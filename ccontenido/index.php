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
	$ubicacion = "ccontenido";
	include('../script/navbar_verificacion.php');
	include('../navbar.php');
?>

	<div class="seccion1" id="seccion1" style="margin-top: 3rem;">
		<div class="row ml-3 mr-3">
			<div class="col-12 text-center" style="font-weight: bold; font-size: 22px; text-transform: uppercase;">Cuentas de Modelos Contenido</div>
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
				<input type="text" class="form-control" id="buscarfiltro" name="buscarfiltro" autocomplete="off">
				<input type="hidden" id="consultaporsede" name="consultaporsede" value="">
			</div>
			<div class="col-2">
				<br>
				<button type="button" class="btn btn-info mt-2" onclick="filtrar1();">Filtrar</button>
			</div>
			<div class="col-12" style="background-color: white; border-radius: 1rem; padding: 20px 1px 1px 1px;" id="resultado_table1"></div>
		</div>
	</div>

</body>
</html>

<div class="modal fade" id="modal_ver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form action="#" method="POST" id="form_modal_new" style="">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Cuentas</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row" id="ver_respuesta1"></div>
					<div class="row">
						<div class="col-6 form-group form-check">
							<label for="nueva_cuenta">Cuenta Nueva</label>
							<input type="text" id="nueva_cuenta" name="nueva_cuenta" class="form-control" autocomplete="off" required>
						</div>
						<div class="col-6 form-group form-check">
							<label for="nueva_pagina">Pagina</label>
							<select class="form-control" id="nueva_pagina" name="nueva_pagina" required>
								<option value="">Seleccione</option>
								<?php
								$sql1 = "SELECT * FROM contenido_paginas";
								$proceso1 = mysqli_query($conexion,$sql1);
								while($row1=mysqli_fetch_array($proceso1)){
									$paginas_id = $row1["id"];
									$paginas_nombre = $row1["nombre"];
									echo '<option value="'.$paginas_id.'">'.$paginas_nombre.'</option>';
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

<input type="hidden" id="hidden_id" name="hidden_id" value="">

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
                "condicion": "table4",
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

    function paginacion1(value){
        $('#datatables').attr({'data-pagina':value})
        filtrar1();
    }

    $("#form_modal_new").on("submit", function(e){
		e.preventDefault();
		var id = $('#hidden_id').val();
		var nueva_cuenta = $('#nueva_cuenta').val();
		var nueva_pagina = $('#nueva_pagina').val();

		$.ajax({
			type: 'POST',
			url: '../script/crud_contenido.php',
			dataType: "JSON",
			data: {
				"id": id,
				"nueva_cuenta": nueva_cuenta,
				"nueva_pagina": nueva_pagina,
				"condicion": "agregar_cuentas1",
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
					$('#nueva_cuenta').val("");
					$('#nueva_pagina').val("");
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
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}

		});
	});

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

	function consultar1(id){
		$('#hidden_id').val(id);
		$.ajax({
			type: 'POST',
			url: '../script/crud_contenido.php',
			data: {
				"id": id,
				"condicion": "consultar_cuentas1",
			},
			dataType: "JSON",

			success: function(respuesta) {
				console.log(respuesta);
				$('#ver_respuesta1').html(respuesta["html"]);
				filtrar1();
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}
</script>