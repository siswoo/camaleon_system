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

$sheet->setCellValue('A1', '');
$sheet->setCellValue('B1', 'Tipo de Documento Titular');
$sheet->setCellValue('C1', 'C Titular');
$sheet->setCellValue('D1', '');
$sheet->setCellValue('E1', 'Numero de Cuenta');
$sheet->setCellValue('F1', 'Banco');
$sheet->setCellValue('G1', 'Nombre');
$sheet->setCellValue('H1', '');
$sheet->setCellValue('I1', '');
$sheet->setCellValue('J1', '');
$sheet->setCellValue('K1', '');
$sheet->setCellValue('L1', 'Salario');
$sheet->setCellValue('M1', '');
$sheet->setCellValue('N1', '');
$sheet->setCellValue('O1', 'Nombre');
$sheet->setCellValue('P1', 'Sede');

/***************LIBRERIA DE ACENTOS*****************/
function eliminar_acentos($cadena){
	$cadena = str_replace(
		array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
		array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
		$cadena
	);
	$cadena = str_replace(
		array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
		array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
	$cadena );
	$cadena = str_replace(
		array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
		array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
	$cadena );
	$cadena = str_replace(
		array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
		array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
	$cadena );
	$cadena = str_replace(
		array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
		array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
	$cadena );
	return $cadena;
}
/************************************************************/

$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
//$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(30);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(20);
//$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(40);

$fila = 2;
$sql2 = "SELECT * FROM nomina";
$consulta2 = mysqli_query($conexion,$sql2);
$contador1 = mysqli_num_rows($consulta2);
while($row2 = mysqli_fetch_array($consulta2)) {
	$id = $row2['id'];
	$nombre = $row2['nombre'];
	$apellido = $row2['apellido'];
	$documento_tipo = $row2['documento_tipo'];
	$documento_numero = $row2['documento_numero'];
	$estatus = $row2['estatus'];
	$banco_cedula = $row2['banco_cedula'];
	$banco_nombre = $row2['banco_nombre'];
	$banco_banco = $row2['banco_banco'];
	$banco_numero = $row2['banco_numero'];
	$banco_tipo = $row2['banco_tipo'];
	$bcpp = $row2['BCPP'];
	$turno = $row2['turno'];
	$sede = $row2['sede'];
	$cargo = $row2['cargo'];
	$salario = $row2['salario'];
	$fecha_nacimiento = $row2['fecha_nacimiento'];
	$direccion = $row2['direccion'];
	$telefono = $row2['telefono'];
	$fecha_retiro = $row2['fecha_retiro'];
	$fecha_ingreso = $row2['fecha_ingreso'];

	if($banco_tipo=='Ahorro'){
		$banco_tipo = "02-Ahorros";
	}else{
		$banco_tipo = "01-Corriente";
	}

	$sheet->setCellValue('A'.$fila, "Ok");
	$sheet->setCellValue('B'.$fila, $banco_tipo);
	$sheet->setCellValue('C'.$fila, $banco_cedula);
	$sheet->setCellValue('D'.$fila, $banco_tipo);
	$sheet->setCellValue('E'.$fila, $banco_numero);
	$sheet->setCellValue('F'.$fila, $banco_banco);
	$sheet->setCellValue('G'.$fila, $banco_nombre);
	$sheet->setCellValue('H'.$fila, "Bogota");
	$sheet->setCellValue('I'.$fila, "");
	$sheet->setCellValue('J'.$fila, "1-Abono en Cuenta");

	$sql3 = "SELECT * FROM sedes WHERE id = ".$sede;
	$consulta3 = mysqli_query($conexion,$sql3);
	while($row3 = mysqli_fetch_array($consulta3)) {
		$sede_nombre = $row3["nombre"];
	}

	$sql4 = "SELECT * FROM cargos WHERE id = ".$cargo;
	$consulta4 = mysqli_query($conexion,$sql4);
	while($row4 = mysqli_fetch_array($consulta4)) {
		$cargo_nombre = $row4["nombre"];
	}

	$sheet->setCellValue('K'.$fila, "");
	$sheet->setCellValue('L'.$fila, $salario);
	$sheet->setCellValue('M'.$fila, "");
	$sheet->setCellValue('N'.$fila, $documento_numero);
	$sheet->setCellValue('O'.$fila, $nombre." ".$apellido);
	$sheet->setCellValue('P'.$fila, $sede_nombre);

	$fila = $fila+1;
}

$fecha_inicio = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('Reporte de Nomina '.$fecha_inicio.'.xlsx');
header("Location: Reporte de Nomina ".$fecha_inicio.".xlsx");


?>