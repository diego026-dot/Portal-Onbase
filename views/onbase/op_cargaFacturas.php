<?php include("public/inc/encabezado_sinbusqueda.php"); ?>

<div class="container-fluid" style="margin-top: 0; padding-top: 0;">
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
            <button type="button" onclick="regresar();" class=" btn-base-regresar">Regresar</button>
        </div>
    </div>
    <form id="uploadForm" enctype="multipart/form-data">
        <div class="row mt-5 d-flex  align-items-center mb-2">
            <div class="col-10  d-flex flex-row justify-content-center">
                <!-- Botón para seleccionar archivos PDF -->
                <label class="btn-file-p mr-3">
                    <i class="fas fa-file-pdf"></i> Subir PDF
                    <input type="file" class="file-btn" name="pdf[]" id="pdf" accept=".pdf" multiple required>
                </label>
                <span id="pdf-count" class="file-count text-muted mr-3">0 archivos</span>

                <label class="btn-file-x mr-3">
                    <i class="fas fa-file-code"></i> Subir XML
                    <input type="file" class="file-btn" name="xml[]" id="xml" accept=".xml" multiple required>
                </label>
                <span id="xml-count" class="file-count text-muted mr-3">0 archivos</span>


            </div>
            <div class="col-2">
                <button type="submit" class="btn-base ">Procesar Archivos</button>
            </div>

        </div>
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


<div class="min-height-200px ">
    <div class="page-header mb-5">
        <div class="table-responsive mt-3">
            <div id="response"> </div>
        </div>
        <div class="row mt-2 mr-4 justify-content-center d-none" id="confirm-btn">
            <div class="col-12 d-flex justify-content-end">
                <button id="move-files-btn" class="btn-base"> Mover Archivos</button>
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


    function updateFileCount(inputId, countId) {
        var input = document.getElementById(inputId);
        var countSpan = document.getElementById(countId);
        var fileCount = input.files.length;

        countSpan.textContent = fileCount + ' archivos';
    }

    // Event listeners para los inputs de archivo
    document.getElementById('pdf').addEventListener('change', function() {
        updateFileCount('pdf', 'pdf-count');
    });

    document.getElementById('xml').addEventListener('change', function() {
        updateFileCount('xml', 'xml-count');
    });

    $('#uploadForm').on('submit', function(e) {
        e.preventDefault(); // Evita el comportamiento predeterminado del formulario

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
                $('#response').html(response); // Mostrar la respuesta del servidor
                var dataFound = $("#data_found").val() === '1';
                var dontFound = $("#dont_found").val();


                if (!dataFound) {
                    // Mostrar el modal si no se encontraron datos
                    $('#noDataModal').modal('show');
                    $("#confirm-btn").addClass("d-none");

                    $('#pdf-count').text('0 archivos');
                    $('#xml-count').text('0 archivos');
                } else if (dontFound === '1') {

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


    $('#move-files-btn').on('click', function(e) {
        // let valido = true;

        // $('table tbody tr').each(function() {
        //     let filled = false;

        //     // Verificar si algún campo en la fila tiene un valor
        //     $(this).find('input').each(function() {
        //         if ($(this).val().trim() !== '') {
        //             filled = true;
        //         }
        //     });

        //     // Si no hay ningún campo lleno en esta fila, marcar como inválido
        //     if (!filled) {
        //         valido = false;
        //     }
        // });

        // // Si no es válido, mostrar advertencia y prevenir la acción
        // if (!valido) {
        //     e.preventDefault();
        //     alert('Por favor, asegúrate de llenar al menos un campo en cada fila antes de mover los archivos.');
        //     return; // Detener el procesamiento
        // }

        $('table tbody tr').each(function() {
            var uuid = $(this).find('td').eq(0).text();
            var nombre = $(this).find('td').eq(1).text();
            var nombreNuevo = $(this).find('td').eq(2).text();
            //Verificar si contiene referencia o hay que ingresar
            var referenciaElement = $(this).find('td').eq(3);
            let referencia = referenciaElement.find('input').length ? referenciaElement.find('input').val().trim() : referenciaElement.text().trim();

            let guiaH = $(this).find('.campo2').val().trim();
            let guiaM = $(this).find('.campo3').val().trim();
            let pedimento = $(this).find('.campo4').val().trim();
            let contenedor = $(this).find('.campo5').val().trim();


            let direccion = "http://172.20.20.56:8080/ravisa/onbase/moverArchivos"
            let url = direccion + "/" + $.trim(uuid) + "/" + $.trim(nombre) + "/" + $.trim(nombreNuevo) +
                "/" + $.trim(referencia) + "/" + $.trim(guiaH) + "/" + $.trim(guiaM) + "/" + $.trim(pedimento) + "/" + $.trim(contenedor);


            $.ajax({
                url: url, // Archivo PHP que moverá los archivos
                type: 'POST',
                success: function(response) {
                    $('table tbody tr').remove();
                    $("#confirm-btn").addClass("d-none");

                    $('#pdf-count').text('0 archivos');
                    $('#xml-count').text('0 archivos');

                },
                error: function(xhr, status, error) {
                    $('#response').html('<div class="alert alert-danger">Ocurrió un error al mover los archivos.</div>');
                }
            });

        })





    })
</script>