<?php
session_start();

echo $_SESSION["user_id"].'

';

function isLoginSessionExpired() {
	$login_session_duration = 60*5; 
	$current_time = time(); 
	if(isset($_SESSION['loggedin_time']) and isset($_SESSION["user_id"])){	
		if(((time() - $_SESSION['loggedin_time']) > $login_session_duration)){ 
			return true; 
		} 
	}
	return false;
}

if(isset($_SESSION["user_id"])) {
	if(!isLoginSessionExpired()) {
		//header("Location:test15_2.php");
		echo "Logeado";
	} else {
		//header("Location:logout.php?session_expired=1");
		echo "Salido";
	}
}


?>