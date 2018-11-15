<?php

/* Gera Número do Cartão */

//busca número de cartão para este cliente
$read = new \ConnCrud\Read();
$read->exeRead("planos", "WHERE numero_do_cartao IS NOT NULL ORDER BY numero_do_cartao DESC LIMIT 1");
$numero_cartao_final = ($read->getResult() ? (int)str_replace('363932111234', '', $read->getResult()[0]['numero_do_cartao']) : 0) + 1;

for($i = 0; $i < 20; $i++) {
    $numero_cartao = "363932111234" . str_pad(($numero_cartao_final + $i), 8, "0", STR_PAD_LEFT);
    $read->exeRead("planos", "WHERE numero_do_cartao = :nn", "nn={$numero_cartao}");
    if(!$read->getResult())
        $i = 20;
}

$up = new \ConnCrud\Update();
$up->exeUpdate("planos", ['numero_do_cartao' => $numero_cartao], "WHERE id = :idc", "idc={$dados['id']}");
