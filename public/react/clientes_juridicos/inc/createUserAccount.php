<?php

if (empty($dados['login'])) {
    $dicCliente = new \Entity\Dicionario("clientes_juridicos");
    $nome = $dados[$dicCliente->search($dicCliente->getInfo()['title'])->getColumn()];
    $tel = $dicCliente->search($dicCliente->getInfo()['tel'])->getColumn();
    $email = $dicCliente->search($dicCliente->getInfo()['email'])->getColumn();
    if (!empty($nome) && (!empty($dados[$email]) || !empty($dados[$tel]))) {

        $senhaUser = (!empty($dados['cnpj']) ? substr($dados['cnpj'], 0, 4) : (!empty($dados[$email]) ? explode("@", $dados[$email])[0] : substr($dados[$tel], -4)));
        $user = [
            "nome" => $nome,
            "nome_usuario" => \Helpers\Check::name($nome),
            "email" => $dados[$email] ?? "",
            "telefone" => $dados[$tel] ?? "",
            "nova_senha" => \Helpers\Check::password($senhaUser),
            "data" => date("Y-m-d H:i:s"),
            "status" => 1,
            "setor" => 5,
            "nivel" => 1,
            "token_recovery" => $senhaUser
        ];

        $read = new \ConnCrud\Read();
        $create = new \ConnCrud\Create();
        $up = new \ConnCrud\Update();

        $read->exeRead("usuarios", "WHERE nome = :nn", "nn={$user['nome']}");
        $user['nome'] .= ($read->getResult() ? "-" . strtotime('now') : "");
        $user['nome_usuario'] = \Helpers\Check::name($user['nome']);

        $create->exeCreate("usuarios", $user);
        if($create->getResult()) {
            $up->exeUpdate("clientes_juridicos", ["login" => $create->getResult()], "WHERE id = :id", "id={$dados['id']}");
        } else {
            $data['error'] = ['id' => "não foi possível criar usuário"];
        }
    }
}