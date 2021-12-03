<?php
require '../resources/Spreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

include('conexion.php');
$sql = $_POST['sql'];
//$sql = "SELECT * FROM pasantes";
$consulta = mysqli_query( $conexion, $sql );
$fecha_inicio1 = date('Y-m-d');

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Tipo Documento');
$sheet->setCellValue('B1', 'Numero Documento');
$sheet->setCellValue('C1', 'Primer Nombre');
$sheet->setCellValue('D1', 'Segundo Nombre');
$sheet->setCellValue('E1', 'Primer Apellido');
$sheet->setCellValue('F1', 'Segundo Apellido');
$sheet->setCellValue('G1', 'Genero');
$sheet->setCellValue('H1', 'Correo');
$sheet->setCellValue('I1', 'WhatsApp');
$sheet->setCellValue('J1', 'Direccion');
$sheet->setCellValue('K1', 'Estatus');
$sheet->setCellValue('L1', 'barrio');
$sheet->setCellValue('M1', 'Sede');
$sheet->setCellValue('N1', 'Fecha Inicio');
$sheet->setCellValue('X1', 'ID Sede');
$fila = 2;
while($row2 = mysqli_fetch_array($consulta)) {
	$id 					= $row2['id'];
	$tipo_documento 		= $row2['tipo_documento'];
	$numero_documento 		= "".$row2['numero_documento']."";
	$primer_nombre 			= $row2['primer_nombre'];
	$segundo_nombre 		= $row2['segundo_nombre'];
	$primer_apellido 		= $row2['primer_apellido'];
	$segundo_apellido 		= $row2['segundo_apellido'];
	$genero 				= $row2['genero'];
	$correo 				= $row2['correo'];
	$telefono1 				= $row2['telefono1'];
	$direccion 				= $row2['direccion'];
	$estatus 				= $row2['estatus'];
	$barrio 				= $row2['barrio'];
	$sede 					= $row2['sede'];
	$fecha_inicio 			= $row2['fecha_inicio'];

	$sql2 = "SELECT * FROM sedes WHERE id =".$sede;
	$consulta2 = mysqli_query($conexion,$sql2);
	while($row3 = mysqli_fetch_array($consulta2)){
		$sede_nombre = $row3['nombre'];
	}
	//$sheet->getActiveSheet()->getStyle('A1')->getNumberFormat()->setFormatCode('#,##0.00');
	/*
	$spreadsheet->getActiveSheet()->getCell('A2')->setValue(19);
	$spreadsheet->getActiveSheet()->getStyle('A2')->getNumberFormat()->setFormatCode('');
	*/
	$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(10);
	$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(30);
	$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(30);
	$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(10);
	$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(15);
	$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(15);
	$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(15);

	$sheet->setCellValue('A'.$fila, $tipo_documento);
	$spreadsheet->getActiveSheet()->getCell('B'.$fila)->setValue($numero_documento);
	$spreadsheet->getActiveSheet()->getStyle('B'.$fila)->getNumberFormat()->setFormatCode('00');
	$sheet->setCellValue('C'.$fila, $primer_nombre);
	$sheet->setCellValue('D'.$fila, $segundo_nombre);
	$sheet->setCellValue('E'.$fila, $primer_apellido);
	$sheet->setCellValue('F'.$fila, $segundo_apellido);
	$sheet->setCellValue('G'.$fila, $genero);
	$sheet->setCellValue('H'.$fila, $correo);
	$sheet->setCellValue('I'.$fila, "".$telefono1."");
	$sheet->setCellValue('J'.$fila, $direccion);
	$sheet->setCellValue('K'.$fila, $estatus);
	$sheet->setCellValue('L'.$fila, $barrio);
	$sheet->setCellValue('M'.$fila, $sede_nombre);
	$sheet->setCellValue('N'.$fila, $fecha_inicio);
	$sheet->setCellValue('X'.$fila, $sede);

	$fila = $fila+1;
}

$fecha_inicio1 = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('../resources/documentos/pasantes/reportes/Reporte_pasantes_'.$fecha_inicio1.'.xlsx');
header("Location: ../resources/documentos/pasantes/reportes/Reporte_pasantes_".$fecha_inicio1.".xlsx");
?>