<?php include("public/inc/encabezado_sinbusqueda.php"); ?>

<div class="container-fluid" style="margin-top: 0; padding-top: 0;">
	<div class="row">
		<div class="col-12 d-flex align-items-center justify-content-between">
			<nav aria-label="breadcrumb" role="navigation" class="bg-transparent">
				<ol class="breadcrumb mb-1 bg-transparent">
					<li class="breadcrumb-item">
						<img src="https://static.wixstatic.com/media/fe7c4c_794ee55525f8446ba0a6ba64d5afaeb6~mv2.png/v1/fill/w_120,h_48,al_c,lg_1,q_85,enc_auto/fe7c4c_794ee55525f8446ba0a6ba64d5afaeb6~mv2.png" alt="Icono" style="width: 40px; height: auto; margin-right: 10px;">
						<a href="#">Facturación</a>
					</li>
					<li class="breadcrumb-item active" aria-current="page">Facturas por Concepto</li>
				</ol>
			</nav>
			<button type="button" onclick="regresar();" class=" btn-base-regresar">Regresar</button>
		</div>
	</div>






	<div class=" min-height-200px ">
		<div class="page-header mb-5">
			<div class="col-12">
				<button type="button" class="btn-base" onclick=mostrarModal()> + Agregar Usuario </button>
				<input type="text" class="form-control pull-right" style="width:20%; margin-bottom: 0.6em;" id="searchRepPhi" name="searchRepPhi" placeholder="Buscador...">
			</div>
			<div class="modal" id="noDataModal" tabindex="-1" role="dialog" aria-labelledby="noDataModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="noDataModalLabel">Nuevo Usuario</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form>
								<div class="mb-3">
									<label for="username" class="form-label">Nombre de Usuario</label>
									<input type="text" class="form-control" id="username" placeholder="Ingrese su nombre de usuario">
								</div>
								<div class="mb-3">
									<label for="email" class="form-label">Correo Electrónico</label>
									<input type="email" class="form-control" id="email" placeholder="Ingrese su correo electrónico">
								</div>
								<div class="mb-3">
									<label for="password" class="form-label">Contraseña</label>
									<input type="password" class="form-control" id="password" placeholder="Ingrese su contraseña">
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn-base-regresar" data-dismiss="modal"
								onclick=enviaDatosAgregarUsuario()>Guardar</button>
						</div>
					</div>
				</div>
			</div>

			<div class="table-responsive mt-3">
				<table id="tablaRepPhi" name="tablaRepPhi" class="table table-responsive">
					<thead class="text-blue">
						<tr>
							<th width=auto style="text-align:left"> </th>
							<th width=auto style="text-align:left">Id</th>
							<th width=auto style="text-align:left">Nombre Usuario</th>
							<th width=auto style="text-align:left">Correo</th>
							<th width=auto style="text-align:left">Estado</th>
							<th width=auto style="text-align:left">Permisos</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 0;
						foreach ($this->consultaUsuarios as $row) {
							$i++; //INICIO DEL FOR    
						?>
							<tr>
								<td><button type="button" class="btn btn-ligth btn-sm" onclick=mostrarModalEditar(<?php echo $i; ?>)>Editar</button></td>
								<td><?php echo $row->UsuarioID; ?></td>
								<td><?php echo $row->NombreUsuario; ?></td>
								<td><?php echo $row->CorreoElectronico; ?></td>
								<td><?php echo ($row->Activo == 1) ? 'Activo' : 'No activo'; ?></td>
								<td><button type="button" class="btn btn-danger btn-sm">Modificar</button></td>

							</tr>
						<?php } //FIN DEL FOR
						?>
					</tbody>
				</table>
			</div>


			<?php
			$y = 0;
			foreach ($this->consultaUsuarios as $row) {
				$y++;
				//INICIO DEL FOR    
			?>
				<div class="modal" id="Modal<?php echo $y; ?>" tabindex="-1" role="dialog" aria-labelledby="noDataModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="noDataModalLabel">Actualizar Usuario</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form>
									<div class="mb-3">
										<label for="username" class="form-label">Nombre de Usuario</label>
										<input type="text" class="form-control" id="username<?php echo $y; ?>" placeholder="Ingrese su nombre de usuario"
											value="<?php echo $row->NombreUsuario; ?>">
									</div>
									<div class="mb-3">
										<label for="email" class="form-label">Correo Electrónico</label>
										<input type="email" class="form-control" id="email<?php echo $y; ?>" placeholder="Ingrese su correo electrónico"
											value=<?php echo $row->CorreoElectronico; ?>>
									</div>
									<div class="mb-3">
										<label for="password" class="form-label">Contraseña</label>
										<input type="password" class="form-control" id="password<?php echo $y; ?>" placeholder="Ingrese su contraseña"
											value="<?php echo $row->Contrasena; ?>">
									</div>

									<div class="mb-3">
										<label for="chekboc" class="form-label">Activo</label>
										<input type="checkbox" class="form-control" id="checkbox<?php echo $y; ?>"
											<?php if ($row->Activo == 1) echo 'checked'; ?>>
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn-base-regresar" data-dismiss="modal"
									onclick="enviaDatosActualizarUsuario(
            							'<?php echo $row->UsuarioID; ?>',
            							document.getElementById('username<?php echo $y; ?>').value,
            							document.getElementById('email<?php echo $y; ?>').value,
            							document.getElementById('password<?php echo $y; ?>').value,
            							document.getElementById('checkbox<?php echo $y; ?>').checked ? 1 : 0
        							)">Guardar</button>
							</div>
						</div>
					</div>

				</div>
			<?php } //FIN DEL FOR
			?>





		</div>



		<?php include("public/inc/jsfooter.php"); ?>
		<?php include("views/onbase/modals/modal_permiso_usuario.php"); ?>
		<?php include("views/onbase/modals/modal_elimina_permisos.php"); ?>

		</html>
		<script>
			function mostrarModal() {
				$('#noDataModal').modal('show')
			}

			function mostrarModalEditar(idModal) {
				$('#Modal' + idModal).modal('show');
			}

			

			// BUSCADOR POR FILTRO TABLA DINAMICA 

			// Write on keyup event of keyword input element
			$(document).ready(function() {
				$("#searchRepPhi").keyup(function() {
					_this = this;
					// Show only matching TR, hide rest of them
					$.each($("#tablaRepPhi tbody tr"), function() {
						if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
							$(this).hide();
						else
							$(this).show();
					});
				});



			});

			function enviaDatosAgregarUsuario() {
				let id = 1
				let usuario = $("#username").val();
				let correo = $("#email").val();
				let contrasena = $("#password").val();
				let activo = 1
				let tipo = 1

				var direccion = "http://172.20.20.56:8080/ravisa/onbase/administracionUser";
				var url = direccion + "/" + $.trim(id) + "/" + $.trim(usuario) + "/" + $.trim(correo) + "/" + $.trim(contrasena) + "/" +
					$.trim(activo) + "/" + $.trim(tipo);

				$.ajax({
					type: "POST",
					url: url,
					beforeSend: function() {},
					success: function(data) {
						console.log(data)
						location.reload()
					},
					complete: function() {
						limpiar_modal()
					},
				});
			}


			function enviaDatosActualizarUsuario(number, user , email, password, check) {
				
				let id = number
				let usuario = user
				let correo = email
				let contrasena = password
				let activo = check
				let tipo = 2
				
				var direccion = "http://172.20.20.56:8080/ravisa/onbase/administracionUser";
				var url = direccion + "/" + $.trim(id) + "/" + $.trim(usuario) + "/" + $.trim(correo) + "/" + $.trim(contrasena) + "/" +
					$.trim(activo) + "/" + $.trim(tipo);

				$.ajax({
					type: "POST",
					url: url,
					beforeSend: function() {
					},
					success: function(data) {
						location.reload()
					},
					complete: function() {						
					},

				});
			}


			$('#selectModulo').change(function() {
				recargaOptionSubmodulo();
				ocultaCamposModalPermiso();
				limpia_opciones();
			});
			$('#selectValoresSubmodulo').change(function() {
				recargaOptionOpciones();
			});
			$('#selectModuloElimina').change(function() {
				recargaOptionSubmoduloElimina();
				limpia_opciones();
			});
			$('#selectValoresSubmoduloElimina').change(function() {
				recargaOptionOpcionesElimina();
			});
			$('#selectTipo').change(function() {
				ocultaCampos();
			});

			function recargaOptionOpciones() {
				//console.log($("#selectValoresSubmodulo").html());
				$("#selectOpcionvalores").html('');
				var modulo = $("#selectModulo").val();
				var submodulo = $("#selectSubMod").val();
				var peticion = $.ajax({
					url: '<?php echo constant('URL') ?>onbase/consulta_opcion_ajax' + "/" + $.trim(modulo) + "/" + $.trim(submodulo),
					success: function(data) {

						$("#selectOpcionvalores").html(data);
					},
					error: function() {

						console.log("No se ha podido obtener la información");
					}
				});
			}

			function recargaOptionSubmodulo() {
				//console.log($("#selectValoresSubmodulo").html());
				$("#selectValoresSubmodulo").html('');
				var modulo = $("#selectModulo").val();
				var peticion = $.ajax({
					url: '<?php echo constant('URL') ?>onbase/consulta_submodulo_ajax' + "/" + $.trim(modulo),
					success: function(data) {
						$("#selectValoresSubmodulo").html(data);
					},
					error: function() {
						console.log("No se ha podido obtener la información");
					}
				});
			}

			function recargaOptionOpcionesElimina() {
				//console.log($("#selectValoresSubmodulo").html());
				$("#selectOpcionvaloresElimina").html('');
				var modulo = $("#selectModuloElimina").val();
				var submodulo = $("#selectSubModElimina").val();
				var peticion = $.ajax({
					url: '<?php echo constant('URL') ?>onbase/Elimina_consulta_opcion_ajax' + "/" + $.trim(modulo) + "/" + $.trim(submodulo),
					success: function(data) {
						$("#selectOpcionvaloresElimina").html(data);
					},
					error: function() {

						console.log("No se ha podido obtener la información");
					}
				});
			}

			function recargaOptionSubmoduloElimina() {
				//console.log($("#selectValoresSubmodulo").html());
				$("#selectValoresSubmoduloElimina").html('');
				var modulo = $("#selectModuloElimina").val();
				var peticion = $.ajax({
					url: '<?php echo constant('URL') ?>onbase/Elimina_consulta_submodulo_ajax' + "/" + $.trim(modulo),
					success: function(data) {
						$("#selectValoresSubmoduloElimina").html(data);
					},
					error: function() {
						console.log("No se ha podido obtener la información");
					}
				});
			}

			function enviaDatos() {
				var direccion = "http://192.168.1.191:81/coflex/onbase/agregar_permisos";
				var usuario = $("#selectUsuario").val();
				var seccion = $("#selectModulo").val();
				var opcion = $("#selectOpcion").val();
				var sub = $("#selectSubMod").val();
				if (opcion == '' || opcion == null) {
					opcion = 0;
				}
				var url = direccion + "/" + $.trim(usuario) + "/" + $.trim(seccion) + "/" + $.trim(sub) + "/" + $.trim(opcion);
				$.ajax({
					type: "POST",
					url: url,
					beforeSend: function() {},
					success: function(data) {

						location.reload();
					}
				});
			}

			function modal_usuario(usuario) {
				$("#selectUsuario").val(usuario);
				ocultaCamposModalPermiso();
				limpiar_modalElimina();
			}

			function limpiar_modal() {
				$("#username").val('');
				$("#email").val('');
				$("#password").val('');
			}

			function limpiar_modalElimina() {
				$("#selectModuloElimina").val('');
				$("#selectOpcionvaloresElimina").val('');
				$("#selectValoresSubmoduloElimina").val('');
			}

			function limpia_opciones() {
				$("#selectOpcionElimina").val('');
				$("#selectOpcion").val('');
			}

			function elimina_permisos(usuario) {
				$("#selectUsuarioElimina").val(usuario);
				ocultaCampos();
				limpiar_modal();
			}

			function ocultaCampos() {
				var tipo = $("#selectTipo").val();

				if (tipo == "MODULO") {
					$("#divformSubmod").hide();
					$("#divformOpcion").hide();
					$("#formMod").show();
				}
				if (tipo == "SUBMODULO") {
					$("#divformOpcion").hide();
					$("#formMod").show();
					$("#divformSubmod").show();
				}
				if (tipo == "OPCION") {
					$("#formMod").show();
					$("#divformSubmod").show();
					$("#divformOpcion").show();
				}
				if (tipo == "0") {
					$("#formMod").hide();
					$("#divformSubmod").hide();
					$("#divformOpcion").hide();
				}
			}

			function ocultaCamposModalPermiso() {
				var sub = $("#selectSubMod").val();
				var op = $("#selectOpcion").val();

				if (sub !== "") {
					$("#formOpcionAgrega").show();
				} else {
					$("#formOpcionAgrega").hide();
				}
				if (op !== "") {
					$("#formOpcionAgrega").show();
				} else {
					$("#formOpcionAgrega").hide();
				}
			}

			function enviaDatosEliminaPermisos() {
				var direccion = "http://192.168.1.191:81/coflex/onbase/elimina_permisos";
				var tipo = $("#selectTipo").val();
				var usuario = $("#selectUsuarioElimina").val();
				var seccion = $("#selectModuloElimina").val();
				var opcion = $("#selectOpcionElimina").val();
				var sub = $("#selectSubModElimina").val();
				if (opcion == '' || opcion == null) {
					opcion = 0;
				}
				//alert(usuario);
				var url = direccion + "/" + $.trim(usuario) + "/" + $.trim(seccion) + "/" + $.trim(sub) + "/" + $.trim(opcion) + "/" + $.trim(tipo);

				$.ajax({
					type: "POST",
					url: url,
					beforeSend: function() {},
					success: function(data) {
						location.reload();
					}
				});
			}
		</script>