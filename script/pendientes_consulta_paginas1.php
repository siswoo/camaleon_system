<?php
session_start();
include('conexion.php');
$fecha = date('Y-m-d');
$value = $_POST['value'];

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
                $id_modelos." ".$usuario_generado."";
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

//echo 'Correcto';

?>