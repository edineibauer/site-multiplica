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
    if (preg_match('/^EMPRESA;FUNCIONARIO/i', $file)) {
        $dados = [];

        foreach (explode(';', $file) as $i => $info) {
            if ($i > 5) {
                $c = count($dados);
                $info = mb_strtolower(trim(strip_tags(str_replace(["'", "*", '\\', '/'], ['', '', '-', '-'], $info))));
                if ($c === 0 || $c === 1 || $c === 2)
                    $info = (int) $info;
                elseif ($c === 3)
                    $info = (float) str_replace(',', '.', $info);
                elseif ($c === 4)
                    $info = (!empty($info) ? implode('-', array_reverse(explode("/", $info))) : null);
                elseif ($c === 5)
                    $info = !empty($info) ? str_replace(",", ":", $info) : null;

                if ($c === 4 && !empty($info) && !preg_match("/\d{4}-\d{2}-\d{2}/i", $info))
                    $info = null;

                $dados[] = $info;


                if ($c === 5) {
                    $resultClient = json_decode(\Helpers\Helper::postRequest(HOME . "api/cashback/create/venda",
                        [
                            "credenciado" => $dados[0],
                            "funcionario" => $dados[1],
                            "cliente" => $dados[2],
                            "valor" => $dados[3],
                            "data" => (!empty($dados[4]) ? $dados[4] . " " . $dados[5] . ":00" : null)
                        ]
                    ), true);

                    if($resultClient['response'] !== 1) {
                        $data = $resultClient;
                        break;
                    }

                    $dados = [];
                }
            }
        }

    } else {
        $data['error'] = "Formato do arquivo não corresponde ao esperado";
    }
}