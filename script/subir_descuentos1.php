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
$fecha_desde = $_POST['fecha_desde_subir_extras'];
$fecha_hasta = $_POST['fecha_hasta_subir_extras'];
$fecha_inicio = date('Y-m-d');
$responsable = $_SESSION['id'];

$archivo_nombre = $_FILES['file']['name'];
$archivo_temporal = $_FILES['file']['tmp_name'];

$extension = explode(".", $archivo_nombre);
$extension = $extension[count($extension)-1];

if($extension!='xls' and $extension!='xml' and $extension!='xlam' and $extension!='xlsx'){
    echo 'error';
    exit;
}

$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($archivo_temporal);
$worksheet = $spreadsheet->getActiveSheet();

$limite = 1000;

for($i=2;$i<=$limite;$i++){
    if($worksheet->getCell('A'.$i)!=''){
        $sede = $worksheet->getCell('A'.$i);
        $nombre_completo = $worksheet->getCell('B'.$i);
        $identificacion = $worksheet->getCell('C'.$i)->getvalue();
        $horas = $worksheet->getCell('D'.$i);
        $bono_streamate = $worksheet->getCell('E'.$i);
        $tienda = $worksheet->getCell('F'.$i);
        $odontologia = $worksheet->getCell('G'.$i);
        $segsocial = $worksheet->getCell('H'.$i);
        $coopserpak = $worksheet->getCell('I'.$i);
        $multas = $worksheet->getCell('J'.$i)->getvalue();
        $sexshop = $worksheet->getCell('K'.$i)->getvalue();
        $avances = $worksheet->getCell('L'.$i)->getvalue();
        $belleza = $worksheet->getCell('M'.$i)->getvalue();
        $sancionpagina = $worksheet->getCell('N'.$i);
        $lenceria = $worksheet->getCell('O'.$i);

        $identificacion = intval($identificacion);
        $multas = str_replace('.','',$multas);
        //$sexshop = str_replace('.','',$sexshop);
        $sexshop = intval($sexshop);
        $avances = str_replace('.','',$avances);
        //$belleza = intval($belleza);

        $sql1 = "SELECT * FROM modelos WHERE documento_numero = ".$identificacion;
        //$sql1 = "SELECT * FROM modelos WHERE documento_numero = 939980927121974";
        $consulta1 = mysqli_query($conexion,$sql1);
        if($consulta1==true){
            $contador1 = mysqli_num_rows($consulta1);
            while($row1 = mysqli_fetch_array($consulta1)) {
                $id_modelo = $row1['id'];
            }
        }

        $pase = 0;

        if($contador1>=1){

            if($horas!=''){
                $sql2 = "DELETE FROM bonos_horas WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
                $consulta2 = mysqli_query($conexion,$sql2);
                $sql3 = "INSERT INTO bonos_horas (id_modelo,concepto,monto,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ($id_modelo,'Horas',75000,'$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                $consulta3 = mysqli_query($conexion,$sql3);
            }

            if($bono_streamate!=''){
                $sql4 = "DELETE FROM bonos_streamate WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
                $consulta4 = mysqli_query($conexion,$sql4);
                $sql5 = "INSERT INTO bonos_streamate (id_modelo,concepto,monto,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ($id_modelo,'Bono Streamate','$bono_streamate','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                $consulta5 = mysqli_query($conexion,$sql5);
            }

            if($tienda!=''){
                $sql6 = "DELETE FROM tienda WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
                $consulta6 = mysqli_query($conexion,$sql6);
                $sql7 = "INSERT INTO tienda (id_modelo,concepto,valor,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ($id_modelo,'Tienda','$tienda','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                $consulta7 = mysqli_query($conexion,$sql7);
            }

            if($odontologia!=''){
                $sql8 = "DELETE FROM odontologia WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
                $consulta8 = mysqli_query($conexion,$sql8);
                $sql9 = "INSERT INTO odontologia (id_modelo,concepto,monto,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ($id_modelo,'Odontologia','$odontologia','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                $consulta9 = mysqli_query($conexion,$sql9);
            }

            if($segsocial!=''){
                $sql10 = "DELETE FROM seguridad_social WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
                $consulta10 = mysqli_query($conexion,$sql10);
                $sql11 = "INSERT INTO seguridad_social (id_modelo,concepto,monto,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ($id_modelo,'Seguridad Social','$segsocial','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                $consulta11 = mysqli_query($conexion,$sql11);
            }

            if($coopserpak!=''){
                $sql12 = "DELETE FROM coopserpak WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
                $consulta12 = mysqli_query($conexion,$sql12);
                $sql13 = "INSERT INTO coopserpak (id_modelo,concepto,monto,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ($id_modelo,'Coopserpak','$coopserpak','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                $consulta13 = mysqli_query($conexion,$sql13);
            }

            if($multas!=''){
                $sql14 = "DELETE FROM multas WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
                $consulta14 = mysqli_query($conexion,$sql14);
                $sql15 = "INSERT INTO multas (id_modelo,concepto,valor,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ($id_modelo,'Multas','$multas','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                $consulta15 = mysqli_query($conexion,$sql15);
            }

            if($sexshop!=''){
                $sql16 = "DELETE FROM sexshop WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
                $consulta16 = mysqli_query($conexion,$sql16);
                $sql17 = "INSERT INTO sexshop (id_modelo,concepto,monto,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ($id_modelo,'Sexshop','$sexshop','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                $consulta17 = mysqli_query($conexion,$sql17);
            }

            if($avances!=''){
                $sql18 = "DELETE FROM avances WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
                $consulta18 = mysqli_query($conexion,$sql18);
                $sql19 = "INSERT INTO avances (id_modelo,concepto,valor,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ($id_modelo,'Avances','$avances','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                $consulta19 = mysqli_query($conexion,$sql19);
            }

            if($belleza!=''){
                $sql20 = "DELETE FROM belleza WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
                $consulta20 = mysqli_query($conexion,$sql20);
                $sql21 = "INSERT INTO belleza (id_modelo,concepto,monto,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ($id_modelo,'Belleza','$belleza','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                $consulta21 = mysqli_query($conexion,$sql21);
            }

            if($sancionpagina!=''){
                $sql22 = "DELETE FROM sancionpagina WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
                $consulta22 = mysqli_query($conexion,$sql22);
                $sql23 = "INSERT INTO sancionpagina (id_modelo,concepto,monto,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ($id_modelo,'Sancion Pagina','$sancionpagina','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                $consulta23 = mysqli_query($conexion,$sql23);
            }

            if($lenceria!=''){
                $sql24 = "DELETE FROM lenceria WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
                $consulta24 = mysqli_query($conexion,$sql24);
                $sql25 = "INSERT INTO lenceria (id_modelo,concepto,monto,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ($id_modelo,'Lenceria','$lenceria','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                $consulta25 = mysqli_query($conexion,$sql25);
            }

            $pase = 1;
        }else{
            $sql4 = "DELETE FROM temporal_faltan_descuentos";
            $consulta4 = mysqli_query($conexion,$sql4);
            $sql3 = "INSERT INTO temporal_faltan_descuentos (nombre,identificacion,sede,fecha_inicio) VALUES ('$nombre_completo','$identificacion','$sede','$fecha_inicio')";
            $consulta3 = mysqli_query($conexion,$sql3);
        }

    }
}

$datos = [
    "sql2" => $sql2,
];

echo json_encode($datos);

//echo 'Correcto';

?>