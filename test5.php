<?php
require 'resources/Spreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

/************GUARDAR***************/
/*
$numeros = '987987987987987987987';

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Olá mundo');
$sheet->setCellValue('A2', $numeros);

$writer = new Xlsx($spreadsheet);
$writer->save('phpcomexcel.xlsx');
*/



/******************LEER******************/
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('phpcomexcel.xlsx');
$worksheet = $spreadsheet->getActiveSheet();
echo $worksheet->getCell('A1');
echo $worksheet->getCell('A2');

/*
$tabela = '<table>
                <tr>
                   <td>Nome</td>
                   <td>Sobrenome</td>
                </tr>
                <tr>
                   <td>Bruce</td>
                   <td>Wayne</td>
                </tr>
           </table>';
*/
//$reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
//$spreadsheet = $reader->loadFromString($tabela);

//$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
//$writer->save('clientes.xls'); 


$datos = [
    "SQL1:"     => 'ozuna',
];

echo json_encode($datos);

?>