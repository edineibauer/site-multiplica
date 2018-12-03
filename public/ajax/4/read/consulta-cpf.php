<?php

$cpf = filter_input(INPUT_POST, 'cpf', FILTER_VALIDATE_INT);

$sql = new \ConnCrud\SqlCommand();
$sql->exeCommand("SELECT * FROM " . PRE . "planos as p JOIN " . PRE . "clientes as c ON c.plano = p.id WHERE c.cpf = '{$cpf}'");
if($sql->getResult()){
    $data['data'] = 1;
} else {
    $read = new \ConnCrud\Read();
    $read->exeRead("clientes", "WHERE cpf = :cpf", "cpf={$cpf}");
    $data['data'] = $read->getResult() ? 2 : 0;
}
