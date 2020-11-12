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
$fecha_streamate = $_POST['fecha_streamate'];
$fecha_streamate = explode('-',$fecha_streamate);
$year = $fecha_streamate[0];
$semana = $fecha_streamate[1];

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

$total1 = 0;

$sql1 = "DELETE FROM streamate WHERE year = '".$year."' and semana = '".$semana."'";
$eliminar1 = mysqli_query($conexion,$sql1);
for($i=2;$i<=$limite;$i++){
    if($worksheet->getCell('A'.$i) != ""){
        $id_nickname = $worksheet->getCell('A'.$i);
        $nickname = $worksheet->getCell('B'.$i);
        $ganancia = $worksheet->getCell('H'.$i);
        $ganancia = explode('$',$ganancia);
        $ganancia_final = $ganancia[1];
        $fecha_inicio = $fecha_inicio;
        $tokens = $ganancia_final/0.05;

        $sql2 = "INSERT INTO streamate (id_nickname, nickname, ganancia, tokens, semana, year, responsable, fecha_inicio) VALUES ('$id_nickname','$nickname','$ganancia_final','$tokens','$semana','$year','$responsable','$fecha_inicio')";
        $guardar1 = mysqli_query($conexion,$sql2);
    }
}

echo "Correcto";

?>