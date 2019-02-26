<?php

$dicCliente = new \Entity\Dicionario("consultor");
$dicUser = new \Entity\Dicionario("usuarios");
$read = new \ConnCrud\Read();
$del = new \ConnCrud\Delete();

$read->exeRead("consultor", "WHERE id = :id", "id={$dados['id']}");
$dados = $read->getResult()[0] ?? [];

$setor = $_SESSION['userlogin']['setor'] ?? 0;
$nome = $dados[$dicCliente->search($dicCliente->getInfo()['title'])->getColumn()];
$senha = $dados[$dicCliente->search($dicCliente->getInfo()['password'])->getColumn()];
$columnStatus = $dicCliente->search($dicCliente->getInfo()['status'])->getColumn();
$status = $dados[$columnStatus];
$consultor = [$columnStatus => $setor <= ADM ? $status : 0];

/* COLUMN NAME */
$tel = $dicUser->search($dicUser->getInfo()['tel'])->getColumn();
$email = $dicUser->search($dicUser->getInfo()['email'])->getColumn();
$pass = $dicUser->search($dicUser->getInfo()['password'])->getColumn();

//verifica se este consultor já existe
$erro = null;
$admSetor = ADM;

//CNPJ
$cnpj = "";
if ($setor === "7") {
    $read->exeRead("revenda", "WHERE login = :id", "id={$_SESSION['userlogin']['id']}");
    if($read->getResult())
        $cnpj = $read->getResult()[0]['cnpj'];

} elseif ($setor === "8") {
    $read->exeRead("consultor", "WHERE login = :id", "id={$_SESSION['userlogin']['id']}");
    if($read->getResult())
        $cnpj = $read->getResult()[0]['pessoa'] == "1" ? $read->getResult()[0]['cnpj'] : $read->getResult()[0]['cpf'];
}

$tipo = ($setor === 8 ? "o Consultor(a)" : "a Revenda") . " com CNPJ <b>{$cnpj}</b>";

if ($dados['pessoa'] == 1) {
    //consultor jurídio

    if (empty($dados['cnpj'])) {
        $erro = ["cnpj" => "Informe o CNPJ"];
    } else {
        $read->exeRead("consultor", "WHERE cnpj = :cnpj && id != :id", "cnpj={$dados['cnpj']}&id={$dados['id']}");
        if ($read->getResult()) {
            $erro = ["cnpj" => "Consultor já Cadastrado!"];
            $consultorExiste = $read->getResult()[0];
            $ativo = $consultorExiste['ativo'] == 1 ? "ativo" : "inativo";

            $read->exeRead("usuarios", "WHERE setor <= :setor && setor > 1", "setor={$admSetor}");
            if ($read->getResult()) {
                foreach ($read->getResult() as $item) {
                    $mensagem = new \Entity\Dicionario("dashboard_note");
                    $mensagem->setData(["titulo" => "Consultor <b>{$dados['nome_razao_social']}</b> já Cadastrado.", "descricao" => $tipo . ", nome de usuário '" . $_SESSION['userlogin']['nome'] . "' tentou cadastrar '{$dados['nome_razao_social']}' com CNPJ <b>{$dados['cnpj']}</b> cujo qual já esta cadastrado e <b>{$ativo}</b> no sistema.", "status" => 2, "autor" => $item['id']]);
                    $mensagem->save();
                }
            }
        }
    }
} else {
    //consultor físico
    if (empty($dados['cpf'])) {
        $erro = ["cpf" => "Informe o CPF!"];
    } else {
        $read->exeRead("consultor", "WHERE cpf = :cpf && id != :id", "cpf={$dados['cpf']}&id={$dados['id']}");
        if ($read->getResult()) {
            $erro = ["cpf" => "Consultor já Cadastrado!"];
            $consultorExiste = $read->getResult()[0];
            $ativo = $consultorExiste['ativo'] == 1 ? "ativo" : "inativo";

            $read->exeRead("usuarios", "WHERE setor <= :setor && setor > 1", "setor={$admSetor}");
            if ($read->getResult()) {
                foreach ($read->getResult() as $item) {
                    $mensagem = new \Entity\Dicionario("dashboard_note");
                    $mensagem->setData(["titulo" => "Consultor <b>{$dados['nome_razao_social']}</b> já Cadastrado.", "descricao" => $tipo . ", nome de usuário '" . $_SESSION['userlogin']['nome'] . "' tentou cadastrar '{$dados['nome_razao_social']}' com CPF <b>{$dados['cpf']}</b> cujo qual já esta cadastrado e <b>{$ativo}</b> no sistema.", "status" => 2, "autor" => $item['id']]);
                    $mensagem->save();
                }
            }
        }
    }
}

if (empty($erro)) {
    $up = new \ConnCrud\Update();
    if (!empty($nome) && !empty($senha)) {

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
            $up->exeUpdate("usuarios", [$pass => $senha], "WHERE id = :id", "id={$consultor["login"]}");
        }
    }

    if($setor <= ADM && !empty($dados['revenda'])) {
        $read->exeRead("revenda", "WHERE id = :id", "id={$dados['revenda']}");
        if($read->getResult())
            $consultor['dono'] = $read->getResult()[0]['login'];
    }

    $up->exeUpdate("consultor", $consultor, "WHERE id = :id", "id={$dados['id']}");
} else {
    $del->exeDelete("consultor", "WHERE id = :id", "id={$dados['id']}");
    $data['error'] = $erro;
}