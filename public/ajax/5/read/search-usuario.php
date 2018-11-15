<?php

$cpf = filter_input(INPUT_POST, 'cpf', FILTER_DEFAULT);
$allow = !(date('d') > 4) && !empty($_SESSION['convenio']) && $_SESSION['convenio']['status'] == 1;

if($allow) {
    $read = new \ConnCrud\Read();
    $tpl = new \Helpers\Template("site-multiplica");

    $read->exeRead("clientes", "WHERE cpf = :cp", "cp={$cpf}");
    if ($read->getResult()) {
        $cliente = $read->getResult()[0];

        /* Busca Associação com Empresa */
        $dicJuridico = new \EntityForm\Dicionario('clientes_juridicos');
        $columnName = $dicJuridico->getRelevant()->getColumn();
        $columnEmail = !empty($dicJuridico->getInfo()['email']) ? $dicJuridico->search($dicJuridico->getInfo()['email'])->getColumn() : "";
        $columnTel = !empty($dicJuridico->getInfo()['tel']) ? $dicJuridico->search($dicJuridico->getInfo()['tel'])->getColumn() : "";
        $read->exeRead("clientes_juridicos_clientes", "WHERE clientes_id = :idc", "idc={$cliente['id']}");
        if($read->getResult()){
            $read->exeRead("clientes_juridicos", "WHERE id = :ji", "ji={$read->getResult()[0]['clientes_juridicos_id']}");
            if($read->getResult()) {
                $cliente['clientes_juridicos'] = [
                    'id' => $read->getResult()[0]['id'] == $_SESSION['convenio']['id'],
                    'nome' => $read->getResult()[0][$columnName],
                    'email' => !empty($columnEmail) ? $read->getResult()[0][$columnEmail] : "",
                    'tel' => !empty($columnTel) ? $read->getResult()[0][$columnTel] : ""
                ];
            } else {
                $cliente['clientes_juridicos'] = "";
            }
        }

        /* Busca Status do plano*/
        if(!empty($cliente['plano'])) {
            $read->exeRead("planos", "WHERE id = :pp", "pp={$cliente['plano']}");
            $cliente['plano'] = ($read->getResult() ? $read->getResult()[0] : null);
        }

        $data['data'] = $tpl->getShow("5/usuario_existe", $cliente);
    } else {
        $form = new \FormCrud\Form("clientes");
        $form->setFields(["nome_completo", "cpf", "sexo", "data_de_nascimento", "telefone", "email", "observacoes", "endereco"]);
        $form->setDefaults(['cpf' => $cpf, "status_do_convenio" => 1]);
        $form->setCallback("goUsuarios");
        $data['data'] = $tpl->getShow("5/novo_usuario_form", ["form" => $form->getForm()]);
    }
} else {
    $data['data'] = 2;
}
