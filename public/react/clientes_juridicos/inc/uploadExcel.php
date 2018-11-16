<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Helpers\Check;

$uploadOld = "";
if (isset($dadosOld) && !empty($dadosOld['upload_excel']))
    $uploadOld = json_decode($dadosOld['upload_excel'], true);

$upload = "";
if (!empty($dados['upload_excel']))
    $upload = json_decode($dados['upload_excel'], true);


if (!empty($upload) && (empty($uploadOld) || $uploadOld[0]['url'] !== $upload[0]['url'])) {

    //Prepara variáveis
    $file = PATH_HOME . json_decode($dados['upload_excel'], true)[0]['url'];
    $spreadsheet = new Spreadsheet();
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
    $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

    $dadosCliente = [];
    $ref = [];
    $conv = [
        "cpf" => "cpf",
        "sexo" => "sexo",
        "telefone" => "telefone",
        "email" => "email",
        "nome" => "nome_completo",
        "data-de-inclusao" => "data_de_abertura",
        "data-de-nascimento" => "data_de_nascimento"
    ];

    //Obtém os dados do excel
    foreach ($sheetData as $i => $sheetDatum) {
        $dadosT = [];
        foreach ($sheetDatum as $column => $valor) {
            if ($i === 1) {
                $ref[$column] = Check::name($valor);
            } elseif (!empty($ref[$column])) {
                if ($ref[$column] === 'data-de-nascimento')
                    $valor = date("Y-m-d", strtotime($valor ?? "now"));
                elseif ($ref[$column] === "data-de-inclusao")
                    $valor = date("Y-m-d H:i:s", strtotime($valor ?? "now"));
                elseif ($ref[$column] === "sexo")
                    $valor = ($valor === "m" || $valor === "M" ? 1 : ($valor === "f" ? 2 : 3));
                elseif ($ref[$column] === "cpf")
                    $valor = (string)str_pad($valor ?? "", 11, "0", STR_PAD_LEFT);
                elseif ($ref[$column] === "nome")
                    $valor = ucwords($valor ?? "");

                $dadosT[$conv[$ref[$column]]] = $valor ?? "";
            }
        }
        if (!empty($dadosT))
            $dadosCliente[] = $dadosT;
    }

    //Cria os dados no banco
    $read = new \ConnCrud\Read();
    $create = new \ConnCrud\Create();
    $up = new \ConnCrud\Update();
    $del = new \ConnCrud\Delete();

    //Remove todas as associações do cliente jurídico com os clientes
    $del->exeDelete("clientes_juridicos_clientes", "WHERE clientes_juridicos_id = :ci", "ci={$dados['id']}");

    foreach ($dadosCliente as $cliente) {

        $cliente['plano'] = [
            "data_de_inicio" => !empty($cliente['data_de_abertura']) ? date("Y-m-d", strtotime($cliente['data_de_abertura'])) : $dados['data_de_inicio'],
            "plano" => $dados['plano'] ?? 2,
            "status" => $dados['status'] ?? 1
        ];

        if (isset($cliente["numero_do_cartao"]))
            unset($cliente["numero_do_cartao"]);

        if (!empty($cliente['cpf']) && !Check::cpf($cliente["cpf"]))
            unset($cliente['cpf']);

        //Se já existe algum cliente com este CPF ou EMAIL, então edita ele
        if (!empty($cliente['cpf']) || !empty($cliente['email'])) {
            if (!empty($cliente['cpf']) && !empty($cliente['email']))
                $read->exeRead("clientes", "WHERE cpf = :cpf || email = :email", "cpf={$cliente['cpf']}&email={$cliente['email']}");
            elseif (!empty($cliente['cpf']))
                $read->exeRead("clientes", "WHERE cpf = :cpf", "cpf={$cliente['cpf']}");
            else
                $read->exeRead("clientes", "WHERE email = :email", "email={$cliente['email']}");

            if ($read->getResult())
                $cliente['id'] = $read->getResult()[0]['id'];
        }

        //Cria ou Atualiza Cliente
        $dic = new \Entity\Dicionario("clientes");
        $dic->setData($cliente);
        $dic->save();

        //se não houve erro, cria o vínculo com o cliente Jurídico
        if (empty($dic->getError())) {
            $cc = $dic->search(0)->getValue();
            $read->exeRead("clientes_juridicos_clientes", "WHERE clientes_juridicos_id = :ci && clientes_id = :cc", "ci={$dados['id']}&cc={$cc}");
            if (!$read->getResult())
                $create->exeCreate("clientes_juridicos_clientes", ["clientes_juridicos_id" => $dados['id'], "clientes_id" => $cc]);
        }
    }
}