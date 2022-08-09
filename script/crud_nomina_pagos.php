<?php
session_start();
include('conexion.php');
require '../resources/Spreadsheet/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
$condicion = $_POST['condicion'];
$fecha_inicio = date('Y-m-d');
$responsable = $_SESSION['id'];

if($condicion=='table1'){
	$pagina = $_POST["pagina"];
	$consultasporpagina = $_POST["consultasporpagina"];
	$filtrado = $_POST["filtrado"];
	$sede = $_POST["sede"];
	$link1 = $_POST["link1"];
	$link1 = explode("/",$link1);
	$link1 = $link1[3];

	$html = '';

	$html .= '
		<div class="col-12">
	        <table class="table table-bordered">
	            <thead>
					<tr>
						<td class="text-center">#</td>
						<td class="text-center">Tipo Doc</td>
						<td class="text-center">Num Doc</td>
						<td class="text-center">Nombre</td>
						<td class="text-center">Sede</td>
						<td class="text-center">Cargo</td>
						<td class="text-center">Sueldo</td>
						<td class="text-center">Laborados</td>
						<td class="text-center">No Laborados</td>
						<td class="text-center">SubTotal</td>
						<td class="text-center">Dobla Turno</td>
						<td class="text-center">Prestamos</td>
						<td class="text-center">Bono</td>
						<td class="text-center">Devolución S.S</td>
						<td class="text-center">Ajuste Nomina</td>
						<td class="text-center">Otros Conceptos</td>
						<td class="text-center">Total devengado</td>
						<td class="text-center">Descuentos</td>
						<td class="text-center">Total deducciones</td>
						<td class="text-center">Total a Pagar</td>
					</tr>
				</thead>
	            <tbody>
	';

	if($pagina==0 or $pagina==''){
		$pagina = 1;
	}

	if($consultasporpagina==0 or $consultasporpagina==''){
		$consultasporpagina = 10;
	}

	if($filtrado!=''){
		$filtrado = ' and (nom.nombre LIKE "%'.$filtrado.'%" or nom.apellido LIKE "%'.$filtrado.'%" or nom.documento_numero LIKE "%'.$filtrado.'%")';
	}

	if($sede==''){
		$html .= '<tr><td colspan="20" class="text-center" style="font-weight:bold;font-size:20px;">Debe elegir una Sede</td></tr>';
		$datos = [
			"estatus"	=> "ok",
			"html"	=> $html,
		];
		echo json_encode($datos);
		exit;
	}

	$limit = $consultasporpagina;
	$offset = ($pagina - 1) * $consultasporpagina;

	$sql1 = "SELECT nom.id as nomina_id, nom.documento_tipo as documento_tipo, nom.documento_numero as documento_numero, nom.nombre as nombre, nom.apellido as apellido, nom.cargo as cargo, nom.sede as sede, nom.estatus as estatus, nom.salario as salario, car.nombre as cargo_nombre, sed.nombre as sede_nombre FROM nomina nom 
	INNER JOIN cargos car 
	ON nom.cargo = car.id 
	INNER JOIN sedes sed 
	ON nom.sede = sed.id 
	WHERE nom.sede = ".$sede.$filtrado." and nom.estatus = 'Aceptado'";


	$sql2 = "SELECT nom.id as nomina_id, nom.documento_tipo as documento_tipo, nom.documento_numero as documento_numero, nom.nombre as nombre, nom.apellido as apellido, nom.cargo as cargo, nom.sede as sede, nom.estatus as estatus, nom.salario as salario, car.nombre as cargo_nombre, sed.nombre as sede_nombre FROM nomina nom 
	INNER JOIN cargos car 
	ON nom.cargo = car.id 
	INNER JOIN sedes sed 
	ON nom.sede = sed.id 
	WHERE nom.sede = ".$sede.$filtrado." and nom.estatus = 'Aceptado' 
	ORDER BY nom.nombre ASC LIMIT ".$limit." OFFSET ".$offset."";

	$proceso1 = mysqli_query($conexion,$sql1);
	$proceso2 = mysqli_query($conexion,$sql2);
	$conteo1 = mysqli_num_rows($proceso1);
	$paginas = ceil($conteo1 / $consultasporpagina);

	if($conteo1>=1){
		$indice1 = 1;
		while($row2 = mysqli_fetch_array($proceso2)) {
			$nomina_id = $row2["nomina_id"];
			$documento_tipo = $row2["documento_tipo"];
			$documento_numero = $row2["documento_numero"];
			$nombre_completo = $row2["nombre"]." ".$row2["apellido"];
			$cargo_nombre = $row2["cargo_nombre"];
			$salario = $row2["salario"];
			$quincena = $row2["salario"]/2;
			$sede_nombre = $row2["sede_nombre"];
			$diario = $salario/30;

			$laborados_texto = 15;
			$nolaborados_con = 0;
			$dobleturnos_con = 0;
			$sub_total = $quincena;

			$prestamos_texto = '';
			$bono_texto = '';
			$devolucion_texto = '';
			$ajustenomina_texto = '';
			$otrosconceptos_texto = '';
			$descuentos_texto = '';

			$prestamos_valor = 0;
			$bono_valor = 0;
			$devolucion_valor = 0;
			$ajustenomina_valor = 0;
			$otrosconceptos_valor = 0;
			$dobleturnos_valor = 0;

			$totaldevengado = $quincena;
			$totaldeducciones = 0;
			$descuentos_con = 0;
			$totalpagar = 0;

			$sql3 = "SELECT * FROM temporal_nomina_pagos WHERE id_nomina = ".$nomina_id;
			$proceso3 = mysqli_query($conexion,$sql3);
			$contador3 = mysqli_num_rows($proceso3);
			if($contador3>=1){
				while($row3=mysqli_fetch_array($proceso3)){
					$concepto = $row3["concepto"];
					if($concepto=='nolaborados'){
						$sql4 = "SELECT * FROM temporal_nomina_pagos WHERE id_nomina = ".$nomina_id." and concepto = 'nolaborados'";
						$proceso4 = mysqli_query($conexion,$sql4);
						$contador4 = mysqli_num_rows($proceso4);
						$nolaborados_con = $contador4;
					}else if($concepto=='dobleturnos'){
						$sql5 = "SELECT * FROM temporal_nomina_pagos WHERE id_nomina = ".$nomina_id." and concepto = 'dobleturnos'";
						$proceso5 = mysqli_query($conexion,$sql5);
						$contador5 = mysqli_num_rows($proceso5);
						$dobleturnos_con = $contador5;
						$sql6 = "SELECT SUM(valor) as total FROM temporal_nomina_pagos WHERE id_nomina = ".$nomina_id." and concepto = 'dobleturnos'";
						$proceso6 = mysqli_query($conexion,$sql6);
						while($row6=mysqli_fetch_array($proceso6)){
							$dobleturnos_valor = $row6["total"];
						}
					}else if($concepto=='prestamos'){
						$prestamos_texto = $row3["valor"];
						$prestamos_valor = $row3["valor"];
					}else if($concepto=='bono'){
						$sql5 = "SELECT * FROM temporal_nomina_pagos WHERE id_nomina = ".$nomina_id." and concepto = 'bono'";
						$proceso5 = mysqli_query($conexion,$sql5);
						$bono_texto = $row3["valor"];
						$bono_valor = $row3["valor"];
					}else if($concepto=='devolucion'){
						$sql5 = "SELECT * FROM temporal_nomina_pagos WHERE id_nomina = ".$nomina_id." and concepto = 'devolucion'";
						$proceso5 = mysqli_query($conexion,$sql5);
						$devolucion_texto = $row3["valor"];
						$devolucion_valor = $row3["valor"];
					}else if($concepto=='ajustenomina'){
						$sql5 = "SELECT * FROM temporal_nomina_pagos WHERE id_nomina = ".$nomina_id." and concepto = 'ajustenomina'";
						$proceso5 = mysqli_query($conexion,$sql5);
						$ajustenomina_texto = $row3["valor"];
						$ajustenomina_valor = $row3["valor"];
					}else if($concepto=='otrosconceptos'){
						$sql5 = "SELECT * FROM temporal_nomina_pagos WHERE id_nomina = ".$nomina_id." and concepto = 'otrosconceptos'";
						$proceso5 = mysqli_query($conexion,$sql5);
						$otrosconceptos_texto = $row3["valor"];
						$otrosconceptos_valor = $row3["valor"];
					}else if($concepto=='descuentos'){
						$descuentos_con = $descuentos_con+1;
						$sql5 = "SELECT SUM(valor) as total FROM temporal_nomina_pagos WHERE id_nomina = ".$nomina_id." and concepto = 'descuentos'";
						$proceso5 = mysqli_query($conexion,$sql5);
						while($row5=mysqli_fetch_array($proceso5)){
							$totaldeducciones = $row5["total"];
						}
					}
				}

				$nolaborados_subtotal = $diario*$nolaborados_con;
				$laborados_texto = 15-$nolaborados_con;
				$sub_total = $quincena-$nolaborados_subtotal;
				$totaldevengado = ($prestamos_valor+$bono_valor+$devolucion_valor+$ajustenomina_valor+$otrosconceptos_valor+$dobleturnos_valor)+$sub_total;
			}

			$totalpagar = $totaldevengado-$totaldeducciones;

			$html.= '
				<tr id="tr_'.$nomina_id.'">
					<td>'.$indice1.'</td>
					<td>'.$documento_tipo.'</td>
					<td>'.$documento_numero.'</td>
					<td>'.$nombre_completo.'</td>
					<td>'.$sede_nombre.'</td>
					<td>'.$cargo_nombre.'</td>
					<td>'."$".number_format($row2["salario"],0,'','.').'</td>
					<td class="text-center"><span style="font-size:18px;">'.$laborados_texto.'</span></td>
					<td class="text-center"><button type="button" id="nolaborados_'.$nomina_id.'" name="nolaborados_'.$nomina_id.'" onclick="nolaborados1('.$nomina_id.');" data-toggle="modal" data-target="#modal_nolaborados1" class="btn btn-info">'.$nolaborados_con.'</button></td>
					<td>'."$".number_format($sub_total,0,'','.').'</td>
					<td><button type="button" id="dobleturnos_'.$nomina_id.'" name="dobleturnos_'.$nomina_id.'" onclick="dobleturnos1('.$nomina_id.');" data-toggle="modal" data-target="#modal_dobleturnos1" class="btn btn-info">'.$dobleturnos_con.'</button></td>
					<td><input type="text" class="form-control" style="width:150px;" onkeyup="auto_guardado('.$nomina_id.',1,0,value);" name="prestamos_'.$nomina_id.'" id="prestamos_'.$nomina_id.'" value="'.$prestamos_texto.'"></td>
					<td><input type="text" class="form-control" style="width:150px;" onkeyup="auto_guardado('.$nomina_id.',2,0,value);" name="bono_'.$nomina_id.'" id="bono_'.$nomina_id.'" value="'.$bono_texto.'"></td>
					<td><input type="text" class="form-control" style="width:150px;" onkeyup="auto_guardado('.$nomina_id.',3,0,value);" name="devolucion_'.$nomina_id.'" id="devolucion_'.$nomina_id.'" value="'.$devolucion_texto.'"></td>
					<td><input type="text" class="form-control" style="width:150px;" onkeyup="auto_guardado('.$nomina_id.',4,0,value);" name="ajustenomina_'.$nomina_id.'" id="ajustenomina_'.$nomina_id.'" value="'.$ajustenomina_texto.'"></td>
					<td><input type="text" class="form-control" style="width:150px;" onkeyup="auto_guardado('.$nomina_id.',5,0,value);" name="otrosconceptos_'.$nomina_id.'" id="otrosconceptos_'.$nomina_id.'" value="'.$otrosconceptos_texto.'"></td>
					<td>'."$".number_format($totaldevengado,0,'','.').'</td>
					<td class="text-center"><button type="button" id="descuentos1_'.$nomina_id.'" name="descuentos1_'.$nomina_id.'" onclick="descuentos1('.$nomina_id.');" data-toggle="modal" data-target="#modal_descuentos1" class="btn btn-info">'.$descuentos_con.'</button></td>
					<td class="text-center">'."$".number_format($totaldeducciones,0,'','.').'</td>
					<td class="text-center" style="font-size: 18px; font-weight: bold;">'."$".number_format($totalpagar,0,'','.').'</td>
				</tr>
			';
			$indice1 = $indice1+1;
		}
	}else{
		$html .= '<tr><td colspan="21" class="text-center" style="font-weight:bold;font-size:20px;">Sin Resultados</td></tr>';
	}

	$html .= '
	            </tbody>
	        </table>
	        <nav>
	            <div class="row">
	                <div class="col-xs-12 col-sm-4 text-center">
	                    <p>Mostrando '.$consultasporpagina.' de '.$conteo1.' Datos disponibles</p>
	                </div>
	                <div class="col-xs-12 col-sm-4 text-center">
	                    <p>Página '.$pagina.' de '.$paginas.' </p>
	                </div> 
	                <div class="col-xs-12 col-sm-4">
			            <nav aria-label="Page navigation" style="float:right; padding-right:2rem;">
							<ul class="pagination">
	';
	
	if ($pagina > 1) {
		$html .= '
								<li class="page-item">
									<a class="page-link" onclick="paginacion1('.($pagina-1).');" href="#">
										<span aria-hidden="true">Anterior</span>
									</a>
								</li>
		';
	}

	$diferenciapagina = 3;
	
	/*********MENOS********/
	if($pagina==2){
		$html .= '
		                		<li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina-1).');" href="#">
			                            '.($pagina-1).'
			                        </a>
			                    </li>
		';
	}else if($pagina==3){
		$html .= '
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina-2).');" href="#"">
			                            '.($pagina-2).'
			                        </a>
			                    </li>
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina-1).');" href="#"">
			                            '.($pagina-1).'
			                        </a>
			                    </li>
	';
	}else if($pagina>=4){
		$html .= '
		                		<li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina-3).');" href="#"">
			                            '.($pagina-3).'
			                        </a>
			                    </li>
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina-2).');" href="#"">
			                            '.($pagina-2).'
			                        </a>
			                    </li>
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina-1).');" href="#"">
			                            '.($pagina-1).'
			                        </a>
			                    </li>
		';
	} 

	/*********MAS********/
	$opcionmas = $pagina+3;
	if($paginas==0){
		$opcionmas = $paginas;
	}else if($paginas>=1 and $paginas<=4){
		$opcionmas = $paginas;
	}
	
	for ($x=$pagina;$x<=$opcionmas;$x++) {
		$html .= '
			                    <li class="page-item 
		';

		if ($x == $pagina){ 
			$html .= '"active"';
		}

		$html .= '">';

		$html .= '
			                        <a class="page-link" onclick="paginacion1('.($x).');" href="#"">'.$x.'</a>
			                    </li>
		';
	}

	if ($pagina < $paginas) {
		$html .= '
			                    <li class="page-item">
			                        <a class="page-link" onclick="paginacion1('.($pagina+1).');" href="#"">
			                            <span aria-hidden="true">Siguiente</span>
			                        </a>
			                    </li>
		';
	}

	$html .= '

						</ul>
					</nav>
				</div>
	        </nav>
	    </div>
	';

	$datos = [
		"estatus"	=> "ok",
		"html"	=> $html,
		"sql2"	=> $sql2,
	];
	echo json_encode($datos);
}

