<?php
$date = new \Helpers\DateTime();
$read = new \ConnCrud\Read();
$read->exeRead(PRE . "cliente_p_juridica", "WHERE usuarios = :id", "id={$_SESSION['userlogin']['id']}");
if (!$read->getResult()) {
    $read->exeRead(PRE . "cliente_p_fisica", "WHERE usuarios = :id", "id={$_SESSION['userlogin']['id']}");
    if ($read->getResult() && !isset($_SESSION['userlogin']['cliente'])) {
        $_SESSION['userlogin']['cliente'] = "PF";
        $_SESSION['userlogin']['clienteId'] = $read->getResult()[0]['id'];
    }
} elseif(!isset($_SESSION['userlogin']['cliente'])) {
    $_SESSION['userlogin']['cliente'] = "PJ";
    $_SESSION['userlogin']['clienteId'] = $read->getResult()[0]['id'];
}

if ($read->getResult()) {
    $abertura = $date->getDateTime($read->getResult()[0]['data_de_inicio'], 'd de M de Y');
    $status = $read->getResult()[0]['status'];


    $fileName = PATH_HOME . "_config/entity_not_show.json";
    $file = [];
    if (file_exists($fileName))
        $file = json_decode(file_get_contents($fileName), true);

    if(date('d') > 4) {
        if (!in_array('clientes', $file[5])) {
            $file[5][] = 'clientes';

            $f = fopen($fileName, "w");
            fwrite($f, json_encode($file));
            fclose($f);
        }
    } else {
        if(in_array('clientes', $file[5])) {
            $file[5] = array_diff($file[5], ['clientes']);

            $f = fopen($fileName, "w");
            fwrite($f, json_encode($file));
            fclose($f);
        }
    }
    ?>
    <div class="col padding-medium">
        <div class="col align-center border padding-medium margin-bottom color-grey-light opacity radius pointer hover-opacity-off menu-li"
             data-action="table" data-entity="clientes">
            <i class="font-xxxlarge material-icons">people</i>
            <span class="font-large col">Funcionários</span>
        </div>

        <div class="col align-center border padding-medium margin-bottom color-grey-light opacity radius pointer hover-opacity-off menu-li"
             data-action="page" data-atributo="fatura">
            <i class="font-xxxlarge material-icons">payment</i>
            <span class="font-large col">Faturas</span>
        </div>
    </div>

    <script>
        function mainLoading() {
            $(".main").loading();
            hide_sidebar_small();
            closeSidebar();
        }

        function preferences() {
            mainLoading();
            post('site-multiplica', '5/update/perfil', {}, function (data) {
                $("#dashboard").html(data.content)
            }, true);
        }
    </script>
    <?php
} else {
    $l = new \SessionControl\Login();
    $l->logOut();
}