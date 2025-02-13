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
			<div class="modal fade" id="noDataModal" tabindex="-1" role="dialog" aria-labelledby="noDataModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="modal-title fs-5" id="noDataModalLabel">Nuevo Usuario</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form>
								<div class="mb-3">
									<label for="username" class="form-label font-weight-bold">Nombre de Usuario</label>
									<input type="text" class="form-control" id="username" placeholder="Ingrese su nombre de usuario" required>
								</div>

								<div class="mb-3">
									<label for="email" class="form-label font-weight-bold">Correo Electrónico</label>
									<input type="email" class="form-control" id="email" placeholder="Ingrese su correo electrónico">
								</div>
								<div class="mb-3">
									<label for="password" class="form-label font-weight-bold">Contraseña</label>
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
								<td><button type="button" class="btn btn-ligth btn-sm bi bi-pencil" onclick=mostrarModalEditar(<?php echo $i; ?>)></button></td>
								<td><?php echo $row->UsuarioID; ?></td>
								<td><?php echo $row->NombreUsuario; ?></td>
								<td><?php echo $row->CorreoElectronico; ?></td>
								<td><?php echo ($row->Activo == 1) ? 'Activo' : 'No activo'; ?></td>
								<td>
									<div class="btn-group">
										<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
											Modulos</button>
										<ul class="dropdown-menu">
											<?php
											$modulosAgregados = array();
											foreach ($this->permisos as $y) {
												if ($row->NombreUsuario == $y->Usuario) {
													if (!in_array($y->Modulo, $modulosAgregados) && $y->Activo == 1) {
														$modulosAgregados[] = $y->Modulo; ?>

														<?php ($y->Modulo == 1) ? print_r('<li><a class="dropdown-item" href="#">Administracion</a></li>') : ''; ?></a></li>
														<?php ($y->Modulo == 2) ? print_r('<li><a class="dropdown-item" href="#">Facturacion</a></li>') : ''; ?></a></li>
														<?php ($y->Modulo == 3) ? print_r('<li><a class="dropdown-item" href="#">Operaciones</a></li>') : ''; ?></a></li>
											<?php }
												}
											} //FIN DEL FOR
											?>
										</ul>
									</div>
								</td>
								<td>
									<div class="btn-group">
										<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
											SubModulos</button>
										<ul class="dropdown-menu">
											<?php
											$subModulos = array();
											foreach ($this->permisos as $y) {
												if ($row->NombreUsuario == $y->Usuario) {
													if (!in_array($y->SubModulo, $subModulos) && $y->Activo == 1) {
														$subModulos[] = $y->SubModulo;  ?>
														<?php ($y->SubModulo == 1) ?  print_r('<li><a class="dropdown-item" href="#">Permisos Usuario</a></li>') : ''; ?></a></li>
														<?php ($y->SubModulo == 2) ?  print_r('<li><a class="dropdown-item" href="#">Dashboard</a></li>') : ''; ?></a></li>
														<?php ($y->SubModulo == 3) ?  print_r('<li><a class="dropdown-item" href="#">Reportes</a></li>') : ''; ?></a></li>
														<?php ($y->SubModulo == 4) ?  print_r('<li><a class="dropdown-item" href="#">Solicitudes</a></li>') : ''; ?></a></li>
														<?php ($y->SubModulo == 1002) ?  print_r('<li><a class="dropdown-item" href="#">Carga facturas</a></li>') : ''; ?></a></li>
														<?php ($y->SubModulo == 1003) ?  print_r('<li><a class="dropdown-item" href="#">Cheklist</a></li>') : ''; ?></a></li>
											<?php }
												}
											} //FIN DEL FOR
											?>
										</ul>
									</div>
								</td>
								<td>
									<div class="btn-group">
										<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
											Opciones</button>
										<ul class="dropdown-menu">
											<?php
											$opciones = array();
											foreach ($this->permisos as $y) {
												if ($row->NombreUsuario == $y->Usuario) {
													if (!in_array($y->Opcion, $opciones) && $y->Activo == 1) {
														$opciones[] = $y->Opcion; ?>
														<?php ($y->Opcion == 1) ?  print_r('<li><a class="dropdown-item" href="#">Reporte Phillips</a></li>') : ''; ?></a></li>
														<?php ($y->Opcion == 2) ?  print_r('<li><a class="dropdown-item" href="#">Reporte Clientes</a></li>') : ''; ?></a></li>
														<?php ($y->Opcion == 3) ?  print_r('<li><a class="dropdown-item" href="#">solicitudes OB</a></li>') : ''; ?></a></li>
														<?php ($y->Opcion == 1002) ?  print_r('<li><a class="dropdown-item" href="#">Reporte Onbase</a></li>') : ''; ?></a></li>
											<?php }
												}
											} //FIN DEL FOR
											?>
										</ul>
									</div>
								</td>
								<td><button type="button" class="btn-base" onclick=mostrarModalPermisos(<?php echo $i; ?>)>+ Agregar Permisos</button></td>
								<td><button type="button" class="btn-base" onclick=mostrarModalEliminaPermisos(<?php echo $i; ?>)>- Elimina Permisos</button></td>

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
				<div class="modal fade" id="Modal<?php echo $y; ?>" tabindex="-1" role="dialog" aria-labelledby="noDataModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="noDataModalLabel">Actualizar Usuario</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="mb-3">
										<label for="username" class="form-label font-weight-bold">Nombre de Usuario</label>
										<input type="text" class="form-control" id="username<?php echo $y; ?>" placeholder="Ingrese su nombre de usuario"
											value="<?php echo $row->NombreUsuario; ?>" required>
									</div>
									<div class="mb-3">
										<label for="email" class="form-label font-weight-bold">Correo Electrónico</label>
										<input type="email" class="form-control" id="email<?php echo $y; ?>" placeholder="Ingrese su correo electrónico"
											value=<?php echo $row->CorreoElectronico; ?>>
									</div>
									<div class="mb-3">
										<label for="password" class="form-label font-weight-bold">Contraseña</label>
										<input type="text" class="form-control" id="password<?php echo $y; ?>" placeholder="Ingrese su contraseña"
											value="<?php echo $row->Contrasena; ?>">
									</div>

									<div class=" form-check  d-flex justify-content-center">

										<input class="form-check-input " type="checkbox" id="checkbox<?php echo $y; ?>"
											<?php if ($row->Activo == 1) echo 'checked'; ?>>
										<label class="form-check-label font-weight-bold ml-5" for="flexCheckDefault">Activo</label>
									</div>


								</div>
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

			<?php
			$y = 0;
			foreach ($this->consultaUsuarios as $row) {
				$y++;
				//INICIO DEL FOR    
			?>
				<div class="modal fade" id="ModalP<?php echo $y; ?>" tabindex="-1" role="dialog" aria-labelledby="noDataModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="noDataModalLabel">Agregar Permisos</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<select class="selectpicker" id="select<?php echo $y; ?>" onchange=actualizarSelect(<?php echo $y; ?>)>
									<option disabled selected>Open this select menu</option>
									<option value=1>Administracion</option>
									<option value=2>Facturacion</option>
									<option value=3>Operaciones</option>
								</select>
								<select class="selectpicker" id="sub<?php echo $y; ?>" onchange=actualizarOpcion(<?php echo $y; ?>) disabled>
									<option selected value=0>Open this select menu</option>
								</select>
								<select class="selectpicker" id="opcion<?php echo $y; ?>" disabled>
									<option selected value=0>Open this select menu</option>
								</select>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn-base-regresar" data-dismiss="modal"
									onclick="enviaDatosAgregarPermisos(
            							'<?php echo $row->UsuarioID; ?>',
            							'<?php echo $row->NombreUsuario; ?>',
										'<?php echo $y; ?>'
        							)">Guardar</button>
							</div>
						</div>
					</div>

				</div>
			<?php } //FIN DEL FOR
			?>
			<?php
			$y = 100;
			foreach ($this->consultaUsuarios as $row) {
				$y++;
				//INICIO DEL FOR    
			?>
				<div class="modal fade" id="ModalE<?php echo $y; ?>" tabindex="-1" role="dialog" aria-labelledby="noDataModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="noDataModalLabel">Elimina Permisos</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<select class="selectpicker" id="select<?php echo $y; ?>" onchange=actualizarSelect(<?php echo $y; ?>)>
									<option disabled selected>Open this select menu</option>
									<option value=1>Administracion</option>
									<option value=2>Facturacion</option>
									<option value=3>Operaciones</option>
								</select>
								<select class="selectpicker" id="sub<?php echo $y; ?>" onchange=actualizarOpcion(<?php echo $y; ?>) disabled>
									<option selected value=0>Open this select menu</option>
								</select>
								<select class="selectpicker" id="opcion<?php echo $y; ?>" disabled>
									<option selected value=0>Open this select menu</option>
								</select>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn-base-regresar" data-dismiss="modal"
									onclick="enviaDatosAgregarPermisos(0,
            							'<?php echo $row->NombreUsuario; ?>',
										'<?php echo $y; ?>'
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

			function mostrarModalPermisos(idModal) {
				$('#ModalP' + idModal).modal('show');
			}

			function mostrarModalEliminaPermisos(idModal) {
				$('#ModalE10' + idModal).modal('show');
			}



			let subModulos = [{
					id: 1,
					name: "Permisos usuarios",
					idArea: 1
				},
				{
					id: 2,
					name: "Dashboards",
					idArea: 2
				},
				{
					id: 3,
					name: "Reportes",
					idArea: 2
				},
				{
					id: 4,
					name: "Solicitudes",
					idArea: 3
				},
				{
					id: 5,
					name: "Carga Facturas",
					idArea: 3
				},
				{
					id: 1003,
					name: "Cheklist",
					idArea: 2
				}
			];

			let opciones = [{
					id: 1,
					name: "Reporte Phillips",
					idCategoria: 3
				},
				{
					id: 2,
					name: "Reporte Clientes",
					idCategoria: 3
				},
				{
					id: 3,
					name: "Solicitudes OB",
					idCategoria: 4
				},
				{
					id: 1002,
					name: "Reporte Onbase",
					idCategoria: 3
				}
			];

			function actualizarSelect(y) {
				var selec1 = $('#select' + y);
				var selec2 = $('#sub' + y);
				var selec3 = $('#opcion' + y);


				var selectedValue = selec1.val();

				if (selectedValue) {
					// Limpiar el segundo select y añadir las opciones
					selec2.empty().append('<option disabled selected>Open this select menu</option>');

					subModulos
						.filter(function(subModulo) {
							return subModulo.idArea == selectedValue;
						})
						.forEach(function(subModulo) {
							selec2.append(new Option(subModulo.name, subModulo.id));
						});

					selec2.prop('disabled', false); // Habilitar el segundo select
					selec2.selectpicker('refresh');

					// Limpiar y deshabilitar temporalmente el tercer select
					selec3.empty().append('<option disabled selected value = 0>Open this select menu</option>');
					selec3.prop('disabled', true).selectpicker('refresh');
				} else {
					// Deshabilitar ambos selects si no se seleccionó un módulo
					selec2.prop('disabled', true).selectpicker('refresh');
					selec3.prop('disabled', true).selectpicker('refresh');
				}
			}

			function actualizarOpcion(y) {
				var selec2 = $('#sub' + y);
				var selec3 = $('#opcion' + y);

				var selectedValue = selec2.val();

				if (selectedValue) {
					// Limpiar el tercer select y añadir las opciones
					selec3.empty().append('<option disabled selected value = 0>Open this select menu</option>');

					opciones
						.filter(function(opcion) {
							return opcion.idCategoria == selectedValue;
						})
						.forEach(function(opcion) {
							selec3.append(new Option(opcion.name, opcion.id));
						});

					// Refrescar el selectpicker de Bootstrap para que los cambios sean visibles
					selec3.prop('disabled', false).selectpicker('refresh');
				} else {
					selec3.prop('disabled', true).selectpicker('refresh'); // Deshabilitar el tercer select
				}

			}

			function enviaDatosAgregarPermisos(i, name, y) {
				let id = i
				let usuario = name
				var selec1 = parseInt($('#select' + y).val(), 10);
				var selec2 = parseInt($('#sub' + y).val(), 10);
				var selec3 = ($('#opcion' + y).val() == null) ? selec3 = 0 : parseInt($('#opcion' + y).val(), 10);
				let tipo = 3

				var direccion = "http://172.20.20.56:8080/ravisa/onbase/administracionUser";
				var url = direccion + "/" + $.trim(id) + "/" + $.trim(usuario) + "/" + $.trim(selec1) + "/" + $.trim(selec2) + "/" +
					$.trim(selec3) + "/" + $.trim(tipo)



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
						$('#noDataModal').modal('hide')
						location.reload()
					},
					complete: function() {
						limpiar_modal()
					},
				});
			}


			function enviaDatosActualizarUsuario(number, user, email, password, check) {

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
					beforeSend: function() {},
					success: function(data) {
						location.reload()
					},
					complete: function() {},

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