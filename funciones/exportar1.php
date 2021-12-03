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
$sheet->setCellValue('B1', 'Descripción 1');
$sheet->setCellValue('C1', 'Descripción 2');
$sheet->setCellValue('D1', 'Descripción 3');
$sheet->setCellValue('E1', 'Descripción 4');
$sheet->setCellValue('F1', 'Descripción 5');
$sheet->setCellValue('G1', 'Descripción 6');
$sheet->setCellValue('H1', 'Descripción 7');
$sheet->setCellValue('I1', 'Descripción 8');
$sheet->setCellValue('J1', 'Descripción 9');
$sheet->setCellValue('K1', 'Descripción 10');
$sheet->setCellValue('L1', 'Descripción 11');
$sheet->setCellValue('M1', 'Descripción 12');
$sheet->setCellValue('N1', 'Descripción 13');
$sheet->setCellValue('O1', 'Descripción 14');
$sheet->setCellValue('P1', 'Descripción 15');

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
$sql2 = "SELECT * FROM funciones";
$consulta2 = mysqli_query($conexion,$sql2);
$contador1 = mysqli_num_rows($consulta2);
while($row2 = mysqli_fetch_array($consulta2)) {
	$nombre = $row2['nombre'];
	$descripcion1 = $row2['descripcion1'];
	$descripcion2 = $row2['descripcion2'];
	$descripcion3 = $row2['descripcion3'];
	$descripcion4 = $row2['descripcion4'];
	$descripcion5 = $row2['descripcion5'];
	$descripcion6 = $row2['descripcion6'];
	$descripcion7 = $row2['descripcion7'];
	$descripcion8 = $row2['descripcion8'];
	$descripcion9 = $row2['descripcion9'];
	$descripcion10 = $row2['descripcion10'];
	$descripcion11 = $row2['descripcion11'];
	$descripcion12 = $row2['descripcion12'];
	$descripcion13 = $row2['descripcion13'];
	$descripcion14 = $row2['descripcion14'];
	$descripcion15 = $row2['descripcion15'];

	$sheet->setCellValue('A'.$fila, $nombre);
	$sheet->setCellValue('B'.$fila, $descripcion1);
	$sheet->setCellValue('C'.$fila, $descripcion2);
	$sheet->setCellValue('D'.$fila, $descripcion3);
	$sheet->setCellValue('E'.$fila, $descripcion4);
	$sheet->setCellValue('F'.$fila, $descripcion5);
	$sheet->setCellValue('G'.$fila, $descripcion6);
	$sheet->setCellValue('H'.$fila, $descripcion7);
	$sheet->setCellValue('I'.$fila, $descripcion8);
	$sheet->setCellValue('J'.$fila, $descripcion9);
	$sheet->setCellValue('K'.$fila, $descripcion10);
	$sheet->setCellValue('L'.$fila, $descripcion11);
	$sheet->setCellValue('M'.$fila, $descripcion12);
	$sheet->setCellValue('N'.$fila, $descripcion13);
	$sheet->setCellValue('O'.$fila, $descripcion14);
	$sheet->setCellValue('P'.$fila, $descripcion15);
	$fila = $fila+1;

}

$fecha_inicio = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('Reporte de Funciones '.$fecha_inicio.'.xlsx');
header("Location: Reporte de Funciones ".$fecha_inicio.".xlsx");


?>