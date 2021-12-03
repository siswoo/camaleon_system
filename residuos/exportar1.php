<?php
require '../resources/Spreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

include('../script/conexion.php');

$sede = $_GET["sede"];
$presabana = $_GET["presabana"];

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Modelo');
$sheet->setCellValue('B1', 'tipo documento');
$sheet->setCellValue('C1', 'numero documento');
$sheet->setCellValue('D1', 'Sede');
$sheet->setCellValue('E1', '');
$sheet->setCellValue('F1', 'Imlive');
$sheet->setCellValue('G1', 'Xlove');
$sheet->setCellValue('H1', 'Chaturbate');
$sheet->setCellValue('I1', 'Stripchat');
$sheet->setCellValue('J1', 'Streamate');
$sheet->setCellValue('K1', 'Myfreecams');
$sheet->setCellValue('L1', 'LiveJasmin');
$sheet->setCellValue('M1', 'Bonga');
$sheet->setCellValue('N1', 'Cam4');
$sheet->setCellValue('O1', 'Camsoda');
$sheet->setCellValue('P1', 'Flirt4free');
$fila = 2;

$sql1 = "SELECT * FROM presabana_inactivos WHERE id = ".$presabana;
$proceso1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($proceso1)) {
	$inicio = $row1["inicio"];
	$fin = $row1["fin"];
	
	$sql2 = "SELECT * FROM presabana_inactivos WHERE inicio BETWEEN '".$inicio."' AND '".$fin."' and fin BETWEEN '".$inicio."' AND '".$fin."'";
	$proceso2 = mysqli_query($conexion,$sql2);
	while($row2 = mysqli_fetch_array($proceso2)) {
		$id_modelo = $row2["id_modelo"];
		$imlive = $row2["imlive"];
		$xlove = $row2["xlove"];
		$chaturbate = $row2["chaturbate"];
		$stripchat = $row2["stripchat"];
		$streamate = $row2["streamate"];
		$myfreecams = $row2["myfreecams"];
		$livejasmin = $row2["livejasmin"];
		$bonga = $row2["bonga"];
		$cam4 = $row2["cam4"];
		$camsoda = $row2["camsoda"];
		$flirt4free = $row2["flirt4free"];
	}

	$sql2 = "SELECT * FROM modelos WHERE id = '".$id_modelo;
	$proceso2 = mysqli_query($conexion,$sql2);
	while($row2 = mysqli_fetch_array($proceso2)){
		$modelo_nombre = $row2["nombre1"]." ".$row2["nombre2"]." ".$row2["apellido1"]." ".$row2["apellido2"];
		$documento_tipo = $row2['documento_tipo'];
		$documento_numero = $row2['documento_numero'];
		$sede = $row2['sede'];

		if($sede=="" or $sede==0){
			$sede_nombre = "Desconocido";
		}else{
			$sql5 = "SELECT * FROM sedes WHERE id =".$sede;
			$proceso5 = mysqli_query($conexion,$sql5);
			while($row5 = mysqli_fetch_array($proceso5)){
				$sede_nombre = $row5['nombre'];
			}
		}

		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(40);
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25);
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
		$spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(25);
		$spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(25);

		$sheet->setCellValue('A'.$fila, $modelo_nombre);
		$sheet->setCellValue('B'.$fila, $documento_tipo);
		$sheet->setCellValue('C'.$fila, $documento_numero);
		$sheet->setCellValue('D'.$fila, $sede_nombre);
		$sheet->setCellValue('E'.$fila, "");
		$sheet->setCellValue('F'.$fila, $imlive);
		$sheet->setCellValue('G'.$fila, $xlove);
		$sheet->setCellValue('H'.$fila, $chaturbate);
		$sheet->setCellValue('I'.$fila, $stripchat);
		$sheet->setCellValue('J'.$fila, $streamate);
		$sheet->setCellValue('K'.$fila, $myfreecams);
		$sheet->setCellValue('L'.$fila, $livejasmin);
		$sheet->setCellValue('M'.$fila, $bonga);
		$sheet->setCellValue('N'.$fila, $cam4);
		$sheet->setCellValue('O'.$fila, $camsoda);
		$sheet->setCellValue('P'.$fila, $flirt4free);

		$fila = $fila+1;
		}
	}
}

$fecha_inicio = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('Presabana Inactivos '.$fecha_inicio.'.xlsx');
header("Location: Presabana Inactivos ".$fecha_inicio.".xlsx");
?>