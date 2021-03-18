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
	<link rel="stylesheet" href="../css/index.css">
	<link rel="stylesheet" href="../css/validaciones.css">
	<link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
	<link href="../resources/fontawesome/css/all.css" rel="stylesheet">
	<link href="../resources/lightbox/dist/css/lightbox.css" rel="stylesheet">
	<title>Camaleon Sistem</title>
</head>
<body>

<style type="text/css">
	.active1{
		background-color: #fff;
    	border-color: #dee2e6 #dee2e6 #fff;
    	color: black !important;
	}

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
  		background-image: url("../img/FONDO APP.png");
  	}

  	.btn-info{
  		background-color: #A9814F !important;
  		border-color: #A9814F !important;
  	}

  	.btn-primary{
  		background-color: #A9814F !important;
  		border-color: #A9814F !important;
  	}

  	.btn-success{
  		background-color: #A9814F !important;
  		border-color: #A9814F !important;
  	}

  	.botones_navbar1{
		color: white !important;
		text-transform: uppercase;
	}
</style>

	<?php
	include('../script/conexion.php');
	$usuario = $_SESSION["usuario"];
	$ubicacion = "perfil";
	$consulta1 = "SELECT * FROM cargos WHERE id = ".$_SESSION['rol']." LIMIT 1";
	$resultado1 = mysqli_query( $conexion, $consulta1 );
	while($row1 = mysqli_fetch_array($resultado1)) {
		$usuario_rol = $row1['nombre'];
	}
	$sql1 = "SELECT * FROM nomina WHERE documento_numero = '".$_SESSION["documento_numero"]."' LIMIT 1";
	$consulta1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($consulta1);
	if($contador1>=1){
		while($row = mysqli_fetch_array($consulta1)) {
			/**************PERSONAL******************/
			$id=$row['id'];
			$documento_tipo=$row['documento_tipo'];
			$documento_numero=$row['documento_numero'];
			$nombre=$row['nombre'];
			$apellido=$row['apellido'];
			$correo=$row['correo'];
			$direccion=$row['direccion'];
			$telefono=$row['telefono'];
			$fecha_inicio=$row['fecha_inicio'];
			/****************************************/
			
			/***********BANCARIO*******************/
			$banco_cedula=$row['banco_cedula'];
			$banco_nombre=$row['banco_nombre'];
			$banco_tipo=$row['banco_tipo'];
			$banco_numero=$row['banco_numero'];
			$banco_banco=$row['banco_banco'];
			$bcpp=$row['BCPP'];
			/**************************************/
			
			/********EMPRESA**************/
			$turno=$row['turno'];
			$sede=$row['sede'];
			$cargo=$row['cargo'];
			$salario=$row['salario'];
			$fecha_nacimiento=$row['fecha_nacimiento'];
			$fecha_ingreso=$row['fecha_ingreso'];
			/*****************************/
		}
	}
	?>

	<?php include('nabvar.php'); ?>

	<div class="container">
		<ul class="nav nav-tabs mb-2">
			<li class="nav-item">
				<a class="nav-link active1" href="#" id="Dpersonales" onclick="pestañas(this.id);" style="color:white; text-transform: uppercase;">Personales</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#" id="Dbancarios" onclick="pestañas(this.id);" style="color:white; text-transform: uppercase;">Bancarios</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#" id="Ddocumentos" onclick="pestañas(this.id);" style="color:white; text-transform: uppercase;">Documentos</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#" id="Dpagos" onclick="pestañas(this.id);" style="color:white; text-transform: uppercase;">Pagos</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#" id="Dcontrato" onclick="pestañas(this.id);" style="color:white; text-transform: uppercase;">Contrato</a>
			</li>
		</ul>

	<!--***********************************************************-->
	<!--**********************DATOS PERSONALES*********************-->
	<!--***********************************************************-->
	<form class="" action="#" method="POST" id="formulario1">
		<input type="hidden" id="asunto" name="asunto" value="personales">
		<input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
		<input type="hidden" id="f1_genero" name="f1_genero" value="<?php echo $genero; ?>">
		<div class="row">
			<div class="col-6 form-group form-check">
				<label for="tipo_documento">Tipo de Documento</label>
				<input type="text" id="tipo_documento" name="tipo_documento" class="form-control" value="<?php echo $documento_tipo; ?>" disabled>
			</div>
			<div class="col-6 form-group form-check">
				<label for="numero_documento">Número de Documento</label>
				<input type="text" name="numero_documento" id="numero_documento" class="form-control" value="<?php echo $documento_numero; ?>" disabled>
			</div>
		</div>

		<div class="row">
			<div class="col-6 form-group form-check">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre; ?>" disabled>
			</div>
			<div class="col-6 form-group form-check">
				<label for="apellido">Apellido</label>
				<input type="text" name="apellido" id="apellido" value="<?php echo $apellido; ?>" class="form-control" disabled>
			</div>
		</div>

		<div class="row">
			<div class="col-6 form-group form-check">
				<label for="correo">Correo</label>
				<input type="email" name="correo" id="correo" class="form-control" value="<?php echo $correo; ?>" disabled>
			</div>
			<div class="col-6 form-group form-check">
				<label for="telefono">Teléfono</label>
				<input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo $telefono; ?>" disabled>
			</div>

			<div class="col-6 form-group form-check">
				<label for="fecha_nacimiento">Fecha Nacimiento</label>
				<input type="text" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="<?php echo $fecha_nacimiento; ?>" disabled>
			</div>
			<div class="col-6 form-group form-check">
				<label for="salario">Salario Actual</label>
				<input type="text" name="salario" id="salario" class="form-control" value="<?php echo $salario; ?>" disabled>
			</div>
			<div class="col-6 form-group form-check">
				<label for="fecha_ingreso">Fecha de Ingreso</label>
				<input type="text" name="fecha_ingreso" id="fecha_ingreso" class="form-control" value="<?php echo $fecha_ingreso; ?>" disabled>
			</div>
			<div class="col-6 form-group form-check">
				<label for="direccion">Dirección</label>
				<input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo $direccion; ?>" disabled>
			</div>
		</div>
	</form>

	<!--***********************************************************-->
	<!--***********************************************************-->

	<!--***********************************************************-->
	<!--**********************DATOS BANCARIOS*********************-->
	<!--***********************************************************-->
	<form class="d-none" action="#" method="POST" id="formulario2">
		<input type="hidden" id="asunto" name="asunto" value="bancarios">
		<input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
		
		<div class="row">
			<div class="col-6 form-group form-check">
				<label for="enlazar">Cuenta Propia o Prestada?</label>
				<select name="BCPP" class="form-control" id="BCPP" required>
					<?php
					if($bcpp==''){ ?>
						<option value="">Seleccione</option>
						<option value="Propia">Propia</option>
						<option value="Prestada">Prestada</option>
					<?php }else{ ?>
						<option value="">Seleccione</option>
						<option value="Propia" <?php if($bcpp=='Propia'){ echo 'selected'; } ?>>Propia</option>
						<option value="Prestada" <?php if($bcpp=='Prestada'){ echo 'selected'; } ?>>Prestada</option>
					<?php } ?>
				</select>
			</div>
			<div class="col-6 form-group form-check">
				<label for="banco_cedula">Cédula del titular</label>
				<input type="text" name="banco_cedula" id="banco_cedula" <?php if($banco_cedula!=''){?> value="<?php echo $banco_cedula; ?>" <?php } ?> class="form-control" autocomplete="off" required>
			</div>
			<div class="col-6 form-group form-check">
				<label for="banco_nombre">Nombre Titular</label>
				<input type="text" name="banco_nombre" id="banco_nombre" <?php if($banco_nombre!=''){?> value="<?php echo $banco_nombre; ?>" <?php } ?> class="form-control" autocomplete="off" required>
			</div>
			<div class="col-6 form-group form-check">
				<label for="banco_tipo">Tipo de Cuenta</label>
				<select name="banco_tipo" class="form-control" id="banco_tipo" required>
					<?php
					if($banco_tipo==''){ ?>
						<option value="">Seleccione</option>
						<option value="Ahorro">Ahorro</option>
						<option value="Corriente">Corriente</option>
					<?php }else{ ?>
						<option value="">Seleccione</option>
						<option value="Ahorro" <?php if($banco_tipo=='Ahorro'){ echo 'selected'; } ?>>Ahorro</option>
						<option value="Corriente" <?php if($banco_tipo=='Corriente'){ echo 'selected'; } ?>>Corriente</option>
					<?php } ?>
				</select>
			</div>
			<div class="col-6 form-group form-check">
				<label for="banco_numero">N° de Cuenta</label>
				<input type="text" name="banco_numero" id="banco_numero" <?php if($banco_numero!=''){ ?> value="<?php echo $banco_numero; ?>" <?php } ?> class="form-control" autocomplete="off" required>
			</div>

			<div class="col-6 form-group form-check">
				<label for="banco_banco">Banco</label>
				<select name="banco_banco" class="form-control" id="banco_banco" required>
					<?php
					if($banco_tipo!=''){ ?>
						<option value="<?php echo $banco_tipo;?>" selected><?php echo $banco_tipo;?></option>
					<?php } ?>
					<option value="">Seleccione</option>
					<option value="Banco Agrario de Colombia">Banco Agrario de Colombia</option>
					<option value="Banco AV Villas">Banco AV Villas</option>
					<option value="Banco Caja Social">Banco Caja Social</option>
					<option value="Banco de Occidente (Colombia)">Banco de Occidente (Colombia)</option>
					<option value="Banco Popular (Colombia)">Banco Popular (Colombia)</option>
					<option value="Bancolombia">Bancolombia</option>
					<option value="BBVA Colombia">BBVA Colombia</option>
					<option value="BBVA Movil">BBVA Movil</option>
					<option value="Banco de Bogotá">Banco de Bogotá</option>
					<option value="Colpatria">Colpatria</option>
					<option value="Davivienda">Davivienda</option>
					<option value="ITAU CorpBanca">ITAU CorpBanca</option>
					<option value="Citibank">Citibank</option>
					<option value="GNB Sudameris">GNB Sudameris</option>
					<option value="ITAU">ITAU</option>
					<option value="Scotiabank">Scotiabank</option>
					<option value="Bancoldex">Bancoldex</option>
					<option value="JPMorgan">JPMorgan</option>
					<option value="BNP Paribas">BNP Paribas</option>
					<option value="Banco ProCredit">Banco ProCredit</option>
					<option value="Banco Pichincha">Banco Pichincha</option>
					<option value="Bancoomeva">Bancoomeva</option>
					<option value="Banco Finandina">Banco Finandina</option>
					<option value="Banco CoopCentral">Banco CoopCentral</option>
					<option value="Compensar">Compensar</option>
					<option value="Aportes en linea">Aportes en linea</option>
					<option value="Asopagos">Asopagos</option>
					<option value="Fedecajas">Fedecajas</option>
					<option value="Simple">Simple</option>
					<option value="Enlace Operativo">Enlace Operativo</option>
					<option value="CorfiColombiana">CorfiColombiana</option>
					<option value="Old Mutual">Old Mutual</option>
					<option value="Cotrafa">Cotrafa</option>
					<option value="Confiar">Confiar</option>
					<option value="JurisCoop">JurisCoop</option>
					<option value="Deceval">Deceval</option>
					<option value="Bancamia">Bancamia</option>
					<option value="Nequi">Nequi</option>
					<option value="Falabella">Falabella</option>
					<option value="DGCPTN">DGCPTN</option>
					<option value="BANCO WWB">BANCO WWB</option>
					<option value="Cooperativa Financiera de Antioquia">Cooperativa Financiera de Antioquia</option>
				</select>
			</div>

		</div>

		<div class="row">
			<div class="col-md-12 form-group form-check text-center">
				<button type="submit" id="submit" class="btn btn-success" style="width: 20%; font-weight: bold;">Actualizar</button>
			</div>
		</div>
	</form>
	<!--***********************************************************-->
	<!--***********************************************************-->

	<!--***********************************************************-->
	<!--**********************DOCUMENTOS*********************-->
	<!--***********************************************************-->
	<div id="formulario5" class="d-none">
		<div class="col-12 text-center mt-3 mb-3" style="font-weight: bold; font-size: 20px; text-transform: capitalize; color: #A9814F;">
			Se sube 1 documento a la vez, por favor darle clic al correspondiente boton de "Subir"
		</div>
		<input type="hidden" id="asunto" name="asunto" value="documentos">
		<input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
		<?php
		$sql3 = "SELECT * FROM n_archivos WHERE id_nomina = ".$id;
		$consulta3 = mysqli_query($conexion,$sql3);
		$contador3 = mysqli_num_rows($consulta3);

		$html_seguridad_social='';
		$html_eps='';
		$html_fondo_de_pension='';
		$html_arl='';
		$html_antecedentes_penales='';
		$html_hoja_de_vida='';

		if($contador3>=1){
			while($row3 = mysqli_fetch_array($consulta3)) {
				$id_documento = $row3['id'];
				$sql4 = "SELECT * FROM n_documentos WHERE id_documento =".$id_documento;
				$consulta4 = mysqli_query($conexion,$sql4);
				while($row4 = mysqli_fetch_array($consulta4)) {
					$nombre_documento = $row4['nombre'];

					switch ($nombre_documento) {
						case 'Seguridad Social':
							$html_seguridad_social = '
								<form id="form_pasaporte" enctype="multipart/form-data" method="POST">
									<div class="row">
										<div class="col-12 form-group form-check text-center">
											<label for="turno">Pasaporte (Subida Actualmente)</label>
											<p>	<embed src="../resources/documentos/nomina/archivos/'.$id.'/seguridad_social.pdf#toolbar=0" type="application/pdf" width="100%" height="400px" /></p>
										</div>
									</div>
								</form>
								<hr style="background-color: white;">
							';
						break;

						case 'EPS':
							$html_eps = '
								<form id="form_rut" enctype="multipart/form-data" method="POST">
									<div class="row">
										<div class="col-12 form-group form-check text-center">
											<label for="turno">RUT (Subida Actualmente)</label>
											<p><embed src="../resources/documentos/nomina/archivos/'.$id.'/eps.pdf#toolbar=0" type="application/pdf" width="100%" height="400px" /></p>
										</div>
									</div>
								</form>
								<hr style="background-color: white;">
							';
						break;

						case 'EPS':
							$html_fondo_de_pension = '
								<form id="form_rut" enctype="multipart/form-data" method="POST">
									<div class="row">
										<div class="col-12 form-group form-check text-center">
											<label for="turno">RUT (Subida Actualmente)</label>
											<p><embed src="../resources/documentos/nomina/archivos/'.$id.'/fondo_de_pension.pdf#toolbar=0" type="application/pdf" width="100%" height="400px" /></p>
										</div>
									</div>
								</form>
								<hr style="background-color: white;">
							';
						break;

						case 'EPS':
							$html_arl = '
								<form id="form_rut" enctype="multipart/form-data" method="POST">
									<div class="row">
										<div class="col-12 form-group form-check text-center">
											<label for="turno">RUT (Subida Actualmente)</label>
											<p><embed src="../resources/documentos/nomina/archivos/'.$id.'/arl.pdf#toolbar=0" type="application/pdf" width="100%" height="400px" /></p>
										</div>
									</div>
								</form>
								<hr style="background-color: white;">
							';
						break;

						case 'EPS':
							$html_antecedentes_penales = '
								<form id="form_rut" enctype="multipart/form-data" method="POST">
									<div class="row">
										<div class="col-12 form-group form-check text-center">
											<label for="turno">RUT (Subida Actualmente)</label>
											<p><embed src="../resources/documentos/nomina/archivos/'.$id.'/antecedentes_penales.pdf#toolbar=0" type="application/pdf" width="100%" height="400px" /></p>
										</div>
									</div>
								</form>
								<hr style="background-color: white;">
							';
						break;

						case 'EPS':
							$html_hoja_de_vida = '
								<form id="form_rut" enctype="multipart/form-data" method="POST">
									<div class="row">
										<div class="col-12 form-group form-check text-center">
											<label for="turno">RUT (Subida Actualmente)</label>
											<p><embed src="../resources/documentos/nomina/archivos/'.$id.'/hoja_de_vida.pdf#toolbar=0" type="application/pdf" width="100%" height="400px" /></p>
										</div>
									</div>
								</form>
								<hr style="background-color: white;">
							';
						break;
						
						default:
							# code...
							break;
					}
				}
			}
		}
		if($html_seguridad_social==''){
			echo '
			<form id="form_seguridad_social" enctype="multipart/form-data" method="POST">
				<div class="row mt-3 mb-3">
					<div class="col-12 form-group form-check">
						<button type="submit" class="btn btn-success" id="submit_seguridad_social" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
						<label for="seguridad_social">Seguridad Social</label>
						<input type="file" style="height:43px;" class="form-control" name="seguridad_social" id="seguridad_social" required>
					</div>
				</div>
			</form>
			<hr style="background-color: white;">
			';
		}else{
			echo $html_seguridad_social;
		}
		if($html_eps==''){
			echo '
			<form id="form_eps" enctype="multipart/form-data" method="POST">
				<div class="row mt-3 mb-3">
					<div class="col-12 form-group form-check">
						<button type="submit" class="btn btn-success" id="submit_eps" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
						<label for="eps">EPS</label>
						<input type="file" style="height:43px;" class="form-control" name="eps" id="eps" required>
					</div>
				</div>
			</form>
			<hr style="background-color: white;">
			';
		}else{
			echo $html_eps;
		}
		if($html_fondo_de_pension==''){
			echo '
			<form id="form_fondo_de_pension" enctype="multipart/form-data" method="POST">
				<div class="row mt-3 mb-3">
					<div class="col-12 form-group form-check">
						<button type="submit" class="btn btn-success" id="submit_fondo_de_pension" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
						<label for="turno">Fonde de Pensión</label>
						<input type="file" style="height:43px;" class="form-control" name="fondo_de_pension" id="fondo_de_pension" required>
					</div>
				</div>
			</form>
			<hr style="background-color: white;">
			';
		}else{
			echo $html_fondo_de_pension;
		}
		if($html_arl==''){
			echo '
			<form id="form_eps" enctype="multipart/form-data" method="POST">
				<div class="row mt-3 mb-3">
					<div class="col-12 form-group form-check">
						<button type="submit" class="btn btn-success" id="submit_eps" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
						<label for="turno">ARL</label>
						<input type="file" style="height:43px;" class="form-control" name="arl" id="arl" required>
					</div>
				</div>
			</form>
			<hr style="background-color: white;">
			';
		}else{
			echo $html_arl;
		}
		if($html_antecedentes_penales==''){
			echo '
			<form id="form_antecedentes_penales" enctype="multipart/form-data" method="POST">
				<div class="row mt-3 mb-3">
					<div class="col-12 form-group form-check">
						<button type="submit" class="btn btn-success" id="submit_antecedentes_penales" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
						<label for="turno">Antecedentes Penales</label>
						<input type="file" style="height:43px;" class="form-control" name="antecedentes_penales" id="antecedentes_penales" required>
					</div>
				</div>
			</form>
			<hr style="background-color: white;">
			';
		}else{
			echo $html_antecedentes_penales;
		}
		if($html_hoja_de_vida==''){
			echo '
			<form id="form_hoja_de_vida" enctype="multipart/form-data" method="POST">
				<div class="row mt-3 mb-3">
					<div class="col-12 form-group form-check">
						<button type="submit" class="btn btn-success" id="submit_hoja_de_vida" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
						<label for="turno">Hoja de Vida</label>
						<input type="file" style="height:43px;" class="form-control" name="hoja_de_vida" id="hoja_de_vida" required>
					</div>
				</div>
			</form>
			';
		}else{
			echo $html_hoja_de_vida;
		}
		?>
	</form>
	</div>
	<!--***********************************************************-->
	<!--***********************************************************-->


	<!--***********************************************************-->
	<!--**********************DOCUMENTOS*********************-->
	<!--***********************************************************-->
	<form class="d-none" action="#" method="POST" id="formulario6">
		<input type="hidden" id="asunto" name="asunto" value="contrato">
		<input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
		<div class="row">
			
			<div class="col-12 form-group form-check text-center mt-3">
				<input type="button" class="btn btn-info" id="botonContratover1" name="botonContratover1" value="Ver Contrato (Primera Opción)" onclick="vercontrato1();">
				<input type="hidden" name="hidden_vercontrato1" id="hidden_vercontrato1" value="No">
			</div>

			<div class="col-12 form-group form-check text-center mt-3">
				<a href="../script/generador_modelo_contrato1.php#toolbar=0" target="_blank">
					<button type="button" class="btn btn-info">Ver Contrato (Segunda Opción)</button>
				</a>
			</div>

			<div class="col-12 form-group form-check text-center" id="seccion_contrato1" style="display: none;">
				<label>Contrato Actualizado</label>
				<embed src="../script/generador_modelo_contrato1.php#toolbar=0" type="application/pdf" width="100%" height="600px" />
			</div>
				
			<div class="col-12 form-group form-check text-center mt-3">
				<?php
				$sql2 = "SELECT * FROM modelos_documentos WHERE id_documentos = 1 and id_modelos = ".$id;
				$consulta2 = mysqli_query($conexion,$sql2);
				$contador2 = mysqli_num_rows($consulta2);
				if($contador2==0){ ?>
				<hr style="background-color: white;">
				<form id="form_certificacion_bancaria" enctype="multipart/form-data" method="POST">
					<div class="row mt-3">
						<div class="col-12 form-group form-check">
							<p for="turno" style="font-size: 22px; text-transform: capitalize;">No cuenta aún con una firma en el contrato</p>
							<p>
								<a href="../script/generador_firmas1.php" target="_blank">
									<button type="button" class="btn btn-danger">Generar Firma Digital</button>
								</a>
							</p>
							<hr style="background-color: white;">
							<button type="submit" class="btn btn-success" id="submit_firma_digital" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
							<label for="turno">Firma Contrato de Prestación</label>
							<input type="file" style="height:43px;" class="form-control" name="firma_digital" id="firma_digital" required>
						</div>
					</div>
				</form>
				<hr style="background-color: white;">
				<?php
				}else{
					while($row2 = mysqli_fetch_array($consulta2)) {
						$sql_documentos_id = $row2['id'];
						$sql_documentos_id_documentos = $row2['id_documentos'];
						$sql_documentos_id_modelos = $row2['id_modelos'];
						$sql_documentos_fecha_inicio = $row2['fecha_inicio'];
					}
					echo '<p for="turno" style="font-size: 22px; text-transform: capitalize;">Ya Tiene una Firma Registrada!</p>';
				}
				?>
			</div>
		</div>
	</form>
	<!--***********************************************************-->
	<!--***********************************************************-->


	<!--***********************************************************-->
	<!--**********************CUENTAS*********************-->
	<!--***********************************************************-->
	<form class="d-none" action="#" method="POST" id="formulario7">
		<input type="hidden" id="asunto" name="asunto" value="contrato">
		<input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
		<div class="row">
				<?php
				$sql5 = "SELECT * FROM modelos_cuentas WHERE id_modelos = ".$id;
				$consulta5 = mysqli_query($conexion,$sql5);
				$contador4 = mysqli_num_rows($consulta5);
				if($contador4>=1){
					while($row5 = mysqli_fetch_array($consulta5)) {
						$id_modelos_cuentas_id = $row5['id'];
						$id_modelos_cuentas_id_paginas = $row5['id_paginas'];
						$id_modelos_cuentas_usuario = $row5['usuario'];
						$id_modelos_cuentas_clave = $row5['clave'];
						$id_modelos_cuentas_correo = $row5['correo'];
						$id_modelos_cuentas_link = $row5['link'];
						$id_modelos_cuentas_estatus = $row5['estatus'];
						$id_modelos_cuentas_fecha_inicio = $row5['fecha_inicio'];

						$sql6 = "SELECT * FROM paginas WHERE id = ".$id_modelos_cuentas_id_paginas;
						$consulta6 = mysqli_query($conexion,$sql6);
						while($row6 = mysqli_fetch_array($consulta6)) {
							$paginas_nombre = $row6['nombre'];
						}

						if($id_modelos_cuentas_estatus=='Aprobada'){
							echo '
								<div class="col-3 form-group form-check text-center mt-3">
									<button type="button" class="btn btn-success" id="'.$id_modelos_cuentas_id.'" onclick="mostrar1(this.id);">'.$id_modelos_cuentas_estatus.' ('.$paginas_nombre.')</button>
								</div>
							';
						}else{
							echo '
								<div class="col-3 form-group form-check text-center mt-3">
									<button type="button" class="btn btn-info" id="'.$id_modelos_cuentas_id.'" onclick="mostrar1(this.id);">'.$id_modelos_cuentas_estatus.' ('.$paginas_nombre.')</button>
								</div>
							';
						}

					}

					echo '<div class="col-12 text-center" id="div_hidden1" style="display:none;">&nbsp;</div>';

				}else{
					echo '
							<div class="col-12 form-group form-check text-center mt-3">No Tiene Cuentas Activas</div>
						';
				}
				?>
		</div>
	</form>
	<!--***********************************************************-->
	<!--***********************************************************-->


	<!--***********************************************************-->
	<!--**********************FOTOS*********************-->
	<!--***********************************************************-->
	<form class="d-none" action="#" method="POST" id="formulario8">
		<div class="row">
				<?php
				$sql7 = "SELECT * FROM modelos_documentos WHERE id_documentos = 13 and id_modelos = ".$id;
				$consulta7 = mysqli_query($conexion,$sql7);
				$contador5 = mysqli_num_rows($consulta7);
				$html_fotos_sensuales = '';
				if($contador5>=1){
					$html_fotos_sensuales = '
						<div class="col-12 text-center mt-3" style="font-weight:bold; font-size: 20px;">Fotos Sensuales</div>
					';
					while($row7 = mysqli_fetch_array($consulta7)) {
						$documentos2_id = $row7['id'];
						$documentos2_id_modelos = $row7['id_modelos'];
						$documentos2_tipo = $row7['tipo'];
						$documentos2_fecha_inicio = $row7['fecha_inicio'];

						$html_fotos_sensuales.='
							<div class="col-12 form-group text-center mt-3">
								<img src="../resources/documentos/nomina/archivos/'.$id.'/sensuales_'.$documentos2_id.'.jpg" style="width:400px; border-radius:1rem;">
							</div>
						';
					}
				}else{
					$html_fotos_sensuales.='
							<div class="col-12 form-group form-check text-center mt-3">No Tiene Fotos Sensuales Actualmente</div>
							<div class="col-12 form-group form-check text-center mt-3">
								<button type="button" class="btn btn-info" id="'.$id.'" data-toggle="modal" data-target="#Modal_fotos_sensuales1">Subir Fotos</button>
							</div>
						';
				}
				echo $html_fotos_sensuales;
				?>
		</div>
	</form>
	<!--***********************************************************-->
	<!--***********************************************************-->

	<!--***********************************************************-->
	<!--**********************PAGOS*********************-->
	<!--***********************************************************-->
	<form class="d-none" action="#" method="POST" id="formulario9">
		<div class="row">
				<?php
				$sql8 = "SELECT * FROM modelos WHERE id = ".$id;
				$consulta8 = mysqli_query($conexion,$sql8);
				while($row8 = mysqli_fetch_array($consulta8)) {
					$modelo_estatus = $row8['estatus'];
				}

				if($modelo_estatus=='Activa'){
					$sql7 = "SELECT * FROM presabana WHERE id_modelo = ".$id." and estatus = 'Activa' GROUP BY inicio";
					$consulta7 = mysqli_query($conexion,$sql7);
					$contador6 = mysqli_num_rows($consulta7);
					$html_presabana = '';
						$html_presabana = '
							<!--<div class="col-12 text-center mt-3" style="font-weight:bold; font-size: 20px;">Desprendibles de Pagos</div>-->
						';
						while($row7 = mysqli_fetch_array($consulta7)) {
							$documentos2_id = $row7['id'];
							$dinero = $row7['total_dolares'];
							$presabana_desde = $row7['inicio'];
							$presabana_hasta = $row7['fin'];
							$id_modelo_especial = $row7['id_modelo'];

							if($dinero>=1){
								if($id_modelo_especial==908 and $presabana_desde=='2021-02-01'){
									$html_presabana .= '';
								}else{
									$html_presabana.='
										<div class="col-12 text-center form-group mt-3">
											<span style="font-size: 20px; font-weight: bold;">Desprendible desde '.$presabana_desde.' hasta '.$presabana_hasta.'</span>
											<br>
											<a href="../script/generar_desprendible2.php?id='.$id.'&pre='.$documentos2_id.'" target="_blank" style="color: white; text-decoration: none;">
												<button type="button" class="btn btn-success mt-3">Descargar</button>
											</a>
											<hr style="background-color: white;">
										</div>
									';
								}
							}else{
								$html_presabana.='
									<div class="col-12 form-group form-check text-center mt-3">No Tienes Pagos Efectuados</div>
								';
							}
						}
					echo $html_presabana;
				}else{
					echo '
						<div class="col-12 form-group form-check text-center mt-3">No tienes desprendibles activos en el sistema</div>
					';
				}
				?>
		</div>
	</form>
	<!--***********************************************************-->
	<!--***********************************************************-->



	<!-- Modal Fotos Sensuales 1 -->
	<div class="modal fade" id="Modal_fotos_sensuales1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color:black;">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_fotos_sensuales1" style="">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Agregar Fotos Sensuales</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<input type="hidden" name="hidden_id_modelo" id="hidden_id_modelo" value="<?php echo $id; ?>">

							<div class="col-12 form-group">
						     	<hr style="background-color: red;">
						     	<p style="font-weight: bold; font-size: 20px; text-transform: capitalize; text-align: center;">Reglamento para cada foto</p>
						     	<p><span style="font-weight: bold;">1._</span> No se permiten fotos explicitas</p>
						     	<p><span style="font-weight: bold;">2._</span> Mostrar la cara</p>
						     	<p><span style="font-weight: bold;">3._</span> No se permiten fotos frente al espejo</p>
						     	<p><span style="font-weight: bold;">4._</span> Al menos una foto Horizontal</p>
						     	<p><span style="font-weight: bold;">5._</span> Al menos una foto Vertical</p>
						     	<p><span style="font-weight: bold;">6._</span> Subir como mínimo 3 fotos y máximo 5</p>
							    <hr style="background-color: red;">
							</div>

						    <div class="col-12 form-group form-check">
						     	<label for="foto_sensual_1">Foto #1</label>
							    <input type="file" style="height:43px;" class="form-control" name="foto_sensual_1" id="foto_sensual_1" required>
							</div>

							<div class="col-12 form-group form-check">
						     	<label for="foto_sensual_2">Foto #2</label>
							    <input type="file" style="height:43px;" class="form-control" name="foto_sensual_2" id="foto_sensual_2" required>
							</div>

							<div class="col-12 form-group form-check">
						     	<label for="foto_sensual_3">Foto #3</label>
							    <input type="file" style="height:43px;" class="form-control" name="foto_sensual_3" id="foto_sensual_3" required>
							</div>

							<div class="col-12 form-group form-check">
						     	<label for="foto_sensual_4">Foto #4</label>
							    <input type="file" style="height:43px;" class="form-control" name="foto_sensual_4" id="foto_sensual_4">
							</div>

							<div class="col-12 form-group form-check">
						     	<label for="foto_sensual_5">Foto #5</label>
							    <input type="file" style="height:43px;" class="form-control" name="foto_sensual_5" id="foto_sensual_5">
							</div>
						</div>
					</div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="submit_Modal_fotos2">Cerrar</button>
				        <button type="submit" id="submit_fotos_sensuales1" class="btn btn-success">Subir Fotos</button>
			      	</div>
		      	</form>
	    	</div>
	  	</div>
	</div>
