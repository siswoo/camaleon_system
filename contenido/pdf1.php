<?php
include('../script/conexion.php');
require('../resources/fpdf/fpdf.php');
@$id = $_GET["id"];

if($id==''){
	echo "No tienes un ID valido!";
	exit;
}

$sql1 = "SELECT * FROM contenido_documentos WHERE id_documentos = 1 and id_modelos = ".$id;
$proceso1 = mysqli_query($conexion,$sql1);
$contador1 = mysqli_num_rows($proceso1);

if($contador1==0){
	echo "No tienes firmado el contrato!";
	exit;
}

$sql2 = "SELECT * FROM contenido_modelos WHERE id = ".$id;
$proceso2 = mysqli_query($conexion,$sql2);
$contador2 = mysqli_num_rows($proceso2);

if($contador2==0){
	echo "No existe dicho ID";
	exit;
}else{
	while($row1=mysqli_fetch_array($proceso1)){
		$imagen  =$row1["imagen"];
	}
	while($row2=mysqli_fetch_array($proceso2)){
		$nombre = $row2["nombre1"]." ".$row2["nombre2"]." ".$row2["apellido1"]." ".$row2["apellido2"];
		$documento_tipo  =$row2["documento_tipo"];
		$documento_numero  =$row2["documento_numero"];
	}
}

class PDF extends FPDF{
	function Header(){
	    //$this->Image('../img/slider_welcome/slider3.jpg',55,15,100,40);
	    //$this->Ln(20);
	}
	function Footer(){
	    $this->SetY(-15);
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,10,utf8_decode('Página').$this->PageNo().'/{nb}',0,0,'C');
	}
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
//$pdf->Ln(30);
$pdf->SetFont('Times','B',12);
$pdf->Cell(190,10,utf8_decode('CONTRATO DE PRESTACIÓN DE SERVICIOS'),0,0,'C');

