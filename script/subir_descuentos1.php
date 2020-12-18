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
        $identificacion = $worksheet->getCell('C'.$i);
        $horas = $worksheet->getCell('D'.$i);
        $bono_streamate = $worksheet->getCell('E'.$i);
        $tienda = $worksheet->getCell('F'.$i);
        $odontologia = $worksheet->getCell('G'.$i);
        $segsocial = $worksheet->getCell('H'.$i);
        $coopserpak = $worksheet->getCell('I'.$i);
        $multas = $worksheet->getCell('J'.$i);
        $sexshop = $worksheet->getCell('K'.$i);
        $avances = $worksheet->getCell('L'.$i);
        $belleza = $worksheet->getCell('M'.$i);
        $sancionpagina = $worksheet->getCell('N'.$i);
        $lenceria = $worksheet->getCell('O'.$i);

        $sql1 = "SELECT * FROM modelos WHERE documento_numero = ".$identificacion;
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
                $sql4 = "DELETE FROM bonos_horas WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
                $consulta4 = mysqli_query($conexion,$sql4);
                $sql2 = "INSERT INTO bonos_horas (id_modelo,concepto,monto,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$id_modelo','Horas',75000,'$fecha_desde','$fecha_hasta','$fecha_inicio')";
                $consulta2 = mysqli_query($conexion,$sql2);
            }

            if($bono_streamate!=''){
                $sql4 = "DELETE FROM bonos_streamate WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
                $consulta4 = mysqli_query($conexion,$sql4);
                $sql2 = "INSERT INTO bonos_streamate (id_modelo,concepto,monto,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$id_modelo','Bono Streamate','$bono_streamate','$fecha_desde','$fecha_hasta','$fecha_inicio')";
                $consulta2 = mysqli_query($conexion,$sql2);
            }

            if($tienda!=''){
                $sql4 = "DELETE FROM tienda WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
                $consulta4 = mysqli_query($conexion,$sql4);
                $sql2 = "INSERT INTO tienda (id_modelo,concepto,valor,responsable,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$id_modelo','Tienda','$tienda','$responsable','$fecha_desde','$fecha_hasta','$fecha_inicio')";
                $consulta2 = mysqli_query($conexion,$sql2);
            }

            if($odontologia!=''){
                $sql4 = "DELETE FROM odontologia WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
                $consulta4 = mysqli_query($conexion,$sql4);
                $sql2 = "INSERT INTO odontologia (id_modelo,concepto,monto,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$id_modelo','Odontologia','$odontologia','$fecha_desde','$fecha_hasta','$fecha_inicio')";
                $consulta2 = mysqli_query($conexion,$sql2);
            }

            if($segsocial!=''){
                $sql4 = "DELETE FROM seguridad_social WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
                $consulta4 = mysqli_query($conexion,$sql4);
                $sql2 = "INSERT INTO seguridad_social (id_modelo,concepto,monto,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$id_modelo','Seguridad Social','$segsocial','$fecha_desde','$fecha_hasta','$fecha_inicio')";
                $consulta2 = mysqli_query($conexion,$sql2);
            }

            if($coopserpak!=''){
                $sql4 = "DELETE FROM coopserpak WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
                $consulta4 = mysqli_query($conexion,$sql4);
                $sql2 = "INSERT INTO coopserpak (id_modelo,concepto,monto,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$id_modelo','Coopserpak','$coopserpak','$fecha_desde','$fecha_hasta','$fecha_inicio')";
                $consulta2 = mysqli_query($conexion,$sql2);
            }

            if($multas!=''){
                $sql4 = "DELETE FROM multas WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
                $consulta4 = mysqli_query($conexion,$sql4);
                $sql2 = "INSERT INTO multas (id_modelo,concepto,valor,responsable,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$id_modelo','Multas','$multas','$responsable','$fecha_desde','$fecha_hasta','$fecha_inicio')";
                $consulta2 = mysqli_query($conexion,$sql2);
            }

            if($sexshop!=''){
                $sql4 = "DELETE FROM sexshop WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
                $consulta4 = mysqli_query($conexion,$sql4);
                $sql2 = "INSERT INTO sexshop (id_modelo,concepto,monto,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$id_modelo','Sexshop','$sexshop','$fecha_desde','$fecha_hasta','$fecha_inicio')";
                $consulta2 = mysqli_query($conexion,$sql2);
            }

            if($avances!=''){
                $sql4 = "DELETE FROM avances WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
                $consulta4 = mysqli_query($conexion,$sql4);
                $sql2 = "INSERT INTO avances (id_modelo,concepto,valor,responsable,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$id_modelo','Avances','$avances','$responsable','$fecha_desde','$fecha_hasta','$fecha_inicio')";
                $consulta2 = mysqli_query($conexion,$sql2);
            }

            if($belleza!=''){
                $sql4 = "DELETE FROM belleza WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
                $consulta4 = mysqli_query($conexion,$sql4);
                $sql2 = "INSERT INTO belleza (id_modelo,concepto,monto,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$id_modelo','Belleza','$belleza','$fecha_desde','$fecha_hasta','$fecha_inicio')";
                $consulta2 = mysqli_query($conexion,$sql2);
            }

            if($sancionpagina!=''){
                $sql4 = "DELETE FROM sancionpagina WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
                $consulta4 = mysqli_query($conexion,$sql4);
                $sql2 = "INSERT INTO sancionpagina (id_modelo,concepto,monto,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$id_modelo','Sancion Pagina','$sancionpagina','$fecha_desde','$fecha_hasta','$fecha_inicio')";
                $consulta2 = mysqli_query($conexion,$sql2);
            }

            if($lenceria!=''){
                $sql4 = "DELETE FROM lenceria WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
                $consulta4 = mysqli_query($conexion,$sql4);
                $sql2 = "INSERT INTO lenceria (id_modelo,concepto,monto,fecha_desde,fecha_hasta,fecha_inicio) VALUES ('$id_modelo','Lenceria','$lenceria','$fecha_desde','$fecha_hasta','$fecha_inicio')";
                $consulta2 = mysqli_query($conexion,$sql2);
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

echo 'Correcto';

?>