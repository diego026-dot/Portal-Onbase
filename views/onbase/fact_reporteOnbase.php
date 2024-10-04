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
    <div class="row mt-5 justify-content-center align-items-center mb-2">
        <div class="col-md-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="option" id="radioCL" value="1">
                <label class="form-check-label" for="radioCliente">
                     Reporte Control SUM
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="option" id="radioCS" value="2" >
                <label class="form-check-label" for="radioProvedor">
                   Reporte CL
                </label>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <label for="calendarioI" class="form-label mb-1">Fecha inicio</label>
            <input type="date" class="form-control" id="calendarioI" name="calendarioI" step="1" min="2022-01-01" max="<?php echo date("Y-m-d"); ?>" value="">
        </div>
        <div class="col-md-2 mb-3">
            <label for="calendarioF" class="form-label mb-1">Fecha fin</label>
            <input type="date" class="form-control" id="calendarioF" name="calendarioF" step="1" min="2022-01-01" max="<?php echo date("Y-m-d"); ?>" value="">
        </div>

        <div class="col-md-2">
            <button type="button" class=" btn-base  mr-3" onclick="enviaDatosClienteDetalle();">Buscar</button>
            <button type="button" 
            onclick="($('input[name=\'option\']:checked').val() == 1) ? enviaDatos() : excel()" 
            class="btn-base" id="botonExcel" style="background-color:green " disabled>Excel</button>

        </div>


    </div>


    <!-- Modal -->
    <div class="modal fade" id="noDataModal" tabindex="-1" role="dialog" aria-labelledby="noDataModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noDataModalLabel">Sin resultados</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    No se encontraron datos del cliente solicitado.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-base-regresar" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <div class="min-height-200px ">
        <div class="page-header mb-5">
            
            <div class="table-responsive mt-3">
                <div id="ReporteClienteP"> </div>
            </div>

        </div>


        <!-- Contenedor para el overlay -->
        <div id="overlay" class="ocultar"></div>


        <!-- Contenedor para el GIF de carga -->
        <div id="loading" class="cargando">
            <img src="<?php echo constant('IMG'); ?>preloader/cargando2.gif" alt="" class="light-logo" style="height:70px;">
        </div>

    </div>

    <?php include("public/inc/jsfooter.php"); ?>

    <script>
        function regresar() {
            window.location = '<?php echo constant('URL') ?>onbase/facturacionReportes/';
        }


        function enviaDatos() {
            var fechaI = $("#calendarioI").val();
            var fechaF = $("#calendarioF").val();

            var direccion = "http://172.20.20.56:8080/ravisa/onbase/cargaReporteExcelOnbase";
            var url = direccion + "/" + $.trim(fechaI) + "/" + $.trim(fechaF) 
            var nombreExcel = "ReporteOB.csv"
            $("#overlay").show();
            $("#loading").show();

            
            $.ajax({
                type: "POST",
                url: url,

                xhrFields: {
                    responseType: 'blob'
                },
                beforeSend: function() {},

                success: function(data) {
                    console.log(data)
                    console.log(data.size); // Verifica el tamaño del Blob (no debe ser undefined)
                    console.log(data.type); 
                    var a = document.createElement('a');
                    var url = window.URL.createObjectURL(data);
                    a.href = url;
                    a.download = nombreExcel;
                    document.body.append(a);
                    a.click();
                    a.remove();
                    window.URL.revokeObjectURL(url);
                },
                complete: function() {
                    $("#overlay").hide();
                    $("#loading").hide();
                },
                error: function() {
                    alert("A ocurrido algun error")
                    $("#overlay").hide();
                    $("#loading").hide();
                }

            });
        }
        function excel() {
            var fechaI = $("#calendarioI").val();
            var fechaF = $("#calendarioF").val();

            var direccion = "http://172.20.20.56:8080/ravisa/onbase/cargaReporteExcelOnbaseCL";
            var url = direccion + "/" + $.trim(fechaI) + "/" + $.trim(fechaF) 
            var nombreExcel = "ReporteCL.csv"
            $("#overlay").show();
            $("#loading").show();

            $.ajax({
                type: "POST",
                url: url,

                xhrFields: {
                    responseType: 'blob'
                },
                beforeSend: function() {},

                success: function(data) {
                    var a = document.createElement('a');
                    var url = window.URL.createObjectURL(data);
                    a.href = url;
                    a.download = nombreExcel;
                    document.body.append(a);
                    a.click();
                    a.remove();
                    window.URL.revokeObjectURL(url);
                },
                complete: function() {
                    $("#overlay").hide();
                    $("#loading").hide();
                },
                error: function() {
                    alert("A ocurrido algun error")
                    $("#overlay").hide();
                    $("#loading").hide();
                }

            });
        }



        function enviaDatosClienteDetalle() {
            var tipo = $('input[name="option"]:checked').val();
            var fechaI = $("#calendarioI").val();
            var fechaF = $("#calendarioF").val();
            let direccion 

            if(tipo == 1){
                direccion = "http://172.20.20.56:8080/ravisa/onbase/cargaTabla_ReporteOnbase";
            }else if(tipo == 2){
                direccion = "http://172.20.20.56:8080/ravisa/onbase/cargaTabla_ReporteOnbaseCL";
            }

            
            var url = direccion + "/" + $.trim(fechaI) + "/" + $.trim(fechaF) 

            $("#overlay").show();
            $("#loading").show();

            
            $.ajax({
                type: "POST",
                url: url,
                beforeSend: function() {

                },
                success: function(data) {
                    $("#ReporteClienteP").html(data);
                    var dataFound = $("#data_found").val() === '1';
                   
                    if (!dataFound) {
                        // Mostrar el modal si no se encontraron datos
                        $('#noDataModal').modal('show');
                        $("#botonExcel").prop('disabled', true);
                    } else {
                        // Habilitar el botón de exportar a Excel
                        $("#botonExcel").prop('disabled', false);
                    }

                },

                complete: function() {
                    $("#overlay").hide();
                    $("#loading").hide();
                },
                error: function() {
                    alert("A ocurrido algun error")
                    $("#overlay").hide();
                    $("#loading").hide();
                }


            });
        }
    </script>