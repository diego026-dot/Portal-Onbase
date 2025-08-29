<?php include("public/inc/encabezado_sinbusqueda.php"); ?>
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
                        <a href="#">Menu</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Facturacion</li>
                </ol>
            </nav>
            <button type="button" onclick="regresar();" class="btn-base-regresar">Regresar</button>
        </div>
    </div> -->



    <div class=" row d-flex justify-content-center gap-4 " style="margin-top: 100px;">


        <div class="col-2 mb-3 shadow clickable-card "
            onclick="window.location='<?php echo constant('URL')?>onbase/administracionCorreos'">
            <div class=" text-center p-4">
            <i class="bi bi-folder-symlink-fill fs-1"></i>
                <p style="color:#293080; font-weight:bold; font-size:16px; margin-top:30px;">
                    Administrar Correos Notificaciones OB
                </p>
            </div>
        </div>

        <div class="col-2 mb-3 shadow clickable-card "
            onclick="window.location='<?php echo constant('URL')?>onbase/administracionUser'">
            <div class=" text-center p-4">
            <i class="bi bi-person-fill-gear fs-1"></i>
                <p style="color:#293080; font-weight:bold; font-size:18px; margin-top:30px;">
                    Admnistrar Usuarios
                </p>
            </div>
        </div>

        <div class="col-2 mb-3 shadow clickable-card "
            onclick="window.location='<?php echo constant('URL')?>onbase/administracionGerentes'">
            <div class=" text-center p-4">
            <i class="bi bi-people-fill fs-1"></i>
                <p style="color:#293080; font-weight:bold; font-size:16px; margin-top:30px;">
                    Admnistrar Usuarios Gerentes
                </p>
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