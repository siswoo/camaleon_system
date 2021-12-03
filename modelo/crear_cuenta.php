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
	<link rel="stylesheet" href="../css/validaciones.css">
	<link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
	<link href="../resources/fontawesome/css/all.css" rel="stylesheet">
	<title>Camaleon Sistem</title>
</head>
<body>
<?php
	include('../script/conexion.php');
	$ubicacion = "modelo";
	$consulta1 = "SELECT * FROM roles WHERE id = ".$_SESSION['rol']." LIMIT 1";
	$resultado1 = mysqli_query( $conexion, $consulta1 );
	while($row1 = mysqli_fetch_array($resultado1)) {
		$usuario_rol = $row1['nombre'];
		$modelo_view = $row1['modelo_view'];
		$modelo_edit = $row1['modelo_edit'];
		$modelo_delete = $row1['modelo_delete'];
	}
	include('../navbar.php');
?>
	<form id="formulario1" method="POST">
		<input type="hidden" id="modelo_view" value="<?php echo $modelo_view; ?>">
		<input type="hidden" id="modelo_edit" value="<?php echo $modelo_edit; ?>">
		<input type="hidden" id="modelo_delete" value="<?php echo $modelo_delete; ?>">
	</form>

    <div class="seccion1">
	    <div class="row">
		    <div class="container">
			    <form action="#" method="POST" id="formulario2" style="">
			    	<!--
			    	<div class="row">
					    <div class="col-12" class="text-center">
					    	<p class="text-center titulo1" style="margin-right: 10px;">Por favor complete el formulario</p>
					    </div>
					</div>
					-->

				    <div class="row">
						<div class="col-6 form-group form-check">
							<label for="tipo_documento">Tipo de Documento <small style="color:red; font-weight: bold;">(*)</small></label>
							<select name="tipo_documento" class="form-control" required>
								<option value="">Seleccione</option>
								<option value="Cedula de Ciudadania">Cedula de Ciudadania</option>
								<option value="Cedula de Extranjeria">Cedula de Extranjeria</option>
								<option value="PEP">PEP</option>
							</select>
						</div>

						<div class="col-6 form-group form-check">
							<label for="numero_documento">Número de Documento <small style="color:red; font-weight: bold;">(*)</small></label>
							<input type="text" name="numero_documento" class="form-control" minlength="6" required>
						</div>
					</div>

				    <div class="row">
						<div class="col-6 form-group form-check">
							<label for="primer_nombre">Primer Nombre <small style="color:red; font-weight: bold;">(*)</small></label>
							<input type="text" name="primer_nombre" class="form-control" minlength="4" required>
						</div>

						<div class="col-6 form-group form-check">
							<label for="segundo_nombre">Segundo Nombre</label>
							<input type="text" name="segundo_nombre" minlength="4" class="form-control">
						</div>

						<div class="col-6 form-group form-check">
							<label for="primer_apellido">Primer Apellido <small style="color:red; font-weight: bold;">(*)</small></label>
							<input type="text" name="primer_apellido" minlength="4" class="form-control" required>
						</div>

						<div class="col-6 form-group form-check">
							<label for="segundo_apellido">Segundo Apellido</label>
							<input type="text" name="segundo_apellido" minlength="4" class="form-control">
						</div>
					</div>

				    <div class="row">
						<div class="col-6 form-group form-check">
							<label for="correo">Correo <small style="color:red; font-weight: bold;">(*)</small></label>
							<input type="email" name="correo" class="form-control" required>
						</div>

						<div class="col-6 form-group form-check">
							<label for="telefono1">Teléfono Principal <small style="color:red; font-weight: bold;">(*)</small></label>
							<input type="text" name="telefono1" class="form-control" required>
						</div>

						<div class="col-6 form-group form-check">
							<label for="telefono2">Teléfono Opcional</label>
							<input type="text" name="telefono2" class="form-control">
						</div>

						<div class="col-6 form-group form-check">
							<label for="direccion">Dirección</label>
							<input type="text" name="direccion" class="form-control">
						</div>
					</div>

					<div class="row">
						<div class="col-6 form-group form-check">
							<label for="turno">Turno <small style="color:red; font-weight: bold;">(*)</small></label>
							<select name="turno" class="form-control" required>
								<option value="">Seleccione</option>
								<option value="Mañana">Mañana</option>
								<option value="Tarde">Tarde</option>
								<option value="Noche">Noche</option>
								<option value="Satelite">Satelite</option>
							</select>
						</div>

						<div class="col-6 form-group form-check">
							<label for="sede">Sede <small style="color:red; font-weight: bold;">(*)</small></label>
							<select name="sede" class="form-control" required>
								<option value="">Seleccione</option>
								<option value="Norte">Norte</option>
								<option value="Occidente 1">Occidente 1</option>
								<option value="VIP Occidente">VIP Occidente</option>
								<option value="VIP Suba">VIP Suba</option>
							</select>
						</div>

						<div class="col-12 form-group form-check">
							<label for="equipo">Equipo <small style="color:red; font-weight: bold;">(*)</small></label>
							<select name="equipo" class="form-control" id="select_equipo" required>
								<option value="">Seleccione</option>
								<option value="Individual">Individual</option>
								<option value="Pareja">Pareja</option>
								<option value="Trio">Trio</option>
								<option value="Cuarteto">Cuarteto</option>
								<option value="Quinteto">Quinteto</option>
							</select>
						</div>

						<div class="col-12" id="divEquipos" style="display: none;">
							<hr>
								<div class="col-12 form-group form-check">
									<label for="enlazar">Enlazar al Equipo?</label>
									<select name="select_enlazar" class="form-control" id="select_enlazar">
									</select>
								</div>
							<hr>
						</div>

					</div>

					<div class="row">
						<div class="col-md-12 form-group form-check text-center">
							<button type="submit" id="submit" class="btn btn-success" style="width: 50%;">Ingresar</button>
						</div>
					</div>
			    </form>
		    </div>
	    </div>
    </div>
  </body>
