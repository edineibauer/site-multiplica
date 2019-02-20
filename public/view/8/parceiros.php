<?php

$read = new \ConnCrud\Read();
$sql = new \ConnCrud\SqlCommand();

$especialidades = new \Entity\Dicionario("especialidades");
$categorias = [];
$allow = $especialidades->search("column", "categoria")->getAllow();
foreach ($allow['values'] as $e => $value) {
    $categorias[$value] = $allow['names'][$e];
}

$read->exeRead("credenciado_fisico");
$parceiros = $read->getResult();
$read->exeRead("credenciado_juridico");
$parceiros = array_merge($parceiros, $read->getResult());

foreach ($parceiros as $i => $parceiro) {
    if(!empty($parceiro['razao_social'])) {
        $parceiros[$i]['tipo'] = 2;
        $sql->exeCommand("SELECT e.* FROM " . PRE . "credenciado_juridico as pf JOIN " . PRE . "credenciado_juridico_especialidades as ef JOIN " . PRE . "especialidades as e ON pf.id = ef.credenciado_juridico_id AND ef.especialidades_id = e.id WHERE pf.id = {$parceiro['id']}");
        if($sql->getResult())
            $parceiros[$i]['especialidades'] = $sql->getResult();

    } else {
        $parceiros[$i]['tipo'] = 1;
        $sql->exeCommand("SELECT e.* FROM " . PRE . "credenciado_fisico as pf JOIN " . PRE . "credenciado_fisico_especialidades as ef JOIN " . PRE . "especialidades as e ON pf.id = ef.credenciado_fisico_id AND ef.especialidades_id = e.id WHERE pf.id = {$parceiro['id']}");
        if($sql->getResult())
            $parceiros[$i]['especialidades'] = $sql->getResult();
    }
}

$tpl = new \Helpers\Template();
$tpl->show("parceiros_card", ["dados" => $parceiros, "categorias" => $categorias]);