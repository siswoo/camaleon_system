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

$presabana = $_GET['tm_select_presabanas'];

$sheet->setCellValue('A1', 'Tipo Identificación');
$sheet->setCellValue('B1', 'Identificación');
$sheet->getStyle('B1')->getAlignment()->setHorizontal('right');
$sheet->setCellValue('C1', 'Identificación Ciudad ');
$sheet->setCellValue('D1', 'Primer Nombre');
$sheet->setCellValue('E1', 'Segundo Nombre');
$sheet->setCellValue('F1', 'Primer Apellido');
$sheet->setCellValue('G1', 'Segundo Apellido');
$sheet->setCellValue('H1', 'Tipo Contrato');
$sheet->setCellValue('I1', 'Fecha Ingreso');
$sheet->setCellValue('J1', 'Area');
$sheet->setCellValue('K1', 'Clase');
$sheet->setCellValue('L1', 'Empresa');
$sheet->setCellValue('M1', 'Cargo');
$sheet->setCellValue('N1', 'Sueldo');
$sheet->setCellValue('O1', 'Periodo Pago');
$sheet->setCellValue('P1', 'Centro Costos');
$sheet->setCellValue('Q1', 'Clasificación Dian');
$sheet->setCellValue('R1', 'Cesantias');
$sheet->setCellValue('S1', 'IntCesantias');
$sheet->setCellValue('T1', 'Prima ');
$sheet->setCellValue('U1', 'Vacaciones');
$sheet->setCellValue('V1', 'Ret. Fte');
$sheet->setCellValue('W1', 'Fecha Nacimiento');
$sheet->setCellValue('X1', 'Ciudad');
$sheet->setCellValue('Y1', 'Tipo Dirección');
$sheet->setCellValue('Z1', 'Direccion');
$sheet->setCellValue('AA1', 'Teléfono');
$sheet->setCellValue('AB1', 'E_Mail');
$sheet->setCellValue('AC1', 'Número hijos');
$sheet->setCellValue('AD1', 'Estado Civil');
$sheet->setCellValue('AE1', 'Declarante');
$sheet->setCellValue('AF1', 'Dotación');
$sheet->setCellValue('AG1', 'Tipo Cuenta ');
$sheet->setCellValue('AH1', 'Número Cuenta ');
$sheet->setCellValue('AI1', 'Banco Cuenta');
$sheet->setCellValue('AJ1', 'Tipo Sena');
$sheet->setCellValue('AK1', 'Fecha Fin Periodo Prueba');
$sheet->setCellValue('AL1', 'Fecha Fin Contrato');
$sheet->setCellValue('AM1', 'ARL');
$sheet->setCellValue('AN1', 'Fecha Afil. ARL');
$sheet->setCellValue('AO1', 'Tarifa ARL');
$sheet->setCellValue('AP1', 'EPS');
$sheet->setCellValue('AQ1', 'Fecha Afil. EPS');
$sheet->setCellValue('AR1', 'Pensión');
$sheet->setCellValue('AS1', 'Fecha Afil. AFP');
$sheet->setCellValue('AT1', 'Fondo Cesantias');
$sheet->setCellValue('AU1', 'Fecha Afil. Fondo Cesantías');
$sheet->setCellValue('AV1', 'Caja');
$sheet->setCellValue('AW1', 'Fecha Afil. Caja');
$sheet->setCellValue('AX1', 'Código Centro Costos');
$sheet->setCellValue('AY1', 'Libreta Militar No.');
$sheet->setCellValue('AZ1', 'Sexo');

/***************LIBRERIA DE ACENTOS*****************/
function eliminar_acentos($cadena){
		
	//Reemplazamos la A y a
	$cadena = str_replace(
		array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
		array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
		$cadena
	);

	//Reemplazamos la E y e
	$cadena = str_replace(
		array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
		array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
	$cadena );

	//Reemplazamos la I y i
	$cadena = str_replace(
		array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
		array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
	$cadena );

	//Reemplazamos la O y o
	$cadena = str_replace(
		array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
		array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
	$cadena );

	//Reemplazamos la U y u
	$cadena = str_replace(
		array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
		array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
	$cadena );

	//Reemplazamos la N, n, C y c
	/*
	$cadena = str_replace(
		array('Ñ', 'ñ', 'Ç', 'ç'),
		array('N', 'n', 'C', 'c'),
	$cadena );
	*/
	return $cadena;
}
/************************************************************/

