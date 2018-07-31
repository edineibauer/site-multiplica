<div class="col padding-medium">
    <div class="col menu-li align-center hover-text-theme border padding-medium color-grey-light opacity radius pointer hover-opacity-off"
         style="margin-bottom: 5px"
         data-action="page" data-atributo="panel">
        <i class="font-xxxlarge material-icons">timeline</i>
        <span class="font-large col">Dashboard</span>
    </div>
    <?php
    if (!empty($_SESSION['convenio']['cashback'])) {
        ?>
        <div class="col align-center border hover-text-theme padding-medium color-grey-light opacity radius pointer hover-opacity-off"
             style="margin-bottom: 5px"
             onclick="createTransacao()">
            <img src="<?=HOME . FAVICON ?>" width="47" height="47" style="height: 47px; width: 47px" alt="pontuar imagem">
            <span class="font-large col">Pontuar CashBack</span>
        </div>
        <?php
    }
    ?>
    <div class="col align-center border hover-text-theme padding-medium color-grey-light opacity radius pointer hover-opacity-off"
         style="margin-bottom: 5px"
         onclick="descontoServicos()">
        <i class="font-xxxlarge material-icons">money_off</i>
        <span class="font-large col">Descontos Multiplica</span>
    </div>
    <?php
    if ($_SESSION['userlogin']['setor'] === "4") {
        ?>
        <div class="col menu-li align-center hover-text-theme border padding-medium color-grey-light opacity radius pointer hover-opacity-off"
             style="margin-bottom: 5px"
             data-atributo='funcionarios' data-action="page" id="functionarios_list">
            <i class="font-xxxlarge material-icons">work</i>
            <span class="font-large col">Funcionários</span>
        </div>
        <?php
    }
    if (!empty($_SESSION['convenio']['cashback'])) {
        ?>
        <div class="col align-center border hover-text-theme padding-medium color-grey-light opacity radius pointer hover-opacity-off"
             style="margin-bottom: 5px"
             onclick="createCliente()">
            <i class="font-xxxlarge material-icons">group_add</i>
            <span class="font-large col">Adicionar Cliente</span>
        </div>
        <?php
    }
    ?>
</div>
<script src="<?=HOME . DEV_PATH?>dash/4/assets/mask.js"></script>
<script src="<?=HOME . DEV_PATH?>dash/4/assets/base.js"></script>