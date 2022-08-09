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
	$roles = $_POST["roles"];

	if($pagina==0 or $pagina==''){
		$pagina = 1;
	}

	if($consultasporpagina==0 or $consultasporpagina==''){
		$consultasporpagina = 10;
	}

	if($filtrado!=''){
		$filtrado = ' and (usua.documento_numero LIKE "%'.$filtrado.'%" or usua.nombre LIKE "%'.$filtrado.'%" or usua.apellido LIKE "%'.$filtrado.'%")';
	}

	if($sede!=''){
		$sede = ' and usua.sede = "'.$sede.'"';
	}

	if($roles!=''){
		$roles = ' and usua.rol = "'.$roles.'"';
	}

	$limit = $consultasporpagina;
	$offset = ($pagina - 1) * $consultasporpagina;

	$sql1 = "SELECT usua.id as usua_id, usua.documento_numero as usua_documento_numero, usua.nombre as usua_nombre, usua.apellido as usua_apellido, usua.sede as usua_sede, usua.rol as usua_rol, sede.id as sede_id, sede.nombre as sede_nombre, role.nombre as role_nombre FROM usuarios usua 
	INNER JOIN sedes sede
	ON usua.sede = sede.id 
	INNER JOIN roles role 
	ON usua.rol = role.id 
	WHERE usua.id != 0 ".$filtrado." ".$sede." ".$roles." ";

	$sql2 = "SELECT usua.id as usua_id, usua.documento_numero as usua_documento_numero, usua.nombre as usua_nombre, usua.apellido as usua_apellido, usua.sede as usua_sede, usua.rol as usua_rol, sede.id as sede_id, sede.nombre as sede_nombre, role.nombre as role_nombre FROM usuarios usua 
	INNER JOIN sedes sede
	ON usua.sede = sede.id 
	INNER JOIN roles role 
	ON usua.rol = role.id  
	WHERE usua.id != 0 ".$filtrado." ".$sede." ".$roles." ORDER BY usua.id DESC LIMIT ".$limit." OFFSET ".$offset."";

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
	                <th class="text-center">Nombre</th>
	                <th class="text-center">Sede</th>
	                <th class="text-center">Rol</th>
	                <th class="text-center">Opciones</th>
	            </tr>
	            </thead>
	            <tbody>
	';
	if($conteo1>=1){
		while($row2 = mysqli_fetch_array($proceso2)) {
			$usua_id = $row2["usua_id"];
			$usua_documento_numero = $row2["usua_documento_numero"];
			$usua_nombre = $row2["usua_nombre"];
			$usua_apellido = $row2["usua_apellido"];
			$sede_nombre = $row2["sede_nombre"];
			$role_nombre = $row2["role_nombre"];

			$html .= '
		                <tr id="tr_'.$usua_id.'">
		                    <td style="text-align:center;">'.$usua_documento_numero.'</td>
		                    <td style="text-align:center;">'.$usua_nombre.' '.$usua_apellido.'</td>
		                    <td style="text-align:center;">'.$sede_nombre.'</td>
		                    <td style="text-align:center;">'.$role_nombre.'</td>
		                    <td style="text-align:center;">
		                    	<button type="button" class="btn btn-info" onclick="consultar1('.$usua_id.')" data-toggle="modal" data-target="#modal_editar1">Editar</button>
		                    	<button type="button" class="btn btn-danger" onclick="eliminar1('.$usua_id.')">Eliminar</button>
		                    </td>
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

if($condicion=='consultar1'){
	$id = $_POST['id'];

	$sql1 = "SELECT * FROM usuarios WHERE id = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);

	if($contador1==0){
		$datos = [
			"estatus"	=> "error",
			"msg"	=> "No existe dicho registro!",
		];
		echo json_encode($datos);
		exit;
	}else{
		while($row1=mysqli_fetch_array($proceso1)){
			$nombre = $row1["nombre"];
			$apellido = $row1["apellido"];
			$documento_tipo = $row1["documento_tipo"];
			$documento_numero = $row1["documento_numero"];
			$correo = $row1["correo"];
			$usuario = $row1["usuario"];
			$telefono1 = $row1["telefono1"];
			$rol = $row1["rol"];
			$sede = $row1["sede"];
		}
		$datos = [
			"estatus"	=> "ok",
			"nombre" => $nombre,
			"apellido" => $apellido,
			"documento_tipo" => $documento_tipo,
			"documento_numero" => $documento_numero,
			"correo" => $correo,
			"usuario" => $usuario,
			"telefono1" => $telefono1,
			"rol" => $rol,
			"sede" => $sede,
		];
		echo json_encode($datos);
	}
}

if($condicion=='editar1'){
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$documento_tipo = $_POST['documento_tipo'];
	$documento_numero = $_POST['documento_numero'];
	$correo = $_POST['correo'];
	$usuario = $_POST['usuario'];
	$clave = md5($_POST['clave']);
	$telefono1 = $_POST['telefono1'];
	$rol = $_POST['rol'];
	$sede = $_POST['sede'];

	$sql1 = "SELECT * FROM usuarios WHERE id = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);

	if($contador1==0){
		$datos = [
			"estatus"	=> "error",
			"msg"	=> "No existe dicho registro!",
		];
		echo json_encode($datos);
		exit;
	}

	$sql2 = "SELECT * FROM usuarios WHERE (usuario = '".$usuario."' or correo = '".$correo."') and id != ".$id;
	$proceso2 = mysqli_query($conexion,$sql2);
	$contador2 = mysqli_num_rows($proceso2);

	if($contador2>=1){
		$datos = [
			"estatus"	=> "error",
			"msg"	=> "correo o usuario ya existente!",
		];
		echo json_encode($datos);
	}else{
		while($row1=mysqli_fetch_array($proceso1)){
			$sql3 = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', documento_tipo = '$documento_tipo', documento_numero = '$documento_numero', correo = '$correo', usuario = '$usuario', clave = '$clave', telefono1 = '$telefono1', rol = $rol, sede = $sede WHERE id = ".$id;
			$proceso3 = mysqli_query($conexion,$sql3);
		}
		$datos = [
			"estatus"	=> "ok",
			"msg" => "Se ha modificado exitosamente!",
			"sql2" => $sql2,
		];
		echo json_encode($datos);
	}
}

if($condicion=='guardar1'){
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$documento_tipo = $_POST['documento_tipo'];
	$documento_numero = $_POST['documento_numero'];
	$correo = $_POST['correo'];
	$usuario = $_POST['usuario'];
	$clave = md5($_POST['clave']);
	$telefono1 = $_POST['telefono1'];
	$rol = $_POST['rol'];
	$sede = $_POST['sede'];

	$sql1 = "SELECT * FROM usuarios WHERE usuario = '".$usuario."' or correo = '".$correo."'";
	$proceso1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);

	if($contador1>=1){
		$datos = [
			"estatus"	=> "error",
			"msg"	=> "correo o usuario ya existente!",
		];
		echo json_encode($datos);
	}else{
		$sql2 = "INSERT INTO usuarios (nombre,apellido,documento_tipo,documento_numero,correo,usuario,clave,telefono1,rol,sede,fecha_inicio) VALUES ('$nombre','$apellido','$documento_tipo','$documento_numero','$correo','$usuario','$clave','$telefono1',$rol,$sede,'$fecha_inicio')";
		$proceso2 = mysqli_query($conexion,$sql2);
		
		$datos = [
			"estatus"	=> "ok",
			"msg" => "Se ha creado exitosamente!",
			"sql2" => $sql2,
		];
		echo json_encode($datos);
	}
}

if($condicion=='eliminar1'){
	$id = $_POST['id'];

	$sql1 = "SELECT * FROM usuarios WHERE id = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);

	while($row1=mysqli_fetch_array($proceso1)){
		$rol = $row1["rol"];
		$documento_numero = $row1["documento_numero"];
	}

	$sql2 = "DELETE FROM usuarios WHERE id = ".$id;
	$proceso2 = mysqli_query($conexion,$sql2);

	if($rol==5){
		$sql3 = "DELETE FROM modelos WHERE documento_numero = '".$documento_numero."'";
		$proceso3 = mysqli_query($conexion,$sql3);
	}

	$datos = [
		"estatus"	=> "ok",
		"msg" => "Se ha eliminado exitosamente!",
	];
	echo json_encode($datos);
}

?>