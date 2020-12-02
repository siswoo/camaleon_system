<?php
require '../resources/Spreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

/*
$fecha_inicio_post = $_POST['fecha_inicio_post'];
$fecha_fin_post = $_POST['fecha_fin_post'];
*/

$fecha_inicio_post = '2020-11-01';
$fecha_fin_post = '2020-11-15';
$fecha_inicio1 = date('Y-m-d');


$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$styleArray = [
    'borders' => [
        'outline' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
            'color' => ['argb' => 'c0504d'],
        ],
    ],
];

$sheet->getStyle('A3:O4')->applyFromArray($styleArray);

$spreadsheet->getActiveSheet()->mergeCells('A1:O2');

$spreadsheet->getActiveSheet()->mergeCells('A3:A4');
$spreadsheet->getActiveSheet()->mergeCells('B3:C3');
$spreadsheet->getActiveSheet()->mergeCells('D3:F3');
$spreadsheet->getActiveSheet()->mergeCells('G3:G4');
$spreadsheet->getActiveSheet()->mergeCells('H3:H4');
$spreadsheet->getActiveSheet()->mergeCells('I3:I4');
$spreadsheet->getActiveSheet()->mergeCells('J3:O3');

$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(15);

$sheet->getStyle('A3:O3')->getAlignment()->setHorizontal('center');
$sheet->getStyle('A4:O4')->getAlignment()->setHorizontal('center');

$sheet->setCellValue('A3', 'OK');
$sheet->setCellValue('B3', 'IDENTIFICACIÓN');
$sheet->setCellValue('D3', 'CUENTA');
$sheet->setCellValue('G3', 'NOMBRE');
$sheet->setCellValue('H3', 'DIRECCIÓN');
$sheet->setCellValue('I3', 'E-MAIL');
$sheet->setCellValue('J3', 'INFORMACIÓN DE PAGO');

$sheet->setCellValue('B4', 'Tipo');
$sheet->setCellValue('C4', 'Numero');
$sheet->setCellValue('D4', 'Tipo');
$sheet->setCellValue('E4', 'Numero');
$sheet->setCellValue('F4', 'Banco');
$sheet->setCellValue('J4', 'Tipo de Pago');
$sheet->setCellValue('K4', 'Oficina de Pago');
$sheet->setCellValue('L4', 'Importe($)');
$sheet->setCellValue('M4', 'Concepto 1');
$sheet->setCellValue('N4', 'Fecha Limite');
$sheet->setCellValue('O4', 'Concepto 2');

$fila = 5;

include('../script/conexion.php');

