<?php include("public/inc/encabezadoCambioRef.php"); ?>
<style>
    p {
        /*color: #002f56;*/
        color: white;


    }

    h1 {
        font-weight: bold;
        color: white;


    }

    .btn.btn-outline-primary:hover,
    .btn.btn-outline-primary:focus,
    .btn.btn-outline-primary:active,
    .btn.btn-outline-primary.active {
        color: #08043b;
        background-color: #ccd5df
    }

    .btn.btn-outline-primary {
        /*color: #ff8300;*/
        background-color: #ffffff;
        color: #08043b;
        border-radius: 10px;
        font-weight: 700;


    }

    .clickable-card {
        cursor: pointer;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out, background-color 0.3s ease-in-out;
    }

    .clickable-card:hover {
        background-color: #f0f0f0;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    }
</style>



<div class="" style="margin-top: 0; padding-top: 0;">

    <!-- <div class="row">
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
    </div> -->


    <!-- Modal -->
    <div class="modal fade" id="DataModal" tabindex="-1" role="dialog" aria-labelledby="noDataModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div id="overlay" class="ocultar "></div>


                <!-- Contenedor para el GIF de carga -->
                <div id="loading" class="cargando">
                    <img src="<?php echo constant('IMG'); ?>preloader/cargando2.gif" alt="" class="light-logo" style="height:70px;">
                </div>
                <div class="modal-header " style="background-color: #08043b;">
                    <h5 class="modal-title color-white" id="noDataModalLabel">Búsqueda de factura por estatus</h5>
                    <button type="button" class="btn-close color-white" style="color:#ffffff !important" data-bs-dismiss="modal" aria-label="Close"></button>
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

                        <div class="hidden gap-3" id="content" style="display:flex; ">
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

    <div class="modal fade" id="modalSap" tabindex="-1" role="dialog" aria-labelledby="noDataModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header " style="background-color: #08043b;">
                    <h5 class="modal-title color-white" id="noDataModalLabel"></h5>
                    <button type="button" class="btn-close color-white" style="color:#ffffff !important" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row bg-body-tertiary m-5 p-3 ">

                        <div class="row justify-content-center align-content-center">
                            <div class="col-6 mt-4 mb-3 d-flex flex-column">
                                <label for="referencia" class="form-label fw-bold">Referencia</label>
                                <select name="" id="referencia" class="selectpicker w-100 bg-white ">
                                    <option value="" selected>Seleccione la referencia</option>
                                </select>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-center">
                            <div class="mb-3 col-6">
                                <label for="num" class="form-label fw-bold">Folio SAP</label>
                                <input
                                    id="num"
                                    type="text"
                                    class="form-control"
                                    placeholder="Ingrese el folio SAP">
                            </div>
                        </div>

                        <div class="row d-flex justify-content-center">
                            <div class="mb-3 col-6">
                                <label for="sucursal" class="form-label fw-bold"> Sucursal</label>
                                <input
                                    id="sucursal"
                                    type="text"
                                    class="form-control"
                                    placeholder="Ingrese el folio SAP">
                            </div>
                        </div>


                        <div class="row d-flex justify-content-center">
                            <div class="col-6 mt-4 mb-3 ">
                                <label for="correo" class="form-label fw-bold">Correo Ejecutivo</label>
                                <input
                                    id="correo"
                                    type="mail"
                                    class="form-control "
                                    placeholder="Ingrese la referencia a modificar">
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

    <div class=" row d-flex justify-content-center gap-4 " style="margin-top: 100px;">


        <div class="col-2 mb-3  shadow clickable-card "
            onclick="window.open('http://srvweb/AppNet//UnityForm.aspx?d1=Ac3LfJq43ixY7ihZn5f%2bVshFxZy99cEGAfobz%2ftf2oOub2kqEHVVg%2bGifTVErDgCRlZUAthefL%2f%2f30XsGSyRsolBv6aVXGbuv%2bNBKoh%2fhBdjOEAyDRTz9ixySowJeb5RLSn5Gd4K%2fouMYEpSskK3gegdNjzznKbGgWL0AUhdKfiMdON3pL5GI3T5%2bXQmK41V%2fhYsg6bTMU6txdt3sv5G9TE%3d', '_blank')">
            <div class=" text-center p-4">
                <i class="bi bi-send-plus-fill fs-1"></i>
                <p style="color:#293080; font-weight:bold; font-size:18px; margin-top:30px;">
                    Solicitud de Anticipo
                </p>
            </div>
        </div>

        <div class="col-2 mb-3 shadow clickable-card "
            onclick="window.open('http://srvweb/AppNet//UnityForm.aspx?d1=AUBuuJnvLL8%2fC9Wt6VwCoXErqQgeJJnYJOUDP%2fq8g0SDYGtXKyv0gh9YV4OJxmU7RUdLRHBG13k%2bN7yg9z7Ehipb967pmyCSkKRWYPIoAWGEncUsc0XmsBQ%2f48dhro6ux8AOPP%2fyDzO6w2fl9s2X%2bJ%2baoiYu8PInGJUBkLvZA9m1aIL%2fRVjW3irL7EhHuijucXqP4GYhqKWfQigeTUr%2bEWQ%3d', '_blank')">
            <div class=" text-center p-4">
                <i class="bi bi-clipboard2-x-fill fs-1"></i>
                <p style="color:#293080; font-weight:bold; font-size:18px; margin-top:30px;">
                    Cancelacion de Anticipo
                </p>
            </div>
        </div>

        <div class=" col-2 mb-3 shadow clickable-card"
            onclick="window.open('http://srvweb/AppNet//UnityForm.aspx?d1=AX37VcaQVsINqHE0G7zVninxFs61yLEZmVyxPuRnJZa%2bzwGpavLLafyDOn1Jc%2fTmt09mXc9bwb%2bemRtfVVcfk%2fTqeZP47JfJ6bz6zFXhnqYxK7GL9hewMDwNzBFsLpCWDh6B%2fiEKmemiABfDI1792w9fbKOSmnFUjxwtuIy1CPf%2b2WgQS44t7XkVlhjz1YG7Cp5kZTYWpJ5L06D%2bhI5QU6s%3d', '_blank')">
            <div class=" text-center p-4">

                <i class="bi bi-card-checklist fs-1"></i>
                <p style="color:#293080; font-weight:bold; font-size:18px; margin-top:30px;">
                    Cheklist
                </p>
            </div>
        </div>

        <div class="col-2 mb-3 shadow clickable-card">
            <div class=" text-center p-4">

                <i class="bi bi-building-fill-gear fs-1"></i>

                <p style="color:#293080; font-weight:bold; font-size:18px; margin-top:30px;">SAP</p>
            </div>
        </div>



    </div>

    <div id="main"></div>



    <!-- Contenedor para el overlay -->
    <div id="overlay" class="ocultar "></div>


    <!-- Contenedor para el GIF de carga -->
    <div id="loading" class="cargando">
        <img src="<?php echo constant('IMG'); ?>preloader/cargando2.gif" alt="" class="light-logo" style="height:70px;">
    </div>

</div>

<?php include("public/inc/jsfooter.php"); ?>

<script>
    function mostrarModal() {
        $('#DataModal').modal('show')
    }

    function modal() {
        $('#modalSap').modal('show')
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
        let archivoSeleccionado = false;

        $(`#${nombrePdf}`).off("click").on("click", function() {
            archivoSeleccionado = false;

            // Cuando la ventana recupere el foco, verificamos si no se seleccionó archivo
            $(window).off("focus").on("focus", function() {
                setTimeout(() => {
                    if (!archivoSeleccionado) {
                        $("#overlay").hide();
                        $("#loading").hide();
                    }
                }, 500);
            });
        });
        
        $("#overlay").show();
        $("#loading").show();

        $(`#${nombrePdf}`).off("change").on("change", function(e) {
            let archivo = e.target.files[0]

            if (!archivo) {
                // Si el usuario cierra el explorador de archivos sin seleccionar nada, se cancela el proceso
                $("#overlay").hide();
                $("#loading").hide();
                return;
            }

            archivoSeleccionado = true;
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
                    $("#alert").append($('<div class="alert alert-success align-items-center text-center" role="alert">Pdf enviado</div>'))
                    setTimeout(() => {
                        $("#alert").addClass("hidden")
                        $("#alert").empty()
                    }, 3000)
                    $("#overlay").hide();
                    $("#loading").hide();


                },
                complete: function() {
                    $("#overlay").hide();
                    $("#loading").hide();

                },
                error: function(xhr, status, error) {
                    $('#response').html('<div class="alert alert-danger">Ocurrió un error al procesar los archivos.</div>');
                    $("#overlay").hide();
                    $("#loading").hide();
                }
            })
        })
    }
</script>