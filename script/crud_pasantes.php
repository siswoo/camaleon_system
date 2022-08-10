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

	if($pagina==0 or $pagina==''){
		$pagina = 1;
	}

	if($consultasporpagina==0 or $consultasporpagina==''){
		$consultasporpagina = 10;
	}

	if($filtrado!=''){
		$filtrado = ' and (pasante.primer_nombre LIKE "%'.$filtrado.'%" or pasante.segundo_nombre LIKE "%'.$filtrado.'%" or pasante.primer_apellido LIKE "%'.$filtrado.'%" or pasante.segundo_apellido LIKE "%'.$filtrado.'%" or pasante.correo LIKE "%'.$filtrado.'%" or pasante.numero_documento LIKE "%'.$filtrado.'%")';
	}

	if($sede!=''){
		$sede = ' and pasante.sede = "'.$sede.'"';
	}

	$limit = $consultasporpagina;
	$offset = ($pagina - 1) * $consultasporpagina;

	$sql3 = "SELECT * FROM usuarios WHERE id = ".$responsable;
	$proceso3 = mysqli_query($conexion,$sql3);
	while($row3 = mysqli_fetch_array($proceso3)) {
		$rol = $row3["rol"];
	}

	if($rol!=1 and $rol!=8 and $rol!=14 and $rol!=15 and $rol!=23){
		$datos = [
			"estatus"	=> "error",
			"msg"	=> "No tienes Rol Permitido!",
		];
		echo json_encode($datos);
		exit;
	}

	$sql1 = "SELECT pasante.id as pasante_id, pasante.tipo_documento as pasante_tipo_documento, pasante.numero_documento as pasante_numero_documento, pasante.primer_nombre as pasante_primer_nombre, pasante.segundo_nombre as pasante_segundo_nombre, pasante.primer_apellido as pasante_primer_apellido, pasante.segundo_apellido as pasante_segundo_apellido, pasante.correo as pasante_correo, pasante.telefono1 as pasante_telefono1, pasante.estatus as pasante_estatus, pasante.sede as pasante_sede, pasante.fecha_inicio as pasante_fecha_inicio, pasante.telefono1 as pasante_telefono1, sede.id as sede_id, sede.nombre as sede_nombre FROM pasantes pasante 
		INNER JOIN sedes sede
		ON pasante.sede = sede.id 
		WHERE pasante.sede = ".$_SESSION['sede']." 
		".$filtrado." 
		".$sede." 
	";

	$sql2 = "SELECT pasante.id as pasante_id, pasante.tipo_documento as pasante_tipo_documento, pasante.numero_documento as pasante_numero_documento, pasante.primer_nombre as pasante_primer_nombre, pasante.segundo_nombre as pasante_segundo_nombre, pasante.primer_apellido as pasante_primer_apellido, pasante.segundo_apellido as pasante_segundo_apellido, pasante.correo as pasante_correo, pasante.telefono1 as pasante_telefono1, pasante.estatus as pasante_estatus, pasante.sede as pasante_sede, pasante.fecha_inicio as pasante_fecha_inicio, pasante.telefono1 as pasante_telefono1, sede.id as sede_id, sede.nombre as sede_nombre FROM pasantes pasante 
		INNER JOIN sedes sede
		ON pasante.sede = sede.id 
		WHERE pasante.sede = ".$_SESSION['sede']." 
		".$filtrado." 
		".$sede." 
		ORDER BY pasante.id DESC LIMIT ".$limit." OFFSET ".$offset."
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
					<th class="text-center">Tipo Doc</th>
					<th class="text-center">Número Doc</th>
	                <th class="text-center">Nombre</th>
					<th class="text-center">Correo</th>
					<th class="text-center">Teléfono</th>
					<th class="text-center">Estatus</th>
					<th class="text-center">Sede</th>
					<th class="text-center">Fecha Inicio</th>
					<th class="text-center">Opciones</th>
					<th class="text-center">Admisión</th>
	            </tr>
	            </thead>
	            <tbody>
	';
	if($conteo1>=1){
		while($row2 = mysqli_fetch_array($proceso2)) {
			$pasante_id = $row2["pasante_id"];
			$nombre = $row2["pasante_primer_nombre"]." ".$row2["pasante_segundo_nombre"]." ".$row2["pasante_primer_apellido"]." ".$row2["pasante_segundo_apellido"];

			$html .= '
		                <tr id="tr_'.$pasante_id.'">
		                    <td style="text-align:center;">'.$nombre.'</td>
		                    <td style="text-align:center;">'.$row2["pasante_tipo_documento"].'</td>
		                    <td style="text-align:center;">'.$row2["pasante_numero_documento"].'</td>
		                    <td style="text-align:center;">'.$row2["pasante_correo"].'</td>
		                    <td style="text-align:center;">'.$row2["pasante_telefono1"].'</td>
		                    <td style="text-align:center;">'.$row2["pasante_estatus"].'</td>
		                    <td style="text-align:center;">'.$row2["sede_nombre"].'</td>
		                    <td style="text-align:center;">'.$row2["pasante_fecha_inicio"].'</td>
		                    <td class="text-center">
						        <i class="fas fa-edit" style="color:#0095ff; cursor:pointer;" title="" value="'.$pasante_id.'" data-toggle="modal" data-target="#modal_editar1" onclick="consulta1('.$pasante_id.');"></i>
						    </td>
							<td class="text-center">
			';
							if($row2["pasante_estatus"]=='Rechazada'){
								//$html .= '<button type="button" class="btn btn-success" onclick="aceptar1('.$pasante_id.');">Aceptar</button>';
							}else if($row2["pasante_estatus"]=='Aceptada'){
								//$html .= '<button type="button" class="btn btn-danger" onclick="rechazar1('.$pasante_id.');">Rechazar</button>';
							}else if($row2["pasante_estatus"]=='Proceso'){
								$html .= '
									<button type="button" class="btn btn-success" onclick="aceptar1('.$pasante_id.');">Aceptar</button>
									<button type="button" class="btn btn-danger" onclick="rechazar1('.$pasante_id.');">Rechazar</button>
								';
							}
			$html .= '
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
	];
	echo json_encode($datos);
}

