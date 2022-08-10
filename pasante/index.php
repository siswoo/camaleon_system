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
	$ubicacion = "pasante";
	include('../script/navbar_verificacion.php');
	include('../navbar.php');
?>


	<?php $ubicacion_url = $_SERVER["PHP_SELF"]; ?>

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
		<input type="hidden" name="consultaporsede" id="consultaporsede" value="">
		<div class="col-2">
			<br>
			<button type="button" class="btn btn-info mt-2" onclick="filtrar1();">Filter</button>
		</div>
		
		<div class="col-12" style="background-color: white; border-radius: 1rem; padding: 20px 1px 1px 1px;" id="resultado_table1"></div>
	</div>

	<!-- Modal Editar -->
		<div class="modal fade" id="modal_editar1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<form action="#" method="POST" id="formulario_modal_editar" style="">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Editar Registro</h5>
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
								    <input type="text" name="numero_documento" id="numero_documento" autocomplete="off" class="form-control" minlength="6" required>
							    </div>
							    <div class="col-6 form-group form-check">
								    <label for="nombre1">Primer Nombre <small style="color:#F2B76F; font-size: 17px;">*</small></label>
								    <input type="text" name="nombre1" id="nombre1" autocomplete="off" class="form-control" minlength="4" required>
							    </div>

							    <div class="col-6 form-group form-check">
								    <label for="nombre">Segundo Nombre</label>
								    <input type="text" name="nombre2" id="nombre2" autocomplete="off" minlength="4" class="form-control">
							    </div>

							    <div class="col-6 form-group form-check">
								    <label for="apellido1">Primer Apellido <small style="color:#F2B76F; font-size: 17px;">*</small></label>
								    <input type="text" name="apellido1" id="apellido1" autocomplete="off" minlength="4" class="form-control" required>
							    </div>

							    <div class="col-6 form-group form-check">
								    <label for="apellido">Segundo Apellido <small style="color:#F2B76F; font-size: 17px;">*</small></label>
								    <input type="text" name="apellido2" id="apellido2" autocomplete="off" minlength="4" class="form-control" required>
							    </div>

							    <div class="col-6 form-group form-check">
								    <label for="correo">Correo <small style="color:#F2B76F; font-size: 17px;">*</small></label>
								    <input type="email" name="correo" id="correo" autocomplete="off" class="form-control" required>
							    </div>

							    <div class="col-6 form-group form-check">
								    <label for="telefono1">Teléfono</label>
								    <input type="text" name="telefono1" id="telefono1" autocomplete="off" class="form-control">
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
            url: '../script/crud_pasantes.php',
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

    function paginacion1(value){
        $('#datatables').attr({'data-pagina':value})
        filtrar1();
    }

    function consulta1(id){
		$.ajax({
			type: 'POST',
			url: '../script/crud_pasantes.php',
			data: {
				"id": id,
				"condicion": "consulta1",
			},
			dataType: "JSON",
			success: function(respuesta) {
				if(respuesta["estatus"]=='ok'){
					$('#hidden_id').val(id);
					$('#nombre1').val(respuesta["nombre1"]);
					$('#nombre2').val(respuesta["nombre2"]);
					$('#apellido1').val(respuesta["apellido1"]);
					$('#apellido2').val(respuesta["apellido2"]);
					$('#correo').val(respuesta["correo"]);
					$('#telefono1').val(respuesta["telefono1"]);
					$('#tipo_documento').val(respuesta["tipo_documento"]);
					$('#numero_documento').val(respuesta["numero_documento"]);
				}else if(respuesta["estatus"]=='error'){
					Swal.fire({
						position: 'center',
						icon: 'error',
						title: 'Error',
						text: respuesta["msg"],
						showConfirmButton: true,
					});
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		})
	}

	function aceptar1(id){
		Swal.fire({
		  title: 'Estas seguro?',
		  text: "Esta acción no podra revertirse",
		  icon: 'warning',
		  showConfirmButton: true,
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, Estoy Seguro!',
		  cancelButtonText: 'Cancelar'
		}).then((result) => {
		  if (result.value) {
		    $.ajax({
				type: 'POST',
				url: '../script/crud_pasantes.php',
				data: {
					"id": id,
					"condicion": "aceptar1",
				},
				dataType: "JSON",
				success: function(respuesta) {
					//console.log(respuesta);
					filtrar1();
					if(respuesta["estatus"]=='ok'){
						Swal.fire({
						    title: 'Success',
						    text: respuesta["msg"],
						    icon: 'success',
						    showConfirmButton: true
					    });
					}else if(respuesta["estatus"]=='error'){
						Swal.fire({
						    title: 'Error',
						    text: respuesta["msg"],
						    icon: 'error',
						    showConfirmButton: true
					    });
					}
				},

				error: function(respuesta) {
					console.log(respuesta['responseText']);
				}
			});
		  }
		})
	}

	function rechazar1(id){
		Swal.fire({
		  title: 'Estas seguro?',
		  text: "Esta acción no podra revertirse",
		  icon: 'warning',
		  showConfirmButton: true,
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, Estoy Seguro!',
		  cancelButtonText: 'Cancelar'
		}).then((result) => {
		  if (result.value) {
		    $.ajax({
				type: 'POST',
				url: '../script/crud_pasantes.php',
				data: {
					"id": id,
					"condicion": "rechazar1",
				},
				dataType: "JSON",
				success: function(respuesta) {
					filtrar1();
					if(respuesta["estatus"]=='ok'){
						Swal.fire({
						    title: 'Success',
						    text: respuesta["msg"],
						    icon: 'success',
						    showConfirmButton: true
					    });
					}else if(respuesta["estatus"]=='error'){
						Swal.fire({
						    title: 'Error',
						    text: respuesta["msg"],
						    icon: 'error',
						    showConfirmButton: true
					    });
					}
				},

				error: function(respuesta) {
					console.log(respuesta['responseText']);
				}
			});
		  }
		})
	}

	$("#formulario_modal_editar").on("submit", function(e){
		e.preventDefault();
		var f = $(this);
		var id = $('#hidden_id').val();
		var nombre1 = $('#nombre1').val();
		var nombre2 = $('#nombre2').val();
		var apellido1 = $('#apellido1').val();
		var apellido2 = $('#apellido2').val();
		var correo = $('#correo').val();
		var telefono1 = $('#telefono1').val();
		var tipo_documento = $('#tipo_documento').val();
		var numero_documento = $('#numero_documento').val();
	    $.ajax({
			type: 'POST',
			url: '../script/crud_pasantes.php',
			dataType: "JSON",
			data: {
				"id": id,
				"nombre1": nombre1,
				"nombre2": nombre2,
				"apellido1": apellido1,
				"apellido2": apellido2,
				"correo": correo,
				"telefono1": telefono1,
				"tipo_documento": tipo_documento,
				"numero_documento": numero_documento,
				"condicion": "editar1",
			},
			success: function(respuesta) {
				filtrar1();
				if(respuesta["estatus"]=='ok'){
					Swal.fire({
						position: 'center',
						icon: 'success',
						title: 'Success',
						text: respuesta["msg"],
						showConfirmButton: true,
					});
				}else if(respuesta["estatus"]=='error'){
					Swal.fire({
						position: 'center',
						icon: 'error',
						title: 'Error',
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


</script>