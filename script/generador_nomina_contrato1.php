<?php
session_start();
include('conexion.php');
require('../resources/fpdf/fpdf.php');

$sql1 = "SELECT * FROM nomina WHERE id = ".$_SESSION["id"];
$proceso1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($proceso1)) {
	$nombre = $row1["nombre"];
	$apellido = $row1["apellido"];
	$documento_tipo = $row1["documento_tipo"];
	$documento_numero = $row1["documento_numero"];
	$direccion = $row1["direccion"];
	$telefono = $row1["telefono"];
	$cargo = $row1["cargo"];
	$salario = $row1["salario"];
	$funcion = $row1["funcion"];
	$sede = $row1["sede"];
	$contrato = $row1["contrato"];
	$fecha_ingreso = $row1["fecha_ingreso"];
}

$sql2 = "SELECT * FROM funciones WHERE id = ".$funcion;
$proceso2 = mysqli_query($conexion,$sql2);
while($row2 = mysqli_fetch_array($proceso2)) {
	$funcion_nombre = $row2["nombre"];
	$funcion_descripcion1 = $row2["descripcion1"];
	$funcion_descripcion2 = $row2["descripcion2"];
	$funcion_descripcion3 = $row2["descripcion3"];
	$funcion_descripcion4 = $row2["descripcion4"];
	$funcion_descripcion5 = $row2["descripcion5"];
	$funcion_descripcion6 = $row2["descripcion6"];
	$funcion_descripcion7 = $row2["descripcion7"];
	$funcion_descripcion8 = $row2["descripcion8"];
	$funcion_descripcion9 = $row2["descripcion9"];
	$funcion_descripcion10 = $row2["descripcion10"];
	$funcion_descripcion11 = $row2["descripcion11"];
	$funcion_descripcion12 = $row2["descripcion12"];
	$funcion_descripcion13 = $row2["descripcion13"];
	$funcion_descripcion14 = $row2["descripcion14"];
	$funcion_descripcion15 = $row2["descripcion15"];
	$funcion_responsable = $row2["responsable"];
	$funcion_fecha_inicio = $row2["fecha_inicio"];
}

$sql3 = "SELECT * FROM sedes WHERE id = ".$sede;
$proceso3 = mysqli_query($conexion,$sql3);
while($row3 = mysqli_fetch_array($proceso3)) {
	$sede_nombre = $row3["nombre"];
	$sede_direccion = $row3["direccion"];
	$sede_ciudad = $row3["ciudad"];
	$sede_descripcion = $row3["descripcion"];
	$sede_responsable = $row3["responsable"];
	$sede_cedula = $row3["cedula"];
	$sede_rut = $row3["rut"];
}

$sql4 = "SELECT * FROM n_archivos WHERE id_documento = 8 and id_nomina = ".$_SESSION["id"];
$proceso4 = mysqli_query($conexion,$sql4);
$contador1 = mysqli_num_rows($proceso4);

$sql5 = "SELECT * FROM cargos WHERE id = ".$cargo;
$proceso5 = mysqli_query($conexion,$sql5);
while($row5 = mysqli_fetch_array($proceso5)) {
	$cargo_nombre = $row5["nombre"];
}

$archivo_fecha_inicio = "";
$archivo_id = "";

if($contador1>=1){
	while($row4 = mysqli_fetch_array($proceso4)) {
		$archivo_fecha_inicio = $row4["fecha_inicio"];
		$archivo_id = $row4["id"];
	}
	$array_fecha_inicio = explode("-",$archivo_fecha_inicio);

	switch ($array_fecha_inicio[1]) {
		case '01':
			$mes = "enero";
		break;

		case '02':
			$mes = "febrero";
		break;

		case '03':
			$mes = "marzo";
		break;

		case '04':
			$mes = "abril";
		break;

		case '05':
			$mes = "mayo";
		break;

		case '06':
			$mes = "junio";
		break;

		case '07':
			$mes = "julio";
		break;

		case '08':
			$mes = "agosto";
		break;

		case '09':
			$mes = "septiembre";
		break;

		case '10':
			$mes = "octubre";
		break;

		case '11':
			$mes = "noviembre";
		break;

		case '12':
			$mes = "diciembre";
		break;
		
		default:
			# code...
			break;
	}
}

$array_fecha_ingreso = explode("-",$fecha_ingreso);
	switch ($array_fecha_ingreso[1]) {
		case '01':
			$mes2 = "enero";
		break;

		case '02':
			$mes2 = "febrero";
		break;

		case '03':
			$mes2 = "marzo";
		break;

		case '04':
			$mes2 = "abril";
		break;

		case '05':
			$mes2 = "mayo";
		break;

		case '06':
			$mes2 = "junio";
		break;

		case '07':
			$mes2 = "julio";
		break;

		case '08':
			$mes2 = "agosto";
		break;

		case '09':
			$mes2 = "septiembre";
		break;

		case '10':
			$mes2 = "octubre";
		break;

		case '11':
			$mes2 = "noviembre";
		break;

		case '12':
			$mes2 = "diciembre";
		break;
		
		default:
			# code...
			break;
	}

