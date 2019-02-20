<?php

/**
 * Cria um usuário para que o cliente consiga logar
 */

$dicCliente = new \Entity\Dicionario("clientes");
$dicUser = new \Entity\Dicionario("usuarios");
$nome = $dados[$dicCliente->search($dicCliente->getInfo()['title'])->getColumn()];

/* COLUMN NAME */
$tel = $dicUser->search($dicUser->getInfo()['tel'])->getColumn();
$email = $dicUser->search($dicUser->getInfo()['email'])->getColumn();

if(!empty($nome) && (!empty($dados[$email]) || !empty($dados[$tel]))) {

    $senhaUser = (!empty($dados['cpf']) ? substr($dados['cpf'], 0, 4) : (!empty($dados[$email]) ? explode("@", $dados[$email])[0] : substr($dados[$tel], -4)));
    $user = [
        "nome" => $nome,
        "nome_usuario" => \Helpers\Check::name($nome),
        $email => $dados[$email] ?? "",
        $tel => $dados[$tel] ?? "",
        "nova_senha" => $senhaUser,
        "data" => date("Y-m-d H:i:s"),
        "status" => 1,
        "setor" => 6,
        "nivel" => 1,
        "token_recovery" => $senhaUser
    ];

    $dicUser->setData($user);
    $dicUser->save();

    if (!$dicUser->getError()) {
        $data['error'] = $dicUser->getError();
    } else {
        $up = new \ConnCrud\Update();
        $up->exeUpdate("clientes", ["login" => $dicUser->search(0)->getValue()], "WHERE id = :id", "id={$dados['id']}");
    }

    /* Se o criador do cliente for um Convenio, então associa */
    if($_SESSION['userlogin']['setor'] == 5 && !empty($_SESSION['convenio'])) {
        $create = new \ConnCrud\Create();
        $create->exeCreate("clientes_juridicos_clientes", ["clientes_juridicos_id" => $_SESSION['convenio']['id'], "clientes_id" => $dados['id']]);
    }
}