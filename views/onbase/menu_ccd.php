<?php include("public/inc/encabezado_sinbusqueda.php");?>
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
            <div class="page-header mb-5">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">CCD</a></li>
									<li class="breadcrumb-item active" aria-current="page">Menu</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right"></div>
					</div>
                    <section class="content" style="padding-top: 5px; padding-bottom: 5px;">
		
				<div class="row">
		<?php foreach($this->consulta_opcionesASG as $row){ //INICIO DEL FOR ?>	
					
		<?php if($row->IdOpcion ==3){ ?>	
		<div class="col-sm-3">	
		<div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
        <div class="card-body">
		<button type="button" class="btn btn-light" style="margin:10px" onClick="nuevo_doc()" title="Metas Corporativas">
					<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/nuevodoc.png'?>
					title="Nuevo Documento" onClick="nuevo_doc()" width="140px"/>
			</button>
		<div style="color:#293080; font-weight:bold; font-size:18px;">NUEVO</div> 
       </div>
       </div> 
       </div>  
       <?php } ?> <!-- fin del if -->

       <?php if($row->IdOpcion ==4){ ?>	
	   <div class="col-sm-3">	
       <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
       <div class="card-body">
		<button type="button" class="btn btn-light" style="margin:10px" onClick="ccd_modificacion()" title="Metas Corporativas">
			<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/modificacion.png'?>
			title="Modificación" onClick="ccd_modificacion()" width="140px"/>
			</button> 
		<div style="color:#293080; font-weight:bold; font-size:18px;">MODIFICACIÓN</div>
	    </div>
        </div>
        </div>
        <?php } ?> <!-- fin del if -->

        <?php if($row->IdOpcion ==5){ ?>	
	    <div class="col-sm-3">	
        <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
        <div class="card-body">
 	     <button type="button" class="btn btn-light" style="margin:10px" onClick="ccd_obsoleto()" title="Metas Corporativas">
			<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/obsoleto.png'?>
			title="Obsoleto" onClick="ccd_obsoleto()" width="140px"/>
			    </button> 
		<div style="color:#293080; font-weight:bold; font-size:18px;">OBSOLETO</div>
        </div>
        </div> 
	    </div>
        <?php } ?> <!-- fin del if -->

		<?php if($row->IdOpcion ==2){ ?>	
	    <div class="col-sm-3">	
        <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
        <div class="card-body">
        <button type="button" class="btn btn-light" style="margin:10px" onClick="ccd()" title="Consulta de Documentos">
			<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/ccd.png'?>
			title="CCD" onClick="ccd()" width="140px"/>
			    </button>   
		<div style="color:#293080; font-weight:bold; font-size:18px;">CONSULTA DOCUMENTOS</div>
       </div>
       </div>
	   </div>
       <?php } ?> <!-- fin del if -->

	   <?php if($row->IdOpcion ==7){ ?>	
       <div class="col-sm-3">	
       <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
       <div class="card-body">
      <button type="button" class="btn btn-light" style="margin:10px" onClick="ccd_aprobacion()" title="Metas Corporativas">
			<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/aprobacion.png'?>
			title="Aprobación" onClick="ccd_aprobacion()" width="140px"/>
			    </button>    
		<div style="color:#293080; font-weight:bold; font-size:18px;">APROBACIÓN</div>
        </div>
        </div>
	    </div>
       <?php } ?> <!-- fin del if -->

       <?php if($row->IdOpcion ==8){ ?>	
	   <div class="col-sm-3">	
       <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
       <div class="card-body">
       <button type="button" class="btn btn-light" style="margin:10px" onClick="panel()" title="Metas Corporativas">
			<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/dashboard.png'?>
			title="Dashboard" onClick="metascorporativas()" width="140px"/>
			    </button> 
		<div style="color:#293080; font-weight:bold; font-size:18px;">PANEL SOLICITUDES ABIERTAS</div>
        </div>
        </div> 
	    </div>
        <?php } ?> <!-- fin del if -->

		<?php if($row->IdOpcion ==13){ ?>	
	   <div class="col-sm-3">	
       <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
       <div class="card-body">
       <button type="button" class="btn btn-light" style="margin:10px" onClick="ccd_exepciones()" title="Excepciones">
			<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/nuevodoc.png'?>
			title="Exepciones" onClick="ccd_exepciones()" width="140px"/>
			    </button> 
		<div style="color:#293080; font-weight:bold; font-size:18px;">EXCEPCIONES</div>
        </div>
        </div> 
	    </div>
        <?php } ?> <!-- fin del if -->

		<?php if($row->IdOpcion ==14){ ?>	
	   <div class="col-sm-3">	
       <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
       <div class="card-body">
       <button type="button" class="btn btn-light" style="margin:10px" onClick="panelDocumentos()" title="Metas Corporativas">
			<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/dashboard.png'?>
			title="Consulta" onClick="metascorporativas()" width="140px"/>
			    </button> 
		<div style="color:#293080; font-weight:bold; font-size:18px;">PANEL DOCUMENTOS VIGENTES</div>
        </div>
        </div> 
	    </div>
        <?php }?> <!-- fin del if -->

		<?php if($row->IdOpcion ==19){ ?>	
	   <div class="col-sm-3">	
       <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
       <div class="card-body">
       <button type="button" class="btn btn-light" style="margin:10px" onClick="monitorSolicitudes()" title="Monitor Solicitudes">
			<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/dashboard.png'?>
			title="MonitorSolicitudes" onClick="" width="140px"/>
			    </button> 
		<div style="color:#293080; font-weight:bold; font-size:18px;">MONITOR SOLICITUDES</div>
        </div>
        </div> 
	    </div>
        <?php }?> <!-- fin del if -->

		<?php if($row->IdOpcion ==20){ ?>	
	   <div class="col-sm-3">	
       <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
       <div class="card-body">
       <button type="button" class="btn btn-light" style="margin:10px" onClick="DifuProcedimientos()" title="Difusión">
			<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/dashboard.png'?>
			title="Difusión" onClick="" width="140px"/>
			    </button> 
		<div style="color:#293080; font-weight:bold; font-size:18px;">DIFUSIÓN DE DOCUMENTOS</div>
        </div>
        </div> 
	    </div>
        <?php }?> <!-- fin del if -->

		<?php if($row->IdOpcion ==26){ ?>	
	   <div class="col-sm-3">	
       <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
       <div class="card-body">
       <button type="button" class="btn btn-light" style="margin:10px" onClick="copiasControladas()" title="Copias">
			<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/dashboard.png'?>
			title="Copias" onClick="" width="140px"/>
			    </button> 
		<div style="color:#293080; font-weight:bold; font-size:18px;">COPIAS CONTROLADAS</div>
        </div>
        </div> 
	    </div>
        <?php }?> <!-- fin del if -->

		
		<?php if($row->IdOpcion ==27){ ?>	
	   <div class="col-sm-3">	
       <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
       <div class="card-body">
       <button type="button" class="btn btn-light" style="margin:10px" onClick="actualizacionPuesto()" title="Copias">
			<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/nuevodoc.png'?>
			title="Copias" onClick="" width="140px"/>
			    </button> 
		<div style="color:#293080; font-weight:bold; font-size:18px;">ACTUALIZAR PUESTOS</div>
        </div>
        </div> 
	    </div>
        <?php }?> <!-- fin del if -->


    <?php }//FIN DEL FOR?>
