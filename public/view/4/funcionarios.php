<?php
$type = ($_SESSION['convenio']['type'] ? "juridico" : "fisico");
$read = new \ConnCrud\Read();

$dados['convenio'] = $_SESSION['convenio'];
$dados['usuarios'] = [];

$read->exeRead("credenciado_{$type}_clientes_funcionarios", "WHERE credenciado_{$type}_id = :cid", "cid={$_SESSION['convenio']['id']}");
$dados['total'] = $read->getRowCount();
if($read->getResult()) {
    foreach ($read->getResult() as $cliente) {
        $read->exeRead("clientes", "WHERE id = :dd", "dd={$cliente['clientes_id']}");
        if ($read->getResult())
            $dados['usuarios'][] = $read->getResult()[0];
    }
}

$tpl = new \Helpers\Template("site-multiplica");
$data['data'] = $tpl->getShow("funcionarios", $dados);
