<?php
session_start();
include('conexion.php');
$fecha_inicio = date('Y-m-d');
$responsable = $_SESSION['id'];
$pagina = $_POST['select_graficos1'];

if($pagina=='XLove'){
	$sql1 = "SELECT DISTINCT mes, year FROM xlove";
	$registro1 = mysqli_query($conexion,$sql1);
	$contador1 = 0;
	while($row1 = mysqli_fetch_array($registro1)) {
		/*
		if($row1['recorte']==1){
			$desde_sql = '01';
			$hasta_sql = '15';
		}else{
			$desde_sql = '16';
			$hasta_sql = '31';
		}
		$desde_array[$contador1] = $desde_sql;
		$hasta_array[$contador1] = $hasta_sql;
		/*
		$mes_array[$contador1] = $row1['mes'];
		$year_array[$contador1] = $row1['year'];
		*/
		$fecha_array[$contador1] = $row1['mes']."-".$row1['year'];
		$contador1 = $contador1 + 1;

		//select mes, SUM(tokens) as Tokens from xlove GROUP BY recorte,mes,year

	}

		$sql3 = "SELECT mes, SUM(tokens) as tokens from xlove GROUP BY mes,year";
		$registro3 = mysqli_query($conexion,$sql3);
		$contador2 = 0;
		while($row3 = mysqli_fetch_array($registro3)) {
			$tokens_array[$contador2] = $row3['tokens'];
			$contador2 = $contador2 + 1;
		}

	/*
	$desde_array = implode(',',$desde_array);
	$hasta_array = implode(',',$hasta_array);
	$meses = implode(',',$mes_array);
	$years = implode(',',$year_array);
	*/
	$fechas = implode("','",$fecha_array);
	$tokens = implode(',',$tokens_array);



}

$datos = [
	//"fechas"	=>	$fechas,
	"fechas" => $fecha_array,
	//"meses"		=>	$meses,
	//"years"		=>	$years,
	//"tokens"		=>	$tokens,
	"tokens"		=>	$tokens_array,
];

echo json_encode($datos);

?>