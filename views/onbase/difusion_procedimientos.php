<?php include("public/inc/encabezado_sinbusqueda.php"); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="page-header mb-5">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <nav aria-label="breadcrumb" role="navigation">
                        <h4 class="modal-title">Seguimiento de difusión de documentos</h4>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <button type="button" onclick="regresar();" class="btn btn-danger float-right">Regresar</button>

                </div>
                
<div class="row mt-2">
    <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Norma</span>
                </div>
            <select class="form-control" aria-label="Default select example" id="selectNorma" name="selectNorma"> 
                            <?php foreach($this->normas as $row){  ?>
                            
                        <option value="<?php echo $row->NORMA;?>"><?php echo $row->NORMA;?></option>
                    <?php } ?>
            </select>
            </div>
    </div>
    <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Proceso</span>
                </div>
            <select class="form-control" aria-label="Default select example" id="selectProceso" name="selectProceso"> 
                            <?php foreach($this->procesosDifusion as $row){  ?>
                            
                        <option value="<?php echo $row->PROCESO;?>"><?php echo $row->PROCESO;?></option>
                    <?php } ?>
            </select>
            <button type="button" onclick="excel();" class="btn btn-success float-right">Excel</button>
            </div>
    </div>
</div>


                </div>
            </div>
        </div>
    </div>

    <div class="card-body" style="background-color:#FFF">
        <!-- card -->
        <ul class="nav nav-pills nav-fill">
            <li class="nav-item ">
                <a class="nav-link active" data-toggle="pill" href="#kardexempleados">Kardex Empleados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#kardexareas">Kardex Áreas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#kardexDetalle">Kardex Detalle</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">

            <div class="tab-pane container-fuild active table-responsive" id="kardexempleados">
                <br></br>

                <!-- KARDEX EMPLEADOS -->
               <div id="ValoresKardexEmpleados"></div>
                    <br>
                    <br>
                    <br>
                    <br>
                <center> 
                <div id="divImg" name="divImg">  
                    <img src=<?php echo constant('URL') . 'public/img/preloader/cargando.gif'?> width="572" height="572" />
                </div>
            </center>  
            </div>

            <div class="tab-pane container-fuild fade table-responsive" id="kardexareas">
                <br></br>
                <!-- KARDEXAREA -->
                <div id="ValoresKardexAreas"> </div>
                    <br>
                    <br>
                    <br>
                    <br>
                <center>      
                <div id="divImg2" name="divImg2">
                <img src=<?php echo constant('URL') . 'public/img/preloader/cargando.gif'?> width="572" height="572" />
                 </div>
            </center>       
                </div>
                
                <div class="tab-pane container-fuild fade table-responsive" id="kardexDetalle">
                <br></br>
                <!-- DETALLE -->
                <div id="ValoresKardexDetalle"> </div>
                    <br>
                    <br>
                    <br>
                    <br>
                <center>      
                <div id="divImg3" name="divImg3">
                <img src=<?php echo constant('URL') . 'public/img/preloader/cargando.gif'?> width="572" height="572" />
                 </div>
            </center>       
                </div>


            </div>
        </div>
    </div>
</div>

<?php include("public/inc/jsfooter.php"); ?>
<?php include("views/onbase/modals/modal_motivoCCD.php"); ?>
<?php include("views/onbase/modals/visor_documento.php"); ?>
<?php include("views/onbase/modals/modal_visor_claverelacionada.php"); ?>
<?php include("views/onbase/modals/modal_visor_documentosOBS.php"); ?>

</html>

<script>
       $(document).ready(function() {

        var norma=$("#selectNorma").val();
        var proceso=$("#selectProceso").val();
        enviaDatosKardexEmpleados(norma, proceso);
        enviaDatosKardexAreas(norma, proceso);
        enviaDatosKardexDetalle(norma, proceso);
    });
	$('#selectNorma').change(function(){

        var norma=$("#selectNorma").val();
        var proceso=$("#selectProceso").val();

        enviaDatosKardexEmpleados(norma, proceso);
        enviaDatosKardexAreas(norma, proceso);
        enviaDatosKardexDetalle(norma, proceso);
		});

        $('#selectProceso').change(function(){
            var norma=$("#selectNorma").val();
            var proceso=$("#selectProceso").val();

            enviaDatosKardexEmpleados(norma, proceso);
            enviaDatosKardexAreas(norma, proceso);
            enviaDatosKardexDetalle(norma, proceso);
            });


        function enviaDatosKardexDetalle(norma, proceso){ 
  
  var direccion="http://192.168.1.191:81/coflex/onbase/cargaTabla_KardexDetalle";
  
  var url = direccion+"/"+$.trim(norma)+"/"+$.trim(proceso);


  $.ajax({                        
      type: "POST",
      url: url,            
      beforeSend: function(){ },  
  success: function(data){
      $("#ValoresKardexDetalle").html(data);   
      $("#divImg3").css("display", "none");
  }});
}


function enviaDatosKardexEmpleados(norma, proceso){ 
  
		var direccion="http://192.168.1.191:81/coflex/onbase/cargaTabla_KardexEmpleados";
		
		var url = direccion+"/"+$.trim(norma)+"/"+$.trim(proceso);
 
		$.ajax({                        
			type: "POST",
			url: url,            
			beforeSend: function(){ },  
		success: function(data){
         
			$("#ValoresKardexEmpleados").html(data);   
            $("#divImg").css("display", "none");

		}});
	}

    function enviaDatosKardexAreas(norma, proceso){ 

    var direccion="http://192.168.1.191:81/coflex/onbase/cargaTabla_KardexAreas";
    
    var url = direccion+"/"+$.trim(norma)+"/"+$.trim(proceso);
 
    $.ajax({                        
        type: "POST",
        url: url,            
        beforeSend: function(){ },  
    success: function(data){
        
        $("#ValoresKardexAreas").html(data);   
        $("#divImg2").css("display", "none");
    }});
}



    $('#tabla').dataTable({
        iDisplayLength: 100,
        "language": {
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "No se encontraron registros",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Sin registros",
            "infoFiltered": "(Filtrado de _MAX_ total de registros)",
            "search": "Filtrar resultados _INPUT_",
            "paginate": {
                "previous": "Anterior",
                "next": "Siguiente"
            },
            select: 'single'
        }
    });

    $('#tabla2').dataTable({
        iDisplayLength: 100,
        "language": {
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "No se encontraron registros",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Sin registros",
            "infoFiltered": "(Filtrado de _MAX_ total de registros)",
            "search": "Filtrar resultados _INPUT_",
            "paginate": {
                "previous": "Anterior",
                "next": "Siguiente"
            },
            select: 'single'
        }
    });

    $('#tabla tbody').on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    function regresar() {
        window.location = '<?php echo constant('URL') ?>onbase/menu_ccd/';
    }


    function excel(){
                $("#tabla14").table2excel ({
                formats: ["xlsx"], //Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
                position: 'bottom',  // Posicion que se muestran los botones puedes ser: (top, bottom)
                bootstrap: false,//Usar lo estilos de css de bootstrap para los botones (true, false)
                name: "Empleados",
                filename : 'Empleados'//Nombre del archivo 
            });
                }
</script>