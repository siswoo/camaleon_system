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

$sheet->setCellValue('A1', 'Nombre');
$sheet->setCellValue('B1', 'Tipo');
$sheet->setCellValue('C1', 'Documento');
$sheet->setCellValue('D1', 'Telefono');
$sheet->setCellValue('E1', 'Sede');
$sheet->setCellValue('F1', 'Fecha');
$sheet->setCellValue('G1', 'Firma');
$sheet->setCellValue('H1', 'Pasaporte');
$sheet->setCellValue('I1', 'Rut');
$sheet->setCellValue('J1', 'C.Bancaria');
$sheet->setCellValue('K1', 'EPS');
$sheet->setCellValue('L1', 'Ant Disciplinarios');
$sheet->setCellValue('M1', 'Ant Penales');
$sheet->setCellValue('N1', 'Bancarios');
$sheet->setCellValue('O1', 'Corporales');
$sheet->setCellValue('P1', 'Empresa');
$sheet->setCellValue('Q1', 'Cuentas');
$sheet->setCellValue('R1', 'Porcentaje');
$fila = 2;

session_start();
include('conexion.php');
$descargable = $_POST['descargable_guiaR'];

$html = '';
$fecha_desde = $_POST['fecha_desde_guiaRut'];
$fecha_hasta = $_POST['fecha_hasta_guiaRut'];
$sedePost = $_POST['sede_guiaR'];

if($sedePost==0){
	$sql1 = "SELECT * FROM modelos";
}else{
	$sql1 = "SELECT * FROM modelos WHERE sede = ".$sedePost;
}

$sql5 = "SELECT * FROM usuarios WHERE id = ".$_SESSION['id'];
$consulta5 = mysqli_query($conexion,$sql5);
while($row5 = mysqli_fetch_array($consulta5)) {
	$usuario_documento = $row5['documento_numero'];
}

if($usuario_documento==1001184301 or $usuario_documento==1000850867 or $usuario_documento==1023886014 or $usuario_documento==24616438){
	$sql1 = "SELECT * FROM modelos WHERE sede = ".$_SESSION['sede'];
}

//FALTA JORGE, KENLLY POR USUARIOS

