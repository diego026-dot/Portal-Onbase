<?php include("public/inc/encabezadoCambioRef.php"); ?>

<div class="container-fluid" style="margin-top: 0; padding-top: 0;">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between">
            <nav aria-label="breadcrumb" role="navigation" class="bg-transparent">
                <ol class="breadcrumb mb-1 bg-transparent">
                    <li class="breadcrumb-item">
                        <img src="https://static.wixstatic.com/media/fe7c4c_794ee55525f8446ba0a6ba64d5afaeb6~mv2.png/v1/fill/w_120,h_48,al_c,lg_1,q_85,enc_auto/fe7c4c_794ee55525f8446ba0a6ba64d5afaeb6~mv2.png" alt="Icono" style="width: 40px; height: auto; margin-right: 10px;">
                        <a href="#">Facturación</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Cambio de Referencia</li>
                </ol>
            </nav>
            
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
                <label for="ref" class="form-label fw-bold">Referencia</label>
                <input
                    id="ref"
                    type="text"
                    class="form-control "
                    placeholder="Ingrese la referencia a modificar"
                    >
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="mb-3 col-6">
                <label for="num" class="form-label fw-bold">Folio SAP</label>
                <input
                    id="num"
                    type="text"
                    class="form-control"
                    placeholder="Ingrese el folio SAP"
                    >

                <button  class="btn btn-primary mt-3 col-12" onclick="enviaDatos()">Guardar</button>
            </div>
        </div>

        <div id="main"></div>

      

    </div>

    <!-- Contenedor para el overlay -->
    <div id="overlay" class="ocultar"></div>


    <!-- Contenedor para el GIF de carga -->
    <div id="loading" class="cargando">
        <img src="<?php echo constant('IMG'); ?>preloader/cargando2.gif" alt="" class="light-logo" style="height:70px;">
    </div>

</div>

<?php include("public/inc/jsfooterCambioRef.php"); ?>

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
        var referencia = $("#ref").val();
        var folioSap = $("#num").val();

        if(referencia === '' || folioSap === ''){
                
                $("#main").find(".alert").remove();
                $("#main").append($('<div class="alert alert-danger text-center" role="alert" style="margin-top:0.3rem; ">Favor de llenar todos los datos</div>'))
                return
            }

        $("#main").find(".alert").remove();
        

        var direccion = "http://172.20.20.56:8080/ravisa/onbase/cambioReferencia";
        var url = direccion + "/" + $.trim(referencia) + "/" + $.trim(folioSap) ;
        console.log(url)
        
        $("#overlay").show();
        $("#loading").show();

        $.ajax({
            type: "POST",
            url: url,

            
            beforeSend: function() {},

            success: function(data) {
       
            },
            complete: function() {
                $("#overlay").hide();
                $("#loading").hide();
                $("#ref").val('');
                $("#num").val('');
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