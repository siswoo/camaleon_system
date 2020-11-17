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
$sheet->setCellValue('B1', 'Sede Registrado');
$fila = 2;

$sql1 = "SELECT * FROM pasantes WHERE estatus != 'Aceptada' ORDER BY sede";
$consulta = mysqli_query($conexion,$sql1);
while($row2 = mysqli_fetch_array($consulta)) {
	$primer_nombre 			= $row2['primer_nombre'];
	$segundo_nombre 		= $row2['segundo_nombre'];
	$primer_apellido 		= $row2['primer_apellido'];
	$segundo_apellido 		= $row2['segundo_apellido'];
	$sede 					= $row2['sede'];
	$estatus 				= $row2['estatus'];

	$sql2 = "SELECT * FROM sedes WHERE id =".$sede;
	$consulta2 = mysqli_query($conexion,$sql2);
	while($row3 = mysqli_fetch_array($consulta2)){
		$sede_nombre = $row3['nombre'];
	}

	$nombre_completo = $primer_nombre." ".$segundo_nombre." ".$primer_apellido." ".$segundo_apellido;

	$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(40);
	$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);

	$sheet->setCellValue('A'.$fila, $nombre_completo);
	$sheet->setCellValue('B'.$fila, $sede_nombre);
	$sheet->setCellValue('C'.$fila, $estatus);

	$fila = $fila+1;
}

$fecha_inicio = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('pasantes sin aceptar '.$fecha_inicio.'.xlsx');
header("Location: pasantes sin aceptar ".$fecha_inicio.".xlsx");
?>