<?php
include('conexion.php');

$condicion = $_POST['condicion'];

if($condicion=='borrar'){
	$id = $_POST['id_tipo'];
	$tipo = $_POST['tipo'];
	$sql1 = "UPDATE ".$tipo." SET estado = 'Eliminado' WHERE id = ".$id;
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

	$sede2_chaturbate = 0;
	$sede2_bonga = 0;
	$sede2_stripchat = 0;
	$sede2_cam4 = 0;
	$sede2_streamate = 0;
	$sede2_camsoda = 0;
	$sede2_imlive = 0;
	$sede2_xlove = 0;
	$sede2_myfreecams = 0;

	$sede3_chaturbate = 0;
	$sede3_bonga = 0;
	$sede3_stripchat = 0;
	$sede3_cam4 = 0;
	$sede3_streamate = 0;
	$sede3_camsoda = 0;
	$sede3_imlive = 0;
	$sede3_xlove = 0;
	$sede3_myfreecams = 0;

	$sede4_chaturbate = 0;
	$sede4_bonga = 0;
	$sede4_stripchat = 0;
	$sede4_cam4 = 0;
	$sede4_streamate = 0;
	$sede4_camsoda = 0;
	$sede4_imlive = 0;
	$sede4_xlove = 0;
	$sede4_myfreecams = 0;

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
		$sql8 = "SELECT SUM(imlive.tokens) as Itokens, SUM(imlive.dolares) as Idolares, SUM(xlove.tokens) as Xtokens, SUM(xlove.dolares) as Xdolares FROM imlive, xlove WHERE imlive.fecha_desde BETWEEN '2020-11-01' AND '2020-11-15' and imlive.fecha_hasta BETWEEN '2020-11-01' AND '2020-11-15'";
		$consulta8 = mysqli_query($conexion,$sql8);
		while($row8 = mysqli_fetch_array($consulta8)) {
			$paxum_tokens = $row8['Itokens']+$row8['Xtokens'];
			$paxum_dolares = $row8['Idolares']+$row8['Xdolares'];
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
		/*****************************************************************************************************************************/


		/****************************************************SEDES**************************************************************/
		$sql10 = "SELECT * FROM modelos WHERE estatus = 'Activa'";
		$consulta10 = mysqli_query($conexion,$sql10);
		while($row10 = mysqli_fetch_array($consulta10)) {
			$sede = $row10['sede'];
			$id_modelo = $row10['id_modelo'];
			if($sede==1){
				$sql11 = "SELECT SUM(chaturbate) as chaturbate, SUM(chaturbate) as chaturbate, SUM(chaturbate) as chaturbate, SUM(chaturbate) as chaturbate, SUM(chaturbate) as chaturbate, SUM(chaturbate) as chaturbate, SUM(chaturbate) as chaturbate, SUM(chaturbate) as chaturbate, SUM(chaturbate) as chaturbate  FROM presabana WHERE id_modelo = ".$id_modelo." and inicio BETWEEN '".$inicio."' AND '".$fin."' and fin BETWEEN '".$inicio."' AND '".$fin."'";
				$consulta11 = mysqli_query($conexion,$sql11);
				
			}
		}
		/*****************************************************************************************************************************/

	}

	$datos = [
		"chaturbate_tokens" => $chaturbate_tokens*1,
		"chaturbate_dolares" => $chaturbate_dolares*1,

		"bonga_tokens" => $bonga_tokens*1,
		"bonga_dolares" => $bonga_dolares*1,

		"stripchat_tokens" => $stripchat_tokens*1,
		"stripchat_dolares" => $stripchat_dolares*1,

		"cam4_tokens" => $cam4_tokens*1,
		"cam4_dolares" => $cam4_dolares*1,

		"streamate_tokens" => $streamate_tokens*1,
		"streamate_dolares" => $streamate_dolares*1,

		"camsoda_tokens" => $camsoda_tokens*1,
		"camsoda_dolares" => $camsoda_dolares*1,

		"paxum_tokens" => $paxum_tokens*1,
		"paxum_dolares" => $paxum_dolares*1,
		
		"epay_tokens" => $epay_tokens*1,
		"epay_dolares" => $epay_dolares*1,
	];
}

echo json_encode($datos);

?>