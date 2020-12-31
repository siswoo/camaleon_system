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
	$ubicacion = "community";
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
	    	<div class="col-12 text-center">
	    		<button class="btn btn-info" id="enterados" value="No" onclick="mostrarseccion1(this.id,value);">Estadisticas de Enterados</button>
	    	</div>
		</div>
	</div>

	<div class="seccion1">
		<div class="row" id="div_enterados" style="display: none;">
			<div class="col-12 mb-3 text-center">
				<span style="font-weight: bold; font-size: 17px;">Total Pasantes: </span>
				<span id="span_total1">0</span>
			</div>
			<!--
			<div class="col-3 mb-3">
				Google: 
				<span id="span_google1">0</span>
				 | 
				<span id="span_google2">0</span>
			</div>
			-->
			<div class="col-3 mb-3">
				Facebook: 
				<span id="span_facebook1">0</span>
				 | 
				<span id="span_facebook2">0</span>
			</div>
			<div class="col-3 mb-3">
				Twitter: 
				<span id="span_twitter1">0</span>
				 | 
				<span id="span_twitter2">0</span>
			</div>
			<div class="col-3 mb-3">
				Instagram: 
				<span id="span_instagram1">0</span>
				 | 
				<span id="span_instagram2">0</span>
			</div>
			<div class="col-3 mb-3">
				Pagina Web: 
				<span id="span_pw1">0</span>
				 | 
				<span id="span_pw2">0</span>
			</div>
			<div class="col-3 mb-3">
				Conocido: 
				<span id="span_conocido1">0</span>
				 | 
				<span id="span_conocido2">0</span>
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

	$('#myModal').on('shown.bs.modal', function () {
	  	$('#myInput').trigger('focus')
	});

	function mostrarseccion1(button,value){
		//console.log(button);
		$.ajax({
			type: 'POST',
			url: '../script/community_enterados1.php',
			data: {"value": value},
			dataType: "JSON",
			success: function(respuesta) {
				//console.log(respuesta);
				$('#span_total1').html(respuesta['suma']);

				//$('#span_google1').html(respuesta['contador_google']);
				$('#span_facebook1').html(respuesta['contador_facebook']);
				$('#span_twitter1').html(respuesta['contador_twitter']);
				$('#span_instagram1').html(respuesta['contador_instagram']);
				$('#span_pw1').html(respuesta['contador_pw']);
				$('#span_conocido1').html(respuesta['contador_conocido']);

				$('#span_google2').html(respuesta['porcentaje_google']+'%');
				$('#span_facebook2').html(respuesta['porcentaje_facebook']+'%');
				$('#span_twitter2').html(respuesta['porcentaje_twitter']+'%');
				$('#span_instagram2').html(respuesta['porcentaje_instagram']+'%');
				$('#span_pw2').html(respuesta['porcentaje_pw']+'%');
				$('#span_conocido2').html(respuesta['porcentaje_conocido']+'%');

				if(value=='Si'){
					$('#div_'+button).hide('slow');
					$('#'+button).val('No');
				}else{
					$('#div_'+button).show('slow');
					$('#'+button).val('Si');
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

</script>
