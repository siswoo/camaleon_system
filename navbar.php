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

<?php
if($ubicacion == 'welcome'){ ?>
	<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: black !important;">
<?php }else{ ?>
	<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: black !important;">
<?php } ?>

	<?php
	if($ubicacion == 'welcome'){ ?>
		<a href="welcome.php" style="margin-right: 2rem;">
			<img src="img/logo_index2.png" style="width: 240px;">
		</a>
	<?php }else{ ?>
		<a href="../welcome.php" style="margin-right: 2rem;">
			<img src="../img/logo_index2.png" style="width: 240px;">
		</a>
	<?php } ?>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon" style="background-color: white;"></span>
  	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<?php
			if($_SESSION['rol']==1 or $_SESSION['rol']==2 or $_SESSION['rol']==14 or $_SESSION['rol']==9){ ?>
				<li class="nav-item" id="li-modelo">
	        		<a class="nav-link navbar-active-a botones_navbar1" href="../modelo/index.php" id="a-modelo">Modelos</a>
	      		</li>
			<?php } ?>

			<?php
			if($_SESSION['rol']==1 or $_SESSION['rol']==22){ ?>
				<li class="nav-item" id="li-satelite">
	        		<a class="nav-link navbar-active-a botones_navbar1" href="../satelite/index.php" id="a-satelite">Satelites</a>
	      		</li>
			<?php } ?>

			<?php
			if($_SESSION['rol']==8 or $_SESSION['rol']==15 or $_SESSION['rol']==23){ ?>
				<li class="nav-item" id="li-modelo">
	        		<a class="nav-link navbar-active-a botones_navbar1" href="../modelo/index2.php" id="a-modelo2">Modelos</a>
	      		</li>
			<?php } ?>

			<?php
			if($_SESSION['rol']==1 or $_SESSION['rol']==21){ ?>
				<li class="nav-item" id="li-modelo">
	        		<a class="nav-link navbar-active-a botones_navbar1" href="../modelo/index3.php" id="a-modelo3">Modelos Auditoria</a>
	      		</li>
			<?php } ?>

			<?php
			if($_SESSION['rol']==1 or $_SESSION['rol']==24){ ?>
				<li class="nav-item" id="li-soluciones">
	        		<a class="nav-link navbar-active-a botones_navbar1" href="../soluciones/index.php" id="a-soluciones">Soluciones</a>
	      		</li>
			<?php } ?>
			
	      	<?php
			if(($verificacion_pasante_view==1 or $_SESSION['rol']==8 or $_SESSION['rol']==14 or $_SESSION['rol']==15 or $_SESSION['rol']==23)){ ?>
		      	<li class="nav-item" id="li-pasante">
		        	<a class="nav-link navbar-active-a botones_navbar1" href="../pasante/index.php" id="a-pasante">Pasantes</a>
		      	</li>
	      	<?php } ?>
			
	      	<?php
			if($verificacion_usuarios_view==1){ ?>
		      	<li class="nav-item" id="li-usuario">
		        	<a class="nav-link navbar-active-a botones_navbar1" href="../usuarios/index.php" id="a-usuario">Usuarios</a>
		      	</li>
	      	<?php } ?>
	      	
	      	<?php
			if($_SESSION['rol']==7 or $_SESSION['id']==3 or $_SESSION['id']==1){ ?>
	      	<li class="nav-item" id="li-monitores">
	        	<a class="nav-link navbar-active-a botones_navbar1" href="../monitores/index.php" id="a-monitores">Monitores</a>
	      	</li>
	      	<?php } ?>

	      	<?php
			if($_SESSION['rol']==1 or $_SESSION['rol']==18){ ?>
	      	<li class="nav-item" id="li-sexshop">
	        	<a class="nav-link navbar-active-a botones_navbar1" href="../sexshop/index.php" id="a-sexshop">Sexshop</a>
	      	</li>
	      	<?php } ?>

	      	<?php
			if($_SESSION['rol']==1 or $_SESSION['rol']==19){ ?>
	      	<li class="nav-item" id="li-contenido">
	        	<a class="nav-link navbar-active-a botones_navbar1" href="../contenido/index.php" id="a-contenido">Contenido</a>
	      	</li>
	      	<?php } ?>
	      	
	      	<?php 
			if($_SESSION['rol']==1 or $_SESSION['rol']==13 or $_SESSION['rol']==14 or $_SESSION['rol']==15 or $_SESSION['rol']==21 or $_SESSION['id']==1722 or $_SESSION['id']==1056 or $_SESSION['id']==1505 or $_SESSION['id']==5698 or $_SESSION['rol']==23){ ?>
	      	<li class="nav-item" id="li-pagos">
	        	<a class="nav-link navbar-active-a botones_navbar1" href="../pagos/index.php" id="a-pagos">Pagos</a>
	      	</li>
	      	<?php } ?>
	      	
	      	<?php
			if($_SESSION['rol']==1 or $_SESSION['rol']==13){ ?>
	      	<li class="nav-item" id="li-erick">
	        	<a class="nav-link navbar-active-a botones_navbar1" href="../erick/index.php" id="a-erick">Erick</a>
	      	</li>
	      	<?php } ?>

	      	<?php
			if($_SESSION['rol']==1 or $_SESSION['rol']==20){ ?>
	      	<li class="nav-item" id="li-ccontenido">
	        	<a class="nav-link navbar-active-a botones_navbar1" href="../ccontenido/index.php" id="a-ccontenido">C.Contenido</a>
	      	</li>
	      	<?php } ?>

	      	<?php
			if($_SESSION['rol']==1 or $_SESSION['rol']==13){ ?>
	      	<li class="nav-item" id="li-bancolombia">
	        	<a class="nav-link navbar-active-a botones_navbar1" href="../bancolombia/index.php" id="a-bancolombia">Bancolombia</a>
	      	</li>
	      	<?php } ?>
	      	<?php
			if($_SESSION['rol']==1 or $_SESSION['rol']==14){ ?>
	      	<li class="nav-item" id="li-buffet">
	        	<a class="nav-link navbar-active-a botones_navbar1" href="../buffet/index.php" id="a-buffet">Buffet</a>
	      	</li>
	      	<?php } ?>
	      	<?php
			if($_SESSION['rol']==1 or $_SESSION['rol']==14){ ?>
	      	<li class="nav-item" id="li-spa">
	        	<a class="nav-link navbar-active-a botones_navbar1" href="../spa/index.php" id="a-spa">Spa</a>
	      	</li>
	      	<?php } ?>
	      	<?php
			if($_SESSION['rol']==1 or $_SESSION["id"]==2243 or $_SESSION['rol']==21){ ?>
	      	<li class="nav-item" id="li-facturas">
	        	<a class="nav-link navbar-active-a botones_navbar1" href="../facturas/index.php" id="a-facturas">Facturas</a>
	        </li>
	        <li class="nav-item" id="li-facturas">
	        	<a class="nav-link navbar-active-a botones_navbar1" href="../bancolombia/index.php" id="a-bancolombia">Bancolombia</a>
	      	</li>
	      	<?php } ?>
	      	<?php
			if($_SESSION['rol']==14){ ?>
	      	<li class="nav-item" id="li-erick">
	        	<a class="nav-link navbar-active-a botones_navbar1" href="../erick/index.php" id="a-erick">Desprendibles</a>
	      	</li>
	      	<?php } ?>
	      	<?php
			if($_SESSION['rol']==1 or $_SESSION['rol']==12 or $_SESSION['rol']==14){ ?>
	      	<li class="nav-item" id="li-community">
	        	<a class="nav-link navbar-active-a botones_navbar1" href="../community/index.php" id="a-community">Community</a>
	      	</li>
	      	<?php } ?>
	      	<?php
			if($_SESSION['rol']==1 or $_SESSION['rol']==8 or $_SESSION['rol']==15 or $_SESSION['rol']==21){ ?>
	      	<li class="nav-item" id="li-consultas">
	        	<a class="nav-link navbar-active-a botones_navbar1" href="../consultas/index.php" id="a-consultas">Consultas</a>
	      	</li>
	      	<?php } ?>
	      	<?php
			if($_SESSION['rol']==1){ ?>
	      	<li class="nav-item" id="li-admin">
	        	<a class="nav-link navbar-active-a botones_navbar1" href="../admin/index.php" id="a-admin">Admin</a>
	      	</li>
	      	<?php } ?>
	      	
	      	<?php
	      	if($_SESSION['id']==1){ ?>
	      	<li class="nav-item" id="li-residuos">
	        	<a class="nav-link navbar-active-a botones_navbar1" href="../residuos/index.php" id="a-residuos">Residuos</a>
	      	</li>
	      	<?php } ?>
	      	<?php
			if($_SESSION['rol']==1 or $_SESSION['rol']==13 or $_SESSION['rol']==8 or $_SESSION['rol']==2 or $_SESSION['rol']==15){ ?>
	      	<li class="nav-item" id="li-pqr">
	        	<a class="nav-link navbar-active-a botones_navbar1" href="../pqr/index.php" id="a-pqr">PQR</a>
	      	</li>
	      	<?php } ?>
	      	<?php
			if($_SESSION['rol']==1 or $_SESSION['id']==1056 or $_SESSION['id']==3){ ?>
	      	<li class="nav-item" id="li-personal">
	        	<a class="nav-link navbar-active-a botones_navbar1" href="../personal/index.php" id="a-personal">Personal</a>
	      	</li>
	      	<?php } ?>
	      	<?php
			if($_SESSION['rol']==1 or $_SESSION['rol']==16 or $_SESSION['usuario']=="valentina0321" or $_SESSION['usuario']=='Fernanda789'){ ?>
	      	<li class="nav-item" id="li-nomina">
	        	<a class="nav-link navbar-active-a botones_navbar1" href="../nomina/index.php" id="a-nomina">Nómina</a>
	      	</li>
	      	<?php } ?>
	      	<?php
			if(($_SESSION['rol']==1) or $_SESSION["id"]==1389){ ?>
	      	<li class="nav-item" id="li-cargos">
	        	<a class="nav-link navbar-active-a botones_navbar1" href="../cargos/index.php" id="a-cargos">Cargos</a>
	      	</li>
	      	<li class="nav-item" id="li-funciones">
	        	<a class="nav-link navbar-active-a botones_navbar1" href="../funciones/index.php" id="a-funciones">Funciones</a>
	      	</li>
	      	<?php } 
	      	?>
	      	
	    </ul>
	    <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
            <!--<li class="nav-item order-2 order-md-1"><a href="#" class="nav-link" title="settings"><i class="fa fa-cog fa-fw fa-lg"></i></a></li>-->
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