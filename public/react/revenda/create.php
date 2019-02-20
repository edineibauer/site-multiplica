<?php

$dicCliente = new \Entity\Dicionario("revenda");
$dicUser = new \Entity\Dicionario("usuarios");

$read = new \ConnCrud\Read();
$read->exeRead("revenda", "WHERE id = :id", "id={$dados['id']}");
$dados = $read->getResult()[0] ?? [];

$nome = $dados[$dicCliente->search($dicCliente->getInfo()['title'])->getColumn()];
$senha = $dados[$dicCliente->search($dicCliente->getInfo()['password'])->getColumn()];
$columnStatus = $dicCliente->search($dicCliente->getInfo()['status'])->getColumn();
$status = $dados[$columnStatus];

/* COLUMN NAME */
$tel = $dicUser->search($dicUser->getInfo()['tel'])->getColumn();
$email = $dicUser->search($dicUser->getInfo()['email'])->getColumn();
$pass = $dicUser->search($dicUser->getInfo()['password'])->getColumn();

$revenda = [
    $columnStatus => $_SESSION['userlogin']['setor'] <= ADM ? $status : 0,
    "master" => $_SESSION['userlogin']['setor'] <= ADM && $dados['master'] ? 1 : 0
];

if(!empty($nome) && !empty($senha)) {
    $up = new \ConnCrud\Update();
    $create = new \ConnCrud\Create();

    $user = [
        "nome" => $nome,
        "nome_usuario" => \Helpers\Check::name($nome),
        $email => $dados[$email] ?? "",
        $tel => $dados[$tel] ?? "",
        $pass => $senha,
        "data" => date("Y-m-d H:i:s"),
        "setor" => 7,
        "status" => $revenda[$columnStatus],
        "nivel" => $revenda['master'],
        "token_recovery" => $senha
    ];

    $dicUser->setData($user);
    $dicUser->save();

    if ($dicUser->getError()) {
        $data['error'] = $dicUser->getError();
    } else {
        $revenda["login"] = $dicUser->search(0)->getValue();
        $up->exeUpdate("usuarios", [$pass => $senha],"WHERE id = :id", "id={$revenda["login"]}");
    }
}
$up->exeUpdate("revenda", $revenda, "WHERE id = :id", "id={$dados['id']}");