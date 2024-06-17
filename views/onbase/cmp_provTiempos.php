<?php include("public/inc/encabezado_sinbusqueda.php");?>

   
<div class="main-container">
   <div class="pd-ltr-20 xs-pd-20-10">
      <div class="page-header mb-5">
         <div class="row">
            <div class="col-md-6 col-sm-12">
               <nav aria-label="breadcrumb" role="navigation">
                  <h4 class="modal-title">Alta proveedor tiempos</h4>
               </nav>


      <div class="container">
      <div class="row">
  <div class="col-3"> <h6> Fecha inicio: </h6>
  <input type="date" id="calendarioI" name="calendarioI" step="1" min="2019-01-01" max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>">

</div>
  <div class="col-3"> <h6> Fecha fin: </h6>
  <input type="date" id="calendarioF" name="calendarioF" step="1" min="2019-01-01" max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>">
  </div>
  <div class="col-2"><button type="button" class="btn btn-primary btn-sm" onclick="enviaDatosTablaDetalle();">Buscar</button>
</div>
  <div class="col-1">
  <button type="button" onclick="excel();" class="btn btn-success float-right btn-sm">Excel</button>
  </div>

</div>
      </div>
    

            </div>
            <div class="col-md-6 col-sm-12 text-right">
            <button type="button" onclick="regresar();" class="btn btn-danger float-right">Regresar</button>				
            </div>
         </div>
      </div>
     
      <?php echo mensaje(); ?>
      <div class="card-box mb-5">
         <div class="pb-20 table-responsive">
        
         <div id="ValoresTiemposAltaProv"> </div>
         </div>
      </div>
   </div>
</div>

<?php include("public/inc/jsfooter.php");?>
</html>
<script>
 


function excel(){
                $("#tablaProvT").table2excel ({
                formats: ["xlsx"], //Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
                position: 'bottom',  // Posicion que se muestran los botones puedes ser: (top, bottom)
                bootstrap: false,//Usar lo estilos de css de bootstrap para los botones (true, false)
                name: "altaProveedor_tiempos",
                filename : 'altaProveedor_tiempos'//Nombre del archivo 
            });
                }



function enviaDatosMes(){ 

   var fechaI=$("#calendarioI").val();   
   var fechaF=$("#calendarioF").val();   
   var resultI = fechaI.replaceAll("-", "@");
   var resultF = fechaF.replaceAll("-", "@");
          
   
          alert(resultI);
  
   var direccion="http://192.168.1.191:81/coflex/onbase/reclamosTiempos";
  
   var url = direccion+"/"+$.trim(resultI)+"/"+$.trim(resultF);
alert(url);
  $.ajax({                        
     type: "POST",
     url: url,            
     beforeSend: function(){ },  
  success: function(data){
     //alert(url);
     location.reload();

  }});
}
  

function enviaDatosTablaDetalle(norma, proceso){ 
   var fechaI=$("#calendarioI").val();   
   var fechaF=$("#calendarioF").val();   
   var resultI = fechaI.replaceAll("-", "@");
   var resultF = fechaF.replaceAll("-", "@");


  var direccion="http://192.168.1.191:81/coflex/onbase/cargaTabla_AltaProveedor_tiempos";
  
  var url = direccion+"/"+$.trim(resultI)+"/"+$.trim(resultF);


  $.ajax({                        
      type: "POST",
      url: url,            
      beforeSend: function(){ },  
  success: function(data){
      $("#ValoresTiemposAltaProv").html(data);   
     // $("#divImg3").css("display", "none");
  }});
}


</script>