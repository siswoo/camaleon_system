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
$sheet->setCellValue('B2', 'Apellido');
$sheet->setCellValue('C2', 'Documento Tipo');
$sheet->setCellValue('D2', 'Documento Numero');
$sheet->setCellValue('E2', 'Estatus');
$sheet->setCellValue('F2', 'Titular Cedula');
$sheet->setCellValue('G2', 'Titular Nombre');
$sheet->setCellValue('H2', 'Banco');
$sheet->setCellValue('I2', 'Propia Prestada');
$sheet->setCellValue('J2', 'Turno');
$sheet->setCellValue('K2', 'Sede');
$sheet->setCellValue('L2', 'Cargo');
$sheet->setCellValue('M2', 'Salario');
$sheet->setCellValue('N2', 'Fecha de Nacimiento');

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

//$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);

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
	$bcpp = $row2['BCPP'];
	$turno = $row2['turno'];
	$sede = $row2['sede'];
	$cargo = $row2['cargo'];
	$salario = $row2['salario'];
	$fecha_nacimiento = $row2['fecha_nacimiento'];

	$sheet->setCellValue('A'.$fila, $nombre);
	$sheet->setCellValue('B'.$fila, $apellido);
	$sheet->setCellValue('C'.$fila, $documento_tipo);
	$sheet->setCellValue('D'.$fila, $documento_numero);
	$sheet->setCellValue('E'.$fila, $estatus);
	$sheet->setCellValue('F'.$fila, $banco_cedula);
	$sheet->setCellValue('G'.$fila, $banco_nombre);
	$sheet->setCellValue('H'.$fila, $banco_banco);
	$sheet->setCellValue('I'.$fila, $bcpp);
	$sheet->setCellValue('J'.$fila, $turno);
	$sheet->setCellValue('K'.$fila, $sede);
	$sheet->setCellValue('L'.$fila, $cargo);
	$sheet->setCellValue('M'.$fila, $salario);
	$sheet->setCellValue('N'.$fila, $fecha_nacimiento);
	$fila = $fila+1;

}

$fecha_inicio = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('Reporte de Nomina '.$fecha_inicio.'.xlsx');
header("Location: Reporte de Nomina ".$fecha_inicio.".xlsx");


?>