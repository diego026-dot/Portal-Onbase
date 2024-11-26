<?php include("public/inc/encabezado_sinbusqueda.php"); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.7.7/xlsx.core.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xls/0.7.5/xls.core.min.js"></script>

<div class="container-fluid" style="margin-top: 0; padding-top: 0;">

    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between">
            <nav aria-label="breadcrumb" role="navigation" class="bg-transparent">
                <ol class="breadcrumb mb-1 bg-transparent">
                    <li class="breadcrumb-item">
                        <img src="https://static.wixstatic.com/media/fe7c4c_794ee55525f8446ba0a6ba64d5afaeb6~mv2.png/v1/fill/w_120,h_48,al_c,lg_1,q_85,enc_auto/fe7c4c_794ee55525f8446ba0a6ba64d5afaeb6~mv2.png" alt="Icono" style="width: 40px; height: auto; margin-right: 10px;">
                        <a href="#">Facturación</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Cheklist</li>
                </ol>
            </nav>
            <button type="button" onclick="regresar();" class=" btn-base-regresar">Regresar</button>
        </div>
    </div>



    <div class="row mt-2 mb-1 align-items-center justify-content-center " id="content">
        <div class="col-3 col-md-2 mr-4 mb-2" id="label">

            <label for="pedimento" class="form-label mb-1 font-weight-bold">Pedimento</label>
            <input type="text" class="form-control" id="pedimento" onchange="cambioDeBoton()">

        </div>
        <div class="col-3 col-md-2 mb-3 " id="labelP">
            <label for="patente" class="form-label mb-1 font-weight-bold"> Patente</label>
            <input type="text" class="form-control" id="patente" onchange="cambioDeBoton()">
        </div>
        <div class=" col-3 col-md-2 mb-3" id="labelA">
            <label for="aduana" class="form-label mb-1 font-weight-bold">Aduana</label>
            <input type="text" class="form-control" id="aduana" onchange="cambioDeBoton()">
        </div>

        <div class="col-3 col-md-2 d-flex justify-content-end">
            <div class="hidden" id="buscar">
                <button type="button" class="btn-base mr-3 " onclick="enviaDatosClienteDetalle();">Buscar</button>
            </div>

            <div id="botonExcel">
                <label class="btn-base mr-3 " style="background-color: green !important; cursor:pointer; ">
                    <i class="fas fa-file-excel"></i> Excel
                    <input type="file" class="file-btn" name="file" id="file" accept=".xlsx,.xls" onchange="cambioDeBoton()">
                </label>
            </div>

            <div class="hidden " id="buscarExcel">
                <button type="button" class="btn-base " onclick="convierteexcel()">Buscar Excel</button>
            </div>


        </div>
    </div>



    <div id="main">

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


    <div class="min-height-200px mt-2 ">
        <div class="page-header mb-5">
            <div class="table-responsive mt-3">
                <div id="ReporteClienteP"> </div>

            </div>

        </div>


        <!-- Contenedor para el overlay -->
        <div id="overlay" class="ocultar"></div>


        <!-- Contenedor para el GIF de carga -->
        <div id="loading" class="cargando">
            <img src="<?php echo constant('IMG'); ?>preloader/cargando2.gif" alt="" class="light-logo" style="height:70px;">
        </div>

    </div>
</div>
<?php include("public/inc/jsfooter.php"); ?>

