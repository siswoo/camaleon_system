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
$fecha_chaturbate = $_POST['fecha_chaturbate'];
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

$sql1 = "DELETE FROM chaturbate WHERE fecha = '".$fecha_chaturbate."'";
$eliminar1 = mysqli_query($conexion,$sql1);
for($i=2;$i<=$limite;$i++){
    if($worksheet->getCell('A'.$i) != ""){
        $nickname = $worksheet->getCell('A'.$i);
        $tokens = $worksheet->getCell('B'.$i);
        $payout = $worksheet->getCell('C'.$i);
        $payout = explode("$", $payout);
        $payout = $payout[1];
        $fecha_inicio = $fecha_inicio;
        
        $sql2 = "INSERT INTO chaturbate (nickname, tokens, payout, fecha, responsable, fecha_inicio) VALUES ('$nickname','$tokens','$payout','$fecha_chaturbate','$responsable','$fecha_inicio')";
        $guardar1 = mysqli_query($conexion,$sql2);
    }
}

echo "Correcto";

?>