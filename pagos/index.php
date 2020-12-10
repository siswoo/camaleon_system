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
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
	<!--<link rel="stylesheet" href="../css/mdb.css">-->
	<!--<link rel="stylesheet" href="../css/style.css">-->
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



	</style>

<?php
	include('../script/conexion.php');
	$ubicacion = "pagos";
	include('../script/navbar_verificacion.php');
	include('../navbar.php');
?>
	<form id="formulario1" method="POST">
		<input type="hidden" id="modelo_view" value="<?php echo $modelo_view; ?>">
		<input type="hidden" id="modelo_edit" value="<?php echo $modelo_edit; ?>">
		<input type="hidden" id="modelo_delete" value="<?php echo $modelo_delete; ?>">
	</form>
	<div class="row">
		<div class="col-12 text-center mt-3">
			<!--
			<a href="nuevo_pago.php" style="text-decoration: none;">
				<input type="submit" class="btn btn-success" value="Nuevo Pago">
			</a>
			<input type="submit" class="btn btn-info" value="Descuentos" data-toggle="modal" data-target="#exampleModal3">
			<button type="button" class="btn btn-info" value="No" id="pendientes" onclick="mostrarSeccionPendientes1(this.id,value);">Pendientes</button>
			-->
			<button type="button" class="btn btn-info" value="No" id="extras" onclick="mostrarSeccionExtras1(this.id,value);">Extras</button>
			<button type="button" class="btn btn-info" value="No" id="graficos" onclick="mostrarSeccionGraficos1(this.id,value);">Gráficos</button>
			<button type="button" class="btn btn-info" value="No" id="datos" onclick="mostrarSeccion1(this.id,value);">Datos</button>
			<button type="button" class="btn btn-info" value="No" id="desprendibles" onclick="mostrarSeccionDesprendible1(this.id,value);">Desprendible de Pagos</button>
		</div>
	</div>

	<!--<div class="col-12 text-center" style="font-weight: bold; ">Resumen de Pagos Efectuados</div>-->

	<div class="seccion1" id="seccion1" style="display: none;">
	    <div class="row">
	    	<div class="col-12 text-center">
			    <button type="button" class="btn btn-info" value="No" id="Imlive" onclick="mostrarSeccion2(this.id,value);">Imlive</button>
			    <button type="button" class="btn btn-info ml-3" value="No" id="XLove" onclick="mostrarSeccion2(this.id,value);">XLove</button>
			    <button type="button" class="btn btn-info ml-3" value="No" id="chaturbate" onclick="mostrarSeccion2(this.id,value);">Chaturbate</button>
			    <button type="button" class="btn btn-info ml-3" value="No" id="stripchat" onclick="mostrarSeccion2(this.id,value);">Stripchat</button>
			    <button type="button" class="btn btn-info ml-3" value="No" id="streamate" onclick="mostrarSeccion2(this.id,value);">Streamate</button>
			    <button type="button" class="btn btn-info ml-3" value="No" id="Myfreecams" onclick="mostrarSeccion2(this.id,value);">Myfreecams</button>
			    <button type="button" class="btn btn-info ml-3" value="No" id="LiveJasmin" onclick="mostrarSeccion2(this.id,value);">LiveJasmin</button>
			    <button type="button" class="btn btn-info ml-3" value="No" id="Bonga" onclick="mostrarSeccion2(this.id,value);">Bonga</button>
			    <button type="button" class="btn btn-info ml-3" value="No" id="Cam4" onclick="mostrarSeccion2(this.id,value);">Cam4</button>
			    <button type="button" class="btn btn-info ml-3" value="No" id="Camsoda" onclick="mostrarSeccion2(this.id,value);">Camsoda</button>
			    <button type="button" class="btn btn-info ml-3" value="No" id="Flirt4free" onclick="mostrarSeccion2(this.id,value);">Flirt4free</button>
		    </div>
		</div>
	</div>

	<div class="seccion1" id="div_Imlive" style="display: none; border: 3px solid black; border-radius: 1rem; padding: 5px 5px 5px 5px;">
		<form id="formulario_Imlive" method="POST" action="#">
	    	<div class="row">
	    		<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">Reporte de Imlive</p>
				</div>
				<div class="form-group col-12">
				    <label for="archivo_Imlive">Archivo Generado</label>
				    <input type="file" class="form-control" name="archivo_Imlive" id="archivo_Imlive" required>
				</div>
				<div class="form-group col-6">
					<label>Fecha Desde</label>
					<input type="date" id="fecha_desde_Imlive" name="fecha_desde_Imlive" class="form-control" required>
				</div>
				<div class="form-group col-6">
					<label>Fecha Hasta</label>
					<input type="date" id="fecha_hasta_Imlive" name="fecha_hasta_Imlive" class="form-control" required>
				</div>
				<div class="form-group col-12 text-center">
				    <button type="submit" id="submit_Imlive" class="btn btn-primary">Cargar Datos</button>
				</div>
			</div>
		</form>
	</div>

	<div class="seccion1" id="div_XLove" style="display: none; border: 3px solid black; border-radius: 1rem; padding: 5px 5px 5px 5px;">
		<form id="formulario_XLove" method="POST" action="#">
	    	<div class="row">
				<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">Reporte de XLove</p>
				</div>
				<div class="form-group col-6">
					<label>Archivo Excel</label>
				    <input type="file" class="form-control" name="archivo_XLove" id="archivo_XLove" required>
				</div>
				<div class="form-group col-6">
					<label>EUR a USD Coste</label>
					<input type="text" id="coste_euro_XLove" name="coste_euro_XLove" class="form-control" required>
				</div>
				<div class="form-group col-6">
					<label>Fecha Desde</label>
					<input type="date" id="fecha_desde_XLove" name="fecha_desde_XLove" class="form-control" required>
				</div>
				<div class="form-group col-6">
					<label>Fecha Hasta</label>
					<input type="date" id="fecha_hasta_XLove" name="fecha_hasta_XLove" class="form-control" required>
				</div>
				<div class="form-group col-12 text-center">
				    <button type="submit" id="submit_XLove" class="btn btn-primary">Ejecutar API</button>
				</div>
			</div>
		</form>
	</div>

	<div class="seccion1" id="div_chaturbate" style="display: none; border: 3px solid black; border-radius: 1rem; padding: 5px 5px 5px 5px;">
		<form id="formulario_chaturbate" method="POST" action="#">
	    	<div class="row">
				<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">Reporte de Chaturbate</p>
				</div>
				<div class="form-group col-6">
					<label>Archivo Excel</label>
				    <input type="file" class="form-control" name="archivo_chaturbate" id="archivo_chaturbate" required>
				</div>
				<div class="form-group col-6">
					<label>Fecha</label>
					<input type="date" id="fecha_chaturbate" class="form-control" name="fecha_chaturbate" value="<?php echo date('Y-m-d'); ?>" required>
				</div>
				<div class="form-group col-12 text-center">
				    <button type="submit" id="submit_chaturbate" class="btn btn-primary">Ejecutar API</button>
				</div>
			</div>
		</form>
	</div>

	<div class="seccion1" id="div_stripchat" style="display: none; border: 3px solid black; border-radius: 1rem; padding: 5px 5px 5px 5px;">
		<form id="formulario_stripchat" method="POST" action="#">
	    	<div class="row">
				<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">Reporte de Stripchat</p>
				</div>
				<div class="form-group col-6">
					<label>Archivo Excel</label>
				    <input type="file" class="form-control" name="archivo_stripchat" id="archivo_stripchat" required>
				</div>
				<div class="form-group col-6">
					<label>Fecha</label>
					<input type="date" id="fecha_stripchat" class="form-control" name="fecha_stripchat" value="<?php echo date('Y-m-d'); ?>" required>
				</div>
				<div class="form-group col-12 text-center">
				    <button type="submit" id="submit_stripchat" class="btn btn-primary">Ejecutar API</button>
				</div>
			</div>
		</form>
	</div>

	<div class="seccion1" id="div_streamate" style="display: none; border: 3px solid black; border-radius: 1rem; padding: 5px 5px 5px 5px;">
		<form id="formulario_streamate" method="POST" action="#">
	    	<div class="row">
				<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">Reporte de StreaMate</p>
				</div>
				<div class="form-group col-4">
					<label>Archivo Excel</label>
				    <input type="file" class="form-control" name="archivo_streamate" id="archivo_streamate" required>
				</div>
				<div class="form-group col-4">
					<label>Fecha Desde</label>
					<input type="date" id="fecha_desde_streamate" name="fecha_desde_streamate" class="form-control" required>
				</div>
				<div class="form-group col-4">
					<label>Fecha Hasta</label>
					<input type="date" id="fecha_hasta_streamate" name="fecha_hasta_streamate" class="form-control" required>
				</div>
				<div class="form-group col-12 text-center">
				    <button type="submit" id="submit_streamate" class="btn btn-primary">Ejecutar API</button>
				</div>
			</div>
		</form>
	</div>

	<div class="seccion1" id="div_Myfreecams" style="display: none; border: 3px solid black; border-radius: 1rem; padding: 5px 5px 5px 5px;">
	    	<div class="row">
				<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">Reporte de Myfreecams</p>
				</div>
				<div class="form-group col-3">
					<label>Recorte N°</label>
					<select class="form-control" name="recorte_Myfreecams" id="recorte_Myfreecams" required>
						<option value="">Seleccione</option>
						<option value="1">1</option>
						<option value="2">2</option>
					</select>
				</div>
				<div class="form-group col-3">
					<label>Mes</label>
					<select class="form-control" name="mes_Myfreecams" id="mes_Myfreecams" required>
						<option value="">Seleccione</option>
						<option value="01">Enero</option>
						<option value="02">Febrero</option>
						<option value="03">Marzo</option>
						<option value="04">Abril</option>
						<option value="05">Mayo</option>
						<option value="06">Junio</option>
						<option value="07">Julio</option>
						<option value="08">Agosto</option>
						<option value="09">Septiembre</option>
						<option value="10">Octubre</option>
						<option value="11">Noviembre</option>
						<option value="12">Diciembre</option>
					</select>
				</div>
				<div class="form-group col-3">
					<label>Año</label>
					<select class="form-control" name="year_Myfreecams" id="year_Myfreecams" required>
						<option value="2020">2020</option>
						<option value="2021">2021</option>
						<option value="2022">2022</option>
						<option value="2023">2023</option>
						<option value="2024">2024</option>
						<option value="2025">2025</option>
					</select>
				</div>
				<div class="form-group col-3">
				    <button type="submit" id="submit_Myfreecams" class="btn btn-primary" style="margin-top: 31px;" onclick="consultarMyfreecams();">Consultar Modelos</button>
				</div>
			</div>

			<div id="div_Myfreecams2">
				<form id="formulario_Myfreecams" method="POST" action="#">
					<div id="resultado1_Myfreecams" class="form-group col-12 text-center">
						<table border="1" class="table">
							<thead>
								<tr>
									<th>Modelo</th>
									<th>Usuario</th>
									<th>Contraseña</th>
									<th>Tokens</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody id="tbody_myfreecams">
							</tbody>
						</table>
					</div>
				</form>
			</div>
	</div>

	<div class="seccion1" id="div_LiveJasmin" style="display: none; border: 3px solid black; border-radius: 1rem; padding: 5px 5px 5px 5px;">
		<div class="row">
				<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">Reporte de LiveJasmin</p>
				</div>
				<div class="form-group col-3">
					<label>Recorte N°</label>
					<select class="form-control" name="recorte_LiveJasmin" id="recorte_LiveJasmin" required>
						<option value="">Seleccione</option>
						<option value="1">1</option>
						<option value="2">2</option>
					</select>
				</div>
				<div class="form-group col-3">
					<label>Mes</label>
					<select class="form-control" name="mes_LiveJasmin" id="mes_LiveJasmin" required>
						<option value="">Seleccione</option>
						<option value="01">Enero</option>
						<option value="02">Febrero</option>
						<option value="03">Marzo</option>
						<option value="04">Abril</option>
						<option value="05">Mayo</option>
						<option value="06">Junio</option>
						<option value="07">Julio</option>
						<option value="08">Agosto</option>
						<option value="09">Septiembre</option>
						<option value="10">Octubre</option>
						<option value="11">Noviembre</option>
						<option value="12">Diciembre</option>
					</select>
				</div>
				<div class="form-group col-3">
					<label>Año</label>
					<select class="form-control" name="year_LiveJasmin" id="year_LiveJasmin" required>
						<option value="2020">2020</option>
						<option value="2021">2021</option>
						<option value="2022">2022</option>
						<option value="2023">2023</option>
						<option value="2024">2024</option>
						<option value="2025">2025</option>
					</select>
				</div>
				<div class="form-group col-3">
				    <button type="submit" id="submit_LiveJasmin" class="btn btn-primary" style="margin-top: 31px;" onclick="consultarLiveJasmin();">Consultar Modelos</button>
				</div>
			</div>

			<div id="div_LiveJasmin2">
				<form id="formulario_LiveJasmin" method="POST" action="#">
					<div id="resultado1_LiveJasmin" class="form-group col-12 text-center">
						<table border="1" class="table">
							<thead>
								<tr>
									<th>Modelo</th>
									<th>Usuario</th>
									<th>Contraseña</th>
									<th>Dolares</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody id="tbody_LiveJasmin">
							</tbody>
						</table>
					</div>
				</form>
			</div>
	</div>

	<div class="seccion1" id="div_Bonga" style="display: none; border: 3px solid black; border-radius: 1rem; padding: 5px 5px 5px 5px;">
		<div class="row">
				<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">Reporte de Bonga</p>
				</div>
				<div class="form-group col-3">
					<label>Recorte N°</label>
					<select class="form-control" name="recorte_Bonga" id="recorte_Bonga" required>
						<option value="">Seleccione</option>
						<option value="1">1</option>
						<option value="2">2</option>
					</select>
				</div>
				<div class="form-group col-3">
					<label>Mes</label>
					<select class="form-control" name="mes_Bonga" id="mes_Bonga" required>
						<option value="">Seleccione</option>
						<option value="01">Enero</option>
						<option value="02">Febrero</option>
						<option value="03">Marzo</option>
						<option value="04">Abril</option>
						<option value="05">Mayo</option>
						<option value="06">Junio</option>
						<option value="07">Julio</option>
						<option value="08">Agosto</option>
						<option value="09">Septiembre</option>
						<option value="10">Octubre</option>
						<option value="11">Noviembre</option>
						<option value="12">Diciembre</option>
					</select>
				</div>
				<div class="form-group col-3">
					<label>Año</label>
					<select class="form-control" name="year_Bonga" id="year_Bonga" required>
						<option value="2020">2020</option>
						<option value="2021">2021</option>
						<option value="2022">2022</option>
						<option value="2023">2023</option>
						<option value="2024">2024</option>
						<option value="2025">2025</option>
					</select>
				</div>
				<div class="form-group col-3">
				    <button type="submit" id="submit_Bonga" class="btn btn-primary" style="margin-top: 31px;" onclick="consultarBonga();">Consultar Modelos</button>
				</div>
			</div>

			<div id="div_Bonga2">
				<form id="formulario_Bonga" method="POST" action="#">
					<div id="resultado1_Bonga" class="form-group col-12 text-center">
						<table border="1" class="table">
							<thead>
								<tr>
									<th>Modelo</th>
									<th>Usuario</th>
									<th>Contraseña</th>
									<th>Dolares</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody id="tbody_Bonga">
							</tbody>
						</table>
					</div>
				</form>
			</div>
	</div>


	<div class="seccion1" id="div_Cam4" style="display: none; border: 3px solid black; border-radius: 1rem; padding: 5px 5px 5px 5px;">
		<div class="row">
				<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">Reporte de Cam4</p>
				</div>
				<div class="form-group col-3">
					<label>Recorte N°</label>
					<select class="form-control" name="recorte_Cam4" id="recorte_Cam4" required>
						<option value="">Seleccione</option>
						<option value="1">1</option>
						<option value="2">2</option>
					</select>
				</div>
				<div class="form-group col-3">
					<label>Mes</label>
					<select class="form-control" name="mes_Cam4" id="mes_Cam4" required>
						<option value="">Seleccione</option>
						<option value="01">Enero</option>
						<option value="02">Febrero</option>
						<option value="03">Marzo</option>
						<option value="04">Abril</option>
						<option value="05">Mayo</option>
						<option value="06">Junio</option>
						<option value="07">Julio</option>
						<option value="08">Agosto</option>
						<option value="09">Septiembre</option>
						<option value="10">Octubre</option>
						<option value="11">Noviembre</option>
						<option value="12">Diciembre</option>
					</select>
				</div>
				<div class="form-group col-3">
					<label>Año</label>
					<select class="form-control" name="year_Cam4" id="year_Cam4" required>
						<option value="2020">2020</option>
						<option value="2021">2021</option>
						<option value="2022">2022</option>
						<option value="2023">2023</option>
						<option value="2024">2024</option>
						<option value="2025">2025</option>
					</select>
				</div>
				<div class="form-group col-3">
				    <button type="submit" id="submit_Cam4" class="btn btn-primary" style="margin-top: 31px;" onclick="consultarCam4();">Consultar Modelos</button>
				</div>
			</div>

			<div id="div_Cam42">
				<form id="formulario_Cam4" method="POST" action="#">
					<div id="resultado1_Cam4" class="form-group col-12 text-center">
						<table border="1" class="table">
							<thead>
								<tr>
									<th>Modelo</th>
									<th>Usuario</th>
									<th>Contraseña</th>
									<th>Dolares</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody id="tbody_Cam4">
							</tbody>
						</table>
					</div>
				</form>
			</div>
	</div>

	<div class="seccion1" id="div_Camsoda" style="display: none; border: 3px solid black; border-radius: 1rem; padding: 5px 5px 5px 5px;">
		<div class="row">
				<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">Reporte de Camsoda</p>
				</div>
				<div class="form-group col-3">
					<label>Recorte N°</label>
					<select class="form-control" name="recorte_Camsoda" id="recorte_Camsoda" required>
						<option value="">Seleccione</option>
						<option value="1">1</option>
						<option value="2">2</option>
					</select>
				</div>
				<div class="form-group col-3">
					<label>Mes</label>
					<select class="form-control" name="mes_Camsoda" id="mes_Camsoda" required>
						<option value="">Seleccione</option>
						<option value="01">Enero</option>
						<option value="02">Febrero</option>
						<option value="03">Marzo</option>
						<option value="04">Abril</option>
						<option value="05">Mayo</option>
						<option value="06">Junio</option>
						<option value="07">Julio</option>
						<option value="08">Agosto</option>
						<option value="09">Septiembre</option>
						<option value="10">Octubre</option>
						<option value="11">Noviembre</option>
						<option value="12">Diciembre</option>
					</select>
				</div>
				<div class="form-group col-3">
					<label>Año</label>
					<select class="form-control" name="year_Camsoda" id="year_Camsoda" required>
						<option value="2020">2020</option>
						<option value="2021">2021</option>
						<option value="2022">2022</option>
						<option value="2023">2023</option>
						<option value="2024">2024</option>
						<option value="2025">2025</option>
					</select>
				</div>
				<div class="form-group col-3">
				    <button type="submit" id="submit_Camsoda" class="btn btn-primary" style="margin-top: 31px;" onclick="consultarCamsoda();">Consultar Modelos</button>
				</div>
			</div>

			<div id="div_Camsoda2">
				<form id="formulario_Camsoda" method="POST" action="#">
					<div id="resultado1_Camsoda" class="form-group col-12 text-center">
						<table border="1" class="table">
							<thead>
								<tr>
									<th>Modelo</th>
									<th>Usuario</th>
									<th>Contraseña</th>
									<th>Tokens</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody id="tbody_Camsoda">
							</tbody>
						</table>
					</div>
				</form>
			</div>
	</div>

	<div class="seccion1" id="div_Flirt4free" style="display: none; border: 3px solid black; border-radius: 1rem; padding: 5px 5px 5px 5px;">
		<div class="row">
				<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">Reporte de Flirt4free</p>
				</div>
				<div class="form-group col-3">
					<label>Recorte N°</label>
					<select class="form-control" name="recorte_Flirt4free" id="recorte_Flirt4free" required>
						<option value="">Seleccione</option>
						<option value="1">1</option>
						<option value="2">2</option>
					</select>
				</div>
				<div class="form-group col-3">
					<label>Mes</label>
					<select class="form-control" name="mes_Flirt4free" id="mes_Flirt4free" required>
						<option value="">Seleccione</option>
						<option value="01">Enero</option>
						<option value="02">Febrero</option>
						<option value="03">Marzo</option>
						<option value="04">Abril</option>
						<option value="05">Mayo</option>
						<option value="06">Junio</option>
						<option value="07">Julio</option>
						<option value="08">Agosto</option>
						<option value="09">Septiembre</option>
						<option value="10">Octubre</option>
						<option value="11">Noviembre</option>
						<option value="12">Diciembre</option>
					</select>
				</div>
				<div class="form-group col-3">
					<label>Año</label>
					<select class="form-control" name="year_Flirt4free" id="year_Flirt4free" required>
						<option value="2020">2020</option>
						<option value="2021">2021</option>
						<option value="2022">2022</option>
						<option value="2023">2023</option>
						<option value="2024">2024</option>
						<option value="2025">2025</option>
					</select>
				</div>
				<div class="form-group col-3">
				    <button type="submit" id="submit_Flirt4free" class="btn btn-primary" style="margin-top: 31px;" onclick="consultarFlirt4free();">Consultar Modelos</button>
				</div>
			</div>

			<div id="div_Flirt4free2">
				<form id="formulario_Flirt4free" method="POST" action="#">
					<div id="resultado1_Flirt4free" class="form-group col-12 text-center">
						<table border="1" class="table">
							<thead>
								<tr>
									<th>Modelo</th>
									<th>Usuario</th>
									<th>Contraseña</th>
									<th>Dolares</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody id="tbody_Flirt4free">
							</tbody>
						</table>
					</div>
				</form>
			</div>
	</div>

