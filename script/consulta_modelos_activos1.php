<?php
include('conexion.php');
require '../resources/Spreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Turno');
$sheet->setCellValue('B1', 'Modelo');
$sheet->setCellValue('C1', 'Tipo Doc');
$sheet->setCellValue('D1', 'Numero Doc');
$sheet->setCellValue('E1', 'Telefono');
$sheet->setCellValue('F1', 'Fecha de registro');
$fila = 2;

$sql1 = "SELECT * FROM modelos WHERE sede = 1 and estatus = 'Activa'";
$consulta1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($consulta1)) {
	$modelo_id = $row1['id'];
	$modelo_telefono = $row1['telefono1'];
	$modelo_sede = $row1['sede'];
	$modelo_turno = $row1['turno'];
	$fecha_inicio = $row1['fecha_inicio'];
	$documento_tipo = $row1['documento_tipo'];
	$documento_numero = $row1['documento_numero'];
	$modelo_nombre_completo = $row1['nombre1']." ".$row1['nombre2']." ".$row1['apellido1']." ".$row1['apellido2'];

		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(60);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);

		$sheet->setCellValue('A'.$fila, $modelo_turno);
		$sheet->setCellValue('B'.$fila, $modelo_nombre_completo);
		$sheet->setCellValue('C'.$fila, $documento_tipo);
		$spreadsheet->getActiveSheet()->getCell('D'.$fila)->setValue($documento_numero);
		$spreadsheet->getActiveSheet()->getStyle('D'.$fila)->getNumberFormat()->setFormatCode('00');
		$sheet->setCellValue('E'.$fila, $modelo_telefono);
		$sheet->setCellValue('F'.$fila, $fecha_inicio);
		$fila = $fila+1;
}

$fecha_inicio1 = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('../resources/documentos/presabanas/modelos_recorte '.$fecha_inicio1.'.xlsx');
header("Location: ../resources/documentos/presabanas/modelos_recorte ".$fecha_inicio1.".xlsx");


?>