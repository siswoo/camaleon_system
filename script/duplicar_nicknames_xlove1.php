<?php
include('conexion.php');

$sql1= "SELECT * FROM modelos_cuentas";
$registro1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($registro1)) {
	$id_cuentas = $row1['id'];
	$usuario = $row1['usuario'];
	$id_paginas = $row1['id_paginas'];
	if($id_paginas==11){
		$sql2 = "UPDATE modelos_cuentas SET nickname_xlove = '$usuario' WHERE id = ".$id_cuentas;
		$registro2 = mysqli_query($conexion,$sql2);
	}
}

?>