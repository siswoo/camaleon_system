<?php
include('conexion.php');

$usuario = $_POST['usuario'];
$clave = md5($_POST["clave"]);
$documento_numero = $_POST["clave"];
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

		$consulta2 = "SELECT * FROM modelos WHERE usuario_modelo = ".$usuario_id;
		$resultado2 = mysqli_query( $conexion, $consulta2 );
		$contador2 = mysqli_num_rows($resultado2);
		while($row2 = mysqli_fetch_array($resultado2)) {
			$estatus = $row2['estatus'];
		}

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
				"estatus" 			=> $estatus,
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
}else{
	$consulta3 = "SELECT * FROM nomina WHERE correo = '".$usuario."' and clave = '".md5($documento_numero)."' and estatus = 'Aceptado' LIMIT 1";
	$resultado3 = mysqli_query($conexion,$consulta3);
	$contador3 = mysqli_num_rows($resultado3);
	if($contador3>=1){
		while($row3 = mysqli_fetch_array($resultado3)) {
			$nomina_id=$row3['id'];
			$nomina_nombre=$row3['nombre'];
			$nomina_apellido=$row3['apellido'];
			$nomina_correo=$row3['correo'];
			$nomina_telefono=$row3['telefono'];
			$usuario_rol=$row3['cargo'];
			$nomina_sede=$row3['sede'];
			$estatus=$row3['estatus'];
			$nomina_documento_numero=$row3['documento_numero'];

			$datos = [
				"usuario_id" 		=> $nomina_id,
				"usuario_nombre" 	=> $nomina_nombre,
				"usuario_apellido" 	=> $nomina_apellido,
				"usuario_correo" 	=> $nomina_correo,
				"usuario_usuario" 	=> $nomina_nombre,
				"usuario_telefono1" => $nomina_telefono,
				"usuario_rol" 		=> $usuario_rol,
				"usuario_sede" 		=> $nomina_sede,
				"redireccion" 		=> 'nomina',
				"sql" 				=> $consulta3,
			];

			session_start();
			$_SESSION["id"] = $nomina_id;
			$_SESSION["nombre"] = $nomina_nombre;
			$_SESSION["apellido"] = $nomina_apellido;
			$_SESSION["correo"] = $nomina_correo;
			$_SESSION["usuario"] = $nomina_nombre;
			$_SESSION["telefono1"] = $nomina_telefono;
			$_SESSION["rol"] = $usuario_rol;
			$_SESSION["sede"] = $nomina_sede;
			$_SESSION["documento_numero"] = $nomina_documento_numero;
			echo json_encode($datos);
		}
	}
}

if(@$usuario_rol!=5 and @$contador3==0){
	$estatus = 'Activo';
}

if($pase==1 and $estatus!='Inactiva'){
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
}
	
if($pase==0 and $estatus=='Inactiva'){
	echo $pase;
}

?>