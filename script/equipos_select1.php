<?php
include('conexion.php');
$equipo = $_POST['equipo'];

if($equipo == 'Pareja'){ $variable_equipo = 2; }
if($equipo == 'Trio'){ $variable_equipo = 3; }
if($equipo == 'Cuarteto'){ $variable_equipo = 4; }
if($equipo == 'Quinteto'){ $variable_equipo = 5; }

if($equipo == 2){ $variable_equipo = 2; }
if($equipo == 3){ $variable_equipo = 3; }
if($equipo == 4){ $variable_equipo = 4; }
if($equipo == 5){ $variable_equipo = 5; }

//$sql_equipos1 = "SELECT * FROM equipos WHERE estatus = 'Activa' and cantidad = '".$variable_equipo."'";
$sql_equipos1 = "SELECT * FROM equipos WHERE (estatus = 'Activa' and cantidad = '".$variable_equipo."') and (id_modelo2='0' or id_modelo3='0' or id_modelo4='0' or id_modelo5='0')";
$consulta_equipos1 = mysqli_query( $conexion, $sql_equipos1 );
$html = '<option value="">Seleccione si desea enlazar</option>';

while($row1 = mysqli_fetch_array($consulta_equipos1)) {
	$equipo_id = $row1['id'];
	$equipo_cantidad = $row1['cantidad'];
	$id_modelo1 = $row1['id_modelo1'];
	$id_modelo2 = $row1['id_modelo2'];
	$id_modelo3 = $row1['id_modelo3'];
	$id_modelo4 = $row1['id_modelo4'];
	$id_modelo5 = $row1['id_modelo5'];
	/********/
	$pase=1;
	/********/

	$sql_modelo1 = "SELECT * FROM modelos WHERE id = ".$id_modelo1." LIMIT 1";
	$consulta_modelo1 = mysqli_query( $conexion, $sql_modelo1 );
	while($row2 = mysqli_fetch_array($consulta_modelo1)) {
		$modelo_nombre1 = $row2['nombre1'];
		$modelo_apellido1 = $row2['apellido1'];
		$nombre_completo_modelo = $modelo_nombre1." ".$modelo_apellido1;
	}

	if($equipo=='Pareja' and $id_modelo2>=1){$pase=0;}
	if($equipo=='Trio' and $id_modelo3>=1){$pase=0;}
	if($equipo=='Cuarteto' and $id_modelo4>=1){$pase=0;}
	if($equipo=='Quinteto' and $id_modelo5>=1){$pase=0;}

	if($pase==1){
		$html.= '
			<option value="'.$equipo_id.'">'.$nombre_completo_modelo.'</option>
		';
	} 
}

$contador1 = mysqli_num_rows($consulta_equipos1);
if($contador1==0){
	$html = '<option value="">No Se han encontrado equipos de esa cantidad</option>';
}

echo $html;

?>