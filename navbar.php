<?php
$sql_verificacion_rol = "SELECT * FROM roles WHERE id = ".$_SESSION['rol'];
$verificacion_rol = mysqli_query($conexion,$sql_verificacion_rol);
while($row_verificacion = mysqli_fetch_array($verificacion_rol)) {
	$verificacion_modelo_view = $row_verificacion['modelo_view'];
	$verificacion_modelo_edit = $row_verificacion['modelo_edit'];
	$verificacion_modelo_delete = $row_verificacion['modelo_delete'];

	$verificacion_roles_view = $row_verificacion['roles_view'];
	$verificacion_roles_edit = $row_verificacion['roles_edit'];
	$verificacion_roles_delete = $row_verificacion['roles_delete'];

	$verificacion_pasante_view = $row_verificacion['pasante_view'];
	$verificacion_pasante_edit = $row_verificacion['pasante_edit'];
	$verificacion_pasante_delete = $row_verificacion['pasante_delete'];

	$verificacion_reporteModelos_view = $row_verificacion['reporteModelos_view'];
	$verificacion_monitores_view = $row_verificacion['monitores_view'];
	$verificacion_sedes_view = $row_verificacion['sedes_view'];
	$verificacion_paginas_view = $row_verificacion['paginas_view'];
	$verificacion_usuarios_view = $row_verificacion['usuarios_view'];
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" id="navbar-home" href="../welcome.php" style="font-weight: bold; border: 2px solid black; padding: 6px 12px; border-radius: 5px;"><?php echo $usuario_rol; ?></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
  	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<?php
			if($verificacion_modelo_view==1){ ?>
				<li class="nav-item" id="li-modelo">
	        		<a class="nav-link navbar-active-a" href="../modelo/index.php" id="a-modelo">Modelos</a>
	      		</li>
			<?php } ?>

			<?php
			if($verificacion_roles_view==1){ ?>
		      	<li class="nav-item" id="li-roles">
		        	<a class="nav-link navbar-active-a" href="../roles/index.php" id="a-roles">Roles</a>
		      	</li>
	      	<?php } ?>
	      	<!--
	      	<li class="nav-item" id="li-seguridad">
	        	<a class="nav-link navbar-active-a" href="../seguridad/index.php" id="a-seguridad">Seguridad</a>
	      	</li>
	      	-->
	      	<?php
			if($verificacion_pasante_view==1){ ?>
		      	<li class="nav-item" id="li-pasante">
		        	<a class="nav-link navbar-active-a" href="../pasante/index.php" id="a-pasante">Pasantes</a>
		      	</li>
	      	<?php } ?>

	      	<?php
			if($verificacion_usuarios_view==1){ ?>
		      	<li class="nav-item" id="li-usuario">
		        	<a class="nav-link navbar-active-a" href="../usuarios/index.php" id="a-usuario">Usuarios</a>
		      	</li>
	      	<?php } ?>

	      	<?php
	      	/*
			if($verificacion_reporteModelos_view==1){ ?>
	      	<li class="nav-item" id="li-Rinicio">
	        	<a class="nav-link navbar-active-a" href="../reportes/reporte_inicio.php" id="a-Rinicio">R Inicio</a>
	      	</li>
	      	<?php } 
			*/
	      	?>

	      	<?php
			if($verificacion_monitores_view==1){ ?>
	      	<li class="nav-item" id="li-monitores">
	        	<a class="nav-link navbar-active-a" href="../monitores/index.php" id="a-monitores">Monitores</a>
	      	</li>
	      	<?php } ?>

	      	<?php
	      	/*
			if($verificacion_sedes_view==1){ ?>
	      	<li class="nav-item" id="li-sedes">
	        	<a class="nav-link navbar-active-a" href="../sedes/index.php" id="a-sedes">Sedes</a>
	      	</li>
	      	<?php } 
	      	*/
	      	?>

	      	<?php
	      	/*
			if($verificacion_paginas_view==1){ ?>
	      	<li class="nav-item" id="li-paginas">
	        	<a class="nav-link navbar-active-a" href="../paginas/index.php" id="a-paginas">Paginas</a>
	      	</li>
	      	<?php } 
			*/
	      	?>
	      	
	      	<?php
			if($_SESSION['rol']==1 or $_SESSION['rol']==7){ ?>
	      	<li class="nav-item" id="li-reportes">
	        	<a class="nav-link navbar-active-a" href="../reportes/index.php" id="a-reportes">Reportes</a>
	      	</li>
	      	<?php } ?>

	      	<li class="nav-item" id="li-pagos">
	        	<a class="nav-link navbar-active-a" href="../pagos/index.php" id="a-pagos">Pagos</a>
	      	</li>

	      	<?php
			if($_SESSION['rol']==1 or $_SESSION['rol']==7){ ?>
	      	<li class="nav-item" id="li-erick">
	        	<a class="nav-link navbar-active-a" href="../erick/index.php" id="a-erick">Erick</a>
	      	</li>
	      	<?php } ?>

	    </ul>

	    <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
            <!--<li class="nav-item order-2 order-md-1"><a href="#" class="nav-link" title="settings"><i class="fa fa-cog fa-fw fa-lg"></i></a></li>-->
            <li class="dropdown order-1">
				<button type="button" id="dropdownMenu1" data-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle"> 
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

<input type="hidden" id="hidden_ubicacion" value="<?php echo $ubicacion; ?>">
<input type="hidden" id="hidden_modelo_view" value="<?php echo $modelo_view; ?>">
<input type="hidden" id="hidden_modelo_edit" value="<?php echo $modelo_edit; ?>">
<input type="hidden" id="hidden_modelo_delete" value="<?php echo $modelo_delete; ?>">

<input type="hidden" id="hidden_roles_view" value="<?php echo $roles_view; ?>">
<input type="hidden" id="hidden_roles_edit" value="<?php echo $roles_edit; ?>">
<input type="hidden" id="hidden_roles_delete" value="<?php echo $roles_delete; ?>">

<input type="hidden" id="hidden_seguridad_view" value="<?php echo $seguridad_view; ?>">

<input type="hidden" id="hidden_pasante_view" value="<?php echo $pasante_view; ?>">
<input type="hidden" id="hidden_pasante_edit" value="<?php echo $pasante_edit; ?>">
<input type="hidden" id="hidden_pasante_delete" value="<?php echo $pasante_delete; ?>">

<input type="hidden" id="hidden_usuario_view" value="<?php echo $usuario_view; ?>">

<!--
	<li class="nav-item active" id="li-modelo">
		<a class="nav-link active-a" href="modelo/index.php" id="a-modelo">Modelos</a>
	</li>
-->	      	