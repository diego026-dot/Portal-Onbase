<?php include("public/inc/encabezado_sinbusqueda.php"); ?>

<div class="container-fluid bg-light " style="margin-top: 0; padding-top: 0;">
    <div class="row">
        <div class="col-12 d-flex justify-content-center mt-4">
            <ul class="nav nav-tabs border-bottom-0" style="font-weight: 600; font-size: 0.9rem;">
                <li class="nav-item">
                    <a class="nav-link active text-uppercase text-primary border-0 border-bottom border-3 border-primary rounded-0"
                        aria-current="page" href="#">
                        Registro
                    </a>
                </li>
                <li class="nav-item">
                    <button class="nav-link btn btn-link text-uppercase text-secondary px-4"
                        onclick="location.replace('<?php echo constant('URL'); ?>pages/formularioCandidatosView')">
                        Agregar
                    </button>
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



    <div class="page-header mb-5 ">
        <div class="row justify-content-center">

            <?php if ($_SESSION['usuario'] === 'admin' || $_SESSION['usuario'] === 'Monserrat') { ?>
                <div class="col-2 me-4">
                    <select name="reclutador" id="reclutador" class="selectpicker filtroCampo">
                        <option value="" selected> Reclutador </option>

                        <option value="Miriam"> Miriam </option>
                        <option value="Monserrat"> Monserrat </option>
                        <option value="Fernanda"> Fernanda </option>
                        <option value="Valeria"> Valeria </option>

                    </select>
                </div>
            <?php }
            ?>

            <div class="col-2" id="puestoCont">
                <input type="text" class="form-control filtroCampo" name="puesto" id="puesto" placeholder="Ingresa el  puesto">
            </div>

            <div class="col-2 " id="sucursalCont">
                <input type="text" class="form-control filtroCampo" name="sucursal" id="sucursal" placeholder="Ingresa la sucursal" >
            </div>

            <div class="col-5 d-flex gap-3 " id="fechaCont">
                <input type="date" class="form-control filtroCampo" id="fechaInicio" name="fechaInicio" step="1" min="2023-01-01" value="">
                <input type="date" class="form-control filtroCampo" id="fechaFin" name="fechaFin" step="1" min="2023-01-01" value="">
                <div class="mt-1">
                    <input type="checkbox" class="btn-check filtroCampo" id="candidatoPotencial" name="candidatoPotencial" value="11" >
                    <label class="btn btn-sm btn-outline-primary" for="candidatoPotencial">CPotencial</label>
                </div>
            </div>



        </div>

        <div class="row mt-5">
            <div class="col-12 table-responsive">


                <table class="table table-bordered" id="tablaCandidatos">
                    <thead class="table-secondary ">
                        <tr>
                            <th>
                                Reclutador
                            </th>
                            <th>
                                Nombre
                            </th>
                            <th>
                                Puesto
                            </th>
                            <th>
                                Sucursal
                            </th>
                            <th>
                                Fecha de Contacto
                            </th>
                            <th>
                                Telefono
                            </th>
                            <th>
                                Medio Reclutamiento
                            </th>
                            <th>
                                URL
                            </th>
                            <th>
                                Correo
                            </th>
                            <th>
                                Comentarios
                            </th>
                            <th>
                                Evaluacion Final
                            </th>
                            <th>
                                Estatus
                            </th>
                            <th>
                                Comentarios Finales
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
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

    <div class="containerModal">
        <div class="modal fade" id="modalComent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">

                    <div class="modal-body">

                        <form class="p-4 border rounded shadow-sm " id="agregarComentarioFinal">

                            <div class="col-12 d-flex flex-column justify-content-center gap-4">
                                <label for="comentario" class="text-uppercase fw-bold ">Agregar Comentarios Finales</label>
                                <textarea class="form-control" id="comentario" name="comentario" rows="3" placeholder="Escribe tus comentarios aquí..."></textarea>
                                <button type="submit" class="btn btn-success fw-bold text-uppercase">
                                    Guardar
                                </button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>


    </div>

