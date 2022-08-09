<?php 
session_start();
session_destroy();
?>
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
					    <input type="text" class="form-control" name="usuario" id="usuario" autocomplete="off" placeholder="" value="">
				    </div>

				    <div class="form-group form-check">
					    <label for="clave">Clave</label>
					    <input type="password" class="form-control" name="clave" id="clave" placeholder="" value="">
					    <div class="ml-1 mt-1 error_texto2 d-none" id="error_texto2"></div>
				    </div>
					<div class="row">
						<div class="col-md-12 form-group form-check text-center">
							<button type="submit" id="submit" class="btn btn-success">Ingresar</button>
						</div>
						<!--
						<div class="col-md-7 form-group form-check text-center">
							<a href="recuperar_contraseña1.php" style="color:white; text-decoration: none; margin-top: 5px;">¿Has olvidado la contraseña?</a>
						</div>
						-->
					</div>
			    </form>

		    </div>
	    </div>
    </div>
  </body>
</html>

<script>
$("#formulario1").on("submit", function(e){
	e.preventDefault();
	var usuario = $('#usuario').val();
	var clave = $('#clave').val();

    $.ajax({
		type: 'POST',
		url: 'script/login.php',
		data: $('#formulario1').serialize(),
		dataType: "JSON",
		success: function(respuesta) {
			console.log(respuesta);
			if(respuesta["estatus"]=="ok"){
				window.location.href = respuesta["redireccion"];
			}else if(respuesta["estatus"]=="error"){
				Swal.fire({
	 				title: 'Error',
	 				text: respuesta["msg"],
	 				icon: 'error',
	 				position: 'center',
	 				timer: 3000
				});
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