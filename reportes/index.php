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
	$ubicacion = "reportes";
	include('../script/navbar_verificacion.php');
	include('../navbar.php');
?>
	<form id="formulario1" method="POST">
		<input type="hidden" id="modelo_view" value="<?php echo $modelo_view; ?>">
		<input type="hidden" id="modelo_edit" value="<?php echo $modelo_edit; ?>">
		<input type="hidden" id="modelo_delete" value="<?php echo $modelo_delete; ?>">
	</form>

	<div class="seccion1">
	    <div class="row-fluid">
	    	<div class="col-12">
	    		<button class="btn btn-primary" value="turno" onclick="desplegables(value);">Reporte Turno</button>
	    	</div>
		</div>
	</div>

	<div class="seccion2 mt-3" id="seccion2" style="display: none;">
		<div class="row-fluid">
			<div class="col-12">
				<h2>Reporte de Turno</h2>
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

	

	/*function buscarModelo2(){
		var value = $('#searchmodelos').val();
		var cantidad = value.length;

		if(cantidad<=3){
			$('#seccion2').show('slow');
			$('#seccion2').html('<div class="col-12 text-center" style="font-weight:bold; font-size: 20px;">Debe colocar datos existentes en la Base de Datos</div>');
			return false;
		}

		$.ajax({
			type: 'POST',
			url: '../script/buscar_modelo2.php',
            dataType: "JSON",
			data: {
				"value": value,
			},

			success: function(respuesta) {
				//console.log(respuesta['html']);
				if(respuesta['contador1']>=1){
					$('#seccion2').show('slow');
					$('#seccion2').html(respuesta['html']);
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}*/


	function desplegables(value){
		//console.log(value);
		$('#seccion2').hide('slow');
		$.ajax({
			type: 'POST',
			url: '../script/reporte_turno1.php',
            dataType: "JSON",
			data: {
				"value": value,
			},

			beforeSend: function(){
				$('#seccion2').show('slow');
				$('#seccion2').html("<img src='../img/icons/spinner.gif' />");
			},

			success: function(respuesta) {
				console.log(respuesta['value']);
				$('#seccion2').html(respuesta['html']);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function buscarModelo(value,fila){
		var cantidad = value.length;
		if(cantidad<=3){
			$('#listamodelos_'+fila).html('ok');
			return false;
		}
		$.ajax({
			type: 'POST',
			url: '../script/buscar_modelo3.php',
            dataType: "JSON",
			data: {
				"value": value,
			},

			success: function(respuesta) {
				if(respuesta['contador1']>=1){
					$('#listamodelos_'+fila).html(respuesta['html']);
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

</script>
