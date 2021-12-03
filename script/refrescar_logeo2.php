<?php
session_start();
if($_SESSION["id"]==''){
	echo "OFF";
}else{
	echo 'On';
}
?>