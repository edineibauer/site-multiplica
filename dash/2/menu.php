<?php
?>
    <div class="col padding-medium no-select">
        <div class="col menu-li align-center hover-text-theme border padding-medium color-grey-light opacity radius pointer hover-opacity-off"
             style="margin-bottom: 5px"
             data-action="page" data-atributo="panel">
            <span class="font-large col">Dashboard</span>
        </div>
        <div class="col align-center border hover-text-theme padding-medium color-grey-light opacity radius pointer hover-opacity-off menu-li"
             style="margin-bottom: 5px" data-action="page" data-atributo="clientes">
            <i class="font-xxxlarge material-icons">face</i>
            <span class="font-large col">Clientes</span>
        </div>

        <div class="col align-center border hover-text-theme padding-medium color-grey-light opacity radius pointer hover-opacity-off menu-li"
             style="margin-bottom: 5px" data-action="page" data-atributo="credenciados">
            <i class="font-xxxlarge material-icons">store</i>
            <span class="font-large col">Credenciados</span>
        </div>
        <div class="col align-center border hover-text-theme padding-medium color-grey-light opacity radius pointer hover-opacity-off menu-li"
             style="margin-bottom: 5px"
             data-action="table" data-entity="planos">
            <i class="font-xxxlarge material-icons">list_alt</i>
            <span class="font-large col">Planos</span>
        </div>

        <div class="col align-center border hover-text-theme padding-medium color-grey-light opacity radius pointer hover-opacity-off menu-li"
             style="margin-bottom: 5px" data-action="page" data-atributo="fatura">
            <i class="font-xxxlarge material-icons">payment</i>
            <span class="font-large col">Faturas</span>
        </div>
        <div class="col align-center border hover-text-theme padding-medium color-grey-light opacity radius pointer hover-opacity-off menu-li"
             style="margin-bottom: 5px"
             data-action="table" data-entity="clientes">
            <span class="font-large col">Usuários</span>
        </div>
    </div>

    <script>
        function mainLoading() {
            $(".main").loading();
            hide_sidebar_small();
            closeSidebar();
        }

        function clienteFisico() {
            mainLoading();
            post('site-multiplica', '5/update/perfil', {}, function (data) {
                $("#dashboard").html(data)
            }, true);
        }
    </script>
<?php