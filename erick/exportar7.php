<?php
require '../resources/Spreadsheet/autoload.php';

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

include('../script/conexion.php');

//$spreadsheet->getActiveSheet()->mergeCells('A1:E1');

$sheet->setCellValue('A1', 'Nombre1');
$sheet->setCellValue('B1', 'Apellido1');
$sheet->setCellValue('C1', 'Documento Numero');
$sheet->setCellValue('D1', 'Fecha Inicio');
$sheet->setCellValue('E1', 'Descripción');
$fila = 2;

$buscador[0] = 26566435;
$buscador[1] = 1006693493;
$buscador[2] = 1072669575;
$buscador[3] = 1022424579;
$buscador[4] = 53123922;
$buscador[5] = 1127618793;
$buscador[6] = 1072192278;
$buscador[7] = 1000579251;
$buscador[8] = 1235252406;
$buscador[9] = 1001285564;
$buscador[10] = 1018464115;
$buscador[11] = 1000929320;
$buscador[12] = 26335613;
$buscador[13] = 1015460797;
$buscador[14] = 1001196476;
$buscador[15] = 26091866;
$buscador[16] = 25633318;
$buscador[17] = 29787017;
$buscador[18] = 1000033352;
$buscador[19] = 1000468532;
$buscador[20] = 1121945543;
$buscador[21] = 10190641385;
$buscador[22] = 1233489234;
$buscador[23] = 1014282417;
$buscador[24] = 1024602389;
$buscador[25] = 24902422;
$buscador[26] = 39583157;
$buscador[27] = 1052396039;
$buscador[28] = 1022437825;
$buscador[29] = 52314942;
$buscador[30] = 1000590372;
$buscador[31] = 1051741662;
$buscador[32] = 1030595598;
$buscador[33] = 18111468;
$buscador[34] = 1001326972;
$buscador[35] = 1010003847;
$buscador[36] = 1030687477;
$buscador[37] = 1016107876;
$buscador[38] = 1000620516;
$buscador[39] = 1024563326;
$buscador[40] = 1034318434;
$buscador[41] = 1005448958;
$buscador[42] = 1002607819;

$contador1 = 42;

$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(40);

for($i=0;$i<=$contador1;$i++){
	
	$si_registro = 0;
	$si_pasante = 0;
	$si_modelo = 0;

	$sql1 = "SELECT primer_nombre, primer_apellido, numero_documento, fecha_inicio FROM pasantes WHERE numero_documento = ".$buscador[$i];
	$consulta = mysqli_query($conexion,$sql1);

	while($row1 = mysqli_fetch_array($consulta)) {
		$primer_nombre 		= $row1['primer_nombre'];
		$primer_apellido 	= $row1['primer_apellido'];
		$numero_documento 	= $row1['numero_documento'];
		$fecha_inicio 		= $row1['fecha_inicio'];
		$si_registro 		= 1;
		$si_pasante 		= 1;
	}

	$sql2 = "SELECT nombre1, apellido1, documento_numero, fecha_inicio FROM modelos WHERE documento_numero = ".$buscador[$i];
	$consulta2 = mysqli_query($conexion,$sql2);

	while($row2 = mysqli_fetch_array($consulta2)) {
		$nombre1 			= $row2['nombre1'];
		$apellido1 			= $row2['apellido1'];
		$documento_numero 	= $row2['documento_numero'];
		$fecha_inicio 		= $row2['fecha_inicio'];
		$si_registro 		= 1;
		$si_modelo 			= 1;
	}

	if($si_registro==0){
		$sheet->setCellValue('A'.$fila, 'Faltante');
		$sheet->setCellValue('B'.$fila, '');
		$sheet->setCellValue('C'.$fila, $buscador[$i]);
		$sheet->setCellValue('D'.$fila, '');
		$sheet->setCellValue('E'.$fila, 'Sin registrar en el sistema');
	}

	if($si_pasante==1 and $si_modelo==0){
		$sheet->setCellValue('A'.$fila, $primer_nombre);
		$sheet->setCellValue('B'.$fila, $primer_apellido);
		$sheet->setCellValue('C'.$fila, $buscador[$i]);
		$sheet->setCellValue('D'.$fila, $fecha_inicio);
		$sheet->setCellValue('E'.$fila, 'Esta Registrada solo como pasante');
	}

	if($si_pasante==0 and $si_modelo==1){
		$sheet->setCellValue('A'.$fila, $nombre1);
		$sheet->setCellValue('B'.$fila, $apellido1);
		$sheet->setCellValue('C'.$fila, $buscador[$i]);
		$sheet->setCellValue('D'.$fila, $fecha_inicio);
		$sheet->setCellValue('E'.$fila, 'Esta Registrada solo como modelo');
	}

	if($si_pasante==1 and $si_modelo==1){
		$sheet->setCellValue('A'.$fila, $nombre1);
		$sheet->setCellValue('B'.$fila, $apellido1);
		$sheet->setCellValue('C'.$fila, $buscador[$i]);
		$sheet->setCellValue('D'.$fila, $fecha_inicio);
		$sheet->setCellValue('E'.$fila, 'Esta Registrada como pasante y modelo');
	}

	$fila = $fila+1;

}


$fecha_inicio = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('Faltantes mixtos1 '.$fecha_inicio.'.xlsx');
header("Location: Faltantes mixtos1 ".$fecha_inicio.".xlsx");

?>