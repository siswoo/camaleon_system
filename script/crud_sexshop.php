<?php
@session_start();
include('conexion.php');
$condicion = $_POST["condicion"];
$datetime = date('Y-m-d H:i:s');
$fecha_inicio = date('Y-m-d');
$fecha_modificacion = date('Y-m-d');
$responsable = $_SESSION['id'];

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
		$filtrado = ' and (model.documento_numero LIKE "%'.$filtrado.'%" or model.nombre1 LIKE "%'.$filtrado.'%" or model.nombre2 LIKE "%'.$filtrado.'%" or model.apellido1 LIKE "%'.$filtrado.'%" or model.apellido2 LIKE "%'.$filtrado.'%")';
	}

	if($sede!=''){
		$sede = ' and model.sede = "'.$sede.'"';
	}

	$limit = $consultasporpagina;
	$offset = ($pagina - 1) * $consultasporpagina;

	$sql1 = "SELECT model.id as mod_id, model.documento_numero as mod_documento_numero, model.documento_tipo as mod_documento_tipo, model.nombre1 as mod_nombre1, model.nombre2 as mod_nombre2, model.apellido1 as mod_apellido1, model.apellido2 as mod_apellido2, model.sede as mod_sede, model.apellido1 as mod_apellido1, model.estatus as mod_estatus, sed.nombre as sed_nombre FROM modelos model 
	INNER JOIN sedes sed 
	ON model.sede = sed.id 
	WHERE model.id != 0 ".$filtrado." ".$sede." ";

	$sql2 = "SELECT model.id as mod_id, model.documento_numero as mod_documento_numero, model.documento_tipo as mod_documento_tipo, model.nombre1 as mod_nombre1, model.nombre2 as mod_nombre2, model.apellido1 as mod_apellido1, model.apellido2 as mod_apellido2, model.sede as mod_sede, model.apellido1 as mod_apellido1, model.estatus as mod_estatus, sed.nombre as sed_nombre FROM modelos model 
	INNER JOIN sedes sed 
	ON model.sede = sed.id 
	WHERE model.id != 0 ".$filtrado." ".$sede." ORDER BY model.id DESC LIMIT ".$limit." OFFSET ".$offset."";

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
	                <th class="text-center">Documento Número</th>
	                <th class="text-center">Modelo</th>
	                <th class="text-center">Sede</th>
	                <th class="text-center">Estatus</th>
	            </tr>
	            </thead>
	            <tbody>
	';
	if($conteo1>=1){
		while($row2 = mysqli_fetch_array($proceso2)) {
			$mod_id = $row2["mod_id"];
			$mod_nombre1 = $row2["mod_nombre1"];
			$mod_nombre2 = $row2["mod_nombre2"];
			$mod_apellido1 = $row2["mod_apellido1"];
			$mod_apellido2 = $row2["mod_apellido2"];
			$mod_documento_numero = $row2["mod_documento_numero"];
			$mod_estatus = $row2["mod_estatus"];
			$sed_nombre = $row2["sed_nombre"];

			$html .= '
		                <tr id="tr_'.$mod_id.'">
		                    <td style="text-align:center;">'.$mod_documento_numero.'</td>
		                    <td style="text-align:center;">'.$mod_nombre1." ".$mod_nombre2." ".$mod_apellido1." ".$mod_apellido2.'</td>
		                    <td style="text-align:center;">'.$sed_nombre.'</td>
		                    <td style="text-align:center;">'.$mod_estatus.'</td>
		                </tr>
			';
		}
	}else{
		$html .= '<tr><td colspan="5" class="text-center" style="font-weight:bold;font-size:20px;">Sin Resultados</td></tr>';
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

if($condicion=='guardar1'){
	$fecha_desde = $_POST['fecha_desde'];
	$modelo = $_POST['modelo'];
	$valor = $_POST['valor'];

	$sql1 = "SELECT * FROM modelos WHERE documento_numero = '$modelo'";
	$proceso1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);
	if($contador1==0){
		$datos = [
			"estatus"	=> "error",
		];
		echo json_encode($datos);
		exit;
	}

	while($row1=mysqli_fetch_array($proceso1)){
		$modelo_id = $row1["id"];
	}

	//$sql2 = "INSERT INTO descuento (id_modelo,concepto,valor,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ($modelo_id,'Sexshop',$valor,'$fecha_desde','$fecha_desde',$responsable,'$fecha_inicio')";
	$sql2 = "INSERT INTO sexshop (id_modelo,concepto,monto,fecha_desde,fecha_hasta,responsable,estado,fecha_inicio) VALUES ($modelo_id,'Descuento Almacen',$valor,'$fecha_desde','$fecha_desde',$responsable,'Activo','$fecha_inicio')";
	$proceso2 = mysqli_query($conexion,$sql2);
	$datos = [
		"estatus"	=> "ok",
	];
	echo json_encode($datos);

}

?>