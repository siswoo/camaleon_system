<?php
@session_start();
require('../resources/fpdf/fpdf.php');
require '../resources/Spreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
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

	$sql1 = "SELECT * FROM contenido_modelos WHERE id != 0 ".$filtrado." ".$sede." ";

	$sql2 = "SELECT * FROM contenido_modelos WHERE id != 0 ".$filtrado." ".$sede." ORDER BY id DESC LIMIT ".$limit." OFFSET ".$offset."";

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
	                <th class="text-center">Estatus</th>
	                <th class="text-center">Condicion</th>
	                <th class="text-center">Mes</th>
	                <th class="text-center">Valor</th>
	                <th class="text-center">Acción</th>
	            </tr>
	            </thead>
	            <tbody>
	';
	if($conteo1>=1){
		while($row2 = mysqli_fetch_array($proceso2)) {
			$id = $row2["id"];
			$nombre1 = $row2["nombre1"];
			$nombre2 = $row2["nombre2"];
			$apellido1 = $row2["apellido1"];
			$apellido2 = $row2["apellido2"];
			$documento_numero = $row2["documento_numero"];
			$estatus = $row2["estatus"];

			$html .= '
		                <tr id="tr_'.$id.'">
		                    <td style="text-align:center;">'.$documento_numero.'</td>
		                    <td style="text-align:center;">'.$nombre1." ".$nombre2." ".$apellido1." ".$apellido2.'</td>
		                    <td style="text-align:center;">'.$estatus.'</td>
		                    <td style="text-align:center;" nowrap="nowrap">
		                    	<select class="form-control" name="pagina_'.$id.'" id="pagina_'.$id.'">
		                    		<option value="">Seleccione</option>
		    ';

		    $sql3 = "SELECT * FROM contenido_paginas";
		    $proceso3 = mysqli_query($conexion,$sql3);
		    while($row3=mysqli_fetch_array($proceso3)){
		    	$contenido_paginas_id = $row3["id"];
		    	$contenido_paginas_nombre = $row3["nombre"];
		    	$html .= '<option value="'.$contenido_paginas_id.'">'.$contenido_paginas_nombre.'</option>';
		    }

		    $html .= '
		    						<option value="descuento">Descuentos</option>
		    						<option value="avances">Avances</option>
		    						<option value="multas">Multas</option>
		    						<option value="sexshop">Sexshop</option>
		    						<option value="tecnologia">Tecnologia</option>
		                    	</select>
		                    </td>
		                    <td>
		                    	<select class="form-control" id="mes_'.$id.'" name="mes_'.$id.'">
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
		                    </td>
		                    <td>
		                    	<input type="text" name="valor_'.$id.'" id="valor_'.$id.'" class="form-control">
		                    </td>
		                    <td class="text-center">
		                    	<button type="button" class="btn btn-primary" onclick="agregar1('.$id.');">Agregar</button>
		                    </td>
		                </tr>
			';
		}
	}else{
		$html .= '<tr><td colspan="7" class="text-center" style="font-weight:bold;font-size:20px;">Sin Resultados</td></tr>';
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
	$nombre1 = $_POST['nombre1'];
	$nombre2 = $_POST['nombre2'];
	$apellido1 = $_POST['apellido1'];
	$apellido2 = $_POST['apellido2'];
	$documento_tipo = $_POST['documento_tipo'];
	$documento_numero = $_POST['documento_numero'];
	$genero = $_POST['genero'];
	$correo = $_POST['correo'];
	$usuario = $_POST['usuario'];
	$clave = md5($_POST['clave']);
	$telefono1 = $_POST['telefono1'];

	$sql1 = "SELECT * FROM contenido_modelos WHERE documento_numero = '$documento_numero' or correo = '$correo'";
	$proceso1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);
	if($contador1>=1){
		$datos = [
			"estatus"	=> "error",
			"msg"	=> "Ya existe el numero de documento y/o correo",
		];
		echo json_encode($datos);
		exit;
	}

	$sql4 = "SELECT * FROM usuarios WHERE correo = '$correo'";
	$proceso4 = mysqli_query($conexion,$sql4);
	$contador4 = mysqli_num_rows($proceso4);
	if($contador4>=1){
		$datos = [
			"estatus"	=> "error",
			"msg"	=> "Ya existe el correo!",
		];
		echo json_encode($datos);
		exit;
	}

	$sql2 = "INSERT INTO contenido_modelos (nombre1,nombre2,apellido1,apellido2,documento_tipo,documento_numero,genero,correo,usuario,clave,telefono1,estatus,fecha_inicio) VALUES ('$nombre1','$nombre2','$apellido1','$apellido2','$documento_tipo','$documento_numero','$genero','$correo','$usuario','$clave','$telefono1','Activa','$fecha_inicio')";
	$proceso2 = mysqli_query($conexion,$sql2);
	$modelo_id=mysql_insert_id();

	@!file_exists(mkdir("../resuorces/contenidos", 0777, true));
	@!file_exists(mkdir("../resuorces/contenidos/modelos/", 0777, true));
	@!file_exists(mkdir("../resuorces/contenidos/modelos/".$modelo_id, 0777, true));

	$sql3 = "INSERT INTO usuarios (nombre,apellido,documento_tipo,documento_numero,correo,usuario,clave,telefono1,rol,sede,fecha_inicio) VALUES ('$nombre1','$apellido1','$documento_tipo','$documento_numero','$correo','$usuario','$clave','$telefono1',5,12,'$fecha_inicio')";
	//$proceso3 = mysqli_query($conexion,$sql3);

	$datos = [
		"estatus"	=> "ok",
	];
	echo json_encode($datos);
}

