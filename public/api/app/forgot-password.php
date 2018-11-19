<?php
$data = ['response' => 2, "error" => "", "data" => ""];

$token = trim(strip_tags(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)));
$d = new \Entity\Dicionario("usuarios");
$emailName = $d->search($d->getInfo()['email'])->getColumn();
$nomeName = $d->search($d->getInfo()['title'])->getColumn();

$read = new \ConnCrud\Read();
$read->exeRead(PRE . "usuarios", "WHERE {$emailName} = :to", "to={$token}");

if ($read->getResult() && $read->getResult()[0]['status'] === '1') {

    //Dados de Usuário
    $user = $read->getResult()[0];
    $email = $user[$emailName];
    $nome = $user[$nomeName];

    if (!empty($email) && \Helpers\Check::email($email)) {

        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $code = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < 4; $i++)
            $code .= $characters[mt_rand(0, $max)];

        $up = new \ConnCrud\Update();
        $up->exeUpdate("usuarios", ['token' => null, 'token_recovery' => $code, "token_expira" => date('Y-m-d H:i:s')], "WHERE id = :iid", "iid={$user['id']}");

            $data = [
            'response' => 1,
            'data' => "Email de Recuperação Enviado",
            'error' => ""
        ];

        //Prepara para enviar email
        $envioEmail = new \EmailControl\EmailSparkPost();
        $envioEmail->setDestinatarioNome($nome);
        $envioEmail->setAssunto("Recuperação de Senha");
        $envioEmail->setLibrary("site-multiplica");
        $envioEmail->setTemplate("email/games",
            [
                "btn" => "<b style='font-size:25px;color:white'>{$code}</b>",
                "title" => "Recuperação de Senha",
                "logo" => HOME . LOGO,
                "content" => "Para redefinir sua senha, utilize o token de segurança abaixo no aplicativo da multiplica."
                    . "<p style=\"margin:10px 0;padding:0;color:#ffffff;font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;line-height:150%;text-align:center\"><b>SEU TOKEN DE RECUPERAÇÃO</b></p>"
            ]);
        $envioEmail->enviar($email);

    } else {
        $data['error'] = "não foi possível recuperar o email";
    }
} elseif ($read->getResult()) {
    $data['error'] = "Usuário com Acesso Desativado!";
} else {
    $data['error'] = "Usuário não encontrado";
}