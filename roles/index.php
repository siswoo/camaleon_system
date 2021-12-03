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
	<link rel="stylesheet" href="../css/roles.css">
	<link rel="stylesheet" href="../css/validaciones.css">
	<link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
	<link href="../resources/fontawesome/css/all.css" rel="stylesheet">
	<title>Camaleon Sistem</title>
</head>
<body>
<?php
	include('../script/conexion.php');
	$ubicacion = "roles";
	include('../script/navbar_verificacion.php');
	include('../navbar.php');
?>
	<form id="formulario1" method="POST">
		<input type="hidden" id="modelo_view" value="<?php echo $modelo_view; ?>">
		<input type="hidden" id="modelo_edit" value="<?php echo $modelo_edit; ?>">
		<input type="hidden" id="modelo_delete" value="<?php echo $modelo_delete; ?>">

		<input type="hidden" id="roles_view" value="<?php echo $roles_view; ?>">
		<input type="hidden" id="roles_edit" value="<?php echo $roles_edit; ?>">
		<input type="hidden" id="roles_delete" value="<?php echo $roles_delete; ?>">
	</form>

	<div class="seccion1">
	    <div class="row">
		    <div class="container_consulta1">

		    	<div class="col-12 mb-2">
		    		<div class="text-left">
		    			<a href="crear_registro.php">
		    				<input type="button" class="btn btn-success" name="Nuevo_rol" id="Nuevo_rol" value="Nuevo Registro">
		    			</a>
		    		</div>
		    	</div>

		    	<table id="example" class="table row-border hover table-bordered" >
			        <thead>
			            <tr>
			                <th class="text-center">Nombre</th>
			                <th class="text-center">V Modelos</th>
			                <th class="text-center">E Modelos</th>
			                <th class="text-center">D Modelos</th>
			                <th class="text-center">V Pasantes</th>
			                <th class="text-center">E Pasantes</th>
			                <th class="text-center">D Pasantes</th>
			                <th class="text-center">Opciones</th>
			            </tr>
			        </thead>
			        <tbody id="resultados">
			        	<?php
			        	if($_SESSION['rol']==1){$consulta2 = "SELECT * FROM roles";}else{$consulta2 = "SELECT * FROM roles WHERE id!=1 and id!=4 and id!=5 and id!=".$_SESSION['rol'];}
						$resultado2 = mysqli_query( $conexion, $consulta2 );
						while($row2 = mysqli_fetch_array($resultado2)) {
							$roles_id 			= $row2['id'];
							$nombre 			= $row2['nombre'];
							$modelo_view2 		= $row2['modelo_view'];
							$modelo_edit2 		= $row2['modelo_edit'];
							$modelo_delete2 	= $row2['modelo_delete'];
							$pasante_view2 		= $row2['pasante_view'];
							$pasante_edit2 		= $row2['pasante_edit'];
							$pasante_delete2 	= $row2['pasante_delete'];

							if($modelo_view2==1){$html_modelo_view3 = '<img src="../img/icons/check_ok1.png" width="40px">';}else{$html_modelo_view3 = '<img src="../img/icons/no1.png" width="40px">';}
							if($modelo_edit2==1){$html_modelo_edit3 = '<img src="../img/icons/check_ok1.png" width="40px">';}else{$html_modelo_edit3 = '<img src="../img/icons/no1.png" width="40px">';}
							if($modelo_delete2==1){$html_modelo_delete3 = '<img src="../img/icons/check_ok1.png" width="40px">';}else{$html_modelo_delete3 = '<img src="../img/icons/no1.png" width="40px">';}

							if($pasante_view2==1){$pasante_view3 = '<img src="../img/icons/check_ok1.png" width="40px">';}else{$pasante_view3 = '<img src="../img/icons/no1.png" width="40px">';}
							if($pasante_edit2==1){$pasante_edit3 = '<img src="../img/icons/check_ok1.png" width="40px">';}else{$pasante_edit3 = '<img src="../img/icons/no1.png" width="40px">';}
							if($pasante_delete2==1){$pasante_delete3 = '<img src="../img/icons/check_ok1.png" width="40px">';}else{$pasante_delete3 = '<img src="../img/icons/no1.png" width="40px">';}

							echo '
								<tr>
					                <td nowrap>'.$nombre.'</td>
									<td class="text-center" data-order="'.$modelo_view2.'">
										'.$html_modelo_view3.'
									</td>
									<td class="text-center" data-order="'.$modelo_edit2.'">
										'.$html_modelo_edit3.'
									</td>
									<td class="text-center" data-order="'.$modelo_delete2.'">
										'.$html_modelo_delete3.'
									</td>
									<td class="text-center" data-order="'.$pasante_view2.'">
										'.$pasante_view3.'
									</td>
									<td class="text-center" data-order="'.$pasante_edit2.'">
										'.$pasante_edit3.'
									</td>
									<td class="text-center" data-order="'.$pasante_delete2.'">
										'.$pasante_delete3.'
									</td>
					                <td class="text-center">
					            ';

					        	if($roles_edit==1){
					        		echo '
					                	<i class="fas fa-edit" style="color:#0095ff; cursor:pointer;" title="" value="'.$roles_id.'" data-toggle="modal" data-target="#exampleModal" onclick="modal_edit('.$roles_id.');"></i>
					                ';
					        	}else{
					        		echo '
					                	<i class="fas fa-edit" style="color:#c3bebe; cursor:pointer;" data-toggle="popover-hover" data-placement="top" title="Deshabilitado" data-content="Falta de permisos"></i>
					                ';
					        	}

					        	if($roles_delete==1){
					        		echo '
					                	<i class="fas fa-trash-alt ml-3" style="color:red; cursor:pointer;" data-toggle="popover-hover" data-placement="top" value="'.$roles_id.'" title="" data-content="<strong>Eliminar Registro</strong>"></i>
					                ';
					        	}else{
					        		echo '
					                	<i class="fas fa-trash-alt ml-3" style="color:#c3bebe; cursor:pointer;" data-toggle="popover-hover" data-placement="top" title="Deshabilitado" data-content="Falta de permisos"></i>
					        		';
					        	}

					        	echo '
					        		</td>
					        	</tr>';
						}
						?>
			            <!-- Caracteristicas interesantes!
			            <tr>
			            	<td data-order="1303689600">Mon 25th Apr 11</td>
                			<td data-order="320800">$320,800/y</td>
			            </tr>
			        	-->
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
						<h5 class="modal-title" id="exampleModalLabel">Editar Rol</h5>
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
							    <label for="edit_modelo_view">Modelo View</label>
							    <select name="edit_modelo_view" id="edit_modelo_view" class="form-control">
							    	<option value="0">No</option>
							    	<option value="1">Si</option>
							    </select>
						    </div>
					    </div>

					    <div class="row">
						    <div class="col-6 form-group form-check">
							    <label for="edit_modelo_edit">Modelo Edit</label>
							    <select name="edit_modelo_edit" id="edit_modelo_edit" class="form-control">
							    	<option value="0">No</option>
							    	<option value="1">Si</option>
							    </select>
						    </div>

						    <div class="col-6 form-group form-check">
							    <label for="edit_modelo_delete">Modelo Delete</label>
							    <select name="edit_modelo_delete" id="edit_modelo_delete" class="form-control">
							    	<option value="0">No</option>
							    	<option value="1">Si</option>
							    </select>
						    </div>
						    <!--
						    <div class="col-6 form-group form-check">
							    <label for="edit_roles_view">Rol View</label>
							    <select name="edit_roles_view" id="edit_roles_view" class="form-control">
							    	<option value="0">No</option>
							    	<option value="1">Si</option>
							    </select>
						    </div>

						    <div class="col-6 form-group form-check">
							    <label for="edit_roles_edit">Rol Edit</label>
							    <select name="edit_roles_edit" id="edit_roles_edit" class="form-control">
							    	<option value="0">No</option>
							    	<option value="1">Si</option>
							    </select>
						    </div>
					    </div>

					    <div class="row">
						    <div class="col-6 form-group form-check">
							    <label for="edit_roles_delete">Rol Delete</label>
							    <select name="edit_roles_delete" id="edit_roles_delete" class="form-control">
							    	<option value="0">No</option>
							    	<option value="1">Si</option>
							    </select>
						    </div>
					    </div>
						-->
						</div>

						<div class="row">
							<div class="col-6 form-group form-check">
							    <label for="edit_pasante_view">Pasante View</label>
							    <select name="edit_pasante_view" id="edit_pasante_view" class="form-control">
							    	<option value="0">No</option>
							    	<option value="1">Si</option>
							    </select>
						    </div>

						    <div class="col-6 form-group form-check">
							    <label for="edit_pasante_edit">Pasante Edit</label>
							    <select name="edit_pasante_edit" id="edit_pasante_edit" class="form-control">
							    	<option value="0">No</option>
							    	<option value="1">Si</option>
							    </select>
						    </div>

						    <div class="col-6 form-group form-check">
							    <label for="edit_pasante_delete">Pasante Delete</label>
							    <select name="edit_pasante_delete" id="edit_pasante_delete" class="form-control">
							    	<option value="0">No</option>
							    	<option value="1">Si</option>
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
			url: '../script/roles_modal_editar.php',
			dataType: "JSON",
			data: {
				"variable": variable,
			},

			success: function(respuesta) {
				console.log(respuesta);
				$('#edit_id').val(respuesta['id']);
				$('#edit_nombre').val(respuesta['nombre']);
				$('#edit_modelo_view').val(respuesta['modelo_view']);
				$('#edit_modelo_edit').val(respuesta['modelo_edit']);
				$('#edit_modelo_delete').val(respuesta['modelo_delete']);

				$('#edit_roles_view').val(respuesta['roles_view']);
				$('#edit_roles_edit').val(respuesta['roles_edit']);
				$('#edit_roles_delete').val(respuesta['roles_delete']);

				$('#edit_pasante_view').val(respuesta['pasante_view']);
				$('#edit_pasante_edit').val(respuesta['pasante_edit']);
				$('#edit_pasante_delete').val(respuesta['pasante_delete']);
				
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
			url: '../script/editar_roles1.php',
			data: $('#formulario2').serialize(),
			dataType: "JSON",
			success: function(respuesta) {
				console.log(respuesta);
				if(respuesta == 0){
					Swal.fire({
						position: 'center',
						icon: 'error',
						title: 'Error en registro...!',
						showConfirmButton: true,
						timer: 3000
					})
				}

				if(respuesta != 0){
					const swalWithBootstrapButtons = Swal.mixin({
						customClass: {
							confirmButton: 'btn btn-success mr-2',
						    cancelButton: 'btn btn-primary'
						},
						buttonsStyling: false
					})
					
					swalWithBootstrapButtons.fire({
						title: 'Se ha registrado exitosamente!',
						text: "Desea volver a la consulta o desea crear otro registro?",
						icon: 'success',
						position: 'center',
						showConfirmButton: true,
						showCancelButton: true,
						confirmButtonText: 'Otro Registro',
						cancelButtonText: 'Consulta',
					}).then((result) => {
						if (result.value) {
							window.location.href = "crear_cuenta.php";
						} else {
							window.location.href = "index.php";
						}
					})
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	});

</script>
