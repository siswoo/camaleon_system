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
		<div class="col-12 text-center mt-3 ml-3">
			<a href="nuevo_pago.php">
				<input type="submit" class="btn btn-success" value="Nuevo Pago">
			</a>
			<input type="submit" class="btn btn-info" value="Descuentos" data-toggle="modal" data-target="#exampleModal3">
		</div>
	</div>

	<!--<div class="col-12 text-center" style="font-weight: bold; ">Resumen de Pagos Efectuados</div>-->

	<div class="seccion1">
	    <div class="row">
		    <div class="container_consulta1">
		    	<table id="example" class="table row-border hover table-bordered" style="font-size: 12px;">
			        <thead>
			            <tr>
			                <th class="text-center">Nombre</th>
			                <th class="text-center">Apellido</th>
			                <th class="text-center">Tipo Doc</th>
			                <th class="text-center">Número Doc</th>
			                <th class="text-center">Correo</th>
			                <th class="text-center">Usuario</th>
			                <th class="text-center">WhatsApp</th>
			                <th class="text-center">Teléfono</th>
			                <th class="text-center">Sede</th>
			                <th class="text-center">Fecha Inicio</th>
			                <th class="text-center">Opciones</th>
			            </tr>
			        </thead>
			        <tbody id="resultados">
			        	<?php
			        	$consulta2 = "SELECT * FROM usuarios WHERE rol = 6 and rol = 9";
						$resultado2 = mysqli_query( $conexion, $consulta2 );
						while($row2 = mysqli_fetch_array($resultado2)) {
							$usuario_id 				= $row2['id'];
							$usuario_nombre 			= $row2['nombre'];
							$usuario_apellido			= $row2['apellido'];
							$usuario_documento_tipo 	= $row2['documento_tipo'];
							$usuario_documento_numero 	= $row2['documento_numero'];
							$usuario_correo 			= $row2['correo'];
							$usuario_usuario 			= $row2['usuario'];
							$usuario_telefono1 			= $row2['telefono1'];
							$usuario_telefono2 			= $row2['telefono2'];
							$sede 						= $row2['sede'];
							$usuario_fecha_inicio 		= $row2['fecha_inicio'];

							$sql_sedes2 = "SELECT * FROM sedes WHERE id = ".$sede;
							$resultado_sedes2 = mysqli_query($conexion, $sql_sedes2);
							while($row4 = mysqli_fetch_array($resultado_sedes2)) {
								$sedes_nombre_mostrar = $row4['nombre'];
							}

							echo '
								<tr>
					                <td nowrap>'.$usuario_nombre.'</td>
					                <td nowrap>'.$usuario_apellido.'</td>
					                <td class="text-center">'.$usuario_documento_tipo.'</td>
					                <td class="text-center">'.$usuario_documento_numero.'</td>
					                <td class="text-center">'.$usuario_correo.'</td>
					                <td class="text-center">'.$usuario_usuario.'</td>
					                <td class="text-center">'.$usuario_telefono1.'</td>
					                <td class="text-center">'.$usuario_telefono2.'</td>
					                <td class="text-center">'.$sedes_nombre_mostrar.'</td>
					                <td class="text-center">'.$usuario_fecha_inicio.'</td>
					                <td class="text-center">
					            ';

					        echo '
								        <i class="fas fa-edit" style="color:#0095ff; cursor:pointer;" title="" value="'.$usuario_id.'" data-toggle="modal" data-target="#exampleModal" onclick="modal_edit('.$usuario_id.');"></i>
								        <i class="fas fa-trash-alt ml-3" style="color:red; cursor:pointer;" data-toggle="popover-hover" onclick="eliminar('.$usuario_id.');" value="'.$usuario_id.'"></i>
					        ';

					        echo '
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

<?php include('../footer.php'); ?>

<!-- Modal Editar Registro -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_edit" style="">
				<input type="hidden" name="edit_id" id="edit_id">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Monitor</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row">
						    <div class="col-6 form-group form-check">
							    <label for="edit_nombre">Nombre <small style="color:red; font-weight: bold;">(*)</small></label>
							    <input type="text" name="edit_nombre" id="edit_nombre" value="" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_apellido">Apellido <small style="color:red; font-weight: bold;">(*)</small></label>
							    <input type="text" name="edit_apellido" id="edit_apellido" value="" class="form-control" required>
						    </div>
					    </div>

					    <div class="row">
						    <div class="col-6 form-group form-check">
							    <label for="edit_tipo_documento">Tipo Documento <small style="color:red; font-weight: bold;">(*)</small></label>
							    <select name="edit_tipo_documento" id="edit_tipo_documento" class="form-control" required>
							    	<option value="">Seleccione</option>
							    	<option value="Cedula de Ciudadania">Cedula de Ciudadania</option>
							    	<option value="Cedula de Extranjeria">Cedula de Extranjeria</option>
							    	<option value="PEP">PEP</option>
							    	<option value="Pasaporte">Pasaporte</option>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_numero_documento">Número Documento <small style="color:red; font-weight: bold;">(*)</small></label>
							    <input type="text" name="edit_numero_documento" id="edit_numero_documento" value="" class="form-control" required>
						    </div>
						</div>

						<div class="row">
							<div class="col-6 form-group form-check">
							    <label for="edit_correo">Correo</label>
							    <input type="email" name="edit_correo" id="edit_correo" value="" class="form-control" required>
						    </div>

						    <div class="col-6 form-group form-check">
							    <label for="edit_usuario">Usuario</label>
							    <input type="text" name="edit_usuario" id="edit_usuario" value="" class="form-control" disabled>
						    </div>

						    <div class="col-6 form-group form-check">
							    <label for="edit_telefono1">WhatsApp</label>
							    <input type="text" name="edit_telefono1" id="edit_telefono1" value="" class="form-control" required>
						    </div>

						    <div class="col-6 form-group form-check">
							    <label for="edit_telefono2">Teléfono</label>
							    <input type="text" name="edit_telefono2" id="edit_telefono2" value="" class="form-control">
						    </div>

						    <div class="col-6 form-group form-check">
							    <label for="edit_sede">Sede</label>
							    <select class="form-control" name="edit_sede" id="edit_sede" required>
							    	<option value="">Seleccione</option>
							    	<?php
							    	$sql_sedes = "SELECT * FROM sedes";
									$resultado_sedes = mysqli_query($conexion, $sql_sedes);
									while($row3 = mysqli_fetch_array($resultado_sedes)) {
										$sedes_id = $row3['id'];
										$sedes_nombre = $row3['nombre'];
										echo '<option value="'.$sedes_id.'">'.$sedes_nombre.'</option>';
									}
							    	?>
							    </select>
						    </div>
						</div>

					</div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" class="btn btn-success">Guardar</button>
			      	</div>
		      	</form>
	    	</div>
	  	</div>
	</div>
<!-- FIN Modal Editar Registro -->

<!-- Modal Crear Registro -->
	<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_nuevo" style="">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Crear Monitor</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row">
						    <div class="col-6 form-group form-check">
							    <label for="nombre">Nombre <small style="color:red; font-weight: bold;">(*)</small></label>
							    <input type="text" name="nombre" id="nombre" value="" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="apellido">Apellido <small style="color:red; font-weight: bold;">(*)</small></label>
							    <input type="text" name="apellido" id="apellido" value="" class="form-control" required>
						    </div>
					    </div>

					    <div class="row">
						    <div class="col-6 form-group form-check">
							    <label for="tipo_documento">Tipo Documento <small style="color:red; font-weight: bold;">(*)</small></label>
							    <select name="tipo_documento" id="tipo_documento" class="form-control" required>
							    	<option value="">Seleccione</option>
							    	<option value="Cedula de Ciudadania">Cedula de Ciudadania</option>
							    	<option value="Cedula de Extranjeria">Cedula de Extranjeria</option>
							    	<option value="PEP">PEP</option>
							    	<option value="Pasaporte">Pasaporte</option>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="numero_documento">Número Documento <small style="color:red; font-weight: bold;">(*)</small></label>
							    <input type="text" name="numero_documento" id="numero_documento" value="" class="form-control" required>
						    </div>
						</div>

						<div class="row">
							<div class="col-6 form-group form-check">
							    <label for="correo">Correo</label>
							    <input type="email" name="correo" id="correo" value="" class="form-control" required>
						    </div>

						    <div class="col-6 form-group form-check">
							    <label for="usuario">Usuario</label>
							    <input type="text" name="usuario" id="usuario" value="" class="form-control" required>
						    </div>

						    <div class="col-6 form-group form-check">
							    <label for="telefono1">WhatsApp</label>
							    <input type="text" name="telefono1" id="telefono1" value="" class="form-control" required>
						    </div>

						    <div class="col-6 form-group form-check">
							    <label for="telefono2">Teléfono</label>
							    <input type="text" name="telefono2" id="telefono2" value="" class="form-control">
						    </div>

						    <div class="col-6 form-group form-check">
							    <label for="sede">Sede</label>
							    <select class="form-control" name="sede" id="sede" required>
							    	<option value="">Seleccione</option>
							    	<?php
							    	$sql_sedes = "SELECT * FROM sedes";
									$resultado_sedes = mysqli_query($conexion, $sql_sedes);
									while($row3 = mysqli_fetch_array($resultado_sedes)) {
										$sedes_id = $row3['id'];
										$sedes_nombre = $row3['nombre'];
										echo '<option value="'.$sedes_id.'">'.$sedes_nombre.'</option>';
									}
							    	?>
							    </select>
						    </div>

						    <div class="col-6 form-group form-check">
							    <label for="clave">Clave</label>
							    <input type="password" name="clave" id="clave" value="" class="form-control">
						    </div>
						</div>

					</div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" class="btn btn-success">Guardar</button>
			      	</div>
		      	</form>
	    	</div>
	  	</div>
	</div>
<!-- FIN Modal Crear Registro -->
</body>
</html>

<script src="../js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../js/popper.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="../js/navbar.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/dataTables.bootstrap4.min.js"></script>

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

	$("#form_modal_register").on("submit", function(e){
		e.preventDefault();
		console.log('guardando...');
	});
	
</script>
