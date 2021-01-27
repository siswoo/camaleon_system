<?php
include('script/conexion.php');

$sql1 = "SELECT * FROM usuarios WHERE documento_numero = 1000465600 or documento_numero = 1070708430 or documento_numero = 1006552299 or documento_numero = 1006719740 or documento_numero = 1007648020 or documento_numero = 1000136827 or documento_numero = 1072961962 or documento_numero = 1024584079 or documento_numero = 1000855308 or documento_numero = 1023937797 or documento_numero = 1233494502 or documento_numero = 1001341803 or documento_numero = 1010036606 or documento_numero = 1033812024 or documento_numero = 1022442122 or documento_numero = 1023969639 or documento_numero = 1000036288 or documento_numero = 1023917251 or documento_numero = 1116542252 or documento_numero = 1233509422 or documento_numero = 1012433860 or documento_numero = 1014289391 or documento_numero = 1193536457 or documento_numero = 1001284055 or documento_numero = 1023906419 or documento_numero = 1120575555 or documento_numero = 1012459937 or documento_numero = 1030579161 or documento_numero = 26324694 or documento_numero = 26768820 or documento_numero = 1000590098 or documento_numero = 1007703272 or documento_numero = 1016110439 or documento_numero = 1016107585 or documento_numero = 1078350270 or documento_numero = 1069757348 or documento_numero = 1010174242 or documento_numero = 1030660755 or documento_numero = 1003710897 or documento_numero = 1000228043 or documento_numero = 52885369 or documento_numero = 26113368 or documento_numero = 29809840 or documento_numero = 1031158272 or documento_numero = 1024575595 or documento_numero = 1000806828 or documento_numero = 1030582351 or documento_numero = 1000126308 or documento_numero = 1032511238 or documento_numero = 1001342877 or documento_numero = 1019154191 or documento_numero = 1143357529 or documento_numero = 1000350961 or documento_numero = 913108520091991 or documento_numero = 1000746550 or documento_numero = 1030642054 or documento_numero = 1003712511 or documento_numero = 1000348432 ORDER BY nombre ASC";
$consulta1 = mysqli_query($conexion,$sql1);
while($row1 = mysqli_fetch_array($consulta1)) {
	$documento_numero = $row1['documento_numero'];
	echo "".$usuario = $row1['usuario']."";
	echo '<br>';
	$md5 = md5($documento_numero);

	//$sql2 = "UPDATE usuarios SET clave = '".$md5."' WHERE documento_numero = '".$documento_numero."'";
	//$consulta2 = mysqli_query($conexion,$sql2);
}



?>