if($condicion=='guardar2'){
	$mes = $_POST['mes'];
	$trm = $_POST['trm'];
	$anio = date('Y');

	$sql1 = "SELECT * FROM contenido_valores_extras WHERE mes = '$mes' and anio = '$anio'";
	$proceso1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);
	
	if($contador1==0){
		$datos = [
			"estatus"	=> "error",
			"msg"	=> "No hay ningun modelo con ganancias registradas en ese mes!",
		];
		echo json_encode($datos);
		exit;
	}
	
	$sql2 = "DELETE FROM contenido_presabana WHERE mes = '$mes' and anio = '$anio'";
	$proceso2 = mysqli_query($conexion,$sql2);

	$sql2 = "SELECT * FROM contenido_modelos";
	$proceso2 = mysqli_query($conexion,$sql2);
	while($row2=mysqli_fetch_array($proceso2)){
		$id_modelo = $row2["id"];
		$documento_numero = $row2["documento_numero"];
		$ganancias = 0;
		$deudas = 0;
		$sub_total = 0;
		$rf = 0;
		$dolares = 0;

		$sql3 = "SELECT * FROM contenido_valores_extras WHERE mes = '$mes' and anio = '$anio' and id_modelos = ".$id_modelo;
		$proceso3 = mysqli_query($conexion,$sql3);
		while($row3=mysqli_fetch_array($proceso3)){
			$id_paginas = $row3["id_paginas"];
			$valor = $row3["valor"];
			if($id_paginas!=0){
				$dolares = $dolares+$valor;
				$valor = $valor*$trm;
				$ganancias = $ganancias+$valor;
			}else{
				$deudas = $deudas+$valor;
			}
		}

		$sub_total = $ganancias-$deudas;

		if($dolares!=0){
			$dolares = $dolares/0.05;
		}

		if($dolares==0){
			$meta = 0;
		}else if($dolares>=1 and $dolares<=9999){
			$meta = 0.5;
		}else if($dolares>=10000 and $dolares<=14999){
			$meta = 0.55;
		}else if($dolares>=15000 and $dolares<=34999){
			$meta = 0.6;
		}else if($dolares>=35000){
			$meta = 0.65;
		}

		@$rf = ($sub_total/$meta)*0.03;
		@$rf_pesos = $rf*$trm;
		$total = $sub_total-$rf;

		$sql4 = "INSERT INTO contenido_presabana (id_modelo,mes,anio,subtotal,rf,meta_porcentajes,total,trm,responsable,fecha_inicio) VALUES ($id_modelo,'$mes','$anio',$sub_total,$rf,'$meta',$total,$trm,$responsable,'$fecha_inicio')";
		$proceso4 = mysqli_query($conexion,$sql4);
	}

	$datos = [
		"estatus"	=> "ok",
		"sql2"	=> $sql2,
	];
	echo json_encode($datos);
}

