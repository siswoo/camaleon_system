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
	<link href="../resources/lightbox/dist/css/lightbox.css" rel="stylesheet">
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
	$ubicacion = "erick";
	include('../script/navbar_verificacion.php');
	include('../navbar.php');
?>
	<div class="seccion1" id="seccion1">
	    <div class="row">
	    	<?php
			if($_SESSION['rol']!=14){?>
		    	<div class="col-12 text-center" style="font-weight: bold; font-size: 30px; text-transform: uppercase;">
		    		Módulo de Erick
		    	</div>
		    	<div class="col-12 text-center mt-3">
		    		<a href="exportar1.php" style="text-decoration: none;">
				    	<button type="button" class="btn btn-info">Modelos Registrados</button>
		    		</a>
		    		<a href="exportar2.php" style="text-decoration: none;">
				    	<button type="button" class="btn btn-info ml-3">Pasantes Sin Aceptar</button>
					</a>
					<a href="exportar3.php" style="text-decoration: none;">
				    	<button type="button" class="btn btn-info ml-3">Pasantes Aceptadas</button>
					</a>
					<a href="exportar4.php" style="text-decoration: none;">
				    	<button type="button" class="btn btn-info ml-3">Modelos Sin Cuentas</button>
					</a>
					<a href="exportar5.php" style="text-decoration: none;">
				    	<button type="button" class="btn btn-info ml-3">Todas las Pasantes</button>
					</a>
					<a href="ejecucionbd1.php" style="text-decoration: none;" target="_blank">
				    	<button type="button" class="btn btn-info ml-3">Quitar Espacios en Cedulas BD</button>
					</a>
					<!--
					<a href="exportar6.php" style="text-decoration: none;">
				    	<button type="button" class="btn btn-info ml-3">Registrados con Banco</button>
					</a>
					<a href="exportar7.php" style="text-decoration: none;">
				    	<button type="button" class="btn btn-info ml-3">Faltantes Mixtos 1</button>
					</a>
					<a href="exportar8.php" style="text-decoration: none;">
				    	<button type="button" class="btn btn-info ml-3">Cuentas Repetidas</button>
					</a>
					-->
		    	</div>
		    	<div class="col-12 mt-3 text-center">
		    		<hr style="background-color: black; height: 2px;">
		    	</div>
			<?php } ?>


	    	<div class="col-12 mt-3 text-center" style="font-weight: bold; font-size: 30px; text-transform: uppercase;">
	    		Zona de Desprendibles
	    	</div>

		    <div class="col-12 mt-3 text-center">
		    	<div class="row">
		    	<?php
		    		$sql_presabana1 = "SELECT * FROM presabana GROUP BY inicio";
		    		$consulta_presabana1 = mysqli_query($conexion,$sql_presabana1);
					while($row1 = mysqli_fetch_array($consulta_presabana1)) {
						echo '
						<div class="form-group col-4 mt-3">
							<!--
							<p style="font-size: 16px;">'.$row1["inicio"].' al '.$row1["fin"].'</p>
						    <a href="ver_presabanas1.php?inicio='.$row1["inicio"].'&fin='.$row1["fin"].'" class="mr-2" style="text-decoration:none;" target="_blank">
								<button class="btn btn-info">Positivos</button>
							</a>
							<a href="ver_presabanas2.php?inicio='.$row1["inicio"].'&fin='.$row1["fin"].'" class="mr-2" style="text-decoration:none;" target="_blank">
								<button class="btn btn-info">Negativos</button>
							</a>
							-->
							<form action="ver_presabanas3.php" target="_blank">
								<p style="font-size: 16px;">'.$row1["inicio"].' al '.$row1["fin"].'</p>
								<input type="hidden" value="'.$row1["inicio"].'" name="inicio">
								<input type="hidden" value="'.$row1["fin"].'" name="fin">
								<select name="condicion" id="condicion" class="form-control" required>
									<option value="">Seleccione</option>
									<option value="Positivos">Positivos</option>
									<option value="Negativos">Negativos</option>
								</select>
								<select name="sedes" id="sedes" class="form-control">
									<option value="">Todos</option>
									<option value="1">VIP Occidente</option>
									<option value="2">Norte</option>
									<option value="3">Occidente I</option>
									<option value="4">VIP Suba</option>
								</select>
								<button type="submit" class="btn btn-info mt-1">Inspeccionar</button>
							</form>
						</div>
						';

						/*
						echo '
						<a href="ver_presabanas1.php?inicio='.$row1["inicio"].'&fin='.$row1["fin"].'" class="mr-2" style="text-decoration:none;">
							<button class="btn btn-info">Ver Presabanas ('.$row1["inicio"].' | '.$row1["fin"].')</button>
						</a>
						';
						*/
					}
		    	?>
		    	</div>
		   	</div>


		   	<div class="col-12 mt-3 text-center">
	    		<hr style="background-color: black; height: 2px;">
	    	</div>

	    	<?php
			if($_SESSION['rol']!=14){?>

	    	<div class="col-12 mt-3 text-center" style="font-weight: bold; font-size: 30px; text-transform: uppercase;">
	    		Zona de Desprendibles Bancarios para Andrea y | <3 Camila *-* |
	    	</div>

		    <div class="col-12 mt-3 text-center">
		    	<div class="row">
		    	<?php
		    		$sql_presabana1 = "SELECT * FROM presabana GROUP BY inicio";
		    		$consulta_presabana1 = mysqli_query($conexion,$sql_presabana1);
					while($row1 = mysqli_fetch_array($consulta_presabana1)) {
						echo '
						<div class="form-group col-4">
							<p style="font-size: 16px;">'.$row1["inicio"].' al '.$row1["fin"].'</p>
						    <a href="exportar6.php?inicio='.$row1["inicio"].'&fin='.$row1["fin"].'" class="mr-2" style="text-decoration:none;" target="_blank">
								<button class="btn btn-info">Generar Datos</button>
							</a>
						</div>
						';
					}
		    	?>
		    	</div>
		   	</div>

		   	<!--****************************************************-->

		   	<!--****************************************************-->

	    	<div class="col-12 mt-3 text-center">
	    		<hr style="background-color: black; height: 2px;">
	    	</div>

	    	<div class="col-12 mt-3 text-center">
	    		<form action="exportar11.php" method="GET" id="tm_formulario1">
	    	</div>

	    	<div class="col-12 mt-3 text-center" style="font-weight: bold; font-size: 30px; text-transform: uppercase;">
	    		Terceros para Medellin
	    	</div>

		    <div class="col-6 mt-3 text-center">
		    	<select name="tm_select_presabanas" id="tm_select_presabanas" class="form-control" required>
		    		<option value="">Seleccione Presabana</option>
		    		<?php
		    		$sql1 = "SELECT * FROM presabana GROUP BY inicio";
		    		$consulta1 = mysqli_query($conexion,$sql1);
					while($row2 = mysqli_fetch_array($consulta1)) {
						echo '<option value="'.$row2["id"].'">Generado desde '.$row2["inicio"].' hasta '.$row2["fin"].'</option>';
					}
					?>
		    	</select>
		   	</div>

		   	<div class="col-6 mt-3 text-center">
		    	<button type="submit" class="btn btn-info ml-3">Generar Datos</button>
		   	</div>

		   	<div class="col-12 mt-3 text-center">
	    		</form>
	    	</div>

	    	<div class="col-12 mt-3 text-center">
	    		<form action="#" method="POST" id="tm_formulario2">
	    	</div>

	    	<div class="col-6 mt-3 text-center">
		    	<input type="file" name="tm_temporales" id="tm_temporales" class="form-control">
		   	</div>

		   	<div class="col-6 mt-3 text-center">
		    	<button type="submit" class="btn btn-info ml-3" id="submit_temporal1">Subir Temporal</button>
		   	</div>

		   	<div class="col-12 mt-3 text-center">
	    		</form>
	    	</div>

		   	<!--****************************************************-->

	    	<div class="col-12 mt-3 text-center">
	    		<hr style="background-color: black; height: 2px;">
	    	</div>

	    	<div class="col-12 mt-3 text-center">
	    		<form action="../pagos/test7.php" method="POST" id="formulario_sc1">
	    	</div>

	    	<div class="col-12 mt-3 text-center" style="font-weight: bold; font-size: 30px; text-transform: uppercase;">
	    		Zona de Software Contable
	    	</div>

	    	<div class="col-6 mt-3 text-center">
	    		<select class="form-control" id="select_sc" name="select_sc" required>
	    			<option value="">Seleccione Presabana</option>
	    		<?php
	    			$sql_presabana2 = "SELECT * FROM presabana GROUP BY fecha_inicio";
		    		$consulta_presabana2 = mysqli_query($conexion,$sql_presabana2);
					while($row3 = mysqli_fetch_array($consulta_presabana2)) {
						echo '
							<option value="'.$row3["id"].'">'.$row3["inicio"].' - '.$row3["fin"].'</option>
						';
					}
	    		?>
	    		</select>
	    	</div>

	    	<div class="col-6 mt-3 text-center">
	    		<a href="../pagos/test7.php" style="text-decoration: none;">
			    	<button type="submit" id="submit_sc1" class="btn btn-info">Generar Formato Software Contable</button>
				</a>
				<!--
				<a href="../pagos/test8.php" style="text-decoration: none;">
			    	<button type="button" class="btn btn-info ml-3">Planilla BBVA</button>
				</a>
				-->
	    	</div>

	    	<div class="col-12 mt-3 text-center">
	    		</form>
	    	</div>

	    	<div class="col-12 mt-3 text-center">
	    		<hr style="background-color: black; height: 2px;">
	    	</div>

	    	<div class="col-12 mt-3 text-center" style="font-weight: bold; font-size: 30px; text-transform: uppercase;">
	    		Zona de Consultas
	    	</div>

	    	<div class="col-12">
	    		<form id="formulario_guiaRut" action="consulta_table1.php" method="POST">
	    	</div>

		    <div class="col-3 mt-3 text-center">
		    	<input type="date" name="fecha_desde_guiaRut" id="fecha_desde_guiaRut" class="form-control">
		    </div>
		   	<div class="col-3 mt-3 text-center">
		   		<input type="date" name="fecha_hasta_guiaRut" id="fecha_hasta_guiaRut" class="form-control">
		   	</div>
		    <div class="col-2 mt-3 text-center">
		   		<select class="form-control" id="sede_guiaR" name="sede_guiaR">
		   			<option value="0">Todos</option>
		   			<option value="1">Vip Occidente</option>
		   			<option value="2">Norte</option>
	    			<option value="3">Occidente I</option>
	    			<option value="4">Vip Suba</option>
	    			<option value="5">Medellín</option>
		    	</select>
		    </div>
		   	<div class="col-2 mt-3 text-center">
		   		<select class="form-control" id="descargable_guiaR" name="descargable_guiaR">
		   			<option value="No">No</option>
		   			<option value="Si">Si</option>
	    		</select>
		    </div>
		   	<div class="col-2 mt-3 text-center">
			    <button type="button" class="btn btn-info" id="submit_guiaR" onclick="generar_consulta1();">Generar Consulta</button>
	    	</div>

		    <div class="col-12">
	    		</form>
	    	</div>

	    	<div class="col-12 text-center" style="margin-top: 5rem;">
		    	<table id="example" class="table row-border hover table-bordered" style="font-size: 12px;">
				    <thead>
				        <tr>
				        	<th class="text-center">Nombre</th>
				            <th class="text-center">Tipo</th>
				            <th class="text-center">Documento</th>
				            <th class="text-center">Telefono</th>
				            <th class="text-center">Sede</th>
				            <th class="text-center">Fecha</th>
				            <th class="text-center">Firma</th>
				            <th class="text-center">Pasaporte</th>
				            <th class="text-center">Rut</th>
				            <th class="text-center">C.Bancaria</th>
				            <th class="text-center">EPS</th>
				            <th class="text-center">Ant Disciplinarios</th>
				            <th class="text-center">Ant Penales</th>
				            <th class="text-center">Bancarios</th>
				            <th class="text-center">Corporales</th>
				            <th class="text-center">Empresa</th>
				            <th class="text-center">Cuentas</th>
				            <th class="text-center">Porcentaje</th>
				        </tr>
					</thead>
				    <tbody id="resultados"></tbody>
				</table>
			</div>

			<?php } ?>

		</div>
	</div>

	<div class="seccion1" id="div_Imlive" style="display: none; border: 3px solid black; border-radius: 1rem; padding: 5px 5px 5px 5px;">
		<form id="formulario_Imlive" method="POST" action="#">
	    	<div class="row">
	    		<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">Reporte de Imlive</p>
				</div>
				<div class="form-group col-6">
				    <label for="archivo_Imlive">Archivo Generado</label>
				    <input type="file" class="form-control" name="archivo_Imlive" id="archivo_Imlive" style="margin-left: 18px; margin-right: 16px;" required>
				</div>
				<div class="form-group col-6">
				    <label for="fecha">Fecha</label>
				    <?php
				    	$fecha_actual = date('Y-m-d');
				    ?>
				    <input type="date" class="form-control" value="<?php echo $fecha_actual; ?>" id="fecha_Imlive" required>
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
				<div class="form-group col-12">
					<label>Archivo Excel</label>
				    <input type="file" class="form-control" name="archivo_XLove" id="archivo_XLove" required>
				</div>
				<div class="form-group col-6">
					<label>Recorte N°</label>
					<select class="form-control" required name="recorte_XLove" id="recorte_XLove">
						<option value="">Seleccione</option>
						<option value="1">1</option>
						<option value="2">2</option>
					</select>
				</div>
				<div class="form-group col-6">
					<label>EUR a USD Coste</label>
					<input type="text" id="coste_euro_XLove" name="coste_euro_XLove" class="form-control" required>
				</div>
				<div class="form-group col-6">
					<label>Mes</label>
					<select class="form-control" required name="mes_XLove" id="mes_XLove">
						<option value="">Seleccione</option>
						<option value="Enero">Enero</option>
						<option value="Febrero">Febrero</option>
						<option value="Marzo">Marzo</option>
						<option value="Abril">Abril</option>
						<option value="Mayo">Mayo</option>
						<option value="Junio">Junio</option>
						<option value="Julio">Julio</option>
						<option value="Agosto">Agosto</option>
						<option value="Septiembre">Septiembre</option>
						<option value="Octubre">Octubre</option>
						<option value="Noviembre">Noviembre</option>
						<option value="Diciembre">Diciembre</option>
					</select>
				</div>
				<div class="form-group col-6">
					<label>Año</label>
					<select class="form-control" required name="year_XLove" id="year_XLove">
						<option value="2020">2020</option>
						<option value="2021">2021</option>
						<option value="2022">2022</option>
						<option value="2023">2023</option>
						<option value="2024">2024</option>
						<option value="2025">2025</option>
					</select>
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
				<div class="form-group col-6">
					<label>Archivo Excel</label>
				    <input type="file" class="form-control" name="archivo_streamate" id="archivo_streamate" required>
				</div>
				<div class="form-group col-6">
					<label>Fecha</label>
					<input type="week" name="fecha_streamate" id="fecha_streamate" class="form-control" min="2020-11-09" required>
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
		<form id="formulario_LiveJasmin" method="POST" action="#">
	    	<div class="row">
	    		<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">Reporte de LiveJasmin</p>
				</div>
				<div class="form-group col-6">
				    <label for="archivo_LiveJasmin">Archivo Generado</label>
				    <input type="file" class="form-control" name="archivo_LiveJasmin" id="archivo_LiveJasmin" style="margin-left: 18px; margin-right: 16px;" required>
				</div>
				<div class="form-group col-6">
				    <label for="fecha">Fecha</label>
				    <?php
				    	$fecha_actual = date('Y-m-d');
				    ?>
				    <input type="date" class="form-control" value="<?php echo $fecha_actual; ?>" id="fecha_LiveJasmin" required>
				</div>
				<div class="form-group col-12 text-center">
				    <button type="submit" id="submit_LiveJasmin" class="btn btn-primary">Cargar Datos</button>
				</div>
			</div>
		</form>
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
<script src="../resources/lightbox/dist/js/lightbox.js"></script>

