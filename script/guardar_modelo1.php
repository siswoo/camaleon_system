<?php
	$tipo_documento = $_POST['tipo_documento'];
	$numero_documento = $_POST['numero_documento'];
	$primer_nombre = $_POST['primer_nombre'];
	$segundo_nombre = $_POST['segundo_nombre'];
	$primer_apellido = $_POST['primer_apellido'];
	$segundo_apellido = $_POST['segundo_apellido'];
	$correo = $_POST['correo'];
	$telefono1 = $_POST['telefono1'];
	$telefono2 = $_POST['telefono2'];
	$direccion = $_POST['direccion'];
	$turno = $_POST['turno'];
	$sede = $_POST['sede'];
	$estatus = 'Activa';
	$fecha_inicio = date('Y-m-d');
	$equipo = $_POST['equipo'];
	$enlazar = $_POST['select_enlazar'];

	include('conexion.php');

	$sql1 = "INSERT INTO modelos (nombre1,nombre2,apellido1,apellido2,documento_tipo,documento_numero,correo,direccion,usuario,clave,telefono1,telefono2,turno,estatus,sede,fecha_inicio) VALUES ('$primer_nombre','$segundo_nombre','$primer_apellido','$segundo_apellido','$tipo_documento','$numero_documento','$correo','$direccion','','','$telefono1','$telefono2','$turno','$estatus','$sede','$fecha_inicio');";
	$registro1 = mysqli_query( $conexion, $sql1 );

	$id = mysqli_insert_id($conexion);
	$usuario = $primer_nombre.$id;
	$clave_generica = rand(999, 9999);
	$clave = md5($clave_generica);

	$sql2 = "UPDATE modelos SET usuario = '$usuario', clave = '$clave' WHERE id = $id";
	$modificacion1 = mysqli_query( $conexion, $sql2 );

	if($enlazar==''){
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
	}else{
		if($equipo=='Pareja'){
			$sql6 = "SELECT * FROM equipos WHERE id = ".$enlazar;
			$consultar2 = mysqli_query( $conexion, $sql6 );
			while($row2 = mysqli_fetch_array($consultar2)) {
				$vacio_modelo2 = $row2['id_modelo2'];
				$vacio_modelo3 = $row2['id_modelo3'];
				$vacio_modelo4 = $row2['id_modelo4'];
				$vacio_modelo5 = $row2['id_modelo5'];
			}
			if($vacio_modelo2==0){
				$sql3 = "UPDATE equipos SET id_modelo2 = '".$id."' WHERE id = ".$enlazar;
			}
		}

		if($equipo=='Trio'){
			$sql6 = "SELECT * FROM equipos WHERE id = ".$enlazar;
			$consultar2 = mysqli_query( $conexion, $sql6 );
			while($row2 = mysqli_fetch_array($consultar2)) {
				$vacio_modelo2 = $row2['id_modelo2'];
				$vacio_modelo3 = $row2['id_modelo3'];
				$vacio_modelo4 = $row2['id_modelo4'];
				$vacio_modelo5 = $row2['id_modelo5'];
			}
			if($vacio_modelo2==0){
				$sql3 = "UPDATE equipos SET id_modelo2 = '".$id."' WHERE id = ".$enlazar;
			}else if ($vacio_modelo3==0){
				$sql3 = "UPDATE equipos SET id_modelo3 = '".$id."' WHERE id = ".$enlazar;
			}
		}

		if($equipo=='Cuarteto'){
			$sql6 = "SELECT * FROM equipos WHERE id = ".$enlazar;
			$consultar2 = mysqli_query( $conexion, $sql6 );
			while($row2 = mysqli_fetch_array($consultar2)) {
				$vacio_modelo2 = $row2['id_modelo2'];
				$vacio_modelo3 = $row2['id_modelo3'];
				$vacio_modelo4 = $row2['id_modelo4'];
				$vacio_modelo5 = $row2['id_modelo5'];
			}
			if($vacio_modelo2==0){
				$sql3 = "UPDATE equipos SET id_modelo2 = '".$id."' WHERE id = ".$enlazar;
			}else if ($vacio_modelo3==0){
				$sql3 = "UPDATE equipos SET id_modelo3 = '".$id."' WHERE id = ".$enlazar;
			}else if ($vacio_modelo4==0){
				$sql3 = "UPDATE equipos SET id_modelo4 = '".$id."' WHERE id = ".$enlazar;
			}
		}

		if($equipo=='Quinteto'){
			$sql6 = "SELECT * FROM equipos WHERE id = ".$enlazar;
			$consultar2 = mysqli_query( $conexion, $sql6 );
			while($row2 = mysqli_fetch_array($consultar2)) {
				$vacio_modelo2 = $row2['id_modelo2'];
				$vacio_modelo3 = $row2['id_modelo3'];
				$vacio_modelo4 = $row2['id_modelo4'];
				$vacio_modelo5 = $row2['id_modelo5'];
			}
			if($vacio_modelo2==0){
				$sql3 = "UPDATE equipos SET id_modelo2 = '".$id."' WHERE id = ".$enlazar;
			}else if ($vacio_modelo3==0){
				$sql3 = "UPDATE equipos SET id_modelo3 = '".$id."' WHERE id = ".$enlazar;
			}else if ($vacio_modelo4==0){
				$sql3 = "UPDATE equipos SET id_modelo4 = '".$id."' WHERE id = ".$enlazar;
			}else if ($vacio_modelo5==0){
				$sql3 = "UPDATE equipos SET id_modelo5 = '".$id."' WHERE id = ".$enlazar;
			}
		}

		$registro2 = mysqli_query( $conexion, $sql3 );

	}

	$sql5 = "UPDATE modelos SET equipo = ".$enlazar." WHERE id = ".$id;
	$modificacion2 = mysqli_query( $conexion, $sql5 );

	$datos = [
		"tipo_documento" 	=> $tipo_documento,
		"numero_documento" 	=> $numero_documento,
		"primer_nombre" 	=> $primer_nombre,
		"segundo_nombre" 	=> $segundo_nombre,
		"primer_apellido" 	=> $primer_apellido,
		"segundo_apellido" 	=> $segundo_apellido,
		"correo" 			=> $correo,
		"telefono1" 		=> $telefono1,
		"telefono2" 		=> $telefono2,
		"direccion" 		=> $direccion,
		"turno" 			=> $turno,
		"sede" 				=> $sede,
		"estatus" 			=> $estatus,
		"fecha_inicio" 		=> $fecha_inicio,
		"SQL-------->"		=> $sql3,
	];
	
	/*
	$to = $correo;
	$subject = "Asunto de Prueba";
	$message = "
	<html>
		<head>
			<title>".$subject."</title>
		</head>
		<body>
			<h2>Felicitaciones has ingresado al sistema de Camaleon Group SAS</h2>
			<p>El siguiente paso es completar tu formulario de contacto, puedes ingresar al sistema con los siguientes datos</p>
			<p>Usuario: ".$usuario."</p>
			<p>Clave: ".$clave_generica."</p>
			<p>Con los pasados datos lograrás acceder a el sistema a travéz del siguiente link... </p>
			<p>https://www.camaleonmg.com/</p>
		</body>
	</html>";
	 
	@mail($to, $subject, $message);
	*/

	echo json_encode($datos);
?>