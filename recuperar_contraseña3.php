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

<?php
include('script/conexion.php');
$contador1 = 0;
if(@$_GET['key']!=''){
	$sql1 = "SELECT * FROM recuperar_password WHERE codigo = '".$_GET['key']."' and verificado = 0";
	$consulta1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($consulta1);
}

if($contador1>=1){

while($row1 = mysqli_fetch_array($consulta1)) {
	$id_recuperar = $row1['id'];
	$usuario_id = $row1['responsable'];
	$sql2 = "SELECT * FROM usuarios WHERE id = ".$usuario_id;
	$consulta2 = mysqli_query($conexion,$sql2);
	while($row2 = mysqli_fetch_array($consulta2)) {
		$usuario_usuario = $row2['usuario'];
		$usuario_correo = $row2['correo'];
		$usuario_documento = $row2['documento_numero'];
	}
}

?>

	<div class="col-12 text-center" style="margin-top: 4rem;">
		<img src="img/logo_index1.png" style="width: 200px;">
	</div>

    <div class="seccion1" style="margin-top: 3rem;">
		<div class="container">
			<div class="row">
		    	<div class="col-12" class="text-center">
			    	<form action="#" method="POST" id="formulario1" style="margin-left: 30%; margin-right: 30%;">
			    </div>

			    	<input type="hidden" name="id_recuperar" id="id_recuperar" value="<?php echo $id_recuperar; ?>">
			    	<input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $usuario_id; ?>">

				    <div class="col-12" class="text-center">
				    	<p class="text-center titulo1">Generar Nueva Contraseña</p>
				    </div>

				    <div class="col-4 form-group form-check">
					    <label for="usuario">Usuario Utilizado</label>
					    <input type="text" class="form-control" name="usuario" id="usuario" autocomplete="off" value="<?php echo $usuario_usuario; ?>" readonly>
				    </div>

				    <div class="col-4 form-group form-check">
					    <label for="correo">Correo Utilizado</label>
					    <input type="text" class="form-control" name="correo" id="correo" autocomplete="off" value="<?php echo $usuario_correo; ?>" readonly>
				    </div>

				    <div class="col-4 form-group form-check">
					    <label for="documento">Número de Documento Utilizado</label>
					    <input type="text" class="form-control" name="documento" id="documento" autocomplete="off" value="<?php echo $usuario_documento; ?>" readonly>
				    </div>

				    <div class="col-6 form-group form-check">
					    <label for="password1">Nueva Contraseña</label>
					    <input type="password" class="form-control" name="password1" id="password1" autocomplete="off" required>
				    </div>

				    <div class="col-6 form-group form-check">
					    <label for="password2">Repetir Contraseña</label>
					    <input type="password" class="form-control" name="password2" id="password2" autocomplete="off" required>
				    </div>
					
					<div class="col-12 text-center">
						<button class="btn btn-success">Guardar Datos</button>
					</div>

				<div class="col-12" class="text-center">
			    	</form>
			    </div>

		    </div>
	    </div>
    </div>

<?php
}
?>
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


<?php
if($contador1==0){ ?>
	<script>
		Swal.fire({
	 		title: 'Error!',
	 		text: "Link Vencido o Utilizado Anteriormente.",
	 		icon: 'error',
	 		position: 'center',
	 		showConfirmButton: false,
	 		time: 3000,
		});
		setTimeout(function() {
			window.location.href = "index.php";
		},3100);
	</script>
<?php } ?>
<script>
$("#formulario1").on("submit", function(e){
	e.preventDefault();
	var f = $(this);
	var password1 = $('#password1').val();
	var password2 = $('#password2').val();
	var id_recuperar = $('#id_recuperar').val();
	var id_usuario = $('#id_usuario').val();
	var condicion = 'recuperar_user1';

	/*******VALIDACIONES********/
	if(password1=='' || password2==''){
		Swal.fire({
			position: 'center',
			icon: 'error',
			title: 'Campos Vacios',
			showConfirmButton: true,
			timer: 3000
		});
		return false;
	}

	if(password1!=password2){
		Swal.fire({
			position: 'center',
			icon: 'error',
			title: 'Contraseñas Diferentes',
			showConfirmButton: true,
			timer: 3000
		});
		return false;
	}
	/***************************/

    $.ajax({
		type: 'POST',
		url: 'script/crud_password1.php',
		data: {
			"password1": password1,
			"id_recuperar": id_recuperar,
			"id_usuario": id_usuario,
			"condicion": condicion,
		},
		dataType: "JSON",
		success: function(respuesta) {
			console.log(respuesta);
			
			Swal.fire({
	 			title: 'Perfecto!',
	 			text: "Contraseñas cambiadas!",
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
			
			setTimeout(function() {
		    	window.location.href = "index.php";
			},3100);

		},

		error: function(respuesta) {
			console.log(respuesta['responseText']);
		}
	});

});

</script>