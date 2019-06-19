<?php

use ConnCrud\Read;
use ConnCrud\SqlCommand;

$start = filter_input(INPUT_POST, 'datestart', FILTER_DEFAULT);
$end = filter_input(INPUT_POST, 'dateend', FILTER_DEFAULT);
$where = "";

if (!empty($start))
    $where = "p.data_de_inicio >= '{$start}'";

if (!empty($end))
    $where .= (!empty($where) ? " AND " : "") . "p.data_de_inicio <= '{$end}'";

/**
 * Lógica para delimitar apenas clientes com contratos ativos
 */
/*if(!empty($end)) {
    if(empty($start))
        $start = date("Y-m-d", strtotime('now'));

    if($start > $end) {
        $t = $start;
        $start = $end;
        $end = $t;
    }

    $daysBetween = round((strtotime($end) - strtotime($start)) / (60 * 60 * 24));
    $mesesBetween = $daysBetween > 30 ? ceil($daysBetween / 30) : 1;
    $endVar = ($mesesBetween > 36 ? 7 : ($mesesBetween > 24 ? 6 : ($mesesBetween > 12 ? 5 : ($mesesBetween > 6 ? 4 : ($mesesBetween > 3 ? 3 : ($mesesBetween > 1 ? 2 : 1))))));

    $where .= " AND tp.contrato_de >= '{$endVar}'";
}*/

$dadosClientes['clientes'] = [];
$consultor = [];
$planos = [];

$read = new Read();
$read->exeRead("tipos_de_planos");
if (!empty($read->getResult())) {
    foreach ($read->getResult() as $item)
        $planos[$item['id']] = $item;
}

$read->exeRead("consultor");
if (!empty($read->getResult())) {
    foreach ($read->getResult() as $item)
        $consultor[$item['id']] = $item;
}

$sql = new SqlCommand();
$sql->exeCommand("SELECT * FROM " . PRE . "clientes as c JOIN " . PRE . "planos as p JOIN " . PRE . "tipos_de_planos as tp 
        ON c.plano = p.id AND p.plano = tp.id"
    . (!empty($where) ? " WHERE {$where}" : "")
    . " ORDER BY c.id DESC LIMIT 100");

$fatura = [1 => "10", 2 => "15", 3 => "20"];
if ($sql->getResult()) {
    foreach ($sql->getResult() as $item) {
        $item['data_de_inicio'] = date("d/m/Y", strtotime($item['data_de_inicio']));
        $item['data_de_abertura'] = date("d/m/Y", strtotime($item['data_de_abertura']));
        $item['dia_da_fatura'] = $fatura[$item['dia_da_fatura']];
        $item['consultor'] = !empty($item['consultor']) && !empty($consultor[$item['consultor']]) ? $consultor[$item['consultor']]['nome_razao_social'] : "";
        $item['plano'] = !empty($item['plano']) && !empty($planos[$item['plano']]) ? $planos[$item['plano']]['titulo'] : "";
        $dadosClientes['clientes'][] = $item;
    }
}

$dadosClientes['total'] = $sql->getRowCount();

$tpl = new \Helpers\Template("site-multiplica");
$data['data'] = $tpl->getShow("relatorios_table", $dadosClientes);