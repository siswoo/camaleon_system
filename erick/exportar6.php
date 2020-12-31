<?php
require '../resources/Spreadsheet/autoload.php';

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

include('../script/conexion.php');

$inicio = $_GET['inicio'];
$fin = $_GET['fin'];

$sheet->setCellValue('A1', 'Nombre Completo');
$sheet->setCellValue('B1', 'Tipo Documento');
$sheet->setCellValue('C1', 'Numero Documento');
$sheet->setCellValue('D1', 'Sede Registrado');
$sheet->setCellValue('E1', 'Cuenta P/P');
$sheet->setCellValue('F1', 'Numero cedula titular');
$sheet->setCellValue('G1', 'Nombre titular');
$sheet->setCellValue('H1', 'Tipo de cuenta');
$sheet->setCellValue('I1', 'Numero de cuenta');
$sheet->setCellValue('J1', 'Banco');
$fila = 2;

/*
$sql1 = "SELECT * FROM modelos WHERE estatus = 'Activa' and banco_cedula != '' ORDER BY sede";
*/
$sql1 = "SELECT * FROM presabana WHERE inicio BETWEEN '".$inicio."' AND '".$fin."' and fin BETWEEN '".$inicio."' AND '".$fin."' and total_dolares >=1";
$consulta = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($consulta)) {
	$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(40);
	$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(40);
	$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(40);
	$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(40);
	$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(40);

	$id_modelo = $row1['id_modelo'];

	$sql3 = "SELECT * FROM modelos WHERE id = ".$id_modelo;
	$consulta3 = mysqli_query($conexion,$sql3);
	while($row3 = mysqli_fetch_array($consulta3)) {
		$nombre_modelo = $row3['nombre1']." ".$row3['nombre2']." ".$row3['apellido1']." ".$row3['apellido2'];
		$tipo_documento = $row3['documento_tipo'];
		$numero_documento = $row3['documento_numero'];
		$id_sede = $row3['sede'];
		$banco_cedula = $row3['banco_cedula'];
		$banco_nombre = $row3['banco_nombre'];
		$banco_tipo = $row3['banco_tipo'];
		$banco_numero = $row3['banco_numero'];
		$banco_banco = $row3['banco_banco'];
		$bcpp = $row3['BCPP'];
	}

	$sql2 = "SELECT * FROM sedes WHERE id = ".$id_sede;
	$consulta2 = mysqli_query($conexion,$sql2);
	while($row2 = mysqli_fetch_array($consulta2)) {
		$nombre_sede = $row2['nombre'];
	}

	$sheet->setCellValue('A'.$fila, $nombre_modelo);
	$spreadsheet->getActiveSheet()->getCell('B'.$fila)->setValue($tipo_documento);
	$spreadsheet->getActiveSheet()->getCell('C'.$fila)->setValue($numero_documento);
	$spreadsheet->getActiveSheet()->getStyle('C'.$fila)->getNumberFormat()->setFormatCode('00');
	//$sheet->setCellValue('B'.$fila, $numero_documento);
	$sheet->setCellValue('D'.$fila, $nombre_sede);
	$sheet->setCellValue('E'.$fila, $bcpp);
	$spreadsheet->getActiveSheet()->getCell('F'.$fila)->setValue($banco_cedula);
	$spreadsheet->getActiveSheet()->getStyle('G'.$fila)->getNumberFormat()->setFormatCode('00');
	//$sheet->setCellValue('E'.$fila, $banco_cedula);
	$sheet->setCellValue('G'.$fila, $banco_nombre);
	$sheet->setCellValue('H'.$fila, $banco_tipo);
	$spreadsheet->getActiveSheet()->getCell('I'.$fila)->setValue($banco_numero);
	$spreadsheet->getActiveSheet()->getStyle('I'.$fila)->getNumberFormat()->setFormatCode('00');
	//$sheet->setCellValue('H'.$fila, $banco_numero);
	$sheet->setCellValue('J'.$fila, $banco_banco);

	$fila = $fila+1;

}


$fecha_inicio = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('Registro de Banco '.$fecha_inicio.'.xlsx');
header("Location: Registro de Banco ".$fecha_inicio.".xlsx");

?>