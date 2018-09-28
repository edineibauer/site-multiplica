<?php
$data = ['response' => 2, "error" => "", "data" => ""];

$token = !empty($var[0]) ? $var[0] : filter_input(INPUT_POST, 'token', FILTER_DEFAULT);
$senha = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);

$senha = "teste555";

if (empty($senha) || strlen($senha) < 3) {
    $data['error'] = "Senha deve possuir 3 ou mais caracteres";
} else {

    $read = new \ConnCrud\Read();
    $read->exeRead(PRE . "usuarios", "WHERE token_recovery = :to", "to={$token}");
    if ($read->getResult() && $read->getResult()[0]['status'] === '1') {
        $user = $read->getResult()[0];

        $d = new \EntityForm\Dicionario("usuarios");
        $passColumn = $d->search($d->getInfo()['password'])->getColumn();

        $dados = [
            "token_recovery" => "",
            "token" => "",
            "token_expira" => null,
            $passColumn => \Helpers\Check::password($senha)
        ];

        $up = new \ConnCrud\Update();
        $up->exeUpdate("usuarios", $dados, "WHERE id = :tt", "tt={$user['id']}");
        if ($up->getErro()) {
            $data['error'] = strip_tags($up->getErro());
        } else {
            $data = [
                "error" => "",
                "data" => "senha alterada",
                "response" => 1
            ];
        }

    } else {
        $data['error'] = $read->getResult() ? "Conta Desativada" : "Token Inválido";
    }
}