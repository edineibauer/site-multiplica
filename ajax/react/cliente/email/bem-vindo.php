<?php
/**
 * Cria conta de usuário, associa usuário com cliente
 * Disparo de email de boas vindas as usuários da Multiplica.
 * User: Edinei.J.Bauer
 * Date: 28/08/2018
 * Time: 16:26
 */

$d = new \EntityForm\Dicionario($entity);

/*Cria um usuário caso tenha email ou CPF*/
if(!empty($dados['email']) || !empty($dados['cpf'])) {
    $senha = (!empty($dados['cpf']) ? substr($dados['cpf'], 0, 4): explode("@", $dados['email'])[0]);
    $user = [
        "nome_de_usuario" => $dados['nome_completo'],
        "email" => !empty($dados['email']) ? $dados['email'] : "",
        "nova_senha" => Helpers\Check::password($senha),
        "data" => date("Y-m-d H:i:s")
    ];

    $create = new \ConnCrud\Create();
    $create->exeCreate("usuarios", $user);
    $update['login'] = $create->getResult();

    $up = new \ConnCrud\Update();
    $up->exeUpdate("clientes", $update, "WHERE id = :id", "id={$dados['id']}");

    if(!empty($dados['email'])) {
        $email = new \EmailControl\EmailSparkPost();
        $email->setDestinatarioNome($dados[$d->search($d->getInfo()['title'])->getColumn()]);
        $email->setAssunto("Seja Bem-Vindo");
        $email->setLibrary("site-multiplica");
        $email->setTemplate("email/games",
            [
                "url" => HOME . "login",
                "btn" => "Acesse Sua Conta",
                "title" => "Seja Bem-Vindo",
                "logo" => "http://dev.ontab.com.br/logo.jpg",
                "content" => "Com o Multiplica você conta com diversos benefícios, entre eles, descontos em farmácias, postos, mercados, além de acumular pontos em diversos estabelecimentos."
                    . "<p style=\"margin:10px 0;padding:0;color:#ffffff;font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;line-height:150%;text-align:center\">FAÇA LOGIN UTILIZANDO SEU <b>CPF</b> OU <b>EMAIL</b></p>"
                    . "<p style=\"margin:10px 0;padding:0;color:#ffffff;font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;line-height:150%;text-align:center\">SENHA: <b>{$senha}</b></p>",
                "image" => [
                    "image" => HOME . LOGO,
                    "url" => HOME . LOGO
                ]
            ]);
        $email->enviar($dados['email']);
    }
}