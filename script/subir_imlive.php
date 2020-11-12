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
$fecha_Imlive = $_POST['fecha_Imlive'];

$archivo_nombre = $_FILES['file']['name'];
$archivo_temporal = $_FILES['file']['tmp_name'];

$extension = explode(".", $archivo_nombre);
$extension = $extension[count($extension)-1];

if($extension!='xls' and $extension!='xml' and $extension!='xlam'){
    echo 'error';
    exit;
}

$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($archivo_temporal);
$worksheet = $spreadsheet->getActiveSheet();

$limite = 1000;

for($i=2;$i<=$limite;$i++){
    $imagen = $worksheet->getCell('B'.$i);
    $username = $worksheet->getCell('C'.$i);
    $status = utf8_decode($worksheet->getCell('D'.$i));
    $date_approved = utf8_decode($worksheet->getCell('E'.$i));
    $room = utf8_decode($worksheet->getCell('F'.$i));
    $last = $worksheet->getCell('G'.$i);
    $total_earnings = $worksheet->getCell('H'.$i);
    $hostname = $worksheet->getCell('I'.$i);
    $fechasql = $fecha_inicio;
}

echo $username;

?>