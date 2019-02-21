    <div class="col padding-medium no-select">
        <div class="col menu-li align-center hover-text-theme border padding-medium color-grey-light opacity radius pointer hover-opacity-off"
             style="margin-bottom: 5px"
             data-action="page" data-atributo="dashboardPages/panel">
            <span class="font-large col">Dashboard</span>
        </div>
        <div class="col align-center border hover-text-theme padding-medium color-grey-light opacity radius pointer hover-opacity-off menu-li"
             style="margin-bottom: 5px" data-action="page" data-atributo="clientes">
            <i class="font-xxxlarge material-icons">face</i>
            <span class="font-large col">Clientes</span>
        </div>

        <div class="col align-center border hover-text-theme padding-medium color-grey-light opacity radius pointer hover-opacity-off menu-li"
             style="margin-bottom: 5px" data-action="page" data-atributo="credenciados">
            <i class="font-xxxlarge material-icons">contact_mail</i>
            <span class="font-large col">Parceiros</span>
        </div>
        <div class="col align-center border hover-text-theme padding-medium color-grey-light opacity radius pointer hover-opacity-off menu-li"
             style="margin-bottom: 5px" data-action="table" data-entity="revenda">
            <i class="font-xxxlarge material-icons">store</i>
            <span class="font-large col">Revendas</span>
        </div>
        <div class="col align-center border hover-text-theme padding-medium color-grey-light opacity radius pointer hover-opacity-off menu-li"
             style="margin-bottom: 5px" data-action="table" data-entity="consultor">
            <i class="font-xxxlarge material-icons">work</i>
            <span class="font-large col">Consultores</span>
        </div>
        <!--<div class="col align-center border hover-text-theme padding-medium color-grey-light opacity radius pointer hover-opacity-off menu-li"
             style="margin-bottom: 5px" data-action="page" data-atributo="fatura">
            <span class="font-large col">Faturas</span>
        </div>-->
        <div class="col align-center border hover-text-theme padding-medium color-grey-light opacity radius pointer hover-opacity-off menu-li"
             style="margin-bottom: 5px"
             data-action="table" data-entity="tipos_de_planos">
            <span class="font-large col">Planos</span>
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