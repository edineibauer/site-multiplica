<?php
ob_start();
require_once './_config/config.php';
require_once './vendor/autoload.php';

/** RESPONSES
 * 1 -> rota encontrada e corretamente executada
 * 2 -> rota encontrada e erro encontrado
 * 3 -> redirecionamento
 * 4 -> rota não encontrada
 * outro -> não faz nada
 * */

$file = filter_input(INPUT_POST, 'file', FILTER_DEFAULT);
$lib = filter_input(INPUT_POST, 'lib', FILTER_DEFAULT);
$data = ["response" => 1, "error" => "", "data" => ""];
$url = strip_tags(trim($_GET['data']));
$include = PATH_HOME . "ajax/" . $url . ".php";

if (isset($include)) {
    new \LinkControl\Sessao();
    if (\Helpers\Check::ajax()) {
        include_once $include;

        if (!isset($data) || !isset($data['response']) || !in_array($data['response'], [1, 2, 3, 4]))
            $data = ["response" => 2, "error" => "data retornada não formatada corretamente", "data" => ""];
        elseif ($data['response'] === 3 && (!is_string($data['data']) || !preg_match("/^" . HOME . "/i", $data['data'])))
            $data = ["response" => 2, "error" => "url de redirecionamento não encontrada, precisa começar com " . HOME, "data" => ""];

    } else {
        $data = ["response" => 2, "error" => "request nao permitido", "data" => ""];
    }
} else {
    $data["response"] = 4;
}

echo json_encode($data);

ob_get_flush();