if($condicion=='auto_guardado1'){
	$id_nomina = $_POST["id_nomina"];
	$concepto = $_POST["concepto"];
	$texto = $_POST["texto"];
	$valor = $_POST["valor"];

	$sql1 = "DELETE FROM temporal_nomina_pagos WHERE id_nomina = ".$id_nomina." and concepto = '".$concepto."'";
	$proceso1 = mysqli_query($conexion,$sql1);

	$sql2 = "INSERT INTO temporal_nomina_pagos (id_nomina,concepto,texto,valor,fecha,responsable,fecha_inicio) VALUES ($id_nomina,'$concepto','$texto',$valor,'$fecha_inicio',$responsable,'$fecha_inicio')";
	$proceso2 = mysqli_query($conexion,$sql2);

	$datos = [
		"estatus" => 'ok',
		"sql1" => $sql1,
		"sql2" => $sql2,
	];
	echo json_encode($datos);
}

if($condicion=='nolaborados1'){
	$nomina_id = $_POST["nomina_id"];
	$html1 = '';
	$sql1="SELECT * FROM temporal_nomina_pagos WHERE id_nomina = ".$nomina_id." and concepto = 'nolaborados'";
	$proceso1=mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);
	while($row1=mysqli_fetch_array($proceso1)){
		$id = $row1["id"];
		$texto = $row1["texto"];
		$fecha = $row1["fecha"];
		$html1.= '
			<div class="col-12 mt-3" id="modal_nolaborados1_generado_'.$id.'">
				<div class="row">
					<div class="col-4 text-center">
						'.$texto.'
					</div>
					<div class="col-4 text-center">
						'.$fecha.'
					</div>
					<div class="col-4 text-center">
						<button type="button" class="btn btn-danger" onclick="eliminar_nolaborados1('.$id.')">Eliminar</button>
					</div>
				</div>
			</div>
		';
	}

	$html1 .= '
		<div class="col-12 text-center">
			<hr style="width:100%;color:black;">
		</div>
		<div class="col-6 form-group form-check">
				<label for="modal_nolaborados1_texto">Concepto</label>
				<input type="text" name="modal_nolaborados1_texto" id="modal_nolaborados1_texto" class="form-control" required>
			</div>
			<div class="col-6 form-group form-check">
				<label for="modal_nolaborados1_fecha">Fecha</label>
				<input type="date" name="modal_nolaborados1_fecha" id="modal_nolaborados1_fecha" class="form-control" required>
			</div>
		</div>
	';
	
	$datos = [
		"estatus" => 'ok',
		"sql1" => $sql1,
		"contador1" => $contador1,
		"html1" => $html1,
	];
	echo json_encode($datos);
}

