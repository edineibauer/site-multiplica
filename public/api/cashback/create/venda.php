<?php
$data = ['response' => 2, "error" => "", "data" => ""];

$dados['credenciado'] = filter_input(INPUT_POST, 'credenciado', FILTER_VALIDATE_INT);
$dados['funcionario'] = filter_input(INPUT_POST, 'funcionario', FILTER_VALIDATE_INT);
$dados['cliente'] = filter_input(INPUT_POST, 'cliente', FILTER_VALIDATE_INT);
$dados['valor'] = (float) trim(strip_tags(filter_input(INPUT_POST, 'valor', FILTER_DEFAULT)));
$dados['data'] = trim(strip_tags(filter_input(INPUT_POST, 'data', FILTER_DEFAULT)));

$transacao = new \SiteMultiplica\ApiVenda();
$transacao->create($dados);
$data = $transacao->getResult();