<?php
/*
$servidor3 = "localhost";
$usuario3 = "camaleon_juanmaldonado";
$contrasena3 = "juanmaldonado123";
$basededatos3 = "camaleon_spa";
*/

$servidor3 = "localhost";
$usuario3 = "root";
$contrasena3 = "";
$basededatos3 = "spa";

$conexion3 = mysqli_connect( $servidor3, $usuario3, $contrasena3 ) or die ("Problemas con la Base de datos, contactar al desarollador");
$db3 = mysqli_select_db( $conexion3, $basededatos3 ) or die ( "Error con la base de datos registrar la configuración" );

if (!mysqli_set_charset($conexion3, "utf8")) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($conexion2));
    exit();
} else {}


date_default_timezone_set("America/Bogota");