<!--****************************GRAFICOS****************************-->

	<div class="seccion1" id="graficos1" style="display: none; border: 3px solid black; border-radius: 1rem; padding: 5px 5px 5px 5px;">
		<form id="formulario_graficos1" method="POST" action="#">
	    	<div class="row">
				<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">Reporte de Gráficos</p>
				</div>
				<div class="form-group col-12">
					<label>Gráficos</label>
				    <select class="form-control" name="select_graficos1" id="select_graficos1" required>
				    	<option value="">Seleccione</option>
				    	<option value="Imlive">Imlive</option>
				    	<option value="XLove">XLove</option>
				    	<option value="Chaturbate">Chaturbate</option>
				    	<option value="Stripchat">Stripchat</option>
				    	<option value="Streamate">Streamate</option>
				    	<option value="Myfreecams">Myfreecams</option>
				    </select>
				</div>
				<div class="form-group col-12 text-center">
				    <button type="button" id="submit_crear_grafica1" class="btn btn-primary" onclick="creargrafica1(this.id);">Crear Gráfica</button>
				</div>
			</div>
		</form>

		<div class="container" id="div_grafica_mostrar1" style="max-height: 400px; max-width: 800px; display: none;">
			<div class="col-12">
				<canvas id="speedCanvas" height="400vw" width="800vw"></canvas>
			</div>
		</div>


	</div>

