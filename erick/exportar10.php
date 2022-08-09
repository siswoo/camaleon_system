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



$sheet->setCellValue('A1', 'Tabla Auxiliar - Terceros');



$sheet->setCellValue('A2', 'Autonumerico');

$sheet->setCellValue('B2', 'IdTipoIdentificacion');

$sheet->setCellValue('C2', 'Identificacion');

$sheet->setCellValue('D2', 'DV');

$sheet->setCellValue('E2', 'IdentificacionCiudad');

$sheet->setCellValue('F2', 'Código');

$sheet->setCellValue('G2', 'Primer Nombre');

$sheet->setCellValue('H2', 'Segundo Nombre');

$sheet->setCellValue('I2', 'Primer Apellido');

$sheet->setCellValue('J2', 'Segundo Apellido');

$sheet->setCellValue('K2', 'Propiedades');

$sheet->setCellValue('L2', 'Nota');

$sheet->setCellValue('M2', 'Activo');

$sheet->setCellValue('N2', 'Clasificación Uno');

$sheet->setCellValue('O2', 'Clasificación Dos');

$sheet->setCellValue('P2', 'Clasificación Tres');

$sheet->setCellValue('Q2', 'Propiedad Retencion');

$sheet->setCellValue('R2', 'Aplica ReteIca');

$sheet->setCellValue('S2', 'Tarifa Ica');

$sheet->setCellValue('T2', 'Lista de Precios');

$sheet->setCellValue('U2', 'Cargo');

$sheet->setCellValue('V2', 'FechaDeCreación');

$sheet->setCellValue('W2', 'Plazo');

$sheet->setCellValue('X2', 'Vendedor');

$sheet->setCellValue('Y2', 'Zona_Uno');

$sheet->setCellValue('Z2', 'Zona_Dos');

$sheet->setCellValue('AA2', 'Personalizado1');

$sheet->setCellValue('AB2', 'Personalizado2');

$sheet->setCellValue('AC2', 'Personalizado3');

$sheet->setCellValue('AD2', 'Personalizado4');

$sheet->setCellValue('AE2', 'Personalizado5');

$sheet->setCellValue('AF2', 'Personalizado6');

$sheet->setCellValue('AG2', 'Personalizado7');

$sheet->setCellValue('AH2', 'Personalizado8');

$sheet->setCellValue('AI2', 'Personalizado9');

$sheet->setCellValue('AJ2', 'Personalizado10');

$sheet->setCellValue('AK2', 'Personalizado11');

$sheet->setCellValue('AL2', 'Personalizado12');

$sheet->setCellValue('AM2', 'Personalizado13');

$sheet->setCellValue('AN2', 'Personalizado14');

$sheet->setCellValue('AO2', 'Personalizado15');

$sheet->setCellValue('AP2', 'Clasificación DIAN');

$sheet->setCellValue('AQ2', 'AplicaReteCree');

$sheet->setCellValue('AR2', 'Tarifa Rete CREE');

$sheet->setCellValue('AS2', 'Actividad Económica');

$sheet->setCellValue('AT2', 'Estado Civil');

$sheet->setCellValue('AU2', 'Sexo');

$sheet->setCellValue('AV2', 'Forma de pago predeterminada');

$sheet->setCellValue('AW2', '% Descuento');

$sheet->setCellValue('AX2', 'Fecha de Nacimiento');

$sheet->setCellValue('AY2', 'Banco');

$sheet->setCellValue('AZ2', 'Tipo de Cuenta');

$sheet->setCellValue('BA2', 'Número de Cuenta');



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



$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);

/*

$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);

$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);

$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);

$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);

$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(30);

*/



$sql1 = "SELECT * FROM presabana WHERE id = ".$presabana;

$consulta1 = mysqli_query($conexion,$sql1);

while($row1 = mysqli_fetch_array($consulta1)) {

	$inicio = $row1['inicio'];

	$fin = $row1['fin'];

}



$fila = 3;



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



			$sql4 = "SELECT * FROM medellin_temporal1 WHERE documento = ".$numero_documento;

			$consulta4 = mysqli_query($conexion,$sql4);

			$contador2 = mysqli_num_rows($consulta4);



			if($contador2==0){



				$tipo_documento = $row3['documento_tipo'];

				if($tipo_documento=='Cedula de Ciudadania'){

					$tipo_documento = 'CC';

				}else if($tipo_documento=='Cedula de Extranjeria'){

					$tipo_documento = 'Cedula de Extranjeria';

				}

				else if($tipo_documento=='Pasaporte'){

					$tipo_documento = 'Pasaporte';

				}

				else if($tipo_documento=='PEP'){

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



				$nombre1 = eliminar_acentos($nombre1);

				$nombre2 = eliminar_acentos($nombre2);

				$apellido1 = eliminar_acentos($apellido1);

				$apellido2 = eliminar_acentos($apellido2);



				//NO USO EL strtoupper PORQUE NO COPEA CON LOS Ñ los lleva en minúsculas.



				$nombre1 = mb_strtoupper($nombre1);

				$nombre2 = mb_strtoupper($nombre2);

				$apellido1 = mb_strtoupper($apellido1);

				$apellido2 = mb_strtoupper($apellido2);



				$sheet->setCellValue('A'.$fila, '');

				$sheet->setCellValue('B'.$fila, $tipo_documento);

				$sheet->setCellValue('C'.$fila, $numero_documento);

				$sheet->setCellValue('D'.$fila, '');

				$sheet->setCellValue('E'.$fila, 'Bogota D.C.');

				$sheet->setCellValue('F'.$fila, '');

				$sheet->setCellValue('G'.$fila, $nombre1);

				$sheet->setCellValue('H'.$fila, $nombre2);

				$sheet->setCellValue('I'.$fila, $apellido1);

				$sheet->setCellValue('J'.$fila, $apellido2);

				$sheet->setCellValue('K'.$fila, 'Proveeder;Empleado;Modelo;Cliente');

				$sheet->setCellValue('L'.$fila, '');

				$sheet->setCellValue('M'.$fila, '-1');

				$sheet->setCellValue('N'.$fila, '');

				$sheet->setCellValue('O'.$fila, '');

				$sheet->setCellValue('P'.$fila, '');

				$sheet->setCellValue('Q'.$fila, 'Persona Natural No Responsable del IVA');

				$sheet->setCellValue('R'.$fila, '0');

				$sheet->setCellValue('S'.$fila, '0');

				$sheet->setCellValue('T'.$fila, '');

				$sheet->setCellValue('U'.$fila, 'ASESOR CALL CENTER');

				$sheet->setCellValue('V'.$fila, '05/09/2019 10:47:50 a. m.');

				$sheet->setCellValue('W'.$fila, '0');

				$sheet->setCellValue('X'.$fila, '');

				$sheet->setCellValue('Y'.$fila, '');

				$sheet->setCellValue('Z'.$fila, '');

				$sheet->setCellValue('AA'.$fila, '');

				$sheet->setCellValue('AB'.$fila, '');

				$sheet->setCellValue('AC'.$fila, '');

				$sheet->setCellValue('AD'.$fila, '');

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

				$sheet->setCellValue('AO'.$fila, '');

				$sheet->setCellValue('AP'.$fila, 'Normal');

				$sheet->setCellValue('AQ'.$fila, '0');

				$sheet->setCellValue('AR'.$fila, '');

				$sheet->setCellValue('AS'.$fila, '');

				$sheet->setCellValue('AT'.$fila, '');

				$sheet->setCellValue('AU'.$fila, $genero);

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