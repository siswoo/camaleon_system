<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/validaciones.css">
	<link href="resources/fontawesome/css/all.css" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
	<link href="resources/lightbox/dist/css/lightbox.css" rel="stylesheet">
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

	<div class="col-12 text-center" style="margin-top: 4rem;">
		<img src="img/logo_index1.png" style="width: 200px;">
	</div>

    <div class="seccion1" style="margin-top: 3rem;">
	    <div class="row">
		    <div class="container">

		    	<div class="col-12" class="text-center">
			    	<form action="#" method="POST" id="formulario1" style="margin-left: 30%; margin-right: 30%;">
			    </div>

				    <div class="col-12" class="text-center">
				    	<p class="text-center titulo1">Recuperar Contraseña</p>
				    </div>
				    <div class="form-group form-check">
					    <label for="usuario">Usuario o Correo Electrónico</label>
					    <input type="text" class="form-control" name="usuario" id="usuario" autocomplete="off">
					    <div class="ml-1 mt-1 error_texto1 d-none" id="error_texto1">Este campo no debe estar vacio.</div>
				    </div>
					
					<div class="col-12 text-center">
						<button class="btn btn-success">Enviar Verificación</button>
					</div>

				<div class="col-12" class="text-center">
			    	</form>
			    </div>

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
<script type="text/javascript" src="js/mdb.js"></script>
<script src="resources/lightbox/dist/js/lightbox.js"></script>

<script>
$("#formulario1").on("submit", function(e){
	e.preventDefault();
	var f = $(this);
	var usuario = $('#usuario').val();

	/*******VALIDACIONES********/
	if(usuario==''){
		Swal.fire({
			position: 'center',
			icon: 'error',
			title: 'Campo Vacio',
			showConfirmButton: true,
			timer: 3000
		});
		return false;
	}
	/***************************/

    $.ajax({
		type: 'POST',
		url: 'script/recuperar_contraseña2.php',
		data: $('#formulario1').serialize(),
		dataType: "JSON",
		success: function(respuesta) {
			console.log(respuesta);
			
			if(respuesta['contador']>=1){
				Swal.fire({
	 				title: 'Perfecto!',
	 				text: "Su contraseña es su numero de documento actual!",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: true,
	 				confirmButtonColor: '#3085d6',
	 				confirmButtonText: 'Aceptar',
				}).then((result) => {
	 				if (result.value) {
	   					window.location.href = "index.php";
	 				}
				})
			}else{
				Swal.fire({
	 				title: 'Error!',
	 				text: "Su usuario y/o correo Electrónico no existen en la base de datos.",
	 				icon: 'error',
	 				position: 'center',
	 				showConfirmButton: false,
	 				time: 3000,
				}).then((result) => {
	 				if (result.value) {
	   					window.location.href = "index.php";
	 				}
				})
			}

			/*
			setTimeout(function() {
		    	window.location.href = "index.php";
			},3500);
			*/

		},

		error: function(respuesta) {
			console.log(respuesta['responseText']);
		}
	});

});

</script>