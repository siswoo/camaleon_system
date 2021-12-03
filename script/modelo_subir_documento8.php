<?php
/**********************************************/
/************foto_cedula_con_cara**************/
/**********************************************/
session_start();
include('../script/conexion.php');
$fecha_inicio = date('Y-m-d');
$sesion_usuario = $_SESSION['usuario'];

$sql1 = "SELECT * FROM modelos WHERE usuario = '".$sesion_usuario."'";
$consulta1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($consulta1)) {
    $modelo_id = $row1['id'];
}

if(file_exists('../resources/documentos/modelos/archivos/'.$modelo_id)){}else{
    mkdir('../resources/documentos/modelos/archivos/'.$modelo_id, 0777);
}

/***************FUNCIONES****************/
function redimensionar_imagen($nombreimg, $rutaimg, $xmax, $ymax){
    $ext = explode(".", $nombreimg);
    $ext = $ext[count($ext)-1];

    if($ext!="jpg" && $ext!="jpeg" && $ext!="png" && $ext!="gif" && $ext!='pdf'){
        echo 'error';
        exit;
    }

    if($ext == "jpg" || $ext == "jpeg")  
        $imagen = imagecreatefromjpeg($rutaimg);
    elseif($ext == "png")  
        $imagen = imagecreatefrompng($rutaimg);
    elseif($ext == "gif")  
        $imagen = imagecreatefromgif($rutaimg);

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
$imagen_temporal = $_FILES['file']['tmp_name'];
$location = "../resources/documentos/modelos/archivos/".$modelo_id."/";
$imagen_nombre = $_FILES['file']['name'];
$extension = explode(".", $imagen_nombre);
$extension = $extension[count($extension)-1];

if($extension == 'pdf'){
    unlink($location.'foto_cedula_parte_frontal_cara.jpg');
    unlink($location.'foto_cedula_parte_frontal_cara.pdf');
    move_uploaded_file ($_FILES['file']['tmp_name'],$location.'foto_cedula_parte_frontal_cara.pdf');
}else{

    $imagen = getimagesize($_FILES['file']['tmp_name']);
    $ancho = $imagen[0];
    $alto = $imagen[1];

    if($ancho>$alto){
        $imagen_optimizada = redimensionar_imagen($imagen_nombre,$imagen_temporal,1920,1080);
        unlink($location.'foto_cedula_parte_frontal_cara.jpg');
        unlink($location.'foto_cedula_parte_frontal_cara.pdf');
        imagejpeg($imagen_optimizada, $location.'foto_cedula_parte_frontal_cara'.'.jpg');
    }else if($ancho<$alto){
        $imagen_optimizada = redimensionar_imagen($imagen_nombre,$imagen_temporal,1080,1920);
        unlink($location.'foto_cedula_parte_frontal_cara.jpg');
        unlink($location.'foto_cedula_parte_frontal_cara.pdf');
        imagejpeg($imagen_optimizada, $location.'foto_cedula_parte_frontal_cara'.'.jpg');
    }else{
        $imagen_optimizada = redimensionar_imagen($imagen_nombre,$imagen_temporal,1080,1080);
        unlink($location.'foto_cedula_parte_frontal_cara.jpg');
        unlink($location.'foto_cedula_parte_frontal_cara.pdf');
        imagejpeg($imagen_optimizada, $location.'foto_cedula_parte_frontal_cara'.'.jpg');
    }

}

$sql3 = "DELETE FROM modelos_documentos WHERE id_documentos = 9 and id_modelos = ".$modelo_id;
$eliminar1 = mysqli_query($conexion,$sql3);

if($extension=='pdf'){}else if($extension=='jpg'){}else{
    $extension='jpg';
}

$sql2 = "INSERT INTO modelos_documentos (id_documentos,id_modelos,tipo,fecha_inicio) VALUES (9,'$modelo_id','$extension','$fecha_inicio')";
$registro1 = mysqli_query($conexion,$sql2);

echo 'ok';

?>