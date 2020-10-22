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
</style>
<body>
<?php
	include('../script/conexion.php');
	$ubicacion = "pasante";
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
	<form id="formulario1" method="POST">
		<input type="hidden" id="pasante_view" value="<?php echo $pasante_view; ?>">
		<input type="hidden" id="pasante_edit" value="<?php echo $pasante_edit; ?>">
		<input type="hidden" id="pasante_delete" value="<?php echo $pasante_delete; ?>">
		<!--*********************************************************************-->
		<input type="hidden" id="roles_view" value="<?php echo $roles_view; ?>">
		<input type="hidden" id="seguridad_view" value="<?php echo $seguridad_view; ?>">
		<input type="hidden" id="modelo_view" value="<?php echo $modelo_view; ?>">
		<!--*********************************************************************-->
	</form>

	<div class="seccion1">
	    <div class="row">
		    <div class="container_consulta1">
		    	
		    	<div class="row mb-3">
		    		<div class="col-md-6 text-right">
		    			<!--<input type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal2" value="Nuevo Registro">-->
		    			<input type="submit" class="btn btn-info" value="Importar Datos" data-toggle="modal" data-target="#exampleModal3">
		    		</div>
		    		<div class="col-md-6">
		    			<form action="../script/pasante_excel_exportar1.php" method="POST">
		    				<input type="submit" class="btn btn-danger" value="Exportar Datos">
		    				<?php
			    			if($_SESSION['rol']==1){
				        		$consulta_hidden = "SELECT * FROM pasantes";	
				        	}else{
				        		$session_sede = $_SESSION['sede'];
				        		$consulta_hidden = "SELECT * FROM pasantes WHERE sede = $session_sede";
				        	}
				        	?>
		    				<input type="hidden" name="sql" id="sql" value="<?php echo $consulta_hidden; ?>">
		    			</form>
		    		</div>
		    	</div>

		    	<table id="example" class="table row-border hover table-bordered" style="font-size: 12px;">
			        <thead>
			            <tr>
			                <th class="text-center">T Doc</th>
			                <th class="text-center">Nº Doc</th>
			                <th class="text-center">Nombre</th>
			                <th class="text-center">Apellido</th>
			                <th class="text-center">Género</th>
			                <th class="text-center">Correo</th>
			                <th class="text-center">Teléfono</th>
			                <th class="text-center">Barrio</th>
			                <th class="text-center">Estatus</th>
			                <th class="text-center">Sede</th>
			                <th class="text-center">Fecha Inicio</th>
			                <th class="text-center">Opciones</th>
			                <th class="text-center">Admisión</th>
			            </tr>
			        </thead>
			        <tbody id="resultados">
			        	<?php
			        	if($_SESSION['rol']==1){
			        		$consulta2 = "SELECT * FROM pasantes";	
			        	}else{
			        		$session_sede = $_SESSION['sede'];
			        		$consulta2 = "SELECT * FROM pasantes WHERE sede = $session_sede";
			        	}
						$resultado2 = mysqli_query( $conexion, $consulta2 );
						while($row2 = mysqli_fetch_array($resultado2)) {
							$id 					= $row2['id'];
							$tipo_documento 		= $row2['tipo_documento'];
							$numero_documento 		= $row2['numero_documento'];
							$primer_nombre 			= $row2['primer_nombre'];
							$segundo_nombre 		= $row2['segundo_nombre'];
							$primer_apellido 		= $row2['primer_apellido'];
							$segundo_apellido 		= $row2['segundo_apellido'];
							$genero 				= $row2['genero'];
							$correo 				= $row2['correo'];
							$telefono1 				= $row2['telefono1'];
							$direccion 				= $row2['direccion'];
							$estatus 				= $row2['estatus'];
							$barrio 				= $row2['barrio'];
							$sede 					= $row2['sede'];
							$fecha_inicio 			= $row2['fecha_inicio'];
							echo '
								<tr>
					                <td class="text-center">'.$tipo_documento.'</td>
					                <td class="text-center">'.$numero_documento.'</td>
					                <td class="text-center" nowrap>'.$primer_nombre." ".$segundo_nombre.'</td>
					                <td class="text-center" nowrap>'.$primer_apellido." ".$segundo_apellido.'</td>
					                <td class="text-center">'.$genero.'</td>
					                <td class="text-center">'.$correo.'</td>
					                <td class="text-center">'.$telefono1.'</td>
					                <td class="text-center">'.$barrio.'</td>
					                <!--<td class="text-center">'.$direccion.'</td>-->
					            ';

					        	if($estatus=='Aceptada'){
					        		echo '<td class="text-center" style="color:green;">'.$estatus.'</td>';	
					        	}else if($estatus=='Rechazada'){
					        		echo '<td class="text-center" style="color:red;">'.$estatus.'</td>';
					        	}else{
					        		echo '<td class="text-center">'.$estatus.'</td>';
					        	}

					        	$sql1 = "SELECT * FROM sedes WHERE id = ".$sede;
					        	$consulta3 = mysqli_query($conexion,$sql1);
								while($row3 = mysqli_fetch_array($consulta3)) {
									$sede_nombre = $row3['nombre'];
								}

								echo '<td class="text-center">'.$sede_nombre.'</td>';

					        echo '
					                <td class="text-center">'.$fecha_inicio.'</td>
					                <td class="text-center">
					            ';

					        	if($pasante_edit==1){
					        		echo '
					                	<i class="fas fa-edit" style="color:#0095ff; cursor:pointer;" title="" value="'.$id.'" data-toggle="modal" data-target="#exampleModal" onclick="modal_edit('.$id.');"></i>
					                ';
					        	}else{
					        		echo '
					                	<i class="fas fa-edit" style="color:#c3bebe; cursor:pointer;" data-toggle="popover-hover" data-placement="top" title="Deshabilitado" data-content="Falta de permisos"></i>
					                ';
					        	}

					        	if($pasante_delete==1){
					        		echo '
					                	<i class="fas fa-trash-alt ml-3" style="color:red; cursor:pointer;" data-toggle="popover-hover" onclick="eliminar('.$id.');" value="'.$id.'"></i>
					                ';
					        	}else{
					        		echo '
					                	<i class="fas fa-trash-alt ml-3" style="color:#c3bebe; cursor:pointer;" data-toggle="popover-hover" data-placement="top" title="Deshabilitado" data-content="Falta de permisos"></i>
					        		';
					        	}
					        	echo '</td>';
					        	echo '<td class="text-center">';

					        	if($estatus=='Proceso'){
					        		echo '
					                	<button class="btn btn-success" value="'.$id.'" onclick="aceptar('.$id.');">A</button>
					                	<button class="btn btn-danger" value="'.$id.'" onclick="rechazar('.$id.');">R</button>
					                ';
					        	}else if($estatus=='Aceptada'){
					        		echo '
					                	<button class="btn btn-danger" value="'.$id.'" onclick="rechazar('.$id.');">R</button>
					                ';
					        	}else{
					        		echo '
					                	<button class="btn btn-success" value="'.$id.'" onclick="aceptar('.$id.');">A</button>
					                ';
					        	}

					        	echo '
					        		</td>
					        	</tr>';
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
						<h5 class="modal-title" id="exampleModalLabel">Editar Registro</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row">
						    <div class="col-6 form-group form-check">
							    <label for="edit_tipo_documento">Tipo de Documento <small style="color:red; font-weight: bold;">(*)</small></label>
							    <select name="edit_tipo_documento" id="edit_tipo_documento" class="form-control" required>
							    	<option value="">Seleccione</option>
							    	<option value="Cedula de Ciudadania">Cedula de Ciudadania</option>
							    	<option value="Cedula de Extranjeria">Cedula de Extranjeria</option>
							    	<option value="PEP">PEP</option>
							    	<option value="Pasaporte">Pasaporte</option>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_numero_documento">Número de Documento <small style="color:red; font-weight: bold;">(*)</small></label>
							    <input type="text" name="edit_numero_documento" id="edit_numero_documento" class="form-control" minlength="6" autocomplete="off" required>
						    </div>
				    	</div>

					    <div class="row">
						    <div class="col-6 form-group form-check">
							    <label for="edit_primer_nombre">Primer Nombre <small style="color:red; font-weight: bold;">(*)</small></label>
							    <input type="text" name="edit_primer_nombre" id="edit_primer_nombre" class="form-control" autocomplete="off" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_segundo_nombre">Segundo Nombre</small></label>
							    <input type="text" name="edit_segundo_nombre" id="edit_segundo_nombre" class="form-control" autocomplete="off" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_primer_apellido">Primer Apellido <small style="color:red; font-weight: bold;">(*)</small></label>
							    <input type="text" name="edit_primer_apellido" id="edit_primer_apellido" class="form-control" autocomplete="off" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_segundo_apellido">Segundo Apellido <small style="color:red; font-weight: bold;">(*)</small></label>
							    <input type="text" name="edit_segundo_apellido" id="edit_segundo_apellido" class="form-control" autocomplete="off" required>
						    </div>
					    </div>

					    <div class="row">
						    <div class="col-6 form-group form-check">
							    <label for="edit_correo">Correo <small style="color:red; font-weight: bold;">(*)</small></label>
							    <input type="email" name="edit_correo" id="edit_correo" class="form-control" autocomplete="off" required>
						    </div>

						    <div class="col-6 form-group form-check">
							    <label for="edit_telefono1">Teléfono Principal <small style="color:red; font-weight: bold;">(*)</small></label>
							    <input type="text" name="edit_telefono1" id="edit_telefono1" class="form-control" autocomplete="off" required>
						    </div>

						    <div class="col-6 form-group form-check">
							    <label for="edit_barrio">Barrio</small></label>
							    <input type="text" name="edit_barrio" id="edit_barrio" class="form-control" autocomplete="off" required>
						    </div>

						    <div class="col-6 form-group form-check">
							    <label for="edit_genero">Género</small></label>
							    <select class="form-control" id="edit_genero" name="edit_genero" required>
									<option value="">Seleccione</option>
									<option value="Hombre">Hombre</option>
									<option value="Mujer">Mujer</option>
									<option value="Transexual">Transexual</option>
								</select>
						    </div>

						    <div class="col-12 form-group form-check">
							    <label for="edit_direccion">Dirección (Opcional)</label>
							    <textarea name="edit_direccion" id="edit_direccion" class="form-control" autocomplete="off" required></textarea>
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
	<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
							    <label for="tipo_documento">Tipo de Documento <small style="color:red; font-weight: bold;">(*)</small></label>
							    <select name="tipo_documento" id="tipo_documento" class="form-control" required>
							    	<option value="">Seleccione</option>
							    	<option value="Cedula de Ciudadania">Cedula de Ciudadania</option>
							    	<option value="Cedula de Extranjeria">Cedula de Extranjeria</option>
							    	<option value="PEP">PEP</option>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="numero_documento">Número de Documento <small style="color:red; font-weight: bold;">(*)</small></label>
							    <input type="text" name="numero_documento" id="numero_documento" class="form-control" minlength="6" autocomplete="off" required>
						    </div>
				    	</div>

					    <div class="row">
						    <div class="col-6 form-group form-check">
							    <label for="primer_nombre">Primer Nombre <small style="color:red; font-weight: bold;">(*)</small></label>
							    <input type="text" name="primer_nombre" id="primer_nombre" class="form-control" autocomplete="off" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="primer_apellido">Primer Apellido <small style="color:red; font-weight: bold;">(*)</small></label>
							    <input type="text" name="primer_apellido" id="primer_apellido" class="form-control" autocomplete="off" required>
						    </div>
					    </div>

					    <div class="row">
						    <div class="col-6 form-group form-check">
							    <label for="correo">Correo <small style="color:red; font-weight: bold;">(*)</small></label>
							    <input type="email" name="correo" id="correo" class="form-control" autocomplete="off" required>
						    </div>

						    <div class="col-6 form-group form-check">
							    <label for="telefono1">Teléfono Principal <small style="color:red; font-weight: bold;">(*)</small></label>
							    <input type="text" name="telefono1" id="telefono1" class="form-control" autocomplete="off" required>
						    </div>
						    <div class="col-12 form-group form-check">
							    <label for="direccion">Dirección (Opcional)</label>
							    <textarea name="direccion" id="direccion" class="form-control" autocomplete="off" required></textarea>
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
<!-- FIN Modal Nuevo Registro -->


<!-- Modal Importar1 -->
	<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_importar" style="" enctype="multipart/form-data">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Importación</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row">
						    <div class="col-12 form-group form-check">
							    <label for="archivo">Tipo de Documento</label>
							    <input type="file" name="archivo" class="form-control" required>
						    </div>
				    	</div>
					</div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" class="btn btn-success" id="submit_importar">Guardar</button>
			      	</div>
	    		</div>
		    </form>
	  	</div>
	</div>
<!-- FIN Modal Importar1 -->

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
        	"order": [[ 10, "desc" ]],

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

    	$('#select_equipo').change(function (){
			var div = $('#select_equipo');
			var variable = $('#select_equipo').val();
			if(variable != '' && variable != 1){
				//$('#divEquipos').removeClass('d-none');
				$('#divEquipos').show();
				$.ajax({
					type: 'POST',
					url: '../script/equipos_select1.php',
					data: {
						"equipo": variable
					},
					/*dataType: "JSON",*/
					success: function(respuesta) {
						//console.log(respuesta);
						$('#select_enlazar').html(respuesta);

					},

					error: function(respuesta) {
						console.log('Error...'+respuesta);
					}
				});
			}else{
				$('#divEquipos').hide();
			}
		});

	} );

    function filtros(variable){
	var condicional = variable;
	var modelo_view = $('#modelo_view').val();
	var modelo_edit = $('#modelo_edit').val();
	var modelo_delete = $('#modelo_delete').val();
	var respuesta = $('#resultados');
	    $.ajax({
			type: 'POST',
			url: '../script/modelo_consultas.php',
			data: {
				"modelo_view": modelo_view,
				"modelo_edit": modelo_edit,
				"modelo_delete": modelo_delete,
				"condicional": condicional
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

		        	"paging": true,
		        	"order": [[ 10, "desc" ]],

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
	};

	$('#myModal').on('shown.bs.modal', function () {
	  	$('#myInput').trigger('focus')
	});

	/*************LLENAR FORM EDIT*******************/

	function modal_edit (variable) {
		$.ajax({
			type: 'POST',
			url: '../script/pasante_model_editar.php',
			dataType: "JSON",
			data: {
				"variable": variable,
			},

			success: function(respuesta) {
				$('#edit_id').val(respuesta['id']);
				$('#edit_tipo_documento').val(respuesta['tipo_documento']);
				$('#edit_numero_documento').val(respuesta['numero_documento']);
				$('#edit_primer_nombre').val(respuesta['primer_nombre']);
				$('#edit_segundo_nombre').val(respuesta['segundo_nombre']);
				$('#edit_primer_apellido').val(respuesta['primer_apellido']);
				$('#edit_segundo_apellido').val(respuesta['segundo_apellido']);
				$('#edit_genero').val(respuesta['genero']);
				$('#edit_correo').val(respuesta['correo']);
				$('#edit_telefono1').val(respuesta['telefono1']);
				$('#edit_barrio').val(respuesta['barrio']);
				$('#edit_direccion').val(respuesta['direccion']);
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
			url: '../script/editar_pasante.php',
			data: $('#form_modal_edit').serialize(),
			dataType: "JSON",
			success: function(respuesta) {
				console.log(respuesta);
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Modificado exitosamente...!',
					showConfirmButton: false,
					timer: 3000
				});
				setTimeout(function() {
					window.location.href = "index.php";
				},3100);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	});


	$("#form_modal_new").on("submit", function(e){
		e.preventDefault();
		var f = $(this);
		var tipo_documento 		= $('#tipo_documento').val();
		var numero_documento 	= $('#numero_documento').val();
		var primer_nombre 		= $('#primer_nombre').val();
		var primer_apellido 	= $('#primer_apellido').val();
		var correo 				= $('#correo').val();
		var telefono1 			= $('#telefono1').val();
		var direccion 			= $('#direccion').val();

	    $.ajax({
			type: 'POST',
			url: '../script/guardar_pasante1.php',
			data: $('#form_modal_new').serialize(),
			dataType: "JSON",
			success: function(respuesta) {
				if(respuesta == 0){
					Swal.fire({
						position: 'center',
						icon: 'error',
						title: 'Error! Comunicarse con el Administrador!',
						showConfirmButton: true,
						timer: 3000
					})
				}

				if(respuesta != 0){
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


	/*****************CAMPOS DE PRUEBA*******************/
	$(document).ready(function() {
		$('#tipo_documento').val('PEP');
		$('#numero_documento').val(111111111);
		$('#primer_nombre').val(222222222222222);
		$('#primer_apellido').val(3333333333333333);
		$('#correo').val('44444444@gmail.com');
		$('#telefono1').val('55555555555555');
		$('#direccion').val('66666666666666666666');
	});
	/*****************************************************/

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
				url: '../script/eliminar_pasante.php',
				data: {"variable": variable},
				dataType: "JSON",
				success: function(respuesta) {
					Swal.fire({
					    title: 'Registro Eliminado!',
					    text: 'Redirigiendo...',
					    icon: 'success',
					    showConfirmButton: false
				    });setTimeout(function() {
			      		window.location.href = "index.php";
			    	},3500);
				},

				error: function(respuesta) {
					console.log("error..."+respuesta);
				}
			});
		  }
		})
	}

	function aceptar(variable){
		var condicional = 'Aceptada';
		$.ajax({
			type: 'POST',
			url: '../script/pasante_estado.php',
			dataType: "JSON",
			data: {
				"variable": variable,
				"condicional": condicional,
			},
			success: function(respuesta) {
				console.log(respuesta);
				if(respuesta == 0){
					Swal.fire({
						position: 'center',
						icon: 'error',
						title: 'Error! Comunicarse con el Administrador!',
						showConfirmButton: true,
						timer: 3000
					})
				}

				if(respuesta['respuesta']=='no'){
					Swal.fire({
						position: 'center',
						icon: 'error',
						title: 'Ya tiene cuenta de modelo!',
						text: 'Se ha cambiado el estatus pero no se ha creado modelo',
						showConfirmButton: true,
						timer: 5000
					})
					setTimeout(function() {
				      window.location.href = "index.php";
				    },5000);
					return false;
				}

				if(respuesta != 0){
					Swal.fire({
	 					title: 'Estatus Cambiado!',
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
	}

	function rechazar(variable){
		var condicional = 'Rechazada';
		Swal.fire({
			title: 'PRECAUCIÓN',
			text: "Si esta enlazado a una cuenta de Modelo, se pondra Inactivo!",
			icon: 'info',
			position: 'center',
			showConfirmButton: true,
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			confirmButtonText: 'Aceptar',
			cancelButtonText: 'Cancelar',
		}).then((result) => {
	 		if (result.value) {
				$.ajax({
					type: 'POST',
					url: '../script/pasante_estado.php',
					dataType: "JSON",
					data: {
						"variable": variable,
						"condicional": condicional,
					},
					success: function(respuesta) {
						console.log(respuesta);
						if(respuesta == 0){
							Swal.fire({
								position: 'center',
								icon: 'error',
								title: 'Error! Comunicarse con el Administrador!',
								showConfirmButton: true,
								timer: 3000
							})
						}

						if(respuesta != 0){
							Swal.fire({
			 					title: 'Estatus Cambiado!',
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
			}
		})
	}

	$("#form_modal_importar").on("submit", function(e){
		e.preventDefault();
		var fd = new FormData();
        var formData = new FormData(this);
        //console.log(formData);
        //return false;
		$.ajax({
			type: 'POST',
			url: '../script/pasante_excel_importar1.php',
			data:formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType: "JSON",

			success: function(respuesta) {
				console.log(respuesta);
				Swal.fire({
			 		title: 'Importación Finalizada',
			 		text: "Redirigiendo...",
			 		icon: 'success',
			 		position: 'center',
			 		showConfirmButton: false,
			 		timer: 3000
				})
				setTimeout(function() {
					window.location.href = "index.php";
				},3000);
				$('#submit_importar').addClass('d-none');
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	});

</script>
