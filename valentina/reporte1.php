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
$sheet->setCellValue('B1', 'Identidad Tipo');
$sheet->setCellValue('C1', 'Identidad Numero');

/***************LIBRERIA DE ACENTOS*****************/
function eliminar_acentos($cadena){
		
	//Reemplazamos la A y a
	$cadena = str_replace(
		array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
		array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
		$cadena
	);

	//Reemplazamos la E y e
	$cadena = str_replace(
		array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
		array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
	$cadena );

	//Reemplazamos la I y i
	$cadena = str_replace(
		array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
		array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
	$cadena );

	//Reemplazamos la O y o
	$cadena = str_replace(
		array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
		array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
	$cadena );

	//Reemplazamos la U y u
	$cadena = str_replace(
		array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
		array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
	$cadena );

	//Reemplazamos la N, n, C y c
	/*
	$cadena = str_replace(
		array('Ñ', 'ñ', 'Ç', 'ç'),
		array('N', 'n', 'C', 'c'),
	$cadena );
	*/
	return $cadena;
}
/************************************************************/

$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(30);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);

$fila = 2;

$sql1 = "SELECT * FROM modelos WHERE sede = 6 and estatus = 'Inactiva'";
$consulta1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($consulta1)) {
	$nombre = $row1['nombre1']." ".$row1['nombre2']." ".$row1['apellido1']." ".$row1['apellido2'];
	$documento_tipo = $row1['documento_tipo'];
	$documento_numero = $row1['documento_numero'];

	$sheet->setCellValue('A'.$fila, $nombre);
	$sheet->setCellValue('B'.$fila, $documento_tipo);
	$sheet->setCellValue('C'.$fila, $documento_numero);

	$fila = $fila+1;
}

$fecha_inicio = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('Inactivos Soacha '.$fecha_inicio.'.xlsx');
header("Location: Inactivos Soacha ".$fecha_inicio.".xlsx");


?>