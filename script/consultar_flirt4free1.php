<?php

session_start();

include('conexion.php');

$fecha_inicio = date('Y-m-d');

$recorte_Flirt4free = $_POST['recorte_Flirt4free'];

$mes_Flirt4free = $_POST['mes_Flirt4free'];

$year_Flirt4free = $_POST['year_Flirt4free'];



if($recorte_Flirt4free==1){

    $fecha_desde_Flirt4free = $year_Flirt4free."-".$mes_Flirt4free."-"."01";

    $fecha_hasta_Flirt4free = $year_Flirt4free."-".$mes_Flirt4free."-"."15";

}else{

    $fecha_desde_Flirt4free = $year_Flirt4free."-".$mes_Flirt4free."-"."16";

    $fecha_hasta_Flirt4free = $year_Flirt4free."-".$mes_Flirt4free."-"."31";

}



echo '<input type="hidden" name="fecha_desde_Flirt4free" id="fecha_desde_Flirt4free" value="'.$fecha_desde_Flirt4free.'">';

echo '<input type="hidden" name="fecha_hasta_Flirt4free" id="fecha_hasta_Flirt4free" value="'.$fecha_hasta_Flirt4free.'">';



$sql1 = "SELECT * FROM modelos_cuentas WHERE id_paginas = 8 and estatus = 'Aprobada'";

$registro1 = mysqli_query($conexion,$sql1);

while($row1 = mysqli_fetch_array($registro1)) {

    $usuario_Flirt4free = $row1['usuario'];

    $clave_Flirt4free = $row1['clave'];

    $contador1 = 0;

    $sql2 = "SELECT * FROM modelos WHERE id = ".$row1['id_modelos'];

    $registro2 = mysqli_query($conexion,$sql2);

    while($row2 = mysqli_fetch_array($registro2)) {

        $nombre_modelo = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];

    }


    $sql6 = "SELECT * FROM flirt4free WHERE id_modelo = ".$row1['id_modelos']." and fecha_desde BETWEEN  '".$fecha_desde_Flirt4free."' AND  '".$fecha_hasta_Flirt4free."' and fecha_hasta BETWEEN  '".$fecha_desde_Flirt4free."' AND  '".$fecha_hasta_Flirt4free."' LIMIT 1";
    $registro6 = mysqli_query($conexion,$sql6);
    $contador2 = mysqli_num_rows($registro6);

    if($contador2==0){

            echo '

                <tr>

                    <td>'.$nombre_modelo.'</td>

                    <td>'.$usuario_Flirt4free.'</td>

                    <td>'.$clave_Flirt4free.'</td>

                    <td>

                        <input type="number" class="form-control" name="dolares_flirt4free_'.$row1["id_modelos"].'" id="dolares_flirt4free_'.$row1["id_modelos"].'">

                    </td>

                    <td>

                        <button type="button" class="btn btn-success" onclick="guardarToken_flirt4free('.$row1["id_modelos"].');">Guardar</button>

                    </td>

                </tr>

            ';

        }else{

            while($row6 = mysqli_fetch_array($registro6)) {

                echo '

                    <tr>

                        <td>'.$nombre_modelo.'</td>

                        <td>'.$usuario_Flirt4free.'</td>

                        <td>'.$clave_Flirt4free.'</td>

                        <td>

                            <input type="number" class="form-control" name="dolares_flirt4free_'.$row1["id_modelos"].'" id="dolares_flirt4free_'.$row1["id_modelos"].'" value="'.$row6["dolares"].'">

                        </td>

                        <td>

                            <button type="button" class="btn btn-success" onclick="guardarToken_flirt4free('.$row1["id_modelos"].');">Guardar</button>

                        </td>

                    </tr>

                ';   

            }

        }

        

    }




?>