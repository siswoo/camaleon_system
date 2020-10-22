<?php
require '../resources/Spreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

include('conexion.php');

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$fila = 1;

	$sql2 = "SELECT * FROM temporaltest2";
	$consulta2 = mysqli_query($conexion,$sql2);
	while($row3 = mysqli_fetch_array($consulta2)){
		$cedula 	= $row3['cedula'];
		$tipo 		= $row3['tipo'];

		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);

		$sheet->setCellValue('A'.$fila, $cedula);
		$sheet->setCellValue('B'.$fila, $tipo);

		$fila = $fila+1;
	}

$fecha_inicio1 = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('../resources/documentos/pasantes/reportes/prueba1.xlsx');
header("Location: ../resources/documentos/pasantes/reportes/prueba1.xlsx");

?>