<?php

function sendMessage($to,$msg){
	include('conexion2.php');

	$data = [
		'phone' => $to,
		'body' => $msg,
	];

	$sql9 = "SELECT * FROM apiwhatsapp";
	$proceso9 = mysqli_query($conexion2,$sql9);
	while($row9 = mysqli_fetch_array($proceso9)) {
		$CHAT_URL = $row9["url"];
		$CHAT_TOKEN = $row9["token"];
	}

	$json = json_encode($data);
	$url = 'https://api.chat-api.com/'.$CHAT_URL.'/sendMessage?token='.$CHAT_TOKEN;
	$options = stream_context_create(['http' => [
			'method' => 'POST',
			'header' => 'Content-type: application/json',
			'content' => $json
		]
	]);

	$result = file_get_contents($url, false, $options);
	if($result) return json_decode($result);
	return false;
	}
	
?>