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
$fecha_desde = $_POST['fecha_desde_subir_extras'];
$fecha_hasta = $_POST['fecha_hasta_subir_extras'];
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

$limite = 1000;

for($i=3;$i<=$limite;$i++){
    if($worksheet->getCell('B'.$i)!=''){
        $fecha = $worksheet->getCell('B'.$i);
        $motivo = $worksheet->getCell('C'.$i);
        $valor = $worksheet->getCell('E'.$i);
        $identificacion = $worksheet->getCell('F'.$i);

        if($identificacion!=''){
            if($i>=3 and $i<=21){
                $sql1 = "SELECT * FROM modelos WHERE documento_numero = ".$identificacion;
                $consulta1 = mysqli_query($conexion,$sql1);
                while($row1 = mysqli_fetch_array($consulta1)) {
                    $id_modelo = $row1['id'];
                    $fecha_desde = '2020-12-16';
                    $fecha_hasta = '2020-12-16';
                    $sql2 = "INSERT INTO multas (id_modelo,concepto,valor,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ('$id_modelo','$motivo','$valor','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                    $consulta2 = mysqli_query($conexion,$sql2);
                }
            }
            if($i>=22 and $i<=38){
                $sql1 = "SELECT * FROM modelos WHERE documento_numero = ".$identificacion;
                $consulta1 = mysqli_query($conexion,$sql1);
                while($row1 = mysqli_fetch_array($consulta1)) {
                    $id_modelo = $row1['id'];
                    $fecha_desde = '2020-12-17';
                    $fecha_hasta = '2020-12-17';
                    $sql2 = "INSERT INTO multas (id_modelo,concepto,valor,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ('$id_modelo','$motivo','$valor','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                    $consulta2 = mysqli_query($conexion,$sql2);
                }
            }
            if($i>=39 and $i<=44){
                $sql1 = "SELECT * FROM modelos WHERE documento_numero = ".$identificacion;
                $consulta1 = mysqli_query($conexion,$sql1);
                while($row1 = mysqli_fetch_array($consulta1)) {
                    $id_modelo = $row1['id'];
                    $fecha_desde = '2020-12-18';
                    $fecha_hasta = '2020-12-18';
                    $sql2 = "INSERT INTO multas (id_modelo,concepto,valor,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ('$id_modelo','$motivo','$valor','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                    $consulta2 = mysqli_query($conexion,$sql2);
                }
            }
            if($i>=45 and $i<=70){
                $sql1 = "SELECT * FROM modelos WHERE documento_numero = ".$identificacion;
                $consulta1 = mysqli_query($conexion,$sql1);
                while($row1 = mysqli_fetch_array($consulta1)) {
                    $id_modelo = $row1['id'];
                    $fecha_desde = '2020-12-19';
                    $fecha_hasta = '2020-12-19';
                    $sql2 = "INSERT INTO multas (id_modelo,concepto,valor,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ('$id_modelo','$motivo','$valor','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                    $consulta2 = mysqli_query($conexion,$sql2);
                }
            }
            if($i>=71 and $i<=82){
                $sql1 = "SELECT * FROM modelos WHERE documento_numero = ".$identificacion;
                $consulta1 = mysqli_query($conexion,$sql1);
                while($row1 = mysqli_fetch_array($consulta1)) {
                    $id_modelo = $row1['id'];
                    $fecha_desde = '2020-12-21';
                    $fecha_hasta = '2020-12-21';
                    $sql2 = "INSERT INTO multas (id_modelo,concepto,valor,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ('$id_modelo','$motivo','$valor','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                    $consulta2 = mysqli_query($conexion,$sql2);
                }
            }
            if($i>=83 and $i<=96){
                $sql1 = "SELECT * FROM modelos WHERE documento_numero = ".$identificacion;
                $consulta1 = mysqli_query($conexion,$sql1);
                while($row1 = mysqli_fetch_array($consulta1)) {
                    $id_modelo = $row1['id'];
                    $fecha_desde = '2020-12-22';
                    $fecha_hasta = '2020-12-22';
                    $sql2 = "INSERT INTO multas (id_modelo,concepto,valor,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ('$id_modelo','$motivo','$valor','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                    $consulta2 = mysqli_query($conexion,$sql2);
                }
            }
            if($i>=97 and $i<=107){
                $sql1 = "SELECT * FROM modelos WHERE documento_numero = ".$identificacion;
                $consulta1 = mysqli_query($conexion,$sql1);
                while($row1 = mysqli_fetch_array($consulta1)) {
                    $id_modelo = $row1['id'];
                    $fecha_desde = '2020-12-23';
                    $fecha_hasta = '2020-12-23';
                    $sql2 = "INSERT INTO multas (id_modelo,concepto,valor,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ('$id_modelo','$motivo','$valor','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                    $consulta2 = mysqli_query($conexion,$sql2);
                }
            }
            if($i>=108 and $i<=109){
                $sql1 = "SELECT * FROM modelos WHERE documento_numero = ".$identificacion;
                $consulta1 = mysqli_query($conexion,$sql1);
                while($row1 = mysqli_fetch_array($consulta1)) {
                    $id_modelo = $row1['id'];
                    $fecha_desde = '2020-12-24';
                    $fecha_hasta = '2020-12-24';
                    $sql2 = "INSERT INTO multas (id_modelo,concepto,valor,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ('$id_modelo','$motivo','$valor','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                    $consulta2 = mysqli_query($conexion,$sql2);
                }
            }
            if($i>=110 and $i<=148){
                $sql1 = "SELECT * FROM modelos WHERE documento_numero = ".$identificacion;
                $consulta1 = mysqli_query($conexion,$sql1);
                while($row1 = mysqli_fetch_array($consulta1)) {
                    $id_modelo = $row1['id'];
                    $fecha_desde = '2020-12-26';
                    $fecha_hasta = '2020-12-26';
                    $sql2 = "INSERT INTO multas (id_modelo,concepto,valor,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ('$id_modelo','$motivo','$valor','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                    $consulta2 = mysqli_query($conexion,$sql2);
                }
            }
            if($i>=149 and $i<=157){
                $sql1 = "SELECT * FROM modelos WHERE documento_numero = ".$identificacion;
                $consulta1 = mysqli_query($conexion,$sql1);
                while($row1 = mysqli_fetch_array($consulta1)) {
                    $id_modelo = $row1['id'];
                    $fecha_desde = '2020-12-28';
                    $fecha_hasta = '2020-12-28';
                    $sql2 = "INSERT INTO multas (id_modelo,concepto,valor,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ('$id_modelo','$motivo','$valor','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                    $consulta2 = mysqli_query($conexion,$sql2);
                }
            }
            if($i>=158 and $i<=170){
                $sql1 = "SELECT * FROM modelos WHERE documento_numero = ".$identificacion;
                $consulta1 = mysqli_query($conexion,$sql1);
                while($row1 = mysqli_fetch_array($consulta1)) {
                    $id_modelo = $row1['id'];
                    $fecha_desde = '2020-12-29';
                    $fecha_hasta = '2020-12-29';
                    $sql2 = "INSERT INTO multas (id_modelo,concepto,valor,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ('$id_modelo','$motivo','$valor','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                    $consulta2 = mysqli_query($conexion,$sql2);
                }
            }
            if($i>=171 and $i<=184){
                $sql1 = "SELECT * FROM modelos WHERE documento_numero = ".$identificacion;
                $consulta1 = mysqli_query($conexion,$sql1);
                while($row1 = mysqli_fetch_array($consulta1)) {
                    $id_modelo = $row1['id'];
                    $fecha_desde = '2020-12-30';
                    $fecha_hasta = '2020-12-30';
                    $sql2 = "INSERT INTO multas (id_modelo,concepto,valor,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ('$id_modelo','$motivo','$valor','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                    $consulta2 = mysqli_query($conexion,$sql2);
                }
            }
            if($i>=185 and $i<=189){
                $sql1 = "SELECT * FROM modelos WHERE documento_numero = ".$identificacion;
                $consulta1 = mysqli_query($conexion,$sql1);
                while($row1 = mysqli_fetch_array($consulta1)) {
                    $id_modelo = $row1['id'];
                    $fecha_desde = '2020-12-16';
                    $fecha_hasta = '2020-12-16';
                    $sql2 = "INSERT INTO multas (id_modelo,concepto,valor,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ('$id_modelo','$motivo','$valor','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                    $consulta2 = mysqli_query($conexion,$sql2);
                }
            }
        }

    }
}

$datos = [
    "resultado" => "Ok",
];

echo json_encode($datos);

//echo 'Correcto';

?>