<?php
session_start();
include('../script/conexion.php');
require('../resources/fpdf/fpdf.php');

$id = $_GET['id'];
$total_devengado = 0;
$total_deducido = 0;

$sql1 = "SELECT * FROM contenido_presabana WHERE id =".$id;
$consulta1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($consulta1)) {
	$modelo_id = $row1["id_modelo"];
	$mes = $row1["mes"];
	$anio = $row1["anio"];
	$subtotal = $row1["subtotal"];
	$rf = $row1["rf"];
	$meta_porcentajes = $row1["meta_porcentajes"];
	$total = $row1["total"];
	$trm = $row1["trm"];
	$fecha_inicio = $row1["fecha_inicio"];
}

$sql2 = "SELECT * FROM contenido_modelos WHERE id = ".$modelo_id;
$consulta2 = mysqli_query($conexion,$sql2);
while($row2 = mysqli_fetch_array($consulta2)) {
	$nombre = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
	$documento_tipo = $row2['documento_tipo'];
	$documento_numero = $row2['documento_numero'];
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
$pdf->SetFont('Times','B',10);
$pdf->Cell(70,5,utf8_decode('Mes '.$mes.' Año '.$anio),0,1,'');

$pdf->Ln(15);
$pdf->SetFont('Times','B',10);
$pdf->Cell(120,5,date("F j, Y, g:i a"),0,0,'');
$pdf->Ln(15);
$pdf->SetFont('Times','B',10);
$pdf->Cell(120,5,utf8_decode(''.strtoupper($nombre)),0,0,'');
$pdf->Cell(70,5,utf8_decode(''.strtoupper($documento_tipo).": ".$documento_numero),0,1,'');
$pdf->Ln(2);
$pdf->Cell(120,5,utf8_decode('CARGO: ASESOR CALL CENTER'),0,0,'');
$pdf->Cell(70,5,utf8_decode('SUELDO BÁSICO (TRM): '.$trm),0,1,'');

$pdf->Ln(2);
$pdf->SetFont('Times','B',8);
$pdf->Cell(70,5,utf8_decode('CONCEPTO NÓMINA'),0,0,'');
$pdf->Cell(30,5,utf8_decode('CANTIDAD'),0,0,'');
$pdf->Cell(30,5,utf8_decode('DEVENGADO'),0,0,'');
$pdf->Cell(30,5,utf8_decode('DEDUCIDO'),0,1,'');

$sql3 = "SELECT * FROM contenido_valores_extras WHERE id_modelos = ".$modelo_id." and mes = '$mes' and anio = '$anio'";
$consulta3 = mysqli_query($conexion,$sql3);
while($row3 = mysqli_fetch_array($consulta3)) {
	$paginas_id = $row3["id_paginas"];
	$condicion = $row3["condicion"];
	$valor = $row3["valor"];
	$valor2 = $row3["valor"]*$trm;
	if($paginas_id>=1){
		$total_devengado = $total_devengado+$valor2;
		$sql4 = "SELECT * FROM contenido_paginas WHERE id =".$paginas_id;
		$consulta4 = mysqli_query($conexion,$sql4);
		while($row4 = mysqli_fetch_array($consulta4)) {
			$paginas_nombre = $row4["nombre"];
		}
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode($paginas_nombre.$meta_porcentajes."%"),0,0,'');
		$pdf->Cell(30,5,utf8_decode($valor."$"),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($valor2,2,',','.'),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}else{
		$total_deducido = $total_deducido+$valor;
		$pdf->Ln(5);
		if($condicion=='sexshop'){
			$condicion="SX";
		}
		$pdf->Cell(65,5,utf8_decode($condicion),0,0,'');
		$pdf->Cell(30,5,utf8_decode($valor),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,0,'C');
		$pdf->Cell(30,5,utf8_decode($valor),0,1,'C');
	}
}

$total_deducido = $total_deducido-$rf;

$pdf->Ln(5);
$pdf->Cell(65,5,utf8_decode('RETENCIÓN EN LA FUENTE'),0,0,'');
$pdf->Cell(30,5,utf8_decode("0"),0,0,'C');
$pdf->Cell(30,5,utf8_decode('0'),0,0,'C');
$pdf->Cell(30,5,"$".number_format($rf,2,',','.'),0,1,'C');

$pdf->Ln(15);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(65,5,utf8_decode(''),0,0,'');
$pdf->Cell(30,5,utf8_decode('TOTAL '),0,0,'C');
$pdf->Cell(30,5,"$".number_format($total_devengado,2,',','.'),0,0,'C');
$pdf->Cell(30,5,"$".number_format($total_deducido,2,',','.'),0,1,'C');

$pdf->Ln(5);
$pdf->Cell(65,5,utf8_decode(''),0,0,'');
$pdf->Cell(30,5,utf8_decode("NETO PAGADO"),0,0,'C');
$pdf->Cell(60,5,"$".number_format($total,2,',','.'),0,0,'C');

$pdf->Output();
?>