if($condicion=='nolaborados2'){
	$nomina_id = $_POST["nomina_id"];
	$texto = $_POST["texto"];
	$fecha = $_POST["fecha"];
	$concepto = "nolaborados";
	$sql1="INSERT INTO temporal_nomina_pagos (id_nomina,concepto,texto,fecha,responsable,fecha_inicio) VALUES ($nomina_id,'$concepto','$texto','$fecha',$responsable,'$fecha_inicio')";
	$proceso1=mysqli_query($conexion,$sql1);
	$datos = [
		"estatus" => 'ok',
		"msg" => "Registro Correcto!",
		"sql1" => $sql1,
	];
	echo json_encode($datos);
}

if($condicion=='eliminar_nolaborados1'){
	$id = $_POST["id"];
	$sql1="DELETE FROM temporal_nomina_pagos WHERE id = ".$id;
	$proceso1=mysqli_query($conexion,$sql1);
	$datos = [
		"estatus" => 'ok',
		"msg" => "Se ha eliminado correctamente!",
		"sql1" => $sql1,
	];
	echo json_encode($datos);	
}

if($condicion=='dobleturnos1'){
	$nomina_id = $_POST["nomina_id"];
	$html1 = '';
	$sql1="SELECT * FROM temporal_nomina_pagos WHERE id_nomina = ".$nomina_id." and concepto = 'dobleturnos'";
	$proceso1=mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);
	while($row1=mysqli_fetch_array($proceso1)){
		$id = $row1["id"];
		$texto = $row1["texto"];
		$fecha = $row1["fecha"];
		$html1.= '
			<div class="col-12 mt-3" id="modal_dobleturnos1_generado_'.$id.'">
				<div class="row">
					<div class="col-4 text-center">
						'.$texto.'
					</div>
					<div class="col-4 text-center">
						'.$fecha.'
					</div>
					<div class="col-4 text-center">
						<button type="button" class="btn btn-danger" onclick="eliminar_dobleturnos1('.$id.')">Eliminar</button>
					</div>
				</div>
			</div>
		';
	}

	$html1 .= '
		<div class="col-12 text-center">
			<hr style="width:100%;color:black;">
		</div>
		<div class="col-12 form-group form-check">
				<label for="modal_dobleturnos1_texto">Concepto</label>
				<select class="form-control" id="modal_dobleturnos1_texto" name="modal_dobleturnos1_texto" required>
					<option value="">Seleccione</option>
					<option value="Normal">Normal</option>
					<option value="Domingo">Domingo</option>
				</select>
			</div>
			<div class="col-12 form-group form-check">
				<label for="modal_dobleturnos1_fecha">Fecha</label>
				<input type="date" name="modal_dobleturnos1_fecha" id="modal_dobleturnos1_fecha" class="form-control" required>
			</div>
			<div class="col-12 form-group form-check">
				<label for="modal_dobleturnos1_multiplicador">Multiplicar</label>
				<select class="form-control" id="modal_dobleturnos1_multiplicador" name="modal_dobleturnos1_multiplicador" required>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
				</select>
			</div>
		</div>
	';

	$datos = [
		"estatus" => 'ok',
		"sql1" => $sql1,
		"contador1" => $contador1,
		"html1" => $html1,
	];
	echo json_encode($datos);
}

