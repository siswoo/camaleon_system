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
	
	<div class="seccion1" id="seccion1" style="margin-top: 3rem;">
		<div class="row ml-3 mr-3" style="margin-top: 4rem;">
			<div class="col-12 text-center" style="font-weight: bold; font-size: 30px; text-transform: uppercase;">Listado de Usuarios</div>
			<div class="col-12">
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_nuevo1">Nuevo Registro</button>
			</div>
			<input type="hidden" name="datatables" id="datatables" data-pagina="1" data-consultasporpagina="10" data-filtrado="" data-sede="" data-roles="">
			<div class="col-3 form-group form-check">
				<label for="consultasporpagina" style="color:black; font-weight: bold;">Resultados por página</label>
				<select class="form-control" id="consultasporpagina" name="consultasporpagina">
					<option value="10">10</option>
					<option value="20">20</option>
					<option value="30">30</option>
					<option value="40">40</option>
					<option value="50">50</option>
					<option value="100">100</option>
				</select>
			</div>
			<div class="col-3 form-group form-check">
				<label for="buscarfiltro" style="color:black; font-weight: bold;">Buscar</label>
				<input type="text" class="form-control" id="buscarfiltro" name="buscarfiltro">
			</div>
			<div class="col-2 form-group form-check">
				<label for="consultaporsede" style="color:black; font-weight: bold;">Sede</label>
				<select class="form-control" id="consultaporsede" name="consultaporsede">
					<option value="">Todas</option>
					<?php
					$sql2 = "SELECT * FROM sedes";
					$proceso2 = mysqli_query($conexion,$sql2);
					while($row2=mysqli_fetch_array($proceso2)){
						$sedes_id = $row2["id"];
						$sedes_nombre = $row2["nombre"];
						echo '<option value="'.$sedes_id.'">'.$sedes_nombre.'</option>';
					}
					?>
				</select>
			</div>
			<div class="col-2 form-group form-check">
				<label for="consultaporroles" style="color:black; font-weight: bold;">Rol</label>
				<select class="form-control" id="consultaporroles" name="consultaporroles">
					<option value="">Todas</option>
					<?php
					$sql2 = "SELECT * FROM roles";
					$proceso2 = mysqli_query($conexion,$sql2);
					while($row2=mysqli_fetch_array($proceso2)){
						$roles_id = $row2["id"];
						$roles_nombre = $row2["nombre"];
						echo '<option value="'.$roles_id.'">'.$roles_nombre.'</option>';
					}
					?>
				</select>
			</div>
			<div class="col-2">
				<br>
				<button type="button" class="btn btn-info mt-2" onclick="filtrar1();">Filtrar</button>
			</div>
			<div class="col-12" style="background-color: white; border-radius: 1rem; padding: 20px 1px 1px 1px;" id="resultado_table1"></div>
		</div>
	</div>

	<div class="modal fade" id="modal_editar1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<form action="#" method="POST" id="formulario_editar" style="">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Registro</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-12 form-group form-check">
								<label for="nombre">Nombre</label>
								<input type="text" id="nombre" name="nombre" class="form-control" autocomplete="off" required>
							</div>
							<div class="col-12 form-group form-check">
								<label for="apellido">Apellido</label>
								<input type="text" id="apellido" name="apellido" class="form-control" autocomplete="off" required>
							</div>
							<div class="col-12 form-group form-check">
								<label for="documento_tipo">Documento Tipo</label>
								<select class="form-control" id="documento_tipo" name="documento_tipo" required>
									<option value="">Seleccione</option>
									<option value="Cedula de Ciudadania">Cedula de Ciudadania</option>
									<option value="Cedula de Extranjeria">Cedula de Extranjeria</option>
									<option value="Pasaporte">Pasaporte</option>
									<option value="PEP">PEP</option>
								</select>
							</div>
							<div class="col-12 form-group form-check">
								<label for="documento_numero">Documento Número</label>
								<input type="text" id="documento_numero" name="documento_numero" class="form-control" autocomplete="off" required>
							</div>
							<div class="col-12 form-group form-check">
								<label for="correo">Correo</label>
								<input type="email" id="correo" name="correo" class="form-control" autocomplete="off" required>
							</div>
							<div class="col-12 form-group form-check">
								<label for="usuario">Usuario</label>
								<input type="text" id="usuario" name="usuario" class="form-control" autocomplete="off" required>
							</div>
							<div class="col-12 form-group form-check">
								<label for="clave">Clave</label>
								<input type="text" id="clave" name="clave" class="form-control" autocomplete="off" required>
							</div>
							<div class="col-12 form-group form-check">
								<label for="telefono1">Telefono</label>
								<input type="text" id="telefono1" name="telefono1" class="form-control" autocomplete="off" required>
							</div>
							<div class="col-12 form-group form-check">
								<label for="rol">Rol</label>
								<select class="form-control" id="rol" name="rol" required>
									<option value="">Seleccione</option>
									<?php
									$sql2 = "SELECT * FROM roles";
									$proceso2 = mysqli_query($conexion,$sql2);
									while($row2=mysqli_fetch_array($proceso2)){
										$roles_id = $row2["id"];
										$roles_nombre = $row2["nombre"];
										echo '<option value="'.$roles_id.'">'.$roles_nombre.'</option>';
									}
									?>
								</select>
							</div>
							<div class="col-12 form-group form-check">
								<label for="sede">Sede</label>
								<select class="form-control" id="sede" name="sede" required>
									<option value="">Seleccione</option>
									<?php
									$sql3 = "SELECT * FROM sedes";
									$proceso3 = mysqli_query($conexion,$sql3);
									while($row3=mysqli_fetch_array($proceso3)){
										$sedes_id = $row3["id"];
										$sedes_nombre = $row3["nombre"];
										echo '<option value="'.$sedes_id.'">'.$sedes_nombre.'</option>';
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-success">Guardar</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="modal fade" id="modal_nuevo1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<form action="#" method="POST" id="formulario_nuevo" style="">
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
								<label for="nombre2">Nombre</label>
								<input type="text" id="nombre2" name="nombre2" class="form-control" autocomplete="off" required>
							</div>
							<div class="col-12 form-group form-check">
								<label for="apellido2">Apellido</label>
								<input type="text" id="apellido2" name="apellido2" class="form-control" autocomplete="off" required>
							</div>
							<div class="col-12 form-group form-check">
								<label for="documento_tipo2">Documento Tipo</label>
								<select class="form-control" id="documento_tipo2" name="documento_tipo2" required>
									<option value="">Seleccione</option>
									<option value="Cedula de Ciudadania">Cedula de Ciudadania</option>
									<option value="Cedula de Extranjeria">Cedula de Extranjeria</option>
									<option value="Pasaporte">Pasaporte</option>
									<option value="PEP">PEP</option>
								</select>
							</div>
							<div class="col-12 form-group form-check">
								<label for="documento_numero2">Documento Número</label>
								<input type="text" id="documento_numero2" name="documento_numero2" class="form-control" autocomplete="off" required>
							</div>
							<div class="col-12 form-group form-check">
								<label for="correo2">Correo</label>
								<input type="email" id="correo2" name="correo2" class="form-control" autocomplete="off" required>
							</div>
							<div class="col-12 form-group form-check">
								<label for="usuario2">Usuario</label>
								<input type="text" id="usuario2" name="usuario2" class="form-control" autocomplete="off" required>
							</div>
							<div class="col-12 form-group form-check">
								<label for="clave2">Clave</label>
								<input type="text" id="clave2" name="clave2" class="form-control" autocomplete="off" required>
							</div>
							<div class="col-12 form-group form-check">
								<label for="telefono12">Telefono</label>
								<input type="text" id="telefono12" name="telefono12" class="form-control" autocomplete="off" required>
							</div>
							<div class="col-12 form-group form-check">
								<label for="rol2">Rol</label>
								<select class="form-control" id="rol2" name="rol2" required>
									<option value="">Seleccione</option>
									<?php
									$sql2 = "SELECT * FROM roles";
									$proceso2 = mysqli_query($conexion,$sql2);
									while($row2=mysqli_fetch_array($proceso2)){
										$roles_id = $row2["id"];
										$roles_nombre = $row2["nombre"];
										echo '<option value="'.$roles_id.'">'.$roles_nombre.'</option>';
									}
									?>
								</select>
							</div>
							<div class="col-12 form-group form-check">
								<label for="sede2">Sede</label>
								<select class="form-control" id="sede2" name="sede2" required>
									<option value="">Seleccione</option>
									<?php
									$sql3 = "SELECT * FROM sedes";
									$proceso3 = mysqli_query($conexion,$sql3);
									while($row3=mysqli_fetch_array($proceso3)){
										$sedes_id = $row3["id"];
										$sedes_nombre = $row3["nombre"];
										echo '<option value="'.$sedes_id.'">'.$sedes_nombre.'</option>';
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-success">Guardar</button>
					</div>
				</div>
			</form>
		</div>
	</div>


<input type="hidden" name="hidden_id" id="hidden_id">

</body>
</html>

<script src="../js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../js/popper.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="../js/navbar.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		filtrar1();
	});

	function filtrar1(){
        var input_consultasporpagina = $('#consultasporpagina').val();
        var input_buscarfiltro = $('#buscarfiltro').val();
        var input_consultaporsede = $('#consultaporsede').val();
        var input_consultaporroles = $('#consultaporroles').val();
        
        $('#datatables').attr({'data-consultasporpagina':input_consultasporpagina})
        $('#datatables').attr({'data-filtrado':input_buscarfiltro})
        $('#datatables').attr({'data-sede':input_consultaporsede})
        $('#datatables').attr({'data-roles':input_consultaporroles})

        var pagina = $('#datatables').attr('data-pagina');
        var consultasporpagina = $('#datatables').attr('data-consultasporpagina');
        var sede = $('#datatables').attr('data-sede');
        var filtrado = $('#datatables').attr('data-filtrado');
        var roles = $('#datatables').attr('data-roles');

        $.ajax({
            type: 'POST',
            url: '../script/crud_usuarios.php',
            dataType: "JSON",
            data: {
                "pagina": pagina,
                "consultasporpagina": consultasporpagina,
                "sede": sede,
                "roles": roles,
                "filtrado": filtrado,
                "condicion": "table1",
            },

            success: function(respuesta) {
                //console.log(respuesta);
                if(respuesta["estatus"]=="ok"){
                    $('#resultado_table1').html(respuesta["html"]);
                }
            },

            error: function(respuesta) {
                console.log(respuesta['responseText']);
            }
        });
    }

    function consultar1(id){
    	$.ajax({
			type: 'POST',
			url: '../script/crud_usuarios.php',
			data: {
				"id": id,
				"condicion": "consultar1",
			},
			dataType: "JSON",

			success: function(respuesta) {
				if(respuesta["estatus"]=="ok"){
					$('#hidden_id').val(id);
					$('#nombre').val(respuesta["nombre"]);
					$('#apellido').val(respuesta["apellido"]);
					$('#documento_tipo').val(respuesta["documento_tipo"]);
					$('#documento_numero').val(respuesta["documento_numero"]);
					$('#correo').val(respuesta["correo"]);
					$('#usuario').val(respuesta["usuario"]);
					$('#clave').val(respuesta["clave"]);
					$('#telefono1').val(respuesta["telefono1"]);
					$('#rol').val(respuesta["rol"]);
					$('#sede').val(respuesta["sede"]);
				}else if(respuesta["estatus"]=="error"){
					Swal.fire({
			 			title: 'Error',
			 			text: respuesta["msg"],
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: true,
			 			timer: 2000,
					});
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
    }

	$("#formulario_editar").on("submit", function(e){
		e.preventDefault();
		var id = $('#hidden_id').val();
		var nombre = $('#nombre').val();
		var apellido = $('#apellido').val();
		var documento_tipo = $('#documento_tipo').val();
		var documento_numero = $('#documento_numero').val();
		var correo = $('#correo').val();
		var usuario = $('#usuario').val();
		var clave = $('#clave').val();
		var telefono1 = $('#telefono1').val();
		var rol = $('#rol').val();
		var sede = $('#sede').val();

		$.ajax({
			type: 'POST',
			url: '../script/crud_usuarios.php',
			dataType: "JSON",
			data: {
				"id": id,
				"nombre": nombre,
				"apellido": apellido,
				"documento_tipo": documento_tipo,
				"documento_numero": documento_numero,
				"correo": correo,
				"usuario": usuario,
				"clave": clave,
				"telefono1": telefono1,
				"rol": rol,
				"sede": sede,
				"condicion": "editar1",
			},

			success: function(respuesta) {
				console.log(respuesta);
				if(respuesta["estatus"]=="ok"){
					Swal.fire({
				 		title: 'Success',
				 		text: respuesta["msg"],
				 		icon: 'success',
				 		position: 'center',
				 		timer: 2000,
					});
					/*
					$('#nombre').val("");
					$('#apellido').val("");
					$('#documento_tipo').val("");
					$('#documento_numero').val("");
					$('#correo').val("");
					$('#usuario').val("");
					$('#clave').val("");
					$('#telefono1').val("");
					$('#rol').val("");
					$('#sede').val("");
					*/
					filtrar1();
				}else if(respuesta["estatus"]=="error"){
					Swal.fire({
				 		title: 'Error',
				 		text: respuesta["msg"],
				 		icon: 'error',
				 		position: 'center',
				 		timer: 2000,
					});
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}

		});
	});

	$("#formulario_nuevo").on("submit", function(e){
		e.preventDefault();
		var nombre = $('#nombre2').val();
		var apellido = $('#apellido2').val();
		var documento_tipo = $('#documento_tipo2').val();
		var documento_numero = $('#documento_numero2').val();
		var correo = $('#correo2').val();
		var usuario = $('#usuario2').val();
		var clave = $('#clave2').val();
		var telefono1 = $('#telefono12').val();
		var rol = $('#rol2').val();
		var sede = $('#sede2').val();

		$.ajax({
			type: 'POST',
			url: '../script/crud_usuarios.php',
			dataType: "JSON",
			data: {
				"nombre": nombre,
				"apellido": apellido,
				"documento_tipo": documento_tipo,
				"documento_numero": documento_numero,
				"correo": correo,
				"usuario": usuario,
				"clave": clave,
				"telefono1": telefono1,
				"rol": rol,
				"sede": sede,
				"condicion": "guardar1",
			},

			success: function(respuesta) {
				console.log(respuesta);
				if(respuesta["estatus"]=="ok"){
					Swal.fire({
				 		title: 'Success',
				 		text: respuesta["msg"],
				 		icon: 'success',
				 		position: 'center',
				 		timer: 2000,
					});
					$('#nombre').val("");
					$('#apellido').val("");
					$('#documento_tipo').val("");
					$('#documento_numero').val("");
					$('#correo').val("");
					$('#usuario').val("");
					$('#clave').val("");
					$('#telefono1').val("");
					$('#rol').val("");
					$('#sede').val("");
					filtrar1();
				}else if(respuesta["estatus"]=="error"){
					Swal.fire({
				 		title: 'Error',
				 		text: respuesta["msg"],
				 		icon: 'error',
				 		position: 'center',
				 		timer: 2000,
					});
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
					url: '../script/crud_usuarios.php',
					dataType: "JSON",
					data: {
						"id": id,
						"condicion": "eliminar1",
					},

					success: function(respuesta) {
						console.log(respuesta);
						Swal.fire({
					 		title: 'Success',
					 		text: respuesta["msg"],
					 		icon: 'success',
					 		position: 'center',
					 		timer: 2000,
						});
						filtrar1();
					},

					error: function(respuesta) {
						console.log("error..."+respuesta);
					}
				});
			}
		})
	}

</script>
