<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/modelo.css">
	<link rel="stylesheet" href="css/validaciones.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
	<link href="resources/fontawesome/css/all.css" rel="stylesheet">
</head>

<?php
include('script/conexion.php');
?>

<body>
	<div class="container" style="margin-top:3rem;">
		<div class="row">
			<div class="col-6">
				<label for="modelo">Modelo</label>
				<input type="text" class="form-control" name="modelo" id="modelo" value="" autocomplete="off">	
			</div>
			<div class="col-3">
				<label for="documento">Documento</label>
				<select class="form-control" id="documento" name="documento">
					<option value="">Seleccione</option>
					<?php
					$sql1 = "SELECT * FROM documentos";
					$proceso1 = mysqli_query($conexion,$sql1);
					while($row1=mysqli_fetch_array($proceso1)){
						$documentos_id = $row1["id"];
						$documentos_nombre = $row1["nombre"];
						echo '<option value="'.$documentos_id.'">'.$documentos_nombre.'</option>';
					}
					?>
				</select>
			</div>
			<div class="col-3">
				<label for="sede">Sedes</label>
				<select class="form-control" id="sede" name="sede">
					<option value="">Seleccione</option>
					<?php
					$sql2 = "SELECT * FROM sedes";
					$proceso2 = mysqli_query($conexion,$sql2);
					while($row2=mysqli_fetch_array($proceso2)){
						$sedes_id = $row2["id"];
						$sedes_nombre = $row2["nombre"];
						echo '<option value="'.$sedes_id.'">'.$sedes_nombre.'</option>';
					}
					?>
				</select>
			</div>
			<div class="col-12 mt-3 text-center">
				<button type="button" class="btn btn-danger" onclick="clave1();">Claves</button>
				<button type="button" class="btn btn-primary" onclick="cambiar2();">Sedes</button>
				<button type="button" class="btn btn-info" onclick="cambiar1();">Cambiar</button>
			</div>
			<div class="col-6" style="margin-top: 3rem;">
				<textarea id="respuesta1" class="form-control" autocomplete="off"></textarea>
			</div>
			<div class="col-2" style="margin-top: 3rem;">
				<button type="button" class="btn btn-info" onclick="copiar1();">Copiar</button>
			</div>
			<div class="col-4" style="margin-top: 3rem;">
				<input type="text" class="form-control" name="documento_nuevo" id="documento_nuevo" value="" autocomplete="off">	
			</div>
		</div>
	</div>
</body>

</html>

<script src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/popper.js"></script>
<script src="js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="js/navbar.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
        //
    } );

	function cambiar1(){
		var modelo = $('#modelo').val();
		var documento = $('#documento').val();
		
		if(modelo=='' || documento==''){
			$('#respuesta1').html("Coloque todos los campos")
			return false;
		}

		$.ajax({
			type: 'POST',
			url: 'script/ladillas1.php',
			dataType: "JSON",
			data: {
				"modelo": modelo,
				"documento": documento,
				"condicion": "cambiar1",
			},

			success: function(respuesta) {
				console.log(respuesta);
				if(respuesta["estatus"]=="error"){
					$('#respuesta1').html(respuesta["msg"]);
				}else{
					Swal.fire({
			 			title: 'Listo',
			 			text: "Se ha eliminado exitosamente",
			 			icon: 'success',
			 			position: 'center',
					});
					$('#modelo').val("");
					$('#documento').val("");
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function copiar1() {
		var content = document.getElementById('respuesta1');
		content.select();
		document.execCommand('copy');
	}

	function cambiar2(){
		var modelo = $('#modelo').val();
		var sede = $('#sede').val();
		
		if(modelo=='' || sede==''){
			$('#respuesta1').html("Coloque todos los campos")
			return false;
		}

		$.ajax({
			type: 'POST',
			url: 'script/ladillas1.php',
			dataType: "JSON",
			data: {
				"modelo": modelo,
				"sede": sede,
				"condicion": "cambiar2",
			},

			success: function(respuesta) {
				console.log(respuesta);
				if(respuesta["estatus"]=="error"){
					$('#respuesta1').html(respuesta["msg"]);
				}else{
					Swal.fire({
			 			title: 'Listo',
			 			text: "Se ha eliminado exitosamente",
			 			icon: 'success',
			 			position: 'center',
					});
					$('#modelo').val("");
					$('#sede').val("");
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function clave1(){
		var modelo = $('#modelo').val();
		
		if(modelo==''){
			$('#respuesta1').html("Coloque todos los campos")
			return false;
		}

		$.ajax({
			type: 'POST',
			url: 'script/ladillas1.php',
			dataType: "JSON",
			data: {
				"modelo": modelo,
				"condicion": "clave1",
			},

			success: function(respuesta) {
				console.log(respuesta);
				if(respuesta["estatus"]=="error"){
					$('#respuesta1').html(respuesta["msg"]);
				}else{
					$('#respuesta1').val(respuesta["html"]);
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function documento_nuevo(){
		var modelo = $('#modelo').val();
		
		if(modelo==''){
			$('#respuesta1').html("Coloque todos los campos")
			return false;
		}

		$.ajax({
			type: 'POST',
			url: 'script/ladillas1.php',
			dataType: "JSON",
			data: {
				"modelo": modelo,
				"condicion": "documento_nuevo1",
			},

			success: function(respuesta) {
				console.log(respuesta);
				$('#respuesta1').html(respuesta["msg"]);
				$('#modelo').val("");
				$('#documento_nuevo').val("");
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}
</script>