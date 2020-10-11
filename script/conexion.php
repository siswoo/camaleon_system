<?php
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$basededatos = "sistema";

$conexion = mysqli_connect( $servidor, $usuario, $contrasena ) or die ("Problemas con la Base de datos, contactar al desarollador");
$db = mysqli_select_db( $conexion, $basededatos ) or die ( "Error con la base de datos registrar la configuración" );