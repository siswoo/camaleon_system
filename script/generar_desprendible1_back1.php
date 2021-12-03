<?php
session_start();
include('conexion.php');
require '../resources/Spreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

$desprendible_fecha_desde 	= $_POST['desprendible_fecha_desde_hidden'];
$desprendible_fecha_hasta 	= $_POST['desprendible_fecha_hasta_hidden'];
$desprendible_trm 			= $_POST['desprendible_trm_hidden'];
/*
$desprendible_fecha_desde = '2020-11-01';
$desprendible_fecha_hasta = '2020-11-15';
$desprendible_trm = 3600;
*/
$responsable = $_SESSION['id'];
$fecha_inicio = date('Y-m-d');

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Sede');
$sheet->setCellValue('B1', 'Modelo');
$sheet->setCellValue('C1', 'Tipo Doc');
$sheet->setCellValue('D1', 'Numero Doc');
$sheet->setCellValue('E1', 'fecha inicio');
$sheet->setCellValue('F1', 'fecha fin');
$sheet->setCellValue('G1', 'Chaturbate');
$sheet->setCellValue('H1', 'Imlive');
$sheet->setCellValue('I1', 'Xlove');
$sheet->setCellValue('J1', 'Stripchat');
$sheet->setCellValue('K1', 'Streamate');
$sheet->setCellValue('L1', 'Myfreecams');
$sheet->setCellValue('M1', 'Livejasmin');
$sheet->setCellValue('N1', 'Bonga');
$sheet->setCellValue('O1', 'Cam4');
$sheet->setCellValue('P1', 'Camsoda');
$sheet->setCellValue('Q1', 'Flirt4free');
$sheet->setCellValue('R1', 'Total Tokens');
$sheet->setCellValue('S1', 'SubT Dolares');
$sheet->setCellValue('T1', 'RF');
$sheet->setCellValue('U1', 'Meta Porcentaje');
$sheet->setCellValue('V1', 'Total en Pesos');
$sheet->setCellValue('W1', 'Total Dolares');
$sheet->setCellValue('X1', 'TRM');
$sheet->setCellValue('Y1', 'PV');

$sheet->setCellValue('Z1', 'Descuento');
$sheet->setCellValue('AA1', 'Tienda');
$sheet->setCellValue('AB1', 'Avances');
$sheet->setCellValue('AC1', 'Multas');

$sheet->setCellValue('AD1', 'Bonos de Horas');
$sheet->setCellValue('AE1', 'Bonos Streamate');
$sheet->setCellValue('AF1', 'Sexshop');
$sheet->setCellValue('AG1', 'Sancion Pagina');

$fila = 2;

$sql5 = "DELETE FROM presabana WHERE inicio BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."' and fin BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
$consulta5 = mysqli_query($conexion,$sql5);

