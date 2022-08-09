    <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <!--<a class="navbar-brand" href="#"><img src="../img/logo_index1.png" class="img-fluid" style="max-width:160px;"></a>-->
                <a class="navbar-brand" href="#">Camaleon Models</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item" style="text-transform: capitalize; margin-right: 2rem; font-size: 18px;"><?php echo $_SESSION["nombre"]; ?></li>
                    </ul>
                </div>
            </nav>
        </div>
        
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="true" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">Menu</li>
							<li class="nav-item ">
								<a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="true" data-target="#submenu-1" aria-controls="submenu-1" style="text-transform: uppercase;">
									<i class="fa fa-fw fa-user-circle" style="color: white;"></i>Modelo Contenido <span class="badge badge-success">6</span>
								</a>
								<div id="submenu-1" class="submenu collapse show" style="">
                                    <ul class="nav flex-column">
										<li class="nav-item">
											<a class="nav-link" href="perfil.php">Personal</a>
										</li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="bancarios.php">Bancarios</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="corporales.php">Corporales</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="documentos.php">Documentos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="contrato.php">Contrato</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="fotos.php">Fotos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pagos.php">Pagos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="cuentas.php">Cuentas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="configuracion.php">Configuración</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../index.php">Cerrar Sesión</a>
                                        </li>
									</ul>
								</div>
							</li>
						</ul>
                    </div>
                </nav>
            </div>
        </div>