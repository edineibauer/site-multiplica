<?php

$form = new \FormCrud\Form("clientes");
$form->setFields(["nome_completo", "cpf", "acesso", "nome_de_usuario", "email", "telefone"]);
$form->setAutoSave();

$data['data'] = "<div class='col padding-large padding-32'><div class='col card padding-medium'>"
    . "<h3 class='padding-medium color-text-grey'>Adicionar Novo Cliente Multiplica</h3>"
    . $form->getForm() . "</div></div>";