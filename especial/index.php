<?php
require '../resources/Spreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

include('../script/conexion.php');

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Nombre Completo');
$sheet->setCellValue('B1', 'Documento Tipo');
$sheet->setCellValue('C1', 'Documento Numero');
$sheet->setCellValue('D1', 'Fecha de Ingreso');
$fila = 2;

$sql1 = "SELECT * FROM modelos WHERE estatus = 'Activa' and genero = 'Mujer' and sede = 1";
$consulta = mysqli_query($conexion,$sql1);
while($row2 = mysqli_fetch_array($consulta)) {
	$nombre1 			= $row2['nombre1'];
	$nombre2 			= $row2['nombre2'];
	$apellido1 			= $row2['apellido1'];
	$apellido2 			= $row2['apellido2'];
	$documento_tipo		= $row2['documento_tipo'];
	$documento_numero 	= $row2['documento_numero'];
	$fecha_inicio 		= $row2['fecha_inicio'];

	$nombre_completo = $nombre1." ".$nombre2." ".$apellido1." ".$apellido2;

	$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(40);
	$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);

	$sheet->setCellValue('A'.$fila, $nombre_completo);
	$sheet->setCellValue('B'.$fila, $documento_tipo);
	$sheet->setCellValue('C'.$fila, $documento_numero);
	$sheet->setCellValue('D'.$fila, $fecha_inicio);

	$fila = $fila+1;
}

$fecha_inicio = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('Mujeres Activas Modelos '.$fecha_inicio.'.xlsx');
header("Location: Mujeres Activas Modelos ".$fecha_inicio.".xlsx");
?>