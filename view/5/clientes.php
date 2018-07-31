<?php
$type = ($_SESSION['convenio']['type'] ? "juridica" : "fisica");
$read = new \ConnCrud\Read();

$dados['convenio'] = $_SESSION['convenio'];
$dados['fatura'] = 0;
$dados['usuarios'] = [];

$read->exeRead("cliente_p_{$type}_clientes_usuarios", "WHERE cliente_p_{$type}_id = :cid", "cid={$_SESSION['convenio']['id']}");
$dados['total'] = 0;
foreach ($read->getResult() as $cliente) {
    $read->exeRead("clientes", "WHERE id = :dd", "dd={$cliente['clientes_id']}");
    if ($read->getResult())
        $dados['usuarios'][] = $read->getResult()[0];

    if ($read->getResult()) {
        if ($read->getResult()[0]['status_do_convenio']) {
            $dados['fatura'] += $_SESSION['convenio']['plano']['valor_mensal'];
            $dados['total']++;
        }
    }
}

$dados['allow'] = !(date('d') < 4);

$tpl = new \Helpers\Template("site-multiplica");
$data['data'] = $tpl->getShow("5/usuarios", $dados);
