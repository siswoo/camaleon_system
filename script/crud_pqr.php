<?php
session_start();
include('conexion.php');
$condicion = $_POST['condicion'];
$fecha_inicio = date('Y-m-d');
$responsable = $_SESSION['id'];

if($condicion=='guardar'){
	$id_modelo 	= $_POST['id_modelo'];
	$mensaje 	= $_POST['mensaje'];
	$tema 		= $_POST['tema'];
	$area 		= 'Modelos';
	$estatus 	= 'Proceso';
	$sql1 = "INSERT INTO pqr (responsable,mensaje,tema,area,estatus,fecha_inicio) VALUES ('$id_modelo','$mensaje','$tema','$area','$estatus','$fecha_inicio')";
	$consulta1 = mysqli_query($conexion,$sql1);
	
	$datos = [
		"estatus" => 'ok',
	];
	echo json_encode($datos);
}

if($condicion=='asignar'){
	$id_pqr = $_POST['id_pqr'];
	$id_modelo 	= $_POST['id_modelo'];
	$rol_responsable 	= $_POST['value'];
	$sql1 = "UPDATE pqr SET rol_responsable = ".$rol_responsable." WHERE id = ".$id_pqr;
	$consulta1 = mysqli_query($conexion,$sql1);

	$datos = [
		"estatus" => 'ok',
	];
	echo json_encode($datos);
}

/*
if($condicion=='listo'){
	$id_pqr = $_POST['id_pqr'];
	$razon = $_POST['razon'];
	$sql1 = "UPDATE pqr SET estatus = 'listo', respuesta = '$razon' WHERE id = ".$id_pqr;
	$consulta1 = mysqli_query($conexion,$sql1);
	
	$datos = [
		"respuesta" => 'listo',
	];
	echo json_encode($datos);
	exit;
}

if($condicion=='proceso'){
	$id_pqr = $_POST['id_pqr'];
	$sql1 = "UPDATE pqr SET estatus = 'proceso' WHERE id = ".$id_pqr;
	$consulta1 = mysqli_query($conexion,$sql1);
	
	$datos = [
		"respuesta" => 'proceso',
	];
	echo json_encode($datos);
	exit;
}
*/

if($condicion=='eliminar'){
	$id_pqr = $_POST['id_pqr'];
	$sql1 = "DELETE FROM pqr WHERE id = ".$id_pqr;
	$consulta1 = mysqli_query($conexion,$sql1);
	
	$datos = [
		"respuesta" => 'eliminar',
	];
	echo json_encode($datos);
	exit;
}

