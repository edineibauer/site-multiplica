<?php
/*
$dicUser = new \Entity\Dicionario("usuarios");

$tel = $dicUser->search($dicUser->getInfo()['tel'])->getColumn();
$email = $dicUser->search($dicUser->getInfo()['email'])->getColumn();
$pass = $dicUser->search($dicUser->getInfo()['password'])->getColumn();

if(empty($dadosOld[$email]) && !empty($dados[$email])) {

    //Atualizou Usuário, agora tem Email, manda mensagem

    $read = new \ConnCrud\Read();
    $read->exeRead("clientes", "WHERE login = :ll", "ll={$dados['id']}");
    if ($read->getResult()) {
        $cliente = $read->getResult()[0];

        $senhaUser = (!empty($cliente['cpf']) ? substr($cliente['cpf'], 0, 4) : (!empty($dados[$email]) ? explode("@", $dados[$email])[0] : substr($dados[$tel], 0, 4)));
        if($dados[$pass] !== \Helpers\Check::password($senhaUser)) {
            //senhas não conferem, atualiza para a nova
            $up = new \ConnCrud\Update();
            $up->exeUpdate("usuarios", [$pass => $senhaUser, 'token_recovery' => $senhaUser], "WHERE id = :id", "id={$dados['id']}");
        }
        $dados['token_recovery'] = $senhaUser;

        include 'inc/email/bem-vindo.php';
    }
}*/