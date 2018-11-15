<?php
if($_SESSION['userlogin']['setor'] === '5') {

    $listIdFisico = [];
    $read = new \ConnCrud\Read();
    $read->exeRead(PRE . "cliente_p_juridica_conveniados_fisicos", "WHERE cliente_p_juridica_id =:id", "id={$_SESSION['userlogin']['id']}");
    if($read->getResult()) {
        foreach ($read->getResult() as $item) {
            $listIdFisico[] = $item['cliente_p_fisica_id'];
        }
    }

    $table = new \Table\Table("cliente_p_fisica");
    $table->setListaId($listIdFisico);
    $table = $table->getShow();

    //$form = new \FormCrud\Form();
    //$form->setCallback("novoClienteCallback");
    //$form->setAutoSave();

    $data['data']['content'] = "<div class='col padding-large padding-32'><div class='col card padding-medium'>" . $table . "</div></div>";

}