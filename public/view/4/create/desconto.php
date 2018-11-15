<?php
$form = new \FormCrud\Form("desconto_multiplica");
$form->setCallback('updateHistoricoDesconto');

$dados['form'] = $form->getForm();

$tpl = new \Helpers\Template(DOMINIO);
$data['data'] = $tpl->getShow("descontos_multiplica_dashboard", $dados);