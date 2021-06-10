<?php
$id_modelo = $_POST['cuentas2_id'];
$pagina = $_POST['select_paginas'];
$cuenta = $_POST['cuenta1'];
$clave = $_POST['clave1'];
$correo = $_POST['correo1'];
$link = $_POST['link1'];
$nickname_xlove = $_POST['nickname_xlove'];
$usuario_bonga = $_POST['usuario_bonga'];
$fecha_inicio = date('Y-m-d');

include('conexion.php');

$contador3 = 0;

$sql2 = "SELECT * FROM modelos_cuentas WHERE usuario = '".$cuenta."'";
$registro1 = mysqli_query($conexion,$sql2);
$contador1 = mysqli_num_rows($registro1);

$error1 = 0;
$ok = 0;

if($contador1>=1){
	while($row1 = mysqli_fetch_array($registro1)) {
		$id_modelos2 = $row1["id_modelos"];
		$id_paginas2 = $row1["id_paginas"];
		if($id_modelos2==$id_modelo and $id_paginas2==$pagina){
			$ok = 1;
			$error1 = 1;
		}else if($id_modelos2!=$id_modelo){
			$ok = 2;
			$error1 = 1;
		}
	}
}
if($error1==0){
	$sql1 = "INSERT INTO modelos_cuentas (id_modelos,id_paginas,usuario,clave,correo,link,nickname_xlove,usuario_bonga,estatus,fecha_inicio) VALUES ('$id_modelo','$pagina','$cuenta','$clave','$correo','$link','$nickname_xlove','$usuario_bonga','Proceso','$fecha_inicio')";
	$registro1 = mysqli_query($conexion, $sql1);
}

$datos = [
	"estatus" => $error1,
	"opcion" => $ok,
];

echo json_encode($datos);
exit;

?>