$sql3 = "SELECT * FROM presabana";
$consulta3 = mysqli_query($conexion,$sql3);
while($row3 = mysqli_fetch_array($consulta3)) {
	$id_modelo_presabana 	= $row3['id_modelo'];
	$inicio 				= $row3['inicio'];
	$fin 					= $row3['fin'];
	$tokens_chaturbate 		= $row3['chaturbate'];
	$tokens_imlive 			= $row3['imlive'];
	$tokens_xlove 			= $row3['xlove'];
	$tokens_stripchat 		= $row3['stripchat'];
	$tokens_streamate 		= $row3['streamate'];
	$tokens_myfreecams 		= $row3['myfreecams'];
	$tokens_livejasmin 		= $row3['livejasmin'];
	$tokens_bonga 			= $row3['bonga'];
	$tokens_cam4 			= $row3['cam4'];
	$tokens_camsoda 		= $row3['camsoda'];
	$tokens_flirt4free 		= $row3['flirt4free'];
	$total_tokens 			= $row3['total_tokens'];
	$subtotal_dolares 		= $row3['subtotal_dolares'];
	$rf 					= $row3['rf'];
	$meta_porcentajes 		= $row3['meta_porcentajes'];
	$total_pesos 			= $row3['total_pesos'];
	$total_dolares 			= $row3['total_dolares'];
	$trm 					= $row3['trm'];
	$pv 					= $row3['pv'];
	$responsable 			= $row3['responsable'];
	$fecha_inicio 			= $row3['fecha_inicio'];

	$sql1 = "SELECT * FROM modelos WHERE estatus = 'Activa' and banco_cedula != '' and id = ".$id_modelo_presabana;
	$consulta1 = mysqli_query($conexion,$sql1);
	while($row1 = mysqli_fetch_array($consulta1)) {
		$id_sede 			= $row1['sede'];
		$documento_tipo 	= $row1['documento_tipo'];
		$documento_numero 	= $row1['documento_numero'];
		$banco_cedula 		= $row1['banco_cedula'];
		$banco_nombre 		= $row1['banco_nombre'];
		$banco_tipo 		= $row1['banco_tipo'];
		$banco_numero 		= $row1['banco_numero'];
		$banco_banco 		= $row1['banco_banco'];
		$BCPP 				= $row1['BCPP'];

		$nombre1 		= $row1['nombre1'];
		$apellido1 		= $row1['apellido1'];

		$nombre_c1 = $nombre1." ".$apellido1;

		$sql2 = "SELECT * FROM sedes WHERE id =".$id_sede;
		$consulta2 = mysqli_query($conexion,$sql2);
		while($row2 = mysqli_fetch_array($consulta2)){
			$sede_nombre = $row2['nombre'];
		}
	}

	$sheet->setCellValue('A'.$fila, 'OK');

	if($documento_tipo=='Cedula de Ciudadania'){
		$sheet->setCellValue('B'.$fila, '01- Cédula de ciudadanía');
	}else if($documento_tipo=='Cedula de Extranjeria'){
		$sheet->setCellValue('B'.$fila, '02 - Cédula de extranjería');
	}else if($documento_tipo=='Pasaporte'){
		$sheet->setCellValue('B'.$fila, '05 - Pasaporte');
	}else if($documento_tipo=='PEP'){
		$sheet->setCellValue('B'.$fila, '06 - Nit Extranjería');
	}

	$spreadsheet->getActiveSheet()->getCell('C'.$fila)->setValue($documento_numero);
	$spreadsheet->getActiveSheet()->getStyle('C'.$fila)->getNumberFormat()->setFormatCode('00');

	if($banco_tipo=='Ahorro'){
		$sheet->setCellValue('D'.$fila, '02-Ahorros');
	}else if($banco_tipo=='Corriente'){
		$sheet->setCellValue('D'.$fila, '01-Corriente');
	}

	/*
	$spreadsheet->getActiveSheet()->getCell('E'.$fila)->setValue($banco_numero);
	$spreadsheet->getActiveSheet()->getStyle('E'.$fila)->getNumberFormat()->setFormatCode('00');
	*/
	$sheet->setCellValue('E'.$fila, $banco_numero);

	/****************SECCION DE CONDICIONALES BANCOS*********************/

	if($banco_banco=='Banco Agrario de Colombia'){
		$sheet->setCellValue('F'.$fila, '040.BANCO AGRARIO ');
	}else if($banco_banco=='Banco AV Villas'){
		$sheet->setCellValue('F'.$fila, '052.AV VILLAS');
	}else if($banco_banco=='Banco Caja Social'){
		$sheet->setCellValue('F'.$fila, '032.BCSC ');
	}else if($banco_banco=='Banco de Occidente (Colombia)'){
		$sheet->setCellValue('F'.$fila, '023.DE OCCIDENTE');
	}else if($banco_banco=='Banco Popular (Colombia)'){
		$sheet->setCellValue('F'.$fila, '002.POPULAR');
	}else if($banco_banco=='Bancolombia'){
		$sheet->setCellValue('F'.$fila, '007.BANCOLOMBIA');
	}else if($banco_banco=='BBVA Colombia'){
		$sheet->setCellValue('F'.$fila, '013.BBVA ');
	}else if($banco_banco=='BBVA Movil'){
		$sheet->setCellValue('F'.$fila, '013.BBVA ');
	}else if($banco_banco=='Banco de Bogotá'){
		$sheet->setCellValue('F'.$fila, '001.BOGOTA ');
	}else if($banco_banco=='Colpatria'){
		$sheet->setCellValue('F'.$fila, '019.SCOTIABANK');
	}else if($banco_banco=='Davivienda'){
		$sheet->setCellValue('F'.$fila, '051.DAVIVIENDA');
	}else if($banco_banco=='ITAU CorpBanca'){
		$sheet->setCellValue('F'.$fila, '006.ITAU CORPBANCA');
	}else if($banco_banco=='Citibank'){
		$sheet->setCellValue('F'.$fila, '009.CITIBANK COLOMBIA');
	}else if($banco_banco=='GNB Sudameris'){
		$sheet->setCellValue('F'.$fila, '012.GNB SUDAMERIS');
	}else if($banco_banco=='ITAU'){
		$sheet->setCellValue('F'.$fila, '014.ITAU');
	}else if($banco_banco=='Scotiabank'){
		$sheet->setCellValue('F'.$fila, '019.SCOTIABANK');
	}else if($banco_banco=='Bancoldex'){
		$sheet->setCellValue('F'.$fila, '031.BANCOLDEX');
	}else if($banco_banco=='JPMorgan'){
		$sheet->setCellValue('F'.$fila, '041.JPMORGAN');
	}else if($banco_banco=='BNP Paribas'){
		$sheet->setCellValue('F'.$fila, '042.BNP PARIBAS');
	}else if($banco_banco=='Banco ProCredit'){
		$sheet->setCellValue('F'.$fila, '058.PROCREDIT');
	}else if($banco_banco=='Banco Pichincha'){
		$sheet->setCellValue('F'.$fila, '060.PICHINCHA');
	}else if($banco_banco=='Bancoomeva'){
		$sheet->setCellValue('F'.$fila, '061.BANCOOMEVA');
	}else if($banco_banco=='Banco Finandina'){
		$sheet->setCellValue('F'.$fila, '063.FINANDINA');
	}else if($banco_banco=='Banco CoopCentral'){
		$sheet->setCellValue('F'.$fila, '066.COOPCENTRAL');
	}else if($banco_banco=='Compensar'){
		$sheet->setCellValue('F'.$fila, '083.COMPENSAR');
	}else if($banco_banco=='Aportes en linea'){
		$sheet->setCellValue('F'.$fila, '084.APORTES EN LINEA');
	}else if($banco_banco=='Asopagos'){
		$sheet->setCellValue('F'.$fila, '086.ASOPAGOS');
	}else if($banco_banco=='Fedecajas'){
		$sheet->setCellValue('F'.$fila, '087.FEDECAJAS');
	}else if($banco_banco=='Simple'){
		$sheet->setCellValue('F'.$fila, '088.SIMPLE');
	}else if($banco_banco=='Enlace Operativo'){
		$sheet->setCellValue('F'.$fila, '089.ENLACE OPERATIVO ');
	}else if($banco_banco=='CorfiColombiana'){
		$sheet->setCellValue('F'.$fila, '090.CORFICOLOMBIANA');
	}else if($banco_banco=='Old Mutual'){
		$sheet->setCellValue('F'.$fila, '502.OLD MUTUAL');
	}else if($banco_banco=='Cotrafa'){
		$sheet->setCellValue('F'.$fila, '289.COTRAFA');
	}else if($banco_banco=='Confiar'){
		$sheet->setCellValue('F'.$fila, '292.CONFIAR');
	}else if($banco_banco=='JurisCoop'){
		$sheet->setCellValue('F'.$fila, '121.JURISCOOP');
	}else if($banco_banco=='Deceval'){
		$sheet->setCellValue('F'.$fila, '550.DECEVAL');
	}else if($banco_banco=='Bancamia'){
		$sheet->setCellValue('F'.$fila, '059.BANCAMIA');
	}else if($banco_banco=='Nequi'){
		$sheet->setCellValue('F'.$fila, '507.NEQUI');
	}else if($banco_banco=='Falabella'){
		$sheet->setCellValue('F'.$fila, '062.FALABELLA');
	}else if($banco_banco=='DGCPTN'){
		$sheet->setCellValue('F'.$fila, '683.DGCPTN');
	}else if($banco_banco=='BANCO WWB'){
		$sheet->setCellValue('F'.$fila, '1053.BANCO WWB');
	}else if($banco_banco=='Cooperativa Financiera de Antioquia'){
		$sheet->setCellValue('F'.$fila, '1283.COOPERATIVA FINANCIERA DE ANTIOQUIA');
	}

	/***************************************************************/

	$sheet->setCellValue('G'.$fila, $nombre_c1);
	$sheet->setCellValue('H'.$fila, 'Bogota');
	$sheet->setCellValue('I'.$fila, '');

	/*
	$saber_telefono = substr($banco_numero,0,3);
	$contador1 = strlen($banco_numero);

	if($saber_telefono>=300 and $saber_telefono<=350 and $banco_banco=='BBVA Colombia' and $contador1 == 10){
		$sheet->setCellValue('J'.$fila, '6- Deposito Electronico');
	}else{
		$sheet->setCellValue('J'.$fila, '1- Abono en Cuenta');
	}
	*/

	if($banco_banco=='BBVA Movil'){
		$sheet->setCellValue('J'.$fila, '6- Deposito Electronico');
	}else{
		$sheet->setCellValue('J'.$fila, '1- Abono en Cuenta');
	}
	
	$sheet->setCellValue('K'.$fila, '');
	$sheet->setCellValue('L'.$fila, 'OK');
	$sheet->setCellValue('M'.$fila, 'NominaMod');
	$sheet->setCellValue('N'.$fila, '');
	$sheet->setCellValue('O'.$fila, '');

	$fila = $fila+1;

}

$fecha_inicio1 = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('test7 '.$fecha_inicio1.'.xlsx');
header("Location: test7 ".$fecha_inicio1.".xlsx");
?>