<?php
	session_start();
	if(!isset($_SESSION['nombre'])){
		header("Location: index.php");
		exit;
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/modelo.css">
	<link href="../resources/fontawesome/css/all.css" rel="stylesheet">
	<title>Camaleon Sistem</title>
</head>

<style type="text/css">
	#submit{
  		background-color: #A67D4C!important; 
  		border-color: #A67D4C;
  	}

  	#submit:hover{
  		background-color: #735735 !important;
  		border-color: #735735 !important;
  		color: white !important;
  	}

  	.page-link{
  		background-color: #A67D4C!important; 
  		border-color: #A67D4C;
  		color: white !important;
  		border-color: white !important;
  	}

  	.seccion1{
  		margin-left: 2rem;
  		margin-right: 2rem;
  	}

  	.navbar-active{
  		border-bottom: 2px solid #A9814F;
  	}

  	body{
  		font-family: Helvetica Neue,Helvetica,Arial,sans-serif;
  	}
</style>

<body>

<?php
	include('../script/conexion.php');
	$ubicacion_url = $_SERVER["PHP_SELF"];
	$ubicacion = "nomina";
	$consulta1 = "SELECT * FROM roles WHERE id = ".$_SESSION['rol']." LIMIT 1";
	$resultado1 = mysqli_query( $conexion, $consulta1 );
	while($row1 = mysqli_fetch_array($resultado1)) {
		$usuario_rol = $row1['nombre'];
		$pasante_view = $row1['pasante_view'];
		$pasante_edit = $row1['pasante_edit'];
		$pasante_delete = $row1['pasante_delete'];

		/**************VALIDAR****************/
		$roles_view = $row1['roles_view'];
		$seguridad_view = $row1['seguridad_view'];
		$modelo_view = $row1['modelo_view'];
		/*************************************/
	}
	include('../navbar.php');
?>

	<div class="col-12 mt-3 mb-3 text-center" style="font-size: 28px; font-weight: bold;">MODULO DE PAGOS NOMINA</div>

	<div class="container">
		<form id="formulario1" enctype="multipart/form-data" method="POST">
			<div class="row ml-3 mr-3">
		        <div class="col-4 form-group form-check">
		            <label for="file" style="color:black; font-weight: bold;">Archivo Excel a Subir</label>
		            <input type="file" name="file" id="file" class="form-control">
		        </div>
		        <div class="col-4 form-group form-check">
		            <label for="fecha_desde" style="color:black; font-weight: bold;">Fecha Desde</label>
		            <input type="date" name="fecha_desde" id="fecha_desde" class="form-control">
		        </div>
		        <div class="col-4 form-group form-check">
		            <label for="fecha_hasta" style="color:black; font-weight: bold;">Fecha Hasta</label>
		            <input type="date" name="fecha_hasta" id="fecha_hasta" class="form-control">
		        </div>
		        <div class="col-12 text-center">
		            <button type="submit" class="btn btn-success" id="submit">SUBIR ARCHIVO</button>
		        </div>
		    </div>
		</form>
	</div>

</body>
</html>

<script src="../js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../js/popper.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="../js/navbar.js"></script>

<?php include('../footer.php'); ?>

<script type="text/javascript">

$("#formulario1").on("submit", function(e){
	e.preventDefault();
	var fd = new FormData();
	var files = $('#file')[0].files[0];
	var input_file = $('#file').val();
	var fecha_desde = $('#fecha_desde').val();
	var fecha_hasta = $('#fecha_hasta').val();
	var condicion = "importar1";
	fd.append('file',files);
	fd.append('fecha_desde',fecha_desde);
	fd.append('fecha_hasta',fecha_hasta);
	fd.append('condicion',condicion);

	if(input_file=='' || fecha_desde=='' || fecha_hasta==''){
		Swal.fire({
			title: 'Error',
			text: "Valide todos los campos",
			icon: 'error',
			position: 'center',
			timer: 3000
		});
		return false;
	}

	$.ajax({
		url: '../script/crud_nomina_pagos.php',
		type: 'POST',
		data: fd,
		dataType: "JSON",
		contentType: false,
		processData: false,

		beforeSend: function (){
			$('#submit').attr('disabled','true');
		},

		success: function(respuesta){
			console.log(respuesta);
			if(respuesta["estatus"]=='ok'){
            	Swal.fire({
		 			title: 'Listo',
			 		text: respuesta["msg"],
			 		icon: 'success',
			 		position: 'center',
					timer: 3000
				});
            }else if(respuesta["estatus"]=="error"){
            	Swal.fire({
		 				title: 'Error',
			 			text: respuesta["msg"],
			 			icon: 'error',
			 			position: 'center',
			 			timer: 3000
					});
            		return false;
            }
			$('#submit').attr('disabled','false');
		},
	});
});
 
</script>