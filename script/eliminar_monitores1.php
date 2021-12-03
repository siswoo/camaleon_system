<?php
	$id 	= $_POST['variable'];

	include('conexion.php');

	$sql1 = "DELETE FROM usuarios WHERE id = ".$id;
	$eliminar1 = mysqli_query($conexion, $sql1);

	$datos = [
		"Sql"		=> $sql1,
	];

	echo json_encode($datos);
?>