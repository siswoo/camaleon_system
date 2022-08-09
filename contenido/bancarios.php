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
                    <h2 class="pageheader-title">Bancarios </h2>
                    <p class="pageheader-text">Bancarios</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Bancarios</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="container">
                        <form id="formulario1" method="POST" action="#" enctype="multipart/form-data">
                            <div class="row">
								<input type="hidden" id="hidden_id" name="hidden_id" value="<?php echo $_SESSION['id']; ?>">
								<input type="hidden" id="condicion" name="condicion" value="guardar_bancario">
                                <div class="col-6 mt-3">
                                	<label form="banco_cpp">Cuenta propia o prestada</label>
                                    <select class="form-control" name="banco_cpp" id="banco_cpp" onchange="foto1(value);" required>
                                    	<option value="">Seleccione</option>
                                    	<option value="Propia" <?php if($bcpp=='Propia'){ echo 'selected'; }; ?>>Propia</option>
                                    	<option value="Prestada" <?php if($bcpp=='Prestada'){ echo 'selected'; }; ?>>Prestada</option>
                                    </select>
                                </div>
                                <div class="col-6 mt-3">
                                	<label form="banco_tipo_documento">Tipo de Documento del Titular</label>
                                    <select class="form-control" name="banco_tipo_documento" id="banco_tipo_documento" required>
                                    	<option value="">Seleccione</option>
										<option <?php if($banco_tipo_documento=='PEP'){ echo 'selected'; }; ?> value="PEP">PEP</option>
										<option <?php if($banco_tipo_documento=='Pasaporte'){ echo 'selected'; }; ?> value="Pasaporte">Pasaporte</option>
										<option <?php if($banco_tipo_documento=='Cedula de Ciudadania'){ echo 'selected'; }; ?> value="Cedula de Ciudadania">Cedula de Ciudadania</option>
										<option <?php if($banco_tipo_documento=='NIT'){ echo 'selected'; }; ?> value="NIT">NIT</option>
										<option <?php if($banco_tipo_documento=='NIT de extranjeria'){ echo 'selected'; }; ?> value="NIT de extranjeria">NIT de extranjeria</option>
                                    </select>
                                </div>
                                <div class="col-6 mt-3">
                                	<label form="banco_documento_numero">Numero Documento Titular</label>
                                    <input type="text" class="form-control droparea" id="banco_documento_numero" name="banco_documento_numero" autocomplete="off" value="<?php echo $banco_cedula; ?>" required>
                                </div>
                                <div class="col-6 mt-3">
                                	<label form="banco_nombre">Nombre Titular</label>
                                    <input type="text" class="form-control droparea" id="banco_nombre" name="banco_nombre" value="<?php echo $banco_nombre; ?>" autocomplete="off" required>
                                </div>
                                <div class="col-6 mt-3">
                                	<label form="banco_tipo_cuenta">Tipo de Cuenta</label>
                                    <select class="form-control" name="banco_tipo_cuenta" id="banco_tipo_cuenta" required>
										<option value="">Seleccione</option>
										<option <?php if($banco_tipo=='Ahorro'){ echo 'selected'; }; ?> value="Ahorro">Ahorro</option>
										<option <?php if($banco_tipo=='Corriente'){ echo 'selected'; }; ?> value="Corriente">Corriente</option>
									</select>
                                </div>
                                <div class="col-6 mt-3">
                                	<label form="banco_cuenta">Numero de Cuenta</label>
                                    <input type="text" class="form-control droparea" id="banco_cuenta" name="banco_cuenta" autocomplete="off" value="<?php echo $banco_numero; ?>" required>
                                </div>
                                <div class="col-12 mt-3">
                                	<label form="banco_banco">Banco</label>
                                    <select class="form-control" name="banco_banco" id="banco_banco" required>
                                    	<option value="">Seleccione</option>
										<option <?php if($banco_banco=='Banco Agrario de Colombia'){ echo 'selected'; }; ?> value="Banco Agrario de Colombia">Banco Agrario de Colombia</option>
										<option <?php if($banco_banco=='Banco AV Villas'){ echo 'selected'; }; ?> value="Banco AV Villas">Banco AV Villas</option>
										<option <?php if($banco_banco=='Banco Caja Social'){ echo 'selected'; }; ?> value="Banco Caja Social">Banco Caja Social</option>
										<option <?php if($banco_banco=='Banco de Occidente (Colombia)'){ echo 'selected'; }; ?> value="Banco de Occidente (Colombia)">Banco de Occidente (Colombia)</option>
										<option <?php if($banco_banco=='Banco Popular (Colombia)'){ echo 'selected'; }; ?> value="Banco Popular (Colombia)">Banco Popular (Colombia)</option>
										<option <?php if($banco_banco=='Bancolombia'){ echo 'selected'; }; ?> value="Bancolombia">Bancolombia</option>
										<option <?php if($banco_banco=='BBVA Colombia'){ echo 'selected'; }; ?> value="BBVA Colombia">BBVA Colombia</option>
										<option <?php if($banco_banco=='BBVA Movil'){ echo 'selected'; }; ?> value="BBVA Movil">BBVA Movil</option>
										<option <?php if($banco_banco=='Banco de Bogotá'){ echo 'selected'; }; ?> value="Banco de Bogotá">Banco de Bogotá</option>
										<option <?php if($banco_banco=='Colpatria'){ echo 'selected'; }; ?> value="Colpatria">Colpatria</option>
										<option <?php if($banco_banco=='Davivienda'){ echo 'selected'; }; ?> value="Davivienda">Davivienda</option>
										<option <?php if($banco_banco=='ITAU CorpBanca'){ echo 'selected'; }; ?> value="ITAU CorpBanca">ITAU CorpBanca</option>
										<option <?php if($banco_banco=='Citibank'){ echo 'selected'; }; ?> value="Citibank">Citibank</option>
										<option <?php if($banco_banco=='GNB Sudameris'){ echo 'selected'; }; ?> value="GNB Sudameris">GNB Sudameris</option>
										<option <?php if($banco_banco=='ITAU'){ echo 'selected'; }; ?> value="ITAU">ITAU</option>
										<option <?php if($banco_banco=='Scotiabank'){ echo 'selected'; }; ?> value="Scotiabank">Scotiabank</option>
										<option <?php if($banco_banco=='Bancoldex'){ echo 'selected'; }; ?> value="Bancoldex">Bancoldex</option>
										<option <?php if($banco_banco=='JPMorgan'){ echo 'selected'; }; ?> value="JPMorgan">JPMorgan</option>
										<option <?php if($banco_banco=='BNP Paribas'){ echo 'selected'; }; ?> value="BNP Paribas">BNP Paribas</option>
										<option <?php if($banco_banco=='Banco ProCredit'){ echo 'selected'; }; ?> value="Banco ProCredit">Banco ProCredit</option>
										<option <?php if($banco_banco=='Banco Pichincha'){ echo 'selected'; }; ?> value="Banco Pichincha">Banco Pichincha</option>
										<option <?php if($banco_banco=='Bancoomeva'){ echo 'selected'; }; ?> value="Bancoomeva">Bancoomeva</option>
										<option <?php if($banco_banco=='Banco Finandina'){ echo 'selected'; }; ?> value="Banco Finandina">Banco Finandina</option>
										<option <?php if($banco_banco=='Banco CoopCentral'){ echo 'selected'; }; ?> value="Banco CoopCentral">Banco CoopCentral</option>
										<option <?php if($banco_banco=='Compensar'){ echo 'selected'; }; ?> value="Compensar">Compensar</option>
										<option <?php if($banco_banco=='Aportes en linea'){ echo 'selected'; }; ?> value="Aportes en linea">Aportes en linea</option>
										<option <?php if($banco_banco=='Asopagos'){ echo 'selected'; }; ?> value="Asopagos">Asopagos</option>
										<option <?php if($banco_banco=='Fedecajas'){ echo 'selected'; }; ?> value="Fedecajas">Fedecajas</option>
										<option <?php if($banco_banco=='Simple'){ echo 'selected'; }; ?> value="Simple">Simple</option>
										<option <?php if($banco_banco=='Enlace Operativo'){ echo 'selected'; }; ?> value="Enlace Operativo">Enlace Operativo</option>
										<option <?php if($banco_banco=='CorfiColombiana'){ echo 'selected'; }; ?> value="CorfiColombiana">CorfiColombiana</option>
										<option <?php if($banco_banco=='Old Mutual'){ echo 'selected'; }; ?> value="Old Mutual">Old Mutual</option>
										<option <?php if($banco_banco=='Cotrafa'){ echo 'selected'; }; ?> value="Cotrafa">Cotrafa</option>
										<option <?php if($banco_banco=='Confiar'){ echo 'selected'; }; ?> value="Confiar">Confiar</option>
										<option <?php if($banco_banco=='JurisCoop'){ echo 'selected'; }; ?> value="JurisCoop">JurisCoop</option>
										<option <?php if($banco_banco=='Deceval'){ echo 'selected'; }; ?> value="Deceval">Deceval</option>
										<option <?php if($banco_banco=='Bancamia'){ echo 'selected'; }; ?> value="Bancamia">Bancamia</option>
										<option <?php if($banco_banco=='Nequi'){ echo 'selected'; }; ?> value="Nequi">Nequi</option>
										<option <?php if($banco_banco=='Falabella'){ echo 'selected'; }; ?> value="Falabella">Falabella</option>
										<option <?php if($banco_banco=='DGCPTN'){ echo 'selected'; }; ?> value="DGCPTN">DGCPTN</option>
										<option <?php if($banco_banco=='BANCO WWB'){ echo 'selected'; }; ?> value="BANCO WWB">BANCO WWB</option>
										<option <?php if($banco_banco=='Cooperativa Financiera de Antioquia'){ echo 'selected'; }; ?> value="Cooperativa Financiera de Antioquia">Cooperativa Financiera de Antioquia</option>
									</select>
                                </div>
                                <div class="col-12 mt-3" id="div_prestada" style="<?php if($bcpp!='Prestada'){ echo 'display: none;'; }; ?>">
                                	<div class="row">
                                		<div class="col-12 text-center">
		                                	<label form="banco_foto_prestada">Foto cuenta prestada </label>
		                                </div>
		                                <?php if($imagen==''){
		                                	echo '
		                                		<div class="col-12">
		                                    		<input type="file" class="form-control droparea" id="banco_foto_prestada" name="banco_foto_prestada">
												</div>
												<div class="col-12 text-center">
		                                    		<small style="font-weight: bold; color:red;">Solo se aceptan formato PNG y JPG</small>
		                                		</div>
		                                	';
		                                }else{
		                                	echo '
		                                		<div class="col-12 text-center">
		                                			<input type="hidden" id="banco_foto_prestada" name="banco_foto_prestada" value="">
		                                    		<img src="../resources/contenidos/modelos/'.$id.'/'.$imagen.'" class="img-fluid" style="max-width:200px;">
												</div>
		                                	';
		                                }?>
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
		var banco_cpp = $('#banco_cpp').val();
		
		if(banco_cpp=='Prestada'){
			var banco_foto_prestada = $('#banco_foto_prestada').val();
		}else{
			var banco_foto_prestada = "";
		}

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
