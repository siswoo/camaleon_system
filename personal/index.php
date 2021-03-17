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
	$ubicacion = "personal";
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

	<div class="row mt-3 mb-3 text-center">
		<div class="col-3 form-group form-check">
			<label for="turno1">Turno</label>
			<select class="form-control" name="turno1" id="turno1">
				<option value="Mañana">Mañana</option>
				<option value="Tarde">Tarde</option>
				<option value="Noche">Noche</option>
			</select>
		</div>
		<div class="col-3 form-group form-check">
			<label for="turno1">Fecha</label>
			<input type="date" class="form-control" name="fecha1" id="fecha1" value="<?php echo date('Y-m-d'); ?>">
		</div>
		<div class="col-3">
			<label for="condicion1">Condición</label>
			<select class="form-control" name="condicion1" id="condicion1">
				<option value="Consultar">Consultar</option>
				<option value="Agregar">Agregar</option>
			</select>
		</div>
		<div class="col-3 mt-4">
			<button type="button" class="btn btn-primary" onclick="consultar1();">Consultar</button>
		</div>
	</div>

	<div class="seccion1">
	    <div class="row">
		    <div class="container_consulta1">
		    	<table id="example" class="table row-border hover table-bordered" style="font-size: 12px; color:rgba(50,55,66,1); border-radius: 5px;">
			        <thead>
			            <tr>
			                <th class="text-center">Nombre</th>
			                <th class="text-center">Turno</th>
			                <th class="text-center">Fecha</th>
			                <th class="text-center">Observación</th>
			                <th class="text-center">Fotos</th>
			                <th class="text-center">Nickname</th>
			                <th class="text-center">Estatus</th>
			                <th class="text-center">Opciones</th>
			            </tr>
			        </thead>
			        <tbody id="resultados"></tbody>
			    </table>
		    </div>
		</div>
	</div>
</body>
</html>

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

	function consultar1(){
		var turno = $('#turno1').val();
		var fecha = $('#fecha1').val();
		var condicion1 = $('#condicion1').val();

		if(turno=='' || fecha==''){
			Swal.fire({
			  title: 'Cuidado!',
			  text: "Colocar campos validos",
			  icon: 'warning',
			  showConfirmButton: false,
			  showCancelButton: false,
			});
			return false;
		}

		$.ajax({
			type: 'POST',
			url: '../script/crud_personal.php',
			dataType: "JSON",
			data: {
				"turno": turno,
				"fecha": fecha,
				"condicion1": condicion1,
				"condicion": 'consultar1',
			},

			success: function(respuesta) {
				console.log(respuesta);
				$('#example').DataTable().destroy();
				$('#resultados').html(respuesta['html']);
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
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function guardar1(id_modelo){
		var nombre = $('#nombre_'+id_modelo).val();
		var turno = $('#turno_'+id_modelo).val();
		var fecha_inicio = $('#fecha_inicio_'+id_modelo).val();
		var observacion = $('#observacion_'+id_modelo).val();
		var fotos = $('#fotos_'+id_modelo).val();
		var nickname = $('#nickname_'+id_modelo).val();
		var estatus = $('#estatus_'+id_modelo).val();
		var fecha = $('#fecha1').val();

		if(observacion=='' || fotos=='' || estatus==''){
			Swal.fire({
			  title: 'Cuidado!',
			  text: "Completar los campos de esta fila",
			  icon: 'warning',
			  showConfirmButton: false,
			  showCancelButton: false,
			});
			return false;
		}

		$.ajax({
			type: 'POST',
			url: '../script/crud_personal.php',
			dataType: "JSON",
			data: {
				"id_modelo": id_modelo,
				"nombre": nombre,
				"turno": turno,
				"fecha_inicio": fecha_inicio,
				"observacion": observacion,
				"fotos": fotos,
				"nickname": nickname,
				"estatus": estatus,
				"fecha": fecha,
				"condicion": 'guardar1',
			},

			success: function(respuesta) {
				console.log(respuesta);
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Modificado Correctamente',
					showConfirmButton: true,
					timer: 3000
				})
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function cambiar_estatus1(id_modelo){
		var fecha = $('#fecha1').val();
		$.ajax({
			type: 'POST',
			url: '../script/crud_personal.php',
			dataType: "JSON",
			data: {
				"id_modelo": id_modelo,
				"fecha": fecha,
				"condicion": 'estatus1',
			},

			success: function(respuesta) {
				console.log(respuesta);
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Modificado Correctamente',
					showConfirmButton: true,
					timer: 3000
				})
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

</script>
