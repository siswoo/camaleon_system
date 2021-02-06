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
	$ubicacion = "monitores";
	include('../script/navbar_verificacion.php');
	include('../navbar.php');
?>
	<form id="formulario1" method="POST">
		<input type="hidden" id="modelo_view" value="<?php echo $modelo_view; ?>">
		<input type="hidden" id="modelo_edit" value="<?php echo $modelo_edit; ?>">
		<input type="hidden" id="modelo_delete" value="<?php echo $modelo_delete; ?>">
	</form>

	<div class="col-12 text-right mt-3">
		<?php
		if($_SESSION['id']!=3){ ?>
			<input type="submit" class="btn btn-success" value="Nuevo Monitor" data-toggle="modal" data-target="#exampleModal3">
			<input type="submit" class="btn btn-primary ml-3" value="Nuevo Registro" data-toggle="modal" data-target="#exampleModal2">
		<?php } ?>
		<input type="submit" class="btn btn-info ml-3" value="Consultar Filtro" data-toggle="modal" data-target="#exampleModal1">
	</div>

	<div class="seccion1">
	    <div class="row">
		    <div class="container_consulta1">
		    	<table id="example" class="table row-border hover table-bordered" style="font-size: 12px;">
			        <thead>
			            <tr>
			                <th class="text-center">Monitor</th>
			                <th class="text-center">Fecha Asignada</th>
			                <th class="text-center">Tokens</th>
			                <th class="text-center">Turno</th>
			                <th class="text-center">Fecha Registrado</th>
			                <th class="text-center">Opciones</th>
			            </tr>
			        </thead>
			        <tbody id="resultados">
			        	<?php
			        	$consulta2 = "SELECT * FROM monitores_registro_diario";
						$resultado2 = mysqli_query( $conexion, $consulta2 );
						while($row2 = mysqli_fetch_array($resultado2)) {
							$id_mrd 		= $row2['id'];
							$monitor 		= $row2['monitor'];
							$fecha 			= $row2['fecha'];
							$tokens			= $row2['tokens'];
							$turno			= $row2['turno'];
							$fecha_inicio 	= $row2['fecha_inicio'];

							$sql3 = "SELECT * FROM monitores WHERE id = ".$monitor;
							$resultado3 = mysqli_query( $conexion,$sql3);
							while($row3 = mysqli_fetch_array($resultado3)) {
								$nombre_monitor = $row3['nombre']." ".$row3['apellido'];
							}

							echo '
								<tr>
					                <td class="text-center" style="text-transform: capitalize;">'.$nombre_monitor.'</td>
					                <td class="text-center">'.$fecha.'</td>
					                <td class="text-center">'.$tokens.'</td>
					                <td class="text-center">'.$turno.'</td>
					                <td class="text-center">'.$fecha_inicio.'</td>
					                <td class="text-center">
					            ';

					        ?>
								<i class="fas fa-edit" style="color:#0095ff; cursor:pointer;" title="" data-toggle="modal" data-target="#exampleModal" onclick="crud(<?php echo $id_mrd; ?>,'editar');"></i>
								<i class="fas fa-trash-alt ml-3" style="color:red; cursor:pointer;" data-toggle="popover-hover" onclick="crud2(<?php echo $id_mrd; ?>,'eliminar');"></i>
					        <?php

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

</body>
</html>

<!-- Modal Editar -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_editar" style="">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Registro</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row">
					    	<input type="hidden" id="edit_id" name="edit_id" value="">
						    <div class="col-6 form-group form-check">
							    <label for="edit_monitor">Monitor</label>
							    <select id="edit_monitor" name="edit_monitor" class="form-control" required>
							    	<option value="">Seleccione</option>
							    	<?php
							    	$sql1 = "SELECT * FROM monitores";
							    	$consulta1 = mysqli_query($conexion,$sql1);
							    	while($row1 = mysqli_fetch_array($consulta1)) { ?>
							    		<option style="text-transform: capitalize;" value="<?php echo $row1['id']; ?>"><?php echo $row1['nombre']." ".$row1['apellido']; ?></option>
							    	<?php } ?>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_turno">Turno</label>
							    <select class="form-control" id="edit_turno" name="edit_turno" required>
							    	<option value="">Seleccione</option>
							    	<option value="Mañana">Mañana</option>
							    	<option value="Tarde">Tarde</option>
							    	<option value="Noche">Noche</option>
							    </select>
						    </div>
					    </div>

					    <div class="row">
					    	<div class="col-6 form-group form-check">
							    <label for="edit_fecha">Fecha</label>
							    <input type="date" name="edit_fecha" id="edit_fecha" value="" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_tokens">Tokens</label>
							    <input type="text" name="edit_tokens" id="edit_tokens" class="form-control" required>
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
<!-- FIN Modal Editar -->

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
							    <label for="nombre">Nombre</label>
							    <input type="text" name="nombre" id="nombre" value="" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="apellido">Apellido</label>
							    <input type="text" name="apellido" id="apellido" value="" class="form-control" required>
						    </div>
					    </div>

					    <div class="row">
						    <div class="col-6 form-group form-check">
							    <label for="tipo_documento">Tipo Documento</label>
							    <select name="tipo_documento" id="tipo_documento" class="form-control" required>
							    	<option value="">Seleccione</option>
							    	<option value="Cedula de Ciudadania">Cedula de Ciudadania</option>
							    	<option value="Cedula de Extranjeria">Cedula de Extranjeria</option>
							    	<option value="PEP">PEP</option>
							    	<option value="Pasaporte">Pasaporte</option>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="numero_documento">Número Documento</label>
							    <input type="text" name="numero_documento" id="numero_documento" value="" class="form-control" required>
						    </div>
						</div>

						<div class="row">
						    <div class="col-12 form-group form-check">
							    <label for="telefono1">WhatsApp</label>
							    <input type="text" name="telefono1" id="telefono1" value="" class="form-control" required>
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

<!-- Modal Crear Registro -->
	<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_registro" style="">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Nuevo Registro</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row">
					    	<input type="hidden" name="condicion" id="condicion" value="registro">
						    <div class="col-6 form-group form-check">
							    <label for="monitor_registro">Monitor</label>
							    <select id="monitor_registro" name="monitor_registro" class="form-control" required>
							    	<option value="">Seleccione</option>
							    	<?php
							    	$sql1 = "SELECT * FROM monitores";
							    	$consulta1 = mysqli_query($conexion,$sql1);
							    	while($row1 = mysqli_fetch_array($consulta1)) { ?>
							    		<option style="text-transform: capitalize;" value="<?php echo $row1['id']; ?>"><?php echo $row1['nombre']." ".$row1['apellido']; ?></option>
							    	<?php } ?>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="turno_registro">Turno</label>
							    <select class="form-control" id="turno_registro" name="turno_registro" required>
							    	<option value="">Seleccione</option>
							    	<option value="Mañana">Mañana</option>
							    	<option value="Tarde">Tarde</option>
							    	<option value="Noche">Noche</option>
							    </select>
						    </div>
					    </div>

					    <div class="row">
						    <div class="col-6 form-group form-check">
							    <label for="fecha_registro">Fecha</label>
							    <input type="date" id="fecha_registro" name="fecha_registro" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="tokens_registro">Tokens</label>
							    <input type="text" id="tokens_registro" name="tokens_registro" class="form-control" required>
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

<!-- Modal Consultar Registro -->
	<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Consultar por Filtro</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="#" id="formulario_consultar_registro1">
					<div class="row">
						<div class="col-6 form-group form-check">
							<label for="fecha_desde1">Desde</label>
							<input type="date" id="fecha_desde1" name="fecha_desde1" class="form-control" required>
						</div>
						<div class="col-6 form-group form-check">
							<label for="fecha_hasta1">Hasta</label>
							<input type="date" id="fecha_hasta1" name="fecha_hasta1" class="form-control" required>
						</div>
						<div class="col-6 form-group form-check">
							<label for="turno1">Turno</label>
							<select class="form-control" id="turno1" name="turno1">
								<option value="">Seleccione</option>
								<option value="Mañana">Mañana</option>
								<option value="Tarde">Tarde</option>
								<option value="Noche">Noche</option>
							</select>
						</div>
						<div class="col-6 form-group form-check">
							<label for="monitor1">Monitor</label>
							<select id="monitor1" name="monitor1" class="form-control" required>
								<option value="">Seleccione</option>
							    <?php
							    $sql1 = "SELECT * FROM monitores";
							    $consulta1 = mysqli_query($conexion,$sql1);
							    while($row1 = mysqli_fetch_array($consulta1)) { ?>
							    	<option style="text-transform: capitalize;" value="<?php echo $row1['id']; ?>"><?php echo $row1['nombre']." ".$row1['apellido']; ?></option>
							    <?php } ?>
							</select>
						</div>
						<div class="col-12 form-group form-check" id="respuesta1"></div>
					</div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" class="btn btn-success">Consultar</button>
			      	</div>
		      	</form>
	    	</div>
	  	</div>
	</div>
<!-- FIN Modal Consultar Registro -->

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
    });
});


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

