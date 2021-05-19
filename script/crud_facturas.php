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

	$limite = 2000;

	$cuenta = $worksheet->getCell('B10');
	$fecha_desde = $worksheet->getCell('B11');
	$fecha_hasta = $worksheet->getCell('B12');

	$fecha_desde = explode('-',$fecha_desde);
	$fecha_desde =  $fecha_desde[2].$fecha_desde[1].$fecha_desde[0];

	$fecha_hasta = explode('-',$fecha_hasta);
	$fecha_hasta =  $fecha_hasta[2].$fecha_hasta[1].$fecha_hasta[0];

	for($i=15;$i<=$limite;$i++){
        if($worksheet->getCell('A'.$i) != ""){
            $fecha_operacion = $worksheet->getCell('A'.$i);
            $fecha_valor = $worksheet->getCell('B'.$i);
            $codigo = $worksheet->getCell('C'.$i);
            $observaciones = $worksheet->getCell('D'.$i);
            $concepto = $worksheet->getCell('E'.$i);
            $numero_movimiento = $worksheet->getCell('F'.$i);
            $importe = $worksheet->getCell('G'.$i);
            //$ganancia = $worksheet->getCell('A'.$j)->getValue();

            $fecha_operacion = explode('-',$fecha_operacion);
			$fecha_operacion =  $fecha_operacion[2].$fecha_operacion[1].$fecha_operacion[0];

			$fecha_valor = explode('-',$fecha_valor);
			$fecha_valor =  $fecha_valor[2].$fecha_valor[1].$fecha_valor[0];
            
            $sql2 = "INSERT INTO facturas1 (cuenta,fecha_desde,fecha_hasta,fecha_operacion,fecha_valor,codigo,observaciones,concepto,numero_movimiento,importe,detalle,fecha_inicio) VALUES ('$cuenta','$fecha_desde','$fecha_hasta','$fecha_operacion','$fecha_valor','$codigo','$observaciones','$concepto','$numero_movimiento','$importe','$detalle','$fecha_inicio')";
            $guardar1 = mysqli_query($conexion,$sql2);
        }
    }

    $datos = [
		"estatus" => "ok",
	];
	echo json_encode($datos);

}

if($condicion=='subir2'){
	$id = $_POST["id"];
	$archivo_nombre = $_FILES['file']['name'];
	$archivo_temporal = $_FILES['file']['tmp_name'];

	$extension = explode(".", $archivo_nombre);
	$extension = $extension[count($extension)-1];

	if(file_exists('../resources/documentos/facturas1/'.$id)){}else{
    	mkdir('../resources/documentos/facturas1/'.$id, 0777);
	}

	if($extension!='pdf' and $extension!='csv' and $extension!='xlsx' and $extension!='xlsxs'){
	    $datos = [
			"estatus" => "error",
		];
		echo json_encode($datos);
	    exit;
	}else{
		$sql1 = "UPDATE facturas1 SET soporte1 = 1, extension = '".$extension."' WHERE id = ".$id;
		$proceso1 = mysqli_query($conexion,$sql1);
		$location = '../resources/documentos/facturas1/'.$id.'/';
		$nombre_final = "soporte1";
		@unlink($location.$nombre_final.'.'.$extension);
		move_uploaded_file ($_FILES['file']['tmp_name'],$location.$nombre_final.'.'.$extension);
		$datos = [
			"estatus" => "ok",
		];
		echo json_encode($datos);
	    exit;
	}
}


if($condicion=='eliminar1'){
	$id = $_POST["id"];
	$sql1 = "DELETE FROM facturas1 WHERE id =".$id;
	$proceso1 = mysqli_query($conexion,$sql1);
	$datos = [
		"estatus" => "ok",
	];
	echo json_encode($datos);
}
?>