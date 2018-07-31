<?php
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$type = ($_SESSION['convenio']['type'] ? "juridico" : "fisico");
$del = new \ConnCrud\Delete();
$del->exeDelete("credenciado_{$type}_clientes_funcionarios", "WHERE clientes_id = :cij", "cij={$id}");
$data['data'] = 1;
