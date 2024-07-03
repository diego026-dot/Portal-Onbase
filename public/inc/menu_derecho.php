            <div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle raw align-items-center" href="#" role="button" data-toggle="dropdown"  >
						<span class="icon">
							<img style = "width:160px; height:60px;" src="<?php echo constant('URL');?>public/img/logotipo/logo-blanco-2.png" alt="">							
						</span>
					
						<?php /*<span class="user-name"><?php echo $_SESSION["SESSION_nombre"];?></span>*/?>
					</a>
						<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list " >
						<!--<a class="dropdown-item" href="#"><i class="dw dw-user1"></i> Perfil</a>-->
						<!--<a class="dropdown-item" href="#"><i class="dw dw-settings2"></i> Configuración</a>-->
						<a class="dropdown-item" href="#"><i class="fa fa-user-o"></i> <?php echo $_SESSION['usuario']; ?></a> 
						<a class="dropdown-item" href="<?php echo constant('URL') . 'logout'?>"><i class="dw dw-logout"></i> Cerrar Sesión</a>
					</div>
				</div>
			</div>