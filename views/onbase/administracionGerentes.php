<?php include("public/inc/encabezado_sinbusqueda.php");


?>

<div class="container-fluid" style="margin-top: 0; padding-top: 0;">

	<div class="row">
		<div class="col-32  d-flex align-items-center justify-content-between">
			<nav aria-label="breadcrumb" role="navigation" class="bg-transparent">
				<ol class="breadcrumb mb-1 bg-transparent">
					<li class="breadcrumb-item">
						<img src="https://static.wixstatic.com/media/fe7c4c_794ee55525f8446ba0a6ba64d5afaeb6~mv2.png/v1/fill/w_120,h_48,al_c,lg_1,q_85,enc_auto/fe7c4c_794ee55525f8446ba0a6ba64d5afaeb6~mv2.png" alt="Icono" style="width: 40px; height: auto; margin-right: 10px;">
						<a href="#">Administracion</a>
					</li>
					<li class="breadcrumb-item active" aria-current="page">Administrar Correos</li>
				</ol>
			</nav>
			<button type="button" onclick="window.location = '<?php echo constant('URL') ?>onbase/menuAdministracion'" class=" btn-base-regresar">Regresar</button>
		</div>
	</div>



	<div class="row page-header d-flex justify-content-center mb-5 mt-5">

		<div class="col-5 d-flex justify-content-center">
			<table id="tablaUser" name="tablaUser" class="table table-responsive mt-10 align-items-center ">
				<thead class="text-blue">
					<tr>
						<th></th>
						<th width=30% class="fs-6 text-left text-uppercase fw-bold">Usuario</th>

						<th width=30% class="fs-6 text-left text-uppercase fw-bold">Sucursal</th>
						<th width=30% class="fs-6 text-left text-uppercase fw-bold">Estado</th>


					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($this->resultados as $row => $resultado) {
						//INICIO DEL FOR
						foreach ($resultado as $user) {
							$row_json = json_encode($user);

					?>
							<tr>
								<td>
									<button class="btn btn-light btn-sm  text-uppercase" onclick="editarUsuario(<?php echo htmlspecialchars($row_json); ?>)">
										<i class="bi bi-pencil"></i>
									</button>
								</td>
								<td class="align-items-center fs-6"><?php echo $user->NombreUsuario; ?></td>

								<td class="align-items-center fs-6"><?php echo $user->Sucursal; ?></td>
								<td class="align-items-center fs-6"><?php echo $user->Activo == 1 ? 'Activo' : 'No Activo'; ?></td>

							</tr>
					<?php }
					} //FIN DEL FOR
					?>
				</tbody>
			</table>
		</div>

		<div class="col-6 justify-content-center">
			<div class="row justify-content-center">
				<button class="btn btn-success fw-bold px-4 py-2 w-50 text-uppercase" onclick="mostrarFormulario()">
					Agregar +
				</button>
			</div>


			<div class=" page-header mb-5 hidden mt-2 " id="formulario">

				<div id="error">

				</div>

				<form id="dataForm">

					<div class="row d-flex justify-content-center g-5 flex-column ">

						<div class="col-md-8  col-sm-4  form-floating">
							<input type="text" id="nombreusuario" name="nombreusuario" class="form-control w-100">
							<label for="nombreusuario" class="font-weight-bold">Nombre</label>
						</div>
						<div class="col-md-8  col-sm-4 ">
							<select class="selectpicker w-100" id="sucursal" name="sucursal">
								<option value="" selected disabled>Elige Sucursal</option>
								<?php
								foreach ($this->sucursalUsuario as $row => $resultado) {
								?>

									<option value=<?php echo $row ?>><?php echo $resultado ?></option>

								<?php }
								//FIN DEL FOR
								?>

							</select>

						</div>
						<div class="col-md-8  col-sm-4  form-floating">

							<input type="text" id="correoelectronico" name="correoelectronico" class="form-control">
							<label for="direccion" class="font-weight-bold">Correo</label>
						</div>
						<div class="col-md-8  col-sm-4  form-floating">

							<input type="text" id="contrasena" name="contrasena" class="form-control">
							<label for="contrasena" class="font-weight-bold">Contraseña</label>
						</div>

						<div class="col-md-8  col-sm-4 ">

							<input type="checkbox" id="activo" name="activo">
							<label for="activo" class="font-weight-bold">Activo</label>
						</div>

					</div>


					<div class="row justify-content-between mt-5">
						<div class="col-4">
							<button class="btn btn-success fw-bold px-4 py-2 w-100 text-uppercase" data-tipo="1" data-id="" type="submit">
								Guardar
							</button>
						</div>
						<div class="col-4">
							<button class="btn btn-danger fw-bold px-4 py-2 w-100 text-uppercase" type="button" onclick="cerrarFormulario()">
								Cancelar
							</button>
						</div>
					</div>


				</form>
				<!-- </div> -->

			</div>
		</div>

		<!-- <div class="min-height-200px "> -->

	</div>






