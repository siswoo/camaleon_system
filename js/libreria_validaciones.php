<?php
$condicion = $_POST['condicion'];

if($condicion=='espacios1'){
	$valor1 = $_POST['valor1'];
	$valor2 = $_POST['valor2'];
	$valor3 = $_POST['valor3'];
	$status = 'ok';
	$patron = '/^[a-zA-Z, ]*$/';
	if($valor1!=''){
        if(preg_match($patron,$valor1)){
        	$status = 'error';
        }
	}

	if($valor2!=''){
		if(preg_match($patron,$valor2)){
        	$status = 'error';
        }
	}

	if($valor3!=''){
		if(preg_match($patron,$valor3)){
        	$status = 'error';
        }
	}

	if($status=='error'){
		$valor1 = str_replace(' ', '', $valor1);
		$valor2 = str_replace(' ', '', $valor2);
		$valor3 = str_replace(' ', '', $valor3);
		$status = 'ok';
	}

	$datos = [
		"status" => $status,
		"valor1" => $valor1,
		"valor2" => $valor2,
		"valor3" => $valor3,
	];

	echo json_encode($datos);
}

if($condicion=='espacios2'){
	$valor1 = $_POST['valor1'];
	$valor2 = $_POST['valor2'];
	$valor3 = $_POST['valor3'];
	$status = 'ok';

	$valor1 = trim($valor1);
	$valor2 = trim($valor2);
	$valor3 = trim($valor3);
	$status = 'ok';
	
	$datos = [
		"status" => $status,
		"valor1" => $valor1,
		"valor2" => $valor2,
		"valor3" => $valor3,
	];

	echo json_encode($datos);
}
?>