<?php
$modelo_cuenta_id = $_POST['modelo_cuenta_id'];
@$cuenta_modelo_usuario = $_POST['cuenta_usuario'];
@$cuenta_clave = $_POST['cuenta_clave'];
@$cuenta_correo = $_POST['cuenta_correo'];
@$cuenta_link = $_POST['cuenta_link'];
@$nickname_xlove = $_POST['nickname_xlove'];
@$usuario_bonga = $_POST['usuario_bonga'];

if($cuenta_clave=='' or $cuenta_clave==null){
	$cuenta_clave = '';
}

if($cuenta_correo=='' or $cuenta_correo==null){
	$cuenta_correo = '';
}

if($cuenta_link=='' or $cuenta_link==null){
	$cuenta_link = '';
}

if($nickname_xlove=='' or $nickname_xlove==null){
	$nickname_xlove = '';
}

if($usuario_bonga=='' or $usuario_bonga==null){
	$usuario_bonga = '';
}

include('conexion.php');

$sql1 = "UPDATE modelos_cuentas SET usuario = '$cuenta_modelo_usuario', clave = '$cuenta_clave', correo = '$cuenta_correo', link = '$cuenta_link', nickname_xlove = '$nickname_xlove', usuario_bonga = '$usuario_bonga' WHERE id = ".$modelo_cuenta_id;
$registro1 = mysqli_query( $conexion, $sql1 );

$datos = [
	"id" 		=> $sql1,
];

echo json_encode($datos);

?>