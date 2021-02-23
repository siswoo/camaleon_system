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

  	.tr_señalada{
  		background-color: #83f7034d;
  		transition-property: all;
    	transition-duration: 3s;
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
	<!--
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
	-->

	<div class="seccion1">
		<div class="row">
			<table id="example" class="table row-border hover table-bordered" style="font-size: 12px; color:rgba(50,55,66,1);">
			        <thead>
			            <tr>
			                <th class="text-center">Sede</th>
			                <th class="text-center">Nombre Completo</th>
			                <th class="text-center">Chaturbate</th>
			                <th class="text-center">Contrato Firmado</th>
			                <th class="text-center">Twitter</th>
			                <th class="text-center">Instagram</th>
			                <th class="text-center">Celular</th>
			                <th class="text-center">Horario Transmisión</th>
			                <th class="text-center">Público</th>
			                <th class="text-center">Opciones</th>
			            </tr>
			        </thead>
			        <tbody id="resultados">
			        	<?php
			        	$consulta1 = "SELECT * FROM modelos WHERE estatus = 'Activa' ORDER BY id DESC";
						$resultado1 = mysqli_query( $conexion, $consulta1 );
						while($row1 = mysqli_fetch_array($resultado1)) {
							$id_modelo 			= $row1['id'];
							$nombre1 			= $row1['nombre1'];
							$nombre2 			= $row1['nombre2'];
							$apellido1 			= $row1['apellido1'];
							$apellido2 			= $row1['apellido2'];
							$documento_tipo 	= $row1['documento_tipo'];
							$documento_numero 	= $row1['documento_numero'];
							$correo 			= $row1['correo'];
							$telefono1 			= $row1['telefono1'];
							$sede 				= $row1['sede'];
							$turno 				= $row1['turno'];
							$fecha_inicio 		= $row1['fecha_inicio'];
							
							if($sede==""){
								$nombre_sede = 'Desconocido';
							}else{
								$consulta2 = "SELECT * FROM sedes WHERE id = ".$sede;
								$resultado2 = mysqli_query( $conexion, $consulta2 );
								while($row2 = mysqli_fetch_array($resultado2)) {
									$nombre_sede = $row2['nombre'];
								}
							}


							$html_chaturbate = '';
							$consulta3 = "SELECT * FROM modelos_cuentas WHERE id_modelos = ".$id_modelo." and id_paginas = 1";
							$resultado3 = mysqli_query( $conexion, $consulta3 );
							while($row3 = mysqli_fetch_array($resultado3)) {
								$html_chaturbate .= '
									<a href="https://es.chaturbate.com/'.$row3["usuario"].'" target="_blank">
										<button type="button" class="btn btn-info">'.$row3["usuario"].'</button>
									</a>
								';
							}

							$html_contrato = 'No';
							$consulta4 = "SELECT * FROM modelos_documentos WHERE id_modelos = ".$id_modelo." and id_documentos = 1";
							$resultado4 = mysqli_query( $conexion, $consulta4 );
							while($row4 = mysqli_fetch_array($resultado4)) {
								$html_contrato = 'Si';
							}

							if($turno==''){
								$turno = 'Sin Asignar';
							}

							$html_twitter = '';
							$contador_twitter = 0;
							$consulta5 = "SELECT * FROM redes_sociales WHERE id_modelo = ".$id_modelo." and red = 'Twitter'";
							$resultado5 = mysqli_query( $conexion, $consulta5 );
							while($row5 = mysqli_fetch_array($resultado5)) {
								$contador_twitter = $contador_twitter+1;
								$html_twitter .= '
									<a href="'.$row5["link"].'" target="_blank">
										<!--<button type="button" class="btn btn-info">'.$contador_twitter.'</button>-->
										<img src="../img/icons/twitter1.png" style="width:40px;">
									</a>
								';
							}

							$html_instagram = '';
							$contador_instagram = 0;
							$consulta5 = "SELECT * FROM redes_sociales WHERE id_modelo = ".$id_modelo." and red = 'Instagram'";
							$resultado5 = mysqli_query( $conexion, $consulta5 );
							while($row5 = mysqli_fetch_array($resultado5)) {
								$contador_instagram = $contador_instagram+1;
								$html_instagram .= '
									<a href="'.$row5["link"].'" target="_blank">
										<!--<button type="button" class="btn btn-info">'.$contador_instagram.'</button>-->
										<img src="../img/icons/instagram1.png" style="width:40px;">
									</a>
								';
							}

							$html_publico = 'No';
							$consulta6 = "SELECT * FROM publicas WHERE id_modelo = ".$id_modelo;
							$resultado6 = mysqli_query( $conexion, $consulta6 );
							while($row6 = mysqli_fetch_array($resultado6)) {
								$html_publico = 'Si';
							}

							echo '
								<tr id="tr_'.$id_modelo.'">
					                <td class="text-center">'.$nombre_sede.'</td>
					                <td class="text-center">'.$nombre1.' '.$nombre2.' '.$apellido1.' '.$apellido2.'</td>
					                <td class="text-center" nowrap="nowrap">'.$html_chaturbate.'</td>
					                <td class="text-center">'.$html_contrato.'</td>
					                <td class="text-center" nowrap="nowrap">'.$html_twitter.'</td>
					                <td class="text-center" nowrap="nowrap">'.$html_instagram.'</td>
					                <td class="text-center">'.$telefono1.'</td>
					                <td class="text-center">'.$turno.'</td>
					                <td class="text-center" id="publico_'.$id_modelo.'">'.$html_publico.'</td>
					                <td class="text-center" nowrap="nowrap">
					               		<i class="fas fa-edit" style="color:#0095ff; cursor:pointer;" title="" value="'.$id_modelo.'" data-toggle="modal" data-target="#exampleModal" onclick="modal_redes1('.$id_modelo.');"></i>
					                	<i class="fas fa-trash-alt ml-3" style="color:red; cursor:pointer;"  data-toggle="modal" data-target="#exampleModal2" onclick="eliminar1('.$id_modelo.');" value="'.$id_modelo.'"></i>
					                	<button type="button" class="btn btn-success ml-3" onclick="publico1('.$id_modelo.')">Público</button>
					                	<button type="button" class="btn btn-danger ml-3" onclick="privado1('.$id_modelo.')">Privado</button>
					                </td>
					            ';
						}
						?>
			        </tbody>
			    </table>
		</div>
	</div>

</body>
</html>

<!-- Modal Asignar Red -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_redes1" style="">
				<input type="hidden" name="add_id1" id="add_id1">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Asignar Redes</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row">
						    <div class="col-12 form-group form-check">
							    <label for="add_redes1">Tipo de Documento <small style="color:#F2B76F; font-size: 17px;">*</small></label>
							    <select name="add_redes1" id="add_redes1" class="form-control" required>
							    	<option value="">Seleccione</option>
							    	<option value="Instagram">Instagram</option>
							    	<option value="Twitter">Twitter</option>
							    </select>
						    </div>
						    <div class="col-12 form-group form-check">
							    <label for="add_link_red1">Link de la Red <small style="color:#F2B76F; font-size: 17px;">*</small></label>
							    <input type="url" name="add_link_red1" id="add_link_red1" class="form-control" autocomplete="off" required>
						    </div>
				    	</div>
				    </div>
				    <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" class="btn btn-success" id="submit_add_redes1">Guardar</button>
			      	</div>
		      	</form>
	    	</div>
	  	</div>
	</div>
<!-- FIN Modal Asignar Red -->

<!-- Modal Eliminar Red -->
	<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_eliminar1" style="">
				<input type="hidden" name="eliminar_id1" id="eliminar_id1">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Eliminar Redes</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row">
						    <div class="col-12 form-group form-check">
							    <label for="eliminar_redes1">Tipo de Documento <small style="color:#F2B76F; font-size: 17px;">*</small></label>
							    <select name="eliminar_redes1" id="eliminar_redes1" class="form-control" required>
							    	<option value="">Seleccione</option>
							    	<option value="Instagram">Instagram</option>
							    	<option value="Twitter">Twitter</option>
							    </select>
						    </div>
				    	</div>
				    </div>
				    <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" class="btn btn-success" id="submit_add_redes1">Guardar</button>
			      	</div>
		      	</form>
	    	</div>
	  	</div>
	</div>
<!-- FIN Modal Eliminar Red -->

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

	function modal_redes1(id_modelo){
		$('#add_redes1').val('');
		$('#add_link_red1').val('');
		$('#add_id1').val(id_modelo);
	}

	$("#form_modal_redes1").on("submit", function(e){
		e.preventDefault();
		var id_modelo = $('#add_id1').val();
		var add_redes1 = $('#add_redes1').val();
		var add_link_red1 = $('#add_link_red1').val();

        $.ajax({
            url: '../script/crud_redes1.php',
            type: 'POST',
           	data: {
				"id_modelo": id_modelo,
				"add_redes1": add_redes1,
				"add_link_red1": add_link_red1,
				"condicion": 'guardar',
			},

            beforeSend: function (){
            	$('#submit_add_redes1').attr('disabled','true');
            },

            success: function(response){
            	console.log(response);
            	$('#submit_add_redes1').removeAttr('disabled','false');
            	
            	Swal.fire({
		 			title: 'Guardado exitosamente!',
		 			text: "Limpiando Cache...",
		 			icon: 'success',
		 			position: 'center',
		 			showConfirmButton: true,
		 			timer: 2000
				});

            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    });

    $("#form_modal_eliminar1").on("submit", function(e){
		e.preventDefault();
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
		  	var id_modelo = $('#eliminar_id1').val();
			var add_redes1 = $('#eliminar_redes1').val();
		    $.ajax({
				type: 'POST',
				url: '../script/crud_redes1.php',
				data: {
					"id_modelo": id_modelo,
					"add_redes1": add_redes1,
					"condicion": 'eliminar',
				},
				dataType: "JSON",
				success: function(respuesta) {
					Swal.fire({
					    title: 'Registro Eliminado!',
					    text: 'Redirigiendo...',
					    icon: 'success',
					    showConfirmButton: false
				    });setTimeout(function() {
			      		window.location.href = "index.php";
			    	},3500);
				},

				error: function(respuesta) {
					console.log("error..."+respuesta);
				}
			});
		  }
		})
	});

	function eliminar1(id_modelo){
		$('#eliminar_redes1').val('');
		$('#eliminar_id1').val(id_modelo);
	}

	function publico1(id_modelo){
		$.ajax({
			type: 'POST',
			url: '../script/crud_publicos1.php',
			data: {
				"id_modelo": id_modelo,
				"condicion": 'publico',
			},
			dataType: "JSON",
			success: function(respuesta) {
				console.log(respuesta);
				$('#publico_'+id_modelo).html('Si');
				$('#tr_'+id_modelo).addClass('tr_señalada');
				setTimeout(function() {
					$('#tr_'+id_modelo).removeClass('tr_señalada');
				},5000);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function privado1(id_modelo){
		$.ajax({
			type: 'POST',
			url: '../script/crud_publicos1.php',
			data: {
				"id_modelo": id_modelo,
				"condicion": 'privado',
			},
			dataType: "JSON",
			success: function(respuesta) {
				console.log(respuesta);
				$('#publico_'+id_modelo).html('No');
				$('#tr_'+id_modelo).addClass('tr_señalada');
				setTimeout(function() {
					$('#tr_'+id_modelo).removeClass('tr_señalada');
				},5000);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

</script>
