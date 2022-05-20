<?php
include('conexion2.php');
include('whatsapp.php');
/*****************APARTADO DE WHATSAPP************/
$pagina_nombre = "xxxxxxxxxx";
$codigo_pais = "57";
$modelo_telefono = "3016984868";
$msg = "Cordial saludo, es de nuestro agrado avisar que tu cuenta en la pagina ".$pagina_nombre." ha sido activada, te invitamos a ingresar a nuestro sistema de https://camaleonmg.com/";
$phone = $codigo_pais.$modelo_telefono;
$result = sendMessage($phone,$msg);
if($result !== false){
	if($result->sent == 1){}else{}
}else{
	var_dump($result);
}
/***************************************************/
?>