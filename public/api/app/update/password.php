<?php
$data = ['response' => 2, "error" => "", "data" => ""];

$token = trim(strip_tags(filter_input(INPUT_POST, 'token', FILTER_DEFAULT)));
$old = \Helpers\Check::password(trim(strip_tags(filter_input(INPUT_POST, 'passwordToken', FILTER_DEFAULT))));
$senha = trim(strip_tags(filter_input(INPUT_POST, 'password', FILTER_DEFAULT)));

if (empty($senha) || strlen($senha) < 3) {
    $data['error'] = "Nova Senha deve possuir 3 ou mais caracteres";
} else {
    $d = new \Entity\Dicionario("usuarios");
    $passName = $d->search($d->getInfo()['password'])->getColumn();

    $read = new \ConnCrud\Read();
    $read->exeRead(PRE . "usuarios", "WHERE token = :tt && {$passName} = :to", "tt={$token}&to={$old}");
    if ($read->getResult() && $read->getResult()[0]['status'] === '1') {
        $user = $read->getResult()[0];

        $dados = [
            "token_recovery" => "",
            "token" => "",
            "token_expira" => null,
            $passName => \Helpers\Check::password($senha)
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

    } elseif ($read->getResult()) {
        $data['error'] = "Usuário com Acesso Desativado!";
    } else {
        $read->exeRead(PRE . "usuarios", "WHERE token = :tt", "tt={$token}");
        $data['error'] = ($read->getResult() ? "Senha Atual Inválida" : "Token inválido");
    }
}