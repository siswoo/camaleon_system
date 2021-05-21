<?php
include("script/conexion.php");
$sql1 = "SELECT * FROM presabana WHERE inicio != '2021-05-01'";
$proceso1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($proceso1)) {
	$id = $row1["id"];
	$rf = $row1["rf"];
	$trm = $row1["trm"];

	$calculo = $rf*$trm;

	$sql2 = "UPDATE presabana SET rf = '$calculo' WHERE id = ".$id;
	$proceso2 = mysqli_query($conexion,$sql2);
}

echo "Listo";

?>