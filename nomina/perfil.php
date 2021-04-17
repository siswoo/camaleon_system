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
	$id_nomina_hidden = $_SESSION["id"];
	echo '
		<input type="hidden" name="id_nomina_hidden" id="id_nomina_hidden" value="'.$id_nomina_hidden.'">
	';
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

			/********EMERGENCIA**************/
			$emergencia_nombre=$row['emergencia_nombre'];
			$emergencia_telefono=$row['emergencia_telefono'];
			$emergencia_parentesco=$row['emergencia_parentesco'];
			/*****************************/

			/********EMPRESARIAL**************/
			$funcion=$row['funcion'];
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
			<li class="nav-item">
				<a class="nav-link" href="#" id="Demergencia" onclick="pestañas(this.id);" style="color:white; text-transform: uppercase;">Emergencia</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#" id="Dclave" onclick="pestañas(this.id);" style="color:white; text-transform: uppercase;">Clave</a>
			</li>
		</ul>

	<!--***********************************************************-->
	<!--**********************DATOS PERSONALES*********************-->
	<!--***********************************************************-->
	<div id="formulario1">
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
	</div>

	<!--***********************************************************-->
	<!--***********************************************************-->

	<!--***********************************************************-->
	<!--**********************DATOS BANCARIOS*********************-->
	<!--***********************************************************-->
	<form class="d-none" action="#" method="POST" id="formulario2">
		<input type="hidden" id="condicion" name="condicion" value="guardar_bancarios">
		<input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
		
		<div class="row">
			<div class="col-6 form-group form-check">
				<label for="BCPP">Cuenta Propia o Prestada?</label>
				<select name="BCPP" class="form-control" id="BCPP" onchange="prestada1(value);" required>
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
					if($banco_banco!=''){ ?>
						<option value="<?php echo $banco_banco;?>" selected><?php echo $banco_banco;?></option>
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


			<?php
			$sql9 = "SELECT * FROM n_archivos WHERE id_nomina = ".$id." and id_documento = 11";
			$consulta9 = mysqli_query($conexion,$sql9);
			$contador9 = mysqli_num_rows($consulta9);

			echo '
				<input type="hidden" id="hidden_contador9" name="hidden_contador9" value="'.$contador9.'">
			';

			if($contador9>=1){
				echo '
					<div class="text-center col-12">
						Ya tiene una foto subida
					</div>
					<div class="text-center col-12 mt-3 mb-3">
						<img src="../resources/documentos/nominas/archivos/'.$id.'/acta_cuenta_prestada.jpg" class="img-fluid" style="max-width:170px;">
					</div>
					<div style="display:none;">
						<input type="file" name="acta_cuenta_prestada" id="acta_cuenta_prestada" class="form-control">
					</div>
				';
			}else{ ?>
				<div id="div_acta_cuenta_prestada" class="col-12">
					<div class="text-center col-12 mt-1" style="font-size: 20px; font-weight: bold;">
						Acta de Cuenta Prestada
					</div>
					<div class="text-center col-12 mt-1 mb-2">
						<input type="file" name="acta_cuenta_prestada" id="acta_cuenta_prestada" class="form-control">
					</div>
				</div>
			<?php } ?>

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
		$html_identificacion='';
		$html_rut='';
		$html_certificacion_bancaria='';

		if($contador3>=1){
			while($row3 = mysqli_fetch_array($consulta3)) {
				$id_documento = $row3['id_documento'];
				$sql4 = "SELECT * FROM n_documentos WHERE id =".$id_documento;
				$consulta4 = mysqli_query($conexion,$sql4);
				while($row4 = mysqli_fetch_array($consulta4)) {
					$nombre_documento = $row4['nombre'];

					switch ($nombre_documento) {
						case 'EPS':
							$html_eps = '
								<div class="row">
									<div class="col-12 form-group form-check text-center">
										<label for="turno">EPS (Subida Actualmente)</label>
										<p><embed src="../resources/documentos/nominas/archivos/'.$id.'/eps.pdf#toolbar=0" type="application/pdf" width="100%" height="400px" /></p>
									</div>
								</div>
								<hr style="background-color: white;">
							';
						break;

						case 'Fondo de Pension':
							$html_fondo_de_pension = '
								<div class="row">
									<div class="col-12 form-group form-check text-center">
										<label for="turno">Fondo de Pensión (Subida Actualmente)</label>
										<p><embed src="../resources/documentos/nominas/archivos/'.$id.'/fondo_de_pension.pdf#toolbar=0" type="application/pdf" width="100%" height="400px" /></p>
									</div>
								</div>
								<hr style="background-color: white;">
							';
						break;

						case 'ARL':
							$html_arl = '
								<div class="row">
									<div class="col-12 form-group form-check text-center">
										<label for="turno">ARL (Subida Actualmente)</label>
										<p><embed src="../resources/documentos/nominas/archivos/'.$id.'/arl.pdf#toolbar=0" type="application/pdf" width="100%" height="400px" /></p>
									</div>
								</div>
								<hr style="background-color: white;">
							';
						break;

						case 'Antecedentes Penales':
							$html_antecedentes_penales = '
								<div class="row">
									<div class="col-12 form-group form-check text-center">
										<label for="turno">Antecedentes Penales (Subida Actualmente)</label>
										<p><embed src="../resources/documentos/nominas/archivos/'.$id.'/antecedentes_penales.pdf#toolbar=0" type="application/pdf" width="100%" height="400px" /></p>
									</div>
								</div>
								<hr style="background-color: white;">
							';
						break;

						case 'Hoja de Vida':
							$html_hoja_de_vida = '
								<div class="row">
									<div class="col-12 form-group form-check text-center">
										<label for="turno">Hoja de Vida (Subida Actualmente)</label>
										<p><embed src="../resources/documentos/nominas/archivos/'.$id.'/hoja_de_vida.pdf#toolbar=0" type="application/pdf" width="100%" height="400px" /></p>
									</div>
								</div>
								<hr style="background-color: white;">
							';
						break;

						case 'Identificacion':
							$html_identificacion = '
								<div class="row">
									<div class="col-12 form-group form-check text-center">
										<label for="turno">Identificación (Subida Actualmente)</label>
										<p><embed src="../resources/documentos/nominas/archivos/'.$id.'/identificacion.pdf#toolbar=0" type="application/pdf" width="100%" height="400px" /></p>
									</div>
								</div>
								<hr style="background-color: white;">
							';
						break;

						case 'Rut':
							$html_rut = '
								<div class="row">
									<div class="col-12 form-group form-check text-center">
										<label for="turno">RUT (Subida Actualmente)</label>
										<p><embed src="../resources/documentos/nominas/archivos/'.$id.'/rut.pdf#toolbar=0" type="application/pdf" width="100%" height="400px" /></p>
									</div>
								</div>
								<hr style="background-color: white;">
							';
						break;

						case 'Certificación Bancaria':
							$html_certificacion_bancaria = '
								<div class="row">
									<div class="col-12 form-group form-check text-center">
										<label for="turno">Certificación Bancaria (Subida Actualmente)</label>
										<p><embed src="../resources/documentos/nominas/archivos/'.$id.'/certificacion_bancaria.pdf#toolbar=0" type="application/pdf" width="100%" height="400px" /></p>
									</div>
								</div>
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
			<form id="form_arl" enctype="multipart/form-data" method="POST">
				<div class="row mt-3 mb-3">
					<div class="col-12 form-group form-check">
						<button type="submit" class="btn btn-success" id="submit_arl" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
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

		if($html_identificacion==''){
			echo '
			<form id="form_identificacion" enctype="multipart/form-data" method="POST">
				<div class="row mt-3 mb-3">
					<div class="col-12 form-group form-check">
						<button type="submit" class="btn btn-success" id="submit_identificacion" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
						<label for="turno">Identificación</label>
						<input type="file" style="height:43px;" class="form-control" name="identificacion" id="identificacion" required>
					</div>
				</div>
			</form>
			';
		}else{
			echo $html_identificacion;
		}

		if($html_rut==''){
			echo '
			<form id="form_rut" enctype="multipart/form-data" method="POST">
				<div class="row mt-3 mb-3">
					<div class="col-12 form-group form-check">
						<button type="submit" class="btn btn-success" id="submit_rut" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
						<label for="turno">RUT</label>
						<input type="file" style="height:43px;" class="form-control" name="rut" id="rut" required>
					</div>
				</div>
			</form>
			';
		}else{
			echo $html_rut;
		}

		if($html_certificacion_bancaria==''){
			echo '
			<form id="form_certificacion_bancaria" enctype="multipart/form-data" method="POST">
				<div class="row mt-3 mb-3">
					<div class="col-12 form-group form-check">
						<button type="submit" class="btn btn-success" id="submit_certificacion_bancaria" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
						<label for="turno">Certificación Bancaria</label>
						<input type="file" style="height:43px;" class="form-control" name="certificacion_bancaria" id="certificacion_bancaria" required>
					</div>
				</div>
			</form>
			';
		}else{
			echo $html_certificacion_bancaria;
		}
		?>
	</form>
	</div>
	<!--***********************************************************-->
	<!--***********************************************************-->


	<!--***********************************************************-->
	<!--**********************CONTRATO*********************-->
	<!--***********************************************************-->
	<form class="d-none" action="#" method="POST" id="formulario6">
		<input type="hidden" id="contrato_id" name="contrato_id" value="<?php echo $id; ?>">
		<?php
		if($funcion=='' or $funcion==0){
			echo '<p for="turno" style="font-size: 22px; text-transform: capitalize;" class="text-center mt-3">Aun no tienes una funcion asignada</p>';
		}else{ ?>
			<div class="row">
				<div class="col-12 form-group form-check text-center mt-3">
					<input type="button" class="btn btn-info" id="botonContratover1" name="botonContratover1" value="Ver Contrato (Primera Opción)" onclick="vercontrato1();">
					<input type="hidden" name="hidden_vercontrato1" id="hidden_vercontrato1" value="No">
				</div>

				<?php
				if($cargo==1){
					$nombre_contrato = "contrato1";
				}
				?>

				<div class="col-12 form-group form-check text-center mt-3">
					<a href="../script/generador_nomina_contrato1.php#toolbar=0" target="_blank">
						<button type="button" class="btn btn-info">Ver Contrato (Segunda Opción)</button>
					</a>
				</div>

				<div class="col-12 form-group form-check text-center" id="seccion_contrato1" style="display: none;">
					<label>Contrato Actualizado</label>
					<embed src="../script/generador_nomina_contrato1.php#toolbar=0" type="application/pdf" width="100%" height="600px" />
				</div>
					
				<div class="col-12 form-group form-check text-center mt-3">
					<?php
					$sql2 = "SELECT * FROM n_archivos WHERE id_documento = 8 and id_nomina = ".$id;
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
						}
						echo '<p for="turno" style="font-size: 22px; text-transform: capitalize;">Ya Tiene una Firma Registrada!</p>';
					}
					?>
				</div>
			</div>
		<?php } ?>
	</form>
	<!--***********************************************************-->
	<!--***********************************************************-->

	<!--***********************************************************-->
	<!--**********************PAGOS*********************-->
	<!--***********************************************************-->
	<form class="d-none" action="#" method="POST" id="formulario9">
		<div class="row">
			<?php
			$sql8 = "SELECT * FROM nomina WHERE id = ".$id;
			$consulta8 = mysqli_query($conexion,$sql8);

			$sql7 = "SELECT * FROM n_pagos WHERE id_nomina = ".$id." and estatus = 'Aceptado'";
			$consulta7 = mysqli_query($conexion,$sql7);
			$contador6 = mysqli_num_rows($consulta7);
			$html_pagos = '';
			if($contador6>=1){
				while($row7 = mysqli_fetch_array($consulta7)) {
					$pago_id = $row7['id'];
					$salario = $row7['salario'];
					$bonos = $row7['bonos'];
					$multas = $row7['multas'];
					$inicio = $row7['inicio'];
					$fin = $row7['fin'];
						
					$html_pagos.='
						<div class="col-12 text-center form-group mt-3">
							<span style="font-size: 20px; font-weight: bold;">Desde '.$inicio.' Hasta '.$fin.'</span>
							<br>
							<a href="desprendible1.php?id='.$pago_id.'" target="_blank" style="color: white; text-decoration: none;">
								<button type="button" class="btn btn-success mt-3">Ver Desprendible</button>
							</a>
							<hr style="background-color: white;">
						</div>
					';
				}
			}else{
				$html_pagos.='
					<div class="col-12 form-group form-check text-center mt-3">No Tienes Pagos Efectuados</div>
				';
			}
			echo $html_pagos;
			?>
		</div>
	</form>
	<!--***********************************************************-->
	<!--***********************************************************-->

	<!--***********************************************************-->
	<!--**********************Emergencia*********************-->
	<!--***********************************************************-->
	<form class="d-none" action="#" method="POST" id="formulario7">
		<input type="hidden" id="condicion" name="condicion" value="guardar_emergencia">
		<input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
		<div class="row">
			<div class="col-12 form-group form-check">
				<label for="emergencia_nombre">Nombre</label>
				<input type="text" name="emergencia_nombre" id="emergencia_nombre" <?php if($emergencia_nombre!=''){?> value="<?php echo $emergencia_nombre; ?>" <?php } ?> class="form-control" autocomplete="off" required>
			</div>
			<div class="col-6 form-group form-check">
				<label for="emergencia_telefono">Teléfono</label>
				<input type="text" name="emergencia_telefono" id="emergencia_telefono" <?php if($emergencia_telefono!=''){?> value="<?php echo $emergencia_telefono; ?>" <?php } ?> class="form-control" autocomplete="off" required>
			</div>
			<div class="col-6 form-group form-check">
				<label for="emergencia_parentesco">Parentesco</label>
				<input type="text" name="emergencia_parentesco" id="emergencia_parentesco" <?php if($emergencia_parentesco!=''){?> value="<?php echo $emergencia_parentesco; ?>" <?php } ?> class="form-control" autocomplete="off" required>
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
	<!--**********************CONTRATO*********************-->
	<!--***********************************************************-->
	<form class="d-none" action="#" method="POST" id="formulario10">
		<div class="row">
			<div class="col-12 text-center" style="font-size: 20px; font-weight: bold;">
				Cambiar Clave de Usuario
			</div>
			<div class="col-12 form-group form-check">
				<label for="clave_password1">Nueva Contraseña</label>
				<input type="password" id="clave_password1" name="clave_password1" class="form-control">
			</div>
			<div class="col-12 form-group form-check">
				<label for="clave_password2">Repetir Contraseña</label>
				<input type="password" id="clave_password2" name="clave_password2" class="form-control">
			</div>
			<div class="col-md-12 text-center">
				<button type="submit" id="submit_clave1" class="btn btn-success" style="width: 25%; font-weight: bold;">Actualizar</button>
			</div>
		</div>
	</form>
	<!--***********************************************************-->
	<!--***********************************************************-->

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
				$('#Demergencia').removeClass('active1');
				$('#Dfotos').removeClass('active1');
				$('#Dpagos').removeClass('active1');
				$('#Dclave').removeClass('active1');
				
				$('#formulario1').removeClass('d-none');
				$('#formulario2').addClass('d-none');
				$('#formulario3').addClass('d-none');
				$('#formulario4').addClass('d-none');
				$('#formulario5').addClass('d-none');
				$('#formulario6').addClass('d-none');
				$('#formulario7').addClass('d-none');
				$('#formulario8').addClass('d-none');
				$('#formulario9').addClass('d-none');
				$('#formulario10').addClass('d-none');
			break;

			case 'Dbancarios':
				$('#Dbancarios').addClass('active1');
				$('#Dbancarios').removeClass('d-none');
				$('#Dpersonales').removeClass('active1');
				$('#Dcorporales').removeClass('active1');
				$('#Dempresa').removeClass('active1');
				$('#Ddocumentos').removeClass('active1');
				$('#Dcontrato').removeClass('active1');
				$('#Demergencia').removeClass('active1');
				$('#Dfotos').removeClass('active1');
				$('#Dpagos').removeClass('active1');
				$('#Dclave').removeClass('active1');
				
				$('#formulario1').addClass('d-none');
				$('#formulario2').removeClass('d-none');
				$('#formulario3').addClass('d-none');
				$('#formulario4').addClass('d-none');
				$('#formulario5').addClass('d-none');
				$('#formulario6').addClass('d-none');
				$('#formulario7').addClass('d-none');
				$('#formulario8').addClass('d-none');
				$('#formulario9').addClass('d-none');
				$('#formulario10').addClass('d-none');
			break;

			case 'Dcorporales':
				$('#Dcorporales').addClass('active1');
				$('#Dcorporales').removeClass('d-none');
				$('#Dbancarios').removeClass('active1');
				$('#Dpersonales').removeClass('active1');
				$('#Dempresa').removeClass('active1');
				$('#Ddocumentos').removeClass('active1');
				$('#Dcontrato').removeClass('active1');
				$('#Demergencia').removeClass('active1');
				$('#Dfotos').removeClass('active1');
				$('#Dpagos').removeClass('active1');
				$('#Dclave').removeClass('active1');
				
				$('#formulario1').addClass('d-none');
				$('#formulario2').addClass('d-none');
				$('#formulario3').removeClass('d-none');
				$('#formulario4').addClass('d-none');
				$('#formulario5').addClass('d-none');
				$('#formulario6').addClass('d-none');
				$('#formulario7').addClass('d-none');
				$('#formulario8').addClass('d-none');
				$('#formulario9').addClass('d-none');
				$('#formulario10').addClass('d-none');
			break;

			case 'Dempresa':
				$('#Dempresa').addClass('active1');
				$('#Dempresa').removeClass('d-none');
				$('#Dbancarios').removeClass('active1');
				$('#Dcorporales').removeClass('active1');
				$('#Dpersonales').removeClass('active1');
				$('#Ddocumentos').removeClass('active1');
				$('#Dcontrato').removeClass('active1');
				$('#Demergencia').removeClass('active1');
				$('#Dfotos').removeClass('active1');
				$('#Dpagos').removeClass('active1');
				$('#Dclave').removeClass('active1');
				
				$('#formulario1').addClass('d-none');
				$('#formulario2').addClass('d-none');
				$('#formulario3').addClass('d-none');
				$('#formulario4').removeClass('d-none');
				$('#formulario5').addClass('d-none');
				$('#formulario6').addClass('d-none');
				$('#formulario7').addClass('d-none');
				$('#formulario8').addClass('d-none');
				$('#formulario9').addClass('d-none');
				$('#formulario10').addClass('d-none');
			break;

			case 'Ddocumentos':
				$('#Ddocumentos').addClass('active1');
				$('#Ddocumentos').removeClass('d-none');
				$('#Dempresa').removeClass('active1');
				$('#Dbancarios').removeClass('active1');
				$('#Dcorporales').removeClass('active1');
				$('#Dpersonales').removeClass('active1');
				$('#Dcontrato').removeClass('active1');
				$('#Demergencia').removeClass('active1');
				$('#Dfotos').removeClass('active1');
				$('#Dpagos').removeClass('active1');
				$('#Dclave').removeClass('active1');
				
				$('#formulario1').addClass('d-none');
				$('#formulario2').addClass('d-none');
				$('#formulario3').addClass('d-none');
				$('#formulario4').addClass('d-none');
				$('#formulario5').removeClass('d-none');
				$('#formulario6').addClass('d-none');
				$('#formulario7').addClass('d-none');
				$('#formulario8').addClass('d-none');
				$('#formulario9').addClass('d-none');
				$('#formulario10').addClass('d-none');
			break;

			case 'Dcontrato':
				$('#Dcontrato').addClass('active1');
				$('#Dcontrato').removeClass('d-none');
				$('#Dempresa').removeClass('active1');
				$('#Dbancarios').removeClass('active1');
				$('#Dcorporales').removeClass('active1');
				$('#Dpersonales').removeClass('active1');
				$('#Ddocumentos').removeClass('active1');
				$('#Demergencia').removeClass('active1');
				$('#Dfotos').removeClass('active1');
				$('#Dpagos').removeClass('active1');
				$('#Dclave').removeClass('active1');
				
				$('#formulario1').addClass('d-none');
				$('#formulario2').addClass('d-none');
				$('#formulario3').addClass('d-none');
				$('#formulario4').addClass('d-none');
				$('#formulario5').addClass('d-none');
				$('#formulario6').removeClass('d-none');
				$('#formulario7').addClass('d-none');
				$('#formulario8').addClass('d-none');
				$('#formulario9').addClass('d-none');
				$('#formulario10').addClass('d-none');
			break;

			case 'Demergencia':
				$('#Demergencia').addClass('active1');
				$('#Dcontrato').removeClass('active1');
				$('#Dcontrato').removeClass('d-none');
				$('#Dempresa').removeClass('active1');
				$('#Dbancarios').removeClass('active1');
				$('#Dcorporales').removeClass('active1');
				$('#Dpersonales').removeClass('active1');
				$('#Ddocumentos').removeClass('active1');
				$('#Dfotos').removeClass('active1');
				$('#Dpagos').removeClass('active1');
				$('#Dclave').removeClass('active1');
				
				$('#formulario1').addClass('d-none');
				$('#formulario2').addClass('d-none');
				$('#formulario3').addClass('d-none');
				$('#formulario4').addClass('d-none');
				$('#formulario5').addClass('d-none');
				$('#formulario6').addClass('d-none');
				$('#formulario7').removeClass('d-none');
				$('#formulario8').addClass('d-none');
				$('#formulario9').addClass('d-none');
				$('#formulario10').addClass('d-none');
			break;

			case 'Dfotos':
				$('#Dfotos').addClass('active1');
				$('#Demergencia').removeClass('active1');
				$('#Dcontrato').removeClass('active1');
				$('#Dcontrato').removeClass('d-none');
				$('#Dempresa').removeClass('active1');
				$('#Dbancarios').removeClass('active1');
				$('#Dcorporales').removeClass('active1');
				$('#Dpersonales').removeClass('active1');
				$('#Ddocumentos').removeClass('active1');
				$('#Dpagos').removeClass('active1');
				$('#Dclave').removeClass('active1');
				
				$('#formulario1').addClass('d-none');
				$('#formulario2').addClass('d-none');
				$('#formulario3').addClass('d-none');
				$('#formulario4').addClass('d-none');
				$('#formulario5').addClass('d-none');
				$('#formulario6').addClass('d-none');
				$('#formulario7').addClass('d-none');
				$('#formulario8').removeClass('d-none');
				$('#formulario9').addClass('d-none');
				$('#formulario10').addClass('d-none');
			break;

			case 'Dpagos':
				$('#Dfotos').removeClass('active1');
				$('#Demergencia').removeClass('active1');
				$('#Dcontrato').removeClass('active1');
				$('#Dcontrato').removeClass('d-none');
				$('#Dempresa').removeClass('active1');
				$('#Dbancarios').removeClass('active1');
				$('#Dcorporales').removeClass('active1');
				$('#Dpersonales').removeClass('active1');
				$('#Ddocumentos').removeClass('active1');
				$('#Dpagos').addClass('active1');
				$('#Dclave').removeClass('active1');
				
				$('#formulario1').addClass('d-none');
				$('#formulario2').addClass('d-none');
				$('#formulario3').addClass('d-none');
				$('#formulario4').addClass('d-none');
				$('#formulario5').addClass('d-none');
				$('#formulario6').addClass('d-none');
				$('#formulario7').addClass('d-none');
				$('#formulario8').addClass('d-none');
				$('#formulario9').removeClass('d-none');
				$('#formulario10').addClass('d-none');
			break;

			case 'Dclave':
				$('#Dfotos').removeClass('active1');
				$('#Demergencia').removeClass('active1');
				$('#Dcontrato').removeClass('active1');
				$('#Dcontrato').removeClass('d-none');
				$('#Dempresa').removeClass('active1');
				$('#Dbancarios').removeClass('active1');
				$('#Dcorporales').removeClass('active1');
				$('#Dpersonales').removeClass('active1');
				$('#Ddocumentos').removeClass('active1');
				$('#Dpagos').removeClass('active1');
				$('#Dclave').addClass('active1');
				
				$('#formulario1').addClass('d-none');
				$('#formulario2').addClass('d-none');
				$('#formulario3').addClass('d-none');
				$('#formulario4').addClass('d-none');
				$('#formulario5').addClass('d-none');
				$('#formulario6').addClass('d-none');
				$('#formulario7').addClass('d-none');
				$('#formulario8').addClass('d-none');
				$('#formulario9').addClass('d-none');
				$('#formulario10').removeClass('d-none');
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
	});

	$("#formulario2").on("submit", function(e){
		e.preventDefault();
		var bcpp = $('#BCPP').val();
		var hidden_contador9 = $('#hidden_contador9').val();
		var fd = new FormData();
        var files = $('#acta_cuenta_prestada')[0].files[0];
		if(files==null && bcpp=='Prestada' && hidden_contador9==0){
			Swal.fire({
		 		title: 'Subir Archivo',
			 	text: "Debe colocar una imagen!",
			 	icon: 'error',
			 	position: 'center',
			 	showConfirmButton: false,
			 	timer: 3000
			});
            return false;
		}

        fd.append('file',files);
        fd.append('condicion',"subir_archivo3");
        fd.append('condicion2',"Permiso Bancario");
        fd.append('condicion3',"acta_cuenta_prestada");
        fd.append('id',$('#id').val());
        fd.append('bcpp',$('#BCPP').val());
        fd.append('banco_cedula',$('#banco_cedula').val());
        fd.append('banco_nombre',$('#banco_nombre').val());
        fd.append('banco_tipo',$('#banco_tipo').val());
        fd.append('banco_numero',$('#banco_numero').val());
        fd.append('banco_banco',$('#banco_banco').val());

        $.ajax({
            url: '../script/crud_nomina.php',
            type: 'POST',
            data: fd,
            dataType: "JSON",
            contentType: false,
            processData: false,
		
			success: function(respuesta) {
				console.log(respuesta);

				if(respuesta['estatus']=='error'){
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> pdf",
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

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
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
        fd.append('condicion3',"seguridad_social");
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
            	console.log(response);
            	$('#submit_seguridad_social').removeAttr('disabled');
            	if(response['estatus']=='error'){
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> pdf",
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

            error: function(response){
            	console.log(response['responseText']);
            	$('#submit_seguridad_social').removeAttr('disabled');
            }
        });
    });

	$("#form_eps").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#eps')[0].files[0];
        fd.append('file',files);
        fd.append('condicion',"subir_archivo1");
        fd.append('condicion2',"EPS");
        fd.append('condicion3',"eps");
        fd.append('id',$('#id').val());

        $.ajax({
            url: '../script/crud_nomina.php',
            type: 'POST',
            data: fd,
            dataType: "JSON",
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_eps').attr('disabled','true');
            },

            success: function(response){
            	console.log(response);
            	$('#submit_eps').removeAttr('disabled');
            	if(response['estatus']=='error'){
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> pdf",
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

            error: function(response){
            	console.log(response['responseText']);
            	$('#submit_eps').removeAttr('disabled');
            }
        });
    });

    $("#form_fondo_de_pension").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#fondo_de_pension')[0].files[0];
        fd.append('file',files);
        fd.append('condicion',"subir_archivo1");
        fd.append('condicion2',"Fondo de Pension");
        fd.append('condicion3',"fondo_de_pension");
        fd.append('id',$('#id').val());

        $.ajax({
            url: '../script/crud_nomina.php',
            type: 'POST',
            data: fd,
            dataType: "JSON",
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_fondo_de_pension').attr('disabled','true');
            },

            success: function(response){
            	console.log(response);
            	$('#submit_fondo_de_pension').removeAttr('disabled');
            	if(response['estatus']=='error'){
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> pdf",
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

            error: function(response){
            	console.log(response['responseText']);
            	$('#submit_fondo_de_pension').removeAttr('disabled');
            }
        });
    });

    $("#form_arl").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#arl')[0].files[0];
        fd.append('file',files);
        fd.append('condicion',"subir_archivo1");
        fd.append('condicion2',"ARL");
        fd.append('condicion3',"arl");
        fd.append('id',$('#id').val());

        $.ajax({
            url: '../script/crud_nomina.php',
            type: 'POST',
            data: fd,
            dataType: "JSON",
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_arl').attr('disabled','true');
            },

            success: function(response){
            	console.log(response);
            	$('#submit_arl').removeAttr('disabled');
            	if(response['estatus']=='error'){
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> pdf",
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

            error: function(response){
            	console.log(response['responseText']);
            	$('#submit_arl').removeAttr('disabled');
            }
        });
    });

    $("#form_antecedentes_penales").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#antecedentes_penales')[0].files[0];
        fd.append('file',files);
        fd.append('condicion',"subir_archivo1");
        fd.append('condicion2',"Antecedentes Penales");
        fd.append('condicion3',"antecedentes_penales");
        fd.append('id',$('#id').val());

        $.ajax({
            url: '../script/crud_nomina.php',
            type: 'POST',
            data: fd,
            dataType: "JSON",
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_antecedentes_penales').attr('disabled','true');
            },

            success: function(response){
            	console.log(response);
            	$('#submit_antecedentes_penales').removeAttr('disabled');
            	if(response['estatus']=='error'){
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> pdf",
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

            error: function(response){
            	console.log(response['responseText']);
            	$('#submit_antecedentes_penales').removeAttr('disabled');
            }
        });
    });

    $("#form_hoja_de_vida").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#hoja_de_vida')[0].files[0];
        fd.append('file',files);
        fd.append('condicion',"subir_archivo1");
        fd.append('condicion2',"Hoja de Vida");
        fd.append('condicion3',"hoja_de_vida");
        fd.append('id',$('#id').val());

        $.ajax({
            url: '../script/crud_nomina.php',
            type: 'POST',
            data: fd,
            dataType: "JSON",
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_hoja_de_vida').attr('disabled','true');
            },

            success: function(response){
            	console.log(response);
            	$('#submit_hoja_de_vida').removeAttr('disabled');
            	if(response['estatus']=='error'){
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> pdf",
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

            error: function(response){
            	console.log(response['responseText']);
            	$('#submit_hoja_de_vida').removeAttr('disabled');
            }
        });
    });

    $("#form_identificacion").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#identificacion')[0].files[0];
        fd.append('file',files);
        fd.append('condicion',"subir_archivo1");
        fd.append('condicion2',"Identificacion");
        fd.append('condicion3',"identificacion");
        fd.append('id',$('#id').val());

        $.ajax({
            url: '../script/crud_nomina.php',
            type: 'POST',
            data: fd,
            dataType: "JSON",
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_identificacion').attr('disabled','true');
            },

            success: function(response){
            	console.log(response);
            	$('#submit_identificacion').removeAttr('disabled');
            	if(response['estatus']=='error'){
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> pdf",
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

            error: function(response){
            	console.log(response['responseText']);
            	$('#submit_identificacion').removeAttr('disabled');
            }
        });
    });

    $("#formulario6").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#firma_digital')[0].files[0];
        fd.append('file',files);
        fd.append('id',$('#contrato_id').val());
        fd.append('condicion',"subir_archivo2");

        $.ajax({
            url: '../script/crud_nomina.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_firma_digital').attr('disabled','true');
            },

            success: function(response){
            	console.log(response);
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

    $("#formulario7").on("submit", function(e){
		e.preventDefault();
		var id = $('#id').val();
		var emergencia_nombre = $('#emergencia_nombre').val();
		var emergencia_telefono = $('#emergencia_telefono').val();
		var emergencia_parentesco = $('#emergencia_parentesco').val();
        $.ajax({
            url: '../script/crud_nomina.php',
            type: 'POST',
            dataType: "JSON",
            data: {
            	"id":id,
            	"emergencia_nombre":emergencia_nombre,
            	"emergencia_telefono":emergencia_telefono,
            	"emergencia_parentesco":emergencia_parentesco,
            	"condicion":"guardar_emergencia",
            },

            beforeSend: function (){},

            success: function(response){
            	console.log(response);
            	Swal.fire({
	 				title: 'Correcto',
	 				text: "Datos Guardados",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: true,
	 				confirmButtonColor: '#3085d6',
	 				confirmButtonText: 'Aceptar',
	 				timer: 3000
				});
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    });

    $("#form_rut").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#rut')[0].files[0];
        fd.append('file',files);
        fd.append('condicion',"subir_archivo1");
        fd.append('condicion2',"Rut");
        fd.append('condicion3',"rut");
        fd.append('id',$('#id').val());

        $.ajax({
            url: '../script/crud_nomina.php',
            type: 'POST',
            data: fd,
            dataType: "JSON",
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_rut').attr('disabled','true');
            },

            success: function(response){
            	console.log(response);
            	$('#submit_identificacion').removeAttr('disabled');
            	if(response['estatus']=='error'){
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> pdf",
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

            error: function(response){
            	console.log(response['responseText']);
            	$('#submit_identificacion').removeAttr('disabled');
            }
        });
    });

    $("#formulario10").on("submit", function(e){
		e.preventDefault();
		var id_nomina_hidden = $('#id_nomina_hidden').val();
		var clave_password1 = $('#clave_password1').val();
		var clave_password2 = $('#clave_password2').val();

		if(clave_password1!=clave_password2){
			Swal.fire({
	 			title: 'Error',
	 			text: "Claves no coinciden",
	 			icon: 'error',
	 			position: 'center',
	 			showConfirmButton: false,
	 			timer: 3000
			});
			return false;
		}

        $.ajax({
            url: '../script/crud_nomina.php',
            type: 'POST',
            dataType: "JSON",
            data: {
            	"id":id_nomina_hidden,
            	"clave_password1":clave_password1,
            	"clave_password2":clave_password2,
            	"condicion":"cambiar_clave1",
            },

            beforeSend: function (){},

            success: function(response){
            	console.log(response);
            	Swal.fire({
	 				title: 'Correcto',
	 				text: "Contraseña Actualizada",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: false,
	 				timer: 3000
				});
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    });

    $("#form_certificacion_bancaria").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#certificacion_bancaria')[0].files[0];
        fd.append('file',files);
        fd.append('condicion',"subir_archivo1");
        fd.append('condicion2',"Certificacion Bancaria");
        fd.append('condicion3',"certificacion_bancaria");
        fd.append('id',$('#id').val());

        $.ajax({
            url: '../script/crud_nomina.php',
            type: 'POST',
            data: fd,
            dataType: "JSON",
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_certificacion_bancaria').attr('disabled','true');
            },

            success: function(response){
            	console.log(response);
            	$('#submit_certificacion_bancaria').removeAttr('disabled');
            	if(response['estatus']=='error'){
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> pdf",
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

            error: function(response){
            	console.log(response['responseText']);
            	$('#submit_identificacion').removeAttr('disabled');
            }
        });
    });

    function prestada1(value){
    	if(value=='Prestada'){
    		$('#div_acta_cuenta_prestada').show();
    	}else{
    		$('#div_acta_cuenta_prestada').hide();
    	}
    }


	/********************************************/

</script>