<?php include("public/inc/encabezado_sinbusqueda.php"); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.7.7/xlsx.core.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xls/0.7.4-a/xls.core.min.js"></script>
<div class="main-container">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
			<div class="page-header mb-5">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Compras</a></li>
								<li class="breadcrumb-item active" aria-current="page">Carga masiva vendor price</li>
							</ol>
						</nav>

					</div>
					<div class="col-md-6 col-sm-12 text-right"></div>
				</div>
				<div class="col-md-6 col-sm-12 text-right">



				</div>

			</div>
			<div>


				<div class="row mt-2">
					<div class="col">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<input type="file" class="form-control" id="file_evaluacion_mensual"
									name="file_evaluacion_mensual" accept=".xlsx,.xls" style="display: none;" required="">

							</div>

							<button type="button" class="btn btn-dark float-right" onclick="botonCargaExcel();" id="btnFile" name="btnFile">
								<i class="fa fa-upload" aria-hidden="true"></i>
							</button>

							<button type="button" onclick="convierteexcel();" class="btn btn-success float-right">
								Guardar Excel <i class="fa fa-floppy-o" aria-hidden="true"></i></button>

							<button type="button" id="btnUactivo" name="btnUactivo" onclick="insertaUsuarioActivo();" class="btn btn-warning float-right">
								Usuario Activo <i class="fa fa-user-o" aria-hidden="true"></i></button>


							<label name="userOnline1" id="userOnline1" class="col-sm-12 col-md-2 col-form-label">
								<strong>Usuario actualmente trabajando: </strong> <label name="userOnline2" id="userOnline2"><strong style="color: green;">
										<?php echo $_SESSION['strUsuario']; ?></strong></label> </label>

							<?php foreach ($this->consultaUsuarioCMP as $row) { ?>



								<strong>Usuario actualmente trabajando: </strong>
								<div class="col">
									<strong style="color: green;"><?php echo $row->USUARIO; ?> </strong>

								<?php } ?>


								<input onchange="mostrarDiv();" id="inputActivo" name="inputActivo" tyype="hidden" value="0">

								</div>

						</div>
						<ol class="breadcrumb">
							<li class="breadcrumb-item active" aria-current="page">Total de registros: <strong id="totalreg" name="totalreg"> </strong></li>
						</ol>

						<table id="tablaVendor" class="table table-hover">
							<thead>
								<td width="10px" style="text-align: center;"><strong>Id Proveedor</strong></td>
								<td width="10px" style="text-align: center;"><strong>Artículo</strong></td>
								<td width="10px" style="text-align: center;"><strong>Costo Nuevo</strong></td>
								<td width="10px" style="text-align: center;"><strong>Min Compra</strong></td>
								<td width="10px" style="text-align: center;"><strong>Núm Parte</strong></td>
								<td width="10px" style="text-align: center;"><strong>UdeM</strong></td>
								<td width="10px" style="text-align: center;"><strong>Sustituto</strong></td>
								<td width="10px" style="text-align: center;"><strong>Baja Vendor</strong></td>
								<td width="10px" style="text-align: center;"><strong>Moneda Nueva</strong></td>
								<td width="10px" style="text-align: center;"><strong>Clave Referencia</strong></td>
							</thead>
							<tbody id="detalle_excel" name="detalle_excel">
							</tbody>
						</table>

					</div>
					<?php echo mensaje(); ?>
				</div>
			</div>
		</div>
		<?php include("public/inc/jsfooter.php"); ?>

		</html>

		<script>
			$(document).ready(function() {
				mostrarDiv();


				! function(a) {
					"use strict";
					a.fn.tableToJSON = function(b) {
						var c = {
							ignoreColumns: [],
							onlyColumns: null,
							ignoreHiddenRows: !0,
							ignoreEmptyRows: !1,
							headings: null,
							allowHTML: !1,
							includeRowId: !1,
							textDataOverride: "data-override",
							textExtractor: null
						};
						b = a.extend(c, b);
						var d = function(a) {
								return void 0 !== a && null !== a
							},
							e = function(c) {
								return d(b.onlyColumns) ? -1 === a.inArray(c, b.onlyColumns) : -1 !== a.inArray(c, b.ignoreColumns)
							},
							f = function(b, c) {
								var e = {},
									f = 0;
								return a.each(c, function(a, c) {
									f < b.length && d(c) && (e[b[f]] = c, f++)
								}), e
							},
							g = function(c, d, e) {
								var f = a(d),
									g = b.textExtractor,
									h = f.attr(b.textDataOverride);
								return null === g || e ? a.trim(h || (b.allowHTML ? f.html() : d.textContent || f.text()) || "") : a.isFunction(g) ? a.trim(h || g(c, f)) : "object" == typeof g && a.isFunction(g[c]) ? a.trim(h || g[c](c, f)) : a.trim(h || (b.allowHTML ? f.html() : d.textContent || f.text()) || "")
							},
							h = function(c, d) {
								var e = [],
									f = b.includeRowId,
									h = "boolean" == typeof f ? f : "string" == typeof f ? !0 : !1,
									i = "string" == typeof f == !0 ? f : "rowId";
								return h && "undefined" == typeof a(c).attr("id") && e.push(i), a(c).children("td,th").each(function(a, b) {
									e.push(g(a, b, d))
								}), e
							},
							i = function(a) {
								var c = a.find("tr:first").first();
								return d(b.headings) ? b.headings : h(c, !0)
							},
							j = function(c, h) {
								var i, j, k, l, m, n, o, p = [],
									q = 0,
									r = [];
								return c.children("tbody,*").children("tr").each(function(c, e) {
									if (c > 0 || d(b.headings)) {
										var f = b.includeRowId,
											h = "boolean" == typeof f ? f : "string" == typeof f ? !0 : !1;
										n = a(e);
										var r = n.find("td").length === n.find("td:empty").length ? !0 : !1;
										!n.is(":visible") && b.ignoreHiddenRows || r && b.ignoreEmptyRows || n.data("ignore") && "false" !== n.data("ignore") || (q = 0, p[c] || (p[c] = []), h && (q += 1, "undefined" != typeof n.attr("id") ? p[c].push(n.attr("id")) : p[c].push("")), n.children().each(function() {
											for (o = a(this); p[c][q];) q++;
											if (o.filter("[rowspan]").length)
												for (k = parseInt(o.attr("rowspan"), 10) - 1, m = g(q, o), i = 1; k >= i; i++) p[c + i] || (p[c + i] = []), p[c + i][q] = m;
											if (o.filter("[colspan]").length)
												for (k = parseInt(o.attr("colspan"), 10) - 1, m = g(q, o), i = 1; k >= i; i++)
													if (o.filter("[rowspan]").length)
														for (l = parseInt(o.attr("rowspan"), 10), j = 0; l > j; j++) p[c + j][q + i] = m;
													else p[c][q + i] = m;
											m = p[c][q] || g(q, o), d(m) && (p[c][q] = m), q++
										}))
									}
								}), a.each(p, function(c, g) {
									if (d(g)) {
										var i = d(b.onlyColumns) || b.ignoreColumns.length ? a.grep(g, function(a, b) {
												return !e(b)
											}) : g,
											j = d(b.headings) ? h : a.grep(h, function(a, b) {
												return !e(b)
											});
										m = f(j, i), r[r.length] = m
									}
								}), r
							},
							k = i(this);
						return j(this, k)
					}
				}(jQuery);

			});



			function convierteexcel() {


				var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xlsx|.xls)$/;
				//Checks whether the file is a valid excel file/  
				if (regex.test($("#file_evaluacion_mensual").val().toLowerCase())) {
					var xlsxflag = false;
					//Flag for checking whether excel is .xls format or .xlsx format/  
					if ($("#file_evaluacion_mensual").val().toLowerCase().indexOf(".xlsx") > 0) {
						xlsxflag = true;
					}
					//Checks whether the browser supports HTML5/  
					if (typeof(FileReader) != "undefined") {
						var reader = new FileReader();
						reader.onload = function(e) {
							var data = e.target.result;
							//Converts the excel data in to object/  
							if (xlsxflag) {
								var workbook = XLSX.read(data, {
									type: 'binary'
								});
							} else {
								var workbook = XLS.read(data, {
									type: 'binary'
								});
							}
							//Gets all the sheetnames of excel in to a variable/  
							var sheet_name_list = workbook.SheetNames;

							var cnt = 0;
							//This is used for restricting the script to consider only first sheet of excel/  
							sheet_name_list.forEach(function(y) {
								//Iterate through all sheets/  
								///Convert the cell value to Json/  
								if (xlsxflag) {
									var exceljson = XLSX.utils.sheet_to_json(workbook.Sheets[y]);
								} else {
									var exceljson = XLS.utils.sheet_to_row_object_array(workbook.Sheets[y]);
								}
								if (exceljson.length > 0 && cnt == 0) {
									cargar_excel(exceljson);
									cnt++;

								}
							});
							$('#detalle_evaluacion_mensual').show();
						}
						if (xlsxflag) {
							//If excel file is .xlsx extension than creates a Array Buffer from excel/  
							reader.readAsArrayBuffer($("#file_evaluacion_mensual")[0].files[0]);
						} else {
							reader.readAsBinaryString($("#file_evaluacion_mensual")[0].files[0]);
						}
					} else {
						alert("Sorry! Your browser does not support HTML5!");
					}
				} else {
					//notificacion_sweet(2, '¡Advertencia!','Favor de adjuntar excel!', 4000);
					alert("Falta cargar el archivo de tipo excel!");
				}


			}



			function cargar_excel(excel_json) {

				html = '';

				for (i = 0; i < excel_json.length; i++) {

					html = html + '<tr>' +
						'<td class="text-center">' + excel_json[i].IDPROVEEDOR + '</td>' +
						'<td class="text-center">' + excel_json[i].ARTICULO + '</td>' +
						'<td class="text-center">' + excel_json[i].COSTONUEVO + '</td>' +
						'<td class="text-center">' + excel_json[i].MINCOMPRA + '</td>' +
						'<td class="text-center">' + excel_json[i].NUMPARTE + '</td>' +
						'<td class="text-center">' + excel_json[i].UDEM + '</td>' +
						'<td class="text-center">' + excel_json[i].SUSTITUTO + '</td>' +
						'<td class="text-center">' + excel_json[i].BAJAVENDOR + '</td>' +
						'<td class="text-center">' + excel_json[i].MONEDANUEVA + '</td>' +
						'<td class="text-center">' + excel_json[i].CLAVEREFERENCIA + '</td>' +

						'</tr>';

					//guardar(excel_json[i].Id,excel_json[i].AgenteId)
				}
				$("#detalle_excel").html(html);
				convertToXML();

				$("#totalreg").html(excel_json.length);

			}

			function convertToXML() {
				// Obtener la tabla
				var table = document.getElementById('detalle_excel');

				// Crear un objeto XML
				var xmlData = document.createElement('data');

				// Recorrer las filas de la tabla
				for (var i = 0; i < table.rows.length; i++) {
					var row = table.rows[i];
					var xmlRow = document.createElement('row');

					// Recorrer las celdas de la fila
					for (var j = 0; j < row.cells.length; j++) {
						var cell = row.cells[j];
						var xmlCell = document.createElement('cell');
						xmlCell.textContent = cell.innerHTML;

						// Agregar la celda a la fila
						xmlRow.appendChild(xmlCell);
					}

					// Agregar la fila al objeto XML
					xmlData.appendChild(xmlRow);
				}

				// Serializar el objeto XML a una cadena
				var xmlString = new XMLSerializer().serializeToString(xmlData);

				xmlString = xmlString.replace('xmlns="http://www.w3.org/1999/xhtml"', '');

				// Enviar los datos XML al servidor
				enviarDatosXML(xmlString);
				console.log(xmlString);
			}



			function enviarDatosXML(xmlString) {
				//alert(xmlString);
				//var direccion = "http://192.168.1.191:81/coflex/onbase/enviaXMLtabla";
				//var url = direccion+"/"+$.trim(xmlString);

				//alert(url);

				var datos = {
					"XmlDatos": xmlString
				}

				var peticion = $.ajax({
					url: 'http://192.168.1.191:81/coflex/onbase/enviaXMLtabla/',
					data: datos,
					type: 'POST',
					success: function(respuesta) {
						//alert(respuesta);
					},
					error: function() {
						console.log("No se ha podido obtener la información");
					}
				});

			}

			function botonCargaExcel() {
				// Activar el campo de entrada al simular un clic en él
				$("#file_evaluacion_mensual").click();

			}


			function insertaUsuarioActivo() {
				$("#inputActivo").val('1');
				mostrarDiv();


				//var clave = "<?php echo $_SESSION['SESSION_id']; ?>";
				var usuario = "<?php echo $_SESSION['strUsuario']; ?>";

				var direccion = "http://192.168.1.191:81/coflex/onbase/insertaUsuarioControl";

				var url = direccion + "/" + $.trim(usuario) + "/" + $.trim(1) + "/" + $.trim(1);

				$.ajax({
					type: "POST",
					url: url,
					beforeSend: function() {


					},
					success: function(data) {

					}
				});
			}

			function mostrarDiv() {



				var mActivo = $("#inputActivo").val();

				if (mActivo == "1") {
					$("#inputActivo").hide();
					$("#userOnline1").show();
					$("#userOnline2").show();
				} else {
					$("#inputActivo").hide();
					$("#userOnline1").hide();
					$("#userOnline2").hide();
				}

				function insertaRegistroLogout() {

					var usuario = "<?php echo $_SESSION['strUsuario']; ?>";

					var direccion = "http://192.168.1.191:81/coflex/onbase/insertaUsuarioControl";



					var url = direccion + "/" + $.trim(usuario) + "/" + $.trim(0) + "/" + $.trim(2);

					$.ajax({
						type: "POST",
						url: url,
						beforeSend: function() {},
						success: function(data) {

						}
					});
				}

				window.addEventListener('beforeunload', function(event) {
					insertaRegistroLogout();
					// Puedes agregar más lógica aquí si es necesario
				});
				//window.addEventListener('beforeunload', insertaRegistroLogout());

			}
		</script>