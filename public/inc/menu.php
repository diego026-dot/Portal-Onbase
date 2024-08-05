
  <div class="left-side-bar open">
		<div class="brand-logo d-flex alig-items-center justify-content-center ">
			<a href="<?php echo constant('URL')?>main">
				<img src="https://static.wixstatic.com/media/fe7c4c_859ff973380e4c27a5dc6fb7864f65ab~mv2.png/v1/fill/w_217,h_48,al_c,lg_1,q_85,enc_auto/fe7c4c_859ff973380e4c27a5dc6fb7864f65ab~mv2.png" alt="" class="dark-logo" style = " height:33px;">
				<img src="<?php echo constant('IMG');?>preloader/new.png" alt="" class="light-logo" style = "height:70px;">
			</a>
			
		</div> 
		<div class="menu-block customscroll">
			<div class="sidebar-menu icon-style-1 icon-list-style-4">	
				<ul id="accordion-menu">
				<?php foreach($_SESSION["UsuarioModulo"] as $perm){ //INICIO DEL FOR ?>
				<?php if($perm ==1){ ?>
					<li class="dropdown"> 
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-folder-122" ></span><span class="mtext">ADMINISTRACIÓN</span>
							<!-- <span class="micon dw dw-folder-122" style="color: #ff7113; font-weight: 700;"></span><span class="mtext">ADMINISTRACIÓN</span> -->
						</a>
						<?php foreach($_SESSION["UsuarioSubModulo"] as $sub){ //INICIO DEL FOR ?>
						<ul class="submenu">
						    <?php if($sub ==1){ ?>
							<li><a href="<?php echo constant('URL')?>onbase/administracionUser" 
							<?php if($this->pagina=="onbase/administracionUser"){ echo "class='active'"; }?>>PERMISOS USUARIOS</a></li>
							<?php } ?>
						</ul>
						<?php } //FIN DEL FOREACH OPC?>
						<?php } //FIN DEL FOREACH?>
					
					</li> 		<?php } ?>
						
					<?php foreach($_SESSION["UsuarioModulo"] as $mod){ //INICIO DEL FOR ?>
					    <?php if($mod ==2) { ?>
					<li class="dropdown"> 
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-zoom-in">
							</span><span class="mtext">FACTURACIÓN</span>
						</a>
						
						<ul class="submenu">
						<?php foreach($_SESSION["UsuarioSubModulo"] as $sub){ //INICIO DEL FOR ?>
						    <?php if($sub ==2){ ?>
						    <li><a href="<?php echo constant('URL')?>onbase/procesos" 
							<?php if($this->pagina=="onbase/procesos"){ echo "class='active'"; }?>>DASHBOARDS</a></li>
							<?php } ?>
							<?php if($sub ==3){ ?>
						    <li><a href="<?php echo constant('URL')?>onbase/facturacionReportes" 
							<?php if($this->pagina=="onbase/facturacionReportes"){ echo "class='active'"; }?>>REPORTES</a></li>
							<?php } ?>
						</ul>
						<?php } //FIN DEL FOREACH OPC?>
					</li>	
					<?php } //FIN DEL FOREACH
					?>	
					
					<?php }?>
								
					

					<?php foreach($_SESSION["UsuarioModulo"] as $mod){ //INICIO DEL FOR ?>
					    <?php if($mod ==3) { ?>
					<li class="dropdown"> 
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-idea-1"></span><span class="mtext">OPERACIONES</span>
						</a>					
						<ul class="submenu">
						 <?php if($sub ==4){ ?>
							<li><a href="<?php echo constant('URL')?>onbase/operaciones_menu" 
							<?php if($this->pagina=="onbase/operaciones_menu"){ echo "class='active'"; }?>>SOLICITUDES</a></li>
							<?php } ?>
						</ul>
						
						
					</li>
					  <?php } //FIN DEL FOREACH?>
					<?php } ?>


					<?php foreach($_SESSION["UsuarioModulo"] as $mod){ //INICIO DEL FOR ?>
					    <?php if($mod ==5) { ?>
					<li class="dropdown"> 
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-idea-1"></span><span class="mtext">SERVICIO CLIENTE</span>
						</a>
						
						<ul class="submenu">
						    <?php if($sub->IdSub ==10 && $sub->IdModulo == 5){ ?>
							<li><a href="<?php echo constant('URL')?>onbase/menu_reclamos" 
							<?php if($this->pagina=="onbase/menu_reclamos"){ echo "class='active'"; }?>>RECLAMOS</a></li>
							<?php } ?>
							
						</ul>
						
						
					</li>
					  <?php } //FIN DEL FOREACH?>
					<?php } ?>



					<?php foreach($_SESSION["UsuarioModulo"] as $mod){ //INICIO DEL FOR ?>
					    <?php if($mod ==6) { ?>
					<li class="dropdown"> 
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-idea-1"></span><span class="mtext">TRÁFICO</span>
						</a>
					
						<ul class="submenu">
						    <?php if($sub->IdSub ==11 && $sub->IdModulo == 6){ ?>
							<li><a href="<?php echo constant('URL')?>onbase/menu_pedimentos" 
							<?php if($this->pagina=="onbase/menu_pedimentos"){ echo "class='active'"; }?>>PEDIMENTOS</a></li>
							<?php } ?>
							
						</ul>
						
				
					</li>
					  <?php } //FIN DEL FOREACH?>
					<?php } ?>



					<?php foreach($_SESSION["UsuarioModulo"] as $mod){ //INICIO DEL FOR ?>
					    <?php if($mod ==4) { ?>
					<li class="dropdown"> 
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-coding-1"></span><span class="mtext">OnBase</span>
						</a>
						<ul class="submenu">
							<li><a href="<?php echo constant('URL')?>onbase/solicitud" 
							<?php if($this->pagina=="onbase/solicitud"){ echo "class='active'"; }?>>Solicitud</a></li>
							<li><a href="<?php echo constant('URL')?>onbase/consulta" 
							<?php if($this->pagina=="onbase/consulta"){ echo "class='active'"; }?>>Consulta</a></li>
							<li><a href="<?php echo constant('URL')?>onbase/dashboard" 
							<?php if($this->pagina=="onbase/dashboard"){ echo "class='active'"; }?>>Dashboard</a></li>
						</ul>
					</li>
					 <?php } //FIN DEL FOREACH?>
					<?php } ?>


					<?php foreach($_SESSION["UsuarioModulo"] as $mod){ //INICIO DEL FOR ?>
					    <?php if($mod ==7) { ?>
					<li class="dropdown"> 
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon fa fa-usd"></span><span class="mtext">COMPRAS</span>
						</a>
						<ul class="submenu">
							<li><a href="<?php echo constant('URL')?>onbase/cmp_vendorCarga" 
							<?php if($this->pagina=="onbase/cmp_vendorCarga"){ echo "class='active'"; }?>>CARGA MASIVA</a></li>

						</ul>
						<ul class="submenu">
							<li><a href="<?php echo constant('URL')?>onbase/cmp_provTiempos" 
							<?php if($this->pagina=="onbase/cmp_provTiempos"){ echo "class='active'"; }?>>ALTA PROVEEDOR</a></li>

						</ul>
					</li>
					 <?php } //FIN DEL FOREACH?>
					<?php } ?>

				</ul>
				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay show"></div>
	</html>