<!--****************************FIN GRAFICOS****************************-->


<!--****************************PENDIENTES****************************-->

	<div class="seccion1" id="div_pendientes" style="display: none; border: 3px solid black; border-radius: 1rem; padding: 5px 5px 5px 5px;">
		<form id="formulario_stripchat" method="POST" action="#">
	    	<div class="row">
				<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">PENDIENTES</p>
				</div>
				<div class="form-group col-12 text-center">
				    <button class="btn btn-primary" type="button" onclick="button_pendientes(10);">Imlive</button>
				    <button class="btn btn-primary ml-2" type="button" onclick="button_pendientes(11);">XLove</button>
				    <button class="btn btn-primary ml-2" type="button" onclick="button_pendientes(1);">Chaturbate</button>
				    <button class="btn btn-primary ml-2" type="button" onclick="button_pendientes(5);">Stripchat</button>
				    <button class="btn btn-primary ml-2" type="button" onclick="button_pendientes(7);">Streamate</button>
				    <button class="btn btn-primary ml-2" type="button" onclick="button_pendientes(2);">Myfreecams</button>
				    <button class="btn btn-primary ml-2" type="button" onclick="button_pendientes(9);">LiveJasmin</button>
				</div>
				<div class="form-group col-12 text-center">
				    <div id="respuesta_pendientes1"></div>
				</div>
			</div>
		</form>

		<div class="container" id="div_grafica_mostrar1" style="max-height: 400px; max-width: 800px; display: none;">
			<div class="col-12">
				<canvas id="speedCanvas" height="400vw" width="800vw"></canvas>
			</div>
		</div>


	</div>

