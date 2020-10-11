<?php
require '../resources/Spreadsheet/autoload.php';
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

$limite = 1000;

include('conexion.php');

for($i=2;$i<=$limite;$i++){
  $tipo_documento = $worksheet->getCell('A'.$i);
  $numero_documento = $worksheet->getCell('B'.$i);
  $primer_nombre = $worksheet->getCell('C'.$i);
  $segundo_nombre = $worksheet->getCell('D'.$i);
  $primer_apellido = $worksheet->getCell('E'.$i);
  $segundo_apellido = $worksheet->getCell('F'.$i);
  $genero = $worksheet->getCell('G'.$i);
  $correo = $worksheet->getCell('H'.$i);
  $telefono1 = $worksheet->getCell('I'.$i);
  $direccion = $worksheet->getCell('J'.$i);
  $estatus = $worksheet->getCell('K'.$i);
  $barrio = $worksheet->getCell('L'.$i);
  $fecha_inicio = $worksheet->getCell('N'.$i);
  $sede = $worksheet->getCell('X'.$i);

  if($tipo_documento!=''){
    $sql1="SELECT * FROM pasantes WHERE tipo_documento = '".$tipo_documento."' and numero_documento = '".$numero_documento."'";
    $consulta = mysqli_query($conexion, $sql1);
    $fila1 = mysqli_num_rows($consulta);

    if($fila1==0){
      $sql2 = "INSERT INTO pasantes (tipo_documento,numero_documento,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,genero,correo,telefono1,direccion,estatus,barrio,fecha_inicio,sede) VALUES ('$tipo_documento','$numero_documento','$primer_nombre','$segundo_nombre','$primer_apellido','$segundo_apellido','$genero','$correo','$telefono1','$direccion','$estatus','$barrio','$fecha_inicio','$sede')";
      $registro = mysqli_query($conexion, $sql2);
    }
  }

}

$datos = [
    "SQL1:"     => $sql1,
    //"SQL2:"     => $sql2,
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