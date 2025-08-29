<?php include("public/inc/encabezado_sinbusqueda.php"); ?>


<div class="container-fluid bg-light mb-5 " style="margin-top: 0; padding-top: 0;">

    <div class="row mt-3 justify-content-center">

        <div class="col-sm-4 col-lg-6 d-flex gap-3" id="fechaCont">

            <input type="date" class="form-control " id="fechaInicio" name="fechaInicio" onchange="inputFecha()" step="1" value="">
            <input type="date" class="form-control " id="fechaFin" name="fechaFin" onchange="inputFecha()" step="1" value="">
            <button
                class="btn btn-success btn-sm"
                id="btnForm"
                data-bs-toggle="tooltip" data-bs-placement="top"
                title="Descargar CH Por Fecha Exacta">
                <i class=" bi bi-download"></i>
            </button>

        </div>



    </div>

    <div class="page-header my-3 ">

        <div class="row mt-5 d-flex justify-content-center">
            <div class="col-12 d-flex justify-content-center" style=" height: 700px;">
                <canvas id="miGrafica"></canvas>
            </div>
        </div>

        <div class="row justify-content-end mt-5">
            <div class="col-1">
                <div>
                    <button
                        class="btn btn-secondary"
                        id="downloadTable"
                        data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Descargar Tabla">
                        <i class=" bi bi-download"></i>
                    </button>
                </div>

            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12 table-responsive ">

                <table class="table table-bordered" id="tablaCandidatos">
                    <thead class="table-secondary ">
                        <tr>
                            <th>
                                Aduana
                            </th>
                            <th>
                                Estado
                            </th>
                            <th>
                                Fecha
                            </th>
                            <th>
                                Patente
                            </th>
                            <th>
                                Pedimento
                            </th>
                            <th>
                                Referencia
                            </th>
                            <th>
                                Sucursal
                            </th>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
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
    let sucursales = {}
    let sucursal = {}

    $(document).ready(function() {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

        checkValues()
        inputFecha()

        $.ajax({
            url: "http://172.20.20.56:8080/ravisa/onbase/getChecklistPendientes",
            type: 'POST',
            dataType: 'json',
            success: function(data) {

                let datos = datosGrafica(data)

                const ctx = document.getElementById('miGrafica').getContext('2d');

                grafica(ctx, datos)
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar clientes:', error);
            }
        })
    })

    $("#downloadTable").click(function() {
        let wb = XLSX.utils.table_to_book(document.getElementById('tablaCandidatos'), {
            sheet: "Checklist"
        });
        XLSX.writeFile(wb, 'Checklist.xlsx');
    });

    $("#btnForm").click(function() {
        let fechaInicio = $("#fechaInicio").val()
        let fechaFinal = $("#fechaFin").val()

        let data = {
            fechaInicio,
            fechaFinal
        }

        $("#overlay").show();
        $("#loading").show();

        $.ajax({
            url: "http://172.20.20.56:8080/ravisa/onbase/getChecklistPendientesFecha",
            type: 'POST',
            data,
            dataType: 'json',
            success: function(data) {
                
                // 1. Convertir el JSON a una hoja de Excel
                const ws = XLSX.utils.json_to_sheet(data);

                // 2. Crear un libro
                const wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, `${fechaInicio}-${fechaFinal}`);

                // 3. Descargar el archivo
                XLSX.writeFile(wb, `Checklist-${fechaInicio}-${fechaFinal}.xlsx`);

            },
            complete: function() {
                $("#overlay").hide();
                $("#loading").hide();
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar clientes:', error);
            }
        })
    })


    function datosGrafica(data) {

        let sucursal = []
        let cantidad = []

        data.forEach(e => {
            const key = e.SUCURSAL.trim();
            if (!sucursales[key]) {
                sucursales[key] = [];
            }
            sucursales[key].push(e);
        });


        Object.entries(sucursales).map(([key, val]) => {

            sucursal.push(key)
            cantidad.push(val.length)

        })

        return {
            sucursal,
            cantidad
        }


    }


    function grafica(ctx, data) {

        const existente = Chart.getChart("miGrafica");
        if (existente) {
            existente.destroy();
        }
        const miGrafica = new Chart(ctx, {
            type: 'pie', // otros: 'line', 'pie', 'doughnut', 'radar', etc.

            data: {
                labels: data.sucursal,
                datasets: [{
                        label: 'Cheklists',
                        data: data.cantidad,
                        backgroundColor: [
                            'rgb(255, 99, 132)', // rojo rosado
                            'rgb(54, 162, 235)', // azul claro
                            'rgb(255, 205, 86)', // amarillo
                            'rgb(75, 192, 192)', // turquesa
                            'rgb(153, 102, 255)', // púrpura
                            'rgb(255, 159, 64)', // naranja
                            'rgb(199, 199, 199)', // gris claro
                            'rgb(0, 204, 102)', // verde esmeralda
                            'rgb(255, 112, 67)', // coral
                            'rgb(100, 181, 246)', // azul cielo
                            'rgb(174, 213, 129)'
                        ],
                        //borderColor: 'rgba(54, 162, 235, 1)',
                        //borderWidth: 1
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
                        text: 'Reporte de Checklist Pendientes por Sucursal',
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
                        text: "Checklist",
                        font: {
                            size: 15,
                            family: "Merriweather"
                        },
                        padding: {
                            bottom: 30
                        }
                    }
                },
                onClick: (event, elements) => {
                    const chart = elements[0];
                    const index = chart.index;
                    const label = miGrafica.data.labels[index];


                    Object.entries(sucursales).map(([key, val]) => {
                        if (key === label) {
                            if (!sucursal[key]) {
                                sucursal[key] = [];
                                sucursal[key].push(...val)
                            } else {
                                delete sucursal[key]
                            }
                        }
                    })


                    let data = Object.values(sucursal).flat();


                    $('#tablaCandidatos tbody').html(tabla(data));
                    checkValues()

                }


            }
        });

        return miGrafica
    }

    function tabla(data) {

        let rows = '';

        data.forEach(sucursal => {
            rows += `
                    <tr>
                        <td>${sucursal.PEDIMENTO}</td>
                        <td>${sucursal.PATENTE}</td>
                        <td>${sucursal.ADUANA}</td>
                        <td>${sucursal.REFERENCIA}</td>
                        <td>${sucursal.ESTADO_FACTURA}</td>
                        <td>${sucursal.FECHA_FACTURA}</td>
                        <td>${sucursal.SUCURSAL}</td>
                        
                    </tr>`;

        })

        return rows


    }

    function checkValues() {
        if (Object.keys(sucursal).length > 0) {
            $("#tablaCandidatos").removeClass("hidden")
            $("#downloadTable").removeClass("disabled")

        } else {
            $("#tablaCandidatos").addClass("hidden")
            $("#downloadTable").addClass("disabled")
        }
    }

    function inputFecha() {
        if ($("#fechaInicio").val() !== "" && $("#fechaFin").val() !== "") {
            $("#btnForm").removeClass("disabled")
        } else {
            $("#btnForm").addClass("disabled")
        }
    }
</script>