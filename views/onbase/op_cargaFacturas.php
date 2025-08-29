<?php include("public/inc/encabezado_sinbusqueda.php"); ?>
<div class="container-fluid  " style="margin-top: 0; padding-top: 0;">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between">
            <nav aria-label="breadcrumb" role="navigation" class="bg-transparent">
                <ol class="breadcrumb mb-1 bg-transparent">
                    <li class="breadcrumb-item">
                        <img src="https://static.wixstatic.com/media/fe7c4c_794ee55525f8446ba0a6ba64d5afaeb6~mv2.png/v1/fill/w_120,h_48,al_c,lg_1,q_85,enc_auto/fe7c4c_794ee55525f8446ba0a6ba64d5afaeb6~mv2.png" alt="Icono" style="width: 40px; height: auto; margin-right: 10px;">
                        <a href="#">Operaciones</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Carga de Facturas</li>
                </ol>
            </nav>
            <!--<button type="button" onclick="regresar();" class=" btn-base-regresar">Regresar</button>-->
        </div>
    </div>
    <form id="uploadForm" enctype="multipart/form-data">
        <div class="row mt-5 d-flex  align-items-center justify-content-between mb-2">
            <div class="col-6  d-flex flex-row justify-content-center">
                <!-- Botón para seleccionar archivos PDF -->
                <label class="btn-file-p mr-4">
                    <i class="bi bi-filetype-pdf fs-3"></i>
                    <input type="file" class="file-btn" name="pdf[]" id="pdf" accept=".pdf" multiple required>

                </label>
                <span id="pdf-count" class="file-count text-muted mr-3 disabled hidden">0 archivos</span>
                <!-- 
                <label class="btn-file-x mr-3">
                    <i class="fas fa-file-code"></i> XML
                    <input type="file" class="file-btn" name="xml[]" id="xml" accept=".xml" multiple required>
                </label> -->
                <label class="btn-file-x mr-3">
                    <i class="bi bi-filetype-xml fs-3"></i>
                    <input type="file" class="file-btn" name="xml[]" id="xml" accept=".xml" multiple required>
                </label>
                <span id="xml-count" class="file-count text-muted mr-3 hidden">0 archivos</span>


            </div>
            <div class="col-5 d-flex gap-4">
                <!--<button type="submit" id="processButton" class="btn-base ">Procesar Archivos</button> -->
                <button class="btn btn-success fw-bold px-1 py-2 w-100 border-radius-4" id="processButton" type="submit">
                    Procesar Archivos
                </button>
                <button class="btn btn-light fw-bold px-1 py-2 w-100 border-radius-4"
                    onclick="$('#modalBusqueda').modal('show');">
                    <i class="bi bi-search fs-4"></i>
                    Buscar OnBase
                </button>
                <button class="btn btn-light fw-bold px-1 py-2 w-25 border-radius-4"
                    onclick="$('#modalVideo').modal('show');">
                    <i class="bi bi-play-circle fs-4"></i>
                </button>
            </div>

        </div>
        <div class="row" id="error">

        </div>


    </form>



    <!-- Modal -->
    <div class="modal fade" id="noDataModal" tabindex="-1" role="dialog" aria-labelledby="noDataModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noDataModalLabel">Sin resultados</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Uno o los Archivos no coinciden
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-base-regresar" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalVideo" tabindex="-1" role="dialog" aria-labelledby="noDataModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noDataModalLabel">Ejemplo de carga</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <video src="/Ravisa/public/Video.mp4" autoplay muted controls style="width: 100%; height: auto;">
                        Tu navegador no admite el elemento <code>video</code>.
                    </video>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-base-regresar" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modalPDF" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noDataModalLabel">Visualizar PDF</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div id="pdfView" style="width: 100%; height:600px ;"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalBusqueda" tabindex="-1" role="dialog" aria-labelledby="noDataModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header " style="background-color: #08043b;">
                    <h5 class="modal-title color-white" id="noDataModalLabel">Buscar factura OnBase</h5>
                    <button type="button" class="btn-close color-white" style="color:#ffffff !important" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class=" mt-2 mb-1 align-items-center justify-content-center d-flex flex-row gap-3">

                        <div class="" id="contentUUID">
                            <label for="uuid" class="form-label mb-1 font-weight-bold">UUID</label>
                            <input type="text" class="form-control" id="uuidOnBase">
                        </div>

                    </div>

                    <div class="row">
                        <div class="page-header mb-5">

                            <div id="responseOB"> </div>

                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-base-regresar" onclick=buscarUUID()>Buscar</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modal">

    </div>


    <div class="min-height-200px ">
        <div class="page-header mb-5">
            <div class="table-responsive mt-3">
                <div id="response"> </div>
            </div>
            <div class="d-flex gap-3 justify-content-center">
                <div id="pdfC">

                </div>
                <div id="xmlC">

                </div>
            </div>
            <div class="row mt-2 mr-4 justify-content-center d-none" id="confirm-btn">
                <div class="col-12 d-flex justify-content-center">
                    <button class="btn btn-success fw-bold px-1 py-2 w-25 border-radius-4" id="moveButton">
                        Mover Archivos
                    </button>
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

    <footer class="justify-content-center text-center my-5">
        <div class="my-5 ">
            <p>- Los archivos ingresados deben tener la misma cantidad de XML y PDF, y no pueden exceder los 20 documentos.</p>
            <p>- Las facturas no serán procesadas si se encuentran canceladas ante el SAT.</p>
            <p>- Cada factura debe tener al menos un dato capturado, el cual deberá existir en Darwin.</p>
            <p>- No se admiten facturas sin timbrar o XML con error en la estructura.</p>
            <p>- Las facturas entran a Onbase en un lapso de 10 minutos aproximadamente.</p>
        </div>

    </footer>
