<?php

$dicCliente = new \Entity\Dicionario("clientes");
$dicUser = new \Entity\Dicionario("usuarios");
$nome = $dados[$dicCliente->search($dicCliente->getInfo()['title'])->getColumn()];

/* COLUMN NAME */
$tel = $dicUser->search($dicUser->getInfo()['tel'])->getColumn();
$email = $dicUser->search($dicUser->getInfo()['email'])->getColumn();

$read = new \ConnCrud\Read();
$read->exeRead("clientes", "WHERE id = :ll", "ll={$dados['id']}");
$cliente = $read->getResult()[0];

var_dump($nome);
var_dump($cliente);die;
if (empty($cliente['login']) && !empty($nome) && (!empty($cliente['email']) || !empty($cliente['telefone']))) {

    //Atualizou Cliente, não Existia Usuário, Requisitos Atendidos, Cria Usuário, Envia Email
    $senhaUser = (!empty($cliente['cpf']) ? substr($cliente['cpf'], 0, 4) : (!empty($cliente['email']) ? explode("@", $cliente['email'])[0] : substr($cliente['telefone'], 0, 4)));
    $user = [
        "nome" => $nome,
        "nome_usuario" => \Helpers\Check::name($nome),
        $email => $cliente['email'] ?? "",
        $tel => $cliente['telefone'] ?? "",
        "nova_senha" => $senhaUser,
        "data" => date("Y-m-d H:i:s"),
        "status" => 1,
        "setor" => 6,
        "nivel" => 1,
        "token_recovery" => $senhaUser
    ];

    $dicUser->setData($user);
    $dicUser->save();


    if ($dicUser->getError()) {
        $data['error'] = $dicUser->getError();
    } else {
        $up = new \ConnCrud\Update();
        $up->exeUpdate("clientes", ["login" => $dicUser->search(0)->getValue()], "WHERE id = :id", "id={$dados['id']}");
    }

} elseif (!empty($cliente['login'])) {

    //Atualizou Cliente, Existia Usuário, Requisitos Atendidos, Atualiza Usuário

    $user = [
        "nome" => $cliente['nome_completo'],
        "nome_usuario" => \Helpers\Check::name($cliente['nome_completo']),
        $email => $cliente['email'] ?? "",
        $tel => $cliente['telefone'] ?? "",
        "id" => $cliente['login']
    ];

    $dicUser->setData($user);
    $dicUser->save();
}
