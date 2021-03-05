<?php
include('conexion.php');

$condicion = $_POST['condicion'];

if($condicion=='borrar'){
	$id = $_POST['id_tipo'];
	$tipo = $_POST['tipo'];
	//$sql1 = "UPDATE ".$tipo." SET estado = 'Eliminado' WHERE id = ".$id;
	$sql1 = "DELETE FROM ".$tipo." WHERE id = ".$id;
	$consulta1 = mysqli_query($conexion,$sql1);

	$datos = [
		"resultado" => 'ok',
	];
}

if($condicion=='consultar'){
	$corte = $_POST['corte'];
	$total1 = 0;
	$total2 = 0;
	$total3 = 0;
	$total4 = 0;

	$sede1_chaturbate = 0;
	$sede1_bonga = 0;
	$sede1_stripchat = 0;
	$sede1_cam4 = 0;
	$sede1_streamate = 0;
	$sede1_camsoda = 0;
	$sede1_imlive = 0;
	$sede1_xlove = 0;
	$sede1_myfreecams = 0;
	$sede1_flirt4free = 0;

	$sede2_chaturbate = 0;
	$sede2_bonga = 0;
	$sede2_stripchat = 0;
	$sede2_cam4 = 0;
	$sede2_streamate = 0;
	$sede2_camsoda = 0;
	$sede2_imlive = 0;
	$sede2_xlove = 0;
	$sede2_myfreecams = 0;
	$sede2_flirt4free = 0;

	$sede3_chaturbate = 0;
	$sede3_bonga = 0;
	$sede3_stripchat = 0;
	$sede3_cam4 = 0;
	$sede3_streamate = 0;
	$sede3_camsoda = 0;
	$sede3_imlive = 0;
	$sede3_xlove = 0;
	$sede3_myfreecams = 0;
	$sede3_flirt4free = 0;

	$sede4_chaturbate = 0;
	$sede4_bonga = 0;
	$sede4_stripchat = 0;
	$sede4_cam4 = 0;
	$sede4_streamate = 0;
	$sede4_camsoda = 0;
	$sede4_imlive = 0;
	$sede4_xlove = 0;
	$sede4_myfreecams = 0;
	$sede4_flirt4free = 0;

	$sql1 = "SELECT * FROM presabana WHERE id = ".$corte;
	$consulta1 = mysqli_query($conexion,$sql1);
	while($row1 = mysqli_fetch_array($consulta1)) {
		$inicio = $row1['inicio'];
		$fin = $row1['fin'];

		/****************************************************TOTAL**************************************************************/
		$sql2 = "SELECT SUM(tokens) as tokens, SUM(payout) as dolares FROM chaturbate WHERE fecha BETWEEN '".$inicio."' AND '".$fin."'";
		$consulta2 = mysqli_query($conexion,$sql2);
		while($row2 = mysqli_fetch_array($consulta2)) {
			$chaturbate_tokens = $row2['tokens'];
			$chaturbate_dolares = $chaturbate_tokens*0.05;
		}

		$sql3 = "SELECT SUM(tokens) as tokens, SUM(dolares) as dolares FROM bonga WHERE fecha_desde BETWEEN '".$inicio."' AND '".$fin."' and fecha_hasta BETWEEN '".$inicio."' AND '".$fin."'";
		$consulta3 = mysqli_query($conexion,$sql3);
		while($row3 = mysqli_fetch_array($consulta3)) {
			$bonga_tokens = $row3['tokens'];
			$bonga_dolares = $row3['dolares'];
		}

		$sql4 = "SELECT SUM(tokens) as tokens, SUM(dolares) as dolares FROM stripchat WHERE fecha BETWEEN '".$inicio."' AND '".$fin."'";
		$consulta4 = mysqli_query($conexion,$sql4);
		while($row4 = mysqli_fetch_array($consulta4)) {
			$stripchat_tokens = $row4['tokens'];
			$stripchat_dolares = $row4['dolares'];
		}

		$sql5 = "SELECT SUM(tokens) as tokens, SUM(dolares) as dolares FROM cam4 WHERE fecha_desde BETWEEN '".$inicio."' AND '".$fin."' and fecha_hasta BETWEEN '".$inicio."' AND '".$fin."'";
		$consulta5 = mysqli_query($conexion,$sql5);
		while($row5 = mysqli_fetch_array($consulta5)) {
			$cam4_tokens = $row5['tokens'];
			$cam4_dolares = $row5['dolares'];
		}

		$sql6 = "SELECT SUM(tokens) as tokens, SUM(ganancia) as dolares FROM streamate WHERE fecha_desde BETWEEN '".$inicio."' AND '".$fin."' and fecha_hasta BETWEEN '".$inicio."' AND '".$fin."'";
		$consulta6 = mysqli_query($conexion,$sql6);
		while($row6 = mysqli_fetch_array($consulta6)) {
			$streamate_tokens = $row6['tokens'];
			$streamate_dolares = $row6['dolares'];
		}

		$sql7 = "SELECT SUM(tokens) as tokens, SUM(dolares) as dolares FROM camsoda WHERE fecha_desde BETWEEN '".$inicio."' AND '".$fin."' and fecha_hasta BETWEEN '".$inicio."' AND '".$fin."'";
		$consulta7 = mysqli_query($conexion,$sql7);
		while($row7 = mysqli_fetch_array($consulta7)) {
			$camsoda_tokens = $row7['tokens'];
			$camsoda_dolares = $row7['dolares'];
		}

		/*******************************PAXUM***********************/
		$sql8 = "SELECT SUM(tokens) as tokens, SUM(dolares) as dolares FROM imlive WHERE fecha_desde BETWEEN '".$inicio."' AND '".$fin."' and fecha_hasta BETWEEN '".$inicio."' AND '".$fin."'";
		$consulta8 = mysqli_query($conexion,$sql8);
		while($row8 = mysqli_fetch_array($consulta8)) {
			$imlive_tokens = $row8['tokens'];
			$imlive_dolares = $row8['dolares'];
		}

		$sql15 = "SELECT SUM(tokens) as tokens, SUM(dolares) as dolares FROM xlove WHERE fecha_desde BETWEEN '".$inicio."' AND '".$fin."' and fecha_hasta BETWEEN '".$inicio."' AND '".$fin."'";
		$consulta15 = mysqli_query($conexion,$sql15);
		while($row15 = mysqli_fetch_array($consulta15)) {
			$xlove_tokens = $row15['tokens'];
			$xlove_dolares = $row15['dolares'];
		}		
		/************************************************************/

		/**********************EPAY******************************/
		$sql9 = "SELECT SUM(tokens) as tokens, SUM(dolares) as dolares FROM myfreecams WHERE fecha_desde BETWEEN '".$inicio."' AND '".$fin."' and fecha_hasta BETWEEN '".$inicio."' AND '".$fin."'";
		$consulta9 = mysqli_query($conexion,$sql9);
		while($row9 = mysqli_fetch_array($consulta9)) {
			$epay_tokens = $row9['tokens'];
			$epay_dolares = $row9['dolares'];
		}
		/********************************************************/

		/**********************Flirt4free******************************/
		$sql17 = "SELECT SUM(tokens) as tokens, SUM(dolares) as dolares FROM flirt4free WHERE fecha_desde BETWEEN '".$inicio."' AND '".$fin."' and fecha_hasta BETWEEN '".$inicio."' AND '".$fin."'";
		$consulta17 = mysqli_query($conexion,$sql17);
		while($row17 = mysqli_fetch_array($consulta17)) {
			$flirt4free_tokens = $row17['tokens'];
			$flirt4free_dolares = $row17['dolares'];
		}
		/********************************************************/
		/*****************************************************************************************************************************/

		/****************************************************SEDES**************************************************************/
		$sql10 = "SELECT * FROM modelos WHERE estatus = 'Activa'";
		$consulta10 = mysqli_query($conexion,$sql10);
		while($row10 = mysqli_fetch_array($consulta10)) {
			$sede = $row10['sede'];
			$id_modelo = $row10['id'];
			if($sede==1){
				$sql11 = "SELECT SUM(chaturbate) as chaturbate, SUM(bonga) as bonga, SUM(stripchat) as stripchat, SUM(cam4) as cam4, SUM(streamate) as streamate, SUM(camsoda) as camsoda, SUM(imlive) as imlive, SUM(xlove) as xlove, SUM(myfreecams) as myfreecams, SUM(flirt4free) as flirt4free FROM presabana WHERE id_modelo = ".$id_modelo." and inicio BETWEEN '".$inicio."' AND '".$fin."' and fin BETWEEN '".$inicio."' AND '".$fin."'";
				$consulta11 = mysqli_query($conexion,$sql11);
				while($row11 = mysqli_fetch_array($consulta11)) {
					$sede1_chaturbate = $sede1_chaturbate+$row11['chaturbate'];
					$sede1_bonga = $sede1_bonga+$row11['bonga'];
					$sede1_stripchat = $sede1_stripchat+$row11['stripchat'];
					$sede1_cam4 = $sede1_cam4+$row11['cam4'];
					$sede1_streamate = $sede1_streamate+$row11['streamate'];
					$sede1_camsoda = $sede1_camsoda+$row11['camsoda'];
					$sede1_imlive = $sede1_imlive+$row11['imlive'];
					$sede1_xlove = $sede1_xlove+$row11['xlove'];
					$sede1_myfreecams = $sede1_myfreecams+$row11['myfreecams'];
					$sede1_flirt4free = $sede1_flirt4free+$row11['flirt4free'];
				}
			}

			if($sede==2){
				$sql12 = "SELECT SUM(chaturbate) as chaturbate, SUM(bonga) as bonga, SUM(stripchat) as stripchat, SUM(cam4) as cam4, SUM(streamate) as streamate, SUM(camsoda) as camsoda, SUM(imlive) as imlive, SUM(xlove) as xlove, SUM(myfreecams) as myfreecams, SUM(flirt4free) as flirt4free FROM presabana WHERE id_modelo = ".$id_modelo." and inicio BETWEEN '".$inicio."' AND '".$fin."' and fin BETWEEN '".$inicio."' AND '".$fin."'";
				$consulta12 = mysqli_query($conexion,$sql12);
				while($row12 = mysqli_fetch_array($consulta12)) {
					$sede2_chaturbate = $sede2_chaturbate+$row12['chaturbate'];
					$sede2_bonga = $sede2_bonga+$row12['bonga'];
					$sede2_stripchat = $sede2_stripchat+$row12['stripchat'];
					$sede2_cam4 = $sede2_cam4+$row12['cam4'];
					$sede2_streamate = $sede2_streamate+$row12['streamate'];
					$sede2_camsoda = $sede2_camsoda+$row12['camsoda'];
					$sede2_imlive = $sede2_imlive+$row12['imlive'];
					$sede2_xlove = $sede2_xlove+$row12['xlove'];
					$sede2_myfreecams = $sede2_myfreecams+$row12['myfreecams'];
					$sede2_flirt4free = $sede2_flirt4free+$row12['flirt4free'];
				}
			}

			if($sede==3){
				$sql13 = "SELECT SUM(chaturbate) as chaturbate, SUM(bonga) as bonga, SUM(stripchat) as stripchat, SUM(cam4) as cam4, SUM(streamate) as streamate, SUM(camsoda) as camsoda, SUM(imlive) as imlive, SUM(xlove) as xlove, SUM(myfreecams) as myfreecams, SUM(flirt4free) as flirt4free FROM presabana WHERE id_modelo = ".$id_modelo." and inicio BETWEEN '".$inicio."' AND '".$fin."' and fin BETWEEN '".$inicio."' AND '".$fin."'";
				$consulta13 = mysqli_query($conexion,$sql13);
				while($row13 = mysqli_fetch_array($consulta13)) {
					$sede3_chaturbate = $sede3_chaturbate+$row13['chaturbate'];
					$sede3_bonga = $sede3_bonga+$row13['bonga'];
					$sede3_stripchat = $sede3_stripchat+$row13['stripchat'];
					$sede3_cam4 = $sede3_cam4+$row13['cam4'];
					$sede3_streamate = $sede3_streamate+$row13['streamate'];
					$sede3_camsoda = $sede3_camsoda+$row13['camsoda'];
					$sede3_imlive = $sede3_imlive+$row13['imlive'];
					$sede3_xlove = $sede3_xlove+$row13['xlove'];
					$sede3_myfreecams = $sede3_myfreecams+$row13['myfreecams'];
					$sede3_flirt4free = $sede3_flirt4free+$row13['flirt4free'];
				}
			}

			if($sede==4){
				$sql14 = "SELECT SUM(chaturbate) as chaturbate, SUM(bonga) as bonga, SUM(stripchat) as stripchat, SUM(cam4) as cam4, SUM(streamate) as streamate, SUM(camsoda) as camsoda, SUM(imlive) as imlive, SUM(xlove) as xlove, SUM(myfreecams) as myfreecams, SUM(flirt4free) as flirt4free FROM presabana WHERE id_modelo = ".$id_modelo." and inicio BETWEEN '".$inicio."' AND '".$fin."' and fin BETWEEN '".$inicio."' AND '".$fin."'";
				$consulta14 = mysqli_query($conexion,$sql14);
				while($row14 = mysqli_fetch_array($consulta14)) {
					$sede4_chaturbate = $sede4_chaturbate+$row14['chaturbate'];
					$sede4_bonga = $sede4_bonga+$row14['bonga'];
					$sede4_stripchat = $sede4_stripchat+$row14['stripchat'];
					$sede4_cam4 = $sede4_cam4+$row14['cam4'];
					$sede4_streamate = $sede4_streamate+$row14['streamate'];
					$sede4_camsoda = $sede4_camsoda+$row14['camsoda'];
					$sede4_imlive = $sede4_imlive+$row14['imlive'];
					$sede4_xlove = $sede4_xlove+$row14['xlove'];
					$sede4_myfreecams = $sede4_myfreecams+$row14['myfreecams'];
					$sede4_flirt4free = $sede4_flirt4free+$row14['flirt4free'];
				}
			}
		}
		/*****************************************************************************************************************************/

	}

	$chaturbate_tokens = $chaturbate_tokens*1;
	$chaturbate_dolares = $chaturbate_tokens*0.05;

	$bonga_tokens = $bonga_tokens*1;
	$bonga_dolares = $bonga_tokens*0.05;

	$stripchat_tokens = $stripchat_tokens*1;
	$stripchat_dolares = $stripchat_tokens*0.05;

	$cam4_tokens = $cam4_tokens*1;
	$cam4_dolares = $cam4_tokens*0.05;

	$streamate_tokens = $streamate_tokens*1;
	$streamate_dolares = $streamate_tokens*0.05;

	$camsoda_tokens = $camsoda_tokens*1;
	$camsoda_dolares = $camsoda_tokens*0.05;
	
	$paxum_tokens = $imlive_tokens+$xlove_tokens;
	$paxum_dolares = $imlive_dolares+$xlove_dolares;

	$epay_tokens = $epay_tokens*1;
	$epay_dolares = $epay_tokens*0.05;

	$flirt4free_tokens = $flirt4free_tokens*1;
	$flirt4free_dolares = $flirt4free_tokens*0.05;

	$sede1_chaturbate = $sede1_chaturbate*0.05;
	$sede1_bonga = $sede1_bonga*0.05;
	$sede1_stripchat = $sede1_stripchat*0.05;
	$sede1_cam4 = $sede1_cam4*0.05;
	$sede1_streamate = $sede1_streamate*0.05;
	$sede1_camsoda = $sede1_camsoda*0.05;
	$sede1_paxum = ($sede1_imlive+$sede1_xlove)*0.05;
	$sede1_epay = $sede1_myfreecams*0.05;
	$sede1_flirt4free = $sede1_flirt4free*0.05;
	
	$sede2_chaturbate = $sede2_chaturbate*0.05;
	$sede2_bonga = $sede2_bonga*0.05;
	$sede2_stripchat = $sede2_stripchat*0.05;
	$sede2_cam4 = $sede2_cam4*0.05;
	$sede2_streamate = $sede2_streamate*0.05;
	$sede2_camsoda = $sede2_camsoda*0.05;
	$sede2_paxum = ($sede2_imlive+$sede2_xlove)*0.05;
	$sede2_epay = $sede2_myfreecams*0.05;
	$sede2_flirt4free = $sede2_flirt4free*0.05;

	$sede3_chaturbate = $sede3_chaturbate*0.05;
	$sede3_bonga = $sede3_bonga*0.05;
	$sede3_stripchat = $sede3_stripchat*0.05;
	$sede3_cam4 = $sede3_cam4*0.05;
	$sede3_streamate = $sede3_streamate*0.05;
	$sede3_camsoda = $sede3_camsoda*0.05;
	$sede3_paxum = ($sede3_imlive+$sede3_xlove)*0.05;
	$sede3_epay = $sede3_myfreecams*0.05;
	$sede3_flirt4free = $sede3_flirt4free*0.05;

	$sede4_chaturbate = $sede4_chaturbate*0.05;
	$sede4_bonga = $sede4_bonga*0.05;
	$sede4_stripchat = $sede4_stripchat*0.05;
	$sede4_cam4 = $sede4_cam4*0.05;
	$sede4_streamate = $sede4_streamate*0.05;
	$sede4_camsoda = $sede4_camsoda*0.05;
	$sede4_paxum = ($sede4_imlive+$sede4_xlove)*0.05;
	$sede4_epay = $sede4_myfreecams*0.05;
	$sede4_flirt4free = $sede4_flirt4free*0.05;

	$td_total_sede = $chaturbate_dolares+$bonga_dolares+$stripchat_dolares+$cam4_dolares+$streamate_dolares+$camsoda_dolares+$paxum_dolares+$epay_dolares+$flirt4free_dolares;
	$td_vipocc_sede = $sede1_chaturbate+$sede1_bonga+$sede1_stripchat+$sede1_cam4+$sede1_streamate+$sede1_camsoda+$sede1_paxum+$sede1_epay+$sede1_flirt4free;
	$td_norte_sede = $sede2_chaturbate+$sede2_bonga+$sede2_stripchat+$sede2_cam4+$sede2_streamate+$sede2_camsoda+$sede2_paxum+$sede2_epay+$sede2_flirt4free;
	$td_occ1_sede = $sede3_chaturbate+$sede3_bonga+$sede3_stripchat+$sede3_cam4+$sede3_streamate+$sede3_camsoda+$sede3_paxum+$sede3_epay+$sede3_flirt4free;
	$td_vipsuba_sede = $sede4_chaturbate+$sede4_bonga+$sede4_stripchat+$sede4_cam4+$sede4_streamate+$sede4_camsoda+$sede4_paxum+$sede4_epay+$sede4_flirt4free;

	$total_chaturbate_tokens = $sede1_chaturbate+$sede2_chaturbate+$sede3_chaturbate+$sede4_chaturbate;
	$total_bonga_tokens = $sede1_bonga+$sede2_bonga+$sede3_bonga+$sede4_bonga;
	$total_stripchat_tokens = $sede1_stripchat+$sede2_stripchat+$sede3_stripchat+$sede4_stripchat;
	$total_cam4_tokens = $sede1_cam4+$sede2_cam4+$sede3_cam4+$sede4_cam4;
	$total_streamate_tokens = $sede1_streamate+$sede2_streamate+$sede3_streamate+$sede4_streamate;
	$total_camsoda_tokens = $sede1_camsoda+$sede2_camsoda+$sede3_camsoda+$sede4_camsoda;
	//$total_paxum_tokens = $sede1_imlive+$sede2_imlive+$sede3_imlive+$sede4_imlive+$sede1_xlove+$sede2_xlove+$sede3_xlove+$sede4_xlove;
	//$total_epay_tokens = $sede1_myfreecams+$sede2_myfreecams+$sede3_myfreecams+$sede4_myfreecams;

	$total_flirt4free_dolares = $sede1_paxum+$sede2_paxum+$sede3_paxum+$sede4_paxum;
	$total_paxum_dolares = $sede1_paxum+$sede2_paxum+$sede3_paxum+$sede4_paxum;
	$total_epay_dolares = $sede1_epay+$sede2_epay+$sede3_epay+$sede4_epay;

	$total_flirt4free_tokens = $sede1_flirt4free+$sede2_flirt4free+$sede3_flirt4free+$sede4_flirt4free;

	$subtotal = $chaturbate_dolares+$bonga_dolares+$stripchat_dolares+$cam4_dolares+$streamate_dolares+$camsoda_dolares+$paxum_dolares+$epay_dolares+$flirt4free_dolares;

	$subtotal2 = $chaturbate_dolares+$bonga_dolares+$stripchat_dolares+$cam4_dolares+$streamate_dolares+$camsoda_dolares+$flirt4free_dolares;
	$subtotal3 = $paxum_dolares+$epay_dolares;

	$descuento1 = $subtotal2*0.025;
	$descuento2 = $subtotal3*0.03;

	$total = ($descuento1+$descuento2);
	$total = $subtotal-$total;

	$total_chaturbate_tokens = $chaturbate_dolares-$total_chaturbate_tokens;
	$total_bonga_tokens = $bonga_dolares-$total_bonga_tokens;
	$total_stripchat_tokens = $stripchat_dolares-$total_stripchat_tokens;
	$total_cam4_tokens = $cam4_dolares-$total_cam4_tokens;
	$total_streamate_tokens = $streamate_dolares-$total_streamate_tokens;
	$total_camsoda_tokens = $camsoda_dolares-$total_camsoda_tokens;
	$total_flirt4free_tokens = $flirt4free_dolares-$total_flirt4free_tokens;

	$total_paxum_dolares = $paxum_dolares-$total_paxum_dolares;
	$total_epay_dolares = $epay_dolares-$total_epay_dolares;

	$total_sinnombre_sede = $total_chaturbate_tokens+$total_bonga_tokens+$total_stripchat_tokens+$total_cam4_tokens+$total_streamate_tokens+$total_camsoda_tokens+$total_paxum_dolares+$total_epay_dolares;


	/********************************************COLORES***************************************************/
	/*
	$color_1_1 = 0;
	$color_1_2 = 0;
	$color_1_3 = 0;
	$color_1_4 = 0;
	$color_1_5 = 0;
	$color_1_6 = 0;
	$color_1_7 = 0;
	$color_1_8 = 0;

	$sql16 = "SELECT * FROM presabana WHERE inicio < '".$inicio."' and fin < '".$fin."'";
	$consulta16 = mysqli_query($conexion,$sql16);
	$contador1 = mysqli_num_rows($consulta16);
	if($contador1>=1){
		while($row16 = mysqli_fetch_array($consulta16)) {
			$inicio = $row16['inicio'];
			$fin = $row16['fin'];
		}



	}

	$datos = [
		"hola" => $sql16,
	];

	echo json_encode($datos);
	exit;
	*/
	/******************************************************************************************************/


	$datos = [
		"chaturbate_tokens" => number_format(round($chaturbate_tokens,2),2,',','.'),
		"chaturbate_dolares" => number_format(round($chaturbate_dolares,2),2,',','.'),

		"bonga_tokens" => number_format(round($bonga_tokens,2),2,',','.'),
		"bonga_dolares" => number_format(round($bonga_dolares,2),2,',','.'),

		"stripchat_tokens" => number_format(round($stripchat_tokens,2),2,',','.'),
		"stripchat_dolares" => number_format(round($stripchat_dolares,2),2,',','.'),

		"cam4_tokens" => number_format(round($cam4_tokens,2),2,',','.'),
		"cam4_dolares" => number_format(round($cam4_dolares,2),2,',','.'),

		"streamate_tokens" => number_format(round($streamate_tokens,2),2,',','.'),
		"streamate_dolares" => number_format(round($streamate_dolares,2),2,',','.'),

		"camsoda_tokens" => number_format(round($camsoda_tokens,2),2,',','.'),
		"camsoda_dolares" => number_format(round($camsoda_dolares,2),2,',','.'),

		"paxum_tokens" => number_format(round($paxum_tokens,2),2,',','.'),
		"paxum_dolares" => number_format(round($paxum_dolares,2),2,',','.'),
		
		"epay_tokens" => number_format(round($epay_tokens,2),2,',','.'),
		"epay_dolares" => number_format(round($epay_dolares,2),2,',','.'),

		"flirt4free_tokens" => number_format(round($flirt4free_tokens,2),2,',','.'),
		"flirt4free_dolares" => number_format(round($flirt4free_dolares,2),2,',','.'),

		"sede1_chaturbate" => number_format(round($sede1_chaturbate,2),2,',','.'),
		"sede1_bonga" => number_format(round($sede1_bonga,2),2,',','.'),
		"sede1_stripchat" => number_format(round($sede1_stripchat,2),2,',','.'),
		"sede1_cam4" => number_format(round($sede1_cam4,2),2,',','.'),
		"sede1_streamate" => number_format(round($sede1_streamate,2),2,',','.'),
		"sede1_camsoda" => number_format(round($sede1_camsoda,2),2,',','.'),
		"sede1_paxum" => number_format(round($sede1_paxum,2),2,',','.'),
		"sede1_epay" => number_format(round($sede1_epay,2),2,',','.'),
		"sede1_flirt4free" => number_format(round($sede1_flirt4free,2),2,',','.'),

		"sede2_chaturbate" => number_format(round($sede2_chaturbate,2),2,',','.'),
		"sede2_bonga" => number_format(round($sede2_bonga,2),2,',','.'),
		"sede2_stripchat" => number_format(round($sede2_stripchat,2),2,',','.'),
		"sede2_cam4" => number_format(round($sede2_cam4,2),2,',','.'),
		"sede2_streamate" => number_format(round($sede2_streamate,2),2,',','.'),
		"sede2_camsoda" => number_format(round($sede2_camsoda,2),2,',','.'),
		"sede2_paxum" => number_format(round($sede2_paxum,2),2,',','.'),
		"sede2_epay" => number_format(round($sede2_epay,2),2,',','.'),
		"sede2_flirt4free" => number_format(round($sede2_flirt4free,2),2,',','.'),

		"sede3_chaturbate" => number_format(round($sede3_chaturbate,2),2,',','.'),
		"sede3_bonga" => number_format(round($sede3_bonga,2),2,',','.'),
		"sede3_stripchat" => number_format(round($sede3_stripchat,2),2,',','.'),
		"sede3_cam4" => number_format(round($sede3_cam4,2),2,',','.'),
		"sede3_streamate" => number_format(round($sede3_streamate,2),2,',','.'),
		"sede3_camsoda" => number_format(round($sede3_camsoda,2),2,',','.'),
		"sede3_paxum" => number_format(round($sede3_paxum,2),2,',','.'),
		"sede3_epay" => number_format(round($sede3_epay,2),2,',','.'),
		"sede3_flirt4free" => number_format(round($sede3_flirt4free,2),2,',','.'),

		"sede4_chaturbate" => number_format(round($sede4_chaturbate,2),2,',','.'),
		"sede4_bonga" => number_format(round($sede4_bonga,2),2,',','.'),
		"sede4_stripchat" => number_format(round($sede4_stripchat,2),2,',','.'),
		"sede4_cam4" => number_format(round($sede4_cam4,2),2,',','.'),
		"sede4_streamate" => number_format(round($sede4_streamate,2),2,',','.'),
		"sede4_camsoda" => number_format(round($sede4_camsoda,2),2,',','.'),
		"sede4_paxum" => number_format(round($sede4_paxum,2),2,',','.'),
		"sede4_epay" => number_format(round($sede4_epay,2),2,',','.'),
		"sede4_flirt4free" => number_format(round($sede4_flirt4free,2),2,',','.'),

		"total_chaturbate_tokens" => number_format(round($total_chaturbate_tokens,2),2,',','.'),
		"total_bonga_tokens" => number_format(round($total_bonga_tokens,2),2,',','.'),
		"total_stripchat_tokens" => number_format(round($total_stripchat_tokens,2),2,',','.'),
		"total_cam4_tokens" => number_format(round($total_cam4_tokens,2),2,',','.'),
		"total_streamate_tokens" => number_format(round($total_streamate_tokens,2),2,',','.'),
		"total_camsoda_tokens" => number_format(round($total_camsoda_tokens,2),2,',','.'),
		"total_flirt4free_tokens" => number_format(round($total_flirt4free_tokens,2),2,',','.'),
		"total_paxum_tokens" => number_format(round($total_paxum_dolares,2),2,',','.'),
		"total_epay_tokens" => number_format(round($total_epay_dolares,2),2,',','.'),

		"subtotal" => number_format(round($subtotal,2),2,',','.'),
		"descuento1" => number_format(round($descuento1,2),2,',','.'),
		"descuento2" => number_format(round($descuento2,2),2,',','.'),
		"total" => number_format(round($total,2),2,',','.'),

		"total_sede" => number_format(round($td_total_sede,2),2,',','.'),

		"sede1_sede" => number_format(round($td_vipocc_sede,2),2,',','.'),
		"sede2_sede" => number_format(round($td_norte_sede,2),2,',','.'),
		"sede3_sede" => number_format(round($td_occ1_sede,2),2,',','.'),
		"sede4_sede" => number_format(round($td_vipsuba_sede,2),2,',','.'),

		"total_sinnombre_sede" => number_format(round($total_sinnombre_sede,2),2,',','.'),
	];
}

echo json_encode($datos);

?>