<!--****************************FIN PENDIENTES****************************-->


<!--****************************EXTRAS****************************-->
	
	<div class="seccion1" id="div_extras" style="display: none; padding: 5px 5px 5px 5px;">
		<div class="row">
			<div class="form-group col-12 text-center">
				<button class="btn btn-primary" type="button" value="No" id="crear_extras1" onclick="mostrarSeccionExtras2(this.id,value);">Crear Extras</button>
				<button class="btn btn-primary ml-3" type="button" value="No" id="consultar_extras1" onclick="mostrarSeccionExtras3(this.id,value);">Consultar Extras</button>
				<button class="btn btn-primary ml-3" type="button" value="No" id="consultar_extras1" onclick="mostrarSeccionExtras4(this.id,value);">Subir Extras</button>
			</div>
		</div>
	</div>

	<div class="seccion1" id="div_extras2" style="display: none; border: 3px solid black; border-radius: 1rem; padding: 5px 5px 5px 5px;">
	    	<div class="row">
				<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">Crear Extras</p>
				</div>
				<div class="form-group col-12">
				    <table class="table" border="1">
				    	<thead>
				    		<tr>
				    			<th class="text-center">Modelo</th>
				    			<th class="text-center">Tipo</th>
				    			<th class="text-center">Concepto</th>
				    			<th class="text-center">Valor</th>
				    			<th class="text-center">Fecha</th>
				    			<th class="text-center">Opción</th>
				    		</tr>
				    	</thead>
				    	<tbody>
				    		<tr>
				    			<td>
				    				<input type="search" name="extra_modelo" id="extra_modelo" list="listamodelos" class="form-control" onkeyup="buscarModelo(value);" autocomplete="off" required>
				    				<datalist id="listamodelos">
				    					<option></option>
				   					</datalist>
				    			</td>
				    			<td>
				    				<select class="form-control" name="extra_tipo1" id="extra_tipo1" required>
				    					<option value="">Seleccione</option>
				    					<option value="descuento">Descuento</option>
				    					<option value="tienda">Tienda</option>
				    					<option value="avances">Avances</option>
				    					<option value="multas">Multas</option>
				    				</select>
				    			</td>
				    			<td>
				    				<input type="text" name="extra_concepto" id="extra_concepto" class="form-control" required>
				    			</td>
				    			<td>
				    				<input type="number" name="extra_valor" id="extra_valor" class="form-control" required>
				    			</td>
				    			<td>
				    				<input type="date" name="extra_fecha" id="extra_fecha" class="form-control" required>
				    			</td>
				    			<td class="text-center">
				    				<button class="btn btn-success" type="button" onclick="guardar_extra1();">Guardar</button>
				    			</td>
				    		</tr>
				    	</tbody>
				    </table>
				</div>
			</div>
	</div>

	<div class="seccion1" id="div_extras3" style="display: none; border: 3px solid black; border-radius: 1rem; padding: 5px 5px 5px 5px;">
		<form id="formulario_extras" method="POST" action="#">
	    	<div class="row">
				<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">Consultar Extras</p>
				</div>
				<div class="form-group col-12 text-center">
					<button class="btn btn-primary" type="button" value="descuento" onclick="generar_extra(value);">Descuentos</button>
					<button class="btn btn-primary ml-3" type="button" value="tienda" onclick="generar_extra(value);">Tienda</button>
					<button class="btn btn-primary ml-3" type="button" value="avances" onclick="generar_extra(value);">Avances</button>
					<button class="btn btn-primary ml-3" type="button" value="multas" onclick="generar_extra(value);">Multas</button>
				</div>
				<div class="form-group col-12" id="extra_generado1"></div>
			</div>
		</form>
	</div>

	<div class="seccion1" id="div_extras4" style="display: none; border: 3px solid black; border-radius: 1rem; padding: 5px 5px 5px 5px;">
		<form id="formulario_subir_extras" method="POST" action="#">
	    	<div class="row">
				<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">Subir Extras</p>
				</div>
				<div class="form-group col-4 text-center">
					<label for="file_subir_extras">Archivo Excel</label>
					<input type="file" id="file_subir_extras" name="file_subir_extras" required class="form-control">
				</div>
				<div class="form-group col-4 text-center">
					<label for="fecha_desde_subir_extras">Fecha Desde</label>
					<input type="date" id="fecha_desde_subir_extras" name="fecha_desde_subir_extras" required class="form-control">
				</div>
				<div class="form-group col-4 text-center">
					<label for="fecha_hasta_subir_extras">Fecha Hasta</label>
					<input type="date" id="fecha_hasta_subir_extras" name="fecha_hasta_subir_extras" required class="form-control">
				</div>
				<div class="form-group col-12 text-center">
					<input type="submit" name="submit_subir_extras" id="submit_subir_extras" value="Generar API" class="btn btn-success">
				</div>
				<div class="form-group col-12" id="subir_extra_generado"></div>
			</div>
		</form>
	</div>

