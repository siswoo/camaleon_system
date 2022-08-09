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

$sheet->setCellValue('A1', 'Tabla Auxiliar - Terceros');
$sheet->setCellValue('A2', 'Autonumerico');
$sheet->setCellValue('B2', 'IdTipoIdentificacion');
$sheet->setCellValue('C2', 'Identificacion');
$sheet->setCellValue('D2', 'DV');

$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(30);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);

$fila = 1;

$sql1 = "SELECT * FROM modelos WHERE turno = 'Satelite'";
$consulta1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($consulta1)) {
	$nombre = $row1['nombre1']." ".$row1['nombre2']." ".$row1['apellido1']." ".$row1['apellido2'];
	$documento_tipo = $row1['documento_tipo'];
	$documento_numero = $row1['documento_numero'];
	$sede = $row1['sede'];

	$sql2 = "SELECT * FROM sedes WHERE id = ".$sede;
	$proceso2 = mysqli_query($conexion,$sql2);
	$contador2 = mysqli_num_rows($proceso2);
	if($contador2==0){
		$sede_nombre = "Desconocido";
	}else{
		while($row2 = mysqli_fetch_array($proceso2)) {
			$sede_nombre = $row2["nombre"];
		}
	}
	
	$sheet->setCellValue('A'.$fila, $nombre);
	$sheet->setCellValue('B'.$fila, $documento_tipo);
	$sheet->setCellValue('C'.$fila, $documento_numero);
	$sheet->setCellValue('D'.$fila, $sede_nombre);

	$fila = $fila+1;
}


$fecha_inicio = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('Satelites '.$fecha_inicio.'.xlsx');
header("Location: Satelites ".$fecha_inicio.".xlsx");


?>