<?php
include('conexion.php');
$html_documentos1='';
$html_firma1='';
$contador_extra1 = 1;
$modelo_id = $_POST['variable'];
$sql2 = "SELECT * FROM modelos_documentos WHERE id_modelos = ".$modelo_id;
$consulta3 = mysqli_query($conexion,$sql2);
while($row5 = mysqli_fetch_array($consulta3)) {
	$modelos_documentos_id = $row5['id'];
	$modelos_documentos_id_documento = $row5['id_documentos'];
	$modelos_documentos_tipo = $row5['tipo'];
							
	if($modelos_documentos_id_documento==1){
		$sql3 = "SELECT * FROM documentos WHERE id = ".$modelos_documentos_id_documento;
		$consulta4 = mysqli_query($conexion,$sql3);
		while($row6 = mysqli_fetch_array($consulta4)) {
			$html_firma1.='
				<div class="col-12 form-group text-center">
					<div>
						<!--<label for="" style="text-transform: capitalize;">Firma</label>-->
						<button type="button" id="documento1" value="0" onclick="bottonMostrar1(this.id,value);" class="btn btn-info">Firma</button>
					</div>
					<img id="div_documento1" src="../resources/documentos/modelos/archivos/'.$modelo_id.'/firma_digital.'.$modelos_documentos_tipo.'" style="width:250px;border-radius:5px; display:none;">
					<hr style="background-color:black;">
				</div>
			';
		}
	}

	if($modelos_documentos_id_documento==3){
		$sql3 = "SELECT * FROM documentos WHERE id = ".$modelos_documentos_id_documento;
		$consulta4 = mysqli_query($conexion,$sql3);
		while($row7 = mysqli_fetch_array($consulta4)) {
			if($modelos_documentos_tipo=='pdf'){
				$html_documentos1.= '
					<div class="col-12 form-group text-center">
						<div>
							<!--<label for="" style="text-transform: capitalize;">Pasaporte</label>-->
							<button type="button" id="documento2" value="0" onclick="bottonMostrar1(this.id,value);" class="btn btn-info">Pasaporte</button>
						</div>
						<embed id="div_documento2" src="../resources/documentos/modelos/archivos/'.$modelo_id.'/pasaporte.'.$modelos_documentos_tipo.'#toolbar=0" type="application/pdf" width="100%" height="300px" style="display:none;" />
						<hr style="background-color:black;">
					</div>
				';
			}else{
				$html_documentos1.='
					<div class="col-12 form-group text-center">
						<div><label for="" style="text-transform: capitalize;">Pasaporte</label></div>
						<img src="../resources/documentos/modelos/archivos/'.$modelo_id.'/pasaporte.'.$modelos_documentos_tipo.'" style="width:250px;border-radius:5px;">
						<hr style="background-color:black;">
					</div>
				';
			}
		}
	}

	if($modelos_documentos_id_documento==4){
		$sql3 = "SELECT * FROM documentos WHERE id = ".$modelos_documentos_id_documento;
		$consulta4 = mysqli_query($conexion,$sql3);
		while($row6 = mysqli_fetch_array($consulta4)) {
			if($modelos_documentos_tipo=='pdf'){
				$html_documentos1.='
					<div class="col-12 form-group text-center">
						<div>
							<!--<label for="" style="text-transform: capitalize;">RUT</label>-->
							<button type="button" id="documento3" value="0" onclick="bottonMostrar1(this.id,value);" class="btn btn-info">RUT</button>
						</div>
						<embed id="div_documento3" src="../resources/documentos/modelos/archivos/'.$modelo_id.'/rut.'.$modelos_documentos_tipo.'#toolbar=0" type="application/pdf" width="100%" height="300px" style="display:none;" />
							<hr style="background-color:black;">
					</div>
				';
			}else{
				$html_documentos1.='
					<div class="col-12 form-group text-center">
						<div><label for="" style="text-transform: capitalize;">RUT</label></div>
						<img src="../resources/documentos/modelos/archivos/'.$modelo_id.'/rut.'.$modelos_documentos_tipo.'" style="width:250px;border-radius:5px;">
						<hr style="background-color:black;">
					</div>
				';
			}
		}
	}

	if($modelos_documentos_id_documento==5){
		$sql3 = "SELECT * FROM documentos WHERE id = ".$modelos_documentos_id_documento;
		$consulta4 = mysqli_query($conexion,$sql3);
		while($row6 = mysqli_fetch_array($consulta4)) {
			if($modelos_documentos_tipo=='pdf'){
				$html_documentos1.='
					<div class="col-12 form-group text-center">
						<div>
							<!--<label for="" style="text-transform: capitalize;">Certificación Bancaria</label>-->
							<button type="button" id="documento4" value="0" onclick="bottonMostrar1(this.id,value);" class="btn btn-info">Certificación Bancaria</button>
						</div>
						<embed id="div_documento4" src="../resources/documentos/modelos/archivos/'.$modelo_id.'/certificacion_bancaria.'.$modelos_documentos_tipo.'#toolbar=0" type="application/pdf" width="100%" height="300px" style="display:none;" />
										    	<hr style="background-color:black;">
					</div>
				';
			}else{
				$html_documentos1.='
					<div class="col-12 form-group text-center">
						<div><label for="" style="text-transform: capitalize;">Certificación Bancaria</label></div>
						<img src="../resources/documentos/modelos/archivos/'.$modelo_id.'/certificacion_bancaria.'.$modelos_documentos_tipo.'" style="width:250px;border-radius:5px;">
						<hr style="background-color:black;">
					</div>
				';
			}
		}
	}

	if($modelos_documentos_id_documento==6){
		$sql3 = "SELECT * FROM documentos WHERE id = ".$modelos_documentos_id_documento;
		$consulta4 = mysqli_query($conexion,$sql3);
		while($row6 = mysqli_fetch_array($consulta4)) {
			if($modelos_documentos_tipo=='pdf'){
				$html_documentos1.='
					<div class="col-12 form-group text-center">
						<div>
							<!--<label for="" style="text-transform: capitalize;">EPS</label>-->
							<button type="button" id="documento5" value="0" onclick="bottonMostrar1(this.id,value);" class="btn btn-info">EPS</button>
						</div>
						<embed id="div_documento5" src="../resources/documentos/modelos/archivos/'.$modelo_id.'/eps.'.$modelos_documentos_tipo.'#toolbar=0" type="application/pdf" width="100%" height="300px" style="display:none;"/>
						<hr style="background-color:black;">
					</div>
				';
			}else{
				$html_documentos1.='
					<div class="col-12 form-group text-center">
						<div><label for="" style="text-transform: capitalize;">EPS</label></div>
						<img src="../resources/documentos/modelos/archivos/'.$modelo_id.'/eps.'.$modelos_documentos_tipo.'" style="width:250px;border-radius:5px;">
						<hr style="background-color:black;">
					</div>
				';
			}
		}
	}

	if($modelos_documentos_id_documento==7){
		$sql3 = "SELECT * FROM documentos WHERE id = ".$modelos_documentos_id_documento;
		$consulta4 = mysqli_query($conexion,$sql3);
		while($row6 = mysqli_fetch_array($consulta4)) {
			if($modelos_documentos_tipo=='pdf'){
				$html_documentos1.='
					<div class="col-12 form-group text-center">
						<div>
							<!--<label for="" style="text-transform: capitalize;">Antecedentes Disciplinarios</label>-->
							<button type="button" id="documento6" value="0" onclick="bottonMostrar1(this.id,value);" class="btn btn-info">Antecedentes Disciplinarios</button>
						</div>
						<embed id="div_documento6" src="../resources/documentos/modelos/archivos/'.$modelo_id.'/antecedentes_disciplinarios.'.$modelos_documentos_tipo.'#toolbar=0" type="application/pdf" width="100%" height="300px" style="display:none;" />
						<hr style="background-color:black;">
					</div>
				';
			}else{
				$html_documentos1.='
					<div class="col-12 form-group text-center">
						<div><label for="" style="text-transform: capitalize;">Antecedentes Disciplinarios</label></div>
						<img src="../resources/documentos/modelos/archivos/'.$modelo_id.'/antecedentes_disciplinarios.'.$modelos_documentos_tipo.'" style="width:250px;border-radius:5px;">
						<hr style="background-color:black;">
					</div>
				';
			}
		}
	}
}

