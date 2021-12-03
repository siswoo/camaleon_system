<?php
session_start();
include('conexion.php');
require '../resources/Spreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
$fecha_inicio = date('Y-m-d');
$responsable = $_SESSION['id'];

$archivo_nombre = $_FILES['file']['name'];
$archivo_temporal = $_FILES['file']['tmp_name'];

$extension = explode(".", $archivo_nombre);
$extension = $extension[count($extension)-1];

$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($archivo_temporal);
$worksheet = $spreadsheet->getActiveSheet();

$limite = 5000;

/*
$sql2 = "DELETE FROM medellin_temporal1";
$eliminar1 = mysqli_query($conexion,$sql2);
*/

for($i=3;$i<=$limite;$i++){
    if($worksheet->getCell('C'.$i)!=''){
        $auto_numerico = $worksheet->getCell('A'.$i)->getValue();
        $tipo_identificacion = $worksheet->getCell('B'.$i)->getValue();
        $documento = $worksheet->getCell('C'.$i)->getValue();
        $primer_nombre = $worksheet->getCell('G'.$i)->getValue();
        $segundo_nombre = $worksheet->getCell('H'.$i)->getValue();
        $primer_apellido = $worksheet->getCell('I'.$i)->getValue();
        $segundo_apellido = $worksheet->getCell('J'.$i)->getValue();

        if($tipo_identificacion!='NIT'){
        	$nombre = $primer_nombre." ".$segundo_nombre." ".$primer_apellido." ".$segundo_apellido;
	        $sql1 = "INSERT INTO medellin_temporal1 (nombre,identificacion,auto_numerico,tipo_identificacion,responsable,fecha_inicio) VALUES ('$nombre','$documento','$auto_numerico','$tipo_identificacion','$responsable','$fecha_inicio')";
	        $registro1 = mysqli_query($conexion,$sql1);
        }

    }
}

echo 'Correcto';

?>