$consulta1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($consulta1)) {
	$modelo_id = $row1['id'];
	$modelo_sede = $row1['sede'];
	$documento_tipo = $row1['documento_tipo'];
	$documento_numero = $row1['documento_numero'];
	$modelo_nombre_completo = $row1['nombre1']." ".$row1['nombre2']." ".$row1['apellido1']." ".$row1['apellido2'];
	$fecha_inicio = $row1['fecha_inicio'];
	$telefono1 = $row1['telefono1'];

	$banco_cedula = $row1['banco_cedula'];
	$altura = $row1['altura'];
	$turno = $row1['turno'];

	$sql2 = "SELECT * FROM modelos_cuentas WHERE id_modelos = ".$modelo_id." and estatus = 'Aprobada'";
	$consulta2 = mysqli_query($conexion,$sql2);
	$contador2 = mysqli_num_rows($consulta2);

	$contador_tokens1 = 0;
	$contador_tokens_chaturbate1 = 0;
	$contador_tokens_myfreecams1 = 0;
	$contador_tokens_camsoda1 = 0;
	$contador_tokens_bonga1 = 0;
	$contador_tokens_stripchat1 = 0;
	$contador_tokens_cam41 = 0;
	$contador_tokens_streamate1 = 0;
	$contador_tokens_flirt4free1 = 0;
	$contador_tokens_livejasmin1 = 0;
	$contador_tokens_imlive1 = 0;
	$contador_tokens_xlove1 = 0;

	$contador_dolares_chaturbate1 = 0;
	$contador_dolares_myfreecams1 = 0;
	$contador_dolares_camsoda1 = 0;
	$contador_dolares_bonga1 = 0;
	$contador_dolares_stripchat1 = 0;
	$contador_dolares_cam41 = 0;
	$contador_dolares_streamate1 = 0;
	$contador_dolares_flirt4free1 = 0;
	$contador_dolares_livejasmin1 = 0;
	$contador_dolares_imlive1 = 0;
	$contador_dolares_xlove1 = 0;

	$contador_documentos1 = 0;
	$contador_documentos2 = 0;
	$contador_documentos3 = 0;
	$contador_documentos4 = 0;
	$contador_documentos5 = 0;
	$contador_documentos6 = 0;
	$contador_documentos7 = 0;
	$contador_documentos8 = 0;
	$contador_documentos9 = 0;
	$contador_documentos10 = 0;
	$contador_documentos11 = 0;
	$contador_documentos12 = 0;
	$contador_documentos13 = 0;

	$contador_porcentaje = 0;

	/**************CONSULTA DE PAGINAS************/

	while($row2 = mysqli_fetch_array($consulta2)) {
		
		if($row2['id_paginas']==1){
			$sql_paginas1 = "SELECT * FROM chaturbate WHERE nickname = '".$row2['usuario']."' and fecha BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_chaturbate1 = $contador_tokens_chaturbate1 + $row3['tokens'];
				$contador_dolares_chaturbate1 = $contador_dolares_chaturbate1 + $row3['payout'];
			}
		}

		if($row2['id_paginas']==2){
			$sql_paginas1 = "SELECT * FROM myfreecams WHERE id_modelo = ".$modelo_id." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_myfreecams1 = $contador_tokens_myfreecams1 + $row3['tokens'];
				$contador_dolares_myfreecams1 = $contador_dolares_myfreecams1 + $row3['dolares'];
			}
		}

		if($row2['id_paginas']==3){
			$sql_paginas1 = "SELECT * FROM camsoda WHERE id_modelo = ".$modelo_id." and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and  fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_camsoda1 = $contador_tokens_camsoda1 + $row3['tokens'];
				$contador_dolares_camsoda1 = $contador_dolares_camsoda1 + $row3['dolares'];
			}
		}

		if($row2['id_paginas']==4){
			$sql_paginas1 = "SELECT * FROM bonga WHERE nickname = '".$row2['usuario']."' and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and  fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_bonga1 = $contador_tokens_bonga1 + $row3['tokens'];
				$contador_dolares_bonga1 = $contador_dolares_bonga1 + $row3['dolares'];
			}
		}

		if($row2['id_paginas']==5){
			$sql_paginas1 = "SELECT * FROM stripchat WHERE nickname = '".$row2['usuario']."' and fecha BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_stripchat1 = $contador_tokens_stripchat1 + $row3['tokens'];
				$contador_dolares_stripchat1 = $contador_dolares_stripchat1 + $row3['dolares'];
			}
		}

		if($row2['id_paginas']==6){
			$sql_paginas1 = "SELECT * FROM cam4 WHERE nickname = '".$row2['usuario']."' and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and  fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_cam41 = $contador_tokens_cam41 + $row3['tokens'];
				$contador_dolares_cam41 = $contador_dolares_cam41 + $row3['dolares'];
			}
		}

		if($row2['id_paginas']==7){
			$sql_paginas1 = "SELECT * FROM streamate WHERE nickname = '".$row2['usuario']."' and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and  fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_streamate1 = $contador_tokens_streamate1 + $row3['tokens'];
				$contador_dolares_streamate1 = $contador_dolares_streamate1 + $row3['ganancia'];
			}
		}

		if($row2['id_paginas']==8){
			$sql_paginas1 = "SELECT * FROM flirt4free WHERE id_modelo = '".$modelo_id."' and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and  fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_flirt4free1 = $contador_tokens_flirt4free1 + $row3['tokens'];
				$contador_dolares_flirt4free1 = $contador_dolares_flirt4free1 + $row3['dolares'];
			}
		}

		if($row2['id_paginas']==9){
			$sql_paginas1 = "SELECT * FROM livejasmin WHERE id_modelo = '".$modelo_id."' and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and  fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_livejasmin1 = $contador_tokens_livejasmin1 + $row3['tokens'];
				$contador_dolares_livejasmin1 = $contador_dolares_livejasmin1 + $row3['dolares'];
			}
		}

		if($row2['id_paginas']==10){
			$sql_paginas1 = "SELECT * FROM imlive WHERE nickname = '".$row2['usuario']."' and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and  fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_imlive1 = $contador_tokens_imlive1 + $row3['tokens'];
				$contador_dolares_imlive1 = $contador_dolares_imlive1 + $row3['dolares'];
			}
		}

		if($row2['id_paginas']==11){
			$sql_paginas1 = "SELECT * FROM xlove WHERE nickname = '".$row2['usuario']."' and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and  fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
			$consulta_paginas1 = mysqli_query($conexion,$sql_paginas1);
			while($row3 = mysqli_fetch_array($consulta_paginas1)) {
				$contador_tokens_xlove1 = $contador_tokens_xlove1 + $row3['tokens'];
				$contador_dolares_xlove1 = $contador_dolares_xlove1 + $row3['dolares'];
			}
		}

		$sql3 = "SELECT * FROM sedes WHERE id = ".$modelo_sede;
		$consulta3 = mysqli_query($conexion,$sql3);
		while($row3 = mysqli_fetch_array($consulta3)) {
			$nombre_sede = $row3['nombre'];
		}

	}

	$total_tokens = $contador_tokens_chaturbate1+$contador_tokens_myfreecams1+$contador_tokens_camsoda1+$contador_tokens_bonga1+$contador_tokens_stripchat1+$contador_tokens_cam41+$contador_tokens_streamate1+$contador_tokens_flirt4free1+$contador_tokens_livejasmin1+$contador_tokens_imlive1+$contador_tokens_xlove1;

	$sql4 = "SELECT * FROM modelos_documentos WHERE id_modelos = ".$modelo_id;
	$consulta4 = mysqli_query($conexion,$sql4);
	$contador1 = mysqli_num_rows($consulta4);
	while($row4 = mysqli_fetch_array($consulta4)) {
		if($row4['id_documentos']==1){
			$contador_documentos1 = 1;
			$tipo_documento1 = $row4['tipo'];
		}

		if($row4['id_documentos']==3){
			$contador_documentos3 = 1;
			$tipo_documento3 = $row4['tipo'];
		}

		if($row4['id_documentos']==4){
			$contador_documentos4 = 1;
			$tipo_documento4 = $row4['tipo'];
		}

		if($row4['id_documentos']==5){
			$contador_documentos5 = 1;
			$tipo_documento5 = $row4['tipo'];
		}

		if($row4['id_documentos']==6){
			$contador_documentos6 = 1;
			$tipo_documento6 = $row4['tipo'];
		}

		if($row4['id_documentos']==7){
			$contador_documentos7 = 1;
			$tipo_documento7 = $row4['tipo'];
		}

		if($row4['id_documentos']==11){
			$contador_documentos11 = 1;
			$tipo_documento11 = $row4['tipo'];
		}
	}

	if($total_tokens>=1){
		$html .= '
			<tr>
				<td>'.$modelo_nombre_completo.'</td>
				<td>'.$documento_tipo.'</td>
				<td>'.$documento_numero.'</td>
				<td>'.$telefono1.'</td>
				<td>'.$nombre_sede.'</td>
				<td>'.$fecha_inicio.'</td>
		';

		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(40);
		$sheet->setCellValue('A'.$fila, $modelo_nombre_completo);

		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$sheet->setCellValue('B'.$fila, $documento_tipo);

		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$spreadsheet->getActiveSheet()->getCell('C'.$fila)->setValue($documento_numero);
		$spreadsheet->getActiveSheet()->getStyle('C'.$fila)->getNumberFormat()->setFormatCode('00');
		$sheet->getStyle('C'.$fila)->getAlignment()->setHorizontal('left');

		$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$sheet->setCellValue('D'.$fila, $telefono1);

		$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$sheet->setCellValue('E'.$fila, $nombre_sede);

		$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$sheet->setCellValue('F'.$fila, $fecha_inicio);

		if($contador_documentos1==1){
			$contador_porcentaje = $contador_porcentaje+10;
			if($tipo_documento1=='jpg' or $tipo_documento1=='jpeg'){
				$html .= '
				<td>
					<a href="../resources/documentos/modelos/archivos/'.$modelo_id.'/firma_digital.jpg" data-lightbox="Documentos_'.$modelo_id.'" data-title="Firma Digital">
						<img src="../img/icons/check_ok1.png" style="width:25px;">
					</a>
				</td>
				';
			}else{
				$html .= '
				<td>
					<a href="../resources/documentos/modelos/archivos/'.$modelo_id.'/firma_digital.pdf" target="_blank">
						<img src="../img/icons/check_ok1.png" style="width:25px;">
					</a>
				</td>';
			}

			$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(10);
			$sheet->setCellValue('G'.$fila, 'Si');

		}else{
			$html .= '
				<td>
					<img src="../img/icons/no1.png" style="width:25px;" data-title="Firma Digital">
				</td>
			';

			$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(10);
			$sheet->setCellValue('G'.$fila, 'No');
		}

		if($contador_documentos3==1){
			$contador_porcentaje = $contador_porcentaje+10;
			if($tipo_documento3=='jpg' or $tipo_documento3=='jpeg'){
				$html .= '
				<td>
					<a href="../resources/documentos/modelos/archivos/'.$modelo_id.'/pasaporte.jpg" data-lightbox="Documentos_'.$modelo_id.'" data-title="Pasaporte">
						<img src="../img/icons/check_ok1.png" style="width:25px;">
					</a>
				</td>';
			}else{
				$html .= '
				<td>
					<a href="../resources/documentos/modelos/archivos/'.$modelo_id.'/pasaporte.pdf" target="_blank">
						<img src="../img/icons/check_ok1.png" style="width:25px;">
					</a>
				</td>';
			}

			$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(10);
			$sheet->setCellValue('H'.$fila, 'Si');
		}else{
			$html .= '
				<td>
					<img src="../img/icons/no1.png" style="width:25px;" data-title="Pasaporte">
				</td>
			';

			$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(10);
			$sheet->setCellValue('H'.$fila, 'No');
		}

		if($contador_documentos4==1){
			$contador_porcentaje = $contador_porcentaje+10;
			if($tipo_documento4=='jpg' or $tipo_documento4=='jpeg'){
				$html .= '
				<td>
					<a href="../resources/documentos/modelos/archivos/'.$modelo_id.'/rut.jpg" data-lightbox="Documentos_'.$modelo_id.'" data-title="RUT">
						<img src="../img/icons/check_ok1.png" style="width:25px;">
					</a>
				</td>';
			}else{
				$html .= '
				<td>
					<a href="../resources/documentos/modelos/archivos/'.$modelo_id.'/rut.pdf" target="_blank">
						<img src="../img/icons/check_ok1.png" style="width:25px;">
					</a>
				</td>';
			}

			$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(10);
			$sheet->setCellValue('I'.$fila, 'Si');
		}else{
			$html .= '
				<td>
					<img src="../img/icons/no1.png" style="width:25px;" data-title="RUT">
				</td>
			';

			$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(10);
			$sheet->setCellValue('I'.$fila, 'No');
		}

		if($contador_documentos5==1){
			$contador_porcentaje = $contador_porcentaje+10;
			if($tipo_documento5=='jpg' or $tipo_documento5=='jpeg'){
				$html .= '
				<td>
					<a href="../resources/documentos/modelos/archivos/'.$modelo_id.'/certificacion_bancaria.jpg" data-lightbox="Documentos_'.$modelo_id.'" data-title="Certificacion Bancario">
						<img src="../img/icons/check_ok1.png" style="width:25px;">
					</a>
				</td>';
			}else{
				$html .= '
				<td>
					<a href="../resources/documentos/modelos/archivos/'.$modelo_id.'/certificacion_bancaria.pdf" target="_blank" Bancario">
						<img src="../img/icons/check_ok1.png" style="width:25px;">
					</a>
				</td>';
			}

			$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(10);
			$sheet->setCellValue('J'.$fila, 'Si');
		}else{
			$html .= '
				<td>
					<img src="../img/icons/no1.png" style="width:25px;" data-title="Certificacion Bancario">
				</td>
			';

			$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(10);
			$sheet->setCellValue('J'.$fila, 'No');
		}

		if($contador_documentos6==1){
			$contador_porcentaje = $contador_porcentaje+10;
			if($tipo_documento6=='jpg' or $tipo_documento6=='jpeg'){
				$html .= '
				<td>
					<a href="../resources/documentos/modelos/archivos/'.$modelo_id.'/certificacion_bancaria.jpg" data-lightbox="Documentos_'.$modelo_id.'" data-title="Certificacion Bancario">
						<img src="../img/icons/check_ok1.png" style="width:25px;">
					</a>
				</td>';
			}else{
				$html .= '
				<td>
					<a href="../resources/documentos/modelos/archivos/'.$modelo_id.'/certificacion_bancaria.pdf" target="_blank" Bancario">
						<img src="../img/icons/check_ok1.png" style="width:25px;">
					</a>
				</td>';
			}

			$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(10);
			$sheet->setCellValue('K'.$fila, 'Si');
		}else{
			$html .= '
				<td>
					<img src="../img/icons/no1.png" style="width:25px;" data-title="Certificacion Bancario">
				</td>
			';

			$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(10);
			$sheet->setCellValue('K'.$fila, 'No');
		}

		if($contador_documentos7==1){
			$contador_porcentaje = $contador_porcentaje+10;
			if($tipo_documento7=='jpg' or $tipo_documento7=='jpeg'){
				$html .= '
				<td>
					<a href="../resources/documentos/modelos/archivos/'.$modelo_id.'/antecedentes_disciplinarios.jpg" data-lightbox="Documentos_'.$modelo_id.'" data-title="Antecedentes Disciplinarios">
						<img src="../img/icons/check_ok1.png" style="width:25px;">
					</a>
				</td>';
			}else{
				$html .= '
				<td>
					<a href="../resources/documentos/modelos/archivos/'.$modelo_id.'/antecedentes_disciplinarios.pdf" target="_blank" Disciplinarios">
						<img src="../img/icons/check_ok1.png" style="width:25px;">
					</a>
				</td>';
			}

			$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(10);
			$sheet->setCellValue('L'.$fila, 'Si');
		}else{
			$html .= '
				<td>
					<img src="../img/icons/no1.png" style="width:25px;" data-title="Antecedentes Disciplinarios">
				</td>
			';

			$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(10);
			$sheet->setCellValue('L'.$fila, 'No');
		}

		if($contador_documentos11==1){
			$contador_porcentaje = $contador_porcentaje+10;
			if($tipo_documento11=='jpg' or $tipo_documento11=='jpeg'){
				$html .= '
				<td>
					<a href="../resources/documentos/modelos/archivos/'.$modelo_id.'/antecedentes_penales.jpg" data-lightbox="Documentos_'.$modelo_id.'" data-title="Antecedentes Penales">
						<img src="../img/icons/check_ok1.png" style="width:25px;">
					</a>
				</td>';
			}else{
				$html .= '
				<td>
					<a href="../resources/documentos/modelos/archivos/'.$modelo_id.'/antecedentes_penales.pdf" target="_blank">
						<img src="../img/icons/check_ok1.png" style="width:25px;">
					</a>
				</td>';
			}

			$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(10);
			$sheet->setCellValue('M'.$fila, 'Si');
		}else{
			$html .= '
				<td>
					<img src="../img/icons/no1.png" style="width:25px;" data-title="Antecedentes Penales">
				</td>
			';

			$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(10);
			$sheet->setCellValue('M'.$fila, 'No');
		}

		if($banco_cedula!=''){
			$contador_cedula = 25;
			$contador_porcentaje = $contador_porcentaje+10;
			$html .= '
				<td>
					<img src="../img/icons/check_ok1.png" style="width:25px;" data-title="cedula">
				</td>
			';

			$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(10);
			$sheet->setCellValue('N'.$fila, 'Si');
		}else{
			$contador_cedula = 0;
			$html .= '
				<td>
					<img src="../img/icons/no1.png" style="width:25px;" data-title="cedula">
				</td>
			';

			$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(10);
			$sheet->setCellValue('N'.$fila, 'No');
		}

		if($altura!=''){
			$contador_altura = 25;
			$contador_porcentaje = $contador_porcentaje+10;
			$html .= '
				<td>
					<img src="../img/icons/check_ok1.png" style="width:25px;" data-title="altura">
				</td>
			';

			$spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(10);
			$sheet->setCellValue('O'.$fila, 'Si');
		}else{
			$contador_altura = 0;
			$html .= '
				<td>
					<img src="../img/icons/no1.png" style="width:25px;" data-title="altura">
				</td>
			';

			$spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(10);
			$sheet->setCellValue('O'.$fila, 'No');
		}

		if($turno!=''){
			$contador_turno = 25;
			$contador_porcentaje = $contador_porcentaje+10;
			$html .= '
				<td>
					<img src="../img/icons/check_ok1.png" style="width:25px;" data-title="turno">
				</td>
			';

			$spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(10);
			$sheet->setCellValue('P'.$fila, 'Si');
		}else{
			$contador_turno = 0;
			$html .= '
				<td>
					<img src="../img/icons/no1.png" style="width:25px;" data-title="turno">
				</td>
			';

			$spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(10);
			$sheet->setCellValue('P'.$fila, 'No');
		}

		//$contador_porcentaje = $contador_porcentaje+25+$contador_cedula+$contador_altura+$contador_turno;

		$html .= '
				<td>
					'.$contador2.'
				</td>
				<td>'.$contador_porcentaje.'%</td>
			</tr>
		';

		$spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(10);
		$sheet->setCellValue('Q'.$fila, $contador2);
		$spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(10);
		$sheet->setCellValue('R'.$fila, $contador_porcentaje);

		$fila = $fila+1;
	}

}

if($descargable=="Si"){
	$fecha_inicio1 = date('Y-m-d');
	$writer = new Xlsx($spreadsheet);
	$writer->save('consulta_table1 '.$fecha_inicio1.'.xlsx');
	header("Location: consulta_table1 ".$fecha_inicio1.".xlsx");
}

echo $html;

?>