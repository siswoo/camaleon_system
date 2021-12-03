<?php
include('conexion.php');
$value = $_POST['value'];

$sql1 = "SELECT * FROM modelos WHERE documento_numero = ".$value." LIMIT 1";
$consulta1 = mysqli_query($conexion,$sql1);
$contador1 = mysqli_num_rows($consulta1);

$html1 = '
	<div class="row">
';

if($contador1 >= 1){
	while($row = mysqli_fetch_array($consulta1)) {
		$nombre = $row['nombre1']." ".$row['nombre2']." ".$row['apellido1']." ".$row['apellido2'];
		$documento = $row['documento_tipo']." - ".$row['documento_numero'];
		$correo = $row['correo'];
		$telefono = $row['telefono1'];
		$html1 .= '
		<div class="col-12">
			<div class="media">
				<img class="d-flex mr-3" src="../img/Negro Camaleon.png" style="width:80px;">
				<div class="media-body">
					<h5 class="mt-0"><strong>'.$nombre.'</strong></h5>
					<strong>Documento:</strong> '.$documento.' <br>
					<strong>Correo:</strong> '.$correo.' <br>
					<strong>Teléfono:</strong> '.$telefono.'
				</div>
			</div>
		</div>
		<div class="col-12 mt-3">
		<hr style="background-color:black;">
			<p><strong>Tokens Obtenidos:</strong> 255</p>
		</div>

		<div class="col-12 mt-3">
		<hr style="background-color:black;">
			<p><strong>Deudas:</strong> 255</p>
		</div>

			<!--
			<div class="col-12"><strong>Nombre Completo:</strong> '.$nombre.'</div>
			<div class="col-12"><strong>Documento:</strong> '.$documento.'</div>
			-->
		';
	}
}

$html1 .= '</div>';

$datos = [
	"sql1" => $sql1,
	"contador1" => $contador1,
	"html" => $html1,
];

echo json_encode($datos);
?>