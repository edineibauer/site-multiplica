<?php
$data = ['response' => 2, "error" => "", "data" => ""];

$token = trim(strip_tags(filter_input(INPUT_POST, 'token', FILTER_DEFAULT)));

$read = new \ConnCrud\Read();
$read->exeRead(PRE . "usuarios", "WHERE token = :to", "to={$token}");
if ($read->getResult() && $read->getResult()[0]['status'] === '1') {

    $sql = new \ConnCrud\SqlCommand();
    $sql->exeCommand("SELECT e.* FROM " . PRE . "endereco as e JOIN " . PRE . "clientes as c ON e.id = c.endereco WHERE c.login = {$read->getResult()[0]['id']}");
    if ($sql->getErro()) {
        $data['error'] = trim(strip_tags($sql->getErro()));
    } elseif ($sql->getResult()) {
        $data['data'] = $sql->getResult()[0];
        $data['response'] = 1;
    } else {
        $data['error'] = "Sem Endereço Cadastrado.";
    }
} else {
    $data['error'] = $read->getResult() ? "Conta Desativada" : "token inválido";
}