if($condicion=='eliminar_dobleturnos1'){
	$id = $_POST["id"];
	$sql1="DELETE FROM temporal_nomina_pagos WHERE id = ".$id;
	$proceso1=mysqli_query($conexion,$sql1);
	$datos = [
		"estatus" => 'ok',
		"msg" => "Se ha eliminado correctamente!",
		"sql1" => $sql1,
	];
	echo json_encode($datos);	
}

if($condicion=='dobleturnos2'){
	$nomina_id = $_POST["nomina_id"];
	$texto = $_POST["texto"];
	$fecha = $_POST["fecha"];
	$multiplicador = $_POST["multiplicador"];
	$concepto = "dobleturnos";
	if($texto!='Domingo'){
		$sql1 = "SELECT * FROM nomina WHERE id = ".$nomina_id;
		$proceso1=mysqli_query($conexion,$sql1);
		while($row1=mysqli_fetch_array($proceso1)){
			$salario = $row1["salario"];
			$valor = $salario/30;
		}
	}else{
		$valor = 50000;
	}

	for($i=1;$i<=$multiplicador;$i++){
		$sql2="INSERT INTO temporal_nomina_pagos (id_nomina,concepto,valor,texto,fecha,responsable,fecha_inicio) VALUES ($nomina_id,'$concepto',$valor,'$texto','$fecha',$responsable,'$fecha_inicio')";
		$proceso2=mysqli_query($conexion,$sql2);
	}

	$datos = [
		"estatus" => 'ok',
		"msg" => "Registro Correcto!",
		"sql2" => $sql2,
	];
	echo json_encode($datos);
}

