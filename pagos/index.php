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

  	.seccion1{
  		margin-left: 2rem;
  		margin-right: 2rem;
  	}
	</style>

<?php
	include('../script/conexion.php');
	$ubicacion = "pagos";
	include('../script/navbar_verificacion.php');
	include('../navbar.php');
?>
	<form id="formulario1" method="POST">
		<input type="hidden" id="modelo_view" value="<?php echo $modelo_view; ?>">
		<input type="hidden" id="modelo_edit" value="<?php echo $modelo_edit; ?>">
		<input type="hidden" id="modelo_delete" value="<?php echo $modelo_delete; ?>">
	</form>
	<div class="row">
		<div class="col-12 text-center mt-3 ml-3">
			<a href="nuevo_pago.php" style="text-decoration: none;">
				<input type="submit" class="btn btn-success" value="Nuevo Pago">
			</a>
			<input type="submit" class="btn btn-info" value="Descuentos" data-toggle="modal" data-target="#exampleModal3">
			<button type="button" class="btn btn-info" value="No" id="graficos" onclick="mostrarSeccionGraficos1(this.id,value);">Gráficos</button>
			<button type="button" class="btn btn-info" value="No" id="datos" onclick="mostrarSeccion1(this.id,value);">Datos</button>
		</div>
	</div>

	<!--<div class="col-12 text-center" style="font-weight: bold; ">Resumen de Pagos Efectuados</div>-->

	<div class="seccion1" id="seccion1" style="display: none;">
	    <div class="row">
		    <button type="button" class="btn btn-info" value="No" id="Imlive" onclick="mostrarSeccion2(this.id,value);">Imlive</button>
		    <button type="button" class="btn btn-info ml-3" value="No" id="XLove" onclick="mostrarSeccion2(this.id,value);">XLove</button>
		    <button type="button" class="btn btn-info ml-3" value="No" id="chaturbate" onclick="mostrarSeccion2(this.id,value);">Chaturbate</button>
		    <button type="button" class="btn btn-info ml-3" value="No" id="stripchat" onclick="mostrarSeccion2(this.id,value);">Stripchat</button>
		    <button type="button" class="btn btn-info ml-3" value="No" id="streamate" onclick="mostrarSeccion2(this.id,value);">Streamate</button>
		    <button type="button" class="btn btn-info ml-3" value="No" id="Myfreecams" onclick="mostrarSeccion2(this.id,value);">Myfreecams</button>
		</div>
	</div>

	<div class="seccion1" id="div_Imlive" style="display: none; border: 3px solid black; border-radius: 1rem; padding: 5px 5px 5px 5px;">
		<form id="formulario_Imlive" method="POST" action="#">
	    	<div class="row">
	    		<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">Reporte de Imlive</p>
				</div>
				<div class="form-group col-6">
				    <label for="archivo_Imlive">Archivo Generado</label>
				    <input type="file" class="form-control" name="archivo_Imlive" id="archivo_Imlive" style="margin-left: 18px; margin-right: 16px;" required>
				</div>
				<div class="form-group col-6">
				    <label for="fecha">Fecha</label>
				    <?php
				    	$fecha_actual = date('Y-m-d');
				    ?>
				    <input type="date" class="form-control" value="<?php echo $fecha_actual; ?>" id="fecha_Imlive" required>
				</div>
				<div class="form-group col-12 text-center">
				    <button type="submit" id="submit_Imlive" class="btn btn-primary">Cargar Datos</button>
				</div>
			</div>
		</form>
	</div>

	<div class="seccion1" id="div_XLove" style="display: none; border: 3px solid black; border-radius: 1rem; padding: 5px 5px 5px 5px;">
		<form id="formulario_XLove" method="POST" action="#">
	    	<div class="row">
				<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">Reporte de XLove</p>
				</div>
				<div class="form-group col-12">
					<label>Archivo Excel</label>
				    <input type="file" class="form-control" name="archivo_XLove" id="archivo_XLove" required>
				</div>
				<div class="form-group col-6">
					<label>Recorte N°</label>
					<select class="form-control" required name="recorte_XLove" id="recorte_XLove">
						<option value="">Seleccione</option>
						<option value="1">1</option>
						<option value="2">2</option>
					</select>
				</div>
				<div class="form-group col-6">
					<label>EUR a USD Coste</label>
					<input type="text" id="coste_euro_XLove" name="coste_euro_XLove" class="form-control" required>
				</div>
				<div class="form-group col-6">
					<label>Mes</label>
					<select class="form-control" required name="mes_XLove" id="mes_XLove">
						<option value="">Seleccione</option>
						<option value="Enero">Enero</option>
						<option value="Febrero">Febrero</option>
						<option value="Marzo">Marzo</option>
						<option value="Junio">Junio</option>
						<option value="Julio">Julio</option>
						<option value="Agosto">Agosto</option>
						<option value="Septiembre">Septiembre</option>
						<option value="Octubre">Octubre</option>
						<option value="Noviembre">Noviembre</option>
						<option value="Diciembre">Diciembre</option>
					</select>
				</div>
				<div class="form-group col-6">
					<label>Año</label>
					<select class="form-control" required name="year_XLove" id="year_XLove">
						<option value="2020">2020</option>
						<option value="2021">2021</option>
						<option value="2022">2022</option>
						<option value="2023">2023</option>
						<option value="2024">2024</option>
						<option value="2025">2025</option>
					</select>
				</div>
				<div class="form-group col-12 text-center">
				    <button type="submit" id="submit_XLove" class="btn btn-primary">Ejecutar API</button>
				</div>
			</div>
		</form>
	</div>

	<div class="seccion1" id="div_chaturbate" style="display: none; border: 3px solid black; border-radius: 1rem; padding: 5px 5px 5px 5px;">
		<form id="formulario_chaturbate" method="POST" action="#">
	    	<div class="row">
				<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">Reporte de Chaturbate</p>
				</div>
				<div class="form-group col-6">
					<label>Archivo Excel</label>
				    <input type="file" class="form-control" name="archivo_chaturbate" id="archivo_chaturbate" required>
				</div>
				<div class="form-group col-6">
					<label>Fecha</label>
					<input type="date" id="fecha_chaturbate" class="form-control" name="fecha_chaturbate" value="<?php echo date('Y-m-d'); ?>" required>
				</div>
				<div class="form-group col-12 text-center">
				    <button type="submit" id="submit_chaturbate" class="btn btn-primary">Ejecutar API</button>
				</div>
			</div>
		</form>
	</div>

	<div class="seccion1" id="div_stripchat" style="display: none; border: 3px solid black; border-radius: 1rem; padding: 5px 5px 5px 5px;">
		<form id="formulario_stripchat" method="POST" action="#">
	    	<div class="row">
				<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">Reporte de Stripchat</p>
				</div>
				<div class="form-group col-6">
					<label>Archivo Excel</label>
				    <input type="file" class="form-control" name="archivo_stripchat" id="archivo_stripchat" required>
				</div>
				<div class="form-group col-6">
					<label>Fecha</label>
					<input type="date" id="fecha_stripchat" class="form-control" name="fecha_stripchat" value="<?php echo date('Y-m-d'); ?>" required>
				</div>
				<div class="form-group col-12 text-center">
				    <button type="submit" id="submit_stripchat" class="btn btn-primary">Ejecutar API</button>
				</div>
			</div>
		</form>
	</div>

	<div class="seccion1" id="div_streamate" style="display: none; border: 3px solid black; border-radius: 1rem; padding: 5px 5px 5px 5px;">
		<form id="formulario_streamate" method="POST" action="#">
	    	<div class="row">
				<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">Reporte de StreaMate</p>
				</div>
				<div class="form-group col-6">
					<label>Archivo Excel</label>
				    <input type="file" class="form-control" name="archivo_streamate" id="archivo_streamate" required>
				</div>
				<div class="form-group col-6">
					<label>Fecha</label>
					<input type="week" name="fecha_streamate" id="fecha_streamate" class="form-control" min="2020-11-09" required>
				</div>
				<div class="form-group col-12 text-center">
				    <button type="submit" id="submit_streamate" class="btn btn-primary">Ejecutar API</button>
				</div>
			</div>
		</form>
	</div>

	<div class="seccion1" id="div_Myfreecams" style="display: none; border: 3px solid black; border-radius: 1rem; padding: 5px 5px 5px 5px;">
	    	<div class="row">
				<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">Reporte de Myfreecams</p>
				</div>
				<div class="form-group col-12">
					<label>Lapso</label>
					<input type="date" name="fecha_Myfreecams" id="fecha_Myfreecams" class="form-control" min="2020-11-01" step="15" required>
				</div>
				<div class="form-group col-12 text-center">
				    <button type="submit" id="submit_Myfreecams" class="btn btn-primary">Consultar Modelos</button>
				</div>
			</div>

			<div id="div_Myfreecams2">
				<form id="formulario_Myfreecams" style="width: 95%;" method="POST" action="#">
					<div id="resultado1_Myfreecams" class="form-group col-12 text-center">
						<table border="1" class="table">
							<tr>
								<td>Modelo</td>
								<td>Usuario</td>
								<td>Contraseña</td>
							</tr>
						</table>
						<?php
							$sql1 = "SELECT * FROM chaturbate WHERE tokens >= 1";
							$registro1 = mysqli_query($conexion,$sql1);
							while($row1 = mysqli_fetch_array($registro1)) {
								
							}
						?>
					</div>
				</form>
			</div>
	</div>

