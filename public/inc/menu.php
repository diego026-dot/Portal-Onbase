<div class="left-side-bar open">
	<div class="brand-logo d-flex alig-items-center justify-content-center ">
		<a href="<?php echo constant('URL') ?>main">
			<img src="https://static.wixstatic.com/media/fe7c4c_859ff973380e4c27a5dc6fb7864f65ab~mv2.png/v1/fill/w_217,h_48,al_c,lg_1,q_85,enc_auto/fe7c4c_859ff973380e4c27a5dc6fb7864f65ab~mv2.png" alt="" class="dark-logo" style=" height:33px;">
			<img src="<?php echo constant('IMG'); ?>preloader/new.png" alt="" class="light-logo" style="height:70px;">
		</a>

	</div>
	<div class="menu-block customscroll">
		<div class="sidebar-menu icon-style-1 icon-list-style-4">
			<ul id="accordion-menu">
				<?php foreach ($_SESSION["UsuarioModulo"] as $mod) { //INICIO DEL FOR 
				?>
					<?php if ($mod == 1) { ?>
						<li class="dropdown">
							<a href="<?php echo constant('URL') ?>onbase/menuAdministracion" class="dropdown-toggle">
								<span class="micon dw dw-folder-122"></span><span class="mtext">ADMINISTRACIÓN</span>
								<!-- <span class="micon dw dw-folder-122" style="color: #ff7113; font-weight: 700;"></span><span class="mtext">ADMINISTRACIÓN</span> -->
							</a>

						<?php }
					?>

						</li>
					<?php } ?>

					<?php foreach ($_SESSION["UsuarioModulo"] as $mod) { //INICIO DEL FOR 
					?>
						<?php if ($mod == 1002) { ?>
							<li class="dropdown">
								<a href="<?php echo constant('URL') ?>pages/registroCandidatosView" class="dropdown-toggle">
								<span class="micon fi fi-tr-people-roof"></span><span class="mtext">CAPITAL HUMANO</span>
								</a>

							<?php }
						 ?>

							</li>
						<?php } ?>



						<?php foreach ($_SESSION["UsuarioModulo"] as $mod) { //INICIO DEL FOR 
						?>
							<?php if ($mod == 2) { ?>
								<li class="dropdown">
									<a href="javascript:;" class="dropdown-toggle">
										<span class="micon dw dw-zoom-in">
										</span><span class="mtext">FACTURACIÓN</span>
									</a>
									<?php foreach ($_SESSION["UsuarioSubModulo"] as $sub) { //INICIO DEL FOR 
									?>
										<ul class="submenu">

											<?php if ($sub == 2) { ?>
												<li><a href="<?php echo constant('URL') ?>onbase/procesos"
														<?php if ($this->pagina == "onbase/procesos") {
															echo "class='active'";
														} ?>>DASHBOARDS</a></li>
											<?php } ?>
											<?php if ($sub == 3) { ?>
												<li><a href="<?php echo constant('URL') ?>onbase/facturacionReportes"
														<?php if ($this->pagina == "onbase/facturacionReportes") {
															echo "class='active'";
														} ?>>REPORTES</a></li>
											<?php } ?>
											<?php if ($sub == 1003) { ?>
												<li><a href="<?php echo constant('URL') ?>onbase/cheklist"
														<?php if ($this->pagina == "onbase/cheklist") {
															echo "class='active'";
														} ?>>CHEKLIST</a></li>
											<?php } ?>
										</ul>
									<?php } //FIN DEL FOREACH OPC
									?>
								</li>
							<?php } //FIN DEL FOREACH
							?>

						<?php } ?>



						<?php foreach ($_SESSION["UsuarioModulo"] as $mod) { //INICIO DEL FOR 
						?>
							<?php if ($mod == 3) { ?>
								<li class="dropdown">
									<a href="javascript:;" class="dropdown-toggle">
										<span class="micon dw dw-idea-1"></span><span class="mtext">OPERACIONES</span>
									</a>
									<?php foreach ($_SESSION["UsuarioSubModulo"] as $sub) { //INICIO DEL FOR 
									?>
										<ul class="submenu">
											<?php if ($sub == 4) { ?>
												<li><a href="<?php echo constant('URL') ?>onbase/operaciones_menu"
														<?php if ($this->pagina == "onbase/operaciones_menu") {
															echo "class='active'";
														} ?>>SOLICITUDES</a></li>
											<?php } ?>

										</ul>
									<?php } //FIN DEL FOREACH
									?>
									<?php foreach ($_SESSION["UsuarioSubModulo"] as $sub) { //INICIO DEL FOR 
									?>
										<ul class="submenu">
											<?php if ($sub == 1002) { ?>
												<li><a href="<?php echo constant('URL') ?>onbase/cargaDeFacturas"
														<?php if ($this->pagina == "onbase/cargaDeFacturas") {
															echo "class='active'";
														} ?>>CARGA FACTURAS</a></li>
											<?php } ?>

										</ul>
									<?php } //FIN DEL FOREACH
									?>

								</li>

							<?php } ?>
						<?php } ?>





			</ul>
			</ul>
		</div>
	</div>
</div>
<div class="mobile-menu-overlay show"></div>

</html>