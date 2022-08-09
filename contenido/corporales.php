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
		$genero = $row1["genero"];
		$altura = $row1["altura"];
		$peso = $row1["peso"];
		$sosten = $row1["sosten"];
		$busto = $row1["busto"];
		$cintura = $row1["cintura"];
		$caderas = $row1["caderas"];
		$pene = $row1["pene"];
		$tipo_cuerpo = $row1["tipo_cuerpo"];
		$vello = $row1["vello"];
		$cabello = $row1["cabello"];
		$ojos = $row1["ojos"];
		$tattoo = $row1["tattoo"];
		$piercing = $row1["piercing"];
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
                    <h2 class="pageheader-title">Corporales </h2>
                    <p class="pageheader-text">Corporales</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Corporales</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="container">
                        <form id="formulario1" method="POST" action="#" enctype="multipart/form-data">
                            <div class="row">
								<input type="hidden" id="hidden_id" name="hidden_id" value="<?php echo $_SESSION['id']; ?>">
								<input type="hidden" id="condicion" name="condicion" value="guardar_corporales">
								<input type="hidden" id="genero" name="genero" value="<?php echo $genero; ?>">
                                <div class="col-6 mt-3">
                                	<label form="altura">Altura (cm)</label>
                                    <input type="text" class="form-control droparea" id="altura" name="altura" pattern="[0-9]+" title="Solo Numeros son validos" autocomplete="off" value="<?php echo $altura; ?>" required>
                                </div>
                                <div class="col-6 mt-3">
                                	<label form="peso">Peso (KG)</label>
                                    <input type="text" class="form-control droparea" id="peso" name="peso" value="<?php echo $peso; ?>" pattern="[0-9]+" autocomplete="off" required>
                                </div>
                                <?php
                                if($genero=='Mujer'){ ?>
	                                <div class="col-6 mt-3">
	                                	<label form="sosten">Tamaño Sosten</label>
	                                    <select class="form-control" name="sosten" id="sosten" required="">
											<option value="">Seleccione</option>
											<option <?php if($sosten=='32A'){ echo 'selected'; } ?> value="32A">32A</option>
											<option <?php if($sosten=='32B'){ echo 'selected'; } ?> value="32B">32B</option>
											<option <?php if($sosten=='32C'){ echo 'selected'; } ?> value="32C">32C</option>
											<option <?php if($sosten=='32D'){ echo 'selected'; } ?> value="32D">32D</option>
											<option <?php if($sosten=='34A'){ echo 'selected'; } ?> value="34A">34A</option>
											<option <?php if($sosten=='34B'){ echo 'selected'; } ?> value="34B">34B</option>
											<option <?php if($sosten=='34C'){ echo 'selected'; } ?> value="34C">34C</option>
											<option <?php if($sosten=='34D'){ echo 'selected'; } ?> value="34D">34D</option>
											<option <?php if($sosten=='36A'){ echo 'selected'; } ?> value="36A">36A</option>
											<option <?php if($sosten=='36B'){ echo 'selected'; } ?> value="36B">36B</option>
											<option <?php if($sosten=='36C'){ echo 'selected'; } ?> value="36C">36C</option>
											<option <?php if($sosten=='36D'){ echo 'selected'; } ?> value="36D">36D</option>
											<option <?php if($sosten=='38A'){ echo 'selected'; } ?> value="38A">38A</option>
											<option <?php if($sosten=='38B'){ echo 'selected'; } ?> value="38B">38B</option>
											<option <?php if($sosten=='38C'){ echo 'selected'; } ?> value="38C">38C</option>
											<option <?php if($sosten=='38D'){ echo 'selected'; } ?> value="38D">38D</option>
											<option <?php if($sosten=='40A'){ echo 'selected'; } ?> value="40A">40A</option>
											<option <?php if($sosten=='40B'){ echo 'selected'; } ?> value="40B">40B</option>
											<option <?php if($sosten=='40C'){ echo 'selected'; } ?> value="40C">40C</option>
											<option <?php if($sosten=='40D'){ echo 'selected'; } ?> value="40D">40D</option>
										</select>
	                                </div>
	                                <div class="col-6 mt-3">
	                                	<label form="busto">Media del Busto</label>
	                                    <input type="text" class="form-control droparea" id="busto" name="busto" value="<?php echo $busto; ?>" pattern="[0-9]+" autocomplete="off" required>
	                                </div>
	                                <div class="col-6 mt-3">
	                                	<label form="cintura">Medida de Cintura</label>
	                                    <input type="text" class="form-control droparea" id="cintura" name="cintura" value="<?php echo $cintura; ?>" pattern="[0-9]+" autocomplete="off" required>
	                                </div>
	                                <div class="col-6 mt-3">
	                                	<label form="caderas">Medida de Caderas</label>
	                                    <input type="text" class="form-control droparea" id="caderas" name="caderas" value="<?php echo $caderas; ?>" pattern="[0-9]+" autocomplete="off" required>
	                                </div>
                                <?php }else{ ?>
	                                <div class="col-6 mt-3">
	                                	<label form="pene">Tamaño del Pene (cm)</label>
	                                    <input type="text" class="form-control droparea" id="pene" name="pene" value="<?php echo $pene; ?>" pattern="[0-9]+" autocomplete="off" required>
	                                </div>
	                            <?php } ?>
                                <div class="col-6 mt-3">
                                	<label form="tipo_cuerpo">Tipo de Cuerpo</label>
                                    <select class="form-control" name="tipo_cuerpo" id="tipo_cuerpo" required="">
										<option value="">Seleccione</option>
										<option <?php if($tipo_cuerpo=='Delgado'){ echo 'selected'; } ?> value="Delgado">Delgado</option>
										<option <?php if($tipo_cuerpo=='Promedio'){ echo 'selected'; } ?> value="Promedio">Promedio</option>
										<option <?php if($tipo_cuerpo=='Atlético'){ echo 'selected'; } ?> value="Atlético">Atlético</option>
										<option <?php if($tipo_cuerpo=='Obeso'){ echo 'selected'; } ?> value="Obeso">Obeso</option>
										<option <?php if($tipo_cuerpo=='Alto y Grande'){ echo 'selected'; } ?> value="Alto y Grande">Alto y Grande</option>
									</select>
                                </div>
                                <div class="col-6 mt-3">
                                	<label form="vello">Vello Púbico</label>
                                    <select class="form-control" name="vello" id="vello" required="">
										<option value="">Seleccione</option>
										<option <?php if($vello=='Peludo'){ echo 'selected'; } ?> value="Peludo">Peludo</option>
										<option <?php if($vello=='Recortado'){ echo 'selected'; } ?> value="Recortado">Recortado</option>
										<option <?php if($vello=='Afeitado'){ echo 'selected'; } ?> value="Afeitado">Afeitado</option>
										<option <?php if($vello=='Calvo'){ echo 'selected'; } ?> value="Calvo">Calvo</option>
									</select>
                                </div>
                                <div class="col-6 mt-3">
                                	<label form="cabello">Color de Cabello</label>
                                    <input type="text" class="form-control droparea" id="cabello" name="cabello" value="<?php echo $cabello; ?>" autocomplete="off" required>
                                </div>
                                <div class="col-6 mt-3">
                                	<label form="ojos">Color de Ojos</label>
                                    <input type="text" class="form-control droparea" id="ojos" name="ojos" value="<?php echo $ojos; ?>" autocomplete="off" required>
                                </div>
                                <div class="col-6 mt-3">
                                	<label form="tattoo">¿Posee Tattoo?</label>
                                    <select class="form-control" id="tattoo" name="tattoo" required="">
										<option value="">Seleccione</option>
										<option <?php if($tattoo=='Si'){ echo 'selected'; } ?> value="Si">Si</option>
										<option <?php if($tattoo=='No'){ echo 'selected'; } ?> value="No">No</option>
									</select>
                                </div>
                                <div class="col-12 mt-3">
                                	<label form="piercing">¿Posee Piercing?</label>
                                    <select class="form-control" id="piercing" name="piercing" required="">
										<option value="">Seleccione</option>
										<option <?php if($piercing=='Si'){ echo 'selected'; } ?> value="Si">Si</option>
										<option <?php if($piercing=='No'){ echo 'selected'; } ?> value="No">No</option>
									</select>
                                </div>
                            </div>
                            <div class="col-12 mt-3 text-center">
								<button type="submit" class="btn btn-primary" id="submit1" name="submit1">Modificar Datos</button>
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

		$.ajax({
			type: 'POST',
			url: '../script/crud_contenido.php',
			data: new FormData(this),
            dataType: "JSON",
			contentType: false,
			cache: false,
			processData:false,

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

	function foto1(value){
		if(value=='Prestada'){
			$('#div_prestada').show("slow");
		}else{
			$('#div_prestada').hide("slow");
		}
	}
</script>
