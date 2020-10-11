<?php
include('conexion.php');
$variable = $_POST['variable'];
$sql1 = "SELECT * FROM roles WHERE id = ".$variable;
$registro1 = mysqli_query( $conexion, $sql1 );

while($row = mysqli_fetch_array($registro1)) {
	$id 				= $row['id'];
	$nombre 			= $row['nombre'];
	$modelo_view 		= $row['modelo_view'];
	$modelo_edit 		= $row['modelo_edit'];
	$modelo_delete 		= $row['modelo_delete'];

	$roles_view 		= $row['roles_view'];
	$roles_edit 		= $row['roles_edit'];
	$roles_delete 		= $row['roles_delete'];

	$pasante_view 		= $row['pasante_view'];
	$pasante_edit 		= $row['pasante_edit'];
	$pasante_delete 	= $row['pasante_delete'];
}

$datos = [
	"id" 			=> $id,
	"nombre" 		=> $nombre,
	"modelo_view" 	=> $modelo_view,
	"modelo_edit" 	=> $modelo_edit,
	"modelo_delete" => $modelo_delete,
	
	"roles_view" 	=> $roles_view,
	"roles_edit" 	=> $roles_edit,
	"roles_delete" 	=> $roles_delete,

	"pasante_view" 	=> $pasante_view,
	"pasante_edit" 	=> $pasante_edit,
	"pasante_delete" 	=> $pasante_delete,
];

echo json_encode($datos);

?>