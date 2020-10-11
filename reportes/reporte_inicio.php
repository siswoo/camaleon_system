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
	$ubicacion = "Rinicio";
	include('../script/navbar_verificacion.php');
	include('../navbar.php');
?>
	<form id="formulario1" method="POST">
		<input type="hidden" id="modelo_view" value="<?php echo $modelo_view; ?>">
		<input type="hidden" id="modelo_edit" value="<?php echo $modelo_edit; ?>">
		<input type="hidden" id="modelo_delete" value="<?php echo $modelo_delete; ?>">
	</form>

	<div class="seccion1">
	    <div class="row">
		    <div class="container_consulta1">
		    	<div class="row mb-3">
		    		<div class="col-md-12 text-center" style="font-weight: bold; font-size: 24px; color: #17a2b8;">Reportes de Inicio</div>
		    		<div class="col-md-12 text-right">
		    			<span style="margin-right: 2rem;">
		    				<a href="nuevo_registro.php">
		    					<button class="btn btn-success" data-toggle="modal" data-target="#exampleModal2">Nuevo Registro</button>
		    				</a>
		    			</span>
		    		</div>
		    	</div>

		    	<table id="example" class="table row-border hover table-bordered">
			        <thead>
			            <tr>
			                <th class="text-center">Rooms</th>
			                <th class="text-center">Responsable</th>
			                <th class="text-center">Turno</th>
			                <th class="text-center">Sede</th>
			                <th class="text-center">Fecha</th>
			                <th class="text-center">Detalles</th>
			            </tr>
			        </thead>
			        <tbody id="resultados">
			        	<?php
			        	$consulta2 = "SELECT * FROM reporte_inicio";
						$resultado2 = mysqli_query( $conexion, $consulta2 );
						$contador1=1;
						while($row2 = mysqli_fetch_array($resultado2)) {
							$rinicio_id 			= $row2['id'];
							$rinicio_filas 			= $row2['id_filas'];
							$rinicio_responsable 	= $row2['responsable'];
							$rinicio_turno 			= $row2['turno'];
							$rinicio_token 			= $row2['token'];
							$rinicio_sede 			= $row2['sede'];
							$rinicio_fecha_inicio 	= $row2['fecha_inicio'];
							echo '
								<tr>
					                <td class="text-center">'.$rinicio_filas.'</td>
					                <td class="text-center">'.$rinicio_responsable.'</td>
					                <td class="text-center">'.$rinicio_turno.'</td>
					                <td class="text-center">'.$rinicio_sede.'</td>
					                <td class="text-center">'.$rinicio_fecha_inicio.'</td>
					                <td class="text-center">
					                	<a href="">
					                		<i class="fas fa-edit" style="color:#0095ff; cursor:pointer;" title="" value="'.$rinicio_id.'"></i>
					                	</a>
					                	<i class="fas fa-trash-alt ml-3" style="color:red; cursor:pointer;" data-toggle="popover-hover" data-placement="top" value="'.$rinicio_id.'" title="" onclick="eliminar('.$rinicio_id.');" data-content="<strong>Eliminar Registro</strong>"></i>
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
	/*****************MODALES****************/
	$('#myModal').on('shown.bs.modal', function () {
	  	$('#myInput').trigger('focus')
	});
	/****************************************/

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
    });

    function eliminar(variable){
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
				url: '../script/eliminar_registro_inicio.php',
				data: {"variable": variable},
				dataType: "JSON",
				success: function(respuesta) {
					Swal.fire({
					    title: 'Registro Eliminado!',
					    text: 'Redirigiendo...',
					    icon: 'success',
					    showConfirmButton: false
				    });setTimeout(function() {
			      		window.location.href = "reporte_inicio.php";
			    	},3500);
				},

				error: function(respuesta) {
					console.log("error..."+respuesta);
				}
			});
		  }
		})
	}

</script>
