<?php
	session_start();
	if(!isset($_SESSION['nombre']) or $_SESSION["rol"]!=4){
		header("Location: ../index.php");
		exit;
	}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/pasante_crear_cuenta.css">
    <link rel="stylesheet" href="../css/validaciones.css">
    <link rel="stylesheet" href="../css/index.css">
    <title>Camaleon Sistem</title>
  </head>
  <body>

  	<style type="text/css">
  		#submit:active{
  			background-color: #a67d4c;
  			border-color: #a67d4c;
  		}
  	</style>

	<!--
	<div class="progress">
	  <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
	</div>
	-->

    <div class="seccion1">
	    <div class="row">
		    <div class="container">
			    <form action="#" method="POST" id="formulario1" style="">
			    	<div class="row">

				    	<div class="col-md-12 form-group form-check text-right mt-2" style="text-align: center;">
							<a href="../index.php">
								<input type="button" class="btn btn-primary" value="Cerrar" style="background-color: black !important; border-color: black;">
							</a>
						</div>


						<div class="col-12" class="text-center" style="text-align: center;">
							<img src="../img/Dorado Completo.png" width="180" class="drop" >
						</div>

						<div class="col-2"></div>
					    <div class="col-8 mt-2 mb-2" class="text-center">
					    	<p class="text-center titulo1">Por favor complete el formulario</p>
					    </div>
					    <div class="col-2"></div>
					</div>

				    <div class="row">
					    <div class="col-6 form-group form-check">
						    <label for="tipo_documento">Tipo de Documento <small style="color:#F2B76F; font-size: 17px;">*</small></label>
						    <select name="tipo_documento" class="form-control" required>
						    	<option value="">Seleccione</option>
						    	<option value="Cedula de Ciudadania">Cedula de Ciudadania</option>
						    	<option value="Cedula Extranjera">Cedula Extranjera</option>
						    	<option value="PEP">PEP</option>
						    	<option value="Pasaporte">Pasaporte</option>
						    </select>
					    </div>
					    <div class="col-6 form-group form-check">
						    <label for="numero_documento">Número de Documento <small style="color:#F2B76F; font-size: 17px;">*</small></label>
						    <input type="text" name="numero_documento" class="form-control" minlength="6" autocomplete="off" required>
					    </div>
				    </div>

				    <div class="row">
					    <div class="col-6 form-group form-check">
						    <label for="primer_nombre">Primer Nombre <small style="color:#F2B76F; font-size: 17px;">*</small></label>
						    <input type="text" name="primer_nombre" class="form-control" autocomplete="off" required>
					    </div>
					    
					    <div class="col-6 form-group form-check">
						    <label for="segundo_nombre">Segundo Nombre</label>
						    <input type="text" name="segundo_nombre" class="form-control" autocomplete="off">
					    </div>

					    <div class="col-6 form-group form-check">
						    <label for="primer_apellido">Primer Apellido <small style="color:#F2B76F; font-size: 17px;">*</small></label>
						    <input type="text" name="primer_apellido" class="form-control" autocomplete="off" required>
					    </div>

					    <div class="col-6 form-group form-check">
						    <label for="segundo_apellido">Segundo Apellido <small style="color:#F2B76F; font-size: 17px;">*</small></label>
						    <input type="text" name="segundo_apellido" class="form-control" autocomplete="off" required>
					    </div>
				    </div>

				    <div class="row">
					    <div class="col-6 form-group form-check">
						    <label for="correo">Correo <small style="color:#F2B76F; font-size: 17px;">*</small></label>
						    <input type="email" name="correo" id="correo" class="form-control" autocomplete="off" required>
					    </div>

					    <div class="col-6 form-group form-check">
						    <label for="correo2">Repetir Correo <small style="color:#F2B76F; font-size: 17px;">*</small></label>
						    <input type="email" name="correo2" id="correo2" class="form-control" autocomplete="off" required>
					    </div>

					    <div class="col-6 form-group form-check">
						    <label for="telefono1">Número de WhatsApp <small style="color:#F2B76F; font-size: 17px;">*</small></label>
						    <input type="text" name="telefono1" class="form-control" autocomplete="off" required>
					    </div>

					    <div class="col-6 form-group form-check">
						    <label for="barrio">Barrio <small style="color:#F2B76F; font-size: 17px;">*</small></label>
						    <input type="text" name="barrio" class="form-control" autocomplete="off" required>
					    </div>

					    <!--
					    <div class="col-6 form-group form-check">
						    <label for="telefono2">Teléfono Opcional</label>
						    <input type="text" name="telefono2" class="form-control">
					    </div>
					    -->
					    <div class="col-6 form-group form-check">
						    <label for="direccion">Dirección</label>
						    <textarea name="direccion" id="direccion" class="form-control" autocomplete="off" required></textarea>
						    <!--<input type="text" name="direccion" class="form-control" required>-->
					    </div>

					    <div class="col-6 form-group form-check">
						    <label for="genero">Género <small style="color:#F2B76F; font-size: 17px;">*</small></label>
						    <select class="form-control" id="genero" name="genero" required>
								<option value="">Seleccione</option>
								<option value="Hombre">Hombre</option>
								<option value="Mujer">Mujer</option>
								<option value="Transexual">Transexual</option>
							</select>
					    </div>
				    </div>
				    <!--
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
				    </div>
					-->

					<input type="hidden" name="sede" value="<?php echo $_SESSION['sede']; ?>">

					<div class="row">
						<div class="col-md-12 mt-4 form-group form-check text-center">
							<button type="submit" id="submit" class="btn btn-success botones1">Ingresar</button>
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

