<?php
$cpf = $route->getVar();

$read = new \ConnCrud\Read();
$tpl = new \Helpers\Template("site-multiplica");

$read->exeRead("clientes", "WHERE cpf = :cp", "cp={$cpf}");
if($read->getResult()) {
    $data['data'] = $tpl->getShow("5/usuario_existe", $read->getResult()[0]);
} else {
    $form = new \FormCrud\Form("clientes");
    $form->setDefaults(['cpf' => $cpf, "status_do_convenio" => 1]);
    $form->setCallback("addUsuarioCriado");
    $data['data'] = $tpl->getShow("5/novo_usuario_form", ["form" => $form->getForm()]);
}
