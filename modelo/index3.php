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
<body>

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

	</style>

<?php
	include('../script/conexion.php');
	$ubicacion = "modelo";
	include('../script/navbar_verificacion.php');
	include('../navbar.php');
?>


	<?php $ubicacion_url = $_SERVER["PHP_SELF"]; ?>

	<div class="row ml-3 mr-3" style="margin-top: 4rem;">
		<input type="hidden" name="datatables" id="datatables" data-pagina="1" data-consultasporpagina="10" data-filtrado="" data-sede="">
		<div class="col-3 form-group form-check">
			<label for="consultasporpagina" style="color:black; font-weight: bold;">Resultados por página</label>
			<select class="form-control" id="consultasporpagina" name="consultasporpagina">
				<option value="10">10</option>
				<option value="20">20</option>
				<option value="30">30</option>
				<option value="40">40</option>
				<option value="50">50</option>
				<option value="100">100</option>
			</select>
		</div>
		<div class="col-4 form-group form-check">
			<label for="buscarfiltro" style="color:black; font-weight: bold;">Busqueda</label>
			<input type="text" class="form-control" id="buscarfiltro" autocomplete="off" name="buscarfiltro">
		</div>
		<div class="col-3 form-group form-check">
			<label for="consultaporsede" style="color:black; font-weight: bold;">Estatus</label>
			<select class="form-control" id="consultaporsede" name="consultaporsede">
				<option value="">Todos</option>
				<option value="Activa">Activa</option>
				<option value="Inactiva">Inactiva</option>
			</select>
		</div>
		<div class="col-2">
			<br>
			<button type="button" class="btn btn-info mt-2" onclick="filtrar1();">Filter</button>
		</div>
		
		<div class="col-12" style="background-color: white; border-radius: 1rem; padding: 20px 1px 1px 1px;" id="resultado_table1"></div>
	</div>

	<!-- Modal Nuevo -->
	<div class="modal fade" id="modal_extras1" tabindex="-1" role="dialog" aria-labelledby="modal_extras1" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">EXTRAS</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row" id="modal_extras1_respuesta"></div>
				</div>
			</div>
		</div>
	</div>
	<!------------------>

