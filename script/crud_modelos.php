<?php

session_start();

include('conexion.php');

$responsable = $_SESSION["id"];

$condicion = $_POST['condicion'];

$fecha_inicio = date("Y-m-d");



if($condicion=='cambiar_clave1'){

	$usuario = $_POST['usuario'];

	$password1 = md5($_POST['password1']);

	$password2 = md5($_POST['password2']);



	$sql1 = "UPDATE usuarios SET clave = '".$password1."' WHERE usuario = '".$usuario."'";

	$actualizar1 = mysqli_query($conexion,$sql1);



	$datos = [

		"sql" 		=> $sql1,

	];

	echo json_encode($datos);

}



if($condicion=='subir_archivo1'){
	$id = $_POST['id'];
	$condicion2 = $_POST['condicion2'];
	$condicion3 = $_POST['condicion3'];
	$banco_cedula = $_POST['banco_cedula'];
	$banco_nombre = $_POST['banco_nombre'];
	$banco_tipo = $_POST['banco_tipo'];
	$banco_numero = $_POST['banco_numero'];
	$banco_banco = $_POST['banco_banco'];
	$bcpp = $_POST['bcpp'];
	$banco_tipo_documento = $_POST['banco_tipo_documento'];

	if(file_exists('../resources/documentos/modelos/archivos/'.$id)){}else{
    	mkdir('../resources/documentos/modelos/archivos/'.$id, 0777);
	}

	if(@$_FILES['file']!=null and $bcpp=="Prestada"){
		$imagen_temporal = $_FILES['file']['tmp_name'];
		$location = "../resources/documentos/modelos/archivos/".$id."/";
		$imagen_nombre = $_FILES['file']['name'];
		$imagen = getimagesize($_FILES['file']['tmp_name']);
		$ancho = $imagen[0];
		$alto = $imagen[1];
		$extension = explode(".", $imagen_nombre);
		$extension = $extension[count($extension)-1];
		
		if($extension!='jpg' and $extension!='jpeg' and $extension!='png' and $extension!='JPG' and $extension!='JPEG' and $extension!='PNG'){
		    $datos = [
				"estatus" => 'error',
			];
			echo json_encode($datos);
	        exit;
		}else{
			$extension='jpg';
		}

		$sql4 = "SELECT * FROM documentos WHERE nombre = '".$condicion2."'";
		$proceso4 = mysqli_query($conexion,$sql4);
		while($row4 = mysqli_fetch_array($proceso4)) {
			$documento_id = $row4['id'];
		}

		$sql3 = "DELETE FROM modelos_documentos WHERE id_documentos = ".$documento_id." and id_modelos = ".$id;
		$eliminar1 = mysqli_query($conexion,$sql3);

		$sql2 = "INSERT INTO modelos_documentos (id_documentos,id_modelos,tipo,estatus,fecha_inicio) VALUES ('$documento_id','$id','$extension','Pendiente','$fecha_inicio')";
		$registro1 = mysqli_query($conexion,$sql2);
	}

	$sql3 = "UPDATE modelos SET banco_cedula = '$banco_cedula', banco_nombre = '$banco_nombre', banco_tipo = '$banco_tipo', banco_numero = '$banco_numero', banco_banco = '$banco_banco', BCPP = '$bcpp', banco_tipo_documento = '$banco_tipo_documento' WHERE id = ".$id;
	$proceso3 = mysqli_query($conexion,$sql3);

	move_uploaded_file($imagen_temporal,$location.$condicion3.".".$extension);

	$datos = [
		"estatus" => 'ok',
		"sql2" => $sql2,
		"sql3" => $sql3,
	];



	echo json_encode($datos);

}



if($condicion=='soporte_subir1'){

	$id = $_POST['id'];

	$condicion2 = $_POST['condicion2'];



	if(file_exists('../resources/documentos/modelos/archivos/'.$id)){}else{

    	mkdir('../resources/documentos/modelos/archivos/'.$id, 0777);

	}



	function redimensionar_imagen($nombreimg, $rutaimg, $xmax, $ymax){

	    $ext = explode(".", $nombreimg);

	    $ext = $ext[count($ext)-1];



	    if($ext!="jpg" && $ext!="jpeg" && $ext!="png" && $ext!="gif" && $ext!="PNG"){

	        $datos = [

				"estatus" => 'error',

			];

			echo json_encode($datos);

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

	    return $img2;

	}



	$imagen_temporal = $_FILES['file']['tmp_name'];

	$location = "../resources/documentos/modelos/archivos/".$id."/";

	$imagen_nombre = $_FILES['file']['name'];

	$imagen = getimagesize($_FILES['file']['tmp_name']);

	$ancho = $imagen[0];

	$alto = $imagen[1];

	$extension = explode(".", $imagen_nombre);

	$extension = $extension[count($extension)-1];



	$sql4 = "SELECT * FROM documentos WHERE nombre = '".$condicion2."'";

	$proceso4 = mysqli_query($conexion,$sql4);

	while($row4 = mysqli_fetch_array($proceso4)) {

		$documento_id = $row4['id'];

		$condicion3 = $row4['ruta'];

	}



	if($ancho>$alto){

		$imagen_optimizada = redimensionar_imagen($imagen_nombre,$imagen_temporal,1920,1080);

 	   	imagejpeg($imagen_optimizada, $location.$condicion3.'.jpg');

	}else if($ancho<$alto){

		$imagen_optimizada = redimensionar_imagen($imagen_nombre,$imagen_temporal,1080,1920);

		imagejpeg($imagen_optimizada, $location.$condicion3.'.jpg');

	}else{

		$imagen_optimizada = redimensionar_imagen($imagen_nombre,$imagen_temporal,1080,1080);

		imagejpeg($imagen_optimizada, $location.$condicion3.'.jpg');

	}



	if($extension=='jpg'){}else{

		$extension='jpg';

	}



	@unlink($location.$condicion3.".".$extension);

    @unlink($location.$condicion3.".".$extension);

    move_uploaded_file ($_FILES['file']['tmp_name'],$location.$condicion3.".".$extension);



	$sql3 = "DELETE FROM modelos_documentos WHERE id_documentos = ".$documento_id." and id_modelos = ".$id;

	$eliminar1 = mysqli_query($conexion,$sql3);



	$sql2 = "INSERT INTO modelos_documentos (id_documentos,id_modelos,tipo,estatus,fecha_inicio) VALUES ('$documento_id','$id','$extension','Pendiente','$fecha_inicio')";

	$registro1 = mysqli_query($conexion,$sql2);



	$datos = [

		"estatus" => 'ok',

		"sql3" => $sql2,

	];



	echo json_encode($datos);

}



?>