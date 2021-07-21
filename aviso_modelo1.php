<?php
include('script/conexion.php');
$sql1 = "SELECT * FROM modelos WHERE estatus = 'Activa' and sede = 1 ORDER BY id DESC LIMIT 1,100";
$proceso1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($proceso1)) {
	$telefono = $row1["telefono1"];
	$nombre_modelo = $row1["nombre1"]." ".$row1["nombre2"]." ".$row1["apellido1"]." ".$row1["apellido2"];
	$msg = "Hola! recuerda que la página para ingresar a nuestra APP es https://camaleonmg.com/";
	$phone = '57'.$telefono;
	//$phone = '573227008002';
	$result = sendMessage($phone,$msg);
	if($result !== false){
		if($result->sent == 1){
			//echo "enviado a -> ".$nombre_modelo;
		}else{
			echo "no enviado a -> ".$nombre_modelo;
		}
	}else{
		var_dump($result);
	}
}
function sendMessage($to,$msg){
	$data = [
		'phone' => $to,
		'body' => $msg,
	];

	$CHAT_URL = 'instance261035';
	$CHAT_TOKEN = 'hyg1a0vao95bq3ij';

	$json = json_encode($data);
	$url = 'https://api.chat-api.com/'.$CHAT_URL.'/sendMessage?token='.$CHAT_TOKEN;
	$options = stream_context_create(['http' => [
		'method' => 'POST',
		'header' => 'Content-type: application/json',
		'content' => $json
	]]);

	$result = file_get_contents($url, false, $options);
	if($result) return json_decode($result);
	return false;
}

?>