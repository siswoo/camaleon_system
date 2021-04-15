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

  	.page-link{
  		background-color: #A67D4C!important; 
  		border-color: #A67D4C;
  		color: white !important;
  		border-color: white !important;
  	}

  	.seccion1{
  		margin-left: 2rem;
  		margin-right: 2rem;
  	}

  	.navbar-active{
  		border-bottom: 2px solid #A9814F;
  	}

  	.btn-info{
  		background-color: #A9814F !important;
  		border-color: #A9814F !important;
  	}

  	.btn-primary{
  		background-color: #A9814F !important;
  		border-color: #A9814F !important;
  	}

  	body{
  		font-family: Helvetica Neue,Helvetica,Arial,sans-serif;
  	}
</style>
<body>
<?php
	include('../script/conexion.php');
	$ubicacion = "residuos";
	$consulta1 = "SELECT * FROM roles WHERE id = ".$_SESSION['rol']." LIMIT 1";
	$resultado1 = mysqli_query( $conexion, $consulta1 );
	while($row1 = mysqli_fetch_array($resultado1)) {
		$usuario_rol = $row1['nombre'];
		$pasante_view = $row1['pasante_view'];
		$pasante_edit = $row1['pasante_edit'];
		$pasante_delete = $row1['pasante_delete'];

		/**************VALIDAR****************/
		$roles_view = $row1['roles_view'];
		$seguridad_view = $row1['seguridad_view'];
		$modelo_view = $row1['modelo_view'];
		/*************************************/
	}
	include('../navbar.php');
?>

	<div class="seccion1">
		<form action="exportar1.php" method="GET">
		    <div class="row">
		    	<div class="col-12 mb-3 text-center" style="font-size: 20px; font-weight: bold;">Presabana de Modelos Inactivas</div>
		    	<div class="col-4 mb-3">
					<select class="form-control" id="sede" name="sede" required>
						<option value="">Selecciona</option>
						<?php
						$sql1 = "SELECT * FROM sedes";
						$proceso1 = mysqli_query($conexion,$sql1);
						while($row1 = mysqli_fetch_array($proceso1)) {
							$sede_id = $row1["id"];
							$sede_nombre = $row1["nombre"];
							echo '
								<option value="'.$sede_id.'">'.$sede_nombre.'</option>
							';
						}
						?>
					</select>
				</div>
				<div class="col-4 mb-3">
					<select class="form-control" id="presabana" name="presabana" required>
						<option value="">Selecciona</option>
						<?php
						$sql2 = "SELECT * FROM presabana_inactivos GROUP BY inicio";
						$proceso2 = mysqli_query($conexion,$sql2);
						while($row2 = mysqli_fetch_array($proceso2)) {
							$presabana_id = $row2["id"];
							$presabana_inicio = $row2["inicio"];
							$presabana_fin = $row2["fin"];
							echo '
								<option value="'.$presabana_id.'"> Desde '.$presabana_inicio.' | Hasta '.$presabana_fin.'</option>
							';
						}
						?>
					</select>
				</div>
				<div class="col-4 mb-3">
					<button type="submit" class="btn btn-primary">Exportar</button>
				</div>
			</div>
		</form>
	</div>
</body>
</html>

<script src="../js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../js/popper.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="../js/navbar.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/dataTables.bootstrap4.min.js"></script>

<?php include('../footer.php'); ?>

<script type="text/javascript">
	//
</script>







