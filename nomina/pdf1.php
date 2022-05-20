<?php
session_start();
include('../script/conexion.php');
require('../resources/fpdf/fpdf.php');

$desprendible_id = $_GET['desprendibles_corte'];

$sql1 = "SELECT * FROM nomina_pagos_presabana WHERE id = ".$desprendible_id;
$consulta1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($consulta1)) {
	$sede = $row1['sede'];
	$cargo = $row1['cargo'];
	$sueldo = $row1['sueldo'];
	$laborados = $row1['laborados'];
	$nolaborados = $row1['nolaborados'];
	$subtotal = $row1['subtotal'];
	$doblaturno = $row1['doblaturno'];
	$prestamos = $row1['prestamos'];
	$bono = $row1['bono'];
	$devolucion_ss = $row1['devolucion_ss'];
	$ajustenomina = $row1['ajustenomina'];
	$otroconceptos = $row1['otroconceptos'];
	$totaldevengado = $row1['totaldevengado'];
	$descuentos = $row1['descuentos'];
	$totaldeducciones = $row1['totaldeducciones'];
	$totalpagan = $row1['totalpagan'];
	$fecha_desde = $row1['fecha_desde'];
	$fecha_hasta = $row1['fecha_hasta'];
	$responsable = $row1['responsable'];
	$fecha_inicio = $row1['fecha_inicio'];
}

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

	$pdf->Ln(2);
	$pdf->SetFont('Times','B',8);
	$pdf->Cell(70,5,utf8_decode('CONCEPTO NÓMINA'),0,0,'');
	$pdf->Cell(30,5,utf8_decode('CANTIDAD'),0,0,'');
	$pdf->Cell(30,5,utf8_decode('V/R. UNITARIO'),0,0,'');
	$pdf->Cell(30,5,utf8_decode('DEVENGADO'),0,0,'');
	$pdf->Cell(30,5,utf8_decode('DEDUCIDO'),0,1,'');

	$pdf->Ln(5);
	$pdf->Cell(65,5,utf8_decode('CB '.$meta_porcentajes."%"),0,0,'');
	$pdf->Cell(30,5,utf8_decode($chaturbate),0,0,'C');
	$pdf->Cell(30,5,utf8_decode($pv),0,0,'C');
	$pdf->Cell(30,5,"$".number_format($total_devengado_chaturbate,2,',','.'),0,0,'C');
	$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');

	$pdf->Ln(15);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(120,5,utf8_decode('TOTAL '),0,0,'R');
	$pdf->Cell(40,5,"$".number_format($total_final2,2,',','.'),0,0,'C');
	$pdf->Cell(20,5,"$".number_format($total_deducido,2,',','.'),0,1,'C');
	$pdf->Ln(5);
	$pdf->Cell(120,5,utf8_decode("NETO PAGADO"),0,0,'R');
	$total_final3 = $total_final2-$total_deducido;
	$pdf->Cell(55,5,"$".number_format($total_final3,2,',','.'),0,0,'R');


$pdf->Output();
?>