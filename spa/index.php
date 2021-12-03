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
	$ubicacion = "spa";
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
	    	<div class="col-12 mb-3 text-center">
				<button type="button" class="btn btn-primary" onclick="mostrar1('efectivo');">Efectivos</button>
				<button type="button" class="btn btn-primary" onclick="mostrar1('app');">App</button>
			</div>

		    <div class="col-12 div_efectivo" style="display: none;">
		    	<div class="col-12 mt-3 mb-3 text-center" style="font-size: 20px; font-weight: bold;">
		    		Consulta de Efectivos
		    	</div>
		    	<table id="example" class="table row-border hover table-bordered" style="font-size: 12px; color:rgba(50,55,66,1); border-radius: 5px;">
			        <thead>
			            <tr>
			                <th class="text-center">ID</th>
			                <th class="text-center">Concepto</th>
			                <th class="text-center">Total</th>
			                <th class="text-center">Fecha Asignada</th>
			            </tr>
			        </thead>
			        <tbody id="resultados">
			        	<?php
			        		include('../script/conexion3.php');
			        		$sql1 = "SELECT * FROM efectivos";
			        		$consulta1 = mysqli_query($conexion3,$sql1);
			        		while($row1 = mysqli_fetch_array($consulta1)) {
			        			$id = $row1['id'];
			        			$tipo = $row1['tipo'];
			        			$total_todo = $row1['total_todo'];
			        			$fecha_creacion = $row1['fecha_creacion'];

			        			echo '
			        				<tr id="tr_'.$id.'">
			        					<td class="text-center" id="id_'.$id.'">'.$id.'</td>
			        					<td class="text-center" id="tipo_'.$id.'">'.$tipo.'</td>
			        					<td class="text-center" id="total_todo_'.$id.'">'.$total_todo.'</td>
			        					<td class="text-center" id="fecha_creacion_'.$id.'">'.$fecha_creacion.'</td>
			        				</tr>
			        			';
			        		}
			        	?>
			        </tbody>
			    </table>
		    </div>

		    <div class="col-12 div_app" style="display: none;">
		    	<div class="col-12 mt-3 mb-3 text-center" style="font-size: 20px; font-weight: bold;">
		    		Consulta de App
		    	</div>
		    	<table id="example2" class="table row-border hover table-bordered" style="font-size: 12px; color:rgba(50,55,66,1); border-radius: 5px;">
			        <thead>
			            <tr>
			                <th class="text-center">ID</th>
			                <th class="text-center">Modelo</th>
			                <th class="text-center">Tipo Documento</th>
			                <th class="text-center">Numero Documento</th>
			                <th class="text-center">Total</th>
			                <th class="text-center">Fecha Asignada</th>
			            </tr>
			        </thead>
			        <tbody>
			        	<?php
			        		$sql1 = "SELECT * FROM usuarios WHERE nombre = 'Spa'";
			        		$consulta1 = mysqli_query($conexion,$sql1);
			        		while($row1 = mysqli_fetch_array($consulta1)) {
			        			$responsable_id = $row1["id"];
			        		}
			        		$sql2 = "SELECT * FROM descuento WHERE responsable = ".$responsable_id;
			        		$consulta2 = mysqli_query($conexion,$sql2);
			        		while($row2 = mysqli_fetch_array($consulta2)) {
			        			$descuento_id = $row2['id'];
			        			$id_modelo = $row2['id_modelo'];
			        			$fecha_inicio = $row2['fecha_inicio'];
			        			$valor2 = $row2['valor'];

			        			$sql3 = "SELECT * FROM modelos WHERE id = ".$id_modelo;
				        		$consulta3 = mysqli_query($conexion,$sql3);
				        		while($row3 = mysqli_fetch_array($consulta3)) {
				        			$modelo_nombre = $row3["nombre1"]." ".$row3["nombre2"]." ".$row3["apellido1"]." ".$row3["apellido2"];
				        			$documento_tipo = $row3["documento_tipo"];
				        			$documento_numero = $row3["documento_numero"];
				        		}

			        			echo '
			        				<tr id="tr2_'.$descuento_id.'">
			        					<td class="text-center" id="descuento_id2_'.$descuento_id.'">'.$descuento_id.'</td>
			        					<td class="text-center" id="modelo_nombre2_'.$descuento_id.'">'.$modelo_nombre.'</td>
			        					<td class="text-center" id="documento_tipo2_'.$descuento_id.'">'.$documento_tipo.'</td>
			        					<td class="text-center" id="documento_numero2_'.$descuento_id.'">'.$documento_numero.'</td>
			        					<td class="text-center" id="total_todo2_'.$descuento_id.'">'.$valor2.'</td>
			        					<td class="text-center" id="fecha_inicio2_'.$descuento_id.'">'.$fecha_inicio.'</td>
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

        	"paging": true,
        	"order": [[ 3, "desc" ]],

    	} );

    	var table = $('#example2').DataTable( {
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

        	"paging": true,
        	"order": [[ 5, "desc" ]],

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

	$("#form_modal_new").on("submit", function(e){
		e.preventDefault();
		var f = $(this);
		var nombre = $('#nombre').val();

	    $.ajax({
			type: 'POST',
			url: '../script/crud_cargos.php',
			data: {
				"nombre": nombre,
				"condicion": "guardar1",
			},
			dataType: "JSON",
			success: function(respuesta) {
				console.log(respuesta);

				if(respuesta['estatus']=='repetido'){
					Swal.fire({
						position: 'center',
						icon: 'error',
						title: 'Error!',
						text: 'Ya existe ese nombre del cargo',
						showConfirmButton: true,
						timer: 3000
					})
					return false;
				}else{
					Swal.fire({
	 					title: 'Registro Correcto!',
	 					text: "Redirigiendo...",
	 					icon: 'success',
	 					position: 'center',
	 					showConfirmButton: false,
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
				    },3000);
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	});

	function mostrar1(value){
		if(value=='efectivo'){
			$('.div_efectivo').show("slow");
			$('.div_app').hide("slow");
		}else{
			$('.div_app').show("slow");
			$('.div_efectivo').hide("slow");
		}
	}

</script>







