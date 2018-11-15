<?php
$sql = new \ConnCrud\SqlCommand();
$read = new \ConnCrud\Read();
$read->exeRead("cliente_p_juridica", "ORDER BY id DESC");
if ($read->getResult()) {
    foreach ($read->getResult() as $i => $juridico) {
        $sql->exeCommand("SELECT * FROM " . PRE . "clientes as c INNER JOIN " . PRE . "cliente_p_juridica_clientes_conveniados as cj ON "
            . "c.id = cj.clientes_id WHERE c.status_do_convenio = 1 AND cj.cliente_p_juridica_id = " . $juridico['id']);
        if ($sql->getResult()) {

            $data['data']['content'][$i] = [
                "template" => TPL_SECTION_MEDIUM,
                "content" => [
                    "template" => TPL_COL_1,
                    "class" => "card padding-large",
                    "content" => [
                        [
                            "template" => TPL_COL_1,
                            "class" => "upper color-text-grey font-large color-grey-light radius padding-large",
                            "content" => $juridico['razao_social']
                        ]
                    ]
                ]
            ];
            foreach ($sql->getResult() as $cliente) {
                $data['data']['content'][$i]['content']['content'][] = [
                    "template" => TPL_UL,
                    "content" => $cliente['cpf']
                ];
            }
        }
    }
}