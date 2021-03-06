<?php
$data = ['response' => 2, "error" => "", "data" => ""];

$token = trim(strip_tags(filter_input(INPUT_POST, 'token', FILTER_DEFAULT)));
$dados = filter_input(INPUT_POST, FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

$read = new \ConnCrud\Read();
$read->exeRead(PRE . "usuarios", "WHERE token = :to", "to={$token}");
if ($read->getResult() && $read->getResult()[0]['status'] === '1') {
    $userId = (int)$read->getResult()[0]['id'];

    $endereco = [
        "cep" => trim(strip_tags($dados['cep'] ?? null)),
        "logradouro" => trim(strip_tags($dados['logradouro'] ?? null)),
        "numero" => trim(strip_tags($dados['numero'] ?? null)),
        "bairro" => trim(strip_tags($dados['bairro'] ?? null)),
        "cidade" => trim(strip_tags($dados['cidade'] ?? null)),
        "estado" => trim(strip_tags($dados['estado'] ?? null)),
        "pais" => trim(strip_tags($dados['pais'] ?? null)),
    ];

    $endereco = array_filter($endereco);

    if (empty($endereco)) {
        $data['error'] = "Nenhuma Alteração recebida";
    } else {
        $sql = new \ConnCrud\SqlCommand();
        $sql->exeCommand("SELECT e.id FROM " . PRE . "endereco as e JOIN " . PRE . "clientes as c ON c.endereco = e.id WHERE c.login = {$userId}");
        if ($sql->getErro()) {
            $data['error'] = strip_tags($sql->getErro());

        } elseif ($sql->getResult()) {
            $idEndereco = $sql->getResult()[0]['id'];
            $up = new \ConnCrud\Update();
            $up->exeUpdate("endereco", $endereco, "WHERE id = :tt", "tt={$idEndereco}");
            if ($up->getErro())
                $data['error'] = strip_tags($up->getErro());

            $data = [
                "response" => 1,
                "data" => "Endereço Atualizado",
                "error" => ""
            ];

        } elseif (!empty($endereco['cep']) && !empty($endereco['numero']) && !empty($endereco['logradouro']) && !empty($endereco['bairro']) && !empty($endereco['cidade']) && !empty($endereco['estado']) && !empty($endereco['pais'])) {
            $create = new \ConnCrud\Create();
            $create->exeCreate("endereco", $endereco);
            if ($create->getErro()) {
                $data['error'] = strip_tags($up->getErro());
            } elseif ($create->getResult()) {
                $up = new \ConnCrud\Update();
                $up->exeUpdate("clientes", ["endereco" => (int)$create->getResult()], "WHERE login = :ac", "ac={$userId}");

                $data = [
                    "response" => 1,
                    "data" => "Endereço Criado",
                    "error" => ""
                ];

            } else {
                $data['error'] = "Não foi possível criar o Endereço";
            }
        }
    }
} else {
    $data['error'] = $read->getResult() ? "Conta Desativada" : "Token Inválido";
}
