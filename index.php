<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/validaciones.css">
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

  	body{
  		background-image: url("img/FONDO APP.png");
  	}

  	.btn-info{
  		background-color: #A9814F !important;
  		border-color: #A9814F !important;
  	}

  	.btn-primary{
  		background-color: #A9814F !important;
  		border-color: #A9814F !important;
  	}
  </style>
<body>
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  	
  	<?php
		if(@$_SESSION['nombre']!=null and @$_SESSION['rol']!=4 and @$_SESSION['rol']!=5){
			?>
			<script src="js/jquery-3.5.1.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
			<script type="text/javascript">
				$(document).ready(function() {
					const swalWithBootstrapButtons = Swal.mixin({
					  customClass: {
					    confirmButton: 'btn btn-success mr-2',
					    cancelButton: 'btn btn-danger'
					  },
					  buttonsStyling: false
					})
					swalWithBootstrapButtons.fire({
 					title: 'Has vuelto al inicio',
 					text: "Aún esta logueado, desea cerrar sesión?",
 					icon: 'info',
 					position: 'center',
 					showConfirmButton: true,
 					showCancelButton: true,
 					confirmButtonText: 'Seguir en sesión',
 					cancelButtonText: 'Cerrar sesión',
					}).then((result) => {
						if (result.value) {
						    window.location.href = "welcome.php";
						} else {
							window.location.href = "script/cerrar_sesion.php";
						}
					})
				});
			</script>
		<?php exit; }else if(@$_SESSION['rol']==4){ ?>
			<script src="js/jquery-3.5.1.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
			<script type="text/javascript">
				Swal.fire({
					title: 'Código de Salida',
				  	input: 'text',
				  	inputAttributes: {
				    	autocapitalize: 'off'
				  	},
				  	showCancelButton: true,
				  	confirmButtonText: 'Intentar',
				  	showLoaderOnConfirm: true,
				}).then((result) => {

					if(result.value!=""){
						if(result.value=='123'){
							window.location.href = "script/cerrar_sesion.php";
						}else{
							Swal.fire({
						      title: 'Código Incorrecto!',
						      icon: 'error',
						      time: 3000,
						      showConfirmButton: false,
						    })
						    setTimeout(function() {
						    	window.location.href = "pasante/crear_cuenta.php";
						    },3000);
						}
					}
				})
			</script>
		<?php exit; }else if(@$_SESSION['rol']==5){ ?>
			<script type="text/javascript">
				const swalWithBootstrapButtons = Swal.mixin({
					customClass: {
						confirmButton: 'btn btn-success mr-2',
					    cancelButton: 'btn btn-danger'
					},
					buttonsStyling: false
				})
				swalWithBootstrapButtons.fire({
					title: 'Has vuelto al inicio',
					text: "Aún esta logueado, desea cerrar sesión?",
					icon: 'info',
					position: 'center',
					showConfirmButton: true,
					showCancelButton: true,
					confirmButtonText: 'Seguir en sesión',
					cancelButtonText: 'Cerrar sesión',
				}).then((result) => {
					if (result.value) {
						window.location.href = "modelo/perfil.php";
					} else {
						window.location.href = "script/cerrar_sesion.php";
					}
				})
			</script>
		<?php }
	?>
	<!--
	<div class="progress">
	  <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
	</div>
	-->

	<div class="col-12 text-center" style="margin-top: 4rem;">
		<img src="img/logo_index1.png" style="width: 200px;">
	</div>

    <div class="seccion1" style="margin-top: 3rem;">
	    <div class="row">
		    <div class="container">
			    <form action="#" method="POST" id="formulario1" style="margin-left: 30%; margin-right: 30%;">
				    <div class="col-12" class="text-center">
				    	<p class="text-center titulo1">Datos de Ingreso</p>
				    </div>
				    <div class="form-group form-check">
					    <label for="usuario">Usuario o Correo</label>
					    <input type="text" class="form-control" name="usuario" id="usuario" placeholder="" value="">
					    <div class="ml-1 mt-1 error_texto1 d-none" id="error_texto1">Este campo no debe estar vacio.</div>
				    </div>

				    <div class="form-group form-check">
					    <label for="clave">Clave</label>
					    <input type="password" class="form-control" name="clave" id="clave" placeholder="" value="">
					    <div class="ml-1 mt-1 error_texto2 d-none" id="error_texto2"></div>
					    <small id="emailHelp" class="form-text text-muted">Los datos de ingreso son totalmente confidenciales.</small>
				    </div>
					<div class="row">
						<div class="col-md-6 form-group form-check text-center">
							<button type="submit" id="submit" class="btn btn-success">Ingresar</button>
						</div>
						<!--
						<div class="col-6" class="text-center" style="text-align: center;">
							<a href="pasante/crear_cuenta.php">
								<input type="button" class="btn btn-info" value="Crear Cuenta">
							</a>
						</div>
						-->
						<div class="col-md-6 form-group form-check text-center" style="text-align: center;">
						<p class="">
							<a href="" style="color:white; text-decoration: none; margin-top: 5px;">Has olvidado la contraseña?</a>
						</p>
					</div>
					</div>
			    </form>
			    <!--
			    <div class="row">
			    	<div class="col-md-6 form-group form-check text-center" style="text-align: center;">
						<p class="olvido1">
							<a href="">Has olvidado la contraseña?</a>
						</p>
					</div>
				</div>
				-->

		    </div>
	    </div>
    </div>

