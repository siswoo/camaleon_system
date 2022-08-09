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
	$ubicacion = "contenido";
	include('../script/navbar_verificacion.php');
	include('../navbar.php');
?>

	<div class="seccion1" id="seccion1" style="margin-top: 3rem;">
		<div class="row ml-3 mr-3" style="margin-top: 4rem;">
			<div class="col-12 text-center" style="font-weight: bold; font-size: 30px; text-transform: uppercase;">Módulo de Contenido</div>
			<div class="col-12 mt-3">
				<form id="formulario1" method="POST" action="#">
	    			<div class="row">
		    			<div class="form-group col-4">
		    				<label for="files1" style="color:black; font-weight: bold;">Archivo</label>
		    				<input type="file" id="files1" name="files1" required="" class="form-control">
						</div>
						<div class="form-group col-4">
							<label for="importar_mes" style="color:black; font-weight: bold;">Mes</label>
		    				<select class="form-control" name="importar_mes" id="importar_mes" required>
								<option value="">Seleccione</option>
								<option value="Enero">Enero</option>
								<option value="Febrero">Febrero</option>
								<option value="Marzo">Marzo</option>
								<option value="Abril">Abril</option>
								<option value="Mayo">Mayo</option>
								<option value="Junio">Junio</option>
								<option value="Julio">Julio</option>
								<option value="Agosto">Agosto</option>
								<option value="Septiembre">Septiembre</option>
								<option value="Octubre">Octubre</option>
								<option value="Noviembre">Noviembre</option>
								<option value="Diciembre">Diciembre</option>
							</select>
						</div>
						<div class="form-group col-4">
							<br>
		    				<button type="submit" class="btn btn-primary mt-2">Importar Datos</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-12 mt-3 mb-3">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_nuevo">Nuevo Registro</button>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_nuevo2">Generar Presabana</button>
			</div>
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
				<label for="buscarfiltro" style="color:black; font-weight: bold;">Buscar</label>
				<input type="text" class="form-control" id="buscarfiltro" name="buscarfiltro">
			</div>
			<input type="hidden" name="consultaporsede" id="consultaporsede" value="">
			<div class="col-2">
				<br>
				<button type="button" class="btn btn-info mt-2" onclick="filtrar1();">Filtrar</button>
			</div>
			<div class="col-12" style="background-color: white; border-radius: 1rem; padding: 20px 1px 1px 1px;" id="resultado_table1"></div>
		</div>
	</div>

	<div class="seccion2" id="seccion2" style="margin-top: 3rem;">
		<div class="row ml-3 mr-3">
			<div class="col-12 text-center" style="font-weight: bold; font-size: 22px; text-transform: uppercase;">Listado de Presabanas</div>
			<input type="hidden" name="datatables2" id="datatables2" data-pagina="1" data-consultasporpagina="10" data-filtrado="" data-sede="">
			<div class="col-3 form-group form-check">
				<label for="consultasporpagina2" style="color:black; font-weight: bold;">Resultados por página</label>
				<select class="form-control" id="consultasporpagina2" name="consultasporpagina2">
					<option value="10">10</option>
					<option value="20">20</option>
					<option value="30">30</option>
					<option value="40">40</option>
					<option value="50">50</option>
					<option value="100">100</option>
				</select>
			</div>
			<div class="col-4 form-group form-check">
				<label for="buscarfiltro2" style="color:black; font-weight: bold;">Buscar</label>
				<input type="text" class="form-control" id="buscarfiltro2" name="buscarfiltro2">
			</div>
			<div class="col-3 form-group form-check">
				<label for="consultaporsede2" style="color:black; font-weight: bold;">Sede</label>
				<select class="form-control" id="consultaporsede2" name="consultaporsede2">
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
			<div class="col-2">
				<br>
				<button type="button" class="btn btn-info mt-2" onclick="filtrar2();">Filtrar</button>
			</div>
			<div class="col-12" style="background-color: white; border-radius: 1rem; padding: 20px 1px 1px 1px;" id="resultado_table2"></div>
		</div>
	</div>

	<div class="seccion3" id="seccion3" style="margin-top: 3rem;">
		<div class="row ml-3 mr-3">
			<div class="col-12 text-center" style="font-weight: bold; font-size: 22px; text-transform: uppercase;">Listado de Descuentos</div>
			<input type="hidden" name="datatables3" id="datatables3" data-pagina="1" data-consultasporpagina="10" data-filtrado="" data-sede="">
			<div class="col-3 form-group form-check">
				<label for="consultasporpagina3" style="color:black; font-weight: bold;">Resultados por página</label>
				<select class="form-control" id="consultasporpagina3" name="consultasporpagina3">
					<option value="10">10</option>
					<option value="20">20</option>
					<option value="30">30</option>
					<option value="40">40</option>
					<option value="50">50</option>
					<option value="100">100</option>
				</select>
			</div>
			<div class="col-4 form-group form-check">
				<label for="buscarfiltro3" style="color:black; font-weight: bold;">Buscar</label>
				<input type="text" class="form-control" id="buscarfiltro3" name="buscarfiltro3">
			</div>
			<div class="col-3 form-group form-check">
				<label for="consultaporsede3" style="color:black; font-weight: bold;">Sede</label>
				<select class="form-control" id="consultaporsede3" name="consultaporsede3">
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
			<div class="col-2">
				<br>
				<button type="button" class="btn btn-info mt-2" onclick="filtrar3();">Filtrar</button>
			</div>
			<div class="col-12" style="background-color: white; border-radius: 1rem; padding: 20px 1px 1px 1px;" id="resultado_table3"></div>
		</div>
	</div>