$sql1 = "SELECT * FROM modelos";
$consulta1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($consulta1)) {
	$modelo_id = $row1['id'];
	$modelo_sede = $row1['sede'];
	$documento_tipo = $row1['documento_tipo'];
	$documento_numero = $row1['documento_numero'];
	$modelo_nombre_completo = $row1['nombre1']." ".$row1['nombre2']." ".$row1['apellido1']." ".$row1['apellido2'];
	$turno = $row1['turno'];

	$sql2 = "SELECT * FROM modelos_cuentas WHERE id_modelos = ".$modelo_id;
	$consulta2 = mysqli_query($conexion,$sql2);

	$contador_tokens1 = 0;
	$contador_tokens_chaturbate1 = 0;
	$contador_tokens_myfreecams1 = 0;
	$contador_tokens_camsoda1 = 0;
	$contador_tokens_bonga1 = 0;
	$contador_tokens_stripchat1 = 0;
	$contador_tokens_cam41 = 0;
	$contador_tokens_streamate1 = 0;
	$contador_tokens_flirt4free1 = 0;
	$contador_tokens_livejasmin1 = 0;
	$contador_tokens_imlive1 = 0;
	$contador_tokens_xlove1 = 0;

	$contador_dolares_chaturbate1 = 0;
	$contador_dolares_myfreecams1 = 0;
	$contador_dolares_camsoda1 = 0;
	$contador_dolares_bonga1 = 0;
	$contador_dolares_stripchat1 = 0;
	$contador_dolares_cam41 = 0;
	$contador_dolares_streamate1 = 0;
	$contador_dolares_flirt4free1 = 0;
	$contador_dolares_livejasmin1 = 0;
	$contador_dolares_imlive1 = 0;
	$contador_dolares_xlove1 = 0;

	/**************CONSULTA DE PAGINAS************/

	while($row2 = mysqli_fetch_array($consulta2)) {
		
		if($row2['id_paginas']==1){
			$sql_paginas1 = "SELECT * FROM chaturbate WHERE nickname = '".$row2['usuario']."' and fecha BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_chaturbate1 = $contador_tokens_chaturbate1 + $row3['tokens'];
				$contador_dolares_chaturbate1 = $contador_dolares_chaturbate1 + $row3['payout'];
			}
		}

		if($row2['id_paginas']==2){
			$sql_paginas1 = "SELECT * FROM myfreecams WHERE id_modelo = ".$modelo_id." and fecha_desde BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."' and fecha_hasta BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_myfreecams1 = $contador_tokens_myfreecams1 + $row3['tokens'];
				$contador_dolares_myfreecams1 = $contador_dolares_myfreecams1 + $row3['dolares'];
			}
		}

		if($row2['id_paginas']==3){
			$sql_paginas1 = "SELECT * FROM camsoda WHERE id_modelo = ".$modelo_id." and fecha_desde BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_camsoda1 = $contador_tokens_camsoda1 + $row3['tokens'];
				$contador_dolares_camsoda1 = $contador_dolares_camsoda1 + $row3['dolares'];
			}
		}

		if($row2['id_paginas']==4){
			$sql_paginas1 = "SELECT * FROM bonga WHERE nickname = '".$row2['usuario']."' and fecha_desde BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."' and  fecha_hasta BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_bonga1 = $contador_tokens_bonga1 + $row3['tokens'];
				$contador_dolares_bonga1 = $contador_dolares_bonga1 + $row3['dolares'];
			}
		}

		if($row2['id_paginas']==5){
			$sql_paginas1 = "SELECT * FROM stripchat WHERE nickname = '".$row2['usuario']."' and fecha BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_stripchat1 = $contador_tokens_stripchat1 + $row3['tokens'];
				$contador_dolares_stripchat1 = $contador_dolares_stripchat1 + $row3['dolares'];
			}
		}

		if($row2['id_paginas']==6){
			if($row2['estatus']=='Aprobada'){
				$sql_paginas1 = "SELECT * FROM cam4 WHERE nickname = '".$row2['usuario']."' and fecha_desde BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."' and  fecha_hasta BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
				$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
				while($row3 = mysqli_fetch_array($consulta_paginas1)) {
					$contador_tokens_cam41 = $contador_tokens_cam41 + $row3['tokens'];
					$contador_dolares_cam41 = $contador_dolares_cam41 + $row3['dolares'];
				}
			}
		}

		if($row2['id_paginas']==7){
			$sql_paginas1 = "SELECT * FROM streamate WHERE nickname = '".$row2['usuario']."' and fecha_desde BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."' and  fecha_hasta BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_streamate1 = $contador_tokens_streamate1 + $row3['tokens'];
				$contador_dolares_streamate1 = $contador_dolares_streamate1 + $row3['ganancia'];
			}
		}

		if($row2['id_paginas']==8){
			$sql_paginas1 = "SELECT * FROM flirt4free WHERE id_modelo = '".$modelo_id."' and fecha_desde BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."' and  fecha_hasta BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_flirt4free1 = $contador_tokens_flirt4free1 + $row3['tokens'];
				$contador_dolares_flirt4free1 = $contador_dolares_flirt4free1 + $row3['dolares'];
			}
		}

		if($row2['id_paginas']==9){
			$sql_paginas1 = "SELECT * FROM livejasmin WHERE id_modelo = '".$modelo_id."' and fecha_desde BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."' and  fecha_hasta BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_livejasmin1 = $contador_tokens_livejasmin1 + $row3['tokens'];
				$contador_dolares_livejasmin1 = $contador_dolares_livejasmin1 + $row3['dolares'];
			}
		}

		if($row2['id_paginas']==10){
			$sql_paginas1 = "SELECT * FROM imlive WHERE nickname = '".$row2['usuario']."' and fecha_desde BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."' and  fecha_hasta BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_imlive1 = $contador_tokens_imlive1 + $row3['tokens'];
				$contador_dolares_imlive1 = $contador_dolares_imlive1 + $row3['dolares'];
			}
		}

		if($row2['id_paginas']==11){
			$sql_paginas1 = "SELECT * FROM xlove WHERE nickname = '".$row2['nickname_xlove']."' and fecha_desde BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."' and  fecha_hasta BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_xlove1 = $contador_tokens_xlove1 + $row3['tokens'];
				$contador_dolares_xlove1 = $contador_dolares_xlove1 + $row3['dolares'];
			}
		}
	}


		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(60);
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

		$sql3 = "SELECT * FROM sedes WHERE id = ".$modelo_sede;
		$consulta3 = mysqli_query($conexion,$sql3);
		while($row3 = mysqli_fetch_array($consulta3)) {
			$nombre_sede = $row3['nombre'];
		}

		$sheet->setCellValue('A'.$fila, $nombre_sede);
		$sheet->setCellValue('B'.$fila, $modelo_nombre_completo);
		$sheet->setCellValue('C'.$fila, $documento_tipo);
		$spreadsheet->getActiveSheet()->getCell('D'.$fila)->setValue($documento_numero);
		$spreadsheet->getActiveSheet()->getStyle('D'.$fila)->getNumberFormat()->setFormatCode('00');
		$sheet->setCellValue('E'.$fila, $desprendible_fecha_desde);
		$sheet->setCellValue('F'.$fila, $desprendible_fecha_hasta);
		$sheet->setCellValue('G'.$fila, $contador_tokens_chaturbate1);
		$sheet->setCellValue('H'.$fila, $contador_tokens_imlive1);
		$sheet->setCellValue('I'.$fila, $contador_tokens_xlove1);
		$sheet->setCellValue('J'.$fila, $contador_tokens_stripchat1);
		$sheet->setCellValue('K'.$fila, $contador_tokens_streamate1);
		$sheet->setCellValue('L'.$fila, $contador_tokens_myfreecams1);
		$sheet->setCellValue('M'.$fila, $contador_tokens_livejasmin1);
		$sheet->setCellValue('N'.$fila, $contador_tokens_bonga1);
		$sheet->setCellValue('O'.$fila, $contador_tokens_cam41);
		$sheet->setCellValue('P'.$fila, $contador_tokens_camsoda1);
		$sheet->setCellValue('Q'.$fila, $contador_tokens_flirt4free1);

		$total_tokens = $contador_tokens_chaturbate1+$contador_tokens_myfreecams1+$contador_tokens_camsoda1+$contador_tokens_bonga1+$contador_tokens_stripchat1+$contador_tokens_cam41+$contador_tokens_streamate1+$contador_tokens_flirt4free1+$contador_tokens_livejasmin1+$contador_tokens_imlive1+$contador_tokens_xlove1;

		$sheet->setCellValue('R'.$fila, $total_tokens);

		$subt_total_dolares = $total_tokens*0.05;

		$sheet->setCellValue('S'.$fila, $subt_total_dolares);

		if($total_tokens==0){
			$meta1 = '0%';
			$meta2 = 0;
			$meta3 = 0;
		}

		if($total_tokens>=1 and $total_tokens<=9999){
			$meta1 = '50%';
			$meta2 = 50;
			$meta3 = 0.5;
		}

		if($total_tokens>=10000 and $total_tokens<=14999){
			$meta1 = '55%';
			$meta2 = 55;
			$meta3 = 0.55;
		}

		if($total_tokens>=15000 and $total_tokens<=34999){
			$meta1 = '60%';
			$meta2 = 60;
			$meta3 = 0.6;
		}

		if($total_tokens>=35000){
			$meta1 = '65%';
			$meta2 = 65;
			$meta3 = 0.65;
		}

		$meta_porcentaje = $meta2;

		if($turno=='Satelite'){
			$meta1 = '80%';
			$meta_porcentaje = 80;
			$meta3 = 0.8;
		}

		$sheet->setCellValue('U'.$fila, $meta_porcentaje);

		//$total_dolares = $subt_total_dolares-$retencion_fuente;
		$total_dolares = $subt_total_dolares*$meta3;
		//$total_dolares = $total_dolares-$retencion_fuente;

		$bono1 = 0;

		if($total_tokens>=50000 and $total_tokens<=79999){
			$bono1 = 100000/$desprendible_trm;
		}

		if($total_tokens>=80000 and $total_tokens<=99999){
			$bono1 = 300000/$desprendible_trm;
		}

		if($total_tokens>=100000){
			$bono1 = 500000/$desprendible_trm;
		}

		$total_dolares = $total_dolares+$bono1;

		$total_pesos = $total_dolares*$desprendible_trm;
		//$total_pesos = $total_pesos*$meta3;

		$sheet->setCellValue('W'.$fila, $total_dolares);

		$sheet->setCellValue('X'.$fila, $desprendible_trm);

		/**************FORMULA DE PV*******************/
		/*** TOTAL TOKENS / (TDOLARES-RF*PORC. META)***/
		/**********************************************/

		$fvp1 = $total_dolares;
		$fvp1 = $fvp1*$desprendible_trm;

		if($fvp1==0){
			$fpv2 = 0;
			$retencion_fuente = 0;
		}else{
			$fpv2 = $fvp1/$total_tokens;
			$retencion_fuente = ((($total_tokens*$fpv2)/$meta3)*0.03)/$desprendible_trm;
			/*
			echo '<div class="col-12"><p>';
			echo "Cedula = ".$documento_numero;
			echo " tokens = ".$total_tokens;
			echo " pv = ".$fpv2;
			echo " meta3 = ".$meta3;
			echo " Total = ".((($total_tokens*$fpv2)/$meta3)*0.03)/$desprendible_trm;
			echo '</p></div>';
			*/
		}

		$sheet->setCellValue('T'.$fila, $retencion_fuente);

		$sheet->setCellValue('Y'.$fila, $fpv2);

		$sql6 = "SELECT * FROM descuento WHERE id_modelo = ".$modelo_id." and fecha_inicio BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
		$consulta6 = mysqli_query($conexion,$sql6);
		$contador_descuento = 0;
		while($row_descuento = mysqli_fetch_array($consulta6)) {
			$concepto_descuento = $row_descuento['concepto'];
			$valor_descuento = $row_descuento['valor'];
			$contador_descuento = $valor_descuento + $contador_descuento;
		}

		$sql7 = "SELECT * FROM tienda WHERE id_modelo = ".$modelo_id." and fecha_inicio BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
		$consulta7 = mysqli_query($conexion,$sql7);
		$contador_tienda = 0;
		while($row_tienda = mysqli_fetch_array($consulta7)) {
			$concepto_tienda = $row_tienda['concepto'];
			$valor_tienda = $row_tienda['valor'];
			$contador_tienda = $valor_tienda + $contador_tienda;
		}

		$sql8 = "SELECT * FROM avances WHERE id_modelo = ".$modelo_id." and fecha_desde BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."' and fecha_hasta BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
		$consulta8 = mysqli_query($conexion,$sql8);
		$contador_avances = 0;
		while($row_avances = mysqli_fetch_array($consulta8)) {
			$concepto_avances = $row_avances['concepto'];
			$valor_avances = $row_avances['valor'];
			$contador_avances = $valor_avances + $contador_avances;
		}

		$sql9 = "SELECT * FROM multas WHERE id_modelo = ".$modelo_id." and fecha_desde BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."' and fecha_hasta BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
		$consulta9 = mysqli_query($conexion,$sql9);
		$contador_multas = 0;
		while($row_multas = mysqli_fetch_array($consulta9)) {
			$concepto_multas = $row_multas['concepto'];
			$valor_multas = $row_multas['valor'];
			$contador_multas = $valor_multas + $contador_multas;
		}

		$sql10 = "SELECT * FROM bonos_horas WHERE id_modelo = ".$modelo_id." and fecha_desde BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."' and fecha_hasta BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
		$consulta10 = mysqli_query($conexion,$sql10);
		$contador_bonos_horas = 0;
		while($row_bonos_horas = mysqli_fetch_array($consulta10)) {
			$concepto_bonos_horas = $row_bonos_horas['concepto'];
			$valor_bonos_horas = $row_bonos_horas['monto'];
			$contador_bonos_horas = $valor_bonos_horas + $contador_bonos_horas;
		}

		$sql11 = "SELECT * FROM bonos_streamate WHERE id_modelo = ".$modelo_id." and fecha_desde BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."' and fecha_hasta BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
		$consulta11 = mysqli_query($conexion,$sql11);
		$contador_bonos_streamate = 0;
		while($row_bonos_streamate = mysqli_fetch_array($consulta11)) {
			$concepto_streamate = $row_bonos_streamate['concepto'];
			$valor_streamate = $row_bonos_streamate['monto'];
			$contador_bonos_streamate = $valor_streamate + $contador_bonos_streamate;
		}

		$sql12 = "SELECT * FROM sexshop WHERE id_modelo = ".$modelo_id." and fecha_desde BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."' and fecha_hasta BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
		$consulta12 = mysqli_query($conexion,$sql12);
		$contador_sexshop = 0;
		while($row_sexshop = mysqli_fetch_array($consulta12)) {
			$concepto_sexshop = $row_sexshop['concepto'];
			$valor_sexshop = $row_sexshop['monto'];
			$contador_sexshop = $valor_sexshop + $contador_sexshop;
		}

		$sql13 = "SELECT * FROM sancionpagina WHERE id_modelo = ".$modelo_id." and fecha_desde BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."' and fecha_hasta BETWEEN '".$desprendible_fecha_desde."' AND '".$desprendible_fecha_hasta."'";
		$consulta13 = mysqli_query($conexion,$sql13);
		$contador_sancionpagina = 0;
		while($row_sancionpagina = mysqli_fetch_array($consulta13)) {
			$concepto_sancionpagina = $row_sancionpagina['concepto'];
			$valor_sancionpagina = $row_sancionpagina['monto'];
			$contador_sancionpagina = $valor_sancionpagina + $contador_sancionpagina;
		}

		if($turno=='Satelite'){
			$contador_descuento = 0;
			$contador_tienda = 0;
			$contador_avances = 0;
			$contador_multas = 0;
			$contador_bonos_horas = 0;
			$as = 0;
		}

		$sheet->setCellValue('Z'.$fila, $contador_descuento);
		$sheet->setCellValue('AA'.$fila, $contador_tienda);
		$sheet->setCellValue('AB'.$fila, $contador_avances);
		$sheet->setCellValue('AC'.$fila, $contador_multas);

		$sheet->setCellValue('AD'.$fila, $contador_bonos_horas);

		if($contador_bonos_streamate>=1){
			$contador_bonos_streamate = $contador_bonos_streamate*$desprendible_trm;
		}

		if($turno=='Satelite'){
			$contador_bonos_streamate = 0;
		}

		$sheet->setCellValue('AE'.$fila, $contador_bonos_streamate);
		$sheet->setCellValue('AF'.$fila, $contador_sexshop);

		if($contador_sancionpagina>=1){
			$contador_sancionpagina = $contador_sancionpagina*$desprendible_trm;
		}

		if($turno=='Satelite'){
			$contador_sancionpagina = 0;
		}
		
		$sheet->setCellValue('AG'.$fila, $contador_sancionpagina);


		$descuentos_totales = $contador_descuento+$contador_tienda+$contador_avances+$contador_multas+$contador_sexshop+$contador_sancionpagina;
		$bonos_totales = $contador_bonos_horas+$contador_bonos_streamate;
		$total_pesos_final1 = $total_pesos-$descuentos_totales+$bonos_totales;
		$retencion_fuente_pesos = $retencion_fuente*$desprendible_trm;
		$total_pesos_final1 = $total_pesos_final1-$retencion_fuente_pesos;


		$sheet->setCellValue('V'.$fila, $total_pesos_final1);

		$fila = $fila+1;

		$sql4 = "INSERT INTO presabana (id_modelo,sede,inicio,fin,chaturbate,imlive,xlove,stripchat,streamate,myfreecams,livejasmin,bonga,cam4,camsoda,flirt4free,total_tokens,subtotal_dolares,rf,meta_porcentajes,total_pesos,total_dolares,trm,pv,responsable,estatus,fecha_inicio) VALUES ('$modelo_id','$modelo_sede','$desprendible_fecha_desde','$desprendible_fecha_hasta','$contador_tokens_chaturbate1','$contador_tokens_imlive1','$contador_tokens_xlove1','$contador_tokens_stripchat1','$contador_tokens_streamate1','$contador_tokens_myfreecams1','$contador_tokens_livejasmin1','$contador_tokens_bonga1','$contador_tokens_cam41','$contador_tokens_camsoda1','$contador_tokens_flirt4free1','$total_tokens','$subt_total_dolares','$retencion_fuente','$meta_porcentaje','$total_pesos','$total_dolares','$desprendible_trm','$fpv2','$responsable','Pendiente','$fecha_inicio')";
		$consulta4 = mysqli_query($conexion,$sql4);
}


$fecha_inicio1 = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('../resources/documentos/presabanas/presabana '.$fecha_inicio1.'.xlsx');
header("Location: ../resources/documentos/presabanas/presabana ".$fecha_inicio1.".xlsx");

?>