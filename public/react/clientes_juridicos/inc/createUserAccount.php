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
            "nova_senha" => $senhaUser,
            "data" => date("Y-m-d H:i:s"),
            "status" => 1,
            "setor" => 5,
            "nivel" => 1,
            "token_recovery" => $senhaUser
        ];

        $dicUser = new \Entity\Dicionario("usuarios");
        $dicUser->setData($user);
        $dicUser->save();

        if ($dicUser->getError()) {
            $data['error'] = $dicUser->getError();
        } else {
            $up = new \ConnCrud\Update();
            $up->exeUpdate("clientes_juridicos", ["login" => $dicUser->search(0)->getValue()], "WHERE id = :id", "id={$dados['id']}");
        }
    }
}