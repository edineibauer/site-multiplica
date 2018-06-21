<?php
$form = new \FormCrud\Form("pontuar_multiplica");
$form->setCallback('updateHistorico');
$data['data']['content'] = "<div class='col padding-large s-padding-tiny s-padding-24 padding-32'>"
    . "<div class='col card padding-medium'>"
    . $form->getForm()
    . "</div>"
    . "<div class='col border radius'>"
    . "<h4 class='color-text-grey padding-medium theme-l3 upper'>Histórico de Pontuação</h4>"
    . "<div class='col padding-medium' id='credenciado-historico'><ul></ul></div>"
    . "<div class='col hide' id='credenciado-historico-ref'></div>"
    . "</div>"
    . "</div>";