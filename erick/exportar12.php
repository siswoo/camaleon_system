<?php
session_start();
require '../resources/Spreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

$spreadsheet = new Spreadsheet();
//$sheet = $spreadsheet->getActiveSheet();



$locale = 'es';
$validLocale = \PhpOffice\PhpSpreadsheet\Settings::setLocale($locale);
if (!$validLocale) {
    echo 'Unable to set locale to '.$locale." - reverting to en_us<br />\n";
}

/*
$spreadsheet->getActiveSheet()
    ->setCellValue('A1', '14/03/2021');

$spreadsheet->getActiveSheet()->getStyle('A1')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_YYYYMMDD);
*/
/*
$spreadsheet->getActiveSheet()->setCellValue('D1', 39813);
$spreadsheet->getActiveSheet()->getStyle('D1')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);
*/


$spreadsheet->getActiveSheet()->setCellValue('A1', '14/03/2021');
$spreadsheet->getActiveSheet()->getStyle('A1')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DDMMYYYY);

/************* PARA EL FORMATO A LA CELDA FECHA!************************
/*
$spreadsheet->getActiveSheet()
    ->setCellValue('A1', '2008-12-31');

$spreadsheet->getActiveSheet()->getStyle('A1')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);
*****************************************************************************/



$fecha_inicio = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('test '.$fecha_inicio.'.xlsx');
header("Location: test ".$fecha_inicio.".xlsx");

?>