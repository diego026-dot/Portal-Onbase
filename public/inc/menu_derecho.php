            <div class="user-info-dropdown">
            	<div class="dropdown">
            		<a class="dropdown-toggle raw align-items-center" href="#" role="button" data-toggle="dropdown">
            			<span class="icon">
            				<img style="width: 30px; height:30px;"
            					src="https://static.wixstatic.com/media/fe7c4c_a62cdb9acd31480196bcad4586eec778~mv2.png/v1/fill/w_29,h_45,al_c,lg_1,q_85,enc_auto/fe7c4c_a62cdb9acd31480196bcad4586eec778~mv2.png" alt="">
            			</span>

            			
            		</a>
            		<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list ">
            			<!--<a class="dropdown-item" href="#"><i class="dw dw-user1"></i> Perfil</a>-->
            			<!--<a class="dropdown-item" href="#"><i class="dw dw-settings2"></i> Configuración</a>-->
            			<a class="dropdown-item" href="#"><i class="fa fa-user-o"></i> <?php echo $_SESSION['usuario']; ?></a>
            			<a class="dropdown-item" href="<?php echo constant('URL') . 'logout' ?>"><i class="dw dw-logout"></i> Cerrar Sesión</a>
            		</div>
            	</div>
            </div>