</div>




<?php include("public/inc/jsfooter.php"); ?>

<script >
    $(document).ready(function() {
        getCandidatos()
    })

    // function toast() {
    //     Toastify({
    //         text: '<i class="bi bi-check-circle-fill text-success me-2"></i> Operación exitosa',
    //         duration: 2000,
    //         close: true,
    //         gravity: "top", // `top` or `bottom`
    //         position: "right", // `left`, `center` or `right`
    //         stopOnFocus: true,
    //         escapeMarkup: false, // Prevents dismissing of toast on hover
    //         style: {
    //             background: "white",
    //             color: "black"
                
    //         } // Callback after click
    //     }).showToast();
    // }

    function getCandidatos() {
        $.ajax({
            url: "http://172.20.20.56:8080/ravisa/onbase/getCandidatos",
            type: 'POST',
            dataType: 'json',
            success: function(data) {

                let rows = tabla(data)


                $('#tablaCandidatos tbody').html(rows);
                $('.selectpicker').selectpicker('refresh');
                const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
                const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

            },
            error: function(xhr, status, error) {
                console.error('Error al cargar clientes:', error);
            }
        })
    }

    const color = {
        'Apto': 'btn-success',
        'No apto': 'btn-danger'
    }
    const evaluacion = {
        'Apto': 'Apto',
        'No apto': 'No Apto'
    }


    const estatus = {
        1: "Ajuste de perfil de búsqueda",
        2: "Publicado",
        3: "Filtro y entrevista reclutamiento",
        4: "Entrevista con Gerencia",
        5: "Evaluaciones Psicométricas",
        6: "Entrevista usuario",
        7: "Investigación laboral",
        8: "En propuesta económica",
        9: "Con propuesta y fecha de ingreso",
        10: "Contratación cerrada",
        11: "Candidato potencial"
    };

    let filtros = {
        reclutador: '',
        sucursal: '',
        puesto: '',
        fechaInicio: '',
        fechaFin: '',
        candidatoPotencial: '',
    }

    function generarSelectEstatus(valorActual, id, nombre, tipo) {

        let html = `<select name="estatus${id}" id="estatus${id}" class="selectpicker" onchange="actualizaEstatus(${id}, '${nombre}',${tipo})">`;

        Object.entries(estatus).forEach(([key, value]) => {
            let selected = (key == valorActual) ? 'selected' : '';
            html += `<option value="${key}" ${selected}>${value}</option>`;
        });

        html += `</select>`;
        return html;
    }

    function generarSelectEvaluacion(valorActual, id, nombre, tipo) {

        let html = `<select name="evaluacion${id}" id="evaluacion${id}"  class="form-select form-select-sm  ${color[valorActual]}" onchange="actualizaEstatus(${id}, '${nombre}',${tipo})">`;

        Object.entries(evaluacion).forEach(([key, value]) => {
            let selected = (key == valorActual) ? 'selected' : '';
            html += `<option value="${key}" ${selected}>${value}</option>`;
        });

        html += `</select>`;
        return html;
    }

    function tabla(data) {

        let rows = '';
        data.forEach(candidato => {
            
            rows += `
                    <tr>
                        <td>${candidato.Reclutador}</td>
                        <td>${candidato.Nombre}</td>
                        <td>${candidato.Puesto}</td>
                        <td>${candidato.Sucursal}</td>
                        <td>${candidato.Fecha}</td>
                        <td>${candidato.Telefono}</td>
                        <td>${candidato.MedioReclutamiento}</td>
                        <td><a href="${candidato.URL}" class="btn btn-light btn-sm" target="_blank"><i class="bi bi-link-45deg fs-5"></i></a></td>
                        <td>${candidato.Correo}</td>
                        <td>
                            <p class="text-truncate" data-bs-toggle="tooltip" data-bs-placement="top" title="${candidato.Comentarios}">
                                ${candidato.Comentarios.substring(0, 15)}
                            </p>
                        </td>
                        <td class= "text-center">
                            ${generarSelectEvaluacion(candidato.EvaluacionFinal,candidato.Id,candidato.Nombre,1)}
                        </td>
                        <td>
                            ${generarSelectEstatus(candidato.Estatus,candidato.Id,candidato.Nombre,2)}
                        </td>
                        <td class= "text-center">
                            ${candidato.ComentarioFinal == null ? `<button type="button" class="btn btn-sm btn-primary" onclick="modalComent(${candidato.Id})">+</button>`
                                : `<p class="text-truncate" data-bs-toggle="tooltip" data-bs-placement="top" title="${candidato.ComentarioFinal}">
                                    ${candidato.ComentarioFinal.substring(0, 15)} </p> ` }
                        </td>

                    </tr>`;
        });

        return rows

    }

    function modalComent(id) {
        $('#modalComent').modal('show')
        $('#agregarComentarioFinal').off('submit').on('submit', function(e) {
            e.preventDefault()
            let formData = new FormData(this);
            formData.append('id', id);
            $.ajax({
                url: "http://172.20.20.56:8080/ravisa/onbase/agregarComentarioFinal", // Cambia por tu ruta real
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                    let data = JSON.parse(response)

                    if (data.success) {
                        mostrarToast(`${data.success}`, 'success');
                    }
                    if (data.error) {
                        mostrarToast(`${data.error}`, 'error');
                    }
                    getCandidatos()

                    $('#modalComent').modal('hide')
                    $('#agregarComentarioFinal')[0].reset();
                    $('.selectpicker').selectpicker('refresh');
                    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
                    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

                },
                error: function() {
                    console.error('Error en la solicitud AJAX');
                }
            });
        })

    }


    $(".filtroCampo").on("change", function(e) {

        filtros = {
            ...filtros,
            [e.target.name]: e.target.type === 'checkbox' ? (e.target.checked ? e.target.value : '') : e.target.value
        }

        $.ajax({
            url: "http://172.20.20.56:8080/ravisa/onbase/filtrarCandidato", // Cambia por tu ruta real
            type: 'POST',
            data: filtros,
            success: function(response) {
                let data = JSON.parse(response)
                let rows = tabla(data)

                $('#tablaCandidatos tbody').html(rows);
                $('.selectpicker').selectpicker('refresh');
                const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
                const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
                // Reemplaza con el contenedor de resultados
            },
            error: function() {
                console.error('Error en la solicitud AJAX');
            }
        });
    })

    function actualizaEstatus(id, nombre, tipo) {

        let data = {}
        if (tipo === 1) {
            let evaluacion = $(`#evaluacion${id}`).val().trim()
            if (evaluacion === "Apto") {
                $(`#evaluacion${id}`).removeClass("btn-danger")
                $(`#evaluacion${id}`).addClass("btn-success")
            } else {
                $(`#evaluacion${id}`).removeClass("btn-success")
                $(`#evaluacion${id}`).addClass("btn-danger")
            }
            data = {
                id,
                evaluacion,
                nombre,
                campo: "EvaluacionFinal"
            }
        } else {
            let estatus = $(`#estatus${id}`).val().trim()
            data = {
                id,
                estatus,
                nombre,
                campo: "Estatus"
            }
        }



        $.ajax({
            url: "http://172.20.20.56:8080/ravisa/onbase/actualizaEstatusCandidato", // Cambia por tu ruta real
            type: 'POST',
            data,
            success: function(response) {

                let data = JSON.parse(response)


                if (data.success) {
                    mostrarToast(`${data.success} actualizado correctamente`, 'success');
                }
                if (data.error) {
                    mostrarToast(`${data.error}`, 'error');
                }
            },
            error: function() {
                mostrarToast(`Error al actualizar.`, 'error');;
            }
        });
    }

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
</script>