<!-- Modal Editar Registro 2 -->
	<div class="modal fade" id="exampleModal_soporte1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_edit_soporte1" style="">
				<input type="hidden" name="edit_id2" id="edit_id2">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel2">Editar Registro</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row">
						    <div class="col-6 form-group form-check">
							    <label for="edit_tipo_documento">Tipo de Documento <small style="color:#F2B76F; font-size: 17px;">*</small></label>
							    <select name="edit_tipo_documento2" id="edit_tipo_documento2" class="form-control" required>
							    	<option value="">Seleccione</option>
							    	<option value="Cedula de Ciudadania">Cedula de Ciudadania</option>
							    	<option value="Cedula de Extranjeria">Cedula de Extranjeria</option>
							    	<option value="PEP">PEP</option>
							    	<option value="Pasaporte">Pasaporte</option>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_numero_documento">Número de Documento <small style="color:#F2B76F; font-size: 17px;">*</small></label>
							    <input type="text" name="edit_numero_documento2" id="edit_numero_documento2" autocomplete="off" class="form-control" minlength="6" required>
						    </div>
					    </div>

					    <div class="row">
						    <div class="col-6 form-group form-check">
							    <label for="edit_primer_nombre">Primer Nombre <small style="color:#F2B76F; font-size: 17px;">*</small></label>
							    <input type="text" name="edit_primer_nombre2" id="edit_primer_nombre2" autocomplete="off" class="form-control" minlength="4" required>
						    </div>

						    <div class="col-6 form-group form-check">
							    <label for="edit_segundo_nombre">Segundo Nombre</label>
							    <input type="text" name="edit_segundo_nombre2" id="edit_segundo_nombre2" autocomplete="off" minlength="4" class="form-control">
						    </div>

						    <div class="col-6 form-group form-check">
							    <label for="edit_primer_apellido">Primer Apellido <small style="color:#F2B76F; font-size: 17px;">*</small></label>
							    <input type="text" name="edit_primer_apellido2" id="edit_primer_apellido2" autocomplete="off" minlength="4" class="form-control" required>
						    </div>

						    <div class="col-6 form-group form-check">
							    <label for="edit_segundo_apellido">Segundo Apellido <small style="color:#F2B76F; font-size: 17px;">*</small></label>
							    <input type="text" name="edit_segundo_apellido2" id="edit_segundo_apellido2" autocomplete="off" minlength="4" class="form-control" required>
						    </div>
					    </div>

					    <div class="row">
						    <div class="col-6 form-group form-check">
							    <label for="edit_correo">Correo <small style="color:#F2B76F; font-size: 17px;">*</small></label>
							    <input type="email" name="edit_correo2" id="edit_correo2" autocomplete="off" class="form-control" required>
						    </div>

						    <?php
						    if($_SESSION['rol']==1 or $_SESSION['rol']==2){ ?>
						    <div class="col-6 form-group form-check">
							    <label for="edit_telefono1">Número WhatsApp </label>
							    <input type="text" name="edit_telefono12" id="edit_telefono12" autocomplete="off" class="form-control" required>
						    </div>

						    <div class="col-6 form-group form-check">
							    <label for="edit_telefono2">Teléfono Opcional</label>
							    <input type="text" name="edit_telefono22" id="edit_telefono22" autocomplete="off" class="form-control">
						    </div>
							<?php }else{ ?>
								<input type="hidden" name="edit_telefono12" id="edit_telefono12" autocomplete="off" class="form-control">
								<input type="hidden" name="edit_telefono22" id="edit_telefono22" autocomplete="off" class="form-control">
							<?php } ?>

						    <div class="col-6 form-group form-check">
							    <label for="edit_direccion">Dirección</label>
							    <input type="text" name="edit_direccion2" id="edit_direccion2" autocomplete="off" class="form-control">
						    </div>
					    </div>

					    <div class="row">
							    <div class="col-6 form-group form-check">
							    <label for="edit_genero">Género </label>
							    <select name="edit_genero2" id="edit_genero2" class="form-control" required>
							    	<option value="">Seleccione</option>
									<option value="Hombre">Hombre</option>
									<option value="Mujer">Mujer</option>
									<option value="Transexual">Transexual</option>
							    </select>
						    </div>

						    <div class="col-6 form-group form-check">
								<label for="edit_estatus">Estatus </label>
								<select name="edit_estatus2" class="form-control" id="edit_estatus2" required>
									<option value="">Seleccione</option>
									<option value="Activa">Activa</option>
									<option value="Inactiva">Inactiva</option>
								</select>
							</div>

							<div class="col-6 form-group form-check">
								<label for="barrio">Barrio </label>
								<input type="text" name="barrio2" id="barrio2" autocomplete="off" required class="form-control">
							</div>

							<div class="col-6 form-group form-check">
								<label for="perfil_transmision">Perfil de Transmisión </label>
								<select class="form-control" name="perfil_transmision2" id="perfil_transmision2">
									<option value="">Seleccione</option>
									<option value="Hombre">Hombre</option>
									<option value="Mujer">Mujer</option>
									<option value="Trans">Trans</option>
									<option value="Parejas">Parejas</option>
								</select>
							</div>
					    </div>

					    <?php
					    if($_SESSION['rol'] == 8 or $_SESSION['rol'] == 1){ ?>
						    <div class="col-12 text-center mb-3 mt-3" style="background-color: black; color:white; font-weight: bold;">
						    	DATOS BANCARIOS
						    </div>

						    <div class="row">
								<div class="col-6 form-group form-check">
									<label for="banco_cedula2">N° Cédula Titular </label>
									<input type="text" name="banco_cedula2" id="banco_cedula2" class="form-control" autocomplete="off">
								</div>

								<div class="col-6 form-group form-check">
									<label for="banco_nombre2">Nombre Titular </label>
									<input type="text" name="banco_nombre2" id="banco_nombre2" class="form-control" autocomplete="off">
								</div>

								<div class="col-6 form-group form-check">
									<label for="banco_tipo2">Tipo de Cuenta </label>
									<select name="banco_tipo2" class="form-control" id="banco_tipo2">
										<option value="">Seleccione</option>
										<option value="Ahorro">Ahorro</option>
										<option value="Corriente">Corriente</option>
									</select>
								</div>

								<div class="col-6 form-group form-check">
									<label for="banco_numero2">N° de Cuenta </label>
									<input type="text" name="banco_numero2" id="banco_numero2" class="form-control" autocomplete="off">
								</div>

								<div class="col-12 form-group form-check">
									<label for="banco_banco2">Banco </label>
									<select name="banco_banco2" class="form-control" id="banco_banco2">
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

								<div class="col-12 form-group form-check">
									<label for="enlazar">Cuenta Propia o de Prestada? </label>
									<select name="BCPP2" class="form-control" id="BCPP2">
										<option value="">Seleccione</option>
										<option value="Propia">Propia</option>
										<option value="Prestada">Prestada</option>
									</select>
								</div>
							</div>
					    <?php } ?>

						<div class="col-12 text-center mb-3 mt-3" style="background-color: black; color:white; font-weight: bold;">
					    	DATOS CORPORALES
					    </div>

					    <div class="row">
							<div class="col-6 form-group form-check">
								<label for="altura">Altura </label>
								<input type="text" name="altura2" id="altura2" class="form-control" autocomplete="off">
							</div>

							<div class="col-6 form-group form-check">
								<label for="peso">Peso </label>
								<input type="text" name="peso2" id="peso2" class="form-control" autocomplete="off">
							</div>
							<div class="col-6 form-group form-check">
								<label for="tpene">Tamaño de Pene </label>
								<input type="text" name="tpene2" id="tpene2" class="form-control" autocomplete="off">
							</div>

							<div class="col-6 form-group form-check">
								<label for="tsosten">Tamaño de Sosten </label>
								<select class="form-control" name="tsosten2" id="tsosten2">
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
								<label for="tbusto">Medida del Busto </label>
								<input type="text" name="tbusto2" id="tbusto2" class="form-control" autocomplete="off">
							</div>

							<div class="col-6 form-group form-check">
								<label for="tcintura">Medida de Cintura </label>
								<input type="text" name="tcintura2" id="tcintura2" class="form-control" autocomplete="off">
							</div>

							<div class="col-6 form-group form-check">
								<label for="tcaderas">Medida de Caderas </label>
								<input type="text" name="tcaderas2" id="tcaderas2" class="form-control" autocomplete="off">
							</div>

							<div class="col-6 form-group form-check">
								<label for="tipo_cuerpo">Tipo de Cuerpo </label>
								<select class="form-control" name="tipo_cuerpo2" id="tipo_cuerpo2">
									<option value="">Seleccione</option>
									<option value="Delgado">Delgado</option>
									<option value="Promedio">Promedio</option>
									<option value="Atlético">Atlético</option>
									<option value="Alto y Grande">Alto y Grande</option>
								</select>
							</div>

							<div class="col-6 form-group form-check">
								<label for="Pvello">¿Posee Vello Púbico? </label>
								<select class="form-control" name="Pvello2" id="Pvello2">
									<option value="">Seleccione</option>
									<option value="Peludo">Peludo</option>
									<option value="Recortado">Recortado</option>
									<option value="Afeitado">Afeitado</option>
									<option value="Calvo">Calvo</option>
								</select>
							</div>

							<div class="col-6 form-group form-check">
								<label for="color_cabello">Color de Cabello </label>
								<input type="text" name="color_cabello2" class="form-control" id="color_cabello2" autocomplete="off">
							</div>

							<div class="col-12 form-group form-check">
								<label for="color_ojos">Color de Ojos </label>
								<input type="text" name="color_ojos2" class="form-control" id="color_ojos2" autocomplete="off">
							</div>

							<div class="col-6 form-group form-check text-center">
								<label for="Ptattu">¿Posee Tattoo?</label>
								<select class="form-control" id="Ptattu2" name="Ptattu2">
									<option value="">Seleccione</option>
									<option value="Si">Si</option>
									<option value="No">No</option>
								</select>
							</div>

							<div class="col-6 form-group form-check text-center">
								<label for="Ppiercing">¿Posee Piercing?</label>
								<select class="form-control" id="Ppiercing2" name="Ppiercing2">
									<option value="">Seleccione</option>
									<option value="Si">Si</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>

						<div class="col-12 text-center mb-3 mt-3" style="background-color: black; color:white; font-weight: bold;">
						   	DATOS BANCARIOS
						</div>

						    <div class="row">
								<div class="col-6 form-group form-check">
									<label for="banco_cedula2">N° Cédula Titular </label>
									<input type="text" name="banco_cedula2" id="banco_cedula2" class="form-control" autocomplete="off" disabled>
								</div>

								<div class="col-6 form-group form-check">
									<label for="banco_tipo_documento">Tipo de documento Titular </label>
									<input type="text" name="banco_tipo_documento" id="banco_tipo_documento" class="form-control" autocomplete="off" disabled>
								</div>

								<div class="col-6 form-group form-check">
									<label for="banco_nombre2">Nombre Titular </label>
									<input type="text" name="banco_nombre2" id="banco_nombre2" class="form-control" autocomplete="off" disabled>
								</div>

								<div class="col-6 form-group form-check">
									<label for="banco_tipo2">Tipo de Cuenta </label>
									<select name="banco_tipo2" class="form-control" id="banco_tipo2" disabled>
										<option value="">Seleccione</option>
										<option value="Ahorro">Ahorro</option>
										<option value="Corriente">Corriente</option>
									</select>
								</div>

								<div class="col-6 form-group form-check">
									<label for="banco_numero2">N° de Cuenta </label>
									<input type="text" name="banco_numero2" id="banco_numero2" class="form-control" autocomplete="off" disabled>
								</div>

								<div class="col-6 form-group form-check">
									<label for="banco_banco2">Banco </label>
									<select name="banco_banco2" class="form-control" id="banco_banco2" disabled>
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

								<div class="col-12 form-group form-check">
									<label for="enlazar">Cuenta Propia o de Prestada? </label>
									<select name="BCPP2" class="form-control" id="BCPP2" disabled>
										<option value="">Seleccione</option>
										<option value="Propia">Propia</option>
										<option value="Prestada">Prestada</option>
									</select>
								</div>
							</div>

						<div class="col-12 text-center mb-3 mt-3" style="background-color: black; color:white; font-weight: bold;">
					    	DATOS EMPRESA
					    </div>

						<div class="row">
							<div class="col-6 form-group form-check">
							    <label for="edit_turno">Turno </label>
							    <select name="edit_turno2" id="edit_turno2" class="form-control">
							    	<option value="">Seleccione</option>
							    	<option value="Mañana">Mañana</option>
							    	<option value="Tarde">Tarde</option>
							    	<option value="Noche">Noche</option>
							    	<option value="Satelite">Satelite</option>
							    </select>
						    </div>

							<div class="col-6 form-group form-check">
							    <label for="edit_sede">Sede </label>
							    <select name="edit_sede2" id="edit_sede2" class="form-control" required>
							    	<option value="">Seleccione</option>
							    	<?php
							    	$sql4 = "SELECT * FROM sedes";
							    	$consulta4 = mysqli_query($conexion,$sql4);
									while($row4 = mysqli_fetch_array($consulta4)) { ?>
										<option value="<?php echo $row4['id']; ?>"><?php echo $row4['nombre']; ?></option>
							    	<?php } ?>
							    </select>
						    </div>

							<div class="col-12 form-group form-check">
								<label for="edit_Htransmision">Horario de Transmisión </label>
								<select name="edit_Htransmision2" id="edit_Htransmision2" class="form-control">
									<option value="">Seleccione</option>
									<option value="Mañana">Mañana</option>
									<option value="Tarde">Tarde</option>
									<option value="Noche">Noche</option>
								</select>
							</div>

							<div class="col-12 form-group form-check">
								<label for="equipo">Equipo </label>
								<select name="equipo2" class="form-control" id="select_equipo2">
									<option value="">Seleccione</option>
									<option value="Individual">Individual</option>
									<option value="Pareja">Pareja</option>
									<option value="Trio">Trio</option>
									<option value="Cuarteto">Cuarteto</option>
									<option value="Quinteto">Quinteto</option>
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" id="submit" class="btn btn-success">Guardar</button>
			      	</div>
		      	</form>
	    	</div>
	  	</div>
	</div>
