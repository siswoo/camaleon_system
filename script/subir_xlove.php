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
$fecha_inicio = date('Y-m-d h-i-s');
$year = date('Y');
$fecha_desde_XLove = $_POST['fecha_desde_XLove'];
$fecha_hasta_XLove = $_POST['fecha_hasta_XLove'];
$coste_euro_XLove = $_POST['coste_euro_XLove'];
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

$limite = 1000;

$sql1 = "DELETE FROM xlove WHERE fecha_desde BETWEEN '".$fecha_desde_XLove."' AND '".$fecha_hasta_XLove."' and fecha_hasta BETWEEN '".$fecha_desde_XLove."' AND '".$fecha_hasta_XLove."'";
$eliminar1 = mysqli_query($conexion,$sql1);

/*
for($i=2;$i<=$limite;$i++){
    if($worksheet->getCell('A'.$i) != ""){
        $nickname = $worksheet->getCell('A'.$i);
        $Amount = $worksheet->getCell('E'.$i);
        $Amount_separado = explode("\n", $Amount);
        $Amount_final = $Amount_separado[0];
        $fecha_inicio = $fecha_inicio;
        $calculo_dolares = $coste_euro_XLove*$Amount_final;
        $calculo_tokens = $calculo_dolares/0.05;
        
        $sql2 = "INSERT INTO xlove (nickname, amount, dolares, tokens, fecha_desde, fecha_hasta, responsable, fecha_inicio) VALUES ('$nickname','$Amount_final','$calculo_dolares','$calculo_tokens','$fecha_desde_XLove','$fecha_hasta_XLove','$responsable','$fecha_inicio')";
        $guardar1 = mysqli_query($conexion,$sql2);
    }
}
*/

/*
for($i=2;$i<=$limite;$i++){
    if($worksheet->getCell('A'.$i) != ""){
        $nickname = $worksheet->getCell('A'.$i);
        $Amount = $worksheet->getCell('I'.$i);
        $Amount_separado = explode("\n", $Amount);
        $Amount_final = $Amount_separado[0];
        $fecha_inicio = $fecha_inicio;
        $calculo_dolares = $coste_euro_XLove*$Amount_final;
        $calculo_tokens = $calculo_dolares/0.05;

        $sql2 = "INSERT INTO xlove (nickname, amount, dolares, tokens, fecha_desde, fecha_hasta, responsable, fecha_inicio) VALUES ('$nickname','$Amount_final','$calculo_dolares','$calculo_tokens','$fecha_desde_XLove','$fecha_hasta_XLove','$responsable','$fecha_inicio')";
        $guardar1 = mysqli_query($conexion,$sql2);
    }
}
*/

/*  
for($i=2;$i<=$limite;$i++){
    if($worksheet->getCell('A'.$i) != ""){
        $nickname = $worksheet->getCell('A'.$i);
        $Amount = $worksheet->getCell('E'.$i);
        $Amount_separado = explode("\n", $Amount);
        $Amount_final = $Amount_separado[0];
        $fecha_inicio = $fecha_inicio;
        $calculo_dolares = $coste_euro_XLove*$Amount_final;
        $calculo_tokens = $calculo_dolares/0.05;

        $sql2 = "INSERT INTO xlove (nickname, amount, dolares, tokens, fecha_desde, fecha_hasta, responsable, fecha_inicio) VALUES ('$nickname','$Amount_final','$calculo_dolares','$calculo_tokens','$fecha_desde_XLove','$fecha_hasta_XLove','$responsable','$fecha_inicio')";
        $guardar1 = mysqli_query($conexion,$sql2);
    }
}
*/

for($i=2;$i<=$limite;$i++){
    if($worksheet->getCell('A'.$i) != ""){
        $nickname = $worksheet->getCell('A'.$i);
        $Amount = $worksheet->getCell('I'.$i);
        //$Amount_separado = explode("\n", $Amount);
        //$Amount_final = $Amount_separado[0];
        $Amount_final = str_replace(".", ",", $Amount);
        $fecha_inicio = $fecha_inicio;
        $calculo_dolares = $coste_euro_XLove*$Amount_final;
        $calculo_tokens = $calculo_dolares/0.05;

        $sql2 = "INSERT INTO xlove (nickname, amount, dolares, tokens, fecha_desde, fecha_hasta, responsable, fecha_inicio) VALUES ('$nickname','$Amount_final','$calculo_dolares','$calculo_tokens','$fecha_desde_XLove','$fecha_hasta_XLove','$responsable','$fecha_inicio')";
        $guardar1 = mysqli_query($conexion,$sql2);
    }
}

echo "Correcto";

?>