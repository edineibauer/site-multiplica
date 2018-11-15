<?php
$data = ['response' => 1, "error" => "", "data" => "Usuário Atualizado"];

$token = trim(strip_tags(filter_input(INPUT_POST, 'token', FILTER_DEFAULT)));
$dados = filter_input(INPUT_POST, FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

/*Separa os dados de usuário e os dados de cliente*/
$user = [
    "nome" => trim(strip_tags($dados['nome'] ?? null)),
    "telefone" => trim(strip_tags($dados['telefone'] ?? null)),
    "email" => trim(strip_tags($dados['email'] ?? null)),
    "status" => $dados['status'] ?? null,
    "imagem" => !empty($dados['imagem']) ? ["url" => $dados['imagem'], "name" => rand(100000,1000000),  "size" => 77934, "type" => "image/jpeg"] : null
];

$user = array_filter($user);
unset($dados['nome'], $dados['telefone'], $dados['email'], $dados['status'], $dados['setor'], $dados['imagem'], $dados['nova_senha']);

$dados = [
    "nome_completo" => trim(strip_tags($dados['nome_completo'] ?? null)),
    "cpf" => trim(strip_tags($dados['cpf'] ?? null)),
    "sexo" => trim(strip_tags($dados['sexo'] ?? null)),
    "data_de_nascimento" => trim(strip_tags($dados['data_de_nascimento'] ?? null)),
    "observacoes" => trim(strip_tags($dados['observacoes'] ?? null))
];

$dados = array_filter($dados);

if (empty($token)) {
    $data = [
        'response' => 2,
        'error' => "envie o token do usuário a ser atualizado.",
        'data' => null
    ];
} else {
    $read = new \ConnCrud\Read();
    $read->exeRead("usuarios", "WHERE token = :tt", "tt={$token}");
    if ($read->getResult()) {
        $userId = (int)$read->getResult()[0]['id'];

        if (empty($user) && empty($dados)) {
            $data = [
                'response' => 2,
                'error' => "Nenhuma Alteração recebida",
                'data' => null
            ];
        } else {

            //Update User
            if (!empty($user)) {
                $up = new \ConnCrud\Update();
                $up->exeUpdate("usuarios", $user, "WHERE id = :tt", "tt={$userId}");
                if ($up->getErro()) {
                    $data = [
                        'response' => 2,
                        'error' => strip_tags($up->getErro()),
                        'data' => null
                    ];
                }
            }

            //Update Cliente
            if (!empty($dados)) {
                $sql = new \ConnCrud\SqlCommand();
                $sql->exeCommand("SELECT c.id FROM " . PRE . "clientes as c JOIN " . PRE . "usuarios as u ON u.id = c.login WHERE u.id = '{$userId}'");
                if ($sql->getResult()) {
                    $clienteId = (int)$sql->getResult()[0]['id'];
                    $up = new \ConnCrud\Update();
                    $up->exeUpdate("clientes", $dados, "WHERE id = :ci", "ci={$clienteId}");
                    if ($up->getErro()) {
                        $data = [
                            'response' => 2,
                            'error' => strip_tags($up->getErro()),
                            'data' => null
                        ];
                    }
                } else {
                    $data = [
                        'response' => 2,
                        'error' => "Opss, este usuário não é um cliente!",
                        'data' => null
                    ];
                }
            }
        }
    } else {
        $data = [
            'response' => 2,
            'error' => "token inválido",
            'data' => null
        ];
    }
}
