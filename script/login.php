<?php
include('conexion.php');
$usuario = $_POST['usuario'];
$clave = md5($_POST["clave"]);
$documento_numero = $_POST["clave"];
$pase = 0;

$sql1 = "SELECT * FROM usuarios WHERE (usuario = '".$usuario."' and clave = '".$clave."') or (correo = '".$usuario."' and clave = '".$clave."') LIMIT 1";
$proceso1 = mysqli_query($conexion,$sql1);
$contador1 = mysqli_num_rows($proceso1);

if($contador1>=1){
	while($row1 = mysqli_fetch_array($proceso1)) {
		$usuario_id=$row1['id'];
		$usuario_nombre=$row1['nombre'];
		$usuario_documento_numero=$row1['documento_numero'];
		$usuario_sede=$row1['sede'];
		$usuario_rol=$row1['rol'];
		$usuario_correo=$row1['correo'];
		$usuario_usuario=$row1['usuario'];
		$redireccion = "welcome.php";

		if($usuario_rol==4){
			$redireccion = "pasante/crear_cuenta.php";
			session_start();
			$_SESSION["id"] = $usuario_id;
			$_SESSION["nombre"] = $usuario_nombre;
			$_SESSION["documento_numero"] = $usuario_documento_numero;
			$_SESSION["sede"] = $usuario_sede;
			$_SESSION["rol"] = $usuario_rol;
			$datos = [
				"estatus"	=> "ok",
				"redireccion"	=> $redireccion,
			];
			echo json_encode($datos);
			exit;
		}else if($usuario_rol==5){
			$sql2 = "SELECT * FROM modelos WHERE usuario = '$usuario' or correo = '$usuario'";
			$proceso2 = mysqli_query($conexion,$sql2);
			$contador2 = mysqli_num_rows($proceso2);

			if($contador2==0){
				$datos = [
					"estatus"	=> "error",
					"msg"	=> "Credenciales incorrectas!",
					"sql2"	=> $sql2,
				];
				echo json_encode($datos);
				exit;
			}
			while($row2 = mysqli_fetch_array($proceso2)) {
				$modelo_usuario = $row2["usuario"];
				$modelo_estatus = $row2["estatus"];
			}

			if($modelo_estatus=='Inactiva'){
				$datos = [
					"estatus"	=> "error",
					"msg"	=> "Su cuenta esta Inactiva",
				];
				echo json_encode($datos);
				exit;
			}

			$redireccion = "modelo/perfil.php";
			session_start();
			$_SESSION["id"] = $usuario_id;
			$_SESSION["usuario"] = $modelo_usuario;
			$_SESSION["nombre"] = $usuario_nombre;
			$_SESSION["documento_numero"] = $usuario_documento_numero;
			$_SESSION["sede"] = $usuario_sede;
			$_SESSION["rol"] = 5;
			$datos = [
				"estatus"	=> "ok",
				"redireccion"	=> $redireccion,
			];
			echo json_encode($datos);
			exit;
		}else{
			$redireccion = "welcome.php";
			session_start();
			$_SESSION["id"] = $usuario_id;
			$_SESSION["nombre"] = $usuario_nombre;
			$_SESSION["documento_numero"] = $usuario_documento_numero;
			$_SESSION["sede"] = $usuario_sede;
			$_SESSION["rol"] = $usuario_rol;
			$datos = [
				"estatus"	=> "ok",
				"redireccion"	=> $redireccion,
			];
			echo json_encode($datos);
			exit;
		}
	}
}

$sql3 = "SELECT * FROM nomina WHERE correo = '$usuario' and clave = '$clave'";
$proceso3 = mysqli_query($conexion,$sql3);
$contador3 = mysqli_num_rows($proceso3);

if($contador3>=1){
	$redireccion = "nomina/perfil.php";
	while($row3 = mysqli_fetch_array($proceso3)) {
		$usuario_id=$row3['id'];
		$usuario_nombre=$row3['nombre']." ".$row3['apellido'];
		$usuario_sede=$row3['sede'];
		$usuario_cargo=$row3['cargo'];
		$usuario_documento_numero=$row3['documento_numero'];
		$usuario_estatus = $row3['estatus'];

		if($usuario_estatus!='Aceptado'){
			$datos = [
				"estatus"	=> "error",
				"msg"	=> "Su usuario esta desactivado!",
			];
			echo json_encode($datos);
			exit;
		}

		session_start();
		$_SESSION["id"] = $usuario_id;
		$_SESSION["nombre"] = $usuario_nombre;
		$_SESSION["documento_numero"] = $usuario_documento_numero;
		$_SESSION["sede"] = $usuario_sede;
		$_SESSION["rol"] = $usuario_cargo;
			
		$datos = [
			"estatus"	=> "ok",
			"redireccion"	=> $redireccion,
		];
		echo json_encode($datos);
		exit;
	}
}

$sql4 = "SELECT * FROM contenido_modelos WHERE (correo = '$usuario' or usuario = '$usuario') and clave = '$clave'";
$proceso4 = mysqli_query($conexion,$sql4);
$contador4 = mysqli_num_rows($proceso4);

if($contador4>=1){
	$redireccion = "contenido/perfil.php";
	while($row4 = mysqli_fetch_array($proceso4)) {
		$usuario_id=$row4['id'];
		$usuario_nombre=$row4['nombre1']." ".$row4['apellido1'];
		$usuario_documento_numero=$row4['documento_numero'];

		session_start();
		$_SESSION["id"] = $usuario_id;
		$_SESSION["nombre"] = $usuario_nombre;
		$_SESSION["documento_numero"] = $usuario_documento_numero;
			
		$datos = [
			"estatus"	=> "ok",
			"redireccion"	=> $redireccion,
		];
		echo json_encode($datos);
		exit;
	}
}

if($contador1==0 and $contador3==0 and $contador4==0){
	$datos = [
		"estatus"	=> "error",
		"msg"	=> "Credenciales incorrectas!",
	];
	echo json_encode($datos);
	exit;
}

?>