<?php
$data = ['response' => 2, "error" => "", "data" => ""];

$token = trim(strip_tags(filter_input(INPUT_POST, 'token', FILTER_DEFAULT)));

$sql = new \ConnCrud\SqlCommand();
$read = new \ConnCrud\Read();
$read->exeRead(PRE . "usuarios", "WHERE token = :to", "to={$token}");
if ($read->getResult() && $read->getResult()[0]['status'] === '1') {

    $read->exeRead("clientes", "WHERE login = :ac", "ac={$read->getResult()[0]['id']}");
    if ($read->getErro()) {
        $data['error'] = trim(strip_tags($read->getErro()));
    } elseif ($read->getResult() && !empty($read->getResult()[0]['plano'])) {
        $plano = (int) $read->getResult()[0]['plano'];

        $sql = new \ConnCrud\SqlCommand();
        $sql->exeCommand("SELECT d.* FROM " . PRE . "dependente as d JOIN " . PRE . "planos_dependentes as pd ON pd.dependente_id = d.id WHERE pd.planos_id = {$plano}");

        if ($read->getErro()) {
            $data['error'] = trim(strip_tags($read->getErro()));
        } elseif($sql->getResult()) {

            $dependente = new \EntityForm\Dicionario("dependente");
            $dependenteData = $dependente->search("grau_de_parentesco")->getAllow();
            $dep = [];
            foreach($dependenteData['values'] as $i => $v)
                $dep[$v] = $dependenteData['names'][$i];

            $list = [];
            foreach($sql->getResult() as $item) {
                $item['data_de_nascimento'] = date("d/m/Y", strtotime($item['data_de_nascimento']));
                $item['data_de_abertura'] = date("d/m/Y H:i:s", strtotime($item['data_de_abertura']));
                $item['grau_de_parentesco'] = $dep[$item['grau_de_parentesco']];

                $list[] = $item;
            }
            $data['data'] = $list;

            $data['response'] = 1;
        } else {
            $data['error'] = "Sem Dependentes Vinculado.";
        }

    } else {
        $data['error'] = "Sem Plano Vinculado.";
    }
} else {
    $data['error'] = $read->getResult() ? "Conta Desativada" : "Token Inválido";
}