<?php
session_start();
include('conexion.php');
require('../resources/fpdf/fpdf.php');

$sql1 = "SELECT * FROM nomina WHERE id = ".$_SESSION["id"];
$proceso1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($proceso1)) {
	$nombre = $row1["nombre"];
	$documento_tipo = $row1["documento_tipo"];
	$documento_numero = $row1["documento_numero"];
	$direccion = $row1["direccion"];
	$telefono = $row1["telefono"];
	$cargo = $row1["cargo"];
	$salario = $row1["salario"];
	$funcion = $row1["funcion"];
}

$sql2 = "SELECT * FROM funciones WHERE id = ".$funcion;
$proceso2 = mysqli_query($conexion,$sql2);
while($row2 = mysqli_fetch_array($proceso2)) {
	$funcion_nombre = $row2["nombre"];
	$funcion_descripcion = $row2["descripcion"];
}


class PDF extends FPDF{
	function Header(){
	    //
	}

	function Footer(){
	    //
	}
}


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Ln(30);
$pdf->SetFont('Times','B',12);
$pdf->Cell(190,10,utf8_decode( $this->Image('../img/slider_welcome/slider3.jpg',55,15,100,40) ),0,0,'C');

$pdf->Ln(10);
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('Hola'),0,'');

/*
if($contador1 >= 1){
	$pdf->Image('../resources/documentos/modelos/archivos/'.$id_modelo.'/firma_digital.jpg',55,155,100,40);
}
*/

$pdf->MultiCell(0,5,utf8_decode('-----------------------------------------------------------------------------'),0,'C');

//$pdf->Output();
?>