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



	<div class="row  justify-content-center mb-20 mt-5">
		<div class="col-4">
			<button class="btn btn-success fw-bold px-4 py-2 w-100 text-uppercase" onclick="mostrarFormulario()">
				Agregar +
			</button>
		</div>

	</div>

	<!-- <div class="min-height-200px "> -->


	<div class="page-header mb-5 hidden mt-5" id="formulario">

		<div id="error">

		</div>

		<form id="dataForm" >

			<div class="row d-flex justify-content-center g-5  ">

				<div class="col-md-4  col-sm-4  form-floating" id="codigoCont">
					<input type="text" id="codigosn" name="codigosn" class="form-control " onchange="validarCorreo()">
					<label for="codigosn" class="font-weight-bold">Codigo SN</label>
					
				</div>
				<div class="col-md-4  col-sm-4  form-floating">
					
					<input type="text" id="nombresocionegocios" name="nombresocionegocios" class="form-control">
					<label for="nombresocionegocios" class="font-weight-bold">Nombre Socio Negocios</label>
				</div>
				<div class="col-md-4  col-sm-4  form-floating">
					
					<input type="text" id="nombre" name="nombre" class="form-control">
					<label for="nombre" class="font-weight-bold">Nombre Usuario</label>
				</div>
				<div class="col-md-4  col-sm-4  form-floating">
					
					<input type="text" id="direccion" name="direccion" class="form-control">
					<label for="direccion" class="font-weight-bold">Direccion</label>
				</div>
				<div class="col-md-4  col-sm-4  form-floating">
					
					<input type="text" id="puesto" name="puesto" class="form-control">
					<label for="puesto" class="font-weight-bold">Puesto</label>
				</div>

				<div class="col-md-4  col-sm-4  form-floating">
					
					<input type="text" id="funcion" name="funcion" class="form-control">
					<label for="funcion" class="font-weight-bold">Funcion</label>
				</div>
				<div class="col-md-4  col-sm-4  form-floating" id="correoCont">
					
					<input type="email" id="correo" name="correo" class="form-control" onchange="validarCorreo()">
					<label for="correo" class="font-weight-bold">Correo</label>
				</div>
				<div class="col-md-4  col-sm-4  form-floating">
					
					<input type="text" id="supervisor" name="supervisor" class="form-control">
					<label for="supervisor" class="font-weight-bold">Supervisor</label>
				</div>
				<div class="col-md-4  col-sm-4  form-floating">
					
					<input type="email" id="supervisorcorreo" name="supervisorcorreo" class="form-control">
					<label for="supervisorcorreo" class="font-weight-bold">Supervisor correo</label>
				</div>


			</div>

			<div class="row  mb-5 pt-5">
				<div class=" col-md-4 col-lg-2  col-sm-6 form-check">
					<input class="form-check-input" type="checkbox" value="1" id="nuevolaredo" name="nuevolaredo" style="border-color: black;">
					<label class="form-check-label  " for="nuevolaredo">
						Nuevo Laredo
					</label>
				</div>
				<div class=" col-md-4 col-lg-2   col-sm-6 form-check">
					<input class="form-check-input" type="checkbox" value="1" id="mazatlan" name="mazatlan" style="border-color: black;">
					<label class="form-check-label " for="mazatlan">
						Mazatlan
					</label>
				</div>
				<div class=" col-md-4 col-lg-2  col-sm-6 form-check">
					<input class="form-check-input" type="checkbox" value="1" id="mexico" name="mexico" style="border-color: black;">
					<label class="form-check-label " for="mexico">
						Mexico
					</label>
				</div>
				<div class=" col-md-4 col-lg-2  col-sm-6 form-check">
					<input class="form-check-input" type="checkbox" value="1" id="manzanillo" name="manzanillo" style="border-color: black;">
					<label class="form-check-label " for="manzanillo">
						Manzanillo
					</label>
				</div>
				<div class=" col-md-4 col-lg-2  col-sm-6 form-check">
					<input class="form-check-input" type="checkbox" value="1" id="monterrey" name="monterrey" style="border-color: black;">
					<label class="form-check-label " for="monterrey">
						Monterrey
					</label>
				</div>
				<div class=" col-md-4 col-lg-2  col-sm-6 form-check">
					<input class="form-check-input" type="checkbox" value="1" id="veracruz" name="veracruz" style="border-color: black;">
					<label class="form-check-label " for="veracruz">
						Veracruz
					</label>
				</div>
				<div class=" col-md-4 col-lg-2  col-sm-6 form-check">
					<input class="form-check-input" type="checkbox" value="1" id="toluca" name="toluca" style="border-color: black;">
					<label class="form-check-label " for="toluca">
						Toluca
					</label>
				</div>
				<div class=" col-md-4 col-lg-2 col-sm-6 form-check">
					<input class="form-check-input" type="checkbox" value="1" id="sanluispotosi" name="sanluispotosi" style="border-color: black;">
					<label class="form-check-label " for="sanluispotosi">
						San Luis Potosi
					</label>
				</div>
				<div class=" col-md-4 col-lg-2  col-sm-6 form-check">
					<input class="form-check-input" type="checkbox" value="1" id="coatzacoalcos" name="coatzacoalcos" style="border-color: black;">
					<label class="form-check-label " for="coatzacoalcos">
						Coatzoacalcos
					</label>
				</div>
			</div>

			<div class="row justify-content-between mt-5">
				<div class="col-2">
					<button class="btn btn-success fw-bold px-4 py-2 w-100 text-uppercase" data-tipo="1" data-id="" type="submit">
						Guardar
					</button>
				</div>
				<div class="col-2">
					<button class="btn btn-danger fw-bold px-4 py-2 w-100 text-uppercase" type="button" onclick="cerrarFormulario()">
						Cancelar
					</button>
				</div>
			</div>


		</form>
		<!-- </div> -->

	</div>

	<div class="row d-flex justify-content-center">
		<div class="col-8 d-flex justify-content-center">
			<table id="tablaUser" name="tablaUser" class="table table-responsive mt-10 align-items-center ">
				<thead class="text-blue">
					<tr>
						<th width=30% class="fs-6 text-left text-uppercase fw-bold">Usuario</th>
						
						<th width=30% class="fs-6 text-left text-uppercase fw-bold">Codigo</th>
						

					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($this->consultaUsuarios as $row) {
						$row_json = json_encode($row); //INICIO DEL FOR 

					?>
						<tr>
							<td class="align-items-center fs-6"><?php echo $row->Nombre; ?></td>
							
							<td class="align-items-center fs-6"><?php echo $row->{"Codigo SN"}; ?></td>

							<td>
								<button class="btn btn-light btn-sm  text-uppercase" onclick="editarUsuario(<?php echo htmlspecialchars($row_json); ?>)">
									Editar <i class="bi bi-pencil"></i>
								</button>
							</td>


						</tr>
					<?php } //FIN DEL FOR
					?>
				</tbody>
			</table>
		</div>
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


			var formData = new FormData(this); // Captura los datos del formulario
			let tipo = $("button[type='submit']").attr("data-tipo");
			let id = $("button[type='submit']").attr("data-id")


			if (tipo === "1") {
				formData.append("tipo", 1);
			} else {
				formData.append("tipo", 2);
				formData.append("id", id);

			}



			$.ajax({
				url: "http://172.20.20.56:8080/ravisa/onbase/administracionCorreos", // Archivo PHP que procesará los datos
				type: 'POST',
				data: formData,
				contentType: false, // Importante para FormData
				processData: false, // Evita que jQuery convierta los datos en una cadena
				success: function(response) {
					$("#error").empty();
					$("#error").append('<div class="alert alert-success text-center" role="alert" style="margin-top:0.3rem; ">Datos enviados con exito</div>')
					setTimeout(() => {
						location.reload()
					}, 1000)
				},
				error: function(xhr, status, error) {
					console.error("Error en la solicitud AJAX: " + error);
				}
			});
		});
	});

	// $("#dataForm").on("input", function() {
	// 	let formularioValido = true;
	// 	$("#dataForm input:not([type='checkbox'])").each(function() {
	// 		if (!$(this).val().trim()) {
	// 			formularioValido = false;
	// 		}
	// 	});

	// 	if (formularioValido) {
	// 		$("button[type='submit']").removeClass("disabled")
	// 	}else {
	// 		$("button[type='submit']").addClass("disabled")
	// 		$("#error").append('<div class="alert alert-danger text-center" role="alert" style="margin-top:0.3rem; ">Favor de llenar al menos un campo de la factura</div>')
	// 	}
	// })



	function mostrarFormulario() {
		//$('#formulario').css('opacity', 0).removeClass('hidden').animate({ opacity: 1 }, 500);
		$('#formulario').hide().removeClass('hidden').slideDown(500);
		//$('#formulario').hide().removeClass('hidden').fadeIn(500);
	}

	function cerrarFormulario() {

		$('#formulario').slideUp(500, function() {
			$(this).addClass('hidden');
			$("#dataForm input").val('')
			$("#dataForm input[type='checkbox']").prop("checked", false)
			$("button[type='submit']").attr("data-tipo", "1");
			$("#error").empty();
			codigoError(2)
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
			} else {
				elemento.val(valor)
			}

			if (indice === "id") {
				$("button[type='submit']").attr("data-id", valor);
			}



		})

	}

	function codigoError(id){
		if(id === 1){
			$("#codigoCont").append('<p class="invalid-feedback" style="position: absolute;">Codigo ya esta enlazado con correo</p>')
			$("#codigosn").addClass("is-invalid")
			$("button[type='submit']").addClass("disabled")
		}else{
			$("#codigoCont").prop('<p class="invalid-feedback" style="position: absolute;">Codigo ya esta enlazado con correo</p>')
			$("#codigosn").removeClass("is-invalid")
			$("button[type='submit']").removeClass("disabled")
		}
		
	}

	function validarCorreo() {
		if ($("button[type='submit']").attr("data-tipo") === "1") {
			let correo = $("#correo").val()
			let codigo = $("#codigosn").val()

			var direccion = "http://172.20.20.56:8080/ravisa/onbase/validarUsuarioDetalle";
			var url = direccion + "/" + $.trim(codigo) + "/" + $.trim(correo) + "/";

			$.ajax({
				type: 'POST',
				url: url,
				dataType: 'json', // Archivo PHP que procesará los datos
				success: function(response) {
					if (response.length > 0) {
						codigoError(1)
						
					}else{
						codigoError(2)
					}

				},
				error: function(xhr, status, error) {
					console.error("Error en la solicitud AJAX: " + error);
				}
			});


		}




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
</script>