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
                        <button class="nav-link btn btn-link text-uppercase text-secondary px-4"
                            onclick="location.replace('<?php echo constant('URL'); ?>pages/estadisticasCandidatosView')">
                            Estadísticas
                        </button>
                    </li>
                <?php }
                ?>
                <?php if ($_SESSION['usuario'] === 'admin' || $_SESSION['usuario'] === 'Monserrat') { ?>
                    <li class="nav-item">
                        <a class="nav-link active text-uppercase text-primary border-0 border-bottom border-3 border-primary rounded-0"
                            aria-current="page" href="#">
                            Reportes
                        </a>
                    </li>
                <?php }
                ?>
            </ul>
        </div>
    </div>

    <div class="page-header mb-5 ">

        <div class="row justify-content-center mb-5">
            <div class="col-3">
                <select name="medioR" id="medioR" class="selectpicker filtroCampo">
                    <option value="" selected> Medio Reclutamiento </option>

                    <option value="OCC"> OCC </option>
                    <option value="Facebook"> Facebook </option>
                    <option value="CompuTrabajo"> Computrabajo </option>

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

        <div class="row mt-5">
            <div class="col-12 table-responsive">
                <table class="table table-bordered" id="tablaCandidatos">
                    <thead class="table-success ">

                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-5 justify-content-center">
            <div class="col-3 ">
                <button class="btn btn-success w-100  hidden text-uppercase" id="excel" onclick="excel()">Excel</button>
            </div>
        </div>



    </div>
</div>

<?php include("public/inc/jsfooter.php"); ?>


<script>
    function excel() {
        $("#tablaCandidatos").table2excel({
            formats: ["xlsx"],
            position: 'bottom',
            bootstrap: false,
            name: "Reporte",
            filename: 'Reporte'
        });
    }


    $(".filtroCampo").on("change", function() {
        let medioR = $('#medioR').val() === undefined ? '' : $('#medioR').val().trim()

        let filtros = {
            medioR,
            fechaInicio: $('#fechaInicio').val(),
            fechaFin: $('#fechaFin').val()
        };


        if (!Object.values(filtros).includes('')) {
            $.ajax({
                url: "http://172.20.20.56:8080/ravisa/onbase/filtrarCandidato", // Cambia por tu ruta real
                type: 'POST',
                data: filtros,
                success: function(response) {
                    let data = JSON.parse(response)


                    let user = datosGrafica(data)


                    const ctx = document.getElementById('miGrafica').getContext('2d');

                    grafica(ctx, user, medioR)
                    let resultadoTabla = tabla(user)


                    $('#tablaCandidatos thead ').html(`<tr>${resultadoTabla.head}</tr>`);
                    $('#tablaCandidatos tbody').html(resultadoTabla.body);
                    $("#excel").removeClass('hidden')

                },
                error: function() {
                    console.error('Error en la solicitud AJAX');
                }
            });
        }

    })

    function datosGrafica(data) {

        const sucursales = {}
        let sucursal = []
        let aptos = []
        let ingresados = []
        let contactados = []

        data.forEach(d => {
            if (!sucursales[d.Sucursal]) {
                sucursales[d.Sucursal] = [];
            }
            sucursales[d.Sucursal].push(d);
        });



        Object.entries(sucursales).map(([key, val]) => {
            let contadorAptos = 0
            let contadorEstatus = 0
            sucursal.push(key)
            contactados.push(val.length)
            val.forEach((a) => {
                if (a.EvaluacionFinal === 'Apto') {
                    contadorAptos++
                }
                if (a.Estatus === "10") {
                    contadorEstatus++
                }
            })

            aptos.push(contadorAptos)
            ingresados.push(contadorEstatus)

        })

        return {
            sucursal,
            contactados,
            aptos,
            ingresados
        }


    }


    function grafica(ctx, data, pagina) {
        const existente = Chart.getChart("miGrafica");
        if (existente) {
            existente.destroy();
        }
        const miGrafica = new Chart(ctx, {
            type: 'bar', // otros: 'line', 'pie', 'doughnut', 'radar', etc.

            data: {
                labels: data.sucursal,
                datasets: [{
                        label: 'Candidatos',
                        data: data.contactados,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Aptos',
                        data: data.aptos,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1

                    },
                    {
                        label: 'Ingresados',
                        data: data.ingresados,
                        backgroundColor: 'rgba(75, 192, 75, 0.5)',
                        borderColor: 'rgba(75, 192, 75, 1)',
                        borderWidth: 1

                    },
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Reporte de Paginas De Reclutamiento',
                        font: {
                            size: 18
                        },
                        padding: {
                            top: 10,
                            bottom: 20
                        }
                    },
                    subtitle: {
                        display: true,
                        text: pagina,
                        font: {
                            size: 15,
                            family: "Merriweather"
                        },
                        padding: {
                            bottom: 30
                        }
                    }
                }


            }
        });

        return miGrafica
    }


    function tabla(data) {
        let head = '<th> </th>';
        let body = ''
        let contactados = ''
        let aptos = ''
        let ingresados = ''
        data.sucursal.forEach(d => {
            head += `
                        <th>${d}</th>
            
                    `;
        });
        data.contactados.forEach(d => {
            contactados += `
                            <td>${d}</td>
                        
                            `
        });

        data.aptos.forEach(d => {
            aptos += `
                            <td>${d}</td>
                        
                            `
        });

        data.ingresados.forEach(d => {
            ingresados += `
                            <td>${d}</td>
                        
                            `
        });

        body = `
                <tr>
                    <th scope="row">Contactados</th>
                    ${contactados}
                </tr>
                <tr>
                    <th scope="row">Aptos</th>
                    ${aptos}
                </tr>
                <tr>
                    <th scope="row">Ingresados</th>
                    ${ingresados}
                </tr>

                `

        return {
            head,
            body
        }

    }
</script>