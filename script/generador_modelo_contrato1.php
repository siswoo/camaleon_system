<?php
session_start();
include('conexion.php');
require('../resources/fpdf/fpdf.php');

$id_sede = $_SESSION['sede'];
$sql1 = "SELECT * FROM sedes WHERE id = ".$id_sede;
$consulta1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($consulta1)) {
	$sede_nombre = $row1['nombre'];
	$sede_direccion = $row1['direccion'];
	$sede_ciudad = $row1['ciudad'];
	$sede_responsable = $row1['responsable'];
	$sede_cedula = $row1['cedula'];
	$sede_rut = $row1['rut'];
}

$name_usuario = $_SESSION['usuario'];
$sql2 = "SELECT * FROM usuarios WHERE usuario = '".$name_usuario."'";
$consulta2 = mysqli_query($conexion,$sql2);
while($row2 = mysqli_fetch_array($consulta2)) {
	$usuario_nombre = $row2['nombre'];
	$usuario_apellido = $row2['apellido'];
	$usuario_documento_tipo = $row2['documento_tipo'];
	$usuario_documento_numero = $row2['documento_numero'];
}

$sql3 = "SELECT * FROM modelos WHERE usuario = '".$name_usuario."'";
$consulta3 = mysqli_query($conexion,$sql3);
while($row3 = mysqli_fetch_array($consulta3)) {
	$id_modelo = $row3['id'];
}

$sql4 = "SELECT * FROM modelos_documentos WHERE id_documentos = 1 and id_modelos = ".$id_modelo;
$consulta4 = mysqli_query($conexion,$sql4);
$contador1 = mysqli_num_rows($consulta4);

class PDF extends FPDF{
	// Page header
	function Header(){
	    $this->Image('../img/slider_welcome/slider3.jpg',55,15,100,40);
	    /*$this->SetFont('Arial','B',15);
	    $this->Cell(80);
	    $this->Cell(30,10,'Title',1,0,'C');*/
	    // Line break
	    $this->Ln(20);
	}

	// Page footer
	function Footer(){
	    $this->SetY(-15);
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,10,utf8_decode('Página').$this->PageNo().'/{nb}',0,0,'C');
	}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Ln(30);
$pdf->SetFont('Times','B',12);
$pdf->Cell(190,10,utf8_decode('CONTRATO DE PRESTACIÓN DE SERVICIOS'),0,0,'C');

