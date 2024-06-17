
  <div class="left-side-bar open">
		<div class="brand-logo">
			<a href="<?php echo constant('URL')?>main">
				<img src="<?php echo constant('IMG');?>preloader/logotipo.png" alt="" class="dark-logo">
				<img src="<?php echo constant('IMG');?>preloader/logotipo.png" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div> 
		<div class="menu-block customscroll">
			<div class="sidebar-menu icon-style-1 icon-list-style-4">	
				<ul id="accordion-menu">
				<?php foreach($_SESSION["U_PERMISOEXTRA"] as $perm){ //INICIO DEL FOR ?>
				<?php if($perm->Administrador ==1){ ?>
					<li class="dropdown"> 
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-folder-122"></span><span class="mtext">ADMINISTRACIÓN</span>
						</a>
						<ul class="submenu">
							<li><a href="<?php echo constant('URL')?>onbase/permisos_usuario" 
							<?php if($this->pagina=="onbase/permisos_usuario"){ echo "class='active'"; }?>>PERMISOS USUARIOS</a></li>
						</ul>
						<?php } //FIN DEL FOREACH?>
					
					</li> 		<?php } ?>
						
					<?php foreach($_SESSION["MODULOS"] as $mod){ //INICIO DEL FOR ?>
					    <?php if($mod->IdModulo ==2) { ?>
					<li class="dropdown"> 
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-zoom-in">
							</span><span class="mtext">SGC</span>
						</a>
						<?php// print_r($_SESSION["V_ID_MODULO"]);?>
						<?php foreach($_SESSION["V_ID_MODULO"] as $sub){ //INICIO DEL FOR ?>
						<ul class="submenu">
					
						    <?php if($sub->IdSub ==1 && $sub->IdModulo == 2){ ?>
						    <li><a href="<?php echo constant('URL')?>onbase/procesos" 
							<?php if($this->pagina=="onbase/procesos"){ echo "class='active'"; }?>>PROCESOS</a></li>
							<?php } ?>
							<?php if($sub->IdSub ==2 && $sub->IdModulo == 2){ ?>
							<li><a href="<?php echo constant('URL')?>onbase/menu_ccd"
							<?php if($this->pagina=="onbase/menu_ccd"){ echo "class='active'"; }?>>CCD</a></li>
							<?php } ?>
							<?php if($sub->IdSub ==3 && $sub->IdModulo == 2){ ?>
							<li><a href="<?php echo constant('URL')?>onbase/menu_ncrs" 
							<?php if($this->pagina=="onbase/menu_ncrs"){ echo "class='active'"; }?>>NCRs</a></li>
							<?php } ?>
							<?php if($sub->IdSub ==4 && $sub->IdModulo == 2){ ?>
							<li><a href="<?php echo constant('URL')?>onbase/documentos" 
							<?php if($this->pagina=="onbase/documentos"){ echo "class='active'"; }?>>AUDITORÍAS</a></li>
							<?php } ?>
							<?php if($sub->IdSub ==5 && $sub->IdModulo == 2){ ?>
							<li><a href="<?php echo constant('URL')?>onbase/difusion" 
							<?php if($this->pagina=="onbase/difusion"){ echo "class='active'"; }?>>DIFUSIÓN</a></li>
							<?php } ?>
							<?php if($sub->IdSub ==6 && $sub->IdModulo == 2){ ?>
							<li><a href="<?php echo constant('URL')?>onbase/juntas" 
							<?php if($this->pagina=="onbase/juntas"){ echo "class='active'"; }?>>JUNTAS</a></li>
						    <?php } ?>
						</ul>
						<?php } //FIN DEL FOREACH?>
					</li>	
					<?php } //FIN DEL FOREACH?>	
					<?php }?>
					<?php// print_r($_SESSION["MODULOS"]);?>
					<?php foreach($_SESSION["MODULOS"] as $mod){ //INICIO DEL FOR ?>
					    <?php if($mod->IdModulo ==1) { ?>
					<li class="dropdown"> 
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-idea-1"></span><span class="mtext">INGENIERÍA</span>
						</a>
						<?php foreach($_SESSION["V_ID_MODULO"] as $sub){ //INICIO DEL FOR ?>
						<ul class="submenu">
						    <?php if($sub->IdSub ==7 && $sub->IdModulo == 1){ ?>
							<li><a href="<?php echo constant('URL')?>onbase/menu_ccd_ing" 
							<?php if($this->pagina=="onbase/menu_ccd_ing"){ echo "class='active'"; }?>>DOCUMENTOS ING</a></li>
							<?php } ?>
							<?php if($sub->IdSub ==8 && $sub->IdModulo == 1){ ?>
							<li><a href="<?php echo constant('URL')?>onbase/ecrs" 
							<?php if($this->pagina=="onbase/ecrs"){ echo "class='active'"; }?>>ECRs</a></li>
							<?php } ?>
							<?php if($sub->IdSub ==9 && $sub->IdModulo == 1){ ?>
							<li><a href="<?php echo constant('URL')?>onbase/nuevos_modelos" 
							<?php if($this->pagina=="onbase/nuevos_modelos"){ echo "class='active'"; }?>>NUEVOS MODELOS</a></li>
						    <?php } ?>
						</ul>
						
						<?php } //FIN DEL FOREACH?>
					</li>
					  <?php } //FIN DEL FOREACH?>
					<?php } ?>

					<?php foreach($_SESSION["MODULOS"] as $mod){ //INICIO DEL FOR ?>
					    <?php if($mod->IdModulo ==5) { ?>
					<li class="dropdown"> 
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-idea-1"></span><span class="mtext">SERVICIO CLIENTE</span>
						</a>
						<?php foreach($_SESSION["V_ID_MODULO"] as $sub){ //INICIO DEL FOR ?>
						<ul class="submenu">
						    <?php if($sub->IdSub ==10 && $sub->IdModulo == 5){ ?>
							<li><a href="<?php echo constant('URL')?>onbase/menu_reclamos" 
							<?php if($this->pagina=="onbase/menu_reclamos"){ echo "class='active'"; }?>>RECLAMOS</a></li>
							<?php } ?>
							
						</ul>
						
						<?php } //FIN DEL FOREACH?>
					</li>
					  <?php } //FIN DEL FOREACH?>
					<?php } ?>



					<?php foreach($_SESSION["MODULOS"] as $mod){ //INICIO DEL FOR ?>
					    <?php if($mod->IdModulo ==6) { ?>
					<li class="dropdown"> 
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-idea-1"></span><span class="mtext">TRÁFICO</span>
						</a>
						<?php foreach($_SESSION["V_ID_MODULO"] as $sub){ //INICIO DEL FOR ?>
						<ul class="submenu">
						    <?php if($sub->IdSub ==11 && $sub->IdModulo == 6){ ?>
							<li><a href="<?php echo constant('URL')?>onbase/menu_pedimentos" 
							<?php if($this->pagina=="onbase/menu_pedimentos"){ echo "class='active'"; }?>>PEDIMENTOS</a></li>
							<?php } ?>
							
						</ul>
						
						<?php } //FIN DEL FOREACH?>
					</li>
					  <?php } //FIN DEL FOREACH?>
					<?php } ?>



					<?php foreach($_SESSION["MODULOS"] as $mod){ //INICIO DEL FOR ?>
					    <?php if($mod->IdModulo ==4) { ?>
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


					<?php foreach($_SESSION["MODULOS"] as $mod){ //INICIO DEL FOR ?>
					    <?php if($mod->IdModulo ==7) { ?>
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