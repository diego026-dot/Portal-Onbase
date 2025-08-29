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
                        <a class="nav-link active text-uppercase text-primary border-0 border-bottom border-3 border-primary rounded-0"
                            aria-current="page" href="#">
                            Estadisticas
                        </a>
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

        <div class="row justify-content-center mb-5">
            <div class="col-3">
                <select name="reclutador" id="reclutador" class="selectpicker filtroCampo">
                    <option value="" selected> Reclutador </option>

                    <option value="Miriam"> Miriam </option>
                    <option value="Monserrat"> Monserrat </option>
                    <option value="Fernanda"> Fernanda </option>
                    <option value="Valeria"> Valeria </option>

                </select>
            </div>
            <div class="col-sm-6 col-lg-5 d-flex gap-3 " id="fechaCont">
                <input type="date" class="form-control filtroCampo" id="fechaInicio" name="fechaInicio" step="1" min="2023-01-01" value="">
                <input type="date" class="form-control filtroCampo" id="fechaFin" name="fechaFin" step="1" min="2023-01-01" value="">
            </div>
        </div>
        <div class="row mt-5 d-flex justify-content-center">
            <div class="col-8" style=" height: 500px;">
                <canvas id="miGrafica"></canvas>
            </div>
        </div>



    </div>
</div>

<?php include("public/inc/jsfooter.php"); ?>


<script>
    $(document).ready(function() {

        $.ajax({
            url: "http://172.20.20.56:8080/ravisa/onbase/getCandidatos",
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                let user = datosGrafica(data)
                const ctx = document.getElementById('miGrafica').getContext('2d');
                grafica(ctx, user.sucursal, user.cantidad)

            },
            error: function(xhr, status, error) {
                console.error('Error al cargar clientes:', error);
            }
        })
    })


    $(".filtroCampo").on("change", function() {
        let campoReclutador = $('#reclutador').val() === undefined ? '' : $('#reclutador').val().trim()

        let filtros = {
            reclutador: campoReclutador,
            fechaInicio: $('#fechaInicio').val(),
            fechaFin: $('#fechaFin').val()
        };
        console.log(filtros)

        $.ajax({
            url: "http://172.20.20.56:8080/ravisa/onbase/filtrarCandidato", // Cambia por tu ruta real
            type: 'POST',
            data: filtros,
            success: function(response) {
                let data = JSON.parse(response)

                let user = datosGrafica(data)

                const ctx = document.getElementById('miGrafica').getContext('2d');
                grafica(ctx, user.sucursal, user.cantidad)
            },
            error: function() {
                console.error('Error en la solicitud AJAX');
            }
        });
    })

    function datosGrafica(data) {
        const contador = {};
        const sucursal = []
        const cantidad = []

        data.forEach(e => {
            contador[e.Sucursal] = (contador[e.Sucursal] || 0) + 1;
        });

        Object.entries(contador).map(([suc, cant]) => {
            sucursal.push(suc),
                cantidad.push(cant)
        });

        return {
            sucursal,
            cantidad
        }
    }


    function grafica(ctx, sucursal, cantidad) {
        const existente = Chart.getChart("miGrafica");
        if (existente) {
            existente.destroy();
        }
        const miGrafica = new Chart(ctx, {
            type: 'bar', // otros: 'line', 'pie', 'doughnut', 'radar', etc.

            data: {
                labels: sucursal,
                datasets: [{
                    label: 'Candidatos',
                    data: cantidad,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Estadisticas De Reclutadores',
                        font: {
                            size: 20,
                            family: 'tahoma'
                        },
                        padding: {
                            top: 10,
                            bottom: 40
                        }
                    }
                }


            }
        });

        return miGrafica
    }


    // function tabla(data) {
    //     let rows = '';
    //     data.forEach(candidato => {
    //         rows += `
    //                 <tr>
    //                     <td><a href="${candidato.URL}" class="btn btn-light btn-sm" target="_blank"><i class="bi bi-link-45deg fs-5"></i></a></td>
    //                     <td>${candidato.Reclutador}</td>
    //                     <td>${candidato.Nombre}</td>
    //                     <td>${candidato.Apellido}</td>
    //                     <td>${candidato.Puesto}</td>
    //                     <td>${candidato.Sucursal}</td>
    //                     <td>${candidato.Telefono}</td>
    //                     <td>${candidato.Correo}</td>
    //                     <td>${candidato.Estatus}</td>
    //                     <td>${candidato.Comentarios}</td>
    //                     <td>${candidato.Fecha}</td>

    //                 </tr>`;
    //     });

    //     return rows

    // }
</script>