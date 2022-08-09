<?php
session_start();
include('conexion.php');
$responsable = $_SESSION["id"];
$condicion = $_POST['condicion'];
$fecha_inicio = date("Y-m-d");

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

if($condicion=='subir_archivo1'){
	$id = $_POST['id'];
	$condicion2 = $_POST['condicion2'];
	$condicion3 = $_POST['condicion3'];
	$banco_cedula = $_POST['banco_cedula'];
	$banco_nombre = $_POST['banco_nombre'];
	$banco_tipo = $_POST['banco_tipo'];
	$banco_numero = $_POST['banco_numero'];
	$banco_banco = $_POST['banco_banco'];
	$bcpp = $_POST['bcpp'];
	$banco_tipo_documento = $_POST['banco_tipo_documento'];
	if(file_exists('../resources/documentos/modelos/archivos/'.$id)){}else{
    	mkdir('../resources/documentos/modelos/archivos/'.$id, 0777);
	}
	if(@$_FILES['file']!=null and $bcpp=="Prestada"){
		$imagen_temporal = $_FILES['file']['tmp_name'];
		$location = "../resources/documentos/modelos/archivos/".$id."/";
		$imagen_nombre = $_FILES['file']['name'];
		$imagen = getimagesize($_FILES['file']['tmp_name']);
		$ancho = $imagen[0];
		$alto = $imagen[1];
		$extension = explode(".", $imagen_nombre);
		$extension = $extension[count($extension)-1];
		
		if($extension!='jpg' and $extension!='jpeg' and $extension!='png' and $extension!='JPG' and $extension!='JPEG' and $extension!='PNG'){
		    $datos = [
				"estatus" => 'error',
			];
			echo json_encode($datos);
	        exit;
		}else{
			$extension='jpg';
		}
		$sql4 = "SELECT * FROM documentos WHERE nombre = '".$condicion2."'";
		$proceso4 = mysqli_query($conexion,$sql4);
		while($row4 = mysqli_fetch_array($proceso4)) {
			$documento_id = $row4['id'];
		}
		$sql3 = "DELETE FROM modelos_documentos WHERE id_documentos = ".$documento_id." and id_modelos = ".$id;
		$eliminar1 = mysqli_query($conexion,$sql3);
		$sql2 = "INSERT INTO modelos_documentos (id_documentos,id_modelos,tipo,estatus,fecha_inicio) VALUES ('$documento_id','$id','$extension','Pendiente','$fecha_inicio')";
		$registro1 = mysqli_query($conexion,$sql2);
	}
	$sql3 = "UPDATE modelos SET banco_cedula = '$banco_cedula', banco_nombre = '$banco_nombre', banco_tipo = '$banco_tipo', banco_numero = '$banco_numero', banco_banco = '$banco_banco', BCPP = '$bcpp', banco_tipo_documento = '$banco_tipo_documento' WHERE id = ".$id;
	$proceso3 = mysqli_query($conexion,$sql3);
	move_uploaded_file($imagen_temporal,$location.$condicion3.".".$extension);
	$datos = [
		"estatus" => 'ok',
		"sql2" => $sql2,
		"sql3" => $sql3,
	];

	echo json_encode($datos);
}

