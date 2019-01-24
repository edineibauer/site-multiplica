<?php
$data = ['response' => 2, "error" => "", "data" => []];

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
$read = new \ConnCrud\Read();

if (empty($id) || !is_numeric($id) || $id < 1) {
    //busca lista de categorias
    $dic = new \Entity\Dicionario("especialidades");
    $allow = $dic->search("categoria")->getAllow();

    $data['data'] = [];
    foreach ($allow['values'] as $i => $value)
        $data['data'][] = ["id" => $value, "categoria" => $allow['names'][$i]];

} else {
    $read->exeRead("especialidades", "WHERE categoria = :cat", "cat={$id}");
    $dados = [];
    if ($read->getResult()) {
        $dados = $read->getResult();
        $sql = new \ConnCrud\SqlCommand();

        foreach ($dados as $i => $dado) {
            if ($dado['credenciado_juridico'] == 1) {
                //credenciado_juridico_especialidades
                $sql->exeCommand("SELECT c.* FROM " . PRE . "credenciado_juridico as c JOIN " . PRE . "credenciado_juridico_especialidades as ce "
                . "ON ce.credenciado_juridico_id = c.id WHERE ce.especialidades_id = {$dado['id']}");
                if($sql->getResult())
                    $dados[$i]['credenciado'] = $sql->getResult()[0];

                $dados[$i]['tipo_de_credenciado'] = 'jurídico';
            } else {
                $sql->exeCommand("SELECT c.* FROM " . PRE . "credenciado_fisico as c JOIN " . PRE . "credenciado_fisico_especialidades as ce "
                    . "ON ce.credenciado_fisico_id = c.id WHERE ce.especialidades_id = {$dado['id']}");
                if($sql->getResult())
                    $dados[$i]['credenciado'] = $sql->getResult()[0];

                $dados[$i]['tipo_de_credenciado'] = 'físico';
            }

            unset($dados[$i]['credenciado_juridico']);
        }
    }

    $data['data'] = $dados;
}

if (empty($data['data']))
    $data['error'] = "Nenhuma Especialidade Encontrada";