if($condicion=='consulta1'){
	$id = $_POST['id'];

	$sql1 = "SELECT * FROM pasantes WHERE id = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);
	if($contador1>=1){
		while($row1=mysqli_fetch_array($proceso1)){
			$nombre1 = $row1["primer_nombre"];
			$nombre2 = $row1["segundo_nombre"];
			$apellido1 = $row1["primer_apellido"];
			$apellido2 = $row1["segundo_apellido"];
			$tipo_documento = $row1["tipo_documento"];
			$numero_documento = $row1["numero_documento"];
			$correo = $row1["correo"];
			$telefono1 = $row1["telefono1"];
		}
		$datos = [
			"estatus" => "ok",
			"nombre1" => $nombre1,
			"nombre2" => $nombre2,
			"apellido1" => $apellido1,
			"apellido2" => $apellido2,
			"tipo_documento" => $tipo_documento,
			"numero_documento" => $numero_documento,
			"correo" => $correo,
			"telefono1" => $telefono1,
		];
		echo json_encode($datos);
	}else{
		$datos = [
			"estatus" => "error",
			"msg" => "El registro que esta consultando no existe, refresque la pagina.",
		];
		echo json_encode($datos);
	}
}

if($condicion=='editar1'){
	$id = $_POST['id'];
	$nombre1 = $_POST['nombre1'];
	$nombre2 = $_POST['nombre2'];
	$apellido1 = $_POST['apellido1'];
	$apellido2 = $_POST['apellido2'];
	$correo = $_POST['correo'];
	$telefono1 = $_POST['telefono1'];
	$tipo_documento = $_POST['tipo_documento'];
	$numero_documento = $_POST['numero_documento'];

	$sql1 = "SELECT * FROM pasantes WHERE id = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);
	if($contador1==0){
		$datos = [
			"estatus" => "error",
			"msg" => "El registro que esta intentado modificar no existe, refresque la pagina.",
		];
		echo json_encode($datos);
		exit;
	}

	$sql2 = "SELECT * FROM usuarios WHERE rol = 5 and (correo = '$correo' or numero_documento = '$numero_documento')";
	$proceso2 = mysqli_query($conexion,$sql2);
	$contador2 = mysqli_num_rows($proceso2);
	if($contador2>=1){
		$datos = [
			"estatus" => "error",
			"msg" => "Ya hay un modelo creado con dicho correo o numero de documento.",
		];
		echo json_encode($datos);
		exit;
	}

	$sql3 = "SELECT * FROM pasantes WHERE id != $id and (correo = '$correo' or numero_documento = '$numero_documento')";
	$proceso3 = mysqli_query($conexion,$sql3);
	$contador3 = mysqli_num_rows($proceso3);
	if($contador3>=1){
		$datos = [
			"estatus" => "error",
			"msg" => "Ya hay un pasante diferente creado con dicho correo o numero de documento.",
		];
		echo json_encode($datos);
		exit;
	}

	$sql4 = "UPDATE pasantes SET primer_nombre = '$nombre1', segundo_nombre = '$nombre2', primer_apellido = '$apellido1', segundo_apellido = '$apellido2', tipo_documento = '$tipo_documento', numero_documento = '$numero_documento', correo = '$correo', telefono1 = '$telefono1' WHERE id = ".$id;
	$proceso4 = mysqli_query($conexion,$sql4);

	$datos = [
			"estatus" => "ok",
			"msg" => "El registro se ha modificado",
		];
		echo json_encode($datos);
}