</html>

<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="../js/navbar.js"></script>

<script>
$("#formulario2").on("submit", function(e){
	e.preventDefault();
	var f = $(this);

    $.ajax({
		type: 'POST',
		url: '../script/guardar_modelo1.php',
		data: $('#formulario2').serialize(),
		dataType: "JSON",
		success: function(respuesta) {
			console.log(respuesta);
			if(respuesta == 0){
				Swal.fire({
					position: 'center',
					icon: 'error',
					title: 'Error en registro...!',
					showConfirmButton: true,
					timer: 3000
				})
			}

			if(respuesta != 0){
				const swalWithBootstrapButtons = Swal.mixin({
					customClass: {
						confirmButton: 'btn btn-success mr-2',
					    cancelButton: 'btn btn-primary'
					},
					buttonsStyling: false
				})
				
				swalWithBootstrapButtons.fire({
					title: 'Se ha registrado exitosamente!',
					text: "Desea volver a la consulta o desea crear otro registro?",
					icon: 'success',
					position: 'center',
					showConfirmButton: true,
					showCancelButton: true,
					confirmButtonText: 'Otro Registro',
					cancelButtonText: 'Consulta',
				}).then((result) => {
					if (result.value) {
						window.location.href = "crear_cuenta.php";
					} else {
						window.location.href = "index.php";
					}
				})
			}
		},

		error: function(respuesta) {
			console.log(respuesta['responseText']);
		}
	});

});

$(document).ready(function(){
	/******VALIDACIONES EN TIEMPO REAL***********/
	$("#nombre").keyup(function(){
		var variable = $("#nombre").val();
    	var size = variable.length;
    	
    	if(size >= 4){
    		$('#nombre').removeClass('error1');
			$('#error_texto1').addClass('d-none');
    	}

    	if(size <= 3 && size != 0){
    		$('#nombre').removeClass('error1');
			$('#error_texto1').removeClass('d-none');
			$('#error_texto1').html('El campo debe contener al menos 4 caracteres.');
    	}

    	if(size == 0){
    		$('#nombre').addClass('error1');
			$('#error_texto1').removeClass('d-none');
			$('#error_texto1').html('Este campo no debe estar vacio.');
    	}
	});

	$("#clave").keyup(function(){
		var variable = $("#clave").val();
    	var size = variable.length;
    	
    	if(size >= 4){
    		$('#clave').removeClass('error1');
			$('#error_texto2').addClass('d-none');
    	}

    	if(size <= 3 && size != 0){
    		$('#clave').removeClass('error1');
			$('#error_texto2').removeClass('d-none');
			$('#error_texto2').html('El campo debe contener al menos 4 caracteres.');
    	}

    	if(size == 0){
    		$('#clave').addClass('error1');
			$('#error_texto2').removeClass('d-none');
			$('#error_texto2').html('Este campo no debe estar vacio.');
    	}
	});
	/******************************************************************************************/

	$('#select_equipo').change(function (){
		var div = $('#select_equipo');
		var variable = $('#select_equipo').val();
		if(variable != '' && variable != 'Individual'){
			//$('#divEquipos').removeClass('d-none');
			$('#divEquipos').show();
			$.ajax({
				type: 'POST',
				url: '../script/equipos_select1.php',
				data: {
					"equipo": variable
				},
				/*dataType: "JSON",*/
				success: function(respuesta) {
					console.log(respuesta);
					$('#select_enlazar').html(respuesta);

				},

				error: function(respuesta) {
					console.log('Error...'+respuesta);
				}
			});
		}
	});

});

</script>