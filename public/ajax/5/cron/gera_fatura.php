<?php

$dia = (int)date("d");
$valorMultiplica = 19;

$dia = ($dia === 5 ? 1 : ($dia === 10 ? 2 : 3));

$create = new \ConnCrud\Create();
$read = new \ConnCrud\Read();
$read->exeRead(PRE . "cliente_p_juridica", "WHERE status = 1 && dia_da_fatura = :fat", "fat={$dia}");
if ($read->getResult()) {
    foreach ($read->getResult() as $cc) {
        $fatura = 0;
        $desc = "";
        $read->exeRead(PRE . "cliente_p_juridica_clientes_funcionarios", "WHERE cliente_p_juridica_id = :pid", "pid={$cc['id']}");
        if ($read->getResult()) {
            foreach ($read->getResult() as $clientes) {
                $read->exeRead(PRE . "clientes", "WHERE id = :cid && status_do_convenio = 1", "cid={$clientes['clientes_id']}");
                if ($read->getResult()) {
                    $fatura++;
                    $desc .= (!empty($desc) ? ", " : "") . $read->getResult()[0]['nome_completo'];
                }

            }
        }

        if ($fatura > 0) {
            $valor = $fatura * $valorMultiplica;
            $diaHoje = date("Y-m-d");
            $read->exeRead(PRE . "cliente_fatura_juridica", "WHERE cliente_pj =:cpj && data = :data && valor = :valor", "cpj={$cc['id']}&data={$diaHoje}&valor={$valor}");
            if (!$read->getResult()) {
                $d = new \Entity\Dicionario("cliente_fatura_juridica");
                $d->setData(["cliente_pj" => $cc['id'], "data" => $diaHoje, "valor" => $valor, "descricao" => $desc]);
                $d->save();
            }
        }
    }
}

$read->exeRead(PRE . "cliente_p_fisica", "WHERE status = 1 && dia_da_fatura = :fat", "fat={$dia}");
if ($read->getResult()) {
    foreach ($read->getResult() as $cc) {
        $fatura = 0;
        $desc = "";
        $read->exeRead(PRE . "cliente_p_fisica_clientes_funcionarios", "WHERE cliente_p_fisica_id = :pid", "pid={$cc['id']}");
        if ($read->getResult()) {
            foreach ($read->getResult() as $clientes) {
                $read->exeRead(PRE . "clientes", "WHERE id = :cid && status_do_convenio = 1", "cid={$clientes['clientes_id']}");
                if ($read->getResult()) {
                    $fatura++;
                    $desc .= (!empty($desc) ? ", " : "") . $read->getResult()[0]['nome_completo'];
                }

            }
        }

        if ($fatura > 0) {
            $valor = $fatura * $valorMultiplica;
            $diaHoje = date("Y-m-d");
            $read->exeRead(PRE . "cliente_fatura_fisica", "WHERE cliente_pf =:cpf && data = :data && valor = :valor", "cpf={$cc['id']}&data={$diaHoje}&valor={$valor}");
            if (!$read->getResult()) {
                $d = new \Entity\Dicionario("cliente_fatura_fisica");
                $d->setData(["cliente_pf" => $cc['id'], "data" => $diaHoje, "valor" => $valor, "descricao" => $desc]);
                $d->save();
            }
        }
    }
}