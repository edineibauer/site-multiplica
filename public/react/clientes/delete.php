<?php

/**
 * Deleta usuário, plano e endereço caso o cliente seja excluído
 *
 */

$del = new \ConnCrud\Delete();
if(!empty($dados['login']))
    $del->exeDelete("usuarios", "WHERE id = :id", "id={$dados['login']}");

if(!empty($dados['plano']))
    $del->exeDelete("planos", "WHERE id = :id", "id={$dados['plano']}");

if(!empty($dados['endereco']))
    $del->exeDelete("endereco", "WHERE id = :id", "id={$dados['endereco']}");