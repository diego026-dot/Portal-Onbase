<?php include("public/inc/encabezado_sinbusqueda.php"); ?>



<div class="container-fluid bg-light" style="margin-top: 0; padding-top: 0;">
    <div class="row">
        <div class="col-12 d-flex justify-content-center mt-4">
            <ul class="nav nav-tabs border-bottom-0" style="font-weight: 600; font-size: 0.9rem;">
                <li class="nav-item">
                    <button class="nav-link btn btn-link text-uppercase text-secondary px-4"
                        onclick="location.replace('<?php echo constant('URL'); ?>pages/registroCandidatosView')">
                        Registro
                    </button>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-uppercase text-primary border-0 border-bottom border-3 border-primary rounded-0"
                        aria-current="page" href="#">
                        Agregar
                    </a>
                </li>
                <?php if ($_SESSION['usuario'] === 'admin' || $_SESSION['usuario'] === 'Monserrat') { ?>
                    <li class="nav-item">
                        <button class="nav-link btn btn-link text-uppercase text-secondary px-4"
                            onclick="location.replace('<?php echo constant('URL'); ?>pages/editarCandidatoView')">
                            Editar
                        </button>
                    </li>
                <?php }
                ?>
                <?php if ($_SESSION['usuario'] === 'admin' || $_SESSION['usuario'] === 'Monserrat') { ?>
                    <li class="nav-item">
                        <button class="nav-link btn btn-link text-uppercase text-secondary px-4"
                            onclick="location.replace('<?php echo constant('URL'); ?>pages/estadisticasCandidatosView')">
                            Estadísticas
                        </button>
                    </li>
                <?php }
                ?>
                <?php if ($_SESSION['usuario'] === 'admin' || $_SESSION['usuario'] === 'Monserrat') { ?>
                    <li class="nav-item">
                        <button class="nav-link btn btn-link text-uppercase text-secondary px-4"
                            onclick="location.replace('<?php echo constant('URL'); ?>pages/reportePaginasView')">
                            Reportes
                        </button>
                    </li>
                <?php }
                ?>
            </ul>
        </div>
    </div>



    <div class="row justify-content-center page-header mb-5 ">

        <div class="row d-flex p-3 mb-5">
            <div class="col-12 d-flex justify-content-center">
                <h4 class="text-uppercase fw-bold">Agregar candidato</h3>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-sm-12">
                <form class="p-4 border rounded shadow-sm " id="formulario">
                    <div class="mb-3 " id="errorForm">

                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" class="form-control " placeholder="Nombre" id="nombre" name="nombre">
                        </div>
                        <div class="col">
                            <select name="medioR" id="medioR" class="selectpicker w-100">
                                <option value="" selected disabled class="fw-bold">Medio Reclutamiento</option>
                                <option value="Facebook">Facebook</option>
                                <option value="OCC">OCC</option>
                                <option value="Computrabajo">Computrabajo</option>
                                <option value="Referidos">Referidos</option>

                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-8">
                            <select name="puesto" id="puesto" class="selectpicker w-100">
                                <option value="" selected disabled class="fw-bold">Puesto</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <select name="sucursal" id="sucursal" class="selectpicker w-100">
                                <option value="" selected disabled class="fw-bold">Sucursal</option>
                                <option value="Manzanillo">Manzanillo</option>
                                <option value="Barragan">Barragan</option>
                                <option value="Apodaca">Apodaca</option>
                                <option value="Veracruz">Veracruz</option>
                                <option value="NuevoLaredo">Nuevo Laredo</option>
                                <option value="Toluca">Toluca</option>
                                <option value="Varsovia">Varsovia</option>
                                <option value="AICM">AICM</option>
                                <option value="AIFA">AIFA</option>
                                <option value="Silao">Silao</option>
                                <option value="RL">RL</option>
                            </select>
                        </div>

                    </div>

                    <div class="row mb-3">
                        <div class="col">

                            <input type="email" class="form-control" id="correo" name="correo" placeholder="correo@ejemplo.com">
                        </div>
                        <div class="col" id="telContainer">
                            <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Numero de Telefono">

                        </div>
                    </div>

                    <div class="mb-3">
                        <input type="url" class="form-control" id="url" name="url" placeholder="URL:">


                    </div>

                    <div class=" row mb-3">
                        <div class="col-lg-4 col-sm-6">
                            <select name="estatus" id="estatus" class="selectpicker">
                                <option value="" selected disabled class="fw-bold">Estatus</option>
                                <option value="1">1.Ajuste de perfil de búsqueda</option>
                                <option value="2">2.Publicado</option>
                                <option value="3">3.Filtro y entrevista reclutamiento</option>
                                <option value="4">4.Entrevista con Gerencia</option>
                                <option value="5">5.Evaluaciones Psicométricas</option>
                                <option value="6">6.Entrevista usuario</option>
                                <option value="7">7.Investigación laboral</option>
                                <option value="8">8.En propuesta económica</option>
                                <option value="9">9.Con propuesta y fecha de ingreso</option>
                                <option value="10">10.Contratación cerrada</option>
                                <option value="11">12.Candidato potencial</option>
                            </select>

                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <select name="evaluacion" id="evaluacion" class="selectpicker">
                                <option value="" selected disabled class="fw-bold">Evaluacion</option>
                                <option value="Apto">Apto</option>
                                <option value="No apto">No apto</option>

                            </select>

                        </div>



                    </div>

                    <div class="mb-3">

                        <textarea class="form-control" id="comentarios" name="comentarios" rows="3" placeholder="Escribe tus comentarios aquí..."></textarea>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-sm-6 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary w-75" id="botonEnviar">Enviar</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>

    <!-- Contenedor del Toast -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055;">
        <div id="userToast" class="toast border rounded shadow-sm" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex align-items-center p-3">
                <i id="toastIcon" class="bi me-3 fs-4 text-success"></i>
                <div class="flex-grow-1">
                    <div id="toastMensaje" class="fw-medium">Usuario agregado correctamente.</div>
                </div>

            </div>
        </div>
    </div>