$pdf->Ln(10);
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('ANDRES FERNANDO BERNAL CORREA, mayor de edad, identificado con cédula de ciudadanía No. 80.774.671 de Bogotá, actuando en nombre y representación de BERNAL GROUP SAS NIT. 901.257.204-8; quien en adelante se denominará EL CONTRATANTE, y '.$nombre.', mayor de edad identificado con '.$documento_tipo.' No. '.$documento_numero.', domiciliado en la ciudad de Bogotá D.C, y quien para los efectos del presente documento se denominará EL CONTRATISTA, acuerdan celebrar el presente CONTRATO DE PRESTACIÓN DE SERVICIOS, el cual se regirá por las siguientes cláusulas: '),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('PRIMERA.- OBJETO:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('EL CONTRATISTA en su calidad de trabajador independiente, se obliga para con EL CONTRATANTE a ejecutar los trabajos y demás actividades propias del servicio contratado, el cual debe realizar de conformidad con las condiciones y cláusulas del presente documento y que consistirá en:'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('- Efectuar transmisión en páginas webcam, en los horarios los cuales considere la contratista, previamente concertados con BERNAL GROUP SAS.'),0,'');
$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('SEGUNDA.- DURACIÓN O PLAZO:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('El plazo para la ejecución del presente contrato será indefinido, contados a partir de la firma del presente contrato.'),0,'');
$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('TERCERA.- PRECIO:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('El valor del contrato será por la suma de acuerdo a la producción de la prestación del servicio, varía según el rendimiento quincenal, sin constituir un sueldo fijo.'),0,'');
$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('CUARTA.- FORMA DE PAGO:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('El valor del contrato será cancelado en pagos quincenales correspondientes a los equivalentes y deducciones de ley correspondientes, a su vez descuentos previamente concertados y generados por la contratista, en las fechas estipuladas 8 y 23 de cada mes, en la fechas que sea fin de semana se correrá automáticamente el siguiente día hábil así:'),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->Cell(95,10,utf8_decode('CANTIDAD DE TOKENS PRODUCIDOS'),1,0,'C');
$pdf->Cell(95,10,utf8_decode('PORCENTAJES DE PAGO CORTE QUINCENAL'),1,0,'C');
$pdf->SetFont('Times','',10);
$pdf->Ln(10);
$pdf->Cell(95,10,utf8_decode('Menos de 10.000'),1,0,'C');
$pdf->Cell(95,10,utf8_decode('50%'),1,0,'C');
$pdf->Ln(10);
$pdf->Cell(95,10,utf8_decode('10.001 a 15.000'),1,0,'C');
$pdf->Cell(95,10,utf8_decode('55%'),1,0,'C');
$pdf->Ln(10);
$pdf->Cell(95,10,utf8_decode('15..001 a 34.999'),1,0,'C');
$pdf->Cell(95,10,utf8_decode('60%'),1,0,'C');
$pdf->Ln(10);
$pdf->Cell(95,10,utf8_decode('35.000 en Adelante'),1,0,'C');
$pdf->Cell(95,10,utf8_decode('65%'),1,0,'C');

$pdf->Ln(15);
$pdf->Cell(0,5,utf8_decode(' De igual forma, se aplicará la retención en la fuente como estipula el estatuto tributario que es del 6%.'),0,0,'');
$pdf->Cell(0,0,(''),0,1,'');

$pdf->Ln(15);
$pdf->SetFont('Times','B',10);
$pdf->Cell(0,5,utf8_decode(' ACLARACION DE PAGOS.'),0,0,'');
$pdf->Cell(0,5,(''),0,1,'');
$pdf->SetFont('Times','',10);

$pdf->MultiCell(0,5,utf8_decode('-	 Solicitud de anticipos de nómina son los días 15 para el corte del pago del 23 y los 30 para el corte del pago del 8 y se debe solicitar un día antes con su respectivo administrador el servicio tiene un costo de $15.000 pesos que serán cobrados en la 15 correspondiente.'),0,'');
$pdf->MultiCell(0,5,utf8_decode('-	 Pagos pendientes de quincenas pasadas no efectuados por documentación; debe solicitarlo por medio PQR de la app y no debe exceder dos meses para esta solicitud. '),0,'');
$pdf->MultiCell(0,5,utf8_decode('-	 Cortes de pago 1 al 15 se realiza el día 23 de cada mes, si su pago queda en rechazo o pendiente por documentación se pagará a más tardar el día 30 del mes. '),0,'');
$pdf->MultiCell(0,5,utf8_decode('-	 Cortes de pago 16 al 30 se realiza el día 8 de cada mes, si su pago queda en rechazo o pendiente por documentación se pagará a más tardar el día 15 del mes. '),0,'');
$pdf->Ln(10);

$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('QUINTA.- BENEFICIOS ECONOMICOS:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('Con el fin de motivar el rendimiento de nuestros contratistas, se acuerdan los diferentes beneficios quincenales, mensuales y semestrales los cuales aplican para todas las sedes del territorio nacional así:'),0,'');

$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('BENEFICIO DE RENDIMIENTO POR CORTE QUINCENAL:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('1-) Quien durante su trabajo desarrollado voluntariamente logre completar 91 horas en la quincena, obtiene un bono de transporte por valor de 75.000 pesos.'),0,'');
$pdf->MultiCell(0,5,utf8_decode('2-) Quien logre un rendimiento entre 50.000 Tokens a 79999, Obtiene un bono de 100.000 pesos.'),0,'');
$pdf->MultiCell(0,5,utf8_decode('3-) Quien logre un rendimiento entre 80.000 Tokens a 99999, Obtiene un bono de 300.000 pesos.'),0,'');
$pdf->MultiCell(0,5,utf8_decode('4-) Quien logre un rendimiento superior a 100.000 Tokens, Obtiene un bono de 500.000 pesos.'),0,'');
$pdf->MultiCell(0,5,utf8_decode('5-) Quien logre un rendimiento de 9.999 tokens se le realizara la entrega del kit de inicio.'),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('SEXTA.- OBLIGACIONES:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('El CONTRATANTE deberá facilitar la siguiente información y elementos que sean necesarios.'),0,'');
$pdf->MultiCell(0,5,utf8_decode('-	La información de datos bancarios y documentación deben estar completos de manera oportuna, documento por ambas caras, Rut, antecedentes disciplinarios, certificaciones bancarias; si está al día la documentación se podrá realizar el pago en los cortes correspondiente de manera oportuna.'),0,'');
$pdf->MultiCell(0,5,utf8_decode('-	El personal colombiano debe tener su propia cuenta bancaria y Rut.'),0,'');
$pdf->MultiCell(0,5,utf8_decode('Para la debida ejecución del objeto del contrato, y, estará obligado a cumplir con lo estipulado en las demás cláusulas y condiciones previstas en este documento. El CONTRATISTA deberá cumplir en forma eficiente y oportuna los trabajos encomendados y aquellas obligaciones que se generen de acuerdo con la naturaleza del servicio, además se compromete obligatoriamente  a afiliarse y apagar de manera independiente una entidad  promotora de salud EPS, y cotizar igualmente al sistema de seguridad social en pensiones y arl tal como lo indica el art.15 de le ley 100 de 1993, para lo cual se dará un término de 30 días hábiles a partir de la fecha de iniciación del contrato. De no hacerlo en el término fijado el contrato se dará por terminado.'),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('SEPTIMA.- SUPERVICION:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('El CONTRATANTE o su representante supervisará la ejecución del servicio encomendado, y podrá formular las observaciones del caso, para ser analizadas conjuntamente con EL CONTRATISTA, Estipulando indemnizaciones por ausencia representadas en:'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('-	Día de no producción valor de la multa de $30.000 pesos.'),0,'');
$pdf->MultiCell(0,5,utf8_decode('-	Dia de no producción sábados o festivos valor de multa de $50.000 pesos.'),0,'');
$pdf->MultiCell(0,5,utf8_decode('-	Inasistencia a la sesión de fotos multa de $50.000 pesos.'),0,'');
$pdf->MultiCell(0,5,utf8_decode('-	Llegadas tarde un valor de $10.000 pesos.'),0,'');
$pdf->MultiCell(0,5,utf8_decode('-	Valor de daños causados por usted le será cobrado por el valor correspondiente.'),0,'');
$pdf->MultiCell(0,5,utf8_decode('-	La empresa no se hace responsable de perdidas o rabos.'),0,'');
$pdf->MultiCell(0,5,utf8_decode('-	La facturación de parejas sale en un solo desprendible, la empresa no se hace responsable de la distribución de pagos de shows o colaboraciones.'),0,'');
$pdf->MultiCell(0,5,utf8_decode('Nota: Si   separa   el domingo y no asiste se realiza una multa de $50.000 pesos por la inasistencia.'),0,'');

$pdf->Ln(15);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('OCTAVA.- TERMINACIÓN:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('El presente contrato terminará por acuerdo entre las partes y unilateralmente por el incumplimiento de las obligaciones derivadas del contrato, quedando estipulado un tiempo mínimo de preaviso de 15 días, dicho incumplimiento acarreara la no cancelación del saldo de la quincena la cual no fue laborada. Quedando el CONTRATANTE, Eximido de reclamaciones, producto de la inasistencia y ausencia de comunicación por parte del CONTRATISTA. De igual forma, los trabajos desarrollados y avanzados durante el acuerdo comercial, las cuentas y diferentes servicios ofrecidos por el CONTRATISTA, Son de total propiedad del CONTRATANTE'),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('NOVENA.- INDEPENDENCIA:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode(' El CONTRATISTA actuará por su cuenta, con autonomía y sin que exista relación laboral, ni subordinación con El CONTRATANTE. Sus derechos se limitarán por la naturaleza del contrato, a exigir el cumplimiento de las obligaciones del CONTRATANTE y el pago oportuno de su remuneración fijada en este documento. '),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('DÉCIMA.- CESIÓN:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('El CONTRATISTA no podrá ceder parcial ni totalmente la ejecución del presente contrato a un tercero, sin la previa, expresa y escrita autorización del CONTRATANTE.'),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('ONCEAVA.- DOMICILIO:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('Para todos los efectos legales, se fija como domicilio contractual a la ciudad de Bogotá'),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('DOCEAVA.- ACUERDO DE CONFIDENCIALIDAD:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('Este Acuerdo de Confidencialidad entre los contratantes, se regulará por las siguientes cláusulas:'),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('1._ TIEMPO ESTABLECIDO DEL ACUERDO'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('Este Acuerdo de Confidencialidad comienza con la firma del Contrato Laboral y/o Prestación de Servicios y permanecerá vigente mientras esté vigente el Objeto por el cual se inició la relación, manteniéndose inclusive durante las prórrogas sin necesidad de firmar un nuevo Acuerdo de Confidencialidad.'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('Asimismo, si el contrato inicial termina y se inicia después un nuevo contrato, pero con el mismo objeto del contrato anterior, este Acuerdo de Confidencialidad tomará vigencia sin necesidad de firmar uno nuevo.'),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('2._ REPRESENTACIÓN Y GARANTÍAS '),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('El Trabajador representa y garantiza que su relación con la Empresa no causará o requerirá que ello viole cualquier obligación a, el acuerdo, o la confianza relacionada con confidencialidad, el secreto de fabricación y la información propietaria con cualquier otra persona, empresa o entidad. Más aun, el Trabajador reconoce que una condición de esta relación consiste en que no ha traído y no traerá o usará en el desempeño de sus deberes en la Empresa cualquier información propietaria o confidencial de un antiguo Empleador o Contratante sin la autorización escrita de aquel Empleador o Contratante. La violación de esta condición causa la terminación automática de la relación laboral desde el tiempo de violación. Si el Trabajador considera que tiene investigaciones o invenciones anteriores a la firma de este Acuerdo de Confidencialidad que serán excluidas de este acuerdo, se deberán anotar en la parte trasera de este documento o en uno aparte firmado por las partes. Con esto. El Trabajador libera a la Empresa de cualquier reclamación por parte del Trabajador por cualquier empleo por la Empresa de cualquier invención antes hecha o concebida por El Trabajador.'),0,'');


$pdf->Cell(0,0,(''),0,1,'');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('3._ CONFIDENCIALIDAD'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('a._ El Trabajador reconoce que la Empresa contratante ha hecho, o puede poner a su disposición ciertas listas de clientes, datos de precios, fuentes de suministro, técnicas, información computarizada, mapas, los métodos, producto de diseño y/o información personal.'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('b._ Información Propietaria de, o autorizado a, la Empresa o sus clientes, incluyendo sin restricción, secretos de fabricación, invenciones, patentes, y materiales con derechos de autor y en general conocimiento específico desarrollado y/o entregado por Bernal Group SAS.'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('c._ El Trabajador reconoce que esta información tiene un valor económico, real o potencial, que no es generalmente dado a conocer al público o a los otros que podrían obtener el valor económico de su descubrimiento o empleo y que esta información es sujeta a un esfuerzo razonable por la Empresa de mantener su secreto y confidencialidad. Asimismo, el Trabajador no hará ninguna duplicación u otra copia del Material Confidencial.'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('d._ El Trabajador devolverá inmediatamente se le solicite por parte de la Empresa, todo material confidencial que se le haya solicitado. El Trabajador notificará a la Empresa cualquier descubrimiento que haya hecho, considerándose esto, como parte del Material Confidencial, así mismo, el Trabajador se compromete a no utilizar información o Material Confidencial finalizado la relación Laboral.'),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('4._ INFORMACIÓN CONSIDERADA DE LA EMPRESA'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('a._ Para el objetivo de este Acuerdo, también se considerará como Material Confidencial cualquier información, observación, datos, material escrito, registro, documento, dibujo, fotografía, disposición, programas de computador, software, multimedia, programas fijos, invención, descubrimiento, mejora, desarrollo, instrumento, máquina, aparato, aplicación, diseño, trabajo de paternidad literario, logo, sistema, idea promocional, lista de clientes, necesidad del cliente, práctica, información de precios, procesos, pruebas, concepto, fórmulas, métodos, información de mercado, técnicas, secreto de fabricación, producto y/o la investigación relacionada con el desarrollo de investigación real o previsto, productos, organización, control de comercialización, publicidad, negocio o fondos de Empresa, sus afiliados o entidades relacionadas.'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('b._ Todo lo anterior, es y será de la Empresa incluso después de terminada la relación con el Trabajador.'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('c._ El Trabajador cumplirá con las medidas de seguridad que tome la Empresa para proteger la confidencialidad de cualquier Información reservada o secreta de la Empresa.'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('d._ El Trabajador irrevocablemente designa al Gerente o quien haga sus veces en la Empresa para realizar todos los actos necesarios para obtener y/o mantener patentes, derechos de autor y derechos similares a cualquier Información exclusiva de la Empresa, según la normas colombianas e Internacionales. '),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('e._ Cualquier uso para una patente, el registro de derechos de autor o el derecho similar registrado por el Trabajador dentro de un año después de la terminación de este Acuerdo será supuesto a relacionarse con la Información creada por el Trabajador durante el término de este Acuerdo, a no ser que el Trabajador pueda demostrar de otra manera con la certeza razonable.'),0,'');
$pdf->Cell(0,0,(''),0,1,'');
$pdf->Ln(10);
$pdf->MultiCell(0,5,utf8_decode('f._ La Empresa puede disponer libremente de toda su información y Material Confidencial, por lo que el Trabajador no tendrá ninguna autoridad para ejercer cualquier derecho o privilegios en lo que concierne a la Información perteneciente exclusivamente a la Empresa poseída por o asignada a esta última conforme a este Acuerdo y las leyes colombianas.'),0,'');


$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('5._ LABOR CONTRATADA'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('a._ El Trabajador reconoce que todos los trabajos de autoría llevados a cabo por la Empresa son sujetos a la dirección de la Empresa y su control y dichos trabajos constituyen una función contratada de conformidad al Contrato Laboral.'),0,'');
$pdf->Ln(5); $pdf->MultiCell(0,5,utf8_decode('b._ Toda la Información o Material Confidencial, creada, inventada, concebida o descubierto por el Trabajador que este sujeto a derechos de autor explícitamente, como se considera, por el Trabajador, corresponde a trabajos propios de la labor contratada y son de propiedad de la Empresa. '),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('6._ ASIGNACIÓN'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('a._ La empresa poseerá como su propiedad exclusiva , y el Trabajador está de acuerdo con asignar, transferir, y transportar y o sus candidatos autorizados todo su derecho, título e interés a y a todas y cualquier dichas "ideas" que estén relacionadas en general con el negocio de la Empresa, incluyendo, pero no limitado con cualquier invención, procesos, mejoras, ideas, obras de arte registrables como propiedad literaria, marcas registradas, derechos de autor, fórmulas, la tecnología de la fabricación, acontecimientos, escrituras, otros, registrables como propiedad literaria, patentables o in patentable, desde la fecha de este Acuerdo o la fecha del primer contrato celebrado con la Empresa y hasta la terminación de la relación Laboral con el Trabajador.'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('b._ El Trabajador por la presente asigna a la Empresa todas las entregas y libera a la Empresa, cualquier afiliado de Empresa y sus oficiales respectivos, directores y empleados, de y contra cualquier y todas las reclamaciones, demandas, responsabilidades, gastos, y los gastos del Trabajador, provenientes, o relacionando con, cualquier Información de Propiedad.'),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('7._ NO COMPETIR '),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('El Trabajador está de acuerdo con no contratar con terceros en cualquier actividad que compita con cualquier actividad de Empresa durante el curso de su relación Laboral Para los objetivos de este párrafo, la actividad competitiva abarca la formación o la planificación de formar una entidad de negocio que, como se puede considerar, sea competitiva con cualquier negocio de la Empresa. Esto no impide al Trabajador buscar u obtener el empleo u otras formas de relaciones de negocio con un competidor después de la terminación de empleo con la Empresa mientras que tal competidor existiese antes de la terminación de la relación con la Empresa y el Trabajador de ninguna manera estuvo implicado con la organización o la formación de tal competidor.'),0,'');


$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('8._ OPORTUNIDADES DE NEGOCIO '),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('Durante las condiciones de este Acuerdo, si el Trabajador se da cuenta de cualquier proyecto, inversión, empresa, negocio u otra oportunidad o similar relacionado con el mismo campo comercial de la Empresa, o cualquier proyecto, inversión, empresa, o el negocio de Empresa, entonces el Trabajador notificará la Empresa inmediatamente por escrito de tal Oportunidad y usará los esfuerzos de buena fe del Trabajador para hacer que la Empresa tuviese la oportunidad de explorar, invertir dinero en, participar en, o de otra manera afiliarse a tal Oportunidad.'),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('9._  SOLICITACIÓN DE EMPLEADOS'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('El Trabajador conviene que terminado el Contrato que dio origen a este Acuerdo de Confidencialidad, no inducirá o intentará contratar a los trabajadores de la Empresa para crear un nuevo negocio que compita en el mismo ramo mercantil.'),0,'');

$pdf->Cell(0,0,(''),0,1,'');
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('10. SOLICITACIÓN DE CLIENTES DESPUÉS DE TERMINACIÓN DE ACUERDO '),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('Por el término de 2 años de terminada la relación con la Empresa, el Trabajador no va a, directamente o indirectamente, dar a conocer a cualquier persona, firma o corporación los nombres o las direcciones de cualquiera de los clientes de Empresa o cualquier otra información que les pertenece, o visitarán, buscarán clientes, se llevarán, o intentarán visitar, buscar clientes, o llevarse cualquier cliente de Empresa sobre quien el Trabajador se halla contactado o con quien el Trabajador se dio por enterado durante el tiempo de este Acuerdo, para sí o para cualquier otra persona, firma, o corporación.'),0,'');


$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('11. SANCIONES POR VIOLAR EL ACUERDO DE CONFIDENCIALIDAD '),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('EL Trabajador que viole alguna de las disposiciones antes mencionadas en relación con lo que se considera objeto de la Confidencialidad, ocasionará el pago de una multa de $20.000.000, sin perjuicio de las demás acciones laborales, comerciales y penales a que haya lugar para la reclamación de indemnización de perjuicios ocasionados con la violación a la Confidencialidad aquí suscrita.'),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('12. COMPROMISOS:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('La CONTRATISTA Se compromete a asumir los códigos de conducta que el CONTRATISTA, durante la prestación de los servicios en el espacio comercial que se le proporcione, las cuales serán indispensables para el cumplimiento del objeto de este contrato, y así evitar incurrir en las siguientes prohibiciones:'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('a) Consumo de Estupefacientes o alcohol o de cualesquiera sustancias que altere su comportamiento.'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('b) Dar su información personal, número de teléfono dirección, redes sociales personales, número de cuentas bancarias y demás información confidencial y que se preste para una interacción por fuera de las transmisiones.'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('c) Abstenerse de recibir transferencias bancarias, giros internaciones, regalos, detalles de cualquier índole por fuera de las transmisiones por parte de los usuarios de las paginas, advirtiéndoles que dicha conducta podría configurar no solo faltas al presente contrato, sino ser constituida infracciones a la Ley Federal de los Estados Unidos de Norteamérica y de los demás países de origen de las páginas y de los usuarios.'),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('13. CONCILIACIÓN Y ARBITRAJE'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('En caso de cualquier controversia en este Acuerdo, los firmantes se comprometen a llevar las diferencias ante un Centro de Conciliación o un Tribunal de Arbitramento antes de iniciar cualquier acción legal ante jueces. Los gastos de las diligencias de Conciliación o Tribunal de Arbitramento serán sufragados por la parte solicitante.'),0,'');
$pdf->Ln(5);

$pdf->Cell(0,0,(''),0,1,'');
$pdf->Cell(0,10,(''),0,1,'');
$pdf->SetFont('Times','B',12);
$pdf->MultiCell(0,5,utf8_decode('ANEXO 1. AUTORIZACIÓN DE
TRATAMIENTO DE DATOS PERSONALES
LEY 1581 DE 2012 Y DEL DECRETO 1377 DE
2013'),0,'C');

$pdf->Ln(5);
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('BERNAL GROUP. En cumplimiento de la normatividad vigente, requiere de su autorización para recolectar, almacenar, usar, circular y suprimir tu información personal con la finalidad asociada al cumplimiento de las obligaciones que se derivan del proceso de registro ante terceros usando plataformas tecnológicas, y especialmente para identificarte ante los procesos dentro de la empresa.'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('La información que recabamos no se utilizará para enviarte información sobre novedades, noticias y promociones propias y de terceros, en forma directa o a través de terceros a menos que nos autorices. BERNAL GROUP. En cualquier momento podrá comunicar a terceros dentro y fuera del país, tus datos personales no sensibles, esta actividad solo tendrá lugar para actividades inherentes al cumplimiento de los contratos ya firmados por ambas partes.'),0,'');
$pdf->MultiCell(0,5,utf8_decode('La información de carácter personal asociada a este documento será conservada por cinco (5) años que contaremos a partir de tu vinculación.'),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',12);
$pdf->MultiCell(0,5,utf8_decode('Autorización de Tratamiento de Datos Personales'),0,'C');

$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('Conforme lo anterior:'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('- Autoriza el tratamiento de mi fotografía para los registros necesarios en páginas webcam tanto en ropa formal, informal o con contenido sexual explícito.
- Autorizo el envío de información requerida para registros.
- Autorizo la digitalización de mi cédula de ciudadanía.'),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',12);
$pdf->MultiCell(0,5,utf8_decode('CONTRATO DE CESIÓN DE DERECHOS DE
IMAGEN MAYOR DE EDAD'),0,'C');

$pdf->SetFont('Times','',10);
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('Entre los suscritos a saber, de una parte, que BERNAL GROUP, identificado bajo el NIT 901257204 representando legalmente por Andres Fernando Bernal Correa persona mayor de edad, identificado con la cédula de ciudadanía No. 80.774.671, empresa con domicilio en la ciudad de Bogotá D.C. Calle 80 # 85-52, para los efectos de este contrato se denominará EL PRODUCTOR, y de otra '.$nombre.' mayor de edad, identificado (a) con la '.$documento_tipo.' N° '.$documento_numero.' domiciliada en la ciudad de Bogotá D.C y quien para los efectos del presente documento se denominará EL o la modelo, acuerdan celebrar el siguiente contrato de cesión de imagen respecto la actividad que la contratista va a realizar como modelo WEBCAM en virtud del contrato de mandato celebrado entre las partes, el cual se regirá por las siguientes:'),0,'');

$pdf->SetFont('Times','B',10);
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('CLÁUSULAS:'),0,'');

$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('PRIMERA: OBJETO'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('De conformidad al contrato de mandato celebrado entre las partes la modelo realizará en el espacio comercial proporcionado por el productor transmisiones Actuaciones en streaming a través de portales web, modelaje para fotografía destinada a la promoción de su imagen personal, Actuación en cortometrajes cualquiera sea su temática, tipo o formato. Actuaciones con fines publicitarios y de mercadeo. Y, en general, cualquier actividad relacionada con actividades artísticas y/o con el talento de LA MODELO'),0,'');

$pdf->Cell(0,0,(''),0,1,'');
$pdf->Ln(10);
$pdf->MultiCell(0,5,utf8_decode('Estos servicios se prestarán en forma continua y en conformidad con las cláusulas pactadas en el presente contrato y en el de mandato. De igual manera, se deja expreso que la MODELO prestará sus servicios de manera independiente, por lo tanto no estará sometido a subordinación laboral o dependencia por parte de EL PRODUCTOR.'),0,'');


$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('SEGUNDA. OBLIGACIONES DE LA MODELO:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('LA MODELO tendrá las siguientes obligaciones:'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('1) Conceder a EL PRODUCTOR el derecho de uso exclusivo de creación de perfiles (cuentas) en las páginas de transmisión, fotografías, películas o grabaciones de voz o cualquier otro material que pueda crear y/o poseer EL PRODUCTOR , en donde aparezca la imagen de la modelo y que en adelante se denominara el "Material Asignado", el cual incluye, sin limitación, el derecho a realizar, relatar, publicar, grabar, filmar o de cualquier otra forma explotar el "Material Asignado" de cualquier manera, en cualquier y en todo medio de difusión, ya sea este actualmente conocido o por conocerse a través de las siguientes páginas (Chaturbate, Bongacams, Cam4, Stripchat, Xlove, Jasmin, Streamate, Imlive, Flyfourfree), Exonerar a EL PRODUCTOR de cualquier reclamo o demanda que surja en conexión con o procedente del uso de dicho "material asignado".'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('2) Ceder, mediante la firma de este contrato, todos los derechos patrimoniales o de explotación sobre las
imágenes y/o voz contenidas en el "Material Asignado" en favor de EL PRODUCTOR.'),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('TERCERA. DERECHOS PATRIMONIALES:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('LA MODELO autoriza por medio del presente acuerdo, de manera irrevocable a EL PRODUCTOR y a cualquiera de sus sucesores, licenciatarios o cesionarios la inclusión, explotación, transmisión, distribución y reproducción, de las fotos, videos y transmisiones en vivo, ya sea este actualmente conocido o posteriormente desarrollado, a través de las siguientes páginas de transmisión webcam (Chaturbate, Bongacams, Cam4, Stripchat, Xlove, Jasmin, Streamate, Imlive, Flyfourfree), y por el término establecido en la leyes nacionales e internacionales.'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('Dichas transmisiones, fotos e imágenes se visualizarán en los 5 continentes, aclarando que desde Colombia podrían visualizarse de manera irregular por usuarios que a través de dispositivos o software suplanten el origen de su conexión.'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('En consecuencia, todos los resultados y ganancias provenientes de los servicios que serán prestados por LA MODELO, y los provenientes de cualquier otro material que sean de cualquier especie, contribuido a suministrado por el mismo en conexión con su actividad como modelo serán de EL PRODUCTOR, en los términos establecidos en el contrato de mandato celebrados entre las partes'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('En razón de lo anterior, se entenderá que LA MODELO ha autorizado de manera irrevocable a EL PRODUCTOR y a cualquiera de sus sucesores, licenciatarios o cesionarios la inclusión, explotación, transmisión, distribución y reproducción de su imagen y voz en las transmisiones a través de las paginas webcam que acuerden ambas partes, y de la misma manera en cualquier medio de comunicación actualmente conocido o posteriormente desarrollado, y por el término establecido en la leyes nacionales e internacionales. La autorización y cesión que LA MODELO hace bajo este acuerdo es irrevocable y en caso de incumplimiento por parte de EL PRODUCTOR, solo tendrá derecho a buscar la recuperación de daños materiales.'),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('CUARTA. CESIÓN DEL CONTRATO:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('LA MODELO no podrá ceder parcial ni totalmente la ejecución del presente contrato a un tercero, salvo previa autorización expresa y escrita por parte de EL PRODUCTOR.'),0,'');
$pdf->Cell(0,0,(''),0,1,'');
$pdf->Ln(10);
$pdf->MultiCell(0,5,utf8_decode('No obstante, la cesión del presente contrato por parte de EL PRODUCTOR se regirá por lo dispuesto en el inciso del artículo 887 del Código de Comercio. LA MODELO renuncia a partir de a firma del presente documento a cualquier derecho a recibir remuneración alguna como contraprestación por dicha cesión.'),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('QUINTA. DURACIÓN:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('La presente cesión de derechos es de manera indefinida mientras persista la relación contractual entre la modelo y el productor a través del contrato de mandato que antecede este documento. Exceptuándose las cuentas, perfiles y el contenido que hay en estas que desarrolle el productor en la paginas en las cuales la modelos transmitirá como modelo webcam, las cuales serán de propiedad del productor/estudio de manera permanente.'),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('SEXTA. DAÑOS Y PREJUICIOS:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode(' EL PRODUCTOR no es responsable de daños o accidentes ocurridos en las áreas de transmisión, LA MODELO debe asumir cualquier tipo de riesgos a través de su ARL Y EPS, este contrato no incluye ningún tipo de relación laboral entre el productor y el contratista.'),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('SEPTIMA. PARAGRAFO:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('Las partes declaran que los espacios en blanco se llenarán de conformidad con las estipulaciones
acordadas por las mismas, y en razón de ello, manifiestan encontrarse de acuerdo con su contenido.'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('Para todos los efectos legales, el domicilio contractual será la ciudad de y las notificaciones serán recibidas por las partes en las siguientes direcciones: Bogotá D.C. Calle 80 # 85-52.'),0,'');


$pdf->Ln(15);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('CONSENTIMIENTO INFORMADO PARA TRANSMISIONES DE MODELOS WEBCAM'),0,'C');
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('(Autorización y Manifestación de voluntad actualizado Sentencia T -407 A/2018 de septiembre de 2018)'),0,'C');

$pdf->Ln(5);
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('Yo, '.$nombre.', persona mayor de edad, identificado(a) con '.$documento_tipo.' No. '.$documento_numero.', actuando de manera libre, consiente, haciendo uso de mi buen estado emocional, físico y psicológico. una vez informado(a), sobre las actividades con fines comerciales y sus respectivas consecuencias, que realizará Andrés Fernando Bernal Correa, para posicionarme y comercializar mis actividades como modelo webcam por medio de la industria del video chat, otorgo en forma libre y autónoma mediante la firma del presente documento, mi consentimiento y autorización a: BERNAL GROUP. Para la realización de las siguientes actividades:'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('- La toma, transmisión, reproducción, comercialización y difusión a través de internet, medios digitales y videochat de fotografías, videos y audios con contenido explícito sexual para ser transmitidos en diferido o en vivo y en dichos medios y redes sociales destinadas para tal fin, que la firma BERNAL GROUP. Considere para lograr una buena comercialización de mis actividades como modelo webcam, las cuales en muchos casos tendrán acceso gratuito, en vivo y en directo por parte de usuarios de los 5 continentes.'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('De la misma manera, declaro que he sido informada sobre los riesgos que las anteriores actividades en los siguientes ámbitos:'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('- A mi intimidad e imagen en el ámbito laboral, familiar y social, tales como burlas, rechazos e estigmatización, por tratarse de imágenes, audios y videos de carácter sexual, que son ampliamente cuestionados.'),0,'');
$pdf->Cell(0,0,(''),0,1,'');
$pdf->Ln(10);
$pdf->MultiCell(0,5,utf8_decode('- La piratería de contenidos digitales y los riesgos de que las imágenes grabadas o fotografiadas sean reproducidas en medios que no han sido autorizados para estos fines puesto que reconozco que el nivel de seguridad de dichas páginas es bajo, dado que algunos usuarios pueden grabar las transmisiones, así como guardar las fotos y videos sin mi autorización.'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('Manifiesto que el presente consentimiento lo otorgo sin presiones o apremios de ninguna índole y de ninguna persona y que exonero a BERNAL GROUP. De cualquier perjuicio derivado de los riesgos puestos en conocimiento.'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('Que dicha autorización se confiere de manera permanente y tendrá vigencia permanente mientras persista el vínculo contractual que tengo con BERNAL GROUP.'),0,'');


/////////////////////////ANEXO NUEVO/////////////////////

$pdf->Ln(15);
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('Aceptación de los Términos de Servicio
Al acceder, usar o visitar (el " Sitio web "), cualquiera de sus contenidos, funcionalidades y servicios, usted expresa su acuerdo con estos Términos de servicio y nuestra Política de privacidad y se incorpora aquí como referencia.
Estos Términos de servicio se aplican a todos los usuarios, incluidos los Socios de contenido, Modelos y Cargadores verificados que también pueden ser contribuyentes de Contenido, del sitio web (colectivamente, " usted ", " Usuario " o " Usuarios " según lo requiera el contexto), ya sea que se acceda a través de una computadora, dispositivo móvil u otra tecnología, manera o medio.
" Contenido " incluye el texto, el software, los guiones, los gráficos, las fotos, los sonidos, la música, los videos, las combinaciones audiovisuales, las funciones interactivas, el contenido textual y otros materiales que puede ver, cargar, publicar, enviar, poner a disposición, mostrar, comunicar o publicar en el sitio web.
“Socios de contenido " se refiere a los usuarios del sitio web que se han unido a nuestro Programa de socios de contenido .
“Modelos " se refiere a los usuarios del sitio web que se han unido a nuestro Programa de socios modelo .
“Subidores verificados " se refiere a los usuarios del sitio web que tienen una cuenta válidamente identificada.
Si no está de acuerdo con alguno de estos Términos de servicio o nuestra Política de privacidad , no acceda ni utilice el sitio web.
Usted acepta ingresar estos Términos de servicio electrónicamente y el almacenamiento de registros relacionados con estos Términos de servicio en forma electrónica.
Capacidad para aceptar los términos de servicio
Usted afirma que tiene al menos 18 años de edad o la mayoría de edad en la jurisdicción desde la que accede al sitio web, y que es completamente capaz y competente para aceptar los términos, condiciones, obligaciones, afirmaciones, representaciones y garantías establecidas. en estos Términos de servicio, y cumplir con estos Términos de servicio. Si tiene menos de 18 años o la mayoría de edad aplicable, no utilice el sitio web. También declara que la jurisdicción desde la que accede al sitio web no prohíbe recibir o ver contenido sexualmente explícito. Ya seas un Usuario registrado o no registrado, es posible que le solicitemos a nosotros y/o a nuestros proveedores de servicios de verificación de edad de terceros información que nos ayudará a determinar que tiene la mayoría de edad requerida para tener acceso al sitio web y ver su contenido. Para obtener más información sobre cómo se procesa esta información, consulte nuestra Política de privacidad
Cambios a los Términos de Servicio
Nos reservamos el derecho de modificar estos Términos de servicio en cualquier momento y sin previo aviso, y es su responsabilidad revisar estos Términos de servicio para ver si hay cambios. Su uso del sitio web después de cualquier modificación de estos Términos de servicio significará su consentimiento y aceptación de sus términos revisados.
La versión actualizada de los Términos de servicio reemplaza cualquier versión anterior inmediatamente después de su publicación, y la(s) versión(es) anterior(es) no tendrá(n) efectos legales continuos. Debe revisar periódicamente la versión más actualizada de los Términos de servicio que se encuentran en Sitio Web permite la visualización general de contenido para adultos por parte de los Usuarios, registrados y no registrados. Además, el sitio web permite la carga de contenido para adultos por parte de socios de contenido, cargadores verificados y modelos.
El sitio web puede contener enlaces a sitios de terceros que no son propiedad ni están controlados por el sitio web o su operador. El sitio web no tiene control ni asume ninguna responsabilidad por el contenido, las políticas de privacidad o las prácticas de sitios de terceros. Además, el sitio web no censurará ni editará el contenido de ningún sitio de terceros. Al utilizar cualquiera de los sitios web, nos libera expresamente de toda responsabilidad derivada del uso que haga de sitios de terceros. En consecuencia, lo alentamos a que esté atento cuando abandone el sitio web y lea los términos, condiciones y políticas de privacidad de cada uno de los sitios que visite.
El sitio web es para contenido orientado a adultos. Otras categorías de contenido pueden ser rechazadas o eliminadas a nuestro exclusivo criterio. Podemos, a nuestro exclusivo criterio y en cualquier momento, eliminar cualquier contenido del sitio web.
Usted comprende y reconoce que al usar el sitio web, estará expuesto a contenido de una variedad de fuentes, y que el sitio web no es responsable de la precisión, utilidad, seguridad o derechos de propiedad intelectual de dicho contenido. Además, comprende y reconoce que puede estar expuesto a contenido inexacto, ofensivo, indecente u objetable, y acepta renunciar, y por la presente renuncia, a cualquier derecho o recurso legal o equitativo que tenga o pueda tener contra el sitio web con al respecto, y acepta indemnizar y eximir de responsabilidad al sitio web, su operador, su corporación matriz, sus afiliados, otorgantes de licencias, proveedores de servicios, funcionarios, directores, empleados, agentes, sucesores y cesionarios, en la mayor medida permitida por la ley con respecto a todos los asuntos. Relacionados con su uso del sitio web.
Preferencia de comunicación
Al usar el sitio web, usted expresa y específicamente acepta recibir comunicaciones electrónicas de nosotros relacionadas con su cuenta. Estas comunicaciones pueden implicar el envío de correos electrónicos a su dirección de correo electrónico proporcionada durante el registro, o la publicación de comunicaciones en el sitio web (por ejemplo, a través del área de miembros en el sitio web al iniciar sesión para garantizar la recepción en caso de que se haya dado de baja de las comunicaciones por correo electrónico), o en la página "Mi cuenta" o "Mi perfil" y pueden incluir avisos sobre su cuenta Acceso al sitio web y seguridad de la cuenta
Usted es responsable de:
Hacer todos los arreglos necesarios para que usted tenga acceso al sitio web, y garantizar que todas las personas que accedan al sitio web a través de su conexión a Internet conozcan estos Términos de servicio y los cumplan.
Para acceder al sitio web o a algunos de los recursos que ofrece, es posible que se le solicite que proporcione ciertos detalles de registro u otra información. Es una condición de su uso del sitio web que toda la información que proporcione en el sitio web sea correcta, actual y completa. Usted acepta que toda la información que proporcione para registrarse en el sitio web o de otra manera, incluido, entre otros, mediante el uso de cualquier función interactiva en el sitio web.
Si elige, o se le proporciona, un nombre de usuario, contraseña o cualquier otra información como parte de nuestros procedimientos de seguridad, debe tratar dicha información como confidencial y no debe revelarla a ninguna otra persona. Usted es completamente responsable de todas las actividades que ocurran bajo su nombre de usuario o contraseña. .
 Si interactúa con nosotros o con proveedores de servicios externos, acepta que toda la información que proporcione será precisa, completa y actual. Revisará todas las políticas y acuerdos aplicables al uso de servicios de terceros. En el caso de que utilice nuestro sitio web a través de dispositivos móviles, por la presente reconoce que se seguirán aplicando las tarifas y tarifas normales de su proveedor, como las tarifas de banda ancha en exceso.
Tenemos el derecho de deshabilitar cualquier nombre de usuario, contraseña u otro identificador, ya sea elegido por usted o proporcionado por nosotros, en cualquier momento a nuestro exclusivo criterio por cualquier motivo o sin él, incluso si, en nuestra opinión, ha violado alguna disposición de estos Términos de servicio.
Licencia limitada y condicional para usar nuestra propiedad intelectual
Camaleón y los logotipos y nombres asociados son nuestras marcas comerciales y/o marcas de servicio. Otras marcas comerciales, marcas de servicio, nombres y logotipos utilizados en o a través del sitio web, como marcas comerciales, marcas de servicio, nombres o logotipos asociados con proveedores de contenido de terceros, son marcas comerciales, marcas de servicio o logotipos de sus respectivos propietarios. No se le otorga ningún derecho o licencia con respecto a ninguna de las marcas registradas, marcas de servicio o logotipos antes mencionados.
La inclusión de imágenes o texto que contenga las marcas comerciales o marcas de servicio o el nombre o la imagen de cualquier persona, incluida cualquier celebridad, no constituye un respaldo, expreso o implícito, por parte de dicha persona, del sitio web o viceversa.
No puede reproducir, distribuir, comunicar al público, poner a disposición, adaptar, realizar públicamente, vincular o mostrar públicamente el sitio web y las obras o cualquier adaptación de los mismos, a menos que se establezca expresamente en este documento. Tal conducta excedería el alcance de su licencia y constituiría una infracción de derechos de autor.
El sitio web puede proporcionar una función de "reproductor integrable", que puede incorporar en su propio sitio web para acceder al contenido del sitio web. No puede modificar, desarrollar o bloquear ninguna parte o funcionalidad del Reproductor integrable de ninguna manera, incluidos, entre otros, los enlaces de regreso al sitio web.
La licencia descrita anteriormente está condicionada a su cumplimiento de estos Términos de servicio, incluido, específicamente, su acuerdo para ver el sitio web completo e intacto tal como lo presenta el anfitrión del sitio web, completo con cualquier publicidad, y terminará con la terminación de estos Términos de servicio. . Si incumple alguna disposición de estos Términos de servicio, cualquier licencia que haya obtenido se rescindirá y terminará automáticamente. Para proteger nuestros derechos, parte del Contenido disponible en el sitio web puede estar controlado por tecnologías de gestión de derechos digitales, lo que restringirá la forma en que puede usar el Contenido. No debe eludir, eliminar, deshabilitar, alterar o interferir de otro modo con ninguna tecnología de gestión de derechos digitales. Tal conducta está prohibida por la ley.
No tiene permitido reproducir, descargar, distribuir, transmitir, difundir, exhibir, vender, licenciar, alterar, modificar o copiar o reproducir nuestras Obras o Contenido que no le pertenezca, en su totalidad o en parte.
Usted declara y garantiza que con respecto a todo el Contenido que cargará en el Sitio web:
el Contenido no contraviene ninguna ley aplicable y no somete al Sitio web a ningún reclamo, demanda, juicio, acción regulatoria o cualquier riesgo real, potencial o de responsabilidad, o cualquier amenaza de ello; usted posee los derechos para usar el Contenido en el sitio web y que el Contenido no infringe los derechos (incluidos los derechos de propiedad intelectual) de un tercero y que ha obtenido el consentimiento y la autorización para cada individuo que aparece en su Contenido, incluidos el derecho de usar y cargar el Contenido en el sitio web; para cada persona que aparece en su Contenido, ha verificado y examinado cuidadosamente una identificación gubernamental válida con fotografía que demuestre que tiene al menos 18 años de edad el día en que se fotografía, filma o aparece de otra manera en dicho Contenido (esto se aplica a todas las personas, ya sea identificable o no, o desnudo o no);con respecto al Contenido, usted o el productor del Contenido han recopilado y mantenido los registros requeridos según se modifique ocasionalmente, y cualquier otra ley aplicable sobre mantenimiento de registros o verificación de edad LEY 1978 DE 2019 el Contenido no es un duplicado de otra pieza de Contenido cargada por usted; el del sitio web , incluida su Política de material de abuso sexual infantil y su Política de contenido no consentido
Si no cumplimos con estos Términos de servicios, o si determinamos que alguna de las declaraciones anteriores es falsa o no se cumple, podemos, a nuestro exclusivo criterio, negarnos a incluir el Contenido o cualquier parte del mismo o cualquier referencia ha dicho Contenido. En el sitio web, elimine el contenido en cuestión del sitio web, cancele su cuenta y tome las medidas necesarias para minimizar o eliminar cualquier responsabilidad.
Podemos, a nuestro exclusivo criterio, cancelar su cuenta si incumple alguno de los Términos de servicio o en cualquier momento por cualquier motivo, incluso sin causa.
Si creemos que su Contenido viola alguna ley penal, la Política de material de abuso sexual infantil del sitio web, la Política de contenido no consensuado del sitio web , su cuenta será cancelada de inmediato, se le prohibirá el acceso al sitio web sin previo aviso y lo denunciaremos ante la ley. Autoridades de aplicación
Obligación de cumplir con los requisitos de mantenimiento de registros.Usted certifica que el Contenido que carga en el sitio web se ha producido y se mantienen registros de acuerdo , según se modifique periódicamente, con las normas y reglamentos establecidos, según se modifique ocasionalmente, y cualquier otra ley aplicable sobre mantenimiento de registros o verificación de edad. A nuestra solicitud, deberá entregarnos de inmediato copias legibles (como pueden estar redactadas legalmente), de identificaciones gubernamentales válidas (a la fecha de producción del Contenido) reconocibles con fotografía para cualquiera o todas las personas que aparecen en una parte o la totalidad de su Contenido ( que demuestre que cada uno tenía al menos 18 años de edad el día en que se produjo el Contenido) junto con los formularios de identificación, documentos y autorizaciones requeridas. En este contexto, cuando nos referimos a todas las personas que aparecen en el Contenido, queremos decir, sin limitación, individuos fotografiados o individuos que aparecen en el Contenido, ya sea que aparezcan desnudos, semidesnudos o completamente vestidos, participando en relaciones sexuales reales o simuladas (incluidas las escenas en solitario). Si no entrega de inmediato la información solicitada cuando se le solicite, puede dar lugar a la suspensión temporal o permanente de su cuenta. Usted, a su cargo, nos indemnizará, defenderá y eximirá de toda responsabilidad, pérdida, daño, multa, tarifa, sanción, costo y gasto (incluidos los honorarios razonables de los abogados) incurridos o sufridos por nosotros por cualquier reclamo. que surja o resulte de su incumplimiento o negligencia para cumplir con el mantenimiento de cualquier registro legalmente obligatorio. Semidesnudo o completamente vestido, participar en relaciones sexuales reales o simuladas (incluidas las escenas en solitario). Si no entrega de inmediato la información solicitada cuando se le solicite, puede dar lugar a la suspensión temporal o permanente de su cuenta. Usted, a su cargo, nos indemnizará, defenderá y eximirá de toda responsabilidad, pérdida, daño, multa, tarifa, sanción, costo y gasto (incluidos los honorarios razonables de los abogados) incurridos o sufridos por nosotros por cualquier reclamo. Que surja o resulte de su incumplimiento o negligencia para cumplir con el mantenimiento de cualquier registro legalmente obligatorio. Semidesnudo o completamente vestido, participar en relaciones sexuales reales o simuladas (incluidas las escenas en solitario). Si no entrega de inmediato la información solicitada cuando se le solicite, puede dar lugar a la suspensión temporal o permanente de su cuenta. Usted, a su cargo, nos indemnizará, defenderá y eximirá de toda responsabilidad, pérdida, daño, multa, tarifa, sanción, costo y gasto (incluidos los honorarios razonables de los abogados) incurridos o sufridos por nosotros por cualquier reclamo. Que surja o resulte de su incumplimiento o negligencia para cumplir con el mantenimiento de cualquier registro legalmente obligatorio.
Usted reconoce que es el único responsable de la actividad que ocurre en su cuenta. Tenga en cuenta que no puede permitir que ninguna otra persona use su cuenta y que debe informarnos de inmediato sobre cualquier aparente violación de la seguridad, como pérdida, robo o divulgación no autorizada o uso de un nombre de pantalla o contraseña. Nunca puede usar la cuenta de otra persona, al igual que nadie puede usar la suya.
Usted será responsable de cualquier pérdida en la que incurramos debido al uso no autorizado de su cuenta. No somos responsables de sus pérdidas causadas por cualquier uso no autorizado de su cuenta y usted renuncia específicamente a tal reclamo y acepta defendernos e indemnizarnos contra tales reclamos contra su cuenta por parte de terceros.
En la medida en que cree voluntariamente un perfil de usuario para participar en ciertos servicios seleccionados que ofrecemos, su perfil (y sus contenidos) pueden ser buscados por otros Usuarios registrados a través del sitio web y otros asociados o conectados en red con nosotros. Del mismo modo, su perfil (y sus contenidos) pueden ser consultados por motores de búsqueda disponibles públicamente.
Usted comprende que no garantizamos ninguna confidencialidad con respecto a ningún Contenido que aporte.
Sujeto a lo permitido por la ley aplicable, usted es libre de elegir el tipo de Contenido que produce y publica. Usted será el único responsable de su propio Contenido y de las consecuencias de publicar dicho Contenido.
No somos responsables de ningún Contenido que viole los estándares de la comunidad en su comunidad. Si está buscando información sobre actividades ilegales o inapropiadas, acepta abandonar el sitio web de inmediato. Esperamos y exigimos que cumpla con todas las leyes aplicables al usar el sitio web y al enviar o publicar contenido en el sitio web. No podemos hacer cumplir las leyes de todas las jurisdicciones para todo el Contenido que se publica en el sitio web. Como tal, no somos responsables del contenido del sitio web.
Debe evaluar y asumir todos los riesgos asociados con el uso de cualquier Contenido, incluida la confianza en la precisión, integridad, utilidad o legalidad de dicho Contenido. En este sentido, usted reconoce que no puede confiar en ningún contenido creado por nosotros o contenido transmitido al sitio web. Usted es responsable de todo el Contenido que cargue, publique, envíe por correo electrónico, transmita o ponga a disposición de otro modo a través del sitio web.
Si tenemos un motivo para sospechar que su Contenido viola cualquier derecho de terceros, incluidos, entre otros, cualquier derecho de autor, marca registrada o derecho de propiedad, podemos solicitarle que nos proporcione evidencia por escrito de su propiedad o derecho de uso del material. en cuestión. Si requerimos dicha evidencia por escrito, usted acepta brindárnosla dentro de los cinco (5) días hábiles posteriores a la fecha de nuestra solicitud. Su falta de proporcionarnos dicha evidencia escrita requerida dentro de ese plazo puede conducir a la terminación inmediata de su cuenta, exigimos una compensación de usted por los costos y daños acumulados relacionados con dicho Contenido.
Usted será el único responsable de su propio Contenido y de las consecuencias de publicar, cargar, publicar, transmitir o poner a disposición su Contenido en el sitio web. Usted comprende y reconoce que es responsable de cualquier Contenido que envíe o contribuya, y usted, no nosotros, tiene la responsabilidad total de dicho Contenido, incluida su legalidad, confiabilidad, precisión y adecuación. No controlamos el Contenido que envía o aporta, y no ofrecemos ninguna garantía relacionada con el Contenido enviado o aportado por los Usuarios. Bajo ninguna circunstancia seremos responsables de ninguna manera por ningún reclamo relacionado con el Contenido enviado o aportado por los Usuarios.
Usted afirma, declara y garantiza que posee o tiene las licencias, los derechos, los consentimientos y los permisos necesarios para publicar el Contenido que envía; y otorga al Sitio web todas las patentes, marcas registradas, secretos comerciales, derechos de autor u otros derechos de propiedad sobre dicho Contenido para su publicación en el Sitio web de conformidad con estos Términos de servicio.
Además, acepta que el Contenido que envíe al sitio web no contendrá material con derechos de autor de terceros, o material que esté sujeto a otros derechos de propiedad de terceros, a menos que tenga el permiso del propietario legítimo del material o que esté legalmente autorizado para publicar el material y para otorgar al sitio web todos los derechos de licencia otorgados en este documento.
Usted acepta y comprende que el Sitio web (y sus sucesores y afiliados) pueden hacer uso de su Contenido con fines promocionales o comerciales y para prestar los servicios de conformidad con estos Términos de servicios. Para mayor claridad, usted conserva todos sus derechos de propiedad sobre su Contenido. Al enviar contenido al sitio web, usted otorga a los operadores del sitio web una licencia ilimitada, mundial, perpetua, no exclusiva, libre de regalías, sublicenciable y transferible para usar, reproducir, publicar, distribuir, transmitir, comercializar, crear obras derivadas de , adaptar, traducir, exhibir públicamente, comunicar o realizar, poner a disposición o utilizar de otro modo todo el Contenido, lo que incluye, entre otros, la promoción y redistribución de parte o la totalidad del Sitio web (y los trabajos derivados del mismo) en cualquier formato de medios y a través de cualquier medio canales También renuncia, en la máxima medida permitida por la ley, a cualquier reclamo contra nosotros relacionado con los derechos morales en el Contenido. En ninguna circunstancia seremos responsables ante usted por la explotación de cualquier Contenido que publique. También otorga a cada usuario del sitio web una licencia no exclusiva y libre de regalías para acceder a su contenido a través del sitio web según lo permitido en estos Términos de servicio. Por la presente, comprende y acepta que no puede usar el sitio web para permitir que otros usuarios descarguen o guarden el contenido que publica (o cualquier parte del mismo). Las licencias anteriores otorgadas por usted en el Contenido de video que envía al sitio web terminan dentro de un tiempo comercialmente razonable después de que elimine o elimine su contenido del sitio web. Sin embargo, comprende y acepta que el sitio web puede retener, pero no mostrar, distribuir o realizar, copias del servidor de sus videos que han sido eliminados o eliminados. Las licencias anteriores otorgadas por usted en los comentarios de usuario que envía son perpetuas e irrevocables.
El sitio web no respalda ningún contenido enviado por ningún usuario u otro licenciante, ni ninguna opinión, recomendación o consejo expresado en el mismo, y el sitio web renuncia expresamente a cualquier responsabilidad en relación con el contenido. El sitio web no permite actividades que infrinjan los derechos de autor y la infracción de los derechos de propiedad intelectual en el sitio web, y el sitio web eliminará todo el contenido si se le notifica adecuadamente que dicho contenido infringe los derechos de propiedad intelectual de otra persona. El Sitio Web se reserva el derecho de eliminar Contenido sin previo aviso.
Todo el Contenido que envíe debe cumplir con los estándares de Contenido establecidos en estos Términos de servicio.
Si alguno de los Contenidos que publica en el Sitio web o a través de este contiene ideas, sugerencias, documentos y/o propuestas para nosotros, no tendremos ninguna obligación de confidencialidad, expresa o implícita, con respecto a dicho Contenido, y tendremos derecho usar, explotar o divulgar (o optar por no usar o divulgar) dicho Contenido a nuestro exclusivo criterio sin ninguna obligación hacia usted (es decir, no tendrá derecho a ninguna compensación de ningún tipo por nuestra parte bajo ninguna circunstancia).
Reglas aplicables a los usuarios verificados
Como usuario verificado, será un titular de cuenta identificado válidamente y podrá enviar contenido al sitio web, incluidos videos.
Podemos, a nuestro exclusivo criterio, rechazar su solicitud para unirse a nuestra comunidad de proveedores de contenido por cualquier motivo.
Es posible que se le solicite que proporcione una dirección de correo electrónico válida para fines de verificación. Elegirá su propio nombre de pantalla, que debe ser exclusivo para usted, no ofensivo para los demás y que no infrinja los derechos de autor o la marca comercial de otra persona. También elegirás tu contraseña, que podrás cambiar más tarde. Es imperativo que no permita que nadie más use su cuenta (debe mantener su contraseña en secreto y segura). Ciertos cambios en su información personal, como su nombre y nombre de pantalla, solo pueden ser realizados por nuestro personal. Por lo tanto, si su información parece incorrecta o necesita ser cambiada, es posible que deba comunicarse con nuestro personal para que lo haga.
Antes de que pueda cargar contenido en el sitio web, debe verificar su identidad. Para hacerlo, debe enviarnos imágenes de alta resolución o escaneos de un mínimo de uno o dos documentos de información, que contengan su fecha de nacimiento, fecha de vencimiento de la identificación, su foto, su nombre legal completo y su dirección. . Esto podría ser, por ejemplo, su licencia de conducir (en países donde una identificación nacional no es obligatoria), pasaporte internacional, tarjeta de ciudadanía, identificación estatal, pasaporte nacional o su tarjeta de identificación nacional. La otra forma de identificación puede ser una factura de servicios públicos. Si toda la información requerida se encuentra en su identificación con foto emitida por el gobierno, no necesita un segundo documento. Podemos, a nuestro exclusivo criterio, solicitarle que nos proporcione múltiples formas de identificación para establecer prueba de la edad adulta y la identidad. También se requiere verificación facial y una evaluación de la autenticidad de los documentos antes mencionados en el contexto de nuestra verificación de su identidad. Nuestra recopilación, uso y divulgación de dicha información y documentación se rige por nuestra Política .
Reglas aplicables a los socios de contenido
Si desea convertirse en un socio de contenido y publicar contenido en el sitio web, primero debe unirse a nuestro Programa de socios de contenido y aceptar sus términos y condiciones.
Reglas aplicables a los modelos
Si desea convertirse en modelo y publicar contenido a través del sitio web, primero debe unirse a nuestro Programa de socios modelo y aceptar sus términos y condiciones.
Podemos, a nuestro exclusivo criterio, rechazar su solicitud para unirse a nuestra comunidad de proveedores de contenido por cualquier motivo.
Es posible que se le solicite que proporcione una dirección de correo electrónico válida para fines de verificación. Elegirá su propio nombre de pantalla, que debe ser exclusivo para usted, no ofensivo para los demás y que no infrinja los derechos de autor o la marca comercial de otra persona. También elegirás tu contraseña, que podrás cambiar más tarde. Es imperativo que no permita que nadie más use su cuenta (debe mantener su contraseña en secreto y segura). Ciertos cambios en su información personal, como su nombre y nombre de pantalla, solo pueden ser realizados por nuestro personal. Por lo tanto, si su información parece incorrecta o necesita ser cambiada, es posible que deba comunicarse con nuestro personal para que lo haga.
Antes de que pueda cargar contenido en el sitio web, debe verificar su identidad. Para hacerlo, debe enviarnos imágenes de alta resolución o escaneos de un mínimo de uno o dos documentos de información, que contengan su fecha de nacimiento, fecha de vencimiento de la identificación, su foto, su nombre legal completo y su dirección. . Esto podría ser, por ejemplo, su licencia de conducir (en países donde una identificación nacional no es obligatoria), pasaporte internacional, tarjeta de ciudadanía, identificación estatal, pasaporte nacional o su tarjeta de identificación nacional. La otra forma de identificación puede ser una factura de servicios públicos. Si toda la información requerida se encuentra en su identificación con foto emitida por el gobierno, no necesita un segundo documento. Podemos, a nuestro exclusivo criterio, solicitarle que nos proporcione múltiples formas de identificación para establecer prueba de la edad adulta y la identidad. También se requiere verificación facial y una evaluación de la autenticidad de los documentos antes mencionados en el contexto de nuestra verificación de su identidad. Nuestra recopilación, uso y divulgación de dicha información y documentación se rige por nuestra Política .
Uso del sitio web
Usted acepta que solo utilizará el sitio web y nuestros servicios para los fines legales expresamente permitidos y contemplados en estos Términos de servicio. No puede usar el sitio web y nuestros servicios para ningún otro propósito, incluidos, entre otros, fines comerciales, sin nuestro consentimiento expreso por escrito.
Usted acepta que verá el sitio web y su contenido sin alteraciones ni modificaciones. Usted reconoce y comprende que tiene prohibido modificar el sitio web o eliminar cualquiera de los contenidos del sitio web, incluido los anuncios. No debe eludir, eliminar, eliminar, deshabilitar, alterar ni interferir de ningún otro modo con ningún proceso, tecnología o herramienta de seguridad de verificación de edad que se utilice en cualquier parte del sitio web o en relación con nuestros servicios. Al usar el sitio web, usted acepta expresamente aceptar la publicidad que se muestra en el sitio web y a través de él y abstenerse de usar software de bloqueo de anuncios o deshabilitar el software de bloqueo de anuncios antes de visitar el sitio web.
El contenido se le proporciona TAL CUAL. Puede acceder al Contenido para su información y uso personal únicamente según lo previsto a través de la funcionalidad proporcionada del sitio web y según lo permitido en estos Términos de servicio. No descargará, copiará, reproducirá, distribuirá, transmitirá, difundirá, exhibirá, venderá, licenciará ni explotará de otro modo ningún Contenido que no esté permitido en los Términos de servicio.
Usos Prohibidos
Usted acepta que no usará ni intentará usar ningún método, dispositivo, software o rutina para dañar a otros o interferir con el funcionamiento del sitio web, o usar y/o monitorear cualquier información en o relacionada con el sitio web para cualquier propósito no autorizado. .
Además de las restricciones generales anteriores, las siguientes restricciones y condiciones se aplican específicamente a su uso del Contenido. Cualquier determinación con respecto al incumplimiento de cualquiera de los siguientes es definitiva. Revise detenidamente la siguiente lista de usos prohibidos antes de utilizar el sitio web. Específicamente, acepta no utilizar nada del sitio web para:
Violar cualquier ley o alentar o dar instrucciones a otro para que lo haga;
actuar de una manera que afecte negativamente la capacidad de otros Usuarios para usar el sitio web, lo que incluye, entre otros, participar en conductas dañinas, amenazantes, abusivas, incendiarias, intimidatorias, violentas o que fomentan la violencia contra personas o animales, acosando, acechando, invasivo de la privacidad de otro, u objetable racial, étnicamente o de otra manera;
Publicar cualquier Contenido que represente a una persona menor de 18 años (o mayor en cualquier otro lugar en el que 18 no sea la mayoría de edad), ya sea real o simulado;
Publicar cualquier Contenido para el que no haya mantenido documentación escrita suficiente para confirmar que todos los sujetos de sus publicaciones son, de hecho, mayores de 18 años.
Publicar cualquier Contenido que muestre actividad sexual de menores de edad, actividad sexual no consensuada, pornografía de venganza, chantaje, intimidación, rapé, tortura, muerte, violencia, incesto, insultos raciales o discurso de odio (ya sea oralmente o por escrito);Publicar cualquier Contenido que contenga falsedades o tergiversaciones que puedan dañar el sitio web o cualquier tercero; publicar cualquier Contenido que sea obsceno, ilegal, ilegal, fraudulento, difamatorio, calumnioso, acosador, odioso, racial o étnicamente ofensivo, o que aliente una conducta que se consideraría una ofensa criminal, daría lugar a responsabilidad civil, violaría cualquier ley, o de otro modo sería inadecuado; publicar cualquier Contenido que contenga publicidad no solicitada o no autorizada, materiales promocionales, spam, correo no deseado, cartas en cadena, esquemas piramidales o cualquier otra forma de solicitud no autorizada; publicar cualquier Contenido que contenga sorteos, concursos o loterías, o que esté relacionado con juegos de azar; publicar cualquier Contenido que contenga materiales con derechos de autor, o materiales protegidos por otras leyes de propiedad intelectual, que no sean de su propiedad o para los cuales no haya obtenido todos los permisos y liberaciones por escrito necesarios; publicar cualquier Contenido que se haga pasar por otra persona o que declare falsamente o tergiverse de otro modo su afiliación con una persona; usar el sitio web (o publicar cualquier contenido que) de cualquier manera que promueva o facilite la prostitución, la solicitud de prostitución, la trata de personas o la trata sexual; usar el sitio web para organizar reuniones en persona con fines de actividad sexual por contrato
Recopilar o almacenar datos personales sobre cualquier persona; alterar o modificar sin permiso cualquier parte del sitio web o su contenido, incluidos los anuncios; obtener o intentar acceder u obtener cualquier Contenido o información a través de cualquier medio que no esté intencionalmente disponible o proporcionado a través del sitio web; explotar errores en el diseño, características que no están documentadas y/o errores para obtener acceso que de otro modo no estaría disponible.
Además, acepta no:
usar el sitio web de cualquier manera que pueda deshabilitar, sobrecargar, dañar o perjudicar el sitio o interferir con el uso del sitio web por parte de terceros, incluida su capacidad para participar en actividades en tiempo real a través del sitio web; usar cualquier robot, araña u otro dispositivo, proceso o medio automático para acceder al sitio web para cualquier propósito, incluido el monitoreo o la copia de cualquier material en el sitio web sin nuestro consentimiento previo por escrito; usar cualquier proceso manual para descargar, monitorear o copiar cualquier material en el sitio web o para cualquier otro propósito no autorizado; usar cualquier información obtenida de o a través del sitio web para bloquear o interferir con la visualización de cualquier publicidad en el sitio web, o con el fin de implementar, modificar o actualizar cualquier software o listas de filtros que bloqueen o interfieran con la visualización de cualquier publicidad en el sitio web Sitio web;
Usar cualquier dispositivo, bot, script, software o rutina que interfiera con el funcionamiento adecuado del sitio web o que acorte o altere las funciones del sitio web para ejecutarse o aparecer de formas que no están previstas en el diseño del sitio web; introducir o cargar virus, caballos de Troya, gusanos, bombas lógicas, bombas de tiempo, cancelbots, archivos corruptos o cualquier otro software, programa o material similar que sea malicioso o tecnológicamente dañino o que pueda dañar el funcionamiento de la propiedad de otra persona o de la el sitio web o nuestros servicios; intentar obtener acceso no autorizado, interferir, dañar o interrumpir cualquier parte del sitio web, el servidor en el que se almacena el sitio web o cualquier servidor, computadora o base de datos conectada al sitio web; eliminar cualquier derecho de autor u otros avisos de propiedad de nuestro sitio web o cualquiera de los materiales contenidos en el mismo; atacar el sitio web a través de un ataque de denegación de servicio o un ataque de denegación de servicio distribuido; de otra manera intentar interferir con el correcto funcionamiento del sitio web.
Supervisión y Cumplimiento; Terminación
Tenemos el derecho pero no la obligación de:
eliminar o negarse a publicar cualquier Contenido que envíe o contribuya al sitio web por cualquier motivo o sin él, a nuestro exclusivo criterio, incluido, entre otros, si alguna información o documentación proporcionada por usted es inadecuada, incompleta o inexacta o no nos permite evaluar y confirmar su identidad; monitorear cualquier comunicación que ocurra en o a través del sitio web para confirmar el cumplimiento de estos Términos de servicio, la seguridad del sitio web o cualquier obligación legal; tomar cualquier medida con respecto a cualquier Contenido publicado por usted que consideremos necesario o apropiado a nuestro exclusivo criterio, incluso si creemos que dicho Contenido viola estos Términos de servicio, infringe cualquier derecho de propiedad intelectual u otro derecho de cualquier persona o entidad, amenaza la seguridad personal de los Usuarios del Sitio Web o del público, o podría crear responsabilidad para nosotros; tomar las medidas legales apropiadas, que incluyen, entre otras, la remisión a las fuerzas del orden, por cualquier uso ilegal o no autorizado del sitio web; rescindir o suspender su acceso a todo o parte del sitio web por cualquier motivo o sin él, incluida, entre otras, cualquier violación de estos Términos de servicio.
Sin limitar lo anterior, tenemos derecho a cooperar plenamente con cualquier autoridad encargada de hacer cumplir la ley u orden judicial que nos solicite u ordene que divulguemos la identidad u otra información de cualquier persona que publique cualquier Contenido en el sitio web o a través de este. USTED RENUNCIA A NOSOTROS, A NUESTROS FUNCIONARIOS, DIRECTORES, EMPLEADOS, SUCESORES Y CESIONARIOS DE CUALQUIER RECLAMACIÓN RESULTANTE DE CUALQUIER ACCIÓN TOMADA POR NOSOTROS COMO CONSECUENCIA DE LA DIVULGACIÓN DE INFORMACIÓN PERSONAL EN RELACIÓN CON LAS SOLICITUDES DE DIVULGACIÓN DE DATOS DE LAS AUTORIDADES POLICIALES.
El sitio web toma una posición poderosa contra cualquier forma de explotación infantil o trata de personas. Si descubrimos que cualquier Contenido involucra a personas menores de edad, o cualquier forma de fuerza, fraude o coerción, eliminaremos el Contenido y enviaremos un informe a las autoridades policiales correspondientes. Si se da cuenta de dicho Contenido, acepta informarlo al sitio web poniéndose en contacto con xxxxxxxx@xxxx.com
Para mantener nuestros servicios de la manera que consideremos apropiada para nuestro lugar y en la máxima medida permitida por las leyes aplicables, el sitio web puede, pero no tendrá la obligación de mostrar, rechazar, negarse a publicar, almacenar, mantener, aceptar o eliminar cualquier Contenido publicado (incluidos, entre otros, mensajes privados, comentarios públicos, mensajes de chat grupales públicos, mensajes de chat grupales privados o mensajes instantáneos privados) por usted, y podemos, a nuestro exclusivo criterio, eliminar, mover, reformatear, eliminar o negarse a publicar o hacer uso del Contenido sin previo aviso ni ninguna responsabilidad hacia usted o cualquier tercero en relación con nuestra operación del sitio web de manera adecuada. Además, el sitio web puede, pero no tendrá ninguna obligación de, revisar y monitorear mensajes privados, comentarios públicos, mensajes de chat grupales públicos, mensajes de chat grupales privados, o mensajes instantáneos privados publicados por usted. Sin limitación, podemos hacerlo para abordar el Contenido que nos llama la atención y que creemos que es ofensivo, obsceno, violento, acosador, amenazante, abusivo, ilegal o de otra manera objetable o inapropiada, o para hacer cumplir los derechos de terceros o estos Términos. de Servicio o cualquier término adicional aplicable, incluidas, entre otras, las restricciones de Contenido establecidas en este documento.
No asumimos ninguna responsabilidad por cualquier acción o inacción con respecto a las transmisiones, comunicaciones o Contenido proporcionado por cualquier Usuario o tercero. No tenemos obligación ni responsabilidad ante nadie por el desempeño o no desempeño de las actividades descritas en esta sección.
Política de cancelación de cuenta
Si bien se acepta Contenido pornográfico y orientado a adultos, el sitio web se reserva el derecho de decidir si el Contenido es apropiado o viola estos Términos de servicio por motivos distintos a la infracción de derechos de autor y violaciones de los derechos de propiedad intelectual, como, entre otros, obsceno o material difamatorio. El sitio web puede, en cualquier momento, sin previo aviso y a su sola discreción, eliminar dicho Contenido y/o cancelar la cuenta de un Usuario por enviar dicho material en violación de estos Términos de servicio.
Si viola la letra o el espíritu de estos Términos de servicio, o crea un riesgo o una posible exposición legal para nosotros, podemos cancelar el acceso al sitio web o dejar de proporcionarle todo o parte del sitio web.
Derechos de autor y otra propiedad intelectual
El sitio web opera una Política de derechos de autor clara en relación con cualquier Contenido que presuntamente infrinja los derechos de autor de un tercero. Si cree que algún Contenido viola sus derechos de autor, consulte nuestra Política de derechos de autor para obtener instrucciones sobre cómo enviarnos un aviso de infracción de derechos de autor. Como parte de nuestra Política de derechos de autor , el sitio web cancelará el acceso del usuario al sitio web si, en las circunstancias apropiadas, se determina que un usuario es un infractor reincidente.
Informe de abuso
El sitio web no permite ninguna forma de pornografía de venganza, chantaje o intimidación. Las violaciones de esta política se pueden informar a través de este app fas camaleón
Confianza en la información publicada
La información presentada en el sitio web se pone a disposición únicamente con fines de información general. No garantizamos la exactitud, integridad o utilidad de esta información. Cualquier confianza que deposite en dicha información es estrictamente bajo su propio riesgo. Renunciamos a toda responsabilidad que surja de la confianza depositada en dichos materiales por usted o cualquier otro visitante del sitio web, o por cualquier persona que pueda estar informada de cualquiera de sus contenidos.
El sitio web incluye contenido proporcionado por terceros, incluidos los materiales proporcionados por otros usuarios, blogueros y licenciantes, sindicadores, agregadores y/o servicios de informes de terceros. Todas las declaraciones y/u opiniones expresadas en estos materiales, y todos los artículos y respuestas a preguntas y otro contenido, que no sea el contenido proporcionado por nosotros, son únicamente opiniones y responsabilidad de la persona o entidad que proporciona dichos materiales. Estos materiales no reflejan necesariamente nuestra opinión. No somos responsables ante usted o cualquier tercero por el contenido o la precisión de los materiales proporcionados por terceros.
Cambios en el sitio web
Es posible que actualicemos el contenido del sitio web de vez en cuando, pero su contenido no está necesariamente completo o actualizado. Cualquiera de los materiales en el sitio web puede estar desactualizado en un momento dado, y no tenemos la obligación de actualizar dicho material.
Información sobre usted y sus visitas al sitio web
Toda la información que recopilamos en el sitio web está sujeta a nuestra Política de privacidad . Al usar el sitio web, usted reconoce que ha leído y comprende los términos de la Política de privacidad y que acepta todas las acciones que tomamos con respecto a su información de conformidad con la Política de privacidad .
Enlace al sitio web y funciones de redes sociales
Puede vincular al sitio web, siempre que lo haga de manera justa y legal y no dañe nuestra reputación ni se aproveche de ella, pero no debe establecer un enlace de tal manera que sugiera cualquier forma de asociación, aprobación o respaldo de nuestra parte sin nuestro consentimiento expreso por escrito.
El sitio web puede proporcionar ciertas funciones de redes sociales que le permiten:
Enlace desde su propio sitio web o de ciertos sitios web de terceros a cierto contenido en el sitio web; enviar correos electrónicos u otras comunicaciones con cierto contenido, o enlaces a cierto contenido, en el sitio web; hacer que porciones limitadas de contenido en el sitio web se muestren o parezcan mostrarse en su propio sitio web o en ciertos sitios web de terceros.
Puede usar estas funciones únicamente como las proporcionamos nosotros y únicamente con respecto al contenido con el que se muestran y, de lo contrario, de acuerdo con los términos y condiciones adicionales que proporcionamos con respecto a dichas funciones. Sujeto a lo anterior, usted no debe:
Hacer que el sitio web o partes del sitio web se muestren, o parezcan mostrarse, por ejemplo, mediante encuadres, enlaces profundos o enlaces en línea, en cualquier otro sitio,de lo contrario, tomar cualquier acción con respecto a los materiales en el sitio web que sea inconsistente con cualquier otra disposición de estos Términos de servicio.
Los sitios desde los que está enlazando, o en los que hace accesible cierto contenido, deben cumplir en todos los aspectos con los estándares de contenido establecidos en estos Términos de servicio.
Usted acepta cooperar con nosotros para hacer que cese de inmediato cualquier encuadre o enlace no autorizado. Nos reservamos el derecho de retirar el permiso de vinculación sin previo aviso.
Podemos deshabilitar todas o algunas de las funciones de las redes sociales y cualquier enlace en cualquier momento sin previo aviso a nuestro exclusivo criterio.
Enlaces desde el sitio web
Si el sitio web contiene enlaces a otros sitios y recursos proporcionados por terceros, estos enlaces se proporcionan únicamente para su comodidad. Esto incluye enlaces contenidos en anuncios, incluidos anuncios publicitarios y enlaces patrocinados. No tenemos control ni asumimos ninguna responsabilidad por el contenido, las políticas de privacidad o las prácticas de esos sitios o recursos, y no aceptamos ninguna responsabilidad por ellos o por cualquier pérdida o daño que pueda surgir de su uso de ellos. La inclusión, vinculación o permiso para el uso o la instalación de cualquier sitio, aplicación, software, contenido o publicidad de terceros no implica la aprobación o el respaldo de los mismos por nuestra parte. Si decide acceder a cualquiera de los sitios de terceros vinculados al sitio web, lo hace bajo su propio riesgo y sujeto a los términos y condiciones de uso de dichos sitios. Más lejos,
Sus comunicaciones o tratos con, o participación en promociones de, patrocinadores, anunciantes u otros terceros encontrados a través del sitio web, son únicamente entre usted y dichos terceros. Usted acepta que el sitio web no será responsable de ninguna pérdida o daño de ningún tipo incurrido como resultado de cualquier trato con dichos patrocinadores, terceros o anunciantes, o como resultado de su presencia en el sitio web.
Divulgaciones permitidas de información personal
El sitio web generalmente no recopila información de identificación personal (datos como su nombre, dirección de correo electrónico, contraseña y el contenido de sus comunicaciones) a menos que envíe o comunique contenido a través del sitio web o se registre con nosotros para usar ciertas funciones del sitio web. . El sitio web no divulgará ninguna información de identificación personal que recopile u obtenga, excepto: (i) como se describe en estos Términos de servicio o nuestra Política de privacidad; (ii) después de obtener su permiso para un uso o divulgación específicos; (iii) si se requiere que el sitio web lo haga para cumplir con cualquier proceso legal válido o solicitud gubernamental (como una orden judicial, una orden de registro, una citación, una solicitud de descubrimiento civil o un requisito legal) y puede, a nuestro exclusivo criterio, asesorar usted de tal proceso o solicitud; (iv) según sea necesario para proteger la propiedad, la seguridad o las operaciones del sitio web, o la propiedad o la seguridad de otros; o (v) a una persona que adquiere el sitio web, o los activos del operador del sitio web en relación con los cuales se ha recopilado o utilizado dicha información; o (vi) según lo exija la ley. Si se requiere que el sitio web responda o cumpla con cualquiera de estas solicitudes de información,
El sitio web tendrá acceso a toda la información que haya enviado o creado durante el tiempo que sea razonablemente necesario para cumplir o investigar cualquier solicitud de información, o para proteger el sitio web. Para hacer cumplir estos Términos de servicio, proteger los derechos de propiedad intelectual, cumplir con los procesos legales y la ley, y proteger el sitio web, usted 
Descargos de responsabilidad
USTED UTILIZA EL SITIO WEB BAJO SU PROPIO RIESGO. PROPORCIONAMOS EL SITIO WEB "TAL CUAL" Y "SEGÚN DISPONIBILIDAD". EN LA MEDIDA MÁXIMA PERMITIDA POR LA LEY, EL SITIO WEB, NIEGA TODAS LAS GARANTÍAS DE CUALQUIER TIPO RELACIONADAS CON EL SITIO WEB Y LOS BIENES O SERVICIOS OBTENIDOS A TRAVÉS DEL SITIO WEB, YA SEA EXPLÍCITA O IMPLÍCITA, INCLUYENDO, ENTRE OTRAS, LAS GARANTÍAS IMPLÍCITAS DE COMERCIABILIDAD, IDONEIDAD PARA UN PROPÓSITO PARTICULAR Y LA NO VIOLACIÓN. USTED SERÁ EL ÚNICO RESPONSABLE DE CUALQUIER DAÑO A SU SISTEMA INFORMÁTICO O PÉRDIDA DE DATOS QUE RESULTE DEL USO DEL SITIO WEB. NO OFRECEMOS NINGUNA GARANTÍA O REPRESENTACIÓN SOBRE LA EXACTITUD O LA INTEGRIDAD DEL CONTENIDO DEL SITIO WEB O EL CONTENIDO DE CUALQUIER SITIO VINCULADO AL SITIO WEB O QUE EL SITIO WEB CUMPLIRÁ CON SUS REQUISITOS Y NO ASUMIMOS NINGUNA RESPONSABILIDAD POR CUALQUIER (I) ERROR, ERROR O INEXACTITUD DE CONTENIDO, (II) LESIONES PERSONALES O DAÑOS A LA PROPIEDAD, DE CUALQUIER NATURALEZA, RESULTANTES DE SU ACCESO Y USO DEL SITIO WEB O DE NUESTROS SERVICIOS, (III) CUALQUIER ACCESO NO AUTORIZADO O USO DE NUESTROS SERVIDORES SEGUROS Y/O CUALQUIER INFORMACIÓN PERSONAL Y /O INFORMACIÓN FINANCIERA ALMACENADA EN EL MISMO, (IV) CUALQUIER INTERRUPCIÓN O CESE DE LA TRANSMISIÓN HACIA O DESDE EL SITIO WEB O NUESTROS SERVICIOS, (IV) CUALQUIER ERROR, VIRUS, TROYANO O SIMILARES QUE PUEDAN TRANSMITIRSE HACIA O A TRAVÉS DEL SITIO WEB O NUESTRO SERVICIOS POR CUALQUIER TERCERO, Y/O (V) CUALQUIER ERROR U OMISIÓN EN CUALQUIER CONTENIDO O POR CUALQUIER PÉRDIDA O DAÑO DE CUALQUIER TIPO INCURRIDO COMO RESULTADO DEL USO DE CUALQUIER CONTENIDO PUBLICADO, ENVIADO POR CORREO ELECTRÓNICO, TRANSMITIDO O PUESTO A DISPOSICIÓN DE OTRO MODO A TRAVÉS DEL SITIO WEB O NUESTROS SERVICIOS. EL SITIO WEB NO GARANTIZA, RESPALDA, GARANTIZA, O ASUME RESPONSABILIDAD POR CUALQUIER PRODUCTO O SERVICIO ANUNCIADO U OFRECIDO POR UN TERCERO A TRAVÉS DEL SITIO WEB O NUESTROS SERVICIOS O CUALQUIER SERVICIO CON HIPERVINCULOS O PRESENTADO EN CUALQUIER BANNER U OTRA PUBLICIDAD, Y EL SITIO WEB NO SERÁ PARTE NI SERÁ RESPONSABLE DE NINGUNA MANERA PARA MONITOREAR CUALQUIER TRANSACCIÓN ENTRE USTED Y TERCEROS PROVEEDORES DE PRODUCTOS O SERVICIOS. AL IGUAL QUE CON LA COMPRA DE UN PRODUCTO O SERVICIO A TRAVÉS DE CUALQUIER MEDIO O EN CUALQUIER ENTORNO, USTED DEBE UTILIZAR SU MEJOR JUICIO Y EJERCER PRECAUCIÓN CUANDO APROPIE.
NINGUNA INFORMACIÓN QUE USTED OBTENGA DE NOSOTROS O A TRAVÉS DEL SITIO WEB CREARÁ NINGUNA GARANTÍA NO EXPRESAMENTE ESTABLECIDA EN ESTOS TÉRMINOS.
Limitación de responsabilidad
(V) CUALQUIER ERROR U OMISIÓN EN CUALQUIER CONTENIDO O POR CUALQUIER PÉRDIDA O DAÑO DE CUALQUIER TIPO INCURRIDO COMO RESULTADO DEL USO DE CUALQUIER CONTENIDO PUBLICADO, ENVIADO POR CORREO ELECTRÓNICO, TRANSMITIDO O PUESTO A DISPOSICIÓN DE OTRO MODO A TRAVÉS DE NUESTRO SITIO WEB O SERVICIOS, Y/O (VI) ) INTERACCIONES QUE TENGA CON ANUNCIOS DE TERCEROS O PROVEEDORES DE SERVICIOS, O SITIOS DE TERCEROS, ENCONTRADOS EN O A TRAVÉS DE LOS SITIOS WEB, INCLUYENDO EL PAGO Y LA ENTREGA DE BIENES O SERVICIOS RELACIONADOS, Y CUALQUIER OTRO TÉRMINO, CONDICIÓN, POLÍTICA, GARANTÍA O DECLARACIÓN ASOCIADA CON DICHOS NEGOCIOS, YA SE BASAN EN GARANTÍA, CONTRATO, AGRAVIO O CUALQUIER OTRA TEORÍA LEGAL, Y SI EL SITIO WEB O EL OPERADOR DEL SITIO SON INFORMADOS O NO DE LA POSIBILIDAD DE DICHOS DAÑOS. LA LIMITACIÓN DE RESPONSABILIDAD ANTERIOR SE APLICARÁ EN LA MEDIDA MÁXIMA PERMITIDA POR LA LEY EN LA JURISDICCIÓN CORRESPONDIENTE. O DISPONIBLE DE OTRO MODO A TRAVÉS DE NUESTRO SITIO WEB O SERVICIOS, Y/O (VI) LAS INTERACCIONES QUE USTED TIENE CON ANUNCIOS O PROVEEDORES DE SERVICIOS DE TERCEROS, O SITIOS DE TERCEROS, ENCONTRADOS EN O A TRAVÉS DE LOS SITIOS WEB, INCLUYENDO EL PAGO Y LA ENTREGA DE BIENES RELACIONADOS O SERVICIOS, Y CUALQUIER OTRO TÉRMINO, CONDICIÓN, POLÍTICA, GARANTÍA O DECLARACIÓN ASOCIADA CON TALES TRATOS, YA SEA EN BASE A GARANTÍA, CONTRATO, AGRAVIO O CUALQUIER OTRA TEORÍA LEGAL, Y YA SEA EL SITIO WEB O SU OPERADOR SEAN O NO INFORMADOS DE LA POSIBILIDAD DE DICHOS DAÑOS. LA LIMITACIÓN DE RESPONSABILIDAD ANTERIOR SE APLICARÁ EN LA MEDIDA MÁXIMA PERMITIDA POR LA LEY EN LA JURISDICCIÓN CORRESPONDIENTE. O DISPONIBLE DE OTRO MODO A TRAVÉS DE NUESTRO SITIO WEB O SERVICIOS, Y/O (VI) LAS INTERACCIONES QUE USTED TIENE CON ANUNCIOS O PROVEEDORES DE SERVICIOS DE TERCEROS, O SITIOS DE TERCEROS, ENCONTRADOS EN O A TRAVÉS DE LOS SITIOS WEB, INCLUYENDO EL PAGO Y LA ENTREGA DE BIENES RELACIONADOS O SERVICIOS, Y CUALQUIER OTRO TÉRMINO, CONDICIÓN, POLÍTICA, GARANTÍA O DECLARACIÓN ASOCIADA CON TALES TRATOS, YA SEA EN BASE A GARANTÍA, CONTRATO, AGRAVIO O CUALQUIER OTRA TEORÍA LEGAL, Y YA SEA EL SITIO WEB O SU OPERADOR SEAN O NO INFORMADOS DE LA POSIBILIDAD DE DICHOS DAÑOS. LA LIMITACIÓN DE RESPONSABILIDAD ANTERIOR SE APLICARÁ EN LA MEDIDA MÁXIMA PERMITIDA POR LA LEY EN LA JURISDICCIÓN CORRESPONDIENTE. INCLUYENDO EL PAGO Y LA ENTREGA DE BIENES O SERVICIOS RELACIONADOS, Y CUALQUIER OTRO TÉRMINO, CONDICIÓN, POLÍTICA, GARANTÍA O REPRESENTACIÓN ASOCIADO CON TALES NEGOCIOS, YA SEA BASADO EN GARANTÍA, CONTRATO, AGRAVIO O CUALQUIER OTRA TEORÍA LEGAL, Y SI EL SITIO WEB O SU SE ADVIERTE AL OPERADOR DEL SITIO DE LA POSIBILIDAD DE TALES DAÑOS. LA LIMITACIÓN DE RESPONSABILIDAD ANTERIOR SE APLICARÁ EN LA MEDIDA MÁXIMA PERMITIDA POR LA LEY EN LA JURISDICCIÓN CORRESPONDIENTE. INCLUYENDO EL PAGO Y LA ENTREGA DE BIENES O SERVICIOS RELACIONADOS, Y CUALQUIER OTRO TÉRMINO, CONDICIÓN, POLÍTICA, GARANTÍA O REPRESENTACIÓN ASOCIADO CON TALES NEGOCIOS, YA SEA BASADO EN GARANTÍA, CONTRATO, AGRAVIO O CUALQUIER OTRA TEORÍA LEGAL, Y SI EL SITIO WEB O SU SE ADVIERTE AL OPERADOR DEL SITIO DE LA POSIBILIDAD DE TALES DAÑOS. LA LIMITACIÓN DE RESPONSABILIDAD ANTERIOR SE APLICARÁ EN LA MEDIDA MÁXIMA PERMITIDA POR LA LEY EN LA JURISDICCIÓN CORRESPONDIENTE.
USTED RECONOCE ESPECÍFICAMENTE QUE LOS FUNCIONARIOS, DIRECTORES Y EMPLEADOS DEL SITIO WEB NO SERÁN RESPONSABLES DEL CONTENIDO O DE LA CONDUCTA DIFAMATORIA, OFENSIVA O ILEGAL DE CUALQUIER TERCERO, Y QUE EL RIESGO DE PERJUICIO O DAÑO DERIVADO DE LO ANTERIOR ES TOTALMENTE DE SU CUENTA.
USTED RECONOCE ADEMÁS QUE CUALQUIER CONTENIDO CARGADO EN EL SITIO PUEDE SER VISUALIZADO, DESCARGADO, REPUBLICADO Y DISTRIBUIDO (POTENCIALMENTE EN VIOLACIÓN DE SUS DERECHOS O DE ESTE ACUERDO) Y QUE ASUME DICHOS RIESGOS COMO PARTE MATERIAL DE ESTOS TÉRMINOS DE SERVICIO.
USTED ACEPTA NO PRESENTAR NINGUNA RECLAMACIÓN DE ARBITRAJE, DEMANDA O PROCEDIMIENTO INCONSISTENTE CON LAS LIMITACIONES DE RESPONSABILIDAD ANTERIORES.
Usted no puede transferir ni asignar estos Términos de servicio y los derechos y licencias otorgados en virtud del presente, pero podemos asignarlos nosotros sin restricciones.
Acuerdo de arbitraje y renuncia a ciertos derechos
Excepto por lo establecido anteriormente, usted y nosotros acordamos que resolveremos cualquier disputa entre nosotros (incluida cualquier disputa entre usted y un agente externo nuestro) a través de un arbitraje vinculante y final en lugar de procedimientos judiciales. Por la presente, usted y nosotros renunciamos a cualquier derecho a un juicio con jurado de cualquier Reclamo (definido a continuación). Todas las controversias, reclamos, reconvenciones u otras disputas que surjan entre usted y nosotros o entre usted y un agente externo nuestro (cada uno de ellos un " Reclamo ") se someterán a arbitraje vinculante de conformidad con las Reglas de la Asociación Estadounidense de Arbitraje (" Reglas AAA”). El arbitraje será oído y resuelto por un solo árbitro. La decisión del árbitro en dicho arbitraje será definitiva y vinculante para las partes y podrá hacerse cumplir en cualquier tribunal de jurisdicción competente. Usted y nosotros acordamos que los procedimientos de arbitraje se mantendrán confidenciales y que la existencia del procedimiento y cualquier elemento del mismo (incluidos, entre otros, los alegatos, resúmenes u otros documentos presentados o intercambiados y cualquier testimonio u otras presentaciones orales y laudos) no se divulgará más allá de los procedimientos de arbitraje, salvo que sea legalmente requerido en los procedimientos judiciales relacionados con el arbitraje, por las normas y reglamentos de divulgación aplicables de las autoridades reguladoras de valores u otras agencias gubernamentales, o según lo permita específicamente la ley estatal. La Ley Federal de Arbitraje y la ley federal de arbitraje se aplican a este acuerdo. Sin embargo, el Árbitro, y no cualquier tribunal o agencia federal, estatal o local, tendrá la autoridad exclusiva para resolver cualquier disputa relacionada con la interpretación, aplicabilidad, exigibilidad o formación de estos Términos de servicio, incluidos, entre otros, una reclamación de que la totalidad o parte de estos Términos de servicio son nulos o anulables.
Si demuestra que los costos del arbitraje serán prohibitivos en comparación con los costos del litigio, pagaremos la mayor parte de los costos administrativos y los honorarios del árbitro necesarios para el arbitraje que el árbitro considere necesarios para evitar que el costo del arbitraje sea prohibitivo. . En el laudo final, el árbitro podrá prorratear los costos del arbitraje y la compensación del árbitro entre las partes en los montos que el árbitro considere apropiados.
Este acuerdo de arbitraje no impide que ninguna de las partes busque la acción de las agencias gubernamentales federales, estatales o locales. Usted y nosotros también tenemos derecho a presentar reclamos calificados en la corte de reclamos menores. Además, usted y nosotros conservamos el derecho de solicitar a cualquier tribunal de jurisdicción competente una reparación provisional, incluidos los embargos previos al arbitraje o las medidas cautelares preliminares, y dicha solicitud no se considerará incompatible con estos Términos de servicio, ni una renuncia a la derecho a que las disputas se sometan a arbitraje según lo dispuesto en estos Términos de servicio.
Ni usted ni nosotros podemos actuar como representante de la clase o fiscal general privado, ni participar como miembro de una clase de demandantes, con respecto a cualquier Reclamación. Las reclamaciones no pueden someterse a arbitraje de forma colectiva o representativa. El árbitro puede decidir solo sus Reclamos individuales y/o nuestros. El árbitro no podrá consolidar o unir las reclamaciones de otras personas o partes que puedan estar en una situación similar. El árbitro puede otorgar en el arbitraje los mismos daños u otra reparación disponible según la ley aplicable, incluidas medidas cautelares y declaratorias, como si la acción se presentara ante un tribunal de manera individual. Sin perjuicio de cualquier disposición en contrario en lo anterior o en el presente, el árbitro no puede emitir una "orden judicial pública" y dicha "orden judicial pública" solo puede ser otorgada por un tribunal federal o estatal. Si cualquiera de las partes solicita un “orden judicial público”, todos los demás reclamos y solicitudes de reparación deben adjudicarse primero en arbitraje y cualquier solicitud o reclamo de “orden judicial público” en un tribunal federal o estatal se suspende hasta que se complete el arbitraje, después de lo cual el tribunal federal o un tribunal estatal puede adjudicar el reclamo u oración de la parte por una “medida cautelar pública”. Al hacerlo, el tribunal federal o estatal está obligado por los principios de preclusión de reclamación o asunto por la decisión del árbitro.
Si se determina que alguna disposición de esta Sección es inválida o inaplicable, entonces esa disposición específica no tendrá fuerza ni efecto y se eliminará, pero el resto de esta Sección continuará en pleno vigor y efecto. Ninguna renuncia a cualquier disposición de esta Sección de los Términos de Servicio será efectiva o exigible a menos que se registre en un escrito firmado por la parte que renuncia a tal derecho o requisito. Tal renuncia no anulará ni afectará ninguna otra parte de estos Términos de servicio. Esta Sección de los Términos sobrevivirá a la terminación de su relación con nosotros.
La presente Sección titulada “Arbitraje” sólo se aplicará a los Usuarios ubicados en los Estados Unidos de América.
ESTA SECCIÓN LIMITA CIERTOS DERECHOS, INCLUYENDO EL DERECHO A MANTENER UNA ACCIÓN JUDICIAL, EL DERECHO A UN JUICIO CON JURADO, EL DERECHO A PARTICIPAR EN CUALQUIER FORMA DE DEMANDA COLECTIVA O REPRESENTANTE, EL DERECHO A PARTICIPAR EN EL DESCUBRIMIENTO EXCEPTO SEGÚN LO DISPUESTO EN LAS REGLAS DE LA AAA, Y EL DERECHO A CIERTOS RECURSOS Y FORMAS DE ALIVIO. OTROS DERECHOS QUE USTED O NOSOTROS TENDREMOS EN EL TRIBUNAL TAMPOCO PUEDEN NO ESTAR DISPONIBLES EN EL ARBITRAJE.
Misceláneas
Estos Términos de servicio, su uso del sitio web y la relación entre usted y nosotros se regirán por las leyes de Chipre, sin tener en cuenta las normas sobre conflictos de leyes. Nada de lo contenido en estos Términos de servicio constituirá un acuerdo para la aplicación de las leyes de cualquier otra nación al sitio web. Usted acepta que el sitio web se considerará un sitio web pasivo que no da lugar a una jurisdicción personal sobre nosotros, ya sea específica o general.
Ninguna renuncia por nuestra parte a cualquier término o condición establecido en estos Términos de servicio se considerará una renuncia adicional o continua de dicho término o condición o una renuncia a cualquier otro término o condición, y cualquier incumplimiento por nuestra parte de hacer valer un derecho o disposición. Bajo estos Términos de Servicio no constituirá una renuncia a tal derecho o disposición.
Si alguna disposición de estos Términos de servicio se considera inválida por un tribunal de jurisdicción competente, la invalidez de dicha disposición no afectará la validez de las disposiciones restantes de estos Términos de servicio, que permanecerán en pleno vigor y efecto.
Los Términos de servicio, nuestra Política de privacidad , nuestra Política de derechos de autor y cualquier documento que incorporen expresamente por referencia constituyen el acuerdo único y completo entre usted y nosotros con respecto al sitio web.
Podemos rescindir estos Términos de servicio por cualquier motivo o sin él en cualquier momento notificándolo a través de un aviso en el sitio web, por correo electrónico o por cualquier otro método de comunicación. Cualquier rescisión será sin perjuicio de nuestros derechos, recursos, reclamaciones o defensas en virtud del presente. Al finalizar los Términos de servicio, ya no tendrá derecho a acceder a su cuenta o su Contenido. No tendremos ninguna obligación de ayudarlo a migrar sus datos o su Contenido y no podemos mantener ninguna copia de seguridad de su Contenido. No asumimos ninguna responsabilidad por la eliminación de su Contenido en virtud de estos Términos de servicio. Tenga en cuenta que, incluso si su Contenido se elimina de nuestros servidores activos, puede permanecer en nuestros archivos (pero no tenemos la obligación de archivar o hacer una copia de seguridad de su Contenido) y sujeto a las licencias establecidas en estos Términos de servicio.
'),0,'J');

////////////////////////FIRMAS////////////////////////////
$pdf->AddPage();
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('Declaro que he entendido el presente documento y como constancia de ello firmo de manera consiente y voluntaria.'),0,'');

$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('
Nombre: '.$nombre.'
'.$documento_tipo.': '.$documento_numero.'
Ciudad: Bogotá D.C'),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',16);
$pdf->MultiCell(0,5,utf8_decode('FIRMA'),0,'C');
$pdf->MultiCell(0,5,utf8_decode('-----------------------------------------------------------------------------'),0,'C');
$pdf->MultiCell(0,40,utf8_decode(''),0,'C');
$pdf->Image('../resources/contenidos/modelos/'.$id.'/'.$imagen,55,55,100,40);
$pdf->MultiCell(0,5,utf8_decode('-----------------------------------------------------------------------------'),0,'C');

$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('
Nombre: Andres Fernando Bernal Correa
Cédula de Ciudadanía : 80.774.671 
Ciudad: Bogotá D.C'),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',16);
$pdf->MultiCell(0,5,utf8_decode('FIRMA'),0,'C');
$pdf->MultiCell(0,5,utf8_decode('-----------------------------------------------------------------------------'),0,'C');
$pdf->MultiCell(0,40,utf8_decode(''),0,'C');

$pdf->Image('../img/firma_jefe.jpeg',55,140,100,40);

$pdf->MultiCell(0,5,utf8_decode('-----------------------------------------------------------------------------'),0,'C');

$pdf->Ln(20);
$pdf->SetFont('Times','B',10);
$pdf->Cell(120,5,utf8_decode('Sede Bogotá Norte Calle 80 # 85-52, Barrio La Española, Bogotá D.C '),0,1,'');
$pdf->Cell(120,5,utf8_decode('Sede Bogotá Tunal  calle 56 a #33-35 sur, Barrio tunal, Bogotá D.C  '),0,1,'');
$pdf->Cell(120,5,utf8_decode('Sede Bogotá Vip Carrera 68h # 23-21 sur Barrio Carvajal '),0,1,'');
$pdf->Cell(120,5,utf8_decode('Sede Bogotá Suba Calle 139 #102-21 Barrio Costa Azul '),0,1,'');
$pdf->Cell(120,5,utf8_decode('Sede Soacha C.A.V Carrera 4 # 26B-66 '),0,1,'');

$pdf->Output();
?>