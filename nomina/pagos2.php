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

	<div class="col-12 mt-3 text-center" style="font-size: 28px; font-weight: bold;">CRUD DE PAGOS NOMINA</div>

	<div class="row mt-3">
		<div class="col-12 row">
        	<div class="col-12 mb-3 text-center text-uppercase font-weight-bold h5">Nuevo</div>
        	<div class="col-4 text-center form-group form-check">
        		<label style="color:black; font-weight: bold;">Nombre</label>
	            <input type="text" id="nuevo_nombre" name="nuevo_nombre" class="form-control" autocomplete="off">
        	</div>
        	<div class="col-4 text-center form-group form-check">
        		<label style="color:black; font-weight: bold;">Desde</label>
	            <input type="date" id="nuevo_desde" name="nuevo_desde" class="form-control" autocomplete="off">
        	</div>
        	<div class="col-4 text-center form-group form-check">
        		<label style="color:black; font-weight: bold;">Hasta</label>
	            <input type="date" id="nuevo_hasta" name="nuevo_hasta" class="form-control" autocomplete="off">
        	</div>
        	<div class="col-12 text-center form-group form-check">
        		<button type="button" class="btn btn-success" id="nuevo_guardar" onclick="guardar1();">Guardar</button>
        	</div>
        </div>
        <div class="col-12 row" style="margin-top: 3rem;">
        	<div class="col-12 text-center text-uppercase font-weight-bold h5">Restaurar</div>
        	<div class="col-12 text-center form-group form-check">
        		<label style="color:black; font-weight: bold;">Listado</label>
	            <select class="form-control" id="listado1" name="listado1">
	            	<option value="">Seleccione</option>
	            	<?php
	            	$sql2 = "SELECT * FROM nomina_pagos GROUP BY fecha_desde";
	            	$proceso2 = mysqli_query($conexion,$sql2);
	            	while($row2=mysqli_fetch_array($proceso2)){
	            		$pagos_id = $row2["id"];
	            		$pagos_desde = $row2["fecha_desde"];
	            		$pagos_hasta = $row2["fecha_hasta"];
	            		echo '<option value="'.$pagos_id.'">'.$pagos_desde.' | '.$pagos_hasta.'</option>';
	            	}
	            	?>
	            </select>
        	</div>
        	<div class="col-12 text-center form-group form-check">
        		<button type="button" class="btn btn-info" id="nuevo_guardar" onclick="restaurar1();">Restaurar</button>
        </div>
        	</div>
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
	$(document).ready(function() {
        //
    } );

	function auto_guardado(id_nomina,concepto,texto,valor){
		if(concepto==1){
			concepto = "prestamos";
		}else if(concepto==2){
			concepto = "bono";
		}else if(concepto==3){
			concepto = "devolucion";
		}else if(concepto==4){
			concepto = "ajustenomina";
		}else if(concepto==5){
			concepto = "otrosconceptos";
		}else if(concepto==6){
			concepto = "descuentos";
		}

		$.ajax({
			type: 'POST',
			url: '../script/crud_nomina_pagos.php',
			dataType: "JSON",
			data: {
				"id_nomina": id_nomina,
				"concepto": concepto,
				"texto": texto,
				"valor": valor,
				"condicion": "auto_guardado1",
			},

			success: function(respuesta) {
				console.log(respuesta);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function guardar1(){
		var nombre = $('#nuevo_nombre').val();
		var desde = $('#nuevo_desde').val();
		var hasta = $('#nuevo_hasta').val();
		
		if(nombre=='' || desde=='' || hasta==''){
			Swal.fire({
		 		title: 'Error',
		 		text: "Debe llenar todos los campos",
		 		icon: 'error',
		 		position: 'center',
			});
			return false;
		}

		$.ajax({
			type: 'POST',
			url: '../script/crud_nomina_pagos.php',
			dataType: "JSON",
			data: {
				"nombre": nombre,
				"desde": desde,
				"hasta": hasta,
				"condicion": "guardar1",
			},

			success: function(respuesta) {
				console.log(respuesta);
				Swal.fire({
		 			title: 'Listo',
		 			text: "Se ha guardado exitosamente",
		 			icon: 'success',
		 			position: 'center',
				});
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	$("#modal_nolaborados1_form").on("submit", function(e){
		e.preventDefault();
		var f = $(this);
		var texto 	= $('#modal_nolaborados1_texto').val();
		var fecha  		= $('#modal_nolaborados1_fecha').val();
		var nomina_id   =$('#nomina_id').val();

		if(texto=='' || fecha==''){
			Swal.fire({
	 			title: 'Error!',
	 			text: "No dejar campos vacios",
	 			icon: 'error',
	 			position: 'center',
			});
		}

	    $.ajax({
			type: 'POST',
			url: '../script/crud_nomina_pagos.php',
			dataType: "JSON",
			data: {
				"texto": texto,
				"fecha": fecha,
				"nomina_id": nomina_id,
				"condicion": "nolaborados2",
			},

			success: function(respuesta) {
				console.log(respuesta);
				filtrar1();
				if(respuesta["estatus"]=="ok"){
					Swal.fire({
		 				title: 'Guardado',
		 				text: respuesta["msg"],
		 				icon: 'success',
		 				position: 'center',
					});
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	});
 
</script>