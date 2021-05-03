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
$sheet->setCellValue('E1', 'Chaturbate');
$sheet->setCellValue('F1', 'Chaturbate');
$sheet->setCellValue('G1', 'Chaturbate');
$sheet->setCellValue('H1', 'Myfreecams');
$sheet->setCellValue('I1', 'Camsoda');
$sheet->setCellValue('J1', 'BongaCams');
$sheet->setCellValue('K1', 'Stripchat');
$sheet->setCellValue('L1', 'Stripchat');
$sheet->setCellValue('M1', 'Cam4');
$sheet->setCellValue('N1', 'Streamatemodels');
$sheet->setCellValue('O1', 'Flirt4free');
$sheet->setCellValue('P1', 'Livejasmin');
$sheet->setCellValue('Q1', 'Imlive');
$sheet->setCellValue('R1', 'Xlovecam');
$sheet->setCellValue('S1', 'Estatus');
$fila = 2;

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
$spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(25);


$sql1 = "SELECT * FROM modelos";
$proceso1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($proceso1)) {
	$id_modelos = $row1["id"];
	$modelo_nombre = $row1['nombre1']." ".$row1['nombre2']." ".$row1['apellido1']." ".$row1['apellido2'];
	$documento_tipo = $row1['documento_tipo'];
	$documento_numero = $row1['documento_numero'];
	$sede = $row1['sede'];
	$estatus = $row1['estatus'];
	
	$sql2 = "SELECT * FROM modelos_cuentas WHERE id_modelos = ".$id_modelos;
	$proceso2 = mysqli_query($conexion,$sql2);
	$contador2 = mysqli_num_rows($proceso2);
	
	$contadorp1 = 0;
	$chaturbate1 = "";
	$chaturbate2 = "";
	$chaturbate3 = "";

	$contadorp2 = 0;
	$myfreecams = "";

	$contadorp3 = 0;
	$camsoda = "";

	$contadorp4 = 0;
	$bongacams = "";

	$contadorp5 = 0;
	$stripchat1 ="";
	$stripchat2 ="";

	$contadorp6 = 0;
	$cam4 = "";

	$contadorp7 = 0;
	$streamatemodels = "";

	$contadorp8 = 0;
	$flirt4free = "";

	$contadorp9 = 0;
	$livejasmin = "";

	$contadorp10 = 0;
	$imlive = "";

	$contadorp11 = 0;
	$xlovecam = "";

	if($contador2>=1){
		while($row2 = mysqli_fetch_array($proceso2)){
			$id_modelos = $row2["id_modelos"];
			$id_paginas = $row2["id_paginas"];
			$usuario1 = $row2["usuario"];

			if($sede=="" or $sede==0){
				$sede_nombre = "Desconocido";
			}else{
				$sql4 = "SELECT * FROM sedes WHERE id =".$sede;
				$proceso4 = mysqli_query($conexion,$sql4);
				while($row4 = mysqli_fetch_array($proceso4)){
					$sede_nombre = $row4['nombre'];
				}
			}

			switch ($id_paginas) {
				case 1:
					$contadorp1 = $contadorp1+1;
					if($contadorp1==1){
						$chaturbate1 = $usuario1;
					}else if($contadorp1==2){
						$chaturbate2 = $usuario1;
					}else if($contadorp1==3){
						$chaturbate3 = $usuario1;
					}
				break;

				case 2:
					$contadorp2 = $contadorp2+1;
					if($contadorp2==1){
						$myfreecams = $usuario1;
					}
				break;

				case 3:
					$contadorp3 = $contadorp3+1;
					if($contadorp3==1){
						$camsoda = $usuario1;
					}
				break;

				case 4:
					$contadorp4 = $contadorp4+1;
					if($contadorp4==1){
						$bongacams = $usuario1;
					}
				break;

				case 5:
					$contadorp5 = $contadorp5+1;
					if($contadorp5==1){
						$stripchat1 = $usuario1;
					}else if($contadorp5==2){
						$stripchat2 = $usuario1;
					}
				break;

				case 6:
					$contadorp6 = $contadorp6+1;
					if($contadorp6==1){
						$cam4 = $usuario1;
					}
				break;

				case 7:
					$contadorp7 = $contadorp7+1;
					if($contadorp7==1){
						$streamatemodels = $usuario1;
					}
				break;

				case 8:
					$contadorp8 = $contadorp8+1;
					if($contadorp8==1){
						$flirt4free = $usuario1;
					}
				break;

				case 9:
					$contadorp9 = $contadorp9+1;
					if($contadorp9==1){
						$livejasmin = $usuario1;
					}
				break;

				case 10:
					$contadorp10 = $contadorp10+1;
					if($contadorp10==1){
						$imlive = $usuario1;
					}
				break;

				case 11:
					$contadorp11 = $contadorp11+1;
					if($contadorp11==1){
						$xlovecam = $row2["nickname_xlove"];
					}
				break;

				default:
					# code...
				break;
			}

			$sheet->setCellValue('A'.$fila, strtolower($modelo_nombre));
			$sheet->setCellValue('B'.$fila, strtolower($documento_tipo));
			$sheet->setCellValue('C'.$fila, strtolower($documento_numero));
			$sheet->setCellValue('D'.$fila, strtolower($sede_nombre));
			
			if($contadorp1==1){
				$sheet->setCellValue('E'.$fila, strtolower($chaturbate1));
			}else if($contadorp1==2){
				$sheet->setCellValue('F'.$fila, strtolower($chaturbate2));
			}else if($contadorp1==3){
				$sheet->setCellValue('G'.$fila, strtolower($chaturbate3));
			}

			if($contadorp2==1){
				$sheet->setCellValue('H'.$fila, strtolower($myfreecams));
			}

			if($contadorp3==1){
				$sheet->setCellValue('I'.$fila, strtolower($camsoda));
			}

			if($contadorp4==1){
				$sheet->setCellValue('J'.$fila, strtolower($bongacams));
			}

			if($contadorp5==1){
				$sheet->setCellValue('K'.$fila, strtolower($stripchat1));
			}else if($contadorp5==2){
				$sheet->setCellValue('L'.$fila, strtolower($stripchat2));
			}

			if($contadorp6==1){
				$sheet->setCellValue('M'.$fila, strtolower($cam4));
			}

			if($contadorp7==1){
				$sheet->setCellValue('N'.$fila, strtolower($streamatemodels));
			}

			if($contadorp8==1){
				$sheet->setCellValue('O'.$fila, strtolower($flirt4free));
			}

			if($contadorp9==1){
				$sheet->setCellValue('P'.$fila, strtolower($livejasmin));
			}

			if($contadorp10==1){
				$sheet->setCellValue('Q'.$fila, strtolower($imlive));
			}

			if($contadorp11==1){
				$sheet->setCellValue('R'.$fila, strtolower($xlovecam));
			}

			$sheet->setCellValue('S'.$fila, strtolower($estatus));
		}
	$fila = $fila+1;
	}

}

$fecha_inicio = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('Cuentas Repetidas '.$fecha_inicio.'.xlsx');
header("Location: Cuentas Repetidas ".$fecha_inicio.".xlsx");
?>