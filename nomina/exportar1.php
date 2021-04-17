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

$sheet->setCellValue('A1', 'Nombre');
$sheet->setCellValue('B1', 'Apellido');
$sheet->setCellValue('C1', 'Documento Tipo');
$sheet->setCellValue('D1', 'Documento Numero');
$sheet->setCellValue('E1', 'Estatus');
$sheet->setCellValue('F1', 'Titular Cedula');
$sheet->setCellValue('G1', 'Titular Nombre');
$sheet->setCellValue('H1', 'Banco');
$sheet->setCellValue('I1', 'Propia Prestada');
$sheet->setCellValue('J1', 'Numero de Cuenta');
$sheet->setCellValue('K1', 'Sede');
$sheet->setCellValue('L1', 'Cargo');
$sheet->setCellValue('M1', 'Salario');
$sheet->setCellValue('N1', 'Fecha de Nacimiento');
$sheet->setCellValue('O1', 'Sede');
$sheet->setCellValue('P1', 'Dirección');
$sheet->setCellValue('Q1', 'Teléfono');
$sheet->setCellValue('R1', 'Fecha Retiro');
$sheet->setCellValue('S1', 'Fecha Ingreso');

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
$spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth(20);

$fila = 2;
$sql2 = "SELECT * FROM nomina";
$consulta2 = mysqli_query($conexion,$sql2);
$contador1 = mysqli_num_rows($consulta2);
while($row2 = mysqli_fetch_array($consulta2)) {
	$nombre = $row2['nombre'];
	$apellido = $row2['apellido'];
	$documento_tipo = $row2['documento_tipo'];
	$documento_numero = $row2['documento_numero'];
	$estatus = $row2['estatus'];
	$banco_cedula = $row2['banco_cedula'];
	$banco_nombre = $row2['banco_nombre'];
	$banco_banco = $row2['banco_banco'];
	$banco_numero = $row2['banco_numero'];
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

	$sheet->setCellValue('A'.$fila, $nombre);
	$sheet->setCellValue('B'.$fila, $apellido);
	$sheet->setCellValue('C'.$fila, $documento_tipo);
	$sheet->setCellValue('D'.$fila, $documento_numero);
	$sheet->setCellValue('E'.$fila, $estatus);
	$sheet->setCellValue('F'.$fila, $banco_cedula);
	$sheet->setCellValue('G'.$fila, $banco_nombre);
	$sheet->setCellValue('H'.$fila, $banco_banco);
	$sheet->setCellValue('I'.$fila, $bcpp);
	$sheet->setCellValue('J'.$fila, $banco_numero);

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

	$sheet->setCellValue('K'.$fila, $sede_nombre);
	$sheet->setCellValue('L'.$fila, $cargo_nombre);
	$sheet->setCellValue('M'.$fila, $salario);
	$sheet->setCellValue('N'.$fila, $fecha_nacimiento);
	$sheet->setCellValue('O'.$fila, $turno);
	$sheet->setCellValue('P'.$fila, $direccion);
	$sheet->setCellValue('Q'.$fila, $telefono);
	$sheet->setCellValue('R'.$fila, $fecha_retiro);
	$sheet->setCellValue('S'.$fila, $fecha_ingreso);
	$fila = $fila+1;

}

$fecha_inicio = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('Reporte de Nomina '.$fecha_inicio.'.xlsx');
header("Location: Reporte de Nomina ".$fecha_inicio.".xlsx");


?>