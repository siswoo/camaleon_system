<?php

/*
require 'resources/Spreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$spreadsheet = new Spreadsheet();
$spreadsheet->getProperties()
    ->setCreator("Maarten Balliauw")
    ->setLastModifiedBy("Maarten Balliauw")
    ->setTitle("Office 2007 XLSX Test Document")
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription(
        "Test document for Office 2007 XLSX, generated using PHP classes."
    )
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Test result file");
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hola Mundo !');
$writer = new Xlsx($spreadsheet);
$writer->save('hola_mundo.xlsx');
// Redireccionamos para que descargue el archivo generado
header("Location: hola_mundo.xlsx");
*/


require 'resources/Spreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

include('script/conexion.php');
//$sql = $_POST['sql'];
$sql = "SELECT * FROM pasantes";
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
$sheet->setCellValue('L1', 'Fecha Inicio');
$fila = 2;
while($row2 = mysqli_fetch_array($consulta)) {
	$id 					= $row2['id'];
	$tipo_documento 		= $row2['tipo_documento'];
	$numero_documento 		= $row2['numero_documento'];
	$primer_nombre 			= $row2['primer_nombre'];
	$segundo_nombre 		= $row2['segundo_nombre'];
	$primer_apellido 		= $row2['primer_apellido'];
	$segundo_apellido 		= $row2['segundo_apellido'];
	$genero 				= $row2['genero'];
	$correo 				= $row2['correo'];
	$telefono1 				= $row2['telefono1'];
	$direccion 				= $row2['direccion'];
	$estatus 				= $row2['estatus'];
	$fecha_inicio 			= $row2['fecha_inicio'];

	$sheet->setCellValue('A'.$fila, $tipo_documento);
	$sheet->setCellValue('B'.$fila, "".$numero_documento." ");
	$sheet->setCellValue('C'.$fila, $primer_nombre);
	$sheet->setCellValue('D'.$fila, $segundo_nombre);
	$sheet->setCellValue('E'.$fila, $primer_apellido);
	$sheet->setCellValue('F'.$fila, $segundo_apellido);
	$sheet->setCellValue('G'.$fila, $genero);
	$sheet->setCellValue('H'.$fila, $correo);
	$sheet->setCellValue('I'.$fila, "".$telefono1." ");
	$sheet->setCellValue('J'.$fila, $direccion);
	$sheet->setCellValue('K'.$fila, $estatus);
	$sheet->setCellValue('L'.$fila, $fecha_inicio);

	$fila = $fila+1;
}

$fecha_inicio1 = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('resources/documentos/pasantes/reportes/Reporte_pasantes_'.$fecha_inicio1.'.xlsx');
header("Location: resources/documentos/pasantes/reportes/Reporte_pasantes_".$fecha_inicio1.".xlsx");


?>