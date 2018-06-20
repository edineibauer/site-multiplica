<?php
$date = new \Helpers\DateTime();
$pontos = 0;
$status = 'desativado';
$abertura = $date->getDateTime(date("Y-m-d H:i:s"), 'd de M de Y');

$read = new \ConnCrud\Read();
$read->exeRead(PRE . "clientes", "WHERE acesso = :id", "id={$_SESSION['userlogin']['id']}");
if($read->getResult()) {
    $pontos = $read->getResult()[0]['pontos_multiplica'];
    $abertura = $date->getDateTime($read->getResult()[0]['data_de_abertura'], 'd de M de Y');
    $status = $read->getResult()[0]['status'];
}
$pontos = $pontos ?? 0;
?>

<div class="col padding-medium">
    <div class="col align-center border padding-medium margin-bottom color-grey-light opacity radius pointer hover-opacity-off" onclick="historico()">
        <span class="font-xlarge"><?=$pontos?></span>
        <span class="font-large col">Pontos Multiplica</span>
    </div>

    <div class="col align-center border padding-medium margin-bottom color-grey-light opacity radius pointer hover-opacity-off" onclick="convenios()">
        <i class="font-xxxlarge material-icons">business</i>
        <span class="font-large col">Convênios Multiplica</span>
    </div>
</div>

<script>

    function mainLoading() {
        $(".main").loading();
        hide_sidebar_small();
        closeSidebar();
    }

    function historico() {
        mainLoading();
        get('convenio/create/cliente', function (data) {
            $("#dashboard").html(data.content)
        })
    }

    function convenios() {
        mainLoading();
        post('site-multiplica', 'convenio/read/list', {}, function (data) {
            $("#dashboard").template(data.content)
        },true);
    }
</script>