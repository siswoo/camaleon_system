<?php
require '../resources/Spreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

include('../script/conexion.php');

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Nombre');
$sheet->setCellValue('B1', 'tipo documento');
$sheet->setCellValue('C1', 'numero documento');

$sheet->setCellValue('D1', 'Chaturbate');
$sheet->setCellValue('E1', 'Myfreecams');
$sheet->setCellValue('F1', 'Camsoda');
$sheet->setCellValue('G1', 'BongaCams');
$sheet->setCellValue('H1', 'Stripchat');
$sheet->setCellValue('I1', 'Cam4');
$sheet->setCellValue('J1', 'Streamatemodels');
$sheet->setCellValue('K1', 'Flirt4free');
$sheet->setCellValue('L1', 'Livejasmin');
$sheet->setCellValue('M1', 'Imlive');
$sheet->setCellValue('N1', 'Xlovecam');

$sheet->setCellValue('O1', 'Sede');
$fila = 2;

$sql1 = "SELECT * FROM modelos";
$consulta = mysqli_query($conexion,$sql1);
while($row2 = mysqli_fetch_array($consulta)) {
	$id = $row2['id'];
	$nombre = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
	$documento_tipo = $row2['documento_tipo'];
	$documento_numero = $row2['documento_numero'];
	$sede = $row2['sede'];

	$sql2 = "SELECT * FROM sedes WHERE id =".$sede;
	$consulta2 = mysqli_query($conexion,$sql2);
	while($row3 = mysqli_fetch_array($consulta2)){
		$sede_nombre = $row3['nombre'];
	}

	$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(40);
	$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25);

	$sheet->setCellValue('A'.$fila, $nombre);
	$sheet->setCellValue('B'.$fila, $documento_tipo);
	$sheet->setCellValue('C'.$fila, $documento_numero);
	$sheet->setCellValue('O'.$fila, $sede_nombre);

	$html1 = "";
	$html2 = "";
	$html3 = "";
	$html4 = "";
	$html5 = "";
	$html6 = "";
	$html7 = "";
	$html8 = "";
	$html9 = "";
	$html10 = "";
	$html11 = "";

	$sql3 = "SELECT * FROM modelos_cuentas WHERE id_modelos =".$id;
	$consulta3 = mysqli_query($conexion,$sql3);
	while($row4 = mysqli_fetch_array($consulta3)){
		$id_paginas = $row4['id_paginas'];
		$usuario = $row4['usuario'];

		switch ($id_paginas) {
			case 1:
				//$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(25);
				//$sheet->setCellValue('D'.$fila, $usuario);
				$html1 .= $usuario." ";
			break;

			case 2:
				//$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(25);
				//$sheet->setCellValue('E'.$fila, $usuario);
				$html2 .= $usuario." ";
			break;

			case 3:
				//$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(25);
				//$sheet->setCellValue('F'.$fila, $usuario);
				$html3 .= $usuario." ";
			break;

			case 4:
				//$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(25);
				//$sheet->setCellValue('G'.$fila, $usuario);
				$html4 .= $usuario." ";
			break;

			case 5:
				//$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(25);
				//$sheet->setCellValue('H'.$fila, $usuario);
				$html5 .= $usuario." ";
			break;

			case 6:
				//$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(25);
				//$sheet->setCellValue('I'.$fila, $usuario);
				$html6 .= $usuario." ";
			break;

			case 7:
				//$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(25);
				//$sheet->setCellValue('J'.$fila, $usuario);
				$html7 .= $usuario." ";
			break;

			case 8:
				//$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(25);
				//$sheet->setCellValue('K'.$fila, $usuario);
				$html8 .= $usuario." ";
			break;

			case 9:
				//$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(25);
				//$sheet->setCellValue('L'.$fila, $usuario);
				$html9 .= $usuario." ";
			break;

			case 10:
				//$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(25);
				//$sheet->setCellValue('M'.$fila, $usuario);
				$html10 .= $usuario." ";
			break;

			case 11:
				//$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(25);
				//$sheet->setCellValue('N'.$fila, $usuario);
				$html11 .= $usuario." ";
			break;
			
			default:
				# code...
				break;
		}

	}

	$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(25);
	$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(25);
	$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(25);
	$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(25);
	$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(25);
	$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(25);
	$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(25);
	$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(25);
	$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(25);
	$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(25);
	$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(25);

	$sheet->setCellValue('D'.$fila, $html1);
	$sheet->setCellValue('E'.$fila, $html2);
	$sheet->setCellValue('F'.$fila, $html3);
	$sheet->setCellValue('G'.$fila, $html4);
	$sheet->setCellValue('H'.$fila, $html5);
	$sheet->setCellValue('I'.$fila, $html6);
	$sheet->setCellValue('J'.$fila, $html7);
	$sheet->setCellValue('K'.$fila, $html8);
	$sheet->setCellValue('L'.$fila, $html9);
	$sheet->setCellValue('M'.$fila, $html10);
	$sheet->setCellValue('N'.$fila, $html11);

	/*
	$spreadsheet->getActiveSheet()->getCell('B'.$fila)->setValue($numero_documento);
	$spreadsheet->getActiveSheet()->getStyle('B'.$fila)->getNumberFormat()->setFormatCode('00');
	*/

	$fila = $fila+1;
}

$fecha_inicio = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('Reporte de Cuentas '.$fecha_inicio.'.xlsx');
header("Location: Reporte de Cuentas ".$fecha_inicio.".xlsx");
?>