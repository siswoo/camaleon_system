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

$sheet->setCellValue('A1', 'Nombre Completo');
$sheet->setCellValue('B1', 'Sede Registrado');
$fila = 2;

$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);

$sql1 = "SELECT * FROM modelos WHERE estatus = 'Activa' ORDER BY sede";
$consulta = mysqli_query($conexion,$sql1);
$contador2 = 0;
while($row1 = mysqli_fetch_array($consulta)) {
	$id_modelo = $row1['id'];
	$nombre_modelo = $row1['nombre1']." ".$row1['nombre2']." ".$row1['apellido1']." ".$row1['apellido2'];
	$sede = $row1['sede'];

	$sql2 = "SELECT * FROM modelos_cuentas WHERE id_modelos = ".$id_modelo;
	$consulta2 = mysqli_query($conexion,$sql2);
	$contador1 = mysqli_num_rows($consulta2);
	
	if($contador1>=1){

		$sql3 = "SELECT * FROM sedes WHERE id =".$sede;
		$consulta3 = mysqli_query($conexion,$sql3);
		while($row3 = mysqli_fetch_array($consulta3)){
			$sede_nombre = $row3['nombre'];
		}
	}else{
		$sheet->setCellValue('A'.$fila, $nombre_modelo);
		$sheet->setCellValue('B'.$fila, $sede_nombre);
		$fila = $fila + 1;
	}
}

$fecha_inicio = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('Modelos sin cuentas '.$fecha_inicio.'.xlsx');
header("Location: Modelos sin cuentas ".$fecha_inicio.".xlsx");

?>