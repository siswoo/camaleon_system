<?php
//session_start();
include('../script/conexion.php');
require('../resources/fpdf/fpdf.php');

$id_modelo = 4;
$presabana = 322826;
$id_sede = 1;

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
	$pdf->Cell(70,5,utf8_decode('Desde 2021-06-16 Hasta 2021-06-30'),0,1,'');

	$pdf->Ln(15);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(120,5,utf8_decode(''.strtoupper('JAIRO ANDRES ABRIL LIZARAZO')),0,0,'');
	$pdf->Cell(70,5,utf8_decode(''.strtoupper("CEDULA DE CIUDADANIA: ").": 1032.491.539"),0,1,'');
	$pdf->Ln(2);
	$pdf->Cell(120,5,utf8_decode('CARGO: ANALISTA EN SISTEMAS'),0,0,'');

	$pdf->Ln(20);
	$pdf->SetFont('Times','B',8);
	$pdf->Cell(70,5,utf8_decode('CONCEPTO NÓMINA'),0,0,'');
	$pdf->Cell(30,5,utf8_decode('CANTIDAD'),0,0,'');
	$pdf->Cell(30,5,utf8_decode('DIAS LABORADOS'),0,0,'');
	$pdf->Cell(30,5,utf8_decode('DESCUENTOS'),0,1,'');

	$pdf->Ln(5);
	$pdf->Cell(65,5,utf8_decode('Sueldo Neto'),0,0,'');
	$pdf->Cell(30,5,utf8_decode("$600.000"),0,0,'C');
	$pdf->Cell(30,5,utf8_decode("15"),0,0,'C');
	$pdf->Cell(30,5,utf8_decode('$0'),0,1,'C');

	$pdf->Ln(15);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(20,5,utf8_decode('TOTAL '),0,0,'R');
	$pdf->Cell(40,5,"$".number_format("600000",2,',','.'),0,0,'C');
	$pdf->Ln(5);
	$pdf->Cell(120,5,utf8_decode(""),0,0,'R');
}


$pdf->Output();
?>