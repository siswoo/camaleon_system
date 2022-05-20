<?php
session_start();
include('conexion.php');
$fecha_inicio = date('Y-m-d');
$recorte = $_POST['recorte'];
$mes = $_POST['mes'];
$year = $_POST['year'];

if($recorte==1){

    $fecha_desde = $year."-".$mes."-"."01";
    $fecha_hasta = $year."-".$mes."-"."15";
}else{

    $fecha_desde = $year."-".$mes."-"."16";
    $fecha_hasta = $year."-".$mes."-"."31";
}

echo '<input type="hidden" name="fecha_desde" id="fecha_desde_streamray" value="'.$fecha_desde.'">';
echo '<input type="hidden" name="fecha_hasta" id="fecha_hasta_streamray" value="'.$fecha_hasta.'">';

$sql1 = "SELECT * FROM modelos_cuentas WHERE id_paginas = 13 and estatus = 'Aprobada'";
$registro1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($registro1)) {
    $usuario = $row1['usuario'];
    $clave = $row1['clave'];
    $contador1 = 0;
    $sql2 = "SELECT * FROM modelos WHERE id = ".$row1['id_modelos'];
    $registro2 = mysqli_query($conexion,$sql2);

    while($row2 = mysqli_fetch_array($registro2)) {
        $nombre_modelo = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
    }


    $sql6 = "SELECT * FROM streamray WHERE id_modelo = ".$row1['id_modelos']." and fecha_desde BETWEEN  '".$fecha_desde."' AND  '".$fecha_hasta."' and fecha_hasta BETWEEN  '".$fecha_desde."' AND  '".$fecha_hasta."' LIMIT 1";
    $registro6 = mysqli_query($conexion,$sql6);
    $contador2 = mysqli_num_rows($registro6);

    if($contador2==0){
        echo '
            <tr>
                <td>'.$nombre_modelo.'</td>
                    <td>'.$usuario.'</td>
                    <td>'.$clave.'</td>
                    <td>
                        <input type="number" class="form-control" name="dolares_streamray_'.$row1["id_modelos"].'" id="dolares_streamray_'.$row1["id_modelos"].'">
                    </td>
                    <td>
                        <button type="button" class="btn btn-success" onclick="guardarToken_streamray('.$row1["id_modelos"].');">Guardar</button>
                    </td>
                </tr>
            ';
        }else{
            while($row6 = mysqli_fetch_array($registro6)) {
                echo '
                    <tr>
                        <td>'.$nombre_modelo.'</td>
                        <td>'.$usuario.'</td>
                        <td>'.$clave.'</td>
                        <td>
                            <input type="number" class="form-control" name="dolares_streamray_'.$row1["id_modelos"].'" id="dolares_streamray_'.$row1["id_modelos"].'" value="'.$row6["dolares"].'">
                        </td>
                        <td>
                            <button type="button" class="btn btn-success" onclick="guardarToken_streamray('.$row1["id_modelos"].');">Guardar</button>
                        </td>
                    </tr>
                ';   
            }
        }
}
?>