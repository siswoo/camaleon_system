<?php
include('conexion.php');

$usuario = $_POST['usuario'];
$clave = md5($_POST["clave"]);
$pase = 0;

$consulta1 = "SELECT * FROM usuarios WHERE (usuario = '".$usuario."' and clave = '".$clave."') or (correo = '".$usuario."' and clave = '".$clave."') LIMIT 1";
$resultado1 = mysqli_query( $conexion, $consulta1 );
$fila1 = mysqli_num_rows($resultado1);

if($fila1>=1){
	$pase = 1;
	while($row = mysqli_fetch_array($resultado1)) {
		$usuario_id=$row['id'];
		$usuario_nombre=$row['nombre'];
		$usuario_apellido=$row['apellido'];
		$usuario_correo=$row['correo'];
		$usuario_usuario=$row['usuario'];
		$usuario_telefono1=$row['telefono1'];
		$usuario_rol=$row['rol'];
		$usuario_sede=$row['sede'];

		/*********************************************************************/
		if($usuario_rol==4){
			$datos = [
				"usuario_id" 		=> $usuario_id,
				"usuario_nombre" 	=> $usuario_nombre,
				"usuario_apellido" 	=> $usuario_apellido,
				"usuario_correo" 	=> $usuario_correo,
				"usuario_usuario" 	=> $usuario_usuario,
				"usuario_telefono1" => $usuario_telefono1,
				"usuario_rol" 		=> $usuario_rol,
				"usuario_sede" 		=> $usuario_sede,
				"redireccion" 		=> 'pasantia',
			];
		}else if($usuario_rol==5){
			$datos = [
				"usuario_id" 		=> $usuario_id,
				"usuario_nombre" 	=> $usuario_nombre,
				"usuario_apellido" 	=> $usuario_apellido,
				"usuario_correo" 	=> $usuario_correo,
				"usuario_usuario" 	=> $usuario_usuario,
				"usuario_telefono1" => $usuario_telefono1,
				"usuario_rol" 		=> $usuario_rol,
				"usuario_sede" 		=> $usuario_sede,
				"redireccion" 		=> 'modelo',
			];
		}else{
			$datos = [
				"usuario_id" 		=> $usuario_id,
				"usuario_nombre" 	=> $usuario_nombre,
				"usuario_apellido" 	=> $usuario_apellido,
				"usuario_correo" 	=> $usuario_correo,
				"usuario_usuario" 	=> $usuario_usuario,
				"usuario_telefono1" => $usuario_telefono1,
				"usuario_rol" 		=> $usuario_rol,
				"usuario_sede" 		=> $usuario_sede,
				"redireccion" 		=> 'normal',
			];
		}
		/*********************************************************************/
	}
}

/*
$consulta2 = "SELECT * FROM usuarios WHERE correo = '".$usuario."' and clave = '".$clave."' LIMIT 1";
$resultado2 = mysqli_query( $conexion, $consulta2 );
$fila2 = mysqli_num_rows($resultado2);

if($fila2>=1){
	$pase = 1;
	while($row2 = mysqli_fetch_array($resultado2)) {
		$usuario_id=$row2['id'];
		$usuario_nombre=$row2['nombre'];
		$usuario_apellido=$row2['apellido'];
		$usuario_correo=$row2['correo'];
		$usuario_usuario=$row2['usuario'];
		$usuario_telefono1=$row2['telefono1'];
		$usuario_rol=$row2['rol'];
		$usuario_sede=$row2['sede'];

		if($usuario_rol==4){
			$datos = [
				"usuario_id" 		=> $usuario_id,
				"usuario_nombre" 	=> $usuario_nombre,
				"usuario_apellido" 	=> $usuario_apellido,
				"usuario_correo" 	=> $usuario_correo,
				"usuario_usuario" 	=> $usuario_usuario,
				"usuario_telefono1" => $usuario_telefono1,
				"usuario_rol" 		=> $usuario_rol,
				"usuario_sede" 		=> $usuario_sede,
				"pasantia" 			=> 'si',
			];
		}

		if($usuario_rol!=4){
			$datos = [
				"usuario_id" 		=> $usuario_id,
				"usuario_nombre" 	=> $usuario_nombre,
				"usuario_apellido" 	=> $usuario_apellido,
				"usuario_correo" 	=> $usuario_correo,
				"usuario_usuario" 	=> $usuario_usuario,
				"usuario_telefono1" => $usuario_telefono1,
				"usuario_rol" 		=> $usuario_rol,
				"usuario_sede" 		=> $usuario_sede,
				"pasantia" 			=> 'no',
			];
		}
	}
}
*/

if($pase==1){
	session_start();
	$_SESSION["id"] = $usuario_id;
	$_SESSION["nombre"] = $usuario_nombre;
	$_SESSION["apellido"] = $usuario_apellido;
	$_SESSION["correo"] = $usuario_correo;
	$_SESSION["usuario"] = $usuario_usuario;
	$_SESSION["telefono1"] = $usuario_telefono1;
	$_SESSION["rol"] = $usuario_rol;
	$_SESSION["sede"] = $usuario_sede;

	echo json_encode($datos);
}else{
	echo $pase;
}

?>