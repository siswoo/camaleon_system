<?php
require '../resources/Spreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

/*
$fecha_inicio_post = $_POST['fecha_inicio_post'];
$fecha_fin_post = $_POST['fecha_fin_post'];
*/

$fecha_inicio_post = '2020-11-01';
$fecha_fin_post = '2020-11-15';

include('../script/conexion.php');
$sql1 = "SELECT * FROM presabana";

$consulta1 = mysqli_query($conexion,$sql1);
$fecha_inicio1 = date('Y-m-d');

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Encab: Empresa');
$sheet->setCellValue('B1', 'Encab: Tipo Documento');
$sheet->setCellValue('C1', 'Encab: Prefijo');
$sheet->setCellValue('D1', 'Encab: Documento Número');
$sheet->setCellValue('E1', 'Encab: Fecha');
$sheet->setCellValue('F1', 'Encab: Tercero Interno');
$sheet->setCellValue('G1', 'Encab: Tercero Externo');
$sheet->setCellValue('H1', 'Encab: Fecha Inic. Nómina');
$sheet->setCellValue('I1', 'Encab: Fecha Fin Nómina ');
$sheet->setCellValue('J1', 'Encab: Fecha Pago');
$sheet->setCellValue('K1', 'Encab: Nota');
$sheet->setCellValue('L1', 'Encab: Anulado');
$sheet->setCellValue('M1', 'Encab: Verificado');
$sheet->setCellValue('N1', 'Detalle: Concepto');
$sheet->setCellValue('O1', 'Detalle: Tercero');
$sheet->setCellValue('P1', 'Detalle: Cantidad');
$sheet->setCellValue('Q1', 'Detalle: Unidad de Medida');
$sheet->setCellValue('R1', 'Detalle: Centro de Costo');
$sheet->setCellValue('S1', 'Detalle: Valor');
$sheet->setCellValue('T1', 'Detalle: Nota');
$sheet->setCellValue('U1', 'Detalle: Vencimiento');
$sheet->setCellValue('V1', 'Detalle: Proceso');
$sheet->setCellValue('W1', 'Detalle: Código Centro Costos');
$fila = 2;
while($row1 = mysqli_fetch_array($consulta1)) {
	$id_modelo 			= $row1['id_modelo'];
	$id_sede 			= $row1['sede'];
	$inicio 			= $row1['inicio'];
	$fin 				= $row1['fin'];
	$tokens_chaturbate 	= $row1['chaturbate'];
	$tokens_imlive 		= $row1['imlive'];
	$tokens_xlove 		= $row1['xlove'];
	$tokens_stripchat 	= $row1['stripchat'];
	$tokens_streamate 	= $row1['streamate'];
	$tokens_myfreecams 	= $row1['myfreecams'];
	$tokens_livejasmin 	= $row1['livejasmin'];
	$tokens_bonga 		= $row1['bonga'];
	$tokens_cam4 		= $row1['cam4'];
	$tokens_camsoda 	= $row1['camsoda'];
	$tokens_flirt4free 	= $row1['flirt4free'];
	$total_tokens 		= $row1['total_tokens'];
	$subtotal_dolares 	= $row1['subtotal_dolares'];
	$rf 				= $row1['rf'];
	$meta_porcentajes 	= $row1['meta_porcentajes'];
	$total_pesos 		= $row1['total_pesos'];
	$total_dolares 		= $row1['total_dolares'];
	$trm 				= $row1['trm'];
	$pv 				= $row1['pv'];
	$responsable 		= $row1['responsable'];
	$fecha_inicio 		= $row1['fecha_inicio'];

	$sql2 = "SELECT * FROM sedes WHERE id =".$id_sede;
	$consulta2 = mysqli_query($conexion,$sql2);
	while($row2 = mysqli_fetch_array($consulta2)){
		$sede_nombre = $row2['nombre'];
	}

	$sql7 = "SELECT * FROM modelos WHERE id = ".$id_modelo;
	$consulta7 = mysqli_query($conexion,$sql7);
	while($row7 = mysqli_fetch_array($consulta7)){
		$cedula_modelo = $row7['documento_numero'];
	}

	$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(10);
	$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(30);
	$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(30);
	$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(10);
	$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(15);
	$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(15);
	$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(15);

	$giros = 0;
	$girosN = 0;

	$tiene_chaturbate = 0;
	$tiene_imlive = 0;
	$tiene_xlove = 0;
	$tiene_stripchat = 0;
	$tiene_streamate = 0;
	$tiene_myfreecams = 0;
	$tiene_livejasmin = 0;
	$tiene_bonga = 0;
	$tiene_cam4 = 0;
	$tiene_camsoda = 0;
	$tiene_flirt4free = 0;

	if($tokens_chaturbate>=1){
		$giros = $giros + 1;
		$tiene_chaturbate = 1;
	}

	if($tokens_imlive>=1){
		$giros = $giros + 1;
		$tiene_imlive = 1;
	}

	if($tokens_xlove>=1){
		$giros = $giros + 1;
		$tiene_xlove = 1;
	}

	if($tokens_stripchat>=1){
		$giros = $giros + 1;
		$tiene_stripchat = 1;
	}

	if($tokens_streamate>=1){
		$giros = $giros + 1;
		$tiene_streamate = 1;
	}

	if($tokens_myfreecams>=1){
		$giros = $giros + 1;
		$tiene_myfreecams = 1;
	}

	if($tokens_livejasmin>=1){
		$giros = $giros + 1;
		$tiene_livejasmin = 1;
	}

	if($tokens_bonga>=1){
		$giros = $giros + 1;
		$tiene_bonga = 1;
	}

	if($tokens_cam4>=1){
		$giros = $giros + 1;
		$tiene_cam4 = 1;
	}

	if($tokens_camsoda>=1){
		$giros = $giros + 1;
		$tiene_camsoda = 1;
	}

	if($tokens_flirt4free>=1){
		$giros = $giros + 1;
		$tiene_flirt4free = 1;
	}

	$giros_descuentos = 0;
	$valor_descuentos = 0;

	$giros_tienda = 0;
	$valor_tienda = 0;

	$giros_avances = 0;
	$valor_avances = 0;

	$giros_multa = 0;
	$valor_multa = 0;

	$sql3 = "SELECT * FROM descuento WHERE id_modelo = ".$id_modelo." and fecha_inicio BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."'";
	
	$consulta3 = mysqli_query($conexion,$sql3);
	while($row3 = mysqli_fetch_array($consulta3)){
		$valor_descuentos = $valor_descuentos + $row3['valor'];
		$giros_descuentos = 1;
		$giros = $giros + 1;
	}

	$sql4 = "SELECT * FROM tienda WHERE id_modelo = ".$id_modelo." and fecha_inicio BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."'";
	$consulta4 = mysqli_query($conexion,$sql4);
	while($row4 = mysqli_fetch_array($consulta4)){
		$valor_tienda = $valor_tienda + $row4['valor'];
		$giros_tienda = 1;
		$giros = $giros + 1;
	}

	$sql5 = "SELECT * FROM avances WHERE id_modelo = ".$id_modelo." and fecha_inicio BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."'";
	$consulta5 = mysqli_query($conexion,$sql5);
	while($row5 = mysqli_fetch_array($consulta5)){
		$valor_avances = $valor_avances + $row5['valor'];
		$giros_avances = 1;
		$giros = $giros + 1;
	}

	$sql6 = "SELECT * FROM multas WHERE id_modelo = ".$id_modelo." and fecha_inicio BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."'";
	$consulta6 = mysqli_query($conexion,$sql6);
	while($row6 = mysqli_fetch_array($consulta6)){
		$valor_multa = $valor_multa + $row6['valor'];
		$giros_multa = 1;
		$giros = $giros + 1;
	}

	for($i=1;$i<=$giros;$i++){

		$sheet->setCellValue('A'.$fila, 'BERNAL GROUP S.A.S');
		$sheet->setCellValue('B'.$fila, 'NO');
		$sheet->setCellValue('C'.$fila, '');
		$sheet->setCellValue('D'.$fila, '');

		$originalDate_inicio = $inicio;
		$newDate_inicio = date("n/j/Y", strtotime($originalDate_inicio));

		$originalDate_fin = $fin;
		$newDate_fin = date("n/j/Y", strtotime($originalDate_fin));

		$sheet->setCellValue('E'.$fila, $newDate_fin);
		$sheet->setCellValue('F'.$fila, '1000438496');
		$sheet->setCellValue('G'.$fila, '1000438496');

		$sheet->setCellValue('H'.$fila, $newDate_inicio);

		$sheet->setCellValue('I'.$fila, $newDate_fin);

		$sacar_inicio = explode('/',$newDate_inicio);
		$sacar_inicio2 = $sacar_inicio[0];

		if($sacar_inicio2==16){
			$fecha_pago = $sacar_inicio[1]."/"."8"."/".$sacar_inicio[2];
		}else{
			$fecha_pago = $sacar_inicio[1]."/"."23"."/".$sacar_inicio[2];
		}

		$sheet->setCellValue('J'.$fila, $fecha_pago);

		switch ($sede_nombre) {
			case 'VIP Occidente':
				$generarK[0] = 'VIP DEL ';
				$generarR = 'VIP';
			break;

			case 'Norte':
				$generarK[0] = 'NORTE DEL ';
				$generarR = 'NORTE';
			break;

			case 'Occidente I':
				$generarK[0] = 'VIP DEL ';
				$generarR = 'VIP';
			break;

			case 'VIP Suba':
				$generarK[0] = 'SUBA DEL ';
				$generarR = 'SUBA';
			break;
			
			default:
				$generarK[0] = 'REVISAR DEL ';
				$generarR = 'REVISAR';
			break;
		}

		$generarK[1] = $sacar_inicio[1]." AL ";

		$generarK_1 = explode('/',$newDate_fin);
		$generarK[2] = $generarK_1[1]." ";

		switch ($generarK_1[0]) {
			case 1:
				$generarK[3] = 'ENERO';
			break;

			case 1:
				$generarK[3] = 'FEBRERO';
			break;

			case 1:
				$generarK[3] = 'MARZO';
			break;

			case 1:
				$generarK[3] = 'ABRIL';
			break;

			case 1:
				$generarK[3] = 'MAYO';
			break;

			case 1:
				$generarK[3] = 'JUNIO';
			break;

			case 1:
				$generarK[3] = 'JULIO';
			break;

			case 1:
				$generarK[3] = 'AGOSTO';
			break;

			case 1:
				$generarK[3] = 'SEPTIEMBRE';
			break;

			case 1:
				$generarK[3] = 'OCTUBRE';
			break;

			case 1:
				$generarK[3] = 'NOVIEMBRE';
			break;

			case 1:
				$generarK[3] = 'DICIEMBRE';
			break;
			
			default:
				$generarK[3] = 'revisar';
			break;
		}

		$nota = $generarK[0].$generarK[1].$generarK[2].$generarK[3];

		$sheet->setCellValue('K'.$fila, $nota);
		$sheet->setCellValue('L'.$fila, '');
		$sheet->setCellValue('M'.$fila, '');

		if($tiene_chaturbate==1){
			$sheet->setCellValue('N'.$fila, 'CB '.$meta_porcentajes.' %');
			$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
			$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
			$spreadsheet->getActiveSheet()->getCell('P'.$fila)->setValue($total_tokens);
			$spreadsheet->getActiveSheet()->getStyle('P'.$fila)->getNumberFormat()->setFormatCode('00');
			$sheet->setCellValue('Q'.$fila, 'Tokens');
			$sheet->setCellValue('R'.$fila, $generarR);
			$sheet->setCellValue('S'.$fila, $pv);
			$sheet->setCellValue('T'.$fila, $nota);
			$sheet->setCellValue('U'.$fila, $newDate_fin);
			$tiene_chaturbate = 0;
		}else if($tiene_imlive==1){
			$sheet->setCellValue('N'.$fila, 'IML '.$meta_porcentajes.' %');
			$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
			$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
			$spreadsheet->getActiveSheet()->getCell('P'.$fila)->setValue($total_tokens);
			$spreadsheet->getActiveSheet()->getStyle('P'.$fila)->getNumberFormat()->setFormatCode('00');
			$sheet->setCellValue('Q'.$fila, 'Tokens');
			$sheet->setCellValue('R'.$fila, $generarR);
			$sheet->setCellValue('S'.$fila, $pv);
			$sheet->setCellValue('T'.$fila, $nota);
			$sheet->setCellValue('U'.$fila, $newDate_fin);
			$tiene_imlive = 0;
		}else if($tiene_xlove==1){
			$sheet->setCellValue('N'.$fila, 'Xlc '.$meta_porcentajes.' %');
			$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
			$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
			$spreadsheet->getActiveSheet()->getCell('P'.$fila)->setValue($total_tokens);
			$spreadsheet->getActiveSheet()->getStyle('P'.$fila)->getNumberFormat()->setFormatCode('00');
			$sheet->setCellValue('Q'.$fila, 'Tokens');
			$sheet->setCellValue('R'.$fila, $generarR);
			$sheet->setCellValue('S'.$fila, $pv);
			$sheet->setCellValue('T'.$fila, $nota);
			$sheet->setCellValue('U'.$fila, $newDate_fin);
			$tiene_xlove = 0;
		}else if($tiene_stripchat==1){
			$sheet->setCellValue('N'.$fila, 'Stp '.$meta_porcentajes.' %');
			$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
			$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
			$spreadsheet->getActiveSheet()->getCell('P'.$fila)->setValue($total_tokens);
			$spreadsheet->getActiveSheet()->getStyle('P'.$fila)->getNumberFormat()->setFormatCode('00');
			$sheet->setCellValue('Q'.$fila, 'Tokens');
			$sheet->setCellValue('R'.$fila, $generarR);
			$sheet->setCellValue('S'.$fila, $pv);
			$sheet->setCellValue('T'.$fila, $nota);
			$sheet->setCellValue('U'.$fila, $newDate_fin);
			$tiene_stripchat = 0;
		}else if($tiene_streamate==1){
			$sheet->setCellValue('N'.$fila, 'Stmt '.$meta_porcentajes.' %');
			$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
			$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
			$spreadsheet->getActiveSheet()->getCell('P'.$fila)->setValue($total_tokens);
			$spreadsheet->getActiveSheet()->getStyle('P'.$fila)->getNumberFormat()->setFormatCode('00');
			$sheet->setCellValue('Q'.$fila, 'Tokens');
			$sheet->setCellValue('R'.$fila, $generarR);
			$sheet->setCellValue('S'.$fila, $pv);
			$sheet->setCellValue('T'.$fila, $nota);
			$sheet->setCellValue('U'.$fila, $newDate_fin);
			$tiene_streamate = 0;
		}else if($tiene_myfreecams==1){
			$sheet->setCellValue('N'.$fila, 'MFC '.$meta_porcentajes.' %');
			$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
			$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
			$spreadsheet->getActiveSheet()->getCell('P'.$fila)->setValue($total_tokens);
			$spreadsheet->getActiveSheet()->getStyle('P'.$fila)->getNumberFormat()->setFormatCode('00');
			$sheet->setCellValue('Q'.$fila, 'Tokens');
			$sheet->setCellValue('R'.$fila, $generarR);
			$sheet->setCellValue('S'.$fila, $pv);
			$sheet->setCellValue('T'.$fila, $nota);
			$sheet->setCellValue('U'.$fila, $newDate_fin);
			$tiene_myfreecams = 0;
		}else if($tiene_livejasmin==1){
			$sheet->setCellValue('N'.$fila, 'LJ '.$meta_porcentajes.' %');
			$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
			$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
			$spreadsheet->getActiveSheet()->getCell('P'.$fila)->setValue($total_tokens);
			$spreadsheet->getActiveSheet()->getStyle('P'.$fila)->getNumberFormat()->setFormatCode('00');
			$sheet->setCellValue('Q'.$fila, 'Tokens');
			$sheet->setCellValue('R'.$fila, $generarR);
			$sheet->setCellValue('S'.$fila, $pv);
			$sheet->setCellValue('T'.$fila, $nota);
			$sheet->setCellValue('U'.$fila, $newDate_fin);
			$tiene_livejasmin = 0;
		}else if($tiene_bonga==1){
			$sheet->setCellValue('N'.$fila, 'Bong '.$meta_porcentajes.' %');
			$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
			$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
			$spreadsheet->getActiveSheet()->getCell('P'.$fila)->setValue($total_tokens);
			$spreadsheet->getActiveSheet()->getStyle('P'.$fila)->getNumberFormat()->setFormatCode('00');
			$sheet->setCellValue('Q'.$fila, 'Tokens');
			$sheet->setCellValue('R'.$fila, $generarR);
			$sheet->setCellValue('S'.$fila, $pv);
			$sheet->setCellValue('T'.$fila, $nota);
			$sheet->setCellValue('U'.$fila, $newDate_fin);
			$tiene_bonga = 0;
		}else if($tiene_cam4==1){
			$sheet->setCellValue('N'.$fila, 'C4 '.$meta_porcentajes.' %');
			$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
			$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
			$spreadsheet->getActiveSheet()->getCell('P'.$fila)->setValue($total_tokens);
			$spreadsheet->getActiveSheet()->getStyle('P'.$fila)->getNumberFormat()->setFormatCode('00');
			$sheet->setCellValue('Q'.$fila, 'Tokens');
			$sheet->setCellValue('R'.$fila, $generarR);
			$sheet->setCellValue('S'.$fila, $pv);
			$sheet->setCellValue('T'.$fila, $nota);
			$sheet->setCellValue('U'.$fila, $newDate_fin);
			$tiene_cam4 = 0;
		}else if($tiene_camsoda==1){
			$sheet->setCellValue('N'.$fila, 'Cms '.$meta_porcentajes.' %');
			$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
			$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
			$spreadsheet->getActiveSheet()->getCell('P'.$fila)->setValue($total_tokens);
			$spreadsheet->getActiveSheet()->getStyle('P'.$fila)->getNumberFormat()->setFormatCode('00');
			$sheet->setCellValue('Q'.$fila, 'Tokens');
			$sheet->setCellValue('R'.$fila, $generarR);
			$sheet->setCellValue('S'.$fila, $pv);
			$sheet->setCellValue('T'.$fila, $nota);
			$sheet->setCellValue('U'.$fila, $newDate_fin);
			$tiene_camsoda = 0;
		}else if($tiene_flirt4free==1){
			$sheet->setCellValue('N'.$fila, 'F4F '.$meta_porcentajes.' %');
			$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
			$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
			$spreadsheet->getActiveSheet()->getCell('P'.$fila)->setValue($total_tokens);
			$spreadsheet->getActiveSheet()->getStyle('P'.$fila)->getNumberFormat()->setFormatCode('00');
			$sheet->setCellValue('Q'.$fila, 'Tokens');
			$sheet->setCellValue('R'.$fila, $generarR);
			$sheet->setCellValue('S'.$fila, $pv);
			$sheet->setCellValue('T'.$fila, $nota);
			$sheet->setCellValue('U'.$fila, $newDate_fin);
			$tiene_flirt4free = 0;
		}else if($giros_descuentos==1 or $giros_avances==1 or $giros_multa==1){
			$sheet->setCellValue('N'.$fila, 'Descuento Multas');
			$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
			$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
			$sheet->setCellValue('P'.$fila, '1');
			$sheet->setCellValue('Q'.$fila, 'Und.');
			$sheet->setCellValue('R'.$fila, $generarR);

			$total_descuentos = $valor_descuentos+$valor_multa+$valor_avances;
			$sheet->setCellValue('S'.$fila, $total_descuentos);

			$sheet->setCellValue('T'.$fila, $nota);
			$sheet->setCellValue('U'.$fila, $newDate_fin);
			$giros_descuentos = 0;
			$giros_avances = 0;
			$giros_multa = 0;
		}else if($giros_tienda==1){
			$sheet->setCellValue('N'.$fila, 'Descuento Almacen');
			$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
			$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
			$sheet->setCellValue('P'.$fila, '1');
			$sheet->setCellValue('Q'.$fila, 'Und.');
			$sheet->setCellValue('R'.$fila, $generarR);

			$total_tienda = $valor_tienda;
			$sheet->setCellValue('S'.$fila, $total_tienda);
			
			$sheet->setCellValue('T'.$fila, $nota);
			$sheet->setCellValue('U'.$fila, $newDate_fin);
			$giros_tienda = 0;
		}

		$fila = $fila+1;
	}

}

$fecha_inicio1 = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('test7 '.$fecha_inicio1.'.xlsx');
header("Location: test7 ".$fecha_inicio1.".xlsx");
?>