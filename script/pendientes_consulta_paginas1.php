<?php
session_start();
include('conexion.php');
$fecha = date('Y-m-d');
$value = $_POST['value'];

$html1 = '
    <table border="1" class="table mt-3">
        <thead>
        <tr>
            <th>Modelo</th>
            <th>NickName</th>
            <th>Fecha Modelo</th>
        </tr>
        </thead>
';

switch ($value) {
    case '1':
        $sql1 = "SELECT * FROM modelos_cuentas WHERE id_paginas = ".$value." and estatus = 'Aprobada'";
        $consulta1 = mysqli_query($conexion,$sql1);
        while($row1 = mysqli_fetch_array($consulta1)) {
            $usuario_generado = $row1['usuario'];
            $id_modelos = $row1['id_modelos'];
            $sql2 = "SELECT * FROM chaturbate WHERE nickname = '$usuario_generado'";
            $consulta2 = mysqli_query($conexion,$sql2);
            $contador1 = mysqli_num_rows($consulta2);
            if($contador1==0){
                $sql3 = "SELECT * FROM modelos WHERE id = '$id_modelos'";
                $consulta3 = mysqli_query($conexion,$sql3);
                while($row2 = mysqli_fetch_array($consulta3)) {
                    $nombre_modelo = $row2['nombre1']." ".$row2['nombre2']." ".$row2['apellido1']." ".$row2['apellido2'];
                    $fecha_inicio = $row2['fecha_inicio'];
                }
                //echo $id_modelos." ".$usuario_generado."";

                $html1 .= '
                    <tr>
                        <td>'.$nombre_modelo.'</td>
                        <td>'.$usuario_generado.'</td>
                        <td>'.$fecha_inicio.'</td>
                    </tr>
                ';
            }
        }
    break;

    case '2':
        echo "Hola 2";
    break;

    default:
        echo 'Error';
    break;
}

$html1 .= '</table>';

echo $html1;

?>