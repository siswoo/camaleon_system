<?php
require 'resources/Spreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

/*
$documento = $_FILES['archivo']['name'];
echo $documento;
*/

foreach ($_FILES as $key ){
  $archivo = $key['name'];
  $temporal = $key['tmp_name'];
}

//$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('phpcomexcel.xlsx');
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($temporal);
$worksheet = $spreadsheet->getActiveSheet();

$limite = 10000;

include('script/conexion.php');

$performer_nickname_original = '';
$total = 0;

for($i=2;$i<=$limite;$i++){
  $performer_id = $worksheet->getCell('A'.$i);
  $performer_nickname = $worksheet->getCell('B'.$i);
  $performer_payee = $worksheet->getCell('C'.$i);
  $customer_nickname = $worksheet->getCell('D'.$i);
  $fecha = $worksheet->getCell('E'.$i);
  $duration = $worksheet->getCell('F'.$i);
  $type = $worksheet->getCell('G'.$i);
  $stream_type = $worksheet->getCell('H'.$i);
  $performer_earned = $worksheet->getCell('I'.$i);
  $studio_id = $worksheet->getCell('J'.$i);
  $studio_payee = $worksheet->getCell('K'.$i);
  $studio_earned = $worksheet->getCell('L'.$i);

  if($performer_id!=''){

    $array = explode('$', $studio_earned);
    $pago_sencillo = $array[1];

    if($performer_nickname_original!=$performer_nickname){
      $performer_nickname_original = $performer_nickname;
      $total = 0;
      $total = $total + $pago_sencillo;
    }else{
      $total = $total + $pago_sencillo;
    }

    $sql = "INSERT INTO temporal_ganancias1 (performer_id,performer_nickname,performer_payee,customer_nickname,fecha,duration,type,stream_type,performer_earned,studio_id,studio_payee,studio_earned) VALUES 
    ('$performer_id','$performer_nickname','$performer_payee','$customer_nickname','$fecha','$duration','$type','$stream_type','$pago_sencillo','$studio_id','$studio_payee','$pago_sencillo')";
    $registro = mysqli_query($conexion,$sql);
  }

}

echo 'ok';

?>

