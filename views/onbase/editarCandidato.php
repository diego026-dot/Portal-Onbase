<?php include("public/inc/encabezado_sinbusqueda.php"); ?>




<div class="container-fluid bg-light " style="margin-top: 0; padding-top: 0;">
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
                    <button class="nav-link btn btn-link text-uppercase text-secondary px-4"
                        onclick="location.replace('<?php echo constant('URL'); ?>pages/formularioCandidatosView')">
                        Agregar
                    </button>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-uppercase text-primary border-0 border-bottom border-3 border-primary rounded-0"
                        aria-current="page" href="#">
                        Editar
                    </a>
                </li>
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

        <div class="row justify-content-start mb-4 ">
            <div class="col-6 d-flex justify-content-start gap-4">
                <button class="btn btn-sm btn-primary" onclick="$('#modalPuesto').modal('show')">
                    + Puesto
                </button>


                <!-- <button class="btn btn-sm btn-secondary" onclick="$('#modalMedioR').modal('show')">
                    + Medio 
                </button> -->
            </div>


        </div>
        <div class="row">

            <?php if ($_SESSION['usuario'] === 'admin' || $_SESSION['usuario'] === 'Monserrat') { ?>
                <div class="col-3">
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

            <div class="col-3 " id="puestoCont">
                <input type="text" class="form-control filtroCampo" name="puesto" id="puesto" placeholder="Ingresa el  puesto">
            </div>

            <div class="col-2 " id="sucursalCont">
                <input type="text" class="form-control filtroCampo" name="sucursal" id="sucursal" placeholder="Ingresa la sucursal">
            </div>

            <div class="col-sm-12 col-lg-4 d-flex gap-3 " id="fechaCont">
                <input type="date" class="form-control filtroCampo" id="fechaInicio" name="fechaInicio" step="1" min="2023-01-01" value="">
                <input type="date" class="form-control filtroCampo" id="fechaFin" name="fechaFin" step="1" min="2023-01-01" value="">
            </div>

        </div>

        <div class="row mt-4">
            <div class="col-12 table-responsive">


                <table class="table table-bordered" id="tablaCandidatos">
                    <thead class="table-dark ">
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

                            </th>
                            <th>

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

        <div class="containerModal">
            <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">

                        <div class="modal-body">

                            <form class="p-4 border rounded shadow-sm " id="formulario">

                            </form>

                        </div>

                    </div>

                </div>
            </div>
            <!-- 
            <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-body">

                        </div>
                    </div>
                </div>
            </div> -->

        </div>

        <div class="containerModal">
            <div class="modal fade" id="modalPuesto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <div class="modal-body">

                            <form class="p-4 border rounded shadow-sm " id="agregarPuesto">

                                <div class="col-12 d-flex flex-column justify-content-center gap-4">
                                    <label for="puesto" class="text-uppercase fw-bold ">Agregar Puesto</label>
                                    <input type="text" name="puesto" class="form-control ">
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

        <!-- <div class="containerModal">
            <div class="modal fade" id="modalMedioR" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <div class="modal-body">

                            <form class="p-4 border rounded shadow-sm " id="agregarPuesto">
                                
                                <div class="col-12 d-flex flex-column justify-content-center gap-4">
                                    <label for="medioR" class="text-uppercase fw-bold ">Agregar Medio Reclutamiento</label>
                                    <input type="text" name="medioR" class="form-control ">
                                    <button type="submit" class="btn btn-success fw-bold text-uppercase">
                                        Guardar
                                    </button>
                                </div>

                            </form>

                        </div>

                    </div>

                </div>
            </div>

        </div> -->

    </div>

</div>



<?php include("public/inc/jsfooter.php"); ?>

<script>
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

    const sucursales = {
        "Manzanillo": "Manzanillo",
        "Barragan": "Barragan",
        "Apodaca": "Apodaca",
        "Veracruz": "Veracruz",
        "NuevoLaredo": "Nuevo Laredo",
        "Toluca": "Toluca",
        "Varsovia": "Varsovia",
        "AICM": "AICM",
        "AIFA": "AIFA",
        "Silao": "Silao",
        "RL": "RL"
    };
    $(document).ready(function() {
        getCandidatos()

    })

    $("#agregarPuesto").on("submit", function(e) {
        e.preventDefault()
        let formData = new FormData(this);

        $.ajax({

            url: "http://172.20.20.56:8080/ravisa/onbase/agregarPuesto", // Archivo PHP que procesará los archivos
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
            },
            complete: function() {

                $('#agregarPuesto')[0].reset();
                $("#modalPuesto").modal('hide');

            },
            error: function() {
                mostrarToast(`Error intenta nuevamente`, 'error');
            }

        })
    })

    function getCandidatos() {
        $.ajax({
            url: "http://172.20.20.56:8080/ravisa/onbase/getCandidatos",
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                let rows = tabla(data)
                $('#tablaCandidatos tbody').html(rows);
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar clientes:', error);
            }
        })
    }

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
        if (!valido) {
            $("#errorForm").find(".alert").remove();
            $("#errorForm").append('<div class="alert alert-danger text-center text-uppercase" role="alert" style="margin-top:0.3rem; ">Favor de llenar todos los campos</div>')
        }


        if (valido) {
            $("#errorForm").find(".alert").remove();
            let formData = new FormData(this);

            $.ajax({

                url: "http://172.20.20.56:8080/ravisa/onbase/actualizaCandidato", // Archivo PHP que procesará los archivos
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
                },
                complete: function() {

                    $('#formulario')[0].reset();
                    $("#modalForm").modal('hide');

                },
                error: function() {
                    mostrarToast(`Error intenta nuevamente`, 'error');
                }
            })
        }
    });

    function deleteCandidato(id, nombre) {
        let data = {
            "id": id,
            "nombre": nombre
        }
        $.ajax({
            url: "http://172.20.20.56:8080/ravisa/onbase/deleteCandidato",
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(data) {

                if (data.success) {
                    mostrarToast(`${data.success} a sido eliminado`, 'success');
                }
                if (data.error) {
                    mostrarToast(`${data.error}`, 'error');
                }

                getCandidatos()

            },
            error: function(xhr, status, error) {
                console.error('Error al cargar clientes:', error);
            }
        })
    }

    $(".filtroCampo").on("change", function() {
        let campoReclutador = $('#reclutador').val() === undefined ? '' : $('#reclutador').val().trim()

        let filtros = {
            reclutador: campoReclutador,
            puesto: $('#puesto').val().trim(),
            sucursal: $('#sucursal').val().trim(),
            fechaInicio: $('#fechaInicio').val(),
            fechaFin: $('#fechaFin').val()
        };

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

    function generarSelectEstatus(valorActual, id) {

        let html = `<select name="estatus" id="estatus" class="selectpicker" >`;

        Object.entries(estatus).forEach(([key, value]) => {
            let selected = (key == valorActual) ? 'selected' : '';
            html += `<option value="${key}" ${selected}>${value}</option>`;
        });

        html += `</select>`;
        return html;
    }

    function generarSelectEstatus(valorActual, id) {

        let html = `<select name="estatus" id="estatus" class="selectpicker" >`;

        Object.entries(estatus).forEach(([key, value]) => {
            let selected = (key == valorActual) ? 'selected' : '';
            html += `<option value="${key}" ${selected}>${value}</option>`;
        });

        html += `</select>`;
        return html;
    }

    function generarSelectEvaluacion(valorActual, id) {

        let html = `<select name="evaluacion" id="evaluacion"  class="selectpicker " >`;

        Object.entries(evaluacion).forEach(([key, value]) => {
            let selected = (key == valorActual) ? 'selected' : '';
            html += `<option value="${key}" ${selected}>${value}</option>`;
        });

        html += `</select>`;
        return html;
    }

    function generarSelectSucursal(valorActual, id) {

        let html = `<select name="sucursal" id="sucursal"  class="selectpicker " >`;

        Object.entries(sucursales).forEach(([key, value]) => {
            let selected = (key == valorActual) ? 'selected' : '';
            html += `<option value="${key}" ${selected}>${value}</option>`;
        });

        html += `</select>`;
        return html;
    }

    function tabla(data) {

        let rows = '';
        data.forEach(candidato => {
            const candidatoString = encodeURIComponent(JSON.stringify(candidato));
            rows += `
                    <tr>
                        <td>${candidato.Reclutador}</td>
                        <td>${candidato.Nombre}</td>
                        <td>${candidato.Puesto}</td>
                        <td>${candidato.Sucursal}</td>
                        <td>${candidato.Fecha}</td>
                        <td>${candidato.Telefono}</td>
                        <td>${candidato.MedioReclutamiento}</td>
                        <td><button class="btn btn-sm btn-secondary" onclick="modal('${candidatoString}')" ><i class="bi bi-pencil-square"></i></button></td>
                        <td><button class="btn btn-sm btn-danger" onclick="deleteCandidato(${candidato.Id},'${candidato.Nombre}')"><i class="bi bi-trash"></i></button></td>
                    </tr>`;
        });

        return rows


    }



    function modal(response) {

        let data = JSON.parse(decodeURIComponent(response))

        let mod = `
                    
                        <div class="row mb-3" id="errorForm">

                        </div>
                        
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" class="form-control " placeholder="Nombre" id="nombre" name="nombre" value="${data.Nombre}">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Medio Reclutamiento" id="medioR" name="medioR" value="${data.MedioReclutamiento}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-8">
                                <input type="text" class="form-control" id="puesto" name="puesto" placeholder="Puesto que ocupa o solicita" value="${data.Puesto}">
                            </div>
                            <div class="col-4">
                                ${generarSelectSucursal(data.Sucursal, data.Id)}
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="col">

                                <input type="email" class="form-control" id="correo" name="correo" placeholder="correo@ejemplo.com" value="${data.Correo}">
                            </div>
                            <div class="col" id="telContainer">
                                <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Numero de Telefono" value="${data.Telefono}">

                            </div>
                        </div>

                        <div class="mb-3">
                            <input type="url" class="form-control" id="url" name="url" placeholder="URL:" value="${data.URL}">


                        </div>

                        <div class=" row mb-3">
                            <div class="col-lg-4 col-sm-6">
                               ${generarSelectEstatus(data.Estatus, data.Id)}

                            </div>

                            <div class="col-lg-4 col-sm-6">
                                ${generarSelectEvaluacion(data.EvaluacionFinal, data.Id)}

                            </div>



                        </div>

                        <div class="mb-3">
                            <textarea class="form-control" id="comentarios" name="comentarios" rows="3" placeholder="Escribe tus comentarios aquí..." >${data.Comentarios}</textarea>
                            <input type="hidden" class="form-control " id="id" name="id" value=${data.Id}>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-sm-6 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary w-75" >Enviar</button>
                            </div>
                        </div>


                    
               `

        $('#modalForm .modal-body #formulario').html(mod);

        $('#modalForm').modal('show')

        $('.selectpicker').selectpicker('refresh');
    }

    // function modalDelete(id, nombre){
    //     let mod = `
    //         <p> Seguro quieres eliminar a ${nombre} </p>
    //     `
    //     $('#modalDelete .modal-body').html(mod);
    //     $('#modalDelete').modal('show')
    // }

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