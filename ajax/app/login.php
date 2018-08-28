<?php

$user = filter_input(INPUT_POST, 'user', FILTER_DEFAULT);
if (empty($user)) {
    $user = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
    if (empty($user)) {
        $user = filter_input(INPUT_POST, 'telefone', FILTER_DEFAULT);
        if (empty($user))
            $user = filter_input(INPUT_POST, 'tel', FILTER_DEFAULT);
    }
}
$pass = (string)\Helpers\Check::password(trim(filter_input(INPUT_POST, 'senha', FILTER_DEFAULT)));

$d = new \EntityForm\Dicionario("usuarios");
$emailName = $d->search($d->getInfo()['email'])->getColumn();
$telName = $d->search($d->getInfo()['tel'])->getColumn() ?? $emailName;
$password = $d->search($d->getInfo()['password'])->getColumn();

$data['response'] = 2;
$read = new \ConnCrud\Read();
$read->exeRead(PRE . "usuarios", "WHERE ({$emailName} = :email || {$telName} = :email) && {$password} = :pass", "email={$user}&pass={$pass}");
if ($read->getResult() && $read->getResult()[0]['status'] === '1') {

    //Dados de Usuário
    $user = $read->getResult()[0];
    if (!empty($user['imagem']))
        $user['imagem'] = json_decode($user['imagem'], true)[0]['url'];
    unset($user['nova_senha'], $user['token_recovery'], $user['token_expira'], $user['token'], $user['data']);

    //Dados de Cliente
    $read->exeRead("clientes", "WHERE acesso = :ui", "ui={$user['id']}");
    if ($read->getResult()) {
        $cliente = $read->getResult()[0];
        $dc = new \EntityForm\Dicionario("clientes");
        $user['cpf'] = $cliente['cpf'];
        $user['pontos_multiplica'] = $cliente['pontos_multiplica'] ?? 0;
        $user['sexo'] = $dc->search("sexo")->getAllow()['names'][(int)$cliente['sexo']];
        $user['criacao_da_conta'] = $cliente['data_de_abertura'];
        $user['data_de_nascimento'] = $cliente['data_de_nascimento'];
        $user['nome_completo'] = $cliente['nome_completo'];

        //Plano
        $read->exeRead("planos", "WHERE id = :pp", "pp={$cliente['plano']}");
        if ($read->getResult()) {
            $plano = $read->getResult()[0];
            $user['plano'] = [
                "inicio" => $plano['data_de_inicio'],
                "anexos" => $plano['anexar_arquivos'],
                "status" => $plano['status'],
                "observacoes" => $plano['observacoes']
            ];
            $d = new \EntityForm\Dicionario("tipos_de_planos");

            $read->exeRead("tipos_de_planos", "WHERE id = :tpp", "tpp={$plano['plano']}");
            if ($read->getResult()) {
                $user['plano']['tipo'] = $read->getResult()[0]['titulo'];
                $user['plano']['valor'] = $read->getResult()[0]['valor_mensal'];
                $user['plano']['duracao'] = $d->search("contrato_de")->getAllow()['names'][(int)$read->getResult()[0]['contrato_de']];
            }
        }

        //Endereço
        if (!empty($cliente['endereco'])) {
            $read->exeRead("endereco", "WHERE id = :end", "end={$cliente['endereco']}");
            if ($read->getResult()) {
                $endereco = $read->getResult()[0];
                $user['endereco'] = $endereco;
            }
        } else {
            $user['endereco'] = null;
        }
    }
    $data['response'] = 1;
    $data['data'] = $user;
} else {
    $read->exeRead(PRE . "usuarios", "WHERE {$emailName} = :email || {$telName} = :email", "email={$user}");
    $data['error'] = $read->getResult() ? "senha invalida" : "email ou telefone não existe";
}