if($condicion=='table1'){
	$pagina = $_POST["pagina"];
	$consultasporpagina = $_POST["consultasporpagina"];
	$filtrado = $_POST["filtrado"];
	$sede = $_POST["sede"];

	if($pagina==0 or $pagina==''){
		$pagina = 1;
	}

	if($consultasporpagina==0 or $consultasporpagina==''){
		$consultasporpagina = 10;
	}

	if($filtrado!=''){
		$filtrado = ' and (modelo.documento_numero LIKE "%'.$filtrado.'%" or modelo.nombre1 LIKE "%'.$filtrado.'%" or modelo.nombre2 LIKE "%'.$filtrado.'%" or modelo.apellido1 LIKE "%'.$filtrado.'%" or modelo.apellido2 LIKE "%'.$filtrado.'%")';
	}

	if($sede!=''){
		$sede = ' and pqr.estatus = "'.$sede.'"';
	}

	$limit = $consultasporpagina;
	$offset = ($pagina - 1) * $consultasporpagina;

	$sql1 = "SELECT pqr.id as pqr_id, pqr.responsable as pqr_responsable, pqr.mensaje as pqr_mensaje, pqr.tema as pqr_tema, pqr.area as pqr_area, pqr.fecha_inicio as pqr_fecha_inicio, pqr.estatus as pqr_estatus, pqr.respuesta as pqr_respuesta,  pqr.rol_responsable as pqr_rol_responsable, modelo.id as modelo_id, modelo.nombre1 as modelo_nombre1, modelo.nombre2 as modelo_nombre2, modelo.apellido1 as modelo_apellido1, modelo.apellido2 as modelo_apellido2, modelo.documento_numero as modelo_documento_numero, modelo.sede as modelo_sede FROM pqr pqr INNER JOIN 
	modelos modelo 
	ON pqr.responsable = modelo.id 
	WHERE pqr.id != 0 ".$filtrado." ".$sede." ";

	$sql2 = "SELECT pqr.id as pqr_id, pqr.responsable as pqr_responsable, pqr.mensaje as pqr_mensaje, pqr.tema as pqr_tema, pqr.area as pqr_area, pqr.fecha_inicio as pqr_fecha_inicio, pqr.estatus as pqr_estatus, pqr.respuesta as pqr_respuesta,  pqr.rol_responsable as pqr_rol_responsable, modelo.id as modelo_id, modelo.nombre1 as modelo_nombre1, modelo.nombre2 as modelo_nombre2, modelo.apellido1 as modelo_apellido1, modelo.apellido2 as modelo_apellido2, modelo.documento_numero as modelo_documento_numero, modelo.sede as modelo_sede FROM pqr pqr INNER JOIN 
	modelos modelo 
	ON pqr.responsable = modelo.id 
	WHERE pqr.id != 0 ".$filtrado." ".$sede." ORDER BY pqr.id DESC LIMIT ".$limit." OFFSET ".$offset."";

	$proceso1 = mysqli_query($conexion,$sql1);
	$proceso2 = mysqli_query($conexion,$sql2);
	$conteo1 = mysqli_num_rows($proceso1);
	$paginas = ceil($conteo1 / $consultasporpagina);

	$html = '';

	$html .= '
		<div class="col-12">
			<input type="hidden" name="contador1" id="contador1" value="'.$conteo1.'">
			<form action="#" method="POST" id="formulario1">
			<input type="hidden" name="condicion" id="condicion" value="guardar2">
	        <table class="table table-bordered">
	            <thead>
	            <tr>
	                <th class="text-center">Responsable</th>
	                <th class="text-center">Documento</th>
	                <th class="text-center">Mensaje</th>
	                <th class="text-center">Tema</th>
	                <th class="text-center">Area</th>
	                <th class="text-center">Fecha Enviada</th>
	                <th class="text-center">Estatus</th>
	                <th class="text-center">Respuesta</th>
	                <th class="text-center">Opciones</th>
	            </tr>
	            </thead>
	            <tbody>
	';
	if($conteo1>=1){
		while($row2 = mysqli_fetch_array($proceso2)) {
			$id = $row2["pqr_id"];
			$nombre = $row2["modelo_nombre1"]." ".$row2["modelo_nombre2"]." ".$row2["modelo_apellido1"]." ".$row2["modelo_apellido2"];
			$documento_numero = $row2["modelo_documento_numero"];
			$mensaje = $row2["pqr_mensaje"];
			$tema = $row2["pqr_tema"];
			$area = $row2["pqr_area"];
			$fecha_inicio = $row2["pqr_fecha_inicio"];
			$estatus = $row2["pqr_estatus"];
			$respuesta = $row2["pqr_respuesta"];

			$html .= '
		                <tr id="tr_'.$id.'">
		                    <td style="text-align:center;">'.$nombre.'</td>
		                    <td style="text-align:center;">'.$documento_numero.'</td>
		                    <td style="text-align:center;">'.$mensaje.'</td>
		                    <td style="text-align:center;">'.$tema.'</td>
		                    <td style="text-align:center;">'.$area.'</td>
		                    <td style="text-align:center;">'.$fecha_inicio.'</td>
		                    <td style="text-align:center;">'.$estatus.'</td>
		                    <td style="text-align:center;">'.$respuesta.'</td>
		                    <td class="text-center" nowrap="nowrap">
		                    	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_listo1" onclick="listo1('.$id.');">Listo</button>
		                    	<button type="button" class="btn btn-primary" onclick="proceso1('.$id.');">Proceso</button>
		                    </td>
		                </tr>
			';
		}
	}else{
		$html .= '<tr><td colspan="9" class="text-center" style="font-weight:bold;font-size:20px;">Sin Resultados</td></tr>';
	}

	$html .= '
	            </tbody>
	        </table>
	    <form>
	        <nav>
	            <div class="row">
	                <div class="col-xs-12 col-sm-4 text-center">
	                    <p>Mostrando '.$conteo1.' de '.$consultasporpagina.' datos por pagina</p>
	                </div>
	                <div class="col-xs-12 col-sm-4 text-center">
	                    <p>Página '.$pagina.' de '.$paginas.' </p>
	                </div> 
	                <div class="col-xs-12 col-sm-4">
			            <nav aria-label="Page navigation" style="float:right; padding-right:2rem;">
							<ul class="pagination" style="font-size: 30px;">
	';
	
	if ($pagina > 1) {
		$html .= '
								<li class="page-item">
									<a class="page-link" onclick="paginacion1('.($pagina-1).');" href="#">
										<span aria-hidden="true">Anterior</span>
									</a>
								</li>
		';
	}

	$diferenciapagina = 3;
	
	/*********MENOS********/
	if($pagina==2){
		$html .= '
		                		<li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina-1).');" href="#">
			                            '.($pagina-1).'
			                        </a>
			                    </li>
		';
	}else if($pagina==3){
		$html .= '
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina-2).');" href="#"">
			                            '.($pagina-2).'
			                        </a>
			                    </li>
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina-1).');" href="#"">
			                            '.($pagina-1).'
			                        </a>
			                    </li>
	';
	}else if($pagina>=4){
		$html .= '
		                		<li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina-3).');" href="#"">
			                            '.($pagina-3).'
			                        </a>
			                    </li>
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina-2).');" href="#"">
			                            '.($pagina-2).'
			                        </a>
			                    </li>
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina-1).');" href="#"">
			                            '.($pagina-1).'
			                        </a>
			                    </li>
		';
	} 

	/*********MAS********/
	$opcionmas = $pagina+3;
	if($paginas==0){
		$opcionmas = $paginas;
	}else if($paginas>=1 and $paginas<=4){
		$opcionmas = $paginas;
	}
	
	for ($x=$pagina;$x<=$opcionmas;$x++) {
		$html .= '
			                    <li class="page-item 
		';

		if ($x == $pagina){ 
			$html .= '"active"';
		}

		$html .= '">';

		$html .= '
			                        <a class="page-link" onclick="paginacion1('.($x).');" href="#"">'.$x.'</a>
			                    </li>
		';
	}

	if ($pagina < $paginas) {
		$html .= '
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina+1).');" href="#"">
			                            <span aria-hidden="true">Siguiente</span>
			                        </a>
			                    </li>
		';
	}

	$html .= '

						</ul>
					</nav>
				</div>
	        </nav>
	    </div>
	';

	$datos = [
		"estatus"	=> "ok",
		"html"	=> $html,
		"sql2"	=> $sql2,
	];
	echo json_encode($datos);
}

if($condicion=='listo1'){
	$id = $_POST["id"];
	$respuesta = $_POST["respuesta"];
	$sql1 = "UPDATE pqr SET estatus = 'listo', respuesta = '$respuesta' WHERE id = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);
	
	$datos = [
		"estatus" => 'ok',
		"msg" => 'Se ha guardado la respuesta',
		"sql1" => $sql1,
	];
	echo json_encode($datos);
	exit;	
}

if($condicion=='proceso1'){
	$id = $_POST["id"];

	$sql1 = "UPDATE pqr SET estatus = 'Proceso', respuesta = '' WHERE id = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);
	
	$datos = [
		"estatus" => 'ok',
		"msg" => 'Se ha modificado el estatus',
	];
	echo json_encode($datos);
	exit;	
}
?>