if($condicion=='descuentos1'){
	$nomina_id = $_POST["nomina_id"];
	$html1 = '';
	$sql1="SELECT * FROM temporal_nomina_pagos WHERE id_nomina = ".$nomina_id." and concepto = 'descuentos'";
	$proceso1=mysqli_query($conexion,$sql1);
	$contador1 = mysqli_num_rows($proceso1);
	while($row1=mysqli_fetch_array($proceso1)){
		$id = $row1["id"];
		$texto = $row1["texto"];
		$valor = $row1["valor"];
		$fecha = $row1["fecha"];
		$html1.= '
			<div class="col-12 mt-3" id="modal_descuentos1_generado_'.$id.'">
				<div class="row">
					<div class="col-12 text-center" style="font-size: 18px; font-weight: bold;">
						'.$texto.'
					</div>
					<div class="col-4 text-center">
						'.$fecha.'
					</div>
					<div class="col-4 text-center">
						'.$valor.'
					</div>
					<div class="col-4 text-center">
						<button type="button" class="btn btn-danger" onclick="eliminar_descuentos1('.$id.')">Eliminar</button>
					</div>
				</div>
			</div>
		';
	}

	$html1 .= '
		<div class="col-12 text-center">
			<hr style="width:100%;color:black;">
		</div>
		<div class="col-12 form-group form-check">
			<label for="modal_descuentos1_valor">Valor</label>
			<input type="text" name="modal_descuentos1_valor" id="modal_descuentos1_valor" class="form-control" required>
		</div>
		<div class="col-6 form-group form-check">
			<label for="modal_descuentos1_texto">Concepto</label>
			<select class="form-control" id="modal_descuentos1_texto" name="modal_descuentos1_texto" required>
				<option value="">Seleccione</option>
				<option value="Prestamos">Prestamos</option>
				<option value="Avances">Avances</option>
				<option value="Arriendo">Arriendo</option>
				<option value="Seguridad Social">Seguridad Social</option>
				<option value="Sexshop">Sexshop</option>
				<option value="Restaurante">Restaurante</option>
				<option value="Spa">Spa</option>
				<option value="Otros">Otros</option>
			</select>
		</div>
		<div class="col-6 form-group form-check">
			<label for="modal_descuentos1_fecha">Fecha</label>
			<input type="date" name="modal_descuentos1_fecha" id="modal_descuentos1_fecha" class="form-control" required>
		</div>
	</div>
	';
	
	$datos = [
		"estatus" => 'ok',
		"sql1" => $sql1,
		"contador1" => $contador1,
		"html1" => $html1,
	];
	echo json_encode($datos);
}

if($condicion=='descuentos2'){
	$nomina_id = $_POST["nomina_id"];
	$valor = $_POST["valor"];
	$texto = $_POST["texto"];
	$fecha = $_POST["fecha"];
	$concepto = "descuentos";
	$sql1="INSERT INTO temporal_nomina_pagos (id_nomina,concepto,valor,texto,fecha,responsable,fecha_inicio) VALUES ($nomina_id,'$concepto',$valor,'$texto','$fecha',$responsable,'$fecha_inicio')";
	$proceso1=mysqli_query($conexion,$sql1);
	$datos = [
		"estatus" => 'ok',
		"msg" => "Registro Correcto!",
		"sql1" => $sql1,
	];
	echo json_encode($datos);
}

if($condicion=='eliminar_descuentos1'){
	$id = $_POST["id"];
	$sql1="DELETE FROM temporal_nomina_pagos WHERE id = ".$id;
	$proceso1=mysqli_query($conexion,$sql1);
	$datos = [
		"estatus" => 'ok',
		"msg" => "Se ha eliminado correctamente!",
		"sql1" => $sql1,
	];
	echo json_encode($datos);	
}

/******************************************************************************************/
/******************************************************************************************/
/******************************************************************************************/
/******************************************************************************************/
/******************************************************************************************/
/******************************************************************************************/

