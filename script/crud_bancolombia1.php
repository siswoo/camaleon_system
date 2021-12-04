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
$fecha_creacion = date("Y-m-d");
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
            $referencia = $worksheet->getCell('A'.$i);
            $concepto = $worksheet->getCell('B'.$i);
            $valor = $worksheet->getCell('C'.$i);

            $valor = str_replace('.','',$valor);
            $valor = str_replace(',','.',$valor);

            $sql1 = "INSERT INTO bancolombia1 (referencia,concepto,valor,fecha_creacion,responsable) VALUES ('$referencia','$concepto',$valor,'$fecha_creacion','$responsable')";
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

	if(file_exists('../resources/documentos/bancolombia1/'.$id)){}else{
    	mkdir('../resources/documentos/bancolombia1/'.$id, 0777);
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
		$location = '../resources/documentos/bancolombia1/'.$id.'/';
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