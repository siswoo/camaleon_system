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
$sheet->setCellValue('A1', 'Tipo Doc');
$sheet->setCellValue('B1', 'Numero Doc');
$sheet->setCellValue('C1', 'Modelo');
$sheet->setCellValue('D1', 'Sede');
$sheet->setCellValue('E1', 'Fecha de registro');
$fila = 2;

$sql1 = "SELECT * FROM modelos WHERE estatus = 'Activa' and fecha_inicio BETWEEN '2021-09-01' AND '2021-09-15' ORDER BY id DESC";
$consulta1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($consulta1)) {
	$modelo_id = $row1['id'];
	$documento_tipo = $row1['documento_tipo'];
	$documento_numero = $row1['documento_numero'];
	$modelo = $row1['nombre1']." ".$row1['nombre2']." ".$row1['apellido1']." ".$row1['apellido2'];
	$sede = $row1['sede'];
	$fecha_inicio = $row1['fecha_inicio'];

	$sql2 = "SELECT * FROM sedes WHERE id = ".$sede;
	$consulta2 = mysqli_query($conexion,$sql2);
	while($row2 = mysqli_fetch_array($consulta2)) {
		$sede_nombre = $row2["nombre"];
	}

		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(60);
		$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);

		$sheet->setCellValue('A'.$fila, $documento_tipo);
		$spreadsheet->getActiveSheet()->getCell('B'.$fila)->setValue($documento_numero);
		$spreadsheet->getActiveSheet()->getStyle('B'.$fila)->getNumberFormat()->setFormatCode('00');
		$sheet->setCellValue('C'.$fila, $modelo);
		$sheet->setCellValue('D'.$fila, $sede_nombre);
		$sheet->setCellValue('E'.$fila, $fecha_inicio);
		$fila = $fila+1;
}

$fecha_inicio1 = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('../resources/documentos/modelos_reporte1 '.$fecha_inicio1.'.xlsx');
header("Location: ../resources/documentos/modelos_reporte1 ".$fecha_inicio1.".xlsx");


?>