<?php include('../footer.php'); ?>

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

	        	"paging": true,
	        	"order": [[ 9, "desc" ]],

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
	});

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
        fd.append('fecha_Imlive',$('#fecha_Imlive').val());

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
        fd.append('recorte_XLove',$('#recorte_XLove').val());
        fd.append('mes_XLove',$('#mes_XLove').val());
        fd.append('year_XLove',$('#year_XLove').val());
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
        var fd = new FormData();
        var files = $('#archivo_streamate')[0].files[0];
        fd.append('file',files);
        fd.append('fecha_streamate',$('#fecha_streamate').val());

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
            	//console.log(response);			
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
            	console.log(response);
            	
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    }

    function generar_consulta1(){
    	var fecha_desde = $('#fecha_desde_guiaRut').val();
    	var fecha_hasta = $('#fecha_hasta_guiaRut').val();
    	var descargable_guiaR = $('#descargable_guiaR').val();
    	var sede = $('#sede_guiaR').val();
    	
    	if(fecha_desde=='' || fecha_hasta==''){
    		Swal.fire({
			 	title: 'Error',
				text: "Colocar rango de Fechas",
				icon: 'error',
				position: 'center',
				showConfirmButton: false,
				timer: 3000
			});
    		return false;
    	}

    	if(descargable_guiaR=='Si'){
    		document.getElementById("formulario_guiaRut").submit();
    		return false;
    	}
    	

    	$.ajax({
            url: 'consulta_table1.php',
            type: 'POST',
            data: {
				"fecha_desde_guiaRut": fecha_desde,
				"fecha_hasta_guiaRut": fecha_hasta,
				"sede_guiaR": sede,
				"descargable_guiaR": descargable_guiaR,
			},

            beforeSend: function (){
            	$('#submit_guiaR').attr('disabled','true');
            },

            success: function(response){
            	//console.log(response);
            	$('#submit_guiaR').removeAttr('disabled');
            	$('#example').DataTable().destroy();
            	$('#resultados').html(response);
            	var table = $('#example').DataTable( {
					"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, 'Todos']],

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
				    "paging": true,
				    //"bDestroy": true,
			    });
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });

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

	$("#tm_formulario2").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#tm_temporales')[0].files[0];
        fd.append('file',files);

        $.ajax({
            url: '../script/subir_tm_temporal1.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_temporal1').attr('disabled','true');
            },

            success: function(response){
            	console.log(response);
            	$('#submit_temporal1').removeAttr('disabled');
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
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    });

</script>