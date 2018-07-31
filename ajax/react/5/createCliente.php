<?php

$read = new \ConnCrud\Read();
$read->exeRead("clientes", "WHERE cpf = :cpf", "cpf={$dados['cpf']}");
if(!$read->getResult()) {

    $clienteData = [
        "nome_completo" => trim($dados['nome_completo']),
        "cpf" => $dados['cpf'],
        "status_do_convenio" => $dados['status'],
        "acesso" => $dados['usuario'],
        "sexo" => substr(explode(' ', trim($dados['nome_completo']))[0], -1) === 'a' ? 2 : 1
    ];

    $d = new \EntityForm\Dicionario("clientes");
    $d->setData($clienteData);
    $d->save();
}