<?php

$inicio = $_SESSION['convenio']['data_de_inicio'];
$tempo = $_SESSION['convenio']['plano']['contrato_de'];
$tempo = date("d/m/Y",strtotime(date("Y-m-d", strtotime($inicio)) . " +{$tempo} month"));

$data['data'] = "<div class='col padding-64 padding-xlarge'><div class='col z-depth-2 radius color-white padding-xxlarge padding-32 font-xlarge font-light'>"
    . "<h2 class='upper'>vantagens do plano {$_SESSION['convenio']['plano']['titulo']}</h2>"
    . $_SESSION['convenio']['plano']['descricao']
    . "<div class='col padding-32'>"
    . "<small>Seu Contrato vence no dia {$tempo}</small>"
    . "</div>"
    . "</div></div>";