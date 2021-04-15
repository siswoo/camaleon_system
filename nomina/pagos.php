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
	    	<div class=""><form></div>
	    	<div class="col-12 mb-3 text-center" style="font-size: 20px; font-weight: bold;">ASIGNAR PAGOS</div>
	    	<div class="col-4 mb-3 form-group form-check">
	    		<label for="c_inicio">Fecha Inicio</label>
	    		<input type="date" id="c_inicio" name="c_inicio" class="form-control" required>
	    	</div>
	    	<div class="col-4 mb-3 form-group form-check">
	    		<label for="c_fin">Fecha Fin</label>
	    		<input type="date" id="c_fin" name="c_fin" class="form-control" required>
	    	</div>
	    	<div class="col-4 mb-3 text-center form-group form-check">
	    		<button type="submit" class="btn btn-info">Consultar</button>
	    		<button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal1">Nuevo Pago</button>
	    	</div>
	    	<div class=""></form></div>
		</div>
	</div>

	<div id="consulta1" style="/*display: none;*/">
		<table id="example" class="table row-border hover table-bordered" style="font-size: 12px; color:rgba(50,55,66,1); border-radius: 5px;">
			<thead>
			    <tr>
			        <th class="text-center">Nombre</th>
			        <th class="text-center">Tipo Doc</th>
			        <th class="text-center">Num Doc</th>
			        <th class="text-center">Salario</th>
			        <th class="text-center">Bonos</th>
			        <th class="text-center">Multas</th>
			        <th class="text-center">Inicio</th>
			        <th class="text-center">Fin</th>
			        <th class="text-center">Fecha Inicio</th>
			        <th class="text-center">Opciones</th>
			    </tr>
			</thead>
			<tbody id="resultados">
			<?php
			if($_SESSION["rol"]==1){
				$sql1 = "SELECT * FROM n_pagos";
			}else{
				$sql1 = "SELECT * FROM n_pagos WHERE sede = ".$_SESSION["sede"];
			}
			$consulta1 = mysqli_query($conexion,$sql1);
			while($row1 = mysqli_fetch_array($consulta1)) {
			    $id = $row1['id'];
			    $id_nomina = $row1['id_nomina'];
			    $salario = $row1['salario'];
			    $bonos = $row1['bonos'];
			    $multas = $row1['multas'];
			    $inicio = $row1['inicio'];
			    $fin = $row1['fin'];
			    $fecha_inicio = $row1['fecha_inicio'];
			    $estatus = $row1['estatus'];

			    $sql2 = "SELECT * FROM nomina WHERE id = ".$id_nomina;
			    $consulta2 = mysqli_query($conexion,$sql2);
				while($row2 = mysqli_fetch_array($consulta2)) {
					$nomina_nombre = $row2["nombre"]." ".$row2["apellido"];
					$nomina_documento_tipo = $row2["documento_tipo"];
					$nomina_documento_numero = $row2["documento_numero"];
				}

			    echo '
					<tr id="tr_'.$id.'">
			        	<td class="text-center" id="nombre_nomina_'.$id.'">'.$nomina_nombre.'</td>
			        	<td class="text-center" id="documento_tipo_nomina_'.$id.'">'.$nomina_documento_tipo.'</td>
			        	<td class="text-center" id="documento_numero_nomina_'.$id.'">'.$nomina_documento_numero.'</td>
			        	<td class="text-center" id="salario_'.$id.'">'.$salario.'</td>
			        	<td class="text-center" id="bonos_'.$id.'">'.$bonos.'</td>
			        	<td class="text-center" id="multas_'.$id.'">'.$multas.'</td>
			        	<td class="text-center" id="inicio_'.$id.'">'.$inicio.'</td>
			        	<td class="text-center" id="fin_'.$id.'">'.$fin.'</td>
			        	<td class="text-center" id="fecha_inicio_'.$id.'">'.$fecha_inicio.'</td>
			        	<td class="text-center" nowrap="nowrap">
			        		<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2" onclick="editar1('.$id.');">Editar</button>
			        		<button class="btn btn-primary" onclick="eliminar1('.$id.');">Eliminar</button>
			    ';
			    	if($estatus=="Proceso"){
			    		echo '
			        		<button class="btn btn-success" id="validar_'.$id.'" onclick="validar1('.$id.');">Validar</button>
			        	';
			    	}else{
			    		echo '
			        		<button class="btn btn-danger" id="cancelar_'.$id.'" onclick="cancelar1('.$id.');">Cancelar</button>
			        	';		
			    	}

			    echo '
			        	</td>
			        </tr>
			    ';
			}
			?>
			</tbody>
		</table>
	</div>
