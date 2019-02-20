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

$up = new \ConnCrud\Update();

$revenda = [
    $columnStatus => $_SESSION['userlogin']['setor'] < 3 ? $status : 0,
    "master" => $_SESSION['userlogin']['setor'] < 3 && $dados['master'] ? 1 : 0
];

if (empty($dados['login']) && !empty($nome) && !empty($senha)) {

    $user = [
        "nome" => $nome,
        "nome_usuario" => \Helpers\Check::name($nome),
        $email => $dados['email'] ?? "",
        $tel => $dados['telefone'] ?? "",
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

} else {

    $revenda = [
        $columnStatus => $_SESSION['userlogin']['setor'] < 3 || $dadosOld[$columnStatus] == 1 ? $status : 0,
        "master" => $_SESSION['userlogin']['setor'] < 3 || $dadosOld['master'] == 1 ? $dados['master'] : 0
    ];

    if (!empty($dados['login'])) {
        $user = [
            "nome" => $nome,
            "nome_usuario" => \Helpers\Check::name($nome),
            $email => $dados['email'] ?? "",
            $tel => $dados['telefone'] ?? "",
            $pass => $senha,
            "status" => $revenda[$columnStatus],
            "nivel" => $revenda['master'],
            "id" => $dados['login']
        ];
        $up->exeUpdate("usuarios", $user, "WHERE id = :id", "id={$dados['login']}");
    }

}

$up->exeUpdate("revenda", $revenda, "WHERE id = :id", "id={$dados['id']}");
