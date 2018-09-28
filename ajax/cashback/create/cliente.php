<?php
$data = ['response' => 2, "error" => "", "data" => ""];


$dados['id'] = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$dados['nome_completo'] = trim(strip_tags(filter_input(INPUT_POST, 'nome_completo', FILTER_DEFAULT)));
$dados['sexo'] = trim(strip_tags(filter_input(INPUT_POST, 'sexo', FILTER_DEFAULT)));
$dados['data_de_nascimento'] = trim(strip_tags(filter_input(INPUT_POST, 'data_de_nascimento', FILTER_DEFAULT)));
$dados['telefone'] = trim(strip_tags(filter_input(INPUT_POST, 'telefone', FILTER_DEFAULT)));
$dados['email'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

$dados['sexo'] = !empty($dados['sexo']) && $dados['sexo'] === "Masculino" ? 1 : (!empty($dados['sexo']) && $dados['sexo'] === "Feminino" ? 2 : 3);
$dados['email'] = !empty($dados['email']) && \Helpers\Check::email($dados['email']) ? $dados['email'] : "";

$user = new \SiteMultiplica\ApiCliente();
$user->create($dados);
$data = $user->getResult();