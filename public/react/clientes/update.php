<?php

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

$read->exeRead("clientes", "WHERE id = :ll", "ll={$dados['id']}");
$cliente = $read->getResult()[0];

if (empty($cliente['login']) && !empty($nome) && (!empty($dados['cpf']) || !empty($cliente['email']) || !empty($cliente['telefone']))) {

    //Atualizou Cliente, não Existia Usuário, Requisitos Atendidos, Cria Usuário, Envia Email
    $senhaUser = (!empty($cliente['cpf']) ? substr($cliente['cpf'], 0, 4) : (!empty($cliente['email']) ? explode("@", $cliente['email'])[0] : substr($cliente['telefone'], 0, 4)));
    $user = [
        "nome" => $nome,
        "nome_usuario" => \Helpers\Check::name($nome),
        $email => $cliente['email'] ?? "",
        $tel => $cliente['telefone'] ?? "",
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

} elseif (!empty($cliente['login'])) {

    //Atualizou Cliente, Existia Usuário, Requisitos Atendidos, Atualiza Usuário

    $user = [
        "nome" => $cliente['nome_completo'],
        "nome_usuario" => \Helpers\Check::name($cliente['nome_completo']),
        $email => $cliente['email'] ?? "",
        $tel => $cliente['telefone'] ?? ""
    ];

    $read->exeRead("usuarios", "WHERE id =:id", "id={$cliente['login']}");
    if($read->getResult()) {
        $dadosOld = $read->getResult()[0];

        $up->exeUpdate("usuarios", $user, "WHERE id =:id", "id={$cliente['login']}");

        $read->exeRead("usuarios", "WHERE id =:id", "id={$cliente['login']}");
        if($read->getResult()) {
            $react = new \Entity\React("update", "usuarios", $read->getResult()[0], $dadosOld);
            if(!empty($react->getResponse()['error']))
                $data['error'] = $react->getResponse()['error'];
        }
    }
}