<!-- FIN Modal Editar Registro 2 -->



<!-- Modal Documentos 1 -->
	<div class="modal fade" id="Modal_documentos1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_documentos1" style="">
				<input type="hidden" name="edit_id" id="edit_id">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Documentos</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" id="div_modal_documentos1"></div>
					<!--
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" id="submit" class="btn btn-success">Guardar</button>
			      	</div>
			      	-->
		      	</form>
	    	</div>
	  	</div>
	</div>
<!-- FIN Modal Documentos1 -->


<!-- Modal Fotos 1 -->
	<div class="modal fade" id="Modal_fotos1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_fotos1" style="">
				<input type="hidden" name="edit_id" id="edit_id">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Biblioteca De Fotos</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" id="modal_body_fotos1"></div>
				</div>
		    </form>
	   	</div>
	</div>
<!-- FIN Modal Fotos 1 -->


<!-- Modal Fotos 2 -->
	<div class="modal fade" id="Modal_fotos2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_fotos2" style="">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Agregar Fotos Extras</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<input type="hidden" name="hidden_fotos2_id" id="hidden_fotos2_id">
						     <div class="col-12 form-group form-check">
						     	<label for="fotos2_id_documentos">Categoría</label>
							    <select class="form-control" name="fotos2_id_documentos" id="fotos2_id_documentos" required>
							    	<option value="">Seleccione</option>
							    	<option value="2">Documento de Identidad</option>
							    	<option value="8">Foto Cédula con Cara</option>
							    	<option value="9">Foto Cédula Parte Frontal Cara</option>
							    	<option value="10">Foto Cédula Parte Respaldo</option>
							    	<option value="12">Extras</option>
							    </select>
							</div>
							<input type="file" class="form-control" name="fotos2_file" id="fotos2_file" style="margin-left: 18px; margin-right: 16px;" required>
						</div>
					</div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="submit_Modal_fotos2">Cerrar</button>
				        <button type="submit" id="submit" class="btn btn-success">Guardar</button>
			      	</div>
		      	</form>
	    	</div>
	  	</div>
	</div>
