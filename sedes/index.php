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
	$ubicacion = "sedes";
	include('../script/navbar_verificacion.php');
	include('../navbar.php');
?>
	<form id="formulario1" method="POST">
		<input type="hidden" id="modelo_view" value="<?php echo $modelo_view; ?>">
		<input type="hidden" id="modelo_edit" value="<?php echo $modelo_edit; ?>">
		<input type="hidden" id="modelo_delete" value="<?php echo $modelo_delete; ?>">
	</form>

	<div class="col-12 text-right mt-3">
		<input type="submit" class="btn btn-success" value="Nuevo Registro" data-toggle="modal" data-target="#exampleModal3">
	</div>

	<div class="seccion1">
	    <div class="row">
		    <div class="container_consulta1">
		    	<table id="example" class="table row-border hover table-bordered" style="font-size: 12px;">
			        <thead>
			            <tr>
			                <th class="text-center">Nombre</th>
			                <th class="text-center">Dirección</th>
			                <th class="text-center">Ciudad</th>
			                <th class="text-center">Opciones</th>
			            </tr>
			        </thead>
			        <tbody id="resultados">
			        	<?php
			        	$consulta2 = "SELECT * FROM sedes";
						$resultado2 = mysqli_query( $conexion, $consulta2 );
						while($row2 = mysqli_fetch_array($resultado2)) {
							$sedes_id 			= $row2['id'];
							$sedes_nombre 		= $row2['nombre'];
							$sedes_direccion	= $row2['direccion'];
							$sedes_ciudad 		= $row2['ciudad'];

							echo '
								<tr>
					                <td class="text-center">'.$sedes_nombre.'</td>
					                <td class="text-center">'.$sedes_direccion.'</td>
					                <td class="text-center">'.$sedes_ciudad.'</td>
					                <td class="text-center">
					            ';

					        echo '
								        <i class="fas fa-edit" style="color:#0095ff; cursor:pointer;" title="" value="'.$sedes_id.'" data-toggle="modal" data-target="#exampleModal" onclick="modal_edit('.$sedes_id.');"></i>
								        <i class="fas fa-trash-alt ml-3" style="color:red; cursor:pointer;" data-toggle="popover-hover" onclick="eliminar('.$sedes_id.');" value="'.$sedes_id.'"></i>
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
						<h5 class="modal-title" id="exampleModalLabel">Editar Sede</h5>
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
							    <label for="edit_ciudad">Ciudad <small style="color:red; font-weight: bold;">(*)</small></label>
							    <input type="text" name="edit_ciudad" id="edit_ciudad" value="" class="form-control" required>
						    </div>
						    <div class="col-12 form-group form-check">
							    <label for="edit_direccion">Dirección <small style="color:red; font-weight: bold;">(*)</small></label>
							    <textarea name="edit_direccion" id="edit_direccion" class="form-control" required></textarea>
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
						<h5 class="modal-title" id="exampleModalLabel">Crear Sede</h5>
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
							    <label for="ciudad">Ciudad <small style="color:red; font-weight: bold;">(*)</small></label>
							    <input type="text" name="ciudad" id="ciudad" value="" class="form-control" required>
						    </div>
						    <div class="col-12 form-group form-check">
							    <label for="direccion">Dirección <small style="color:red; font-weight: bold;">(*)</small></label>
							    <textarea name="direccion" id="direccion" class="form-control" required></textarea>
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

	} );

	$('#myModal').on('shown.bs.modal', function () {
	  	$('#myInput').trigger('focus')
	});

	/*************LLENAR FORM EDIT*******************/

	function modal_edit (variable) {
		$.ajax({
			type: 'POST',
			url: '../script/sedes_modal_editar.php',
			dataType: "JSON",
			data: {
				"variable": variable,
			},

			success: function(respuesta) {
				console.log(respuesta);
				$('#edit_id').val(respuesta['id']);
				$('#edit_nombre').val(respuesta['nombre']);
				$('#edit_direccion').val(respuesta['direccion']);
				$('#edit_ciudad').val(respuesta['ciudad']);
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
			url: '../script/editar_monitores1.php',
			data: $('#form_modal_edit').serialize(),
			dataType: "JSON",

			success: function(respuesta) {
				//console.log(respuesta);
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Se ha modificado exitosamente!',
					showConfirmButton: false,
					timer: 3000
				})
				setTimeout(function() {
			      	window.location.href = "index.php";
			    },3500);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	});

	$("#form_modal_nuevo").on("submit", function(e){
		e.preventDefault();
		var f = $(this);
	    $.ajax({
			type: 'POST',
			url: '../script/guardar_sede1.php',
			data: $('#form_modal_nuevo').serialize(),
			dataType: "JSON",

			success: function(respuesta) {
				console.log(respuesta);
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Se ha creado exitosamente!',
					showConfirmButton: false,
					timer: 3000
				})
				setTimeout(function() {
			      	window.location.href = "index.php";
			    },3500);
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
				url: '../script/eliminar_sedes1.php',
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
	
</script>
