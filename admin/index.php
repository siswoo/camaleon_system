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
	$ubicacion = "admin";
	include('../script/navbar_verificacion.php');
	include('../navbar.php');
?>

	<div class="seccion1" id="seccion1">
	    <div class="row">
	    	<div class="col-12 text-center mt-3">
			    <button type="button" class="btn btn-info" value="No" id="verificar1" onclick="mostrarSeccion1(this.id,value)">Verificar Documentos</button>
			    <button type="button" class="btn btn-info ml-3" value="No" id="pqr1" onclick="mostrarSeccion1(this.id,value)">PQR'S</button>
	    	</div>
	    	<!--
	    	<div class="col-12 mt-3 text-center">
	    		<hr style="background-color: black; height: 2px;">
	    	</div>
	    	-->
	    </div>

<!--****************************VERIFICAR1****************************-->

	<div class="seccion1" id="div_verificar1" style="display: none;">
	    <div class="row">
			<div class="form-group col-12">
			    <p class="text-center" style="font-weight: bold; font-size: 20px;">Verificar Documentos</p>
			</div>
			<div class="col-12 text-center" style="margin-top: 5rem;">
			    <table id="example" class="table row-border hover table-bordered" style="font-size: 12px; width: 90%;">
					<thead>
					    <tr>
					        <th class="text-center">Sede</th>
					       	<th class="text-center">Nombre</th>
					        <th class="text-center"># Documento</th>
					        <th class="text-center">Pasaporte</th>
					        <th class="text-center">RUT</th>
					        <th class="text-center">Certificación Bancaria</th>
					        <th class="text-center">EPS</th>
					        <th class="text-center">Antecedentes Disciplinarios</th>
					        <th class="text-center">Antecedentes Penales</th>
					        <th class="text-center">Opciones</th>
					    </tr>
					</thead>
					<tbody>
						<?php
						$sql1 = "SELECT * FROM modelos WHERE estatus = 'Activa'";
						$consulta1 = mysqli_query($conexion,$sql1);
						while($row1 = mysqli_fetch_array($consulta1)) {
							$id_modelos = $row1['id'];
							$modelo_sede = $row1['sede'];
							$modelo_nombre = $row1['nombre1']." ".$row1['apellido1'];
							$modelo_documento = $row1['documento_numero'];
							$sql2 = "SELECT * FROM sedes WHERE id = ".$modelo_sede;
							$consulta2 = mysqli_query($conexion,$sql2);
							while($row2 = mysqli_fetch_array($consulta2)) {
								$sede = $row2['nombre'];
							}
							//AQUI
							$sql4 = "SELECT * FROM modelos_documentos WHERE id_modelos = ".$id_modelos." and id_documentos = 3";
							$consulta4 = mysqli_query($conexion,$sql4);
							$contador1 = mysqli_num_rows($consulta4);

							if($contador1>=1){
								echo '<tr>';

									echo '<td>'.$sede.'</td>';
									echo '<td>'.$modelo_nombre.'</td>';
									echo '<td>'.$modelo_documento.'</td>';

									$pasaporte = 0;
									$t_pasaporte = 'jpg';

									$rut = 0;
									$t_rut = 'jpg';

									$cb = 0;
									$t_cb = 'jpg';

									$eps = 0;
									$t_eps = 'jpg';

									$ad = 0;
									$t_ad = 'jpg';

									$ap = 0;
									$t_ap = 'jpg';

									$sql3 = "SELECT * FROM modelos_documentos WHERE id_modelos = ".$id_modelos." and estatus = 'Pendiente'";
									$consulta3 = mysqli_query($conexion,$sql3);
									while($row3 = mysqli_fetch_array($consulta3)) {

										if($row3['id_documentos']=='3'){ 
											$pasaporte = 1;
											$t_pasaporte = $row3['tipo'];
										}

										if($row3['id_documentos']=='4'){ 
											$rut = 1;
											$t_rut = $row3['tipo'];
										}

										if($row3['id_documentos']=='5'){ 
											$cb = 1;
											$t_cb = $row3['tipo'];
										}

										if($row3['id_documentos']=='6'){ 
											$eps = 1;
											$t_eps = $row3['tipo'];
										}

										if($row3['id_documentos']=='7'){ 
											$ad = 1;
											$t_ad = $row3['tipo'];
										}

										if($row3['id_documentos']=='11'){ 
											$ap = 1;
											$t_ap = $row3['tipo'];
										}

									}

									if($pasaporte==1){
										if($t_pasaporte=='jpg'){
											echo '
												<td data-order="'.$t_pasaporte.'">
													<img src="../resources/documentos/modelos/archivos/'.$id_modelos.'/pasaporte.jpg" style="width:40px;">
												</td>
											';
										}else{
											echo '
												<td data-order="'.$t_pasaporte.'">
													<a href="../resources/documentos/modelos/archivos/'.$id_modelos.'/pasaporte.pdf" target="_blank">
														<button type="button" class="btn btn-danger">PDF</button>
													</a>
												</td>
											';
										}
									}else{
										echo '
											<td data-order="'.$pasaporte.'">
												<img src="../img/icons/no1.png" style="width:40px;">
											</td>
										';
									}

									if($rut==1){
										if($t_rut=='jpg'){
											echo '
												<td data-order="'.$t_rut.'">
													<img src="../resources/documentos/modelos/archivos/'.$id_modelos.'/rut.jpg" style="width:40px;">
												</td>
											';
										}else{
											echo '
												<td data-order="'.$t_rut.'">
													<a href="../resources/documentos/modelos/archivos/'.$id_modelos.'/rut.pdf" target="_blank">
														<button type="button" class="btn btn-danger">PDF</button>
													</a>
												</td>
											';
										}
									}else{
										echo '
											<td data-order="'.$rut.'">
												<img src="../img/icons/no1.png" style="width:40px;">
											</td>
										';
									}

									if($cb==1){
										if($t_cb=='jpg'){
											echo '
												<td data-order="'.$t_cb.'">
													<img src="../resources/documentos/modelos/archivos/'.$id_modelos.'/certificacion_bancaria.jpg" style="width:40px;">
												</td>
											';
										}else{
											echo '
												<td data-order="'.$t_cb.'">
													<a href="../resources/documentos/modelos/archivos/'.$id_modelos.'/certificacion_bancaria.pdf" target="_blank">
														<button type="button" class="btn btn-danger">PDF</button>
													</a>
												</td>
											';
										}
									}else{
										echo '
											<td data-order="'.$cb.'">
												<img src="../img/icons/no1.png" style="width:40px;">
											</td>
										';
									}

									if($eps==1){
										if($t_eps=='jpg'){
											echo '
												<td data-order="'.$t_eps.'">
													<img src="../resources/documentos/modelos/archivos/'.$id_modelos.'/eps.jpg" style="width:40px;">
												</td>
											';
										}else{
											echo '
												<td data-order="'.$t_eps.'">
													<a href="../resources/documentos/modelos/archivos/'.$id_modelos.'/eps.pdf" target="_blank">
														<button type="button" class="btn btn-danger">PDF</button>
													</a>
												</td>
											';
										}
									}else{
										echo '
											<td data-order="'.$eps.'">
												<img src="../img/icons/no1.png" style="width:40px;">
											</td>
										';
									}

									if($ad==1){
										if($t_ad=='jpg'){
											echo '
												<td data-order="'.$t_ad.'">
													<img src="../resources/documentos/modelos/archivos/'.$id_modelos.'/antecedentes_disciplinarios.jpg" style="width:40px;">
												</td>
											';
										}else{
											echo '
												<td data-order="'.$t_ad.'">
													<a href="../resources/documentos/modelos/archivos/'.$id_modelos.'/antecedentes_disciplinarios.pdf" target="_blank">
														<button type="button" class="btn btn-danger">PDF</button>
													</a>
												</td>
											';
										}
									}else{
										echo '
											<td data-order="'.$ad.'">
												<img src="../img/icons/no1.png" style="width:40px;">
											</td>
										';
									}

									if($ap==1){
										if($t_ap=='jpg'){
											echo '
												<td data-order="'.$t_ap.'">
													<img src="../resources/documentos/modelos/archivos/'.$id_modelos.'/antecedentes_penales.jpg" style="width:40px;">
												</td>
											';
										}else{
											echo '
												<td data-order="'.$t_ap.'">
													<a href="../resources/documentos/modelos/archivos/'.$id_modelos.'/antecedentes_penales.pdf" target="_blank">
														<button type="button" class="btn btn-danger">PDF</button>
													</a>
												</td>
											';
										}
									}else{
										echo '
											<td data-order="'.$ap.'">
												<img src="../img/icons/no1.png" style="width:40px;">
											</td>
										';
									}

								echo '
									<td nowrap>
										<button type="button" class="btn btn-info" id="'.$id_modelos.'" style="background-color:green !important;" onclick="aceptar_documento1(this.id)">Aceptar</button>
										<button type="button ml-3" class="btn btn-danger" id="'.$id_modelos.'" onclick="rechazar_documento1(this.id)">Rechazar</button>
									</td>
								';
								
								echo '</tr>';
								}
							}
							?>
					</tbody>
				</table>
			</div>
		</div>
	</div>


	<div class="seccion1" id="div_pqr1" style="display: none;">
	    <div class="row">
			<div class="form-group col-12">
			    <p class="text-center" style="font-weight: bold; font-size: 20px;">CONSULTA DE PQR'S</p>
			</div>
			<div class="col-12 text-center">
			    <table id="example2" class="table row-border hover table-bordered" style="font-size: 12px; width: 90%;">
					<thead>
					    <tr>
					        <th class="text-center">ID</th>
					        <th class="text-center">Nombre</th>
					        <th class="text-center">Documento</th>
					       	<th class="text-center">Mensaje</th>
					        <th class="text-center">Tema</th>
					        <th class="text-center">Area</th>
					        <th class="text-center">Fecha</th>
					    </tr>
					</thead>
					<tbody>
						<?php
						$sql1 = "SELECT * FROM pqr";
						$consulta1 = mysqli_query($conexion,$sql1);
						while($row1 = mysqli_fetch_array($consulta1)) {
							$id_pqr = $row1['id'];
							$responsable_pqr = $row1['responsable'];
							$mensaje_pqr = $row1['mensaje'];
							$tema_pqr = $row1['tema'];
							$area_pqr = $row1['area'];
							$fecha_inicio_pqr = $row1['fecha_inicio'];

							$sql2 = "SELECT * FROM modelos WHERE id = ".$responsable_pqr;
							$consulta2 = mysqli_query($conexion,$sql2);
							while($row2 = mysqli_fetch_array($consulta2)) {
								$nombre_responsable = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
								$documento_responsable = $row2['documento_numero'];
							}

							echo '
								<tr>
									<td>'.$id_pqr.'</td>
									<td>'.$nombre_responsable.'</td>
									<td>'.$documento_responsable.'</td>
									<td>'.$mensaje_pqr.'</td>
									<td>'.$tema_pqr.'</td>
									<td>'.$area_pqr.'</td>
									<td>'.$fecha_inicio_pqr.'</td>
								</tr>
							';
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

<!--****************************FIN VERIFICAR1****************************-->

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

	        	"paging": true,
	        	"order": [[ 9, "desc" ]],

	    	} );

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

	function aceptar_documento1(id_modelo){
		console.log(id_modelo);
		var condicion = 'aceptar';
		$.ajax({
            url: '../script/crud_documentos1.php',
            type: 'POST',
            data: {
				"id_modelo": id_modelo,
				"condicion": condicion,
			},

            beforeSend: function (){},

            success: function(response){
            	console.log(response);
            	Swal.fire({
					title: 'Correcto!',
					text: "Cuentas Aceptadas",
					icon: 'success',
					position: 'center',
					showConfirmButton: false,
					timer: 1200
				});
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
	}

</script>