<?php
if($_SESSION['userlogin']['setor'] === '5') {

    $listIdFisico = [];
    $read = new \ConnCrud\Read();
    $read->exeRead(PRE . "conveniado_juridico_conveniado_fisico_conveniados_fisicos", "WHERE conveniado_juridico_id =:id", "id={$_SESSION['userlogin']['id']}");
    if($read->getResult()) {
        foreach ($read->getResult() as $item) {
            $listIdFisico[] = $item['conveniado_fisico_id'];
        }
    }

    $table = new \Table\Table("conveniado_fisico");
    $table->setListaId($listIdFisico);
    $table = $table->getShow();

    //$form = new \FormCrud\Form();
    //$form->setCallback("novoClienteCallback");
    //$form->setAutoSave();

    $data['data']['content'] = "<div class='col padding-large padding-32'><div class='col card padding-medium'>" . $table . "</div></div>";

}