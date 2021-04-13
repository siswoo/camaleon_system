<?php
$bd_servidor = "localhost";
$bd_usuario = "camaleon_jaime";
$bd_contrasena = "passwordjaime123";
$bd_basededatos = "camaleon_jaime1";
//passwordcpanel123
$conn = mysqli_connect( $bd_servidor, $bd_usuario, $bd_contrasena ) or die ("Problemas con la Base de datos, contactar al desarollador");
$db = mysqli_select_db( $conn, $bd_basededatos ) or die ( "Error con la base de datos registrar la configuración" );