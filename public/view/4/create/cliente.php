<?php

$form = new \FormCrud\Form("clientes");
$form->setFields(["nome_completo", "cpf", "acesso", "nome", "email", "telefone"]);
$form->setAutoSave();

$data['data'] = "<div class='col padding-large padding-32'><div class='col card padding-medium'>"
    . $form->getForm() . "</div></div>";