</div>

<?php include("public/inc/jsfooter.php"); ?>

<script>
    function regresar() {
        window.location = '<?php echo constant('URL') ?>onbase/facturacionReportes/';
    }

    let uuid = []


    $(window).on('beforeunload', function(e) {

        let url = "http://172.20.20.56:8080/ravisa/onbase/borrarFacturas" // Archivo PHP que procesará los archivos
        const data = new FormData();
        uuid.forEach(id => {
            data.append('uuid[]', id);
        });
        navigator.sendBeacon(url, data)


    });


    function buscarUUID() {
        let uuid = $("#uuidOnBase").val()

        $.ajax({
            url: "http://172.20.20.56:8080/ravisa/onbase/buscarFacturaOnBase", // Archivo PHP que procesará los archivos
            type: 'POST',
            data: {
                uuid: uuid
            },
            success: function(response) {

                let data = JSON.parse(response)

                if (data.error === true) {
                    $("#responseOB").empty()
                    $("#responseOB").append(`<div class="alert alert-danger text-center" role="alert" style="margin-top:0.3rem; ">${data.mensaje}</div>`)
                } else {
                    $("#responseOB").empty()
                    $("#responseOB").append('<div class="alert alert-success text-center" role="alert" style="margin-top:0.3rem; ">La factura ya se encuentra en OnBase</div>')
                }

            },
            complete: function() {


            },
            error: function(xhr, status, error) {
                $('#responseOB').html('<div class="alert alert-danger">Ocurrió un error al buscar la factura.</div>');
            }
        });

    }

    //Funcion para contar la cantidad de archivos y evitar que sean mas de 10
    function updateFileCount(inputId, countId) {
        var input = document.getElementById(inputId);
        var countSpan = document.getElementById(countId);
        var fileCount = input.files.length;

        countSpan.textContent = fileCount + ' archivos';
        if (fileCount > 20) {
            $("#error").append('<div class="alert alert-danger text-center" role="alert" style="margin-top:0.3rem; ">No se pueden cargar mas de 20 archivos</div>')
            //$('#processButton').prop('disabled', true)
            $('#processButton').addClass('disabled')
        } else {
            $("#error").empty()
            $('#processButton').removeClass('disabled')
        }
    }

    // Event listeners para los inputs de archivo
    $('#pdf').on('change', function() {
        $('#pdf-count').removeClass('hidden')
        updateFileCount('pdf', 'pdf-count');
        let archivos = this.files; // Accedes al objeto FileList
        let rows =''
        $.each(archivos, function(index, archivo) {
            rows += ` <p class='small'>${archivo.name}</p> ` 
                    
        });

        $('#pdfC').html(rows)

    });

    $('#xml').on('change', function() {
        $('#xml-count').removeClass('hidden')
        updateFileCount('xml', 'xml-count');
        let archivos = this.files; // Accedes al objeto FileList
        let rows =''
        $.each(archivos, function(index, archivo) {
            rows += ` <p class='small'>${archivo.name}</p> ` 
                    
        });

        $('#xmlC').html(rows)
    });

    //Submit para enviar a procesar los archivos
    $('#uploadForm').on('submit', function(e) {
        e.preventDefault(); // Evita el comportamiento predeterminado del formulario

        let pdf = $('#pdf')[0].files.length;
        let xml = $('#xml')[0].files.length;

        //Condicion para verificar que sean la misma cantidad de archivos

        if (pdf != xml) {
            $("#error").find(".alert").remove();
            $("#error").append($('<div class="alert alert-danger text-center" role="alert" style="margin-top:0.3rem; ">Los pdf y xml no tinenen la misma cantidad de archivos</div>'))
            return
        }

        $("#error").find(".alert").remove();

        $("#overlay").show();
        $("#loading").show();
        $("#confirm-btn").removeClass("d-none");

        var formData = new FormData(this);

        $.ajax({
            url: "http://172.20.20.56:8080/ravisa/onbase/procesarArchivos", // Archivo PHP que procesará los archivos
            type: 'POST',
            data: formData,
            processData: false, // No procesar los datos
            contentType: false, // No establecer el tipo de contenido
            success: function(response) {
                $('#pdfC').empty();
                $('#xmlC').empty();

                //Convertir el arreglo en formato JSON
                let data = JSON.parse(response)
                console.log(data)

                //Imprimir la tabla retornada
                $('#response').html(data.tabla)
                $('#tablaRepPhi').on('click', '.eliminar-fila', function() {
                    $(this).closest('tr').remove();
                });

                //Quitar las facturas canceladas y validar datos a las correctas
                const uuidCorrectos = data.uuids.filter(uuid => uuid != data.uuidError)

                uuid = data.uuids.slice()

                uuidCorrectos.forEach(uuid => {
                    validarReferencia(`${uuid}ref`, 'RF')
                    validarReferencia(`${uuid}gh`, 'GH')
                    validarReferencia(`${uuid}gm`, 'GM')
                    validarReferencia(`${uuid}ped`, 'PD')
                    validarReferencia(`${uuid}cont`, 'CN')
                })

                if (!uuidCorrectos.length) {
                    $("#moveButton").addClass("d-none")
                }

                //De las canceladas o no timbradas mostrar el modal
                if (data.modal) {
                    data.uuidError.forEach(uuid => {
                        $('#modal').append(data.modal);
                        $(`#${uuid}`).modal('show');

                    })
                }

                if (!data.data) {
                    // Mostrar el modal si no se encontraron datos
                    $('#noDataModal').modal('show');
                    $("#confirm-btn").addClass("d-none");

                    $('#pdf-count').text('0 archivos');
                    $('#xml-count').text('0 archivos');
                }

                if (data.noEncontrados > 0) {
                    // Mostrar el modal si no se encontraron datos
                    $('#noDataModal').modal('show');
                }


            },
            complete: function() {
                $("#overlay").hide();
                $("#loading").hide();


            },
            error: function(xhr, status, error) {
                $('#response').html('<div class="alert alert-danger">Ocurrió un error al procesar los archivos.</div>');
            }
        });
    });


    $('#moveButton').on('click', function(e) {
        let valido = true;
        $("#mainSelectSucursal").find(".alert").remove();

        $('table tbody tr').each(function() {
            let filled = false;

            // Verificar si algún campo en la fila tiene un valor
            $(this).find('input').each(function() {
                if ($(this).val().trim() !== '') {
                    filled = true;
                }
            });

            // Si no hay ningún campo lleno en esta fila, marcar como inválido
            if (!filled) {
                valido = false;
            }
        });

        // Si no es válido, mostrar advertencia y prevenir la acción
        if (!valido) {
            e.preventDefault();
            $("#mainSelectSucursal").find(".alert").remove();
            $("#mainSelectSucursal").append($('<div class="alert alert-danger text-center" role="alert" style="margin-top:0.3rem; ">Favor de llenar al menos un campo de la factura</div>'))
            return; // Detener el procesamiento
        }

        let select = $("#selectSucursal").val()

        //Verificar si el select no esta vacio
        if (select === '') {
            e.preventDefault();
            $("#mainSelectSucursal").find(".alert").remove();
            $("#mainSelectSucursal").append($('<div class="alert alert-danger text-center" role="alert" style="margin-top:0.3rem; ">Favor de elegir una sucursal</div>'))
            return
        }

        // let correo = $("#correo").val()

        // if (correo === '') {
        //     e.preventDefault();
        //     $("#mainSelectSucursal").find(".alert").remove();
        //     $("#mainSelectSucursal").append($('<div class="alert alert-danger text-center" role="alert" style="margin-top:0.3rem; ">Favor de ingresar al menos un correo</div>'))
        //     return
        // }

        //Recorrido a las filas de la tabla para obtner los datos 
        $('table tbody tr').each(function() {
            var uuid = $(this).find('td').eq(0).text();
            var nombre = $(this).find('td').eq(1).text();
            var nombreNuevo = $(this).find('td').eq(2).text();
            //Verificar si contiene referencia o hay que ingresar

            let referencia = $(this).find('.campo1').hasClass('is-invalid') ? '' : $(this).find('.campo1').val();
            let guiaH = $(this).find('.campo2').hasClass('is-invalid') ? '' : $(this).find('.campo2').val();
            let guiaM = $(this).find('.campo3').hasClass('is-invalid') ? '' : $(this).find('.campo3').val();
            let pedimento = $(this).find('.campo4').hasClass('is-invalid') ? '' : $(this).find('.campo4').val();
            let contenedor = $(this).find('.campo5').hasClass('is-invalid') ? '' : $(this).find('.campo5').val();
            let correo = " "
            let direccion = "http://172.20.20.56:8080/ravisa/onbase/moverArchivos";
            let url = direccion + "/" + encodeURIComponent($.trim(select)) + "/" + encodeURIComponent($.trim(uuid)) + "/" + encodeURIComponent($.trim(nombre)) + "/" + encodeURIComponent($.trim(nombreNuevo)) + "/" + (referencia ? encodeURIComponent($.trim(referencia)) : 'NULL') + "/" + (pedimento ? encodeURIComponent($.trim(pedimento)) : 'NULL') + "/" + (guiaH ? encodeURIComponent($.trim(guiaH)) : 'NULL') + "/" + (guiaM ? encodeURIComponent($.trim(guiaM)) : 'NULL') + "/" + (contenedor ? encodeURIComponent($.trim(contenedor)) : 'NULL') + "/" + $.trim(correo);

            console.log(url)
            $.ajax({
                url: url, // Archivo PHP que moverá los archivos
                type: 'POST',
                success: function(response) {
                    $('table tbody tr').remove();
                    $("#moveButton").addClass("d-none")


                    if (parseInt(response.tipo) === 1) {
                        //Respuesta del controlador que recibe de la base de datos si ya fue ingresada o no la factura
                        $("#mainSelectSucursal").find(".alert").remove();
                        $("#mainSelectSucursal").append(`<div class="alert alert-success text-center" role="alert" style="margin-top:0.3rem; ">${response.message}</div>`)

                    } else {
                        $("#mainSelectSucursal").append(`<div class="alert alert-danger text-center" role="alert" style="margin-top:0.3rem; ">${response.message}</div>`)
                    }

                    setTimeout(() => {
                        window.location.reload()
                    }, 2500)


                },
                error: function(xhr, status, error) {
                    $('#response').html('<div class="alert alert-danger">Ocurrió un error al mover los archivos.</div>');
                }
            });
        })
    })


    //Funcion que valida los inputs para verificar si existen o no en Darwin
    function validarReferencia(id, clave) {
        let referencia = $(`#${id}`).val().trim()

        if (referencia === '') {
            $(`#${id}`).removeClass('is-invalid')
            verificarCampos()

        }
        let direccion = "http://172.20.20.56:8080/ravisa/onbase/validarReferencia"
        let url = direccion + "/" + $.trim(referencia) + "/" + $.trim(clave)


        $.ajax({
            url: url, // Archivo PHP que moverá los archivos
            type: 'POST',
            success: function(response) {
                let data = JSON.parse(response)
                console.log(data)
                if (data.Mensaje === "EXISTE EN DARWIN") {
                    $(`#${id}`).removeClass('is-invalid')
                }
                if (data.Mensaje === "NO EXISTE EN DARWIN") {
                    $(`#${id}`).addClass('is-invalid')
                }

                verificarCampos()
            },
            error: function(xhr, status, error) {
                $('#response').html('<div class="alert alert-danger">Ocurrió un error al mover los archivos.</div>');
            }
        });

    }

    //Funcion para que el boton no se desabilite si algun campo es invalido
    // function verificarCampos(){
    //     if ($('.is-invalid').length > 0) {
    //         $("#moveButton").addClass('disabled');
    //     } else {
    //         $("#moveButton").removeClass('disabled');
    //     }
    // }

    // Llamar a la verificación cuando se cambie el valor de algún campo


    // Verificar que al menos una celda tenga datos válidos en cada fila
    function verificarCampos() {
        let valido = true;

        $('table tbody tr').each(function() {
            let filaValida = false;

            // Verificar si al menos un input en la fila tiene un valor válido
            $(this).find('input').each(function() {
                if ($(this).val().trim() !== '' && !$(this).hasClass('is-invalid')) {
                    filaValida = true;
                    return false; // Romper el bucle interno si se encuentra un input válido
                }
            });

            // Si la fila no tiene ningún campo válido, marcar el formulario como inválido
            if (!filaValida) {
                valido = false;
                return false; // Romper el bucle externo si se encuentra una fila inválida
            }
        });

        // Habilitar o deshabilitar el botón en función de la validez de todas las filas
        if (valido) {
            $("#moveButton").removeClass('disabled').prop('disabled', false);
        } else {
            $("#moveButton").addClass('disabled').prop('disabled', true);
        }
    }

    function mostrarPDF(url) {
        let ruta = `../upload/${url}`
        
        PDFObject.embed(ruta, "#pdfView")
        $("#modalPDF").modal('show')
    }
</script>