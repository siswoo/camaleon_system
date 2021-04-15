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
$sheet->setCellValue('A1', 'Modelo');
$sheet->setCellValue('B1', 'tipo documento');
$sheet->setCellValue('C1', 'numero documento');
$sheet->setCellValue('D1', 'Sede');
$sheet->setCellValue('E1', 'Usuario');
$sheet->setCellValue('F1', 'Pagina');
$fila = 2;

$sql1 = "SELECT id_modelos,usuario,count(usuario) c FROM modelos_cuentas group by usuario having c >1";
$consulta = mysqli_query($conexion,$sql1);
while($row2 = mysqli_fetch_array($consulta)) {
	$usuarior1 = $row2["usuario"];
	$sql3 = "SELECT * FROM modelos_cuentas WHERE usuario = '".$usuarior1."' GROUP BY id_modelos";
	$proceso3 = mysqli_query($conexion,$sql3);
	$contador3 = mysqli_num_rows($proceso3);
	if($contador3>=2){
		while($row3 = mysqli_fetch_array($proceso3)){
			$id_modelos = $row3["id_modelos"];
			$id_paginas = $row3["id_paginas"];

			$sql4 = "SELECT * FROM modelos WHERE id = ".$id_modelos;
			$proceso4 = mysqli_query($conexion,$sql4);
			while($row4 = mysqli_fetch_array($proceso4)){
				$modelo_nombre = $row4['nombre1']." ".$row4['nombre2']." ".$row4['apellido1']." ".$row4['apellido2'];
				$documento_tipo = $row4['documento_tipo'];
				$documento_numero = $row4['documento_numero'];
				$sede = $row4['sede'];
			}

			if($sede=="" or $sede==0){
				$sede_nombre = "Desconocido";
			}else{
				$sql5 = "SELECT * FROM sedes WHERE id =".$sede;
				$proceso5 = mysqli_query($conexion,$sql5);
				while($row5 = mysqli_fetch_array($proceso5)){
					$sede_nombre = $row5['nombre'];
				}
			}

			$sql6 = "SELECT * FROM paginas WHERE id = ".$id_paginas;
			$proceso6 = mysqli_query($conexion,$sql6);
			while($row6 = mysqli_fetch_array($proceso6)){
				$pagina_nombre = $row6['nombre'];
			}

			$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(40);
			$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25);
			$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(25);
			$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(25);
			$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(25);

			$sheet->setCellValue('A'.$fila, $modelo_nombre);
			$sheet->setCellValue('B'.$fila, $documento_tipo);
			$sheet->setCellValue('C'.$fila, $documento_numero);
			$sheet->setCellValue('D'.$fila, $sede_nombre);
			$sheet->setCellValue('E'.$fila, $usuarior1);
			$sheet->setCellValue('F'.$fila, $pagina_nombre);

			$fila = $fila+1;
		}
	}
}

$fecha_inicio = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('Cuentas Repetidas '.$fecha_inicio.'.xlsx');
header("Location: Cuentas Repetidas ".$fecha_inicio.".xlsx");
?>