<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;

include_once 'relatorios.php';

function mask($val, $mask)
{
    $maskared = '';
    $k = 0;
    for($i = 0; $i<=strlen($mask)-1; $i++)
    {
        if($mask[$i] == '#')
        {
            if(isset($val[$k]))
                $maskared .= $val[$k++];
        }
        else
        {
            if(isset($mask[$i]))
                $maskared .= $mask[$i];
        }
    }
    return $maskared;
}

if(file_exists(PATH_HOME . "relatorio-propostas-pendentes.xlsx"))
    unlink(PATH_HOME . "relatorio-propostas-pendentes.xlsx");

$spreadsheet = new Spreadsheet();  /*----Spreadsheet object-----*/
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");

$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet();

$activeSheet->setCellValue('A1' , 'NOME');
$activeSheet->setCellValue('B1' , 'CPF');
$activeSheet->setCellValue('C1' , 'CELULAR');
$activeSheet->setCellValue('D1' , 'E-MAIL');
$activeSheet->setCellValue('E1' , 'CONSULTOR');
$activeSheet->setCellValue('F1' , 'PLANO');
$activeSheet->setCellValue('G1' , 'DATA CONTRATO');
$activeSheet->setCellValue('H1' , 'VENCIMENTO PARCELA');
$activeSheet->setCellValue('I1' , 'DATA CADASTRO');

foreach ($dadosClientes['clientes'] as $i => $cliente) {
    $activeSheet->setCellValue('A' . ($i + 2) , $cliente['nome_completo']);
    $activeSheet->setCellValue('B' . ($i + 2) , !empty($cliente['cpf']) ? mask($cliente['cpf'],'###.###.###-##') : "");
    $activeSheet->setCellValue('C' . ($i + 2) , (!empty($cliente['telefone']) ? (mask($cliente['telefone'], (strlen($cliente['telefone']) === 8 ? '####-####' : (strlen($cliente['telefone']) === 9 ? '#####-####' : (strlen($cliente['telefone']) === 10 ? '(##) ####-####' : '(##) #####-####'))))) : ""));
    $activeSheet->setCellValue('D' . ($i + 2) , $cliente['email'] ?? "");
    $activeSheet->setCellValue('E' . ($i + 2) , $cliente['consultor'] ?? "");
    $activeSheet->setCellValue('F' . ($i + 2) , $cliente['plano'] ?? "");
    $activeSheet->setCellValue('G' . ($i + 2) , $cliente['data_de_inicio']);
    $activeSheet->setCellValue('H' . ($i + 2) , $cliente['dia_da_fatura']);
    $activeSheet->setCellValue('I' . ($i + 2) , $cliente['data_de_abertura']);
}

foreach(range('A','I') as $columnID)
    $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);

$writer->save(PATH_HOME . "relatorio-propostas-pendentes.xlsx");