</body>
</html>

<div class="modal fade" id="modal_nuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
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
							<label for="nombre1">Primer Nombre</label>
							<input type="text" id="nombre1" name="nombre1" class="form-control" autocomplete="off" required>
						</div>
						<div class="col-12 form-group form-check">
							<label for="nombre2">Segundo Nombre</label>
							<input type="text" id="nombre2" name="nombre2" class="form-control" autocomplete="off" required>
						</div>
						<div class="col-12 form-group form-check">
							<label for="apellido1">Primer Apellido</label>
							<input type="text" id="apellido1" name="apellido1" class="form-control" autocomplete="off" required>
						</div>
						<div class="col-12 form-group form-check">
							<label for="apellido2">Segundo Apellido</label>
							<input type="text" id="apellido2" name="apellido2" class="form-control" autocomplete="off">
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
							<label for="genero">Genero</label>
							<select class="form-control" id="genero" name="genero" required>
								<option value="">Seleccione</option>
								<option value="Hombre">Hombre</option>
								<option value="Mujer">Mujer</option>
								<option value="Transexual">Transexual</option>
							</select>
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

<div class="modal fade" id="modal_nuevo2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form action="#" method="POST" id="form_modal_new2" style="">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Nueva Presabana</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-12 form-group form-check">
							<label for="mes">Mes</label>
							<select class="form-control" name="mes" id="mes" required>
								<option value="">Seleccione</option>
								<option value="Enero">Enero</option>
								<option value="Febrero">Febrero</option>
								<option value="Marzo">Marzo</option>
								<option value="Abril">Abril</option>
								<option value="Mayo">Mayo</option>
								<option value="Junio">Junio</option>
								<option value="Julio">Julio</option>
								<option value="Agosto">Agosto</option>
								<option value="Septiembre">Septiembre</option>
								<option value="Octubre">Octubre</option>
								<option value="Noviembre">Noviembre</option>
								<option value="Diciembre">Diciembre</option>
							</select>
						</div>
						<div class="col-12 form-group form-check">
							<label for="trm">Trm</label>
							<input type="text" class="form-control" id="trm" name="trm" required>
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

