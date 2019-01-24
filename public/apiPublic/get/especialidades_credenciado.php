<?php
$data = ['response' => 2, "error" => "", "data" => []];

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

$sql = new \ConnCrud\SqlCommand();
$read = new \ConnCrud\Read();

if (!empty($id)) {
    $read->exeRead("credenciado_juridico", "WHERE id = :id || documento = :id", "id={$id}");
    if (!$read->getResult())
        $read->exeRead("credenciado_fisico", "WHERE id = :id || documento = :id", "id={$id}");

    if ($read->getResult()) {
        $cred = $read->getResult()[0];
        if (!empty($cred['razao_social'])) {
            //juridico
            $sql->exeCommand("SELECT e.* FROM " . PRE . "especialidades as e JOIN " . PRE . "credenciado_juridico_especialidades as cje JOIN " . PRE . "credenciado_juridico as cj"
                . " ON e.id = cje.especialidades_id AND cje.credenciado_juridico_id = cj.id"
                . " WHERE cj.id = " . $id);

        } else {
            //fisico
            $sql->exeCommand("SELECT e.* FROM " . PRE . "especialidades as e JOIN " . PRE . "credenciado_fisico_especialidades as cfe JOIN " . PRE . "credenciado_fisico as cj"
                . " ON e.id = cfe.especialidades_id AND cfe.credenciado_fisico_id = cj.id"
                . " WHERE cj.id = " . $id);

        }
        if ($sql->getResult()) {
            $e = 0;
            foreach ($sql->getResult() as $item) {
                unset($item['credenciado_juridico']);
                $data['data'][$e] = $item;
                $data['data'][$e]['data'] = date("d/m/Y", strtotime($item['data']));
                $e++;
            }
        } else {
            $data['error'] = "Nenhuma Especialidade Encontrada";
        }
    } else {
        $data['error'] = "Credenciado não Encontrado";
    }
} else {
    $data['error'] = "Credenciado não Encontrado";
}