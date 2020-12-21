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
	$ubicacion = "pqr";
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
	include('nabvar_modelo.php');
?>
	<div class="seccion1">
	    <div class="row">
	    	<div class="col-12 text-center">
	    		<span style="font-weight: bold; font-size: 25px;">SECCIÓN PQR</span>
	    	</div>

	    	<?php
	    	$usuario = $_SESSION["usuario"];
	    	$sql1 = "SELECT * FROM modelos WHERE usuario = '".$usuario."'";
			$consulta1 = mysqli_query($conexion,$sql1);
			while($row = mysqli_fetch_array($consulta1)) {
				$id_modelo = $row['id'];
			}
			?>

	    	<input type="hidden" id="id_modelo" name="id_modelo" value="<?php echo $id_modelo; ?>">

	    	<div class="col-4 mt-3">&nbsp;</div>
			<div class="col-4 mt-3">
				<label form="mensaje" style="font-size: 20px;">Mensaje del Problema Sugerencia o Duda</label>
	    		<textarea id="mensaje" name="mensaje" class="form-control"></textarea>
	    	</div>
	    	<div class="col-4 mt-3">&nbsp;</div>

	    	<div class="col-4 mt-3">&nbsp;</div>
	    	<div class="col-4 mt-3">
				<label form="tema" style="font-size: 20px;">Tema Referente al Ticket</label>
	    		<select name="tema" id="tema" class="form-control" required>
	    			<option value="">Seleccione</option>
	    			<option value="Problema">Problema</option>
	    			<option value="Sugerencia">Sugerencia</option>
	    			<option value="Duda con mi Desprendible">Duda con mi Desprendible</option>
	    		</select>
	    	</div>
	    	<div class="col-4 mt-3">&nbsp;</div>

	    	<div class="col-12 mt-3 text-center">
	    		<button class="btn btn-success" onclick="enviarpqr1();">Enviar PQR</button>
	    	</div>
		</div>
	</div>

<?php include('../footer.php'); ?>

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

	function enviarpqr1(){
		var id_modelo = $('#id_modelo').val();
		var mensaje = $('#mensaje').val();
		var tema = $('#tema').val();
		condicion = 'guardar';
		if(mensaje=='' || tema==''){
			Swal.fire({
				position: 'center',
				title: 'Error',
				text: 'Por favor llenar todos los campos',
				icon: 'error',
				showConfirmButton: true,
			})
			return false;
		}
		$.ajax({
			type: 'POST',
			url: '../script/crud_pqr.php',
			data: {
				"id_modelo": id_modelo,
				"mensaje": mensaje,
				"tema": tema,
				"condicion": condicion,
			},
			dataType: "JSON",
			success: function(respuesta) {
				//console.log(respuesta);
				Swal.fire({
					position: 'center',
					title: 'Perfecto',
					text: 'Se ha generado el Ticket satisfactoriamente',
					icon: 'success',
					showConfirmButton: true,
				});
				$('#mensaje').val('');
				$('#tema').val('');
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

</script>
