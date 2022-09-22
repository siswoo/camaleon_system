<?php
/**********************************/
/*************EXTRAS***************/
/**********************************/
session_start();
include('../script/conexion.php');
$fecha_inicio = date('Y-m-d');
$id_documentos = $_POST['id_documentos'];
$id_modelos = $_POST['id_modelos'];
$imagen_temporal = $_FILES['file']['tmp_name'];
$imagen_nombre = $_FILES['file']['name'];

if(file_exists('../resources/documentos/modelos/archivos/'.$id_modelos)){}else{
    mkdir('../resources/documentos/modelos/archivos/'.$id_modelos, 0777);
}

/***************FUNCIONES****************/
function redimensionar_imagen($nombreimg, $rutaimg, $xmax, $ymax){
    $ext = explode(".", $nombreimg);
    $ext = $ext[count($ext)-1];

    if($ext!="jpg" && $ext!="jpeg" && $ext!="png"){
        echo 'error';
        exit;
    }

    if($ext == "jpg" || $ext == "jpeg")  
        $imagen = imagecreatefromjpeg($rutaimg);
    elseif($ext == "png")  
        $imagen = imagecreatefrompng($rutaimg);

    $x = imagesx($imagen);  
    $y = imagesy($imagen);  
          
    if($x <= $xmax && $y <= $ymax){
        //echo "<center>Esta imagen ya esta optimizada para los maximos que deseas.<center>";
        return $imagen;  
    }
      
    if($x >= $y) {  
        $nuevax = $xmax;  
        $nuevay = $nuevax * $y / $x;  
    }  
    else {  
        $nuevay = $ymax;  
        $nuevax = $x / $y * $nuevay;  
    }  

    $img2 = imagecreatetruecolor($nuevax, $nuevay);
    imagecopyresized($img2, $imagen, 0, 0, 0, 0, floor($nuevax), floor($nuevay), $x, $y);
    //echo "<center>La imagen se ha optimizado correctamente.</center>";
    return $img2;
}
/*******************************************/

if($id_documentos==2){
    $location = "../resources/documentos/modelos/archivos/".$id_modelos."/documento_identidad.jpg";
}else if($id_documentos==8){
    $location = "../resources/documentos/modelos/archivos/".$id_modelos."/foto_cedula_con_cara.jpg";
}else if($id_documentos==9){
    $location = "../resources/documentos/modelos/archivos/".$id_modelos."/foto_cedula_parte_frontal_cara.jpg";
}else if($id_documentos==10){
    $location = "../resources/documentos/modelos/archivos/".$id_modelos."/foto_cedula_parte_respaldo.jpg";
}else if($id_documentos==12){
    $imagen_nombre = $_FILES['file']['name'];
    $extension = explode(".", $imagen_nombre);
    $extension = $extension[count($extension)-1];
    if($extension=='pdf'){}else if($extension=='jpg'){}else{
        $extension='jpg';
    }

    $sql2 = "INSERT INTO modelos_documentos (id_documentos,id_modelos,tipo,fecha_inicio) VALUES ('$id_documentos','$id_modelos','$extension','$fecha_inicio')";
    $registro1 = mysqli_query($conexion,$sql2);
    $id_modelos_documentos = mysqli_insert_id($conexion);

    $location = "../resources/documentos/modelos/archivos/".$id_modelos."/extras_".$id_modelos_documentos.".jpg";
}else{
    echo 'error';
    exit;
}

$imagen_nombre = $_FILES['file']['name'];
$extension = explode(".", $imagen_nombre);
$extension = $extension[count($extension)-1];

if($extension == 'pdf'){
    @unlink($location);
    move_uploaded_file ($_FILES['file']['tmp_name'],$location);
}else{
    $imagen = getimagesize($_FILES['file']['tmp_name']);
    $ancho = $imagen[0];
    $alto = $imagen[1];

    if($ancho>$alto){
        //echo 'Mas ancho por Alto';
        $imagen_optimizada = redimensionar_imagen($imagen_nombre,$imagen_temporal,1920,1080);
        @unlink($location);
        imagejpeg($imagen_optimizada, $location);
    }else if($ancho<$alto){
        //echo 'Mas Alto por Ancho';
        $imagen_optimizada = redimensionar_imagen($imagen_nombre,$imagen_temporal,1080,1920);
        @unlink($location);
        imagejpeg($imagen_optimizada, $location);
    }else{
        //echo 'Cuadrado';
        $imagen_optimizada = redimensionar_imagen($imagen_nombre,$imagen_temporal,1080,1080);
        @unlink($location);
        imagejpeg($imagen_optimizada, $location);
    }
}

if($id_documentos!=12){
    $sql3 = "DELETE FROM modelos_documentos WHERE id_documentos = ".$id_documentos." and id_modelos = ".$id_modelos;
    $eliminar1 = mysqli_query($conexion,$sql3);

    if($extension=='pdf'){}else if($extension=='jpg'){}else{
        $extension='jpg';
    }

    $sql2 = "INSERT INTO modelos_documentos (id_documentos,id_modelos,tipo,fecha_inicio) VALUES ('$id_documentos','$id_modelos','$extension','$fecha_inicio')";
    $registro1 = mysqli_query($conexion,$sql2);
}


echo 'ok';

?>