<?php
require '../resources/Spreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

include('../script/conexion.php');

$id_presabana = $_GET["corte14"];
$sqlx = "SELECT * FROM presabana WHERE id = ".$id_presabana;
$procesox = mysqli_query($conexion,$sqlx);
while($rowx = mysqli_fetch_array($procesox)) {
	$fecha_desde = $rowx["inicio"];
	$fecha_hasta = $rowx["fin"];
}

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Número Documento');
$sheet->setCellValue('B1', 'Descuento');
$sheet->setCellValue('C1', 'Tienda');
$sheet->setCellValue('D1', 'Avances');
$sheet->setCellValue('E1', 'Multas');
$sheet->setCellValue('F1', 'Bonos Horas');
$sheet->setCellValue('G1', 'Bonos Streamate');
$sheet->setCellValue('H1', 'Odontologia');
$sheet->setCellValue('I1', 'Seguridad Social');
$sheet->setCellValue('J1', 'Coopserpak');
$sheet->setCellValue('K1', 'Sexshop');
$sheet->setCellValue('L1', 'Belleza');
$sheet->setCellValue('M1', 'Sanción Pagina');
$sheet->setCellValue('N1', 'Lenceria');
$fila = 2;

$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(25);

$sql1 = "SELECT * FROM modelos";
$proceso1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($proceso1)) {
	$id_modelos = $row1["id"];
	$documento_numero = $row1['documento_numero'];
	
	$pase_descuento = 0;
	$suma_descuento = 0;

	$pase_tienda = 0;
	$suma_tienda = 0;

	$pase_avances = 0;
	$suma_avances = 0;

	$pase_multas = 0;
	$suma_multas = 0;

	$pase_bonos_horas = 0;
	$suma_bonos_horas = 0;

	$pase_bonos_streamate = 0;
	$suma_bonos_streamate = 0;

	$pase_odontologia = 0;
	$suma_odontologia = 0;

	$pase_seguridad_social = 0;
	$suma_seguridad_social = 0;

	$pase_coopserpak = 0;
	$suma_coopserpak = 0;

	$pase_sexshop = 0;
	$suma_sexshop = 0;

	$pase_belleza = 0;
	$suma_belleza = 0;

	$pase_sancionpagina = 0;
	$suma_sancionpagina = 0;

	$pase_lenceria = 0;
	$suma_lenceria = 0;

	/************************BUSQUEDA GLOBAL*******************************/
	$sql2 = "SELECT * FROM descuento WHERE id_modelo = ".$id_modelos." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$proceso2 = mysqli_query($conexion,$sql2);
	$contador2 = mysqli_num_rows($proceso2);
	if($contador2>=1){
		$pase_descuento = 1;
		while($row2 = mysqli_fetch_array($proceso2)){
			$suma_descuento = $suma_descuento+$row2["valor"];
		}
	}

	$sql3 = "SELECT * FROM tienda WHERE id_modelo = ".$id_modelos." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$proceso3 = mysqli_query($conexion,$sql3);
	$contador3 = mysqli_num_rows($proceso3);
	if($contador3>=1){
		$pase_tienda = 1;
		while($row3 = mysqli_fetch_array($proceso3)){
			$suma_tienda = $suma_tienda+$row3["valor"];
		}
	}

	$sql4 = "SELECT * FROM avances WHERE id_modelo = ".$id_modelos." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$proceso4 = mysqli_query($conexion,$sql4);
	$contador4 = mysqli_num_rows($proceso4);
	if($contador4>=1){
		$pase_avances = 1;
		while($row4 = mysqli_fetch_array($proceso4)){
			$suma_avances = $suma_avances+$row4["valor"];
		}
	}

	$sql5 = "SELECT * FROM multas WHERE id_modelo = ".$id_modelos." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$proceso5 = mysqli_query($conexion,$sql5);
	$contador5 = mysqli_num_rows($proceso5);
	if($contador5>=1){
		$pase_multas = 1;
		while($row5 = mysqli_fetch_array($proceso5)){
			$suma_multas = $suma_multas+$row5["valor"];
		}
	}

	$sql6 = "SELECT * FROM bonos_horas WHERE id_modelo = ".$id_modelos." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$proceso6 = mysqli_query($conexion,$sql6);
	$contador6 = mysqli_num_rows($proceso6);
	if($contador6>=1){
		$pase_bonos_horas = 1;
		while($row6 = mysqli_fetch_array($proceso6)){
			$suma_bonos_horas = $suma_bonos_horas+$row6["monto"];
		}
	}

	$sql7 = "SELECT * FROM bonos_streamate WHERE id_modelo = ".$id_modelos." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$proceso7 = mysqli_query($conexion,$sql7);
	$contador7 = mysqli_num_rows($proceso7);
	if($contador7>=1){
		$pase_bonos_streamate = 1;
		while($row7 = mysqli_fetch_array($proceso7)){
			$suma_bonos_streamate = $suma_bonos_streamate+$row7["valor"];
		}
	}

	$sql8 = "SELECT * FROM odontologia WHERE id_modelo = ".$id_modelos." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$proceso8 = mysqli_query($conexion,$sql8);
	$contador8 = mysqli_num_rows($proceso8);
	if($contador8>=1){
		$pase_odontologia = 1;
		while($row8 = mysqli_fetch_array($proceso8)){
			$suma_odontologia = $suma_odontologia+$row8["valor"];
		}
	}

	$sql9 = "SELECT * FROM seguridad_social WHERE id_modelo = ".$id_modelos." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$proceso9 = mysqli_query($conexion,$sql9);
	$contador9 = mysqli_num_rows($proceso9);
	if($contador9>=1){
		$pase_seguridad_social = 1;
		while($row9 = mysqli_fetch_array($proceso9)){
			$suma_seguridad_social = ($suma_seguridad_social+$row9["monto"])*1;
		}
	}

	$sql10 = "SELECT * FROM coopserpak WHERE id_modelo = ".$id_modelos." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$proceso10 = mysqli_query($conexion,$sql10);
	$contador10 = mysqli_num_rows($proceso10);
	if($contador10>=1){
		$pase_coopserpak = 1;
		while($row10 = mysqli_fetch_array($proceso10)){
			$suma_coopserpak = $suma_coopserpak+$row10["monto"];
		}
	}

	$sql11 = "SELECT * FROM sexshop WHERE id_modelo = ".$id_modelos." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$proceso11 = mysqli_query($conexion,$sql11);
	$contador11 = mysqli_num_rows($proceso11);
	if($contador11>=1){
		$pase_sexshop = 1;
		while($row11 = mysqli_fetch_array($proceso11)){
			$suma_sexshop = ($suma_sexshop+$row11["monto"])*1;
		}
	}

	$sql12 = "SELECT * FROM belleza WHERE id_modelo = ".$id_modelos." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$proceso12 = mysqli_query($conexion,$sql12);
	$contador12 = mysqli_num_rows($proceso12);
	if($contador12>=1){
		$pase_belleza = 1;
		while($row12 = mysqli_fetch_array($proceso12)){
			$suma_belleza = $suma_belleza+$row12["monto"];
		}
	}

	$sql13 = "SELECT * FROM sancionpagina WHERE id_modelo = ".$id_modelos." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$proceso13 = mysqli_query($conexion,$sql13);
	$contador13 = mysqli_num_rows($proceso13);
	if($contador13>=1){
		$pase_sancionpagina = 1;
		while($row13 = mysqli_fetch_array($proceso13)){
			$suma_sancionpagina = $suma_sancionpagina+$row13["monto"];
		}
	}

	$sql14 = "SELECT * FROM lenceria WHERE id_modelo = ".$id_modelos." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$proceso14 = mysqli_query($conexion,$sql14);
	$contador14 = mysqli_num_rows($proceso14);
	if($contador14>=1){
		$pase_lenceria = 1;
		while($row14 = mysqli_fetch_array($proceso14)){
			$suma_lenceria = $suma_lenceria+$row14["monto"];
		}
	}
	/**********************************************************************/

	if($contador2>=1 or $contador3>=1 or $contador4>=1 or $contador5>=1 or $contador6>=1 or $contador7>=1 or $contador8>=1 or $contador9>=1 or $contador10>=1 or $contador11>=1 or $contador12>=1 or $contador13>=1 or $contador14>=1){
		

		$sheet->setCellValue('A'.$fila, $documento_numero);

		if($contador2>=1){
			$sheet->setCellValue('B'.$fila, $suma_descuento);
		}

		if($contador3>=1){
			$sheet->setCellValue('C'.$fila, $suma_tienda);
		}

		if($contador4>=1){
			$sheet->setCellValue('D'.$fila, $suma_avances);
		}

		if($contador5>=1){
			$sheet->setCellValue('E'.$fila, $suma_multas);
		}

		if($contador6>=1){
			$sheet->setCellValue('F'.$fila, $suma_bonos_horas);
		}

		if($contador7>=1){
			$sheet->setCellValue('G'.$fila, $suma_bonos_streamate);
		}

		if($contador8>=1){
			$sheet->setCellValue('H'.$fila, $suma_odontologia);
		}

		if($contador9>=1){
			$sheet->setCellValue('I'.$fila, $suma_seguridad_social);
		}

		if($contador10>=1){
			$sheet->setCellValue('J'.$fila, $suma_coopserpak);
		}

		if($contador11>=1){
			$sheet->setCellValue('K'.$fila, $suma_sexshop);
		}

		if($contador12>=1){
			$sheet->setCellValue('L'.$fila, $suma_belleza);
		}

		if($contador13>=1){
			$sheet->setCellValue('M'.$fila, $suma_sancionpagina);
		}

		if($contador14>=1){
			$sheet->setCellValue('N'.$fila, $suma_lenceria);
		}

	$fila = $fila+1;
	}

}


$fecha_inicio = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('Reporte de Descuentos '.$fecha_inicio.'.xlsx');
header("Location: Reporte de Descuentos ".$fecha_inicio.".xlsx");

?>