<!-- FIN Modal Fotos 2 -->


<!-- Modal Cuentas 1 -->
	<div class="modal fade" id="Modal_cuentas1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_edit2" style="">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Cuentas</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row" id="hidden_cuentas1"></div>
					</div>
		      	</form>
	    	</div>
	  	</div>
	</div>
<!-- FIN Modal Cuentas 1 -->

<!-- Modal Cuentas 2 -->
	<div class="modal fade" id="Modal_cuentas2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_edit3" style="">
				<input type="hidden" name="cuentas2_id" id="cuentas2_id">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Creación de Cuenta</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row" id="hidden_cuentas2">
					    	<div class="col-12">
					    		<label>Página</label>
					    		<select class="form-control" required name="select_paginas" id="select_paginas">
					    			<option value="">Seleccione</option>
					    			<?php
					    			$sql1 = "SELECT * FROM paginas ORDER BY id";
					    			$consulta1 = mysqli_query($conexion,$sql1);
									while($row3 = mysqli_fetch_array($consulta1)) { ?>
										<option value="<?php echo $row3['id']; ?>"><?php echo $row3['nombre']; ?></option>
									<?php } ?>
					    		</select>
					    	</div>
					    	<div class="col-12 mt-2">
					    		<label>Cuenta</label>
					    		<input type="text" name="cuenta1" id="cuenta1" class="form-control" required>
					    	</div>
					    	<div class="col-12 mt-2">
					    		<label>Clave</label>
					    		<input type="text" name="clave1" id="clave1" class="form-control">
					    	</div>
					    	<div class="col-12 mt-2">
					    		<label>Correo</label>
					    		<input type="email" name="correo1" id="correo1" class="form-control">
					    	</div>
					    	<div class="col-12 mt-2">
					    		<label>Link</label>
					    		<input type="text" name="link1" id="link1" class="form-control">
					    	</div>
					    </div>
					</div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" id="submit" class="btn btn-success">Guardar</button>
			      	</div>
		      	</form>
	    	</div>
	  	</div>
	</div>
<!-- FIN Modal Cuentas 2 -->



<!-- Modal Responsables 1 -->
	<div class="modal fade" id="exampleModal_responsable1" tabindex="-1" role="dialog" aria-labelledby="exampleModal_responsable1" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_edit2" style="">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModal_responsable1">Reponsables</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row" id="hidden_responsable1">
					    	
					    </div>
					</div>
		      	</form>
	    	</div>
	  	</div>
	</div>
<!-- FIN Responsables 1 -->


<script src="../js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../js/popper.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="../js/navbar.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/dataTables.bootstrap4.min.js"></script>

<?php include('../footer.php'); ?>

