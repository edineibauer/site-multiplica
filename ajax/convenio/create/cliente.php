<?php

$form = new \FormCrud\Form("clientes");
$form->setFields(["cpf", "acesso", "nome_de_usuario", "email"]);
//$form->setCallback("novoClienteCallback");
$form->setAutoSave();

$data['data']['content'] = "<div class='col padding-large padding-32'><div class='col card padding-medium'>" . $form->getForm() . "</div></div>";