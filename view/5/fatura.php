<?php
$read = new \ConnCrud\Read();
if ($_SESSION['convenio']['type'])
    $read->exeRead(PRE . "cliente_fatura_juridica", "WHERE cliente_pj = :pj", "pj={$_SESSION['convenio']['id']}");
else
    $read->exeRead(PRE . "cliente_fatura_fisica", "WHERE status != 1 && cliente_pf = :pj", "pf={$_SESSION['convenio']['id']}");

if ($read->getResult()) {
    $tpl = new \Helpers\Template("site-multiplica");
    $datt = new \Helpers\Date();
    $dados['faturas'] = $read->getResult();
    foreach ($read->getResult() as $i => $item) {
        $dados['faturas'][$i]['data'] = $datt->getDate($item['data'], 'd/m/Y');
        $dados['faturas'][$i]['descricao'] = Helpers\Check::words($dados['faturas'][$i]['descricao'], 50);
    }
}
$data['data'] = $tpl->getShow("5/faturas", $dados);;