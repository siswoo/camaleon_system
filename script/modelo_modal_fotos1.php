<?php
include('conexion.php');
$html_documento_identidad='';
$html_foto_cedula_con_cara='';
$html_foto_cedula_parte_frontal_cara='';
$html_foto_cedula_parte_respaldo='';
$html_antecedentes_penales='';
$html_extras1='';
$html_fotos1='';
$modelo_id = $_POST['variable'];
$contador_extra1 = 0;
$contador_fotos1 = 0;
$sql2 = "SELECT * FROM modelos_documentos WHERE id_modelos = ".$modelo_id;
$consulta3 = mysqli_query($conexion,$sql2);
while($row5 = mysqli_fetch_array($consulta3)) {
	$modelos_documentos_id = $row5['id'];
	$modelos_documentos_id_documento = $row5['id_documentos'];
	$modelos_documentos_tipo = $row5['tipo'];
	$modelos_documentos_fecha_inicio = $row5['fecha_inicio'];

	if($modelos_documentos_id_documento==2){
		$html_documento_identidad.='
			<div class="col-12 form-group text-center" id="documento_'.$modelos_documentos_id.'">
				<div><label for="" style="text-transform: capitalize;">Foto Documento de Identidad</label></div>
				<img src="../resources/documentos/modelos/archivos/'.$modelo_id.'/documento_identidad.'.$modelos_documentos_tipo.'" style="width:250px;border-radius:5px;">
				<p class="mt-3"><button type="button" class="btn btn-danger" id="'.$modelo_id.'" value="documento_identidad.'.$modelos_documentos_tipo.'" onclick="eliminar_foto1(this.id,value,'.$modelos_documentos_id.')">Borrar</button></p>
				<hr style="background-color:black;">
			</div>
		';
	}

	if($modelos_documentos_id_documento==8){
		$html_foto_cedula_con_cara.='
			<div class="col-12 form-group text-center" id="documento_'.$modelos_documentos_id.'">
				<div><label for="" style="text-transform: capitalize;">Foto cédula con cara</label></div>
				<img src="../resources/documentos/modelos/archivos/'.$modelo_id.'/foto_cedula_con_cara.'.$modelos_documentos_tipo.'" style="width:250px;border-radius:5px;">
				<p class="mt-3"><button type="button" class="btn btn-danger" id="'.$modelo_id.'" value="foto_cedula_con_cara.'.$modelos_documentos_tipo.'" onclick="eliminar_foto1(this.id,value,'.$modelos_documentos_id.')">Borrar</button></p>
				<hr style="background-color:black;">
			</div>
		';
	}

	if($modelos_documentos_id_documento==9){
		$html_foto_cedula_parte_frontal_cara.='
			<div class="col-12 form-group text-center" id="documento_'.$modelos_documentos_id.'">
				<div><label for="" style="text-transform: capitalize;">Foto cédula parte frontal con cara</label></div>
				<img src="../resources/documentos/modelos/archivos/'.$modelo_id.'/foto_cedula_parte_frontal_cara.'.$modelos_documentos_tipo.'" style="width:250px;border-radius:5px;">
				<p class="mt-3"><button type="button" class="btn btn-danger" id="'.$modelo_id.'" value="foto_cedula_parte_frontal_cara.'.$modelos_documentos_tipo.'" onclick="eliminar_foto1(this.id,value,'.$modelos_documentos_id.')">Borrar</button></p>
				<hr style="background-color:black;">
			</div>
		';
	}

	if($modelos_documentos_id_documento==10){
		$html_foto_cedula_parte_respaldo.='
			<div class="col-12 form-group text-center" id="documento_'.$modelos_documentos_id.'">
				<div><label for="" style="text-transform: capitalize;">Foto Cédula Parte Respaldo</label></div>
				<img src="../resources/documentos/modelos/archivos/'.$modelo_id.'/foto_cedula_parte_respaldo.'.$modelos_documentos_tipo.'" style="width:250px;border-radius:5px;">
				<p class="mt-3"><button type="button" class="btn btn-danger" id="'.$modelo_id.'" value="foto_cedula_parte_respaldo.'.$modelos_documentos_tipo.'" onclick="eliminar_foto1(this.id,value,'.$modelos_documentos_id.')">Borrar</button></p>
				<hr style="background-color:black;">
			</div>
		';
	}

	if($modelos_documentos_id_documento==12){
		if($contador_extra1==0){
			$html_extras1.='
				<div class="col-12 form-group text-center">
					<div><label for="" style="text-transform: capitalize;">Extras</label></div>
			';
			$contador_extra1 = $contador_extra1 + 1;
		}
		$html_extras1.='
					<div class="mt-3 mb-3">
						<img src="../resources/documentos/modelos/archivos/'.$modelo_id.'/extras_'.$modelos_documentos_id.'.'.$modelos_documentos_tipo.'" style="width:250px;border-radius:5px;">
						<p class="mt-3" style="font-weight:bold;">('.$modelos_documentos_fecha_inicio.')</p>
						<p><button type="button" class="btn btn-danger mt-1" value="'.$modelos_documentos_id.'" id="'.$modelo_id.'" onclick="borrar_extra(this.value,this.id);">Borrar</button></p>
					</div>
					<br>
		';
	}

	if($modelos_documentos_id_documento==13){
		if($contador_fotos1==0){
			$html_fotos1.='
				<div class="col-12 form-group text-center">
					<div><label for="" style="text-transform: capitalize;">Fotos Sensuales</label></div>
			';
			$contador_fotos1 = $contador_fotos1 + 1;
		}
		$html_fotos1.='
					<div class="mt-3 mb-3">
						<img src="../resources/documentos/modelos/archivos/'.$modelo_id.'/sensuales_'.$modelos_documentos_id.'.jpg" style="width:250px;border-radius:5px;">
						<p class="mt-3" style="font-weight:bold;">('.$modelos_documentos_fecha_inicio.')</p>
						<p><button type="button" class="btn btn-danger mt-1" value="'.$modelos_documentos_id.'" id="'.$modelo_id.'" onclick="borrar_sensual(this.value,this.id);">Borrar</button></p>
					</div>
					<br>
		';
	}
}

if($contador_extra1>=1){
	$html_extras1.='
			<hr style="background-color:black;">
		</div>
	';
}

if($contador_fotos1>=1){
	$html_fotos1.='
			<hr style="background-color:black;">
		</div>
	';
}

$html_matriz = $html_documento_identidad.$html_foto_cedula_con_cara.$html_foto_cedula_parte_frontal_cara.$html_foto_cedula_parte_respaldo.$html_extras1.$html_fotos1;

if($html_matriz==''){
	$html_matriz = '
		<div class="col-12 form-group text-center">
			<div><label for="" style="text-transform: capitalize;">Sin Fotos cargados</label></div>
			<hr style="background-color:black;">
		</div>
	';
}

$datos = [
	"html_matriz" => $html_matriz,
];

echo json_encode($datos);

/*
echo $html_documento_identidad;
echo $html_foto_cedula_con_cara;
echo $html_foto_cedula_parte_frontal_cara;
echo $html_foto_cedula_parte_respaldo;
echo $html_extras1;
*/
?>