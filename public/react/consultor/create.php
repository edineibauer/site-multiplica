<?php

$dicCliente = new \Entity\Dicionario("consultor");
$dicUser = new \Entity\Dicionario("usuarios");

$read = new \ConnCrud\Read();
$read->exeRead("consultor", "WHERE id = :id", "id={$dados['id']}");
$dados = $read->getResult()[0] ?? [];

$nome = $dados[$dicCliente->search($dicCliente->getInfo()['title'])->getColumn()];
$senha = $dados[$dicCliente->search($dicCliente->getInfo()['password'])->getColumn()];
$columnStatus = $dicCliente->search($dicCliente->getInfo()['status'])->getColumn();
$status = $dados[$columnStatus];
$consultor = [$columnStatus => $_SESSION['userlogin']['setor'] <= ADM ? $status : 0];

/* COLUMN NAME */
$tel = $dicUser->search($dicUser->getInfo()['tel'])->getColumn();
$email = $dicUser->search($dicUser->getInfo()['email'])->getColumn();
$pass = $dicUser->search($dicUser->getInfo()['password'])->getColumn();

$up = new \ConnCrud\Update();
if(!empty($nome) && !empty($senha)) {

    $user = [
        "nome" => $nome,
        "nome_usuario" => \Helpers\Check::name($nome),
        $email => $dados[$email] ?? "",
        $tel => $dados[$tel] ?? "",
        $pass => $senha,
        "data" => date("Y-m-d H:i:s"),
        "status" => $consultor[$columnStatus],
        "setor" => 8,
        "nivel" => 1,
        "token_recovery" => $senha
    ];

    $dicUser->setData($user);
    $dicUser->save();

    if ($dicUser->getError()) {
        $data['error'] = $dicUser->getError();
    } else {
        $consultor["login"] = $dicUser->search(0)->getValue();
        $up->exeUpdate("usuarios", [$pass => $senha],"WHERE id = :id", "id={$consultor["login"]}");
    }
}

$up->exeUpdate("consultor", $consultor, "WHERE id = :id", "id={$dados['id']}");