</div>

<?php include("public/inc/jsfooter.php"); ?>

<script>
    $(document).ready(function() {
        $.ajax({
            url: "http://172.20.20.56:8080/ravisa/onbase/getPuestoCandidatos",
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                
                $('#puesto').append(generarSelectPuesto(data))
                $('.selectpicker').selectpicker('refresh');
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar clientes:', error);
            }
        })
    })

    $('#formulario').on('submit', function(e) {
        e.preventDefault()

        let valido = true

        $(this).find('input').each(function() {
            const tipo = $(this).attr('type');

            if (tipo !== 'email' && tipo !== 'url' && $(this).val().trim() === '') {
                $(this).addClass('is-invalid');
                valido = false;
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        $(this).find('select.selectpicker').each(function() {
            const $btn = $(this).parent().find('button.dropdown-toggle');
            if ($(this).val() === null || $(this).val().length === 0) {
                $btn.addClass('border border-danger');
                $(this).addClass('is-invalid').selectpicker('refresh');
                valido = false;
            } else {
                $btn.removeClass('border border-danger');
                $(this).removeClass('is-invalid').selectpicker('refresh');
            }
        });

        if (!valido) {
            $("#errorForm").find(".alert").remove();
            $("#errorForm").append('<div class="alert alert-danger text-center text-uppercase" role="alert" style="margin-top:0.3rem; ">Favor de llenar todos los campos</div>')
        }



        if (valido) {
            $("#errorForm").find(".alert").remove();
            let formData = new FormData(this);
            let reclutador = "<?php echo $_SESSION['usuario']; ?>"

            formData.append('reclutador', reclutador);

            $.ajax({

                url: "http://172.20.20.56:8080/ravisa/onbase/registrarCandidato", // Archivo PHP que procesará los archivos
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    
                    let data = JSON.parse(response)
                    
                    mostrarToast(`${data.nombre} agregado correctamente.`, 'success');
                    $('#formulario')[0].reset();
                    $('.selectpicker').val('').selectpicker('refresh');


                },
                error: function() {

                }

            })
        }

    });

    $("#telefono").on('change', function() {
        let telefono = $("#telefono").val()
        var direccion = "http://172.20.20.56:8080/ravisa/onbase/validaTelefonoCandidato";
        var url = direccion + "/" + $.trim(telefono);

        $.ajax({
            type: 'POST',
            url: url,
            dataType: 'json', // Archivo PHP que procesará los datos
            success: function(response) {
                if (response.length > 0) {
                    $("#errorForm").find(".alert").remove();
                    $("#telefono").addClass('is-invalid')
                    $("#botonEnviar").addClass('disabled')
                    $("#errorForm").append('<div class="alert alert-danger text-center text-uppercase" role="alert" style="margin-top:0.3rem; ">El candidato ya existe</div>')
                } else {
                    $("#telefono").removeClass('is-invalid')
                    $("#botonEnviar").removeClass('disabled')
                    $("#errorForm").find(".alert").remove();
                }

            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud AJAX: " + error);
            }
        });
    })

    function mostrarToast(mensaje, tipo = 'success') {
        const toastEl = $('#userToast');
        const toastIcon = $('#toastIcon');
        const toastMsg = $('#toastMensaje');

        const tipos = {
            success: {
                icon: 'bi-check-circle-fill',
                color: 'text-success'
            },
            error: {
                icon: 'bi-x-circle-fill',
                color: 'text-danger'
            },
            warning: {
                icon: 'bi-exclamation-triangle-fill',
                color: 'text-warning'
            },
            info: {
                icon: 'bi-info-circle-fill',
                color: 'text-primary'
            }
        };

        const t = tipos[tipo] || tipos.info;

        // Icono y color
        toastIcon.attr('class', `bi ${t.icon} me-3 fs-4 ${t.color}`);
        toastMsg.text(mensaje);

        // Mostrar el toast
        let toastElement = $("#userToast")[0]
        let toast = new bootstrap.Toast(toastElement, {
            delay: 6000,
            autohide: true
        });
        toast.show();


    }

    function generarSelectPuesto(data) {

        let html = ''

        data.map(e=> {
            html += `<option value="${e.Puesto}">${e.Puesto}</option>`;
        })

        return html;
    }
</script>