<?php
include('conexion.php');
$value = $_POST['value'];
$html = '';
$rooms = '';
$monitores = '';

if($value == 'turno'){
	$html .= '
	<table id="table1" class="table">
		<thead>
			<tr>
				<th class="text-center">Número</th>
				<th class="text-center">Modelo</th>
				<th class="text-center">Room</th>
				<th class="text-center">Monitor</th>
			</tr>
		</thead>
		<tbody>
	';

	for($i=1;$i<=50;$i++){
		$html .= '
			<tr>
				<td class="text-center" style="width: 10%">'.$i.'</td>
				<td class="text-center" style="width: 35%">
					<input type="search" class="form-control" style="/*width: 220px;*/ display: initial;" id="searchmodelos" name="listamodelos_'.$i.'" list="listamodelos_'.$i.'" onkeyup="buscarModelo(value,'.$i.');">
				    <datalist id="listamodelos_'.$i.'">
				    	<option></option>
				    </datalist>
				</td>
				<td class="text-center" style="width: 25%">
					<select name="rooms_'.$i.'" id="rooms_'.$i.'" class="form-control">
						<option value="">Vacio</option>
				';

				$sql1 = "SELECT * FROM rooms";
				$consulta1 = mysqli_query($conexion,$sql1);
				while($row = mysqli_fetch_array($consulta1)) {
					$html .= '
							<option value="'.$row["id"].'">'.$row["nombre"].'</option>
					';
				}
		$html .= '
					</select>
				</td>
				<td class="text-center" style="width: 25%">
					<select name="monitor_'.$i.'" id="monitor_'.$i.'" class="form-control">
						<option value="">Ninguno</option>
				';

				$sql2 = "SELECT * FROM usuarios WHERE rol = 11";
				$consulta2 = mysqli_query($conexion,$sql2);
				while($row2 = mysqli_fetch_array($consulta2)) {
					$html .= '
						<option value="'.$row2["id"].'">'.$row2["nombre"].' '.$row2["apellido"].'</option>
					';
				}

		$html .= '
					</select>
				</td>
			</tr>
		';
	}

}



$html .= '
	</tbody>
</table>
';

$datos = [
	"value" => $value,
	"html" => $html,
];

echo json_encode($datos);
?>