class PDF extends FPDF{
	function Header(){
	    //
	}

	function Footer(){
	    //
	}
}


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Ln(30);
$pdf->SetFont('Times','B',14);

if($contrato==1){
	$pdf->MultiCell(0,5,utf8_decode('CONTRATO INDIVIDUAL DE TRABAJO CON TÉRMINO INDEFINIDO'),0,'C');

	$pdf->Ln(5);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(40,10,utf8_decode(''),0,0,'');
	$pdf->Cell(60,10,utf8_decode('Nombre del empleador: '),0,0,'');
	$pdf->Cell(40,10,utf8_decode($sede_descripcion),0,0,'');
	$pdf->Ln(5);

	$pdf->Cell(40,10,utf8_decode(''),0,0,'');
	$pdf->Cell(60,10,utf8_decode('Representante legal: '),0,0,'');
	$pdf->Cell(40,10,utf8_decode($sede_responsable),0,0,'');
	$pdf->Ln(6);

	$pdf->Cell(40,10,utf8_decode(''),0,0,'');
	$pdf->Cell(60,10,utf8_decode('Nombre del empleado(a): '),0,0,'');
	$pdf->Cell(40,10,utf8_decode($nombre." ".$apellido),0,0,'');
	$pdf->Ln(6);

	$pdf->Cell(40,10,utf8_decode(''),0,0,'');
	$pdf->Cell(60,10,utf8_decode('Identificado con tipo de cédula: '),0,0,'');
	$pdf->Cell(40,10,utf8_decode($documento_tipo),0,0,'');
	$pdf->Ln(6);

	$pdf->Cell(40,10,utf8_decode(''),0,0,'');
	$pdf->Cell(60,10,utf8_decode('Identificado con cédula n°: '),0,0,'');
	$pdf->Cell(40,10,utf8_decode($documento_numero),0,0,'');
	$pdf->Ln(6);

	$pdf->Cell(40,10,utf8_decode(''),0,0,'');
	$pdf->Cell(60,10,utf8_decode('Lugar de residencia n°: '),0,0,'');
	$pdf->Cell(40,10,utf8_decode($direccion),0,0,'');
	$pdf->Ln(6);

	$pdf->Cell(40,10,utf8_decode(''),0,0,'');
	$pdf->Cell(60,10,utf8_decode('teléfonos n°: '),0,0,'');
	$pdf->Cell(40,10,utf8_decode($telefono),0,0,'');
	$pdf->Ln(6);

	$pdf->Cell(40,10,utf8_decode(''),0,0,'');
	$pdf->Cell(60,10,utf8_decode('Cargo a desempeñar: '),0,0,'');
	$pdf->Cell(40,10,utf8_decode($cargo_nombre),0,0,'');
	$pdf->Ln(6);

	$pdf->Cell(40,10,utf8_decode(''),0,0,'');
	$pdf->Cell(60,10,utf8_decode('Salario: '),0,0,'');
	$pdf->Cell(40,10,number_format($salario,0,",","."),0,0,'');
	$pdf->Ln(20);

	$pdf->MultiCell(0,10,utf8_decode('Entre el empleador y trabajador(a), ambas mayores de edad, identificadas como ya se anotó, se suscribe CONTRATO DE TRABAJO A TÉRMINO INDEFINIDO regido por las siguientes cláusulas:'),0,'');
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,10,utf8_decode('PRIMERA: Lugar'),0,1,'');
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,10,utf8_decode('El trabajador(a) desarrollará sus funciones en las dependencias o el lugar que la empresa determine. Cualquier modificación del lugar de trabajo, que signifique cambio de ciudad, se hará conforme al Código Sustantivo de Trabajo. EL EMPLEADOR podrá servirse de varios empleados que desempeñen las mismas funciones de EL TRABAJADOR aun para el mismo ramo de actividades de este, pues EL TRABAJADOR no goza del derecho de exclusividad.'));
	$pdf->Ln(5);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,10,utf8_decode('SEGUNDA: Funciones'),0,1,'');
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,10,utf8_decode('El empleador contrata al trabajador(a) para desempeñarse como '.$funcion_nombre.', ejecutando labores como:'),0,'');
	$pdf->Ln(5);
	if($funcion_descripcion1!=""){
		$pdf->MultiCell(0,5,"* ".utf8_decode($funcion_descripcion1),0,'');
	}
	if($funcion_descripcion2!=""){
		$pdf->MultiCell(0,5,"* ".utf8_decode($funcion_descripcion2),0,'');
	}
	if($funcion_descripcion3!=""){
		$pdf->MultiCell(0,5,"* ".utf8_decode($funcion_descripcion3),0,'');
	}
	if($funcion_descripcion4!=""){
		$pdf->MultiCell(0,5,"* ".utf8_decode($funcion_descripcion4),0,'');
	}
	if($funcion_descripcion5!=""){
		$pdf->MultiCell(0,5,"* ".utf8_decode($funcion_descripcion5),0,'');
	}
	if($funcion_descripcion6!=""){
		$pdf->MultiCell(0,5,"* ".utf8_decode($funcion_descripcion6),0,'');
	}
	if($funcion_descripcion7!=""){
		$pdf->MultiCell(0,5,"* ".utf8_decode($funcion_descripcion7),0,'');
	}
	if($funcion_descripcion8!=""){
		$pdf->MultiCell(0,5,"* ".utf8_decode($funcion_descripcion8),0,'');
	}
	if($funcion_descripcion9!=""){
		$pdf->MultiCell(0,5,"* ".utf8_decode($funcion_descripcion9),0,'');
	}
	if($funcion_descripcion10!=""){
		$pdf->MultiCell(0,5,"* ".utf8_decode($funcion_descripcion10),0,'');
	}
	if($funcion_descripcion11!=""){
		$pdf->MultiCell(0,5,"* ".utf8_decode($funcion_descripcion11),0,'');
	}
	if($funcion_descripcion12!=""){
		$pdf->MultiCell(0,5,"* ".utf8_decode($funcion_descripcion12),0,'');
	}
	if($funcion_descripcion13!=""){
		$pdf->MultiCell(0,5,"* ".utf8_decode($funcion_descripcion13),0,'');
	}
	if($funcion_descripcion14!=""){
		$pdf->MultiCell(0,5,"* ".utf8_decode($funcion_descripcion14),0,'');
	}
	if($funcion_descripcion15!=""){
		$pdf->MultiCell(0,5,"* ".utf8_decode($funcion_descripcion15),0,'');
	}

	$pdf->Ln(5);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,10,utf8_decode('TERCERA: Elementos de trabajo'),0,1,'');
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,10,utf8_decode('Corresponde al empleador suministrar los elementos necesarios para el normal desempeño de las funciones del cargo contratado.'),0,'');

	$pdf->Ln(5);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,10,utf8_decode('CUARTA: Obligaciones del contratado'),0,1,'');
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,10,utf8_decode('El trabajador(a) por su parte, prestará su fuerza laboral con fidelidad y entrega, cumpliendo debidamente el (Reglamento Interno de Trabajo, Higiene y de Seguridad), cumpliendo las órdenes e instrucciones que le imparta el empleador o sus representantes, al igual que no laborar por cuenta propia o a otro empleador en el mismo oficio, mientras esté vigente este contrato:'),0,'');

	$pdf->MultiCell(0,5,utf8_decode('1.	Guardar la más estricta reserva sobre las estrategias, operaciones, negocios, procedimientos industriales, prácticas de negocio, planes de venta, nuevos modelos, secretos profesionales, comerciales, técnicos, administrativos, etc., que conozca por razón de las funciones que desempeñen o de sus relaciones con EL EMPLEADOR, cuya divulgación pueda ocasionar perjuicio a este y a juicio de este y en general no tratar con personas ajenas a la empresa o aun de las misma, los temas aquí relacionados, salvo mandato previo y por escrito de su superior.'),0,'');

	$pdf->MultiCell(0,10,utf8_decode('2.	A cumplir estrictamente las normas de confidencialidad en cada etapa de los procesos que ejecuten en virtud de este contrato.'),0,'');
	$pdf->MultiCell(0,10,utf8_decode('3.	Guardar buena conducta en todo sentido y obrar con espíritu de leal colaboración en el orden moral y disciplina general de la empresa.'),0,'');
	$pdf->MultiCell(0,10,utf8_decode('4.	Absolutamente prohibido cualquier tipo de relaciones amorosas con modelos y/o compañeros(as) de trabajo'),0,'');

	$pdf->Ln(5);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,10,utf8_decode('QUINTA: Término del contrato'),0,1,'');
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,10,utf8_decode('El presente contrato tendrá un término indefinido, pero podrá darse por terminado por cualquiera de las partes, cumpliendo con las exigencias legales al respecto.'),0,'');

	$pdf->Ln(5);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,10,utf8_decode('SEXTA: Periodo de prueba'),0,1,'');
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,10,utf8_decode('Las partes acuerdan un período de prueba de dos (2) meses, conforme lo dispuesto en el artículo 78 del Código Sustantivo del Trabajo.  En caso de prórrogas o nuevo contrato entre las partes, se entenderá, que no hay nuevo período de prueba. Durante este período tanto EL EMPLEADOR como EL TRABAJADOR podrán terminar el contrato en cualquier momento, en forma unilateral, de conformidad con el artículo 80 del Código Sustantivo del Trabajo. '),0,'');

	$pdf->Ln(5);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,10,utf8_decode('SEPTIMA: Justas causas para despedir'),0,1,'');
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,10,utf8_decode('Son justas causas para dar por terminado unilateralmente el presente contrato por cualquiera de las partes, el incumplimiento a las obligaciones y prohibiciones que se expresan en los artículos 57 y siguientes del Código sustantivo del Trabajo. Además del incumplimiento o violación a las normas establecidas en el (Reglamento Interno de Trabajo, Higiene y de Seguridad) y las previamente establecidas por el empleador o sus representantes.
	'),0,'');

	$pdf->Ln(5);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,10,utf8_decode('OCTAVA: Salario'),0,1,'');
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,10,utf8_decode('El empleador cancelará al trabajador(a) un salario mensual de $'.number_format($salario,0,",",".").' pesos moneda Corriente MAS LOS RECARGOS LEGALES QUE SE GENEREN, pagaderos mediante transferencia bancaria en periodos quincenales. Dentro de este pago se encuentra incluida la remuneración de los descansos dominicales y festivos de que tratan los capítulos I y II del título VII del Código Sustantivo del Trabajo. Por mutuo acuerdo entre las partes, las bonificaciones, aguinaldos, viáticos y las demás prestaciones extralegales no constituyen salario, así como aquellos dineros que reciba para ejecutar las funciones que le son propias.'),0,'');

	$pdf->Ln(5);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,10,utf8_decode('NOVENA: Horario'),0,1,'');
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,10,utf8_decode('El trabajador se obliga a laborar la jornada ordinaria en los turnos y dentro de las horas señaladas por el empleador, pudiendo hacer éste ajustes o cambios de horario cuando lo estime conveniente. Por el acuerdo expreso o tácito de las partes, podrán repartirse las horas jornada ordinaria de la forma prevista en el artículo 164 del Código Sustantivo del Trabajo, modificado por el artículo 23 de la Ley 50 de 1990, teniendo en cuenta que los tiempos de descanso entre las secciones de la jornada no se computan dentro de la misma, según el artículo 167 ibídem.'),0,'');

	$pdf->Ln(5);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,10,utf8_decode('DÉCIMA: Afiliación y pago a seguridad social'),0,1,'');
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,10,utf8_decode('Es obligación de la empleadora afiliar a la trabajadora a la seguridad social como es salud, pensión y riesgos profesionales, autorizando el trabajador el descuento en su salario, los valores que le corresponda aportan, en la proporción establecida por la ley.'),0,'');

	$pdf->Ln(5);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,10,utf8_decode('DECIMA PRIMERA: Modificaciones'),0,1,'');
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,10,utf8_decode('Cualquier modificación al presente contrato debe efectuarse por escrito y anexarse a este documento.'),0,'');

	$pdf->Ln(5);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,10,utf8_decode('DECIMA SEGUNDA Efectos'),0,1,'');
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,10,utf8_decode('El presente contrato reemplaza y deja sin efecto cualquier otro contrato verbal o escrito, que se hubiera celebrado entre las partes con anterioridad.'),0,'');

	$pdf->Ln(5);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,10,utf8_decode('DECIMA TERCERA'),0,1,'');
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,10,utf8_decode('EL TRABAJADOR autoriza expresamente a EL EMPLEADOR para que, al finalizar este contrato por cualquier causa, deduzca y compense de las sumas que le correspondan por concepto de salarios, prestaciones sociales, sanciones e indemnizaciones de carácter laboral, las cantidades y saldos pendientes a su cargo y a favor de este último, por razón de préstamos personales, de vivienda, facturas, crédito u obligaciones por cualquier concepto.'),0,'');
}