$pdf->Ln(10);
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('ANDRES FERNANDO BERNAL CORREA, mayor de edad, identificado con cédula de ciudadanía No. 80.774.671 de Bogotá, actuando en nombre y representación de BERNAL GROUP SAS NIT. 901.257.204-8; quien en adelante se denominará EL CONTRATANTE, y '.$usuario_nombre.' '.$usuario_apellido.', mayor de edad identificado con '.$usuario_documento_tipo.' No. '.$usuario_documento_numero.', domiciliado en la ciudad de '.$sede_ciudad.', y quien para los efectos del presente documento se denominará EL CONTRATISTA, acuerdan celebrar el presente CONTRATO DE PRESTACIÓN DE SERVICIOS, el cual se regirá por las siguientes cláusulas: '),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('PRIMERA.- OBJETO:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('El CONTRATISTA en su calidad de trabajador independiente, se obliga para con El CONTRATANTE a ejecutar los trabajos y demás actividades propias del servicio contratado, el cual debe realizar de conformidad con las condiciones y cláusulas del presente documento y que consistirá en:'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('- Efectuar transmisión en paginas webcam, en los horarios los cuales considere la contratista, previamente concertados con BERNAL GROUP SAS.'),0,'');
$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('SEGUNDA.- DURACIÓN O PLAZO:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('El plazo para la ejecución del presente contrato será indefinido, contados a partir de la firma del presente contrato'),0,'');
$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('TERCERA.- PRECIO:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('El valor del contrato será por la suma de acuerdo a la producción de la prestación del servicio, varia según el rendimiento quincenal, sin constituir un sueldo fijo.'),0,'');
$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('CUARTA.- FORMA DE PAGO:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('El valor del contrato será cancelado en pagos quincenales correspondientes a los equivalentes y deducciones de ley correspondientes, a su vez descuentos previamente concertados y generados por la contratista, en las fechas estipuladas 8 y 23 de cada mes, en las fecha que sea fin de semana se correrá automáticamente el siguiente día hábil así:'),0,'');

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
$pdf->Cell(0,5,utf8_decode('De igual forma, se aplicará la retención en la fuente como estipula el estatuto tributario'),0,0,'');
$pdf->Cell(0,25,(''),0,1,'');
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
$pdf->MultiCell(0,5,utf8_decode('4-) Quien logre un rendimiento superior a 100.000 Tokens, Obtiene un bono de 500.000 pesos'),0,'');


$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('BENEFICIO DE RENDIMIENTO POR CORTE MENSUAL:'),0,'');
$pdf->Ln(5);
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('1-) La Contratista que logre la mayor cantidad de horas de conexión en Chaturbate, obtiene:'),0,'');
$pdf->MultiCell(0,5,utf8_decode('* KIT DE LENCERIA O KIT DEPORTIVO'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('2-) La Contratista que logre la mayor cantidad de tokens, obtiene:'),0,'');
$pdf->MultiCell(0,5,utf8_decode('* UN DÍA DE SPA'),0,'');

$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('BENEFICIO RENDIMIENTO POR CORTE SEMESTRAL:'),0,'');
$pdf->Ln(5);
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('1-) La modelo que, durante el semestre, gracias a su dedicación y esfuerzo logre la mayor cantidad de producción de Tokens, Gana 01 VIAJE SORPRESA.'),0,'');


$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('SEXTA.- OBLIGACIONES:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('El CONTRATANTE deberá facilitar acceso a la información y elementos que sean necesarios, de manera oportuna, para la debida ejecución del objeto del contrato, y, estará obligado a cumplir con lo estipulado en las demás cláusulas y condiciones previstas en este documento. El CONTRATISTA deberá cumplir en forma eficiente y oportuna los trabajos encomendados y aquellas obligaciones que se generen de acuerdo con la naturaleza del servicio, además se compromete a afiliarse a una empresa promotora de salud EPS, y cotizar igualmente al sistema de seguridad social en pensiones tal como lo indica el art.15 de le ley 100 de 1993, para lo cual se dará un termino de 30 días contados a partir de la fecha de iniciación del contrato. De no hacerlo en el termino fijado el contrato se dará por terminado.'),0,'');


$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('SEPTIMA.- SUPERVICION:'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('El CONTRATANTE o su representante supervisará la ejecución del servicio encomendado, y podrá formular las observaciones del caso, para ser analizadas conjuntamente con El CONTRATISTA, Estipulando indemnizaciones por ausencia representadas en:'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('Día de no Producción: 30.000 Pesos'),0,'');


$pdf->Cell(0,20,(''),0,1,'');
$pdf->Ln(10);
$pdf->Ln(5);
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
$pdf->MultiCell(0,5,utf8_decode('El CONTRATISTA no podrá ceder parcial ni totalmente la ejecución del presente contrato a un tercero, sin la previa, expresa y escrita autorización del CONTRATANTE. '),0,'');

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
$pdf->MultiCell(0,5,utf8_decode('El Trabajador representa y garantiza que su relación con la Empresa no causará o requerirá que ello viole cualquier obligación a, el acuerdo, o la confianza relacionada con confidencialidad, el secreto de fabricación y la información propietaria con cualquier otra persona, empresa o entidad. Más aun, el Trabajador reconoce que una condición de esta relación consiste en que no ha traído y no traerá o usará en el desempeño de sus deberes en la Empresa cualquier información propietaria o confidencial de un antiguo Empleador o Contratante sin la autorización escrita de aquel Empleador o Contratante. La violación de esta condición causa la terminación automática de la relación laboral desde el tiempo de violación. Si el Trabajador considera que tiene investigaciones o invenciones anteriores a la firma de este Acuerdo de Confidencialidad que serán excluidas de este acuerdo, se deberán anotar en la parte trasera de este documento o en uno aparte firmado por las partes. Con esto. El Trabajador libera a la Empresa de cualquier reclamación por parte del Trabajador por cualquier empleo por la Empresa de cualquier invención antes hecha o concebida por El Trabajador. '),0,'');


$pdf->Cell(0,20,(''),0,1,'');
$pdf->Ln(10);
$pdf->Ln(5);
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
$pdf->Cell(0,20,(''),0,1,'');
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
$pdf->MultiCell(0,5,utf8_decode('El Trabajador está de acuerdo con no contratar con terceros en cualquier actividad que compita con cualquier actividad de Empresa durante el curso de su relación Laboral Para los objetivos de este párrafo, la actividad competitiva abarca la formación o la planificación de formar una entidad de negocio que, como se puede considerar, sea competitiva con cualquier negocio de la Empresa. Esto no impide al Trabajador buscar u obtener el empleo u otras formas de relaciones de negocio con un competidor después de la terminación de empleo con la Empresa mientras que tal competidor existiese antes de la terminación de la relación con la Empresa y el Trabajador de ninguna manera estuvo implicado con la organización o la formación de tal competidor'),0,'');


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

$pdf->Cell(0,20,(''),0,1,'');
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

$pdf->Cell(0,25,(''),0,1,'');
$pdf->Cell(0,30,(''),0,1,'');
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
$pdf->SetFont('Times','B',10);
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
$pdf->MultiCell(0,5,utf8_decode('Entre los suscritos a saber, de una parte, que BERNAL GROUP, identificado bajo el NIT 901257204 representando legalmente por Andres Fernando Bernal Correa persona mayor de edad, identificado con la cédula de ciudadanía No. 80.774.671, empresa con domicilio en la ciudad de Bogota D.C. Calle 80 # 85-52, para los efectos de este contrato se denominará EL PRODUCTOR, y de otra '.$usuario_nombre.' '.$usuario_apellido.' mayor de edad, identificado (a) con la '.$usuario_documento_tipo.' N° '.$usuario_documento_numero.' domiciliada en la ciudad de '.$sede_ciudad.' y quien para los efectos del presente documento se denominará EL o la modelo, acuerdan celebrar el siguiente contrato de cesión de imagen respecto la actividad que la contratista va a realizar como modelo WEBCAM en virtud del contrato de mandato celebrado entre las partes, el cual se regirá por las siguientes:'),0,'');

$pdf->SetFont('Times','B',10);
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('CLÁUSULAS:'),0,'');

$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('PRIMERA: OBJETO'),0,'');
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('De conformidad al contrato de mandato celebrado entre las partes la modelo realizará en el espacio comercial proporcionado por el productor transmisiones Actuaciones en streaming a través de portales web, modelaje para fotografía destinada a la promoción de su imagen personal, Actuación en cortometrajes cualquiera sea su temática, tipo o formato. Actuaciones con fines publicitarios y de mercadeo. Y, en general, cualquier actividad relacionada con actividades artísticas y/o con el talento de LA MODELO'),0,'');

