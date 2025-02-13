<?php

$this->dbOnBase = new DatabaseOnBase();


$this->dbOnBase->connect();

$sql = "exec [dbo].[OB_WEB_IndicadoresMain2] '" . "1" . "'";
$this->dbOnBase->query($sql);
$resultados = $this->dbOnBase->obtener_registros();

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="background-image">
        <img src="public/img/fondos/coflex.png" alt="">
    </div>
    <div class="modal fade" id="DataModal" tabindex="-1" role="dialog" aria-labelledby="noDataModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header " style="background-color: #08043b;">
                    <h5 class="modal-title color-white" id="noDataModalLabel">Busqueda de factura por estatus</h5>
                    <button type="button" class="btn-close" style="color:#ffffff" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="hidden" id="alert">

                    </div>

                    <div class=" mt-2 mb-1 align-items-center justify-content-center d-flex flex-row gap-3">

                        <div class="d-flex flex-column">
                            <label for="busqueda" class="form-label mb-1 font-weight-bold">Buscar por:</label>
                            <select id="busqueda" class="selectpicker">
                                <option value="" selected disabled>Elige una opcion</option>
                                <option value="1">Pedimento</option>
                                <option value="2">Folio Fiscal</option>
                                <option value="3">Referencia</option>
                            </select>
                        </div>

                        <div class="hidden d-flex gap-3" id="content">
                            <div>
                                <label for="pedimento" class="form-label mb-1 font-weight-bold">Pedimento</label>
                                <input type="text" class="form-control" id="pedimento">
                            </div>

                            <div>
                                <label for="patente" class="form-label mb-1 font-weight-bold"> Patente</label>
                                <input type="text" class="form-control" id="patente">
                            </div>

                            <div>
                                <label for="aduana" class="form-label mb-1 font-weight-bold">Aduana</label>
                                <input type="text" class="form-control" id="aduana">
                            </div>

                        </div>

                        <div class="hidden" id="contentUUID">
                            <label for="uuid" class="form-label mb-1 font-weight-bold">UUID</label>
                            <input type="text" class="form-control" id="uuid">
                        </div>


                        <div class="hidden" id="contentReferencia">
                            <label for="referencia" class="form-label mb-1 font-weight-bold">Referencia</label>
                            <input type="text" class="form-control" id="referencia">
                        </div>

                    </div>

                    <div class="row">
                        <div class="page-header mb-5">
                            <div class="table-responsive mt-3">
                                <div id="response"> </div>
                            </div>
                        </div>
                    </div>

                </div>





                <div class="modal-footer">
                    <button type="button" class="btn-base-regresar" onclick=enviaDatos()>Buscar</button>
                </div>
            </div>
        </div>
    </div>
    </div>



    <!-- Tu contenido aquí -->

</body>

</html>

<script>
    function mostrarModal() {
        $('#DataModal').modal('show')
    }

    $('#busqueda').on('change', function(e) {
        if (e.target.value === '1') {
            $('#content').removeClass('hidden')
            $('#contentUUID').addClass('hidden')
            $('#contentReferencia').addClass('hidden')
        } else if (e.target.value === '2') {
            $('#content').addClass('hidden')
            $('#contentUUID').removeClass('hidden')
            $('#contentReferencia').addClass('hidden')
        } else {
            $('#content').addClass('hidden')
            $('#contentUUID').addClass('hidden')
            $('#contentReferencia').removeClass('hidden')
        }
    })

    function enviaDatos() {
        let opcion = $('#busqueda').val()
        let pedimento = ''
        let patente = null
        let aduana = null

        if (opcion === '1') {
            pedimento = $('#pedimento').val()
            patente = $('#patente').val()
            aduana = $('#aduana').val()
        }
        if (opcion === '2') {
            pedimento = $('#uuid').val()
        }
        if (opcion === '3') {
            pedimento = $('#referencia').val()
        }

        var direccion = "http://172.20.20.56:8080/ravisa/onbase/cargaTabla_EstatusFactura";
        var url = direccion + "/" + $.trim(pedimento) + "/" + patente + "/" + aduana + "/" + $.trim(opcion);

        console.log(url)

        $("#overlay").show();
        $("#loading").show();


        $.ajax({
            type: "POST",
            url: url,
            beforeSend: function() {

            },
            success: function(data) {
                $("#response").html(data);
                var dataFound = $("#data_found").val() === '1';

                if (!dataFound) {
                    // Mostrar el modal si no se encontraron datos


                } else {
                    $('#noDataModalLabel').text("Resultados")
                }


            },

            complete: function() {
                $("#overlay").hide();
                $("#loading").hide();
                $('#pedimento').val("")
                $('#patente').val("")
                $('#aduana').val("")
                $('#uuid').val("")
                $('#referencia').val("")

            },
            error: function() {
                alert("A ocurrido algun error")
                $("#overlay").hide();
                $("#loading").hide();
            }


        });

    }

    $('#DataModal').on('hidden.bs.modal', function() {
        // Borra el contenido del cuerpo de la tabla
        $('#tablaRepPhi ').empty();
        $('#searchRepPhi').remove();
        $('#busqueda').val("").selectpicker('refresh')

    });

    function subirPdf(nombrePdf) {

        $(`#${nombrePdf}`).off("change").on("change", function(e) {
            let archivo = e.target.files[0]
            let nombre = nombrePdf



            let formData = new FormData();
            formData.append('archivo', archivo)
            formData.append('nombre', nombre)

            $.ajax({
                url: "http://172.20.20.56:8080/ravisa/onbase/procesarFacturaPdf", // Archivo PHP que procesará los archivos
                type: 'POST',
                data: formData,
                processData: false, // No procesar los datos
                contentType: false, // No establecer el tipo de contenido
                success: function(response) {
                    $("#alert").removeClass("hidden")
                    $("#alert").append($('<div class="alert alert-success align-items-center text-uppercase" role="alert">Pdf enviado</div>'))
                    setTimeout(() => {
                        $("#alert").addClass("hidden")
                        $("#alert").empty()
                    }, 3000)

                },
                complete: function() {


                },
                error: function(xhr, status, error) {
                    $('#response').html('<div class="alert alert-danger">Ocurrió un error al procesar los archivos.</div>');
                }
            })
        })
    }
</script>