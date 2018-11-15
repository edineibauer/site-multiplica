<?php
$cpf = $route->getVar();
$read = new \ConnCrud\Read();
$tpl = new \Helpers\Template("site-multiplica");

$read->exeRead("clientes", "WHERE cpf = :cp", "cp={$cpf}");
if ($read->getResult()) {
    $data['data'] = $tpl->getShow("funcionario_existe", $read->getResult()[0]);
} else {
    $form = new \FormCrud\Form("clientes");
    $form->setDefaults(['cpf' => $cpf, "status_do_convenio" => 0]);
    $form->setFields(["cpf", "nome_completo", "sexo", "data_de_nascimento", "acesso"]);
    $form->setCallback("addFuncionarioCriado");
    $data['data'] = $tpl->getShow("novo_funcionario_form", ["form" => $form->getForm()]);
}
