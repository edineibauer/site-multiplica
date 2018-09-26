<?php
$data = ['response' => 2, "error" => "", "data" => ""];

/*Obtém user*/
if (!empty($_POST['user']))
    $user = trim(strip_tags(filter_input(INPUT_POST, 'user', FILTER_DEFAULT)));
else
    $data['error'] = "parâmetro 'user' não recebido. (pode ser passado o valor do CPF, email ou telefone)";

/*Obtém senha*/
if (!empty($_POST['password']))
    $pass = (string)\Helpers\Check::password(trim(filter_input(INPUT_POST, 'password', FILTER_DEFAULT)));
else
    $data['error'] = "parâmetro 'password' não recebido.";

/* VERIFICA CPF MASCARA */
if(preg_match('/\d{3}.\d{3}-\d{2}/i', $user))
    $user = str_replace([".", '-'], '', $user);

if (empty($data['error'])) {
    $d = new \EntityForm\Dicionario("usuarios");
    $emailName = $d->search($d->getInfo()['email'])->getColumn();
    $telName = $d->search($d->getInfo()['tel'])->getColumn() ?? $emailName;
    $password = $d->search($d->getInfo()['password'])->getColumn();

    $read = new \ConnCrud\Read();
    $sql = new \ConnCrud\SqlCommand();

    if (is_numeric($user) && strlen($user) === 11 && \Helpers\Check::cpf($user)) {
        $sql->exeCommand("SELECT u.id, u.status, u.token FROM " . PRE . "usuarios as u JOIN " . PRE . "clientes as c ON u.id = c.acesso WHERE (c.cpf = '{$user}' OR u.{$telName} = '{$user}') AND u.{$password} = '{$pass}'");
        if ($sql->getErro()) {
            $data['error'] = trim(strip_tags($sql->getErro()));
        } elseif ($sql->getResult()) {
            $data['data'] = $sql->getResult()[0];
        } else {
            //Verifica motivo da falha ao logar
            $read->exeRead(PRE . "clientes", "WHERE cpf = :cc", "cc={$user}");
            if ($read->getResult()) {
                $data['error'] = "Senha inválida";
            } else {
                $read->exeRead(PRE . "usuarios", "WHERE {$telName} = :tn", "tn={$user}");
                $data['error'] = $read->getResult() ? "Senha inválida para o Telefone " . \Helpers\Check::mask($user, '(##) #####-####') : "CPF não Existe";
            }
        }

    } else {
        $sql->exeCommand("SELECT u.id, u.status, u.token FROM " . PRE . "usuarios as u JOIN " . PRE . "clientes as c ON u.id = c.acesso WHERE (u.{$emailName} = '{$user}' OR u.{$telName} = '{$user}') AND u.{$password} = '{$pass}'");
        if ($sql->getErro()) {
            $data['error'] = trim(strip_tags($sql->getErro()));
        } elseif ($sql->getResult()) {
            $data['data'] = $sql->getResult()[0];
        } else {
            $read->exeRead(PRE . "usuarios", "WHERE {$telName} = :us || {$emailName} = :us", "us={$user}");
            $data['error'] = $read->getResult() ? "Senha inválida" : "Usuário não existe (email ou telefone)";
        }
    }

    if (!empty($data['data']) && $data['data']['status'] === "1") {
        $data['response'] = 1;

        /* GERA NOVO TOKEN */
        if (empty($data['data']['token'])) {
            $data['data']['token'] = md5("tokes" . rand(9999, 99999) . md5(base64_encode(date("Y-m-d H:i:s"))) . rand(0, 9999));
            $up = new \ConnCrud\Update();
            $up->exeUpdate(PRE . "usuarios", [
                'token' => $data['data']['token'],
                "token_expira" => date("Y-m-d H:i:s"),
                "token_recovery" => null
            ], "WHERE id = :tok", "tok={$data['data']['id']}");
        }

        /* RETORNA SOMENTE TOKEN */
        $data['data'] = $data['data']['token'];
    }
}