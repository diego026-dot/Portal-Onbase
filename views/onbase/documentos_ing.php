<?php include("public/inc/encabezado_ing.php");?>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
            <div class="page-header mb-5">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<nav aria-label="breadcrumb" role="navigation">
						    	<h4 class="modal-title">Consulta de documentos ingeniería</h4>
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
			              <!--  <th width="10px">ID</th>  -->
							<th> </th>
							<th>Clave</th>
							<th>Nombre</th>
							<th width="10px">Revisión</th>
							<th>Tipo Documento</th>
							<th>Tipo Dibujo</th>
							<th width="10px">Fecha Alta</th>
							<th width="20px">Clave Relacionada</th>
							<?php foreach($this->PermisoVisualizarModal as $row2){ //INICIO DEL FOR?>  
                     <?php if($row2->PermisoModal == 1){?>
						<?php } //end if?>
						<?php } // end foreach ?>
							<th>Solicitante</th>
                            <th width="10px">Estatus</th>
							<th></th>
							<th></th>
                        </tr>
                    </thead>
                    <tbody>
					<!-- <button type="button" id="btn_modal_visor"  class="btn-sm btn btn-link"
							onclick="datos_modal('<?php echo $row->ID;?>');"
							data-toggle="modal" data-target="#visor_documento">
							</button>    -->
                    <?php foreach($this->documentos as $row){ //INICIO DEL FOR    ?>
                       <?php if( $row->ESTATUS == "LIBERACIÓN MANUAL"){?> <tr class="table-warning"> <?php } ?>
					   <?php if( $row->ESTATUS == "PPAP"){?> <tr style = "background-color: #FF9343;"> <?php } ?>					
						<!-- <td>	<?php echo $row->ID;?></td>  -->
							<td>
							<?php if ($row->EXT == 'AI' || $row->EXT == 'ai') { ?> 
								<i type="button" id="btn_modal_descarga"  class="micon fa fa-eye" title="Descargar"
							onclick="downloadFile2('<?php echo $row->ID;?>','<?php echo $row->EXT;?>','<?php echo $row->CLAVE;?>');"></i>
							<?php } else {?>
							
								<i type="button" id="btn_modal_visor2"  class="micon fa fa-eye" title="Ver documento"
							onclick="datos_modalVisorExterno('<?php echo $row->ID;?>','<?php echo $row->EXT;?>','<?php echo $row->CLAVE;?>');"
							data-toggle="" data-target=""></i>
							    <?php } //FIN DEL IF ?>
						    </td>
							<td><?php echo $row->CLAVE;?></td>
							<td><?php echo $row->NOMBRE;?></td>
							<td><?php echo $row->REVISION;?></td>
							<td><?php echo $row->TIPO;?></td>
							<td><?php echo $row->TIPODIBUJO;?></td>
							<td><?php echo $row->FECHACIERRE;?></td>
							<td align="center"> 
							<?php // if ($row->TIPORELACION <>"INDIVIDUAL") { ?> 
							<i type="button" id="btn_modal_claverl"  class="micon dw dw-key1" title="Clave relacionada"
							onclick="enviaDatosModalClaveRL('<?php echo $row->CLAVE;?>');"
							data-toggle="modal" data-target="#claverelacionada_ing"></i>
							<?php // } ?>				
							</td>
							<td><?php echo $row->SOLICITANTE;?></td>
							<td><?php echo $row->ESTATUS;?></td>
							<td>
							<i type="button" id="b_motivo2"  class="micon dw dw-newspaper"  
							onclick="modal_comentario2('<?php echo $row->MOTIVO;?>');" data-toggle="modal" data-target="#modal_motivo" title="Comentarios"></i>	
							<?php ?></td>	
							<td align="center"> 
							<?php foreach($this->PermisoVisualizarModal as $row2){ //INICIO DEL FOR?>  
                     <?php if($row2->PermisoModal == 1){?>
						<button type="button" class="btn btn-danger">
							<i type="button" id="btn_modal_docsObs"  class="micon dw dw-door" title="Documentos obsoletos"
							onclick="enviaDatosModalDocsOBS('<?php echo $row->CLAVE;?>');"
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
<?php include("views/onbase/modals/visor_documento.php");?>
<?php include("views/onbase/modals/modal_motivoCCD.php");?>
<?php include("views/onbase/modals/modal_visor_claverelacionada.php");?>
<?php include("views/onbase/modals/modal_visor_documentosOBS.php");?>
</html>

<script>
        function datos_modal2(id, ext)
        { 
		//alert("http://192.168.1.191/coflex/public/pdf_docs/"+id+"."+ext+"pdf#zoom=95");
		$("#f_id").val(id);
		 document.getElementById('visordoc').src ="<?php echo constant('URL')?>public/pdf_docs/"+id+"."+'pdf'+"#toolbar=1"  
		//document.getElementById('visordoc').src ="http://192.168.1.191/coflex/public/pdf_docs/"+ID+".pdf#zoom=95" 
	//	var respuesta = document.getElementById('visordoc').src;
	//alert(respuesta);
}
function limpiar_modal()
{
    var id = $("#f_id").val();
	//alert("http://192.168.1.191/coflex/public/pdf_docs/"+id+".pdf#zoom=95");
		 document.getElementById('visordoc').src ="<?php echo constant('URL')?>public/pdf_docs/"+id+"#toolbar=0" 
    //document.getElementById('visordoc').src ="";
//	var id1 = document.getElementById('visordoc').src;
//	alert(id1);

}

function downloadFile2(id, ext, clave) {
	
	if(ext =='AI'){
		var file_path = 'http://192.168.1.191:81/coflex/public/pdf_docs/'+id+'.'+ext;
var a = document.createElement('A');
 var fileName = clave;//if you have the fileName header available
a.href = file_path;
a.download = file_path.substr(file_path.lastIndexOf('/') + 1);

document.body.appendChild(a);
a.click();
document.body.removeChild(a);

		//window.open('http://192.168.1.191:81/coflex/public/pdf_docs/'+id+'.'+ext);
		//window.open(file_path, clave);
    
	 }else{
		 
	urlToSend='http://192.168.1.191:81/coflex/public/pdf_docs/'+id+'.'+ext; 
	alert(urlToSend);
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

	 
   }//enf if
 }

 function enviaDatosModalClaveRL(clave){ 
		var direccion="http://192.168.1.191:81/coflex/onbase/carga_tablaClaveRL_ajax";
		
		var url = direccion+"/"+$.trim(clave)+"/"+$.trim(1);

		$.ajax({                        
			type: "POST",
			url: url,            
			beforeSend: function(){ },  
		success: function(data){
			$("#Valoresdocumentosrl").html(data);   
		}});
	}

	function enviaDatosModalDocsOBS(clave){ 
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

function modal_comentario2(motivo)
{
	//alert(motivo);
	var s = motivo.replace(/\|/g, '"');
	$("#m_motivo").val(s);
}
function visor_claverl(clave, ext)
{ 
    url ="<?php echo constant('URL')?>public/pdf_docs/"+clave+"."+ext+""
    window.open(url);
}
function datos_modalVisorExterno(id, ext, clave)
{

    url ="<?php echo constant('URL')?>public/pdf_docs/"+id+"."+ext+""
    window.open(url);
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
		//window.location='<?php echo constant('URL')?>onbase/menu_ccd_ing/';
		}


</script>

