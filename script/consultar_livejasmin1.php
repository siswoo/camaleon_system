<?php
session_start();
include('conexion.php');
$fecha_inicio = date('Y-m-d');
$recorte_LiveJasmin = $_POST['recorte_LiveJasmin'];
$mes_LiveJasmin = $_POST['mes_LiveJasmin'];
$year_LiveJasmin = $_POST['year_LiveJasmin'];

if($recorte_LiveJasmin==1){
    $fecha_desde_LiveJasmin = $year_LiveJasmin."-".$mes_LiveJasmin."-"."01";
    $fecha_hasta_LiveJasmin = $year_LiveJasmin."-".$mes_LiveJasmin."-"."15";
}else{
    $fecha_desde_LiveJasmin = $year_LiveJasmin."-".$mes_LiveJasmin."-"."16";
    $fecha_hasta_LiveJasmin = $year_LiveJasmin."-".$mes_LiveJasmin."-"."31";
}

echo '<input type="hidden" name="fecha_desde_LiveJasmin" id="fecha_desde_LiveJasmin" value="'.$fecha_desde_LiveJasmin.'">';
echo '<input type="hidden" name="fecha_hasta_LiveJasmin" id="fecha_hasta_LiveJasmin" value="'.$fecha_hasta_LiveJasmin.'">';

$sql1 = "SELECT * FROM modelos_cuentas WHERE id_paginas = 9 and estatus = 'Aprobada'";
$registro1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($registro1)) {
    $usuario_LiveJasmin = $row1['usuario'];
    $clave_LiveJasmin = $row1['clave'];
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
        
        $sql4 = "SELECT * FROM chaturbate WHERE nickname = '".$nickname_modelo_chaturbate."' and tokens >= 1 and fecha BETWEEN  '".$fecha_desde_LiveJasmin."' AND  '".$fecha_hasta_LiveJasmin."'";
        $registro4 = mysqli_query($conexion,$sql4);
        while($row4 = mysqli_fetch_array($registro4)) {
            $contador1 = $contador1 + 1;
        }
    }

    if($contador1>=1){
        $sql6 = "SELECT * FROM livejasmin WHERE id_modelo = ".$row1['id_modelos']." and fecha_desde BETWEEN  '".$fecha_desde_LiveJasmin."' AND  '".$fecha_hasta_LiveJasmin."' and fecha_hasta BETWEEN  '".$fecha_desde_LiveJasmin."' AND  '".$fecha_hasta_LiveJasmin."' LIMIT 1";
        $registro6 = mysqli_query($conexion,$sql6);
        $contador2 = mysqli_num_rows($registro6);

        if($contador2==0){
            echo '
                <tr>
                    <td>'.$nombre_modelo.'</td>
                    <td>'.$usuario_LiveJasmin.'</td>
                    <td>'.$clave_LiveJasmin.'</td>
                    <td>
                        <input type="number" class="form-control" name="dolares_livejasmin_'.$row1["id_modelos"].'" id="dolares_livejasmin_'.$row1["id_modelos"].'">
                    </td>
                    <td>
                        <button type="button" class="btn btn-success" onclick="guardarToken_livejasmin('.$row1["id_modelos"].');">Guardar</button>
                    </td>
                </tr>
            ';
        }else{
            while($row6 = mysqli_fetch_array($registro6)) {
                echo '
                    <tr>
                        <td>'.$nombre_modelo.'</td>
                        <td>'.$usuario_LiveJasmin.'</td>
                        <td>'.$clave_LiveJasmin.'</td>
                        <td>
                            <input type="number" class="form-control" name="dolares_livejasmin_'.$row1["id_modelos"].'" id="dolares_livejasmin_'.$row1["id_modelos"].'" value="'.$row6["dolares"].'">
                        </td>
                        <td>
                            <button type="button" class="btn btn-success" onclick="guardarToken_livejasmin('.$row1["id_modelos"].');">Guardar</button>
                        </td>
                    </tr>
                ';   
            }
        }
        
    }

}



?>