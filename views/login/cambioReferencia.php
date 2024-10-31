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



    <div class="row bg-body-tertiary m-5 ">

        <div class="row d-flex justify-content-center">
            <div class="col-6 mt-4 mb-3 ">
                <label for="ref" class="form-label fw-bold text-uppercase">Cambio de referencia</label>
                <input
                    id="ref"
                    type="text"
                    class="form-control"
                    placeholder="Ingresa la referencia"
                    >
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="mb-3 col-6">
                <label for="num" class="form-label fw-bold text-uppercase">Numero de ..</label>
                <input
                    id="num"
                    type="text"
                    class="form-control"
                    placeholder="Ingresa el num .."
                    >

                <button  class="btn btn-primary mt-3 col-12">Guardar</button>
            </div>
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

    // function excel() {
    //     $("#tabla20").table2excel({
    //         formats: ["xlsx"],
    //         position: 'bottom',
    //         bootstrap: false,
    //         name: "reclamos_tiempos",
    //         filename: 'reclamos_tiempos'
    //     });
    // }

    function enviaDatos() {
        var fechaI = $("#calendarioI").val();
        var fechaF = $("#calendarioF").val();
        var cliente = $("#selectCliente").val();

        var direccion = "http://172.20.20.56:8080/ravisa/onbase/cargaReporteExcel";
        var url = direccion + "/" + $.trim(fechaI) + "/" + $.trim(fechaF) + "/" + $.trim(cliente);
        var nombreExcel = "Reporte: " + $.trim(cliente) + "/" + $.trim(fechaI) + "/" + $.trim(fechaF) + "/";
        $("#overlay").show();
        $("#loading").show();

        $.ajax({
            type: "POST",
            url: url,

            beforeSend: function() {},

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



    function enviaDatosClienteDetalle(norma, proceso) {
        var fechaI = $("#calendarioI").val();
        var fechaF = $("#calendarioF").val();
        let select = $("#selectCliente").val()
        var cliente = select === null ? '' : select;


        var direccion = "http://172.20.20.56:8080/ravisa/onbase/cargaTabla_ReportePhilips";
        var url = direccion + "/" + $.trim(fechaI) + "/" + $.trim(fechaF) + "/" + $.trim(cliente);


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