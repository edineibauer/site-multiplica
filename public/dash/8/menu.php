<?php

$read = new \ConnCrud\Read();
$read->exeRead("consultor", "WHERE login = :id", "id={$_SESSION['userlogin']['id']}");
$read->exeRead("revenda", "WHERE id = :id", "id={$read->getResult()[0]['revenda']}");
define("REVENDA", $read->getResult()[0] ?? []);

?>

<style>
    .showifadm {display: none}
</style>

<script>
    const REVENDA = JSON.parse('<?= json_encode(REVENDA) ?>');
    $(function() {
        $('#dashboard').on('DOMNodeInserted', '.ontab', function () {
            let $form = $(this).find(".ontab-content").find(".form-crud");
            if($form.attr("data-entity") === "consultor") {
                $("#consultor-revenda").val(REVENDA.id).trigger("change");
            }
        });
    });
</script>

<div class="col padding-medium no-select">
    <!--<div class="col menu-li align-center hover-text-theme border padding-medium color-grey-light opacity radius pointer hover-opacity-off"
         style="margin-bottom: 5px"
         data-action="page" data-atributo="dashboardPages/panel">
        <span class="font-large col">Dashboard</span>
    </div>-->
    <div class="col align-center border hover-text-theme padding-medium color-grey-light opacity radius pointer hover-opacity-off menu-li"
         style="margin-bottom: 5px"
         data-action="table" data-entity="clientes">
        <i class="font-xxxlarge material-icons">perm_identity</i>
        <span class="col">Clientes Físico</span>
    </div>
    <div class="col align-center border hover-text-theme padding-medium color-grey-light opacity radius pointer hover-opacity-off menu-li"
         style="margin-bottom: 5px"
         data-action="table" data-entity="clientes_juridicos">
        <i class="font-xxxlarge material-icons">work_outline</i>
        <span class="col">Clientes Jurídico</span>
    </div>
    <div class="col align-center border hover-text-theme padding-medium color-grey-light opacity radius pointer hover-opacity-off menu-li"
         style="margin-bottom: 5px" data-action="table" data-entity="consultor">
        <span class="font-large col">Consultores</span>
    </div>

    <div class="col align-center border hover-text-theme padding-medium color-grey-light opacity radius pointer hover-opacity-off menu-li"
         style="margin-bottom: 5px"
         data-action="page" data-atributo="parceiros">
        <span class="col">Parceiro</span>
    </div>
</div>

<script>
    function mainLoading() {
        $(".main").loading();
        hide_sidebar_small();
        closeSidebar();
    }
</script>