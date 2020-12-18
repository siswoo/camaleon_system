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

$sql2 = "DELETE FROM medellin_temporal1";
$eliminar1 = mysqli_query($conexion,$sql2);

for($i=3;$i<=$limite;$i++){
    if($worksheet->getCell('C'.$i)!=''){
        $documento = $worksheet->getCell('C'.$i)->getValue();

        $sql1 = "INSERT INTO medellin_temporal1 (documento,fecha_inicio) VALUES ('$documento','$fecha_inicio')";
        $registro1 = mysqli_query($conexion,$sql1);
    }
}

echo 'Correcto';

?>