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
$fecha_stripchat = $_POST['fecha_stripchat'];
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

$sql1 = "DELETE FROM stripchat WHERE fecha = '".$fecha_stripchat."'";
$eliminar1 = mysqli_query($conexion,$sql1);
for($i=2;$i<=$limite;$i++){
    if($worksheet->getCell('A'.$i) != ""){
        $nickname = $worksheet->getCell('B'.$i);
        $tokens = $worksheet->getCell('O'.$i);
        $fecha_inicio = $fecha_inicio;

        $sql2 = "INSERT INTO stripchat (nickname, tokens, fecha, responsable, fecha_inicio) VALUES ('$nickname','$tokens','$fecha_stripchat','$responsable','$fecha_inicio')";
        $guardar1 = mysqli_query($conexion,$sql2);
        
        $id_stripchat = mysqli_insert_id($conexion);

        $sql3 = "SELECT * FROM stripchat WHERE id = ".$id_stripchat;
        $consulta1 = mysqli_query($conexion,$sql3);
        while($row1 = mysqli_fetch_array($consulta1)) {
        	$tokens_consulta = $row1['tokens'];
        }

        $calculo_dolares = $tokens_consulta*0.05;

        $sql4 = "UPDATE stripchat SET dolares = ".$calculo_dolares." WHERE id = ".$id_stripchat;
        $modificar1 = mysqli_query($conexion,$sql4);
    }
}

echo "Correcto";

?>