<?php
include("../script/conexion.php");
$sql1 = "SELECT * FROM modelos_cuentas WHERE id_paginas = 4";
$proceso1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($proceso1)) {
	$id = $row1["id"];
	$usuario = $row1["usuario"];
	$sql2 = "UPDATE modelos_cuentas SET usuario_bonga = '".$usuario."' WHERE id = ".$id;
	$proceso2 = mysqli_query($conexion,$sql2);
}
?>