<!-- FIN Modal Fotos 2 -->
</div>

<script src="../js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../js/popper.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="../resources/lightbox/dist/js/lightbox.js"></script>

<script type="text/javascript">
	function pestañas(variable){
		switch (variable) {
			case 'Dpersonales':
				$('#Dpersonales').addClass('active1');
				$('#Dpersonales').removeClass('d-none');
				$('#Dbancarios').removeClass('active1');
				$('#Dcorporales').removeClass('active1');
				$('#Dempresa').removeClass('active1');
				$('#Ddocumentos').removeClass('active1');
				$('#Dcontrato').removeClass('active1');
				$('#Dcuentas').removeClass('active1');
				$('#Dfotos').removeClass('active1');
				$('#Dpagos').removeClass('active1');
				
				$('#formulario1').removeClass('d-none');
				$('#formulario2').addClass('d-none');
				$('#formulario3').addClass('d-none');
				$('#formulario4').addClass('d-none');
				$('#formulario5').addClass('d-none');
				$('#formulario6').addClass('d-none');
				$('#formulario7').addClass('d-none');
				$('#formulario8').addClass('d-none');
				$('#formulario9').addClass('d-none');
			break;

			case 'Dbancarios':
				$('#Dbancarios').addClass('active1');
				$('#Dbancarios').removeClass('d-none');
				$('#Dpersonales').removeClass('active1');
				$('#Dcorporales').removeClass('active1');
				$('#Dempresa').removeClass('active1');
				$('#Ddocumentos').removeClass('active1');
				$('#Dcontrato').removeClass('active1');
				$('#Dcuentas').removeClass('active1');
				$('#Dfotos').removeClass('active1');
				$('#Dpagos').removeClass('active1');
				
				$('#formulario1').addClass('d-none');
				$('#formulario2').removeClass('d-none');
				$('#formulario3').addClass('d-none');
				$('#formulario4').addClass('d-none');
				$('#formulario5').addClass('d-none');
				$('#formulario6').addClass('d-none');
				$('#formulario7').addClass('d-none');
				$('#formulario8').addClass('d-none');
				$('#formulario9').addClass('d-none');
			break;

			case 'Dcorporales':
				$('#Dcorporales').addClass('active1');
				$('#Dcorporales').removeClass('d-none');
				$('#Dbancarios').removeClass('active1');
				$('#Dpersonales').removeClass('active1');
				$('#Dempresa').removeClass('active1');
				$('#Ddocumentos').removeClass('active1');
				$('#Dcontrato').removeClass('active1');
				$('#Dcuentas').removeClass('active1');
				$('#Dfotos').removeClass('active1');
				$('#Dpagos').removeClass('active1');
				
				$('#formulario1').addClass('d-none');
				$('#formulario2').addClass('d-none');
				$('#formulario3').removeClass('d-none');
				$('#formulario4').addClass('d-none');
				$('#formulario5').addClass('d-none');
				$('#formulario6').addClass('d-none');
				$('#formulario7').addClass('d-none');
				$('#formulario8').addClass('d-none');
				$('#formulario9').addClass('d-none');
			break;

			case 'Dempresa':
				$('#Dempresa').addClass('active1');
				$('#Dempresa').removeClass('d-none');
				$('#Dbancarios').removeClass('active1');
				$('#Dcorporales').removeClass('active1');
				$('#Dpersonales').removeClass('active1');
				$('#Ddocumentos').removeClass('active1');
				$('#Dcontrato').removeClass('active1');
				$('#Dcuentas').removeClass('active1');
				$('#Dfotos').removeClass('active1');
				$('#Dpagos').removeClass('active1');
				
				$('#formulario1').addClass('d-none');
				$('#formulario2').addClass('d-none');
				$('#formulario3').addClass('d-none');
				$('#formulario4').removeClass('d-none');
				$('#formulario5').addClass('d-none');
				$('#formulario6').addClass('d-none');
				$('#formulario7').addClass('d-none');
				$('#formulario8').addClass('d-none');
				$('#formulario9').addClass('d-none');
			break;

			case 'Ddocumentos':
				$('#Ddocumentos').addClass('active1');
				$('#Ddocumentos').removeClass('d-none');
				$('#Dempresa').removeClass('active1');
				$('#Dbancarios').removeClass('active1');
				$('#Dcorporales').removeClass('active1');
				$('#Dpersonales').removeClass('active1');
				$('#Dcontrato').removeClass('active1');
				$('#Dcuentas').removeClass('active1');
				$('#Dfotos').removeClass('active1');
				$('#Dpagos').removeClass('active1');
				
				$('#formulario1').addClass('d-none');
				$('#formulario2').addClass('d-none');
				$('#formulario3').addClass('d-none');
				$('#formulario4').addClass('d-none');
				$('#formulario5').removeClass('d-none');
				$('#formulario6').addClass('d-none');
				$('#formulario7').addClass('d-none');
				$('#formulario8').addClass('d-none');
				$('#formulario9').addClass('d-none');
			break;

			case 'Dcontrato':
				$('#Dcontrato').addClass('active1');
				$('#Dcontrato').removeClass('d-none');
				$('#Dempresa').removeClass('active1');
				$('#Dbancarios').removeClass('active1');
				$('#Dcorporales').removeClass('active1');
				$('#Dpersonales').removeClass('active1');
				$('#Ddocumentos').removeClass('active1');
				$('#Dcuentas').removeClass('active1');
				$('#Dfotos').removeClass('active1');
				$('#Dpagos').removeClass('active1');
				
				$('#formulario1').addClass('d-none');
				$('#formulario2').addClass('d-none');
				$('#formulario3').addClass('d-none');
				$('#formulario4').addClass('d-none');
				$('#formulario5').addClass('d-none');
				$('#formulario6').removeClass('d-none');
				$('#formulario7').addClass('d-none');
				$('#formulario8').addClass('d-none');
				$('#formulario9').addClass('d-none');
			break;

			case 'Dcuentas':
				$('#Dcuentas').addClass('active1');
				$('#Dcontrato').removeClass('active1');
				$('#Dcontrato').removeClass('d-none');
				$('#Dempresa').removeClass('active1');
				$('#Dbancarios').removeClass('active1');
				$('#Dcorporales').removeClass('active1');
				$('#Dpersonales').removeClass('active1');
				$('#Ddocumentos').removeClass('active1');
				$('#Dfotos').removeClass('active1');
				$('#Dpagos').removeClass('active1');
				
				$('#formulario1').addClass('d-none');
				$('#formulario2').addClass('d-none');
				$('#formulario3').addClass('d-none');
				$('#formulario4').addClass('d-none');
				$('#formulario5').addClass('d-none');
				$('#formulario6').addClass('d-none');
				$('#formulario7').removeClass('d-none');
				$('#formulario8').addClass('d-none');
				$('#formulario9').addClass('d-none');
			break;

			case 'Dfotos':
				$('#Dfotos').addClass('active1');
				$('#Dcuentas').removeClass('active1');
				$('#Dcontrato').removeClass('active1');
				$('#Dcontrato').removeClass('d-none');
				$('#Dempresa').removeClass('active1');
				$('#Dbancarios').removeClass('active1');
				$('#Dcorporales').removeClass('active1');
				$('#Dpersonales').removeClass('active1');
				$('#Ddocumentos').removeClass('active1');
				$('#Dpagos').removeClass('active1');
				
				$('#formulario1').addClass('d-none');
				$('#formulario2').addClass('d-none');
				$('#formulario3').addClass('d-none');
				$('#formulario4').addClass('d-none');
				$('#formulario5').addClass('d-none');
				$('#formulario6').addClass('d-none');
				$('#formulario7').addClass('d-none');
				$('#formulario8').removeClass('d-none');
				$('#formulario9').addClass('d-none');
			break;

			case 'Dpagos':
				$('#Dfotos').removeClass('active1');
				$('#Dcuentas').removeClass('active1');
				$('#Dcontrato').removeClass('active1');
				$('#Dcontrato').removeClass('d-none');
				$('#Dempresa').removeClass('active1');
				$('#Dbancarios').removeClass('active1');
				$('#Dcorporales').removeClass('active1');
				$('#Dpersonales').removeClass('active1');
				$('#Ddocumentos').removeClass('active1');
				$('#Dpagos').addClass('active1');
				
				$('#formulario1').addClass('d-none');
				$('#formulario2').addClass('d-none');
				$('#formulario3').addClass('d-none');
				$('#formulario4').addClass('d-none');
				$('#formulario5').addClass('d-none');
				$('#formulario6').addClass('d-none');
				$('#formulario7').addClass('d-none');
				$('#formulario8').addClass('d-none');
				$('#formulario9').removeClass('d-none');
			break;
			
		default:
		    console.log('Lo lamentamos, por el momento no disponemos de ' + variable + '.');
		}
	}

	$("#formulario1").on("submit", function(e){
		e.preventDefault();
		var f = $(this);
	    $.ajax({
			type: 'POST',
			url: '../script/guardar_modelo2.php',
			data: $('#formulario1').serialize(),
			dataType: "JSON",
			success: function(respuesta) {
				//console.log(respuesta);
				Swal.fire({
	 				title: 'Correcto',
	 				text: "Datos actualizados",
	 				icon: 'success',
	 				position: 'center',
	 				timer: 3000
				})
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
		refrescar();
	});

	$("#formulario2").on("submit", function(e){
		e.preventDefault();
		var f = $(this);
	    $.ajax({
			type: 'POST',
			url: '../script/guardar_modelo2.php',
			data: $('#formulario2').serialize(),
			dataType: "JSON",
			success: function(respuesta) {
				//console.log(respuesta);
				Swal.fire({
	 				title: 'Correcto',
	 				text: "Datos actualizados",
	 				icon: 'success',
	 				position: 'center',
	 				timer: 3000
				})
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
		refrescar();
	});

	$("#formulario3").on("submit", function(e){
		e.preventDefault();
		var f = $(this);
	    $.ajax({
			type: 'POST',
			url: '../script/guardar_modelo2.php',
			data: $('#formulario3').serialize(),
			dataType: "JSON",
			success: function(respuesta) {
				//console.log(respuesta);
				Swal.fire({
	 				title: 'Correcto',
	 				text: "Datos actualizados",
	 				icon: 'success',
	 				position: 'center',
	 				timer: 3000
				})
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
		refrescar();
	});

	$("#formulario4").on("submit", function(e){
		e.preventDefault();
		var f = $(this);
	    $.ajax({
			type: 'POST',
			url: '../script/guardar_modelo2.php',
			data: $('#formulario4').serialize(),
			dataType: "JSON",
			success: function(respuesta) {
				console.log(respuesta);
				Swal.fire({
	 				title: 'Correcto',
	 				text: "Datos actualizados",
	 				icon: 'success',
	 				position: 'center',
	 				timer: 3000
				})
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
		refrescar();
	});

	function checkbox1(){
		if( $('#Ptattu').prop('checked') ) {
		    $('#f3_hidden_Ptattu').val('Si');
		}else{
			$('#f3_hidden_Ptattu').val('No');
		}
	}

	function checkbox2(){
		if( $('#Ppiercing').prop('checked') ) {
		    $('#f3_hidden_Ppiercing').val('Si');
		}else{
			$('#f3_hidden_Ppiercing').val('No');
		}
	}


	function vercontrato1(){
		var hidden = $('#hidden_vercontrato1').val();
		if(hidden == 'Si'){
			$('#hidden_vercontrato1').val('No');
			$('#botonContratover1').val('Ver Contrato (Primera Opción)');
			$('#seccion_contrato1').hide();
		}else{
			$('#hidden_vercontrato1').val('Si');
			$('#botonContratover1').val('Ocultar Contrato (Primera Opción)');
			$('#seccion_contrato1').show();
		}
	}

	/**************SUBIR ARCHIVOS****************/
	$("#form_seguridad_social").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#seguridad_social')[0].files[0];
        fd.append('file',files);
        fd.append('condicion',"subir_archivo1");
        fd.append('condicion2',"Seguridad Social");
        fd.append('id',$('#id').val());

        $.ajax({
            url: '../script/crud_nomina.php',
            type: 'POST',
            data: fd,
            dataType: "JSON",
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_seguridad_social').attr('disabled','true');
            },

            success: function(response){
            	if(response['estatus']=='error'){
            		$('#submit_seguridad_social').attr('disabled','false');
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> pdf",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
					$('#submit_seguridad_social').removeAttr('disabled');
            		return false;
            	}

            	Swal.fire({
	 				title: 'Documento Subido',
	 				text: "Redirigiendo...!",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: true,
	 				confirmButtonColor: '#3085d6',
	 				confirmButtonText: 'No esperar!',
	 				timer: 3000
				}).then((result) => {
	 				if (result.value) {
	   					window.location.href = "perfil.php";
	 				}
				})
				setTimeout(function() {
			    	window.location.href = "perfil.php";
				},3500);
            },
        });
    });



	$("#form_pasaporte").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#pasaporte')[0].files[0];
        fd.append('file',files);

        $.ajax({
            url: '../script/modelo_subir_documento2.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_pasaporte').attr('disabled','true');
            },

            success: function(response){
            	if(response=='error'){
            		$('#submit_pasaporte').attr('disabled','false');
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> jpg jpeg png",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
            		return false;
            	}
            	Swal.fire({
	 				title: 'Documento Subido',
	 				text: "Redirigiendo...!",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: true,
	 				confirmButtonColor: '#3085d6',
	 				confirmButtonText: 'No esperar!',
	 				timer: 3000
				}).then((result) => {
	 				if (result.value) {
	   					window.location.href = "perfil.php";
	 				}
				})
				setTimeout(function() {
			    	window.location.href = "perfil.php";
				},3500);
            },
        });
    });




    $("#form_rut").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#rut')[0].files[0];
        fd.append('file',files);

        $.ajax({
            url: '../script/modelo_subir_documento3.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_rut').attr('disabled','true');
            },

            success: function(response){
            	if(response=='error'){
            		$('#submit_rut').attr('disabled','false');
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> jpg jpeg png",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
            		return false;
            	}
            	Swal.fire({
	 				title: 'Documento Subido',
	 				text: "Redirigiendo...!",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: true,
	 				confirmButtonColor: '#3085d6',
	 				confirmButtonText: 'No esperar!',
	 				timer: 3000
				}).then((result) => {
	 				if (result.value) {
	   					window.location.href = "perfil.php";
	 				}
				})
				setTimeout(function() {
			    	window.location.href = "perfil.php";
				},3500);
            },
        });
    });



    $("#form_certificacion_bancaria").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#certificacion_bancaria')[0].files[0];
        fd.append('file',files);

        $.ajax({
            url: '../script/modelo_subir_documento4.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_certificacion_bancaria').attr('disabled','true');
            },

            success: function(response){
            	if(response=='error'){
            		$('#submit_certificacion_bancaria').attr('disabled','false');
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> jpg jpeg png",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
            		return false;
            	}
            	Swal.fire({
	 				title: 'Documento Subido',
	 				text: "Redirigiendo...!",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: true,
	 				confirmButtonColor: '#3085d6',
	 				confirmButtonText: 'No esperar!',
	 				timer: 3000
				}).then((result) => {
	 				if (result.value) {
	   					window.location.href = "perfil.php";
	 				}
				})
				setTimeout(function() {
			    	window.location.href = "perfil.php";
				},3500);
            },
        });
    });



    $("#form_eps").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#eps')[0].files[0];
        fd.append('file',files);

        $.ajax({
            url: '../script/modelo_subir_documento5.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_eps').attr('disabled','true');
            },

            success: function(response){
            	if(response=='error'){
            		$('#submit_eps').attr('disabled','false');
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> jpg jpeg png",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
            		return false;
            	}
            	Swal.fire({
	 				title: 'Documento Subido',
	 				text: "Redirigiendo...!",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: true,
	 				confirmButtonColor: '#3085d6',
	 				confirmButtonText: 'No esperar!',
	 				timer: 3000
				}).then((result) => {
	 				if (result.value) {
	   					window.location.href = "perfil.php";
	 				}
				})
				setTimeout(function() {
			    	window.location.href = "perfil.php";
				},3500);
            },
        });
    });


    $("#form_antecedentes_disciplinarios").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#antecedentes_disciplinarios')[0].files[0];
        fd.append('file',files);

        $.ajax({
            url: '../script/modelo_subir_documento6.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_antecedentes_disciplinarios').attr('disabled','true');
            },

            success: function(response){
            	if(response=='error'){
            		$('#submit_antecedentes_disciplinarios').attr('disabled','false');
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> jpg jpeg png",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
            		return false;
            	}
            	Swal.fire({
	 				title: 'Documento Subido',
	 				text: "Redirigiendo...!",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: true,
	 				confirmButtonColor: '#3085d6',
	 				confirmButtonText: 'No esperar!',
	 				timer: 3000
				}).then((result) => {
	 				if (result.value) {
	   					window.location.href = "perfil.php";
	 				}
				})
				setTimeout(function() {
			    	window.location.href = "perfil.php";
				},3500);
            },
        });
    });



    $("#form_foto_cedula_con_cara").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#foto_cedula_con_cara')[0].files[0];
        fd.append('file',files);

        $.ajax({
            url: '../script/modelo_subir_documento7.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_foto_cedula_con_cara').attr('disabled','true');
            },

            success: function(response){
            	if(response=='error'){
            		$('#submit_foto_cedula_con_cara').attr('disabled','false');
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> jpg jpeg png",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
            		return false;
            	}
            	Swal.fire({
	 				title: 'Documento Subido',
	 				text: "Redirigiendo...!",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: true,
	 				confirmButtonColor: '#3085d6',
	 				confirmButtonText: 'No esperar!',
	 				timer: 3000
				}).then((result) => {
	 				if (result.value) {
	   					window.location.href = "perfil.php";
	 				}
				})
				setTimeout(function() {
			    	window.location.href = "perfil.php";
				},3500);
            },
        });
    });




    $("#form_foto_cedula_parte_frontal_cara").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#foto_cedula_parte_frontal_cara')[0].files[0];
        fd.append('file',files);

        $.ajax({
            url: '../script/modelo_subir_documento8.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_foto_cedula_parte_frontal_cara').attr('disabled','true');
            },

            success: function(response){
            	if(response=='error'){
            		$('#submit_foto_cedula_parte_frontal_cara').attr('disabled','false');
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> jpg jpeg png",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
            		return false;
            	}
            	Swal.fire({
	 				title: 'Documento Subido',
	 				text: "Redirigiendo...!",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: true,
	 				confirmButtonColor: '#3085d6',
	 				confirmButtonText: 'No esperar!',
	 				timer: 3000
				}).then((result) => {
	 				if (result.value) {
	   					window.location.href = "perfil.php";
	 				}
				})
				setTimeout(function() {
			    	window.location.href = "perfil.php";
				},3500);
            },
        });
    });



    $("#form_foto_cedula_parte_respaldo").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#foto_cedula_parte_respaldo')[0].files[0];
        fd.append('file',files);

        $.ajax({
            url: '../script/modelo_subir_documento9.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_foto_cedula_parte_respaldo').attr('disabled','true');
            },

            success: function(response){
            	if(response=='error'){
            		$('#submit_foto_cedula_parte_respaldo').attr('disabled','false');
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> jpg jpeg png",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
            		return false;
            	}
            	Swal.fire({
	 				title: 'Documento Subido',
	 				text: "Redirigiendo...!",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: true,
	 				confirmButtonColor: '#3085d6',
	 				confirmButtonText: 'No esperar!',
	 				timer: 3000
				}).then((result) => {
	 				if (result.value) {
	   					window.location.href = "perfil.php";
	 				}
				})
				setTimeout(function() {
			    	window.location.href = "perfil.php";
				},3500);
            },
        });
    });



    $("#form_antecedentes_penales").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#antecedentes_penales')[0].files[0];
        fd.append('file',files);

        $.ajax({
            url: '../script/modelo_subir_documento10.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_antecedentes_penales').attr('disabled','true');
            },

            success: function(response){
            	if(response=='error'){
            		$('#submit_antecedentes_penales').attr('disabled','false');
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> jpg jpeg png",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
            		return false;
            	}
            	Swal.fire({
	 				title: 'Documento Subido',
	 				text: "Redirigiendo...!",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: true,
	 				confirmButtonColor: '#3085d6',
	 				confirmButtonText: 'No esperar!',
	 				timer: 3000
				}).then((result) => {
	 				if (result.value) {
	   					window.location.href = "perfil.php";
	 				}
				})
				setTimeout(function() {
			    	window.location.href = "perfil.php";
				},3500);
            },
        });
    });


    $("#formulario6").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#firma_digital')[0].files[0];
        fd.append('file',files);

        $.ajax({
            url: '../script/modelo_subir_documento.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_firma_digital').attr('disabled','true');
            },

            success: function(response){
            	if(response=='error'){
            		$('#submit_firma_digital').attr('disabled','false');
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> jpg jpeg png",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
            		return false;
            	}
            	Swal.fire({
	 				title: 'Documento Subido',
	 				text: "Redirigiendo...!",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: true,
	 				confirmButtonColor: '#3085d6',
	 				confirmButtonText: 'No esperar!',
	 				timer: 3000
				}).then((result) => {
	 				if (result.value) {
	   					window.location.href = "perfil.php";
	 				}
				})
				setTimeout(function() {
			    	window.location.href = "perfil.php";
				},3500);
            },
        });
    });

    function mostrar1(variable){
    	$.ajax({
			type: 'POST',
			url: '../script/modelos_cuentas_hidden1.php',
			data: {"variable":variable,},
			dataType: "JSON",

			beforeSend: function(){
				$('#div_hidden1').hide('medium');
			},

			success: function(respuesta) {
				$('#div_hidden1').html(respuesta['html']);
				$('#div_hidden1').show('medium');
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
    }

    $("#form_modal_fotos_sensuales1").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var foto1 = $('#foto_sensual_1')[0].files[0];
        var foto2 = $('#foto_sensual_2')[0].files[0];
        var foto3 = $('#foto_sensual_3')[0].files[0];
        var foto4 = $('#foto_sensual_4')[0].files[0];
        var foto5 = $('#foto_sensual_5')[0].files[0];
        var id_modelo = $('#hidden_id_modelo').val();
        fd.append('foto1',foto1);
        fd.append('foto2',foto2);
        fd.append('foto3',foto3);
        fd.append('foto4',foto4);
        fd.append('foto5',foto5);
        fd.append('id_modelo',id_modelo);

        $.ajax({
            url: '../script/modelos_fotos_sensuales_subir1.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_fotos_sensuales1').attr('disabled','true');
            },

            success: function(response){
            	console.log(response);
            	if(response=='error'){
            		$('#submit_fotos_sensuales1').removeAttr('disabled');
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> jpg jpeg png",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
            		return false;
            	}
            	Swal.fire({
	 				title: 'Documento Subido',
	 				text: "Redirigiendo...!",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: true,
	 				confirmButtonColor: '#3085d6',
	 				confirmButtonText: 'No esperar!',
	 				timer: 3000
				}).then((result) => {
	 				if (result.value) {
	   					window.location.href = "perfil.php";
	 				}
				})
				setTimeout(function() {
			    	window.location.href = "perfil.php";
				},3500);
				$("#Modal_fotos_sensuales1").modal('hide');
				$('#Modal_fotos_sensuales1').removeClass('modal-open');
				$('.modal-backdrop').remove();
            },
        });
    });


	/********************************************/

</script>