if($condicion=='soporte_subir1'){
	$id = $_POST['id'];
	$condicion2 = $_POST['condicion2'];

	if(file_exists('../resources/documentos/modelos/archivos/'.$id)){}else{
    	mkdir('../resources/documentos/modelos/archivos/'.$id, 0777);
	}

	function redimensionar_imagen($nombreimg, $rutaimg, $xmax, $ymax){
	    $ext = explode(".", $nombreimg);
	    $ext = $ext[count($ext)-1];

	    if($ext!="jpg" && $ext!="jpeg" && $ext!="png" && $ext!="gif" && $ext!="PNG"){
	        $datos = [
				"estatus" => 'error',
			];
			echo json_encode($datos);
	        exit;
	    }
	      
	    if($ext == "jpg" || $ext == "jpeg")  
	        $imagen = imagecreatefromjpeg($rutaimg);
	    elseif($ext == "png")  
	        $imagen = imagecreatefrompng($rutaimg);
	    elseif($ext == "gif")  
	        $imagen = imagecreatefromgif($rutaimg);

	    $x = imagesx($imagen);  
	    $y = imagesy($imagen);  
	          
	    if($x <= $xmax && $y <= $ymax){
	        return $imagen;  
	    }
	      
	    if($x >= $y) {  
	        $nuevax = $xmax;  
	        $nuevay = $nuevax * $y / $x;  
	    }  
	    else {  
	        $nuevay = $ymax;  
	        $nuevax = $x / $y * $nuevay;  
	    }  

	    $img2 = imagecreatetruecolor($nuevax, $nuevay);
	    imagecopyresized($img2, $imagen, 0, 0, 0, 0, floor($nuevax), floor($nuevay), $x, $y);
	    return $img2;
	}

	$imagen_temporal = $_FILES['file']['tmp_name'];
	$location = "../resources/documentos/modelos/archivos/".$id."/";
	$imagen_nombre = $_FILES['file']['name'];
	$imagen = getimagesize($_FILES['file']['tmp_name']);
	$ancho = $imagen[0];
	$alto = $imagen[1];
	$extension = explode(".", $imagen_nombre);
	$extension = $extension[count($extension)-1];

	$sql4 = "SELECT * FROM documentos WHERE nombre = '".$condicion2."'";
	$proceso4 = mysqli_query($conexion,$sql4);
	while($row4 = mysqli_fetch_array($proceso4)) {
		$documento_id = $row4['id'];
		$condicion3 = $row4['ruta'];
	}

	if($ancho>$alto){
		$imagen_optimizada = redimensionar_imagen($imagen_nombre,$imagen_temporal,1920,1080);
 	   	imagejpeg($imagen_optimizada, $location.$condicion3.'.jpg');
	}else if($ancho<$alto){
		$imagen_optimizada = redimensionar_imagen($imagen_nombre,$imagen_temporal,1080,1920);
		imagejpeg($imagen_optimizada, $location.$condicion3.'.jpg');
	}else{
		$imagen_optimizada = redimensionar_imagen($imagen_nombre,$imagen_temporal,1080,1080);
		imagejpeg($imagen_optimizada, $location.$condicion3.'.jpg');
	}

	if($extension=='jpg'){}else{
		$extension='jpg';
	}

	@unlink($location.$condicion3.".".$extension);
    @unlink($location.$condicion3.".".$extension);
    move_uploaded_file ($_FILES['file']['tmp_name'],$location.$condicion3.".".$extension);

	$sql3 = "DELETE FROM modelos_documentos WHERE id_documentos = ".$documento_id." and id_modelos = ".$id;
	$eliminar1 = mysqli_query($conexion,$sql3);

	$sql2 = "INSERT INTO modelos_documentos (id_documentos,id_modelos,tipo,estatus,fecha_inicio) VALUES ('$documento_id','$id','$extension','Pendiente','$fecha_inicio')";
	$registro1 = mysqli_query($conexion,$sql2);

	$datos = [
		"estatus" => 'ok',
		"sql3" => $sql2,
	];

	echo json_encode($datos);
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
		$filtrado = ' and (model.nombre1 LIKE "%'.$filtrado.'%" or model.nombre2 LIKE "%'.$filtrado.'%" or model.apellido1 LIKE "%'.$filtrado.'%" or model.apellido2 LIKE "%'.$filtrado.'%" or model.documento_numero LIKE "%'.$filtrado.'%")';
	}

	if($sede!=''){
		$sede = ' and model.estatus = "'.$sede.'"';
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

	$sql1 = "SELECT model.id as model_id, model.nombre1 as model_nombre1, model.nombre2 as model_nombre2, model.apellido1 as model_apellido1, model.apellido2 as model_apellido2, model.documento_tipo as model_documento_tipo, model.documento_numero as model_documento_numero, model.sede as model_sede, model.fecha_inicio as model_fecha_inicio, model.estatus as model_estatus, sed.id as sed_id, sed.nombre as sed_nombre FROM modelos model 
		INNER JOIN sedes sed 
		ON model.sede = sed.id 
		".$filtrado." 
		".$sede." 
	";

	$sql2 = "SELECT model.id as model_id, model.nombre1 as model_nombre1, model.nombre2 as model_nombre2, model.apellido1 as model_apellido1, model.apellido2 as model_apellido2, model.documento_tipo as model_documento_tipo, model.documento_numero as model_documento_numero, model.sede as model_sede, model.fecha_inicio as model_fecha_inicio, model.estatus as model_estatus, sed.id as sed_id, sed.nombre as sed_nombre FROM modelos model 
		INNER JOIN sedes sed 
		ON model.sede = sed.id 
		".$filtrado." 
		".$sede." 
		ORDER BY model.id DESC LIMIT ".$limit." OFFSET ".$offset."
	";
	
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
					<th class="text-center">Tipo Doc</th>
					<th class="text-center">Número Doc</th>
					<th class="text-center">Sede</th>
					<th class="text-center">Fecha Inicio</th>
					<th class="text-center">Opciones</th>
					<th class="text-center">Documentos</th>
					<th class="text-center">Cuentas</th>
	            </tr>
	            </thead>
	            <tbody>
	';
	if($conteo1>=1){
		while($row2 = mysqli_fetch_array($proceso2)) {
			$modelo_id = $row2["model_id"];
			$nombre = $row2["model_nombre1"]." ".$row2["model_nombre2"]." ".$row2["model_apellido1"]." ".$row2["model_apellido2"];

			$html .= '
		                <tr id="tr_'.$modelo_id.'">
		                    <td style="text-align:center;">'.$nombre.'</td>
		                    <td style="text-align:center;">'.$row2["model_documento_tipo"].'</td>
		                    <td style="text-align:center;">'.$row2["model_documento_numero"].'</td>
		                    <td style="text-align:center;">'.$row2["sed_nombre"].'</td>
		                    <td style="text-align:center;">'.$row2["model_fecha_inicio"].'</td>
		                    <td class="text-center">
						        <i class="fas fa-edit" style="color:#0095ff; cursor:pointer;" title="" value="'.$modelo_id.'" data-toggle="modal" data-target="#exampleModal_soporte1" onclick="modal_edit2('.$modelo_id.');"></i>
						    </td>
							<td class="text-center">
								<i class="fas fa-folder-open" style="cursor:pointer; font-size:20px;" title="" value="'.$modelo_id.'" data-toggle="modal" data-target="#Modal_documentos1" onclick="documentos1('.$modelo_id.');"></i>
								<i class="fas fa-camera-retro" style="cursor:pointer; font-size:20px;" title="" value="'.$modelo_id.'" data-toggle="modal" data-target="#Modal_fotos1" onclick="fotos1('.$modelo_id.');"></i>
								<i class="fas fa-images ml-3" style="cursor:pointer; font-size:20px;" title="" value="'.$modelo_id.'" data-toggle="modal" data-target="#Modal_fotos2" onclick="fotos2('.$modelo_id.');"></i>
							</td>
							<td class="text-center">
								<i class="fas fa-user-shield" style="cursor:pointer; font-size:20px;" data-toggle="modal" data-target="#Modal_cuentas1" onclick="cuentas('.$modelo_id.');"></i>
								<i class="fas fa-user-plus ml-3" style="cursor:pointer; font-size:20px;" data-toggle="modal" data-target="#Modal_cuentas2" onclick="cuentas2('.$modelo_id.');"></i>
							</td>
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

?>