<?php
$data = ['response' => 2, "error" => "", "data" => ""];

$file = filter_input(INPUT_POST, 'file', FILTER_DEFAULT);

if (preg_match('/^http/i', $file)) {
    try {
        $file = file_get_contents($file);
    } catch (Exception $e) {
        $data['error'] = $e;
    }
}

if (empty($data['error'])) {
    if (preg_match('/^CODIGO;NOME;/i', $file)) {
        $dados = [];
        $sqlCommand = "";
//        $ref = json_decode(file_get_contents(PATH_HOME . "ajax/cashback/mapaCliente.json"), true);
//        $id = 1;

        foreach (explode(';', $file) as $i => $info) {
            if ($i > 5) {
                $c = count($dados);
                $info = mb_strtolower(trim(strip_tags(str_replace(["'", "*", '\\', '/'], ['', '', '-', '-'], $info))));
                if ($c === 1)
                    $info = "'" . ucwords($info) . "'";
                elseif ($c === 2)
                    $info = $info === "Masculino" ? 1 : ($info === "Feminino" ? 2 : 3);
                elseif ($c === 3)
                    $info = (!empty($info) ? "'" . implode('-', array_reverse(explode("/", $info))) . "'" : 'NULL');
                elseif ($c === 4)
                    $info = !empty($info) ? "'" . $info . "'" : "NULL";
                elseif ($c === 5)
                    $info = !empty($info) ? "'" . $info . "'" : "NULL";

                if ($c === 3 && !empty($info) && !preg_match("/\d{4}-\d{2}-\d{2}/i", $info))
                    $info = "NULL";

                $dados[] = $info;

                if ($c === 5) {
//                    $ref[$dados[0]] = $id;
//                    unset($dados[0]);
//                    $id++;
                    $sqlCommand .= (!empty($sqlCommand) ? ", " : "") . "(" . implode(", ", $dados) . ")";
                    $dados = [];
                }
            }
        }

//        echo $sqlCommand;

        $sql = new \ConnCrud\SqlCommand();
        $sql->exeCommand("INSERT INTO " . PRE . "clientes (id, nome_completo, sexo, data_de_nascimento, telefone, email) VALUES {$sqlCommand};");
        if ($sql->getErro()) {
            $data['error'] = trim(strip_tags($sql->getErro()));
        } else {
            $data = [
                "response" => 1,
                "data" => "Importado com Sucesso",
                "error" => ""
            ];
        }

//        $f = fopen(PATH_HOME . "ajax/cashback/mapaCliente.json", "w+");
//        fwrite($f, json_encode($ref));
//        fclose($f);

    } else {
        $data['error'] = "Formato do arquivo não corresponde ao esperado";
    }
}