<script>
$("#formulario1").on("submit", function(e){
	e.preventDefault();
	var f = $(this);
	var tipo_documento 		= $('#tipo_documento').val();
	var numero_documento 	= $('#numero_documento').val();
	var primer_nombre 		= $('#primer_nombre').val();
	var segundo_nombre 		= $('#segundo_nombre').val();
	var primer_apellido 	= $('#primer_apellido').val();
	var segundo_apellido 	= $('#segundo_apellido').val();
	var genero 				= $('#genero').val();
	var correo 				= $('#correo').val();
	var correo2 			= $('#correo2').val();
	var telefono1 			= $('#telefono1').val();
	var direccion 			= $('#direccion').val();
	var barrio 				= $('#barrio').val();
	//console.log(correo+" - "+correo2);
	if(correo!=correo2){
		Swal.fire({
			position: 'center',
			icon: 'error',
			title: 'Correos No son Iguales, por favor validar!',
			showConfirmButton: true,
			timer: 3000
		})
		return false;
	}

    $.ajax({
		type: 'POST',
		url: '../script/guardar_pasante1.php',
		data: $('#formulario1').serialize(),
		dataType: "JSON",

		beforeSend: function() {
        	$('#submit').prop("disabled", true);
    	},

		success: function(respuesta) {
			//console.log(respuesta);
			if(respuesta == 0){
				Swal.fire({
					position: 'center',
					icon: 'error',
					title: 'Error! Comunicarse con el Administrador!',
					showConfirmButton: true,
					timer: 3000
				})
			}

			if(respuesta['contador']==1){
				Swal.fire({
					position: 'center',
					icon: 'error',
					title: 'Ya te has registrado anteriormente en nuestra base de datos!',
					showConfirmButton: false,
					timer: 5000
				})
				setTimeout(function() {
			    	window.location.href = "crear_cuenta.php";
			    },5000);
			    return false;
			}

			if(respuesta != 0){
				Swal.fire({
 					title: 'Registro Correcto!',
 					text: "Muchas gracias por su participación.",
 					icon: 'success',
 					position: 'center',
 					showConfirmButton: false,
 					confirmButtonColor: '#3085d6',
 					confirmButtonText: 'No esperar!',
 					timer: 5000
				}).then((result) => {
 					if (result.value) {
   						window.location.href = "crear_cuenta.php";
 					}
				})
				setTimeout(function() {
			    	window.location.href = "crear_cuenta.php";
			    },5100);
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
});

</script>