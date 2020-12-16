<?php

include('conexion.php');

$sql1 = "SELECT enterado FROM pasantes";
$consulta1 = mysqli_query($conexion,$sql1);
//$contador1 = mysqli_num_rows($consulta1);

$contador_google = 0;
$contador_facebook = 0;
$contador_twitter = 0;
$contador_instagram = 0;
$contador_pw = 0;
$contador_conocido = 0;

while($row1 = mysqli_fetch_array($consulta1)) {
	$enterado = $row1['enterado'];
	if($enterado == 'Google'){
		$contador_google = $contador_google+1;
	}

	if($enterado == 'Facebook'){
		$contador_facebook = $contador_facebook+1;
	}

	if($enterado == 'Twitter'){
		$contador_twitter = $contador_twitter+1;
	}

	if($enterado == 'Instagram'){
		$contador_instagram = $contador_instagram+1;
	}

	if($enterado == 'Pagina Web'){
		$contador_pw = $contador_pw+1;
	}

	if($enterado == 'Conocido'){
		$contador_conocido = $contador_conocido+1;
	}
}

/*****************PORCENTAJES*******************/

$suma = $contador_google+$contador_facebook+$contador_twitter+$contador_instagram+$contador_pw+$contador_conocido;

$porcentaje_google = ($contador_google*$suma)/10000;
$porcentaje_facebook = ($contador_facebook*$suma)/10000;
$porcentaje_twitter = ($contador_twitter*$suma)/10000;
$porcentaje_instagram = ($contador_instagram*$suma)/10000;
$porcentaje_pw = ($contador_pw*$suma)/10000;
$porcentaje_conocido = ($contador_conocido*$suma)/10000;

/***********************************************/

$datos = [
	"Sql" 					=> $sql1,
	"contador_google" 		=> $contador_google,
	"contador_facebook" 	=> $contador_facebook,
	"contador_twitter" 		=> $contador_twitter,
	"contador_instagram" 	=> $contador_instagram,
	"contador_pw" 			=> $contador_pw,
	"contador_conocido" 	=> $contador_conocido,

	"porcentaje_google" 		=> $porcentaje_google,
	"porcentaje_facebook" 		=> $porcentaje_facebook,
	"porcentaje_twitter" 		=> $porcentaje_twitter,
	"porcentaje_instagram" 		=> $porcentaje_instagram,
	"porcentaje_pw" 			=> $porcentaje_pw,
	"porcentaje_conocido" 		=> $porcentaje_conocido,

	"suma" 		=> $suma,
];

echo json_encode($datos);

?>