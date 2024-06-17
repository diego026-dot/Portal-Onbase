<?php include("public/inc/encabezado.php");?>
<div class="main-container">
   <div class="pd-ltr-20 xs-pd-20-10">
      <div class="page-header mb-5">
         <div class="row">
            <div class="col-md-6 col-sm-12">
               <nav aria-label="breadcrumb" role="navigation">
                  <h4 class="modal-title">Consulta de documentos SGC</h4>
                  <h6 class="">Documentos encontrados: <?php print_r(count($this->documentos)); ?> </h6>
               </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
            <button type="button" onclick="regresar();" class="btn btn-danger float-right">Regresar</button>				
            </div>
         </div>
      </div>
      <?php echo mensaje(); ?>
      <?php /*INICIO DE TABLA */?>
      <div class="card-box mb-5">
         <div class="pb-20 table-responsive">
         <table id="tabla" class="table table-hover multiple-select-row">
			        <thead>
						<tr>
			             <!--   <th width="10px">ID</th>   -->
							<th width="2px"> </th>
							<th width="10px">Clave</th>
							<th width="20px">Título</th>
							<th width="1px">Revisión</th>
							<th width="8px">Tipo Documento</th>
							<th width="5px">Proceso</th>	
							<th width="3px">Clave Relacionada</th>   
                     <th width="8px">Fecha Alta</th>
							<th width="5px">Norma</th>
							<th width="7px">Solicitante</th>
                     <th width="1px">Estatus</th>
							<th width="2px"></th>
                     <th width="5px"></th>
                        </tr>
                    </thead>  
                    <tbody>
                    <?php foreach($this->documentos as $row){ //INICIO DEL FOR?>  
                        <?php if( $row->ESTATUS == "LIBERACIÓN MANUAL"){?> <tr class="table-warning"> <?php } ?>
                        <?php if( $row->ESTATUS == "PPAP"){?> <tr style = "background-color: #ACECFF;"> <?php } ?>
						<!--	<td><?php echo $row->ID;?></td>   --> 
							<td>
							<?php if ($row->EXT == 'AI' || $row->EXT == 'ai'|| strpos($row->CLAVE, 'FOR-')!== FALSE || strpos($row->CLAVE, 'MAP-')!== FALSE) { ?> 
                        <i type="button" id="btn_modal_descarga"  class="micon fa fa-eye" title="Descargar"
							onclick="downloadFile('<?php echo $row->ID;?>','<?php echo $row->EXT;?>','<?php echo $row->CLAVE;?>');"></i>
					    
						
							<?php } else { ?>		
                        <i type="button" id="btn_modal_visor"  class="micon fa fa-eye" title="Ver documento"
							onclick="datos_modal('<?php echo $row->ID;?>','<?php echo $row->EXT;?>');"
							data-toggle="modal" data-target="#visor_documento"></i>
							<?php } //FIN DEL IF ?>

                     <?php foreach($this->descargaDocs as $row2){ //INICIO DEL FOR?>  
                     <?php if($row2->PermisoDescarga == 1){?>
                    <i type="button" id="btn_modal_descarga"  class="micon dw dw-download" title="Descargar"
							onclick="downloadFile('<?php echo $row->ID;?>','<?php echo $row->EXT;?>','<?php echo $row->CLAVE;?>');"></i>
					    
                     <?php } // FIN DEL IF DESCARGADOC?> 
                     <?php } //FIN DEL FOREACH PERMISO DE DESCARGA ?>
						    </td>
							<td><?php echo $row->CLAVE;?></td>	
							<td><?php echo $row->NOMBRE;?></td>
							<td><?php echo $row->REVISION;?></td>
							<td><?php echo $row->TIPO;?></td>
							<td><?php echo $row->PROCESO;?></td>
							<td align="center"><?php //if ($row->TIPORELACION <>"INDIVIDUAL") { ?> 
							<i type="button" id="btn_modal_claverlsgc"  class="micon dw dw-key1" title="Clave relacionada"
							onclick="enviaDatosSGCModalClaveRL('<?php echo $row->CLAVE;?>');"
							data-toggle="modal" data-target="#claverelacionada_ing"></i>
							<?php //  } ?></td>
							<td><?php echo $row->FECHACIERRE;?></td>
							<td><?php echo $row->NORMA;?></td>
							<td><?php echo $row->SOLICITANTE;?></td>
                     <td><?php echo $row->ESTATUS;?></td>
							<td>
							<i type="button" id="b_motivo" title="Comentarios"  class="micon dw dw-newspaper"  
							onclick="modal_comentario('<?php echo $row->MOTIVO;?>');" data-toggle="modal" data-target="#modal_motivo"></i>	
							<?php ?>
                     <br> <br>
                     <i type="button" id="btn_modal_puestorl" title="Puestos relacionados" class="micon dw dw-user3"
							onclick="enviaDatosModalPuestoRL('<?php echo $row->CLAVE;?>');"
							data-toggle="modal" data-target="#puestoRLmodal"></i>
                  </td>
                     <td align="center"> 
							<?php foreach($this->PermisoVisualizarModal as $row2){ //INICIO DEL FOR?>  
                     <?php if($row2->PermisoModal == 1){?>
						<button type="button" class="btn btn-danger" >
							<i id="btn_modal_docsObs"  class="micon dw dw-door" title="Revisiones obsoletas"
							onclick="enviaDatosModalDocsOBSSGC('<?php echo $row->CLAVE;?>');"
							data-toggle="modal" data-target="#documentosOBSing"></i>
					 </button>
							<?php } //END IF ?>		
							<?php } //END FOREACH ?>			
							</td>
					    </tr>         
					<?php } //FIN DEL FOR?>
					</tbody>
				</table> 
         </div>
      </div>
   </div>
