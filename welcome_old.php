<?php
	session_start();
	if(!isset($_SESSION['nombre'])){
		header("Location: index.php");
		exit;
	}else if($_SESSION['rol']==4){
		//
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

	<!--
	<div class="seccion1">
	    <div class="row">
		    <div class="container">
			    <form action="#" method="POST" id="formulario1" style="margin-left: 30%; margin-right: 30%;">
				    <div class="col-12" class="text-center">
				    	<p class="text-center titulo1">Ingrese Datos de Ingreso</p>
				    </div>
				    <div class="form-group form-check">
					    <label for="usuario">Usuario o Correo</label>
					    <input type="text" class="form-control" name="usuario" id="usuario" placeholder="" value="admin">
					    <div class="ml-1 mt-1 error_texto1 d-none" id="error_texto1">Este campo no debe estar vacio.</div>
				    </div>

				    <div class="form-group form-check">
					    <label for="clave">Clave</label>
					    <input type="password" class="form-control" name="clave" id="clave" placeholder="" value="admin">
					    <div class="ml-1 mt-1 error_texto2 d-none" id="error_texto2"></div>
					    <small id="emailHelp" class="form-text text-muted">Los datos de ingreso son totalmente confidenciales.</small>
				    </div>
					<div class="row">
						<div class="col-md-6 form-group form-check text-center">
							<button type="submit" id="submit" class="btn btn-success">Ingresar</button>
						</div>
						<div class="col-md-6 form-group form-check text-center" style="text-align: center;">
						<p class="olvido1">
							<a href="">Has olvidado la contraseña?</a>
						</p>
					</div>
					</div>
			    </form>
		    </div>
	    </div>
    </div>
	-->


</body>
</html>

<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="js/navbar.js"></script>
<?php include('footer.php'); ?>