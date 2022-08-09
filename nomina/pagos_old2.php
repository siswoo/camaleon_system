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

  	body{
  		font-family: Helvetica Neue,Helvetica,Arial,sans-serif;
  	}
</style>

<body>

<?php
	include('../script/conexion.php');
	$ubicacion_url = $_SERVER["PHP_SELF"];
	$ubicacion = "nomina";
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

	<div class="col-12 mt-3 mb-3 text-center" style="font-size: 28px; font-weight: bold;">MODULO DE PAGOS NOMINA</div>

	<div class="row ml-3 mr-3">
        <input type="hidden" name="datatables" id="datatables" data-pagina="1" data-consultasporpagina="10" data-filtrado="" data-sede="">
        <div class="col-2 form-group form-check">
            <label for="consultasporpagina" style="color:black; font-weight: bold;">Consultas por Página</label>
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
        <div class="col-3 form-group form-check">
            <label for="consultaporsede" style="color:black; font-weight: bold;">Elegir Sede</label>
            <select class="form-control" id="consultaporsede" name="consultaporsede">
                <option value="">Todos</option>
                <?php
	    		$sql1="SELECT * FROM sedes ORDER BY nombre ASC";
	    		$proceso1=mysqli_query($conexion,$sql1);
	    		while($row1=mysqli_fetch_array($proceso1)){
	    			$sede_id=$row1["id"];
	    			$sede_nombre=$row1["nombre"];
	    			echo '
	    				<option value="'.$sede_id.'">'.$sede_nombre.'</option>
	    			';
	   			}
	   			?>
            </select>
        </div>
        <div class="col-1 text-center">
            <br>
            <button type="button" class="btn btn-info mt-2" onclick="filtrar1();">Filtrar</button>
        </div>
        <div class="col-1 text-center">
            <br>
            <a href="pagos2.php" target="_blank">
            	<button type="button" class="btn btn-success mt-2">Pagar</button>
            </a>
        </div>
        <div class="col-12" style="background-color: white; border-radius: 1rem; padding: 20px 1px 1px 1px;" id="resultado_table1"></div>
    </div>
</body>
</html>

<input type="hidden" id="nomina_id" name="nomina_id" value="">

<!-- Modal Dias no laborados -->
	<div class="modal fade" id="modal_nolaborados1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="modal_nolaborados1_form" style="">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Días No Laborados</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row" id="modal_nolaborados1_respuesta1"></div>
					</div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" class="btn btn-success" id="modal_nolaborados1_submit">Guardar</button>
			      	</div>
		      	</form>
	    	</div>
	  	</div>
	</div>
<!-- FIN Modal Dias no laborados -->

<!-- Modal Dias dobleturnos1 -->
	<div class="modal fade" id="modal_dobleturnos1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="modal_dobleturnos1_form" style="">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Doble Turnos</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row" id="modal_dobleturnos1_respuesta1"></div>
					</div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" class="btn btn-success" id="modal_dobleturnos1_respuesta1">Guardar</button>
			      	</div>
		      	</form>
	    	</div>
	  	</div>
	</div>
<!-- FIN Modal Dias dobleturnos1 -->

<!-- Modal Dias descuentos1 -->
	<div class="modal fade" id="modal_descuentos1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="modal_descuentos1_form" style="">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Descuentos</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row" id="modal_descuentos1_respuesta1"></div>
					</div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" class="btn btn-success" id="modal_descuentos1_respuesta1">Guardar</button>
			      	</div>
		      	</form>
	    	</div>
	  	</div>
	</div>
<!-- FIN Modal Dias descuentos1 -->

<script src="../js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../js/popper.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="../js/navbar.js"></script>

<?php include('../footer.php'); ?>