</div>

<?php include("public/inc/jsfooter.php");?>
<?php include("views/onbase/modals/modal_motivoCCD.php");?>
<?php include("views/onbase/modals/visor_documento.php");?>
<?php include("views/onbase/modals/modal_visor_claverelacionada.php");?>
<?php include("views/onbase/modals/modal_visor_documentosOBS.php");?>
<?php include("views/onbase/modals/modal_puesto_relacionados.php");?>
</html>
<script>
   $( document ).ready(function() {
   //consultar_documentos();
     });
   
     function cerrar_modal(){
     $("#exampleModal").modal("hide");
     $("#sgcclave").val('');
     $("#sgcnombre").val('');
     $("#sgcclaverl").val('');
     }
   
     function consultar_documentos(){
   
     var clave = $("#sgcclave").val();
     var nombre = $("#sgcnombre").val();
     var 	claverelacionada=$("#sgcclaverl").val();;
   
     		var datos = {
         		"sgcclave" : clave, 
         		"sgcnombre" : nombre,
     			"sgcclaverl" : claverelacionada
     		};
        		var peticion = $.ajax({
              url: '<?php echo constant('URL')?>onbase/documentos2/',
     			data: datos,
     			type: 'post',
              success: function(respuesta) {
   				cerrar_modal();
     			//$("#tabla").html(respuesta);
                 },
                 error: function() {
                     console.log("No se ha podido obtener la información");
                 }
             });
            }
   
          function datos_modal(id, ext)
          { 
   		
   		//alert("http://192.168.1.191/coflex/public/pdf_docs/"+id+".pdf#zoom=95");
   	$("#f_id").val(id);
   	//document.getElementById('visordoc').src ='//10.1.10.12/e/CCD/'+id+'.'+ext; 
      document.getElementById('visordoc').src ="<?php echo constant('URL')?>public/pdf_docs/"+id+"."+'pdf'+"#toolbar=1" 
   	 //document.getElementById('visordoc').src ="<?php echo constant('URL')?>public/pdf_docs/"+id+"."+ext+"#zoom=95" 
   	//document.getElementById('visordoc').src ="http://192.168.1.191/coflex/public/pdf_docs/"+ID+".pdf#zoom=95" 
   //	var respuesta = document.getElementById('visordoc').src;
   //alert(respuesta);
   		
   }
   function limpiar_modal()
   {
      var id = $("#f_id").val();
   //alert("http://192.168.1.191/coflex/public/pdf_docs/"+id+".pdf#zoom=95");
   	 document.getElementById('visordoc').src ="<?php echo constant('URL')?>public/pdf_docs/"+id+".pdf#zoom=95" 
   
   }
   
   function downloadFile(id, ext, clave) {
   
   
   urlToSend='http://192.168.1.191:81/coflex/public/pdf_docs/'+id+'.'+ext;
  // alert(urlToSend);
       var req = new XMLHttpRequest();
       req.open("GET", urlToSend, true);
       req.responseType = "blob";
       req.onload = function (event) {
           var blob = req.response;
           var fileName = clave;//if you have the fileName header available
           var link=document.createElement('a');
           link.href=window.URL.createObjectURL(blob);
           link.download=fileName;
           link.click();
       };
      
       req.send();
   }
   
   function modal_comentario(motivo)
   {
   var s = motivo.replace(/\|/g, '"');
   $("#m_motivo").val(s);
   }
   function enviaDatosSGCModalClaveRL(clave){ 
   	var direccion="http://192.168.1.191:81/coflex/onbase/carga_tablaClaveRL_ajaxSGC";
   	
   	var url = direccion+"/"+$.trim(clave)+"/"+$.trim(2);
   
   	$.ajax({                        
   		type: "POST",
   		url: url,            
   		beforeSend: function(){ },  
   	success: function(data){
   		$("#Valoresdocumentosrl").html(data);   
   	}});
   }
   function visor_claverl(clave, ext)
   { 
      url ="<?php echo constant('URL')?>public/pdf_docs/"+clave+"."+ext+""
      window.open(url);
   }

   function enviaDatosModalDocsOBSSGC(clave){ 
		var direccion="http://192.168.1.191:81/coflex/onbase/carga_tablaDocsOBS_ajax";
		
		var url = direccion+"/"+$.trim(clave)+"/"+$.trim(1);

		$.ajax({                        
			type: "POST",
			url: url,            
			beforeSend: function(){ },  
		success: function(data){
			$("#ValoresdocumentosOBS").html(data);   
		}});
	}

   function enviaDatosModalPuestoRL(clave){ 
      
		var direccion="http://192.168.1.191:81/coflex/onbase/carga_tablaPuestoRL_ajax";
		
		var url = direccion+"/"+$.trim(clave)+"/"+$.trim(1);

		$.ajax({                        
			type: "POST",
			url: url,            
			beforeSend: function(){ },  
		success: function(data){
			$("#Valorespuestosrl").html(data);   
		}});
	}

   
   $('#tabla').dataTable({ 
              iDisplayLength: 100,"language": {
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
                     
   $('#tabla tbody').on( 'click', 'tr', function () {
          if ( $(this).hasClass('selected') ) {
              $(this).removeClass('selected');
          }
          else {
              table.$('tr.selected').removeClass('selected');
              $(this).addClass('selected');
          }
      } );

      function regresar(){
         window.history.back();
		
      //   window.location='<?php echo constant('URL')?>onbase/menu_ccd/';
		}
   
</script>