<?php
include('../script/conexion.php');
require '../resources/Spreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Nombre');
$sheet->setCellValue('B1', 'Telefono');
$sheet->setCellValue('C1', 'Correo');
$sheet->setCellValue('D1', 'Sede');
$sheet->setCellValue('E1', 'Barrio');
$sheet->setCellValue('F1', 'Fecha Registro');
$fila = 2;

$sql1 = "SELECT * FROM pasantes";
$consulta1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($consulta1)) {
	$id = $row1['id'];
	$primer_nombre = $row1['primer_nombre'];
	$segundo_nombre = $row1['segundo_nombre'];
	$primer_apellido = $row1['primer_apellido'];
	$segundo_apellido = $row1['segundo_apellido'];
	$nombre = $primer_nombre." ".$segundo_nombre." ".$primer_apellido." ".$segundo_apellido;
	$telefono1 = $row1['telefono1'];
	$correo = $row1['correo'];
	$sede = $row1['sede'];
	$barrio = $row1['barrio'];
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
	$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);

	$sheet->setCellValue('A'.$fila, $nombre);
	$spreadsheet->getActiveSheet()->getCell('B'.$fila)->setValue($telefono1);
	$spreadsheet->getActiveSheet()->getStyle('B'.$fila)->getNumberFormat()->setFormatCode('00');
	$sheet->setCellValue('C'.$fila, $correo);
	$sheet->setCellValue('D'.$fila, $sede_nombre);
	$sheet->setCellValue('E'.$fila, $barrio);
	$sheet->setCellValue('F'.$fila, $fecha_inicio);
	$fila = $fila+1;
}

$fecha_inicio1 = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('exportar1 '.$fecha_inicio1.'.xlsx');
header("Location: exportar1 ".$fecha_inicio1.".xlsx");

?>