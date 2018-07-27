<?php

$m = (int)date("m");
$mes = $m == 1 ? 12 : $m - 1;
$ano = $m == 1 ? date("Y") - 1 : date("Y");
$di = "{$ano}-{$mes}-1";
$de = "{$ano}-{$mes}-31";
$date = date("Y-m-d");

$sql = new \ConnCrud\SqlCommand();
$read = new \ConnCrud\Read();
$create = new \ConnCrud\Create();
$read->exeRead("credenciado_juridico");
if ($read->getResult()) {
    foreach ($read->getResult() as $juridico) {
        $desc = "{$juridico['razao_social']} - Fatura Gerada Referente ao Mês {$mes}/{$ano} por uso do sistema de CashBack.";
        $sql->exeCommand("SELECT SUM(valor) FROM " . PRE . "transacao WHERE credenciado = {$juridico['id']} && data >= '{$di}' && data <= '{$de}' && credenciado_juridico = 1 && status = 0");
        $total = (float)$sql->getResult()[0]['SUM(valor)'];

        if ($total > 0) {
            $read->exeRead("credenciado_fatura_juridica", "WHERE credenciado_juridico = {$juridico['id']} && valor = {$total} && data = {$date}");
            if (!$read->getResult())
                $create->exeCreate("credenciado_fatura_juridica", ["credenciado_juridico" => $juridico['id'], "valor" => $total, "data" => $date, "descricao" => $desc]);
        }
    }
}
$read->exeRead("credenciado_fisico");
if ($read->getResult()) {
    foreach ($read->getResult() as $fisico) {
        $desc = "{$fisico['nome_completo']} - Fatura Gerada Referente ao Mês {$mes}/{$ano} por uso do sistema de CashBack.";
        $sql->exeCommand("SELECT SUM(valor) FROM " . PRE . "transacao WHERE credenciado = {$fisico['id']} && data >= '{$di}' && data <= '{$de}' && credenciado_juridico = 0 && status = 0");
        $total = (float)$sql->getResult()[0]['SUM(valor)'];

        if ($total > 0) {
            $read->exeRead("credenciado_fatura_fisica", "WHERE credenciado_fisico = {$fisico['id']} && valor = {$total} && data = {$date}");
            if (!$read->getResult())
                $create->exeCreate("credenciado_fatura_fisica", ["credenciado_fisico" => $fisico['id'], "valor" => $total, "data" => $date, "descricao" => $desc]);
        }
    }
}