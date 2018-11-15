<?php
$data = ['response' => 2, "error" => "", "data" => ""];

$token = trim(strip_tags(filter_input(INPUT_POST, 'token', FILTER_DEFAULT)));

$read = new \ConnCrud\Read();
$read->exeRead(PRE . "usuarios", "WHERE token = :to", "to={$token}");
if ($read->getResult() && $read->getResult()[0]['status'] === '1') {

    $sql = new \ConnCrud\SqlCommand();
    $sql->exeCommand("SELECT p.*, tp.*, c.nome_completo, c.cpf FROM " . PRE . "planos as p JOIN " . PRE . "clientes as c JOIN " . PRE . "tipos_de_planos as tp ON p.id = c.plano AND tp.id = p.plano WHERE c.login = {$read->getResult()[0]['id']}");
    if ($sql->getErro()) {
        $data['error'] = trim(strip_tags($sql->getErro()));
    } elseif ($sql->getResult()) {
        $plano = $sql->getResult()[0];

        $contrato = [
            1 => 1,
            2 => 3,
            3 => 6,
            4 => 12,
            5 => 24,
            6 => 36,
            7 => 60
        ];
        $mesesContrato = $contrato[$plano['contrato_de']];
        $validade = date('m/Y', strtotime("+{$mesesContrato} month", strtotime($plano['data_de_inicio'])));

        $user = [
            "nome" => $plano['nome_completo'],
            "cpf" => $plano['cpf'],
            "inicio" => date("m/Y", strtotime($plano['data_de_inicio'])),
            "validade" => $validade,
            "numero" => $plano['numero_do_cartao'],
            "anexos" => $plano['anexar_arquivos'],
            "status" => $plano['status'],
            "observacoes" => $plano['observacoes'],
            'valor' => $plano['valor_mensal'],
            'tipo' => $plano['titulo']
        ];

        $data['data'] = $user;
        $data['response'] = 1;
    } else {
        $data['error'] = "Sem Plano Vinculado.";
    }
} else {
    $data['error'] = $read->getResult() ? "Conta Desativada" : "Token Inválido";
}