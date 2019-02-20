<?php

/**
 * Deleta usuário, plano e endereço caso o cliente seja excluído
 *
 */

$del = new \ConnCrud\Delete();
if(!empty($dados['login']))
    $del->exeDelete("usuarios", "WHERE id = :id", "id={$dados['login']}");