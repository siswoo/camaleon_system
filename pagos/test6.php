<?php
session_start();
include('../script/conexion.php');
require('../resources/fpdf/fpdf.php');

$id_modelo = 4;
$id_sede = $_SESSION['sede'];

$sql1 = "SELECT * FROM modelos LIMIT 1";
$consulta1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($consulta1)) {
	$modelo_nombre = $row1['nombre1']." ".$row1['nombre2']." ".$row1['apellido1']." ".$row1['apellido2'];
	$modelo_tipo_documento = $row1['documento_tipo'];
	$modelo_cedula = $row1['documento_numero'];
}

$sql2 = "SELECT * FROM presabana WHERE id_modelo = ".$id_modelo;
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

	$meta_porcentajes = $row2['meta_porcentajes'];
	//$total_pesos = $row2['total_pesos'];
	//$deducidos = $row2['deducidos'];
	$deducidos = 0;
	$pv = $row2['pv'];

	$total_pesos_chaturbate = $chaturbate*0.05;
	$total_pesos_chaturbate = $total_pesos_chaturbate*3400;

	$total_pesos_imlive 	= $imlive*0.05;
	$total_pesos_imlive 	= $total_pesos_imlive*3400;

	$total_pesos_xlove 		= $xlove*0.05;
	$total_pesos_xlove 		= $total_pesos_xlove*3400;

	$total_pesos_stripchat 	= $stripchat*0.05;
	$total_pesos_stripchat 	= $total_pesos_stripchat*3400;

	$total_pesos_streamate 	= $streamate*0.05;
	$total_pesos_streamate 	= $total_pesos_streamate*3400;

	$total_pesos_myfreecams = $myfreecams*0.05;
	$total_pesos_myfreecams = $total_pesos_myfreecams*3400;

	$total_pesos_livejasmin = $livejasmin*0.05;
	$total_pesos_livejasmin = $total_pesos_livejasmin*3400;

	$total_pesos_bonga 		= $bonga*0.05;
	$total_pesos_bonga 		= $total_pesos_bonga*3400;

	$total_pesos_cam4 		= $cam4*0.05;
	$total_pesos_cam4 		= $total_pesos_cam4*3400;

	$total_pesos_camsoda 	= $camsoda*0.05;
	$total_pesos_camsoda 	= $total_pesos_camsoda*3400;

	$total_pesos_flirt4free = $flirt4free*0.05;
	$total_pesos_flirt4free = $total_pesos_flirt4free*3400;

	$total_final1 = $total_pesos_chaturbate+$total_pesos_imlive+$total_pesos_xlove+$total_pesos_stripchat+$total_pesos_streamate+$total_pesos_myfreecams+$total_pesos_livejasmin+$total_pesos_bonga+$total_pesos_cam4+$total_pesos_camsoda+$total_pesos_flirt4free;

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

	class PDF extends FPDF{
		/*
		function Footer(){
		    $this->SetY(-15);
		    $this->SetFont('Arial','B',10);
		    $this->Cell(90,5,utf8_decode('FIRMA EMPLEADO _____________________'),0,0,'');
		    $this->Cell(45,5,utf8_decode('TOTAL '.$total_final1),0,0,'');
		}
		*/
	}

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
	$pdf->Cell(120,5,utf8_decode(''.strtoupper($modelo_nombre)),0,0,'');
	$pdf->Cell(70,5,utf8_decode(''.strtoupper($modelo_tipo_documento).": ".$modelo_cedula),0,1,'');
	$pdf->Ln(2);
	$pdf->Cell(120,5,utf8_decode('CARGO: ASESOR CALL CENTER'),0,0,'');
	$pdf->Cell(70,5,utf8_decode('SUELDO BÁSICO (TRM): 3400'),0,1,'');
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
		//$pdf->Cell(30,5,utf8_decode($total_pesos_chaturbate),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($total_devengado_chaturbate),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	if($imlive>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('IML '.$meta_porcentajes."%"),0,0,'');
		$pdf->Cell(30,5,utf8_decode($imlive),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($pv),0,0,'C');
		//$pdf->Cell(30,5,utf8_decode($total_pesos_imlive),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($total_devengado_imlive),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	if($xlove>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('XLC '.$meta_porcentajes."%"),0,0,'');
		$pdf->Cell(30,5,utf8_decode($xlove),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($pv),0,0,'C');
		//$pdf->Cell(30,5,utf8_decode($total_pesos_xlove),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($total_devengado_xlove),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	if($stripchat>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('STP '.$meta_porcentajes."%"),0,0,'');
		$pdf->Cell(30,5,utf8_decode($stripchat),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($pv),0,0,'C');
		//$pdf->Cell(30,5,utf8_decode($total_pesos_stripchat),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($total_devengado_stripchat),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	if($streamate>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('STMT '.$meta_porcentajes."%"),0,0,'');
		$pdf->Cell(30,5,utf8_decode($streamate),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($pv),0,0,'C');
		//$pdf->Cell(30,5,utf8_decode($total_pesos_streamate),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($total_devengado_streamate),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	if($myfreecams>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('MFC '.$meta_porcentajes."%"),0,0,'');
		$pdf->Cell(30,5,utf8_decode($myfreecams),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($pv),0,0,'C');
		//$pdf->Cell(30,5,utf8_decode($total_pesos_myfreecams),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($total_devengado_myfreecams),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	if($livejasmin>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('LJ '.$meta_porcentajes."%"),0,0,'');
		$pdf->Cell(30,5,utf8_decode($livejasmin),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($pv),0,0,'C');
		//$pdf->Cell(30,5,utf8_decode($total_pesos_livejasmin),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($total_devengado_livejasmin),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	if($bonga>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('BONG '.$meta_porcentajes."%"),0,0,'');
		$pdf->Cell(30,5,utf8_decode($bonga),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($pv),0,0,'C');
		//$pdf->Cell(30,5,utf8_decode($total_pesos_bonga),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($total_devengado_bonga),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	if($cam4>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('C4 '.$meta_porcentajes."%"),0,0,'');
		$pdf->Cell(30,5,utf8_decode($cam4),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($pv),0,0,'C');
		//$pdf->Cell(30,5,utf8_decode($total_pesos_cam4),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($total_devengado_cam4),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	if($camsoda>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('CMS '.$meta_porcentajes."%"),0,0,'');
		$pdf->Cell(30,5,utf8_decode($camsoda),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($pv),0,0,'C');
		//$pdf->Cell(30,5,utf8_decode($total_pesos_camsoda),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($total_devengado_camsoda),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	if($flirt4free>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('F4F '.$meta_porcentajes."%"),0,0,'');
		$pdf->Cell(30,5,utf8_decode($flirt4free),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($pv),0,0,'C');
		//$pdf->Cell(30,5,utf8_decode($total_pesos_flirt4free),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($total_devengado_flirt4free),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	$total_deducido = 0;

	$sql4 = "SELECT * FROM descuento WHERE id_modelo = ".$id_modelo;
	$consulta4 = mysqli_query($conexion,$sql4);
	while($row4 = mysqli_fetch_array($consulta4)) {
		$descuento_valor = $row4['valor'];
		$total_deducido = $total_deducido+$descuento_valor;
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode(""),0,0,'');
		$pdf->Cell(30,5,utf8_decode(""),0,0,'C');
		$pdf->Cell(30,5,utf8_decode(""),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($descuento_valor),0,1,'C');
	}

	$total_final2 = $total_devengado_chaturbate+$total_devengado_imlive+$total_devengado_xlove+$total_devengado_stripchat+$total_devengado_streamate+$total_devengado_myfreecams+$total_devengado_livejasmin+$total_devengado_bonga+$total_devengado_cam4+$total_devengado_camsoda+$total_devengado_flirt4free;

	$pdf->Ln(15);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(90,5,utf8_decode('FIRMA EMPLEADO _____________________'),0,0,'');
	$pdf->Cell(30,5,utf8_decode('TOTAL '),0,0,'C');
	$pdf->Cell(40,5,utf8_decode($total_final2),0,0,'C');
	$pdf->Cell(20,5,utf8_decode($total_deducido),0,1,'C');
	$pdf->Ln(5);
	$pdf->Cell(120,5,utf8_decode("NETO PAGADO"),0,0,'R');
	$total_final3 = $total_final2-$total_deducido;
	$pdf->Cell(55,5,utf8_decode($total_final3),0,0,'R');

}


$pdf->Output();
?>