<script type="text/javascript">
    $(document).ready(function() {
        filtrar1();
    } );

    function filtrar1(){
        var input_consultasporpagina = $('#consultasporpagina').val();
        var input_buscarfiltro = $('#buscarfiltro').val();
        var input_consultaporsede = $('#consultaporsede').val();
        
        $('#datatables').attr({'data-consultasporpagina':input_consultasporpagina})
        $('#datatables').attr({'data-filtrado':input_buscarfiltro})
        $('#datatables').attr({'data-sede':input_consultaporsede})

        var pagina = $('#datatables').attr('data-pagina');
        var consultasporpagina = $('#datatables').attr('data-consultasporpagina');
        var sede = $('#datatables').attr('data-sede');
        var filtrado = $('#datatables').attr('data-filtrado');
        var ubicacion_url = '<?php echo $ubicacion_url; ?>';

        $.ajax({
            type: 'POST',
            url: '../script/crud_modelos.php',
            dataType: "JSON",
            data: {
                "pagina": pagina,
                "consultasporpagina": consultasporpagina,
                "sede": sede,
                "filtrado": filtrado,
                "link1": ubicacion_url,
                "condicion": "table1",
            },

            success: function(respuesta) {
                //console.log(respuesta);
                if(respuesta["estatus"]=="ok"){
                    $('#resultado_table1').html(respuesta["html"]);
                }else{
                	Swal.fire({
                        title: 'Error',
                        text: respuesta["estatus"]=="error",
                        icon: 'error',
                        showConfirmButton: true,
                    })
                }
            },

            error: function(respuesta) {
                console.log(respuesta['responseText']);
            }
        });
    }

    function paginacion1(value){
        $('#datatables').attr({'data-pagina':value})
        filtrar1();
    }

    	/*************LLENAR FORM EDIT*******************/

	function modal_edit (variable) {
		$.ajax({
			type: 'POST',
			url: '../script/modelo_modal_editar.php',
			dataType: "JSON",
			data: {
				"variable": variable,
			},

			success: function(respuesta) {
				console.log(respuesta);
				/***********PERSONALES*************/
				$('#edit_id').val(respuesta['id']);
				$('#edit_tipo_documento').val(respuesta['documento_tipo']);
				$('#edit_numero_documento').val(respuesta['documento_numero']);
				$('#edit_primer_nombre').val(respuesta['nombre1']);
				$('#edit_segundo_nombre').val(respuesta['nombre2']);
				$('#edit_primer_apellido').val(respuesta['apellido1']);
				$('#edit_segundo_apellido').val(respuesta['apellido2']);
				$('#edit_correo').val(respuesta['correo']);
				$('#edit_telefono1').val(respuesta['telefono1']);
				$('#edit_telefono2').val(respuesta['telefono2']);
				$('#edit_direccion').val(respuesta['direccion']);
				$('#edit_genero').val(respuesta['genero']);
				$('#edit_estatus').val(respuesta['estatus']);
				$('#barrio').val(respuesta['barrio']);
				$('#perfil_transmision').val(respuesta['perfil_de_transmision']);
				/*************************************/
				/**********BANCARIOS*****************/
				$('#banco_cedula').val(respuesta['banco_cedula']);
				$('#banco_nombre').val(respuesta['banco_nombre']);
				$('#banco_tipo').val(respuesta['banco_tipo']);
				$('#banco_numero').val(respuesta['banco_numero']);
				$('#banco_banco').val(respuesta['banco_banco']);
				$('#BCPP').val(respuesta['BCPP']);
				/*************************************/
				/**********CORPORALES*****************/
				$('#altura').val(respuesta['altura']);
				$('#peso').val(respuesta['peso']);
				$('#tpene').val(respuesta['tpene']);
				$('#tsosten').val(respuesta['tsosten']);
				$('#tbusto').val(respuesta['tbusto']);
				$('#tcintura').val(respuesta['tcintura']);
				$('#tcaderas').val(respuesta['tcaderas']);
				$('#tipo_cuerpo').val(respuesta['tipo_cuerpo']);
				$('#Pvello').val(respuesta['Pvello']);
				$('#color_cabello').val(respuesta['color_cabello']);
				$('#color_ojos').val(respuesta['color_ojos']);
				
				$('#Ptattu').val(respuesta['Ptattu']);
				$('#Ppiercing').val(respuesta['Ppiercing']);
				/*************************************/
				/**********EMPRESA*****************/
				$('#edit_turno').val(respuesta['turno']);
				$('#edit_sede').val(respuesta['sede']);
				$('#edit_Htransmision').val(respuesta['Htransmision']);
				$('#select_equipo').val(respuesta['equipo']);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function modal_edit2 (variable) {
		$.ajax({
			type: 'POST',
			url: '../script/modelo_modal_editar.php',
			dataType: "JSON",
			data: {
				"variable": variable,
			},

			success: function(respuesta) {
				console.log(respuesta);
				/***********PERSONALES*************/
				$('#edit_id2').val(respuesta['id']);
				$('#edit_tipo_documento2').val(respuesta['documento_tipo']);
				$('#edit_numero_documento2').val(respuesta['documento_numero']);
				$('#edit_primer_nombre2').val(respuesta['nombre1']);
				$('#edit_segundo_nombre2').val(respuesta['nombre2']);
				$('#edit_primer_apellido2').val(respuesta['apellido1']);
				$('#edit_segundo_apellido2').val(respuesta['apellido2']);
				$('#edit_correo2').val(respuesta['correo']);
				$('#edit_telefono12').val(respuesta['telefono1']);
				$('#edit_telefono22').val(respuesta['telefono2']);
				$('#edit_direccion2').val(respuesta['direccion']);
				$('#edit_genero2').val(respuesta['genero']);
				$('#edit_estatus2').val(respuesta['estatus']);
				$('#barrio2').val(respuesta['barrio']);
				$('#perfil_transmision2').val(respuesta['perfil_de_transmision']);
				/*************************************/
				/**********BANCARIOS*****************/
				$('#banco_cedula2').val(respuesta['banco_cedula']);
				$('#banco_nombre2').val(respuesta['banco_nombre']);
				$('#banco_tipo2').val(respuesta['banco_tipo']);
				$('#banco_numero2').val(respuesta['banco_numero']);
				$('#banco_banco2').val(respuesta['banco_banco']);
				$('#BCPP2').val(respuesta['BCPP']);
				/*************************************/
				/**********CORPORALES*****************/
				$('#altura2').val(respuesta['altura']);
				$('#peso2').val(respuesta['peso']);
				$('#tpene2').val(respuesta['tpene']);
				$('#tsosten2').val(respuesta['tsosten']);
				$('#tbusto2').val(respuesta['tbusto']);
				$('#tcintura2').val(respuesta['tcintura']);
				$('#tcaderas2').val(respuesta['tcaderas']);
				$('#tipo_cuerpo2').val(respuesta['tipo_cuerpo']);
				$('#Pvello2').val(respuesta['Pvello']);
				$('#color_cabello2').val(respuesta['color_cabello']);
				$('#color_ojos2').val(respuesta['color_ojos']);
				
				$('#Ptattu2').val(respuesta['Ptattu']);
				$('#Ppiercing2').val(respuesta['Ppiercing']);
				/*************************************/
				/**********EMPRESA*****************/
				$('#edit_turno2').val(respuesta['turno']);
				$('#edit_sede2').val(respuesta['sede']);
				$('#edit_Htransmision2').val(respuesta['Htransmision']);
				$('#select_equipo2').val(respuesta['equipo']);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	/**********FIN LLENAR FORM EDIT******************/

	$("#form_modal_edit").on("submit", function(e){
		e.preventDefault();
		var f = $(this);
	    $.ajax({
			type: 'POST',
			url: '../script/editar_modelo1.php',
			data: $('#form_modal_edit').serialize(),
			dataType: "JSON",
			success: function(respuesta) {
				console.log(respuesta);
				if(respuesta == 0){
					Swal.fire({
						position: 'center',
						icon: 'error',
						title: 'No se ha logrado modificar!',
						showConfirmButton: true,
						timer: 3000
					})
				}

				if(respuesta != 0){
					Swal.fire({
						position: 'center',
						icon: 'success',
						title: 'Se ha modificado exitosamente!',
						showConfirmButton: true,
						timer: 3000
					})
					setTimeout(function() {
			      		//window.location.href = "index.php";
			    	},3500);
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	});

	$("#form_modal_edit_soporte1").on("submit", function(e){
		e.preventDefault();
		var f = $(this);
	    $.ajax({
			type: 'POST',
			url: '../script/editar_modelo_soporte1.php',
			data: $('#form_modal_edit_soporte1').serialize(),
			dataType: "JSON",
			success: function(respuesta) {
				console.log(respuesta);
				if(respuesta == 0){
					Swal.fire({
						position: 'center',
						icon: 'error',
						title: 'No se ha logrado modificar!',
						showConfirmButton: true,
						timer: 3000
					})
				}

				if(respuesta != 0){
					Swal.fire({
						position: 'center',
						icon: 'success',
						title: 'Se ha modificado exitosamente!',
						showConfirmButton: true,
						timer: 3000
					})
					setTimeout(function() {
			      		//window.location.href = "index.php";
			    	},3500);
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	});


	function eliminar(variable){
		Swal.fire({
		  title: 'Estas seguro?',
		  text: "Esta acción no podra revertirse",
		  icon: 'warning',
		  showConfirmButton: true,
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, Eliminar registro!',
		  cancelButtonText: 'Cancelar'
		}).then((result) => {
		  if (result.value) {
		    $.ajax({
				type: 'POST',
				url: '../script/eliminar_modelo.php',
				data: {"variable": variable},
				dataType: "JSON",
				success: function(respuesta) {
					Swal.fire({
					    title: 'Registro Eliminado!',
					    text: 'Redirigiendo...',
					    icon: 'success',
					    showConfirmButton: true
				    });setTimeout(function() {
			      		//window.location.href = "index.php";
			    	},3500);
				},

				error: function(respuesta) {
					console.log("error..."+respuesta);
				}
			});
		  }
		})
	}

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

	function documentos1(variable){
		$.ajax({
			type: 'POST',
			url: '../script/modelo_documentos1.php',
			data: {"variable": variable},
			dataType: "JSON",

			success: function(respuesta) {
				//console.log(respuesta['html_matriz']);
				$('#div_modal_documentos1').html(respuesta['html_matriz']);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function ver_contrato1(){
		var hidden_contrato1 = $('#hidden_contrato1').val();
		if(hidden_contrato1=='1'){
			$('#hidden_contrato1').val('0');
			$('#div_contrato1').addClass('d-none');
			$('#contrato1').val('Ocultar Documento');
			console.log('ocultando...');
		}else{
			$('#hidden_contrato1').val('1');
			$('#div_contrato1').removeClass('d-none');
			$('#contrato1').val('Mostrar Documento');
			console.log('mostrando...');
		}
	}

	function firmar1(){
		console.log('generando firma...');
		$('#div_firmar1').show();
	}

	function cuentas(variable){
		console.log('cuentas...');
		$.ajax({
			type: 'POST',
			url: '../script/modelo_modal_cuentas1.php',
			data: {"variable": variable},
			dataType: "JSON",
			success: function(respuesta) {
				//console.log(respuesta);
				$('#hidden_cuentas1').html(respuesta['html']);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function cuentas2(variable){
		$('#cuentas2_id').val(variable);
	}

	$("#form_modal_edit3").on("submit", function(e){
		e.preventDefault();
		var f = $(this);
	    $.ajax({
			type: 'POST',
			url: '../script/modelo_cuenta1.php',
			data: $('#form_modal_edit3').serialize(),
			dataType: "JSON",
			success: function(respuesta) {
				//console.log(respuesta['duplicados_documentos']);
				if(respuesta['resultado']=='duplicados'){
					Swal.fire({
						position: 'center',
						icon: 'error',
						title: 'Cuenta ya existentes! ',
						text: respuesta['duplicados_documentos'][1]+' -> '+respuesta['duplicados_nombres'][1],
						showConfirmButton: true,
					});
					return false;
				}

				if(respuesta['resultado']=='error'){
					Swal.fire({
						position: 'center',
						icon: 'error',
						title: 'Cuenta ya existente!',
						text: 'Solo se permite una misma cuenta para esta pagina',
						showConfirmButton: true,
					});
					return false;
				}

				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Se ha registrado la cuenta!',
					showConfirmButton: true,
				});
				$("#Modal_cuentas2").modal('hide');
				$('#Modal_cuentas2').removeClass('modal-open');
				$('.modal-backdrop').remove();
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	});

	function hidden_cuentas1(variable){
		var div = $('#'+variable).val();
		//console.log(div);
		if(div=='0'){
			$('#div_'+variable).show('slow');
			$('#'+variable).val('1');
		}else{
			$('#div_'+variable).hide('slow');
			$('#'+variable).val('0');
		}
	}

	function cuenta_estatus(estatus,pagina,id,pagina_id,modelo_cuenta_id){
		$.ajax({
			type: 'POST',
			url: '../script/modelo_cuenta_estatus1.php',
			data: {
				"estatus": estatus,
				"pagina": pagina,
				"id": id,
				"pagina_id": pagina_id,
				"modelo_cuenta_id": modelo_cuenta_id,
			},
			dataType: "JSON",
			success: function(respuesta) {
				console.log(respuesta);
				Swal.fire({
	 				title: 'Estado Cambiado',
	 				text: "Refrescando Cuenta...",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: false,
	 				timer: 2000
				});
				$("#Modal_cuentas1").modal('hide');
				$('#Modal_cuentas1').removeClass('modal-open');
				$('.modal-backdrop').remove();
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function alerta_cuenta1(variable,modelo_cuenta_id){
		console.log('ok...');
		$.ajax({
			type: 'POST',
			url: '../script/modelo_alerta1.php',
			data: {
				"variable": variable,
				"modelo_cuenta_id": modelo_cuenta_id,
			},
			dataType: "JSON",
			success: function(respuesta) {
				//console.log(respuesta);
				Swal.fire({
	 				title: 'Alerta enviada!',
	 				text: "Limpiando Cache de mensajes!",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: false,
	 				timer: 2000
				});
				$("#Modal_cuentas1").modal('hide');
				$('#Modal_cuentas1').removeClass('modal-open');
				$('.modal-backdrop').remove();
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function fotos1(variable){
		//console.log('configurando...');
		$.ajax({
            url: '../script/modelo_modal_fotos1.php',
            type: 'POST',
           	dataType: "JSON",
           	data: {
           		"variable": variable,
           	},

            beforeSend: function (){},

            success: function(response){
            	//console.log(response['html_matriz']);
            	$('#modal_body_fotos1').html(response['html_matriz']);
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });

	}

	function fotos2(variable){
		$('#hidden_fotos2_id').val(variable);
	}

	$("#form_modal_fotos2").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#fotos2_file')[0].files[0];
        fd.append('file',files);
        fd.append('id_documentos',$('#fotos2_id_documentos').val());
        fd.append('id_modelos',$('#hidden_fotos2_id').val());
        //paqueteDeDatos.append('nombre', $('#campoNombre').prop('value'));

        $.ajax({
            url: '../script/modelo_subir_documento11.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_Modal_fotos2').attr('disabled','true');
            },

            success: function(response){
            	console.log(response);
            	if(response=='error'){
            		$('#submit_Modal_fotos2').attr('disabled','false');
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
	   					//window.location.href = "index.php";
	 				}
				})
				setTimeout(function() {
			    	//window.location.href = "index.php";
				},3500);
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    });

    function bottonMostrar1(variable,value){
    	if(value==0){
    		$('#div_'+variable).show('slow');
    		$('#'+variable).val(1);
    	}else{
    		$('#div_'+variable).hide('slow');
    		$('#'+variable).val(0);
    	}
    }

    function borrar_extra(variable,id_modelo){
    	//console.log(variable);
    	$.ajax({
            url: '../script/modelo_borrar_extras1.php',
            type: 'POST',
           	dataType: "JSON",
           	data: {
           		"variable": variable,
           		"id_modelo": id_modelo,
           	},

            beforeSend: function (){},

            success: function(response){
            	console.log(response);
            	Swal.fire({
	 				title: 'Eliminado!',
	 				text: "Limpiando Cache de fotos!",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: false,
	 				timer: 2000
				});
				$("#Modal_fotos1").modal('hide');
				$('#Modal_fotos1').removeClass('modal-open');
				$('.modal-backdrop').remove();
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    }

     function borrar_sensual(variable,id_modelo){
    	//console.log(variable);
    	$.ajax({
            url: '../script/modelo_borrar_sensual1.php',
            type: 'POST',
           	dataType: "JSON",
           	data: {
           		"variable": variable,
           		"id_modelo": id_modelo,
           	},

            beforeSend: function (){},

            success: function(response){
            	console.log(response);
            	Swal.fire({
	 				title: 'Eliminado!',
	 				text: "Limpiando Cache de fotos!",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: false,
	 				timer: 2000
				});
				$("#Modal_fotos1").modal('hide');
				$('#Modal_fotos1').removeClass('modal-open');
				$('.modal-backdrop').remove();
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    }

    function filtros2(variable){
    	$.ajax({
			type: 'POST',
			url: '../script/modelo_filtros_soporte1.php',
			data: {
				"variable": variable,
			},

			success: function(respuesta) {
				$('#example').DataTable().destroy();
				$('#resultados').html(respuesta);
				var table = $('#example').DataTable( {
		        	"lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],

		        	"language": {
			            "lengthMenu": "Mostrar _MENU_ Registros por página",
			            "zeroRecords": "No se ha encontrado resultados",
			            "info": "Ubicado en la página <strong>_PAGE_</strong> de <strong>_PAGES_</strong>",
			            "infoEmpty": "Sin registros actualmente",
			            "infoFiltered": "(Filtrado de <strong>_MAX_</strong> total registros)",
			            "paginate": {
					        "first":      "Primero",
					        "last":       "Última",
					        "next":       "Siguiente",
					        "previous":   "Anterior"
					    },
					    "search": "Buscar",
		        	},

		        	"paging": true

	    		} );
	    		/***************POPOVERS*******************/
				$(function () {
					$('[data-toggle="popover"]').popover()
				})

				// popovers initialization - on hover
				$('[data-toggle="popover-hover"]').popover({
				  html: true,
				  trigger: 'hover',
				  placement: 'bottom',
				  /*content: function () { return '<img src="' + $(this).data('img') + '" />'; }*/
				});

				// popovers initialization - on click
				$('[data-toggle="popover-click"]').popover({
				  html: true,
				  trigger: 'click',
				  placement: 'bottom',
				  content: function () { return '<img src="' + $(this).data('img') + '" />'; }
				});
		    	/******************************************/
			},

			error: function(respuesta) {
				console.log('Error...'+respuesta);
			}
		});
    }

    function modal_responsable1(variable){
    	$.ajax({
            url: '../script/modelo_modal_responsable1.php',
            type: 'POST',
           	dataType: "JSON",
           	data: {
           		"variable": variable,
           	},

            beforeSend: function (){},

            success: function(response){
            	$('#hidden_responsable1').html(response['html']);
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    }

    function agregar_responsable1(modelo_id){
    	var responsable = $('#responsable_registro').val();
    	if(responsable==''){
    		return false;
    	}
    	$.ajax({
            url: '../script/modelo_guardar_responsable1.php',
            type: 'POST',
           	dataType: "JSON",
           	data: {
           		"variable": modelo_id,
           		"responsable": responsable,
           	},

            beforeSend: function (){},

            success: function(response){
            	console.log(response);
            	if(response['resultado']=='error'){
            		Swal.fire({
		 				title: 'Error',
		 				text: "Responsable ya enlazado",
		 				icon: 'error',
		 				position: 'center',
		 				showConfirmButton: false,
		 				timer: 2000
					});
            	}
            	Swal.fire({
	 				title: 'Guardado exitosamente!',
	 				text: "Limpiando Cache...",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: true,
	 				timer: 2000
				});
            	setTimeout(function() {
			      	//window.location.href = "index.php";
			    },2000);

				//$("#exampleModal_responsable1").modal('hide');
				//$('#exampleModal_responsable1').removeClass('modal-open');
				//$('.modal-backdrop').remove();
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    }

    function borrar_responsable(responsable,modelo_id){
    	console.log('borrando...');
    	$.ajax({
            url: '../script/modelo_borrar_responsable1.php',
            type: 'POST',
           	dataType: "JSON",
           	data: {
           		"variable": modelo_id,
           		"responsable": responsable,
           	},

            beforeSend: function (){},

            success: function(response){
            	console.log(response);
            	Swal.fire({
	 				title: 'Se ha borrado el enlace!',
	 				text: "Limpiando Cache...",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: false,
	 				timer: 2000
				});
				$("#exampleModal_responsable1").modal('hide');
				$('#exampleModal_responsable1').removeClass('modal-open');
				$('.modal-backdrop').remove();
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    }

    function cuenta_eliminar(pagina,condicion,modelo_id,pagina_id,modelo_cuenta_id){
    	console.log(condicion);
    	$.ajax({
            url: '../script/modelo_borrar_cuenta.php',
            type: 'POST',
           	dataType: "JSON",
           	data: {
           		"modelo_cuenta_id": modelo_cuenta_id,
           	},

            beforeSend: function (){},

            success: function(response){
            	console.log(response);
            	Swal.fire({
	 				title: 'Se ha borrado la Cuenta!',
	 				text: "Limpiando Cache...",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: false,
	 				timer: 2000
				});
				$("#Modal_cuentas1").modal('hide');
				$('#Modal_cuentas1').removeClass('modal-open');
				$('.modal-backdrop').remove();
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    }

    function cuenta_editar(modelo_cuenta_id){
    	var cuenta_usuario = $('#edit_cuenta_usuario_'+modelo_cuenta_id).val();
    	var cuenta_clave = $('#edit_cuenta_clave_'+modelo_cuenta_id).val();
    	var cuenta_correo = $('#edit_cuenta_correo_'+modelo_cuenta_id).val();
    	var cuenta_link = $('#edit_cuenta_link_'+modelo_cuenta_id).val();
    	$.ajax({
            url: '../script/modelo_editar_cuenta.php',
            type: 'POST',
           	dataType: "JSON",
           	data: {
           		"modelo_cuenta_id": modelo_cuenta_id,
           		"cuenta_usuario": cuenta_usuario,
           		"cuenta_clave": cuenta_clave,
           		"cuenta_correo": cuenta_correo,
           		"cuenta_link": cuenta_link,
           	},

            beforeSend: function (){},

            success: function(response){
            	console.log(response);
            	Swal.fire({
	 				title: 'Se ha modificado la Cuenta!',
	 				text: "Limpiando Cache...",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: false,
	 				timer: 2000
				});
				$("#Modal_cuentas1").modal('hide');
				$('#Modal_cuentas1').removeClass('modal-open');
				$('.modal-backdrop').remove();
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    }

    function colocar_responsable(id_modelo,id_responsable){
    	$.ajax({
            url: '../script/modelo_guardar_responsable1.php',
            type: 'POST',
           	dataType: "JSON",
           	data: {
           		"id_modelo": id_modelo,
           		"id_responsable": id_responsable,
           	},

            beforeSend: function (){},

            success: function(response){
            	console.log(response);
            	Swal.fire({
	 				title: 'Modificado!',
	 				text: "Limpiando Cache...",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: false,
	 				timer: 1000
				});
				$("#Modal_cuentas1").modal('hide');
				$('#Modal_cuentas1').removeClass('modal-open');
				$('.modal-backdrop').remove();
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    }

    function generar_clave1(id){
		$.ajax({
			url: '../script/generar_clave1.php',
			type: 'POST',
			dataType: "JSON",
			data: {
				"id": id,
			},

			success: function(respuesta) {
				console.log(respuesta);
				Swal.fire({
			 		title: 'Correo enviado',
			 		text: "Se ha generado su clave",
			 		icon: 'success',
			 		position: 'center',
			 		showConfirmButton: false,
			 		timer: 3000
				})
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function eliminar_foto1(id_modelo,documento,id_documento){
		Swal.fire({
		  title: 'Estas seguro?',
		  text: "Esta acción no podra revertirse",
		  icon: 'warning',
		  showConfirmButton: true,
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, Eliminar registro!',
		  cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.value) {
		 		$.ajax({
					url: '../script/borrar_foto_modelo1.php',
					type: 'POST',
					dataType: "JSON",
					data: {
						"id_modelo": id_modelo,
						"documento": documento,
						"id_documento": id_documento,
					},

					success: function(respuesta) {
						console.log(respuesta);
						if(respuesta['resultado']=='no existe'){
							Swal.fire({
						 		title: 'Error',
						 		text: "Ya se ha eliminado archivo!",
						 		icon: 'error',
						 		position: 'center',
						 		showConfirmButton: false,
						 		timer: 2000
							});
						}

						if(respuesta['resultado']=='correcto'){
							Swal.fire({
						 		title: 'Perfecto!',
						 		text: "Se ha eliminado correctamente",
						 		icon: 'success',
						 		position: 'center',
						 		showConfirmButton: false,
						 		timer: 3000
							})
						}

						$('#documento_'+id_documento).hide('slow');

					},

					error: function(respuesta) {
						console.log(respuesta['responseText']);
					}
				});
			}
		})
	}

</script>