if($condicion=='table2'){
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

	$sql1 = "SELECT model.id as mod_id, model.documento_numero as mod_documento_numero, model.documento_tipo as mod_documento_tipo, model.nombre1 as mod_nombre1, model.nombre2 as mod_nombre2, model.apellido1 as mod_apellido1, model.apellido2 as mod_apellido2, model.apellido1 as mod_apellido1, model.estatus as mod_estatus, contenidopre.mes as contenidopre_mes, contenidopre.anio as contenidopre_anio, contenidopre.rf as contenidopre_rf, contenidopre.meta_porcentajes as contenidopre_meta_porcentajes, contenidopre.rf as contenidopre_rf, contenidopre.subtotal as contenidopre_subtotal, contenidopre.total as contenidopre_total, contenidopre.trm as contenidopre_trm, contenidopre.fecha_inicio as contenidopre_fecha_inicio FROM contenido_modelos model 
	INNER JOIN contenido_presabana contenidopre 
	ON model.id = contenidopre.id_modelo 
	WHERE model.id != 0 ".$filtrado." ".$sede." ";

	$sql2 = "SELECT model.id as mod_id, model.documento_numero as mod_documento_numero, model.documento_tipo as mod_documento_tipo, model.nombre1 as mod_nombre1, model.nombre2 as mod_nombre2, model.apellido1 as mod_apellido1, model.apellido2 as mod_apellido2, model.apellido1 as mod_apellido1, model.estatus as mod_estatus, contenidopre.mes as contenidopre_mes, contenidopre.anio as contenidopre_anio, contenidopre.rf as contenidopre_rf, contenidopre.meta_porcentajes as contenidopre_meta_porcentajes, contenidopre.rf as contenidopre_rf, contenidopre.subtotal as contenidopre_subtotal, contenidopre.total as contenidopre_total, contenidopre.total as contenidopre_total, contenidopre.trm as contenidopre_trm, contenidopre.fecha_inicio as contenidopre_fecha_inicio FROM contenido_modelos model 
	INNER JOIN contenido_presabana contenidopre 
	ON model.id = contenidopre.id_modelo 
	WHERE model.id != 0 ".$filtrado." ".$sede." ORDER BY model.id DESC LIMIT ".$limit." OFFSET ".$offset."";

	$proceso1 = mysqli_query($conexion,$sql1);
	$proceso2 = mysqli_query($conexion,$sql2);
	$conteo1 = mysqli_num_rows($proceso1);
	$paginas = ceil($conteo1 / $consultasporpagina);

	$html = '';

	$html .= '
		<div class="col-12">
			<input type="hidden" name="contador1" id="contador1" value="'.$conteo1.'">
	        <table class="table table-bordered">
	            <thead>
	            <tr>
	                <th class="text-center">Documento Número</th>
	                <th class="text-center">Modelo</th>
	                <th class="text-center">Mes</th>
	                <th class="text-center">Subtotal</th>
	                <th class="text-center">RF</th>
	                <th class="text-center">Meta</th>
	                <th class="text-center">Total</th>
	                <th class="text-center">TRM</th>
	                <th class="text-center">Registro</th>
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

			$contenidopre_mes = $row2["contenidopre_mes"];
			$contenidopre_anio = $row2["contenidopre_anio"];
			$contenidopre_subtotal = $row2["contenidopre_subtotal"];
			$contenidopre_rf = $row2["contenidopre_rf"];
			$contenidopre_meta = $row2["contenidopre_meta_porcentajes"];
			$contenidopre_total = $row2["contenidopre_total"];
			$contenidopre_trm = $row2["contenidopre_trm"];
			$contenidopre_fecha_inicio = $row2["contenidopre_fecha_inicio"];

			$html .= '
		                <tr id="tr_'.$mod_id.'">
		                    <td style="text-align:center;">'.$mod_documento_numero.'</td>
		                    <td style="text-align:center;">'.$mod_nombre1." ".$mod_nombre2." ".$mod_apellido1." ".$mod_apellido2.'</td>
		                    <td style="text-align:center;">'.$contenidopre_mes.' - '.$contenidopre_anio.'</td>
		                    <td style="text-align:center;">'.$contenidopre_subtotal.'</td>
		                    <td style="text-align:center;">'.$contenidopre_rf.'</td>
		                    <td style="text-align:center;">'.$contenidopre_meta.'</td>
		                    <td style="text-align:center;">'.$contenidopre_total.'</td>
		                    <td style="text-align:center;">'.$contenidopre_trm.'</td>
		                    <td style="text-align:center;">'.$contenidopre_fecha_inicio.'</td>
		                </tr>
			';
		}
	}else{
		$html .= '<tr><td colspan="9" class="text-center" style="font-weight:bold;font-size:20px;">Sin Resultados</td></tr>';
	}

	$html .= '
	            </tbody>
	        </table>
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
									<a class="page-link" onclick="paginacion2('.($pagina-1).');" href="#">
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
			                        <a class="page-link" onclick="paginacion2('.($pagina-1).');" href="#">
			                            '.($pagina-1).'
			                        </a>
			                    </li>
		';
	}else if($pagina==3){
		$html .= '
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion2('.($pagina-2).');" href="#"">
			                            '.($pagina-2).'
			                        </a>
			                    </li>
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion2('.($pagina-1).');" href="#"">
			                            '.($pagina-1).'
			                        </a>
			                    </li>
	';
	}else if($pagina>=4){
		$html .= '
		                		<li class="page-item">
			                        <a class="page-link" onclick="paginacion2('.($pagina-3).');" href="#"">
			                            '.($pagina-3).'
			                        </a>
			                    </li>
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion2('.($pagina-2).');" href="#"">
			                            '.($pagina-2).'
			                        </a>
			                    </li>
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion2('.($pagina-1).');" href="#"">
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
			                        <a class="page-link" onclick="paginacion2('.($x).');" href="#"">'.$x.'</a>
			                    </li>
		';
	}

	if ($pagina < $paginas) {
		$html .= '
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion2('.($pagina+1).');" href="#"">
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

if($condicion=='agregar1'){
	$id = $_POST['id'];
	$pagina = $_POST['pagina'];
	$mes = $_POST['mes'];
	$valor = $_POST['valor'];
	$anio = date('Y');

	if($pagina=='descuento' or $pagina=='avances' or $pagina=='multas' or $pagina=='sexshop'){
		$sql1 = "INSERT INTO contenido_valores_extras (id_modelos,condicion,valor,mes,anio,responsable,fecha_inicio) VALUES ($id,'$pagina',$valor,'$mes','$anio',$responsable,'$fecha_inicio')";
		$proceso1 = mysqli_query($conexion,$sql1);
	}else{
		$sql1 = "INSERT INTO contenido_valores_extras (id_modelos,id_paginas,valor,mes,anio,responsable,fecha_inicio) VALUES ($id,$pagina,$valor,'$mes','$anio',$responsable,'$fecha_inicio')";
		$proceso1 = mysqli_query($conexion,$sql1);
	}

	$datos = [
		"estatus"	=> "ok",
		"sql1"	=> $sql1,
	];
	echo json_encode($datos);
}

if($condicion=='table3'){
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

	$sql1 = "SELECT model.id as mod_id, model.documento_numero as mod_documento_numero, model.documento_tipo as mod_documento_tipo, model.nombre1 as mod_nombre1, model.nombre2 as mod_nombre2, model.apellido1 as mod_apellido1, model.apellido2 as mod_apellido2, model.apellido1 as mod_apellido1, model.estatus as mod_estatus, contenido.id_paginas as contenido_id_paginas, contenido.condicion as contenido_condicion, contenido.valor as contenido_valor, contenido.mes as contenido_mes, contenido.anio as contenido_anio, contenido.fecha_inicio as contenido_fecha_inicio FROM contenido_modelos model 
	INNER JOIN contenido_valores_extras contenido 
	ON contenido.id_modelos = model.id 
	WHERE model.id != 0 ".$filtrado." ".$sede." ";

	$sql2 = "SELECT model.id as mod_id, model.documento_numero as mod_documento_numero, model.documento_tipo as mod_documento_tipo, model.nombre1 as mod_nombre1, model.nombre2 as mod_nombre2, model.apellido1 as mod_apellido1, model.apellido2 as mod_apellido2, model.apellido1 as mod_apellido1, model.estatus as mod_estatus, contenido.id as contenido_id, contenido.id_paginas as contenido_id_paginas, contenido.condicion as contenido_condicion, contenido.valor as contenido_valor, contenido.mes as contenido_mes, contenido.anio as contenido_anio, contenido.fecha_inicio as contenido_fecha_inicio FROM contenido_modelos model 
	INNER JOIN contenido_valores_extras contenido 
	ON contenido.id_modelos = model.id 
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
	                <th class="text-center">Estatus</th>
	                <th class="text-center">Descuento Concepto</th>
	                <th class="text-center">Descuento Monto</th>
	                <th class="text-center">Descuento Mes</th>
	                <th class="text-center">Descuento Registrado</th>
	                <th class="text-center">Opciones</th>
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
			$contenido_id = $row2["contenido_id"];
			$contenido_condicion = $row2["contenido_condicion"];
			$contenido_id_paginas = $row2["contenido_id_paginas"];
			$contenido_valor = $row2["contenido_valor"];
			$contenido_mes = $row2["contenido_mes"];
			$contenido_anio = $row2["contenido_anio"];
			$contenido_fecha_inicio = $row2["contenido_fecha_inicio"];

			if($contenido_condicion==''){
				$sql3 =  "SELECT * FROM contenido_paginas WHERE id = ".$contenido_id_paginas;
				$proceso3 = mysqli_query($conexion,$sql3);
				while($row3 = mysqli_fetch_array($proceso3)) {
					$contenido_paginas_nombre = $row3["nombre"];
				}
				$contenido_concepto = $contenido_paginas_nombre;
			}else{
				$contenido_concepto = $contenido_condicion;
			}

			$html .= '
		                <tr id="tr_'.$contenido_id.'">
		                    <td style="text-align:center;">'.$mod_documento_numero.'</td>
		                    <td style="text-align:center;">'.$mod_nombre1." ".$mod_nombre2." ".$mod_apellido1." ".$mod_apellido2.'</td>
		                    <td style="text-align:center;">'.$mod_estatus.'</td>
		                    <td style="text-align:center;">'.$contenido_concepto.'</td>
		                    <td style="text-align:center;">'.$contenido_valor.'</td>
		                    <td style="text-align:center;">'.$contenido_mes.' - '.$contenido_anio.'</td>
		                    <td style="text-align:center;">'.$contenido_fecha_inicio.'</td>
		                    <td style="text-align:center;">
		                    	<button type="button" class="btn btn-danger" onclick="eliminar1('.$contenido_id.')">Eliminar</button>
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
									<a class="page-link" onclick="paginacion2('.($pagina-1).');" href="#">
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
			                        <a class="page-link" onclick="paginacion2('.($pagina-1).');" href="#">
			                            '.($pagina-1).'
			                        </a>
			                    </li>
		';
	}else if($pagina==3){
		$html .= '
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion2('.($pagina-2).');" href="#"">
			                            '.($pagina-2).'
			                        </a>
			                    </li>
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion2('.($pagina-1).');" href="#"">
			                            '.($pagina-1).'
			                        </a>
			                    </li>
	';
	}else if($pagina>=4){
		$html .= '
		                		<li class="page-item">
			                        <a class="page-link" onclick="paginacion2('.($pagina-3).');" href="#"">
			                            '.($pagina-3).'
			                        </a>
			                    </li>
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion2('.($pagina-2).');" href="#"">
			                            '.($pagina-2).'
			                        </a>
			                    </li>
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion2('.($pagina-1).');" href="#"">
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
			                        <a class="page-link" onclick="paginacion2('.($x).');" href="#"">'.$x.'</a>
			                    </li>
		';
	}

	if ($pagina < $paginas) {
		$html .= '
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion2('.($pagina+1).');" href="#"">
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

if($condicion=='eliminar1'){
	$id = $_POST['id'];

	$sql1 = "SELECT * FROM contenido_valores_extras WHERE id = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);
	if($contador1==0){
		$datos = [
			"estatus"	=> "error",
			"msg"	=> "No existe dicho registro!",
		];
		echo json_encode($datos);
	}else{
		$sql2 = "DELETE FROM contenido_valores_extras WHERE id = ".$id;
		$proceso2 = mysqli_query($conexion,$sql2);
		
		$datos = [
			"estatus"	=> "ok",
			"msg"	=> "Se ha eliminado exitosamente!",
		];
		echo json_encode($datos);
	}
}

if($condicion=='importar1'){
	$mes = $_POST['importar_mes'];
	$anio = date('Y');
	$errores1 = 'No se han conseguido los siguientes modelos -> ';
	$contador_error1 = 0;

	$archivo_nombre = $_FILES['file']['name'];
	$archivo_temporal = $_FILES['file']['tmp_name'];

	$extension = explode(".", $archivo_nombre);
	$extension = $extension[count($extension)-1];

	if($extension!='xls' and $extension!='xml' and $extension!='xlam' and $extension!='xlsx'){
	    $datos = [
			"estatus"	=> "error",
			"msg"	=> "solo se aceptan archivos de excel!",
		];
		echo json_encode($datos);
		exit;
	}

	$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($archivo_temporal);
	$worksheet = $spreadsheet->getActiveSheet();

	$limite = 1000;

	$sql1 = "DELETE FROM contenido_valores_extras WHERE mes = '$mes' and anio = '$anio'";
	$proceso1 = mysqli_query($conexion,$sql1);

	for($i=2;$i<=$limite;$i++){
	    if($worksheet->getCell('A'.$i)!=''){
	        $documento_numero = $worksheet->getCell('A'.$i);
			
			$sql2 = "SELECT * FROM contenido_modelos WHERE documento_numero= '$documento_numero'";
			$proceso2 = mysqli_query($conexion,$sql2);
			$contador2 = mysqli_num_rows($proceso2);

			if($contador2==0){
				$errores1 .= $documento_numero." | ";
				$contador_error1 = 1;
			}else{
				while($row2=mysqli_fetch_array($proceso2)){
					$id_modelo = $row2["id"];
				}
				$documento_numero = $worksheet->getCell('A'.$i);
				$pornhub = $worksheet->getCell('B'.$i);
				$onlyfans = $worksheet->getCell('C'.$i);
				$manyvids = $worksheet->getCell('D'.$i);
				$descuentos = $worksheet->getCell('H'.$i);
				$avances = $worksheet->getCell('I'.$i);
				$multas = $worksheet->getCell('J'.$i);
				$sexshop = $worksheet->getCell('K'.$i);

				if($pornhub!=''){
					$pagina = 1;
					$valor2 = $pornhub;
					$sql3 = "INSERT INTO contenido_valores_extras (id_modelos,id_paginas,valor,mes,anio,responsable,fecha_inicio) VALUES ($id_modelo,$pagina,$valor2,'$mes','$anio',$responsable,'$fecha_inicio')";
					$proceso3 = mysqli_query($conexion,$sql3);
				}

				if($onlyfans!=''){
					$pagina = 2;
					$valor2 = $onlyfans;
					$sql3 = "INSERT INTO contenido_valores_extras (id_modelos,id_paginas,valor,mes,anio,responsable,fecha_inicio) VALUES ($id_modelo,$pagina,$valor2,'$mes','$anio',$responsable,'$fecha_inicio')";
					$proceso3 = mysqli_query($conexion,$sql3);
				}

				if($manyvids!=''){
					$pagina = 3;
					$valor2 = $manyvids;
					$sql3 = "INSERT INTO contenido_valores_extras (id_modelos,id_paginas,valor,mes,anio,responsable,fecha_inicio) VALUES ($id_modelo,$pagina,$valor2,'$mes','$anio',$responsable,'$fecha_inicio')";
					$proceso3 = mysqli_query($conexion,$sql3);
				}

				if($descuentos!=''){
					$condicion = "descuento";
					$valor2 = $descuentos;
					$sql3 = "INSERT INTO contenido_valores_extras (id_modelos,condicion,valor,mes,anio,responsable,fecha_inicio) VALUES ($id_modelo,'$condicion',$valor2,'$mes','$anio',$responsable,'$fecha_inicio')";
					$proceso3 = mysqli_query($conexion,$sql3);
				}

				if($avances!=''){
					$condicion = "avances";
					$valor2 = $avances;
					$sql3 = "INSERT INTO contenido_valores_extras (id_modelos,condicion,valor,mes,anio,responsable,fecha_inicio) VALUES ($id_modelo,'$condicion',$valor2,'$mes','$anio',$responsable,'$fecha_inicio')";
					$proceso3 = mysqli_query($conexion,$sql3);
				}

				if($multas!=''){
					$condicion = "multas";
					$valor2 = $multas;
					$sql3 = "INSERT INTO contenido_valores_extras (id_modelos,condicion,valor,mes,anio,responsable,fecha_inicio) VALUES ($id_modelo,'$condicion',$valor2,'$mes','$anio',$responsable,'$fecha_inicio')";
					$proceso3 = mysqli_query($conexion,$sql3);
				}

				if($sexshop!=''){
					$condicion = "sexshop";
					$valor2 = $sexshop;
					$sql3 = "INSERT INTO contenido_valores_extras (id_modelos,condicion,valor,mes,anio,responsable,fecha_inicio) VALUES ($id_modelo,'$condicion',$valor2,'$mes','$anio',$responsable,'$fecha_inicio')";
					$proceso3 = mysqli_query($conexion,$sql3);
				}
			}
	    }
	}
}

if($condicion=='guardar_personal1'){
	$id = $_POST['id'];
	$direccion = $_POST['direccion'];
	$telefono = $_POST['telefono'];
	$telegram = $_POST['telegram'];
	$sql1 = "UPDATE contenido_modelos SET direccion = '$direccion', telefono1 = '$telefono', telegram = '$telegram' WHERE id = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);
	$datos = [
		"estatus"	=> "ok",
		"msg"	=> "Se ha modificado exitosamente!",
	];
	echo json_encode($datos);
}

if($condicion=='guardar_bancario'){
	$id = $_POST['hidden_id'];
	$banco_cpp = $_POST['banco_cpp'];
	$banco_tipo_documento = $_POST['banco_tipo_documento'];
	$banco_documento_numero = $_POST['banco_documento_numero'];
	$banco_nombre = $_POST['banco_nombre'];
	$banco_tipo_cuenta = $_POST['banco_tipo_cuenta'];
	$banco_cuenta = $_POST['banco_cuenta'];
	$banco_banco = $_POST['banco_banco'];

	$sql4 = "SELECT * FROM contenido_documentos WHERE id_documentos = 14 and id_modelos = ".$id;
	$proceso4 = mysqli_query($conexion,$sql4);
	$contador4 = mysqli_num_rows($proceso4);

	if($banco_cpp=='Prestada' and $contador4==0){
		$targetDir = "../resources/contenidos/modelos/";
	    $imagen_nombre = strtolower($_FILES['banco_foto_prestada']['name']);
	    if($imagen_nombre==''){
	    	$datos = [
				"estatus"	=> "error",
				"msg"	=> "Debe ingresar una imagen",
			];
			echo json_encode($datos);
	    	exit;
	    }
		$imagen_temporal = $_FILES['banco_foto_prestada']['tmp_name'];
		$imagen_type = $_FILES['banco_foto_prestada']['type'];
		$extension = explode("/", $imagen_type);
		@$extension = strtolower($extension[1]);
		$imagen_nombre2 = explode(".", $imagen_nombre);

		if($extension!='png' and $extension=='jpg' and $extension=='jpeg'){
			$datos = [
				"estatus"	=> "error",
				"msg"	=> "Extension incorrecta de imagen prestada",
			];
			echo json_encode($datos);
			exit;
		}

		@!file_exists(mkdir("../resources/contenidos/", 0777, true));
		@!file_exists(mkdir("../resources/contenidos/modelos/", 0777, true));
		@!file_exists(mkdir("../resources/contenidos/modelos/".$id, 0777, true));

		$fileName = basename($_FILES['banco_foto_prestada']['name']);
		$targetFilePath = $targetDir . $fileName;
		$new_name = $imagen_nombre;
		$nombre_simple = explode(".",$new_name);
		$nombre_simple = $nombre_simple;
		$sourcePath = $_FILES["banco_foto_prestada"]["tmp_name"];
		$nombre_random = rand(999,9999).".".$extension;
		$ruta = $targetDir.$id."/".$nombre_random;
		move_uploaded_file($sourcePath, $ruta);

		$sql2 = "DELETE FROM contenido_documentos WHERE id_documentos = 14 and id_modelos = ".$id;
		$proceso2 = mysqli_query($conexion,$sql2);

		$sql3 = "INSERT INTO contenido_documentos (id_documentos,id_modelos,imagen,fecha_inicio) VALUES (14,$id,'$nombre_random','$fecha_inicio')";
		$proceso3 = mysqli_query($conexion,$sql3);
	}

    $sql1 = "UPDATE contenido_modelos SET banco_cedula = '$banco_documento_numero', banco_nombre = '$banco_nombre', banco_tipo = '$banco_tipo_cuenta', banco_numero = '$banco_cuenta', banco_banco = '$banco_banco', BCPP = '$banco_cpp', banco_tipo_documento = '$banco_tipo_documento' WHERE id = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);

	$datos = [
		"estatus"	=> "ok",
		"msg"	=> "Se ha modificado exitosamente!",
	];
	echo json_encode($datos);
}

if($condicion=='guardar_corporales'){
	$id = $_POST['hidden_id'];
	$genero = $_POST['genero'];
	$altura = $_POST['altura'];
	$peso = $_POST['peso'];
	$tipo_cuerpo = $_POST['tipo_cuerpo'];
	$vello = $_POST['vello'];
	$cabello = $_POST['cabello'];
	$ojos = $_POST['ojos'];
	$tattoo = $_POST['tattoo'];
	$piercing = $_POST['piercing'];
	$html1 = '';

	if($genero=='Mujer'){
		$sosten = $_POST['sosten'];
		$busto = $_POST['busto'];
		$cintura = $_POST['cintura'];
		$caderas = $_POST['caderas'];
		$html1 .= "'sosten = $sosten',busto = '$busto',cintura = '$cintura',caderas = '$caderas',";
	}else{
		$pene = $_POST['pene'];
		$html1 .= "pene = '$pene',";
	}

    $sql1 = "UPDATE contenido_modelos SET ".$html1." altura = '$altura', peso = '$peso', tipo_cuerpo = '$tipo_cuerpo', vello = '$vello', cabello = '$cabello', ojos = '$ojos', tattoo = '$tattoo', piercing = '$piercing' WHERE id = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);

	$datos = [
		"estatus"	=> "ok",
		"msg"	=> "Se ha modificado exitosamente!",
	];
	echo json_encode($datos);
}

if($condicion=='subir_documentos1'){
	$id = $_POST['id'];
	$documento = $_POST['documento'];
	$targetDir = "../resources/contenidos/modelos/".$id."/";
	$random = rand(999,9999);

	$sql1 = "SELECT * FROM contenido_documentos WHERE id_documentos = $documento and id_modelos = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);

	if($contador1>=1){
		$datos = [
			"estatus"	=> "error",
			"msg"	=> "Ya tiene dicho documento subido!",
		];
		echo json_encode($datos);
	}else{
		$imagen_nombre = strtolower($_FILES['file']['name']);
		$imagen_temporal = $_FILES['file']['tmp_name'];
		$imagen_type = $_FILES['file']['type'];
		@$extension = explode(".", $imagen_nombre);
		@$extension = strtolower($extension[1]);

		if($documento!=1 and $documento!=13){
			if($extension!='pdf'){
				$datos = [
					"estatus"	=> "error",
					"msg"	=> "Solo se acepta en formato PDF",
				];
				echo json_encode($datos);
				exit;
			}
		}else{
			if($extension!='png' and $extension!='jpg' and $extension!='jpeg'){
				$datos = [
					"estatus"	=> "error",
					"msg"	=> "Solo se acepta formatos PNG o JPG",
				];
				echo json_encode($datos);
				exit;
			}
		}

		$imagen = $random.".".$extension;
		$sql2 = "INSERT INTO contenido_documentos (id_documentos,id_modelos,imagen,fecha_inicio) VALUES ($documento,$id,'$imagen','$fecha_inicio')";
		$proceso2 = mysqli_query($conexion,$sql2);

		move_uploaded_file($imagen_temporal, $targetDir.$random.".".$extension);

		$datos = [
			"estatus"	=> "ok",
			"msg"	=> "Se ha modificado exitosamente!",
		];
		echo json_encode($datos);
	}
}

if($condicion=='consultar_documentos1'){
	$id = $_POST['id'];
	$documento = $_POST['documento'];

	$sql1 = "SELECT * FROM contenido_documentos WHERE id_documentos = $documento and id_modelos = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);

	if($contador1==0){
		$datos = [
			"estatus"	=> "error",
			"msg"	=> "No Posees ese Documento!",
		];
		echo json_encode($datos);
	}else{
		while($row1=mysqli_fetch_array($proceso1)){
			$imagen = $row1["imagen"];
			$html1 = '<img class="img-fluid" src="../resources/contenidos/modelos/'.$id.'/'.$imagen.'" style="max-width:500px;">';
		}
		if($documento==1){
			$html1 .= '<br><a href="pdf1.php?id='.$id.'" target="_blank"><button type="button" class="btn btn-primary mt-3">VER CONTRATO</button></a>';	
		}
		$datos = [
			"estatus"	=> "ok",
			"html1"	=> $html1,
		];
		echo json_encode($datos);
	}
}

if($condicion=='subir_fotosensual1'){
	$id = $_POST['id'];
	$documento = $_POST['documento'];
	$targetDir = "../resources/contenidos/modelos/".$id."/";
	$random = rand(999,9999);

	$sql1 = "SELECT * FROM contenido_documentos WHERE id_documentos = $documento and id_modelos = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);

	if($contador1>=5){
		$datos = [
			"estatus"	=> "error",
			"msg"	=> "Ya tiene el máximo de 5 fotos cargadas!",
		];
		echo json_encode($datos);
	}else{
		$imagen_nombre = strtolower($_FILES['file']['name']);
		$imagen_temporal = $_FILES['file']['tmp_name'];
		$imagen_type = $_FILES['file']['type'];
		@$extension = explode(".", $imagen_nombre);
		@$extension = strtolower($extension[1]);

		if($extension!='png' and $extension!='jpg' and $extension!='jpeg'){
			$datos = [
				"estatus"	=> "error",
				"msg"	=> "Solo se acepta formatos PNG o JPG",
			];
			echo json_encode($datos);
			exit;
		}

		$imagen = $random.".".$extension;
		$sql2 = "INSERT INTO contenido_documentos (id_documentos,id_modelos,imagen,fecha_inicio) VALUES ($documento,$id,'$imagen','$fecha_inicio')";
		$proceso2 = mysqli_query($conexion,$sql2);

		move_uploaded_file($imagen_temporal, $targetDir.$random.".".$extension);

		$datos = [
			"estatus"	=> "ok",
			"msg"	=> "Se ha modificado exitosamente!",
		];
		echo json_encode($datos);
	}
}

if($condicion=='consultar_fotosensual1'){
	$id = $_POST['id'];
	$documento = $_POST['documento'];
	$html1 = '';

	$sql1 = "SELECT * FROM contenido_documentos WHERE id_documentos = $documento and id_modelos = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);

	if($contador1==0){
		$datos = [
			"estatus"	=> "error",
			"msg"	=> "No Posees ese Documento!",
		];
		echo json_encode($datos);
	}else{
		while($row1=mysqli_fetch_array($proceso1)){
			$imagen = $row1["imagen"];
			$html1 .= '
				<div class="col-4 mt-3 text-center">
					<img class="img-fluid" src="../resources/contenidos/modelos/'.$id.'/'.$imagen.'" style="max-width:200px; max-height: 300px;">
				</div>
				';
		}
		$datos = [
			"estatus"	=> "ok",
			"html1"	=> $html1,
		];
		echo json_encode($datos);
	}
}

if($condicion=='table4'){
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
		$filtrado = ' and (documento_numero LIKE "%'.$filtrado.'%" or nombre1 LIKE "%'.$filtrado.'%" or nombre2 LIKE "%'.$filtrado.'%" or apellido1 LIKE "%'.$filtrado.'%" or apellido2 LIKE "%'.$filtrado.'%")';
	}

	if($sede!=''){
		$sede = ' and sede = "'.$sede.'"';
	}

	$limit = $consultasporpagina;
	$offset = ($pagina - 1) * $consultasporpagina;

	$sql1 = "SELECT * FROM contenido_modelos WHERE id != 0 ".$filtrado." ".$sede." ";

	$sql2 = "SELECT * FROM contenido_modelos WHERE id != 0 ".$filtrado." ".$sede." ORDER BY id DESC LIMIT ".$limit." OFFSET ".$offset."";

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
	                <th class="text-center">Fecha Registro</th>
	                <th class="text-center">Cuentas</th>
	            </tr>
	            </thead>
	            <tbody>
	';
	if($conteo1>=1){
		while($row2 = mysqli_fetch_array($proceso2)) {
			$id = $row2["id"];
			$nombre1 = $row2["nombre1"];
			$nombre2 = $row2["nombre2"];
			$apellido1 = $row2["apellido1"];
			$apellido2 = $row2["apellido2"];
			$documento_numero = $row2["documento_numero"];
			$estatus = $row2["estatus"];
			$fecha_inicio = $row2["fecha_inicio"];

			if($estatus==1){
				$estatus_nombre = 'Activa';
			}else{
				$estatus_nombre = 'Inactiva';
			}

			$sql3 = "SELECT id FROM contenido_cuentas WHERE id_modelos = ".$id;
			$proceso3 = mysqli_query($conexion,$sql3);
			$contador3 = mysqli_num_rows($proceso3);

			$html .= '
		                <tr id="tr_'.$id.'">
		                    <td style="text-align:center;">'.$documento_numero.'</td>
		                    <td style="text-align:center;">'.$nombre1." ".$nombre2." ".$apellido1." ".$apellido2.'</td>
		                    <td style="text-align:center;">'.$fecha_inicio.'</td>
		                    <td class="text-center">
		                    	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_ver" onclick="consultar1('.$id.');">'.$contador3.'</button>
		                    </td>
		                </tr>
			';
		}
	}else{
		$html .= '<tr><td colspan="7" class="text-center" style="font-weight:bold;font-size:20px;">Sin Resultados</td></tr>';
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

if($condicion=='consultar_cuentas1'){
	$id = $_POST['id'];
	$html = '';

	$sql1 = "SELECT * FROM contenido_cuentas WHERE id_modelos = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);

	if($contador1==0){
		$datos = [
			"estatus"	=> "error",
			"html"	=> "<div class='col-12 text-center'>No tiene Cuentas Actualmente</div>",
		];
		echo json_encode($datos);
	}else{
		while($row1=mysqli_fetch_array($proceso1)){
			$id_paginas = $row1["id_paginas"];
			$usuario = $row1["usuario"];
			$clave = $row1["clave"];
			$estatus = $row1["estatus"];
			$responsable = $row1["responsable"];
			$fecha_modificacion = $row1["fecha_modificacion"];

			$html .= '
				<div class="col-6 mt-3">
					<label>Cuenta</label>
					<input type="text" id="cuenta" class="form-control" value="'.$usuario.'">
				</div>
				<div class="col-6 mt-3">
					<label>Pagina</label>
					<select class="form-control" name="pagina" id="pagina">
					<option value="">Seleccione</option>
			';
				$sql3 = "SELECT * FROM contenido_paginas";
				$proceso3 = mysqli_query($conexion,$sql3);
				while($row3=mysqli_fetch_array($proceso3)){
					$paginas_id = $row3["id"];
					$paginas_nombre = $row3["nombre"];
					if($id_paginas==$paginas_id){
						$html .= '<option selected="selected" value="'.$paginas_id.'">'.$paginas_nombre.'</option>';
					}else{
						$html .= '<option value="'.$paginas_id.'">'.$paginas_nombre.'</option>';
					}
				}
			$html .='
				</div>
				';
		}
		$datos = [
			"estatus"	=> "ok",
			"html"	=> $html,
		];
		echo json_encode($datos);
	}
}

if($condicion=='agregar_cuentas1'){
	$id = $_POST['id'];
	$cuenta = $_POST['nueva_cuenta'];
	$pagina = $_POST['nueva_pagina'];

	$sql1 = "SELECT * FROM contenido_cuentas WHERE usuario = '$cuenta'";
	$proceso1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);

	if($contador1>=1){
		while($row1=mysqli_fetch_array($proceso1)){
			$id_modelos = $row1["id_modelos"];
			$sql2 = "SELECT * FROM contenido_modelos WHERE id = ".$id_modelos;
			$proceso2 = mysqli_query($conexion,$sql2);
			while($row2=mysqli_fetch_array($proceso2)){
				$documento_numero = $row2["documento_numero"];
			}
		}
		$datos = [
			"estatus"	=> "error",
			"msg"	=> "ya existe un modelo con dicha cuenta! -> ".$documento_numero,
		];
		echo json_encode($datos);
	}else{
		$sql3 = "INSERT INTO contenido_cuentas (id_modelos,id_paginas,usuario,estatus,responsable,fecha_inicio) VALUES ($id,$pagina,'$cuenta',2,$responsable,'$fecha_inicio')";
		$proceso3 = mysqli_query($conexion,$sql3);
		$datos = [
			"estatus"	=> "ok",
			"msg"	=> "Se ha creado satisfactoriamente!",
		];
		echo json_encode($datos);
	}
}

if($condicion=='nueva_clave1'){
	$id = $_POST['id'];
	$clave = $_POST['clave'];
	$clave2 = $_POST['clave2'];

	if($clave!=$clave2){
		$datos = [
			"estatus"	=> "error",
			"msg"	=> "Las claves no Coinciden!",
		];
		echo json_encode($datos);
		exit;
	}

	$clave = md5($clave);

	$sql2 = "UPDATE contenido_modelos SET clave = '$clave' WHERE id = ".$id;
	$proceso2 = mysqli_query($conexion,$sql2);
	$datos = [
		"estatus"	=> "ok",
		"msg"	=> "Se ha modificado exitosamente!",
	];
	echo json_encode($datos);
	exit;
}

if($condicion=='consultar_cuentas2'){
	$id = $_POST['id'];
	$html = '';

	$sql1 = "SELECT * FROM contenido_cuentas WHERE id_modelos = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);

	if($contador1==0){
		$datos = [
			"estatus"	=> "error",
			"html"	=> "<div class='col-12 text-center'>No tiene Cuentas Actualmente</div>",
		];
		echo json_encode($datos);
	}else{
		while($row1=mysqli_fetch_array($proceso1)){
			$id_paginas = $row1["id_paginas"];
			$usuario = $row1["usuario"];

			$sql2 = "SELECT * FROM contenido_paginas WHERE id =".$id_paginas;
			$proceso2 = mysqli_query($conexion,$sql2);
			while($row2=mysqli_fetch_array($proceso2)){
				$paginas_nombre = $row2["nombre"];
			}

			$html .= '
				<div class="col-6 mt-3">
					<strong>Cuenta:</strong> '.$usuario.' | <strong>Pagina:</strong> '.$paginas_nombre.'
				</div>
			';
		}
		$datos = [
			"estatus"	=> "ok",
			"html"	=> $html,
		];
		echo json_encode($datos);
	}
}
?>