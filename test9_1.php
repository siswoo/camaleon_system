<?php

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

    $imagefile = 'upload/img1.jpg';
    $imagen = getimagesize($imagefile);
    $ancho = $imagen[0];
    $alto = $imagen[1];

    if($ancho>$alto){
        $imagen_optimizada = redimensionar_imagen('upload/img1.jpg','upload/img1.jpg',1920,1080);
        imagejpeg($imagen_optimizada, "upload/imagen_optimizada.jpg");
    }else if($ancho<$alto){
        $imagen_optimizada = redimensionar_imagen('upload/img1.jpg','upload/img1.jpg',1080,1920);
        imagejpeg($imagen_optimizada, "upload/imagen_optimizada.jpg");
    }else{
        $imagen_optimizada = redimensionar_imagen('upload/img1.jpg','upload/img1.jpg',1080,1080);
        imagejpeg($imagen_optimizada, "upload/imagen_optimizada.jpg");
    }


exit;
/*************FUNCIONES*************/

/**********VERIFICACION*************/
function icreate($filename){
    $isize = getimagesize($filename);
    if ($isize['mime']=='image/jpeg')
    return imagecreatefromjpeg($filename);
    elseif ($isize['mime']=='image/png')
    return imagecreatefrompng($filename);
}
/***********************************/

/*************ANCHO*****************/
function resizeAspectW($image, $width){
    $aspect = imagesx($image) / imagesy($image);
    $height = $width / $aspect;
    $new = imageCreateTrueColor($width, $height);

    imagecopyresampled($new, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image));
    return $new;
}
/***********************************/

/*************ALTO*****************/
function resizeAspectH($image, $height){
    $aspect = imagesx($image) / imagesy($image);
    $width = $height * $aspect;
    $new = imageCreateTrueColor($width, $height);

    imagecopyresampled($new, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image));
    return $new;
}
/***********************************/

/***********************************/

$imagefile = 'upload/img1.jpg';

$imagen = getimagesize($imagefile);
$ancho = $imagen[0];
$alto = $imagen[1];

if($ancho>$alto){
    $imgh = icreate($imagefile);
    $imgr = resizeAspectH($imgh, 1920);
    //header('Content-type: image/jpeg');
    //imagejpeg($imgr);
    $location = "upload/convertido.jpg";
    move_uploaded_file($imgr,$location);
    //echo $imgr;
    //echo 'Es mas Ancho';
}else if($ancho<$alto){
    echo 'Es mas Alto';
}else{
    echo 'Es Cuadrado';
}

//echo "Ancho: ".$ancho;
//echo "<p></p> Alto: ".$alto;
exit;

/*
function icreate($filename)
{
  $isize = getimagesize($filename);
  if ($isize['mime']=='image/jpeg')
    return imagecreatefromjpeg($filename);
  elseif ($isize['mime']=='image/png')
    return imagecreatefrompng($filename);
}

function resizeAspectW($image, $width)
{
  $aspect = imagesx($image) / imagesy($image);
  $height = $width / $aspect;
  $new = imageCreateTrueColor($width, $height);

  imagecopyresampled($new, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image));
  return $new;
}

function resizeAspectH($image, $height){
  $aspect = imagesx($image) / imagesy($image);
  $width = $height * $aspect;
  $new = imageCreateTrueColor($width, $height);

  imagecopyresampled($new, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image));
  return $new;
}

$imgh = icreate($imagefile);
$imgr = resizeAspectH($imgh, 1920);

header('Content-type: image/jpeg');
imagejpeg($imgr);
*/
exit;
?>

<?php
/* 
 * Función personalizada para comprimir y 
 * subir una imagen mediante PHP
 */ 
function compressImage($source, $destination, $quality) { 
    // Obtenemos la información de la imagen
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime']; 
     
    // Creamos una imagen
    switch($mime){ 
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($source); 
            break; 
        case 'image/png': 
            $image = imagecreatefrompng($source); 
            break; 
        case 'image/gif': 
            $image = imagecreatefromgif($source); 
            break; 
        default: 
            $image = imagecreatefromjpeg($source); 
    } 
     
    // Guardamos la imagen
    imagejpeg($image, $destination, $quality); 
     
    // Devolvemos la imagen comprimida
    return $destination; 
} 
 
 
// Ruta subida
$uploadPath = "upload/";
 
// Si el fichero se ha enviado
$status = $statusMsg = '';
if(isset($_POST["submit"])){
    $status = 'error';
    if(!empty($_FILES["image"]["name"])) { 
        // File info 
        $fileName = basename($_FILES["image"]["name"]); 
        $imageUploadPath = $uploadPath . $fileName; 
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 

        // Permitimos solo unas extensiones
        $allowTypes = array('jpg','png','jpeg','gif');
        if(in_array($fileType, $allowTypes)){ 
            // Image temp source 
            $imageTemp = $_FILES["image"]["tmp_name"];

            // Comprimos el fichero
            $compressedImage = compressImage($imageTemp, $imageUploadPath, 75); 

            if($compressedImage){
                $status = 'success'; 
                $statusMsg = "La imagen se ha subido satisfactoriamente."; 
            }else{ 
                $statusMsg = "La compresion de la imagen ha fallado"; 
            } 
        }else{ 
            $statusMsg = 'Lo sentimos, solo se permiten imágenes con estas extensiones: JPG, JPEG, PNG, & GIF.'; 
        } 
    }else{ 
        $statusMsg = 'Por favor, selecciona una imagen.'; 
    } 
} 
 
// Mostrar el estado de la imagen 
echo $statusMsg; 
?>