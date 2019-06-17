<?php

use ConnCrud\Read;
use ConnCrud\SqlCommand;

$dadosTemplate['planos'] = [];
$dadosTemplate['consultor'] = [];
$dadosTemplate['clientes'] = [];

$read = new Read();
$read->exeRead("tipos_de_planos");
if(!empty($read->getResult())) {
    foreach ($read->getResult() as $item)
        $dadosTemplate['planos'][$item['id']] = $item;
}
$read->exeRead("consultor");
if(!empty($read->getResult())) {
    foreach ($read->getResult() as $item)
        $dadosTemplate['consultor'][$item['id']] = $item;
}

$sql = new SqlCommand();
$sql->exeCommand("SELECT * FROM " . PRE . "clientes as c JOIN " . PRE . "planos as p ON c.plano = p.id ORDER BY c.id DESC LIMIT 100");
if($sql->getResult()) {
    foreach ($sql->getResult() as $item) {
        $item['data_de_abertura'] = date("d/m/Y", strtotime($item['data_de_abertura']));
        $dadosTemplate['clientes'][] = $item;
    }
}

$dadosTemplate['total'] = $sql->getRowCount();

$tpl = new \Helpers\Template("site-multiplica");
$data['data'] = $tpl->getShow("relatorios", []);