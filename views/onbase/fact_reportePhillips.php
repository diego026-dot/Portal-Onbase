<?php include("public/inc/encabezado_sinbusqueda.php"); ?>

<div class="main-container">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
			<div class="page-header mb-5">
				<div class="row">
					<div class="col-12">
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Facturacion</a></li>
								<li class="breadcrumb-item active" aria-current="page">Reportes</li>
							</ol>
						</nav>
					</div>
					<div class="col-3 mt-3   ">
						<form>
							<div class="form-group d-flex align-items-center">
								<input type="date" class="form-control m-3" id="searchDate" placeholder="Selecciona una fecha">
								<button type="submit" class="btn btn-secondary " style="height: 40px;">Buscar</button>
							</div>
						</form>

					</div>
					<!--<div class="col-2"><button type="submit" class="btn btn-secondary btn-sm btn-block">Buscar</button></div> -->

					<div class="col-md-6 col-sm-12 text-right"></div>
				</div>
				<br>
				<table id="tabla" class="table table-hover multiple-select-row">


					<thead>
						<tr>
							<th scope="col">Usuario</th>
							<th scope="col">Total Módulos</th>
							<th scope="col">Total Opciones</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>

						<tr>
							<td>
								<button type="button" class="btn-sm btn btn-link" onclick="modal_usuario('<?php echo rtrim(ltrim($row->Usuario)); ?>','<?php echo rtrim(ltrim($row->Usuario)); ?>');" data-toggle="modal" data-target="#AgregarPerm" <?php echo $row->Usuario; ?>>
									<?php echo $row->Usuario; ?>
								</button>
							</td>
							<td><?php echo $row->Modulo; ?></td>
							<td><?php echo $row->Opcion; ?></td>
							<td width="10px"><button type="button" class="btn btn-danger btn-sm" onclick="elimina_permisos('<?php echo rtrim(ltrim($row->Usuario)); ?>');" data-toggle="modal" data-target="#EliminarPerm" <?php echo $row->Usuario; ?>>Eliminar Permisos </button></td>
						</tr>

					</tbody>
				</table>
			</div>
			<div class="col">
				<div class="form-group">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" style="width:100px"><b></b></span>
						</div>

					</div>
				</div>
				<br>
			</div>
			<?php echo mensaje(); ?>
		</div>
	</div>
</div>
</div>
</div>
<br>
<?php include("public/inc/jsfooter.php"); ?>
<?php include("views/onbase/modals/modal_permiso_usuario.php"); ?>
<?php include("views/onbase/modals/modal_elimina_permisos.php"); ?>

</html>
<script>
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
		$("#selectModulo").val('');
		$("#selectOpcionvalores").val('');
		$("#selectSubMod").val('');
		$("#selectOpcion").val('');
		$("#selectOpcionvalores").val('');
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