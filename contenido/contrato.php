<?php
	session_start();
	if(!isset($_SESSION['nombre'])){
		header("Location: ../index.php");
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
	<link rel="stylesheet" href="../assets/libs/css/style.css">
    <link rel="stylesheet" href="../assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="../assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="../assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="../assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="../assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
	<title>Camaleon Sistem</title>
</head>
<body>

<?php
	include('../script/conexion.php');
	$sql1 = "SELECT * FROM contenido_modelos WHERE id = ".$_SESSION["id"];
	$proceso1 = mysqli_query($conexion,$sql1);
	while($row1=mysqli_fetch_array($proceso1)){
		$id = $row1["id"];
		$banco_cedula = $row1["banco_cedula"];
		$banco_nombre = $row1["banco_nombre"];
		$banco_tipo = $row1["banco_tipo"];
		$banco_numero = $row1["banco_numero"];
		$banco_banco = $row1["banco_banco"];
		$bcpp = $row1["BCPP"];
		$banco_tipo_documento = $row1["banco_tipo_documento"];
	}

	$sql2 = "SELECT * FROM contenido_documentos WHERE id_documentos = 14 and id_modelos = ".$id;
	$proceso2 = mysqli_query($conexion,$sql2);
	$contador2 = mysqli_num_rows($proceso2);
	if($contador2==0){
		$imagen = '';
	}else{
		while($row2=mysqli_fetch_array($proceso2)){
			$imagen = $row2["imagen"];
		}
	}
?>

	<div class="dashboard-main-wrapper">
		<?php include("header.php"); ?>
        <div class="dashboard-wrapper">
            <div class="page-header">
                <div class="container-fluid dashboard-content ">
                    <h2 class="pageheader-title">Contrato </h2>
                    <p class="pageheader-text">Contrato</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Contrato</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="container">
                        <form id="formulario1" method="POST" action="#" enctype="multipart/form-data">
                            <div class="row">
								<input type="hidden" id="hidden_id" name="hidden_id" value="<?php echo $_SESSION['id']; ?>">
                                <div class="col-6 mt-3">
                                	<label form="documento">Identifique Documento</label>
                                	<select class="form-control" id="documento" name="documento" required>
                                		<option value="">Seleccione</option>
                                		<option value="1">Contrato de Mandato</option>
                                	</select>
                                </div>
                                <div class="col-6 mt-3">
                                	<label form="file">Archivo a Subir (Solo formato PNG o JPG)</label>
                                   	<input type="file" class="form-control" id="file" name="file" required>
                                </div>
	                            <div class="col-12 mt-3 text-center">
	                            	<a href="pdf_muestra.php" target="_blank">
										<button type="button" class="btn btn-primary" id="firma" name="firma">VER MUESTRA CONTRATO</button>
									</a>
	                            	<a href="../script/generador_firmas1.php" target="_blank">
										<button type="button" class="btn btn-primary" id="firma" name="firma">GENERAR FIRMA</button>
									</a>
									<button type="button" class="btn btn-primary" onclick="consultar1();">CONSULTAR</button>
									<button type="submit" class="btn btn-primary" id="submit1" name="submit1">SUBIR</button>
								</div>
							</div>
						</form>
						<div class="row">
							<div class="col-12 mt-3 text-center" id="respuesta1"></div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

<script src="../js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../js/popper.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script type="text/javascript">
	$(document).ready(function() {
		//
	});

	$("#formulario1").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#file')[0].files[0];
        fd.append('file',files);
        fd.append('documento',$('#documento').val());
        fd.append('id',$('#hidden_id').val());
        fd.append('condicion','subir_documentos1');
        $.ajax({
            url: '../script/crud_contenido.php',
            type: 'POST',
            dataType: "JSON",
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit1').prop('disabled', true);
            },

            success: function(respuesta){
            	console.log(respuesta);
            	if(respuesta["estatus"]=='error'){
            		Swal.fire({
		 				title: 'Error',
			 			text: respuesta["msg"],
			 			icon: 'error',
			 			position: 'center',
			 			timer: 2000
					});
            		return false;
            	}else if(respuesta["estatus"]=='ok'){
            		Swal.fire({
		 				title: 'Correcto',
		 				text: respuesta["msg"],
		 				icon: 'success',
		 				position: 'center',
		 				timer: 2000
					});
					$('#documento').val("");
					$('#file').val("");
            	}
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
        $('#submit1').prop('disabled', false);
	});

	function consultar1(){
		var id = $('#hidden_id').val();
		var documento = $('#documento').val();

		if(documento==''){
			Swal.fire({
				title: 'Error',
				text: "Por favor indique que documento desea consultar!",
				icon: 'error',
				position: 'center',
				timer: 5000
			});
			return false;
		}

		$.ajax({
            type: 'POST',
            url: '../script/crud_contenido.php',
            dataType: "JSON",
            data: {
                "id": id,
                "documento": documento,
                "condicion": "consultar_documentos1",
            },

            success: function(respuesta) {
                console.log(respuesta);
                if(respuesta["estatus"]=="ok"){
                    $('#respuesta1').html(respuesta["html1"]);
                }else if(respuesta["estatus"]=="error"){
                	Swal.fire({
		 				title: 'Error',
			 			text: respuesta["msg"],
			 			icon: 'error',
			 			position: 'center',
			 			timer: 2000
					});
                }
            },

            error: function(respuesta) {
                console.log(respuesta['responseText']);
            }
        });
	}
</script>