<!--****************************GRAFICOS****************************-->

	<div class="seccion1" id="graficos1" style="display: none; border: 3px solid black; border-radius: 1rem; padding: 5px 5px 5px 5px;">
		<form id="formulario_stripchat" method="POST" action="#">
	    	<div class="row">
				<div class="form-group col-12">
				    <p class="text-center" style="font-weight: bold; font-size: 20px;">Reporte de Gráficos</p>
				</div>
				<div class="form-group col-4">
					<label>Gráficos</label>
				    <select class="form-control" name="select_graficos1" id="select_graficos1" required>
				    	<option value="">Seleccione</option>
				    	<option value="Imlive">Imlive</option>
				    	<option value="XLove">XLove</option>
				    	<option value="Chaturbate">Chaturbate</option>
				    	<option value="Stripchat">Stripchat</option>
				    </select>
				</div>
				<div class="form-group col-12 text-center">
				    <button type="submit" id="submit_stripchat" class="btn btn-primary">Crear Gráfica</button>
				</div>
			</div>
		</form>
	</div>

<!--****************************FIN GRAFICOS****************************-->


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

<script type="text/javascript">
	$(document).ready(function() {
    	var table = $('#example').DataTable( {
        	//"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
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

	$('#myModal').on('shown.bs.modal', function () {
	  	$('#myInput').trigger('focus')
	});

	function mostrarSeccion1(button,value){
		//console.log(button);
		if(value=='Si'){
			$('#seccion1').hide('slow');
			$('#'+button).val('No');
		}else{
			$('#seccion1').show('slow');
			$('#'+button).val('Si');
		}
	}

	function mostrarSeccion2(button,value){
		//console.log(button);
		if(value=='Si'){
			$('#div_'+button).hide('slow');
			$('#'+button).val('No');
			$('#'+button).removeClass('active');
			$('#'+button).removeClass('font-weight-bold');
		}else{
			$('#div_'+button).show('slow');
			$('#'+button).val('Si');
			$('#'+button).addClass('active');
			$('#'+button).addClass('font-weight-bold');
		}
	}

	$("#formulario_Imlive").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#archivo_Imlive')[0].files[0];
        fd.append('file',files);
        fd.append('fecha_Imlive',$('#fecha_Imlive').val());

        $.ajax({
            url: '../script/subir_imlive.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	//$('#submit_Imlive').attr('disabled','true');
            },

            success: function(response){
            	console.log(response);
            	if(response=='error'){
            		$('#submit_Imlive').attr('disabled','false');
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> xls xml xlam xlsx",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
            		return false;
            	}
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    });

    $("#formulario_XLove").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#archivo_XLove')[0].files[0];
        fd.append('file',files);
        fd.append('recorte_XLove',$('#recorte_XLove').val());
        fd.append('mes_XLove',$('#mes_XLove').val());
        fd.append('year_XLove',$('#year_XLove').val());
        fd.append('coste_euro_XLove',$('#coste_euro_XLove').val());

        $.ajax({
            url: '../script/subir_xlove.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_XLove').attr('disabled','true');
            },

            success: function(response){
            	//console.log(response);
            	if(response=='error'){
            		$('#submit_XLove').attr('disabled','false');
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> xls xml xlam xlsx",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
            		return false;
            	}else{
            		Swal.fire({
		 				title: 'Guardado exitosamente!',
		 				text: "Limpiando Cache...",
		 				icon: 'success',
		 				position: 'center',
		 				showConfirmButton: true,
		 				timer: 2000
					});
	            	setTimeout(function() {
				      	window.location.href = "index.php";
				    },2000);
            	}
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    });


    $("#formulario_chaturbate").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#archivo_chaturbate')[0].files[0];
        fd.append('file',files);
        fd.append('fecha_chaturbate',$('#fecha_chaturbate').val());

        $.ajax({
            url: '../script/subir_chaturbate.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_chaturbate').attr('disabled','true');
            },

            success: function(response){
            	console.log(response);
            	if(response=='error'){
            		$('#submit_chaturbate').attr('disabled','false');
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> xls xml xlam xlsx",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
            		return false;
            	}else{
            		Swal.fire({
		 				title: 'Guardado exitosamente!',
		 				text: "Limpiando Cache...",
		 				icon: 'success',
		 				position: 'center',
		 				showConfirmButton: true,
		 				timer: 2000
					});
	            	setTimeout(function() {
				      	window.location.href = "index.php";
				    },2000);
            	}
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    });

    $("#formulario_stripchat").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#archivo_stripchat')[0].files[0];
        fd.append('file',files);
        fd.append('fecha_stripchat',$('#fecha_stripchat').val());

        $.ajax({
            url: '../script/subir_stripchat.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_stripchat').attr('disabled','true');
            },

            success: function(response){
            	console.log(response);
            	if(response=='error'){
            		$('#submit_stripchat').attr('disabled','false');
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> xls xml xlam xlsx",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
            		return false;
            	}else{
            		Swal.fire({
		 				title: 'Guardado exitosamente!',
		 				text: "Limpiando Cache...",
		 				icon: 'success',
		 				position: 'center',
		 				showConfirmButton: true,
		 				timer: 2000
					});
	            	setTimeout(function() {
				      	window.location.href = "index.php";
				    },2000);
            	}
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    });

    function mostrarSeccionGraficos1(button,value){
    	console.log('ok');
    	if(value=='Si'){
    		$('#graficos1').hide('slow');
    	}else{
    		$('#graficos1').show('slow');
    	}
    }

    $("#formulario_streamate").on("submit", function(e){
		e.preventDefault();
        var fd = new FormData();
        var files = $('#archivo_streamate')[0].files[0];
        fd.append('file',files);
        fd.append('fecha_streamate',$('#fecha_streamate').val());

        $.ajax({
            url: '../script/subir_streamate.php',
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,

            beforeSend: function (){
            	$('#submit_streamate').attr('disabled','true');
            },

            success: function(response){
            	console.log(response);
            	if(response=='error'){
            		$('#submit_streamate').attr('disabled','false');
            		Swal.fire({
		 				title: 'Formato Invalido',
			 			text: "Formato Validos -> xls xml xlam xlsx",
			 			icon: 'error',
			 			position: 'center',
			 			showConfirmButton: false,
			 			timer: 3000
					});
            		return false;
            	}else{
            		Swal.fire({
		 				title: 'Guardado exitosamente!',
		 				text: "Limpiando Cache...",
		 				icon: 'success',
		 				position: 'center',
		 				showConfirmButton: true,
		 				timer: 2000
					});
	            	setTimeout(function() {
				      	window.location.href = "index.php";
				    },2000);
            	}
            },

            error: function(response){
            	console.log(response['responseText']);
            }
        });
    });



</script>