$pdf->Cell(0,20,(''),0,1,'');
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
$pdf->Cell(0,20,(''),0,1,'');
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
$pdf->MultiCell(0,5,utf8_decode('Para todos los efectos legales, el domicilio contractual será la ciudad de y las notificaciones serán recibidas por las partes en las siguientes direcciones: Bogota D.C. Calle 80 # 85-52.'),0,'');


$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('CONSENTIMIENTO INFORMADO PARA TRANSMISIONES DE MODELOS WEBCAM'),0,'C');
$pdf->SetFont('Times','B',6);
$pdf->MultiCell(0,5,utf8_decode('(Autorización y Manifestación de voluntad actualizado Sentencia T -407 A/2018 de septiembre de 2018)'),0,'C');

$pdf->Ln(5);
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,5,utf8_decode('Yo, '.$usuario_nombre.' '.$usuario_apellido.', persona mayor de edad, identificado(a) con '.$usuario_documento_tipo.' No. '.$usuario_documento_numero.', actuando de manera libre, consiente, haciendo uso de mi buen estado emocional, físico y psicológico. una vez informado(a), sobre las actividades con fines comerciales y sus respectivas consecuencias, que realizará '.$sede_responsable.', para posicionarme y comercializar mis actividades como modelo webcam por medio de la industria del video chat, otorgo en forma libre y autónoma mediante la firma del presente documento, mi consentimiento y autorización a: BERNAL GROUP. Para la realización de las siguientes actividades:'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('- La toma, transmisión, reproducción, comercialización y difusión a través de internet, medios digitales y videochat de fotografías, videos y audios con contenido explícito sexual para ser transmitidos en diferido o en vivo y en dichos medios y redes sociales destinadas para tal fin, que la firma BERNAL GROUP. Considere para lograr una buena comercialización de mis actividades como modelo webcam, las cuales en muchos casos tendrán acceso gratuito, en vivo y en directo por parte de usuarios de los 5 continentes.'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('De la misma manera, declaro que he sido informada sobre los riesgos que las anteriores actividades en los siguientes ámbitos:'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('- A mi intimidad e imagen en el ámbito laboral, familiar y social, tales como burlas, rechazos e estigmatización, por tratarse de imágenes, audios y videos de carácter sexual, que son ampliamente cuestionados.'),0,'');
$pdf->Cell(0,20,(''),0,1,'');
$pdf->Ln(10);
$pdf->MultiCell(0,5,utf8_decode('- La piratería de contenidos digitales y los riesgos de que las imágenes grabadas o fotografiadas sean reproducidas en medios que no han sido autorizados para estos fines puesto que reconozco que el nivel de seguridad de dichas páginas es bajo, dado que algunos usuarios pueden grabar las transmisiones, así como guardar las fotos y videos sin mi autorización.'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('Manifiesto que el presente consentimiento lo otorgo sin presiones o apremios de ninguna índole y de ninguna persona y que exonero a BERNAL GROUP. De cualquier perjuicio derivado de los riesgos puestos en conocimiento.'),0,'');
$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('Que dicha autorización se confiere de manera permanente y tendrá vigencia permanente mientras persista el vínculo contractual que tengo con BERNAL GROUP.'),0,'');
$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(0,5,utf8_decode('Declaro que he entendido el presente documento y como constancia de ello firmo de manera consiente y voluntaria.'),0,'');

$pdf->Ln(5);
$pdf->MultiCell(0,5,utf8_decode('
Nombre: '.$usuario_nombre.' '.$usuario_apellido.'
'.$usuario_documento_tipo.': '.$usuario_documento_numero.'
Ciudad: '.$sede_ciudad),0,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',16);
$pdf->MultiCell(0,5,utf8_decode('FIRMA'),0,'C');
$pdf->MultiCell(0,5,utf8_decode('-----------------------------------------------------------------------------'),0,'C');
$pdf->MultiCell(0,40,utf8_decode(''),0,'C');

if($contador1 >= 1){
	$pdf->Image('../resources/documentos/modelos/archivos/'.$id_modelo.'/firma_digital.jpg',55,155,100,40);
}
//$pdf->Image('img/slider_welcome/slider3.jpg',55,15,100,40);
//$pdf->Image('resources/documentos/modelos/test/signature.png',70,155,70,40,'PNG');
$pdf->MultiCell(0,5,utf8_decode('-----------------------------------------------------------------------------'),0,'C');


$pdf->Ln(20);
$pdf->SetFont('Times','B',10);
$pdf->Cell(30,5,(utf8_decode('Sede Bogotá Norte')),0,0,'');
$pdf->SetFont('Times','',10);
$pdf->Cell(120,5,utf8_decode('Calle 80 # 85-52, Barrio La Española, Bogotá D.C (031-7612345).'),0,1,'');

$pdf->SetFont('Times','B',10);
$pdf->Cell(35,5,(utf8_decode('Sede Bogotá Occidente ')),0,0,'');
$pdf->SetFont('Times','',10);
$pdf->Cell(120,5,utf8_decode('Carrera 73 # 00-01, Barrio América Occidental, Bogotá D.C. (031-7238790).'),0,1,'');

$pdf->SetFont('Times','B',10);
$pdf->Cell(26,5,(utf8_decode('Sede Bogotá Sur')),0,0,'');
$pdf->SetFont('Times','',10);
$pdf->Cell(120,5,utf8_decode('Carrera 68h # 23-21 sur Barrio Carvajal (031-7223606).'),0,1,'');

$pdf->SetFont('Times','B',10);
$pdf->Cell(38,5,(utf8_decode('Sede Medellín Occidente')),0,0,'');
$pdf->SetFont('Times','',10);
$pdf->Cell(120,5,utf8_decode('AV 80 # 30A-67, Barrio Belén (300-7821777).'),0,1,'');

$pdf->SetFont('Times','B',10);
$pdf->Cell(45,5,(utf8_decode('Sede Medellín Suramericana')),0,0,'');
$pdf->SetFont('Times','',10);
$pdf->Cell(120,5,utf8_decode('Calle 48 # 66-70, Barrio Suramericana (300-7821777).'),0,1,'');

$pdf->SetFont('Times','B',10);
$pdf->Cell(15,5,(utf8_decode('Sede Cali')),0,0,'');
$pdf->SetFont('Times','',10);
$pdf->Cell(120,5,utf8_decode('Calle 32 # 82-33, Barrio Granada (300-7821777).'),0,1,'');

$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->Cell(180,5,utf8_decode('WHATSSAP +57 317 4922224 (INSTAGRAM CAMALEONABC - FACEBOOK CAMALEONABC'),0,1,'C');
$pdf->Cell(180,5,utf8_decode('WWW.WEBCAMALEONABC.COM - CONTACTOMODELOS@WEBCAMALEONABC.COM'),0,1,'C');

$pdf->Output();
?>