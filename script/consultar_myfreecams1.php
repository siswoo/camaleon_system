<?php
session_start();
include('conexion.php');
$fecha_inicio = date('Y-m-d');
$recorte_Myfreecams = $_POST['recorte_Myfreecams'];
$mes_Myfreecams = $_POST['mes_Myfreecams'];
$year_Myfreecams = $_POST['year_Myfreecams'];

if($recorte_Myfreecams==1){
    $fecha_desde_Myfreecams = $year_Myfreecams."-".$mes_Myfreecams."-"."01";
    $fecha_hasta_Myfreecams = $year_Myfreecams."-".$mes_Myfreecams."-"."15";
}else{
    $fecha_desde_Myfreecams = $year_Myfreecams."-".$mes_Myfreecams."-"."16";
    $fecha_hasta_Myfreecams = $year_Myfreecams."-".$mes_Myfreecams."-"."31";
}

echo '<input type="hidden" name="fecha_desde_Myfreecams" id="fecha_desde_Myfreecams" value="'.$fecha_desde_Myfreecams.'">';
echo '<input type="hidden" name="fecha_hasta_Myfreecams" id="fecha_hasta_Myfreecams" value="'.$fecha_hasta_Myfreecams.'">';

$sql1 = "SELECT * FROM modelos_cuentas WHERE id_paginas = 2 and estatus = 'Aprobada'";
$registro1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($registro1)) {
    $usuario_myfreecams = $row1['usuario'];
    $clave_myfreecams = $row1['clave'];
    $contador1 = 0;
    $sql2 = "SELECT * FROM modelos WHERE id = ".$row1['id_modelos'];
    $registro2 = mysqli_query($conexion,$sql2);
    while($row2 = mysqli_fetch_array($registro2)) {
        $nombre_modelo = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
    }
    $sql3 = "SELECT * FROM modelos_cuentas WHERE id_modelos = ".$row1['id_modelos']." and id_paginas = 1 and estatus = 'Aprobada'";
    $registro3 = mysqli_query($conexion,$sql3);
    while($row3 = mysqli_fetch_array($registro3)) {
        $nickname_modelo_chaturbate = $row3['usuario'];
        $clave_modelo_chaturbate = $row3['clave'];
        
        $sql4 = "SELECT * FROM chaturbate WHERE nickname = '".$nickname_modelo_chaturbate."' and tokens >= 1 and fecha BETWEEN  '".$fecha_desde_Myfreecams."' AND  '".$fecha_hasta_Myfreecams."'";
        $registro4 = mysqli_query($conexion,$sql4);
        while($row4 = mysqli_fetch_array($registro4)) {
            $contador1 = $contador1 + 1;
        }
    }

    if($contador1>=1){
        /*
        $sql5 = "SELECT * FROM modelos_cuentas WHERE id_modelos = ".$row1['id_modelos']." and id_paginas = 2 and estatus = 'Aprobada'";
        $registro5 = mysqli_query($conexion,$sql5);
        */

        $sql6 = "SELECT * FROM myfreecams WHERE id_modelo = ".$row1['id_modelos']." and fecha_desde BETWEEN  '".$fecha_desde_Myfreecams."' AND  '".$fecha_hasta_Myfreecams."' and fecha_hasta BETWEEN  '".$fecha_desde_Myfreecams."' AND  '".$fecha_hasta_Myfreecams."' LIMIT 1";
        $registro6 = mysqli_query($conexion,$sql6);
        $contador2 = mysqli_num_rows($registro6);

        if($contador2==0){
            echo '
                <tr>
                    <td>'.$nombre_modelo.'</td>
                    <td>'.$usuario_myfreecams.'</td>
                    <td>'.$clave_myfreecams.'</td>
                    <td>
                        <input type="number" class="form-control" name="tokens_'.$row1["id_modelos"].'" id="tokens_'.$row1["id_modelos"].'">
                    </td>
                    <td>
                        <button type="button" class="btn btn-success" onclick="guardarToken1('.$row1["id_modelos"].');">Guardar</button>
                    </td>
                </tr>
            ';
        }else{
            while($row6 = mysqli_fetch_array($registro6)) {
                echo '
                    <tr>
                        <td>'.$nombre_modelo.'</td>
                        <td>'.$usuario_myfreecams.'</td>
                        <td>'.$clave_myfreecams.'</td>
                        <td>
                            <input type="number" class="form-control" name="tokens_'.$row1["id_modelos"].'" id="tokens_'.$row1["id_modelos"].'" value="'.$row6["tokens"].'">
                        </td>
                        <td>
                            <button type="button" class="btn btn-success" onclick="guardarToken1('.$row1["id_modelos"].');">Guardar</button>
                        </td>
                    </tr>
                ';   
            }
        }
        
    }

}



?>