if($contrato==2){
	$pdf->MultiCell(0,5,utf8_decode('CONTRATO INDIVIDUAL DE PRESTACION DE SERVICIO'),0,'C');
	$pdf->Ln(10);
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,5,utf8_decode('Contrato de prestación de servicios desempeñando el cargo de '.$cargo_nombre),0,'C');

	$pdf->Ln(5);
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,10,utf8_decode($sede_responsable.', mayor de edad, identificado con cédula de ciudadanía No. '.$sede_cedula.' de la ciudad de '.$sede_ciudad.', actuando en representación de '.$sede_descripcion.', '.$sede_rut.' quien en adelante se denominará EL CONTRATANTE, y '.$nombre.' '.$apellido.' mayor de edad identificado con '.$documento_tipo.' No '.$documento_numero.', domiciliado en '.$sede_ciudad.'., y quien para los efectos del presente documento se denominará EL CONTRATISTA, acuerdan celebrar el presente CONTRATO DE PRESTACIÓN DE SERVICIOS, el cual se regirá por las siguientes cláusulas:'),0,'');

	$pdf->Ln(5);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,10,utf8_decode('PRIMERA.- OBJETO:'),0,1,'');
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,10,utf8_decode('El CONTRATISTA en su calidad de trabajador independiente, se obliga para con El CONTRATANTE a ejecutar los trabajos y demás actividades propias del servicio contratado, el cual debe realizar de conformidad con las condiciones y cláusulas del presente documento y que consistirá en: las herramientas a utilizar las proporcionara el contratista, las actividades administrativas y de oficina se realizaran en las instalaciones del contratista.'),0,'');

	$pdf->Ln(5);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,10,utf8_decode('SEGUNDA. - DURACIÓN O PLAZO:'),0,1,'');
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,10,utf8_decode('Contados a partir del día '.$array_fecha_ingreso[2].' de '.$mes2.' del '.$array_fecha_ingreso[0].' y podrá prorrogarse por acuerdo entre las partes con antelación a la fecha de su expiración mediante la celebración de un contrato adicional que deberá constar por escrito.'),0,'');

	$pdf->Ln(25);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,10,utf8_decode('TERCERA. - PRECIO:'),0,1,'');
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,10,utf8_decode('El valor del contrato será por la suma de $'.$salario.' M/C. que serán pagados en dos quincenas el día 8 y 23 de cada mes.'),0,'');

	$pdf->Ln(5);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,10,utf8_decode('CUARTA. - FORMA DE PAGO:'),0,1,'');
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,10,utf8_decode('El CONTRATANTE deberá facilitar acceso a la información y elementos que sean necesarios, de manera oportuna, para la debida ejecución del objeto del contrato, y, estará obligado a cumplir con lo estipulado en las demás cláusulas y condiciones previstas en este documento. El CONTRATISTA deberá cumplir en forma eficiente y oportuna los trabajos encomendados y aquellas obligaciones que se generen de acuerdo con la naturaleza del servicio, además se compromete a afiliarse a una empresa promotora de salud EPS, y cotizar igualmente al sistema de seguridad social en pensiones y Riesgos Laborales tal como lo indica el art.15 de la ley 100 de 1993, y el Decreto Ley 1295 de 1994 para lo cual se dará un término de 30  días contados a partir de la fecha de iniciación del contrato para realizar dicha vinculación.'),0,'');

	$pdf->Ln(5);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,10,utf8_decode('QUINTA. - OBLIGACIONES:'),0,1,'');
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,10,utf8_decode('El CONTRATANTE supervisará la ejecución del servicio encomendado, y podrá formular las observaciones del caso, para ser analizadas conjuntamente con El CONTRATISTA.'),0,'');

	$pdf->Ln(5);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,10,utf8_decode('SEXTA. - SUPERVISION'),0,1,'');
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,10,utf8_decode('El presente contrato terminará por acuerdo entre las partes y unilateralmente por el incumplimiento de las obligaciones derivadas del contrato.'),0,'');

	$pdf->Ln(5);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,10,utf8_decode('SEPTIMA. - TERMINACIÓN:'),0,1,'');
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,10,utf8_decode('El CONTRATISTA actuará por su cuenta, con autonomía y sin que exista relación laboral, ni subordinación con El CONTRATANTE. Sus derechos se limitarán por la naturaleza del contrato, a exigir el cumplimiento de las obligaciones del CONTRATANTE y el pago oportuno de su remuneración fijada en este documento ,Si el CONTRATISTA desea irse debe pasar una carta con 15 dias anticipados informando la terminacion del contrato, si no es asi se realizara una retencion del sueldo por falta de cumplimiento.'),0,'');

	$pdf->Ln(5);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,10,utf8_decode('OCTAVA. - INDEPENDENCIA:'),0,1,'');
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,10,utf8_decode('El CONTRATISTA no podrá ceder parcial ni totalmente la ejecución del presente contrato a un tercero, sin la previa, expresa y escrita autorización del CONTRATANTE.'),0,'');

	$pdf->Ln(5);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,10,utf8_decode('NOVENA. - CESIÓN:'),0,1,'');
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,10,utf8_decode('Para todos los efectos legales, se fija como domicilio contractual a la ciudad de '.$sede_ciudad.'.'),0,'');
}

