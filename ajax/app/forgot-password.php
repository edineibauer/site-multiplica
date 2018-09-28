<?php
$data = ['response' => 2, "error" => "", "data" => ""];

$email = !empty($var[0]) ? $var[0] : filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

$d = new \EntityForm\Dicionario("usuarios");
$emailName = $d->search($d->getInfo()['email'])->getColumn();
$columnName = \Helpers\Check::email($email) && !empty($emailName) ? $emailName : "token";
$read = new \ConnCrud\Read();
$read->exeRead(PRE . "usuarios", "WHERE {$columnName} = :to", "to={$email}");

if ($read->getResult() && $read->getResult()[0]['status'] === '1') {

    //Dados de Usuário
    $user = $read->getResult()[0];
    $email = $user[$emailName];

    if (!empty($email) && \Helpers\Check::email($email)) {

        $code = md5(base64_encode(date('Y-m-d H:i:s') . "recovery-pass"));
        $up = new \ConnCrud\Update();
        $up->exeUpdate("usuarios", ['token' => null, 'token_recovery' => $code, "token_expira" => date('Y-m-d H:i:s')], "WHERE id = :iid", "iid={$user['id']}");

        $data = [
            'response' => 1,
            'data' => "Email de Recuperação Enviado",
            'error' => ""
        ];

        $send = new \EmailControl\EmailSparkPost();
        $send->setAssunto("Recuperação de Senha " . SITENAME);
        $send->setTemplate("password", ['token_recovery' => $code]);
        $send->enviar($email);
    } else {
        $data['error'] = "não foi possível recuperar o email";
    }
} else {
    $data['error'] = "Usuário não encontrado";
}