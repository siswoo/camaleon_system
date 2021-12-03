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

$inicio = $_GET['inicio'];
$fin = $_GET['fin'];

$sheet->setCellValue('A1', '');
$sheet->setCellValue('B1', 'Tipo de Documento Titular');
$sheet->setCellValue('C1', 'C Titular');
$sheet->setCellValue('D1', '');
$sheet->setCellValue('E1', 'Numero de Cuenta');
$sheet->setCellValue('F1', 'Banco');
$sheet->setCellValue('G1', 'Nombre');
$sheet->setCellValue('H1', '');
$sheet->setCellValue('I1', '');
$sheet->setCellValue('J1', '');
$sheet->setCellValue('K1', '');
$sheet->setCellValue('L1', 'TOTAL TEXTO');
$sheet->setCellValue('M1', '');
$sheet->setCellValue('N1', '');
$sheet->setCellValue('O1', 'Sede');
$fila = 2;

/*
$sql1 = "SELECT * FROM modelos WHERE estatus = 'Activa' and banco_cedula != '' ORDER BY sede";
$sql1 = "SELECT * FROM presabana WHERE (id_modelo = 474 and inicio = '2020-12-16') or (id_modelo = 540 and inicio = '2020-12-16') or (id_modelo = 560 and inicio = '2020-12-16')";	
*/
$sql1 = "SELECT * FROM presabana WHERE inicio BETWEEN '".$inicio."' AND '".$fin."' and fin BETWEEN '".$inicio."' AND '".$fin."' and total_dolares >=1";
$consulta = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($consulta)) {
	$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(40);
	$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
	$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(40);
	$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
	$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(40);
	$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(40);
	$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(40);
	$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(40);
	$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(40);
	$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(40);
	$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(40);
	$spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(40);
	$spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(25);

	$id_modelo = $row1['id_modelo'];
	$rf = $row1['rf'];

	$sql3 = "SELECT * FROM modelos WHERE id = ".$id_modelo;
	$consulta3 = mysqli_query($conexion,$sql3);
	while($row3 = mysqli_fetch_array($consulta3)) {
		$nombre_modelo = $row3['nombre1']." ".$row3['nombre2']." ".$row3['apellido1']." ".$row3['apellido2'];
		$tipo_documento = $row3['documento_tipo'];
		$numero_documento = $row3['documento_numero'];
		$id_sede = $row3['sede'];
		$banco_cedula = $row3['banco_cedula'];
		$banco_nombre = $row3['banco_nombre'];
		$banco_tipo = $row3['banco_tipo'];
		$banco_numero = $row3['banco_numero'];
		$banco_banco = $row3['banco_banco'];
		$bcpp = $row3['BCPP'];
		$turno = $row3['turno'];
		$banco_tipo_documento = $row3['banco_tipo_documento'];
	}

	$sql2 = "SELECT * FROM sedes WHERE id = ".$id_sede;
	$consulta2 = mysqli_query($conexion,$sql2);
	while($row2 = mysqli_fetch_array($consulta2)) {
		$nombre_sede = $row2['nombre'];
	}

	/**************************************************************/
	/******************SEPARACION DE NEGATIVOS*********************/
	/**************************************************************/

	$monto_separacion = 0;
	$monto_separacion2 = 0;
	$fecha_desde = $inicio;
	$fecha_hasta = $fin;

	$sql_separacion1 = "SELECT * FROM descuento WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$consultas_separacion1 = mysqli_query($conexion,$sql_separacion1);
	while($row_separacion1 = mysqli_fetch_array($consultas_separacion1)) {
		$monto_separacion = $monto_separacion+$row_separacion1["valor"];
	}
	
	$sql_separacion1 = "SELECT * FROM tienda WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$consultas_separacion1 = mysqli_query($conexion,$sql_separacion1);
	while($row_separacion1 = mysqli_fetch_array($consultas_separacion1)) {
		$monto_separacion = $monto_separacion+$row_separacion1["valor"];
	}
			
	$sql_separacion1 = "SELECT * FROM avances WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$consultas_separacion1 = mysqli_query($conexion,$sql_separacion1);
	while($row_separacion1 = mysqli_fetch_array($consultas_separacion1)) {
		$monto_separacion = $monto_separacion+$row_separacion1["valor"];
	}
			
	$sql_separacion1 = "SELECT * FROM multas WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$consultas_separacion1 = mysqli_query($conexion,$sql_separacion1);
	while($row_separacion1 = mysqli_fetch_array($consultas_separacion1)) {
		$monto_separacion = $monto_separacion+$row_separacion1["valor"];
	}

	if($turno!='Satelite'){
		$sql_separacion1 = "SELECT * FROM bonos_horas WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
		$consultas_separacion1 = mysqli_query($conexion,$sql_separacion1);
		while($row_separacion1 = mysqli_fetch_array($consultas_separacion1)) {
			if($row_separacion1["concepto"]=='Amateur'){
				$monto_separacion2 = $monto_separacion2+($row_separacion1["monto"]*$trm);
			}else{
				$monto_separacion2 = $monto_separacion2+$row_separacion1["monto"];
			}
		}

		$sql_separacion1 = "SELECT * FROM bonos_streamate WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
		$consultas_separacion1 = mysqli_query($conexion,$sql_separacion1);
		while($row_separacion1 = mysqli_fetch_array($consultas_separacion1)) {
			$monto_separacion2 = $monto_separacion2+$row_separacion1["monto"];
		}
	}

	$sql_separacion1 = "SELECT * FROM odontologia WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$consultas_separacion1 = mysqli_query($conexion,$sql_separacion1);
	while($row_separacion1 = mysqli_fetch_array($consultas_separacion1)) {
		$monto_separacion = $monto_separacion+$row_separacion1["monto"];
	}
			
	$sql_separacion1 = "SELECT * FROM seguridad_social WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$consultas_separacion1 = mysqli_query($conexion,$sql_separacion1);
	while($row_separacion1 = mysqli_fetch_array($consultas_separacion1)) {
		$monto_separacion = $monto_separacion+$row_separacion1["monto"];
	}
	
	$sql_separacion1 = "SELECT * FROM coopserpak WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$consultas_separacion1 = mysqli_query($conexion,$sql_separacion1);
	while($row_separacion1 = mysqli_fetch_array($consultas_separacion1)) {
		$monto_separacion = $monto_separacion+$row_separacion1["monto"];
	}
			
	$sql_separacion1 = "SELECT * FROM sexshop WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$consultas_separacion1 = mysqli_query($conexion,$sql_separacion1);
	while($row_separacion1 = mysqli_fetch_array($consultas_separacion1)) {
		$monto_separacion = $monto_separacion+$row_separacion1["monto"];
	}
			
	$sql_separacion1 = "SELECT * FROM belleza WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$consultas_separacion1 = mysqli_query($conexion,$sql_separacion1);
	while($row_separacion1 = mysqli_fetch_array($consultas_separacion1)) {
		$monto_separacion = $monto_separacion+$row_separacion1["monto"];
	}
			
	$sql_separacion1 = "SELECT * FROM sancionpagina WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$consultas_separacion1 = mysqli_query($conexion,$sql_separacion1);
	while($row_separacion1 = mysqli_fetch_array($consultas_separacion1)) {
		$monto_sancionpagina = $row_separacion1["monto"]*$trm;
		$monto_separacion = $monto_separacion+$monto_sancionpagina;
	}
	
	$sql_separacion1 = "SELECT * FROM lenceria WHERE id_modelo = ".$id_modelo." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$consultas_separacion1 = mysqli_query($conexion,$sql_separacion1);
	while($row_separacion1 = mysqli_fetch_array($consultas_separacion1)) {
		$monto_separacion = $monto_separacion+$row_separacion1["monto"];
	}

	$monto_separacion = $monto_separacion+$rf;
	$total_pesos_separacion = $monto_separacion-$monto_separacion2;

	/**************************************************************/
	/**************************************************************/
	/**************************************************************/

	//if($total_pesos_separacion <= $row1['total_pesos'] and $banco_cedula!=''){
	if($total_pesos_separacion <= $row1['total_pesos']){

		$sheet->setCellValue('A'.$fila, "OK");
		$sheet->setCellValue('B'.$fila, $banco_tipo_documento);

		$banco_cedula = str_replace(' ', '', $banco_cedula);
		$spreadsheet->getActiveSheet()->getCell('C'.$fila)->setValue($banco_cedula);
		$spreadsheet->getActiveSheet()->getStyle('C'.$fila)->getNumberFormat()->setFormatCode('00');

		if($banco_tipo=='Ahorro'){
			$sheet->setCellValue('D'.$fila, '02-Ahorros');	
		}else{
			$sheet->setCellValue('D'.$fila, '01-Corriente');
		}

		$banco_numero = str_replace(' ', '', $banco_numero);
		$spreadsheet->getActiveSheet()->getCell('E'.$fila)->setValue($banco_numero);
		$spreadsheet->getActiveSheet()->getStyle('E'.$fila)->getNumberFormat()->setFormatCode('00');

		if($banco_banco=='Banco Agrario de Colombia'){
			$banco_nombre2 = '040.BANCO AGRARIO ';
		}else if($banco_banco=='Banco AV Villas'){
			$banco_nombre2 = '052.AV VILLAS';
		}else if($banco_banco=='Banco Caja Social'){
			$banco_nombre2 = '032.BCSC ';
		}else if($banco_banco=='Banco de Occidente (Colombia)'){
			$banco_nombre2 = '023.DE OCCIDENTE';
		}else if($banco_banco=='Banco Popular (Colombia)'){
			$banco_nombre2 = '002.POPULAR';
		}else if($banco_banco=='Bancolombia'){
			$banco_nombre2 = '007.BANCOLOMBIA';
		}else if($banco_banco=='BBVA Colombia'){
			$banco_nombre2 = '013.BBVA ';
		}else if($banco_banco=='BBVA Movil'){
			$banco_nombre2 = '013.BBVA ';
		}else if($banco_banco=='Banco de Bogotá'){
			$banco_nombre2 = '001.BOGOTA ';
		}else if($banco_banco=='Colpatria'){
			$banco_nombre2 = '019.SCOTIABANK';
		}else if($banco_banco=='Davivienda'){
			$banco_nombre2 = '051.DAVIVIENDA';
		}else if($banco_banco=='ITAU CorpBanca'){
			$banco_nombre2 = '006.ITAU CORPBANCA';
		}else if($banco_banco=='Citibank'){
			$banco_nombre2 = '009.CITIBANK COLOMBIA';
		}else if($banco_banco=='GNB Sudameris'){
			$banco_nombre2 = '012.GNB SUDAMERIS';
		}else if($banco_banco=='ITAU'){
			$banco_nombre2 = '006.ITAU CORPBANCA';
		}else if($banco_banco=='Scotiabank'){
			$banco_nombre2 = '019.SCOTIABANK';
		}else if($banco_banco=='Bancoldex'){
			$banco_nombre2 = '031.BANCOLDEX';
		}else if($banco_banco=='JPMorgan'){
			$banco_nombre2 = '041.JPMORGAN';
		}else if($banco_banco=='BNP Paribas'){
			$banco_nombre2 = '042.BNP PARIBAS';
		}else if($banco_banco=='Banco ProCredit'){
			$banco_nombre2 = '058.PROCREDIT';
		}else if($banco_banco=='Banco Pichincha'){
			$banco_nombre2 = '060.PICHINCHA';
		}else if($banco_banco=='Bancoomeva'){
			$banco_nombre2 = '061.BANCOOMEVA';
		}else if($banco_banco=='Banco Finandina'){
			$banco_nombre2 = '063.FINANDINA';
		}else if($banco_banco=='Banco CoopCentral'){
			$banco_nombre2 = '066.COOPCENTRAL';
		}else if($banco_banco=='Compensar'){
			$banco_nombre2 = '083.COMPENSAR';
		}else if($banco_banco=='Aportes en linea'){
			$banco_nombre2 = '084.APORTES EN LINEA';
		}else if($banco_banco=='Asopagos'){
			$banco_nombre2 = '086.ASOPAGOS';
		}else if($banco_banco=='Fedecajas'){
			$banco_nombre2 = '087.FEDECAJAS';
		}else if($banco_banco=='Simple'){
			$banco_nombre2 = '088.SIMPLE';
		}else if($banco_banco=='Enlace Operativo'){
			$banco_nombre2 = '089.ENLACE OPERATIVO ';
		}else if($banco_banco=='CorfiColombiana'){
			$banco_nombre2 = '090.CORFICOLOMBIANA';
		}else if($banco_banco=='Old Mutual'){
			$banco_nombre2 = '502.OLD MUTUAL';
		}else if($banco_banco=='Cotrafa'){
			$banco_nombre2 = '289.COTRAFA';
		}else if($banco_banco=='Confiar'){
			$banco_nombre2 = '292.CONFIAR';
		}else if($banco_banco=='JurisCoop'){
			$banco_nombre2 = '121.JURISCOOP';
		}else if($banco_banco=='Deceval'){
			$banco_nombre2 = '550.DECEVAL';
		}else if($banco_banco=='Bancamia'){
			$banco_nombre2 = '059.BANCAMIA';
		}else if($banco_banco=='Nequi'){
			$banco_nombre2 = '507.NEQUI';
		}else if($banco_banco=='Falabella'){
			$banco_nombre2 = '062.FALABELLA';
		}else if($banco_banco=='DGCPTN'){
			$banco_nombre2 = '683.DGCPTN';
		}else if($banco_banco=='BANCO WWB'){
			$banco_nombre2 = '1053.BANCO WWB';
		}else if($banco_banco=='Cooperativa Financiera de Antioquia'){
			$banco_nombre2 = '1283.COOPERATIVA FINANCIERA DE ANTIOQUIA';
		}

		$sheet->setCellValue('F'.$fila, $banco_nombre2);

		$sheet->setCellValue('G'.$fila, $banco_nombre);

		$sheet->setCellValue('H'.$fila, 'Bogota');	

		$sheet->setCellValue('I'.$fila, '');

		$sheet->setCellValue('J'.$fila, '1-Abono en Cuenta');

		$sheet->setCellValue('K'.$fila, '');

		/****************************CALCULO TOTAL DEL PAGO PARA LA MODELO**********************/
		$total_dolares = $row1['total_dolares'];
		$total_pesos = $row1['total_pesos']*1;
		$trm = $row1['trm'];
		$rf_pesos = $rf;
		$total_final = $total_pesos+$monto_separacion2;
		$total_final = $total_final-$monto_separacion;
		$total_final = "$".number_format($total_final,2,',','');
		/****************************************************************************************/

		$sheet->setCellValue('L'.$fila, $total_final);

		$sheet->setCellValue('M'.$fila, '');

		$spreadsheet->getActiveSheet()->getCell('N'.$fila)->setValue($numero_documento);
		$spreadsheet->getActiveSheet()->getStyle('N'.$fila)->getNumberFormat()->setFormatCode('00');

		$sheet->setCellValue('O'.$fila, $nombre_modelo);
		$sheet->setCellValue('P'.$fila, $nombre_sede);

		$fila = $fila+1;
	}
}


$fecha_inicio = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('Registro de Banco '.$fecha_inicio.'.xlsx');
header("Location: Registro de Banco ".$fecha_inicio.".xlsx");

?>