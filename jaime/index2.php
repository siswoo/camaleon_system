<?php
session_start();
include('../script/conexion.php');
require '../resources/Spreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

$responsable = $_SESSION['id'];
$fecha_inicio = date('Y-m-d');

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Nombre');
$sheet->setCellValue('B1', 'Documento Tipo');
$sheet->setCellValue('C1', 'Documento Numero');
$sheet->setCellValue('D1', 'Estatus');
$sheet->setCellValue('E1', 'valor');
$sheet->setCellValue('F1', 'Fecha Ingreso');

$fila = 2;

$sql1 = "SELECT * FROM descuento WHERE concepto = 'Restaurante' and fecha_desde BETWEEN '2021-05-01' AND '2021-05-15' and fecha_hasta BETWEEN '2021-05-01' AND '2021-05-15'";
$consulta1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($consulta1)) {
	$id_modelo = $row1['id_modelo'];
	$valor = $row1['valor'];
	$sql2 = "SELECT * FROM modelos WHERE id = ".$id_modelo;
	$consulta2 = mysqli_query($conexion,$sql2);
	while($row2 = mysqli_fetch_array($consulta2)) {
		$modelo_id = $row2['id'];
		$documento_numero = $row2['documento_numero'];
		$documento_tipo = $row2['documento_tipo'];
		$modelo_nombre_completo = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
		$estatus = $row2['estatus'];
		$fecha_inicio = $row2['fecha_inicio'];
	}

	$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(60);
	$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);

	$sheet->setCellValue('A'.$fila, $modelo_nombre_completo);
	$spreadsheet->getActiveSheet()->getCell('B'.$fila)->setValue($documento_numero);
	$spreadsheet->getActiveSheet()->getStyle('B'.$fila)->getNumberFormat()->setFormatCode('00');
	$sheet->setCellValue('C'.$fila, $documento_tipo);
	$sheet->setCellValue('D'.$fila, $estatus);
	$sheet->setCellValue('E'.$fila, $valor);
	$sheet->setCellValue('F'.$fila, $fecha_inicio);

	$fila = $fila+1;
}

$fecha_inicio1 = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('../resources/documentos/miscelanea/Reporte Jaime 2 '.$fecha_inicio1.'.xlsx');
header("Location: ../resources/documentos/miscelanea/Reporte Jaime 2 ".$fecha_inicio1.".xlsx");

?>