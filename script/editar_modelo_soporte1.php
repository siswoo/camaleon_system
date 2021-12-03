<?php
/***********PERSONALES*************/
$id = $_POST['edit_id2'];
$tipo_documento = $_POST['edit_tipo_documento2'];
$numero_documento = $_POST['edit_numero_documento2'];
$primer_nombre = $_POST['edit_primer_nombre2'];
$segundo_nombre = $_POST['edit_segundo_nombre2'];
$primer_apellido = $_POST['edit_primer_apellido2'];
$segundo_apellido = $_POST['edit_segundo_apellido2'];
$correo = $_POST['edit_correo2'];
$telefono1 = $_POST['edit_telefono12'];
$telefono2 = $_POST['edit_telefono22'];
$direccion = $_POST['edit_direccion2'];
$genero = $_POST['edit_genero2'];
$estatus = $_POST['edit_estatus2'];
$barrio = $_POST['barrio2'];
$perfil_transmision = $_POST['perfil_transmision2'];
/*************************************/
/**********BANCARIOS*****************/
/*
$banco_cedula = $_POST['banco_cedula2'];
$banco_nombre = $_POST['banco_nombre2'];
$banco_tipo = $_POST['banco_tipo2'];
$banco_numero = $_POST['banco_numero2'];
$banco_banco = $_POST['banco_banco2'];
$banco_cpp = $_POST['BCPP2'];
*/
/*************************************/
/**********CORPORALES*****************/
$altura = $_POST['altura2'];
$peso = $_POST['peso2'];
$tpene = $_POST['tpene2'];
$tsosten = $_POST['tsosten2'];
$tbusto = $_POST['tbusto2'];
$tcintura = $_POST['tcintura2'];
$tcaderas = $_POST['tcaderas2'];
$tipo_cuerpo = $_POST['tipo_cuerpo2'];
$Pvello = $_POST['Pvello2'];
$color_cabello = $_POST['color_cabello2'];
$color_ojos = $_POST['color_ojos2'];
$Ptattu = $_POST['Ptattu2'];
$Ppiercing = $_POST['Ppiercing2'];
/*************************************/
/**********EMPRESA*****************/
$turno = $_POST['edit_turno2'];
$sede = $_POST['edit_sede2'];
$htransmision = $_POST['edit_Htransmision2'];
$equipo = $_POST['equipo2'];
/*************************************/
/**********EXTRAS*****************/
$fecha_inicio = date('Y-m-d');

	include('conexion.php');
	/*
	$sql1 = "UPDATE modelos SET documento_tipo = '".$tipo_documento."',documento_numero = '".$numero_documento."',nombre1 = '".$primer_nombre."',nombre2 = '".$segundo_nombre."',apellido1 = '".$primer_apellido."',apellido2 = '".$segundo_apellido."',correo = '".$correo."',telefono1 = '".$telefono1."',telefono2 = '".$telefono2."',direccion = '".$direccion."',genero = '".$genero."',estatus = '".$estatus."',barrio = '".$barrio."',perfil_de_transmision = '".$perfil_transmision."',altura = '".$altura."',peso = '".$peso."',tpene = '".$tpene."',tsosten = '".$tsosten."',tbusto = '".$tbusto."',tcintura = '".$tcintura."',tcaderas = '".$tcaderas."',tipo_cuerpo = '".$tipo_cuerpo."',Pvello = '".$Pvello."',color_cabello = '".$color_cabello."',color_ojos = '".$color_ojos."',Ptattu = '".$Ptattu."',Ppiercing = '".$Ppiercing."',turno = '".$turno."',sede = '".$sede."',Htransmision = '".$htransmision."',select_equipo = '".$equipo."',fecha_inicio = '".$fecha_inicio."', banco_cedula = '".$banco_cedula."', banco_nombre = '".$banco_nombre."',banco_tipo = '".$banco_tipo."',banco_numero = '".$banco_numero."',banco_banco = '".$banco_banco."',BCPP = '".$banco_cpp."' WHERE id =".$id;
	*/

	$sql1 = "UPDATE modelos SET documento_tipo = '".$tipo_documento."',documento_numero = '".$numero_documento."',nombre1 = '".$primer_nombre."',nombre2 = '".$segundo_nombre."',apellido1 = '".$primer_apellido."',apellido2 = '".$segundo_apellido."',correo = '".$correo."',telefono1 = '".$telefono1."',telefono2 = '".$telefono2."',direccion = '".$direccion."',genero = '".$genero."',estatus = '".$estatus."',barrio = '".$barrio."',perfil_de_transmision = '".$perfil_transmision."',altura = '".$altura."',peso = '".$peso."',tpene = '".$tpene."',tsosten = '".$tsosten."',tbusto = '".$tbusto."',tcintura = '".$tcintura."',tcaderas = '".$tcaderas."',tipo_cuerpo = '".$tipo_cuerpo."',Pvello = '".$Pvello."',color_cabello = '".$color_cabello."',color_ojos = '".$color_ojos."',Ptattu = '".$Ptattu."',Ppiercing = '".$Ppiercing."',turno = '".$turno."',sede = '".$sede."',Htransmision = '".$htransmision."',select_equipo = '".$equipo."',fecha_inicio = '".$fecha_inicio."' WHERE id =".$id;
	$modificar1 = mysqli_query( $conexion, $sql1 );

	$sql2 = "SELECT * FROM sedes WHERE id = ".$sede;
	$consulta2 = mysqli_query($conexion,$sql2);
	while($row2 = mysqli_fetch_array($consulta2)) {
		$sede_nombre = $row2['nombre'];
	}

	$datos = [
		//"SQL1:"		=> $sql1,
		"id"		=> $id,
		"nombre"	=> $primer_nombre." ".$segundo_nombre." ".$primer_apellido." ".$segundo_apellido,
		"td"		=> $tipo_documento,
		"nd"		=> $numero_documento,
		"turno"		=> $turno,
		"sede"		=> $sede_nombre,
		"telefono"	=> $telefono1,
	];

	echo json_encode($datos);
?>