<!--<div id="respuesta">&nbsp;</div>-->
<form action="welcome.php" id="formulario2" method="POST">
	<input type="hidden" value="" id="usuario_nombre" name="usuario_nombre">
	<input type="hidden" value="" id="usuario_apellido" name="usuario_apellido">
	<input type="hidden" value="" id="usuario_correo" name="usuario_correo">
	<input type="hidden" value="" id="usuario_rol" name="usuario_rol">
	<input type="hidden" value="" id="usuario_telefono1" name="usuario_telefono1">
	<input type="hidden" value="" id="usuario_usuario" name="usuario_usuario">
</form>

  </body>
</html>

<script>
$("#formulario1").on("submit", function(e){
	e.preventDefault();
	var f = $(this);
	var usuario = $('#usuario').val();
	var clave = $('#clave').val();

	/*******VALIDACIONES********/
	if(usuario==''){
		$('#usuario').addClass('error1');
		$('#error_texto1').removeClass('d-none');
		$('#error_texto1').html('Este campo no debe estar vacio.');
		return false;
	}

	if(clave==''){
		$('#clave').addClass('error1');
		$('#error_texto2').removeClass('d-none');
		$('#error_texto2').html('Este campo no debe estar vacio.');
		return false;
	}
	/***************************/

    $.ajax({
		type: 'POST',
		url: 'script/login.php',
		data: $('#formulario1').serialize(),
		dataType: "JSON",
		success: function(respuesta) {
			//console.log(respuesta);
			if(respuesta == 0){
				Swal.fire({
					position: 'center',
					icon: 'error',
					title: 'Usuario incorrecto...!',
					showConfirmButton: true,
					timer: 3000
				})
				return false;
			}

			if(respuesta['redireccion']=='pasantia'){
				Swal.fire({
	 				title: 'Preparando Ambiente de Pasantes!',
	 				text: "Redirigiendo...!",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: true,
	 				confirmButtonColor: '#3085d6',
	 				confirmButtonText: 'No esperar!',
	 				timer: 3000
				}).then((result) => {
	 				if (result.value) {
	   					window.location.href = "pasante/crear_cuenta.php";
	 				}
				})
				setTimeout(function() {
			    	window.location.href = "pasante/crear_cuenta.php";
				},3500);
				return false;
			}

			if(respuesta['redireccion']=='modelo'){
				Swal.fire({
	 				title: 'Preparando Perfil de Modelo!',
	 				text: "Redirigiendo...!",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: true,
	 				confirmButtonColor: '#3085d6',
	 				confirmButtonText: 'No esperar!',
	 				timer: 3000
				}).then((result) => {
	 				if (result.value) {
	   					window.location.href = "modelo/perfil.php";
	 				}
				})
				setTimeout(function() {
			    	window.location.href = "modelo/perfil.php";
				},3500);
				return false;
			}

			$('#usuario_nombre').val(respuesta['usuario_nombre']);
			$('#usuario_apellido').val(respuesta['usuario_apellido']);
			$('#usuario_correo').val(respuesta['usuario_correo']);
			$('#usuario_rol').val(respuesta['usuario_rol']);
			$('#usuario_telefono1').val(respuesta['usuario_telefono1']);
			$('#usuario_usuario').val(respuesta['usuario_usuario']);

			Swal.fire({
 				title: 'Bienvenido usuario '+respuesta['usuario_usuario'],
 				text: "Redirigiendo...!",
 				icon: 'success',
 				position: 'center',
 				showConfirmButton: true,
 				confirmButtonColor: '#3085d6',
 				confirmButtonText: 'No esperar!',
 				timer: 3000
			}).then((result) => {
 				if (result.value) {
   					$('#formulario2').submit();
 				}
			})
			setTimeout(function() {
		    	$('#formulario2').submit();
			},3500);
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