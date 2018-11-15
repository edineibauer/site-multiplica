<?php

$form = new \FormCrud\Form("pedidos");
//$form->setFields(["cpf", "acesso", "nome", "email"]);
//$form->setCallback("novoClienteCallback");
$form->setAutoSave();

$data['data']['content'] = "<div class='col padding-large padding-32'><div class='col card padding-medium'>" . $form->getForm() . "</div></div>";