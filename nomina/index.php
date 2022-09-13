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
	$ubicacion = "nomina";
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
	    <div class="row">
		    <div class="col-12 mb-3 text-right">
		   		<a href="pagos.php">
					<button type="button" class="btn btn-primary" style="margin-right: 2rem;">Pagos</button>
				</a>
				<button type="button" class="btn btn-primary" style="margin-right: 2rem;" data-toggle="modal" data-target="#exampleModal1">Registro Nuevo</button>
				<a href="exportar1_old.php" target="_blank">
					<button type="button" class="btn btn-info" style="margin-right: 2rem;">Exportar Datos</button>
				</a>
				<a href="exportar1.php" target="_blank">
					<button type="button" class="btn btn-info" style="margin-right: 2rem;">Exportar Datos</button>
				</a>
			</div>

		    <div class="container_consulta1">
		    	<table id="example" class="table row-border hover table-bordered" style="font-size: 12px; color:rgba(50,55,66,1); border-radius: 5px;">
			        <thead>
			            <tr>
			                <th class="text-center">Nombre</th>
			                <th class="text-center">Apellido</th>
			                <th class="text-center">Documento T</th>
			                <th class="text-center">Documento N</th>
			                <th class="text-center">Estatus</th>
			                <th class="text-center">Turno</th>
			                <th class="text-center">Sede</th>
			                <th class="text-center">Cargo</th>
			                <th class="text-center">Fecha Ingreso</th>
			                <th class="text-center">Fecha Nacimiento</th>
			                <th class="text-center">Opciones</th>
			            </tr>
			        </thead>
			        <tbody id="resultados">
			        	<?php
			        		$sql1 = "SELECT * FROM nomina";
			        		$consulta1 = mysqli_query($conexion,$sql1);
			        		while($row1 = mysqli_fetch_array($consulta1)) {
			        			$id = $row1['id'];
			        			$nombre = $row1['nombre'];
			        			$apellido = $row1['apellido'];
			        			$documento_tipo = $row1['documento_tipo'];
			        			$documento_numero = $row1['documento_numero'];
			        			$genero = $row1['genero'];
			        			$correo = $row1['correo'];
			        			$estatus = $row1['estatus'];
			        			$turno = $row1['turno'];
			        			$sede = $row1['sede'];
			        			$cargo = $row1['cargo'];
			        			$fecha_ingreso = $row1['fecha_ingreso'];
			        			$fecha_nacimiento = $row1['fecha_nacimiento'];

			        			$sql2 = "SELECT * FROM sedes WHERE id = ".$sede;
			        			$consulta2 = mysqli_query($conexion,$sql2);
			        			while($row2 = mysqli_fetch_array($consulta2)) {
			        				$nombre_sede = $row2['nombre'];
			        			}

			        			$sql3 = "SELECT * FROM cargos WHERE id = ".$cargo;
			        			$consulta3 = mysqli_query($conexion,$sql3);
			        			while($row3 = mysqli_fetch_array($consulta3)) {
			        				$nombre_cargo = $row3['nombre'];
			        			}

			        			echo '
			        				<tr id="tr_'.$id.'">
			        					<td class="text-center" id="nombre_'.$id.'">'.$nombre.'</td>
			        					<td class="text-center" id="apellido_'.$id.'">'.$apellido.'</td>
			        					<td class="text-center" id="documento_tipo_'.$id.'">'.$documento_tipo.'</td>
			        					<td class="text-center" id="documento_numero_'.$id.'">'.$documento_numero.'</td>
			        					<td class="text-center" id="estatus_'.$id.'">'.$estatus.'</td>
			        					<td class="text-center" id="turno_'.$id.'">'.$turno.'</td>
			        					<td class="text-center" id="sede_'.$id.'">'.$nombre_sede.'</td>
			        					<td class="text-center" id="cargo_'.$id.'">'.$nombre_cargo.'</td>
			        					<td class="text-center" id="fecha_ingreso_'.$id.'">'.$fecha_ingreso.'</td>
			        					<td class="text-center" id="fecha_nacimiento_'.$id.'">'.$fecha_nacimiento.'</td>
			        					<td class="text-center" nowrap="nowrap">
			        						<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2" onclick="personal1('.$id.');">Personal</button>
			        						<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3" onclick="bancario1('.$id.');">Bancario</button>
			        						<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal4" onclick="documentos1('.$id.');">Documentos</button>
			        						<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal5" onclick="contrato1('.$id.');">Contrato</button>
			        						<!--<button class="btn btn-primary" onclick="eliminar1('.$id.');">Eliminar</button>-->
			        					</td>
			        				</tr>
			        			';
			        		}
			        	?>
			        </tbody>
			    </table>
		    </div>
		</div>
	</div>
</body>
</html>