<script>
    function regresar() {
        window.location = '<?php echo constant('URL') ?>onbase/facturacionReportes/';
    }


    function convierteexcel() {

        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xlsx|.xls)$/;
        //Checks whether the file is a valid excel file/  
        if (regex.test($("#file").val().toLowerCase())) {
            var xlsxflag = false;
            //Flag for checking whether excel is .xls format or .xlsx format/  
            if ($("#file").val().toLowerCase().indexOf(".xls" || ".xlsx") > 0) {
                xlsxflag = true;
            }
            //Checks whether the browser supports HTML5/  
            if (typeof(FileReader) != "undefined") {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var data = e.target.result;
                    //Converts the excel data in to object/  
                    if (xlsxflag) {
                        var workbook = XLSX.read(data, {
                            type: 'binary'
                        });
                    } else {
                        var workbook = XLS.read(data, {
                            type: 'binary'
                        });
                    }
                    //Gets all the sheetnames of excel in to a variable/  
                    var sheet_name_list = workbook.SheetNames;

                    var cnt = 0;
                    //This is used for restricting the script to consider only first sheet of excel/  
                    sheet_name_list.forEach(function(y) {
                        //Iterate through all sheets/  
                        ///Convert the cell value to Json/  
                        if (xlsxflag) {
                            var exceljson = XLSX.utils.sheet_to_json(workbook.Sheets[y]);
                        } else {
                            var exceljson = XLS.utils.sheet_to_row_object_array(workbook.Sheets[y]);
                        }
                        if (exceljson.length > 0 && cnt == 0) {

                            cargar_excel(exceljson);
                            cnt++;

                        }
                    });
                    $('#detalle_evaluacion_mensual').show();
                }
                if (xlsxflag) {
                    //If excel file is .xlsx extension than creates a Array Buffer from excel/  
                    reader.readAsArrayBuffer($("#file")[0].files[0]);
                } else {
                    reader.readAsBinaryString($("#file")[0].files[0]);
                }
            } else {
                alert("Sorry! Your browser does not support HTML5!");
            }
        } else {
            //notificacion_sweet(2, '¡Advertencia!','Favor de adjuntar excel!', 4000);
            alert("Falta cargar el archivo de tipo excel!");
        }


    }



    function enviaDatosClienteDetalle() {
        let pedimento = $("#pedimento").val()
        let patente = $("#patente").val()
        let aduana = $("#aduana").val()

        if (pedimento === '' || patente === '' || aduana == '') {

            $("#main").find(".alert").remove();
            $("#main").append($('<div class="alert alert-danger text-center" role="alert" style="margin-top:0.3rem; ">Favor de llenar todos los datos</div>'))
            return
        }

        $("#main").find(".alert").remove();


        var direccion = "http://172.20.20.56:8080/ravisa/onbase/cargaTablaCheklist";
        var url = direccion + "/" + $.trim(pedimento) + "/" + $.trim(patente) + "/" + $.trim(aduana);

        console.log(url)

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

    function cambioDeBoton() {
        if ($("#pedimento").val() != '' && $("#patente").val() != '' && $("#aduana").val() != '') {
            $("#buscar").removeClass("hidden")
            $("#botonExcel").addClass("hidden")
        }

        if ($("#file")[0].files.length > 0) {
            $("#buscarExcel").removeClass("hidden")
            $("#content").removeClass("justify-content-center")
            $("#content").addClass("justify-content-end")

            $("#label").addClass("hidden")
            $("#labelP").addClass("hidden")
            $("#labelA").addClass("hidden")
            $("#tablaVendor").removeClass("hidden")
        }
    }


    function cargar_excel(excel_json) {
       
            let xml = "<data>";

            excel_json.map(item => {
                xml += "<row>";
                xml += `<cell>${item.Pedimento}</cell>`;
                xml += `<cell>${item.Patente}</cell>`;
                xml += `<cell>${item.Aduana}</cell>`;
                xml += "</row>";
            });

            xml += "</data>";
            enviarDatosXML(xml);
        

    }

   
    function enviarDatosXML(xmlString) {
        //alert(xmlString);
        //var direccion = "http://192.168.1.191:81/coflex/onbase/enviaXMLtabla";
        //var url = direccion+"/"+$.trim(xmlString);

        //alert(url);

        var datos = {
            "XmlDatos": xmlString
        }

        console.log(datos)
        console.log(xmlString)

        $("#overlay").show();
        $("#loading").show();

        var peticion = $.ajax({
            url: "http://172.20.20.56:8080/ravisa/onbase/cargaExcelCheklist/",
            data: datos,
            type: 'POST',
            xhrFields: {
                responseType: 'blob'
            },
            success: function(data) {
                var a = document.createElement('a');
                var url = window.URL.createObjectURL(data);
                a.href = url;
                a.download = "Pedimentos_CL.xlsx";
                document.body.append(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
            },
            complete: function() {
                $("#overlay").hide();
                $("#loading").hide();
            },
            error: function() {
                console.log("No se ha podido obtener la información");
            }
        });

    }
</script>