<?php
require '../resources/Spreadsheet/autoload.php';

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

include('../script/conexion.php');

$sheet->setCellValue('A1', 'Nombre Completo');
$sheet->setCellValue('B1', 'Numero Documento');
$sheet->setCellValue('C1', 'Sede Registrado');
$sheet->setCellValue('D1', 'Cuenta P/P');
$sheet->setCellValue('E1', 'Numero cedula titular');
$sheet->setCellValue('F1', 'Nombre titular');
$sheet->setCellValue('G1', 'Tipo de cuenta');
$sheet->setCellValue('H1', 'Numero de cuenta');
$sheet->setCellValue('I1', 'Banco');
$fila = 2;

$sql1 = "SELECT * FROM modelos WHERE estatus = 'Activa' and banco_cedula != '' ORDER BY sede";
$consulta = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($consulta)) {
	$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(40);
	$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(40);
	$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(40);
	$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(40);

	$nombre_modelo = $row1['nombre1']." ".$row1['nombre2']." ".$row1['apellido1']." ".$row1['apellido2'];
	$numero_documento = $row1['documento_numero'];
	$id_sede = $row1['sede'];
	$banco_cedula = $row1['banco_cedula'];
	$banco_nombre = $row1['banco_nombre'];
	$banco_tipo = $row1['banco_tipo'];
	$banco_numero = $row1['banco_numero'];
	$banco_banco = $row1['banco_banco'];
	$bcpp = $row1['BCPP'];

	$sql2 = "SELECT * FROM sedes WHERE id = ".$id_sede;
	$consulta2 = mysqli_query($conexion,$sql2);
	while($row2 = mysqli_fetch_array($consulta2)) {
		$nombre_sede = $row2['nombre'];
	}

	$sheet->setCellValue('A'.$fila, $nombre_modelo);
	$spreadsheet->getActiveSheet()->getCell('B'.$fila)->setValue($numero_documento);
	$spreadsheet->getActiveSheet()->getStyle('B'.$fila)->getNumberFormat()->setFormatCode('00');
	//$sheet->setCellValue('B'.$fila, $numero_documento);
	$sheet->setCellValue('C'.$fila, $nombre_sede);
	$sheet->setCellValue('D'.$fila, $bcpp);
	$spreadsheet->getActiveSheet()->getCell('E'.$fila)->setValue($banco_cedula);
	$spreadsheet->getActiveSheet()->getStyle('E'.$fila)->getNumberFormat()->setFormatCode('00');
	//$sheet->setCellValue('E'.$fila, $banco_cedula);
	$sheet->setCellValue('F'.$fila, $banco_nombre);
	$sheet->setCellValue('G'.$fila, $banco_tipo);
	$spreadsheet->getActiveSheet()->getCell('H'.$fila)->setValue($banco_numero);
	$spreadsheet->getActiveSheet()->getStyle('H'.$fila)->getNumberFormat()->setFormatCode('00');
	//$sheet->setCellValue('H'.$fila, $banco_numero);
	$sheet->setCellValue('I'.$fila, $banco_banco);

	$fila = $fila+1;

}


$fecha_inicio = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('Registrados Banco '.$fecha_inicio.'.xlsx');
header("Location: Registrados Banco ".$fecha_inicio.".xlsx");

?>