<?php
$data = ['response' => 2, "error" => "", "data" => ""];

$token = trim(strip_tags(filter_input(INPUT_POST, 'token', FILTER_DEFAULT)));

$read = new \ConnCrud\Read();
$read->exeRead(PRE . "usuarios", "WHERE token = :to", "to={$token}");
if ($read->getResult() && $read->getResult()[0]['status'] === '1') {

    //Dados de Usuário
    $user = $read->getResult()[0];
    if (!empty($user['imagem']))
        $user['imagem'] = json_decode($user['imagem'], true)[0]['url'];

    unset($user['nova_senha'], $user['token_recovery'], $user['token'], $user['token_expira'], $user['data']);

    //Dados de Cliente
    $read->exeRead("clientes", "WHERE login = :ui", "ui={$user['id']}");
    if ($read->getResult()) {
        $cliente = $read->getResult()[0];
        $dc = new \EntityForm\Dicionario("clientes");
        $user['cpf'] = $cliente['cpf'];
        $user['telefone'] = $cliente['telefone'];
        $user['email'] = $user['email'] ?? $cliente['email'];
        $user['pontos_multiplica'] = $cliente['pontos_multiplica'] ?? 0;
        $user['sexo'] = $dc->search("sexo")->getAllow()['names'][(int)$cliente['sexo']];
        $user['criacao_da_conta'] = $cliente['data_de_abertura'];
        $user['data_de_nascimento'] = $cliente['data_de_nascimento'];
        $user['nome_completo'] = $cliente['nome_completo'];

        //Plano
        $read->exeRead("planos", "WHERE id = :pp", "pp={$cliente['plano']}");
        if ($read->getResult()) {
            $plano = $read->getResult()[0];
            $user['plano'] = [
                "inicio" => $plano['data_de_inicio'],
                "anexos" => $plano['anexar_arquivos'],
                "status" => $plano['status'],
                "observacoes" => $plano['observacoes']
            ];
            $d = new \EntityForm\Dicionario("tipos_de_planos");

            $read->exeRead("tipos_de_planos", "WHERE id = :tpp", "tpp={$plano['plano']}");
            if ($read->getResult()) {
                $user['plano']['tipo'] = $read->getResult()[0]['titulo'];
                $user['plano']['valor'] = $read->getResult()[0]['valor_mensal'];
                $user['plano']['duracao'] = $d->search("contrato_de")->getAllow()['names'][(int)$read->getResult()[0]['contrato_de']];
            }
        }

        //Endereço
        if (!empty($cliente['endereco'])) {
            $read->exeRead("endereco", "WHERE id = :end", "end={$cliente['endereco']}");
            if ($read->getResult()) {
                $endereco = $read->getResult()[0];
                $user['endereco'] = $endereco;
            }
        } else {
            $user['endereco'] = null;
        }
    }
    $data['response'] = 1;
    $data['data'] = $user;
} else {
    $data['error'] = $read->getResult() ? "Conta Desativada" : "token inválido";
}