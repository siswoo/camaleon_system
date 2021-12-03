<?php
/***********PERSONALES*************/
$id = $_POST['edit_id'];
$tipo_documento = $_POST['edit_tipo_documento'];
$numero_documento = $_POST['edit_numero_documento'];
$primer_nombre = $_POST['edit_primer_nombre'];
$segundo_nombre = $_POST['edit_segundo_nombre'];
$primer_apellido = $_POST['edit_primer_apellido'];
$segundo_apellido = $_POST['edit_segundo_apellido'];
$correo = $_POST['edit_correo'];
$telefono1 = $_POST['edit_telefono1'];
$telefono2 = $_POST['edit_telefono2'];
$direccion = $_POST['edit_direccion'];
$genero = $_POST['edit_genero'];
$estatus = $_POST['edit_estatus'];
$barrio = $_POST['barrio'];
$perfil_transmision = $_POST['perfil_transmision'];
/*************************************/
/**********BANCARIOS*****************/
$banco_cedula = $_POST['banco_cedula'];
$banco_nombre = $_POST['banco_nombre'];
$banco_tipo = $_POST['banco_tipo'];
$banco_numero=$_POST['banco_numero'];
$banco_banco = $_POST['banco_banco'];
$banco_cpp = $_POST['BCPP'];
/*************************************/
/**********CORPORALES*****************/
$altura = $_POST['altura'];
$peso = $_POST['peso'];
$tpene = $_POST['tpene'];
$tsosten = $_POST['tsosten'];
$tbusto = $_POST['tbusto'];
$tcintura = $_POST['tcintura'];
$tcaderas = $_POST['tcaderas'];
$tipo_cuerpo = $_POST['tipo_cuerpo'];
$Pvello = $_POST['Pvello'];
$color_cabello = $_POST['color_cabello'];
$color_ojos = $_POST['color_ojos'];
@$Ptattu = $_POST['Ptattu'];
@$Ppiercing = $_POST['Ppiercing'];
/*************************************/
/**********EMPRESA*****************/
$turno = $_POST['edit_turno'];
$sede = $_POST['edit_sede'];
$htransmision = $_POST['edit_Htransmision'];
$equipo = $_POST['equipo'];
//$crear_equipo = $_POST['crear_equipo'];
/*************************************/
/**********EXTRAS*****************/
$fecha_inicio = date('Y-m-d');
@$enlazar = $_POST['select_enlazar'];
@$enlazar2 = $_POST['select_enlazar'];