/************************************************************************/
/******************************MINUTA************************************/
/************************************************************************/

$pdf->addPage();
$pdf->SetFont('Times','B',12);
$pdf->MultiCell(0,10,utf8_decode("MINUTA ACUERDO DE CONFIDENCIALIDAD CONTRATO N° ".$archivo_id),0,'C');

$pdf->Ln(10);
$pdf->SetFont('Times','',12);
$pdf->MultiCell(0,10,utf8_decode("Entre los suscritos a saber, ".$nombre." ".$apellido.", mayor de edad, residente de ".$sede_ciudad.", identificado con ".$documento_tipo." Nº ".$documento_numero." de ".$sede_ciudad.", quien en su calidad de ".$cargo_nombre." del día ".$array_fecha_inicio[2]." del mes ".$mes." del ".$array_fecha_inicio[0].", en nombre y representación de ".$sede_descripcion.", sociedad con domicilio en ".$sede_ciudad.", transformada en empresa procesamientos de datos , alojamiento (hosting) y actividades relacionadas , inscrita en la Cámara de Comercio de Bogotá, el 13 de febrero de 2019 bajo el N° 02423940, del Libro IX, con matrícula mercantil N° 03066829 , por una parte y que en el texto de este contrato se denominará LA EMPRESA, y de la otra, ".$sede_responsable.", mayor de edad, residente en la ciudad de ".$sede_ciudad." , identificado con la cédula de ciudadanía No. ".$sede_cedula." de Bogotá  en su calidad representante legal, , quienes en su conjunto se consideran las PARTES, hemos convenido celebrar el siguiente Acuerdo de Confidencialidad (en adelante el Acuerdo), previas las siguientes"),0,'');

