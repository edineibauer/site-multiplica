<?php
$data = ['response' => 2, "error" => "", "data" => []];

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
$nome = filter_input(INPUT_POST, "especialidade", FILTER_DEFAULT);

$sql = new \ConnCrud\SqlCommand();
$read = new \ConnCrud\Read();

$where = "";
if($id)
    $where = " AND e.id = {$id}";
elseif($nome)
    $where = " AND e.especialidade = '{$nome}'";

$sql->exeCommand("SELECT e.*, cj.id as id_credenciado, cj.razao_social as nome, cj.documento, cj.email, cj.telefone, cj.estado, cj.estado, cj.bairro FROM " . PRE . "especialidades as e JOIN " . PRE . "credenciado_juridico_especialidades as cje JOIN " . PRE . "credenciado_juridico as cj"
    . " ON e.id = cje.especialidades_id AND cje.credenciado_juridico_id = cj.id"
    . " WHERE e.credenciado_juridico = 1" . $where);

$e = 0;
if($sql->getResult()) {
    foreach ($sql->getResult() as $item) {
        $data['data'][$e] = $item;
        $data['data'][$e]['data'] = date("d/m/Y", strtotime($item['data']));
        $data['data'][$e]['tipo'] = "Credenciado Jurídico";
        unset($data['data'][$e]['credenciado_juridico'], $data['data'][$e]['razao_social'], $data['data'][$e]['login']);
        $e++;
    }
}

$sql->exeCommand("SELECT e.*, cf.id as id_credenciado, cf.nome, cf.documento, cf.email, cf.telefone, cf.estado, cf.estado, cf.bairro FROM " . PRE . "especialidades as e JOIN " . PRE . "credenciado_fisico_especialidades as cfe JOIN " . PRE . "credenciado_fisico as cf"
    . " ON e.id = cfe.especialidades_id AND cfe.credenciado_fisico_id = cf.id"
    . " WHERE e.credenciado_juridico = 0" . $where);

if($sql->getResult()) {
    foreach ($sql->getResult() as $item) {
        $data['data'][$e] = $item;
        $data['data'][$e]['data'] = date("d/m/Y", strtotime($item['data']));
        $data['data'][$e]['tipo'] = "Credenciado Físico";
        unset($data['data'][$e]['credenciado_juridico'], $data['data'][$e]['login']);
        $e++;
    }
}

if(empty($data['data']))
    $data['error'] = "Nenhuma Especialidade Encontrada";