<?php
session_start();
include('../script/conexion.php');
require('../resources/fpdf/fpdf.php');

$id = $_GET['id'];

$sql1 = "SELECT * FROM n_pagos WHERE id = ".$id;
$proceso1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($proceso1)) {
	$id_nomina = $row1['id_nomina'];
	$salario = $row1['salario'];
	$bonos = $row1['bonos'];
	$inasistencia = $row1['inasistencias'];
	$multas = $row1['multas'];
	$inicio = $row1['inicio'];
	$fin = $row1['fin'];
}

$sql2 = "SELECT * FROM nomina WHERE id = ".$id_nomina;
$consulta2 = mysqli_query($conexion,$sql2);
while($row2 = mysqli_fetch_array($consulta2)) {
	$nombre = $row2['nombre'];
	$apellido = $row2['apellido'];
	$documento_tipo = $row2['documento_tipo'];
	$documento_numero = $row2['documento_numero'];
	$cargo = $row2['cargo'];

	$sql3 = "SELECT * FROM cargos";
	$proceso3 = mysqli_query($conexion,$sql3);
	while($row3 = mysqli_fetch_array($proceso3)) {
		$cargo_nombre = $row3["nombre"];
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
	$pdf->Cell(70,5,utf8_decode('Desde '.$inicio.' Hasta '.$fin),0,1,'');

	$pdf->Ln(15);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(120,5,date("F j, Y, g:i a"),0,0,'');

	$pdf->Ln(15);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(120,5,utf8_decode(''.strtoupper($nombre." ".$apellido)),0,0,'');
	$pdf->Cell(70,5,utf8_decode(''.strtoupper($documento_tipo).": ".$documento_numero),0,1,'');
	$pdf->Ln(2);
	$pdf->Cell(120,5,utf8_decode('CARGO: '.$cargo_nombre),0,0,'');
	$pdf->Cell(70,5,utf8_decode('SUELDO BÁSICO: '.number_format($salario,2,',','.')),0,1,'');
	$pdf->Ln(2);
	$pdf->SetFont('Times','B',8);
	$pdf->Cell(70,5,utf8_decode('CONCEPTO NÓMINA'),0,0,'');
	$pdf->Cell(30,5,utf8_decode('DEVENGADO'),0,0,'');
	$pdf->Cell(30,5,utf8_decode('DEDUCIDO'),0,1,'');

	$quincena = $salario/2;

	$pdf->Ln(5);
	$pdf->Cell(65,5,utf8_decode('Quincena'),0,0,'');
	$pdf->Cell(30,5,"$".number_format($quincena,2,',','.'),0,0,'C');
	$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');

	if($bonos>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('Bonos'),0,0,'');
		$pdf->Cell(30,5,"$".number_format($bonos,2,',','.'),0,0,'C');
		$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
	}

	$salario2 = $salario/30;
	$inasistencia_valor = $salario2*$inasistencia;

	if($inasistencia>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('Inasistencia'),0,0,'');
		$pdf->Cell(30,5,utf8_decode('0'),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($inasistencia_valor,2,',','.'),0,1,'C');
	}

	if($multas>=1){
		$pdf->Ln(5);
		$pdf->Cell(65,5,utf8_decode('Descuentos'),0,0,'');
		$pdf->Cell(30,5,utf8_decode('0'),0,0,'C');
		$pdf->Cell(30,5,"$".number_format($multas,2,',','.'),0,1,'C');
	}

	$total_final2 = $quincena+$bonos;
	$total_deducido = $inasistencia_valor+$multas;

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