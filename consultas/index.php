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
	<link href="../resources/lightbox/dist/css/lightbox.css" rel="stylesheet">
	<title>Camaleon Sistem</title>
</head>
<style type="text/css">
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
	$ubicacion = "consultas";
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
	
	<div class="row">
		<div class="col-12 mt-3 text-center" style="font-weight: bold; font-size: 30px; text-transform: uppercase;">
			Consultar Tablas de Porcentajes
		</div>

		<div class="col-12">
			<form id="formulario_guiaRut" action="../script/consultar_porcentajes1.php" method="POST">
		</div>

		<div class="col-3 mt-3 text-center">
			<input type="date" name="fecha_desde_guiaRut" id="fecha_desde_guiaRut" class="form-control">
		</div>
		
		<div class="col-3 mt-3 text-center">
			<input type="date" name="fecha_hasta_guiaRut" id="fecha_hasta_guiaRut" class="form-control">
		</div>

		<input type="hidden" name="sede_guiaR" id="sede_guiaR" value="<?php echo $_SESSION['sede']; ?>">
		
		<div class="col-3 mt-3 text-center">
			<select class="form-control" id="descargable_guiaR" name="descargable_guiaR">
				<option value="No">No</option>
				<option value="Si">Si</option>
		   	</select>
		</div>
		
		<div class="col-3 mt-3 text-center">
			<button type="button" class="btn btn-info" id="submit_guiaR" onclick="generar_consulta1();">Generar Consulta</button>
		</div>

		<div class="col-12">
		   	</form>
		</div>

		<div class="col-12 text-center" style="margin-top: 5rem;">
		    <table id="example" class="table row-border hover table-bordered" style="font-size: 12px; width: 90%;">
				<thead>
				    <tr>
				    	<th class="text-center">Opciones</th>
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
	</div>

	<div class="row mt-3">
		<div class="col-12 mt-3 text-center" style="font-weight: bold; font-size: 30px; text-transform: uppercase;">
			Consultar Desprendibles ACTIVOS
		</div>

		<div class="col-12">
			<form id="form_desprendibles1" action="../script/consultar_porcentajes2.php" method="POST" target="_blank">
		</div>

		<div class="col-9 ml-2">
			<select name="desprendible_select1" id="desprendible_select1" class="form-control" required>
				<option value="">Seleccione</option>
				<?php
				$sql1 = "SELECT * FROM presabana WHERE inicio >= '2021-01-01' GROUP BY inicio ORDER BY inicio";
				$consulta1 = mysqli_query($conexion,$sql1);
				while($row1 = mysqli_fetch_array($consulta1)) { ?>
					<option value="<?php echo $row1['inicio']; ?>">Desde <?php echo $row1['inicio']; ?> Hasta <?php echo $row1['fin']; ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-2">
			<button type="submit" class="btn btn-info" id="desprendible_consultar1">Consultar</button>
		</div>
		<div class="col-12">
			</form>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-12 mt-3 text-center" style="font-weight: bold; font-size: 30px; text-transform: uppercase;">
			Consultar Desprendibles INACTIVOS
		</div>

		<div class="col-12">
			<form id="form_desprendibles1" action="../script/consultar_porcentajes3.php" method="POST" target="_blank">
		</div>

		<div class="col-9 ml-2">
			<select name="desprendible_select2" id="desprendible_select2" class="form-control" required>
				<option value="">Seleccione</option>
				<?php
				$sql1 = "SELECT * FROM presabana_inactivos WHERE inicio >= '2021-01-01' GROUP BY inicio ORDER BY inicio";
				$consulta1 = mysqli_query($conexion,$sql1);
				while($row1 = mysqli_fetch_array($consulta1)) { ?>
					<option value="<?php echo $row1['inicio']; ?>">Desde <?php echo $row1['inicio']; ?> Hasta <?php echo $row1['fin']; ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-2">
			<button type="submit" class="btn btn-info" id="desprendible_consultar2">Consultar</button>
		</div>
		<div class="col-12">
			</form>
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
<script src="../resources/lightbox/dist/js/lightbox.js"></script>

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

	$('#myModal').on('shown.bs.modal', function () {
	  	$('#myInput').trigger('focus')
	});

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
            url: '../script/consultar_porcentajes1.php',
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

    /*
    function consulta2(){
    	var select = $('#desprendible_select1').val();
    	if(select==''){
    		Swal.fire({
			 	title: 'Error',
				text: "Coloca una opción por favor",
				icon: 'error',
				position: 'center',
				showConfirmButton: false,
				timer: 3000
			});
			return false;
    	}

    	$.ajax({
            url: '../script/consultar_porcentajes2.php',
            type: 'POST',
            data: {
				"inicio": select,
			},

            beforeSend: function (){
            	$('#desprendible_consultar1').attr('disabled','true');
            },

            success: function(response){
            	console.log(response);
            	$('#desprendible_consultar1').removeAttr('disabled');
            },

            error: function(response){
            	console.log(response['responseText']);
            	$('#desprendible_consultar1').removeAttr('disabled');
            }
        });
    }
    */

</script>
