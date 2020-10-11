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
<?php
	include('../script/conexion.php');
	$ubicacion = "seguridad";
	include('../script/navbar_verificacion.php');
	include('../navbar.php');
?>
	<form id="formulario1" method="POST">
		<input type="hidden" id="seguridad_view" value="<?php echo $seguridad_view; ?>">
	</form>

	<div class="seccion1">
	    <div class="row">
		    <div class="container_consulta1">
		    	<div class="row mb-3">
		    		<div class="col-md-12 text-center" style="font-weight: bold; font-size: 24px; color: #17a2b8;">PC's de Auditoria Permitidos</div>
		    		<div class="col-md-12 text-right">
		    			<span style="margin-right: 2rem;">
		    				<button class="btn btn-success" data-toggle="modal" data-target="#exampleModal2">Nuevo Registro</button>
		    			</span>
		    		</div>
		    	</div>

		    	<table id="example" class="table row-border hover table-bordered" >
			        <thead>
			            <tr>
			                <th class="text-center">Número</th>
			                <th class="text-center">Nombre</th>
			                <th class="text-center">Opciones</th>
			            </tr>
			        </thead>
			        <tbody id="resultados">
			        	<?php
			        	$consulta2 = "SELECT * FROM seguridad";
						$resultado2 = mysqli_query( $conexion, $consulta2 );
						$contador1=1;
						while($row2 = mysqli_fetch_array($resultado2)) {
							$seguridad_id 		= $row2['id'];
							$seguridad_nombre 	= $row2['nombre'];
							echo '
								<tr>
					                <td class="text-center">'.$contador1.'</td>
					                <td class="text-center">'.$seguridad_nombre.'</td>
					                <td class="text-center">
					                	<i class="fas fa-edit" style="color:#0095ff; cursor:pointer;" title="" value="'.$seguridad_id.'" data-toggle="modal" data-target="#exampleModal" onclick="modal_edit('.$seguridad_id.');"></i>
					                	<i class="fas fa-trash-alt ml-3" style="color:red; cursor:pointer;" data-toggle="popover-hover" data-placement="top" value="'.$seguridad_id.'" title="" onclick="eliminar('.$seguridad_id.');" data-content="<strong>Eliminar Registro</strong>"></i>
					                </td>
					            </tr>
					        ';
					        $contador1 = $contador1+1;
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
						    <div class="col-12 form-group form-check">
							    <label for="edit_nombre">Nombre de la PC <small style="color:red; font-weight: bold;">(*)</small></label>
							    <input type="text" id="edit_nombre" name="edit_nombre" class="form-control" required>
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
						    <div class="col-12 form-group form-check">
							    <label for="new_nombre">Nombre de la PC <small style="color:red; font-weight: bold;">(*)</small></label>
							    <input type="text" id="new_nombre" name="new_nombre" class="form-control" required>
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

	$('#myModal').on('shown.bs.modal', function () {
	  	$('#myInput').trigger('focus')
	});

	$("#form_modal_register").on("submit", function(e){
		e.preventDefault();
		console.log('guardando...');
	});

	/*************LLENAR FORM EDIT*******************/

	function modal_edit (variable) {
		console.log(variable);
		$.ajax({
			type: 'POST',
			url: '../script/seguridad_modal_editar.php',
			dataType: "JSON",
			data: {
				"variable": variable,
			},

			success: function(respuesta) {
				$('#edit_id').val(respuesta['id']);
				$('#edit_nombre').val(respuesta['nombre']);
			},

			error: function(respuesta) {
				console.log('Error...'+respuesta);
			}
		});
	}

	/**********FIN LLENAR FORM EDIT******************/

	$("#form_modal_edit").on("submit", function(e){
		e.preventDefault();
		var f = $(this);
	    $.ajax({
			type: 'POST',
			url: '../script/editar_seguridad1.php',
			data: $('#form_modal_edit').serialize(),
			dataType: "JSON",
			success: function(respuesta) {
				Swal.fire({
 					title: 'Datos actualizados satisfactoriamente',
 					text: "Redirigiendo...!",
 					icon: 'success',
 					position: 'center',
 					showConfirmButton: true,
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
			    },3500);
			},

			error: function(respuesta) {
				console.log("error..."+respuesta);
			}
		});
	});

	function eliminar(variable){
		//console.log(variable);
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
				url: '../script/eliminar_seguridad.php',
				data: {"variable": variable},
				dataType: "JSON",
				success: function(respuesta) {
					//console.log(respuesta);
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

	$('#form_modal_new').on('submit',function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '../script/crear_seguridad1.php',
			data: $('#form_modal_new').serialize(),
			dataType: "JSON",
			success: function(respuesta) {
				$('#exampleModal2').addClass('d-none');
				Swal.fire({
 					title: 'Registro creado satisfactoriamente',
 					text: "Redirigiendo...!",
 					icon: 'success',
 					position: 'center',
 					showConfirmButton: true,
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
			    },3500);
			},

			error: function(respuesta) {
				console.log("error..."+respuesta);
			}
		});
	})

</script>