$("#form_modal_nuevo").on("submit", function(e){
	e.preventDefault();
	var f = $(this);
	   $.ajax({
		type: 'POST',
		url: '../script/guardar_monitores2.php',
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

$("#form_modal_registro").on("submit", function(e){
	e.preventDefault();
	var f = $(this);
	   $.ajax({
		type: 'POST',
		url: '../script/crud_monitores_diarios.php',
		data: $('#form_modal_registro').serialize(),
		dataType: "JSON",

		success: function(respuesta) {
			console.log(respuesta);
			window.location.href = "index.php";
		},

		error: function(respuesta) {
			console.log(respuesta['responseText']);
		}
	});
});

function crud (variable,condicion) {
	$.ajax({
		type: 'POST',
		url: '../script/crud_monitores_diarios.php',
		dataType: "JSON",
		data: {
			"variable": variable,
			"condicion": condicion,
		},

		success: function(respuesta) {
			console.log(respuesta);
			if(condicion == 'editar'){
				$('#edit_id').val(respuesta['id']);
				$('#edit_monitor').val(respuesta['monitor']);
				$('#edit_fecha').val(respuesta['fecha']);
				$('#edit_tokens').val(respuesta['tokens']);
				$('#edit_turno').val(respuesta['turno']);
			}
		},

		error: function(respuesta) {
			console.log(respuesta['responseText']);
		}
	});
}

function crud2 (variable,condicion) {
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
		if(result.value){
			$.ajax({
				type: 'POST',
				url: '../script/crud_monitores_diarios.php',
				dataType: "JSON",
				data: {
					"variable": variable,
					"condicion": condicion,
				},

				success: function(respuesta) {
					console.log(respuesta);
				},

				error: function(respuesta) {
					console.log(respuesta['responseText']);
				}
			});
		  }
	});
}

$("#form_modal_editar").on("submit", function(e){
	e.preventDefault();
	var id = $('#edit_id').val();
	var monitor = $('#edit_monitor').val();
	var fecha = $('#edit_fecha').val();
	var tokens = $('#edit_tokens').val();
	var turno = $('#edit_turno').val();
	var condicion = 'actualizar';
	$.ajax({
		type: 'POST',
		url: '../script/crud_monitores_diarios.php',
		dataType: "JSON",
		data: {
			"id": id,
			"monitor": monitor,
			"fecha": fecha,
			"tokens": tokens,
			"turno": turno,
			"condicion": condicion,
		},

		success: function(respuesta) {
			console.log(respuesta);
			window.location.href = "index.php";
		},

		error: function(respuesta) {
			console.log(respuesta['responseText']);
		}
	});
});

$("#formulario_consultar_registro1").on("submit", function(e){
	e.preventDefault();
	var fecha_desde = $('#fecha_desde1').val();
	var fecha_hasta = $('#fecha_hasta1').val();
	var monitor = $('#monitor1').val();
	var turno = $('#turno1').val();
	var condicion = 'consultar1';
	$.ajax({
		type: 'POST',
		url: '../script/crud_monitores_diarios.php',
		dataType: "JSON",
		data: {
			"fecha_desde": fecha_desde,
			"fecha_hasta": fecha_hasta,
			"monitor": monitor,
			"turno": turno,
			"condicion": condicion,
		},

		success: function(respuesta) {
			console.log(respuesta);
			$('#respuesta1').html(respuesta['html']);
		},

		error: function(respuesta) {
			console.log(respuesta['responseText']);
		}
	});
});

</script>