<input type="hidden" id="hidden_presabana" name="hidden_presabana" value="">

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
		filtrar1();
		filtrar2();
		filtrar3();
	});

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

        $.ajax({
            type: 'POST',
            url: '../script/crud_contenido.php',
            dataType: "JSON",
            data: {
                "pagina": pagina,
                "consultasporpagina": consultasporpagina,
                "sede": sede,
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

    function filtrar2(){
        var input_consultasporpagina = $('#consultasporpagina2').val();
        var input_buscarfiltro = $('#buscarfiltro2').val();
        var input_consultaporsede = $('#consultaporsede2').val();
        
        $('#datatables2').attr({'data-consultasporpagina':input_consultasporpagina})
        $('#datatables2').attr({'data-filtrado':input_buscarfiltro})
        $('#datatables2').attr({'data-sede':input_consultaporsede})

        var pagina = $('#datatables2').attr('data-pagina');
        var consultasporpagina = $('#datatables2').attr('data-consultasporpagina');
        var sede = $('#datatables2').attr('data-sede');
        var filtrado = $('#datatables2').attr('data-filtrado');

        $.ajax({
            type: 'POST',
            url: '../script/crud_contenido.php',
            dataType: "JSON",
            data: {
                "pagina": pagina,
                "consultasporpagina": consultasporpagina,
                "sede": sede,
                "filtrado": filtrado,
                "condicion": "table2",
            },

            success: function(respuesta) {
                //console.log(respuesta);
                if(respuesta["estatus"]=="ok"){
                    $('#resultado_table2').html(respuesta["html"]);
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

    function paginacion2(value){
        $('#datatables2').attr({'data-pagina':value})
        filtrar2();
    }

    $("#form_modal_new").on("submit", function(e){
		e.preventDefault();
		var nombre1 = $('#nombre1').val();
		var nombre2 = $('#nombre2').val();
		var apellido1 = $('#apellido1').val();
		var apellido2 = $('#apellido2').val();
		var documento_tipo = $('#documento_tipo').val();
		var documento_numero = $('#documento_numero').val();
		var genero = $('#genero').val();
		var correo = $('#correo').val();
		var usuario = $('#usuario').val();
		var clave = $('#clave').val();
		var telefono1 = $('#telefono1').val();

		$.ajax({
			type: 'POST',
			url: '../script/crud_contenido.php',
			dataType: "JSON",
			data: {
				"nombre1": nombre1,
				"nombre2": nombre2,
				"apellido1": apellido1,
				"apellido2": apellido2,
				"documento_tipo": documento_tipo,
				"documento_numero": documento_numero,
				"genero": genero,
				"correo": correo,
				"usuario": usuario,
				"clave": clave,
				"telefono1": telefono1,
				"condicion": "guardar1",
			},

			success: function(respuesta) {
				console.log(respuesta);
				if(respuesta["estatus"]=="ok"){
					Swal.fire({
				 		title: 'Ok',
				 		text: "Guardado exitosamente!",
				 		icon: 'success',
				 		position: 'center',
				 		timer: 2000,
					});
					$('#nombre1').val("");
					$('#nombre2').val("");
					$('#apellido1').val("");
					$('#apellido2').val("");
					$('#documento_tipo').val("");
					$('#documento_numero').val("");
					$('#genero').val("");
					$('#correo').val("");
					$('#usuario').val("");
					$('#clave').val("");
					$('#telefono1').val("");
					filtrar1();
				}else{
					Swal.fire({
				 		title: 'Error',
				 		text: respuesta["msg"],
				 		icon: 'error',
				 		position: 'center',
				 		timer: 2000,
					});
				}
				//window.location.href = "index.php";
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}

		});
	});

	$("#form_modal_new2").on("submit", function(e){
		e.preventDefault();
		var mes = $('#mes').val();
		var trm = $('#trm').val();

		$.ajax({
			type: 'POST',
			url: '../script/crud_contenido.php',
			dataType: "JSON",
			data: {
				"mes": mes,
				"trm": trm,
				"condicion": "guardar2",
			},

			success: function(respuesta) {
				console.log(respuesta);
				if(respuesta["estatus"]=="ok"){
					Swal.fire({
				 		title: 'Ok',
				 		text: "Guardado exitosamente!",
				 		icon: 'success',
				 		position: 'center',
				 		timer: 2000,
					});
					/*
					$('#mes').val("");
					$('#trm').val("");
					*/
					filtrar2();
				}else{
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

    function agregar1(id){
    	var pagina = $("#pagina_"+id).val();
    	var mes = $("#mes_"+id).val();
    	var valor = $("#valor_"+id).val();

    	if(pagina == '' || valor=='' || mes==''){
    		Swal.fire({
		 		title: 'Error',
		 		text: "Verifique los campos!",
		 		icon: 'error',
		 		position: 'center',
		 		showConfirmButton: true,
		 		timer: 2000
			});
    		return false;
    	}

		$.ajax({
			type: 'POST',
			url: '../script/crud_contenido.php',
			data: {
				"id": id,
				"pagina": pagina,
				"mes": mes,
				"valor": valor,
				"condicion": "agregar1",
			},
			dataType: "JSON",

			success: function(respuesta) {
				console.log(respuesta);
				if(respuesta["estatus"]=="ok"){
					Swal.fire({
			 			title: 'Ok',
			 			text: "Guardado exitosamente!",
			 			icon: 'success',
			 			position: 'center',
			 			timer: 2000,
					});
				}else if(respuesta["estatus"]=="error"){
					Swal.fire({
			 			title: 'Error',
			 			text: "No existe modelo",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: true,
			 			timer: 2000,
					});
				}
				filtrar3();
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function filtrar3(){
        var input_consultasporpagina = $('#consultasporpagina3').val();
        var input_buscarfiltro = $('#buscarfiltro3').val();
        var input_consultaporsede = $('#consultaporsede3').val();
        
        $('#datatables3').attr({'data-consultasporpagina':input_consultasporpagina})
        $('#datatables3').attr({'data-filtrado':input_buscarfiltro})
        $('#datatables3').attr({'data-sede':input_consultaporsede})

        var pagina = $('#datatables3').attr('data-pagina');
        var consultasporpagina = $('#datatables3').attr('data-consultasporpagina');
        var sede = $('#datatables3').attr('data-sede');
        var filtrado = $('#datatables3').attr('data-filtrado');

        $.ajax({
            type: 'POST',
            url: '../script/crud_contenido.php',
            dataType: "JSON",
            data: {
                "pagina": pagina,
                "consultasporpagina": consultasporpagina,
                "sede": sede,
                "filtrado": filtrado,
                "condicion": "table3",
            },

            success: function(respuesta) {
                console.log(respuesta);
                if(respuesta["estatus"]=="ok"){
                    $('#resultado_table3').html(respuesta["html"]);
                }
            },

            error: function(respuesta) {
                console.log(respuesta['responseText']);
            }
        });
    }

    function eliminar1(id){
		$.ajax({
			type: 'POST',
			url: '../script/crud_contenido.php',
			data: {
				"id": id,
				"condicion": "eliminar1",
			},
			dataType: "JSON",

			success: function(respuesta) {
				console.log(respuesta);
				if(respuesta["estatus"]=="ok"){
					Swal.fire({
			 			title: 'Ok',
			 			text: respuesta["msg"],
			 			icon: 'success',
			 			position: 'center',
			 			timer: 2000,
					});
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
				filtrar3();
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	$("#formulario1").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#files1')[0].files[0];
        fd.append('file',files);
        fd.append('importar_mes',$('#importar_mes').val());
        fd.append('condicion','importar1');
        
        $.ajax({
            url: '../script/crud_contenido.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	//
            },

            success: function(response){
            	console.log(response);
            	if(response=='error'){
            		Swal.fire({
		 				title: 'Error',
			 			text: response["msg"],
			 			icon: 'error',
			 			position: 'center',
			 			timer: 2000
					});
            		return false;
            	}else if(response=='ok'){
            		Swal.fire({
		 				title: 'Correcto',
		 				text: response["msg"],
		 				icon: 'success',
		 				position: 'center',
		 				timer: 2000
					});
            	}
            	filtrar3();
            },

            error: function(response){
            	console.log(response['responseText']);
            }

        });

    });

</script>