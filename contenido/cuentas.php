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
	}
?>

<div class="dashboard-main-wrapper">
		<?php include("header.php"); ?>
        <div class="dashboard-wrapper">
            <div class="page-header">
                <div class="container-fluid dashboard-content ">
                    <h2 class="pageheader-title">Cuentas </h2>
                    <p class="pageheader-text">Cuentas</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cuentas</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="container">
						<input type="hidden" id="hidden_id" name="hidden_id" value="<?php echo $_SESSION['id']; ?>">
						<div class="row" id="respuesta1"></div>
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
		consultar_cuentas2();
	});

	function consultar_cuentas2(){
		var id = $('#hidden_id').val();
		$.ajax({
			type: 'POST',
			url: '../script/crud_contenido.php',
			dataType: "JSON",
			data: {
				"id": id,
				"condicion": "consultar_cuentas2",
			},

			success: function(respuesta) {
				console.log(respuesta);
				$('#respuesta1').html(respuesta["html"]);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}

		});
	};
</script>
