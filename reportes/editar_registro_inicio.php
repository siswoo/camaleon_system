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
	<link rel="stylesheet" href="../css/bootstrap-select.css">
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

	<form id="formulario2" method="POST">
		<div class="seccion1">
		    <div class="row">
			    <div class="col-4 text-center">
			    	<?php $fecha_inicio=date('Y-m-d'); ?>
			    	<strong>Fecha:</strong> <?php echo $fecha_inicio; ?>
			    </div>
			    <div class="col-4 text-center">
			    	<strong>Responsable:</strong> <?php echo $fecha_inicio; ?>
			    </div>
			    <div class="col-4 text-center">
			    	<strong>Turno:</strong>
			    	<select name="turno" id="turno" class="">
			    		<option value="">Seleccione</option>
			    		<option value="Mañana">Mañana</option>
			    		<option value="Tarde">Tarde</option>
			    		<option value="Noche">Noche</option>
			    	</select>
			    </div>
			     <div class="col-12 text-center">
			    	<input type="submit" class="btn btn-danger" value="tester guardar">
			    </div>
			    <div class="col-12" style="padding-left: 1rem; padding-right: 1rem;">
			    	<table border="1" class="table table-dark table-striped mt-3">
			    		<thead>
				    		<tr>
				    			<td class="text-center">Rooms</td>
				    			<td class="text-center">Modelos</td>
				    			<td class="text-center">Monitores</td>
				    			<td class="text-center">Estado</td>
				    			<td class="text-center">Asunto</td>
				    			<!-- paginas -->
				    			<?php
				    			$sql1="SELECT * FROM paginas";
				    			$consulta1 = mysqli_query($conexion,$sql1);
				    			$contador1= 1;
				    			/*
				    			while($row = mysqli_fetch_array($consulta1)) {
									$paginas[$contador1]['id'] 		= $row['id'];
									$paginas[$contador1]['nombre'] 	= $row['nombre'];
									$paginas[$contador1]['tasa'] 	= $row['tasa'];
									$paginas[$contador1]['url'] 	= $row['url'];
									$paginas[$contador1]['moneda'] 	= $row['moneda'];
				    				echo '<td class="text-center">'.$paginas[$contador1]['nombre'].'</td>';
				    				$contador1=$contador1+1;
								}
								*/
								?>
				    			<!-- ******* -->
				    		</tr>
				    	</thead>
				    	<tbody>
				    		<?php
					    		$sql2="SELECT * FROM rooms WHERE sede = ".$_SESSION['sede'];
					    		$consulta2 = mysqli_query($conexion,$sql2);
					    		$fila1 = mysqli_num_rows($consulta2);
					    		$contador2 = 1;
					    		while($row2 = mysqli_fetch_array($consulta2)) {
					    			$room_id = $row2['id'];
					    			$room_nombre = $row2['nombre'];
					    			$room_color = $row2['color'];
					    			echo '
					    			<tr class="text-center">
								    	<th>'.$room_nombre.'</th>
								    ';
									?>
										<td>
											<select class="form-control form-control-xs selectpicker" name="select_modelos" id="select_modelos" data-size="10" data-live-search="true" data-title="select_modelos" data-width="100%">
												<option value="" selected>Seleccione</option>
												<?php
												$sql4="SELECT * FROM modelos_temporal LIMIT 10";
								    			$consulta4 = mysqli_query($conexion,$sql4);
								    			while($row4 = mysqli_fetch_array($consulta4)) {
								    				$modelos_id = $row4['id'];
								    				$modelos_nombre = $row4['nombre'];
								    				echo '
								    					<option value="'.$modelos_id.'">'.$modelos_nombre.'</option>
								    				';
								    			}
								    			?>
											</select>
										</td>
									    <td>
										    <select class="form-control form-control-xs selectpicker" name="select_monitores" id="select_monitores" data-size="7" data-live-search="true" data-title="select_monitores" data-width="100%">
												<option value="" selected>Seleccione</option>
									
								    <?php
								    $sql3="SELECT * FROM usuarios WHERE rol = 6";
								    $consulta3 = mysqli_query($conexion,$sql3);
								    while($row3 = mysqli_fetch_array($consulta3)) {
								    	$usuario_id = $row3['id'];
								    	$usuario_nombre = $row3['nombre'];
								    	$usuario_apellido = $row3['apellido'];
								    	echo '
								    		<option value="'.$usuario_id.'">'.$usuario_nombre.' '.$usuario_apellido.'</option>
								    	';
								    }
								    echo '
								    		</select>
								      	</td>
								      	<td class="text-center">
								      		<select class="form-control" name="estatus_'.$room_nombre.'" id="estatus_'.$room_nombre.'">
								      			<option value="Habilitado">Habilitado</option>
								      			<option value="Deshabilitado">Deshabilitado</option>
								      			<option value="Vacio">Vacio</option>
								      		</select>
								      	</td>
								      	<td class="text-center">
								      		<input type="text" class="form-control" name="asunto_'.$room_nombre.'" id="asunto_'.$room_nombre.'">
								      	</td>
								    ';
								    /*
								    for($i=1;$i<$contador1;$i++){
								    	echo '
									    	<td class="text-center">
									    		<input type="number" value="" class="form-control" id="'.$paginas[$i]['nombre'].'_'.$room_nombre.'_'.$i.'" name="pagina_'.$room_nombre.'_'.$i.'" style="width:80%; display:initial;" min="0">
									    	</td>
									    ';
								    }
								    */
								    echo '
								    </tr>
								    ';
								    $contador2 = $contador2 + 1;
					    		}
					    	?>
						</tbody>
			    	</table>
			    </div>
			</div>
		</div>
	</form>

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
<script src="../js/bootstrap-select.js"></script>

<script type="text/javascript">
	/*****************MODALES****************/
	$('#myModal').on('shown.bs.modal', function () {
	  	$('#myInput').trigger('focus')
	});
	/****************************************/


	$("#formulario2").on("submit", function(e){
		//console.log(variable);
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '../script/guardar_reporte_inicio1.php',
			data: $('#formulario2').serialize(),
			dataType: "JSON",
			success: function(respuesta) {
				console.log(respuesta);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	});


</script>
