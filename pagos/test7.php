<?php
require '../resources/Spreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

$presabana_id = $_POST['select_sc'];
include('../script/conexion.php');

$sql8 = "SELECT * FROM presabana WHERE id =".$presabana_id;
$consulta8 = mysqli_query($conexion,$sql8);
while($row8 = mysqli_fetch_array($consulta8)) {
	$fecha_inicio_post = $row8['inicio'];
	$fecha_fin_post = $row8['fin'];
}

$sql1 = "SELECT * FROM presabana WHERE inicio BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."' and fin BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."' and total_pesos >= 1";
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

	$apuro = 0;

	if($id_modelo == 97 or $id_modelo == 437 or $id_modelo == 460 or $id_modelo == 481 or $id_modelo == 534 or $id_modelo == 541 or $id_modelo == 547 or $id_modelo == 550 or $id_modelo == 555 or $id_modelo == 557 or $id_modelo == 559 or $id_modelo == 560 or $id_modelo == 563 or $id_modelo == 569 or $id_modelo == 571 or $id_modelo == 576 or $id_modelo == 582 or $id_modelo == 585 or $id_modelo == 625 or $id_modelo == 471 or $id_modelo == 623 or $id_modelo == 533 or $id_modelo == 452 or $id_modelo == 565 or $id_modelo == 581 or $id_modelo == 491 or $id_modelo == 668){ 
		if($fecha_inicio_post=='2020-12-01'){
			$apuro = 1;
		}
	}

	if($id_modelo == 541 or $id_modelo == 481 or $id_modelo == 560 or $id_modelo == 350 or $id_modelo == 616 or $id_modelo == 528 or $id_modelo == 471 or $id_modelo == 554 /*or $id_modelo == 104*/ or $id_modelo == 564 /*or $id_modelo == 429*/ or $id_modelo == 140 or $id_modelo == 598 or $id_modelo == 482 or $id_modelo == 596 or $id_modelo == 562 or $id_modelo == 597 or $id_modelo == 311 or $id_modelo == 420 or $id_modelo == 554 or $id_modelo == 471 or $id_modelo == 528 or $id_modelo == 616 or $id_modelo == 350 or $id_modelo == 560 or $id_modelo == 481 or $id_modelo == 541 or $id_modelo == 139){ 
		if($fecha_inicio_post=='2020-12-16'){
			$apuro = 1;
		}
	}

	if($id_modelo == 97 or $id_modelo == 322 or $id_modelo == 606 or $id_modelo == 610 or $id_modelo == 616 or $id_modelo == 632 or $id_modelo == 35 or $id_modelo == 193 or $id_modelo == 395 or $id_modelo == 399 or $id_modelo == 429 or $id_modelo == 617 or $id_modelo == 618 or $id_modelo == 633 or $id_modelo == 636 or $id_modelo == 637 or $id_modelo == 638 or $id_modelo == 642 or $id_modelo == 644 or $id_modelo == 651 or $id_modelo == 653 or $id_modelo == 682){ 
		if($fecha_inicio_post=='2021-01-01'){
			$apuro = 1;
		}
	}

	if($id_modelo == 302 or $id_modelo == 780 or $id_modelo == 923 or $id_modelo == 692 or $id_modelo == 818 or $id_modelo == 854 or $id_modelo == 981 or $id_modelo == 682 or $id_modelo == 193 or $id_modelo == 653 or $id_modelo == 687 or $id_modelo == 827 or $id_modelo == 826 or $id_modelo == 656 or $id_modelo == 586 or $id_modelo == 788 or $id_modelo == 909 or $id_modelo == 926 or $id_modelo == 3 or $id_modelo == 663 or $id_modelo == 482 or $id_modelo == 804 or $id_modelo == 840 or $id_modelo == 901 or $id_modelo == 781 or $id_modelo == 820 or $id_modelo == 867 or $id_modelo == 812 or $id_modelo == 480 or $id_modelo == 799 or $id_modelo == 615 or $id_modelo == 862 or $id_modelo == 904 or $id_modelo == 885 or $id_modelo == 685 or $id_modelo == 650 or $id_modelo == 897 or $id_modelo == 696 or $id_modelo == 939){ 
		if($fecha_inicio_post=='2021-01-16'){
			$apuro = 1;
		}
	}

	if($apuro==0){

		$sql2 = "SELECT * FROM sedes WHERE id =".$id_sede;
		$consulta2 = mysqli_query($conexion,$sql2);
		while($row2 = mysqli_fetch_array($consulta2)){
			$sede_nombre = $row2['nombre'];
		}

		$sql7 = "SELECT * FROM modelos WHERE id = ".$id_modelo;
		$consulta7 = mysqli_query($conexion,$sql7);
		while($row7 = mysqli_fetch_array($consulta7)){
			$cedula_modelo = $row7['documento_numero'];
			$turno = $row7['turno'];
			$estatus = $row7['estatus'];
		}

		if($id_modelo==207 and $fecha_desde == '2020-12-01'){
			$turno = 'mañana';
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
		$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(30);
		$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('T')->setWidth(30);
		$spreadsheet->getActiveSheet()->getColumnDimension('U')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('V')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('W')->setWidth(15);

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

		$giros_bonos_hora = 0;
		$valor_bonos_hora = 0;

		$giros_bonos_streamate = 0;
		$valor_bonos_streamate = 0;

		$giros_sexshop = 0;
		$valor_sexshop = 0;

		$giros_seguridad_social = 0;
		$valor_seguridad_social = 0;

		$giros_sancion_pagina = 0;
		$valor_sancion_pagina = 0;

		$giros_lenceria = 0;
		$valor_lenceria = 0;

		$giros_bonos_meta = 0;
		$bonos_meta = 0;

		$sql3 = "SELECT * FROM descuento WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."' and fecha_hasta BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."'";
		
		$consulta3 = mysqli_query($conexion,$sql3);
		while($row3 = mysqli_fetch_array($consulta3)){
			$valor_descuentos = $valor_descuentos + $row3['valor'];
			$giros_descuentos = 1;
			$giros = $giros + 1;
		}

		$sql4 = "SELECT * FROM tienda WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."' and fecha_hasta BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."'";
		$consulta4 = mysqli_query($conexion,$sql4);
		while($row4 = mysqli_fetch_array($consulta4)){
			$valor_tienda = $valor_tienda + $row4['valor'];
			$giros_tienda = 1;
			$giros = $giros + 1;
		}

		$sql5 = "SELECT * FROM avances WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."' and fecha_hasta BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."'";
		$consulta5 = mysqli_query($conexion,$sql5);
		while($row5 = mysqli_fetch_array($consulta5)){
			$valor_avances = $valor_avances + $row5['valor'];
			$giros_avances = 1;
			$giros = $giros + 1;
		}

		$sql6 = "SELECT * FROM multas WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."' and fecha_hasta BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."'";
		$consulta6 = mysqli_query($conexion,$sql6);
		while($row6 = mysqli_fetch_array($consulta6)){
			$valor_multa = $valor_multa + $row6['valor'];
			$giros_multa = 1;
			$giros = $giros + 1;
		}

		$sql9 = "SELECT * FROM bonos_horas WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."' and fecha_hasta BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."'";
		$consulta9 = mysqli_query($conexion,$sql9);
		while($row9 = mysqli_fetch_array($consulta9)){
			$valor_bonos_hora = $valor_bonos_hora + $row9['monto'];
			$giros_bonos_hora = 1;
			$giros = $giros + 1;
		}

		$sql10 = "SELECT * FROM sexshop WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."' and fecha_hasta BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."'";
		$consulta10 = mysqli_query($conexion,$sql10);
		while($row10 = mysqli_fetch_array($consulta10)){
			$valor_sexshop = $valor_sexshop + $row10['monto'];
			$giros_sexshop = 1;
			$giros = $giros + 1;
		}

		$sql11 = "SELECT * FROM seguridad_social WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."' and fecha_hasta BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."'";
		$consulta11 = mysqli_query($conexion,$sql11);
		while($row11 = mysqli_fetch_array($consulta11)){
			$valor_seguridad_social = $valor_seguridad_social + $row11['monto'];
			$giros_seguridad_social = 1;
			$giros = $giros + 1;
		}

		$sql12 = "SELECT * FROM sancionpagina WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."' and fecha_hasta BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."'";
		$consulta12 = mysqli_query($conexion,$sql12);
		while($row12 = mysqli_fetch_array($consulta12)){
			$valor_sancion_pagina = $valor_sancion_pagina + $row12['monto'];
			$giros_sancion_pagina = 1;
			$giros = $giros + 1;
		}

		$sql13 = "SELECT * FROM bonos_streamate WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."' and fecha_hasta BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."'";
		$consulta13 = mysqli_query($conexion,$sql13);
		while($row13 = mysqli_fetch_array($consulta13)){
			$valor_bonos_streamate = $valor_bonos_streamate + $row13['monto'];
			$giros_bonos_streamate = 1;
			$giros = $giros + 1;
		}

		$sql14 = "SELECT * FROM lenceria WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."' and fecha_hasta BETWEEN '".$fecha_inicio_post."' AND '".$fecha_fin_post."'";
		$consulta14 = mysqli_query($conexion,$sql14);
		while($row14 = mysqli_fetch_array($consulta14)){
			$valor_lenceria = $valor_lenceria + $row14['monto'];
			$giros_lenceria = 1;
			$giros = $giros + 1;
		}

		if($total_tokens>=50000 and $total_tokens<=79999 and $turno != 'Satelite' and $fecha_inicio_post!='2020-12-01' and $fecha_inicio_post!='2020-12-16'){
			$giros_bonos_meta = 1;
			$bonos_meta = 100000;
			$giros = $giros + 1;
		}

		if($total_tokens>=80000 and $total_tokens<=99999 and $turno != 'Satelite' and $fecha_inicio_post!='2020-12-01' and $fecha_inicio_post!='2020-12-16'){
			$giros_bonos_meta = 1;
			$bonos_meta = 300000;
			$giros = $giros + 1;
		}

		if($total_tokens>=100000 and $turno != 'Satelite' and $fecha_inicio_post!='2020-12-01' and $fecha_inicio_post!='2020-12-16'){
			$giros_bonos_meta = 1;
			$bonos_meta = 500000;
			$giros = $giros + 1;
		}

		$total_restado = $valor_descuentos+$valor_tienda+$valor_avances+$valor_multa+$valor_sexshop+$valor_seguridad_social+($valor_sancion_pagina*$trm)+($rf*$trm)+$valor_lenceria;

		$valor_bonos_streamate = $valor_bonos_streamate*$trm;

		$positivos = $total_pesos+$bonos_meta+$valor_bonos_hora+$valor_bonos_streamate;

		//if($positivos>=$total_restado){
		if($apuro==0){

			for($i=1;$i<=$giros;$i++){

				if($tiene_chaturbate>=1 or $tiene_imlive>=1 or $tiene_xlove>=1 or $tiene_stripchat>=1 or $tiene_streamate>=1 or $tiene_myfreecams>=1 or $tiene_livejasmin>=1 or $tiene_bonga>=1 or $tiene_cam4>=1 or $tiene_camsoda>=1 or $tiene_flirt4free>=1 or $giros_descuentos>=1 or $giros_avances>=1 or $giros_multa>=1 or $giros_tienda>=1 or $giros_bonos_meta>=1 or $giros_bonos_hora>=1 or $giros_sexshop>=1 or $giros_seguridad_social>=1 or $giros_sancion_pagina>=1 or $giros_bonos_streamate>=1 or $giros_lenceria>=1){

					$sheet->setCellValue('A'.$fila, 'BERNAL GROUP S.A.S');
					$sheet->setCellValue('B'.$fila, 'NO');
					$sheet->setCellValue('C'.$fila, '');
					$sheet->setCellValue('D'.$fila, '');

					$originalDate_inicio = $inicio;
					$newDate_inicio = date("d/m/Y", strtotime($originalDate_inicio));

					$originalDate_fin = $fin;
					$newDate_fin = date("d/m/Y", strtotime($originalDate_fin));

					//$sheet->setCellValue('E'.$fila, $newDate_fin);
					$sheet->setCellValue('E'.$fila, $newDate_fin);
					$sheet->getStyle('E'.$fila)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DDMMYYYY);
					$sheet->setCellValue('F'.$fila, '');
					$sheet->setCellValue('G'.$fila, '');

					$sheet->setCellValue('H'.$fila, $newDate_inicio);
					$sheet->getStyle('H'.$fila)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DDMMYYYY);

					$sheet->setCellValue('I'.$fila, $newDate_fin);
					$sheet->getStyle('I'.$fila)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DDMMYYYY);

					$sacar_inicio = explode('/',$newDate_inicio);
					$sacar_inicio2 = $sacar_inicio[0];

					if($sacar_inicio2==1){
						//$fecha_pago = $sacar_inicio[0]."/"."8"."/".$sacar_inicio[2];
						$fecha_pago = "23"."/".$sacar_inicio[1]."/".$sacar_inicio[2];
					}else if($sacar_inicio2==16){
						//$fecha_pago = $sacar_inicio[0]."/"."23"."/".$sacar_inicio[2];
						if($sacar_inicio[1]==12){
							$mes_a_pagar = "01";
						}else{
							$mes_a_pagar = $sacar_inicio[1];
						}
						if($sacar_inicio[1]==12){
							$year_a_pagar = $sacar_inicio[2]+1;
						}else{
							$year_a_pagar = $sacar_inicio[2]; 
						}
						$fecha_pago = "08"."/".$mes_a_pagar."/".$year_a_pagar;
					}

					$sheet->setCellValue('J'.$fila, $fecha_pago);
					$sheet->getStyle('J'.$fila)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DDMMYYYY);

					switch ($sede_nombre) {
						case 'VIP Occidente':
							$generarK[0] = 'VIP DEL ';
							$generarR = 'VIP';
						break;

						case 'Norte':
							$generarK[0] = 'NORTE DEL ';
							$generarR = 'Norte';
						break;

						case 'Occidente I':
							$generarK[0] = 'VIP DEL ';
							$generarR = 'VIP';
						break;

						case 'VIP Suba':
							$generarK[0] = 'SUBA DEL ';
							$generarR = 'Suba';
						break;
						
						default:
							$generarK[0] = 'REVISAR DEL ';
							$generarR = 'REVISAR';
						break;
					}

					$generarK[1] = $sacar_inicio[1]." AL ";

					$generarK_1 = explode('/',$newDate_fin);
					$generarK[2] = $generarK_1[0]." ";

					switch ($generarK_1[1]) {
						case 1:
							$generarK[3] = 'ENERO';
						break;

						case 2:
							$generarK[3] = 'FEBRERO';
						break;

						case 3:
							$generarK[3] = 'MARZO';
						break;

						case 4:
							$generarK[3] = 'ABRIL';
						break;

						case 5:
							$generarK[3] = 'MAYO';
						break;

						case 6:
							$generarK[3] = 'JUNIO';
						break;

						case 7:
							$generarK[3] = 'JULIO';
						break;

						case 8:
							$generarK[3] = 'AGOSTO';
						break;

						case 9:
							$generarK[3] = 'SEPTIEMBRE';
						break;

						case 10:
							$generarK[3] = 'OCTUBRE';
						break;

						case 11:
							$generarK[3] = 'NOVIEMBRE';
						break;

						case 12:
							$generarK[3] = 'DICIEMBRE';
						break;
						
						default:
							$generarK[3] = 'revisar';
						break;
					}

					//$nota = $generarK[0].$generarK[1].$generarK[2].$generarK[3];
					$nota = $generarK[0].$sacar_inicio2." AL ".$generarK[2].$generarK[3];

					$sheet->setCellValue('K'.$fila, $nota);
					$sheet->setCellValue('L'.$fila, '');
					$sheet->setCellValue('M'.$fila, '');

					if($tiene_chaturbate==1){
						if($turno=='Satelite'){
							$sheet->setCellValue('N'.$fila, 'CB 80% Satelite');
						}else{
							$sheet->setCellValue('N'.$fila, 'CB '.$meta_porcentajes.'%');
						}
						$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
						$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
						$spreadsheet->getActiveSheet()->getCell('P'.$fila)->setValue($tokens_chaturbate);
						$spreadsheet->getActiveSheet()->getStyle('P'.$fila)->getNumberFormat()->setFormatCode('00');
						$sheet->setCellValue('Q'.$fila, 'Tokens');
						$sheet->setCellValue('R'.$fila, $generarR);
						$sheet->setCellValue('S'.$fila, $pv);
						$sheet->setCellValue('T'.$fila, $nota);
						$sheet->setCellValue('U'.$fila, $newDate_fin);
						$tiene_chaturbate = 0;
					}else if($tiene_imlive==1){
						if($turno=='Satelite'){
							$sheet->setCellValue('N'.$fila, 'IML 80% Satelite');
						}else{
							$sheet->setCellValue('N'.$fila, 'IML '.$meta_porcentajes.'%');
						}
						$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
						$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
						$spreadsheet->getActiveSheet()->getCell('P'.$fila)->setValue($tokens_imlive);
						$spreadsheet->getActiveSheet()->getStyle('P'.$fila)->getNumberFormat()->setFormatCode('00');
						$sheet->setCellValue('Q'.$fila, 'Tokens');
						$sheet->setCellValue('R'.$fila, $generarR);
						$sheet->setCellValue('S'.$fila, $pv);
						$sheet->setCellValue('T'.$fila, $nota);
						$sheet->setCellValue('U'.$fila, $newDate_fin);
						$tiene_imlive = 0;
					}else if($tiene_xlove==1){
						if($turno=='Satelite'){
							$sheet->setCellValue('N'.$fila, 'Xlc 80% Satelite');
						}else{
							$sheet->setCellValue('N'.$fila, 'Xlc '.$meta_porcentajes.'%');
						}
						$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
						$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
						$spreadsheet->getActiveSheet()->getCell('P'.$fila)->setValue($tokens_xlove);
						$spreadsheet->getActiveSheet()->getStyle('P'.$fila)->getNumberFormat()->setFormatCode('00');
						$sheet->setCellValue('Q'.$fila, 'Tokens');
						$sheet->setCellValue('R'.$fila, $generarR);
						$sheet->setCellValue('S'.$fila, $pv);
						$sheet->setCellValue('T'.$fila, $nota);
						$sheet->setCellValue('U'.$fila, $newDate_fin);
						$tiene_xlove = 0;
					}else if($tiene_stripchat==1){
						if($turno=='Satelite'){
							$sheet->setCellValue('N'.$fila, 'Stp 80% Satelite');
						}else{
							$sheet->setCellValue('N'.$fila, 'Stp '.$meta_porcentajes.'%');
						}
						$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
						$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
						$spreadsheet->getActiveSheet()->getCell('P'.$fila)->setValue($tokens_stripchat);
						$spreadsheet->getActiveSheet()->getStyle('P'.$fila)->getNumberFormat()->setFormatCode('00');
						$sheet->setCellValue('Q'.$fila, 'Tokens');
						$sheet->setCellValue('R'.$fila, $generarR);
						$sheet->setCellValue('S'.$fila, $pv);
						$sheet->setCellValue('T'.$fila, $nota);
						$sheet->setCellValue('U'.$fila, $newDate_fin);
						$tiene_stripchat = 0;
					}else if($tiene_streamate==1){
						if($turno=='Satelite'){
							$sheet->setCellValue('N'.$fila, 'Stmt 80% Satelite');
						}else{
							$sheet->setCellValue('N'.$fila, 'Stmt '.$meta_porcentajes.'%');
						}
						$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
						$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
						$spreadsheet->getActiveSheet()->getCell('P'.$fila)->setValue($tokens_streamate);
						$spreadsheet->getActiveSheet()->getStyle('P'.$fila)->getNumberFormat()->setFormatCode('00');
						$sheet->setCellValue('Q'.$fila, 'Tokens');
						$sheet->setCellValue('R'.$fila, $generarR);
						$sheet->setCellValue('S'.$fila, $pv);
						$sheet->setCellValue('T'.$fila, $nota);
						$sheet->setCellValue('U'.$fila, $newDate_fin);
						$tiene_streamate = 0;
					}else if($tiene_myfreecams==1){
						if($turno=='Satelite'){
							$sheet->setCellValue('N'.$fila, 'MFC 80% Satelite');
						}else{
							$sheet->setCellValue('N'.$fila, 'MFC '.$meta_porcentajes.'%');
						}
						$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
						$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
						$spreadsheet->getActiveSheet()->getCell('P'.$fila)->setValue($tokens_myfreecams);
						$spreadsheet->getActiveSheet()->getStyle('P'.$fila)->getNumberFormat()->setFormatCode('00');
						$sheet->setCellValue('Q'.$fila, 'Tokens');
						$sheet->setCellValue('R'.$fila, $generarR);
						$sheet->setCellValue('S'.$fila, $pv);
						$sheet->setCellValue('T'.$fila, $nota);
						$sheet->setCellValue('U'.$fila, $newDate_fin);
						$tiene_myfreecams = 0;
					}else if($tiene_livejasmin==1){
						if($turno=='Satelite'){
							$sheet->setCellValue('N'.$fila, 'LJ 80% Satelite');
						}else{
							$sheet->setCellValue('N'.$fila, 'LJ '.$meta_porcentajes.'%');
						}
						$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
						$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
						$spreadsheet->getActiveSheet()->getCell('P'.$fila)->setValue($tokens_livejasmin);
						$spreadsheet->getActiveSheet()->getStyle('P'.$fila)->getNumberFormat()->setFormatCode('00');
						$sheet->setCellValue('Q'.$fila, 'Tokens');
						$sheet->setCellValue('R'.$fila, $generarR);
						$sheet->setCellValue('S'.$fila, $pv);
						$sheet->setCellValue('T'.$fila, $nota);
						$sheet->setCellValue('U'.$fila, $newDate_fin);
						$tiene_livejasmin = 0;
					}else if($tiene_bonga==1){
						if($turno=='Satelite'){
							$sheet->setCellValue('N'.$fila, 'Bong 80% Satelite');
						}else{
							$sheet->setCellValue('N'.$fila, 'Bong '.$meta_porcentajes.'%');
						}
						$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
						$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
						$spreadsheet->getActiveSheet()->getCell('P'.$fila)->setValue($tokens_bonga);
						$spreadsheet->getActiveSheet()->getStyle('P'.$fila)->getNumberFormat()->setFormatCode('00');
						$sheet->setCellValue('Q'.$fila, 'Tokens');
						$sheet->setCellValue('R'.$fila, $generarR);
						$sheet->setCellValue('S'.$fila, $pv);
						$sheet->setCellValue('T'.$fila, $nota);
						$sheet->setCellValue('U'.$fila, $newDate_fin);
						$tiene_bonga = 0;
					}else if($tiene_cam4==1){
						if($turno=='Satelite'){
							$sheet->setCellValue('N'.$fila, 'C4 80% Satelite');
						}else{
							$sheet->setCellValue('N'.$fila, 'C4 '.$meta_porcentajes.'%');
						}
						$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
						$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
						$spreadsheet->getActiveSheet()->getCell('P'.$fila)->setValue($tokens_cam4);
						$spreadsheet->getActiveSheet()->getStyle('P'.$fila)->getNumberFormat()->setFormatCode('00');
						$sheet->setCellValue('Q'.$fila, 'Tokens');
						$sheet->setCellValue('R'.$fila, $generarR);
						$sheet->setCellValue('S'.$fila, $pv);
						$sheet->setCellValue('T'.$fila, $nota);
						$sheet->setCellValue('U'.$fila, $newDate_fin);
						$tiene_cam4 = 0;
					}else if($tiene_camsoda==1){
						if($turno=='Satelite'){
							$sheet->setCellValue('N'.$fila, 'Cms 80% Satelite');
						}else{
							$sheet->setCellValue('N'.$fila, 'Cms '.$meta_porcentajes.'%');
						}
						$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
						$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
						$spreadsheet->getActiveSheet()->getCell('P'.$fila)->setValue($tokens_camsoda);
						$spreadsheet->getActiveSheet()->getStyle('P'.$fila)->getNumberFormat()->setFormatCode('00');
						$sheet->setCellValue('Q'.$fila, 'Tokens');
						$sheet->setCellValue('R'.$fila, $generarR);
						$sheet->setCellValue('S'.$fila, $pv);
						$sheet->setCellValue('T'.$fila, $nota);
						$sheet->setCellValue('U'.$fila, $newDate_fin);
						$tiene_camsoda = 0;
					}else if($tiene_flirt4free==1){
						if($turno=='Satelite'){
							$sheet->setCellValue('N'.$fila, 'F4F 80% Satelite');
						}else{
							$sheet->setCellValue('N'.$fila, 'F4F '.$meta_porcentajes.'%');
						}
						$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
						$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
						$spreadsheet->getActiveSheet()->getCell('P'.$fila)->setValue($tokens_flirt4free);
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
						$sheet->setCellValue('N'.$fila, 'Descuento Tienda');
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
					}else if($giros_sexshop==1){
						$sheet->setCellValue('N'.$fila, 'Descuento Almacen');
						$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
						$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
						$sheet->setCellValue('P'.$fila, '1');
						$sheet->setCellValue('Q'.$fila, 'Und.');
						$sheet->setCellValue('R'.$fila, $generarR);

						$total_sexshop = $valor_sexshop;
						$sheet->setCellValue('S'.$fila, $total_sexshop);
						
						$sheet->setCellValue('T'.$fila, $nota);
						$sheet->setCellValue('U'.$fila, $newDate_fin);
						$giros_sexshop = 0;
					}else if($giros_seguridad_social==1){
						$sheet->setCellValue('N'.$fila, 'Descuento Seg. Social Independiente');
						$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
						$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
						$sheet->setCellValue('P'.$fila, '1');
						$sheet->setCellValue('Q'.$fila, 'Und.');
						$sheet->setCellValue('R'.$fila, $generarR);

						$total_seguridad_social = $valor_seguridad_social;
						$sheet->setCellValue('S'.$fila, $total_seguridad_social);
						
						$sheet->setCellValue('T'.$fila, $nota);
						$sheet->setCellValue('U'.$fila, $newDate_fin);
						$giros_seguridad_social = 0;
					}else if($giros_sancion_pagina==1){
						$sheet->setCellValue('N'.$fila, 'Sanciones Paginas');
						$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
						$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
						$sheet->setCellValue('P'.$fila, '1');
						$sheet->setCellValue('Q'.$fila, 'Und.');
						$sheet->setCellValue('R'.$fila, $generarR);

						$total_sancion_pagina = $valor_sancion_pagina*$trm;
						$sheet->setCellValue('S'.$fila, $total_sancion_pagina);
						
						$sheet->setCellValue('T'.$fila, $nota);
						$sheet->setCellValue('U'.$fila, $newDate_fin);
						$giros_sancion_pagina = 0;
					}else if($giros_bonos_hora==1){
						$sheet->setCellValue('N'.$fila, 'Bono Cumplimiento horas');
						$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
						$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
						$sheet->setCellValue('P'.$fila, '1');
						$sheet->setCellValue('Q'.$fila, 'Und.');
						$sheet->setCellValue('R'.$fila, $generarR);

						$total_bonos_hora = $valor_bonos_hora;
						$sheet->setCellValue('S'.$fila, $total_bonos_hora);
						
						$sheet->setCellValue('T'.$fila, $nota);
						$sheet->setCellValue('U'.$fila, $newDate_fin);
						$giros_bonos_hora = 0;
					}else if($giros_bonos_streamate==1){
						$sheet->setCellValue('N'.$fila, 'Bono Economico');
						$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
						$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
						$sheet->setCellValue('P'.$fila, '1');
						$sheet->setCellValue('Q'.$fila, 'Und.');
						$sheet->setCellValue('R'.$fila, $generarR);

						$total_bonos_streamate = $valor_bonos_streamate;
						$sheet->setCellValue('S'.$fila, $total_bonos_streamate);
						
						$sheet->setCellValue('T'.$fila, $nota);
						$sheet->setCellValue('U'.$fila, $newDate_fin);
						$giros_bonos_streamate = 0;
					}else if($giros_bonos_meta==1){
						if($id_modelo == 100 and $fecha_desde == '2020-12-16'){
							$giros_bonos_meta = 0;
						}else{
							$sheet->setCellValue('N'.$fila, 'Bono Economico');
							$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
							$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
							$sheet->setCellValue('P'.$fila, '1');
							$sheet->setCellValue('Q'.$fila, 'Und.');
							$sheet->setCellValue('R'.$fila, $generarR);

							$total_bonos_meta = $bonos_meta;
							$sheet->setCellValue('S'.$fila, $total_bonos_meta);
							
							$sheet->setCellValue('T'.$fila, $nota);
							$sheet->setCellValue('U'.$fila, $newDate_fin);
							$giros_bonos_meta = 0;
						}
					}else if($giros_lenceria==1){
						$sheet->setCellValue('N'.$fila, 'Descuento Almacen');
						$spreadsheet->getActiveSheet()->getCell('O'.$fila)->setValue($cedula_modelo);
						$spreadsheet->getActiveSheet()->getStyle('O'.$fila)->getNumberFormat()->setFormatCode('00');
						$sheet->setCellValue('P'.$fila, '1');
						$sheet->setCellValue('Q'.$fila, 'Und.');
						$sheet->setCellValue('R'.$fila, $generarR);

						$total_lenceria = $valor_lenceria;
						$sheet->setCellValue('S'.$fila, $total_lenceria);
						
						$sheet->setCellValue('T'.$fila, $nota);
						$sheet->setCellValue('U'.$fila, $newDate_fin);
						$giros_lenceria = 0;
					}

					$sheet->getStyle('U'.$fila)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DDMMYYYY);

					$fila = $fila+1;
				}
			}
		}
	}
}


$fecha_inicio1 = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('Software Contable '.$fecha_inicio1.'.xlsx');
header("Location: Software Contable ".$fecha_inicio1.".xlsx");

?>