<!-- Modal Crear Registro -->
	<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_new" style="">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Nuevo Registro</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row">
						    <div class="col-6 form-group form-check">
							    <label for="tipo_documento">Tipo de Documento </label>
							    <select name="tipo_documento" id="tipo_documento" class="form-control" required>
							    	<option value="">Seleccione</option>
							    	<option value="Cedula de Ciudadania">Cedula de Ciudadania</option>
							    	<option value="Cedula de Extranjeria">Cedula de Extranjeria</option>
							    	<option value="PEP">PEP</option>
							    	<option value="Pasaporte">Pasaporte</option>
							    	<option value="PPT">PPT</option>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="numero_documento">Número de Documento </label>
							    <input type="text" name="numero_documento" id="numero_documento" class="form-control" minlength="6" autocomplete="off" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="nombre">Nombre </label>
							    <input type="text" name="nombre" id="nombre" class="form-control" autocomplete="off" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="apellido">Apellido </label>
							    <input type="text" name="apellido" id="apellido" class="form-control" autocomplete="off" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="genero">Genero </label>
							    <select id="genero" name="genero" class="form-control" required>
							    	<option value="">Seleccione</option>
							    	<option value="Hombre">Hombre</option>
							    	<option value="Mujer">Mujer</option>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="correo">Correo </label>
							    <input type="email" name="correo" id="correo" class="form-control" autocomplete="off" disabled>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="correo_personal">Correo Personal </label>
							    <input type="email" name="correo_personal" id="correo_personal" class="form-control" autocomplete="off" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="direccion">Dirección </label>
							    <input type="text" name="direccion" id="direccion" class="form-control" autocomplete="off" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="salario">Salario </label>
							    <input type="number" name="salario" id="salario" class="form-control" autocomplete="off" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="turno">Turno </label>
							    <select class="form-control" name="turno" id="turno" required>
							    	<option value="">Seleccione</option>
							    	<option value="Mañana">Mañana</option>
							    	<option value="Tarde">Tarde</option>
							    	<option value="Noche">Noche</option>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="telefono">Teléfono </label>
							    <input type="text" name="telefono" id="telefono" class="form-control" autocomplete="off">
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="cargo">Cargo </label>
							    <select class="form-control" name="cargo" id="cargo" onchange="cargo1(value);" required>
							    	<option value="">Seleccione</option>
							    	<?php
							    	$sql_rol = "SELECT * FROM cargos";
							    	$resultado_rol = mysqli_query($conexion,$sql_rol);
									while($row3 = mysqli_fetch_array($resultado_rol)) {
										$rol_id = $row3['id'];
										$rol_nombre = $row3['nombre'];
										echo '<option value="'.$rol_id.'">'.$rol_nombre.'</option>';
									}
							    	?>
							    </select>
						    </div>

						    <div class="col-6 form-group form-check">
							    <label for="rol">Sedes </label>
							    <select class="form-control" name="sedes" id="sedes" required>
							    	<option value="">Seleccione</option>
							    	<?php
							    	if($_SESSION['sede']==1){
							    		$sql_sedes = "SELECT * FROM sedes";	
							    	}else{
							    		$sql_sedes = "SELECT * FROM sedes WHERE id = ".$_SESSION["sede"];
							    	}
									$resultado_sedes = mysqli_query($conexion,$sql_sedes);
									while($row4 = mysqli_fetch_array($resultado_sedes)) {
										$sedes_id = $row4['id'];
										$sedes_nombre = $row4['nombre'];
										echo '<option value="'.$sedes_id.'">'.$sedes_nombre.'</option>';
									}
							    	?>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="fecha_nacimiento">Fecha de Nacimiento </label>
							    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control">
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="fecha_ingreso">Fecha de Ingreso </label>
							    <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control">
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="fecha_expedicion">Fecha de expedición del documento </label>
							    <input type="date" name="fecha_expedicion" id="fecha_expedicion" class="form-control">
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="funcion">Función </label>
							    <select class="form-control" name="funcion" id="funcion" required>
							    	<option value="">Seleccione</option>
							    	<?php
							    	$sql_funcion = "SELECT * FROM funciones";
									$resultado_funcion = mysqli_query($conexion,$sql_funcion);
									while($row5 = mysqli_fetch_array($resultado_funcion)) {
										$funcion_id = $row5['id'];
										$funcion_nombre = $row5['nombre'];
										echo '<option value="'.$funcion_id.'">'.$funcion_nombre.'</option>';
									}
							    	?>
							    </select>
						    </div>
						    <div class="col-12 form-group form-check">
							    <label for="contrato">Contrato </label>
							    <select class="form-control" name="contrato" id="contrato" required>
							    	<option value="">Seleccione</option>
							    	<?php
							    	$sql4 = "SELECT * FROM n_contrato";
									$proceso4 = mysqli_query($conexion,$sql4);
									while($row4 = mysqli_fetch_array($proceso4)) {
										$contrato_id = $row4['id'];
										$contrato_nombre = $row4['nombre'];
										echo '<option value="'.$contrato_id.'">'.$contrato_nombre.'</option>';
									}
							    	?>
							    </select>
						    </div>
					    </div>
					</div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" class="btn btn-success" id="submit_guardar1">Guardar</button>
			      	</div>
		      	</form>
	    	</div>
	  	</div>
	</div>
