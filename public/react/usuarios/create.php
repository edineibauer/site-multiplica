<?php
/**
 * Disparo de email de boas vindas aos usuários da Multiplica.
 */

$d = new \Entity\Dicionario("usuarios");
$emailDestinatario = $dados[$d->search($d->getInfo()['email'])->getColumn()];
$telDestinatario = (!empty($d->getInfo()['tel']) ? $dados[$d->search($d->getInfo()['tel'])->getColumn()] : "");
$nome = $dados[$d->search($d->getInfo()['title'])->getColumn()];
$senha = (!empty($dados['token_recovery']) ? $dados['token_recovery'] : "");

if (!empty($emailDestinatario)) {
    try {
        //Prepara para enviar email

        $up = new \ConnCrud\Update();
        $up->exeUpdate("usuarios", ["token_recovery" => ""], "WHERE id = :id", "id={$dados['id']}");

        $emailEnvio = new \Entity\Dicionario('email_envio');
        $emailEnvio->setData([
            'email_destinatario' => $emailDestinatario,
            'nome_destinatario' => !empty($nome) ? $nome : "",
            'assunto' => "Bem-Vindo a Multiplica",
            'mensagem' => "<p style='color:#FFFFFF'>Com o Multiplica você conta com diversos benefícios, entre eles, descontos em farmácias, postos, mercados, além de acumular pontos em diversos estabelecimentos.</p>"
                    . "<p style=\"margin:10px 0;padding:0;color:#ffffff;font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;line-height:150%;text-align:center\">UTILIZE SEU <b>CPF/CNPJ</b> OU <b>EMAIL</b> para fazer login</p>"
                    . "<p style=\"margin:10px 0;padding:0;color:#ffffff;font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;line-height:150%;text-align:center\">SENHA: <b>{$senha}</b></p>"
                    . "<p style=\"margin-top:40px;padding:0;color:#ffffff;font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;line-height:150%;text-align:center\">"
                    . "<a href=\"http://bit.ly/2qhm6la\" style='padding-right:10px'><img src=\"". HOME ."public/assets/img/playstore.jpg\" width='135' height='40' style='width: 135px' alt=\"logo play store\"></a>"
                    . "<a href=\"http://bit.ly/2qhm6la\"><img src=\"". HOME ."public/assets/img/appstore.png\" width='135' height='40' style='width: 135px' alt=\"logo app store\"></a>"
                    . "</p>"
            ]);
        $emailEnvio->save();
        if ($emailEnvio->getError())
            $data['error'] = $emailEnvio->getError();

    } catch (Exception $exception) {
        $data['error'] = "Erro de Exception ao Enviar Email";
    }
}

if (!empty($telDestinatario)) {
    try {
        //Prepara para enviar email
        $telDic = new \Entity\Dicionario("smsiagente");
        $telDic->setData([
            "celular" => $telDestinatario,
            "mensagem" => "Bem vindo(a) a MULTIPLICA, utilize o APP para android http://bit.ly/2qhm6la, acesse com seu Email ou CPF/CNPJ, juntamente com a senha: {$senha}",
            "status" => "AGUARDANDO"
        ]);
        $telDic->save();

        if ($telDic->getError())
            $data['error'] = $telDic->getError();

    } catch (Exception $exception) {
        $data['error'] = "Erro de Exception ao Enviar Email";
    }
}