<?php
$data = ['response' => 2, "error" => "", "data" => ""];

$dados['empresa'] = filter_input(INPUT_POST, 'empresa', FILTER_VALIDATE_INT);
$dados['id_credenciado'] = filter_input(INPUT_POST, 'id_credenciado', FILTER_VALIDATE_INT);
$dados['nome'] = trim(strip_tags(filter_input(INPUT_POST, 'nome', FILTER_DEFAULT)));
$dados['sexo'] = trim(strip_tags(filter_input(INPUT_POST, 'sexo', FILTER_DEFAULT)));
$dados['data_de_nascimento'] = trim(strip_tags(filter_input(INPUT_POST, 'data_de_nascimento', FILTER_DEFAULT)));
$dados['telefone'] = trim(strip_tags(filter_input(INPUT_POST, 'telefone', FILTER_DEFAULT)));
$dados['email'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

$dados['sexo'] = !empty($dados['sexo']) && $dados['sexo'] === "Masculino" ? 1 : (!empty($dados['sexo']) && $dados['sexo'] === "Feminino" ? 2 : 3);
$dados['email'] = !empty($dados['email']) && \Helpers\Check::email($dados['email']) ? $dados['email'] : "";

$apiFuncionario = new \SiteMultiplica\ApiFuncionario();
$apiFuncionario->create($dados);
$data = $apiFuncionario->getResult();