if($condicion=='guardar1'){
	$nombre = $_POST["nombre"];
	$desde = $_POST["desde"];
	$hasta = $_POST["hasta"];

	$sql1 = "SELECT nom.id as nomina_id, nom.documento_tipo as documento_tipo, nom.documento_numero as documento_numero, nom.nombre as nombre, nom.apellido as apellido, nom.cargo as cargo, nom.sede as sede, nom.estatus as estatus, nom.salario as salario, car.nombre as cargo_nombre, sed.id as sede_id, sed.nombre as sede_nombre FROM nomina nom 
	INNER JOIN cargos car 
	ON nom.cargo = car.id 
	INNER JOIN sedes sed 
	ON nom.sede = sed.id 
	WHERE nom.estatus = 'Aceptado'";

	$proceso1 = mysqli_query($conexion,$sql1);
	$conteo1 = mysqli_num_rows($proceso1);

	if($conteo1>=1){
		$indice1 = 1;
		while($row2 = mysqli_fetch_array($proceso1)) {
			$nomina_id = $row2["nomina_id"];
			$documento_tipo = $row2["documento_tipo"];
			$documento_numero = $row2["documento_numero"];
			$nombre_completo = $row2["nombre"]." ".$row2["apellido"];
			$cargo_nombre = $row2["cargo_nombre"];
			$salario = $row2["salario"];
			$quincena = $row2["salario"]/2;
			$sede_id = $row2["sede_id"];
			$sede_nombre = $row2["sede_nombre"];
			$diario = $salario/30;

			$laborados_texto = 15;
			$nolaborados_con = 0;
			$dobleturnos_con = 0;
			$sub_total = $quincena;

			$prestamos_texto = '';
			$bono_texto = '';
			$devolucion_texto = '';
			$ajustenomina_texto = '';
			$otrosconceptos_texto = '';
			$descuentos_texto = '';

			$prestamos_valor = 0;
			$bono_valor = 0;
			$devolucion_valor = 0;
			$ajustenomina_valor = 0;
			$otrosconceptos_valor = 0;
			$dobleturnos_valor = 0;

			$totaldevengado = $quincena;
			$totaldeducciones = 0;
			$descuentos_con = 0;
			$totalpagar = 0;

			$sql3 = "SELECT * FROM temporal_nomina_pagos WHERE id_nomina = ".$nomina_id;
			$proceso3 = mysqli_query($conexion,$sql3);
			$contador3 = mysqli_num_rows($proceso3);
			if($contador3>=1){
				while($row3=mysqli_fetch_array($proceso3)){
					$concepto = $row3["concepto"];
					if($concepto=='nolaborados'){
						$sql4 = "SELECT * FROM temporal_nomina_pagos WHERE id_nomina = ".$nomina_id." and concepto = 'nolaborados'";
						$proceso4 = mysqli_query($conexion,$sql4);
						$contador4 = mysqli_num_rows($proceso4);
						$nolaborados_con = $contador4;
					}else if($concepto=='dobleturnos'){
						$sql5 = "SELECT * FROM temporal_nomina_pagos WHERE id_nomina = ".$nomina_id." and concepto = 'dobleturnos'";
						$proceso5 = mysqli_query($conexion,$sql5);
						$contador5 = mysqli_num_rows($proceso5);
						$dobleturnos_con = $contador5;
						$sql6 = "SELECT SUM(valor) as total FROM temporal_nomina_pagos WHERE id_nomina = ".$nomina_id." and concepto = 'dobleturnos'";
						$proceso6 = mysqli_query($conexion,$sql6);
						while($row6=mysqli_fetch_array($proceso6)){
							$dobleturnos_valor = $row6["total"];
						}
					}else if($concepto=='prestamos'){
						$prestamos_texto = $row3["valor"];
						$prestamos_valor = $row3["valor"];
					}else if($concepto=='bono'){
						$sql5 = "SELECT * FROM temporal_nomina_pagos WHERE id_nomina = ".$nomina_id." and concepto = 'bono'";
						$proceso5 = mysqli_query($conexion,$sql5);
						$bono_texto = $row3["valor"];
						$bono_valor = $row3["valor"];
					}else if($concepto=='devolucion'){
						$sql5 = "SELECT * FROM temporal_nomina_pagos WHERE id_nomina = ".$nomina_id." and concepto = 'devolucion'";
						$proceso5 = mysqli_query($conexion,$sql5);
						$devolucion_texto = $row3["valor"];
						$devolucion_valor = $row3["valor"];
					}else if($concepto=='ajustenomina'){
						$sql5 = "SELECT * FROM temporal_nomina_pagos WHERE id_nomina = ".$nomina_id." and concepto = 'ajustenomina'";
						$proceso5 = mysqli_query($conexion,$sql5);
						$ajustenomina_texto = $row3["valor"];
						$ajustenomina_valor = $row3["valor"];
					}else if($concepto=='otrosconceptos'){
						$sql5 = "SELECT * FROM temporal_nomina_pagos WHERE id_nomina = ".$nomina_id." and concepto = 'otrosconceptos'";
						$proceso5 = mysqli_query($conexion,$sql5);
						$otrosconceptos_texto = $row3["valor"];
						$otrosconceptos_valor = $row3["valor"];
					}else if($concepto=='descuentos'){
						$descuentos_con = $descuentos_con+1;
						$sql5 = "SELECT SUM(valor) as total FROM temporal_nomina_pagos WHERE id_nomina = ".$nomina_id." and concepto = 'descuentos'";
						$proceso5 = mysqli_query($conexion,$sql5);
						while($row5=mysqli_fetch_array($proceso5)){
							$totaldeducciones = $row5["total"];
						}
					}
				}

				$nolaborados_subtotal = $diario*$nolaborados_con;
				$laborados_texto = 15-$nolaborados_con;
				$sub_total = $quincena-$nolaborados_subtotal;
				$totaldevengado = ($prestamos_valor+$bono_valor+$devolucion_valor+$ajustenomina_valor+$otrosconceptos_valor+$dobleturnos_valor)+$sub_total;
			}

			$totalpagar = $totaldevengado-$totaldeducciones;

			$sql6 = "DELETE FROM nomina_pagos_presabana WHERE id_nomina = ".$nomina_id." and fecha_desde BETWEEN '$desde' AND '$hasta' and fecha_hasta BETWEEN '$desde' AND '$hasta'";
			$proceso6 = mysqli_query($conexion,$sql6);

			$sql7 = "INSERT INTO nomina_pagos_presabana (id_nomina,sede,cargo,sueldo,laborados,nolaborados,subtotal,doblaturno,prestamos,bono,devolucion_ss,ajustenomina,otrosconceptos,totaldevengado,descuentos,totaldeducciones,totalpagar,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ($nomina_id,$sede_id,'$cargo_nombre',$salario,$laborados_texto,$nolaborados_con,$sub_total,$dobleturnos_con,$prestamos_valor,$bono_valor,$devolucion_valor,$ajustenomina_valor,$otrosconceptos_valor,$totaldevengado,$descuentos_con,$totaldeducciones,$totalpagar,'$desde','$hasta',$responsable,'$fecha_inicio')";
			$proceso7 = mysqli_query($conexion,$sql7);
		}
	}

	$datos = [
		"estatus"	=> "ok",
	];
	echo json_encode($datos);
}

