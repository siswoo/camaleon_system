<?php
include('../script/conexion.php');

$inicio = '2020-11-16';
$fin = '2020-11-30';

$sede1_chaturbate = 0;
$sede1_bonga = 0;
$sede1_stripchat = 0;
$sede1_cam4 = 0;
$sede1_streamate = 0;
$sede1_camsoda = 0;
$sede1_imlive = 0;
$sede1_xlove = 0;
$sede1_myfreecams = 0;

$sql10 = "SELECT * FROM modelos WHERE estatus = 'Activa'";
$consulta10 = mysqli_query($conexion,$sql10);
while($row10 = mysqli_fetch_array($consulta10)) {
	$sede = $row10['sede'];
	$id_modelo = $row10['id'];
	if($sede==1){
		$sql11 = "SELECT SUM(chaturbate) as chaturbate, SUM(bonga) as bonga, SUM(stripchat) as stripchat, SUM(cam4) as cam4, SUM(streamate) as streamate, SUM(camsoda) as camsoda, SUM(imlive) as imlive, SUM(xlove) as xlove, SUM(myfreecams) as myfreecams FROM presabana WHERE id_modelo = ".$id_modelo." and inicio BETWEEN '".$inicio."' AND '".$fin."' and fin BETWEEN '".$inicio."' AND '".$fin."'";
		$consulta11 = mysqli_query($conexion,$sql11);
		$contador1 = mysqli_num_rows($consulta11);
		if($contador1>=1){
			while($row11 = mysqli_fetch_array($consulta11)) {
				$sede1_chaturbate = $sede1_chaturbate+$row11['chaturbate'];
				$sede1_bonga = $sede1_bonga+$row11['bonga'];
				$sede1_stripchat = $sede1_stripchat+$row11['stripchat'];
				$sede1_cam4 = $sede1_cam4+$row11['cam4'];
				$sede1_streamate = $sede1_streamate+$row11['streamate'];
				$sede1_camsoda = $sede1_camsoda+$row11['camsoda'];
				$sede1_imlive = $sede1_imlive+$row11['imlive'];
				$sede1_xlove = $sede1_xlove+$row11['xlove'];
				$sede1_myfreecams = $sede1_myfreecams+$row11['myfreecams'];

				$contador2 = $row11['chaturbate'];
			}
			if($contador2>=1){
				echo '
					<p>'.$sede1_chaturbate.'</p>
				';
			}
		}
	}
}



exit;
$uno = '123 ';
$dos = '2000';
$uno = floatval(str_replace(',', '.', str_replace('.', '', $uno)));
$suma = $uno+$dos;

echo $suma;

exit;
$number = floatval(str_replace(',', '.', str_replace('.', '', $string_number)));

exit;
$foo = "5bar"; // cadena
$bar = true;   // booleano
$hola = "123456789";

$claro = intval($hola); // $foo es ahora 5   (entero)
echo $claro*50;
?>