<?php
include('conexion.php');
session_start();
require '../resources/Spreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
$fecha_inicio = date("Y-m-d");
$responsable = $_SESSION["id"];
$condicion = $_POST['condicion'];

if($condicion=='subir1'){
	$detalle = $_POST["detalle"];
	$archivo_nombre = $_FILES['file']['name'];
	$archivo_temporal = $_FILES['file']['tmp_name'];

	$extension = explode(".", $archivo_nombre);
	$extension = $extension[count($extension)-1];

	if($extension!='xls' and $extension!='xml' and $extension!='xlam' and $extension!='xlsx'){
	    $datos = [
			"estatus" => "error",
		];
		echo json_encode($datos);
	    exit;
	}

	$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($archivo_temporal);
	$worksheet = $spreadsheet->getActiveSheet();

	$limite = 500;

	for($i=2;$i<=$limite;$i++){
        if($worksheet->getCell('A'.$i) != ""){
            $empresa = $worksheet->getCell('A'.$i);
            $referencia = $worksheet->getCell('B'.$i);
            $fecha = $worksheet->getCell('C'.$i);
            $resultado = $worksheet->getCell('D'.$i);

            $fecha = explode('/',$fecha);
			$fecha =  $fecha[2].$fecha[1].$fecha[0];

			$valor = $worksheet->getCell('E'.$i);

            $sql1 = "INSERT INTO bancolombia1 (empresa,referencia,fecha,resultado,valor,fecha_inicio) VALUES ('$empresa','$referencia','$fecha','$resultado',$valor,'$fecha_inicio')";
            $proceso1 = mysqli_query($conexion,$sql1);
        }
    }

    $datos = [
		"estatus" => "ok",
		"sql" => $sql1,
	];

	echo json_encode($datos);

}

if($condicion=='subir2'){
	$id = $_POST["id"];
	$archivo_nombre = $_FILES['file']['name'];
	$archivo_temporal = $_FILES['file']['tmp_name'];

	$extension = explode(".", $archivo_nombre);
	$extension = $extension[count($extension)-1];

	if(file_exists('../resources/documentos/bancolombia/'.$id)){}else{
    	mkdir('../resources/documentos/bancolombia/'.$id, 0777);
	}

	if($extension!='pdf'){
	    $datos = [
			"estatus" => "error",
		];
		echo json_encode($datos);
	    exit;
	}else{
		$sql1 = "UPDATE bancolombia1 SET soporte = 1 WHERE id = ".$id;
		$proceso1 = mysqli_query($conexion,$sql1);
		$location = '../resources/documentos/bancolombia/'.$id.'/';
		$nombre_final = "soporte";
		@unlink($location.$nombre_final.'.'.$extension);
		move_uploaded_file ($_FILES['file']['tmp_name'],$location.$nombre_final.'.pdf');
		$datos = [
			"estatus" => "ok",
		];
		echo json_encode($datos);
	    exit;
	}
}


if($condicion=='eliminar1'){
	$id = $_POST["id"];
	$sql1 = "DELETE FROM bancolombia1 WHERE id =".$id;
	$proceso1 = mysqli_query($conexion,$sql1);
	$datos = [
		"estatus" => "ok",
	];
	echo json_encode($datos);
}
?>