</body>
</html>

<!-- Modal Crear Registro -->
	<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_new" style="">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Nuevo Pago</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row">
					    	<input type="hidden" id="nomina_id" name="nomina_id">
						    <div class="col-12 form-group form-check">
							    <label for="buscar_nomina">Persona</label>
						    	<input type="search" name="extra_modelo" id="extra_modelo" list="listamodelos" class="form-control" onkeyup="buscar_nomina1(value);" autocomplete="off" required>
				    			<datalist id="listamodelos"><option></option></datalist>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="nombre">Nombre </label>
							    <input type="text" name="nombre" id="nombre" class="form-control" disabled>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="apellido">Apellido </label>
							    <input type="text" name="apellido" id="apellido" class="form-control" disabled>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="documento_tipo">Documento Tipo</label>
							    <input type="text" name="documento_tipo" id="documento_tipo" class="form-control" disabled>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="documento_numero">Documento Número</label>
							    <input type="text" name="documento_numero" id="documento_numero" class="form-control" disabled>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="cargo">Cargo</label>
							    <input type="text" name="cargo" id="cargo" class="form-control" disabled>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="funcion">Función</label>
							    <input type="text" name="funcion" id="funcion" class="form-control" disabled>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="salario">Salario</label>
							    <input type="text" name="salario" id="salario" class="form-control" disabled>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="inasistencia">Inasistencias</label>
							    <input type="number" name="inasistencia" id="inasistencia" class="form-control">
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="descuento">Descuento</label>
							    <input type="number" name="descuento" id="descuento" class="form-control">
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="bonos">Bonos</label>
							    <input type="number" name="bonos" id="bonos" class="form-control">
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="inicio">Inicio</label>
							    <input type="date" name="inicio" id="inicio" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="fin">Fin</label>
							    <input type="date" name="fin" id="fin" class="form-control" required>
						    </div>
					    </div>
					</div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" class="btn btn-success" id="submit_guardar1" disabled>Guardar</button>
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
							    <label for="edit_nombre">Nombre </label>
							    <input type="text" name="edit_nombre" id="edit_nombre" class="form-control" disabled>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_apellido">Apellido </label>
							    <input type="text" name="edit_apellido" id="edit_apellido" class="form-control" disabled>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_documento_tipo">Documento Tipo</label>
							    <input type="text" name="edit_documento_tipo" id="edit_documento_tipo" class="form-control" disabled>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_documento_numero">Documento Número</label>
							    <input type="text" name="edit_documento_numero" id="edit_documento_numero" class="form-control" disabled>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_salario">Salario</label>
							    <input type="text" name="edit_salario" id="edit_salario" class="form-control" disabled>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_inasistencia">Inasistencias</label>
							    <input type="number" name="edit_inasistencia" id="edit_inasistencia" class="form-control">
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_descuento">Descuento</label>
							    <input type="number" name="edit_descuento" id="edit_descuento" class="form-control">
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_bonos">Bonos</label>
							    <input type="number" name="edit_bonos" id="edit_bonos" class="form-control">
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_inicio">Inicio</label>
							    <input type="date" name="edit_inicio" id="edit_inicio" class="form-control" disabled>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_fin">Fin</label>
							    <input type="date" name="edit_fin" id="edit_fin" class="form-control" disabled>
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
		var inicio 		= $('#inicio').val();
		var fin  		= $('#fin').val();

	    $.ajax({
			type: 'POST',
			url: '../script/crud_pagos_nomina.php',
			data: {
				"fin": fin,
				"inicio": inicio,
				"condicion": "consultar1",
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

					/*
					$("#exampleModal3").modal('hide');
					$('#exampleModal3').removeClass('modal-open');
					$('.modal-backdrop').remove();
					*/
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	});

	function buscar_nomina1(value){
		var cantidad = value.length;
		if(cantidad<=3){
			$('#listamodelos').html('ok');
			return false;
		}
		$.ajax({
			type: 'POST',
			url: '../script/crud_pagos_nomina.php',
            dataType: "JSON",
			data: {
				"value": value,
				"condicion": "consultar2",
			},

			success: function(respuesta) {
				console.log(respuesta);
				if(respuesta["estatus"]=="especifico"){
					$('#listamodelos').html("");
					$('#nomina_id').val(respuesta["nomina_id"]);
					$('#nombre').val(respuesta["nombre"]);
					$('#apellido').val(respuesta["apellido"]);
					$('#documento_tipo').val(respuesta["documento_tipo"]);
					$('#documento_numero').val(respuesta["documento_numero"]);
					$('#cargo').val(respuesta["cargo"]);
					$('#funcion').val(respuesta["funcion"]);
					$('#salario').val(respuesta["salario"]);
					$('#submit_guardar1').removeAttr('disabled');
				}else if(respuesta["estatus"]=="ok"){
					$('#listamodelos').html(respuesta['html']);
					$('#submit_guardar1').attr('disabled','true');
				}else if(respuesta["estatus"]=="sin resultados"){
					$('#submit_guardar1').attr('disabled','true');
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	$("#form_modal_new").on("submit", function(e){
		e.preventDefault();
		var f = $(this);
		var nomina_id 		= $('#nomina_id').val();
		var salario  		= $('#salario').val();
		var inasistencia  	= $('#inasistencia').val();
		var descuento  		= $('#descuento').val();
		var bonos  			= $('#bonos').val();
		var inicio  		= $('#inicio').val();
		var fin  			= $('#fin').val();

	    $.ajax({
			type: 'POST',
			url: '../script/crud_pagos_nomina.php',
			dataType: "JSON",
			data: {
				"nomina_id": nomina_id,
				"salario": salario,
				"inasistencia": inasistencia,
				"descuento": descuento,
				"bonos": bonos,
				"inicio": inicio,
				"fin": fin,
				"condicion": "guardar1",
			},

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
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	});

	function editar1(id){
		$.ajax({
			type: 'POST',
			url: '../script/crud_pagos_nomina.php',
			dataType: "JSON",
			data: {
				"id": id,
				"condicion": "consultar3",
			},

			success: function(respuesta) {
				console.log(respuesta);
				$('#edit_id').val(id);
				$('#edit_nombre').val(respuesta["nombre"]);
				$('#edit_apellido').val(respuesta["apellido"]);
				$('#edit_documento_tipo').val(respuesta["documento_tipo"]);
				$('#edit_documento_numero').val(respuesta["documento_numero"]);
				$('#edit_salario').val(respuesta["salario"]);
				$('#edit_inasistencia').val(respuesta["inasistencia"]);
				$('#edit_descuento').val(respuesta["multas"]);
				$('#edit_bonos').val(respuesta["bonos"]);
				$('#edit_inicio').val(respuesta["inicio"]);
				$('#edit_fin').val(respuesta["fin"]);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	$("#form_modal_edit").on("submit", function(e){
		e.preventDefault();
		var f = $(this);
		var id 		= $('#edit_id').val();
		var salario  		= $('#edit_salario').val();
		var inasistencia  	= $('#edit_inasistencia').val();
		var descuento  		= $('#edit_descuento').val();
		var bonos  			= $('#edit_bonos').val();

	    $.ajax({
			type: 'POST',
			url: '../script/crud_pagos_nomina.php',
			dataType: "JSON",
			data: {
				"id": id,
				"salario": salario,
				"inasistencia": inasistencia,
				"descuento": descuento,
				"bonos": bonos,
				"condicion": "editar1",
			},

			success: function(respuesta) {
				console.log(respuesta);
				Swal.fire({
	 				title: 'Modificado Correctamente!',
	 				text: "Redirigiendo...",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: false,
	 				confirmButtonColor: '#3085d6',
	 				confirmButtonText: 'No esperar!',
	 				timer: 3000
				});
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	});

	function eliminar1(id){
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
					url: '../script/crud_pagos_nomina.php',
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
						console.log(respuesta['responseText']);
					}
				});
			}
		})
	}

	function validar1(id){
		$.ajax({
			type: 'POST',
			url: '../script/crud_pagos_nomina.php',
			dataType: "JSON",
			data: {
				"id": id,
				"condicion": "validar1",
			},

			success: function(respuesta) {
				console.log(respuesta);
				Swal.fire({
	 				title: 'Modificado Correctamente!',
	 				text: "Redirigiendo...",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: false,
	 				confirmButtonColor: '#3085d6',
	 				confirmButtonText: 'No esperar!',
	 				timer: 3000
				});
				window.location.href = "pagos.php";
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function cancelar1(id){
		$.ajax({
			type: 'POST',
			url: '../script/crud_pagos_nomina.php',
			dataType: "JSON",
			data: {
				"id": id,
				"condicion": "cancelar1",
			},

			success: function(respuesta) {
				console.log(respuesta);
				Swal.fire({
	 				title: 'Modificado Correctamente!',
	 				text: "Redirigiendo...",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: false,
	 				confirmButtonColor: '#3085d6',
	 				confirmButtonText: 'No esperar!',
	 				timer: 3000
				});
				window.location.href = "pagos.php";
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}




</script>







