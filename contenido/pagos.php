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
		$id = $row1["id"];
		$banco_cedula = $row1["banco_cedula"];
		$banco_nombre = $row1["banco_nombre"];
		$banco_tipo = $row1["banco_tipo"];
		$banco_numero = $row1["banco_numero"];
		$banco_banco = $row1["banco_banco"];
		$bcpp = $row1["BCPP"];
		$banco_tipo_documento = $row1["banco_tipo_documento"];
	}

	$sql2 = "SELECT * FROM contenido_documentos WHERE id_documentos = 14 and id_modelos = ".$id;
	$proceso2 = mysqli_query($conexion,$sql2);
	$contador2 = mysqli_num_rows($proceso2);
	if($contador2==0){
		$imagen = '';
	}else{
		while($row2=mysqli_fetch_array($proceso2)){
			$imagen = $row2["imagen"];
		}
	}
?>

<div class="dashboard-main-wrapper">
		<?php include("header.php"); ?>
        <div class="dashboard-wrapper">
            <div class="page-header">
                <div class="container-fluid dashboard-content ">
                    <h2 class="pageheader-title">Pagos </h2>
                    <p class="pageheader-text">Pagos</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pagos</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="container">
                        <form id="formulario1" method="GET" target="_blank" action="desprendible1.php" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12 mt-3">
                                	<label form="id">Desprendible</label>
                                    <select class="form-control" name="id" id="id" required>
                                    	<option value="">Seleccione</option>
                                    	<?php
                                    	$sql3 = "SELECT * FROM contenido_presabana WHERE id_modelo = ".$id;
                                    	$proceso3 = mysqli_query($conexion,$sql3);
                                    	$contador3 = mysqli_num_rows($proceso3);
                                    	if($contador3>=1){
                                    		while($row3=mysqli_fetch_array($proceso3)){
                                    			$presabana_id = $row3["id"];
                                    			$presabana_mes = $row3["mes"];
                                    			$presabana_anio = $row3["anio"];
                                    			echo '<option value="'.$presabana_id.'">'.$presabana_mes.' | '.$presabana_anio.'</option>';
                                    		}
                                    	}
                                    	?>
                                    </select>
                                </div>
	                            <div class="col-12 mt-3 text-center">
									<button type="submit" class="btn btn-primary" id="submit1" name="submit1">CONSULTAR</button>
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

</script>
