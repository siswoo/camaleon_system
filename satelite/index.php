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
	$ubicacion = "satelite";
	include('../script/navbar_verificacion.php');
	include('../navbar.php');
?>

	<?php $ubicacion_url = $_SERVER["PHP_SELF"]; ?>

	<div class="row ml-3 mr-3" style="margin-top: 4rem;">
		<button type="button" class="btn btn-info" data-toggle="modal" data-target="#Modal_crear1">Crear Modelo Satelite</button>
	</div>

	<div class="row ml-3 mr-3" style="margin-top: 4rem;">
		<input type="hidden" name="datatables" id="datatables" data-pagina="1" data-consultasporpagina="10" data-filtrado="" data-sede="">
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
		<div class="col-4 form-group form-check">
			<label for="buscarfiltro" style="color:black; font-weight: bold;">Busqueda</label>
			<input type="text" class="form-control" id="buscarfiltro" autocomplete="off" name="buscarfiltro">
		</div>
		<div class="col-3 form-group form-check">
			<label for="consultaporsede" style="color:black; font-weight: bold;">Estatus</label>
			<select class="form-control" id="consultaporsede" name="consultaporsede">
				<option value="">Todos</option>
				<option value="Activa">Activa</option>
				<option value="Inactiva">Inactiva</option>
			</select>
		</div>
		<div class="col-2">
			<br>
			<button type="button" class="btn btn-info mt-2" onclick="filtrar1();">Filter</button>
		</div>
		
		<div class="col-12" style="background-color: white; border-radius: 1rem; padding: 20px 1px 1px 1px;" id="resultado_table1"></div>
	</div>

	<!-- Modal Crear -->
	<div class="modal fade" id="Modal_crear1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="formulario_new1" style="">
				<input type="hidden" name="edit_id2" id="edit_id2">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel2">Crear Registro</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row">
						    <div class="col-6 form-group form-check">
							    <label for="new_documento_tipo">Tipo de Documento </label>
							    <select name="new_documento_tipo" id="new_documento_tipo" class="form-control" required>
							    	<option value="">Seleccione</option>
							    	<option value="Cedula de Ciudadania">Cedula de Ciudadania</option>
							    	<option value="Cedula de Extranjeria">Cedula de Extranjeria</option>
							    	<option value="PEP">PEP</option>
							    	<option value="Pasaporte">Pasaporte</option>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="new_documento_numero">Número de Documento </label>
							    <input type="text" name="new_documento_numero" id="new_documento_numero" autocomplete="off" class="form-control" minlength="6" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="new_nombre1">Primer Nombre </label>
							    <input type="text" name="new_nombre1" id="new_nombre1" autocomplete="off" class="form-control" minlength="4" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="new_nombre2">Segundo Nombre </label>
							    <input type="text" name="new_nombre2" id="new_nombre2" autocomplete="off" class="form-control" minlength="4" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="new_apellido1">Primer Apellido </label>
							    <input type="text" name="new_apellido1" id="new_apellido1" autocomplete="off" class="form-control" minlength="4" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="new_apellido2">Segundo Apellido </label>
							    <input type="text" name="new_apellido2" id="new_apellido2" autocomplete="off" class="form-control" minlength="4" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="new_correo">Correo </label>
							    <input type="email" name="new_correo" id="new_correo" autocomplete="off" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="new_telefono1">Teléfono</label>
							    <input type="text" name="new_telefono1" id="new_telefono1" autocomplete="off" class="form-control">
						    </div>
						    <div class="col-12 form-group form-check">
							    <label for="new_direccion">Dirección</label>
							    <input type="text" name="new_direccion" id="new_direccion" autocomplete="off" class="form-control">
						    </div>
							<div class="col-6 form-group form-check">
							    <label for="new_genero">Género </label>
							    <select name="new_genero" id="new_genero" class="form-control" required>
							    	<option value="">Seleccione</option>
									<option value="Hombre">Hombre</option>
									<option value="Mujer">Mujer</option>
									<option value="Transexual">Transexual</option>
							    </select>
						    </div>
							<div class="col-6 form-group form-check">
								<label for="new_barrio">Barrio </label>
								<input type="text" name="new_barrio" id="new_barrio" autocomplete="off" required class="form-control">
							</div>
					    </div>
					</div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" id="submit" class="btn btn-success">Guardar</button>
			      	</div>
		      	</form>
	    	</div>
	  	</div>
	</div>
	<!-- FIN Modal Crear -->

	<!-- Modal Editar -->
		<div class="modal fade" id="exampleModal_soporte1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form action="#" method="POST" id="formulario_edit1" style="">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel2">Editar Registro</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
						    <div class="row">
							    <div class="col-6 form-group form-check">
								    <label for="edit_tipo_documento">Tipo de Documento </label>
								    <select name="edit_tipo_documento" id="edit_tipo_documento" class="form-control" required>
								    	<option value="">Seleccione</option>
								    	<option value="Cedula de Ciudadania">Cedula de Ciudadania</option>
								    	<option value="Cedula de Extranjeria">Cedula de Extranjeria</option>
								    	<option value="PEP">PEP</option>
								    	<option value="Pasaporte">Pasaporte</option>
								    </select>
							    </div>
							    <div class="col-6 form-group form-check">
								    <label for="edit_numero_documento">Número de Documento </label>
								    <input type="text" name="edit_numero_documento" id="edit_numero_documento" autocomplete="off" class="form-control" minlength="6" required>
							    </div>
						    </div>

						    <div class="row">
							    <div class="col-6 form-group form-check">
								    <label for="edit_primer_nombre">Primer Nombre </label>
								    <input type="text" name="edit_primer_nombre" id="edit_primer_nombre" autocomplete="off" class="form-control" minlength="4" required>
							    </div>

							    <div class="col-6 form-group form-check">
								    <label for="edit_segundo_nombre">Segundo Nombre</label>
								    <input type="text" name="edit_segundo_nombre" id="edit_segundo_nombre" autocomplete="off" minlength="4" class="form-control">
							    </div>

							    <div class="col-6 form-group form-check">
								    <label for="edit_primer_apellido">Primer Apellido </label>
								    <input type="text" name="edit_primer_apellido" id="edit_primer_apellido" autocomplete="off" minlength="4" class="form-control" required>
							    </div>

							    <div class="col-6 form-group form-check">
								    <label for="edit_segundo_apellido">Segundo Apellido </label>
								    <input type="text" name="edit_segundo_apellido" id="edit_segundo_apellido" autocomplete="off" minlength="4" class="form-control" required>
							    </div>
							    <div class="col-6 form-group form-check">
								    <label for="edit_correo">Correo </label>
								    <input type="email" name="edit_correo" id="edit_correo" autocomplete="off" class="form-control" required>
							    </div>
								<div class="col-6 form-group form-check">
								    <label for="edit_genero">Género </label>
								    <select name="edit_genero" id="edit_genero" class="form-control" required>
								    	<option value="">Seleccione</option>
										<option value="Hombre">Hombre</option>
										<option value="Mujer">Mujer</option>
										<option value="Transexual">Transexual</option>
								    </select>
							    </div>
							    <div class="col-6 form-group form-check">
									<label for="edit_estatus">Estatus </label>
									<select name="edit_estatus" class="form-control" id="edit_estatus" required>
										<option value="">Seleccione</option>
										<option value="Activa">Activa</option>
										<option value="Inactiva">Inactiva</option>
									</select>
								</div>
								<div class="col-6 form-group form-check">
									<label for="edit_telefono1">Teléfono </label>
									<input type="text" name="edit_telefono1" id="edit_telefono1" autocomplete="off" required class="form-control">
								</div>
								<div class="col-12 form-group form-check">
									<label for="edit_barrio">Barrio </label>
									<input type="text" name="edit_barrio" id="edit_barrio" autocomplete="off" required class="form-control">
								</div>
								<div class="col-12 form-group form-check">
								    <label for="edit_direccion">Dirección</label>
								    <input type="text" name="edit_direccion" id="edit_direccion" autocomplete="off" class="form-control">
							    </div>
						    </div>
						</div>
						<div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					        <button type="submit" id="submit" class="btn btn-success">Guardar</button>
				      	</div>
			      	</form>
		    	</div>
		  	</div>
		</div>
	<!-- FIN Modal Editar -->

