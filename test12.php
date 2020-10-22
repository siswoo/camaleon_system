<?php
require '../resources/Spreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

foreach ($_FILES as $key ){
  $archivo = $key['name'];
  $temporal = $key['tmp_name'];
}

$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($temporal);
$worksheet = $spreadsheet->getActiveSheet();

$limite = 1000;

include('conexion.php');

for($i=1;$i<=$limite;$i++){
  $cedulas = $worksheet->getActiveSheet()->getCell('A'.$i)->getNumberFormat()->setFormatCode('00');
  if($cedulas!=){
    if($cedulas>=50000){
      $tipo = "Cedula de Ciudadania";
    }else{
      $tipo = "Cedula de Extranjeria";
    }
    $sql = "INSERT INTO temporaltest2 (cedula,tipo) VALUES ('$cedulas','$tipo')";
    $registro = mysqli_query($conexion,$sql);
  }
}

exit;
?>