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
$fecha = $_POST['fecha_Cam4'];

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

$sql1 = "DELETE FROM cam4 WHERE fecha_desde BETWEEN '".$fecha."' AND '".$fecha."' and fecha_hasta BETWEEN '".$fecha."' AND '".$fecha."'";
$eliminar1 = mysqli_query($conexion,$sql1);
for($i=2;$i<=$limite;$i++){

    if($i==2){
        if($worksheet->getCell('A'.$i) != ""){
            //$id_nickname = $worksheet->getCell('A'.$i);
            $nickname = $worksheet->getCell('A'.$i);
            $j = $i+2;
            $ganancia = $worksheet->getCell('A'.$j)->getValue();
            $ganancia = floatval($ganancia);

            /*
            $ganancia = explode('$',$ganancia);
            $ganancia_final = $ganancia[1];
            */
            $tokens = $ganancia/0.05;
            
            $sql2 = "INSERT INTO cam4 (nickname, dolares, tokens, fecha_desde, fecha_hasta, responsable, fecha_inicio) VALUES ('$nickname','$ganancia','$tokens','$fecha','$fecha','$responsable','$fecha_inicio')";
            $guardar1 = mysqli_query($conexion,$sql2);
            
        }
    }else{
        if($worksheet->getCell('A'.$i) != ""){
            $nickname = $worksheet->getCell('A'.$i);
            $j = $i+2;
            $ganancia = $worksheet->getCell('A'.$j)->getValue();
            $ganancia = floatval($ganancia);

            $tokens = $ganancia/0.05;

            $sql2 = "INSERT INTO cam4 (nickname, dolares, tokens, fecha_desde, fecha_hasta, responsable, fecha_inicio) VALUES ('$nickname','$ganancia','$tokens','$fecha','$fecha','$responsable','$fecha_inicio')";
            $guardar1 = mysqli_query($conexion,$sql2);

        }
    }
    $i = $i+3;
}

echo "Correcto";

?>