<input type="hidden" name="hidden_id" id="hidden_id" value="">

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
        filtrar1();
    } );

    function filtrar1(){
        var input_consultasporpagina = $('#consultasporpagina').val();
        var input_buscarfiltro = $('#buscarfiltro').val();
        var input_consultaporsede = $('#consultaporsede').val();
        
        $('#datatables').attr({'data-consultasporpagina':input_consultasporpagina})
        $('#datatables').attr({'data-filtrado':input_buscarfiltro})
        $('#datatables').attr({'data-sede':input_consultaporsede})

        var pagina = $('#datatables').attr('data-pagina');
        var consultasporpagina = $('#datatables').attr('data-consultasporpagina');
        var sede = $('#datatables').attr('data-sede');
        var filtrado = $('#datatables').attr('data-filtrado');
        var ubicacion_url = '<?php echo $ubicacion_url; ?>';

        $.ajax({
            type: 'POST',
            url: '../script/crud_satelites.php',
            dataType: "JSON",
            data: {
                "pagina": pagina,
                "consultasporpagina": consultasporpagina,
                "sede": sede,
                "filtrado": filtrado,
                "link1": ubicacion_url,
                "condicion": "table1",
            },

            success: function(respuesta) {
                //console.log(respuesta);
                if(respuesta["estatus"]=="ok"){
                    $('#resultado_table1').html(respuesta["html"]);
                }else{
                	Swal.fire({
                        title: 'Error',
                        text: respuesta["msg"],
                        icon: 'error',
                        showConfirmButton: true,
                    })
                }
            },

            error: function(respuesta) {
                console.log(respuesta['responseText']);
            }
        });
    }

    function paginacion1(value){
        $('#datatables').attr({'data-pagina':value})
        filtrar1();
    }

	$("#formulario_new1").on("submit", function(e){
		e.preventDefault();
		var f = $(this);
		var new_nombre1 = $('#new_nombre1').val();
		var new_nombre2 = $('#new_nombre2').val();
		var new_apellido1 = $('#new_apellido1').val();
		var new_apellido2 = $('#new_apellido2').val();
		var new_documento_tipo = $('#new_documento_tipo').val();
		var new_documento_numero = $('#new_documento_numero').val();
		var new_correo = $('#new_correo').val();
		var new_direccion = $('#new_direccion').val();
		var new_genero = $('#new_genero').val();
		var new_barrio = $('#new_barrio').val();
		var new_telefono1 = $('#new_telefono1').val();
	    $.ajax({
			type: 'POST',
			url: '../script/crud_satelites.php',
			dataType: "JSON",
			data: {
                "nombre1": new_nombre1,
                "nombre2": new_nombre2,
                "apellido1": new_apellido1,
                "apellido2": new_apellido2,
                "documento_tipo": new_documento_tipo,
                "documento_numero": new_documento_numero,
                "correo": new_correo,
                "direccion": new_direccion,
                "genero": new_genero,
                "barrio": new_barrio,
                "telefono1": new_telefono1,
                "condicion": "new1",
            },
			success: function(respuesta) {
				console.log(respuesta);
				if(respuesta['estatus']=='ok'){
					filtrar1();
					Swal.fire({
						position: 'center',
						icon: 'success',
						title: "Success",
						text: respuesta["msg"],
						showConfirmButton: true,
					});
				}else if(respuesta['estatus']=='error'){
					Swal.fire({
						position: 'center',
						icon: 'error',
						title: "error",
						text: respuesta["msg"],
						showConfirmButton: true,
					});
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	});

	$("#formulario_edit1").on("submit", function(e){
		e.preventDefault();
		var f = $(this);
		var id = $('#hidden_id').val();
		var nombre1 = $('#edit_primer_nombre').val();
		var nombre2 = $('#edit_segundo_nombre').val();
		var apellido1 = $('#edit_primer_apellido').val();
		var apellido2 = $('#edit_segundo_apellido').val();
		var edit_tipo_documento = $('#edit_tipo_documento').val();
		var edit_numero_documento = $('#edit_numero_documento').val();
		var edit_correo = $('#edit_correo').val();
		var edit_direccion = $('#edit_direccion').val();
		var edit_genero = $('#edit_genero').val();
		var edit_estatus = $('#edit_estatus').val();
		var edit_barrio = $('#edit_barrio').val();
		var edit_telefono1 = $('#edit_telefono1').val();
	    $.ajax({
			type: 'POST',
			url: '../script/crud_satelites.php',
			dataType: "JSON",
			data: {
                "id": id,
                "nombre1": nombre1,
                "nombre2": nombre2,
                "apellido1": apellido1,
                "apellido2": apellido2,
                "documento_tipo": edit_tipo_documento,
                "documento_numero": edit_numero_documento,
                "correo": edit_correo,
                "direccion": edit_direccion,
                "genero": edit_genero,
                "estatus": edit_estatus,
                "barrio": edit_barrio,
                "telefono1": edit_telefono1,
                "condicion": "edit1",
            },
			success: function(respuesta) {
				console.log(respuesta);
				if(respuesta['estatus']=='ok'){
					filtrar1();
					Swal.fire({
						position: 'center',
						icon: 'success',
						title: "Success",
						text: respuesta["msg"],
						showConfirmButton: true,
					});
				}else if(respuesta['estatus']=='error'){
					Swal.fire({
						position: 'center',
						icon: 'error',
						title: "error",
						text: respuesta["msg"],
						showConfirmButton: true,
					});
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	});

	function consulta1(id){
        $.ajax({
            type: 'POST',
            url: '../script/crud_satelites.php',
            dataType: "JSON",
            data: {
                "id": id,
                "condicion": "consulta1",
            },

            success: function(respuesta) {
                if(respuesta["estatus"]=="ok"){
                	$('#hidden_id').val(id);
                    $('#edit_primer_nombre').val(respuesta["nombre1"]);
                    $('#edit_segundo_nombre').val(respuesta["nombre2"]);
                    $('#edit_primer_apellido').val(respuesta["apellido1"]);
                    $('#edit_segundo_apellido').val(respuesta["apellido2"]);
                    $('#edit_tipo_documento').val(respuesta["documento_tipo"]);
                    $('#edit_numero_documento').val(respuesta["documento_numero"]);
                    $('#edit_correo').val(respuesta["correo"]);
                    $('#edit_genero').val(respuesta["genero"]);
                    $('#edit_estatus').val(respuesta["estatus2"]);
                    $('#edit_telefono1').val(respuesta["telefono1"]);
                    $('#edit_barrio').val(respuesta["barrio"]);
                    $('#edit_direccion').val(respuesta["direccion"]);
                }else if(respuesta["estatus"]=="error"){
                	Swal.fire({
                        title: 'Error',
                        text: respuesta["msg"],
                        icon: 'error',
                        showConfirmButton: true,
                    })
                }
            },

            error: function(respuesta) {
                console.log(respuesta['responseText']);
            }
        });
    }

</script>