<script type="text/javascript">
	$(document).ready(function() {
        filtrar1();
        //setInterval('filtrar1()',3000);
    } );

	function sede1(value){
		
		if(value==''){
			return false;

		}

		$.ajax({
			type: 'POST',
			url: '../script/crud_nomina_pagos.php',
			dataType: "JSON",
			data: {
				"value": value,
				"condicion": "consultar_sede1",
			},

			success: function(respuesta) {
				console.log(respuesta);
				if(respuesta["estatus"]=="ok"){
					$("#table1_resultado").html(respuesta["html"]);
                }else if(respuesta["estatus"]=="error"){
                    Swal.fire({
                        title: 'Error',
                        text: respuesta["msg"],
                        icon: 'error',
                    })
                }
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function auto_guardado(id_nomina,concepto,texto,valor){
		if(concepto==1){
			concepto = "prestamos";
		}else if(concepto==2){
			concepto = "bono";
		}else if(concepto==3){
			concepto = "devolucion";
		}else if(concepto==4){
			concepto = "ajustenomina";
		}else if(concepto==5){
			concepto = "otrosconceptos";
		}else if(concepto==6){
			concepto = "descuentos";
		}

		$.ajax({
			type: 'POST',
			url: '../script/crud_nomina_pagos.php',
			dataType: "JSON",
			data: {
				"id_nomina": id_nomina,
				"concepto": concepto,
				"texto": texto,
				"valor": valor,
				"condicion": "auto_guardado1",
			},

			success: function(respuesta) {
				console.log(respuesta);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function nolaborados1(nomina_id){
		$('#nomina_id').val(nomina_id);
		$.ajax({
			type: 'POST',
			url: '../script/crud_nomina_pagos.php',
			dataType: "JSON",
			data: {
				"nomina_id": nomina_id,
				"condicion": "nolaborados1",
			},

			success: function(respuesta) {
				console.log(respuesta);
				$('#modal_nolaborados1_respuesta1').html(respuesta["html1"]);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	$("#modal_nolaborados1_form").on("submit", function(e){
		e.preventDefault();
		var f = $(this);
		var texto 	= $('#modal_nolaborados1_texto').val();
		var fecha  		= $('#modal_nolaborados1_fecha').val();
		var nomina_id   =$('#nomina_id').val();

		if(texto=='' || fecha==''){
			Swal.fire({
	 			title: 'Error!',
	 			text: "No dejar campos vacios",
	 			icon: 'error',
	 			position: 'center',
			});
		}

	    $.ajax({
			type: 'POST',
			url: '../script/crud_nomina_pagos.php',
			dataType: "JSON",
			data: {
				"texto": texto,
				"fecha": fecha,
				"nomina_id": nomina_id,
				"condicion": "nolaborados2",
			},

			success: function(respuesta) {
				console.log(respuesta);
				filtrar1();
				if(respuesta["estatus"]=="ok"){
					Swal.fire({
		 				title: 'Guardado',
		 				text: respuesta["msg"],
		 				icon: 'success',
		 				position: 'center',
					});
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	});

	function eliminar_nolaborados1(id_nolaborados){
		$.ajax({
			type: 'POST',
			url: '../script/crud_nomina_pagos.php',
			dataType: "JSON",
			data: {
				"id": id_nolaborados,
				"condicion": "eliminar_nolaborados1",
			},

			success: function(respuesta) {
				console.log(respuesta);
				filtrar1();
				if(respuesta["estatus"]=="ok"){
					$('#modal_nolaborados1_generado_'+id_nolaborados).hide("slow");
					Swal.fire({
		 				title: 'Correcto!',
		 				text: respuesta["msg"],
		 				icon: 'success',
		 				position: 'center',
					});
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

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
            url: '../script/crud_nomina_pagos.php',
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
                console.log(respuesta);
                $('#resultado_table1').html(respuesta["html"]);
                if(respuesta["estatus"]=="ok"){
                    $('#resultado_table1').html(respuesta["html"]);
                }else{
                	Swal.fire({
		 				title: 'Error',
		 				text: respuesta["msg"],
		 				icon: 'error',
		 				position: 'center',
					});
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

    function dobleturnos1(nomina_id){
		$('#nomina_id').val(nomina_id);
		$.ajax({
			type: 'POST',
			url: '../script/crud_nomina_pagos.php',
			dataType: "JSON",
			data: {
				"nomina_id": nomina_id,
				"condicion": "dobleturnos1",
			},

			success: function(respuesta) {
				console.log(respuesta);
				$('#modal_dobleturnos1_respuesta1').html(respuesta["html1"]);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	$("#modal_dobleturnos1_form").on("submit", function(e){
		e.preventDefault();
		var f = $(this);
		var texto 	= $('#modal_dobleturnos1_texto').val();
		var fecha  		= $('#modal_dobleturnos1_fecha').val();
		var multiplicador  		= $('#modal_dobleturnos1_multiplicador').val();
		var nomina_id   =$('#nomina_id').val();

		if(texto=='' || fecha==''){
			Swal.fire({
	 			title: 'Error!',
	 			text: "No dejar campos vacios",
	 			icon: 'error',
	 			position: 'center',
			});
		}

	    $.ajax({
			type: 'POST',
			url: '../script/crud_nomina_pagos.php',
			dataType: "JSON",
			data: {
				"texto": texto,
				"fecha": fecha,
				"multiplicador": multiplicador,
				"nomina_id": nomina_id,
				"condicion": "dobleturnos2",
			},

			success: function(respuesta) {
				console.log(respuesta);
				filtrar1();
				if(respuesta["estatus"]=="ok"){
					Swal.fire({
		 				title: 'Guardado',
		 				text: respuesta["msg"],
		 				icon: 'success',
		 				position: 'center',
					});
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	});

	function eliminar_dobleturnos1(id_nolaborados){
		$.ajax({
			type: 'POST',
			url: '../script/crud_nomina_pagos.php',
			dataType: "JSON",
			data: {
				"id": id_nolaborados,
				"condicion": "eliminar_dobleturnos1",
			},

			success: function(respuesta) {
				console.log(respuesta);
				filtrar1();
				if(respuesta["estatus"]=="ok"){
					$('#modal_dobleturnos1_generado_'+id_nolaborados).hide("slow");
					Swal.fire({
		 				title: 'Correcto!',
		 				text: respuesta["msg"],
		 				icon: 'success',
		 				position: 'center',
					});
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function descuentos1(nomina_id){
		$('#nomina_id').val(nomina_id);
		$.ajax({
			type: 'POST',
			url: '../script/crud_nomina_pagos.php',
			dataType: "JSON",
			data: {
				"nomina_id": nomina_id,
				"condicion": "descuentos1",
			},

			success: function(respuesta) {
				console.log(respuesta);
				$('#modal_descuentos1_respuesta1').html(respuesta["html1"]);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	$("#modal_descuentos1_form").on("submit", function(e){
		e.preventDefault();
		var f = $(this);
		var valor 	= $('#modal_descuentos1_valor').val();
		var texto 	= $('#modal_descuentos1_texto').val();
		var fecha  		= $('#modal_descuentos1_fecha').val();
		var nomina_id   =$('#nomina_id').val();

		if(texto=='' || fecha==''){
			Swal.fire({
	 			title: 'Error!',
	 			text: "No dejar campos vacios",
	 			icon: 'error',
	 			position: 'center',
			});
		}

	    $.ajax({
			type: 'POST',
			url: '../script/crud_nomina_pagos.php',
			dataType: "JSON",
			data: {
				"valor": valor,
				"texto": texto,
				"fecha": fecha,
				"nomina_id": nomina_id,
				"condicion": "descuentos2",
			},

			success: function(respuesta) {
				console.log(respuesta);
				filtrar1();
				if(respuesta["estatus"]=="ok"){
					Swal.fire({
		 				title: 'Guardado',
		 				text: respuesta["msg"],
		 				icon: 'success',
		 				position: 'center',
					});
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	});

	function eliminar_descuentos1(id_nolaborados){
		$.ajax({
			type: 'POST',
			url: '../script/crud_nomina_pagos.php',
			dataType: "JSON",
			data: {
				"id": id_nolaborados,
				"condicion": "eliminar_descuentos1",
			},

			success: function(respuesta) {
				console.log(respuesta);
				filtrar1();
				if(respuesta["estatus"]=="ok"){
					$('#modal_descuentos1_generado_'+id_nolaborados).hide("slow");
					Swal.fire({
		 				title: 'Correcto!',
		 				text: respuesta["msg"],
		 				icon: 'success',
		 				position: 'center',
					});
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}
 
</script>