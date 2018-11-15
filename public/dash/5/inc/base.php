<?php
$read = new \ConnCrud\Read();
$read->exeRead(PRE . "clientes_juridicos", "WHERE login = :id", "id={$_SESSION['userlogin']['id']}");
if ($read->getResult()) {
    $_SESSION['convenio'] = $read->getResult()[0];
    $_SESSION['convenio']['type'] = 1;

    function contrato(int $id)
    {
        switch ($id) {
            case 1:
                return 1;
                break;
            case 2:
                return 3;
                break;
            case 3:
                return 6;
                break;
            case 4:
                return 12;
                break;
            case 5:
                return 24;
                break;
            case 6:
                return 36;
                break;
            case 7:
                return 60;
                break;
        }
    }

    $data1 = new DateTime(date("Y-m-d"));
    $data2 = new DateTime($_SESSION['convenio']['data_de_inicio']);
    $intervalo = $data1->diff($data2);
    $_SESSION['convenio']['intervalo'] = [$intervalo->y, $intervalo->m, $intervalo->d];

    $read->exeRead("tipos_de_planos", "WHERE id = :id", "id={$_SESSION['convenio']['plano']}");
    $_SESSION['convenio']['plano'] = $read->getResult() ? $read->getResult()[0] : "";
    $_SESSION['convenio']['plano']['contrato_de'] = contrato($_SESSION['convenio']['plano']['contrato_de']);
}