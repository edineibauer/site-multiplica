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
    if (preg_match('/^EMPRESA;CODIGO;/i', $file)) {
        $dados = [];

        foreach (explode(';', $file) as $i => $info) {
            if ($i > 6) {
                $c = count($dados);
                $info = mb_strtolower(trim(strip_tags(str_replace(["'", "*", '\\', '/'], ['', '', '-', '-'], $info))));
                if ($c === 0 || $c === 1)
                    $info = (int) $info;
                elseif ($c === 2)
                    $info = ucwords($info);
                elseif ($c === 3)
                    $info = $info === "Masculino" ? 1 : ($info === "Feminino" ? 2 : 3);
                elseif ($c === 4)
                    $info = (!empty($info) ? implode('-', array_reverse(explode("/", $info))) : null);
                elseif ($c === 5)
                    $info = !empty($info) ? $info : null;
                elseif ($c === 6)
                    $info = !empty($info) ? $info : null;

                if ($c === 4 && !empty($info) && !preg_match("/\d{4}-\d{2}-\d{2}/i", $info))
                    $info = null;

                $dados[] = $info;

                if ($c === 6) {

                    $resultClient = json_decode(\Helpers\Helper::postRequest(HOME . "api/cashback/create/funcionario",
                        [
                            "empresa" => $dados[0],
                            "id_credenciado" => $dados[1],
                            "nome" => $dados[2],
                            "sexo" => $dados[3],
                            "data_de_nascimento" => $dados[4],
                            "telefone" => $dados[5],
                            "email" => $dados[6]
                        ]
                    ), true);

                    $dados = [];
                }
            }
        }

    } else {
        $data['error'] = "Formato do arquivo não corresponde ao esperado";
    }
}