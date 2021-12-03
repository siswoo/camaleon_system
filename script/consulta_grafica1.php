<?php
header('Content-Type: application/json');
session_start();
include('conexion.php');
$fecha_inicio = date('Y-m-d');
$responsable = $_SESSION['id'];
$pagina = $_POST['select_graficos1'];
$trm = $_POST['trm_graficos1'];
$moneda = $_POST['moneda_graficos1'];

if($pagina=='XLove' or $pagina=='Imlive'){

	if($pagina=='XLove'){
		$sqlQuery = "SELECT SUM(tokens) as tokens, SUM(dolares) as dolares, fecha_desde, fecha_hasta, fecha_inicio FROM xlove GROUP BY fecha_desde";
	}

	if($pagina=='Imlive'){
		$sqlQuery = "SELECT SUM(tokens) as tokens, SUM(dolares) as dolares, fecha_desde, fecha_hasta, fecha_inicio FROM imlive GROUP BY fecha_desde";	
	}

	$result = mysqli_query($conexion,$sqlQuery);

	$data = array();

	$contador1 = 0;

	while($row1 = mysqli_fetch_array($result)) {
		if($moneda=='Dolares'){
			$total[$contador1] = round($row1['dolares']*1,2);
		}
		if($moneda=='Pesos'){
			$total[$contador1] = round($row1['dolares']*$trm,2);
		}
		if($moneda=='Tokens'){
			$total[$contador1] = $row1['tokens']*1;
		}
		$fecha_desde[$contador1] = $row1['fecha_desde'];
		$fecha_hasta[$contador1] = $row1['fecha_hasta'];
		$data[] = array("total"=>$total[$contador1], "desde" => $fecha_desde[$contador1], "hasta" => $fecha_hasta[$contador1]);
		$contador1 = $contador1 + 1;
	}
}

if($pagina=='Chaturbate' or $pagina=='Stripchat'){

	if($pagina=='Chaturbate'){
		$sqlQuery = "SELECT SUM(tokens) as tokens, fecha FROM chaturbate GROUP BY fecha";	
	}

	if($pagina=='Stripchat'){
		$sqlQuery = "SELECT SUM(tokens) as tokens, fecha FROM stripchat GROUP BY fecha";	
	}
	
	$result = mysqli_query($conexion,$sqlQuery);

	$data = array();

	$contador1 = 0;

	while($row1 = mysqli_fetch_array($result)) {
		if($moneda=='Dolares'){
			$total[$contador1] = round($row1['tokens']*0.05,2);
		}
		if($moneda=='Pesos'){
			$calculo1 = $row1['tokens']*0.05;
			$total[$contador1] = round($calculo1*$trm,2);
		}
		if($moneda=='Tokens'){
			$total[$contador1] = $row1['tokens']*1;
		}
		$fecha_desde[$contador1] = $row1['fecha'];
		$fecha_hasta[$contador1] = $row1['fecha'];
		$data[] = array("total"=>$total[$contador1], "desde" => $fecha_desde[$contador1], "hasta" => $fecha_hasta[$contador1]);
		$contador1 = $contador1 + 1;
	}
}

if($pagina=='Streamate' or $pagina=='Myfreecams' or $pagina=='LiveJasmin' or $pagina=='Bonga' or $pagina=='Cam4' or $pagina=='Camsoda' or $pagina=='Flirt4free'){

	if($pagina=='Streamate'){
		$sqlQuery = "SELECT SUM(tokens) as tokens, SUM(ganancia) as dolares, fecha_desde, fecha_hasta FROM streamate GROUP BY fecha_desde";	
	}

	if($pagina=='Myfreecams'){
		$sqlQuery = "SELECT SUM(tokens) as tokens, SUM(dolares) as dolares, fecha_desde, fecha_hasta FROM myfreecams GROUP BY fecha_desde";	
	}

	if($pagina=='LiveJasmin'){
		$sqlQuery = "SELECT SUM(tokens) as tokens, SUM(dolares) as dolares, fecha_desde, fecha_hasta FROM livejasmin GROUP BY fecha_desde";	
	}

	if($pagina=='Bonga'){
		$sqlQuery = "SELECT SUM(tokens) as tokens, SUM(dolares) as dolares, fecha_desde, fecha_hasta FROM bonga GROUP BY fecha_desde";	
	}

	if($pagina=='Cam4'){
		$sqlQuery = "SELECT SUM(tokens) as tokens, SUM(dolares) as dolares, fecha_desde, fecha_hasta FROM cam4 GROUP BY fecha_desde";	
	}

	if($pagina=='Camsoda'){
		$sqlQuery = "SELECT SUM(tokens) as tokens, SUM(dolares) as dolares, fecha_desde, fecha_hasta FROM camsoda GROUP BY fecha_desde";	
	}

	if($pagina=='Flirt4free'){
		$sqlQuery = "SELECT SUM(tokens) as tokens, SUM(dolares) as dolares, fecha_desde, fecha_hasta FROM flirt4free GROUP BY fecha_desde";	
	}


	$result = mysqli_query($conexion,$sqlQuery);

	$data = array();

	$contador1 = 0;

	while($row1 = mysqli_fetch_array($result)) {
		if($moneda=='Dolares'){
			$total[$contador1] = round($row1['dolares'],2);
		}
		if($moneda=='Pesos'){
			$total[$contador1] = round($row1['dolares']*$trm,2);
		}
		if($moneda=='Tokens'){
			$total[$contador1] = $row1['tokens']*1;
		}
		$fecha_desde[$contador1] = $row1['fecha_desde'];
		$fecha_hasta[$contador1] = $row1['fecha_hasta'];
		$data[] = array("total"=>$total[$contador1], "desde" => $fecha_desde[$contador1], "hasta" => $fecha_hasta[$contador1]);
		$contador1 = $contador1 + 1;
	}
}


echo json_encode($data);



?>