</div>


<div class="main-container">

  <div class="row">
    <div class="col col-lg">
	<?php if(sizeof($this->consulta_datosob)!=0) { ?>

	<div style="color:#293080; font-weight:bold; font-size:18px;">MIS SOLICITUDES ABIERTAS</div>
	<table  class="table center table-center table-hover">
			        <thead>
						<tr>
							<th width="100px">FOLIO</th>
							<th width="100px">TIPO SOLICITUD</th>
							<th width="150px">CLAVE</th>
							<th width="50px">REVISIÓN</th>
							<th width="100px">TIPO DOCUMENTO</th>
							<th width="100px">FECHA</th>
							<th width="100px">ESTATUS</th>
							<th width="100px">APROBADOR</th>
                        </tr>
                    </thead>
                    <tbody>
					<?php foreach($this->consulta_datosob as $row){ //INICIO DEL FOR ?>	
                        <tr class="table-info"> 	
							<td><?php echo $row->FOLIO;?></td>	
							<td><?php echo $row->TIPOSOLICITUD;?></td>
							<td><?php echo $row->CLAVE;?></td>	
							<td><?php echo $row->REVISION;?></td>	
							<td><?php echo $row->TIPO;?></td>	
							<td><?php echo $row->FECHASOLICITUD;?></td>
							<td><?php echo $row->ESTATUS;?></td>	
							<td><?php echo $row->REVISORJEFE;?></td>		
					    </tr>         
					</tbody>
					
				<?php }   ?>
				</table> 
			

				<br>
			<?php }?>
			<?php if(sizeof($this->consulta_datosob2) != 0) { ?>
	<div style="color:#293080; font-weight:bold; font-size:18px;">MIS SOLICITUDES POR APROBAR</div>

	<table class="table table-center table-hover">
			        <thead>
						<tr>
						<th width="100px">FOLIO</th>
							<th width="100px">TIPO SOLICITUD</th>
							<th width="150px">CLAVE</th>
							<th width="50px">REVISIÓN</th>
							<th width="100px">TIPO DOCUMENTO</th>
							<th width="100px">FECHA</th>
							<th width="100px">ESTATUS</th>
							<th width="200px">SOLICITANTE</th>
							<th width="100px">APROBADOR</th>
							<th width="50px"></th>
						
                        </tr>
                    </thead>
                    <tbody>
					<?php foreach($this->consulta_datosob2 as $row2){ //INICIO DEL FOR ?>	
                        <tr class="table-info"> 	
						<td><?php echo $row2->FOLIO;?></td>	
							<td><?php echo $row2->TIPOSOLICITUD;?></td>
							<td><?php echo $row2->CLAVE;?></td>	
							<td><?php echo $row2->REVISION;?></td>	
							<td><?php echo $row2->TIPO;?></td>	
							<td><?php echo $row2->FECHASOLICITUD;?></td>
							<td><?php echo $row2->ESTATUS;?></td>
							<td><?php echo $row2->SOLICITANTE;?></td>		
							<td><?php echo $row2->REVISORJEFE;?></td>	
							<td>
							<i type="button" id="consultaob"  class="micon dw dw-edit1" title="Link OnBase"
							onclick="LinkOnbase('<?php echo $row2->URL;?>');"
							></i></td>	
					    </tr>         
					</tbody>
					<?php }  //FIN DEL FOR ?>
				</table> 
				
		

    </div>
	<?php } ?>


    
  </div>
 
