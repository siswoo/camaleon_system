<?php
session_start();
include('../script/conexion.php');
require('../resources/fpdf/fpdf.php');

$id_modelo = $_GET['id'];
$presabana = $_GET['pre'];
$id_sede = $_SESSION['sede'];

$sql1 = "SELECT * FROM modelos WHERE id = ".$id_modelo;
$consulta1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($consulta1)) {
	$modelo_nombre = $row1['nombre1']." ".$row1['nombre2']." ".$row1['apellido1']." ".$row1['apellido2'];
	$modelo_tipo_documento = $row1['documento_tipo'];
	$modelo_cedula = $row1['documento_numero'];
	$turno = $row1['turno'];
}

$sql2 = "SELECT * FROM presabana WHERE id_modelo = ".$id_modelo." and id = ".$presabana;
$consulta2 = mysqli_query($conexion,$sql2);

while($row2 = mysqli_fetch_array($consulta2)) {
	$fecha_desde = $row2['inicio'];
	$fecha_hasta = $row2['fin'];
	$chaturbate = $row2['chaturbate'];
	$imlive = $row2['imlive'];
	$xlove = $row2['xlove'];
	$stripchat = $row2['stripchat'];
	$streamate = $row2['streamate'];
	$myfreecams = $row2['myfreecams'];
	$livejasmin = $row2['livejasmin'];
	$bonga = $row2['bonga'];
	$cam4 = $row2['cam4'];
	$camsoda = $row2['camsoda'];
	$flirt4free = $row2['flirt4free'];
	$amateur = $row2['amateur'];
	$streamray = $row2['streamray'];
	$meta_porcentajes = $row2['meta_porcentajes'];
	$deducidos = 0;
	$pv = $row2['pv'];
	$rf = $row2['rf'];
	$trm = $row2['trm'];

	$total_pesos_chaturbate = $chaturbate*0.05;
	$total_pesos_chaturbate = $total_pesos_chaturbate*$trm;

	$total_pesos_imlive 	= $imlive*0.05;
	$total_pesos_imlive 	= $total_pesos_imlive*$trm;

	$total_pesos_xlove 		= $xlove*0.05;
	$total_pesos_xlove 		= $total_pesos_xlove*$trm;

	$total_pesos_stripchat 	= $stripchat*0.05;
	$total_pesos_stripchat 	= $total_pesos_stripchat*$trm;

	$total_pesos_streamate 	= $streamate*0.05;
	$total_pesos_streamate 	= $total_pesos_streamate*$trm;

	$total_pesos_myfreecams = $myfreecams*0.05;
	$total_pesos_myfreecams = $total_pesos_myfreecams*$trm;

	$total_pesos_livejasmin = $livejasmin*0.05;
	$total_pesos_livejasmin = $total_pesos_livejasmin*$trm;

	$total_pesos_bonga 		= $bonga*0.05;
	$total_pesos_bonga 		= $total_pesos_bonga*$trm;

	$total_pesos_cam4 		= $cam4*0.05;
	$total_pesos_cam4 		= $total_pesos_cam4*$trm;

	$total_pesos_camsoda 	= $camsoda*0.05;
	$total_pesos_camsoda 	= $total_pesos_camsoda*$trm;

	$total_pesos_flirt4free = $flirt4free*0.05;
	$total_pesos_flirt4free = $total_pesos_flirt4free*$trm;

	$total_pesos_amateur = $amateur*0.05;
	$total_pesos_amateur = $total_pesos_amateur*$trm;

	$total_pesos_streamray = $streamray*0.05;
	$total_pesos_streamray = $total_pesos_streamray*$trm;

	$total_final1 = $total_pesos_chaturbate+$total_pesos_imlive+$total_pesos_xlove+$total_pesos_stripchat+$total_pesos_streamate+$total_pesos_myfreecams+$total_pesos_livejasmin+$total_pesos_bonga+$total_pesos_cam4+$total_pesos_camsoda+$total_pesos_flirt4free+$total_pesos_amateur+$total_pesos_streamray;

	$total_devengado_chaturbate 	= $chaturbate*$pv;
	$total_devengado_imlive 		= $imlive*$pv;
	$total_devengado_xlove 			= $xlove*$pv;
	$total_devengado_stripchat 		= $stripchat*$pv;
	$total_devengado_streamate 		= $streamate*$pv;
	$total_devengado_myfreecams 	= $myfreecams*$pv;
	$total_devengado_livejasmin 	= $livejasmin*$pv;
	$total_devengado_bonga 			= $bonga*$pv;
	$total_devengado_cam4 			= $cam4*$pv;
	$total_devengado_camsoda 		= $camsoda*$pv;
	$total_devengado_flirt4free 	= $flirt4free*$pv;
	$total_devengado_amateur 		= $amateur*$pv;
	$total_devengado_streamray 		= $streamray*$pv;

	class PDF extends FPDF{}

	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->Image('../img/logo_bernal-01.png',10,15,45,25);
	$pdf->Ln(10);
	$pdf->SetFont('Times','B',16);
	$pdf->Cell(65,10,utf8_decode(''),0,0,'');
	$pdf->Cell(70,10,utf8_decode('BERNAL GROUP S.A.S'),0,0,'');
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(80,10,utf8_decode('PERIODO CORRESPONDIENTE'),0,1,'');
	$pdf->SetFont('Times','B',16);
	$pdf->Cell(74,10,utf8_decode(''),0,0,'');
	$pdf->Cell(62,5,utf8_decode('NIT 901 257 204'),0,0,'');
	$pdf->SetFont('Times','',10);
	$pdf->Cell(70,5,utf8_decode('Desde '.$fecha_desde.' Hasta '.$fecha_hasta),0,1,'');

	$pdf->Ln(15);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(120,5,date("F j, Y, g:i a"),0,0,'');
	$pdf->Ln(15);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(120,5,utf8_decode(''.strtoupper($modelo_nombre)),0,0,'');
	$pdf->Cell(70,5,utf8_decode(''.strtoupper($modelo_tipo_documento).": ".$modelo_cedula),0,1,'');
	$pdf->Ln(2);
	$pdf->Cell(120,5,utf8_decode('CARGO: ASESOR CALL CENTER'),0,0,'');

	/********************APARTADO TRM NUEVO**************************/
	$sql10 = "SELECT * FROM trm1 WHERE inicio = '".$fecha_desde."' and fin = '".$fecha_hasta."' LIMIT 1";
	$consulta10 = mysqli_query($conexion,$sql10);
	$contador10 = mysqli_num_rows($consulta10);
	if($contador10>=1){
		while($row10 = mysqli_fetch_array($consulta10)) {
			$trm_mostrar = $row10["valor"];
			$pdf->Cell(70,5,utf8_decode('SUELDO BÁSICO (TRM): '.$trm_mostrar),0,1,'');
		}
	}else{
		$pdf->Cell(70,5,"",0,1,'');
	}
	/****************************************************************/

	$pdf->Ln(2);
	$pdf->SetFont('Times','B',8);
	$pdf->Cell(70,5,utf8_decode('CONCEPTO NÓMINA'),0,0,'');
	$pdf->Cell(30,5,utf8_decode('CANTIDAD'),0,0,'');
	$pdf->Cell(30,5,utf8_decode('V/R. UNITARIO'),0,0,'');
	$pdf->Cell(30,5,utf8_decode('DEVENGADO'),0,0,'');
	$pdf->Cell(30,5,utf8_decode('DEDUCIDO'),0,1,'');

	if($chaturbate>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('CB '.$meta_porcentajes."%"),0,0,'');
		$pdf->Cell(30,5,utf8_decode($chaturbate),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($pv),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($total_devengado_chaturbate,2,',','.'),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	if($imlive>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('IML '.$meta_porcentajes."%"),0,0,'');
		$pdf->Cell(30,5,utf8_decode($imlive),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($pv),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($total_devengado_imlive,2,',','.'),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	if($xlove>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('XLC '.$meta_porcentajes."%"),0,0,'');
		$pdf->Cell(30,5,utf8_decode($xlove),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($pv),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($total_devengado_xlove,2,',','.'),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	if($stripchat>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('STP '.$meta_porcentajes."%"),0,0,'');
		$pdf->Cell(30,5,utf8_decode($stripchat),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($pv),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($total_devengado_stripchat,2,',','.'),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	if($streamate>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('STMT '.$meta_porcentajes."%"),0,0,'');
		$pdf->Cell(30,5,utf8_decode($streamate),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($pv),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($total_devengado_streamate,2,',','.'),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	if($myfreecams>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('MFC '.$meta_porcentajes."%"),0,0,'');
		$pdf->Cell(30,5,utf8_decode($myfreecams),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($pv),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($total_devengado_myfreecams,2,',','.'),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	if($livejasmin>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('LJ '.$meta_porcentajes."%"),0,0,'');
		$pdf->Cell(30,5,utf8_decode($livejasmin),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($pv),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($total_devengado_livejasmin,2,',','.'),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	if($bonga>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('BONG '.$meta_porcentajes."%"),0,0,'');
		$pdf->Cell(30,5,utf8_decode($bonga),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($pv),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($total_devengado_bonga,2,',','.'),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	if($cam4>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('C4 '.$meta_porcentajes."%"),0,0,'');
		$pdf->Cell(30,5,utf8_decode($cam4),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($pv),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($total_devengado_cam4,2,',','.'),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	if($camsoda>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('CMS '.$meta_porcentajes."%"),0,0,'');
		$pdf->Cell(30,5,utf8_decode($camsoda),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($pv),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($total_devengado_camsoda,2,',','.'),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	if($flirt4free>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('F4F '.$meta_porcentajes."%"),0,0,'');
		$pdf->Cell(30,5,utf8_decode($flirt4free),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($pv),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($total_devengado_flirt4free,2,',','.'),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	if($amateur>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('AMA '.$meta_porcentajes."%"),0,0,'');
		$pdf->Cell(30,5,utf8_decode($amateur),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($pv),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($total_devengado_amateur,2,',','.'),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	if($streamray>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('SRAY '.$meta_porcentajes."%"),0,0,'');
		$pdf->Cell(30,5,utf8_decode($streamray),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($pv),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($total_devengado_streamray,2,',','.'),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	$total_tokens = $chaturbate+$imlive+$xlove+$stripchat+$streamate+$myfreecams+$livejasmin+$bonga+$cam4+$camsoda+$flirt4free+$amateur+$streamray;

	$bono1 = 0;

	if($turno!="Satelite"){
		if($total_tokens>=50000 and $total_tokens<=79999){
			$bono1 = 100000;
		}

		if($total_tokens>=80000 and $total_tokens<=99999){
			$bono1 = 300000;
		}

		if($total_tokens>=100000){
			$bono1 = 500000;
		}

		if($id_modelo == 377 and $fecha_desde == '2021-02-16'){
			$bono1 = 300000;
		}
	}else{
		$bono1 = 0;
	}

	if($bono1>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('BONO'),0,0,'');
		$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
		$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($bono1,2,',','.'),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	$pdf->Ln(5);
	$pdf->Cell(65,5,utf8_decode('RETENCIÓN EN LA FUENTE'),0,0,'');
	$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
	$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
	$pdf->Cell(30,5,utf8_decode('0'),0,0,'C');

	$rf_pesos = $rf;
	$pdf->Cell(30,5,"$".number_format($rf_pesos,2,',','.'),0,1,'C');
	$total_deducido = 0;

	$sql4 = "SELECT * FROM descuento WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$consulta4 = mysqli_query($conexion,$sql4);
	while($row4 = mysqli_fetch_array($consulta4)) {
		$descuento_valor = $row4['valor'];
		$descuento_concepto = $row4['concepto'];
		$total_deducido = $total_deducido+$descuento_valor;
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode(strtoupper($descuento_concepto)),0,0,'');
		$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
		$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($descuento_valor,2,',','.'),0,1,'C');
	}

	$sql5 = "SELECT * FROM tienda WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$consulta5 = mysqli_query($conexion,$sql5);
	while($row5 = mysqli_fetch_array($consulta5)) {
		$tienda_valor = $row5['valor'];
		$tienda_concepto = $row5['concepto'];
		$total_deducido = $total_deducido+$tienda_valor;
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode(strtoupper($tienda_concepto)),0,0,'');
		$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
		$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($tienda_valor,2,',','.'),0,1,'C');
	}

	$sql6 = "SELECT * FROM avances WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$consulta6 = mysqli_query($conexion,$sql6);
	while($row6 = mysqli_fetch_array($consulta6)) {
		$avances_valor = $row6['valor'];
		$avances_concepto = $row6['concepto'];
		$total_deducido = $total_deducido+$avances_valor;
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode(strtoupper($avances_concepto)),0,0,'');
		$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
		$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($avances_valor,2,',','.'),0,1,'C');
	}

	$sql7 = "SELECT * FROM multas WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$consulta7 = mysqli_query($conexion,$sql7);
	while($row7 = mysqli_fetch_array($consulta7)) {
		$multas_valor = $row7['valor'];
		$multas_concepto = $row7['concepto'];
		//$total_deducido = $total_deducido+$multas_valor;
		$total_deducido = $total_deducido+$multas_valor;
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode(strtoupper($multas_concepto)),0,0,'');
		$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
		$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($multas_valor,2,',','.'),0,1,'C');
	}

	if($turno!='Satelite'){
		$sql8 = "SELECT * FROM bonos_horas WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
		$consulta8 = mysqli_query($conexion,$sql8);
		$total_devengado_bonos_horas = 0;
		if($turno!='Satelite'){
			while($row8 = mysqli_fetch_array($consulta8)) {
				$bonos_horas_concepto = $row8['concepto'];
				if($bonos_horas_concepto=='Amateur' or $bonos_horas_concepto=='Streamray'){
					$bonos_horas_valor = $row8['monto']*$trm;
				}else{
					$bonos_horas_valor = $row8['monto'];
				}
				$total_devengado_bonos_horas = $total_devengado_bonos_horas+$bonos_horas_valor;
				$pdf->Ln(5);
				$pdf->Cell(65,5,utf8_decode(strtoupper($bonos_horas_concepto)),0,0,'');
				$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
				$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
				$pdf->Cell(30,5,"$".number_format($bonos_horas_valor,2,',','.'),0,0,'C');
				$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
			}

		}

		$sql9 = "SELECT * FROM bonos_streamate WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
		$consulta9 = mysqli_query($conexion,$sql9);
		$total_devengado_bonos_streamate = 0;
		while($row9 = mysqli_fetch_array($consulta9)) {
			$bonos_streamate_valor = $row9['monto'];
			$bonos_streamate_concepto = $row9['concepto'];
			$total_devengado_bonos_streamate = $total_devengado_bonos_streamate+$bonos_streamate_valor;
			$pdf->Ln(5);
			$pdf->Cell(65,5,utf8_decode(strtoupper($bonos_streamate_concepto)),0,0,'');
			$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
			$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
			$pdf->Cell(30,5,"$".number_format($bonos_streamate_valor*$trm,2,',','.'),0,0,'C');
			$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
		}
	}

	$sql10 = "SELECT * FROM odontologia WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$consulta10 = mysqli_query($conexion,$sql10);
	while($row10 = mysqli_fetch_array($consulta10)) {
		$deducido_odontologia_valor = $row10['monto'];
		$deducido_odontologia_concepto = $row10['concepto'];
		$total_deducido = $total_deducido+$deducido_odontologia_valor;
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode(strtoupper($deducido_odontologia_concepto)),0,0,'');
		$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
		$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($deducido_odontologia_valor,2,',','.'),0,1,'C');
	}

	$sql11 = "SELECT * FROM seguridad_social WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$consulta11 = mysqli_query($conexion,$sql11);
	while($row11 = mysqli_fetch_array($consulta11)) {
		$deducido_seguridad_social_valor = $row11['monto'];
		$deducido_seguridad_social_concepto = $row11['concepto'];
		$total_deducido = $total_deducido+$deducido_seguridad_social_valor;
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode(strtoupper($deducido_seguridad_social_concepto)),0,0,'');
		$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
		$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($deducido_seguridad_social_valor,2,',','.'),0,1,'C');
	}

	$sql12 = "SELECT * FROM coopserpak WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$consulta12 = mysqli_query($conexion,$sql12);
	while($row12 = mysqli_fetch_array($consulta12)) {
		$deducido_coopserpak_valor = $row12['monto'];
		$deducido_coopserpak_concepto = $row12['concepto'];
		$total_deducido = $total_deducido+$deducido_coopserpak_valor;
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode(strtoupper($deducido_coopserpak_concepto)),0,0,'');
		$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
		$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($deducido_coopserpak_valor,2,',','.'),0,1,'C');
	}

	$sql13 = "SELECT * FROM sexshop WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$consulta13 = mysqli_query($conexion,$sql13);
	while($row13 = mysqli_fetch_array($consulta13)) {

		$deducido_sexshop_valor = $row13['monto'];
		//$deducido_sexshop_concepto = $row13['concepto'];
		$deducido_sexshop_concepto = "SX";
		$total_deducido = $total_deducido+$deducido_sexshop_valor;
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode(strtoupper($deducido_sexshop_concepto)),0,0,'');
		$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
		$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($deducido_sexshop_valor,2,',','.'),0,1,'C');
	}



	$sql14 = "SELECT * FROM belleza WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$consulta14 = mysqli_query($conexion,$sql14);
	while($row14 = mysqli_fetch_array($consulta14)) {

		$deducido_belleza_valor = $row14['monto'];
		$deducido_belleza_concepto = $row14['concepto'];
		$total_deducido = $total_deducido+$deducido_belleza_valor;
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode(strtoupper($deducido_belleza_concepto)),0,0,'');
		$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
		$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($deducido_belleza_valor,2,',','.'),0,1,'C');
	}



	$sql15 = "SELECT * FROM sancionpagina WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$consulta15 = mysqli_query($conexion,$sql15);
	while($row15 = mysqli_fetch_array($consulta15)) {

		$deducido_sancionpagina_valor = $row15['monto']*$trm;
		$deducido_sancionpagina_concepto = $row15['concepto'];
		$total_deducido = $total_deducido+$deducido_sancionpagina_valor;
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode(strtoupper($deducido_sancionpagina_concepto)),0,0,'');
		$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
		$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($deducido_sancionpagina_valor,2,',','.'),0,1,'C');
	}



	$sql16 = "SELECT * FROM lenceria WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$consulta16 = mysqli_query($conexion,$sql16);
	while($row16 = mysqli_fetch_array($consulta16)) {

		$deducido_lenceria_valor = $row16['monto'];
		$deducido_lenceria_concepto = $row16['concepto'];
		$total_deducido = $total_deducido+$deducido_lenceria_valor;
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode(strtoupper($deducido_lenceria_concepto)),0,0,'');
		$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
		$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($deducido_lenceria_valor,2,',','.'),0,1,'C');
	}

	$total_deducido = $total_deducido+$rf_pesos;
	$total_devengado_bonos_streamate = $total_devengado_bonos_streamate*$trm;
	$total_final2 = $total_devengado_chaturbate+$total_devengado_imlive+$total_devengado_xlove+$total_devengado_stripchat+$total_devengado_streamate+$total_devengado_myfreecams+$total_devengado_livejasmin+$total_devengado_bonga+$total_devengado_cam4+$total_devengado_camsoda+$total_devengado_flirt4free+$total_devengado_amateur+$total_devengado_streamray+$total_devengado_bonos_horas+$total_devengado_bonos_streamate+$bono1;

	$pdf->Ln(15);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(120,5,utf8_decode('TOTAL '),0,0,'R');
	$pdf->Cell(40,5,"$".number_format($total_final2,2,',','.'),0,0,'C');
	$pdf->Cell(20,5,"$".number_format($total_deducido,2,',','.'),0,1,'C');
	$pdf->Ln(5);
	$pdf->Cell(120,5,utf8_decode("NETO PAGADO"),0,0,'R');
	$total_final3 = $total_final2-$total_deducido;
	$pdf->Cell(55,5,"$".number_format($total_final3,2,',','.'),0,0,'R');
}

$pdf->Output();
?>