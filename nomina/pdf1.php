<?php
session_start();
include('../script/conexion.php');
require('../resources/fpdf/fpdf.php');

$desprendible_id = $_GET['desprendibles_corte'];
$descuentos_totales = 0;

$sql1 = "SELECT * FROM nomina_pagos_presabana WHERE id = ".$desprendible_id;
$proceso1 = mysqli_query($conexion,$sql1);
$contador1 = mysqli_num_rows($proceso1);

if($contador1==0){
	echo 'ID incorrecto valide nuevamente su registro!';
	exit;
}

while($row1 = mysqli_fetch_array($proceso1)) {
	$id_nomina = $row1['id_nomina'];
	$cargo = $row1['cargo'];
	$sueldo = $row1['sueldo'];
	$sede = $row1['sede'];
	$laborados = $row1['laborados'];
	$nolaborados = $row1['nolaborados'];
	$subtotal = $row1['subtotal'];
	$doblaturno = $row1['doblaturno'];
	$prestamos = $row1['prestamos'];
	$bono = $row1['bono'];
	$devolucion_ss = $row1['devolucion_ss'];
	$ajustenomina = $row1['ajustenomina'];
	$otrosconceptos = $row1['otrosconceptos'];
	$totaldevengado = $row1['totaldevengado'];
	$descuentos = $row1['descuentos'];
	$totaldeducciones = $row1['totaldeducciones'];
	$totalpagar = $row1['totalpagar'];
	$fecha_desde = $row1['fecha_desde'];
	$fecha_hasta = $row1['fecha_hasta'];
	$fecha_inicio = $row1['fecha_inicio'];
}

