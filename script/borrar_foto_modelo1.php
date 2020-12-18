<?php
session_start();
include('conexion.php');
$id_modelo = $_POST['id_modelo'];
$documento = $_POST['documento'];
$id_documento = $_POST['id_documento'];
$responsable = $_SESSION['id'];

$sql1 = "SELECT * FROM modelos_documentos WHERE id = ".$id_documento;
$consulta1 = mysqli_query($conexion,$sql1);
$contador1 = mysqli_num_rows($consulta1);

if($contador1==0){
	$datos = [
		"resultado" => "no existe",
	];

	echo json_encode($datos);
	exit;
}

$sql2 = "DELETE FROM modelos_documentos WHERE id = ".$id_documento;
$consulta2 = mysqli_query($conexion,$sql2);
unlink('../resources/documentos/modelos/archivos/'.$id_modelo.'/'.$documento);

$datos = [
	"resultado" => "correcto",
];

echo json_encode($datos);

?>