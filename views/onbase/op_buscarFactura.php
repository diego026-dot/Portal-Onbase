<?php include("public/inc/encabezado_sinbusqueda.php"); ?>
<style>
    .hidden {
    display: none !important;
}
</style>
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
                <input class="form-check-input" type="radio" name="option" id="radioCliente" value="1">
                <label class="form-check-label" for="radioCliente">
                     Cliente
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="option" id="radioProvedor" value="2" >
                <label class="form-check-label" for="radioProvedor">
                    Proovedor
                </label>
            </div>
        </div>
        <div class="col-lg-2 col-md-12 mr-4 mb-2 hidden" id="input1" >
            <label for="selectCliente" class="form-label mb-1">Cliente</label>
            <select class="selectpicker" aria-label="Clientes" id="selectCliente" name="selectCliente" required>
                <option value="" disabled selected>Selecciona un cliente</option>
                <?php foreach ($this->selectClientes as $row) { ?>
                    <option value="<?php echo $row->Cliente; ?>"><?php echo $row->Cliente; ?></option>
                <?php } ?>
                <option value="">Cliente</option>
            </select>
        </div>
        <div class="col-lg-2 col-md-12 mr-4 mb-2 hidden" id="input2">
            <label for="selectCliente" class="form-label mb-1">Proovedor</label>
            <select class="selectpicker" aria-label="Clientes" id="selectProveedor" name="selectProveedor" required>
                <option value="" disabled selected>Selecciona un Proovedor</option>
                <?php foreach ($this->selectProveedor as $row) { ?>
                    <option value="<?php echo $row->Proveedor; ?>"><?php echo $row->Proveedor; ?></option>
                <?php } ?>

                <option value="">Proovedor</option>
            </select>
        </div>
        <div class="col-md-2 mb-3">
            <label for="calendarioI" class="form-label mb-1">Fecha inicio</label>
            <input type="date" class="form-control" id="calendarioI" name="calendarioI" step="1" min="2023-01-01" max="<?php echo date("Y-m-d"); ?>" value="">
        </div>
        <div class="col-md-2 mb-3">
            <label for="calendarioF" class="form-label mb-1">Fecha fin</label>
            <input type="date" class="form-control" id="calendarioF" name="calendarioF" step="1" min="2023-01-01" max="<?php echo date("Y-m-d"); ?>" value="">
        </div>

        <div class="col-md-2">
            <button type="button" class=" btn-base  mr-3" onclick="enviaDatos();">Buscar</button>
            <button type="button" class="btn-base"onclick="excel();" id="botonExcel" style="background-color:green " disabled>Excel</button>

            <!-- <button type="button" id="exportBtn" class="btn btn-success btn-sm">Excel</button> -->
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
            <div class="col">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="width:100px"><b></b></span>
                        </div>
                    </div>
                </div>

                <?php echo mensaje(); ?>
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
        function excel() {
            $("#tablaRepPhi").table2excel({
                formats: ["xlsx"],
                position: 'bottom',
                bootstrap: false,
                name: "reclamos_tiempos",
                filename: 'reclamos_tiempos'
            });
        }

        function regresar() {
            window.location = '<?php echo constant('URL') ?>onbase/facturacionReportes/';
        }

        function enviaDatos() {
            var tipo = $('input[name="option"]:checked').val();
            var fechaI = $("#calendarioI").val();
            var fechaF = $("#calendarioF").val();
            var cliente 
            if(tipo === '1'){
                cliente = $("#selectCliente").val();
            }else if(tipo === '2'){
                cliente = $("#selectProveedor").val();
            }
            
            var direccion = "http://172.20.20.56:8080/ravisa/onbase/cargaTabla_ReporteStatusFactura";
            var url = direccion + "/" + $.trim(fechaI) + "/" + $.trim(fechaF) + "/" + $.trim(cliente)+ "/" + $.trim(tipo);;


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


        $(document).ready(function() {
            // Cuando cambie el valor de los radio buttons
            $('input[name="option"]').change(function() {
                if ($(this).val() == '1') {
                    // Mostrar input1 y ocultar input2
                    $('#input1').removeClass('hidden');
                    $('#input2').addClass('hidden');
                } else if ($(this).val() == '2') {
                    // Mostrar input2 y ocultar input1
                    $('#input1').addClass('hidden');
                    $('#input2').removeClass('hidden');
                }
            });
        });

</script>