$pdf->SetFont('Times','B',12);
$pdf->MultiCell(0,10,utf8_decode("CONSIDERACIONES"),0,'C');

$pdf->SetFont('Times','',12);
$pdf->MultiCell(0,10,utf8_decode("1. Que la EMPRESA va a revelar determinada Información Confidencial que considera confidencial y de su total propiedad, relacionada con el objeto contractual."),0,'');
$pdf->MultiCell(0,10,utf8_decode("2. Que el presente Acuerdo de Confidencialidad tiene como finalidad establecer el uso y la protección de la información que entregue la EMPRESA."),0,'');
$pdf->MultiCell(0,10,utf8_decode("3. En virtud de lo expuesto, las PARTES acuerdan las siguientes"),0,'');

$pdf->SetFont('Times','B',12);
$pdf->MultiCell(0,10,utf8_decode("CLAUSULAS"),0,'C');

$pdf->SetFont('Times','B',12);
$pdf->MultiCell(0,10,utf8_decode("1. DEFINICIONES"),0,'');

$pdf->SetFont('Times','',12);
$pdf->MultiCell(0,10,utf8_decode("Los términos utilizados en el texto del presente Acuerdo se deberán entender en el sentido corriente y usual que ellos tienen en el lenguaje técnico correspondiente o en el natural y obvio según el uso general de los mismos, a menos que se especifique de otra forma en el presente Acuerdo. Los términos en mayúscula tendrán el significado que se les asigna a continuación:"),0,'');

