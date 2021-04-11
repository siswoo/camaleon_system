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
	$ubicacion = "funciones";
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
	    	<div class="col-12 mb-3 text-right">
				<button type="button" class="btn btn-primary" style="margin-right: 2rem;" data-toggle="modal" data-target="#exampleModal1">Registro Nuevo</button>
			</div>

		    <div class="container_consulta1">
		    	<table id="example" class="table row-border hover table-bordered" style="font-size: 12px; color:rgba(50,55,66,1); border-radius: 5px;">
			        <thead>
			            <tr>
			                <th class="text-center">ID</th>
			                <th class="text-center">Nombre</th>
			                <th class="text-center">Cargo</th>
			                <th class="text-center">Responsable</th>
			                <th class="text-center">Fecha Creación</th>
			                <th class="text-center">Opciones</th>
			            </tr>
			        </thead>
			        <tbody id="resultados">
			        	<?php
			        		$sql1 = "SELECT * FROM funciones";
			        		$consulta1 = mysqli_query($conexion,$sql1);
			        		while($row1 = mysqli_fetch_array($consulta1)) {
			        			$id = $row1['id'];
			        			$nombre = $row1['nombre'];
			        			$responsable = $row1['responsable'];
			        			$cargo = $row1['cargo'];
			        			$fecha_inicio = $row1['fecha_inicio'];

			        			$sql2 = "SELECT * FROM usuarios WHERE id = ".$responsable;
			        			$consulta2 = mysqli_query($conexion,$sql2);
			        			while($row2 = mysqli_fetch_array($consulta2)) {
			        				$responsable_nombre = $row2['nombre']." ".$row2['apellido'];
			        			}
			        			if($cargo==0){
			        				$cargo_nombre = "Sin asignar";
			        			}else{
				        			$sql3 = "SELECT * FROM cargos WHERE id = ".$cargo;
				        			$consulta3 = mysqli_query($conexion,$sql3);
				        			while($row3 = mysqli_fetch_array($consulta3)) {
				        				$cargo_nombre = $row3['nombre'];
				        			}
			        			}

			        			echo '
			        				<tr id="tr_'.$id.'">
			        					<td class="text-center" id="id_'.$id.'">'.$id.'</td>
			        					<td class="text-center" id="nombre_'.$id.'">'.$nombre.'</td>
			        					<td class="text-center" id="cargo_'.$id.'">'.$cargo_nombre.'</td>
			        					<td class="text-center" id="responsable_'.$id.'">'.$responsable_nombre.'</td>
			        					<td class="text-center" id="fecha_inicio_'.$id.'">'.$fecha_inicio.'</td>
			        					<td class="text-center" nowrap="nowrap">
			        						<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2" onclick="editar1('.$id.');">Editar</button>
			        						<!--<button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal3" onclick="eliminar1('.$id.');">Eliminar</button>-->
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

<!-- Modal Crear Registro -->
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
						    <div class="col-6 form-group form-check">
							    <label for="nombre">Nombre</label>
							    <input type="text" name="nombre" id="nombre" class="form-control" autocomplete="off" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="cargo">Cargo</label>
							    <select id="cargo" name="cargo" class="form-control" required>
							    	<option value="">Seleccione</option>
							    	<?php
							    	$sql4 = "SELECT * FROM cargos";
				        			$consulta4 = mysqli_query($conexion,$sql4);
				        			while($row4 = mysqli_fetch_array($consulta4)) {
				        				$cargo_id = $row4["id"];
				        				$cargo_nombre = $row4["nombre"];
				        				echo '
				        					<option value="'.$cargo_id.'">'.$cargo_nombre.'</option>
				        				';
				        			}
							    	?>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="descripcion1">Descripción #1</label>
							    <textarea class="form-control" id="descripcion1" name="descripcion1" autocomplete="off" required></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="descripcion2">Descripción #2</label>
							    <textarea class="form-control" id="descripcion2" name="descripcion2" autocomplete="off"></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="descripcion3">Descripción #3</label>
							    <textarea class="form-control" id="descripcion3" name="descripcion3" autocomplete="off"></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="descripcion4">Descripción #4</label>
							    <textarea class="form-control" id="descripcion4" name="descripcion4" autocomplete="off"></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="descripcion5">Descripción #5</label>
							    <textarea class="form-control" id="descripcion5" name="descripcion5" autocomplete="off"></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="descripcion6">Descripción #6</label>
							    <textarea class="form-control" id="descripcion6" name="descripcion6" autocomplete="off"></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="descripcion7">Descripción #7</label>
							    <textarea class="form-control" id="descripcion7" name="descripcion7" autocomplete="off"></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="descripcion8">Descripción #8</label>
							    <textarea class="form-control" id="descripcion8" name="descripcion8" autocomplete="off"></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="descripcion9">Descripción #9</label>
							    <textarea class="form-control" id="descripcion9" name="descripcion9" autocomplete="off"></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="descripcion10">Descripción #10</label>
							    <textarea class="form-control" id="descripcion10" name="descripcion10" autocomplete="off"></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="descripcion11">Descripción #11</label>
							    <textarea class="form-control" id="descripcion11" name="descripcion11" autocomplete="off"></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="descripcion12">Descripción #12</label>
							    <textarea class="form-control" id="descripcion12" name="descripcion12" autocomplete="off"></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="descripcion13">Descripción #13</label>
							    <textarea class="form-control" id="descripcion13" name="descripcion13" autocomplete="off"></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="descripcion14">Descripción #14</label>
							    <textarea class="form-control" id="descripcion14" name="descripcion14" autocomplete="off"></textarea>
						    </div>
						    <div class="col-12 form-group form-check">
							    <label for="descripcion15">Descripción #15</label>
							    <textarea class="form-control" id="descripcion15" name="descripcion15" autocomplete="off"></textarea>
						    </div>
					    </div>
					</div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" class="btn btn-success" id="submit_guardar1">Guardar</button>
			      	</div>
		      	</form>
	    	</div>
	  	</div>
	</div>
<!-- FIN Modal Nuevo Registro -->

<!-- Modal Editar Registro -->
	<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_edit" style="">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Registro</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row">
					    	<input type="hidden" name="edit_id" id="edit_id">
						    <div class="col-6 form-group form-check">
							    <label for="edit_nombre">Nombre</label>
							    <input type="text" id="edit_nombre" name="edit_nombre" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_cargo">Cargo</label>
							    <select id="edit_cargo" name="edit_cargo" class="form-control" required>
							    	<option value="">Seleccione</option>
							    	<?php
							    	$sql4 = "SELECT * FROM cargos";
				        			$consulta4 = mysqli_query($conexion,$sql4);
				        			while($row4 = mysqli_fetch_array($consulta4)) {
				        				$cargo_id = $row4["id"];
				        				$cargo_nombre = $row4["nombre"];
				        				echo '
				        					<option value="'.$cargo_id.'">'.$cargo_nombre.'</option>
				        				';
				        			}
							    	?>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_descripcion1">Descripción #1</label>
							    <textarea class="form-control" id="edit_descripcion1" name="edit_descripcion1" autocomplete="off" required></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_descripcion2">Descripción #2</label>
							    <textarea class="form-control" id="edit_descripcion2" name="edit_descripcion2" autocomplete="off"></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_descripcion3">Descripción #3</label>
							    <textarea class="form-control" id="edit_descripcion3" name="edit_descripcion3" autocomplete="off"></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_descripcion4">Descripción #4</label>
							    <textarea class="form-control" id="edit_descripcion4" name="edit_descripcion4" autocomplete="off"></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_descripcion5">Descripción #5</label>
							    <textarea class="form-control" id="edit_descripcion5" name="edit_descripcion5" autocomplete="off"></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_descripcion6">Descripción #6</label>
							    <textarea class="form-control" id="edit_descripcion6" name="edit_descripcion6" autocomplete="off"></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_descripcion7">Descripción #7</label>
							    <textarea class="form-control" id="edit_descripcion7" name="edit_descripcion7" autocomplete="off"></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_descripcion8">Descripción #8</label>
							    <textarea class="form-control" id="edit_descripcion8" name="edit_descripcion8" autocomplete="off"></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_descripcion9">Descripción #9</label>
							    <textarea class="form-control" id="edit_descripcion9" name="edit_descripcion9" autocomplete="off"></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_descripcion10">Descripción #10</label>
							    <textarea class="form-control" id="edit_descripcion10" name="edit_descripcion10" autocomplete="off"></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_descripcion11">Descripción #11</label>
							    <textarea class="form-control" id="edit_descripcion11" name="edit_descripcion11" autocomplete="off"></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_descripcion12">Descripción #12</label>
							    <textarea class="form-control" id="edit_descripcion12" name="edit_descripcion12" autocomplete="off"></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_descripcion13">Descripción #13</label>
							    <textarea class="form-control" id="edit_descripcion13" name="edit_descripcion13" autocomplete="off"></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_descripcion14">Descripción #14</label>
							    <textarea class="form-control" id="edit_descripcion14" name="edit_descripcion14" autocomplete="off"></textarea>
						    </div>
						    <div class="col-12 form-group form-check">
							    <label for="edit_descripcion15">Descripción #15</label>
							    <textarea class="form-control" id="edit_descripcion15" name="edit_descripcion15" autocomplete="off"></textarea>
						    </div>
					    </div>
					</div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" class="btn btn-success" id="submit_edit1">Guardar</button>
			      	</div>
		      	</form>
	    	</div>
	  	</div>
	</div>
<!-- FIN Modal Editar Registro -->


<!-- Modal Editar Bancarios -->
	<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_bancario" style="">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Datos Bancarios</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row">
					    	<input type="hidden" name="edit_bancario_id" id="edit_bancario_id">
						    <div class="col-6 form-group form-check">
							    <label for="edit_bancario_bcpp">Cuenta Propia o Prestada?</label>
							    <select name="edit_bancario_bcpp" id="edit_bancario_bcpp" class="form-control" required>
							    	<option value="">Seleccione</option>
							    	<option value="Propia">Propia</option>
							    	<option value="Prestada">Prestada</option>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_bancario_cedula">Cédula del titular</label>
							    <input type="text" name="edit_bancario_cedula" id="edit_bancario_cedula" class="form-control" minlength="6" autocomplete="off" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_bancario_nombre">Nombre Titular</label>
							    <input type="text" name="edit_bancario_nombre" id="edit_bancario_nombre" class="form-control" autocomplete="off" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_bancario_tipo_cuenta">Tipo de Cuenta</label>
							    <select name="edit_bancario_tipo_cuenta" id="edit_bancario_tipo_cuenta" class="form-control" required>
							    	<option value="">Seleccione</option>
							    	<option value="Ahorro">Ahorro</option>
							    	<option value="Corriente">Corriente</option>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_bancario_numero_cuenta">Número de Cuenta</label>
							    <input type="text" name="edit_bancario_numero_cuenta" id="edit_bancario_numero_cuenta" class="form-control" autocomplete="off" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_bancario_banco">Banco</label>
							    <select name="edit_bancario_banco" id="edit_bancario_banco" class="form-control" required="">
									<option value="">Seleccione</option>
									<option value="Banco Agrario de Colombia">Banco Agrario de Colombia</option>
									<option value="Banco AV Villas">Banco AV Villas</option>
									<option value="Banco Caja Social">Banco Caja Social</option>
									<option value="Banco de Occidente (Colombia)">Banco de Occidente (Colombia)</option>
									<option value="Banco Popular (Colombia)">Banco Popular (Colombia)</option>
									<option value="Bancolombia">Bancolombia</option>
									<option value="BBVA Colombia">BBVA Colombia</option>
									<option value="BBVA Movil">BBVA Movil</option>
									<option value="Banco de Bogotá">Banco de Bogotá</option>
									<option value="Colpatria">Colpatria</option>
									<option value="Davivienda">Davivienda</option>
									<option value="ITAU CorpBanca">ITAU CorpBanca</option>
									<option value="Citibank">Citibank</option>
									<option value="GNB Sudameris">GNB Sudameris</option>
									<option value="ITAU">ITAU</option>
									<option value="Scotiabank">Scotiabank</option>
									<option value="Bancoldex">Bancoldex</option>
									<option value="JPMorgan">JPMorgan</option>
									<option value="BNP Paribas">BNP Paribas</option>
									<option value="Banco ProCredit">Banco ProCredit</option>
									<option value="Banco Pichincha">Banco Pichincha</option>
									<option value="Bancoomeva">Bancoomeva</option>
									<option value="Banco Finandina">Banco Finandina</option>
									<option value="Banco CoopCentral">Banco CoopCentral</option>
									<option value="Compensar">Compensar</option>
									<option value="Aportes en linea">Aportes en linea</option>
									<option value="Asopagos">Asopagos</option>
									<option value="Fedecajas">Fedecajas</option>
									<option value="Simple">Simple</option>
									<option value="Enlace Operativo">Enlace Operativo</option>
									<option value="CorfiColombiana">CorfiColombiana</option>
									<option value="Old Mutual">Old Mutual</option>
									<option value="Cotrafa">Cotrafa</option>
									<option value="Confiar">Confiar</option>
									<option value="JurisCoop">JurisCoop</option>
									<option value="Deceval">Deceval</option>
									<option value="Bancamia">Bancamia</option>
									<option value="Nequi">Nequi</option>
									<option value="Falabella">Falabella</option>
									<option value="DGCPTN">DGCPTN</option>
									<option value="BANCO WWB">BANCO WWB</option>
									<option value="Cooperativa Financiera de Antioquia">Cooperativa Financiera de Antioquia</option>
								</select>
						    </div>
						</div>
					</div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" class="btn btn-success" id="submit_edit_bancario1">Guardar</button>
			      	</div>
			    </div>
		      </form>
	    </div>
	</div>
<!-- FIN Modal Editar Bancarios -->

<!-- Modal Editar Documentos -->
	<div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_documentos" style="">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Visualizar Documentos</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" id="respuesta_documentos1"></div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			      	</div>
			    </div>
		      </form>
	    </div>
	</div>
<!-- FIN Modal Editar Documentos -->

<!-- Modal Editar Contrato -->
	<div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_contratos">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Visualizar Contrato</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" id="respuesta_contratos1"></div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			      	</div>
			    </div>
		      </form>
	    </div>
	</div>
<!-- FIN Modal Editar Contrato -->

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

	$("#form_modal_new").on("submit", function(e){
		e.preventDefault();
		var f = $(this);
		var nombre = $('#nombre').val();
		var cargo = $('#cargo').val();
		var descripcion1 = $('#descripcion1').val();
		var descripcion2 = $('#descripcion2').val();
		var descripcion3 = $('#descripcion3').val();
		var descripcion4 = $('#descripcion4').val();
		var descripcion5 = $('#descripcion5').val();
		var descripcion6 = $('#descripcion6').val();
		var descripcion7 = $('#descripcion7').val();
		var descripcion8 = $('#descripcion8').val();
		var descripcion9 = $('#descripcion9').val();
		var descripcion10 = $('#descripcion10').val();
		var descripcion11 = $('#descripcion11').val();
		var descripcion12 = $('#descripcion12').val();
		var descripcion13 = $('#descripcion13').val();
		var descripcion14 = $('#descripcion14').val();
		var descripcion15 = $('#descripcion15').val();

	    $.ajax({
			type: 'POST',
			url: '../script/crud_funciones.php',
			data: {
				"nombre": nombre,
				"cargo": cargo,
				"descripcion1": descripcion1,
				"descripcion2": descripcion2,
				"descripcion3": descripcion3,
				"descripcion4": descripcion4,
				"descripcion5": descripcion5,
				"descripcion6": descripcion6,
				"descripcion7": descripcion7,
				"descripcion8": descripcion8,
				"descripcion9": descripcion9,
				"descripcion10": descripcion10,
				"descripcion11": descripcion11,
				"descripcion12": descripcion12,
				"descripcion13": descripcion13,
				"descripcion14": descripcion14,
				"descripcion15": descripcion15,
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

	function editar1(id){
		$.ajax({
			type: 'POST',
			url: '../script/crud_funciones.php',
			data: {
				"id": id,
				"condicion": "consultar1",
			},
			dataType: "JSON",
			success: function(respuesta) {
				console.log(respuesta);
				$("#edit_id").val(id);
				$("#edit_nombre").val(respuesta["nombre"]);
				$("#edit_cargo").val(respuesta["cargo"]);
				$("#edit_descripcion1").val(respuesta["descripcion1"]);
				$("#edit_descripcion2").val(respuesta["descripcion2"]);
				$("#edit_descripcion3").val(respuesta["descripcion3"]);
				$("#edit_descripcion4").val(respuesta["descripcion4"]);
				$("#edit_descripcion5").val(respuesta["descripcion5"]);
				$("#edit_descripcion6").val(respuesta["descripcion6"]);
				$("#edit_descripcion7").val(respuesta["descripcion7"]);
				$("#edit_descripcion8").val(respuesta["descripcion8"]);
				$("#edit_descripcion9").val(respuesta["descripcion9"]);
				$("#edit_descripcion10").val(respuesta["descripcion10"]);
				$("#edit_descripcion11").val(respuesta["descripcion11"]);
				$("#edit_descripcion12").val(respuesta["descripcion12"]);
				$("#edit_descripcion13").val(respuesta["descripcion13"]);
				$("#edit_descripcion14").val(respuesta["descripcion14"]);
				$("#edit_descripcion15").val(respuesta["descripcion15"]);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	$("#form_modal_edit").on("submit", function(e){
		e.preventDefault();
		var f = $(this);
		var id = $('#edit_id').val();
		var nombre = $('#edit_nombre').val();
		var cargo = $('#edit_cargo').val();
		var descripcion1 = $('#edit_descripcion1').val();
		var descripcion2 = $('#edit_descripcion2').val();
		var descripcion3 = $('#edit_descripcion3').val();
		var descripcion4 = $('#edit_descripcion4').val();
		var descripcion5 = $('#edit_descripcion5').val();
		var descripcion6 = $('#edit_descripcion6').val();
		var descripcion7 = $('#edit_descripcion7').val();
		var descripcion8 = $('#edit_descripcion8').val();
		var descripcion9 = $('#edit_descripcion9').val();
		var descripcion10 = $('#edit_descripcion10').val();
		var descripcion11 = $('#edit_descripcion11').val();
		var descripcion12 = $('#edit_descripcion12').val();
		var descripcion13 = $('#edit_descripcion13').val();
		var descripcion14 = $('#edit_descripcion14').val();
		var descripcion15 = $('#edit_descripcion15').val();

	    $.ajax({
			type: 'POST',
			url: '../script/crud_funciones.php',
			data: {
				"id": id,
				"nombre": nombre,
				"cargo": cargo,
				"descripcion1": descripcion1,
				"descripcion2": descripcion2,
				"descripcion3": descripcion3,
				"descripcion4": descripcion4,
				"descripcion5": descripcion5,
				"descripcion6": descripcion6,
				"descripcion7": descripcion7,
				"descripcion8": descripcion8,
				"descripcion9": descripcion9,
				"descripcion10": descripcion10,
				"descripcion11": descripcion11,
				"descripcion12": descripcion12,
				"descripcion13": descripcion13,
				"descripcion14": descripcion14,
				"descripcion15": descripcion15,
				"condicion": "editar1",
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
					});

					$("#exampleModal2").modal('hide');
					$('#exampleModal2').removeClass('modal-open');
					$('.modal-backdrop').remove();

					$('#nombre_'+id).html(respuesta['nombre']);
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
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
					url: '../script/crud_nomina.php',
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