<!-- FIN Modal Nuevo Registro -->

<!-- Modal Editar Registro -->
	<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_edit" style="">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Registro</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row">
					    	<input type="hidden" name="edit_id" id="edit_id">
						    <div class="col-6 form-group form-check">
							    <label for="edit_tipo_documento">Tipo de Documento </label>
							    <select name="edit_tipo_documento" id="edit_tipo_documento" class="form-control" required>
							    	<option value="">Seleccione</option>
							    	<option value="Cedula de Ciudadania">Cedula de Ciudadania</option>
							    	<option value="Cedula de Extranjeria">Cedula de Extranjeria</option>
							    	<option value="PEP">PEP</option>
							    	<option value="Pasaporte">Pasaporte</option>
							    	<option value="PPT">PPT</option>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_numero_documento">Número de Documento </label>
							    <input type="text" name="edit_numero_documento" id="edit_numero_documento" class="form-control" minlength="6" autocomplete="off" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_nombre">Nombre </label>
							    <input type="text" name="edit_nombre" id="edit_nombre" class="form-control" autocomplete="off" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_apellido">Apellido </label>
							    <input type="text" name="edit_apellido" id="edit_apellido" class="form-control" autocomplete="off" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_genero">Genero </label>
							    <select id="edit_genero" name="edit_genero" class="form-control" required>
							    	<option value="">Seleccione</option>
							    	<option value="Hombre">Hombre</option>
							    	<option value="Mujer">Mujer</option>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_correo">Correo </label>
							    <input type="email" name="edit_correo" id="edit_correo" class="form-control" autocomplete="off" disabled>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_correo_personal">Correo Personal </label>
							    <input type="email" name="edit_correo_personal" id="edit_correo_personal" class="form-control" autocomplete="off" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_direccion">Dirección </label>
							    <input type="text" name="edit_direccion" id="edit_direccion" class="form-control" autocomplete="off" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_salario">Salario </label>
							    <input type="number" name="edit_salario" id="edit_salario" class="form-control" autocomplete="off" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_turno">Turno </label>
							    <select class="form-control" name="edit_turno" id="edit_turno" required>
							    	<option value="">Seleccione</option>
							    	<option value="Mañana">Mañana</option>
							    	<option value="Tarde">Tarde</option>
							    	<option value="Noche">Noche</option>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_telefono">Teléfono </label>
							    <input type="text" name="edit_telefono" id="edit_telefono" class="form-control" autocomplete="off">
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_cargo">Cargo </label>
							    <select class="form-control" name="edit_cargo" id="edit_cargo" onchange="cargo2(value);" required>
							    	<option value="">Seleccione</option>
							    	<?php
							    	$sql_rol = "SELECT * FROM cargos";
							    	$resultado_rol = mysqli_query($conexion,$sql_rol);
									while($row3 = mysqli_fetch_array($resultado_rol)) {
										$rol_id = $row3['id'];
										$rol_nombre = $row3['nombre'];
										echo '<option value="'.$rol_id.'">'.$rol_nombre.'</option>';
									}
							    	?>
							    </select>
						    </div>

						    <div class="col-6 form-group form-check">
							    <label for="edit_sedes">Sedes </label>
							    <select class="form-control" name="edit_sedes" id="edit_sedes" required>
							    	<option value="">Seleccione</option>
							    	<?php
							    	$sql_sedes = "SELECT * FROM sedes";
									$resultado_sedes = mysqli_query($conexion,$sql_sedes);
									while($row4 = mysqli_fetch_array($resultado_sedes)) {
										$sedes_id = $row4['id'];
										$sedes_nombre = $row4['nombre'];
										echo '<option value="'.$sedes_id.'">'.$sedes_nombre.'</option>';
									}
							    	?>
							    </select>
						    </div>
						    <div class="col-12 form-group form-check">
							    <label for="edit_estatus">Estatus </label>
							    <select class="form-control" id="edit_estatus" name="edit_estatus" required>
							    	<option value="">Seleccione</option>
							    	<option value="Aceptado">Aceptado</option>
							    	<option value="Retirado">Retirado</option>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_fecha_nacimiento">Fecha de Nacimiento </label>
							    <input type="date" id="edit_fecha_nacimiento" name="edit_fecha_nacimiento" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_fecha_ingreso">Fecha de Ingreso </label>
							    <input type="date" id="edit_fecha_ingreso" name="edit_fecha_ingreso" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_fecha_retiro">Fecha de Retiro</label>
							    <input type="date" id="edit_fecha_retiro" name="edit_fecha_retiro" class="form-control">
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_fecha_expedicion">Fecha de Expedición</label>
							    <input type="date" id="edit_fecha_expedicion" name="edit_fecha_expedicion" class="form-control">
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_funcion">Función</label>
							    <select class="form-control" name="edit_funcion" id="edit_funcion" required>
							    	<option value="">Seleccione</option>
							    	<?php
							    	$sql_funcion = "SELECT * FROM funciones";
									$resultado_funcion = mysqli_query($conexion,$sql_funcion);
									while($row5 = mysqli_fetch_array($resultado_funcion)) {
										$funcion_id = $row5['id'];
										$funcion_nombre = $row5['nombre'];
										echo '<option value="'.$funcion_id.'">'.$funcion_nombre.'</option>';
									}
							    	?>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_contrato">Contrato </label>
							    <select class="form-control" name="edit_contrato" id="edit_contrato" required>
							    	<option value="">Seleccione</option>
							    	<?php
							    	$sql4 = "SELECT * FROM n_contrato";
									$proceso4 = mysqli_query($conexion,$sql4);
									while($row4 = mysqli_fetch_array($proceso4)) {
										$contrato_id = $row4['id'];
										$contrato_nombre = $row4['nombre'];
										echo '<option value="'.$contrato_id.'">'.$contrato_nombre.'</option>';
									}
							    	?>
							    </select>
						    </div>
						    <div class="col-12 form-group form-check" style="font-size: 20px; font-weight: bold;">APARTADO DE EMERGENCIA</div>
						    <div class="col-12 form-group form-check">
							    <label for="edit_emergencia_nombre">Emergencia Nombre</label>
							    <input type="text" id="edit_emergencia_nombre" name="edit_emergencia_nombre" value="" class="form-control" readonly>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_emergencia_telefono">Emergencia Teléfono</label>
							    <input type="text" id="edit_emergencia_telefono" name="edit_emergencia_telefono" value="" class="form-control" readonly>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_emergencia_parentesco">Emergencia Parentesco</label>
							    <input type="text" id="edit_emergencia_parentesco" name="edit_emergencia_parentesco" value="" class="form-control" readonly>
						    </div>
					    </div>
					</div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" class="btn btn-success" id="submit_edit1">Guardar</button>
			      	</div>
		      	</form>
	    	</div>
	  	</div>
	</div>
