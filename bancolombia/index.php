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

	$ubicacion = "bancolombia";

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

	    <div class="row" style="/*margin-left: 1rem; margin-right: 3rem; margin-top: 1rem; overflow-x: auto; white-space: nowrap;*/">

	    	<?php

	    	if($_SESSION["usuario"]!="camila123"){ ?>

		    	<div class="col-12 mb-3 text-right">

					<button type="button" class="btn btn-primary" style="margin-right: 2rem;" data-toggle="modal" data-target="#exampleModal1">Importar</button>

				</div>

	    	<?php } ?>



		    <div class="container_consulta1">
		    	<table id="example" class="table row-border hover table-bordered" style="font-size: 12px; color:rgba(50,55,66,1); border-radius: 5px;">
			        <thead>
			            <tr>
			                <th class="text-center">Referencia</th>
			                <th class="text-center">Concepto</th>
			                <th class="text-center">Monto Pagado</th>
			                <th class="text-center">Fecha Creación</th>
			                <th class="text-center">Opciones</th>
			            </tr>
			        </thead>
			        <tbody id="resultados">
			        	<?php
			        		$sql1 = "SELECT * FROM bancolombia1";
			        		$consulta1 = mysqli_query($conexion,$sql1);
			        		while($row1 = mysqli_fetch_array($consulta1)) {
			        			$id = $row1['id'];
			        			$referencia = $row1['referencia'];
			        			$concepto = $row1['concepto'];
			        			$valor = $row1['valor'];
			        			$soporte = $row1['soporte'];
			        			$fecha_creacion = $row1['fecha_creacion'];

			        			echo '

			        				<tr id="tr_'.$id.'">
			        					<td class="text-center" id="referencia'.$id.'">'.$referencia.'</td>
			        					<td class="text-center" id="concepto'.$id.'">'.$concepto.'</td>
			        					<td class="text-center" id="valor'.$id.'">'.$valor.'</td>
			        					<td class="text-center" id="fecha_creacion'.$id.'">'.$fecha_creacion.'</td>
			        					<td class="text-center" nowrap="nowrap">
			        			';

			        			if($soporte==0 and $_SESSION["usuario"]!="camila123"){
			        				echo '
			        						<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2" onclick="subir2('.$id.');">Subir</button>
			        				';
			        			}else if($soporte==1){
			        				$location = '../resources/documentos/bancolombia1/'.$id.'/';
									$nombre_final = "soporte";
			        				echo '
			        						<a href="'.$location.$nombre_final.'.pdf" target="_blank">
			        							<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3">Ver</button>
			        						</a>
			        				';
			        			}

			        			if($_SESSION["usuario"]!="camila123"){
			        				echo '
			        				<button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal3" onclick="eliminar1('.$id.');">Eliminar</button>
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
		</div>
	</div>
</body>
</html>


<!-- Modal IMPORTAR Registro -->

	<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

		<div class="modal-dialog" role="document">

			<form action="#" method="POST" id="form_modal_new" style="">

				<div class="modal-content">

					<div class="modal-header">

						<h5 class="modal-title" id="exampleModalLabel">Nuevo Registro</h5>

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">

							<span aria-hidden="true">&times;</span>

						</button>

					</div>

					<div class="modal-body">

					    <div class="row">

						    <div class="col-12 form-group form-check">

							    <label for="documento1">Documento Excel</label>

							    <input type="file" name="documento1" id="documento1" class="form-control" required>

						    </div>

						    <input type="hidden" name="detalle1" id="detalle1" class="form-control" required>

					    </div>

					</div>

					<div class="modal-footer">

				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

				        <button type="submit" class="btn btn-success" id="submit_guardar1">Subir</button>

			      	</div>

		      	</form>

	    	</div>

	  	</div>

	</div>

<!-- FIN Modal IMPORTAR Registro -->



<!-- Modal PDF1 -->

	<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

		<div class="modal-dialog" role="document">

			<form action="#" method="POST" id="form_modal_subir2" style="">

				<input type="hidden" id="subir2_id" name="subir2_id">

				<div class="modal-content">

					<div class="modal-header">

						<h5 class="modal-title" id="exampleModalLabel">Subir Soporte</h5>

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">

							<span aria-hidden="true">&times;</span>

						</button>

					</div>

					<div class="modal-body">

					    <div class="row">

						    <div class="col-12 form-group form-check">

							    <label for="documento2">Documento PDF</label>

							    <input type="file" name="documento2" id="documento2" class="form-control" required>

						    </div>

					    </div>

					</div>

					<div class="modal-footer">

				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

				        <button type="submit" class="btn btn-success" id="submit_guardar2">Subir</button>

			      	</div>

		      	</form>

	    	</div>

	  	</div>

	</div>

<!-- FIN Modal PDF1 -->



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
        var fd = new FormData();
        var files = $('#documento1')[0].files[0];
        var detalle = $('#detalle1').val();
        fd.append('file',files);
        fd.append('condicion',"subir1");
        fd.append('detalle',detalle);

        $.ajax({
            url: '../script/crud_bancolombia1.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,
            dataType: "JSON",

            beforeSend: function (){
            	$('#submit_guardar1').attr('disabled','true');
            },

            success: function(response){
            	console.log(response);
            	$('#submit_guardar1').removeAttr('disabled');

            	if(response["estatus"]=='error'){
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Debe ser un archivo de Excel Aceptable",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
            		return false;
            	}

            	Swal.fire({
	 				title: 'Documento Subido',
	 				text: "Redirigiendo...!",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: true,
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
				},3500);
            },

            error: function (response){
            	console.log(response["responseText"]);
            	$('#submit_guardar1').removeAttr('disabled');
            }
        });
	});

	function subir2(id){
		$('#subir2_id').val(id);
	}

	$("#form_modal_subir2").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#documento2')[0].files[0];
        var id = $('#subir2_id').val();
        fd.append('file',files);
        fd.append('id',id);
        fd.append('condicion',"subir2");

        $.ajax({
            url: '../script/crud_bancolombia1.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,
            dataType: "JSON",

            beforeSend: function (){
            	$('#submit_guardar1').attr('disabled','true');
            },

            success: function(response){
            	$('#submit_guardar1').removeAttr('disabled');
            	if(response["estatus"]=='error'){
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Debe ser un archivo de PDF Valido",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
            		return false;
            	}

            	Swal.fire({
	 				title: 'Documento Subido',
	 				text: "Redirigiendo...!",
	 				icon: 'success',
	 				position: 'center',
	 				showConfirmButton: true,
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
				},3500);
            },

            error: function (response){
            	console.log(response["responseText"]);
            	$('#submit_guardar1').removeAttr('disabled');
            }
        });
	});

	function eliminar1(id){
		Swal.fire({
			title: 'Estas seguro?',
			text: "Luego no podrás revertir esta acción",
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
					url: '../script/crud_bancolombia1.php',
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
						console.log("error..."+respuesta);
					}
				});
			}
		})
	}

</script>















