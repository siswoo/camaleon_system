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

$sheet->setCellValue('A1', 'Modelo');
$sheet->setCellValue('B1', 'Documento Numero');
$sheet->setCellValue('C1', 'Usuario');
$sheet->setCellValue('D1', 'Pagina');
$sheet->setCellValue('E1', 'Estatus');

$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(30);

$sql1 = "SELECT *, COUNT(*) Total FROM modelos_cuentas GROUP BY usuario HAVING COUNT(*) > 1";
$consulta = mysqli_query($conexion,$sql1);

$fila = 2;

$contador1 = 0;

while($row1 = mysqli_fetch_array($consulta)) {
	$id_mc 			= $row1['id'];
	$id_modelos 	= $row1['id_modelos'];
	$id_paginas 	= $row1['id_paginas'];
	$usuario 		= $row1['usuario'];
	$estatus 		= $row1['estatus'];
	$fecha_inicio 	= $row1['fecha_inicio'];

	echo $sql2 = "SELECT * FROM modelos_cuentas WHERE usuario = '".$usuario."' and id_paginas != ".$id_paginas." and id_modelos != ".$id_modelos;
	$consulta2 = mysqli_query($conexion,$sql2);
	echo "<br>";
	while($row2 = mysqli_fetch_array($consulta2)) {
		$contador1 = $contador1+1;
		echo "<p>".$usuario."</p>";

		/*
		$sheet->setCellValue('A'.$fila, $nombre_completo);
		$sheet->setCellValue('B'.$fila, $documento);
		$sheet->setCellValue('C'.$fila, $usuario);
		$sheet->setCellValue('D'.$fila, $pagina_nombre);
		$sheet->setCellValue('E'.$fila, $estatus);
		*/
	}


/*
	$sql2 = "SELECT * FROM modelos_cuentas WHERE usuario = '".$usuario."'";
	$consulta2 = mysqli_query($conexion,$sql2);
	while($row2 = mysqli_fetch_array($consulta2)) {
		$id_modelos = $row2['id_modelos'];
		
		$sql3 = "SELECT * FROM modelos WHERE id = ".$id_modelos;
		$consulta3 = mysqli_query($conexion,$sql3);
		while($row3 = mysqli_fetch_array($consulta3)) {
			$nombre_completo = $row3['nombre1']." ".$row3['apellido1'];
			$documento = $row3['documento_numero'];
		}

		$sql4 = "SELECT * FROM paginas WHERE id = ".$id_paginas;
		$consulta4 = mysqli_query($conexion,$sql4);
		while($row4 = mysqli_fetch_array($consulta4)) {
			$pagina_nombre = $row4['nombre'];
		}

		$sheet->setCellValue('A'.$fila, $nombre_completo);
		$sheet->setCellValue('B'.$fila, $documento);
		$sheet->setCellValue('C'.$fila, $usuario);
		$sheet->setCellValue('D'.$fila, $pagina_nombre);
		$sheet->setCellValue('E'.$fila, $estatus);

		$fila = $fila+1;
	}
*/
}

/*
$fecha_inicio = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('Cuentas Repetidas '.$fecha_inicio.'.xlsx');
header("Location: Cuentas Repetidas ".$fecha_inicio.".xlsx");
//unlink('Faltantes mixtos1 '.$fecha_inicio.'.xlsx'); //Eliminarlo para no almacenar en Nube
*/
?>