if($condicion=='importar1'){
	$fecha_desde = $_POST["fecha_desde"];
	$fecha_hasta = $_POST["fecha_hasta"];
	$archivo_nombre = $_FILES['file']['name'];
	$archivo_temporal = $_FILES['file']['tmp_name'];

	$extension = explode(".", $archivo_nombre);
	$extension = strtolower($extension[1]);

	if($extension!='xls' and $extension!='xml' and $extension!='xlam' and $extension!='xlsx'){
	    $datos = [
			"estatus" => 'error',
			"msg" => "Formato de archivo incorrecto!",
		];
		echo json_encode($datos);
		exit;
	}

	$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($archivo_temporal);
	$worksheet = $spreadsheet->getActiveSheet();

	$limite = 1000;

	$sql1 = "DELETE FROM nomina_pagos_presabana WHERE fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$proceso1 = mysqli_query($conexion,$sql1);
	$sql6 = "DELETE FROM temporal_nomina_pagos WHERE fecha BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
	$proceso6 = mysqli_query($conexion,$sql6);

	for($i=3;$i<=$limite;$i++){
		$documento_numero = $worksheet->getCell('C'.$i);
		//$worksheet->getCell('Z'.$i)->getCalculatedValue()."<br>";
	    	if($documento_numero!=''){
		        $sql2 = "SELECT * FROM nomina WHERE estatus = 'Aceptado' and documento_numero = '$documento_numero'";
				$proceso2 = mysqli_query($conexion,$sql2);
				$contador2 = mysqli_num_rows($proceso2);
				if($contador2>=1){
					while($row2=mysqli_fetch_array($proceso2)){
						$nomina_id = $row2["id"];
						$nomina_sede = $row2["sede"];
						$nomina_cargo = $row2["cargo"];
						$nomina_salario = $row2["salario"];
						$diario = $nomina_salario/30;
						$doble = $diario*2;
						$total_devengado = 0;
						$total_deducciones = 0;
						$descuentos_contador = 0;
					}

					$diaslaborados = $worksheet->getCell('I'.$i)->getValue();
					$diaslaborados_valor = $diaslaborados*$diario;
					$diasnolaborados = $worksheet->getCell('L'.$i)->getValue();
					if($diasnolaborados==""){
						$diasnolaborados = 0;
						$diasnolaborados_valor = 0;
					}else{
						$diasnolaborados_valor = $diasnolaborados*$diario;	
					}
					$subtotal = $diaslaborados_valor-$diasnolaborados_valor;
					$total_devengado = $subtotal;

					$doblaturnos_totales = 0;

					$doblaturno = $worksheet->getCell('O'.$i)->getValue();
					if($doblaturno!=''){
						for($j=1;$j<=$doblaturno;$j++){
							$sql3 = "INSERT INTO temporal_nomina_pagos (id_nomina,concepto,texto,valor,fecha,responsable,fecha_inicio) VALUES ($nomina_id,'dobleturnos','Normal',$diario,'$fecha_desde',$responsable,'$fecha_inicio')";
							$proceso3 = mysqli_query($conexion,$sql3);
							$total_devengado = $total_devengado+$diario;
							$doblaturnos_totales = $doblaturnos_totales+1;
						}
					}

					$domingos = $worksheet->getCell('R'.$i)->getValue();
					if($domingos!=''){
						for($k=1;$k<=$domingos;$k++){
							$sql3 = "INSERT INTO temporal_nomina_pagos (id_nomina,concepto,texto,valor,fecha,responsable,fecha_inicio) VALUES ($nomina_id,'dobleturnos','Domingo',50000,'$fecha_desde',$responsable,'$fecha_inicio')";
							$proceso3 = mysqli_query($conexion,$sql3);
							$total_devengado = $total_devengado+50000;
							$doblaturnos_totales = $doblaturnos_totales+1;
						}
					}

					$prestamos = $worksheet->getCell('T'.$i)->getCalculatedValue();
					if($prestamos!=''){
						$sql3 = "INSERT INTO temporal_nomina_pagos (id_nomina,concepto,texto,valor,fecha,responsable,fecha_inicio) VALUES ($nomina_id,'prestamos','0',$prestamos,'$fecha_desde',$responsable,'$fecha_inicio')";
						$proceso3 = mysqli_query($conexion,$sql3);
						$total_devengado = $total_devengado+$prestamos;
					}

					$bono = $worksheet->getCell('U'.$i)->getCalculatedValue();
					if($bono!=''){
						$sql3 = "INSERT INTO temporal_nomina_pagos (id_nomina,concepto,texto,valor,fecha,responsable,fecha_inicio) VALUES ($nomina_id,'bono','0',$bono,'$fecha_desde',$responsable,'$fecha_inicio')";
						$proceso3 = mysqli_query($conexion,$sql3);
						$total_devengado = $total_devengado+$bono;
					}

					$devolucion = $worksheet->getCell('V'.$i)->getCalculatedValue();
					if($devolucion!=''){
						$sql3 = "INSERT INTO temporal_nomina_pagos (id_nomina,concepto,texto,valor,fecha,responsable,fecha_inicio) VALUES ($nomina_id,'devolucion','0',$devolucion,'$fecha_desde',$responsable,'$fecha_inicio')";
						$proceso3 = mysqli_query($conexion,$sql3);
						$total_devengado = $total_devengado+$devolucion;
					}

					$ajustenomina = $worksheet->getCell('W'.$i)->getCalculatedValue();
					if($ajustenomina!=''){
						$sql3 = "INSERT INTO temporal_nomina_pagos (id_nomina,concepto,texto,valor,fecha,responsable,fecha_inicio) VALUES ($nomina_id,'ajustenomina','0',$ajustenomina,'$fecha_desde',$responsable,'$fecha_inicio')";
						$proceso3 = mysqli_query($conexion,$sql3);
						$total_devengado = $total_devengado+$ajustenomina;
					}

					$otrosconceptos = $worksheet->getCell('X'.$i)->getCalculatedValue();
					if($otrosconceptos!=''){
						$sql3 = "INSERT INTO temporal_nomina_pagos (id_nomina,concepto,texto,valor,fecha,responsable,fecha_inicio) VALUES ($nomina_id,'otrosconceptos','0',$otrosconceptos,'$fecha_desde',$responsable,'$fecha_inicio')";
						$proceso3 = mysqli_query($conexion,$sql3);
						$total_devengado = $total_devengado+$otrosconceptos;
					}

					$prestamos2 = $worksheet->getCell('Z'.$i)->getCalculatedValue();
					if($prestamos2!=''){
						$sql3 = "INSERT INTO temporal_nomina_pagos (id_nomina,concepto,texto,valor,fecha,responsable,fecha_inicio) VALUES ($nomina_id,'descuentos','Prestamos',$prestamos2,'$fecha_desde',$responsable,'$fecha_inicio')";
						$proceso3 = mysqli_query($conexion,$sql3);
						$total_deducciones = $total_deducciones+$prestamos2;
						$descuentos_contador = $descuentos_contador+1;
					}

					$avances = $worksheet->getCell('AA'.$i)->getCalculatedValue();
					if($avances!=''){
						$sql3 = "INSERT INTO temporal_nomina_pagos (id_nomina,concepto,texto,valor,fecha,responsable,fecha_inicio) VALUES ($nomina_id,'descuentos','Avances',$avances,'$fecha_desde',$responsable,'$fecha_inicio')";
						$proceso3 = mysqli_query($conexion,$sql3);
						$total_deducciones = $total_deducciones+$avances;
						$descuentos_contador = $descuentos_contador+1;
					}

					$arriendo = $worksheet->getCell('AB'.$i)->getCalculatedValue();
					if($arriendo!=''){
						$sql3 = "INSERT INTO temporal_nomina_pagos (id_nomina,concepto,texto,valor,fecha,responsable,fecha_inicio) VALUES ($nomina_id,'descuentos','Arriendo',$arriendo,'$fecha_desde',$responsable,'$fecha_inicio')";
						$proceso3 = mysqli_query($conexion,$sql3);
						$total_deducciones = $total_deducciones+$arriendo;
						$descuentos_contador = $descuentos_contador+1;
					}

					$seguridadsocial = $worksheet->getCell('AC'.$i)->getCalculatedValue();
					if($seguridadsocial!=''){
						$sql3 = "INSERT INTO temporal_nomina_pagos (id_nomina,concepto,texto,valor,fecha,responsable,fecha_inicio) VALUES ($nomina_id,'descuentos','Seguridad Social',$seguridadsocial,'$fecha_desde',$responsable,'$fecha_inicio')";
						$proceso3 = mysqli_query($conexion,$sql3);
						$total_deducciones = $total_deducciones+$seguridadsocial;
						$descuentos_contador = $descuentos_contador+1;
					}

					$sexshop = $worksheet->getCell('AD'.$i)->getCalculatedValue();
					if($sexshop!=''){
						$sql3 = "INSERT INTO temporal_nomina_pagos (id_nomina,concepto,texto,valor,fecha,responsable,fecha_inicio) VALUES ($nomina_id,'descuentos','Sexshop',$sexshop,'$fecha_desde',$responsable,'$fecha_inicio')";
						$proceso3 = mysqli_query($conexion,$sql3);
						$total_deducciones = $total_deducciones+$sexshop;
						$descuentos_contador = $descuentos_contador+1;
					}

					$restaurante = $worksheet->getCell('AE'.$i)->getCalculatedValue();
					if($restaurante!=''){
						$sql3 = "INSERT INTO temporal_nomina_pagos (id_nomina,concepto,texto,valor,fecha,responsable,fecha_inicio) VALUES ($nomina_id,'descuentos','Restaurante',$restaurante,'$fecha_desde',$responsable,'$fecha_inicio')";
						$proceso3 = mysqli_query($conexion,$sql3);
						$total_deducciones = $total_deducciones+$restaurante;
						$descuentos_contador = $descuentos_contador+1;
					}

					$spa = $worksheet->getCell('AF'.$i)->getCalculatedValue();
					if($spa!=''){
						$sql3 = "INSERT INTO temporal_nomina_pagos (id_nomina,concepto,texto,valor,fecha,responsable,fecha_inicio) VALUES ($nomina_id,'descuentos','Spa',$spa,'$fecha_desde',$responsable,'$fecha_inicio')";
						$proceso3 = mysqli_query($conexion,$sql3);
						$total_deducciones = $total_deducciones+$spa;
						$descuentos_contador = $descuentos_contador+1;
					}

					$tecnologia = $worksheet->getCell('AG'.$i)->getCalculatedValue();
					if($tecnologia!=''){
						$sql3 = "INSERT INTO temporal_nomina_pagos (id_nomina,concepto,texto,valor,fecha,responsable,fecha_inicio) VALUES ($nomina_id,'descuentos','tecnologia',$tecnologia,'$fecha_desde',$responsable,'$fecha_inicio')";
						$proceso3 = mysqli_query($conexion,$sql3);
						$total_deducciones = $total_deducciones+$tecnologia;
						$descuentos_contador = $descuentos_contador+1;
					}

					$otros = $worksheet->getCell('AH'.$i)->getCalculatedValue();
					if($otros!=''){
						$sql3 = "INSERT INTO temporal_nomina_pagos (id_nomina,concepto,texto,valor,fecha,responsable,fecha_inicio) VALUES ($nomina_id,'descuentos','Otros',$otros,'$fecha_desde',$responsable,'$fecha_inicio')";
						$proceso3 = mysqli_query($conexion,$sql3);
						$total_deducciones = $total_deducciones+$otros;
						$descuentos_contador = $descuentos_contador+1;
					}

					$total_pagar = $total_devengado-$total_deducciones;

					if($doblaturno==''){
						$doblaturno = 0;
					}
					if($domingos==''){
						$domingos = 0;
					}
					if($prestamos==''){
						$prestamos = 0;
					}
					if($bono==''){
						$bono = 0;
					}
					if($devolucion==''){
						$devolucion = 0;
					}
					if($ajustenomina==''){
						$ajustenomina = 0;
					}
					if($otrosconceptos==''){
						$otrosconceptos = 0;
					}
					if($prestamos2==''){
						$prestamos2 = 0;
					}
					if($avances==''){
						$avances = 0;
					}
					if($arriendo==''){
						$arriendo = 0;
					}
					if($seguridadsocial==''){
						$seguridadsocial = 0;
					}
					if($sexshop==''){
						$sexshop = 0;
					}
					if($restaurante==''){
						$restaurante = 0;
					}
					if($spa==''){
						$spa = 0;
					}
					if($otros==''){
						$otros = 0;
					}

					$sql4 = "SELECT * FROM cargos WHERE id = ".$nomina_cargo;
					$proceso4 = mysqli_query($conexion,$sql4);
					$contador4 = mysqli_num_rows($proceso4);
					if($contador4>=1){
						while($row4=mysqli_fetch_array($proceso4)){
							$cargo_nombre = $row4["nombre"];
						}
					}else{
						$cargo_nombre = "Desconocido";
					}

					$sql5 = "INSERT INTO nomina_pagos_presabana (id_nomina,sede,cargo,sueldo,laborados,nolaborados,subtotal,doblaturno,prestamos,bono,devolucion_ss,ajustenomina,otrosconceptos,totaldevengado,descuentos,totaldeducciones,totalpagar,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ($nomina_id,$nomina_sede,'$cargo_nombre',$nomina_salario,$diaslaborados,$diasnolaborados,$subtotal,$doblaturnos_totales,$prestamos,$bono,$devolucion,$ajustenomina,$otros,$total_devengado,$descuentos_contador,$total_deducciones,$total_pagar,'$fecha_desde','$fecha_hasta',$responsable,'$fecha_inicio')";
					$proceso5 = mysqli_query($conexion,$sql5);
				}
			}
	}

	$datos = [
		"estatus"	=> "ok",
		"msg"	=> "Se ha guardado exitosamente!",
	];
	echo json_encode($datos);
}