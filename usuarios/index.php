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

	$ubicacion = "usuario";

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

	<form id="formulario1" method="POST">

		<input type="hidden" id="pasante_view" value="<?php echo $pasante_view; ?>">

		<input type="hidden" id="pasante_edit" value="<?php echo $pasante_edit; ?>">

		<input type="hidden" id="pasante_delete" value="<?php echo $pasante_delete; ?>">

		<!--*********************************************************************-->

		<input type="hidden" id="roles_view" value="<?php echo $roles_view; ?>">

		<input type="hidden" id="seguridad_view" value="<?php echo $seguridad_view; ?>">

		<input type="hidden" id="modelo_view" value="<?php echo $modelo_view; ?>">

		<!--*********************************************************************-->

	</form>



	<div class="seccion1">

	    <div class="row">

		    <div class="container_consulta1">

		    	

		    	<div class="row mb-3">

		    		<div class="col-md-12 text-right">

		    			<input type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal2" value="Nuevo Registro">

		    		</div>

		    	</div>



		    	<table id="example" class="table row-border hover table-bordered" style="font-size: 12px; color:rgba(50,55,66,1); border-radius: 5px;">

			        <thead>

			            <tr>

			                <th class="text-center">Nombre</th>

			                <th class="text-center">T Doc</th>

			                <th class="text-center">Nº Doc</th>

			                <th class="text-center">Correo</th>

			                <th class="text-center">usuario</th>

			                <th class="text-center">WhatsApp</th>

			                <th class="text-center">Telefono</th>

			                <th class="text-center">Rol Nivel</th>

			                <th class="text-center">Fecha Inicio</th>

			                <th class="text-center">Opciones</th>

			            </tr>

			        </thead>

			        <tbody id="resultados">

			        	<?php

			        	$condicion_administracion = 0;

			        	if($_SESSION['rol']==2){
			        		if($_SESSION["sede"]==1 or $_SESSION["sede"]==2 or $_SESSION["sede"]==3 or $_SESSION["sede"]==4){
					        	$separar_usuarios1 = ' and (sede = 1 or sede = 2 or sede = 3 or sede = 4)';
					        }else if($_SESSION["sede"]==6){
					        	$separar_usuarios1 = ' and (sede = 6)';
					        }else if($_SESSION["sede"]==7 or $_SESSION["sede"]==8 or $_SESSION["sede"]==9){
					       		$separar_usuarios1 = ' and (sede = 7 or sede = 8 or sede = 9)';
					       	}else if($_SESSION["sede"]==10){
					       		$separar_usuarios1 = ' and sede = 10';
					       	}

			        		$consulta2 = "SELECT * FROM usuarios WHERE rol = 9"." ".$separar_usuarios1;

			        	}else if($_SESSION['rol']==15){

			        		$sql3 = "SELECT * FROM usuarios WHERE id = ".$_SESSION['id'];

				        	$resultado3 = mysqli_query($conexion,$sql3);

							while($row3 = mysqli_fetch_array($resultado3)) {

								$usuario_documento = $row3['documento_numero'];



								if($usuario_documento=='1023886014'){

									$condicion_administracion = 1;

									$consulta2 = "SELECT * FROM usuarios WHERE (rol != 1 and rol != 99 and rol != 5 and rol != 4 and rol != 14 and rol !=15 and sede = 1) or (rol != 1 and rol != 99 and rol != 5 and rol != 4 and rol != 14 and rol !=15 and sede = 3)";

								}else if($usuario_documento=='24616438'){

									$condicion_administracion = 2;

									$consulta2 = "SELECT * FROM usuarios WHERE (rol != 1 and rol != 99 and rol != 5 and rol != 4 and rol != 14 and rol !=15 and sede = 2) or (rol != 1 and rol != 99 and rol != 5 and rol != 4 and rol != 14 and rol !=15 and sede = 4)";

								}else{

									$consulta2 = "SELECT * FROM usuarios WHERE rol != 1 and rol != 99";

								}

							}

			        	}else{

			        		$consulta2 = "SELECT * FROM usuarios WHERE rol != 1 and rol != 99";

			        	}

						$resultado2 = mysqli_query( $conexion, $consulta2 );

						while($row2 = mysqli_fetch_array($resultado2)) {

							$id 				= $row2['id'];

							$nombre 			= $row2['nombre'];

							$apellido 			= $row2['apellido'];

							$documento_tipo 	= $row2['documento_tipo'];

							$documento_numero 	= $row2['documento_numero'];

							$correo 			= $row2['correo'];

							$usuario 			= $row2['usuario'];

							$telefono1 			= $row2['telefono1'];

							$telefono2 			= $row2['telefono2'];

							$rol 				= $row2['rol'];

							$fecha_inicio 		= $row2['fecha_inicio'];

							echo '

								<tr>

					                <td class="text-center">'.$nombre.' '.$apellido.'</td>

					                <td class="text-center">'.$documento_tipo.'</td>

					                <td class="text-center">'.$documento_numero.'</td>

					                <td class="text-center">'.$correo.'</td>

					                <td class="text-center">'.$usuario.'</td>

					                <td class="text-center">'.$telefono1.'</td>

					                <td class="text-center">'.$telefono2.'</td>

					            ';

					        	$sql_rol2 = "SELECT * FROM roles WHERE id = ".$rol." LIMIT 1";

									$resultado_rol2 = mysqli_query($conexion, $sql_rol2);

									while($row4 = mysqli_fetch_array($resultado_rol2)) {

										$rol_id2 = $row4['id'];

										$rol_nombre2 = $row4['nombre'];

										echo '<td class="text-center">'.$rol_nombre2.'</td>';

									}

								echo '

					                <td class="text-center">'.$fecha_inicio.'</td>

					                <td class="text-center">

					                	<i class="fas fa-edit" style="color:#0095ff; cursor:pointer;" title="" value="'.$id.'" data-toggle="modal" data-target="#exampleModal" onclick="modal_edit('.$id.');"></i>

					                	<i class="fas fa-trash-alt ml-3" style="color:red; cursor:pointer;" data-toggle="popover-hover" onclick="eliminar('.$id.');" value="'.$id.'"></i>

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



<!-- Modal Editar Registro -->

	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

		<div class="modal-dialog" role="document">

			<form action="#" method="POST" id="form_modal_edit" style="">

				<input type="hidden" name="edit_id" id="edit_id">

				<div class="modal-content">

					<div class="modal-header">

						<h5 class="modal-title" id="exampleModalLabel">Editar Registro</h5>

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">

							<span aria-hidden="true">&times;</span>

						</button>

					</div>

					<div class="modal-body">

					    <div class="row">

						    <div class="col-6 form-group form-check">

							    <label for="edit_documento_tipo">Tipo de Documento <small style="color:#F2B76F; font-size: 17px;">*</small></label>

							    <select name="edit_documento_tipo" id="edit_documento_tipo" class="form-control" required>

							    	<option value="">Seleccione</option>

							    	<option value="Cedula de Ciudadania">Cedula de Ciudadania</option>

							    	<option value="Cedula de Extranjeria">Cedula de Extranjeria</option>

							    	<option value="PEP">PEP</option>

							    	<option value="Pasaporte">Pasaporte</option>

							    </select>

						    </div>

						    <div class="col-6 form-group form-check">

							    <label for="edit_documento_numero">Número de Documento <small style="color:#F2B76F; font-size: 17px;">*</small></label>

							    <input type="text" name="edit_documento_numero" id="edit_documento_numero" class="form-control" minlength="6" autocomplete="off" required>

						    </div>

				    	</div>



					    <div class="row">

						    <div class="col-6 form-group form-check">

							    <label for="edit_nombre">Nombre <small style="color:#F2B76F; font-size: 17px;">*</small></label>

							    <input type="text" name="edit_nombre" id="edit_nombre" class="form-control" autocomplete="off" required>

						    </div>

						    <div class="col-6 form-group form-check">

							    <label for="edit_apellido">Apellido <small style="color:#F2B76F; font-size: 17px;">*</small></label>

							    <input type="text" name="edit_apellido" id="edit_apellido" class="form-control" autocomplete="off" required>

						    </div>

					    </div>



					    <div class="row">

						    <div class="col-6 form-group form-check">

							    <label for="edit_correo">Correo <small style="color:#F2B76F; font-size: 17px;">*</small></label>

							    <input type="email" name="edit_correo" id="edit_correo" class="form-control" autocomplete="off" required>

						    </div>



						    <div class="col-6 form-group form-check">

							    <label for="edit_usuario">Usuario <small style="color:#F2B76F; font-size: 17px;">*</small></label>

							    <input type="text" name="edit_usuario" id="edit_usuario" class="form-control" autocomplete="off" required>

						    </div>



						    <div class="col-6 form-group form-check">

							    <label for="edit_telefono1">WhatsApp <small style="color:#F2B76F; font-size: 17px;">*</small></label>

							    <input type="text" name="edit_telefono1" id="edit_telefono1" class="form-control" autocomplete="off" required>

						    </div>



						    <div class="col-6 form-group form-check">

							    <label for="edit_telefono2">Teléfono</label>

							    <input type="text" name="edit_telefono2" id="edit_telefono2" class="form-control" autocomplete="off">

						    </div>



						    <div class="col-6 form-group form-check">

							    <label for="edit_rol">Rol</label>

							    <input type="text" name="edit_rol" id="edit_rol" class="form-control" autocomplete="off" disabled>

						    </div>



						    <div class="col-6 form-group form-check">

							    <label for="rol">Sedes <small style="color:#F2B76F; font-size: 17px;">*</small></label>

							    <select class="form-control" name="edit_sedes" id="edit_sedes" required>

							    	<option value="">Seleccione</option>

							    	<?php

							    	if($condicion_administracion == 1){

							    		$sql_sedes = "SELECT * FROM sedes WHERE id = 1 or id = 3";	

							    	}else if($condicion_administracion == 2){

							    		$sql_sedes = "SELECT * FROM sedes WHERE id = 2 or id = 4";

							    	}else{

							    		if($_SESSION["sede"]==1 or $_SESSION["sede"]==2 or $_SESSION["sede"]==3 or $_SESSION["sede"]==4){

								        	$separar_sedes1 = ' or (id = 1 or id = 2 or id = 3 or id = 4)';

								        }else if($_SESSION["sede"]==6){

								        	$separar_sedes1 = ' or (id = 6)';

								        }else if($_SESSION["sede"]==7 or $_SESSION["sede"]==8 or $_SESSION["sede"]==9){

								       		$separar_sedes1 = ' or (id = 7 or id = 8 or id = 9)';

								       	}

							    		$sql_sedes = "SELECT * FROM sedes WHERE id = 999999"." ".$separar_sedes1;

							    	}

									$resultado_sedes = mysqli_query($conexion,$sql_sedes);

									while($row4 = mysqli_fetch_array($resultado_sedes)) {

										$sedes_id = $row4['id'];

										$sedes_nombre = $row4['nombre'];

										echo '<option value="'.$sedes_id.'">'.$sedes_nombre.'</option>';

									}

							    	?>

							    </select>

						    </div>

					    </div>

					</div>

					<div class="modal-footer">

				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

				        <button type="submit" class="btn btn-success" id="edit_submit">Guardar</button>

			      	</div>

		      	</form>

	    	</div>

	  	</div>

	</div>

<!-- FIN Modal Editar Registro -->





<!-- Modal Crear Registro -->

	<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

		<div class="modal-dialog" role="document">

			<form action="#" method="POST" id="form_modal_new" style="">

				<div class="modal-content">

					<div class="modal-header">

						<h5 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h5>

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">

							<span aria-hidden="true">&times;</span>

						</button>

					</div>

					<div class="modal-body">

					    <div class="row">

						    <div class="col-6 form-group form-check">

							    <label for="tipo_documento">Tipo de Documento <small style="color:#F2B76F; font-size: 17px;">*</small></label>

							    <select name="tipo_documento" id="tipo_documento" class="form-control" required>

							    	<option value="">Seleccione</option>

							    	<option value="Cedula de Ciudadania">Cedula de Ciudadania</option>

							    	<option value="Cedula de Extranjeria">Cedula de Extranjeria</option>

							    	<option value="PEP">PEP</option>

							    	<option value="Pasaporte">Pasaporte</option>

							    </select>

						    </div>

						    <div class="col-6 form-group form-check">

							    <label for="numero_documento">Número de Documento <small style="color:#F2B76F; font-size: 17px;">*</small></label>

							    <input type="text" name="numero_documento" id="numero_documento" class="form-control" minlength="6" autocomplete="off" required>

						    </div>

				    	</div>



					    <div class="row">

						    <div class="col-6 form-group form-check">

							    <label for="primer_nombre">Primer Nombre <small style="color:#F2B76F; font-size: 17px;">*</small></label>

							    <input type="text" name="primer_nombre" id="primer_nombre" class="form-control" autocomplete="off" required>

						    </div>

						    <div class="col-6 form-group form-check">

							    <label for="primer_apellido">Primer Apellido <small style="color:#F2B76F; font-size: 17px;">*</small></label>

							    <input type="text" name="primer_apellido" id="primer_apellido" class="form-control" autocomplete="off" required>

						    </div>

					    </div>



					    <div class="row">

						    <div class="col-6 form-group form-check">

							    <label for="correo">Correo <small style="color:#F2B76F; font-size: 17px;">*</small></label>

							    <input type="email" name="correo" id="correo" class="form-control" autocomplete="off" required>

						    </div>



						    <div class="col-6 form-group form-check">

							    <label for="telefono1">Teléfono Principal <small style="color:#F2B76F; font-size: 17px;">*</small></label>

							    <input type="text" name="telefono1" id="telefono1" class="form-control" autocomplete="off" required>

						    </div>



						    <div class="col-6 form-group form-check">

							    <label for="usuario">Usuario <small style="color:#F2B76F; font-size: 17px;">*</small></label>

							    <input type="text" name="usuario" id="usuario" class="form-control" autocomplete="off" required>

						    </div>



						    <div class="col-6 form-group form-check">

							    <label for="clave">Clave <small style="color:#F2B76F; font-size: 17px;">*</small></label>

							    <input type="password" name="clave" id="clave" class="form-control" autocomplete="off" required>

						    </div>



						    <div class="col-6 form-group form-check">

							    <label for="rol">Rol <small style="color:#F2B76F; font-size: 17px;">*</small></label>

							    <select class="form-control" name="rol" id="rol" required>

							    	<option value="">Seleccione</option>

							    	<?php

							    	if($condicion_administracion == 1){

							    		$sql_rol = "SELECT * FROM roles WHERE id != 1 and id != 4 and id != 5 and id != 13 and id != 14 and id != 15";

							    	}else if($condicion_administracion == 2){

							    		$sql_rol = "SELECT * FROM roles WHERE id != 1 and id != 4 and id != 5 and id != 13 and id != 14 and id != 15";

							    	}else if($_SESSION['rol']==2){

								    	$sql_rol = "SELECT * FROM roles WHERE id = 9";	

								    }else{

								    	$sql_rol = "SELECT * FROM roles WHERE id != 1 and id!=5";

								    }

								    

							    	$resultado_rol = mysqli_query($conexion,$sql_rol);

									while($row3 = mysqli_fetch_array($resultado_rol)) {

										$rol_id = $row3['id'];

										$rol_nombre = $row3['nombre'];

										echo '<option value="'.$rol_id.'">'.$rol_nombre.'</option>';

									}

							    	?>

							    </select>

						    </div>



						    <div class="col-6 form-group form-check">

							    <label for="rol">Sedes <small style="color:#F2B76F; font-size: 17px;">*</small></label>

							    <select class="form-control" name="sedes" id="sedes" required>

							    	<option value="">Seleccione</option>

							    	<?php

							    	if($condicion_administracion == 1){

							    		$sql_sedes = "SELECT * FROM sedes WHERE id = 1 or id = 3";	

							    	}else if($condicion_administracion == 2){

							    		$sql_sedes = "SELECT * FROM sedes WHERE id = 2 or id = 4";

							    	}else{

							    		if($_SESSION["sede"]==1 or $_SESSION["sede"]==2 or $_SESSION["sede"]==3 or $_SESSION["sede"]==4){

								        	$separar_sedes1 = ' or (id = 1 or id = 2 or id = 3 or id = 4)';

								        }else if($_SESSION["sede"]==6){

								        	$separar_sedes1 = ' or (id = 6)';

								        }else if($_SESSION["sede"]==7 or $_SESSION["sede"]==8 or $_SESSION["sede"]==9){

								       		$separar_sedes1 = ' or (id = 7 or id = 8 or id = 9)';

								       	}

							    		$sql_sedes = "SELECT * FROM sedes WHERE id = 9999999"." ".$separar_sedes1;	

							    	}

									$resultado_sedes = mysqli_query($conexion,$sql_sedes);

									while($row4 = mysqli_fetch_array($resultado_sedes)) {

										$sedes_id = $row4['id'];

										$sedes_nombre = $row4['nombre'];

										echo '<option value="'.$sedes_id.'">'.$sedes_nombre.'</option>';

									}

							    	?>

							    </select>

						    </div>



						    <!--

						    <div class="col-12 form-group form-check">

							    <label for="direccion">Dirección (Opcional)</label>

							    <textarea name="direccion" id="direccion" class="form-control" autocomplete="off" required></textarea>

						    </div>

							-->

					    </div>

					</div>

					<div class="modal-footer">

				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

				        <button type="submit" class="btn btn-success">Guardar</button>

			      	</div>

		      	</form>

	    	</div>

	  	</div>

	</div>

<!-- FIN Modal Nuevo Registro -->



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



    	$('#select_equipo').change(function (){

			var div = $('#select_equipo');

			var variable = $('#select_equipo').val();

			if(variable != '' && variable != 1){

				//$('#divEquipos').removeClass('d-none');

				$('#divEquipos').show();

				$.ajax({

					type: 'POST',

					url: '../script/equipos_select1.php',

					data: {

						"equipo": variable

					},

					/*dataType: "JSON",*/

					success: function(respuesta) {

						//console.log(respuesta);

						$('#select_enlazar').html(respuesta);



					},



					error: function(respuesta) {

						console.log('Error...'+respuesta);

					}

				});

			}else{

				$('#divEquipos').hide();

			}

		});



	} );



    function filtros(variable){

	var condicional = variable;

	var modelo_view = $('#modelo_view').val();

	var modelo_edit = $('#modelo_edit').val();

	var modelo_delete = $('#modelo_delete').val();

	var respuesta = $('#resultados');

	    $.ajax({

			type: 'POST',

			url: '../script/modelo_consultas.php',

			data: {

				"modelo_view": modelo_view,

				"modelo_edit": modelo_edit,

				"modelo_delete": modelo_delete,

				"condicional": condicional

			},



			success: function(respuesta) {

				$('#example').DataTable().destroy();

				$('#resultados').html(respuesta);

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

			},



			error: function(respuesta) {

				console.log('Error...'+respuesta);

			}

		});

	};



	$('#myModal').on('shown.bs.modal', function () {

	  	$('#myInput').trigger('focus')

	});



	/*************LLENAR FORM EDIT*******************/



	function modal_edit (variable) {

		$.ajax({

			type: 'POST',

			url: '../script/usuario_model_editar.php',

			dataType: "JSON",

			data: {

				"variable": variable,

			},



			success: function(respuesta) {

				$('#edit_id').val(respuesta['id']);

				$('#edit_documento_tipo').val(respuesta['documento_tipo']);

				$('#edit_documento_numero').val(respuesta['documento_numero']);

				$('#edit_nombre').val(respuesta['nombre']);

				$('#edit_apellido').val(respuesta['apellido']);

				$('#edit_correo').val(respuesta['correo']);

				$('#edit_usuario').val(respuesta['usuario']);

				$('#edit_telefono1').val(respuesta['telefono1']);

				$('#edit_telefono2').val(respuesta['telefono2']);

				$('#edit_rol').val(respuesta['rol']);

				$('#edit_sedes').val(respuesta['sedes']);

				$('#edit_fecha_inicio').val(respuesta['fecha_inicio']);

			},



			error: function(respuesta) {

				console.log(respuesta['responseText']);

			}

		});

	}



	/**********FIN LLENAR FORM EDIT******************/



	$("#form_modal_edit").on("submit", function(e){

		e.preventDefault();

		var f = $(this);

	    $.ajax({

			type: 'POST',

			url: '../script/editar_usuario.php',

			data: $('#form_modal_edit').serialize(),

			dataType: "JSON",

			success: function(respuesta) {

				console.log(respuesta);

				$('#edit_submit').addClass('d-none');

				Swal.fire({

					position: 'center',

					icon: 'success',

					title: 'Modificado exitosamente...!',

					showConfirmButton: false,

					timer: 3000

				});

				setTimeout(function() {

					window.location.href = "index.php";

				},3100);

			},



			error: function(respuesta) {

				console.log(respuesta['responseText']);

			}

		});

	});





	$("#form_modal_new").on("submit", function(e){

		e.preventDefault();

		var f = $(this);

		var tipo_documento 		= $('#tipo_documento').val();

		var numero_documento 	= $('#numero_documento').val();

		var primer_nombre 		= $('#primer_nombre').val();

		var primer_apellido 	= $('#primer_apellido').val();

		var correo 				= $('#correo').val();

		var telefono1 			= $('#telefono1').val();

		var sedes 				= $('#sedes').val();



	    $.ajax({

			type: 'POST',

			url: '../script/guardar_usuario1.php',

			data: $('#form_modal_new').serialize(),

			dataType: "JSON",

			success: function(respuesta) {

				console.log(respuesta);

				if(respuesta['resultado'] == 'no'){

					Swal.fire({

						position: 'center',

						icon: 'error',

						title: 'Error!',

						text: 'Ya existe ese nombre de usuario',

						showConfirmButton: true,

						timer: 3000

					})

				}



				if(respuesta['resultado'] == 'ok'){

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





	/*****************CAMPOS DE PRUEBA*******************/

	/*

	$(document).ready(function() {

		$('#tipo_documento').val('PEP');

		$('#numero_documento').val(111111111);

		$('#primer_nombre').val(222222222222222);

		$('#primer_apellido').val(3333333333333333);

		$('#correo').val('44444444@gmail.com');

		$('#telefono1').val('55555555555555');

		$('#direccion').val('66666666666666666666');

		$('#usuario').val('test1');

		$('#clave').val('test');

	});

	*/

	/*****************************************************/



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

				url: '../script/eliminar_usuario.php',

				data: {"variable": variable},

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

	}



</script>

