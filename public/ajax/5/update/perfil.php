<?php

if (!empty($_SESSION['userlogin']['cliente'])) {
    $form = new \FormCrud\Form("cliente_p_" . ($_SESSION['userlogin']['cliente'] === "PJ" ? "juridica" : "fisica"));
    $form->setFields(["dia_da_fatura"]);

    $data['data']['content'] = "<div class='col padding-large padding-32'><div class='col card padding-medium'>"
        . "<h3 class='padding-medium color-text-grey'>Minhas Preferências</h3>"
        . $form->getForm($_SESSION['userlogin']['clienteId']) . "</div></div>";
} else{
    $data['data']['content'] = "";
}