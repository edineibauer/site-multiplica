<?php

use ConnCrud\Read;
use ConnCrud\SqlCommand;

function mask($val, $mask)
{
    $maskared = '';
    $k = 0;
    for($i = 0; $i<=strlen($mask)-1; $i++)
    {
        if($mask[$i] == '#')
        {
            if(isset($val[$k]))
                $maskared .= $val[$k++];
        }
        else
        {
            if(isset($mask[$i]))
                $maskared .= $mask[$i];
        }
    }
    return $maskared;
}

$start = filter_input(INPUT_POST, 'datestart', FILTER_DEFAULT);
$end = filter_input(INPUT_POST, 'dateend', FILTER_DEFAULT);
$where = "";
$whereJ = "";

if (!empty($start)) {
    $where = "c.data_de_abertura >= '{$start}'";
    $whereJ = "c.data_de_inicio >= '{$start}'";
}
if (!empty($end)) {
    $where .= (!empty($where) ? " AND " : "") . "c.data_de_abertura <= '{$end}'";
    $whereJ .= (!empty($whereJ) ? " AND " : "") . "c.data_de_inicio <= '{$end}'";
}

$results = [];
$sql = new SqlCommand();
$sql->exeCommand("SELECT u.nome, u.data, c.id, c.nome_completo, c.cpf, c.data_de_abertura, c.data_de_nascimento, c.telefone, c.email, e.*, p.data_de_inicio, p.dia_da_fatura, tp.titulo as plano, co.nome_razao_social as consultor "
    . "FROM " . PRE . "clientes as c "
    . "JOIN " . PRE . "usuarios as u ON c.login = u.id "
    . "JOIN " . PRE . "planos as p ON c.plano = p.id "
    . "JOIN " . PRE . "tipos_de_planos as tp ON p.plano = tp.id "
    . "LEFT JOIN " . PRE . "endereco as e ON c.endereco = e.id "
    . "LEFT JOIN " . PRE . "consultor as co ON c.consultor = co.id "
    . (!empty($where) ? "WHERE {$where} " : "")
    . "ORDER BY c.id DESC LIMIT 100");

if(is_array($sql->getResult()) && !empty($sql->getResult()))
    $results = $sql->getResult();

$sql->exeCommand("SELECT u.nome, u.data, c.razao_social, c.cnpj, c.data_de_inicio, c.telefone, c.email, e.*, p.data_de_inicio, p.dia_da_fatura, tp.titulo as plano, co.nome_razao_social as consultor "
    . "FROM " . PRE . "clientes_juridicos as c "
    . "JOIN " . PRE . "usuarios as u ON c.login = u.id "
    . "JOIN " . PRE . "planos as p ON c.plano = p.id "
    . "JOIN " . PRE . "tipos_de_planos as tp ON p.plano = tp.id "
    . "LEFT JOIN " . PRE . "endereco as e ON c.endereco = e.id "
    . "LEFT JOIN " . PRE . "consultor as co ON c.consultor = co.id "
    . (!empty($whereJ) ? " WHERE {$whereJ}" : "")
    . " ORDER BY c.id DESC LIMIT 100");

if(is_array($sql->getResult()) && !empty($sql->getResult()))
    $results = array_merge($results, $sql->getResult());

$dadosClientes['total'] = count($results);
$dadosClientes['clientes'] = [];
$fatura = [1 => "10", 2 => "15", 3 => "20"];
if ($results) {
    foreach ($results as $item) {
        $item['data_de_inicio'] = date("d/m/Y", strtotime($item['data_de_inicio']));
        $item['data'] = date("d/m/Y", strtotime($item['data']));
        $item['dia_da_fatura'] = $fatura[$item['dia_da_fatura']];
        $item['data_de_nascimento'] = !empty($item['data_de_nascimento']) ? date("d/m/Y", strtotime($item['data_de_nascimento'])) : "";
        $dadosClientes['clientes'][] = $item;
    }
}

$tpl = new \Helpers\Template("site-multiplica");
$data['data'] = $tpl->getShow("relatorios_table_importacao", $dadosClientes);