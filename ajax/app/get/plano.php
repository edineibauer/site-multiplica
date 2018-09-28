<?php
$data = ['response' => 2, "error" => "", "data" => ""];

$token = trim(strip_tags(!empty($var[0]) ? $var[0] : filter_input(INPUT_POST, 'token', FILTER_DEFAULT)));

$read = new \ConnCrud\Read();
$read->exeRead(PRE . "usuarios", "WHERE token = :to", "to={$token}");
if ($read->getResult() && $read->getResult()[0]['status'] === '1') {

    $sql = new \ConnCrud\SqlCommand();
    $sql->exeCommand("SELECT p.* FROM " . PRE . "planos as p JOIN " . PRE . "clientes as c ON p.id = c.plano WHERE c.login = {$read->getResult()[0]['id']}");
    if ($sql->getErro()) {
        $data['error'] = trim(strip_tags($sql->getErro()));
    } elseif ($sql->getResult()) {
        $plano = $sql->getResult()[0];
        $user = [
            "inicio" => $plano['data_de_inicio'],
            "anexos" => $plano['anexar_arquivos'],
            "status" => $plano['status'],
            "observacoes" => $plano['observacoes']
        ];
        $d = new \EntityForm\Dicionario("tipos_de_planos");

        $read->exeRead("tipos_de_planos", "WHERE id = :tpp", "tpp={$plano['plano']}");
        if ($read->getResult()) {
            $user['tipo'] = $read->getResult()[0]['titulo'];
            $user['valor'] = $read->getResult()[0]['valor_mensal'];
            $user['duracao'] = $d->search("contrato_de")->getAllow()['names'][(int)$read->getResult()[0]['contrato_de']];
        }

        $data['data'] = $user;
        $data['response'] = 1;
    } else {
        $data['error'] = "Sem Plano Vinculado.";
    }
} else {
    $data['error'] = $read->getResult() ? "Conta Desativada" : "Token Inválido";
}