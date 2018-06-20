<?php
$read = new \ConnCrud\Read();
$read->exeRead(PRE . "credenciado_juridico", "WHERE usuario = :ui", "ui={$_SESSION['userlogin']['id']}");
if(!$read->getResult())
    $read->exeRead(PRE . "credenciado_fisico", "WHERE usuario = :ui", "ui={$_SESSION['userlogin']['id']}");
if(!$read->getResult())
    $read->exeRead(PRE . "funcionario_credenciado", "WHERE usuario = :ui", "ui={$_SESSION['userlogin']['id']}");

if($read->getResult()) {
    $cred = $read->getResult()[0];
    ?>
    <div class="col padding-medium">
        <div class="col menu-li align-center border padding-medium margin-bottom color-grey-light opacity radius pointer hover-opacity-off"
             data-action="page" data-atributo="dash/geral">
            <i class="font-xxxlarge material-icons">timeline</i>
            <span class="font-large col">Dashboard</span>
        </div>
        <div class="col align-center border padding-medium margin-bottom color-grey-light opacity radius pointer hover-opacity-off"
             onclick="createTransacao()">
            <i class="font-xxxlarge material-icons">add_box</i>
            <span class="font-large col">Pontuar Multiplica</span>
        </div>
        <div class="col align-center border padding-medium margin-bottom color-grey-light opacity radius pointer hover-opacity-off"
             onclick="createCliente()">
            <i class="font-xxxlarge material-icons">people</i>
            <span class="font-large col">Novo Conveniado</span>
        </div>
        <?php
        if ($_SESSION['userlogin']['nivel'] === "1") {
            ?>
            <div class="col menu-li align-center border padding-medium margin-bottom color-grey-light opacity radius pointer hover-opacity-off"
                 data-entity='funcionario_credenciado' data-action="table">
                <i class="font-xxxlarge material-icons">people_outline</i>
                <span class="font-large col">Funcionários</span>
            </div>
            <?php
        }
        if (isset($cred['desconto_em_servicos']) && $cred['desconto_em_servicos']) {
            ?>
            <div class="col menu-li align-center border padding-medium margin-bottom color-grey-light opacity radius pointer hover-opacity-off"
                 data-entity='descontos' data-action="table">
                <i class="font-xxxlarge material-icons">book</i>
                <span class="font-large col">Tabela de Descontos</span>
            </div>
            <?php
        }
        ?>
        <!--<div class="col align-center border padding-medium margin-bottom color-grey-light opacity radius pointer hover-opacity-off" onclick="createPedido()"
             data-atributo='produtos' data-lib="">
            <i class="font-xxxlarge material-icons">shopping_cart</i>
            <span class="font-large col">Realizar Pedido</span>
        </div>-->
    </div>

    <script>

        function mainLoading() {
            $(".main").loading();
            hide_sidebar_small();
            closeSidebar();
        }

        function createCliente() {
            mainLoading();
            get('convenio/create/cliente', function (data) {
                $("#dashboard").html(data.content)
            })
        }

        function createTransacao() {
            mainLoading();
            get('credenciado/create/transacao', function (data) {
                console.log(data);
                $("#dashboard").html(data.content)
            }, true)
        }

        /*function createPedido() {
            mainLoading();
            get('convenio/create/pedido', function (data) {
                $("#dashboard").html(data.content)
            })
        }*/

        function novoClienteCallback(dados) {
            toast("Cliente Salvo!");
            createCliente();
        }
    </script>
    <?php
}
?>