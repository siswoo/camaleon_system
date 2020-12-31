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
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
	<!--<link rel="stylesheet" href="../css/mdb.css">-->
	<!--<link rel="stylesheet" href="../css/style.css">-->
	<link href="../resources/lightbox/dist/css/lightbox.css" rel="stylesheet">
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
	</style>

<?php
	include('../script/conexion.php');
	$ubicacion = "pqr";
	include('../script/navbar_verificacion.php');
	include('../navbar.php');
?>

	<div class="seccion1" id="seccion1">
	    <div class="row">
	    	<div class="col-12 text-center mt-3">
			    <button type="button" class="btn btn-info" value="No" id="pqr1" onclick="mostrarSeccion1(this.id,value)">PQR'S PENDIENTES</button>
			    <button type="button" class="btn btn-info ml-3" value="No" id="pqr2" onclick="mostrarSeccion1(this.id,value)">PQR'S LISTOS</button>
	    	</div>
	    </div>

<!--****************************PQR1****************************-->
	<div class="seccion1" id="div_pqr1" style="display: none;">
	    <div class="row">
			<div class="form-group col-12">
			    <p class="text-center" style="font-weight: bold; font-size: 20px;">CONSULTA DE PQR'S PENDIENTES</p>
			</div>
			<div class="col-12 text-center">
			    <table id="example2" class="table row-border hover table-bordered" style="font-size: 12px; width: 100%;">
					<thead>
					    <tr>
					        <th class="text-center">ID</th>
					        <th class="text-center">Nombre</th>
					        <th class="text-center">Documento</th>
					       	<th class="text-center">Mensaje</th>
					        <th class="text-center">Tema</th>
					        <th class="text-center">Area</th>
					        <th class="text-center">Estatus</th>
					        <th class="text-center">Fecha</th>
					        <?php
					        if($_SESSION['rol']==1 or $_SESSION['rol']==13){
					        echo '
					        	<th class="text-center">Responsable</th>
					        	<th class="text-center">Opciones</th>
					        ';
					    	} ?>
					    </tr>
					</thead>
					<tbody>
						<?php
						if($_SESSION['rol']!=1 and $_SESSION['rol']!=13){
							$sql1 = "SELECT * FROM pqr WHERE rol_responsable = ".$_SESSION['rol']." and estatus = 'Proceso'";
						}else{
							$sql1 = "SELECT * FROM pqr WHERE estatus = 'Proceso'";
						}
						$consulta1 = mysqli_query($conexion,$sql1);
						while($row1 = mysqli_fetch_array($consulta1)) {
							$id_pqr = $row1['id'];
							$responsable_pqr = $row1['responsable'];
							$mensaje_pqr = $row1['mensaje'];
							$tema_pqr = $row1['tema'];
							$area_pqr = $row1['area'];
							$estatus_pqr = $row1['estatus'];
							$fecha_inicio_pqr = $row1['fecha_inicio'];
							$rol_responsable = $row1['rol_responsable'];

							$sql2 = "SELECT * FROM modelos WHERE id = ".$responsable_pqr;
							$consulta2 = mysqli_query($conexion,$sql2);
							while($row2 = mysqli_fetch_array($consulta2)) {
								$nombre_responsable = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
								$documento_responsable = $row2['documento_numero'];
							}

							echo '
								<tr id="tr_pqr_'.$id_pqr.'">
									<td>'.$id_pqr.'</td>
									<td nowrap>'.$nombre_responsable.'</td>
									<td>'.$documento_responsable.'</td>
									<td>'.$mensaje_pqr.'</td>
									<td>'.$tema_pqr.'</td>
									<td>'.$area_pqr.'</td>
									<td id="estatus_pqr_'.$id_pqr.'">'.$estatus_pqr.'</td>
									<td nowrap>'.$fecha_inicio_pqr.'</td>
								';
								if($_SESSION['rol']==1 or $_SESSION['rol']==13){
									echo '
										<td class="text-center" style="width:130px;">
									';
									if($rol_responsable==0){
										echo '
											<select class="form-control" onchange="asignarpqr1('.$id_pqr.','.$responsable_pqr.',value);">
												<option value="0">Sin Responsable</option>
												<option value="2">Soporte</option>
												<option value="8">Recursos Humanos</option>
											</select>
										';
									}else if($rol_responsable==2){
										echo '
											<select class="form-control" onchange="asignarpqr1('.$id_pqr.','.$responsable_pqr.',value);">
												<option value="0">Sin Responsable</option>
												<option value="2" selected>Soporte</option>
												<option value="8">Recursos Humanos</option>
											</select>
										';
									}else if($rol_responsable==8){
										echo '
											<select class="form-control" onchange="asignarpqr1('.$id_pqr.','.$responsable_pqr.',value);">
												<option value="0">Sin Responsable</option>
												<option value="2">Soporte</option>
												<option value="8" selected>Recursos Humanos</option>
											</select>
										';
									}
									echo '
										</td>
									';

									echo '
										<td class="text-center" nowrap>
											<button type="button" class="btn btn-info" value="listo" onclick="cambiar_estado_pqr1('.$id_pqr.',value)">Listo</button>
											<button type="button" class="btn btn-info" value="proceso" onclick="cambiar_estado_pqr1('.$id_pqr.',value)">Proceso</button>
											<button type="button" class="btn btn-info" value="eliminar" onclick="cambiar_estado_pqr1('.$id_pqr.',value)">Eliminar</button>
										</td>
									';
								}
									echo '
								</tr>
							';
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

<!--****************************FIN PQR1****************************-->


<!--****************************PQR2****************************-->
	<div class="seccion1" id="div_pqr2" style="display: none;">
	    <div class="row">
			<div class="form-group col-12">
			    <p class="text-center" style="font-weight: bold; font-size: 20px;">CONSULTA DE PQR'S LISTOS</p>
			</div>
			<div class="col-12 text-center">
			    <table id="example2" class="table row-border hover table-bordered" style="font-size: 12px; width: 100%;">
					<thead>
					    <tr>
					        <th class="text-center">ID</th>
					        <th class="text-center">Nombre</th>
					        <th class="text-center">Documento</th>
					       	<th class="text-center">Mensaje</th>
					        <th class="text-center">Tema</th>
					        <th class="text-center">Area</th>
					        <th class="text-center">Estatus</th>
					        <th class="text-center">Fecha</th>
					        <?php
					        if($_SESSION['rol']==1 or $_SESSION['rol']==13){
					        echo '
					        	<th class="text-center">Responsable</th>
					        	<th class="text-center">Opciones</th>
					        ';
					    	} ?>
					    </tr>
					</thead>
					<tbody>
						<?php
						if($_SESSION['rol']!=1 and $_SESSION['rol']!=13){
							$sql1 = "SELECT * FROM pqr WHERE rol_responsable = ".$_SESSION['rol']." and estatus = 'listo'";
						}else{
							$sql1 = "SELECT * FROM pqr WHERE estatus = 'listo'";
						}
						$consulta1 = mysqli_query($conexion,$sql1);
						while($row1 = mysqli_fetch_array($consulta1)) {
							$id_pqr = $row1['id'];
							$responsable_pqr = $row1['responsable'];
							$mensaje_pqr = $row1['mensaje'];
							$tema_pqr = $row1['tema'];
							$area_pqr = $row1['area'];
							$estatus_pqr = $row1['estatus'];
							$fecha_inicio_pqr = $row1['fecha_inicio'];
							$rol_responsable = $row1['rol_responsable'];

							$sql2 = "SELECT * FROM modelos WHERE id = ".$responsable_pqr;
							$consulta2 = mysqli_query($conexion,$sql2);
							while($row2 = mysqli_fetch_array($consulta2)) {
								$nombre_responsable = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
								$documento_responsable = $row2['documento_numero'];
							}

							echo '
								<tr id="tr_pqr_'.$id_pqr.'">
									<td>'.$id_pqr.'</td>
									<td nowrap>'.$nombre_responsable.'</td>
									<td>'.$documento_responsable.'</td>
									<td>'.$mensaje_pqr.'</td>
									<td>'.$tema_pqr.'</td>
									<td>'.$area_pqr.'</td>
									<td id="estatus_pqr_'.$id_pqr.'">'.$estatus_pqr.'</td>
									<td nowrap>'.$fecha_inicio_pqr.'</td>
								';
								if($_SESSION['rol']==1 or $_SESSION['rol']==13){
									echo '
										<td class="text-center" style="width:130px;">
									';
									if($rol_responsable==0){
										echo '
											<select class="form-control" onchange="asignarpqr1('.$id_pqr.','.$responsable_pqr.',value);">
												<option value="0">Sin Responsable</option>
												<option value="2">Soporte</option>
												<option value="8">Recursos Humanos</option>
											</select>
										';
									}else if($rol_responsable==2){
										echo '
											<select class="form-control" onchange="asignarpqr1('.$id_pqr.','.$responsable_pqr.',value);">
												<option value="0">Sin Responsable</option>
												<option value="2" selected>Soporte</option>
												<option value="8">Recursos Humanos</option>
											</select>
										';
									}else if($rol_responsable==8){
										echo '
											<select class="form-control" onchange="asignarpqr1('.$id_pqr.','.$responsable_pqr.',value);">
												<option value="0">Sin Responsable</option>
												<option value="2">Soporte</option>
												<option value="8" selected>Recursos Humanos</option>
											</select>
										';
									}
									echo '
										</td>
									';

									echo '
										<td class="text-center" nowrap>
											<button type="button" class="btn btn-info" value="listo" onclick="cambiar_estado_pqr1('.$id_pqr.',value)">Listo</button>
											<button type="button" class="btn btn-info" value="proceso" onclick="cambiar_estado_pqr1('.$id_pqr.',value)">Proceso</button>
											<button type="button" class="btn btn-info" value="eliminar" onclick="cambiar_estado_pqr1('.$id_pqr.',value)">Eliminar</button>
										</td>
									';
								}
									echo '
								</tr>
							';
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

<!--****************************FIN PQR2****************************-->

</body>
</html>

<script src="../js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../js/popper.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="../js/navbar.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="../js/mdb.js"></script>
<script src="../js/Chart.js"></script>
<script src="../resources/lightbox/dist/js/lightbox.js"></script>

<?php include('../footer.php'); ?>

<script type="text/javascript">
	$(document).ready(function() {
		var table = $('#example2').DataTable( {
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

	        	"paging": true,
	        	"order": [[ 7, "desc" ]],

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
	});

	$('#myModal').on('shown.bs.modal', function () {
	  	$('#myInput').trigger('focus')
	});

	function mostrarSeccion1(button,value){
		if(value=='Si'){
			$('#div_'+button).hide('slow');
			$('#'+button).val('No');
		}else{
			$('#div_'+button).show('slow');
			$('#'+button).val('Si');
		}
	}

	function asignarpqr1(id_pqr,id_modelo,value){
		var condicion = 'asignar';
		$.ajax({
            url: '../script/crud_pqr.php',
            type: 'POST',
            data: {
				"id_pqr": id_pqr,
				"id_modelo": id_modelo,
				"value": value,
				"condicion": condicion,
			},

            beforeSend: function (){},

            success: function(response){
            	//console.log(response);
            	Swal.fire({
			 		title: 'Perfecto!',
				 	text: "Responsable Asignado",
				 	icon: 'success',
				 	position: 'center',
				 	showConfirmButton: false,
				 	timer: 2000
				});
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
	}

	function cambiar_estado_pqr1(id_pqr,condicion){
		console.log(condicion);
		if(condicion=='listo'){
			Swal.fire({
				title: '¿Razón?',
				input: 'text',
				inputAttributes: {
				    autocapitalize: 'off'
				},
				showCancelButton: true,
				confirmButtonText: 'Guardar',
				showLoaderOnConfirm: true,
			}).then((result) => {
				if(result.value!=""){
					$.ajax({
			            url: '../script/crud_pqr.php',
			            type: 'POST',
			            dataType: "JSON",
			            data: {
							"id_pqr": id_pqr,
							"condicion": condicion,
							"razon": result.value,
						},

			            beforeSend: function (){},

			            success: function(response){
			            	//console.log(response['respuesta']);
			            	if(response['respuesta']=='listo'){
			            		Swal.fire({
							 		title: 'Perfecto!',
								 	text: "Estatus Cambiado a listo",
								 	icon: 'success',
								 	position: 'center',
								 	showConfirmButton: false,
								 	timer: 2000
								});
								$('#estatus_pqr_'+id_pqr).html(condicion);
			            	}
			            },

			            error: function(response){
			            	console.log(response['responseText']);
			            }
			        });
				}
			})
		}else{
			$.ajax({
			    url: '../script/crud_pqr.php',
			    type: 'POST',
		        dataType: "JSON",
		        data: {
					"id_pqr": id_pqr,
					"condicion": condicion,
					"razon": result.value,
				},

			    beforeSend: function (){},

			   	success: function(response){
			        //console.log(response['respuesta']);

			        if(response['respuesta']=='proceso'){
			           	Swal.fire({
							title: 'Perfecto!',
							text: "Estatus Cambiado a proceso",
							icon: 'success',
							position: 'center',
							showConfirmButton: false,
							timer: 2000
						});
						$('#estatus_pqr_'+id_pqr).html(condicion);
			        }

			        if(response['respuesta']=='eliminar'){
			        	Swal.fire({
							title: 'Perfecto!',
							text: "Se ha eliminado el PQR",
							icon: 'success',
							position: 'center',
							showConfirmButton: false,
							timer: 2000
						});
						$('#tr_pqr_'+id_pqr).hide('slow');
			        }
			    },

			    error: function(response){
			        console.log(response['responseText']);
			    }
			});
		}
	}

</script>