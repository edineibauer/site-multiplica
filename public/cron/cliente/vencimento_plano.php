<?php

// Todos os dias
if($hora === '00') {

    //Tempo de contrato em mêses (id => mês)
    $contrato = [
        1 => 1,
        2 => 3,
        3 => 6,
        4 => 12,
        5 => 24,
        6 => 36,
        7 => 60
    ];

    $read = new \ConnCrud\Read();
    $read->exeRead("tipos_de_planos", "ORDER BY id DESC");
    if($read->getResult()) {
        $tiposPlanos = $read->getResult();

        //Para cada tipo de plano
        foreach ($tiposPlanos as $tipo) {
            $mesesContrato = $contrato[$tipo['contrato_de']];

            //Planos de Clientes
            $read->exeRead("planos", "WHERE plano = :pp && status = 1", "pp={$tipo['id']}");
            if($read->getResult()) {
                $planos = $read->getResult();

                //para cada plano
                foreach ($planos as $plano) {
                    $vencimento = date('Y-m-d', strtotime("+{$mesesContrato} month", strtotime($plano['data_de_inicio'])));

                    if($vencimento > $hoje) {
                        //Plano vencido, desativa plano

                        $d = new \EntityForm\Dicionario("planos");
                        $d->setData(["id" => $plano['id'], "status" => 0]);
                        $d->save();

                    }
                }
            }

            //Planos de Juridicos
            $read->exeRead("clientes_juridicos", "WHERE plano = :cpp && status = 1", "cpp={$tipo['id']}");
            if($read->getResult()) {
                $jud = $read->getResult();

                $vencimento = date('Y-m-d', strtotime("+{$mesesContrato} month", strtotime($jud['data_de_inicio'])));

                if($vencimento > $hoje) {
                    //Plano vencido, desativa plano de Jurídico

                    $d = new \EntityForm\Dicionario("clientes_juridicos");
                    $d->setData(["id" => $jud['id'], "status" => 0]);
                    $d->save();

                }
            }
        }
    }
}