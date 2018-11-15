<?php
$dados = [];
$read = new \ConnCrud\Read();
$read->exeRead(PRE . "convenios", "ORDER BY ID DESC LIMIT 100");
if ($read->getResult()) {
    $convenio = $read->getResult();
    $i=0;
    $temp = [];
    foreach ($convenio as $item) {
        $dados[$i]['cashback'] = $item['cashback'];
        $read->exeRead(PRE . "usuarios", "WHERE id = :id && imagem != ''", "id={$item['usuario']}");
        $dados[$i]['imagem'] = $read->getResult() ? \Helpers\Helper::convertImageJson($read->getResult()[0]['imagem']) : "";

        if ($i % 4 === 0) {
            $temp[] = [
                "template" => TPL_POST_CARD,
                "src" => $read->getResult() ? \Helpers\Helper::convertImageJson($read->getResult()[0]['imagem']) : "",
                "width" => 200,
                "title" => $item['nome_completo_razao_social']
            ];
        } else {
            $data['data']['content'][$i] = [
                "template" => TPL_COL_4,
                "content" => $temp
                ];
            $temp = [];
            $i++;
        }
    }
}

$data['data']['content'] = $dados;