if($enlazar==null or $enlazar==''){$enlazar=0;}
if($Ptattu==null or $Ptattu==''){$Ptattu=='';}
if($Ppiercing==null or $Ppiercing==''){$Ppiercing=='';}

	include('conexion.php');

	$sql1 = "UPDATE modelos SET documento_tipo = '".$tipo_documento."',documento_numero = '".$numero_documento."',nombre1 = '".$primer_nombre."',nombre2 = '".$segundo_nombre."',apellido1 = '".$primer_apellido."',apellido2 = '".$segundo_apellido."',correo = '".$correo."',telefono1 = '".$telefono1."',telefono2 = '".$telefono2."',direccion = '".$direccion."',genero = '".$genero."',estatus = '".$estatus."',barrio = '".$barrio."',perfil_transmision = '".$perfil_transmision."',banco_cedula = '".$banco_cedula."',banco_nombre = '".$banco_nombre."',banco_tipo = '".$banco_tipo."',banco_numero = '".$banco_numero."',banco_banco = '".$banco_banco."',BCPP = '".$banco_cpp."',altura = '".$altura."',peso = '".$peso."',tpene = '".$tpene."',tsosten = '".$tsosten."',tbusto = '".$tbusto."',tcintura = '".$tcintura."',tcaderas = '".$tcaderas."',tipo_cuerpo = '".$tipo_cuerpo."',Pvello = '".$Pvello."',color_cabello = '".$color_cabello."',color_ojos = '".$color_ojos."',Ptattu = '".$Ptattu."',Ppiercing = '".$Ppiercing."',turno = '".$turno."',sede = '".$sede."',Htransmision = '".$htransmision."',select_equipo = '".$equipo."',equipo = '".$enlazar."',fecha_inicio = '".$fecha_inicio."' WHERE id =".$id;
	$modificar1 = mysqli_query( $conexion, $sql1 );

	if($enlazar2=='' && $crear_equipo=='Si'){
		if($equipo=='Individual'){
			$sql3 = "INSERT INTO equipos (cantidad,id_modelo1,sede,turno,estatus,fecha_inicio) VALUES ('1',$id,'$sede','$turno','$estatus','$fecha_inicio')";
		}

		if($equipo=='Pareja'){
			$sql3 = "INSERT INTO equipos (cantidad,id_modelo1,sede,turno,estatus,fecha_inicio) VALUES ('2',$id,'$sede','$turno','$estatus','$fecha_inicio')";
		}

		if($equipo=='Trio'){
			$sql3 = "INSERT INTO equipos (cantidad,id_modelo1,sede,turno,estatus,fecha_inicio) VALUES ('3',$id,'$sede','$turno','$estatus','$fecha_inicio')";
		}

		if($equipo=='Cuarteto'){
			$sql3 = "INSERT INTO equipos (cantidad,id_modelo1,sede,turno,estatus,fecha_inicio) VALUES ('4',$id,'$sede','$turno','$estatus','$fecha_inicio')";
		}

		if($equipo=='Quinteto'){
			$sql3 = "INSERT INTO equipos (cantidad,id_modelo1,sede,turno,estatus,fecha_inicio) VALUES ('5',$id,'$sede','$turno','$estatus','$fecha_inicio')";
		}

		$registro2 = mysqli_query( $conexion, $sql3 );
		
		$sql4 = "SELECT * FROM equipos order by id desc LIMIT 1";
		$consultar1 = mysqli_query( $conexion, $sql4 );
		while($row = mysqli_fetch_array($consultar1)) {
			$id2 = $row['id'];
		}

		$sql5 = "UPDATE modelos SET equipo = ".$id2." WHERE id = ".$id;
		$modificacion2 = mysqli_query( $conexion, $sql5 );
	}else if($enlazar2!=''){
		if($equipo=='Pareja'){
			$sql6 = "SELECT * FROM equipos WHERE id = ".$enlazar2;
			$consultar2 = mysqli_query( $conexion, $sql6 );
			while($row2 = mysqli_fetch_array($consultar2)) {
				$vacio_modelo2 = $row2['id_modelo2'];
				$vacio_modelo3 = $row2['id_modelo3'];
				$vacio_modelo4 = $row2['id_modelo4'];
				$vacio_modelo5 = $row2['id_modelo5'];
			}
			if($vacio_modelo2==0){
				$sql3 = "UPDATE equipos SET id_modelo2 = '".$id."' WHERE id = ".$enlazar2;
				$registro2 = mysqli_query( $conexion, $sql3 );
			}
		}

		if($equipo=='Trio'){
			$sql6 = "SELECT * FROM equipos WHERE id = ".$enlazar2;
			$consultar2 = mysqli_query( $conexion, $sql6 );
			while($row2 = mysqli_fetch_array($consultar2)) {
				$vacio_modelo2 = $row2['id_modelo2'];
				$vacio_modelo3 = $row2['id_modelo3'];
				$vacio_modelo4 = $row2['id_modelo4'];
				$vacio_modelo5 = $row2['id_modelo5'];
			}
			if($vacio_modelo2==0){
				$sql3 = "UPDATE equipos SET id_modelo2 = '".$id."' WHERE id = ".$enlazar2;
				$registro2 = mysqli_query( $conexion, $sql3 );
			}else if ($vacio_modelo3==0){
				$sql3 = "UPDATE equipos SET id_modelo3 = '".$id."' WHERE id = ".$enlazar2;
				$registro2 = mysqli_query( $conexion, $sql3 );
			}
		}

		if($equipo=='Cuarteto'){
			$sql6 = "SELECT * FROM equipos WHERE id = ".$enlazar2;
			$consultar2 = mysqli_query( $conexion, $sql6 );
			while($row2 = mysqli_fetch_array($consultar2)) {
				$vacio_modelo2 = $row2['id_modelo2'];
				$vacio_modelo3 = $row2['id_modelo3'];
				$vacio_modelo4 = $row2['id_modelo4'];
				$vacio_modelo5 = $row2['id_modelo5'];
			}
			if($vacio_modelo2==0){
				$sql3 = "UPDATE equipos SET id_modelo2 = '".$id."' WHERE id = ".$enlazar2;
				$registro2 = mysqli_query( $conexion, $sql3 );
			}else if ($vacio_modelo3==0){
				$sql3 = "UPDATE equipos SET id_modelo3 = '".$id."' WHERE id = ".$enlazar2;
				$registro2 = mysqli_query( $conexion, $sql3 );
			}else if ($vacio_modelo4==0){
				$sql3 = "UPDATE equipos SET id_modelo4 = '".$id."' WHERE id = ".$enlazar2;
				$registro2 = mysqli_query( $conexion, $sql3 );
			}
		}

		if($equipo=='Quinteto'){
			$sql6 = "SELECT * FROM equipos WHERE id = ".$enlazar2;
			$consultar2 = mysqli_query( $conexion, $sql6 );
			while($row2 = mysqli_fetch_array($consultar2)) {
				$vacio_modelo2 = $row2['id_modelo2'];
				$vacio_modelo3 = $row2['id_modelo3'];
				$vacio_modelo4 = $row2['id_modelo4'];
				$vacio_modelo5 = $row2['id_modelo5'];
			}
			if($vacio_modelo2==0){
				$sql3 = "UPDATE equipos SET id_modelo2 = '".$id."' WHERE id = ".$enlazar2;
				$registro2 = mysqli_query( $conexion, $sql3 );
			}else if ($vacio_modelo3==0){
				$sql3 = "UPDATE equipos SET id_modelo3 = '".$id."' WHERE id = ".$enlazar2;
				$registro2 = mysqli_query( $conexion, $sql3 );
			}else if ($vacio_modelo4==0){
				$sql3 = "UPDATE equipos SET id_modelo4 = '".$id."' WHERE id = ".$enlazar2;
				$registro2 = mysqli_query( $conexion, $sql3 );
			}else if ($vacio_modelo5==0){
				$sql3 = "UPDATE equipos SET id_modelo5 = '".$id."' WHERE id = ".$enlazar2;
				$registro2 = mysqli_query( $conexion, $sql3 );
			}
		}

		$sql5 = "UPDATE modelos SET equipo = ".$enlazar2." WHERE id = ".$id;
		$modificacion2 = mysqli_query( $conexion, $sql5 );

	}

	$datos = [
		"SQL1:"		=> $sql1,
	];

	echo json_encode($datos);
?>