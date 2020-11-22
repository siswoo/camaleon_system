<?php
$asunto = $_POST['asunto'];
$id = $_POST['id'];
	if($asunto=='personales'){
	/***********PERSONALES*************/
	/*
	$tipo_documento = $_POST['tipo_documento'];
	$numero_documento = $_POST['numero_documento'];
	$primer_nombre = $_POST['primer_nombre'];
	$primer_apellido = $_POST['primer_apellido'];
	$segundo_apellido = $_POST['segundo_apellido'];
	$correo = $_POST['correo'];
	*/
	$segundo_nombre = $_POST['segundo_nombre'];
	$telefono1 = $_POST['telefono1'];
	$telefono2 = $_POST['telefono2'];
	$direccion = $_POST['direccion'];
	$genero = $_POST['f1_genero'];
	//$estatus = $_POST['estatus'];
	$barrio = $_POST['barrio'];
	$nickname = $_POST['nickname'];
	$perfil_de_transmision = $_POST['perfil_transmision'];
	/*************************************/
	$sql1 = "UPDATE modelos SET nombre2 = '$segundo_nombre',telefono1 = '$telefono1',telefono2 = '$telefono2',direccion = '$direccion',barrio = '$barrio',sugerenciaNickname = '$nickname', perfil_de_transmision = '$perfil_de_transmision'  WHERE id = ".$id;
}else if($asunto=='bancarios'){
	/**********BANCARIOS*****************/
	$banco_cedula = $_POST['banco_cedula'];
	$banco_nombre = $_POST['banco_nombre'];
	$banco_tipo = $_POST['banco_tipo'];
	$banco_numero = $_POST['banco_numero'];
	$banco_banco = $_POST['banco_banco'];
	$banco_cpp = $_POST['BCPP'];
	/*************************************/
	$sql1 = "UPDATE modelos SET banco_cedula = '$banco_cedula',banco_nombre = '$banco_nombre',banco_tipo = '$banco_tipo',banco_numero = '$banco_numero',banco_banco = '$banco_banco',BCPP = '$banco_cpp' WHERE id = ".$id;
}else if($asunto=='corporales'){

	$genero = $_POST['f3_genero'];
	if($genero=='Hombre' or $genero=='Transexual'){
		$tpene = $_POST['tpene'];
		$altura = $_POST['altura'];
		$peso = $_POST['peso'];
		$tipo_cuerpo = $_POST['tipo_cuerpo'];
		$Pvello = $_POST['Pvello'];
		$color_cabello = $_POST['color_cabello'];
		$color_ojos = $_POST['color_ojos'];
		$Ptattu = $_POST['Ptattu'];
		$Ppiercing = $_POST['Ppiercing'];
		$sql1 = "UPDATE modelos SET altura = '$altura',peso = '$peso',tpene = '$tpene',tipo_cuerpo = '$tipo_cuerpo',Pvello = '$Pvello',color_cabello = '$color_cabello',color_ojos = '$color_ojos',Ptattu = '$Ptattu',Ppiercing = '$Ppiercing' WHERE id = ".$id;
	}

	if($genero=='Mujer' or $genero=='Transexual'){
		$tsosten = $_POST['tsosten'];
		$tbusto = $_POST['tbusto'];
		$tcintura = $_POST['tcintura'];
		$tcaderas = $_POST['tcaderas'];
		$altura = $_POST['altura'];
		$peso = $_POST['peso'];
		$tipo_cuerpo = $_POST['tipo_cuerpo'];
		$Pvello = $_POST['Pvello'];
		$color_cabello = $_POST['color_cabello'];
		$color_ojos = $_POST['color_ojos'];
		@$Ptattu = $_POST['f3_hidden_Ptattu'];
		@$Ppiercing = $_POST['f3_hidden_Ppiercing'];
		$sql1 = "UPDATE modelos SET altura = '$altura',peso = '$peso',tsosten = '$tsosten',tbusto = '$tbusto',tcintura = '$tcintura',tcaderas = '$tcaderas',tipo_cuerpo = '$tipo_cuerpo',Pvello = '$Pvello',color_cabello = '$color_cabello',color_ojos = '$color_ojos',Ptattu = '$Ptattu',Ppiercing = '$Ppiercing' WHERE id = ".$id;
	}
}else if($asunto=='empresa'){
	/**********EMPRESA*****************/
	$turno = $_POST['turno'];
	$sede = $_POST['sede'];
	$htransmision = $_POST['Htransmision'];
	/*
	$equipo = $_POST['equipo'];
	$crear_equipo = $_POST['crear_equipo'];
	/*************************************/
	/**********EXTRAS*****************/
	$fecha_inicio = date('Y-m-d');
	/*
	@$enlazar = $_POST['select_enlazar'];
	@$enlazar2 = $_POST['select_enlazar'];

	if($enlazar==null or $enlazar==''){$enlazar=0;}
	if($Ptattu==null or $Ptattu==''){$Ptattu=='';}
	if($Ppiercing==null or $Ppiercing==''){$Ppiercing=='';}
	*/
	$sql1 = "UPDATE modelos SET turno = '$turno', sede = '$sede', Htransmision = '$htransmision' WHERE id = ".$id;
}


	include('conexion.php');
	$modificar1 = mysqli_query($conexion, $sql1);

/*
	$sql1 = "INSERT INTO modelos (documento_tipo,documento_numero,nombre1,nombre2,apellido1,apellido2,correo,telefono1,telefono2,direccion,genero,estatus,barrio,banco_cedula,banco_nombre,banco_tipo,banco_banco,BCPP,altura,peso,tpene,tsosten,tbusto,tcintura,tcaderas,tipo_cuerpo,Pvello,color_cabello,color_ojos,Ptattu,Ppiercing,turno,sede,Htransmision,select_equipo,equipo,fecha_inicio) VALUES ('$tipo_documento','$numero_documento','$primer_nombre','$segundo_nombre','$primer_apellido','$segundo_apellido','$correo','$telefono1','$telefono2','$direccion','$genero','$estatus','$barrio','$banco_cedula','$banco_nombre','$banco_tipo','$banco_banco','$banco_cpp','$altura','$peso','$tpene','$tsosten','$tbusto','$tcintura','$tcaderas','$tipo_cuerpo','$Pvello','$color_cabello','$color_ojos','$Ptattu','$Ppiercing','$turno','$sede','$htransmision','$equipo','$crear_equipo','$fecha_inicio')";
	//$registro1 = mysqli_query( $conexion, $sql1 );
*/

	$datos = [
		"sql1" 	=> $sql1,
	];

	echo json_encode($datos);
?>