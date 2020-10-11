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

foreach ($_FILES as $key ){
  $archivo = $key['name'];
  $temporal = $key['tmp_name'];
}
*/

$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('Modelos_temporal1.xlsx');
//$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($temporal);
$worksheet = $spreadsheet->getActiveSheet();

$limite = 10000;

include('script/conexion.php');

for($i=1;$i<=$limite;$i++){
  $nombre = $worksheet->getCell('A'.$i);

  if($nombre!=''){
    if($fila1==0){
      $sql2 = "INSERT INTO modelos_temporal (nombre) VALUES ('$nombre')";
      $registro = mysqli_query($conexion, $sql2);
    }
  }

}

$datos = [
    "estatus:" => 'ok',
];

echo json_encode($datos);

exit;
/*
$fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
$fileName = $_FILES['uploadedFile']['name'];
$fileSize = $_FILES['uploadedFile']['size'];
$fileType = $_FILES['uploadedFile']['type'];
*/
/******************LEER******************/
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('phpcomexcel.xlsx');
$worksheet = $spreadsheet->getActiveSheet();
$worksheet->getCell('A1');
$worksheet->getCell('A2');

$datos = [
    "SQL1:"     => $sql1,
];

echo json_encode($datos);

?>