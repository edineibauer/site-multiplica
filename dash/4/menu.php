<?php
if (!isset($_SESSION['convenio'])) {
    $type = 1;
    $read = new \ConnCrud\Read();
    $read->exeRead(PRE . "credenciado_juridico", "WHERE usuario = :ui", "ui={$_SESSION['userlogin']['id']}");
    if (!$read->getResult())
        $read->exeRead(PRE . "credenciado_fisico", "WHERE usuario = :ui", "ui={$_SESSION['userlogin']['id']}");
    if (!$read->getResult()) {
        $type = 0;
        $read->exeRead(PRE . "funcionario_credenciado", "WHERE usuario = :ui", "ui={$_SESSION['userlogin']['id']}");
        if ($read->getResult()) {
            $ii = $read->getResult()[0]['id'];
            $read->exeRead(PRE . "credenciado_juridico_funcionario_credenciado_funcionarios", "WHERE funcionario_credenciado_id = :ii", "ii={$ii}");
            if ($read->getResult()) {
                $read->exeRead(PRE . "credenciado_juridico", "WHERE id = :u", "u={$read->getResult()[0]['credenciado_juridico_id']}");
            } else {
                $read->exeRead(PRE . "credenciado_fisico_funcionario_credenciado_funcionarios", "WHERE funcionario_credenciado_id = :ii", "ii={$ii}");
                if ($read->getResult())
                    $read->exeRead(PRE . "credenciado_fisico", "WHERE id = :u", "u={$read->getResult()[0]['credenciado_fisico_id']}");
            }
        }
    }
    if ($read->getResult()) {
        $_SESSION['convenio'] = $read->getResult()[0];
        $_SESSION['convenio']['type'] = $type;
    }
}
if (isset($_SESSION['convenio'])) {
    ?>
    <div class="col padding-medium">
        <?php
        if (!empty($_SESSION['convenio']['type'] === 1)) {
            ?>
            <div class="col menu-li align-center hover-text-theme border padding-medium color-grey-light opacity radius pointer hover-opacity-off"
                 style="margin-bottom: 5px"
                 data-action="page" data-atributo="panel">
                <i class="font-xxxlarge material-icons">timeline</i>
                <span class="font-large col">Dashboard</span>
            </div>
            <?php
        }
        if (!empty($_SESSION['convenio']['cashback'])) {
            ?>
            <div class="col align-center border hover-text-theme padding-medium color-grey-light opacity radius pointer hover-opacity-off"
                 style="margin-bottom: 5px"
                 onclick="createTransacao()">
                <i class="font-xxxlarge material-icons">add_box</i>
                <span class="font-large col">Pontuar Multiplica</span>
            </div>
            <div class="col align-center border hover-text-theme padding-medium color-grey-light opacity radius pointer hover-opacity-off"
                 style="margin-bottom: 5px"
                 onclick="createCliente()">
                <i class="font-xxxlarge material-icons">people</i>
                <span class="font-large col">Novo Cliente</span>
            </div>
            <?php
        }
        ?>
        <div class="col align-center border hover-text-theme padding-medium color-grey-light opacity radius pointer hover-opacity-off"
             style="margin-bottom: 5px"
             onclick="descontoServicos()">
            <i class="font-xxxlarge material-icons">add_shopping_cart</i>
            <span class="font-large col">Desconto em Serviço</span>
        </div>
        <?php
        if ($_SESSION['userlogin']['nivel'] === "1") {
            ?>
            <div class="col menu-li align-center hover-text-theme border padding-medium color-grey-light opacity radius pointer hover-opacity-off"
                 style="margin-bottom: 5px"
                 data-entity='funcionario_credenciado' data-action="table">
                <i class="font-xxxlarge material-icons">people_outline</i>
                <span class="font-large col">Funcionários</span>
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
        var updateHist = null;
        var $dash = $("#dashboard");

        function mainLoading() {
            $(".main").loading();
            hide_sidebar_small();
            closeSidebar();
            clearInterval(updateHist);
        }

        function createCliente() {
            mainLoading();
            get('create/cliente', function (data) {
                $dash.html(data.content)
            })
        }

        function updateHistorico(dd, tt) {
            if (typeof (tt) === "undefined")
                toast("Pontos Aplicados");

            get('read/historico', function (data) {
                $dash.find("#credenciado-historico").html(data.content);
            });
        }

        function updateHistoricoDesconto(dd, tt) {
            if (typeof (tt) === "undefined")
                toast("Desconto Aplicados");

            $("#descontoTotal, #descontoRecebidoTotal").html("");

            get('read/descontoHistorico', function (data) {
                $dash.find("#credenciado-desconto-historico").html(data.content);
            });
        }

        function readMoreHistoryDesc() {
            var $ref = $dash.find("#credenciado-desconto-historico-ref").html("");
            var $hist = $dash.find("#credenciado-desconto-historico");
            $hist.loading();
            get('read/descontoHistoricoMore', function (data) {
                $ref.template(data.content.template, data.content, function (data) {
                    $hist.html(data.content);
                });
            });
        }

        function createTransacao() {
            mainLoading();
            get('create/transacao', function (data) {
                $dash.html(data.content);
                updateHistorico(1, 1);
            });
        }

        function descontoServicos() {
            mainLoading();
            get('create/desconto', function (data) {
                console.log(data);
                $dash.html(data.content);
                updateHistoricoDesconto(1, 1);
            });
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

        $(function () {
            $("#dashboard").off("change", ".checkboxmult").on("change", ".checkboxmult", function () {
                let total = 0;
                let descontoTotal = 0;
                $(".checkboxmult").each(function () {
                    if ($(this).is(":checked")) {
                        let $div = $(this).siblings("div");
                        total += parseFloat($div.find(".checkBoxDesconto").text());
                        descontoTotal += parseFloat($div.find(".checkBoxValor").text()) - parseFloat($div.find(".checkBoxDesconto").text());
                    }
                });
                $("#descontoTotal").html("R$" + total.toFixed(2));
                $("#descontoRecebidoTotal").html("Desconto de R$" + descontoTotal.toFixed(2));
            });
        });
    </script>
    <?php
}
?>