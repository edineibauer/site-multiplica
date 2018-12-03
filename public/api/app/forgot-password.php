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

        //Prepara para enviar email
        $envio = new \EmailControl\EmailEnvio();
        $envio->setAssunto("Recuperação de Senha");
        $envio->setDestinatarioEmail($email);
        $envio->setBtnLink(HOME . "inserir-nova-senha/{$code}");
        $envio->setBtnText("<b style='font-size:25px;color:white'>Redefinir Senha</b>");
        $envio->setMensagem("Para redefinir sua senha, clique no link abaixo.");
        $envio->enviar();

    } else {
        $data['error'] = "não foi possível recuperar o email";
    }
} elseif ($read->getResult()) {
    $data['error'] = "Usuário com Acesso Desativado!";
} else {
    $data['error'] = "Usuário não encontrado";
}