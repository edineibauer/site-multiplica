<?php

/**
 * Cria um usuário para que o credenciado consiga logar
 */

$dicCliente = new \Entity\Dicionario("credenciado_fisico");
$dicUser = new \Entity\Dicionario("usuarios");
$nome = $dados[$dicCliente->search($dicCliente->getInfo()['title'])->getColumn()];

/* COLUMN NAME */
$tel = $dicUser->search($dicUser->getInfo()['tel'])->getColumn();
$email = $dicUser->search($dicUser->getInfo()['email'])->getColumn();

$senhaUser = substr($dados['documento'], 0, 4);

$user = [
    "nome" => $nome,
    "nome_usuario" => \Helpers\Check::name($nome),
    $email => $dados['email'] ?? "",
    $tel => $dados['telefone'] ?? "",
    "nova_senha" => $senhaUser,
    "data" => date("Y-m-d H:i:s"),
    "status" => 1,
    "setor" => 4,
    "nivel" => 1,
    "token_recovery" => $senhaUser
];

$dicUser->setData($user);
$dicUser->save();

if ($dicUser->getError()) {
    $data['error'] = $dicUser->getError();
} else {
    $up = new \ConnCrud\Update();
    $up->exeUpdate("credenciado_fisico", ["login" => $dicUser->search(0)->getValue()], "WHERE id = :id", "id={$dados['id']}");
}