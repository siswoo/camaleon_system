<?php
header('Content-Type: application/json');

require_once('../script/conexion.php');

$sqlQuery = "SELECT SUM(tokens) as tokens, SUM(dolares) as dolares, fecha_desde, fecha_hasta, fecha_inicio FROM xlove GROUP BY fecha_desde";
$result = mysqli_query($conexion,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conexion);

echo json_encode($data);
?>