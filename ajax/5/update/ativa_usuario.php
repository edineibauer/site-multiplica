<?php
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$allow = !(date('d') > 4);

if($allow) {
    $up = new \ConnCrud\Update();
    $up->exeUpdate("clientes", ["status_do_convenio" => 1], "WHERE id=:id", "id={$id}");

    $data['data'] = 1;
} else {
    $data['data'] = 2;
}