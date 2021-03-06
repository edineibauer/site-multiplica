<?php
if (empty($_SESSION['convenio']))
    include_once "inc/base.php";

if (!empty($_SESSION['convenio']) && $_SESSION['convenio']['status'] == 1) {

    $allow = !(date('d') > 4);
    $tempo = $_SESSION['convenio']['intervalo'];
    $tempo = ($tempo[0] > 0 ? $tempo[0] . " ano" . ($tempo[0] > 1 ? "s e " : " e ") . $tempo[1] . ($tempo[1] > 1 ? " meses" : " mês") : ($tempo[1] > 0 ? $tempo[1] . ($tempo[1] > 1 ? " meses e " : " mês e ") . $tempo[2] . " dias" : $tempo[2] . " dias"));
    ?>
    <div class="col padding-medium upper font-bold align-center pointer font-small menu-li" data-action="page"
         data-atributo="plano"
         style="background-color: <?= ($_SESSION['convenio']['plano']['titulo'] === "Prata" ? "#EEE" : "gold") ?>">
        <?= $_SESSION['convenio']['plano']['titulo'] ?>
    </div>
    <div class="col padding-medium">
        <div class="col menu-li align-center hover-text-theme border padding-medium color-grey-light opacity radius pointer hover-opacity-off"
             style="margin-bottom: 5px"
             data-action="page" data-atributo="panel">
            <i class="font-xxxlarge material-icons">timeline</i>
            <span class="font-large col">Dashboard</span>
        </div>

        <div class="col align-center border padding-medium color-grey-light opacity radius pointer hover-opacity-off menu-li"
             style="margin-bottom: 5px" data-action="page" data-atributo="clientes" id="usuarios_list">
            <i class="font-xxxlarge material-icons">people</i>
            <span class="font-large col">Conveniados</span>
        </div>

        <div class="col align-center border padding-medium color-grey-light opacity radius pointer hover-opacity-off menu-li"
             style="margin-bottom: 5px" data-action="page" data-atributo="fatura">
            <i class="font-xxxlarge material-icons">payment</i>
            <span class="font-large col">Faturas</span>
        </div>
    </div>
    <script src="<?=HOME?>public/assets/5/mask.js"></script>
    <script src="<?=HOME?>public/assets/5/base.js"></script>
    <?php
//    if($allow)
        echo '<script src="' . HOME . 'public/assets/5/clientes.js"></script>';
} else {
    $l = new \SessionControl\Login();
    $l->logOut();
}