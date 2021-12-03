<?php
include('../script/conexion.php');
$sql1 = "SELECT id,documento_numero FROM modelos";
$consulta1 = mysqli_query($conexion,$sql1);
while($row1=mysqli_fetch_array($consulta1)){
	$numero = $row1["documento_numero"];
	$numero = str_replace(' ', '', $numero);
	echo $numero;
}
?>