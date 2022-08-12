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

	<div class="container">

		<div class="row" style="margin-top:3rem;">
			<div class="col-12 text-center" style="font-weight:bold;font-size: 20px;">Eliminar Documentación</div>
			<div class="col-6">
				<label for="modelo1">Modelo</label>
				<input type="text" class="form-control" name="modelo1" id="modelo1" value="" autocomplete="off">	
			</div>
			<div class="col-3">
				<label for="documento">Documento</label>
				<select class="form-control" id="documento" name="documento">
					<option value="">Seleccione</option>
					<?php
					$sql1 = "SELECT * FROM documentos";
					$proceso1 = mysqli_query($conexion,$sql1);
					while($row1=mysqli_fetch_array($proceso1)){
						$documentos_id = $row1["id"];
						$documentos_nombre = $row1["nombre"];
						echo '<option value="'.$documentos_id.'">'.$documentos_nombre.'</option>';
					}
					?>
				</select>
			</div>
			<div class="col-3 text-center" style="margin-top:2rem;">
				<button type="button" class="btn btn-info" onclick="cambiar1();">Cambiar</button>
			</div>
		</div>


		<div class="row" style="margin-top:3rem;">
			<div class="col-12 text-center" style="font-weight:bold;font-size: 20px;">Cambio de Sede</div>
			<div class="col-6">
				<label for="modelo2">Modelo</label>
				<input type="text" class="form-control" name="modelo2" id="modelo2" value="" autocomplete="off">	
			</div>
			<div class="col-3">
				<label for="sede">Sedes</label>
				<select class="form-control" id="sede" name="sede">
					<option value="">Seleccione</option>
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
			<div class="col-3 text-center" style="margin-top:2rem;">
				<button type="button" class="btn btn-primary" onclick="cambiar2();">Sedes</button>
			</div>
		</div>
	</div>

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
    } );

	function cambiar1(){
		var modelo = $('#modelo1').val();
		var documento = $('#documento').val();
        $.ajax({
            type: 'POST',
            url: '../script/crud_soluciones.php',
            dataType: "JSON",
            data: {
                "modelo": modelo,
                "documento": documento,
                "condicion": "cambiar1",
            },

            success: function(respuesta) {
                if(respuesta["estatus"]=="ok"){
                    Swal.fire({
                        title: 'Success',
                        text: respuesta["msg"],
                        icon: 'success',
                        showConfirmButton: true,
                    })
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

    function cambiar2(){
		var modelo = $('#modelo2').val();
		var sede = $('#sede').val();
        $.ajax({
            type: 'POST',
            url: '../script/crud_soluciones.php',
            dataType: "JSON",
            data: {
                "modelo": modelo,
                "sede": sede,
                "condicion": "cambiar2",
            },

            success: function(respuesta){
                if(respuesta["estatus"]=="ok"){
                    Swal.fire({
                        title: 'Success',
                        text: respuesta["msg"],
                        icon: 'success',
                        showConfirmButton: true,
                    })
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