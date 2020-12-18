<?php
include('conexion.php');
$id_modelo = $_POST['id_modelo'];
$condicion = $_POST['condicion'];

if($condicion=='aceptar'){
	$sql1 = "UPDATE modelos_documentos SET estatus = 'Aceptada' WHERE id_modelos = ".$id_modelos;
	$actualizar1 = mysqli_query($conexion,$sql1);
}

$datos = [
	"sql" 		=> $sql1,
];

echo json_encode($datos);

?>