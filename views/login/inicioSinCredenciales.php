<?php include("public/inc/encabezadoCambioRef.php"); ?>
<style>
		
		a {
			width: 200px;
			min-width: 120px;
		}

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
	</style>
<div class="container-fluid" style="margin-top: 0; padding-top: 0;">
    <div class="row">
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
    </div>


    <!-- Modal -->
    <div class="modal fade" id="noDataModal" tabindex="-1" role="dialog" aria-labelledby="noDataModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noDataModalLabel">Sin resultados</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    No se encontraron datos del cliente solicitado.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-base-regresar" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>





    

        <div class="row justify-content-md-center" style="margin-top: 50px;">
            <div class="col-lg-12 " style="padding: 5px">
                <p class="d-flex justify-content-center"><a
                        href="http://srvweb/AppNet//UnityForm.aspx?d1=Ac3LfJq43ixY7ihZn5f%2bVshFxZy99cEGAfobz%2ftf2oOub2kqEHVVg%2bGifTVErDgCRlZUAthefL%2f%2f30XsGSyRsolBv6aVXGbuv%2bNBKoh%2fhBdjOEAyDRTz9ixySowJeb5RLSn5Gd4K%2fouMYEpSskK3gegdNjzznKbGgWL0AUhdKfiMdON3pL5GI3T5%2bXQmK41V%2fhYsg6bTMU6txdt3sv5G9TE%3d"
                        class="btn btn-outline-primary " target="_blank" role="button" aria-pressed="true">Solicitud de Anticipo </a>
                </p>
            </div>
            <div class="col-lg-12 ">
                <p class="d-flex justify-content-center"><a
                        href="http://srvweb/AppNet//UnityForm.aspx?d1=AUBuuJnvLL8%2fC9Wt6VwCoXErqQgeJJnYJOUDP%2fq8g0SDYGtXKyv0gh9YV4OJxmU7RUdLRHBG13k%2bN7yg9z7Ehipb967pmyCSkKRWYPIoAWGEncUsc0XmsBQ%2f48dhro6ux8AOPP%2fyDzO6w2fl9s2X%2bJ%2baoiYu8PInGJUBkLvZA9m1aIL%2fRVjW3irL7EhHuijucXqP4GYhqKWfQigeTUr%2bEWQ%3d"
                        class="btn btn-outline-primary " target="_blank" role="button" aria-pressed="true">Cancelación Anticipo</a>
                </p>
            </div>
            <div class="col-lg-12 " style="padding: 5px">
                <p class="d-flex justify-content-center"><a
                        href="http://srvweb/AppNet//UnityForm.aspx?d1=AX37VcaQVsINqHE0G7zVninxFs61yLEZmVyxPuRnJZa%2bzwGpavLLafyDOn1Jc%2fTmt09mXc9bwb%2bemRtfVVcfk%2fTqeZP47JfJ6bz6zFXhnqYxK7GL9hewMDwNzBFsLpCWDh6B%2fiEKmemiABfDI1792w9fbKOSmnFUjxwtuIy1CPf%2b2WgQS44t7XkVlhjz1YG7Cp5kZTYWpJ5L06D%2bhI5QU6s%3d"
                        class="btn btn-outline-primary " target="_blank" role="button" aria-pressed="true">Checklist</a></p>
            </div>





        </div>

        <div id="main"></div>



    <!-- Contenedor para el overlay -->
    <div id="overlay" class="ocultar"></div>


    <!-- Contenedor para el GIF de carga -->
    <div id="loading" class="cargando">
        <img src="<?php echo constant('IMG'); ?>preloader/cargando2.gif" alt="" class="light-logo" style="height:70px;">
    </div>

</div>

<?php include("public/inc/jsfooterCambioRef.php"); ?>

<script>
    function regresar() {
        window.location = '<?php echo constant('URL') ?>onbase/facturacionReportes/';
    }

    // function excel() {
    //     $("#tabla20").table2excel({
    //         formats: ["xlsx"],
    //         position: 'bottom',
    //         bootstrap: false,
    //         name: "reclamos_tiempos",
    //         filename: 'reclamos_tiempos'
    //     });
    // }

    function enviaDatos() {
        var referencia = $("#ref").val();
        var folioSap = $("#num").val();

        if (referencia === '' || folioSap === '') {

            $("#main").find(".alert").remove();
            $("#main").append($('<div class="alert alert-danger text-center" role="alert" style="margin-top:0.3rem; ">Favor de llenar todos los datos</div>'))
            return
        }

        $("#main").find(".alert").remove();


        var direccion = "http://172.20.20.56:8080/ravisa/onbase/cambioReferencia";
        var url = direccion + "/" + $.trim(referencia) + "/" + $.trim(folioSap);
        console.log(url)

        $("#overlay").show();
        $("#loading").show();

        $.ajax({
            type: "POST",
            url: url,


            beforeSend: function() {},

            success: function(data) {

            },
            complete: function() {
                $("#overlay").hide();
                $("#loading").hide();
                $("#ref").val('');
                $("#num").val('');
            },
            error: function() {
                alert("A ocurrido algun error")
                $("#overlay").hide();
                $("#loading").hide();
            }

        });
    }



    function enviaDatosClienteDetalle(norma, proceso) {
        var fechaI = $("#calendarioI").val();
        var fechaF = $("#calendarioF").val();
        let select = $("#selectCliente").val()
        var cliente = select === null ? '' : select;


        var direccion = "http://172.20.20.56:8080/ravisa/onbase/cargaTabla_ReportePhilips";
        var url = direccion + "/" + $.trim(fechaI) + "/" + $.trim(fechaF) + "/" + $.trim(cliente);


        $("#overlay").show();
        $("#loading").show();


        $.ajax({
            type: "POST",
            url: url,
            beforeSend: function() {

            },
            success: function(data) {
                $("#ReporteClienteP").html(data);
                var dataFound = $("#data_found").val() === '1';

                if (!dataFound) {
                    // Mostrar el modal si no se encontraron datos
                    $('#noDataModal').modal('show');
                    $("#botonExcel").prop('disabled', true);
                } else {
                    // Habilitar el botón de exportar a Excel
                    $("#botonExcel").prop('disabled', false);
                }

            },

            complete: function() {
                $("#overlay").hide();
                $("#loading").hide();
            },
            error: function() {
                alert("A ocurrido algun error")
                $("#overlay").hide();
                $("#loading").hide();
            }


        });
    }
</script>