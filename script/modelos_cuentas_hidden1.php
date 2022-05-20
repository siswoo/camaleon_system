<?php
include('conexion.php');
$id = $_POST['variable'];
$html='';

$sql1 = "SELECT * FROM modelos_cuentas WHERE id = ".$id;
$consulta1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($consulta1)) {
	$id_modelos_cuentas_id = $row1['id'];
	$id_modelos_cuentas_id_paginas = $row1['id_paginas'];
	$id_modelos_cuentas_usuario = $row1['usuario'];
	$id_modelos_cuentas_clave = $row1['clave'];
	$id_modelos_cuentas_correo = $row1['correo'];
	$id_modelos_cuentas_link = $row1['link'];
	$id_modelos_cuentas_estatus = $row1['estatus'];
	$modelos_usuario_bonga = $row1['usuario_bonga'];
	$nickname_xlove = $row1['nickname_xlove'];
	$id_modelos_cuentas_fecha_inicio = $row1['fecha_inicio'];

	if($id_modelos_cuentas_estatus=='Aprobada'){

		$html.='
			<p><hr style="background-color: white;"></p>
		';

		if($id_modelos_cuentas_id_paginas==4){
			$html.='
				<p>Usuario: '.$modelos_usuario_bonga.'</p>
			';
		}else if($id_modelos_cuentas_id_paginas==11){
			$html.='
				<p>Usuario: '.$nickname_xlove.'</p>
			';
		}else{
			$html.='
				<p>Usuario: '.$id_modelos_cuentas_usuario.'</p>
			';
		}

		$html.='
			<p>Clave: '.$id_modelos_cuentas_clave.'</p>
		';

		if($id_modelos_cuentas_correo!=''){
			$html.='
				<p>Correo: '.$id_modelos_cuentas_correo.'</p>
			';
		}

		if($id_modelos_cuentas_link!=''){
			$html.='
				<p>Link: <input type="text" class="form-control" value="'.$id_modelos_cuentas_link.'"></p>
			';
		}

		$html.='
			<p><hr style="background-color: white;"></p>
		';
	}

}

	$datos = [
		"html" 	=> $html,
		"sql1" 	=> $sql1,
		"id_modelos_cuentas_usuario" 	=> $id_modelos_cuentas_usuario,
	];

	echo json_encode($datos);

?>