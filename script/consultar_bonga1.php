<?php

session_start();

include('conexion.php');

$fecha_inicio = date('Y-m-d');

$recorte_Bonga = $_POST['recorte_Bonga'];

$mes_Bonga = $_POST['mes_Bonga'];

$year_Bonga = $_POST['year_Bonga'];



if($recorte_Bonga==1){

    $fecha_desde_Bonga = $year_Bonga."-".$mes_Bonga."-"."01";

    $fecha_hasta_Bonga = $year_Bonga."-".$mes_Bonga."-"."15";

}else{

    $fecha_desde_Bonga = $year_Bonga."-".$mes_Bonga."-"."16";

    $fecha_hasta_Bonga = $year_Bonga."-".$mes_Bonga."-"."31";

}



echo '<input type="hidden" name="fecha_desde_Bonga" id="fecha_desde_Bonga" value="'.$fecha_desde_Bonga.'">';

echo '<input type="hidden" name="fecha_hasta_Bonga" id="fecha_hasta_Bonga" value="'.$fecha_hasta_Bonga.'">';



$sql1 = "SELECT * FROM modelos_cuentas WHERE id_paginas = 4 and estatus = 'Aprobada'";

$registro1 = mysqli_query($conexion,$sql1);

while($row1 = mysqli_fetch_array($registro1)) {

    $usuario_Bonga = $row1['usuario'];

    $clave_Bonga = $row1['clave'];

    $contador1 = 0;

    $sql2 = "SELECT * FROM modelos WHERE id = ".$row1['id_modelos'];

    $registro2 = mysqli_query($conexion,$sql2);

    while($row2 = mysqli_fetch_array($registro2)) {

        $nombre_modelo = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];

    }




        $sql6 = "SELECT * FROM bonga WHERE id_modelo = ".$row1['id_modelos']." and fecha_desde BETWEEN  '".$fecha_desde_Bonga."' AND  '".$fecha_hasta_Bonga."' and fecha_hasta BETWEEN  '".$fecha_desde_Bonga."' AND  '".$fecha_hasta_Bonga."' LIMIT 1";

        $registro6 = mysqli_query($conexion,$sql6);

        $contador2 = mysqli_num_rows($registro6);



        if($contador2==0){

            echo '

                <tr>

                    <td>'.$nombre_modelo.'</td>

                    <td>'.$usuario_Bonga.'</td>

                    <td>'.$clave_Bonga.'</td>

                    <td>

                        <input type="number" class="form-control" name="dolares_bonga_'.$row1["id_modelos"].'" id="dolares_bonga_'.$row1["id_modelos"].'">

                    </td>

                    <td>

                        <button type="button" class="btn btn-success" onclick="guardarToken_bonga('.$row1["id_modelos"].');">Guardar</button>

                    </td>

                </tr>

            ';

        }else{

            while($row6 = mysqli_fetch_array($registro6)) {

                echo '

                    <tr>

                        <td>'.$nombre_modelo.'</td>

                        <td>'.$usuario_Bonga.'</td>

                        <td>'.$clave_Bonga.'</td>

                        <td>

                            <input type="number" class="form-control" name="dolares_bonga_'.$row1["id_modelos"].'" id="dolares_bonga_'.$row1["id_modelos"].'" value="'.$row6["dolares"].'">

                        </td>

                        <td>

                            <button type="button" class="btn btn-success" onclick="guardarToken_bonga('.$row1["id_modelos"].');">Guardar</button>

                        </td>

                    </tr>

                ';   

            }

        }

        





}







?>