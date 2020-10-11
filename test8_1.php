<?php
session_start();
include('script/conexion.php');
//echo $_SESSION['rol'];
$sesion_usuario = $_SESSION['usuario'];

$sql1 = "SELECT * FROM modelos WHERE usuario = '".$sesion_usuario."'";
$consulta1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($consulta1)) {
    $modelo_id = $row1['id'];
}

if(file_exists('resources/documentos/modelos/archivos')){}else{
    mkdir('resources/documentos/modelos/archivos/'.$modelo_id, 0777);
}

/***************FUNCIONES****************/
function redimensionar_imagen($nombreimg, $rutaimg, $xmax, $ymax){
    $ext = explode(".", $nombreimg);
    $ext = $ext[count($ext)-1];
      
    if($ext == "jpg" || $ext == "jpeg")  
        $imagen = imagecreatefromjpeg($rutaimg);
    elseif($ext == "png")  
        $imagen = imagecreatefrompng($rutaimg);  
    elseif($ext == "gif")  
        $imagen = imagecreatefromgif($rutaimg);  
          
    $x = imagesx($imagen);  
    $y = imagesy($imagen);  
          
    if($x <= $xmax && $y <= $ymax){
        echo "<center>Esta imagen ya esta optimizada para los maximos que deseas.<center>";
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
    echo "<center>La imagen se ha optimizado correctamente.</center>";
    return $img2;
}
/*******************************************/
$imagen_temporal = $_FILES['file']['tmp_name'];
//$location = "resources/documentos/modelos/archivos/".$modelo_id."/firmas2.jpg";
$location = "resources/documentos/modelos/archivos/".$modelo_id."/";
$imagen_nombre = $_FILES['file']['name'];
//$imagen = getimagesize($imagefile);
$imagen = getimagesize($_FILES['file']['tmp_name']);
$ancho = $imagen[0];
$alto = $imagen[1];

if($ancho>$alto){
    $imagen_optimizada = redimensionar_imagen($imagen_nombre,$imagen_temporal,1920,1080);
    imagejpeg($imagen_optimizada, $location.$modelo_id.'.jpg');
}else if($ancho<$alto){
    $imagen_optimizada = redimensionar_imagen($imagen_nombre,$imagen_temporal,1080,1920);
    imagejpeg($imagen_optimizada, $location.$modelo_id.'.jpg');
}else{
    $imagen_optimizada = redimensionar_imagen($imagen_nombre,$imagen_temporal,1080,1080);
    imagejpeg($imagen_optimizada, $location.$modelo_id.'.jpg');
}

//move_uploaded_file($_FILES['file']['tmp_name'],$location.$imagen_nombre);

exit;

$filename = $_FILES['file']['name'];
$location = "resources/documentos/modelos/archivos/".$modelo_id."/firmas1.jpg";
$uploadOk = 1;
$imageFileType = pathinfo($location,PATHINFO_EXTENSION);

/* Valid Extensions */
$valid_extensions = array("jpg","jpeg","png");
/* Check file extension */
if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
   $uploadOk = 0;
}

if($uploadOk == 0){
   echo 0;
}else{
   /* Upload file */
   if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
      //echo $location;
   }else{
      //echo 0;
   }
}

$imagedata = file_get_contents("resources/documentos/modelos/archivos/".$modelo_id."/firmas1.png");
// alternatively specify an URL, if PHP settings allow
$base64 = base64_encode($imagedata);

$file = fopen("resources/documentos/modelos/archivos/".$modelo_id."/firmas1.txt", "w");
fwrite($file, $base64 . PHP_EOL);
//fwrite($file, "Esto es una nueva linea de texto" . PHP_EOL);
//fwrite($file, "Otra más" . PHP_EOL);
fclose($file);

?>