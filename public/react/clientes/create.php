<?php

/**
 * Cria um usuário para que o cliente consiga logar
 */

$dicCliente = new \Entity\Dicionario("clientes");
$dicUser = new \Entity\Dicionario("usuarios");
$nome = $dados[$dicCliente->search($dicCliente->getInfo()['title'])->getColumn()];
$setor = $_SESSION['userlogin']['setor'];

$up = new \ConnCrud\Update();
$read = new \ConnCrud\Read();
$create = new \ConnCrud\Create();

/* COLUMN NAME */
$tel = $dicUser->search($dicUser->getInfo()['tel'])->getColumn();
$email = $dicUser->search($dicUser->getInfo()['email'])->getColumn();

if(!empty($nome) && (!empty($dados['cpf']) || !empty($dados[$email]) || !empty($dados[$tel]))) {

    $senhaUser = (!empty($dados['cpf']) ? substr($dados['cpf'], 0, 4) : (!empty($dados[$email]) ? explode("@", $dados[$email])[0] : substr($dados[$tel], -4)));
    $user = [
        "nome" => $nome,
        "nome_usuario" => \Helpers\Check::name($nome),
        $email => $dados[$email] ?? "",
        $tel => $dados[$tel] ?? "",
        "nova_senha" => \Helpers\Check::password($senhaUser),
        "data" => date("Y-m-d H:i:s"),
        "status" => 1,
        "setor" => 6,
        "nivel" => 1,
        "token_recovery" => $senhaUser
    ];

    $read->exeRead("usuarios", "WHERE nome = :nn", "nn={$user['nome']}");
    $user['nome'] .= ($read->getResult() ? "-" . strtotime('now') : "");
    $user['nome_usuario'] = \Helpers\Check::name($user['nome']);

    $create->exeCreate("usuarios", $user);
    if($create->getResult()) {
        $react = new \Entity\React("create", "usuarios", $user);
        if(!empty($react->getResponse()['error']))
            $data['error'] = $react->getResponse()['error'];

        $up->exeUpdate("clientes", ["login" => $create->getResult()], "WHERE id = :id", "id={$dados['id']}");
    } else {
        $data['error'] = ['id' => "não foi possível criar usuário"];
    }
}

if($setor === "5" && !empty($_SESSION['convenio'])) {
    //Convênio Criou Usuário
    $create = new \ConnCrud\Create();
    $create->exeCreate("clientes_juridicos_clientes", ["clientes_juridicos_id" => $_SESSION['convenio']['id'], "clientes_id" => $dados['id']]);

} elseif($setor === "7") {
    //Revenda Criou Usuário
    $read->exeRead("revenda", "WHERE login = :li", "li={$_SESSION['userlogin']['id']}");
    if($read->getResult())
        $up->exeUpdate("clientes", ['revenda' => (int)$read->getResult()[0]['id']], "WHERE id = :id", "id={$dados['id']}");

} elseif($setor === "8") {
    //Consultor Criou Usuário
    $read->exeRead("consultor", "WHERE login = :li", "li={$_SESSION['userlogin']['id']}");
    if($read->getResult()) {
        $cliente = ['consultor' => $read->getResult()[0]['id']];
        $read->exeRead("revenda", "WHERE id = :idr", "idr={$read->getResult()[0]['revenda']}");
        if($read->getResult())
            $cliente['revenda'] = $read->getResult()[0]['id'];

        $up->exeUpdate("clientes", $cliente, "WHERE id = :id", "id={$dados['id']}");
    }
}