function eliminar_especiales($cadena){
	$cadena = str_replace(
		array('.',',','#','-','*','º','·'),
		array('','','','','','',''),
		$cadena
	);
	return $cadena;
}

$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('X')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('Z')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('AA')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('AB')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AC')->setWidth(15);

$sql1 = "SELECT * FROM presabana WHERE id = ".$presabana;
$consulta1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($consulta1)) {
	$inicio = $row1['inicio'];
	$fin = $row1['fin'];
}

$fila = 2;

$sql2 = "SELECT * FROM presabana WHERE inicio = '".$inicio."' and fin = '".$fin."'";
$consulta2 = mysqli_query($conexion,$sql2);
while($row2 = mysqli_fetch_array($consulta2)) {
	$total_pesos = $row2['total_pesos'];
	$sql3 = "SELECT * FROM modelos WHERE id = ".$row2['id_modelo'];
	$consulta3 = mysqli_query($conexion,$sql3);
	$contador1 = mysqli_num_rows($consulta3);

	if($contador1>=1 && $total_pesos>=1){
		while($row3 = mysqli_fetch_array($consulta3)) {

			$numero_documento = $row3['documento_numero'];

			$sql4 = "SELECT * FROM medellin_temporal1 WHERE identificacion = ".$numero_documento;
			$consulta4 = mysqli_query($conexion,$sql4);
			$contador2 = mysqli_num_rows($consulta4);

			if($contador2==0){

				$tipo_documento = $row3['documento_tipo'];

				if($tipo_documento=='Cedula de Ciudadania'){
					$tipo_documento = 'CC';
				}else if($tipo_documento=='Cedula de Extranjeria' or $tipo_documento=='PEP'){
					$tipo_documento = 'Documento de identificación extranjero';
				}else if($tipo_documento=='Pasaporte'){
					$tipo_documento = 'PASAPORTE';
				}else if($tipo_documento=='PEP'){
					$tipo_documento = 'PEP';
				}

				$nombre1 = $row3['nombre1'];
				$nombre2 = $row3['nombre2'];
				$apellido1 = $row3['apellido1'];
				$apellido2 = $row3['apellido2'];
				$genero = $row3['genero'];
				if($genero=='Transexual'){
					$genero = 'Hombre';
				}

				$sede = $row3['sede'];
				$sql5 = "SELECT * FROM sedes WHERE id = ".$sede;
				$consulta5 = mysqli_query($conexion,$sql5);
				while($row5 = mysqli_fetch_array($consulta5)) {
					$sede_nombre = $row5['nombre'];
				}

				if($sede_nombre=='VIP Occidente'){
					$sede_nombre = 'VIP';
				}

				if($sede_nombre=='VIP Suba'){
					$sede_nombre = 'Suba';
				}

				if($sede_nombre=='Occidente I'){
					$sede_nombre = 'Occidente 1';
				}

				$direccion = $row3['direccion'];
				$telefono1 = $row3['telefono1'];
				$correo = $row3['correo'];

				$nombre1 = eliminar_acentos($nombre1);
				$nombre2 = eliminar_acentos($nombre2);
				$apellido1 = eliminar_acentos($apellido1);
				$apellido2 = eliminar_acentos($apellido2);

				//NO USO EL strtoupper PORQUE NO COPEA CON LOS Ñ los lleva en minúsculas.

				$nombre1 = mb_strtoupper($nombre1);
				$nombre2 = mb_strtoupper($nombre2);
				$apellido1 = mb_strtoupper($apellido1);
				$apellido2 = mb_strtoupper($apellido2);

				$sheet->setCellValue('A'.$fila, $tipo_documento);

				$sheet->setCellValue('B'.$fila, $numero_documento);
				$spreadsheet->getActiveSheet()->getStyle('B'.$fila)->getNumberFormat()->setFormatCode('00');
				$sheet->getStyle('B'.$fila)->getAlignment()->setHorizontal('right');

				$sheet->setCellValue('C'.$fila, 'Bogota D.C.');
				$sheet->setCellValue('D'.$fila, $nombre1);
				$sheet->setCellValue('E'.$fila, $nombre2);
				$sheet->setCellValue('F'.$fila, $apellido1);
				$sheet->setCellValue('G'.$fila, $apellido2);
				$sheet->setCellValue('H'.$fila, 'Indefinido');
				
				//$fecha_generada1 = date('d-m-Y');
				//$inicio2 = date("d/m/Y", strtotime($inicio));
				$sheet->setCellValue('I'.$fila, $inicio);
				$sheet->getStyle('I'.$fila)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DDMMYYYY);

				$sheet->setCellValue('J'.$fila, 'Administrativa');
				$sheet->setCellValue('K'.$fila, 'Normal');
				$sheet->setCellValue('L'.$fila, 'BERNAL GROUP S.A.S');
				$sheet->setCellValue('M'.$fila, 'MODELO NUEVO');
				$sheet->setCellValue('N'.$fila, '1');
				$sheet->setCellValue('O'.$fila, 'Quincenal');
				$sheet->setCellValue('P'.$fila, $sede_nombre);
				$sheet->setCellValue('Q'.$fila, 'Normal');
				$sheet->setCellValue('R'.$fila, '0');
				$sheet->setCellValue('S'.$fila, '0');
				$sheet->setCellValue('T'.$fila, '0');
				$sheet->setCellValue('U'.$fila, '0');
				$sheet->setCellValue('V'.$fila, '0');
				$sheet->setCellValue('W'.$fila, '');
				$sheet->setCellValue('X'.$fila, 'Bogota D.C.');
				$sheet->setCellValue('Y'.$fila, 'Casa');

				$direccion = eliminar_acentos($direccion);
				$direccion = mb_strtoupper($direccion);
				$direccion = eliminar_especiales($direccion);
				$sheet->setCellValue('Z'.$fila, $direccion);

				$sheet->setCellValue('AA'.$fila, $telefono1);
				$sheet->setCellValue('AB'.$fila, $correo);
				$sheet->setCellValue('AC'.$fila, '');
				$sheet->setCellValue('AD'.$fila, 'Soltero');
				$sheet->setCellValue('AE'.$fila, '');
				$sheet->setCellValue('AF'.$fila, '');
				$sheet->setCellValue('AG'.$fila, '');
				$sheet->setCellValue('AH'.$fila, '');
				$sheet->setCellValue('AI'.$fila, '');
				$sheet->setCellValue('AJ'.$fila, '');
				$sheet->setCellValue('AK'.$fila, '');
				$sheet->setCellValue('AL'.$fila, '');
				$sheet->setCellValue('AM'.$fila, '');
				$sheet->setCellValue('AN'.$fila, '');
				$sheet->setCellValue('AO'.$fila, '6,96%');
				$sheet->setCellValue('AP'.$fila, '');
				$sheet->setCellValue('AQ'.$fila, '');
				$sheet->setCellValue('AR'.$fila, '');
				$sheet->setCellValue('AS'.$fila, '');
				$sheet->setCellValue('AT'.$fila, '');
				$sheet->setCellValue('AU'.$fila, '');
				$sheet->setCellValue('AV'.$fila, '');
				$sheet->setCellValue('AW'.$fila, '');
				$sheet->setCellValue('AX'.$fila, '');
				$sheet->setCellValue('AY'.$fila, '');
				$sheet->setCellValue('AZ'.$fila, '');
				$sheet->setCellValue('BA'.$fila, '');
				$fila = $fila+1;

			}
		}
	}
}

$fecha_inicio = date('Y-m-d');
$writer = new Xlsx($spreadsheet);
$writer->save('terceros_medellin '.$fecha_inicio.'.xlsx');
header("Location: terceros_medellin ".$fecha_inicio.".xlsx");


?>