$html_matriz = $html_firma1.$html_documentos1;

if($html_matriz==''){
	$html_matriz = '
		<div class="col-12 form-group text-center">
			<div><label for="" style="text-transform: capitalize;">Sin Documentos cargados</label></div>
			<hr style="background-color:black;">
		</div>
	';
}

$datos = [
	"html_matriz" => $html_matriz,
];

echo json_encode($datos);

exit;
?>



<?php
$id = $_POST['variable'];
include('conexion.php');

$sql1 = "SELECT * FROM modelos_documentos WHERE id_modelos = ".$id;
$consulta1 = mysqli_query($conexion, $sql1);
$resultados = 0;

while($row = mysqli_fetch_array($consulta1)) {
	$contrato_id = $row['id_documentos'];
	$sql2 = "SELECT * FROM documentos WHERE id = ".$contrato_id;
	$consulta2 = mysqli_query($conexion, $sql2);
	while($row2 = mysqli_fetch_array($consulta2)) {
		$nombre_documento = $row2['nombre'];
		$ruta_documento = $row2['ruta'];
		$resultados = 1;

		$datos = [
			"nombre_documento" 	=> $nombre_documento,
			"ruta_documento" 	=> $ruta_documento,
			"resultados" 	=> $resultados,
		];
	}
}

$datos = [
	"nombre_documento" 	=> '',
	"ruta_documento" 	=> '',
	"resultados" 	=> $resultados,
];

echo json_encode($datos);

?>