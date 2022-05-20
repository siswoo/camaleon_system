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
        $amateur = $worksheet->getCell('E'.$i);
        $sancionpagina = $worksheet->getCell('F'.$i);
        $lenceria = $worksheet->getCell('G'.$i);
        $sexshop = $worksheet->getCell('H'.$i);
        $avances = $worksheet->getCell('I'.$i);
        $multas = $worksheet->getCell('J'.$i)->getvalue();
        $restaurante = $worksheet->getCell('K'.$i)->getvalue();
        $valor_especial = $worksheet->getCell('P'.$i)->getvalue();
        $concepto_especial = $worksheet->getCell('Q'.$i)->getvalue();
        $streamray = $worksheet->getCell('S'.$i)->getvalue();
        $identificacion = intval($identificacion);
        $multas = str_replace('.','',$multas);
        $avances = str_replace('.','',$avances);
        
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

            if($amateur!=''){
                $sql2 = "DELETE FROM bonos_horas WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and concepto = 'Amateur'";
                $consulta2 = mysqli_query($conexion,$sql2);
                $sql3 = "INSERT INTO bonos_horas (id_modelo,concepto,monto,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ($id_modelo,'Amateur','$amateur','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                $consulta3 = mysqli_query($conexion,$sql3);
            }

            if($streamray!=''){
                $sql2 = "DELETE FROM bonos_horas WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and concepto = 'Streamray'";
                $consulta2 = mysqli_query($conexion,$sql2);
                $sql3 = "INSERT INTO bonos_horas (id_modelo,concepto,monto,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ($id_modelo,'Streamray',$streamray,'$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                $consulta3 = mysqli_query($conexion,$sql3);
            }
            
            if($horas!=''){
                $sql2 = "DELETE FROM bonos_horas WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and concepto = 'Horas'";
                $consulta2 = mysqli_query($conexion,$sql2);
                $sql3 = "INSERT INTO bonos_horas (id_modelo,concepto,monto,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ($id_modelo,'Horas',75000,'$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                $consulta3 = mysqli_query($conexion,$sql3);
            }

            if($restaurante!=''){
                $sql4 = "DELETE FROM descuento WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."'";
                $consulta4 = mysqli_query($conexion,$sql4);
                $sql5 = "INSERT INTO descuento (id_modelo,concepto,valor,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ($id_modelo,'Restaurante','$restaurante','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";
                $consulta5 = mysqli_query($conexion,$sql5);
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



            if($valor_especial!='' and $concepto_especial!=''){

                $sql26 = "DELETE FROM descuento WHERE id_modelo = $id_modelo and fecha_desde BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and fecha_hasta BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' and concepto = '".$concepto_especial."'";

                $consulta26 = mysqli_query($conexion,$sql26);

                $sql27 = "INSERT INTO descuento (id_modelo,concepto,valor,fecha_desde,fecha_hasta,responsable,fecha_inicio) VALUES ($id_modelo,'$concepto_especial','$valor_especial','$fecha_desde','$fecha_hasta','$responsable','$fecha_inicio')";

                $consulta27 = mysqli_query($conexion,$sql27);

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

    "estatus" => "ok",

];



echo json_encode($datos);



//echo 'Correcto';



?>