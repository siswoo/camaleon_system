<?php
	session_start();
	if(!isset($_SESSION['nombre']) or $_SESSION["rol"]!=5){
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
	echo '
		<input type="hidden" name="usuario_hidden" id="usuario_hidden" value="'.$usuario.'">
	';
	$ubicacion = "perfil";
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
	$sql1 = "SELECT * FROM modelos WHERE usuario = '".$usuario."'";
	$consulta1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($consulta1);
	if($contador1>=1){
		while($row = mysqli_fetch_array($consulta1)) {
			/**************PERSONAL******************/
			$id=$row['id'];
			$documento_tipo=$row['documento_tipo'];
			$documento_numero=$row['documento_numero'];
			$nombre1=$row['nombre1'];
			$nombre2=$row['nombre2'];
			$apellido1=$row['apellido1'];
			$apellido2=$row['apellido2'];
			$correo=$row['correo'];
			$telefono1=$row['telefono1'];
			$telefono2=$row['telefono2'];
			$direccion=$row['direccion'];
			$genero=$row['genero'];
			$barrio=$row['barrio'];
			$nickname=$row['sugerenciaNickname'];
			$perfil_transmision=$row['perfil_de_transmision'];
			
			/***********BANCARIO*******************/
			$banco_cedula=$row['banco_cedula'];
			$banco_nombre=$row['banco_nombre'];
			$banco_tipo=$row['banco_tipo'];
			$banco_numero=$row['banco_numero'];
			$banco_banco=$row['banco_banco'];
			$bcpp=$row['BCPP'];
			$banco_tipo_documento=$row['banco_tipo_documento'];
			
			/*********CORPORALES*************/
			$altura=$row['altura'];
			$peso=$row['peso'];
			$tpene=$row['tpene'];
			$tsosten=$row['tsosten'];
			$tbusto=$row['tbusto'];
			$tcintura=$row['tcintura'];
			$tcaderas=$row['tcaderas'];
			$tipo_cuerpo=$row['tipo_cuerpo'];
			$Pvello=$row['Pvello'];
			$color_cabello=$row['color_cabello'];
			$color_ojos=$row['color_ojos'];
			$Ptattu=$row['Ptattu'];
			$Ppiercing=$row['Ppiercing'];
			
			/********EMPRESA**************/
			$turno=$row['turno'];
			$sede=$row['sede'];
			$Htransmision=$row['Htransmision'];
			$select_equipo=$row['select_equipo'];
			$equipo=$row['equipo'];
		}
	}
	?>

	<form id="hidden_form">
		<input type="hidden" id="hidden_id" value="<?php echo $id; ?>">
		<input type="hidden" id="hidden_documento_tipo" value="<?php echo $documento_tipo; ?>">
		<input type="hidden" id="hidden_documento_numero" value="<?php echo $documento_numero; ?>">
		<input type="hidden" id="hidden_nombre1" value="<?php echo $nombre1; ?>">
		<input type="hidden" id="hidden_nombre2" value="<?php echo $nombre2; ?>">
		<input type="hidden" id="hidden_apellido1" value="<?php echo $apellido1; ?>">
		<input type="hidden" id="hidden_apellido2" value="<?php echo $apellido2; ?>">
		<input type="hidden" id="hidden_correo" value="<?php echo $correo; ?>">
		<input type="hidden" id="hidden_telefono1" value="<?php echo $telefono1; ?>">
		<input type="hidden" id="hidden_telefono2" value="<?php echo $telefono2; ?>">
		<input type="hidden" id="hidden_direccion" value="<?php echo $direccion; ?>">
		<input type="hidden" id="hidden_genero" value="<?php echo $genero; ?>">
		<input type="hidden" id="hidden_barrio" value="<?php echo $barrio; ?>">
		<input type="hidden" id="hidden_nickname" value="<?php echo $nickname; ?>">
		<input type="hidden" id="hidden_perfil_transmision" value="<?php echo $perfil_transmision; ?>">
	
		<input type="hidden" id="hidden_banco_cedula" value="<?php echo $banco_cedula; ?>">
		<input type="hidden" id="hidden_banco_nombre" value="<?php echo $banco_nombre; ?>">
		<input type="hidden" id="hidden_banco_tipo" value="<?php echo $banco_tipo; ?>">
		<input type="hidden" id="hidden_banco_numero" value="<?php echo $banco_numero; ?>">
		<input type="hidden" id="hidden_banco_banco" value="<?php echo $banco_banco; ?>">
		<input type="hidden" id="hidden_bcpp" value="<?php echo $bcpp; ?>">
		<input type="hidden" id="hidden_banco_tipo_documento" value="<?php echo $banco_tipo_documento; ?>">

		<input type="hidden" id="hidden_altura" value="<?php echo $altura; ?>">
		<input type="hidden" id="hidden_peso" value="<?php echo $peso; ?>">
		<input type="hidden" id="hidden_tpene" value="<?php echo $tpene; ?>">
		<input type="hidden" id="hidden_tsosten" value="<?php echo $tsosten; ?>">
		<input type="hidden" id="hidden_tbusto" value="<?php echo $tbusto; ?>">
		<input type="hidden" id="hidden_tcintura" value="<?php echo $tcintura; ?>">
		<input type="hidden" id="hidden_tcaderas" value="<?php echo $tcaderas; ?>">
		<input type="hidden" id="hidden_tipo_cuerpo" value="<?php echo $tipo_cuerpo; ?>">
		<input type="hidden" id="hidden_Pvello" value="<?php echo $Pvello; ?>">
		<input type="hidden" id="hidden_color_cabello" value="<?php echo $color_cabello; ?>">
		<input type="hidden" id="hidden_color_ojos" value="<?php echo $color_ojos; ?>">
		<input type="hidden" id="hidden_Ptattu" value="<?php echo $Ptattu; ?>">
		<input type="hidden" id="hidden_Ppiercing" value="<?php echo $Ppiercing; ?>">

		<input type="hidden" id="hidden_turno" value="<?php echo $turno; ?>">
		<input type="hidden" id="hidden_sede" value="<?php echo $sede; ?>">
		<input type="hidden" id="hidden_Htransmision" value="<?php echo $Htransmision; ?>">
		<input type="hidden" id="hidden_select_equipo" value="<?php echo $select_equipo; ?>">
		<input type="hidden" id="hidden_equipo" value="<?php echo $equipo; ?>">
	</form>

	<?php include('nabvar_modelo.php'); ?>

	<div class="container">
		<!--
		<div class="row">
			<div class="col-1"><a href="../script/cerrar_sesion.php"><button class="btn btn-info mt-2">Salir</button></a></div>
			<h1 class="col-10 text-center mt-2">Completar todos los datos</h1>
			<div class="col-1"></div>
		</div>
		-->

		<h1 class="col-12 text-center mt-2" style="text-transform: capitalize;">Progreso Camaleón Models <span id="progreso_html1"></span></h1>

		<div class="progress mb-3">
			<div class="progress-bar" id="progressbar" role="progressbar" style="" aria-valuemin="0" aria-valuemax="100"></div>
		</div>

		<ul class="nav nav-tabs mb-2">
			<li class="nav-item">
				<a class="nav-link active1" href="#" id="Dpersonales" onclick="pestañas(this.id);" style="color:white; text-transform: uppercase;">Personales</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#" id="Dbancarios" onclick="pestañas(this.id);" style="color:white; text-transform: uppercase;">Bancarios</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#" id="Dcorporales" onclick="pestañas(this.id);" style="color:white; text-transform: uppercase;">Corporales</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#" id="Dempresa" onclick="pestañas(this.id);" style="color:white; text-transform: uppercase;">Empresa</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#" id="Ddocumentos" onclick="pestañas(this.id);" style="color:white; text-transform: uppercase;">Documentos</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#" id="Dcontrato" onclick="pestañas(this.id);" style="color:white; text-transform: uppercase;">Contrato</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#" id="Dcuentas" onclick="pestañas(this.id);" style="color:white; text-transform: uppercase;">Cuentas</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#" id="Dfotos" onclick="pestañas(this.id);" style="color:white; text-transform: uppercase;">Fotos</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#" id="Dpagos" onclick="pestañas(this.id);" style="color:white; text-transform: uppercase;">Pagos</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#" id="Dclave" onclick="pestañas(this.id);" style="color:white; text-transform: uppercase;">Clave</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#" id="Dsoporte" onclick="pestañas(this.id);" style="color:white; text-transform: uppercase;">Soporte</a>
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
				<select name="tipo_documento" id="tipo_documento" class="form-control" disabled>
					<option value="">Seleccione</option>
					<option value="Cedula de Ciudadania">Cedula de Ciudadania</option>
					<option value="Cedula de Extranjeria">Cedula de Extranjeria</option>
					<option value="PEP">PEP</option>
				</select>
			</div>
			<div class="col-6 form-group form-check">
				<label for="numero_documento">Número de Documento</label>
				<input type="text" name="numero_documento" id="numero_documento" class="form-control" minlength="6" autocomplete="off" disabled>
			</div>
		</div>

		<div class="row">
			<div class="col-6 form-group form-check">
				<label for="primer_nombre">Primer Nombre</label>
				<input type="text" name="primer_nombre" id="primer_nombre" class="form-control" minlength="4" autocomplete="off" disabled>
			</div>

			<div class="col-6 form-group form-check">
				<label for="segundo_nombre">Segundo Nombre</label>
				<input type="text" name="segundo_nombre" id="segundo_nombre" minlength="4" autocomplete="off" class="form-control">
			</div>

			<div class="col-6 form-group form-check">
				<label for="primer_apellido">Primer Apellido</label>
				<input type="text" name="primer_apellido" id="primer_apellido" minlength="4" autocomplete="off" class="form-control" disabled>
			</div>

			<div class="col-6 form-group form-check">
				<label for="segundo_apellido">Segundo Apellido</label>
				<input type="text" name="segundo_apellido" id="segundo_apellido" minlength="4" autocomplete="off" class="form-control" disabled>
			</div>
		</div>

		<div class="row">
			<div class="col-6 form-group form-check">
				<label for="correo">Correo</label>
				<input type="email" name="correo" id="correo" class="form-control" autocomplete="off" disabled>
			</div>

			<div class="col-6 form-group form-check">
				<label for="telefono1">Número WhatsApp <small style="color:#F2B76F; font-size: 17px;">*</small></label>
				<input type="text" name="telefono1" id="telefono1" class="form-control" autocomplete="off" required>
			</div>

			<div class="col-6 form-group form-check">
				<label for="telefono2">Teléfono Opcional</label>
				<input type="text" name="telefono2" id="telefono2" autocomplete="off" class="form-control">
			</div>

			<div class="col-6 form-group form-check">
				<label for="direccion">Dirección</label>
				<input type="text" name="direccion" id="direccion" autocomplete="off" class="form-control">
			</div>

			<div class="col-6 form-group form-check">
				<label for="genero">Género</label>
				<select class="form-control" id="genero" name="genero" disabled>
					<option value="">Seleccione</option>
					<option value="Hombre">Hombre</option>
					<option value="Mujer">Mujer</option>
					<option value="Transexual">Transexual</option>
				</select>
			</div>

			<div class="col-6 form-group form-check">
				<label for="barrio">Barrio</label>
				<input type="text" name="barrio" id="barrio" autocomplete="off" class="form-control" required>
			</div>
			<div class="col-6 form-group form-check">
				<label for="nickname">NickName de Referencia <small style="color:#F2B76F; font-size: 17px;">*</small></label>
				<small style="color:red; margin-left: 1rem;">(Este usuario es el nombre de tus páginas)</small>
				<input type="text" name="nickname" id="nickname" autocomplete="off" class="form-control" required>
			</div>
			<div class="col-6 form-group form-check">
				<label for="perfil_transmision">Perfil de Transmisión <small style="color:#F2B76F; font-size: 17px;">*</small></label>
				<select class="form-control" name="perfil_transmision" id="perfil_transmision" required>
					<option value="">Seleccione</option>
					<option value="Hombre">Hombre</option>
					<option value="Mujer">Mujer</option>
					<option value="Trans">Trans</option>
					<option value="Parejas">Parejas</option>
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
	<!--**********************DATOS BANCARIOS*********************-->
	<!--***********************************************************-->
	<form class="d-none" action="#" method="POST" id="formulario2">
		<input type="hidden" id="asunto" name="asunto" value="bancarios">
		<input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
		<div class="row">

			<div class="col-6 form-group form-check">
				<label for="enlazar">Cuenta Propia o Prestada? <small style="color:#F2B76F; font-size: 17px;">*</small></label>
				<select name="BCPP" class="form-control" id="BCPP" onchange="alerta1(value);" required>
					<option value="">Seleccione</option>
					<option value="Propia">Propia</option>
					<option value="Prestada">Prestada</option>
				</select>
			</div>

			<div class="col-6 form-group form-check">
				<label for="banco_tipo_documento">Tipo de Documento del Titular <small style="color:#F2B76F; font-size: 17px;">*</small></label>
				<select name="banco_tipo_documento" class="form-control" id="banco_tipo_documento" required>
					<option value="">Seleccione</option>
					<option value="PEP">PEP</option>
					<option value="Pasaporte">Pasaporte</option>
					<option value="Cedula de Ciudadania">Cedula de Ciudadania</option>
					<option value="NIT">NIT</option>
					<option value="NIT de extranjeria">NIT de extranjeria</option>
				</select>
			</div>

			<div class="col-6 form-group form-check">
				<label for="banco_cedula">N° Cédula Titular <small style="color:#F2B76F; font-size: 17px;">*</small></label>
				<input type="text" name="banco_cedula" id="banco_cedula" class="form-control" autocomplete="off" required>
			</div>

			<div class="col-6 form-group form-check">
				<label for="banco_nombre">Nombre Titular <small style="color:#F2B76F; font-size: 17px;">*</small></label>
				<input type="text" name="banco_nombre" id="banco_nombre" class="form-control" autocomplete="off" required>
			</div>

			<div class="col-6 form-group form-check">
				<label for="banco_tipo">Tipo de Cuenta <small style="color:#F2B76F; font-size: 17px;">*</small></label>
				<select name="banco_tipo" class="form-control" id="banco_tipo" required>
					<option value="">Seleccione</option>
					<option value="Ahorro">Ahorro</option>
					<option value="Corriente">Corriente</option>
				</select>
			</div>

			<div class="col-6 form-group form-check">
				<label for="banco_numero">N° de Cuenta <small style="color:#F2B76F; font-size: 17px;">*</small></label>
				<input type="text" name="banco_numero" id="banco_numero" class="form-control" autocomplete="off" required>
			</div>

			<div class="col-12 form-group form-check">
				<label for="banco_banco">Banco <small style="color:#F2B76F; font-size: 17px;">*</small></label>
				<select name="banco_banco" class="form-control" id="banco_banco" required>
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
			/****************************************************************************************/
			/*****************************DOCUMENTO DE CUENTA PRESTADA**********************************/
			/****************************************************************************************/
			$sql9 = "SELECT * FROM modelos_documentos WHERE id_modelos = ".$id." and id_documentos = 14";
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
						<img src="../resources/documentos/modelos/archivos/'.$id.'/acta_cuenta_prestada.jpg" class="img-fluid" style="max-width:170px;">
					</div>
					<div style="display:none;">
						<input type="file" name="acta_cuenta_prestada" id="acta_cuenta_prestada" class="form-control">
					</div>
				';
			}else{ ?>
				<div id="div_acta_cuenta_prestada" class="text-center col-12 mt-1 mb-2" style="font-size: 20px; font-weight: bold;">
					Acta de Cuenta Prestada ><a href="ejemplo1.jpg" target="_blank">Ejemplo</a><
					<p style="font-size: 14px;">Solo si su cuenta es prestada</p>
				</div>
				<div class="col-3">&nbsp;</div>
				<div id="div_acta_cuenta_prestada" class="text-center col-6 mt-3 mb-3">
					<input type="file" name="acta_cuenta_prestada" id="acta_cuenta_prestada" class="form-control">
				</div>
				<div class="col-3">&nbsp;</div>
			<?php 
			} 
			/****************************************************************************************/
			/****************************************************************************************/
			/****************************************************************************************/
			?>

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
	<!--**********************DATOS CORPORALES*********************-->
	<!--***********************************************************-->
	<form class="d-none" action="#" method="POST" id="formulario3">
		<input type="hidden" id="asunto" name="asunto" value="corporales">
		<input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
		<input type="hidden" id="f3_genero" name="f3_genero" value="<?php echo $genero; ?>">
		<div class="row">
			<div class="col-6 form-group form-check">
				<label for="altura">Altura <small style="color:#F2B76F; font-size: 17px;">*</small></label>
				<input type="text" name="altura" id="altura" class="form-control" autocomplete="off" required>
			</div>

			<div class="col-6 form-group form-check">
				<label for="peso">Peso (Kg) <small style="color:#F2B76F; font-size: 17px;">*</small></label>
				<input type="text" name="peso" id="peso" class="form-control" autocomplete="off" required>
			</div>
			<?php
			if($genero=='Hombre' or $genero=='Transexual'){ ?>
				<div class="col-6 form-group form-check">
					<label for="tpene">Tamaño de Pene (Cm) <small style="color:#F2B76F; font-size: 17px;">*</small></label>
					<input type="text" name="tpene" id="tpene" class="form-control" autocomplete="off" required>
				</div>
			<?php } ?>

			<?php
			if($genero=='Mujer' or $genero=='Transexual'){ ?>
			<div class="col-6 form-group form-check">
				<label for="tsosten">Tamaño de Sosten<small style="color:#F2B76F; font-size: 17px;">*</small></label>
				<select class="form-control" name="tsosten" id="tsosten" required>
					<option value="">Seleccione</option>
					<option value="32A">32A</option>
					<option value="32B">32B</option>
					<option value="32C">32C</option>
					<option value="32D">32D</option>
					<option value="34A">34A</option>
					<option value="34B">34B</option>
					<option value="34C">34C</option>
					<option value="34D">34D</option>
					<option value="36A">36A</option>
					<option value="36B">36B</option>
					<option value="36C">36C</option>
					<option value="36D">36D</option>
					<option value="38A">38A</option>
					<option value="38B">38B</option>
					<option value="38C">38C</option>
					<option value="38D">38D</option>
					<option value="40A">40A</option>
					<option value="40B">40B</option>
					<option value="40C">40C</option>
					<option value="40D">40D</option>
				</select>
			</div>

			<div class="col-6 form-group form-check">
				<label for="tbusto">Medida del Busto <small style="color:#F2B76F; font-size: 17px;">*</small></label>
				<input type="text" name="tbusto" id="tbusto" class="form-control" autocomplete="off" required>
			</div>

			<div class="col-6 form-group form-check">
				<label for="tcintura">Medida de Cintura <small style="color:#F2B76F; font-size: 17px;">*</small></label>
				<input type="text" name="tcintura" id="tcintura" class="form-control" autocomplete="off" required>
			</div>

			<div class="col-6 form-group form-check">
				<label for="tcaderas">Medida de Caderas <small style="color:#F2B76F; font-size: 17px;">*</small></label>
				<input type="text" name="tcaderas" id="tcaderas" class="form-control" autocomplete="off" required>
			</div>
			<?php } ?>

			<div class="col-6 form-group form-check">
				<label for="tipo_cuerpo">Tipo de Cuerpo <small style="color:#F2B76F; font-size: 17px;">*</small></label>
				<select class="form-control" name="tipo_cuerpo" id="tipo_cuerpo" required>
					<option value="">Seleccione</option>
					<option value="Delgado">Delgado</option>
					<option value="Promedio">Promedio</option>
					<option value="Atlético">Atlético</option>
					<option value="Obeso">Obeso</option>
					<option value="Alto y Grande">Alto y Grande</option>
				</select>
			</div>

			<div class="col-6 form-group form-check">
				<label for="Pvello">¿Posee Vello Púbico? <small style="color:#F2B76F; font-size: 17px;">*</small></label>
				<select class="form-control" name="Pvello" id="Pvello" required>
					<option value="">Seleccione</option>
					<option value="Peludo">Peludo</option>
					<option value="Recortado">Recortado</option>
					<option value="Afeitado">Afeitado</option>
					<option value="Calvo">Calvo</option>
				</select>
			</div>

			<div class="col-6 form-group form-check">
				<label for="color_cabello">Color de Cabello <small style="color:#F2B76F; font-size: 17px;">*</small></label>
				<input type="text" name="color_cabello" class="form-control" id="color_cabello" autocomplete="off" required>
			</div>

			<div class="col-6 form-group form-check">
				<label for="color_ojos">Color de Ojos <small style="color:#F2B76F; font-size: 17px;">*</small></label>
				<input type="text" name="color_ojos" class="form-control" id="color_ojos" autocomplete="off" required>
			</div>

			<div class="col-6 form-group form-check">
				<label for="Ptattu">¿Posee Tattoo? <small style="color:#F2B76F; font-size: 17px;">*</small></label>
				<select class="form-control" id="Ptattu" name="Ptattu" required>
					<option value="">Seleccione</option>
					<option value="Si">Si</option>
					<option value="No">No</option>
				</select>
			</div>

			<div class="col-6 form-group form-check">
				<label for="Ppiercing">¿Posee Piercing? <small style="color:#F2B76F; font-size: 17px;">*</small></label>
				<select class="form-control" id="Ppiercing" name="Ppiercing" required>
					<option value="">Seleccione</option>
					<option value="Si">Si</option>
					<option value="No">No</option>
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
	<!--**********************DATOS EMPRESA*********************-->
	<!--***********************************************************-->
	<form class="d-none" action="#" method="POST" id="formulario4">
		<input type="hidden" id="asunto" name="asunto" value="empresa">
		<input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
		<div class="row">
			<div class="col-6 form-group form-check">
				<label for="turno">Turno</label>
				<select name="turno" id="turno" class="form-control" disabled>
					<option value="">Seleccione</option>
					<option value="Mañana">Mañana</option>
					<option value="Tarde">Tarde</option>
					<option value="Noche">Noche</option>
					<option value="Satelite">Satelite</option>
				</select>
			</div>

			<div class="col-6 form-group form-check">
				<label for="sede">Sede</label>
				<select name="sede" id="sede" class="form-control" disabled>
					<option value="">Seleccione</option>
					<option value="2">Norte</option>
					<option value="3">Occidente 1</option>
					<option value="1">VIP Occidente</option>
					<option value="4">VIP Suba</option>
				</select>
			</div>

			<div class="col-12 form-group form-check">
				<label for="Htransmision">Horario de Transmisión</label>
				<select name="Htransmision" id="Htransmision" id="Htransmision" class="form-control" disabled>
					<option value="">Seleccione</option>
					<option value="Mañana">Mañana</option>
					<option value="Tarde">Tarde</option>
					<option value="Noche">Noche</option>
				</select>
			</div>
			<!--
			<div class="col-12 form-group form-check">
				<label for="equipo">Equipo <small style="color:#F2B76F; font-size: 17px;">*</small></label>
				<select name="equipo" id="equipo" class="form-control" id="select_equipo" required>
					<option value="">Seleccione</option>
					<option value="Individual">Individual</option>
					<option value="Pareja">Pareja</option>
					<option value="Trio">Trio</option>
					<option value="Cuarteto">Cuarteto</option>
					<option value="Quinteto">Quinteto</option>
				</select>
			</div>
			-->

			<div class="col-12" id="divEquipos" style="display: none;">
				<hr>
				<div class="col-12 form-group form-check">
					<label for="enlazar">Enlazar al Equipo?</label>
					<select name="select_enlazar" id="select_enlazar" class="form-control" id="select_enlazar" ></select>
				</div>
				<hr>
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
		$sql3 = "SELECT * FROM modelos_documentos WHERE id_modelos = ".$id;
		$consulta3 = mysqli_query($conexion,$sql3);
		$contador3 = mysqli_num_rows($consulta3);

		$html_documento_identidad='';
		$html_pasaporte='';
		$html_rut='';
		$html_certificacion_bancaria='';
		$html_eps='';
		$html_antecedentes_disciplinarios='';
		$html_foto_cedula_con_cara='';
		$html_foto_cedula_parte_frontal_cara='';
		$html_foto_cedula_parte_respaldo='';
		$html_antecedentes_penales='';

		if($contador3>=1){
			while($row3 = mysqli_fetch_array($consulta3)) {
				$id_documento = $row3['id_documentos'];
				$file_tipo = $row3['tipo'];
				$sql4 = "SELECT * FROM documentos WHERE id =".$id_documento;
				$consulta4 = mysqli_query($conexion,$sql4);
				while($row4 = mysqli_fetch_array($consulta4)) {
					$nombre_documento = $row4['nombre'];

					switch ($nombre_documento) {
						/*
						case 'Documento de Identidad':
							$html_documento_identidad = '
								<form id="form_documento_identidad" enctype="multipart/form-data" method="POST">
									<div class="row">
										<div class="col-6 form-group form-check text-center">
											<label for="turno">Documento de Identidad (Subida Actualmente)</label>
											';

											if($file_tipo=='pdf'){
												$html_documento_identidad.= '
													<p>	<embed src="../resources/documentos/modelos/archivos/'.$id.'/documento_identidad.pdf#toolbar=0" type="application/pdf" width="100%" height="300px" /></p>
												';
											}else{
												$html_documento_identidad.= '
													<p>
														<a href="../resources/documentos/modelos/archivos/'.$id.'/documento_identidad.jpg" data-lightbox="Documentos1" data-title="Documento de Identidad">
															<img src="../resources/documentos/modelos/archivos/'.$id.'/documento_identidad.jpg" style="width:250px;border-radius:5px;">
														</a>
													</p>
												';
											}

										$html_documento_identidad.= '
										</div>
										<div class="col-6 form-group form-check" style="margin-top:2rem;">
											<button type="submit" class="btn btn-success" id="submit_documento_identidad" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
											<label for="turno">Documento de Identidad</label>
											<input type="file" style="height:43px;" class="form-control" name="documento_identidad" id="documento_identidad" required>
										</div>
									</div>
								</form>
								<hr style="background-color: white;">
							';
						break;
						*/

						case 'Pasaporte':
							$html_pasaporte = '
								<form id="form_pasaporte" enctype="multipart/form-data" method="POST">
									<div class="row">
										<div class="col-12 form-group form-check text-center">
											<label for="turno">Pasaporte (Subida Actualmente)</label>
											';

											if($file_tipo=='pdf'){
												$html_pasaporte.= '
													<p>	<embed src="../resources/documentos/modelos/archivos/'.$id.'/pasaporte.pdf#toolbar=0" type="application/pdf" width="100%" height="400px" /></p>
												';
											}else{
												$html_pasaporte.= '
													<p>
														<a href="../resources/documentos/modelos/archivos/'.$id.'/pasaporte.jpg" data-lightbox="Documentos1" data-title="Pasaporte">
															<img src="../resources/documentos/modelos/archivos/'.$id.'/pasaporte.jpg" style="width:250px;border-radius:5px;">
														</a>
													</p>
												';
											}

										$html_pasaporte.= '
										</div>
										<!--
										<div class="col-6 form-group form-check" style="margin-top:2rem;">
											<button type="submit" class="btn btn-success" id="submit_pasaporte" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
											<label for="turno">Pasaporte</label>
											<input type="file" style="height:43px;" class="form-control" name="pasaporte" id="pasaporte" required>
										</div>
										-->
									</div>
								</form>
								<hr style="background-color: white;">
							';
						break;

						case 'RUT':
							$html_rut = '
								<form id="form_rut" enctype="multipart/form-data" method="POST">
									<div class="row">
										<div class="col-12 form-group form-check text-center">
											<label for="turno">RUT (Subida Actualmente)</label>
											';

											if($file_tipo=='pdf'){
												$html_rut.= '
													<p><embed src="../resources/documentos/modelos/archivos/'.$id.'/rut.pdf#toolbar=0" type="application/pdf" width="100%" height="400px" /></p>
												';
											}else{
												$html_rut.= '
													<p>
														<a href="../resources/documentos/modelos/archivos/'.$id.'/rut.jpg" data-lightbox="Documentos1" data-title="RUT">
															<img src="../resources/documentos/modelos/archivos/'.$id.'/rut.jpg" style="width:250px;border-radius:5px;">
														</a>
													</p>
												';
											}

										$html_rut.= '
										</div>
										<!--
										<div class="col-6 form-group form-check" style="margin-top:2rem;">
											<button type="submit" class="btn btn-success" id="submit_rut" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
											<label for="turno">RUT</label>
											<input type="file" style="height:43px;" class="form-control" name="rut" id="rut" required>
										</div>
										-->
									</div>
								</form>
								<hr style="background-color: white;">
							';
						break;

						case 'Certificación Bancaria':
							$html_certificacion_bancaria = '
								<form id="form_certificacion_bancaria" enctype="multipart/form-data" method="POST">
									<div class="row">
										<div class="col-12 form-group form-check text-center">
											<label for="turno">Certificación Bancaria (Subida Actualmente)</label>
											';

											if($file_tipo=='pdf'){
												$html_certificacion_bancaria.= '
													<p><embed src="../resources/documentos/modelos/archivos/'.$id.'/certificacion_bancaria.pdf#toolbar=0" type="application/pdf" width="100%" height="400px" /></p>
												';
											}else{
												$html_certificacion_bancaria.= '
													<p>
														<a href="../resources/documentos/modelos/archivos/'.$id.'/certificacion_bancaria.jpg" data-lightbox="Documentos1" data-title="Certificación Bancaria">
															<img src="../resources/documentos/modelos/archivos/'.$id.'/certificacion_bancaria.jpg" style="width:250px;border-radius:5px;">
														</a>
													</p>
												';
											}

										$html_certificacion_bancaria.= '
										</div>
										<!--
										<div class="col-6 form-group form-check" style="margin-top:2rem;">
											<button type="submit" class="btn btn-success" id="submit_certificacion_bancaria" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
											<label for="turno">Certificación Bancaria</label>
											<input type="file" style="height:43px;" class="form-control" name="certificacion_bancaria" id="certificacion_bancaria" required>
										</div>
										-->
									</div>
								</form>
								<hr style="background-color: white;">
							';
						break;

						case 'EPS':
							$html_eps = '
								<form id="form_eps" enctype="multipart/form-data" method="POST">
									<div class="row">
										<div class="col-12 form-group form-check text-center">
											<label for="turno">Eps (Subida Actualmente)</label>
											';

											if($file_tipo=='pdf'){
												$html_eps.= '
													<p><embed src="../resources/documentos/modelos/archivos/'.$id.'/eps.pdf#toolbar=0" type="application/pdf" width="100%" height="400px" /></p>
												';
											}else{
												$html_eps.= '
													<p>
														<a href="../resources/documentos/modelos/archivos/'.$id.'/eps.jpg" data-lightbox="Documentos1" data-title="EPS">
															<img src="../resources/documentos/modelos/archivos/'.$id.'/eps.jpg" style="width:250px;border-radius:5px;">
														</a>
													</p>
												';
											}

										$html_eps.= '
										</div>
										<!--
										<div class="col-6 form-group form-check" style="margin-top:2rem;">
											<button type="submit" class="btn btn-success" id="submit_eps" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
											<label for="turno">EPS</label>
											<input type="file" style="height:43px;" class="form-control" name="eps" id="eps" required>
										</div>
										-->
									</div>
								</form>
								<hr style="background-color: white;">
							';
						break;

						case 'Antecedentes Disciplinarios':
							$html_antecedentes_disciplinarios = '
								<form id="form_antecedentes_disciplinarios" enctype="multipart/form-data" method="POST">
									<div class="row">
										<div class="col-12 form-group form-check text-center">
											<label for="turno">Antecedentes Disciplinarios (Subida Actualmente)</label>
											';

											if($file_tipo=='pdf'){
												$html_antecedentes_disciplinarios.= '
													<p><embed src="../resources/documentos/modelos/archivos/'.$id.'/antecedentes_disciplinarios.pdf#toolbar=0" type="application/pdf" width="100%" height="400px" /></p>
												';
											}else{
												$html_antecedentes_disciplinarios.= '
													<p>
														<a href="../resources/documentos/modelos/archivos/'.$id.'/antecedentes_disciplinarios.jpg" data-lightbox="Documentos1" data-title="Antecedentes Disciplinarios">
															<img src="../resources/documentos/modelos/archivos/'.$id.'/antecedentes_disciplinarios.jpg" style="width:250px;border-radius:5px;">
														</a>
													</p>
												';
											}

										$html_antecedentes_disciplinarios.= '
										</div>
										<!--
										<div class="col-6 form-group form-check" style="margin-top:2rem;">
											<button type="submit" class="btn btn-success" id="submit_antecedentes_disciplinarios" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
											<label for="turno">Antecedentes Disciplinarios</label>
											<input type="file" style="height:43px;" class="form-control" name="antecedentes_disciplinarios" id="antecedentes_disciplinarios" required>
										</div>
										-->
									</div>
								</form>
								<hr style="background-color: white;">
							';
						break;
						/*
						case 'Foto Cédula con Cara':
							$html_foto_cedula_con_cara = '
								<form id="form_foto_cedula_con_cara" enctype="multipart/form-data" method="POST">
									<div class="row">
										<div class="col-6 form-group form-check text-center">
											<label for="turno">Foto Cédula con Cara (Subida Actualmente)</label>
											';

											if($file_tipo=='pdf'){
												$html_foto_cedula_con_cara.= '
													<p><embed src="../resources/documentos/modelos/archivos/'.$id.'/foto_cedula_con_cara.pdf#toolbar=0" type="application/pdf" width="100%" height="300px" /></p>
												';
											}else{
												$html_foto_cedula_con_cara.= '
													<p>
														<a href="../resources/documentos/modelos/archivos/'.$id.'/foto_cedula_con_cara.jpg" data-lightbox="Documentos1" data-title="Foto Cédula con Cara">
															<img src="../resources/documentos/modelos/archivos/'.$id.'/foto_cedula_con_cara.jpg" style="width:250px;border-radius:5px;">
														</a>
													</p>
												';
											}

										$html_foto_cedula_con_cara.= '
										</div>
										<div class="col-6 form-group form-check" style="margin-top:2rem;">
											<button type="submit" class="btn btn-success" id="submit_foto_cedula_con_cara" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
											<label for="turno">Foto Cédula con Cara</label>
											<input type="file" style="height:43px;" class="form-control" name="foto_cedula_con_cara" id="foto_cedula_con_cara" required>
										</div>
									</div>
								</form>
								<hr style="background-color: white;">
							';
						break;

						case 'Foto Cédula Parte Frontal Cara':
							$html_foto_cedula_parte_frontal_cara = '
								<form id="form_foto_cedula_parte_frontal_cara" enctype="multipart/form-data" method="POST">
									<div class="row">
										<div class="col-6 form-group form-check text-center">
											<label for="turno">Foto Cédula Parte Frontal Cara (Subida Actualmente)</label>
											';

											if($file_tipo=='pdf'){
												$html_foto_cedula_parte_frontal_cara.= '
													<p><embed src="../resources/documentos/modelos/archivos/'.$id.'/foto_cedula_parte_frontal_cara.pdf#toolbar=0" type="application/pdf" width="100%" height="300px" /></p>
												';
											}else{
												$html_foto_cedula_parte_frontal_cara.= '
													<p>
														<a href="../resources/documentos/modelos/archivos/'.$id.'/foto_cedula_parte_frontal_cara.jpg" data-lightbox="Documentos1" data-title="Foto Cédula Parte Frontal Cara">
															<img src="../resources/documentos/modelos/archivos/'.$id.'/foto_cedula_parte_frontal_cara.jpg" style="width:250px;border-radius:5px;">
														</a>
													</p>
												';
											}

										$html_foto_cedula_parte_frontal_cara.= '
										</div>
										<div class="col-6 form-group form-check" style="margin-top:2rem;">
											<button type="submit" class="btn btn-success" id="submit_foto_cedula_parte_frontal_cara" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
											<label for="turno">Foto Cédula Parte Frontal Cara</label>
											<input type="file" style="height:43px;" class="form-control" name="foto_cedula_parte_frontal_cara" id="foto_cedula_parte_frontal_cara" required>
										</div>
									</div>
								</form>
								<hr style="background-color: white;">
							';
						break;

						case 'Foto Cédula Parte Respaldo':
							$html_foto_cedula_parte_respaldo = '
								<form id="form_foto_cedula_parte_respaldo" enctype="multipart/form-data" method="POST">
									<div class="row">
										<div class="col-6 form-group form-check text-center">
											<label for="turno">Foto Cédula Parte Respaldo (Subida Actualmente)</label>
											';

											if($file_tipo=='pdf'){
												$html_foto_cedula_parte_respaldo.= '
													<p><embed src="../resources/documentos/modelos/archivos/'.$id.'/foto_cedula_parte_respaldo.pdf#toolbar=0" type="application/pdf" width="100%" height="300px" /></p>
												';
											}else{
												$html_foto_cedula_parte_respaldo.= '
													<p>
														<a href="../resources/documentos/modelos/archivos/'.$id.'/foto_cedula_parte_respaldo.jpg" data-lightbox="Documentos1" data-title="Foto Cédula Parte Respaldo">
															<img src="../resources/documentos/modelos/archivos/'.$id.'/foto_cedula_parte_respaldo.jpg" style="width:250px;border-radius:5px;">
														</a>
													</p>
												';
											}

										$html_foto_cedula_parte_respaldo.= '
										</div>
										<div class="col-6 form-group form-check" style="margin-top:2rem;">
											<button type="submit" class="btn btn-success" id="submit_foto_cedula_parte_respaldo" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
											<label for="turno">Foto Cédula Parte Respaldo</label>
											<input type="file" style="height:43px;" class="form-control" name="foto_cedula_parte_respaldo" id="foto_cedula_parte_respaldo" required>
										</div>
									</div>
								</form>
								<hr style="background-color: white;">
							';
						break;
						*/
						case 'Antecedentes Penales':
							$html_antecedentes_penales = '
								<form id="form_antecedentes_penales" enctype="multipart/form-data" method="POST">
									<div class="row">
										<div class="col-12 form-group form-check text-center">
											<label for="turno">Antecedentes Penales (Subida Actualmente)</label>
											';

											if($file_tipo=='pdf'){
												$html_antecedentes_penales.= '
													<p><embed src="../resources/documentos/modelos/archivos/'.$id.'/antecedentes_penales.pdf#toolbar=0" type="application/pdf" width="100%" height="400px" /></p>
												';
											}else{
												$html_antecedentes_penales.= '
													<p>
														<a href="../resources/documentos/modelos/archivos/'.$id.'/antecedentes_penales.jpg" data-lightbox="Documentos1" data-title="Antecedentes Penales">
															<img src="../resources/documentos/modelos/archivos/'.$id.'/antecedentes_penales.jpg" style="width:250px;border-radius:5px;">
														</a>
													</p>
												';
											}

										$html_antecedentes_penales.= '
										</div>
										<!--
										<div class="col-6 form-group form-check" style="margin-top:2rem;">
											<button type="submit" class="btn btn-success" id="submit_antecedentes_penales" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
											<label for="turno">Antecedentes Penales</label>
											<input type="file" style="height:43px;" class="form-control" name="antecedentes_penales" id="antecedentes_penales" required>
										</div>
										-->
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
		/*
		if($html_documento_identidad==''){
			echo '
			<form id="form_documento_identidad" enctype="multipart/form-data" method="POST">
				<div class="row mt-3 mb-3">
					<div class="col-12 form-group form-check">
						<button type="submit" class="btn btn-success" id="submit_documento_identidad" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
						<label for="turno">Documento de Identidad</label>
						<input type="file" style="height:43px;" class="form-control" name="documento_identidad" id="documento_identidad" required>
					</div>
				</div>
			</form>
			<hr style="background-color: white;">
			';
		}else{
			echo $html_documento_identidad;
		}
		*/
		if($html_pasaporte==''){
			echo '
			<form id="form_pasaporte" enctype="multipart/form-data" method="POST">
				<div class="row mt-3 mb-3">
					<div class="col-12 form-group form-check">
						<button type="submit" class="btn btn-success" id="submit_pasaporte" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
						<label for="pasaporte">Cédula o Pasaporte</label>
						<input type="file" style="height:43px;" class="form-control" name="pasaporte" id="pasaporte" required>
					</div>
				</div>
			</form>
			<hr style="background-color: white;">
			';
		}else{
			echo $html_pasaporte;
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
			<hr style="background-color: white;">
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
			<hr style="background-color: white;">
			';
		}else{
			echo $html_certificacion_bancaria;
		}
		if($html_eps==''){
			echo '
			<form id="form_eps" enctype="multipart/form-data" method="POST">
				<div class="row mt-3 mb-3">
					<div class="col-12 form-group form-check">
						<button type="submit" class="btn btn-success" id="submit_eps" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
						<label for="turno">EPS</label>
						<input type="file" style="height:43px;" class="form-control" name="eps" id="eps" required>
					</div>
				</div>
			</form>
			<hr style="background-color: white;">
			';
		}else{
			echo $html_eps;
		}
		if($html_antecedentes_disciplinarios==''){
			echo '
			<form id="form_antecedentes_disciplinarios" enctype="multipart/form-data" method="POST">
				<div class="row mt-3 mb-3">
					<div class="col-12 form-group form-check">
						<button type="submit" class="btn btn-success" id="submit_antecedentes_disciplinarios" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
						<label for="turno">Antecedentes Disciplinarios</label>
						<input type="file" style="height:43px;" class="form-control" name="antecedentes_disciplinarios" id="antecedentes_disciplinarios" required>
					</div>
				</div>
			</form>
			<hr style="background-color: white;">
			';
		}else{
			echo $html_antecedentes_disciplinarios;
		}
		/*
		if($html_foto_cedula_con_cara==''){
			echo '
			<form id="form_foto_cedula_con_cara" enctype="multipart/form-data" method="POST">
				<div class="row mt-3 mb-3">
					<div class="col-12 form-group form-check">
						<button type="submit" class="btn btn-success" id="submit_foto_cedula_con_cara" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
						<label for="turno">Foto Cédula con Cara</label>
						<input type="file" style="height:43px;" class="form-control" name="foto_cedula_con_cara" id="foto_cedula_con_cara" required>
					</div>
				</div>
			</form>
			<hr style="background-color: white;">
			';
		}else{
			echo $html_foto_cedula_con_cara;
		}
		if($html_foto_cedula_parte_frontal_cara==''){
			echo '
			<form id="form_foto_cedula_parte_frontal_cara" enctype="multipart/form-data" method="POST">
				<div class="row mt-3 mb-3">
					<div class="col-12 form-group form-check">
						<button type="submit" class="btn btn-success" id="submit_foto_cedula_parte_frontal_cara" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
						<label for="turno">Foto Cédula Parte Frontal Cara</label>
						<input type="file" style="height:43px;" class="form-control" name="foto_cedula_parte_frontal_cara" id="foto_cedula_parte_frontal_cara" required>
					</div>
				</div>
			</form>
			<hr style="background-color: white;">
			';
		}else{
			echo $html_foto_cedula_parte_frontal_cara;
		}
		if($html_foto_cedula_parte_respaldo==''){
			echo '
			<form id="form_foto_cedula_parte_respaldo" enctype="multipart/form-data" method="POST">
				<div class="row mt-3 mb-3">
					<div class="col-12 form-group form-check">
						<button type="submit" class="btn btn-success" id="submit_foto_cedula_parte_respaldo" style="height: 35px; margin-top: 6px; margin-bottom: 11px;margin-right: 20px;">Subir</button>
						<label for="turno">Foto Cédula Parte Respaldo</label>
						<input type="file" style="height:43px;" class="form-control" name="foto_cedula_parte_respaldo" id="foto_cedula_parte_respaldo" required>
					</div>
				</div>
			</form>
			<hr style="background-color: white;">
			';
		}else{
			echo $html_foto_cedula_parte_respaldo;
		}
		*/
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
			';
		}else{
			echo $html_antecedentes_penales;
		}
		?>
		<!--
		<div class="row">
			<div class="col-md-12 form-group form-check text-center">
				<button type="submit" id="submit" class="btn btn-success" style="width: 20%; font-weight: bold;">Actualizar</button>
			</div>
		</div>
		-->
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
				/*
					echo '<span style="font-weight:bold; font-size:20px;">Debe firmar el contrato y esperar a su validación para poder Iniciar</span>';
					echo '<hr style="background-color: white;">';
					echo '<p><a href="../script/generador_firmas1.php" target="_blank" style="text-decoration:none; font-size:18px; color:white;">- Clic Para Crear Firma Digital -</a></p>';
					echo '<p style="font-size:18px; color:white;">Subir Firma Digital ---- ';
					echo '<input type="file"> </p>';
					echo '<hr style="background-color: white;">';
					echo '<input type="submit" class="btn btn-success" value="Registrar Firma">';
				*/
				}else{
					while($row2 = mysqli_fetch_array($consulta2)) {
						$sql_documentos_id = $row2['id'];
						$sql_documentos_id_documentos = $row2['id_documentos'];
						$sql_documentos_id_modelos = $row2['id_modelos'];
						//$sql_documentos_firma = $row2['firma'];
						$sql_documentos_fecha_inicio = $row2['fecha_inicio'];
					}
					echo '<p for="turno" style="font-size: 22px; text-transform: capitalize;">Ya Tiene una Firma Registrada!</p>';
				}
				?>
			</div>
		</div>
		<!--
		<div class="row">
			<div class="col-md-12 form-group form-check text-center">
				<button type="submit" id="submit" class="btn btn-success" style="width: 20%; font-weight: bold;">Actualizar</button>
			</div>
		</div>
		-->
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
								<img src="../resources/documentos/modelos/archivos/'.$id.'/sensuales_'.$documentos2_id.'.jpg" style="width:400px; border-radius:1rem;">
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

	<!--***********************************************************-->
	<!--**********************Clave*********************-->
	<!--***********************************************************-->
	<form class="d-none" action="#" method="POST" id="formulario10">
		<div class="row">
			<div class="col-12 text-center" style="font-size: 20px; font-weight: bold;">
				Cambiar Contraseña
			</div>
			<div class="col-12 form-group form-check">
				<label for="clave_password1">Nueva Contraseña</label>
				<input type="password" class="form-control" name="clave_password1" id="clave_password1" required>
			</div>
			<div class="col-12 form-group form-check">
				<label for="clave_password2">Repetir Contraseña</label>
				<input type="password" class="form-control" name="clave_password2" id="clave_password2" required>
			</div>
			<div class="col-md-12 form-group form-check text-center">
				<button type="submit" class="btn btn-success" id="submit_clave1" style="width: 20%; font-weight: bold;">Actualizar</button>
			</div>
		</div>
	</form>
	<!--***********************************************************-->
	<!--***********************************************************-->

	<!--***********************************************************-->
	<!--**********************DATOS SOPORTE*********************-->
	<!--***********************************************************-->
	<form class="d-none" action="#" method="POST" id="formulario11">
		<input type="hidden" id="soporte_id" name="soporte_id" value="<?php echo $id; ?>">
		<input type="hidden" id="soporte_condicion" name="soporte_condicion" value="<?php echo $id; ?>">
		<div class="row">
			<div class="col-12 mt-3 form-group form-check">
				<label for="soporte_documento_identidad">Documento de Identidad</label>
				<button type="button" id="soporte_submit1" class="btn btn-success ml-3" style="font-weight: bold; float:right;" onclick="soporte_subir(<?php echo $id; ?>,id)">Subir</button>
				<input type="file" id="soporte_documento_identidad" name="soporte_documento_identidad" class="form-control mt-2">
			</div>

			<div class="col-12 mt-3 form-group form-check">
				<label for="soporte_foto_cedula_con_cara">Foto Cédula con Cara</label>
				<button type="button" id="soporte_submit2" class="btn btn-success ml-3" style="font-weight: bold; float:right;" onclick="soporte_subir(<?php echo $id; ?>,id)">Subir</button>
				<input type="file" id="soporte_foto_cedula_con_cara" name="soporte_foto_cedula_con_cara" class="form-control mt-2">
			</div>

			<div class="col-12 mt-3 form-group form-check">
				<label for="soporte_foto_cedula_parte_frontal_cara">Foto Cédula Parte Frontal Cara</label>
				<button type="button" id="soporte_submit3" class="btn btn-success ml-3" style="font-weight: bold; float:right;" onclick="soporte_subir(<?php echo $id; ?>,id)">Subir</button>
				<input type="file" id="soporte_foto_cedula_parte_frontal_cara" name="soporte_foto_cedula_parte_frontal_cara" class="form-control mt-2">
			</div>

			<div class="col-12 mt-3 form-group form-check">
				<label for="soporte_foto_cedula_parte_respaldo">Foto Cédula Parte Respaldo</label>
				<button type="button" id="soporte_submit4" class="btn btn-success ml-3" style="font-weight: bold; float:right;" onclick="soporte_subir(<?php echo $id; ?>,id)">Subir</button>
				<input type="file" id="soporte_foto_cedula_parte_respaldo" name="soporte_foto_cedula_parte_respaldo" class="form-control mt-2">
			</div>
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
						     	<label for="foto_sensual_1">Foto #1 <small style="color:#F2B76F; font-size: 17px;">*</small></label>
							    <input type="file" style="height:43px;" class="form-control" name="foto_sensual_1" id="foto_sensual_1" required>
							</div>

							<div class="col-12 form-group form-check">
						     	<label for="foto_sensual_2">Foto #2 <small style="color:#F2B76F; font-size: 17px;">*</small></label>
							    <input type="file" style="height:43px;" class="form-control" name="foto_sensual_2" id="foto_sensual_2" required>
							</div>

							<div class="col-12 form-group form-check">
						     	<label for="foto_sensual_3">Foto #3 <small style="color:#F2B76F; font-size: 17px;">*</small></label>
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
	$(document).ready(function(){
		$('#tipo_documento').val($('#hidden_documento_tipo').val());
		$('#numero_documento').val($('#hidden_documento_numero').val());
		$('#primer_nombre').val($('#hidden_nombre1').val());
		$('#segundo_nombre').val($('#hidden_nombre2').val());
		$('#primer_apellido').val($('#hidden_apellido1').val());
		$('#segundo_apellido').val($('#hidden_apellido2').val());
		$('#correo').val($('#hidden_correo').val());
		$('#telefono1').val($('#hidden_telefono1').val());
		$('#telefono2').val($('#hidden_telefono2').val());
		$('#direccion').val($('#hidden_direccion').val());
		$('#genero').val($('#hidden_genero').val());
		$('#barrio').val($('#hidden_barrio').val());
		$('#nickname').val($('#hidden_nickname').val());
		$('#perfil_transmision').val($('#hidden_perfil_transmision').val());

		$('#banco_cedula').val($('#hidden_banco_cedula').val());
		$('#banco_nombre').val($('#hidden_banco_nombre').val());
		$('#banco_tipo').val($('#hidden_banco_tipo').val());
		$('#banco_numero').val($('#hidden_banco_numero').val());
		$('#banco_banco').val($('#hidden_banco_banco').val());
		$('#BCPP').val($('#hidden_bcpp').val());
		$('#banco_tipo_documento').val($('#hidden_banco_tipo_documento').val());

		$('#altura').val($('#hidden_altura').val());
		$('#peso').val($('#hidden_peso').val());
		$('#tpene').val($('#hidden_tpene').val());
		$('#tsosten').val($('#hidden_tsosten').val());
		$('#tbusto').val($('#hidden_tbusto').val());
		$('#tcintura').val($('#hidden_tcintura').val());
		$('#tcaderas').val($('#hidden_tcaderas').val());
		$('#tipo_cuerpo').val($('#hidden_tipo_cuerpo').val());
		$('#Pvello').val($('#hidden_Pvello').val());
		$('#color_cabello').val($('#hidden_color_cabello').val());
		$('#color_ojos').val($('#hidden_color_ojos').val());
		$("#selectall").prop("checked", true);
		$('#Ptattu').val($('#hidden_Ptattu').val());
		$('#Ppiercing').val($('#hidden_Ppiercing').val());
		/*****************************/

		$('#turno').val($('#hidden_turno').val());
		$('#sede').val($('#hidden_sede').val());
		$('#Htransmision').val($('#hidden_Htransmision').val());
		$('#equipo').val($('#hidden_select_equipo').val());
		$('#select_enlazar').val($('#hidden_equipo').val());


		/********Barra de Porcentaje*********/
		setInterval('Bprogreso()',3000);
		/************************************/
		refrescar();
	});

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
				$('#Dclave').removeClass('active1');
				$('#Dsoporte').removeClass('active1');
				
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
				$('#formulario11').addClass('d-none');
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
				$('#Dclave').removeClass('active1');
				$('#Dsoporte').removeClass('active1');
				
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
				$('#formulario11').addClass('d-none');
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
				$('#Dclave').removeClass('active1');
				$('#Dsoporte').removeClass('active1');
				
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
				$('#formulario11').addClass('d-none');
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
				$('#Dclave').removeClass('active1');
				$('#Dsoporte').removeClass('active1');
				
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
				$('#formulario11').addClass('d-none');
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
				$('#Dclave').removeClass('active1');
				$('#Dsoporte').removeClass('active1');
				
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
				$('#formulario11').addClass('d-none');
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
				$('#Dclave').removeClass('active1');
				$('#Dsoporte').removeClass('active1');
				
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
				$('#formulario11').addClass('d-none');
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
				$('#Dclave').removeClass('active1');
				$('#Dsoporte').removeClass('active1');
				
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
				$('#formulario11').addClass('d-none');
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
				$('#Dclave').removeClass('active1');
				$('#Dsoporte').removeClass('active1');
				
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
				$('#formulario11').addClass('d-none');
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
				$('#Dclave').removeClass('active1');
				$('#Dsoporte').removeClass('active1');
				
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
				$('#formulario11').addClass('d-none');
			break;

			case 'Dclave':
				$('#Dfotos').removeClass('active1');
				$('#Dcuentas').removeClass('active1');
				$('#Dcontrato').removeClass('active1');
				$('#Dcontrato').removeClass('d-none');
				$('#Dempresa').removeClass('active1');
				$('#Dbancarios').removeClass('active1');
				$('#Dcorporales').removeClass('active1');
				$('#Dpersonales').removeClass('active1');
				$('#Ddocumentos').removeClass('active1');
				$('#Dpagos').removeClass('active1');
				$('#Dclave').addClass('active1');
				$('#Dsoporte').removeClass('active1');
				
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
				$('#formulario11').addClass('d-none');
			break;

			case 'Dsoporte':
				$('#Dfotos').removeClass('active1');
				$('#Dcuentas').removeClass('active1');
				$('#Dcontrato').removeClass('active1');
				$('#Dcontrato').removeClass('d-none');
				$('#Dempresa').removeClass('active1');
				$('#Dbancarios').removeClass('active1');
				$('#Dcorporales').removeClass('active1');
				$('#Dpersonales').removeClass('active1');
				$('#Ddocumentos').removeClass('active1');
				$('#Dpagos').removeClass('active1');
				$('#Dclave').removeClass('active1');
				$('#Dsoporte').addClass('active1');
				
				$('#formulario1').addClass('d-none');
				$('#formulario2').addClass('d-none');
				$('#formulario3').addClass('d-none');
				$('#formulario4').addClass('d-none');
				$('#formulario5').addClass('d-none');
				$('#formulario6').addClass('d-none');
				$('#formulario7').addClass('d-none');
				$('#formulario8').addClass('d-none');
				$('#formulario9').addClass('d-none');
				$('#formulario10').addClass('d-none');
				$('#formulario11').removeClass('d-none');
			break;
			
		default:
		    console.log('Lo lamentamos, por el momento no disponemos de ' + variable + '.');
		}
	}

	function alerta1(variable){
		if(variable=='Prestada'){
			Swal.fire({
				position: 'center',
				title: 'Te Recordamos',
				text: 'Debes agregar los datos del titular de dicha cuenta!',
				icon: 'info',
				showConfirmButton: true,
				//timer: 3000
			})

			//$('#bancario_oculto1').val(); PENDIENTE
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
        fd.append('condicion',"subir_archivo1");
        fd.append('condicion2',"Permiso Bancario");
        fd.append('condicion3',"acta_cuenta_prestada");
        fd.append('id',$('#id').val());
        fd.append('bcpp',$('#BCPP').val());
        fd.append('banco_tipo_documento',$('#banco_tipo_documento').val());
        fd.append('banco_cedula',$('#banco_cedula').val());
        fd.append('banco_nombre',$('#banco_nombre').val());
        fd.append('banco_tipo',$('#banco_tipo').val());
        fd.append('banco_numero',$('#banco_numero').val());
        fd.append('banco_banco',$('#banco_banco').val());

        $.ajax({
            url: '../script/crud_modelos.php',
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
		/*
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
		*/
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

	function Bprogreso(){
		var barra = $('#progressbar');
		var formulario = $("#hidden_form");
		var progreso = 0;
		var variable1 = $('#hidden_telefono1').val();
		var variable2 = $('#hidden_banco_cedula').val();
		var variable3 = $('#hidden_altura').val();
		var variable4 = $('#hidden_Htransmision').val();
		if(variable1!=''){progreso=progreso+25;}
		if(variable2!=''){progreso=progreso+25;}
		if(variable3!=''){progreso=progreso+25;}
		if(variable4!=''){progreso=progreso+25;}
		barra.width(progreso+'%');
		$('#progreso_html1').html(progreso+'%');
		if(progreso==25){
			barra.addClass('bg-danger');
		}else if(progreso==50){
			barra.addClass('bg-warning');
		}else if(progreso==75){
			barra.addClass('bg-primary');
		}else if(progreso==100){
			barra.addClass('bg-success');
		}
		//console.log('progreso...'+progreso);
	}

	function refrescar(){
		var id = $('#hidden_id').val();
		$.ajax({
			type: 'POST',
			url: '../script/modelo_refrescar1.php',
			data: { 'id': id, },
			dataType: "JSON",
			success: function(respuesta) {
				//console.log(respuesta);
				$('#hidden_documento_tipo').val(respuesta['documento_tipo']);
				$('#hidden_documento_numero').val(respuesta['documento_numero']);
				$('#hidden_nombre1').val(respuesta['nombre1']);
				$('#hidden_nombre2').val(respuesta['nombre2']);
				$('#hidden_apellido1').val(respuesta['apellido1']);
				$('#hidden_apellido2').val(respuesta['apellido2']);
				$('#hidden_correo').val(respuesta['correo']);
				$('#hidden_telefono1').val(respuesta['telefono1']);
				$('#hidden_telefono2').val(respuesta['telefono2']);
				$('#hidden_direccion').val(respuesta['direccion']);
				$('#hidden_genero').val(respuesta['genero']);
				$('#hidden_banco_cedula').val(respuesta['banco_cedula']);
				$('#hidden_banco_nombre').val(respuesta['banco_nombre']);
				$('#hidden_banco_tipo').val(respuesta['banco_tipo']);
				$('#hidden_banco_banco').val(respuesta['banco_banco']);
				$('#hidden_bcpp').val(respuesta['bcpp']);
				$('#hidden_altura').val(respuesta['altura']);
				$('#hidden_peso').val(respuesta['peso']);
				$('#hidden_tpene').val(respuesta['tpene']);
				$('#hidden_tsosten').val(respuesta['tsosten']);
				$('#hidden_tbusto').val(respuesta['tbusto']);
				$('#hidden_tcintura').val(respuesta['tcintura']);
				$('#hidden_tcaderas').val(respuesta['tcaderas']);
				$('#hidden_tipo_cuerpo').val(respuesta['tipo_cuerpo']);
				$('#hidden_Pvello').val(respuesta['Pvello']);
				$('#hidden_color_cabello').val(respuesta['color_cabello']);
				$('#hidden_color_ojos').val(respuesta['color_ojos']);
				$('#hidden_Ptattu').val(respuesta['Ptattu']);
				$('#hidden_Ppiercing').val(respuesta['Ppiercing']);
				$('#hidden_turno').val(respuesta['turno']);
				$('#hidden_sede').val(respuesta['sede']);
				$('#hidden_Htransmision').val(respuesta['Htransmision']);
				$('#hidden_select_equipo').val(respuesta['select_equipo']);
				$('#hidden_equipo').val(respuesta['equipo']);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
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
	$("#form_documento_identidad").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#documento_identidad')[0].files[0];
        fd.append('file',files);

        $.ajax({
            url: '../script/modelo_subir_documento1.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_documento_identidad').attr('disabled','true');
            },

            success: function(response){
            	if(response=='error'){
            		$('#submit_documento_identidad').attr('disabled','false');
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> jpg jpeg png pdf",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
					$('#submit_documento_identidad').removeAttr('disabled');
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

    $("#formulario10").on("submit", function(e){
		e.preventDefault();
		var usuario = $('#usuario_hidden').val();
		var password1 = $('#clave_password1').val();
		var password2 = $('#clave_password2').val();

		if(password1!=password2){
        	Swal.fire({
		 		title: 'Error',
			 	text: "Las claves no son iguales",
			 	icon: 'error',
			 	position: 'center',
			 	showConfirmButton: false,
			 	timer: 3000
			});
            return false;
        }

        $.ajax({
            url: '../script/crud_modelos.php',
            type: 'POST',
            dataType: "JSON",
            data: { 
            	"usuario": usuario,
            	"password1": password1,
            	"password2": password2,
            	"condicion": "cambiar_clave1",
            },

            beforeSend: function (){
            	$('#submit_clave1').attr('disabled','true');
            },

            success: function(response){
            	console.log(response);
            	$('#submit_clave1').removeAttr('disabled');
            	Swal.fire({
	 				title: 'Correcto',
	 				text: "Claves Cambiadas",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: false,
	 				timer: 3000
				});
            },

            error: function(response){
            	console.log(response);
            	$('#submit_clave1').removeAttr('disabled');
            }
        });
    });

	/********************************************/

	function soporte_subir(id,submit){
		var condicion = "soporte_subir1";
		var fd = new FormData();
		fd.append('id',id);
		if(submit=='soporte_submit1'){
			var files = $('#soporte_documento_identidad')[0].files[0];
			var condicion2 = "Documento de Identidad";
			fd.append('file',files);
			fd.append('condicion2',condicion2);
		}else if(submit=='soporte_submit2'){
			var files = $('#soporte_foto_cedula_con_cara')[0].files[0];
			var condicion2 = "Foto Cédula con Cara";
			fd.append('file',files);
			fd.append('condicion2',condicion2);
		}else if(submit=='soporte_submit3'){
			var files = $('#soporte_foto_cedula_parte_frontal_cara')[0].files[0];
			var condicion2 = "Foto Cédula Parte Frontal Cara";
			fd.append('file',files);
			fd.append('condicion2',condicion2);
		}else if(submit=='soporte_submit4'){
			var files = $('#soporte_foto_cedula_parte_respaldo')[0].files[0];
			var condicion2 = "Foto Cédula Parte Respaldo";
			fd.append('file',files);
			fd.append('condicion2',condicion2);
		}

		if(files==undefined || files=="" || files==null){
			console.log("No tiene Archivo Señalado");
			return false;
		}else{
			console.log(files);
			$.ajax({
	            url: '../script/crud_modelos.php',
	            type: 'POST',
	            dataType: "JSON",
	            data: fd,
	            contentType: false,
            	processData: false,

	            beforeSend: function (){
	            	$('#'+submit).attr('disabled','true');
	            },

	            success: function(response){
	            	console.log(response);
	            	$('#'+submit).removeAttr('disabled');
	            	Swal.fire({
		 				title: 'Correcto',
		 				text: "Claves Cambiadas",
		 				icon: 'success',
		 				position: 'center',
		 				showConfirmButton: false,
		 				timer: 3000
					});
	            },

	            error: function(response){
	            	console.log(response);
	            	$('#submit_clave1').removeAttr('disabled');
	            }
	        });
		}
	}

</script>