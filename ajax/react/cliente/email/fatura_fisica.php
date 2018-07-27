<?php
$read = new \ConnCrud\Read();
$read->exeRead(PRE . "cliente_p_fisica", "WHERE id = :id", "id={$dados['cliente_pf']}");
if ($read->getResult()) {
    $cpj = $read->getResult()[0];
    $read->exeRead(PRE . "usuarios", "WHERE id = :us", "us={$cpj['usuarios']}");
    if ($read->getResult()) {
        $user = $read->getResult()[0];

        $email = new \EmailControl\EmailSparkPost();
        $email->setAssunto("Sua Fatura Multiplica foi Lançada");
        $email->setDestinatarioEmail($user['email']);
        $email->setDestinatarioNome($user['nome_de_usuario']);
        $email->setMensagem("<p>Olá {$user['nome_de_usuario']}.</p><br><p>Por motivos de segurança, nunca pague boletos enviados por email!</p><br><p>Sua fatura se encontra disponível em seu painel de login em: " . HOME . "/cliente");
        $email->enviar();
    }
}