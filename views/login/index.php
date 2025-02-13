<?php
include("public/inc/encabezado_login.php"); ?>
<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-6 col-lg-7"></div>
			<div class="col-md-6 col-lg-5">
				<div class="login-box bg-blue-otro box-shadow border-radius-10"
					style="filter:alpha(opacity=10); opacity:0.85;">
					<div align="center" class="pb-15">
						<img src="<?php echo constant('IMG'); ?>logotipo/ravisalogotipo.png"
							width="143" height="100" style="border-radius: 0px;">
					</div>
					<form action="<?php echo constant('URL') ?>login/validacion"
						name="formulario" id="formulario" method="POST" enctype="multipart/form-data">
						<div class="input-group custom">
							<input type="text" class="form-control form-control-lg"
								name="usuario" id="usuario" required
								placeholder="Usuario" autofocus>
							<div class="input-group-append custom">
								<span class="input-group-text">
									<i class="icon-copy dw dw-user1"></i></span>
							</div>
						</div>
						<div class="input-group custom">
							<input type="password" class="form-control form-control-lg" required
								name="contrasena" id="contrasena" placeholder="Contraseña">
							<div class="input-group-append custom">
								<span class="input-group-text">
									<i class="dw dw-padlock1"></i></span>
							</div>
						</div>
						<div class="row pb-10 mb-10">
							<div class="col-sm-12">
								<div class="input-group mb-0">
									<button type="submit" id="btn-validar" onclick="validacion_permisos();"
										class="btn btn-proyecto btn-lg btn-block">Iniciar Sesión</button>
								</div>
							</div>
						</div>
						<div class="row">
							
						</div>
						<div class="row pb-10">
							<div class="col-6">
							</div>
							<div class="col-6">
								<div class="forgot-password">
									<a href=" ">Recupera contraseña</a>
								</div>
							</div>
						</div>
					</form>
					<?php echo mensaje(); ?>

					<div class="row">
						<div class="col-12">
							<a
								
								class="btn btn-proyecto btn-lg btn-block"
								style="background-color:#ff7113 !important; color:white; opacity:0.70;"
								onclick="accesoReferencia()">
					         Iniciar Sin Credenciales
							</a>
						</div>
					</div>


				</div>

				
			</div>
		</div>
	</div>
</div>
<?php include("public/inc/jsfooter.php"); ?>

</html>
<script>
	$(document).ready(function() {
		$("#btn-validar").click(function() {
			$("form#formulario").submit(function() {
				$('#btn-validar').attr("true", true);
				return true;
			});
		});
	});

	
	function accesoReferencia() {
		// Datos de usuario y contraseña automáticos
		const usuario = "Global"; // Reemplaza con el usuario que deseas
		const contrasena = "global123"; // Reemplaza con la contraseña que deseas
		
		// Crear un formulario dinámico y enviarlo
		let form = document.createElement("form");
		form.method = "POST";
		form.action = "<?php echo constant('URL') ?>login/validacion"
		
		// Crear los campos ocultos de usuario y contraseña
		let inputUsuario = document.createElement("input");
		inputUsuario.type = "hidden";
		inputUsuario.name = "usuario";
		inputUsuario.value = usuario;

		let inputContrasena = document.createElement("input");
		inputContrasena.type = "hidden";
		inputContrasena.name = "contrasena";
		inputContrasena.value = contrasena;
		
		// Agregar campos al formulario
		form.appendChild(inputUsuario);
		form.appendChild(inputContrasena);
		
		// Agregar el formulario al DOM y enviarlo
		document.body.appendChild(form);
		form.submit();
	}



	


</script>
<?php $_SESSION["mensaje"] = ""; ?>