$pdf->MultiCell(0,10,utf8_decode("Información Confidencial: Significa cualquier información escrita, oral, visual, por medios electrónicos o digitales de propiedad de la EMPRESA o sobre la cual detente algún tipo de derecho. Se entenderá incluida en la Información Confidencial cualquier copia de la misma, que comprende pero no se limita a todo tipo de información, notas, datos, análisis, conceptos, hojas de trabajo, compilaciones, comparaciones, estudios, resúmenes, registros preparados para o en beneficio de la Parte Receptora (según se define posteriormente) que contengan o de alguna forma reflejen dicha información."),0,'');

$pdf->MultiCell(0,10,utf8_decode("Parte Reveladora: Se constituye en Parte Reveladora la EMPRESA o sus Representantes, que suministre información por cualquiera de los mecanismos previstos en este Acuerdo."),0,'');

$pdf->MultiCell(0,10,utf8_decode("Parte Receptora: Se constituye en Parte Receptora el CONTRATISTA o sus
Representantes que reciba información."),0,'');

$pdf->MultiCell(0,10,utf8_decode("Representantes: Referido a las Partes de este Acuerdo, significará los funcionarios, directores, administradores, empleados, agentes, contratistas, subcontratistas y asesores de esa Parte, de su controladora o de cualquier compañía filial, subsidiaria o que esté controlada por ella o bajo control común de esa Parte, incluyendo a título enunciativo, sus abogados, auditores, consultores y asesores financieros independientes que tengan necesidad de enterarse de la Información Confidencial para el desarrollo del objeto del presente acuerdo y están obligados frente a la EMPRESA a proteger la confidencialidad de la información revelada."),0,'');

$pdf->SetFont('Times','B',12);
$pdf->MultiCell(0,10,utf8_decode("2. OBJETO"),0,'');

$pdf->SetFont('Times','',12);
$pdf->MultiCell(0,10,utf8_decode("El Acuerdo tiene como propósito proteger, entre otros, la información que la EMPRESA
Revele en desarrollo del objeto del Contrato No ".$archivo_id."."),0,'');

$pdf->MultiCell(0,10,utf8_decode("En virtud del Acuerdo, el CONTRATISTA se obliga a no revelar, divulgar, exhibir, mostrar y/o comunicar la Información Confidencial que reciba de la EMPRESA, ni a utilizarla en favor de terceros y a proteger dicha información para evitar su divulgación no autorizada, ejerciendo sobre ésta el mismo grado de diligencia utilizado por un buen comerciante para proteger la Información Confidencial."),0,'');

$pdf->MultiCell(0,10,utf8_decode("El CONTRATISTA no podrá revelar públicamente ningún aspecto de la Información Confidencial sin el consentimiento previo y por escrito de la EMPRESA."),0,'');

$pdf->SetFont('Times','B',12);
$pdf->MultiCell(0,10,utf8_decode("3.	PLAZO"),0,'');

$pdf->SetFont('Times','',12);
$pdf->MultiCell(0,10,utf8_decode("El presente Acuerdo estará vigente por el término del plazo del Contrato No. ".$archivo_id." Más dos (2) años más."),0,'');

$pdf->SetFont('Times','B',12);
$pdf->MultiCell(0,10,utf8_decode("4. USO DE LA INFORMACION CONFIDENCIAL"),0,'');

$pdf->SetFont('Times','',12);
$pdf->MultiCell(0,10,utf8_decode("La Información Confidencial sólo podrá ser utilizada para los fines señalados en el presente Acuerdo. El CONTRATISTA no podrá hacer uso de la Información Confidencial en detrimento de la EMPRESA."),0,'');

$pdf->MultiCell(0,10,utf8_decode("Se podrá revelar o divulgar la Información Confidencial únicamente en los siguientes eventos:"),0,'');
$pdf->MultiCell(0,10,utf8_decode("(i) Que se revele con la aprobación previa y escrita de la EMPRESA."),0,'');
$pdf->MultiCell(0,10,utf8_decode("(ii)	Que la revelación y/o divulgación de la Información Confidencial se realice en desarrollo o por mandato de una ley, decreto, acto administrativo, sentencia u orden de autoridad competente en ejercicio de sus funciones legales."),0,'');
$pdf->MultiCell(0,10,utf8_decode("En este caso, el CONTRATISTA se obliga a avisar inmediatamente haya tenido conocimiento de esta obligación de revelación y/o divulgación a la EMPRESA, para que pueda tomar las medidas necesarias para proteger a la Información Confidencial, y de igual manera se compromete a tomar las medidas para atenuar los efectos de tal divulgación y se limitará a divulgar únicamente la información efectivamente requerida por la autoridad competente."),0,'');
$pdf->MultiCell(0,10,utf8_decode("(iii)	Que la Información Confidencial esté o llegue a estar a disposición del público o sea de dominio público por causa diferente a un acto u omisión del CONTRATISTA."),0,'');
$pdf->MultiCell(0,10,utf8_decode("(iv)	Que la Información Confidencial haya estado en posesión del CONTRATISTA antes de que hubiese recibido la misma por medio de la EMPRESA o que no hubiese sido adquirida de la EMPRESA, o de cualquier tercero que tuviere un compromiso de confidencialidad con respecto a la EMPRESA."),0,'');

$pdf->SetFont('Times','B',12);
$pdf->MultiCell(0,10,utf8_decode("5. CALIDAD DE LA INFORMACIÓN"),0,'');

$pdf->SetFont('Times','',12);
$pdf->MultiCell(0,10,utf8_decode("La EMPRESA no garantiza, ni expresa ni implícitamente, que la Información Confidencial sea exacta o perfecta. La EMPRESA queda liberada de cualquier responsabilidad que se derive de errores u omisiones contenidos en la Información Confidencial."),0,'');

$pdf->SetFont('Times','B',12);
$pdf->MultiCell(0,10,utf8_decode("6. PROPIEDAD Y DEVOLUCIÓN DE LA INFORMACIÓN"),0,'');

$pdf->SetFont('Times','',12);
$pdf->MultiCell(0,10,utf8_decode("La información entregada por LA EMPRESA es propiedad exclusiva de ésta y deberá ser tratada como confidencial y resguardada bajo este entendido por el CONTRATISTA, durante el término que se fija en el presente Acuerdo. La entrega de la Información Confidencial no concede ni implica licencias al CONTRATISTA, bajo ninguna marca comercial, patente, derechos de autor, secreto comercial o cualquier otro derecho de propiedad intelectual."),0,'');

$pdf->MultiCell(0,10,utf8_decode("La EMPRESA podrá solicitar a la Parte Receptora la devolución o destrucción de la Información Confidencial que haya recibido, incluidas pero no limitadas a todas las copias, extractos y otras reproducciones de la Información Confidencial, los cuales deberán ser devueltos o destruidos dentro de los ocho  (8) días siguientes a la terminación del Acuerdo. La destrucción de la Información Confidencial debe ser certificada por la Parte Receptora a la EMPRESA."),0,'');
$pdf->MultiCell(0,10,utf8_decode("En todo caso, el hecho de no recibir una comunicación en el sentido a que alude el párrafo anterior, no libera a la Parte Receptora de su deber de custodia, en los términos señalados en el presente Acuerdo."),0,'');

$pdf->SetFont('Times','B',12);
$pdf->MultiCell(0,10,utf8_decode("7. CLÁUSULA PENAL PECUNIARIA"),0,'');

$pdf->SetFont('Times','',12);
$pdf->MultiCell(0,10,utf8_decode("En caso de incumplimiento total o parcial de cualquiera de las obligaciones por el CONTRATISTA, se causará a su cargo una cláusula penal pecuniaria equivalente al 20% del valor total del Contrato No.XXXXX. Se podrá compensar el valor de la cláusula penal pecuniaria hasta concurrencia de los valores que el CONTRATISTA adeude a la EMPRESA por cualquier concepto. De no ser posible la compensación total o parcial, el CONTRATISTA se obliga a consignar el valor o el saldo no compensado de la cláusula penal en la cuenta que la EMPRESA le indique."),0,'');
$pdf->MultiCell(0,10,utf8_decode("Dichas sumas serán canceladas dentro de los treinta (30) días siguientes al incumplimiento declarado por LA EMPRESA, para lo cual EL CONTRATISTA  autoriza a LA EMPRESA para cobrarse por la vía ejecutiva, para lo cual este documento prestará mérito ejecutivo."),0,'');
$pdf->MultiCell(0,10,utf8_decode("El CONTRATISTA renuncia expresamente a todo requerimiento para efectos de constitución en mora, reservándose el derecho de cobrar perjuicios adicionales por encima del monto pactado, siempre que los mismos se acrediten."),0,'');

$pdf->SetFont('Times','B',12);
$pdf->MultiCell(0,10,utf8_decode("8. PROHIBICIÓN DE CESIÓN"),0,'');

$pdf->SetFont('Times','',12);
$pdf->MultiCell(0,10,utf8_decode("Este Acuerdo de Confidencialidad debe beneficiar y comprometer a las Partes y no puede ser cedido, vendido, asignado, ni transferido, bajo ninguna forma y a ningún título, sin contar con la autorización previa y escrita de la otra Parte."),0,'');

$pdf->SetFont('Times','B',12);
$pdf->MultiCell(0,10,utf8_decode("9. DISPOSICIONES VARIAS"),0,'');

$pdf->SetFont('Times','',12);
$pdf->MultiCell(0,10,utf8_decode("(i)	Este documento representa el Acuerdo completo entre las Partes y sustituye cualquier otro verbal o escrito celebrado anteriormente entre ellas, sobre la materia objeto del mismo."),0,'');
$pdf->MultiCell(0,10,utf8_decode("(ii)	Si alguna de las disposiciones de este Acuerdo llegare a ser ilegal, inválida o sin vigor bajo las leyes presentes o futuras o por un Tribunal, se entenderá excluida. Este Acuerdo será realizado y ejecutado, como si dicha disposición ilegal, inválida o sin vigor, no hubiera hecho parte del mismo y las restantes disposiciones aquí contenidas conservarán idéntico valor y efecto."),0,'');

$pdf->SetFont('Times','B',12);
$pdf->MultiCell(0,10,utf8_decode("10. LEY APLICABLE"),0,'');

$pdf->SetFont('Times','',12);
$pdf->MultiCell(0,10,utf8_decode("El presente Acuerdo se regirá e interpretará de conformidad con las leyes de la República de Colombia y quedarán excluidas las reglas de conflictos de leyes que pudiesen remitir el caso a las leyes de otra jurisdicción."),0,'');


//$pdf->MultiCell(0,10,utf8_decode("as"),0,'');
/************************************************************************/
/************************************************************************/
/************************************************************************/



$pdf->addPage();
$pdf->MultiCell(0,10,utf8_decode("Las partes suscriben el presente documento en dos ejemplares, el día ".$array_fecha_inicio[2]." del mes ".$mes." del ".$array_fecha_inicio[0]."."),0,'');

$pdf->Ln(60);
$pdf->Cell(20,5,utf8_decode(''),0,'');
$pdf->Cell(60,5,utf8_decode('Firma del Jefe'),0,'C');
//$pdf->Image('../resources/documentos/nominas/archivos/'.$_SESSION["id"].'/firma_digital.jpg',10,60,100,40);

if($contador1 >= 1){
	$pdf->Image('../resources/documentos/nominas/archivos/'.$_SESSION["id"].'/firma_digital.jpg',80,60,100,40);
}else{
	$pdf->Cell(60,5,utf8_decode('Falta Firmar'),0,'C');
}

$pdf->Ln(10);
$pdf->Cell(80,5,utf8_decode('-------------------------------------------'),0,'C');
$pdf->Cell(80,5,utf8_decode('-------------------------------------------'),0,'C');

$pdf->Ln(10);
$pdf->Cell(80,5,utf8_decode($sede_responsable),0,'C');
$pdf->Cell(80,5,utf8_decode($nombre." ".$apellido),0,'C');

$pdf->Ln(10);
$pdf->Cell(80,5,utf8_decode("EMPLEADOR"),0,'C');
$pdf->Cell(80,5,utf8_decode("TRABAJADOR"),0,'C');

$pdf->Ln(10);
$pdf->Cell(80,5,utf8_decode("C.C. No. ".$sede_cedula),0,'C');
$pdf->Cell(80,5,utf8_decode($documento_tipo." No. ".$documento_numero),0,'C');

//$pdf->MultiCell(0,5,utf8_decode(''),0,'');

/*
if($contador1 >= 1){
	$pdf->Image('../resources/documentos/modelos/archivos/'.$id_modelo.'/firma_digital.jpg',55,155,100,40);
}
*/


$pdf->Output();
?>