<?php
$id = $_POST['variable'];
$id_modelo = $_POST['id_modelo'];
include('conexion.php');

$sql1 = "DELETE FROM modelos_documentos WHERE id = ".$id." and id_modelos = ".$id_modelo;
$registro1 = mysqli_query( $conexion, $sql1 );

$location = "../resources/documentos/modelos/archivos/".$id_modelo."/sensuales_".$id.".jpg";
@unlink($location);

$datos = [
	"sql" 		=> $sql1,
];

echo json_encode($datos);
?>