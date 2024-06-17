<?php include("public/inc/encabezado_recupera.php");?>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7"></div>
				<div class="col-md-5">
					<div class="login-box bg-white box-shadow border-radius-10"
					style="filter:alpha(opacity=10); opacity:0.85;">
						<div align="center" class="pb-15">
							<img src="<?php echo constant('IMG');?>logotipo/logotipo.png" 
                            width="222" height="88">
                        </div>
						<?php echo mensaje(); ?>
						<div align="center">
                        	<h6 class="mb-20">Proporciona tu correo 
                            <br />para recuperar tu contraseña</h6>
                        </div>
						<form action="<?php echo constant('URL')?>recupera/validacion" 
                        name="formulario" id="formulario" method="POST" enctype="multipart/form-data">
							<div class="input-group custom">
								<input type="text" class="form-control form-control-lg" 
								name="correo" id="correo"
								placeholder="Correo" autofocus>
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
								</div>
							</div>
							<div class="row align-items-center">
								<div class="col-6">
									<div class="input-group mb-0">
										<button type="button" id="btn-regresar" 
										onclick="javascript:location.href='<?php echo constant('URL')?>login';"
										class="btn btn-proyecto btn-lg btn-block">Regresar</button>
									</div>
								</div>
								<div class="col-6">
									<div class="input-group mb-0">
										<button type="submit" id="btn-enviar" 
										class="btn btn-proyecto btn-lg btn-block">Enviar</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include("public/inc/jsfooter.php");?>
</html>
<script>
	$(document).ready(function() {
		$("#btn-enviar").click(function() {
			$("form#formulario").submit(function() {
				$('#btn-enviar').attr("disabled", true);
				return true;
			});
		});
	});
</script>
<?php $_SESSION["mensaje"]="";?>