<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: black !important;">
<!--<a class="navbar-brand" id="navbar-home" href="#" style="font-weight: bold; border: 2px solid black; padding: 6px 12px; border-radius: 5px;">Sección de Modelos</a>-->
<a href="perfil.php" style="margin-right: 2rem;">
	<img src="../img/logo_index2.png" style="width: 260px;">
</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
  	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<?php
			if($ubicacion=='pqr'){
				echo '
					<li class="nav-item navbar-active" id="li-pqr">
		        		<a class="nav-link navbar-active-a botones_navbar1" href="pqr.php" style="font-size: 24px;" id="a-pqr">PQR</a>
		      		</li>
	      		';
			}else{
				echo '
					<li class="nav-item" id="li-pqr">
		        		<a class="nav-link navbar-active-a botones_navbar1" href="pqr.php" style="font-size: 24px;" id="a-pqr">PQR</a>
		      		</li>
	      		';
			}
			?>
	    </ul>
	    <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
            <li class="dropdown order-1">
				<button type="button" id="dropdownMenu1" data-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle botones_navbar1"> 
					<?php echo $usuario_rol; ?>
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu dropdown-menu-right mt-2">
					<li class="px-3 py-2">
                        <form class="form" role="form">
							<div class="form-group">
								<a href="../script/cerrar_sesion.php" id="navbar-cerrarSesion" style="color:black;font-weight: bold;">Cerrar Sesión</a>
							</div>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
	</div>
</nav>
