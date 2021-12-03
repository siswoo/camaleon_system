<?php
	session_start();
	if(!isset($_SESSION['nombre'])){
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
	<link rel="stylesheet" href="../css/roles.css">
	<link rel="stylesheet" href="../css/validaciones.css">
	<link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
	<link href="../resources/fontawesome/css/all.css" rel="stylesheet">
	<title>Camaleon Sistem</title>
</head>
<body>
<?php
	include('../script/conexion.php');
	$ubicacion = "roles";
	$consulta1 = "SELECT * FROM roles WHERE id = ".$_SESSION['rol']." LIMIT 1";
	$resultado1 = mysqli_query( $conexion, $consulta1 );
	while($row1 = mysqli_fetch_array($resultado1)) {
		$usuario_rol = $row1['nombre'];

		$modelo_view = $row1['modelo_view'];
		$modelo_edit = $row1['modelo_edit'];
		$modelo_delete = $row1['modelo_delete'];

		$roles_view = $row1['roles_view'];
		$roles_edit = $row1['roles_edit'];
		$roles_delete = $row1['roles_delete'];

		$pasante_view = $row1['pasante_view'];
		$pasante_edit = $row1['pasante_edit'];
		$pasante_delete = $row1['pasante_delete'];
	}
	include('../navbar.php');
?>
	<form id="formulario1" method="POST">
		<input type="hidden" id="modelo_view" value="<?php echo $modelo_view; ?>">
		<input type="hidden" id="modelo_edit" value="<?php echo $modelo_edit; ?>">
		<input type="hidden" id="modelo_delete" value="<?php echo $modelo_delete; ?>">

		<input type="hidden" id="pasante_view" value="<?php echo $pasante_view; ?>">
		<input type="hidden" id="pasante_edit" value="<?php echo $pasante_edit; ?>">
		<input type="hidden" id="pasante_delete" value="<?php echo $pasante_delete; ?>">
	</form>

    <div class="seccion1">
	    <div class="row">
		    <div class="container">
			    <form action="#" method="POST" id="formulario2" style="">
			    	<div class="row">
					    <div class="col-12" class="text-center">
					    	<p class="text-center titulo1" style="margin-right: 10px;text-transform: uppercase;">Ingrese la información del nuevo Rol</p>
					    </div>
					</div>

				    <div class="row">
						<div class="col-12 form-group form-check">
							<label for="nombre">Nombre <small style="color:red; font-weight: bold;">(*)</small></label>
							<input type="text" name="nombre" id="nombre" value="" class="form-control" required>
						</div>
					</div>

					<p class="hr-texto mt-3"><span style="z-index: 1; font-weight: bold; background-color: white; padding-left: 1rem; padding-right: 1rem;">Modelos</span></p>

				    <div class="row">
						<div class="col-4 form-group form-check">
							<label for="modelo_view">Modelo View</label>
							<select name="modelo_view" id="modelo_view" class="form-control">
							   	<option value="0">No</option>
							    <option value="1">Si</option>
							</select>
						</div>

						<div class="col-4 form-group form-check">
						    <label for="modelo_edit">Modelo Edit</label>
						    <select name="modelo_edit" id="modelo_edit" class="form-control">
						    	<option value="0">No</option>
						    	<option value="1">Si</option>
						    </select>
					    </div>

						<div class="col-4 form-group form-check">
						    <label for="modelo_delete">Modelo Delete</label>
						    <select name="modelo_delete" id="modelo_delete" class="form-control">
						    	<option value="0">No</option>
						    	<option value="1">Si</option>
						    </select>
					    </div>
					</div>

					<!--
					<p class="hr-texto mt-3"><span style="z-index: 1; font-weight: bold; background-color: white; padding-left: 1rem; padding-right: 1rem;">Roles</span></p>

					<div class="row">
						<div class="col-4 form-group form-check">
						    <label for="roles_view">Rol View</label>
						    <select name="roles_view" id="roles_view" class="form-control">
						    	<option value="0">No</option>
						    	<option value="1">Si</option>
						    </select>
					    </div>

						<div class="col-4 form-group form-check">
						    <label for="roles_edit">Rol Edit</label>
						    <select name="roles_edit" id="roles_edit" class="form-control">
						    	<option value="0">No</option>
						    	<option value="1">Si</option>
						    </select>
					    </div>
						<div class="col-4 form-group form-check">
							<label for="roles_delete">Rol Delete</label>
							<select name="roles_delete" id="roles_delete" class="form-control">
						    	<option value="0">No</option>
						    	<option value="1">Si</option>
						    </select>
					    </div>
					</div>
					-->

					<p class="hr-texto mt-3"><span style="z-index: 1; font-weight: bold; background-color: white; padding-left: 1rem; padding-right: 1rem;">Pasantes</span></p>

					<div class="row">
						<div class="col-4 form-group form-check">
						    <label for="pasante_view">Pasante View</label>
						    <select name="pasante_view" id="pasante_view" class="form-control">
						    	<option value="0">No</option>
						    	<option value="1">Si</option>
						    </select>
					    </div>

						<div class="col-4 form-group form-check">
						    <label for="pasante_edit">Pasante Edit</label>
						    <select name="pasante_edit" id="pasante_edit" class="form-control">
						    	<option value="0">No</option>
						    	<option value="1">Si</option>
						    </select>
					    </div>
						<div class="col-4 form-group form-check">
							<label for="pasante_delete">Pasante Delete</label>
							<select name="pasante_delete" id="pasante_delete" class="form-control">
						    	<option value="0">No</option>
						    	<option value="1">Si</option>
						    </select>
					    </div>
					</div>


					<div class="row mt-2">
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
		url: '../script/guardar_roles.php',
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
						window.location.href = "crear_registro.php";
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


</script>