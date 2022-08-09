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
	<link rel="stylesheet" href="../css/modelo.css">
	<link rel="stylesheet" href="../css/validaciones.css">
	<link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
	<link href="../resources/fontawesome/css/all.css" rel="stylesheet">
	<link rel="stylesheet" href="../assets/libs/css/style.css">
    <link rel="stylesheet" href="../assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="../assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="../assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="../assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="../assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
	<title>Camaleon Sistem</title>
</head>
<body>

<?php
	include('../script/conexion.php');
	$sql1 = "SELECT * FROM contenido_modelos WHERE id = ".$_SESSION["id"];
	$proceso1 = mysqli_query($conexion,$sql1);
	while($row1=mysqli_fetch_array($proceso1)){
		$documento_tipo = $row1["documento_tipo"];
		$documento_numero = $row1["documento_numero"];
		$nombre_completo = $row1["nombre1"]." ".$row1["nombre2"]." ".$row1["apellido1"]." ".$row1["apellido2"];
		$correo = $row1["correo"];
		$telefono1 = $row1["telefono1"];
		$genero = $row1["genero"];
		$direccion = $row1["direccion"];
		$telegram = $row1["telegram"];
	}
?>

<div class="dashboard-main-wrapper">
		<?php include("header.php"); ?>
        <div class="dashboard-wrapper">
            <div class="page-header">
                <div class="container-fluid dashboard-content ">
                    <h2 class="pageheader-title">Personal </h2>
                    <p class="pageheader-text">Personal</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Personal</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="container">
                        <form id="formulario1" method="POST" action="#" enctype="multipart/form-data">
                            <div class="row">
								<input type="hidden" id="hidden_id" name="hidden_id" value="<?php echo $_SESSION['id']; ?>">
                                <div class="col-6 mt-3">
                                	<label form="documento_tipo">Tipo de Documento</label>
                                    <input type="text" class="form-control droparea" id="documento_tipo" name="documento_tipo" value="<?php echo $documento_tipo; ?>" readonly>
                                </div>
                                <div class="col-6 mt-3">
                                	<label form="documento_numero">Numero de Documento</label>
                                    <input type="text" class="form-control droparea" id="documento_numero" name="documento_numero" value="<?php echo $documento_numero; ?>" readonly>
                                </div>
                                <div class="col-6 mt-3">
                                	<label form="nombre">Nombre Completo</label>
                                    <input type="text" class="form-control droparea" id="nombre" name="nombre" value="<?php echo $nombre_completo; ?>" readonly>
                                </div>
                                <div class="col-6 mt-3">
                                	<label form="correo">Correo</label>
                                    <input type="text" class="form-control droparea" id="correo" name="correo" value="<?php echo $correo; ?>" readonly>
                                </div>
                                <div class="col-6 mt-3">
                                	<label form="genero">Genero</label>
                                    <input type="text" class="form-control droparea" id="genero" name="genero" value="<?php echo $genero; ?>" readonly>
                                </div>
                                <div class="col-6 mt-3">
                                	<label form="telefono1">Telefono</label>
                                    <input type="text" class="form-control droparea" id="telefono1" name="telefono1" autocomplete="off" value="<?php echo $telefono1; ?>">
                                </div>
                                <div class="col-6 mt-3">
                                	<label form="direccion">Direccion</label>
                                    <input type="text" class="form-control droparea" id="direccion" name="direccion" autocomplete="off" value="<?php echo $direccion; ?>">
                                </div>
                                <div class="col-6 mt-3">
                                	<label form="telegram">Telegram</label>
                                    <input type="text" class="form-control droparea" id="telegram" name="telegram" autocomplete="off" value="<?php echo $telegram; ?>" required>
                                </div>
                                <div class="col-12 mt-3 text-center">
                                    <button type="submit" class="btn btn-primary" id="submit1" name="submit1">Modificar Datos</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

<script src="../js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../js/popper.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script type="text/javascript">
	$(document).ready(function() {
		//
	});

	$("#formulario1").on("submit", function(e){
		e.preventDefault();
		var id = $('#hidden_id').val();
		var telefono1 = $('#telefono1').val();
		var direccion = $('#direccion').val();
		var telegram = $('#telegram').val();

		$.ajax({
			type: 'POST',
			url: '../script/crud_contenido.php',
			dataType: "JSON",
			data: {
				"id": id,
				"telefono": telefono1,
				"direccion": direccion,
				"telegram": telegram,
				"condicion": "guardar_personal1",
			},

			success: function(respuesta) {
				console.log(respuesta);
				if(respuesta["estatus"]=="ok"){
					Swal.fire({
				 		title: 'Ok',
				 		text: respuesta["msg"],
				 		icon: 'success',
				 		position: 'center',
				 		timer: 2000,
					});
				}else if(respuesta["estatus"]=="error"){
					Swal.fire({
				 		title: 'Error',
				 		text: respuesta["msg"],
				 		icon: 'error',
				 		position: 'center',
				 		timer: 2000,
					});
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}

		});
	});
</script>
