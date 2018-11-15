<?php
/*$data = ['response' => 2, "error" => "", "data" => ""];

$token = !empty($var[0]) ? $var[0] : filter_input(INPUT_POST, 'token', FILTER_DEFAULT);
$dados = filter_input(INPUT_POST, FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

$read = new \ConnCrud\Read();
$read->exeRead(PRE . "usuarios", "WHERE token = :to", "to={$token}");
if ($read->getResult() && $read->getResult()[0]['status'] === '1') {
    $userId = (int)$read->getResult()[0]['id'];

    $plano = [
        "status" => trim(strip_tags($dados['cep'] ?? null)),
        "observacoes" => trim(strip_tags($dados['logradouro'] ?? null)),
        "plano" => trim(strip_tags($dados['numero'] ?? null)),
        "bairro" => trim(strip_tags($dados['bairro'] ?? null)),
        "cidade" => trim(strip_tags($dados['cidade'] ?? null)),
        "estado" => trim(strip_tags($dados['estado'] ?? null)),
        "pais" => trim(strip_tags($dados['pais'] ?? null)),
    ];

    $plano = array_filter($plano);

    if (empty($plano)) {
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

        } elseif (!empty($endereco['cep']) && !empty($endereco['numero']) && !empty($endereco['logradouro']) && !empty($endereco['bairro']) && !empty($endereco['cidade']) && !empty($endereco['estado']) && !empty($endereco['pais'])) {
            $create = new \ConnCrud\Create();
            $create->exeCreate("endereco", $endereco);
            if ($create->getErro()) {
                $data['error'] = strip_tags($up->getErro());
            } elseif ($create->getResult()) {
                $up = new \ConnCrud\Update();
                $up->exeUpdate("clientes", ["endereco" => (int)$create->getResult()], "WHERE login = :ac", "ac={$userId}");
            } else {
                $data['error'] = "Não foi possível criar o Endereço";
            }
        }
    }
} else {
    $data['error'] = $read->getResult() ? "Conta Desativada" : "Token Inválido";
}*/