<?php
$data = ['response' => 2, "error" => "", "data" => []];

$sql = new \ConnCrud\SqlCommand();
$read = new \ConnCrud\Read();

$sql->exeCommand("SELECT DISTINCT especialidade FROM " . PRE . "especialidades");

if($sql->getResult()) {
    foreach ($sql->getResult() as $item)
        $data['data'] = $sql->getResult();
}

if(empty($data['data']))
    $data['error'] = "Nenhuma Especialidade Encontrada";