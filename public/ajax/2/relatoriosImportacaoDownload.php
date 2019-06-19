<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;

require_once 'relatoriosImportacao.php';

if(file_exists(PATH_HOME . "propostasPendentes.xlsx"))
    unlink(PATH_HOME . "propostasPendentes.xlsx");

$spreadsheet = new Spreadsheet();  /*----Spreadsheet object-----*/
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");

$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet();

$activeSheet->setCellValue('A1' , 'Nome do cliente / Nome Fantasia *');
$activeSheet->setCellValue('B1' , 'Razão Social');
$activeSheet->setCellValue('C1' , 'CNPJ');
$activeSheet->setCellValue('D1' , 'CPF');
$activeSheet->setCellValue('E1' , 'Email');
$activeSheet->setCellValue('F1' , 'Cep');
$activeSheet->setCellValue('G1' , 'Estado');
$activeSheet->setCellValue('H1' , 'Cidade');
$activeSheet->setCellValue('I1' , 'Endereço');
$activeSheet->setCellValue('J1' , 'Bairro');
$activeSheet->setCellValue('K1' , 'Número');
$activeSheet->setCellValue('L1' , 'Complemento');
$activeSheet->setCellValue('M1' , 'Telefone');
$activeSheet->setCellValue('N1' , 'Contato');
$activeSheet->setCellValue('O1' , 'Data de nascimento / Fundação');
$activeSheet->setCellValue('P1' , 'Data Contrato');
$activeSheet->setCellValue('Q1' , 'Data Vencimento');
$activeSheet->setCellValue('R1' , 'Consultor');

foreach ($dadosClientes['clientes'] as $i => $cliente) {
    $activeSheet->setCellValue('A' . ($i + 2) , $cliente['nome_completo'] ?? "");
    $activeSheet->setCellValue('B' . ($i + 2) , $cliente['razao_social'] ?? "");
    $activeSheet->setCellValue('C' . ($i + 2) , !empty($cliente['cnpj']) ? mask($cliente['cnpj'],'##.###.###/####-##') : "");
    $activeSheet->setCellValue('D' . ($i + 2) , !empty($cliente['cpf']) ? mask($cliente['cpf'],'###.###.###-##') : "");
    $activeSheet->setCellValue('E' . ($i + 2) , $cliente['email']);
    $activeSheet->setCellValue('F' . ($i + 2) , $cliente['cep'] ?? "");
    $activeSheet->setCellValue('G' . ($i + 2) , $cliente['estado'] ?? "");
    $activeSheet->setCellValue('H' . ($i + 2) , $cliente['cidade'] ?? "");
    $activeSheet->setCellValue('I' . ($i + 2) , $cliente['logradouro'] ?? "");
    $activeSheet->setCellValue('J' . ($i + 2) , $cliente['bairro'] ?? "");
    $activeSheet->setCellValue('K' . ($i + 2) , $cliente['numero'] ?? "");
    $activeSheet->setCellValue('L' . ($i + 2) , $cliente['complemento'] ?? "");
    $activeSheet->setCellValue('M' . ($i + 2) , $cliente['telefone']);
    $activeSheet->setCellValue('N' . ($i + 2) , $cliente['nome']);
    $activeSheet->setCellValue('O' . ($i + 2) , $cliente['data_de_nascimento'] ?? "");
    $activeSheet->setCellValue('P' . ($i + 2) , $cliente['data_de_inicio']);
    $activeSheet->setCellValue('Q' . ($i + 2) , $cliente['dia_da_fatura']);
    $activeSheet->setCellValue('R' . ($i + 2) , $cliente['consultor'] ?? "");
}

foreach(range('A','R') as $columnID)
    $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);

$writer->save(PATH_HOME . "relatorio-importacao-clientes.xlsx");