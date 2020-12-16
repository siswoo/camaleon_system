<?php
session_start();
include('conexion.php');
$fecha_inicio = date('Y-m-d');
$recorte_Camsoda = $_POST['recorte_Camsoda'];
$mes_Camsoda = $_POST['mes_Camsoda'];
$year_Camsoda = $_POST['year_Camsoda'];

if($recorte_Camsoda==1){
    $fecha_desde_Camsoda = $year_Camsoda."-".$mes_Camsoda."-"."01";
    $fecha_hasta_Camsoda = $year_Camsoda."-".$mes_Camsoda."-"."15";
}else{
    $fecha_desde_Camsoda = $year_Camsoda."-".$mes_Camsoda."-"."16";
    $fecha_hasta_Camsoda = $year_Camsoda."-".$mes_Camsoda."-"."31";
}

echo '<input type="hidden" name="fecha_desde_Camsoda" id="fecha_desde_Camsoda" value="'.$fecha_desde_Camsoda.'">';
echo '<input type="hidden" name="fecha_hasta_Camsoda" id="fecha_hasta_Camsoda" value="'.$fecha_hasta_Camsoda.'">';

$sql1 = "SELECT * FROM modelos_cuentas WHERE id_paginas = 3 and estatus = 'Aprobada'";
$registro1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($registro1)) {
    $usuario_Camsoda = $row1['usuario'];
    $clave_Camsoda = $row1['clave'];
    $contador1 = 0;
    $sql2 = "SELECT * FROM modelos WHERE id = ".$row1['id_modelos'];
    $registro2 = mysqli_query($conexion,$sql2);
    while($row2 = mysqli_fetch_array($registro2)) {
        $nombre_modelo = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
    }

    /******VERIFICAMOS QUE TIENE CUENTA DE CHATURBATE CREADA Y QUE AL MENOS HA GENERADO 1 TOKEN**********/
    $sql3 = "SELECT * FROM modelos_cuentas WHERE id_modelos = ".$row1['id_modelos']." and id_paginas = 1 and estatus = 'Aprobada'";
    $registro3 = mysqli_query($conexion,$sql3);
    while($row3 = mysqli_fetch_array($registro3)) {
        $nickname_modelo_chaturbate = $row3['usuario'];
        $clave_modelo_chaturbate = $row3['clave'];
        
        $sql4 = "SELECT * FROM chaturbate WHERE nickname = '".$nickname_modelo_chaturbate."' and tokens >= 1 and fecha BETWEEN  '".$fecha_desde_Camsoda."' AND  '".$fecha_hasta_Camsoda."'";
        $registro4 = mysqli_query($conexion,$sql4);
        while($row4 = mysqli_fetch_array($registro4)) {
            $contador1 = $contador1 + 1;
        }

        $sql8 = "SELECT * FROM modelos_cuentas WHERE id_modelos = ".$row1['id_modelos']." and id_paginas = 5 and estatus = 'Aprobada'";
        $registro8 = mysqli_query($conexion,$sql8);
        while($row8 = mysqli_fetch_array($registro8)) {
            $nickname_modelo_stripchat = $row8['usuario'];
            $clave_modelo_stripchat = $row8['clave'];
            
            $sql7 = "SELECT * FROM stripchat WHERE nickname ='".$nickname_modelo_stripchat."' and tokens >= 1 and fecha BETWEEN  '".$fecha_desde_Camsoda."' AND  '".$fecha_hasta_Camsoda."'";
            $registro7 = mysqli_query($conexion,$sql7);
            while($row7 = mysqli_fetch_array($registro7)) {
                $contador1 = $contador1 + 1;
            }
        }

    }

    if($contador1>=1){
        $sql6 = "SELECT * FROM camsoda WHERE id_modelo = ".$row1['id_modelos']." and fecha_desde BETWEEN  '".$fecha_desde_Camsoda."' AND  '".$fecha_hasta_Camsoda."' AND  '".$fecha_hasta_Camsoda."' LIMIT 1";
        $registro6 = mysqli_query($conexion,$sql6);
        $contador2 = mysqli_num_rows($registro6);

        if($contador2==0){
            echo '
                <tr>
                    <td>'.$nombre_modelo.'</td>
                    <td>'.$usuario_Camsoda.'</td>
                    <td>'.$clave_Camsoda.'</td>
                    <td>
                        <input type="number" class="form-control" name="tokens_camsoda_'.$row1["id_modelos"].'" id="tokens_camsoda_'.$row1["id_modelos"].'">
                    </td>
                    <td>
                        <button type="button" class="btn btn-success" onclick="guardarToken_camsoda('.$row1["id_modelos"].');">Guardar</button>
                    </td>
                </tr>
            ';
        }else{
            while($row6 = mysqli_fetch_array($registro6)) {
                echo '
                    <tr>
                        <td>'.$nombre_modelo.'</td>
                        <td>'.$usuario_Camsoda.'</td>
                        <td>'.$clave_Camsoda.'</td>
                        <td>
                            <input type="number" class="form-control" name="tokens_camsoda_'.$row1["id_modelos"].'" id="tokens_camsoda_'.$row1["id_modelos"].'" value="'.$row6["tokens"].'">
                        </td>
                        <td>
                            <button type="button" class="btn btn-success" onclick="guardarToken_camsoda('.$row1["id_modelos"].');">Guardar</button>
                        </td>
                    </tr>
                ';   
            }
        }
        
    }

}



?>