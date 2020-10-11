<nav class="navbar navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" id="navbar-home" href="#" style="font-weight: bold; border: 2px solid black; padding: 6px 12px; border-radius: 5px;">Sección de Modelos</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
  	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
            <!--<li class="nav-item order-2 order-md-1"><a href="#" class="nav-link" title="settings"><i class="fa fa-cog fa-fw fa-lg"></i></a></li>-->
            <li class="dropdown order-1">
				<button type="button" id="dropdownMenu1" data-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle"> 
					<?php echo $nombre1." ".$apellido1; ?>
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

<!--
	<li class="nav-item active" id="li-modelo">
		<a class="nav-link active-a" href="modelo/index.php" id="a-modelo">Modelos</a>
	</li>
-->