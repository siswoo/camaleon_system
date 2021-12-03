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
$sheet->setCellValue('F1', 'Fecha Desde');
$sheet->setCellValue('G1', 'Fecha Hasta');
$sheet->setCellValue('H1', 'Concepto');
$fila = 2;

$sql1 = "SELECT * FROM descuento WHERE concepto = 'Evento Artístico Halloween'";
$proceso1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($proceso1)) {
	$id_modelo = $row1['id'];
	$fecha_desde = $row1['fecha_desde'];
	$fecha_hasta = $row1['fecha_hasta'];
	$concepto = $row1['concepto'];

	$sql2 = "SELECT * FROM modelos WHERE id = ".$id_modelo;
	$proceso2 = mysqli_query($conexion,$sql2);

	$contador2 = mysqli_num_rows($proceso2);
	if($contador2>=1){
		while($row2 = mysqli_fetch_array($proceso2)) {
			$documento_tipo = $row2['documento_tipo'];
			$documento_numero = $row2['documento_numero'];
			$modelo = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
			$sede = $row2['sede'];
			$fecha_inicio = $row2['fecha_inicio'];
		}

		$sql3 = "SELECT * FROM sedes WHERE id = ".$sede;
		$proceso3 = mysqli_query($conexion,$sql3);
		while($row3 = mysqli_fetch_array($proceso3)) {
			$sede_nombre = $row3["nombre"];
		}

			$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(60);
			$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(30);

			$sheet->setCellValue('A'.$fila, $documento_tipo);
			$spreadsheet->getActiveSheet()->getCell('B'.$fila)->setValue($documento_numero);
			$spreadsheet->getActiveSheet()->getStyle('B'.$fila)->getNumberFormat()->setFormatCode('00');
			$sheet->setCellValue('C'.$fila, $modelo);
			$sheet->setCellValue('D'.$fila, $sede_nombre);
			$sheet->setCellValue('E'.$fila, $fecha_inicio);
			$sheet->setCellValue('F'.$fila, $fecha_desde);
			$sheet->setCellValue('G'.$fila, $fecha_hasta);
			$sheet->setCellValue('H'.$fila, $concepto);
			$fila = $fila+1;

	}

}

$fecha_inicio1 = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('../resources/documentos/modelos_reporte2 '.$fecha_inicio1.'.xlsx');
header("Location: ../resources/documentos/modelos_reporte2 ".$fecha_inicio1.".xlsx");


?>