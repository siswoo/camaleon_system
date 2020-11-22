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
$fecha_desde_Imlive = $_POST['fecha_desde_Imlive'];
$fecha_hasta_Imlive = $_POST['fecha_hasta_Imlive'];
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

$sql2 = "DELETE FROM imlive WHERE fecha_desde BETWEEN '".$fecha_desde_Imlive."' AND '".$fecha_hasta_Imlive."' and fecha_hasta BETWEEN '".$fecha_desde_Imlive."' AND '".$fecha_hasta_Imlive."'";
$eliminar1 = mysqli_query($conexion,$sql2);

for($i=2;$i<=$limite;$i++){
    if($worksheet->getCell('A'.$i)!=''){
        $username = $worksheet->getCell('A'.$i);
        $total = $worksheet->getCell('B'.$i);
        if($total=='0'){
            $total = 0;
            $tokens = 0;
        }else{
            $ganancia = explode('$',$total);
            $total = $ganancia[1];
            $tokens = $total/0.05;
        }
        $fecha_inicio = $fecha_inicio;

        $sql1 = "INSERT INTO imlive (nickname,dolares,tokens,responsable,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$username','$total','$tokens','$responsable','$fecha_desde_Imlive','$fecha_hasta_Imlive','$fecha_inicio')";
        $registro1 = mysqli_query($conexion,$sql1);
    }
}

echo 'Correcto';

?>