</div>

</section><!-- /.content -->
				</div>
                <?php echo mensaje(); ?>
			</div>
		</div>
    </div>
<?php include("public/inc/jsfooter.php");?>
</html>

<script>
function ccd(){
	window.location='<?php echo constant('URL')?>onbase/documentos/';
      }

      function nuevo_doc(){
	window.location='<?php echo constant('URL')?>onbase/ccd_nuevo_documento/';
      }
      function ccd_modificacion(){
	window.location='<?php echo constant('URL')?>onbase/ccd_modificacion/';
      }
      function ccd_obsoleto(){
	window.location='<?php echo constant('URL')?>onbase/ccd_obsoleto/';
      }
      function ccd_aprobacion(){
	window.location='<?php echo constant('URL')?>onbase/ccd_aprobacion/';
      }
	  function panel(){
	window.open('https://coflexbpm.coflex.com.mx/reportingviewer/Viewer.aspx?enc=AZSpPx%2bBJ0ATH5T9O0AD2%2bqZm1rc4tmbfIu7aUu73qmvpmRKF8QhEgECWVgE71gx%2b63MMMEfjX04bD%2ber7ZCjZbHFnzteR2xX6N0qyJ7hu5CYMQOQEIH6VZVgELFt%2fEvqEjk9OtV4FZfGk3lZHXIsqhKswGcyKWHw6kXLc6UmcQv%2bv1UU%2bPW9K96i%2bXkAanzLApe0qh7%2bMcySddRprMVDHIXYb7YjhBJkdm79qgKStxD');
      }
	  function ccd_exepciones(){
	window.location='<?php echo constant('URL')?>onbase/ccd_exepciones/';
      }
	  function panelDocumentos(){
	window.open('https://coflexbpm.coflex.com.mx/reportingviewer/Viewer.aspx?enc=AbUCYz%2bI7tCwxcLnKFdk%2frYOiNxhWUK2DAXr6dBSmMs3Kbn4%2fkMosA3B7%2byCkNWPZqguVIZwQZ4KQmvXHnSNJjU9NWSqQ7BPFKFcgbFbqU2%2b3JbSOwCSB7vVfzUCCfveWarbaYvjMTbSb9WGqtzI3gukbb9l2o3kByuLaJUXRXX%2fh%2fqm%2fhKuqmHUAwcIEmlRYdbD1SIW1HG4Xiyi%2fVgevMN2ln07%2fpSGEqqf1aP5R2ws');
      }
	  function monitorSolicitudes(){
	window.open('https://coflexbpm.coflex.com.mx/AppNet/docpop/docpop.aspx?clienttype=html&cqid=147');
      }
	  function DifuProcedimientos(){
	window.location='<?php echo constant('URL')?>onbase/difusionProcedimientos/';
      }
	  function copiasControladas(){
		window.open('https://coflexbpm.coflex.com.mx/ReportingViewer/Viewer.aspx?enc=AXVhFv5T22RpAQwX7ErVS7OY9gmOXed1IuViuySuDqZD6ycbZAIzA7vKoVU6zjYioIXnkS8lPQ8o5fANJR%2fdKaSVkX47gBTTlO%2b3ctKl7zWEFp7%2bUzTj%2fK9SQLvUasSugSMaL6Rv4LSJIjA7DBE2az1FkTr%2f%2fzHSR%2fjP2AJE8UHo09B4JKdKCIAuzZS2ZMJ8eAoZ05c8e%2fsbfqF2ot%2btReNcK5IswlPyR0ZrtsHUcFd5');
      }
	  function actualizacionPuesto(){
	window.location='<?php echo constant('URL')?>onbase/actualizacionPuestos/';
      }
	  function LinkOnbase(url){
	window.open(url);
      }
</script>