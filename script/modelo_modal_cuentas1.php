<?php
$modelo_id = $_POST['variable'];
include('conexion.php');

$html = '';

$sql1="SELECT * FROM paginas ORDER BY id";
$consulta1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($consulta1)) {
	$pagina_id = $row1['id'];
	$pagina_nombre = $row1['nombre'];
	$html.="<div class='col-12'>";
	if($pagina_id!=1){ $html.= '<hr>'; }
	$html.= "<p style='font-weight:bold; text-align:center;'>".$pagina_nombre."</p>";
	$sql2="SELECT * FROM modelos_cuentas WHERE id_modelos = ".$modelo_id." and id_paginas = ".$pagina_id;
	$consulta2 = mysqli_query($conexion,$sql2);
	$fila1 = mysqli_num_rows($consulta2);
	if($fila1==0){
		$html.="<p><small>No ha registrado cuenta</small></p>";
	}
	$contador1=1;
	while($row2 = mysqli_fetch_array($consulta2)) {
		$modelo_cuenta_id = $row2['id'];
		$modelo_usuario = $row2['usuario'];
		$modelo_clave = $row2['clave'];
		$modelo_correo = $row2['correo'];
		$modelo_link = $row2['link'];
		$modelo_estatus = $row2['estatus'];
		$modelo_nickname_xlove = $row2['nickname_xlove'];
		$modelo_usuario_bonga = $row2['usuario_bonga'];
		if($modelo_estatus=='Proceso'){
			$html.= "<button type='button' class='btn btn-info' style='margin-bottom:1rem;' value='hidden_cuenta_".$pagina_nombre."_".$contador1."' onclick='hidden_cuentas1(this.value);'>Cuenta #".$contador1." (Proceso)</button>";	
		}else if($modelo_estatus=='Aprobada'){
			$html.= "<button type='button' class='btn btn-success' style='margin-bottom:1rem;' value='hidden_cuenta_".$pagina_nombre."_".$contador1."' onclick='hidden_cuentas1(this.value);'>Cuenta #".$contador1." (Aprobada)</button>";	
		}else{
			$html.= "<button type='button' class='btn btn-danger' style='margin-bottom:1rem;' value='hidden_cuenta_".$pagina_nombre."_".$contador1."' onclick='hidden_cuentas1(this.value);'>Cuenta #".$contador1." (Rechazada)</button>";	
		}

		if($pagina_id==4){
			$html.="
			<input type='hidden' id='hidden_cuenta_".$pagina_nombre."_".$contador1."' value='0'>
			<div class='row' id='div_hidden_cuenta_".$pagina_nombre."_".$contador1."' style='display:none;'>
				<div class='col-12'>
					<div class='input-group'>
						<span style='margin-top:1rem; width:100px;'>Usuario Pago: &nbsp;</span>
						<input class='form-control mb-2 mt-2' type='text' value='".$modelo_usuario."' id='edit_cuenta_usuario_".$modelo_cuenta_id."' name='edit_cuenta_usuario_".$modelo_cuenta_id."'> 
					</div>
				</div>
				<div class='col-12'>
					<div class='input-group'>
						<span style='margin-top:1rem; width:100px;'>Usuario Login: &nbsp;</span>
						<input class='form-control mb-2 mt-2' type='text' value='".$modelo_usuario_bonga."' id='edit_usuario_bonga_".$modelo_cuenta_id."' name='edit_usuario_bonga_".$modelo_cuenta_id."'> 
					</div>
				</div>

				<div class='col-12'>
					<div class='input-group'>
						<span style='margin-top:1rem; width:100px;'>Clave: &nbsp;</span>
						<input class='form-control mb-2 mt-2' type='text' value='".$modelo_clave."' id='edit_cuenta_clave_".$modelo_cuenta_id."' name='edit_cuenta_clave_".$modelo_cuenta_id."'> 
					</div>
				</div>
				";
				if($modelo_correo!=''){
				$html.= "
					<div class='col-12'>
						<div class='input-group'>
							<span style='margin-top:1rem; width:100px;'>Correo: &nbsp;</span>
							<input class='form-control mb-2 mt-2' type='text' value='".$modelo_correo."' id='edit_cuenta_correo_".$modelo_cuenta_id."' name='edit_cuenta_correo_".$modelo_cuenta_id."'> 
						</div>
					</div>	
				";	
				}
				if($modelo_link!=''){
				$html.= "
					<div class='col-12'>
						<div class='input-group'>
							<span style='margin-top:1rem; width:100px;'>Link: &nbsp;</span>
							<input class='form-control mb-2 mt-2' type='text' value='".$modelo_link."' id='edit_cuenta_link_".$modelo_cuenta_id."' name='edit_cuenta_link_".$modelo_cuenta_id."'>
						</div>
					</div>
				";	
				}

				if($pagina_id==11){
					$html.= "
					<div class='col-12'>
						<div class='input-group'>
							<span style='margin-top:1rem; width:140px;'>NickName Xlove: &nbsp;</span>
							<input class='form-control mb-2 mt-2' type='text' value='".$modelo_nickname_xlove."' id='edit_cuenta_nickname_xlove_".$modelo_cuenta_id."' name='edit_cuenta_nickname_xlove_".$modelo_cuenta_id."'>
						</div>
					</div>
					";
				}

				if($modelo_estatus=='Aprobada'){
					$html.= "
					<div class='col-12 text-center mt-2'>
						<!--<button type='button' class='btn btn-primary' onclick='alerta_cuenta1(".$modelo_id.",".$modelo_cuenta_id.");'>Alertar a Modelo</button>-->
						<button type='button' class='btn btn-danger' value='".$pagina_nombre."' id='Rechazada' onclick='cuenta_estatus(this.id,this.value,".$modelo_id.",".$pagina_id.",".$modelo_cuenta_id.");'>Cuenta Rechazada</button>
						<button type='button' class='btn btn-dark' value='".$pagina_nombre."' id='Eliminar' onclick='cuenta_eliminar(this.id,this.value,".$modelo_id.",".$pagina_id.",".$modelo_cuenta_id.");'>Eliminar Cuenta</button>
						<button type='button' class='btn btn-warning' value='".$pagina_nombre."' id='Eliminar' style='color:white;' onclick='cuenta_editar(".$modelo_cuenta_id.",".$pagina_id.");'>Editar Cuenta</button>
					</div>
					";
				}
				if($modelo_estatus=='Proceso'){
					$html.= "
						<div class='col-12 text-center'>
							<button type='button' class='btn btn-success' value='".$pagina_nombre."' id='Aprobada' onclick='cuenta_estatus(this.id,this.value,".$modelo_id.",".$pagina_id.",".$modelo_cuenta_id.");'>Cuenta Aprobada</button>
							<button type='button' class='btn btn-danger' value='".$pagina_nombre."' id='Rechazada' onclick='cuenta_estatus(this.id,this.value,".$modelo_id.",".$pagina_id.",".$modelo_cuenta_id.");'>Cuenta Rechazada</button>
							<button type='button' class='btn btn-dark' value='".$pagina_nombre."' id='Eliminar' onclick='cuenta_eliminar(this.id,this.value,".$modelo_id.",".$pagina_id.",".$modelo_cuenta_id.");'>Eliminar Cuenta</button>
							<button type='button' class='btn btn-warning' value='".$pagina_nombre."' id='Eliminar' style='color:white;' onclick='cuenta_editar(".$modelo_cuenta_id.",".$pagina_id.");'>Editar Cuenta</button>
						</div>
					";
				}

				if($modelo_estatus=='Rechazada'){
					$html.= "
						<div class='col-12 text-center'>
							<button type='button' class='btn btn-success' value='".$pagina_nombre."' id='Aprobada' onclick='cuenta_estatus(this.id,this.value,".$modelo_id.",".$pagina_id.",".$modelo_cuenta_id.");'>Cuenta Aprobada</button>
							<button type='button' class='btn btn-dark' value='".$pagina_nombre."' id='Eliminar' onclick='cuenta_eliminar(this.id,this.value,".$modelo_id.",".$pagina_id.",".$modelo_cuenta_id.");'>Eliminar Cuenta</button>
							<button type='button' class='btn btn-warning' value='".$pagina_nombre."' id='Eliminar' style='color:white;' onclick='cuenta_editar(".$modelo_cuenta_id.",".$pagina_id.");'>Editar Cuenta</button>
						</div>
					";
				}
				$html.= "
				<div style='margin-bottom:10px;'>&nbsp;</div>
			</div>
		";
		}else{
			$html.="
			<input type='hidden' id='hidden_cuenta_".$pagina_nombre."_".$contador1."' value='0'>
			<div class='row' id='div_hidden_cuenta_".$pagina_nombre."_".$contador1."' style='display:none;'>
				<div class='col-12'>
					<div class='input-group'>
						<span style='margin-top:1rem; width:100px;'>Usuario: &nbsp;</span>
						<input class='form-control mb-2 mt-2' type='text' value='".$modelo_usuario."' id='edit_cuenta_usuario_".$modelo_cuenta_id."' name='edit_cuenta_usuario_".$modelo_cuenta_id."'> 
					</div>
				</div>
				<div class='col-12'>
					<div class='input-group'>
						<span style='margin-top:1rem; width:100px;'>Clave: &nbsp;</span>
						<input class='form-control mb-2 mt-2' type='text' value='".$modelo_clave."' id='edit_cuenta_clave_".$modelo_cuenta_id."' name='edit_cuenta_clave_".$modelo_cuenta_id."'> 
					</div>
				</div>
				";
				if($modelo_correo!=''){
				$html.= "
					<div class='col-12'>
						<div class='input-group'>
							<span style='margin-top:1rem; width:100px;'>Correo: &nbsp;</span>
							<input class='form-control mb-2 mt-2' type='text' value='".$modelo_correo."' id='edit_cuenta_correo_".$modelo_cuenta_id."' name='edit_cuenta_correo_".$modelo_cuenta_id."'> 
						</div>
					</div>	
				";	
				}
				if($modelo_link!=''){
				$html.= "
					<div class='col-12'>
						<div class='input-group'>
							<span style='margin-top:1rem; width:100px;'>Link: &nbsp;</span>
							<input class='form-control mb-2 mt-2' type='text' value='".$modelo_link."' id='edit_cuenta_link_".$modelo_cuenta_id."' name='edit_cuenta_link_".$modelo_cuenta_id."'>
						</div>
					</div>
				";	
				}

				if($pagina_id==11){
					$html.= "
					<div class='col-12'>
						<div class='input-group'>
							<span style='margin-top:1rem; width:140px;'>NickName Xlove: &nbsp;</span>
							<input class='form-control mb-2 mt-2' type='text' value='".$modelo_nickname_xlove."' id='edit_cuenta_nickname_xlove_".$modelo_cuenta_id."' name='edit_cuenta_nickname_xlove_".$modelo_cuenta_id."'>
						</div>
					</div>
					";
				}

				if($modelo_estatus=='Aprobada'){
					$html.= "
					<div class='col-12 text-center mt-2'>
						<!--<button type='button' class='btn btn-primary' onclick='alerta_cuenta1(".$modelo_id.",".$modelo_cuenta_id.");'>Alertar a Modelo</button>-->
						<button type='button' class='btn btn-danger' value='".$pagina_nombre."' id='Rechazada' onclick='cuenta_estatus(this.id,this.value,".$modelo_id.",".$pagina_id.",".$modelo_cuenta_id.");'>Cuenta Rechazada</button>
						<button type='button' class='btn btn-dark' value='".$pagina_nombre."' id='Eliminar' onclick='cuenta_eliminar(this.id,this.value,".$modelo_id.",".$pagina_id.",".$modelo_cuenta_id.");'>Eliminar Cuenta</button>
						<button type='button' class='btn btn-warning' value='".$pagina_nombre."' id='Eliminar' style='color:white;' onclick='cuenta_editar(".$modelo_cuenta_id.",".$pagina_id.");'>Editar Cuenta</button>
					</div>
					";
				}
				if($modelo_estatus=='Proceso'){
					$html.= "
						<div class='col-12 text-center'>
							<button type='button' class='btn btn-success' value='".$pagina_nombre."' id='Aprobada' onclick='cuenta_estatus(this.id,this.value,".$modelo_id.",".$pagina_id.",".$modelo_cuenta_id.");'>Cuenta Aprobada</button>
							<button type='button' class='btn btn-danger' value='".$pagina_nombre."' id='Rechazada' onclick='cuenta_estatus(this.id,this.value,".$modelo_id.",".$pagina_id.",".$modelo_cuenta_id.");'>Cuenta Rechazada</button>
							<button type='button' class='btn btn-dark' value='".$pagina_nombre."' id='Eliminar' onclick='cuenta_eliminar(this.id,this.value,".$modelo_id.",".$pagina_id.",".$modelo_cuenta_id.");'>Eliminar Cuenta</button>
							<button type='button' class='btn btn-warning' value='".$pagina_nombre."' id='Eliminar' style='color:white;' onclick='cuenta_editar(".$modelo_cuenta_id.",".$pagina_id.");'>Editar Cuenta</button>
						</div>
					";
				}

				if($modelo_estatus=='Rechazada'){
					$html.= "
						<div class='col-12 text-center'>
							<button type='button' class='btn btn-success' value='".$pagina_nombre."' id='Aprobada' onclick='cuenta_estatus(this.id,this.value,".$modelo_id.",".$pagina_id.",".$modelo_cuenta_id.");'>Cuenta Aprobada</button>
							<button type='button' class='btn btn-dark' value='".$pagina_nombre."' id='Eliminar' onclick='cuenta_eliminar(this.id,this.value,".$modelo_id.",".$pagina_id.",".$modelo_cuenta_id.");'>Eliminar Cuenta</button>
							<button type='button' class='btn btn-warning' value='".$pagina_nombre."' id='Eliminar' style='color:white;' onclick='cuenta_editar(".$modelo_cuenta_id.",".$pagina_id.");'>Editar Cuenta</button>
						</div>
					";
				}
				$html.= "
				<div style='margin-bottom:10px;'>&nbsp;</div>
			</div>
		";
		}

		$contador1=$contador1+1;
	}
	$html.="</div>";

	$datos = [
		"sql1" 	=> $sql1,
		"sql2" 	=> $sql2,
		"html" 	=> $html,
	];

}

	echo json_encode($datos);
?>