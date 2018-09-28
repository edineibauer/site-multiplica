<?php
$data = ['response' => 2, "error" => "", "data" => ""];

$read = new \ConnCrud\Read();
$read->exeRead(PRE . "tipos_de_planos");
if ($read->getErro()) {
    $data['error'] = strip_tags($read->getErro());
} elseif ($read->getResult()) {
    $data['data'] = $read->getResult();
} else {
    $data['error'] = "Nenhum Plano Cadastrado";
}