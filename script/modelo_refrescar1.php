<?php
	include('conexion.php');
	$id = $_POST['id'];

	$sql1 = "SELECT * FROM modelos WHERE id = ".$id;
	$consulta1 = mysqli_query( $conexion, $sql1 );
	while($row = mysqli_fetch_array($consulta1)) {
		$documento_tipo=$row['documento_tipo'];
		$documento_numero=$row['documento_numero'];
		$nombre1=$row['nombre1'];
		$nombre2=$row['nombre2'];
		$apellido1=$row['apellido1'];
		$apellido2=$row['apellido2'];
		$correo=$row['correo'];
		$telefono1=$row['telefono1'];
		$telefono2=$row['telefono2'];
		$direccion=$row['direccion'];
		$genero=$row['genero'];

		/***********BANCARIO*******************/
		$banco_cedula=$row['banco_cedula'];
		$banco_nombre=$row['banco_nombre'];
		$banco_tipo=$row['banco_tipo'];
		$banco_numero=$row['banco_numero'];
		$banco_banco=$row['banco_banco'];
		$bcpp=$row['BCPP'];

		/*********CORPORALES*************/
		$altura=$row['altura'];
		$peso=$row['peso'];
		$tpene=$row['tpene'];
		$tsosten=$row['tsosten'];
		$tbusto=$row['tbusto'];
		$tcintura=$row['tcintura'];
		$tcaderas=$row['tcaderas'];
		$tipo_cuerpo=$row['tipo_cuerpo'];
		$Pvello=$row['Pvello'];
		$color_cabello=$row['color_cabello'];
		$color_ojos=$row['color_ojos'];
		$Ptattu=$row['Ptattu'];
		$Ppiercing=$row['Ppiercing'];

		/********EMPRESA**************/
		$turno=$row['turno'];
		$sede=$row['sede'];
		$Htransmision=$row['Htransmision'];
		$select_equipo=$row['select_equipo'];
		$equipo=$row['equipo'];
	}

	$datos = [
		"documento_tipo" => $documento_tipo,
		"documento_numero" => $documento_numero,
		"nombre1" => $nombre1,
		"nombre2" => $nombre2,
		"apellido1" => $apellido1,
		"apellido2" => $apellido2,
		"correo" => $correo,
		"telefono1" => $telefono1,
		"telefono2" => $telefono2,
		"direccion" => $direccion,
		"genero" => $genero,
		"banco_cedula" => $banco_cedula,
		"banco_nombre" => $banco_nombre,
		"banco_tipo" => $banco_tipo,
		"banco_numero" => $banco_numero,
		"banco_banco" => $banco_banco,
		"bcpp" => $bcpp,
		"altura" => $altura,
		"peso" => $peso,
		"tpene" => $tpene,
		"tsosten" => $tsosten,
		"tbusto" => $tbusto,
		"tcintura" => $tcintura,
		"tcaderas" => $tcaderas,
		"tipo_cuerpo" => $tipo_cuerpo,
		"Pvello" => $Pvello,
		"color_cabello" => $color_cabello,
		"color_ojos" => $color_ojos,
		"Ptattu" => $Ptattu,
		"Ppiercing" => $Ppiercing,
		"turno" => $turno,
		"sede" => $sede,
		"Htransmision" => $Htransmision,
		"select_equipo" => $select_equipo,
		"equipo" => $equipo,
	];

	echo json_encode($datos);
?>