$sql2 = "SELECT * FROM nomina WHERE id = ".$id_nomina;
$proceso2 = mysqli_query($conexion,$sql2);
while($row2 = mysqli_fetch_array($proceso2)) {
	$nombre = $row2['nombre'].$row2['apellido'];
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
	$pdf->SetFont('Times','',10);
	$pdf->Cell(70,5,utf8_decode('Desde '.$fecha_desde.' Hasta '.$fecha_hasta),0,1,'');

	$pdf->Ln(15);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(120,5,date("F j, Y, g:i a"),0,0,'');
	$pdf->Ln(15);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(120,5,utf8_decode(''.strtoupper($nombre)),0,0,'');
	$pdf->Cell(70,5,utf8_decode(''.strtoupper($documento_tipo).": ".$documento_numero),0,1,'');
	$pdf->Ln(2);
	$pdf->Cell(120,5,utf8_decode('CARGO: '.strtoupper($cargo)),0,1,'');

	$pdf->Ln(10);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(70,5,utf8_decode('CONCEPTO NÓMINA'),0,0,'');
	$pdf->Cell(30,5,utf8_decode('CANTIDAD'),0,0,'');
	$pdf->Cell(30,5,utf8_decode('DEVENGADO'),0,0,'');
	$pdf->Cell(30,5,utf8_decode('DEDUCIDO'),0,1,'');

	$pdf->Ln(5);
	$pdf->Cell(65,5,utf8_decode('Sueldo'),0,0,'');
	$pdf->Cell(30,5,utf8_decode('1'),0,0,'C');
	$pdf->Cell(30,5,utf8_decode("$".number_format($sueldo,2,',','.')),0,0,'C');
	$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');

	$diario = $sueldo/30;
	$laborados2= $laborados*$diario;
	if($nolaborados>=1){
		$nolaborados2= $diario*$nolaborados;
	}else{
		$nolaborados2 = 0;
	}

	$pdf->Ln(5);
	$pdf->Cell(65,5,utf8_decode('Dias Laborados'),0,0,'');
	$pdf->Cell(30,5,utf8_decode($laborados),0,0,'C');
	$pdf->Cell(30,5,utf8_decode("$".number_format($laborados2,2,',','.')),0,0,'C');
	$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');

	$pdf->Ln(5);
	$pdf->Cell(65,5,utf8_decode('Dias No Laborados'),0,0,'');
	$pdf->Cell(30,5,utf8_decode($nolaborados),0,0,'C');
	$pdf->Cell(30,5,utf8_decode('0'),0,0,'C');
	$pdf->Cell(30,5,utf8_decode("$".number_format($nolaborados2,2,',','.')),0,1,'C');

	$sql3 = "SELECT * FROM temporal_nomina_pagos WHERE id_nomina = ".$id_nomina." and fecha BETWEEN '$fecha_desde' AND '$fecha_hasta'";
	$proceso3 = mysqli_query($conexion,$sql3);
	while($row3 = mysqli_fetch_array($proceso3)) {
		$concepto = $row3["concepto"];
		$texto = $row3["texto"];
		$valor = $row3["valor"];
		if($concepto=='nolaborados'){
			$descuentos3 = $descuentos3+$valor;
			//resta
		}else if($concepto=='dobleturnos'){
			//suma
			$pdf->Ln(5);
			$pdf->Cell(65,5,utf8_decode($concepto),0,0,'');
			$pdf->Cell(30,5,utf8_decode('1'),0,0,'C');
			$pdf->Cell(30,5,utf8_decode("$".number_format($valor,2,',','.')),0,0,'C');
			$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
		}else if($concepto=='prestamos'){
			//suma
			$pdf->Ln(5);
			$pdf->Cell(65,5,utf8_decode($concepto),0,0,'');
			$pdf->Cell(30,5,utf8_decode('1'),0,0,'C');
			$pdf->Cell(30,5,utf8_decode("$".number_format($valor,2,',','.')),0,0,'C');
			$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
		}else if($concepto=='bono'){
			//suma
			$pdf->Ln(5);
			$pdf->Cell(65,5,utf8_decode($concepto),0,0,'');
			$pdf->Cell(30,5,utf8_decode('1'),0,0,'C');
			$pdf->Cell(30,5,utf8_decode("$".number_format($valor,2,',','.')),0,0,'C');
			$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
		}else if($concepto=='devolucion'){
			//suma
			$pdf->Ln(5);
			$pdf->Cell(65,5,utf8_decode($concepto),0,0,'');
			$pdf->Cell(30,5,utf8_decode('1'),0,0,'C');
			$pdf->Cell(30,5,utf8_decode("$".number_format($valor,2,',','.')),0,0,'C');
			$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
		}else if($concepto=='ajustenomina'){
			//suma
			$pdf->Ln(5);
			$pdf->Cell(65,5,utf8_decode($concepto),0,0,'');
			$pdf->Cell(30,5,utf8_decode('1'),0,0,'C');
			$pdf->Cell(30,5,utf8_decode("$".number_format($valor,2,',','.')),0,0,'C');
			$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
		}else if($concepto=='otrosconceptos'){
			//suma
			$pdf->Ln(5);
			$pdf->Cell(65,5,utf8_decode($concepto),0,0,'');
			$pdf->Cell(30,5,utf8_decode('1'),0,0,'C');
			$pdf->Cell(30,5,utf8_decode("$".number_format($valor,2,',','.')),0,0,'C');
			$pdf->Cell(30,5,utf8_decode('0'),0,1,'C');
		}
		else if($concepto=='descuentos'){
			//resta
			$descuentos_totales = $descuentos_totales+$valor;
			$pdf->Ln(5);
			$pdf->Cell(65,5,utf8_decode("Descuento: ".$texto),0,0,'');
			$pdf->Cell(30,5,utf8_decode('1'),0,0,'C');
			$pdf->Cell(30,5,utf8_decode('0'),0,0,'C');
			$pdf->Cell(30,5,utf8_decode("$".number_format($valor,2,',','.')),0,1,'C');
		}
	}

	$pdf->Ln(15);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(95,5,utf8_decode('TOTAL '),0,0,'C');
	$pdf->Cell(30,5,"$".number_format($totaldevengado,2,',','.'),0,0,'C');
	$pdf->Cell(30,5,"$".number_format($descuentos_totales,2,',','.'),0,1,'C');
	$pdf->Ln(5);
	$pdf->Cell(95,5,utf8_decode("NETO PAGADO"),0,0,'C');
	$pdf->Cell(60,5,"$".number_format($totalpagar,2,',','.'),0,0,'C');


$pdf->Output();
?>