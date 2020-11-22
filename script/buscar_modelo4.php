<?php
include('conexion.php');
$value = $_POST['value'];

$sql1 = "SELECT * FROM modelos WHERE documento_numero LIKE '%".$value."%' or nombre1 LIKE '%".$value."%' or nombre2 LIKE '%".$value."%' or apellido1 LIKE '%".$value."%' or apellido2 LIKE '%".$value."%' ";
$consulta1 = mysqli_query($conexion,$sql1);
$contador1 = mysqli_num_rows($consulta1);

$html1 = '';

if($contador1 >= 1){
	while($row = mysqli_fetch_array($consulta1)) {
		$nombre = $row['nombre1']." ".$row['nombre2']." ".$row['apellido1']." ".$row['apellido2'];
		$documento = $row['documento_numero'];
		$html1 .= '
			<option value="'.$documento.'">'.$nombre.'</option>
		';
	}
}

$datos = [
	"sql1" => $sql1,
	"contador1" => $contador1,
	"html" => $html1,
];

echo json_encode($datos);
?>