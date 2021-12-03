<?php
$modelo_id = $_POST['variable'];
$responsable = $_POST['responsable'];

include('conexion.php');

$sql2 = "DELETE FROM soporte_responsable_modelo WHERE id_modelo =".$modelo_id." and id_soporte = ".$responsable;
$borrar1 = mysqli_query($conexion,$sql2);

$datos = [
	"resultado" => 'ok',
];

echo json_encode($datos);

?>