if($condicion=='aceptar1'){
	$id = $_POST['id'];

	$sql3 = "SELECT * FROM pasantes WHERE id = ".$id;
	$proceso3 = mysqli_query($conexion,$sql3);
	while($row3=mysqli_fetch_array($proceso3)){
		$nombre1 = strtolower($row3["primer_nombre"]);
		$nombre2 = strtolower($row3["segundo_nombre"]);
		$apellido1 = strtolower($row3["primer_apellido"]);
		$apellido2 = strtolower($row3["segundo_apellido"]);
		$tipo_documento = $row3["tipo_documento"];
		$numero_documento = $row3["numero_documento"];
		$correo = strtolower($row3["correo"]);
		$genero = $row3["genero"];
		$direccion = strtolower($row3["direccion"]);
		$telefono1 = $row3["telefono1"];
		$barrio = strtolower($row3["barrio"]);
		$sede = $row3["sede"];
		$fecha_inicio = $row3["fecha_inicio"];
		$usuario = $nombre1.rand(999,9999);
		$clave = md5($row3["numero_documento"]);
	}

	$sql1 = "SELECT * FROM modelos WHERE correo = '$correo' or documento_numero = '$numero_documento'";
	$proceso1 = mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);
	if($contador1>=1){
		$datos = [
			"estatus" => "error",
			"msg" => "Ya existe un modelo con dicho correo o numero de documento.",
		];
		echo json_encode($datos);
		exit;
	}

	$sql6 = "SELECT * FROM usuarios WHERE rol = 5 and (correo = '$correo' or documento_numero = '$numero_documento')";
	$proceso6 = mysqli_query($conexion,$sql6);
	$contador6 = mysqli_num_rows($proceso6);
	if($contador6>=1){
		$datos = [
			"estatus" => "error",
			"msg" => "Ya existe un usuario con dicho correo o numero de documento.",
		];
		echo json_encode($datos);
		exit;
	}

	$sql2 = "UPDATE pasantes SET estatus = 'Aceptada' WHERE id = ".$id;
	$proceso2 = mysqli_query($conexion,$sql2);

	$sql4 = "INSERT INTO modelos (nombre1,nombre2,apellido1,apellido2,documento_tipo,documento_numero,correo,genero,direccion,usuario,clave,telefono1,barrio,sede,fecha_inicio) VALUES ('$nombre1','$nombre2','$apellido1','$apellido2','$tipo_documento','$numero_documento','$correo','$genero','$direccion','$usuario','$clave','$telefono1','$barrio',$sede,'$fecha_inicio')";
	$proceso4 = mysqli_query($conexion,$sql4);

	$id_modelo = mysqli_insert_id($conexion);

	$sql5 = "INSERT INTO usuarios (nombre,apellido,documento_tipo,documento_numero,correo,usuario,clave,telefono1,rol,sede,id_modelo,fecha_inicio) VALUES ('$nombre1','$apellido1','$tipo_documento','$numero_documento','$correo','$usuario','$clave','$telefono1',5,$sede,$id_modelo,'$fecha_inicio')";
	$proceso5 = mysqli_query($conexion,$sql5);

	$datos = [
		"estatus" => "ok",
		"msg" => "Se ha cambiado el estatus exitosamente!",
	];
	echo json_encode($datos);
	exit;
}

if($condicion=='rechazar1'){
	$id = $_POST['id'];

	$sql1 = "UPDATE pasantes SET estatus = 'Rechazada' WHERE id = ".$id;
	$proceso1 = mysqli_query($conexion,$sql1);

	$datos = [
		"estatus" => "ok",
		"msg" => "Se ha cambiado el estatus exitosamente!",
	];
	echo json_encode($datos);
	exit;
}

?>