<!-- FIN Modal Editar Registro -->


<!-- Modal Editar Bancarios -->
	<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_bancario" style="">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Datos Bancarios</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row">
					    	<input type="hidden" name="edit_bancario_id" id="edit_bancario_id">
						    <div class="col-6 form-group form-check">
							    <label for="edit_bancario_bcpp">Cuenta Propia o Prestada?</label>
							    <select name="edit_bancario_bcpp" id="edit_bancario_bcpp" class="form-control" required>
							    	<option value="">Seleccione</option>
							    	<option value="Propia">Propia</option>
							    	<option value="Prestada">Prestada</option>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_bancario_cedula">Cédula del titular</label>
							    <input type="text" name="edit_bancario_cedula" id="edit_bancario_cedula" class="form-control" minlength="6" autocomplete="off" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_bancario_nombre">Nombre Titular</label>
							    <input type="text" name="edit_bancario_nombre" id="edit_bancario_nombre" class="form-control" autocomplete="off" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_bancario_tipo_cuenta">Tipo de Cuenta</label>
							    <select name="edit_bancario_tipo_cuenta" id="edit_bancario_tipo_cuenta" class="form-control" required>
							    	<option value="">Seleccione</option>
							    	<option value="Ahorro">Ahorro</option>
							    	<option value="Corriente">Corriente</option>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_bancario_numero_cuenta">Número de Cuenta</label>
							    <input type="text" name="edit_bancario_numero_cuenta" id="edit_bancario_numero_cuenta" class="form-control" autocomplete="off" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_bancario_banco">Banco</label>
							    <select name="edit_bancario_banco" id="edit_bancario_banco" class="form-control" required="">
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
					</div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" class="btn btn-success" id="submit_edit_bancario1">Guardar</button>
			      	</div>
			    </div>
		      </form>
	    </div>
	</div>
<!-- FIN Modal Editar Bancarios -->

<!-- Modal Editar Documentos -->
	<div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_documentos" style="">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Visualizar Documentos</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" id="respuesta_documentos1"></div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			      	</div>
			    </div>
		      </form>
	    </div>
	</div>
<!-- FIN Modal Editar Documentos -->

<!-- Modal Editar Contrato -->
	<div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_contratos">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Visualizar Contrato</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" id="respuesta_contratos1"></div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			      	</div>
			    </div>
		      </form>
	    </div>
	</div>