<!--****************************FIN EXTRAS****************************-->


<!--****************************DESPRENDIBLES****************************-->

	<div class="seccion1" id="div_desprendibles" style="display: none; border: 3px solid black; border-radius: 1rem; padding: 5px 5px 5px 5px;">
	    	<div class="row">
				<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">Desprendibles</p>
				</div>
				<div class="form-group col-6">
					<label for="desprendible_fecha_desde">Fecha Desde</label>
					<input type="date" class="form-control" name="desprendible_fecha_desde" id="desprendible_fecha_desde" required>
				</div>
				<div class="form-group col-6">
					<label for="desprendible_fecha_hasta">Fecha Hasta</label>
					<input type="date" class="form-control" name="desprendible_fecha_hasta" id="desprendible_fecha_hasta" required>
				</div>
				<div class="form-group col-12">
					<label for="desprendible_trm">TRM</label>
					<input type="text" class="form-control" name="desprendible_trm" id="desprendible_trm" required>
				</div>
				<div class="form-group col-12 text-center">
				    <button type="button" class="btn btn-success" onclick="generar_desprendible1();">Generar Desprendible</button>
				</div>
				<div class="form-group col-12" id="desprendible_generado1"></div>
			</div>
			<form method="POST" action="../script/generar_desprendible1.php" id="formulario_desprendible_hidden1">
				<input type="hidden" name="desprendible_fecha_desde_hidden" id="desprendible_fecha_desde_hidden">
				<input type="hidden" name="desprendible_fecha_hasta_hidden" id="desprendible_fecha_hasta_hidden">
				<input type="hidden" name="desprendible_trm_hidden" id="desprendible_trm_hidden">
			</form>
	</div>

<!--****************************FIN DESPRENDIBLES****************************-->

<?php include('../footer.php'); ?>

</body>
</html>

