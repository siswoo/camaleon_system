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
$fecha_desde = $_POST['fecha_desde'];
$fecha_hasta = $_POST['fecha_hasta'];

$fecha_inicio = date('Y-m-d');
$responsable = $_SESSION['id'];

$archivo_nombre = $_FILES['file']['name'];
$archivo_temporal = $_FILES['file']['tmp_name'];

$extension = explode(".", $archivo_nombre);
$extension = $extension[count($extension)-1];

if($extension!='xls' and $extension!='xml' and $extension!='xlam' and $extension!='xlsx'){
    echo 'error';
    exit;
}

$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($archivo_temporal);
$worksheet = $spreadsheet->getActiveSheet();

$limite = 2000;

$total1 = 0;

$sql1 = "DELETE FROM bonga WHERE fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
$eliminar1 = mysqli_query($conexion,$sql1);
for($i=2;$i<=$limite;$i++){
    if($worksheet->getCell('A'.$i) != ""){
        $nickname = $worksheet->getCell('B'.$i);
        $tokens = $worksheet->getCell('D'.$i)->getValue();
        $tokens = intval($tokens);
        $dolares = $worksheet->getCell('E'.$i)->getValue();
        $dolares = floatval($dolares);
            
        $sql2 = "INSERT INTO bonga (nickname, dolares, tokens, fecha_desde, fecha_hasta, responsable, fecha_inicio) VALUES ('$nickname','$dolares','$tokens','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
        $guardar1 = mysqli_query($conexion,$sql2);
            
    }
}

echo "Correcto";

?>