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
	$ubicacion = "sexshop";
	include('../script/navbar_verificacion.php');
	include('../navbar.php');
?>

	<div class="seccion1" id="seccion1">
		<div class="row">
			<div class="col-12 text-center" style="font-weight: bold; font-size: 30px; text-transform: uppercase;">Agregar Descuento</div>
			<div class="col-3 mt-3">
				<label for="fecha_desde" style="color:black; font-weight: bold;">Fecha</label>
				<input type="date" id="fecha_desde" name="fecha_desde" class="form-control">
			</div>
			<div class="col-3 mt-3">
				<label for="modelo" style="color:black; font-weight: bold;">Documento del modelo</label>
				<input type="text" id="modelo" name="modelo" class="form-control">
			</div>
			<div class="col-3 mt-3">
				<label for="valor" style="color:black; font-weight: bold;">Cantidad a descontar</label>
				<input type="text" id="valor" name="valor" class="form-control">
			</div>
			<div class="col-3 mt-3">
				<br>
				<button type="button" class="btn btn-success mt-2" onclick="guardar1();">Guardar</button>
			</div>
		</div>
	</div>

	<div class="seccion2" id="seccion2" style="margin-top: 3rem;">
		<div class="row ml-3 mr-3" style="margin-top: 4rem;">
			<div class="col-12 text-center" style="font-weight: bold; font-size: 30px; text-transform: uppercase;">Listado de Modelos</div>
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
			<div class="col-3 form-group form-check">
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
			<div class="col-2">
				<br>
				<button type="button" class="btn btn-info mt-2" onclick="filtrar1();">Filtrar</button>
			</div>
			<div class="col-12" style="background-color: white; border-radius: 1rem; padding: 20px 1px 1px 1px;" id="resultado_table1"></div>
		</div>
	</div>

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
            url: '../script/crud_sexshop.php',
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

    function paginacion1(value){
        $('#datatables').attr({'data-pagina':value})
        filtrar1();
    }

    function guardar1(){
    	var fecha_desde = $("#fecha_desde").val();
    	var modelo = $("#modelo").val();
    	var valor = $("#valor").val();

    	if(fecha_desde == '' || modelo=='' || valor<=0){
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
			url: '../script/crud_sexshop.php',
			data: {
				"fecha_desde": fecha_desde,
				"modelo": modelo,
				"valor": valor,
				"condicion": "guardar1",
			},
			dataType: "JSON",

			success: function(respuesta) {
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
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

</script>