</div>




<?php include("public/inc/jsfooter.php"); ?>


</html>
<script>
	$(document).ready(function() {
		$("#dataForm").submit(function(e) {
			e.preventDefault()

			let formValid = true

			$("#error").empty();

			$("#dataForm input:not([type='checkbox'])").each(function() {
				if (!$(this).val().trim()) {
					formValid = false
				}
			});

			if (!formValid) {
				$("#error").append('<div class="alert alert-danger text-center" role="alert" style="margin-top:0.3rem; ">Favor de llenar todos los campos</div>')
				return
			}

			let id = $("button[type='submit']").attr("data-id") || 1
			let usuario = $("#nombreusuario").val();
			let correo = $("#correoelectronico").val();
			let contrasena = $("#contrasena").val();
			let sucursal = $("#sucursal").val()
			let activo = $("#activo").prop("checked")
			let tipo = parseInt($("button[type='submit']").attr("data-tipo"))

			var direccion = "http://172.20.20.56:8080/ravisa/onbase/administracionUser";
			var url = direccion + "/" + $.trim(id) + "/" + $.trim(usuario) + "/" + $.trim(correo) + "/" + $.trim(contrasena) + "/" +
				$.trim(activo) + "/" + $.trim(sucursal) + "/" + $.trim(tipo);
			
				console.log(url)
			

			$.ajax({
				type: "POST",
				url: url,
				beforeSend: function() {},
				success: function(data) {

					location.reload()
				},
				complete: function() {

				},
			});
		})
	})


	function mostrarFormulario() {
		//$('#formulario').css('opacity', 0).removeClass('hidden').animate({ opacity: 1 }, 500);
		$('#formulario').hide().removeClass('hidden').slideDown(500);
		$("#dataForm input").val('')
		$("#dataForm input[type='checkbox']").prop("checked", false)
		$('#sucursal').val('').selectpicker('refresh');
		$("button[type='submit']").attr("data-tipo", "1");
		$("#error").empty();
		//$('#formulario').hide().removeClass('hidden').fadeIn(500);
	}

	function cerrarFormulario() {

		$('#formulario').slideUp(500, function() {
			$(this).addClass('hidden');
			$("#dataForm input").val('')
			$("#dataForm input[type='checkbox']").prop("checked", false)
			$('#sucursal').val('').selectpicker('refresh');
			$("button[type='submit']").attr("data-tipo", "1");
			$("#error").empty();

		});

		// $('#formulario').fadeOut(500, function() {
		// 	$(this).addClass('hidden');
		// });

		// $('#formulario').animate({
		// 	opacity: 0
		// }, 500, function() {
		// 	$(this).addClass('hidden').hide();
		// });



	}

	function editarUsuario(datos) {

		mostrarFormulario()
		$("button[type='submit']").attr("data-tipo", "2");

		Object.entries(datos).forEach(([clave, valor]) => {
			let indice = clave.toLowerCase().trim().replace(/\s+/g, '')
			let elemento = $(`#${indice}`);

			if (elemento.attr("type") === "checkbox") {
				elemento.prop("checked", valor == 1 || valor === true);
			} else if (indice === "sucursal") {
				elemento.val(valor).selectpicker('refresh')
			} else {
				elemento.val(valor)
			}

			if (indice === "usuarioid") {
				$("button[type='submit']").attr("data-id", valor);
			}



		})

	}
</script>