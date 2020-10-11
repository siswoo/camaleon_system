


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="resources/signature/docs/css/signature-pad.css">
	<link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/validaciones.css">
</head>
<body style='text-align:center; font-family: Helvetica Neue,Helvetica,Arial,sans-serif;'>
	<!--
	<div class="row">
		<div class="col-12 text-center">
			<?php include('resources/signature/docs/index.php'); ?>
		</div>
	</div>
	-->
	<?php include('resources/signature/docs/index.php'); ?>
</body>
</html>

<script src="resources/signature/docs/js/signature_pad.umd.js"></script>
<script src="resources/signature/docs/js/app.js"></script>








<?php exit; ?>



<?php
//Datos que se quieren firmar:
$datos = 'Este texto será firmado. Thanks for your attention :)';
//Se deben crear dos claves aparejadas, una clave pública y otra privada
//A continuación el array de configuración para la creación del juego de claves
$configArgs = array(
    'config' => 'C:\xampp\php\extras\openssl\openssl.cnf', //<-- esta ruta es necesaria si trabajas con XAMPP
    'private_key_bits' => 2048,
    'private_key_type' => OPENSSL_KEYTYPE_RSA
);
$resourceNewKeyPair = openssl_pkey_new($configArgs);
if (!$resourceNewKeyPair) {
    echo 'Puede que tengas problemas con la ruta indicada en el array de configuración "$configArgs" ';
    echo openssl_error_string(); //en el caso que la función anterior de openssl arrojará algun error, este sería visualizado gracias a esta línea
    exit;
}
//obtengo del recurso $resourceNewKeyPair la clave publica como un string 
$details = openssl_pkey_get_details($resourceNewKeyPair);
$publicKeyPem = $details['key'];
//obtengo la clave privada como string dentro de la variable $privateKeyPem (la cual es pasada por referencia)
if (!openssl_pkey_export($resourceNewKeyPair, $privateKeyPem, NULL, $configArgs)) {
    echo openssl_error_string(); //en el caso que la función anterior de openssl arrojará algun error, este sería visualizado gracias a esta línea
    exit;
}
//guardo la clave publica y privada en disco:
file_put_contents('private_key.pem', $privateKeyPem);
file_put_contents('public_key.pem', $publicKeyPem);
//si bien ya tengo cargado el string de la clave privada, lo voy a buscar a disco para verificar que el archivo private_key.pem haya sido correctamente generado:
$privateKeyPem = file_get_contents('private_key.pem');
//obtengo la clave privada como resource desde el string
$resourcePrivateKey = openssl_get_privatekey($privateKeyPem);
//crear la firma dentro de la variable $firma (la cual es pasada por referencia)
if (!openssl_sign($datos, $firma, $resourcePrivateKey, OPENSSL_ALGO_SHA256)) {
    echo openssl_error_string(); //en el caso que la función anterior de openssl arrojará algun error, este sería visualizado gracias a esta línea
    exit;
}
// guardar la firma en disco:
file_put_contents('signature.dat', $firma);
// comprobar la firma
if (openssl_verify($datos, $firma, $publicKeyPem, 'sha256WithRSAEncryption') === 1) {
    echo 'la firma es valida y los datos son confiables';
} else {
    echo 'la firma es invalida y/o los datos fueron alterados';
}
?>


<?php exit; ?>





<!--
<html>
<head>
  <script type="text/javascript">
    window.mifiel=window.mifiel||[],function(){"use strict";for(var e=["widget"],i=function(e){return function(){window.mifiel.push([e].concat(Array.prototype.slice.call(arguments,0)))}},t=0;t<e.length;t++){var n=e[t];window.mifiel[n]||(window.mifiel[n]=i(n))}if(!document.getElementById("mifiel-js")){var r=document.createElement("script"),o=document.getElementsByTagName("script")[0];r.type="text/javascript",r.id="mifiel-js",r.async=!0,r.src="https://sandbox.mifiel.com/sign-widget-v1.0.0.js",o.parentNode.insertBefore(r,o)}}();
  </script>
</head>
<body>
  <div id="mifiel-widget"></div>
  <script type="text/javascript">
    window.mifiel.widget({
      widgetId: '3fa8a920-f0e8-452c-9097-020d356a95de',
      appendTo: 'mifiel-widget',
      successBtnText: 'Proceed to next step'
    });
  </script>
</body>
</html>
-->



<?php exit; ?>












<?php

$micarpeta = 'resources/documentos/modelos/carpeta';
if (!file_exists($micarpeta)) {
    mkdir($micarpeta, 0777, true);
}

exit;
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style='text-align:center; font-family: Helvetica Neue,Helvetica,Arial,sans-serif;'>
	<div style="text-align:center;">
		<img src='https://i.imgur.com/gcJh9ip.png'>
	</div>
	<div>
		<a href="https://link2">
		<img style="z-index: 99; position: absolute; top: 695px; left: 700px;" src='https://i.imgur.com/qoOKgKT.png'>
		</a>
	</div>
	<div>
		<a href="https://link3">
		<img style="z-index: 99; position: absolute; top: 695px; left: 890px;" src='https://i.imgur.com/zHkSPLt.png'>
		</a>
	</div>
	<div>
		<a href="https://link4">
		<img style="z-index: 99; position: absolute; top: 695px; left: 1085px;" src='https://i.imgur.com/91A8C9j.png'>
		</a>
	</div>
	<div>
		<a href="https://link1">
		<img style="z-index: 99; position: absolute; top: 612px; left: 688px;" src='https://i.imgur.com/vDwAkXq.png'>
		</a>
	</div>
</body>
</html>