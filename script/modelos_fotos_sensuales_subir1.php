<?php
include('conexion.php');
$foto1 = $_FILES['foto1']['name'];
$foto2 = $_FILES['foto2']['name'];
$foto3 = $_FILES['foto3']['name'];
@$foto4 = $_FILES['foto4']['name'];
@$foto5 = $_FILES['foto5']['name'];
$id_modelos = $_POST['id_modelo'];
$fecha_inicio = date('Y-m-d');

if($foto1!=''){
	$extension = '';
	$extension = explode(".", $foto1);
	$extension = $extension[count($extension)-1];
	if($extension!='jpg' and $extension!='jpeg' and $extension!='png'){
		echo 'error';
		exit;
	}
}

if($foto2!=''){
	$extension = '';
	$extension = explode(".", $foto2);
	$extension = $extension[count($extension)-1];
	if($extension!='jpg' and $extension!='jpeg' and $extension!='png'){
		echo 'error';
		exit;
	}
}

if($foto3!=''){
	$extension = '';
	$extension = explode(".", $foto3);
	$extension = $extension[count($extension)-1];
	if($extension!='jpg' and $extension!='jpeg' and $extension!='png'){
		echo 'error';
		exit;
	}
}

if($foto4!=''){
	$extension = '';
	$extension = explode(".", $foto4);
	$extension = $extension[count($extension)-1];
	if($extension!='jpg' and $extension!='jpeg' and $extension!='png'){
		echo 'error';
		exit;
	}
}

if($foto5!=''){
	$extension = '';
	$extension = explode(".", $foto5);
	$extension = $extension[count($extension)-1];
	if($extension!='jpg' and $extension!='jpeg' and $extension!='png'){
		echo 'error';
		exit;
	}
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

for ($i=1;$i<=5;$i++) {
	if(@$_FILES['foto'.$i]['name']!=''){
		$imagen = getimagesize($_FILES['foto'.$i]['tmp_name']);
		$ancho = $imagen[0];
		$alto = $imagen[1];
		$foto_temporal = $_FILES['foto'.$i]['tmp_name'];

		$extension = explode(".", $_FILES['foto'.$i]['name']);
		$extension = $extension[count($extension)-1];
		$id_documentos = 13;
		$sql1 = "INSERT INTO modelos_documentos (id_documentos,id_modelos,tipo,fecha_inicio) VALUES ('$id_documentos','$id_modelos','$extension','$fecha_inicio')";
		$registro1 = mysqli_query($conexion,$sql1);
		$id_modelos_documentos = mysqli_insert_id($conexion);
		$location = "../resources/documentos/modelos/archivos/".$id_modelos."/sensuales_".$id_modelos_documentos.".jpg";
		if($ancho>$alto){
			$imagen_optimizada = redimensionar_imagen($_FILES['foto'.$i]['name'],$foto_temporal,1920,1080);
			@unlink($location);
			imagejpeg($imagen_optimizada, $location);
		}else if($ancho<$alto){
			$imagen_optimizada = redimensionar_imagen($_FILES['foto'.$i]['name'],$foto_temporal,1080,1920);
			@unlink($location);
			imagejpeg($imagen_optimizada, $location);
		}else{
			$imagen_optimizada = redimensionar_imagen($_FILES['foto'.$i]['name'],$foto_temporal,1080,1080);
			@unlink($location);
			imagejpeg($imagen_optimizada, $location);
		}
	}
}

echo 'ok';
exit;










$html='';
$sql1 = "SELECT * FROM modelos_cuentas WHERE id = ".$id;
$consulta1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($consulta1)) {
	$id_modelos_cuentas_id = $row1['id'];
	$id_modelos_cuentas_id_paginas = $row1['id_paginas'];
	$id_modelos_cuentas_usuario = $row1['usuario'];
	$id_modelos_cuentas_clave = $row1['clave'];
	$id_modelos_cuentas_correo = $row1['correo'];
	$id_modelos_cuentas_link = $row1['link'];
	$id_modelos_cuentas_estatus = $row1['estatus'];
	$id_modelos_cuentas_fecha_inicio = $row1['fecha_inicio'];

	if($id_modelos_cuentas_estatus=='Aprobada'){
		$html.='
			<p><hr style="background-color: white;"></p>
			<p>Usuario: '.$id_modelos_cuentas_usuario.'</p>
			<p>Clave: '.$id_modelos_cuentas_clave.'</p>
		';
		if($id_modelos_cuentas_correo!=''){
			$html.='
				<p>Correo: '.$id_modelos_cuentas_correo.'</p>
			';
		}

		if($id_modelos_cuentas_link!=''){
			$html.='
				<p>Link: <input type="text" class="form-control" value="'.$id_modelos_cuentas_link.'"></p>
			';
		}

		$html.='
			<p><hr style="background-color: white;"></p>
		';
	}

}

	$datos = [
		"html" 	=> $html,
	];

	echo json_encode($datos);
?>