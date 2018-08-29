<?php
$read = new \ConnCrud\Read();

$dados['convenio'] = $_SESSION['convenio'];
$dados['fatura'] = 0;
$dados['usuarios'] = [];

$read->exeRead("pessoas_juridicas_clientes_usuarios", "WHERE pessoas_juridicas_id = :cid", "cid={$_SESSION['convenio']['id']}");
$dados['total'] = 0;
$i = -1;
$date = new \Helpers\Date();
foreach ($read->getResult() as $cliente) {
    $read->exeRead("clientes", "WHERE id = :dd", "dd={$cliente['clientes_id']}");
    if ($read->getResult()) {
        $i++;
        $dados['usuarios'][$i] = $read->getResult()[0];
        $dados['usuarios'][$i]['data_de_nascimento'] = $date->getDate($dados['usuarios'][$i]['data_de_nascimento'], 'd-m-Y');
        $dados['usuarios'][$i]['cpf'] = \Helpers\Check::mask($dados['usuarios'][$i]['cpf'], '###.###.###-##');

        if(!empty($read->getResult()[0]['plano'])) {
            $read->exeRead("planos", "WHERE id = :pp", "pp={$read->getResult()[0]['plano']}");
            if($read->getResult()) {
                $dados['usuarios'][$i]['plano'] = $read->getResult()[0];

                if($dados['usuarios'][$i]['plano']['status'] === "1") {
                    $dados['fatura'] += $_SESSION['convenio']['plano']['valor_mensal'];
                    $dados['total']++;
                }
            }
        }
    }
}

$dados['allow'] = !(date('d') > 4);

$tpl = new \Helpers\Template("site-multiplica");
$data['data'] = $tpl->getShow("5/usuarios", $dados);
