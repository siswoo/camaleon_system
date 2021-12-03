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

$limite = 10000;

$total1 = 0;

$sql1 = "DELETE FROM stripchat WHERE fecha = '".$fecha_stripchat."'";
$eliminar1 = mysqli_query($conexion,$sql1);
for($i=1;$i<=$limite;$i++){

    /*
    if($i==1){
        echo $nickname = $worksheet->getCell('A'.$i);
        echo '
        ';
    }else{
        $i = $i +13;
        echo $nickname = $worksheet->getCell('A'.$i);
        echo '
        ';
    }
    */

    if($i==1){
        if($worksheet->getCell('A'.$i) != ""){
            $nickname = $worksheet->getCell('A'.$i);
            $j = 14;
            $tokens = $worksheet->getCell('A'.$j);
            //$tokens = str_replace(".", "", $tokens);
            $fecha_inicio = $fecha_inicio;
            $limpiar = 0;

            $detectar1 = substr($nickname,0,1);
            if($detectar1=='1' or $detectar1=='2' or $detectar1=='3' or $detectar1=='4' or $detectar1=='5' or $detectar1=='6' or $detectar1=='7' or $detectar1=='8' or $detectar1=='9' or $detectar1=='0'){
                $limpiar = 1;
                $detectar2 = substr($nickname,1,1);
                if($detectar2=='1' or $detectar2=='2' or $detectar2=='3' or $detectar2=='4' or $detectar2=='5' or $detectar2=='6' or $detectar2=='7' or $detectar2=='8' or $detectar2=='9' or $detectar2=='0'){
                    $limpiar = 2;
                }
            }

            if($limpiar>=1){
                $nickname = substr($nickname,$limpiar);
            }
            
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
    }else{
        $i = $i+13;
        if($worksheet->getCell('A'.$i) != ""){
            $nickname = $worksheet->getCell('A'.$i);
            $j = $i+13;
            $tokens = $worksheet->getCell('A'.$j);
            /*
            $cantidad_tokens = strlen($tokens);
            if($cantidad_tokens>=6){
                $tokens = str_replace(".", "", $tokens);    
            }
            */
            
            $fecha_inicio = $fecha_inicio;
            $limpiar = 0;

            $detectar1 = substr($nickname,0,1);

            if($detectar1=='1' or $detectar1=='2' or $detectar1=='3' or $detectar1=='4' or $detectar1=='5' or $detectar1=='6' or $detectar1=='7' or $detectar1=='8' or $detectar1=='9' or $detectar1=='0'){
                $limpiar = 1;
                $detectar2 = substr($nickname,1,1);
                if($detectar2=='1' or $detectar2=='2' or $detectar2=='3' or $detectar2=='4' or $detectar2=='5' or $detectar2=='6' or $detectar2=='7' or $detectar2=='8' or $detectar2=='9' or $detectar2=='0'){
                    $limpiar = 2;
                }

                $detectar3 = substr($nickname,2,1);
                if($detectar3=='1' or $detectar3=='2' or $detectar3=='3' or $detectar3=='4' or $detectar3=='5' or $detectar3=='6' or $detectar3=='7' or $detectar3=='8' or $detectar3=='9' or $detectar3=='0'){
                    $limpiar = 3;
                }

            }

            if($nickname!='6869bulma'){
                if($limpiar>=1){
                    $nickname = substr($nickname,$limpiar);
                }
            }else{
                $nickname = '69bulma';
            }
            
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
}

echo "Correcto";

?>