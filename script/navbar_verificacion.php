<?php

$consulta1 = "SELECT * FROM roles WHERE id = ".$_SESSION['rol']." LIMIT 1";
$resultado1 = mysqli_query( $conexion, $consulta1 );
while($row1 = mysqli_fetch_array($resultado1)) {
	$usuario_rol = $row1['nombre'];
	$modelo_view = $row1['modelo_view'];
	$modelo_edit = $row1['modelo_edit'];
	$modelo_delete = $row1['modelo_delete'];

	$roles_view = $row1['roles_view'];
	$roles_edit = $row1['roles_edit'];
	$roles_delete = $row1['roles_delete'];

	$seguridad_view = $row1['seguridad_view'];

	$pasante_view = $row1['pasante_view'];
	$pasante_edit = $row1['pasante_edit'];
	$pasante_delete = $row1['pasante_delete'];
}

?>