<?php

/* Reenvia SMS caso seja alterado */
if(!empty($dados['telefone']) && $dadosOld['telefone'] !== $dados['telefone']) {
    try {
        //Prepara para enviar email
        $telDic = new \Entity\Dicionario("smsiagente");
        $telDic->setData([
            "celular" => $dados['telefone'],
            "mensagem" => "Bem vindo(a) a MULTIPLICA, utilize o APP para android http://bit.ly/2qhm6la, acesse com seu Email ou CPF/CNPJ, juntamente com a senha: {$senha}",
            "status" => "AGUARDANDO"
        ]);
        $telDic->save();

        if ($telDic->getError())
            $data['error'] = $telDic->getError();

    } catch (Exception $exception) {
        $data['error'] = "Erro de Exception ao Enviar Email";
    }
}

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