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

if($contador1>=1){
	while($row4 = mysqli_fetch_array($proceso4)) {
		$archivo_fecha_inicio = $row4["fecha_inicio"];
	}
	$array_fecha_inicio = explode("-",$archivo_fecha_inicio);
	/*
	echo "Original: ".$archivo_fecha_inicio;
	echo "<br>";
	echo "Deseado: Se firma por las partes, el día 8 del mes agosto del 2020.";
	echo "<br>";
	*/
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
	//echo "Se firma por las partes, el día ".$array_fecha_inicio[2]." del mes ".$mes." del ".$array_fecha_inicio[0].".";
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
$pdf->MultiCell(0,5,utf8_decode('CONTRATO INDIVIDUAL DE TRABAJO CON TÉRMINO INDEFINIDO'),0,'C');

$pdf->Ln(5);
$pdf->SetFont('Times','',12);
//$pdf->MultiCell(0,5,utf8_decode('Nombre del empleador: '),0,'');
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
$pdf->MultiCell(0,10,utf8_decode('El trabajador(a) por su parte, prestará su fuerza laboral con fidelidad y entrega, cumpliendo debidamente el (Reglamento Interno de Trabajo, Higiene y de Seguridad –si lo hay-), cumpliendo las órdenes e instrucciones que le imparta el empleador o sus representantes, al igual que no laborar por cuenta propia o a otro empleador en el mismo oficio, mientras esté vigente este contrato:'),0,'');

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
$pdf->MultiCell(0,10,utf8_decode('Son justas causas para dar por terminado unilateralmente el presente contrato por cualquiera de las partes, el incumplimiento a las obligaciones y prohibiciones que se expresan en los artículos 57 y siguientes del Código sustantivo del Trabajo. Además del incumplimiento o violación a las normas establecidas en el (Reglamento Interno de Trabajo, Higiene y de Seguridad –si lo hay-) y las previamente establecidas por el empleador o sus representantes.
'),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',12);
$pdf->Cell(40,10,utf8_decode('OCTAVA: Salario'),0,1,'');
$pdf->SetFont('Times','',12);
$pdf->MultiCell(0,10,utf8_decode('El empleador cancelará al trabajador(a) un salario mensual de '.$salario.' pesos moneda Corriente MAS LOS RECARGOS LEGALES QUE SE GENEREN, pagaderos mediante transferencia bancaria en periodos quincenales. Dentro de este pago se encuentra incluida la remuneración de los descansos dominicales y festivos de que tratan los capítulos I y II del título VII del Código Sustantivo del Trabajo. Por mutuo acuerdo entre las partes, las bonificaciones, aguinaldos, viáticos y las demás prestaciones extralegales no constituyen salario, así como aquellos dineros que reciba para ejecutar las funciones que le son propias.'),0,'');

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

$pdf->addPage();

$pdf->MultiCell(0,10,utf8_decode("Se firma por las partes, el día ".$array_fecha_inicio[2]." del mes ".$mes." del ".$array_fecha_inicio[0]."."),0,'');

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