<!-- FIN Modal Editar Contrato -->

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
	} );

	$("#form_modal_new").on("submit", function(e){
		e.preventDefault();
		var f = $(this);
		var tipo_documento 		= $('#tipo_documento').val();
		var numero_documento 	= $('#numero_documento').val();
		var nombre 				= $('#nombre').val();
		var apellido 			= $('#apellido').val();
		var genero 				= $('#genero').val();
		var correo 				= $('#correo').val();
		var correo_personal 	= $('#correo_personal').val();
		var direccion 			= $('#direccion').val();
		var salario 			= $('#salario').val();
		var turno 				= $('#turno').val();
		var telefono 			= $('#telefono').val();
		var cargo 				= $('#cargo').val();
		var sedes 				= $('#sedes').val();
		var fecha_nacimiento 	= $('#fecha_nacimiento').val();
		var fecha_ingreso 		= $('#fecha_ingreso').val();
		var fecha_expedicion 	= $('#fecha_expedicion').val();
		var funcion 			= $('#funcion').val();
		var contrato 			= $('#contrato').val();

	    $.ajax({
			type: 'POST',
			url: '../script/crud_nomina.php',
			data: {
				"tipo_documento": tipo_documento,
				"numero_documento": numero_documento,
				"nombre": nombre,
				"apellido": apellido,
				"genero": genero,
				"correo": correo,
				"correo_personal": correo_personal,
				"direccion": direccion,
				"salario": salario,
				"turno": turno,
				"telefono": telefono,
				"cargo": cargo,
				"sedes": sedes,
				"fecha_nacimiento": fecha_nacimiento,
				"fecha_ingreso": fecha_ingreso,
				"fecha_expedicion": fecha_expedicion,
				"funcion": funcion,
				"contrato": contrato,
				"condicion": "guardar1",
			},
			dataType: "JSON",
			success: function(respuesta) {
				console.log(respuesta);

				if(respuesta['estatus']=='repetido'){
					Swal.fire({
						position: 'center',
						icon: 'error',
						title: 'Error!',
						text: 'Ya existe ese numero de documento',
						showConfirmButton: true,
						timer: 3000
					})
					return false;
				}else{
					Swal.fire({
	 					title: 'Registro Correcto!',
	 					text: "Redirigiendo...",
	 					icon: 'success',
	 					position: 'center',
	 					showConfirmButton: false,
	 					confirmButtonColor: '#3085d6',
	 					confirmButtonText: 'No esperar!',
	 					timer: 3000
					}).then((result) => {
	 					if (result.value) {
	   						window.location.href = "index.php";
	 					}
					})
					setTimeout(function() {
				      window.location.href = "index.php";
				    },3000);
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	});

	function personal1(id){
		$.ajax({
			type: 'POST',
			url: '../script/crud_nomina.php',
			data: {
				"id": id,
				"condicion": "consultar1",
			},
			dataType: "JSON",
			success: function(respuesta) {
				console.log(respuesta);
				$("#edit_id").val(respuesta["id"]);
				$("#edit_tipo_documento").val(respuesta["tipo_documento"]);
				$("#edit_numero_documento").val(respuesta["numero_documento"]);
				$("#edit_nombre").val(respuesta["nombre"]);
				$("#edit_apellido").val(respuesta["apellido"]);
				$("#edit_genero").val(respuesta["genero"]);
				$("#edit_correo").val(respuesta["correo"]);
				$("#edit_correo_personal").val(respuesta["correo_personal"]);
				$("#edit_direccion").val(respuesta["direccion"]);
				$("#edit_salario").val(respuesta["salario"]);
				$("#edit_turno").val(respuesta["turno"]);
				$("#edit_telefono").val(respuesta["telefono"]);
				$("#edit_cargo").val(respuesta["cargo"]);
				$("#edit_sedes").val(respuesta["sedes"]);
				$("#edit_estatus").val(respuesta["estatus2"]);
				$("#edit_fecha_nacimiento").val(respuesta["fecha_nacimiento"]);
				$("#edit_fecha_ingreso").val(respuesta["fecha_ingreso"]);
				$("#edit_fecha_retiro").val(respuesta["fecha_retiro"]);
				$("#edit_fecha_expedicion").val(respuesta["fecha_expedicion"]);
				
				if(respuesta["funcion"]==0){
					$("#edit_funcion").val("");
				}else{
					$("#edit_funcion").val(respuesta["funcion"]);
				}

				if(respuesta["contrato"]==0){
					$("#edit_contrato").val("");
				}else{
					$("#edit_contrato").val(respuesta["contrato"]);
				}

				$("#edit_emergencia_nombre").val(respuesta["emergencia_nombre"]);
				$("#edit_emergencia_telefono").val(respuesta["emergencia_telefono"]);
				$("#edit_emergencia_parentesco").val(respuesta["emergencia_parentesco"]);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	$("#form_modal_edit").on("submit", function(e){
		e.preventDefault();
		var f = $(this);
		var id 					= $('#edit_id').val();
		var tipo_documento 		= $('#edit_tipo_documento').val();
		var numero_documento 	= $('#edit_numero_documento').val();
		var nombre 				= $('#edit_nombre').val();
		var apellido 			= $('#edit_apellido').val();
		var genero 				= $('#edit_genero').val();
		var correo 				= $('#edit_correo').val();
		var correo_personal 	= $('#edit_correo_personal').val();
		var direccion 			= $('#edit_direccion').val();
		var salario 			= $('#edit_salario').val();
		var turno 				= $('#edit_turno').val();
		var telefono 			= $('#edit_telefono').val();
		var cargo 				= $('#edit_cargo').val();
		var sedes 				= $('#edit_sedes').val();
		var estatus 			= $('#edit_estatus').val();
		var fecha_nacimiento 	= $('#edit_fecha_nacimiento').val();
		var fecha_ingreso 		= $('#edit_fecha_ingreso').val();
		var fecha_retiro 		= $('#edit_fecha_retiro').val();
		var fecha_expedicion 	= $('#edit_fecha_expedicion').val();
		var funcion 			= $('#edit_funcion').val();
		var contrato 			= $('#edit_contrato').val();

	    $.ajax({
			type: 'POST',
			url: '../script/crud_nomina.php',
			data: {
				"id": id,
				"tipo_documento": tipo_documento,
				"numero_documento": numero_documento,
				"nombre": nombre,
				"apellido": apellido,
				"genero": genero,
				"correo": correo,
				"correo_personal": correo_personal,
				"direccion": direccion,
				"salario": salario,
				"turno": turno,
				"telefono": telefono,
				"cargo": cargo,
				"sedes": sedes,
				"estatus": estatus,
				"fecha_nacimiento": fecha_nacimiento,
				"fecha_ingreso": fecha_ingreso,
				"fecha_retiro": fecha_retiro,
				"fecha_expedicion": fecha_expedicion,
				"funcion": funcion,
				"contrato": contrato,
				"condicion": "editar1",
			},
			dataType: "JSON",
			success: function(respuesta) {
				console.log(respuesta);

				if(respuesta['estatus']=='repetido'){
					Swal.fire({
						position: 'center',
						icon: 'error',
						title: 'Error!',
						text: 'Ya existe ese numero de documento',
						showConfirmButton: true,
						timer: 3000
					})
					return false;
				}else{
					Swal.fire({
	 					title: 'Registro Correcto!',
	 					text: "Redirigiendo...",
	 					icon: 'success',
	 					position: 'center',
	 					showConfirmButton: false,
	 					confirmButtonColor: '#3085d6',
	 					confirmButtonText: 'No esperar!',
	 					timer: 3000
					});

					$("#exampleModal2").modal('hide');
					$('#exampleModal2').removeClass('modal-open');
					$('.modal-backdrop').remove();

					$('#nombre_'+id).html(respuesta['nombre']);
					$('#apellido_'+id).html(respuesta['apellido']);
					$('#documento_tipo_'+id).html(respuesta['tipo_documento']);
					$('#documento_numero_'+id).html(respuesta['numero_documento']);
					$('#genero_'+id).html(respuesta['genero']);
					$('#correo_'+id).html(respuesta['correo']);
					$('#estatus_'+id).html(respuesta['estatus2']);
					$('#turno_'+id).html(respuesta['turno']);
					$('#sede_'+id).html(respuesta['sede']);
					$('#cargo_'+id).html(respuesta['cargo']);
					$('#fecha_nacimiento_'+id).html(respuesta['fecha_nacimiento']);
					$('#fecha_ingreso_'+id).html(respuesta['fecha_ingreso']);
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	});

	function eliminar1(id){
		Swal.fire({
			title: 'Estas seguro?',
			text: "Luego no podrás revertir esta acción",
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
					url: '../script/crud_nomina.php',
					dataType: "JSON",
					data: {
						"id": id,
						"condicion": "eliminar1",
					},
					success: function(respuesta) {
						console.log(respuesta);
						$('#tr_'+id).hide('slow');
					},

					error: function(respuesta) {
						console.log("error..."+respuesta);
					}
				});
			}
		})
	}

	function cargo1(value){
		if(value==1){
			$('#correo').val("directivo@camaleonmg.com");
		}else if(value==2){
			$('#correo').val("administrador@camaleonmg.com");
		}else if(value==3){
			$('#correo').val("aseo@camaleonmg.com");
		}else if(value==4){
			$('#correo').val("asesordeimagen@camaleonmg.com");
		}else if(value==5){
			$('#correo').val("asistente@camaleonmg.com");
		}else if(value==6){
			$('#correo').val("capacitadoraypagos@camaleonmg.com");
		}else if(value==7){
			$('#correo').val("designer@camaleonmg.com");
		}else if(value==8){
			$('#correo').val("fotografo@camaleonmg.com");
		}else if(value==9){
			$('#correo').val("gerentedeoperaciones@camaleonmg.com");
		}else if(value==10){
			$('#correo').val("jefesoporte@camaleonmg.com");
		}else if(value==11){
			$('#correo').val("mantenimiento@camaleonmg.com");
		}else if(value==12){
			$('#correo').val("monitor@camaleonmg.com");
		}else if(value==13){
			$('#correo').val("programador@camaleonmg.com");
		}else if(value==14){
			$('#correo').val("recursoshumanos@camaleonmg.com");
		}else if(value==15){
			$('#correo').val("reparaciones@camaleonmg.com");
		}else if(value==16){
			$('#correo').val("soporte@camaleonmg.com");
		}else if(value==17){
			$('#correo').val("soportetecnico@camaleonmg.com");
		}else if(value==18){
			$('#correo').val("trafico@camaleonmg.com");
		}else if(value==19){
			$('#correo').val("vigilante@camaleonmg.com");
		}else if(value==20){
			$('#correo').val("financiera@camaleonmg.com");
		}else if(value==21){
			$('#correo').val("jefedemonitores@camaleonmg.com");
		}else if(value==22){
			$('#correo').val("communitymanager@camaleonmg.com");
		}else if(value==23){
			$('#correo').val("sexshop@camaleonmg.com");
		}else if(value==24){
			$('#correo').val("seguridad_social@camaleonmg.com");
		}else if(value==25){
			$('#correo').val("hoster@camaleonmg.com");
		}else if(value==26){
			$('#correo').val("app@camaleonmg.com");
		}else if(value==27){
			$('#correo').val("administradorrestaurante@camaleonmg.com");
		}else if(value==28){
			$('#correo').val("chef@camaleonmg.com");
		}else if(value==29){
			$('#correo').val("cajera@camaleonmg.com");
		}else if(value==30){
			$('#correo').val("jefeimd@camaleonmg.com");
		}else if(value==31){
			$('#correo').val("auditoria@camaleonmg.com");
		}else if(value==32){
			$('#correo').val("traficoestatico@camaleonmg.com");
		}else if(value==33){
			$('#correo').val("metirerestaurant@camaleonmg.com");
		}else if(value==34){
			$('#correo').val("cocinero@camaleonmg.com");
		}else if(value==35){
			$('#correo').val("inventariosycostos@camaleonmg.com");
		}else if(value==36){
			$('#correo').val("auxcontable@camaleonmg.com");
		}else if(value==37){
			$('#correo').val("callcenter@camaleonmg.com");
		}else if(value==38){
			$('#correo').val("adminspa@camaleonmg.com");
		}else if(value==39){
			$('#correo').val("auditorpagos@camaleonmg.com");
		}else if(value==40){
			$('#correo').val("edi.fotos@camaleonmg.com");
		}else if(value==41){
			$('#correo').val("liderrhh@camaleonmg.com");
		}else if(value==42){
			$('#correo').val("sst@camaleonmg.com");
		}
	}

	function cargo2(value){
		if(value==1){
			$('#edit_correo').val("directivo@camaleonmg.com");
		}else if(value==2){
			$('#edit_correo').val("administrador@camaleonmg.com");
		}else if(value==3){
			$('#edit_correo').val("aseo@camaleonmg.com");
		}else if(value==4){
			$('#edit_correo').val("asesordeimagen@camaleonmg.com");
		}else if(value==5){
			$('#edit_correo').val("asistente@camaleonmg.com");
		}else if(value==6){
			$('#edit_correo').val("capacitadoraypagos@camaleonmg.com");
		}else if(value==7){
			$('#edit_correo').val("designer@camaleonmg.com");
		}else if(value==8){
			$('#edit_correo').val("fotografo@camaleonmg.com");
		}else if(value==9){
			$('#edit_correo').val("gerentedeoperaciones@camaleonmg.com");
		}else if(value==10){
			$('#edit_correo').val("jefesoporte@camaleonmg.com");
		}else if(value==11){
			$('#edit_correo').val("mantenimiento@camaleonmg.com");
		}else if(value==12){
			$('#edit_correo').val("monitor@camaleonmg.com");
		}else if(value==13){
			$('#edit_correo').val("programador@camaleonmg.com");
		}else if(value==14){
			$('#edit_correo').val("recursoshumanos@camaleonmg.com");
		}else if(value==15){
			$('#edit_correo').val("reparaciones@camaleonmg.com");
		}else if(value==16){
			$('#edit_correo').val("soporte@camaleonmg.com");
		}else if(value==17){
			$('#edit_correo').val("soportetecnico@camaleonmg.com");
		}else if(value==18){
			$('#edit_correo').val("trafico@camaleonmg.com");
		}else if(value==19){
			$('#edit_correo').val("vigilante@camaleonmg.com");
		}else if(value==20){
			$('#edit_correo').val("financiera@camaleonmg.com");
		}else if(value==21){
			$('#edit_correo').val("jefedemonitores@camaleonmg.com");
		}else if(value==22){
			$('#edit_correo').val("communitymanager@camaleonmg.com");
		}else if(value==23){
			$('#edit_correo').val("sexshop@camaleonmg.com");
		}else if(value==24){
			$('#edit_correo').val("seguridad_social@camaleonmg.com");
		}else if(value==25){
			$('#edit_correo').val("hoster@camaleonmg.com");
		}else if(value==26){
			$('#edit_correo').val("app@camaleonmg.com");
		}else if(value==27){
			$('#edit_correo').val("administradorrestaurante@camaleonmg.com");
		}else if(value==28){
			$('#edit_correo').val("chef@camaleonmg.com");
		}else if(value==29){
			$('#edit_correo').val("cajera@camaleonmg.com");
		}else if(value==30){
			$('#edit_correo').val("jefeimd@camaleonmg.com");
		}else if(value==31){
			$('#edit_correo').val("auditoria@camaleonmg.com");
		}else if(value==32){
			$('#edit_correo').val("traficoestatico@camaleonmg.com");
		}else if(value==33){
			$('#edit_correo').val("metirerestaurant@camaleonmg.com");
		}else if(value==34){
			$('#edit_correo').val("cocinero@camaleonmg.com");
		}else if(value==35){
			$('#edit_correo').val("inventariosycostos@camaleonmg.com");
		}else if(value==36){
			$('#edit_correo').val("auxcontable@camaleonmg.com");
		}else if(value==37){
			$('#edit_correo').val("callcenter@camaleonmg.com");
		}else if(value==38){
			$('#edit_correo').val("adminspa@camaleonmg.com");
		}else if(value==39){
			$('#edit_correo').val("auditorpagos@camaleonmg.com");
		}else if(value==40){
			$('#edit_correo').val("edi.fotos@camaleonmg.com");
		}else if(value==41){
			$('#edit_correo').val("liderrhh@camaleonmg.com");
		}else if(value==42){
			$('#edit_correo').val("sst@camaleonmg.com");
		}
	}

	function bancario1(id){
		$.ajax({
			type: 'POST',
			url: '../script/crud_nomina.php',
			data: {
				"id": id,
				"condicion": "consultar_bancarios1",
			},
			dataType: "JSON",
			success: function(respuesta) {
				console.log(respuesta);
				$("#edit_bancario_id").val(id);
				$("#edit_bancario_bcpp").val(respuesta["bcpp"]);
				$("#edit_bancario_cedula").val(respuesta["banco_cedula"]);
				$("#edit_bancario_nombre").val(respuesta["banco_nombre"]);
				$("#edit_bancario_tipo_cuenta").val(respuesta["banco_tipo"]);
				$("#edit_bancario_numero_cuenta").val(respuesta["banco_numero"]);
				$("#edit_bancario_banco").val(respuesta["banco_banco"]);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	$("#form_modal_bancario").on("submit", function(e){
		e.preventDefault();
		var f = $(this);
		var id 				= $('#edit_bancario_id').val();
		var bcpp 			= $('#edit_bancario_bcpp').val();
		var banco_cedula 	= $('#edit_bancario_cedula').val();
		var banco_nombre 	= $('#edit_bancario_nombre').val();
		var banco_tipo 		= $('#edit_bancario_tipo_cuenta').val();
		var banco_numero 	= $('#edit_bancario_numero_cuenta').val();
		var banco_banco 	= $('#edit_bancario_banco').val();

	    $.ajax({
			type: 'POST',
			url: '../script/crud_nomina.php',
			data: {
				"id": id,
				"bcpp": bcpp,
				"banco_cedula": banco_cedula,
				"banco_nombre": banco_nombre,
				"banco_tipo": banco_tipo,
				"banco_numero": banco_numero,
				"banco_banco": banco_banco,
				"condicion": "modificar_bancarios1",
			},
			dataType: "JSON",
			success: function(respuesta) {
				console.log(respuesta);
					Swal.fire({
	 					title: 'Registro Correcto!',
	 					text: "Redirigiendo...",
	 					icon: 'success',
	 					position: 'center',
	 					showConfirmButton: false,
	 					confirmButtonColor: '#3085d6',
	 					confirmButtonText: 'No esperar!',
	 					timer: 3000
					});

					$("#exampleModal3").modal('hide');
					$('#exampleModal3').removeClass('modal-open');
					$('.modal-backdrop').remove();
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	});

	function documentos1(id){
		$.ajax({
			type: 'POST',
			url: '../script/crud_nomina.php',
			data: {
				"id": id,
				"condicion": "documentos1",
			},
			dataType: "JSON",
			success: function(respuesta) {
				//console.log(respuesta);
				$("#respuesta_documentos1").html(respuesta["html"]);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function contrato1(id){
		$.ajax({
			type: 'POST',
			url: '../script/crud_nomina.php',
			data: {
				"id": id,
				"condicion": "contrato1",
			},
			dataType: "JSON",
			success: function(respuesta) {
				console.log(respuesta);
				$("#respuesta_contratos1").html(respuesta["html"]);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function eliminar2(id,id_documento){
		Swal.fire({
			title: 'Estas seguro?',
			text: "Luego no podrás revertir esta acción",
			icon: 'warning',
			showConfirmButton: true,
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, Eliminar Documento!',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: 'POST',
					url: '../script/crud_nomina.php',
					dataType: "JSON",
					data: {
						"id": id,
						"id_documento": id_documento,
						"condicion": "eliminar2",
					},
					success: function(respuesta) {
						console.log(respuesta);
						$('#div_documento1_'+id_documento).hide('slow');
					},

					error: function(respuesta) {
						console.log("error..."+respuesta);
					}
				});
			}
		})
	}

</script>







