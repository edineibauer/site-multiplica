<?php
$read = new \ConnCrud\Read();
if ($_SESSION['userlogin']['cliente'] === "PJ")
    $read->exeRead(PRE . "cliente_fatura_juridica", "WHERE cliente_pj = :pj", "pj={$_SESSION['userlogin']['clienteId']}");
else
    $read->exeRead(PRE . "cliente_fatura_fisica", "WHERE status != 1 && cliente_pf = :pj", "pf={$_SESSION['userlogin']['clienteId']}");

$data['data'] = "<div class='col padding-medium padding-24'><h3 class='col padding-0'>FATURAS</h3><div class='col padding-8'>";
if ($read->getResult()) {
    $tpl = new \Helpers\Template("site-multiplica");
    $datt = new \Helpers\Date();
    foreach ($read->getResult() as $i => $item) {
        $item['back'] = $i/2 === 0 ? "#E9E9E9" : "#F5F5F5";
        $item['data'] = $datt->getDate($item['data'], 'd/m/Y');
        $data['data'] .= $tpl->getShow("fatura_cliente", $item);
    }
}
$data['data'] .= '</div></div>';