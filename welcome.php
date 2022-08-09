<?php
	session_start();
	if(!isset($_SESSION['nombre'])){
		header("Location: index.php");
		exit;
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/welcome.css">
	<link rel="stylesheet" href="css/modelo.css">
	<title>Camaleon Sistem</title>
</head>

<style type="text/css">
	body{
  		background-image: url("img/FONDO APP.png");
  	}
</style>

<body>
<?php
	include('script/conexion.php');
	$ubicacion = "welcome";
	include('script/navbar_verificacion.php');
	include('navbar.php');
?>
	
	<div class="seccion_slider">
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			</ol>
	  		
	  		<div class="carousel-inner">
	    		<div class="carousel-item active">
	      			<img class="d-block w-100 h-100" src="img/slider_welcome/slider1.png" alt="First slide" style="border-radius: 2rem;">
	    		</div>
	    		
	    		<div class="carousel-item">
	      			<img class="d-block w-100 h-100" src="img/slider_welcome/slider2.png" alt="Second slide" style="border-radius: 2rem;">
	    		</div>
	    
	    		<div class="carousel-item">
	      			<img class="d-block w-100 h-100" src="img/slider_welcome/slider3.png" alt="Third slide" style="border-radius: 2rem;">
	    		</div>
	  		</div>
	  		
	  		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
	    		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    		<span class="sr-only">Previous</span>
	  		</a>
	  		
	  		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
	    		<span class="carousel-control-next-icon" aria-hidden="true"></span>
	    		<span class="sr-only">Next</span>
	  		</a>
		</div>
	</div>
</body>
</html>

<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="js/navbar.js"></script>