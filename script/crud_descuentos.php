<?php
session_start();
include('conexion.php');
$responsable = $_SESSION["id"];
$condicion = $_POST['condicion'];
$fecha_inicio = date("Y-m-d");

if($condicion=='table1'){
	$pagina = $_POST["pagina"];
	$consultasporpagina = $_POST["consultasporpagina"];
	$filtrado = $_POST["filtrado"];
	$sede = $_POST["sede"];

	if($sede==''){
		$sede = 'Sexshop';
	}

	if($pagina==0 or $pagina==''){
		$pagina = 1;
	}

	if($consultasporpagina==0 or $consultasporpagina==''){
		$consultasporpagina = 10;
	}

	if($filtrado!=''){
		$filtrado = ' and (model.nombre1 LIKE "%'.$filtrado.'%" or model.nombre2 LIKE "%'.$filtrado.'%" or model.apellido1 LIKE "%'.$filtrado.'%" or model.apellido2 LIKE "%'.$filtrado.'%" or model.documento_numero LIKE "%'.$filtrado.'%")';
	}

	$limit = $consultasporpagina;
	$offset = ($pagina - 1) * $consultasporpagina;

	$sql3 = "SELECT * FROM usuarios WHERE id = ".$responsable;
	$proceso3 = mysqli_query($conexion,$sql3);
	while($row3 = mysqli_fetch_array($proceso3)) {
		$rol = $row3["rol"];
	}

	if($rol!=1 and $rol!=21){
		$datos = [
			"estatus"	=> "error",
			"msg"	=> "No tienes Rol Permitido!",
		];
		echo json_encode($datos);
	}

	if($sede=='Sexshop'){
		$sql1 = "SELECT condicion.id as condicion_id, condicion.id_modelo as condicion_id_modelo, condicion.concepto as condicion_concepto, condicion.monto as condicion_monto, condicion.fecha_desde as fecha_desde, condicion.fecha_hasta as fecha_hasta, condicion.responsable as condicion_responsable, model.id as model_id, model.nombre1 as model_nombre1, model.nombre2 as model_nombre2, model.apellido1 as model_apellido1, model.apellido2 as model_apellido2, model.documento_tipo as model_documento_tipo, model.documento_numero as model_documento_numero, model.sede as model_sede FROM sexshop condicion 
			INNER JOIN modelos model 
			ON model.id = condicion.id_modelo 
			WHERE model.id != 0 
			".$filtrado."  
		";

		$sql2 = "SELECT condicion.id as condicion_id, condicion.id_modelo as condicion_id_modelo, condicion.concepto as condicion_concepto, condicion.monto as condicion_monto, condicion.fecha_desde as fecha_desde, condicion.fecha_hasta as fecha_hasta, condicion.responsable as condicion_responsable, model.id as model_id, model.nombre1 as model_nombre1, model.nombre2 as model_nombre2, model.apellido1 as model_apellido1, model.apellido2 as model_apellido2, model.documento_tipo as model_documento_tipo, model.documento_numero as model_documento_numero, model.sede as model_sede FROM sexshop condicion 
			INNER JOIN modelos model 
			ON model.id = condicion.id_modelo 
			WHERE model.id != 0 
			".$filtrado."  
			ORDER BY model.id DESC LIMIT ".$limit." OFFSET ".$offset."
		";
	}else if($sede=='Seguridad social'){
		$sql1 = "SELECT condicion.id as condicion_id, condicion.id_modelo as condicion_id_modelo, condicion.concepto as condicion_concepto, condicion.monto as condicion_monto, condicion.fecha_desde as fecha_desde, condicion.fecha_hasta as fecha_hasta, condicion.responsable as condicion_responsable, model.id as model_id, model.nombre1 as model_nombre1, model.nombre2 as model_nombre2, model.apellido1 as model_apellido1, model.apellido2 as model_apellido2, model.documento_tipo as model_documento_tipo, model.documento_numero as model_documento_numero, model.sede as model_sede FROM seguridad_social condicion 
			INNER JOIN modelos model 
			ON model.id = condicion.id_modelo 
			WHERE model.id != 0 
			".$filtrado."  
		";

		$sql2 = "SELECT condicion.id as condicion_id, condicion.id_modelo as condicion_id_modelo, condicion.concepto as condicion_concepto, condicion.monto as condicion_monto, condicion.fecha_desde as fecha_desde, condicion.fecha_hasta as fecha_hasta, condicion.responsable as condicion_responsable, model.id as model_id, model.nombre1 as model_nombre1, model.nombre2 as model_nombre2, model.apellido1 as model_apellido1, model.apellido2 as model_apellido2, model.documento_tipo as model_documento_tipo, model.documento_numero as model_documento_numero, model.sede as model_sede FROM seguridad_social condicion 
			INNER JOIN modelos model 
			ON model.id = condicion.id_modelo 
			WHERE model.id != 0 
			".$filtrado."  
			ORDER BY model.id DESC LIMIT ".$limit." OFFSET ".$offset."
		";
	}else if($sede=='Coolserpark'){
		$sql1 = "SELECT condicion.id as condicion_id, condicion.id_modelo as condicion_id_modelo, condicion.concepto as condicion_concepto, condicion.monto as condicion_monto, condicion.fecha_desde as fecha_desde, condicion.fecha_hasta as fecha_hasta, condicion.responsable as condicion_responsable, model.id as model_id, model.nombre1 as model_nombre1, model.nombre2 as model_nombre2, model.apellido1 as model_apellido1, model.apellido2 as model_apellido2, model.documento_tipo as model_documento_tipo, model.documento_numero as model_documento_numero, model.sede as model_sede FROM coopserpak condicion 
			INNER JOIN modelos model 
			ON model.id = condicion.id_modelo 
			WHERE model.id != 0 
			".$filtrado."  
		";

		$sql2 = "SELECT condicion.id as condicion_id, condicion.id_modelo as condicion_id_modelo, condicion.concepto as condicion_concepto, condicion.monto as condicion_monto, condicion.fecha_desde as fecha_desde, condicion.fecha_hasta as fecha_hasta, condicion.responsable as condicion_responsable, model.id as model_id, model.nombre1 as model_nombre1, model.nombre2 as model_nombre2, model.apellido1 as model_apellido1, model.apellido2 as model_apellido2, model.documento_tipo as model_documento_tipo, model.documento_numero as model_documento_numero, model.sede as model_sede FROM coopserpak condicion 
			INNER JOIN modelos model 
			ON model.id = condicion.id_modelo 
			WHERE model.id != 0 
			".$filtrado."  
			ORDER BY model.id DESC LIMIT ".$limit." OFFSET ".$offset."
		";
	}else if($sede=='Multas'){
		$sql1 = "SELECT condicion.id as condicion_id, condicion.id_modelo as condicion_id_modelo, condicion.concepto as condicion_concepto, condicion.valor as condicion_monto, condicion.fecha_desde as fecha_desde, condicion.fecha_hasta as fecha_hasta, condicion.responsable as condicion_responsable, model.id as model_id, model.nombre1 as model_nombre1, model.nombre2 as model_nombre2, model.apellido1 as model_apellido1, model.apellido2 as model_apellido2, model.documento_tipo as model_documento_tipo, model.documento_numero as model_documento_numero, model.sede as model_sede FROM multas condicion 
			INNER JOIN modelos model 
			ON model.id = condicion.id_modelo 
			WHERE model.id != 0 
			".$filtrado."  
		";

		$sql2 = "SELECT condicion.id as condicion_id, condicion.id_modelo as condicion_id_modelo, condicion.concepto as condicion_concepto, condicion.valor as condicion_monto, condicion.fecha_desde as fecha_desde, condicion.fecha_hasta as fecha_hasta, condicion.responsable as condicion_responsable, model.id as model_id, model.nombre1 as model_nombre1, model.nombre2 as model_nombre2, model.apellido1 as model_apellido1, model.apellido2 as model_apellido2, model.documento_tipo as model_documento_tipo, model.documento_numero as model_documento_numero, model.sede as model_sede FROM multas condicion 
			INNER JOIN modelos model 
			ON model.id = condicion.id_modelo 
			WHERE model.id != 0 
			".$filtrado."  
			ORDER BY model.id DESC LIMIT ".$limit." OFFSET ".$offset."
		";
	}else if($sede=='Descuentos'){
		$sql1 = "SELECT condicion.id as condicion_id, condicion.id_modelo as condicion_id_modelo, condicion.concepto as condicion_concepto, condicion.valor as condicion_monto, condicion.fecha_desde as fecha_desde, condicion.fecha_hasta as fecha_hasta, condicion.responsable as condicion_responsable, model.id as model_id, model.nombre1 as model_nombre1, model.nombre2 as model_nombre2, model.apellido1 as model_apellido1, model.apellido2 as model_apellido2, model.documento_tipo as model_documento_tipo, model.documento_numero as model_documento_numero, model.sede as model_sede FROM descuento condicion 
			INNER JOIN modelos model 
			ON model.id = condicion.id_modelo 
			WHERE model.id != 0 
			".$filtrado."  
		";

		$sql2 = "SELECT condicion.id as condicion_id, condicion.id_modelo as condicion_id_modelo, condicion.concepto as condicion_concepto, condicion.valor as condicion_monto, condicion.fecha_desde as fecha_desde, condicion.fecha_hasta as fecha_hasta, condicion.responsable as condicion_responsable, model.id as model_id, model.nombre1 as model_nombre1, model.nombre2 as model_nombre2, model.apellido1 as model_apellido1, model.apellido2 as model_apellido2, model.documento_tipo as model_documento_tipo, model.documento_numero as model_documento_numero, model.sede as model_sede FROM descuento condicion 
			INNER JOIN modelos model 
			ON model.id = condicion.id_modelo 
			WHERE model.id != 0 
			".$filtrado."  
			ORDER BY model.id DESC LIMIT ".$limit." OFFSET ".$offset."
		";
	}else if($sede=='Avances'){
		$sql1 = "SELECT condicion.id as condicion_id, condicion.id_modelo as condicion_id_modelo, condicion.concepto as condicion_concepto, condicion.valor as condicion_monto, condicion.fecha_desde as fecha_desde, condicion.fecha_hasta as fecha_hasta, condicion.responsable as condicion_responsable, model.id as model_id, model.nombre1 as model_nombre1, model.nombre2 as model_nombre2, model.apellido1 as model_apellido1, model.apellido2 as model_apellido2, model.documento_tipo as model_documento_tipo, model.documento_numero as model_documento_numero, model.sede as model_sede FROM avances condicion 
			INNER JOIN modelos model 
			ON model.id = condicion.id_modelo 
			WHERE model.id != 0 
			".$filtrado."  
		";

		$sql2 = "SELECT condicion.id as condicion_id, condicion.id_modelo as condicion_id_modelo, condicion.concepto as condicion_concepto, condicion.valor as condicion_monto, condicion.fecha_desde as fecha_desde, condicion.fecha_hasta as fecha_hasta, condicion.responsable as condicion_responsable, model.id as model_id, model.nombre1 as model_nombre1, model.nombre2 as model_nombre2, model.apellido1 as model_apellido1, model.apellido2 as model_apellido2, model.documento_tipo as model_documento_tipo, model.documento_numero as model_documento_numero, model.sede as model_sede FROM avances condicion 
			INNER JOIN modelos model 
			ON model.id = condicion.id_modelo 
			WHERE model.id != 0 
			".$filtrado."  
			ORDER BY model.id DESC LIMIT ".$limit." OFFSET ".$offset."
		";
	}else if($sede=='Sanción Página'){
		$sql1 = "SELECT condicion.id as condicion_id, condicion.id_modelo as condicion_id_modelo, condicion.concepto as condicion_concepto, condicion.monto as condicion_monto, condicion.fecha_desde as fecha_desde, condicion.fecha_hasta as fecha_hasta, condicion.responsable as condicion_responsable, model.id as model_id, model.nombre1 as model_nombre1, model.nombre2 as model_nombre2, model.apellido1 as model_apellido1, model.apellido2 as model_apellido2, model.documento_tipo as model_documento_tipo, model.documento_numero as model_documento_numero, model.sede as model_sede FROM sancionpagina condicion 
			INNER JOIN modelos model 
			ON model.id = condicion.id_modelo 
			WHERE model.id != 0 
			".$filtrado."  
		";

		$sql2 = "SELECT condicion.id as condicion_id, condicion.id_modelo as condicion_id_modelo, condicion.concepto as condicion_concepto, condicion.monto as condicion_monto, condicion.fecha_desde as fecha_desde, condicion.fecha_hasta as fecha_hasta, condicion.responsable as condicion_responsable, model.id as model_id, model.nombre1 as model_nombre1, model.nombre2 as model_nombre2, model.apellido1 as model_apellido1, model.apellido2 as model_apellido2, model.documento_tipo as model_documento_tipo, model.documento_numero as model_documento_numero, model.sede as model_sede FROM sancionpagina condicion 
			INNER JOIN modelos model 
			ON model.id = condicion.id_modelo 
			WHERE model.id != 0 
			".$filtrado."  
			ORDER BY model.id DESC LIMIT ".$limit." OFFSET ".$offset."
		";
	}else if($sede=='Avances'){
		$sql1 = "SELECT condicion.id as condicion_id, condicion.id_modelo as condicion_id_modelo, condicion.concepto as condicion_concepto, condicion.valor as condicion_monto, condicion.fecha_desde as fecha_desde, condicion.fecha_hasta as fecha_hasta, condicion.responsable as condicion_responsable, model.id as model_id, model.nombre1 as model_nombre1, model.nombre2 as model_nombre2, model.apellido1 as model_apellido1, model.apellido2 as model_apellido2, model.documento_tipo as model_documento_tipo, model.documento_numero as model_documento_numero, model.sede as model_sede FROM avances condicion 
			INNER JOIN modelos model 
			ON model.id = condicion.id_modelo 
			WHERE model.id != 0 
			".$filtrado."  
		";

		$sql2 = "SELECT condicion.id as condicion_id, condicion.id_modelo as condicion_id_modelo, condicion.concepto as condicion_concepto, condicion.valor as condicion_monto, condicion.fecha_desde as fecha_desde, condicion.fecha_hasta as fecha_hasta, condicion.responsable as condicion_responsable, model.id as model_id, model.nombre1 as model_nombre1, model.nombre2 as model_nombre2, model.apellido1 as model_apellido1, model.apellido2 as model_apellido2, model.documento_tipo as model_documento_tipo, model.documento_numero as model_documento_numero, model.sede as model_sede FROM avances condicion 
			INNER JOIN modelos model 
			ON model.id = condicion.id_modelo 
			WHERE model.id != 0 
			".$filtrado."  
			ORDER BY model.id DESC LIMIT ".$limit." OFFSET ".$offset."
		";
	}
	
	$proceso1 = mysqli_query($conexion,$sql1);
	$proceso2 = mysqli_query($conexion,$sql2);
	$conteo1 = mysqli_num_rows($proceso1);
	$paginas = ceil($conteo1 / $consultasporpagina);

	$html = '';

	$html .= '
		<div class="col-12">
	        <table class="table table-bordered">
	            <thead>
	            <tr>
	                <th class="text-center">Nombre</th>
					<th class="text-center">Número Doc</th>
					<th class="text-center">Concepto</th>
					<th class="text-center">Monto</th>
					<th class="text-center">Sede</th>
					<th class="text-center">Fecha Desde</th>
					<th class="text-center">Fecha Hasta</th>
	            </tr>
	            </thead>
	            <tbody>
	';
	if($conteo1>=1){
		while($row2 = mysqli_fetch_array($proceso2)) {
			$modelo_id = $row2["model_id"];
			$nombre = $row2["model_nombre1"]." ".$row2["model_nombre2"]." ".$row2["model_apellido1"]." ".$row2["model_apellido2"];
			$modelo_sede = $row2["model_sede"];

			$sql3 = "SELECT * FROM sedes WHERE id = ".$modelo_sede;
			$proceso3 = mysqli_query($conexion,$sql3);
			$contador3 = mysqli_num_rows($proceso3);
			if($contador3==0){
				$sede_nombre = "Desconocido";
			}else{
				while($row3=mysqli_fetch_array($proceso3)){
					$sede_nombre = $row3["nombre"];
				}
			}

			$html .= '
		                <tr id="tr_'.$modelo_id.'">
		                    <td style="text-align:center;">'.$nombre.'</td>
		                    <td style="text-align:center;">'.$row2["model_documento_numero"].'</td>
		                    <td style="text-align:center;">'.$row2["condicion_concepto"].'</td>
		                    <td style="text-align:center;">'.$row2["condicion_monto"].'</td>
		                    <td style="text-align:center;">'.$sede_nombre.'</td>
		                    <td style="text-align:center;">'.$row2["fecha_desde"].'</td>
		                    <td style="text-align:center;">'.$row2["fecha_hasta"].'</td>
		                </tr>
			';
		}
	}else{
		$html .= '<tr><td colspan="10" class="text-center" style="font-weight:bold;font-size:20px;">Sin Resultados</td></tr>';
	}

	$html .= '
	            </tbody>
	        </table>
	        <nav>
	            <div class="row">
	                <div class="col-xs-12 col-sm-4 text-center">
	                    <p>Mostrando '.$consultasporpagina.' de '.$conteo1.' Datos disponibles</p>
	                </div>
	                <div class="col-xs-12 col-sm-4 text-center">
	                    <p>Página '.$pagina.' de '.$paginas.' </p>
	                </div> 
	                <div class="col-xs-12 col-sm-4">
			            <nav aria-label="Page navigation" style="float:right; padding-right:2rem;">
							<ul class="pagination">
	';
	
	if ($pagina > 1) {
		$html .= '
								<li class="page-item">
									<a class="page-link" onclick="paginacion2('.($pagina-1).');" href="#resultado_table2">
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
			                        <a class="page-link" onclick="paginacion2('.($pagina-1).');" href="#resultado_table2">
			                            '.($pagina-1).'
			                        </a>
			                    </li>
		';
	}else if($pagina==3){
		$html .= '
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion2('.($pagina-2).');" href="#resultado_table2">
			                            '.($pagina-2).'
			                        </a>
			                    </li>
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion2('.($pagina-1).');" href="#resultado_table2">
			                            '.($pagina-1).'
			                        </a>
			                    </li>
	';
	}else if($pagina>=4){
		$html .= '
		                		<li class="page-item">
			                        <a class="page-link" onclick="paginacion2('.($pagina-3).');" href="#resultado_table2">
			                            '.($pagina-3).'
			                        </a>
			                    </li>
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion2('.($pagina-2).');" href="#resultado_table2">
			                            '.($pagina-2).'
			                        </a>
			                    </li>
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion2('.($pagina-1).');" href="#resultado_table2">
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
			                        <a class="page-link" onclick="paginacion2('.($x).');" href="#resultado_table2">'.$x.'</a>
			                    </li>
		';
	}

	if ($pagina < $paginas) {
		$html .= '
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion2('.($pagina+1).');" href="#resultado_table2">
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
	];
	echo json_encode($datos);
}

if($condicion=='cambiar_clave1'){
	$usuario = $_POST['usuario'];
	$password1 = md5($_POST['password1']);
	$password2 = md5($_POST['password2']);

	$sql1 = "UPDATE usuarios SET clave = '".$password1."' WHERE usuario = '".$usuario."'";
	$actualizar1 = mysqli_query($conexion,$sql1);

	$datos = [
		"sql" 		=> $sql1,
	];
	echo json_encode($datos);
}

?>