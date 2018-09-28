<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Helpers\Check;

$file = PATH_HOME . $dados['arquivo_excel']['url'];

$spreadsheet = new Spreadsheet();
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

$dados = [];
$ref = [];
foreach ($sheetData as $i => $sheetDatum) {
    $dadosT = [];
    foreach ($sheetDatum as $column => $valor) {
        if ($i === 1)
            $ref[$column] = Check::name($valor);
        elseif (!empty($ref[$column]))
            $dadosT[$ref[$column]] = $valor;
    }
    if (!empty($dadosT))
        $dados[] = $dadosT;
}
var_dump($dados);