<script src="../js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../js/popper.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="../js/navbar.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="../js/mdb.js"></script>
<!--<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>-->
<script src="../js/Chart.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
    	var table = $('#example').DataTable( {
        	//"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
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
	} );

	$('#myModal').on('shown.bs.modal', function () {
	  	$('#myInput').trigger('focus')
	});

	function mostrarSeccion1(button,value){
		//console.log(button);
		if(value=='Si'){
			$('#seccion1').hide('slow');
			$('#'+button).val('No');
		}else{
			$('#seccion1').show('slow');
			$('#'+button).val('Si');
		}
	}

	function mostrarSeccion2(button,value){
		//console.log(button);
		if(value=='Si'){
			$('#div_'+button).hide('slow');
			$('#'+button).val('No');
			$('#'+button).removeClass('active');
			$('#'+button).removeClass('font-weight-bold');
		}else{
			$('#div_'+button).show('slow');
			$('#'+button).val('Si');
			$('#'+button).addClass('active');
			$('#'+button).addClass('font-weight-bold');
		}
	}

	$("#formulario_Imlive").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#archivo_Imlive')[0].files[0];
        fd.append('file',files);
        fd.append('fecha_desde_Imlive',$('#fecha_desde_Imlive').val());
        fd.append('fecha_hasta_Imlive',$('#fecha_hasta_Imlive').val());

        $.ajax({
            url: '../script/subir_imlive.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_Imlive').attr('disabled','true');
            },

            success: function(response){
            	console.log(response);
            	if(response=='error'){
            		$('#submit_Imlive').removeAttr('disabled');
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> xls xml xlam xlsx",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
            		return false;
            	}else{
            		Swal.fire({
		 				title: 'Guardado exitosamente!',
		 				text: "Limpiando Cache...",
		 				icon: 'success',
		 				position: 'center',
		 				showConfirmButton: true,
		 				timer: 2000
					});
	            	setTimeout(function() {
				      	window.location.href = "index.php";
				    },2000);
            	}
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    });

    $("#formulario_XLove").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#archivo_XLove')[0].files[0];
        fd.append('file',files);
        fd.append('fecha_desde_XLove',$('#fecha_desde_XLove').val());
        fd.append('fecha_hasta_XLove',$('#fecha_hasta_XLove').val());
        fd.append('coste_euro_XLove',$('#coste_euro_XLove').val());

        $.ajax({
            url: '../script/subir_xlove.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_XLove').attr('disabled','true');
            },

            success: function(response){
            	//console.log(response);
            	if(response=='error'){
            		$('#submit_XLove').attr('disabled','false');
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> xls xml xlam xlsx",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
            		return false;
            	}else{
            		Swal.fire({
		 				title: 'Guardado exitosamente!',
		 				text: "Limpiando Cache...",
		 				icon: 'success',
		 				position: 'center',
		 				showConfirmButton: true,
		 				timer: 2000
					});
	            	setTimeout(function() {
				      	window.location.href = "index.php";
				    },2000);
            	}
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    });


    $("#formulario_chaturbate").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#archivo_chaturbate')[0].files[0];
        fd.append('file',files);
        fd.append('fecha_chaturbate',$('#fecha_chaturbate').val());

        $.ajax({
            url: '../script/subir_chaturbate.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_chaturbate').attr('disabled','true');
            },

            success: function(response){
            	console.log(response);
            	if(response=='error'){
            		$('#submit_chaturbate').attr('disabled','false');
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> xls xml xlam xlsx",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
            		return false;
            	}else{
            		Swal.fire({
		 				title: 'Guardado exitosamente!',
		 				text: "Limpiando Cache...",
		 				icon: 'success',
		 				position: 'center',
		 				showConfirmButton: true,
		 				timer: 2000
					});
	            	setTimeout(function() {
				      	window.location.href = "index.php";
				    },2000);
            	}
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    });

    $("#formulario_stripchat").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#archivo_stripchat')[0].files[0];
        fd.append('file',files);
        fd.append('fecha_stripchat',$('#fecha_stripchat').val());

        $.ajax({
            url: '../script/subir_stripchat.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_stripchat').attr('disabled','true');
            },

            success: function(response){
            	console.log(response);
            	if(response=='error'){
            		$('#submit_stripchat').attr('disabled','false');
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> xls xml xlam xlsx",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
            		return false;
            	}else{
            		Swal.fire({
		 				title: 'Guardado exitosamente!',
		 				text: "Limpiando Cache...",
		 				icon: 'success',
		 				position: 'center',
		 				showConfirmButton: true,
		 				timer: 2000
					});
	            	setTimeout(function() {
				      	window.location.href = "index.php";
				    },2000);
            	}
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    });

    function mostrarSeccionGraficos1(button,value){
    	console.log('ok');
    	if(value=='Si'){
			$('#graficos1').hide('slow');
			$('#'+button).val('No');
		}else{
			$('#graficos1').show('slow');
			$('#'+button).val('Si');
		}
    }

    $("#formulario_streamate").on("submit", function(e){
		e.preventDefault();
		var fecha_desde_streamate = $('#fecha_desde_streamate').val();
    	var fecha_hasta_streamate = $('#fecha_hasta_streamate').val();
        var fd = new FormData();
        var files = $('#archivo_streamate')[0].files[0];
        fd.append('file',files);
        fd.append('fecha_desde_streamate',$('#fecha_desde_streamate').val());
        fd.append('fecha_hasta_streamate',$('#fecha_hasta_streamate').val());

        $.ajax({
            url: '../script/subir_streamate.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_streamate').attr('disabled','true');
            },

            success: function(response){
            	console.log(response);
            	if(response=='error'){
            		$('#submit_streamate').attr('disabled','false');
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> xls xml xlam xlsx",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
            		return false;
            	}else{
            		Swal.fire({
		 				title: 'Guardado exitosamente!',
		 				text: "Limpiando Cache...",
		 				icon: 'success',
		 				position: 'center',
		 				showConfirmButton: true,
		 				timer: 2000
					});
	            	setTimeout(function() {
				      	window.location.href = "index.php";
				    },2000);
            	}
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    });


    function consultarMyfreecams(){
    	var recorte_Myfreecams = $('#recorte_Myfreecams').val();
    	var mes_Myfreecams = $('#mes_Myfreecams').val();
    	var year_Myfreecams = $('#year_Myfreecams').val();

    	if(recorte_Myfreecams=='' || mes_Myfreecams=='' || year_Myfreecams==''){
    		Swal.fire({
		 		title: 'Desplegables sin Señalar',
			 	text: "No olvide señalar un valor en cada campo por favor",
			 	icon: 'error',
			 	position: 'center',
			 	showConfirmButton: false,
			 	timer: 5000
			});
    		return false;
    	}
    	$.ajax({
            url: '../script/consultar_myfreecams1.php',
            type: 'POST',
            data: {
				"recorte_Myfreecams": recorte_Myfreecams,
				"mes_Myfreecams": mes_Myfreecams,
				"year_Myfreecams": year_Myfreecams,
			},

            beforeSend: function (){
            	$('#submit_Myfreecams').attr('disabled','true');
            },

            success: function(response){
            	//console.log(response);
            	$('#submit_Myfreecams').removeAttr('disabled');
            	$('#tbody_myfreecams').html(response);
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    }

    function guardarToken1(id){
    	var tokens = $('#tokens_'+id).val();
    	var fecha_desde_Myfreecams = $('#fecha_desde_Myfreecams').val();
    	var fecha_hasta_Myfreecams = $('#fecha_hasta_Myfreecams').val();
    	$.ajax({
            url: '../script/guardar_tokens_myfreecams1.php',
            type: 'POST',
            data: {
				"id": id,
				"tokens": tokens,
				"fecha_desde_Myfreecams": fecha_desde_Myfreecams,
				"fecha_hasta_Myfreecams": fecha_hasta_Myfreecams,
			},

            beforeSend: function (){},

            success: function(response){
            	console.log(response);
            	Swal.fire({
			 		title: 'Guardado',
				 	text: "Borrando Cache",
				 	icon: 'success',
				 	position: 'center',
				 	showConfirmButton: false,
				 	timer: 2000
				});
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    }

    function creargrafica1(submit){
    	var select_graficos1 = $('#select_graficos1').val();
    	if(select_graficos1==''){
    		$('#div_grafica_mostrar1').hide('slow');
    		return false;
    	}else{
    		$('#div_grafica_mostrar1').show('slow');
    	}

    	$.ajax({
            url: '../script/consulta_grafica1.php',
            type: 'POST',
            dataType: "JSON",
            data: {
				"select_graficos1": select_graficos1,
			},

            beforeSend: function (){},

            success: function(response){
            	console.log(response);
            	
            	var speedData = {
					labels: [
						response['fechas'][0],response['fechas'][1],response['fechas'][2],response['fechas'][3],"","",
						//fechas_resultados
						//response['fechas']
						//"Uno,Dos,Tres"
						//"Noviembre-2020","Octubre-2020","Enero-2021"
					],
					datasets: [
						dataFirst = {
							label: select_graficos1,
							lineTension: 0.3,
							data: [
								//response['tokens']
								100,3000,5000
							],
						},
						/*
						dataSecond = {
							label: "Chaturbate",
							data: [0, 59, 75, 20, 20, 55, 40],
							lineTension: 0.3,
						},
						*/
					]
				};

				var lineChart = new Chart(speedCanvas, {
					type: 'bar',
					data: speedData
				});
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    }

    function mostrarSeccionPendientes1(button,value){
    	if(value=='Si'){
			$('#div_pendientes').hide('slow');
			$('#'+button).val('No');
		}else{
			$('#div_pendientes').show('slow');
			$('#'+button).val('Si');
		}
    }

    function button_pendientes(value){
    	console.log(value);
    	$.ajax({
            url: '../script/pendientes_consulta_paginas1.php',
            type: 'POST',
            data: {
				"value": value,
			},

            beforeSend: function (){},

            success: function(response){
            	//console.log(response);
            	$('#respuesta_pendientes1').html(response);
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    }

    function consultarLiveJasmin(){
    	var recorte_LiveJasmin = $('#recorte_LiveJasmin').val();
    	var mes_LiveJasmin = $('#mes_LiveJasmin').val();
    	var year_LiveJasmin = $('#year_LiveJasmin').val();

    	if(recorte_LiveJasmin=='' || mes_LiveJasmin=='' || year_LiveJasmin==''){
    		Swal.fire({
		 		title: 'Desplegables sin Señalar',
			 	text: "No olvide señalar un valor en cada campo por favor",
			 	icon: 'error',
			 	position: 'center',
			 	showConfirmButton: false,
			 	timer: 5000
			});
    		return false;
    	}
    	$.ajax({
            url: '../script/consultar_livejasmin1.php',
            type: 'POST',
            data: {
				"recorte_LiveJasmin": recorte_LiveJasmin,
				"mes_LiveJasmin": mes_LiveJasmin,
				"year_LiveJasmin": year_LiveJasmin,
			},

            beforeSend: function (){
            	$('#submit_LiveJasmin').attr('disabled','true');
            },

            success: function(response){
            	//console.log(response);
            	$('#submit_LiveJasmin').removeAttr('disabled');
            	$('#tbody_LiveJasmin').html(response);
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    }

    function guardarToken_livejasmin(id){
    	var dolares = $('#dolares_livejasmin_'+id).val();
    	var fecha_desde_LiveJasmin = $('#fecha_desde_LiveJasmin').val();
    	var fecha_hasta_LiveJasmin = $('#fecha_hasta_LiveJasmin').val();
    	$.ajax({
            url: '../script/guardar_tokens_livejasmin1.php',
            type: 'POST',
            data: {
				"id": id,
				"dolares": dolares,
				"fecha_desde_LiveJasmin": fecha_desde_LiveJasmin,
				"fecha_hasta_LiveJasmin": fecha_hasta_LiveJasmin,
			},

            beforeSend: function (){},

            success: function(response){
            	console.log(response);
            	Swal.fire({
			 		title: 'Guardado',
				 	text: "Borrando Cache",
				 	icon: 'success',
				 	position: 'center',
				 	showConfirmButton: false,
				 	timer: 2000
				});
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    }


    function consultarBonga(){
    	var recorte_Bonga = $('#recorte_Bonga').val();
    	var mes_Bonga = $('#mes_Bonga').val();
    	var year_Bonga = $('#year_Bonga').val();

    	if(recorte_Bonga=='' || mes_Bonga=='' || year_Bonga==''){
    		Swal.fire({
		 		title: 'Desplegables sin Señalar',
			 	text: "No olvide señalar un valor en cada campo por favor",
			 	icon: 'error',
			 	position: 'center',
			 	showConfirmButton: false,
			 	timer: 5000
			});
    		return false;
    	}
    	$.ajax({
            url: '../script/consultar_bonga1.php',
            type: 'POST',
            data: {
				"recorte_Bonga": recorte_Bonga,
				"mes_Bonga": mes_Bonga,
				"year_Bonga": year_Bonga,
			},

            beforeSend: function (){
            	$('#submit_Bonga').attr('disabled','true');
            },

            success: function(response){
            	//console.log(response);
            	$('#submit_Bonga').removeAttr('disabled');
            	$('#tbody_Bonga').html(response);
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    }

    function guardarToken_bonga(id){
    	var dolares = $('#dolares_bonga_'+id).val();
    	var fecha_desde_Bonga = $('#fecha_desde_Bonga').val();
    	var fecha_hasta_Bonga = $('#fecha_hasta_Bonga').val();
    	$.ajax({
            url: '../script/guardar_tokens_bonga1.php',
            type: 'POST',
            data: {
				"id": id,
				"dolares": dolares,
				"fecha_desde_Bonga": fecha_desde_Bonga,
				"fecha_hasta_Bonga": fecha_hasta_Bonga,
			},

            beforeSend: function (){},

            success: function(response){
            	console.log(response);
            	Swal.fire({
			 		title: 'Guardado',
				 	text: "Borrando Cache",
				 	icon: 'success',
				 	position: 'center',
				 	showConfirmButton: false,
				 	timer: 2000
				});
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    }

    function consultarCam4(){
    	var recorte_Cam4 = $('#recorte_Cam4').val();
    	var mes_Cam4 = $('#mes_Cam4').val();
    	var year_Cam4 = $('#year_Cam4').val();

    	if(recorte_Cam4=='' || mes_Cam4=='' || year_Cam4==''){
    		Swal.fire({
		 		title: 'Desplegables sin Señalar',
			 	text: "No olvide señalar un valor en cada campo por favor",
			 	icon: 'error',
			 	position: 'center',
			 	showConfirmButton: false,
			 	timer: 5000
			});
    		return false;
    	}
    	$.ajax({
            url: '../script/consultar_cam41.php',
            type: 'POST',
            data: {
				"recorte_Cam4": recorte_Cam4,
				"mes_Cam4": mes_Cam4,
				"year_Cam4": year_Cam4,
			},

            beforeSend: function (){
            	$('#submit_Cam4').attr('disabled','true');
            },

            success: function(response){
            	//console.log(response);
            	$('#submit_Cam4').removeAttr('disabled');
            	$('#tbody_Cam4').html(response);
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    }

    function guardarToken_cam4(id){
    	var dolares = $('#dolares_cam4_'+id).val();
    	var fecha_desde_Cam4 = $('#fecha_desde_Cam4').val();
    	var fecha_hasta_Cam4 = $('#fecha_hasta_Cam4').val();
    	$.ajax({
            url: '../script/guardar_tokens_cam41.php',
            type: 'POST',
            data: {
				"id": id,
				"dolares": dolares,
				"fecha_desde_Cam4": fecha_desde_Cam4,
				"fecha_hasta_Cam4": fecha_hasta_Cam4,
			},

            beforeSend: function (){},

            success: function(response){
            	console.log(response);
            	Swal.fire({
			 		title: 'Guardado',
				 	text: "Borrando Cache",
				 	icon: 'success',
				 	position: 'center',
				 	showConfirmButton: false,
				 	timer: 2000
				});
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    }


    function consultarCamsoda(){
    	var recorte_Camsoda = $('#recorte_Camsoda').val();
    	var mes_Camsoda = $('#mes_Camsoda').val();
    	var year_Camsoda = $('#year_Camsoda').val();

    	if(recorte_Camsoda=='' || mes_Camsoda=='' || year_Camsoda==''){
    		Swal.fire({
		 		title: 'Desplegables sin Señalar',
			 	text: "No olvide señalar un valor en cada campo por favor",
			 	icon: 'error',
			 	position: 'center',
			 	showConfirmButton: false,
			 	timer: 5000
			});
    		return false;
    	}
    	$.ajax({
            url: '../script/consultar_camsoda1.php',
            type: 'POST',
            data: {
				"recorte_Camsoda": recorte_Camsoda,
				"mes_Camsoda": mes_Camsoda,
				"year_Camsoda": year_Camsoda,
			},

            beforeSend: function (){
            	$('#submit_Camsoda').attr('disabled','true');
            },

            success: function(response){
            	//console.log(response);
            	$('#submit_Camsoda').removeAttr('disabled');
            	$('#tbody_Camsoda').html(response);
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    }

    function guardarToken_camsoda(id){
    	var tokens = $('#tokens_camsoda_'+id).val();
    	var fecha_desde_Camsoda = $('#fecha_desde_Camsoda').val();
    	var fecha_hasta_Camsoda = $('#fecha_hasta_Camsoda').val();
    	$.ajax({
            url: '../script/guardar_tokens_camsoda1.php',
            type: 'POST',
            data: {
				"id": id,
				"tokens": tokens,
				"fecha_desde_Camsoda": fecha_desde_Camsoda,
				"fecha_hasta_Camsoda": fecha_hasta_Camsoda,
			},

            beforeSend: function (){},

            success: function(response){
            	console.log(response);
            	Swal.fire({
			 		title: 'Guardado',
				 	text: "Borrando Cache",
				 	icon: 'success',
				 	position: 'center',
				 	showConfirmButton: false,
				 	timer: 2000
				});
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    }

    function consultarFlirt4free(){
    	var recorte_Flirt4free = $('#recorte_Flirt4free').val();
    	var mes_Flirt4free = $('#mes_Flirt4free').val();
    	var year_Flirt4free = $('#year_Flirt4free').val();

    	if(recorte_Flirt4free=='' || mes_Flirt4free=='' || year_Flirt4free==''){
    		Swal.fire({
		 		title: 'Desplegables sin Señalar',
			 	text: "No olvide señalar un valor en cada campo por favor",
			 	icon: 'error',
			 	position: 'center',
			 	showConfirmButton: false,
			 	timer: 5000
			});
    		return false;
    	}
    	$.ajax({
            url: '../script/consultar_flirt4free1.php',
            type: 'POST',
            data: {
				"recorte_Flirt4free": recorte_Flirt4free,
				"mes_Flirt4free": mes_Flirt4free,
				"year_Flirt4free": year_Flirt4free,
			},

            beforeSend: function (){
            	$('#submit_Flirt4free').attr('disabled','true');
            },

            success: function(response){
            	//console.log(response);
            	$('#submit_Flirt4free').removeAttr('disabled');
            	$('#tbody_Flirt4free').html(response);
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    }


    function guardarToken_flirt4free(id){
    	var dolares = $('#dolares_flirt4free_'+id).val();
    	var fecha_desde_Flirt4free = $('#fecha_desde_Flirt4free').val();
    	var fecha_hasta_Flirt4free = $('#fecha_hasta_Flirt4free').val();
    	$.ajax({
            url: '../script/guardar_tokens_flirt4free1.php',
            type: 'POST',
            data: {
				"id": id,
				"dolares": dolares,
				"fecha_desde_Flirt4free": fecha_desde_Flirt4free,
				"fecha_hasta_Flirt4free": fecha_hasta_Flirt4free,
			},

            beforeSend: function (){},

            success: function(response){
            	console.log(response);
            	Swal.fire({
			 		title: 'Guardado',
				 	text: "Borrando Cache",
				 	icon: 'success',
				 	position: 'center',
				 	showConfirmButton: false,
				 	timer: 2000
				});
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    }

    function mostrarSeccionExtras1(button,value){
    	if(value=='Si'){
			$('#div_extras').hide('slow');
			$('#'+button).val('No');
		}else{
			$('#div_extras').show('slow');
			$('#'+button).val('Si');
		}
    }

    function buscarModelo(value){
		var cantidad = value.length;
		if(cantidad<=3){
			$('#listamodelos').html('ok');
			return false;
		}
		$.ajax({
			type: 'POST',
			url: '../script/buscar_modelo4.php',
            dataType: "JSON",
			data: {
				"value": value,
			},

			success: function(respuesta) {
				if(respuesta['contador1']>=1){
					$('#listamodelos').html(respuesta['html']);
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function guardar_extra1(){
		var modelo = $('#extra_modelo').val();
		var tipo = $('#extra_tipo1').val();
		var concepto = $('#extra_concepto').val();
		var valor = $('#extra_valor').val();
		var fecha = $('#extra_fecha').val();
		$.ajax({
			type: 'POST',
			url: '../script/guardar_extra1.php',
            dataType: "JSON",
			data: {
				"modelo": modelo,
				"tipo": tipo,
				"concepto": concepto,
				"valor": valor,
				"fecha": fecha,
			},

			success: function(respuesta) {
				//console.log(respuesta['contador1']);
				if(respuesta['contador1']==0){
					Swal.fire({
				 		title: 'Error',
					 	text: "Verifique datos del Modelo",
					 	icon: 'error',
					 	position: 'center',
					 	showConfirmButton: false,
					 	timer: 3000
					});
					return false;
				}
				$('#extra_modelo').val('');
				$('#extra_tipo1').val('');
				$('#extra_concepto').val('');
				$('#extra_valor').val('');
				$('#extra_fecha').val('');
				Swal.fire({
			 		title: 'Guardado',
				 	text: "Borrando Cache",
				 	icon: 'success',
				 	position: 'center',
				 	showConfirmButton: false,
				 	timer: 2000
				});
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function mostrarSeccionExtras2(button,value){
		if(value=='Si'){
			$('#div_extras2').hide('slow');
			$('#div_extras3').hide('slow');
			$('#'+button).val('No');
			$('#consultar_extras1').val('No');
		}else{
			$('#div_extras2').show('slow');
			$('#'+button).val('Si');
		}
	}

	function mostrarSeccionExtras3(button,value){
		if(value=='Si'){
			$('#div_extras3').hide('slow');
			$('#'+button).val('No');
		}else{
			$('#div_extras3').show('slow');
			$('#'+button).val('Si');
		}
	}

	function mostrarSeccionExtras4(button,value){
		if(value=='Si'){
			$('#div_extras4').hide('slow');
			$('#'+button).val('No');
		}else{
			$('#div_extras4').show('slow');
			$('#'+button).val('Si');
		}
	}

	function generar_extra(value){
		$.ajax({
			type: 'POST',
			url: '../script/generar_consulta_extras1.php',
            dataType: "JSON",
			data: {
				"value": value,
			},

			success: function(respuesta) {
				//console.log(respuesta['contador1']);
				$('#extra_generado1').hide('slow').html(respuesta['html']).fadeIn();
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function mostrarSeccionDesprendible1(button,value){
		if(value=='Si'){
			$('#div_'+button).hide('slow');
			$('#'+button).val('No');
		}else{
			$('#div_'+button).show('slow');
			$('#'+button).val('Si');
		}
	}

	function generar_desprendible1(){
		var desprendible_fecha_desde = $('#desprendible_fecha_desde').val();
		var desprendible_fecha_hasta = $('#desprendible_fecha_hasta').val();
		var desprendible_trm 		= $('#desprendible_trm').val();
		if(desprendible_fecha_desde=='' || desprendible_fecha_hasta=='' || desprendible_trm==''){
			Swal.fire({
		 		title: 'Campos Vacios',
			 	text: "Por favor Llene todos los Campos",
			 	icon: 'error',
			 	position: 'center',
			 	showConfirmButton: false,
			 	timer: 3000
			});
			return false;
		}

		if(desprendible_fecha_desde>=desprendible_fecha_hasta){
			Swal.fire({
		 		title: 'Error',
			 	text: "Rango de Fechas Erroneas",
			 	icon: 'error',
			 	position: 'center',
			 	showConfirmButton: false,
			 	timer: 3000
			});
			return false;
		}

		$('#desprendible_fecha_desde_hidden').val(desprendible_fecha_desde);
		$('#desprendible_fecha_hasta_hidden').val(desprendible_fecha_hasta);
		$('#desprendible_trm_hidden').val(desprendible_trm);
		$('#formulario_desprendible_hidden1').submit();

		/*
		$.ajax({
			type: 'POST',
			url: '../script/generar_desprendible1.php',
            dataType: "JSON",
			data: {
				"desprendible_fecha_desde": desprendible_fecha_desde,
				"desprendible_fecha_hasta": desprendible_fecha_hasta,
			},

			success: function(respuesta) {
				console.log(respuesta);
				//$('#desprendible_generado1').hide('slow').html(respuesta).fadeIn();
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
		*/

	}

	$("#formulario_subir_extras").on("submit", function(e){
		e.preventDefault();
        var fecha_desde_subir_extras = $('#fecha_desde_subir_extras').val();
        var fecha_hasta_subir_extras = $('#fecha_hasta_subir_extras').val();
        var fd = new FormData();
        var files = $('#file_subir_extras')[0].files[0];
        fd.append('file',files);
        fd.append('fecha_desde_subir_extras',$('#fecha_desde_subir_extras').val());
        fd.append('fecha_hasta_subir_extras',$('#fecha_hasta_subir_extras').val());
        $.ajax({
            url: '../script/subir_descuentos1.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_subir_extras').attr('disabled','true');
            },

            success: function(response){
            	console.log(response);
            	$('#submit_subir_extras').removeAttr('disabled');
            	if(response=='error'){
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> xls xml xlam xlsx",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
            		return false;
            	}else{
            		Swal.fire({
		 				title: 'Subido exitosamente!',
		 				text: "Limpiando Cache...",
		 				icon: 'success',
		 				position: 'center',
		 				showConfirmButton: true,
		 				timer: 2000
					});
					/*
	            	setTimeout(function() {
				      	window.location.href = "index.php";
				    },2000);
				    */
            	}
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    });


</script>