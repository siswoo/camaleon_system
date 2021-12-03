<?php
$modelo_id = $_POST['variable'];
include('conexion.php');

$html = '';

$html .= '
	<div class="col-6 mt-1 mb-2">
';

$sql1 = "SELECT * FROM usuarios WHERE rol = 9";
$consulta1 = mysqli_query($conexion,$sql1);
$html .= '
	<select class="form-control" required name="responsable_registro" id="responsable_registro">
		<option value="">Seleccione</option>
';
while($row1 = mysqli_fetch_array($consulta1)) {
	$nombre = $row1['nombre'];
	$apellido = $row1['apellido'];
	$responsable_id = $row1['id'];
	$html .=  '
		<option value="'.$responsable_id.'">'.$nombre.' '.$apellido.'</option>
	';
}

$html .= '
	</select>
	</div>

	<div class="col-6 mt-1 mb-2 text-center">
		<button type="button" class="btn btn-success" value="'.$modelo_id.'" onclick="agregar_responsable1(this.value)">Agregar</button>
	</div>
';

$sql_responsable1 = "SELECT * FROM soporte_responsable_modelo WHERE id_modelo = ".$modelo_id;
$resultado3 = mysqli_query($conexion,$sql_responsable1);
$contador1 = mysqli_num_rows($resultado3);
if($contador1>=1){
	while($row5 = mysqli_fetch_array($resultado3)) {
		$responsable_id = $row5['id_soporte'];
		$reponsable_fecha_inicio = $row5['fecha_inicio'];
		$sql_responsable2 = "SELECT * FROM usuarios WHERE id = ".$responsable_id;
		$resultado4 = mysqli_query($conexion,$sql_responsable2);
		while($row5 = mysqli_fetch_array($resultado4)) {
			$responsable_name = $row5['nombre'];
			$responsable_apellido = $row5['apellido'];
			$responsable_nombre = $responsable_name.' '.$responsable_apellido;

			$html .= '
				<div class="col-12">
					<hr style="background-color:black;">
					<p><strong>Nombre:</strong> '.$responsable_nombre.'</p>
					<p><strong>Fecha Asignado:</strong> '.$reponsable_fecha_inicio.'</p>
					<button type="button" class="btn btn-danger" value="'.$responsable_id.'" id="'.$modelo_id.'" onclick="borrar_responsable(this.value,this.id);">Borrar Enlace</button>
					<hr style="background-color:black;">
				</div>
			';

		}
	}
}else{
	$html .= '
	<div class="col-12 text-center mt-3 mb-3" style="font-weight:bold; font-size:20px;">
		Sin responsable
	</div>
	';
}

$datos = [
	"html" 	=> $html,
];

echo json_encode($datos);

?>