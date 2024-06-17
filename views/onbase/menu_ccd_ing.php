<?php include("public/inc/encabezado_sinbusqueda.php");?>
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
            <div class="page-header mb-5">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Documentos Ingeniería</a></li>
									<li class="breadcrumb-item active" aria-current="page">Menu</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right"></div>
					</div>
                    <section class="content" style="padding-top: 5px; padding-bottom: 5px;">
<div class="row">

<?php foreach($this->consulta_opcionesING as $row){ //INICIO DEL FOR ?>	
	<?php if($row->IdOpcion ==9){ ?>	
	<div class="col-sm-3">	
		<div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
        <div class="card-body">
				<button type="button" class="btn btn-light" style="margin:10px" onClick="nuevo_doc()" title="Metas Corporativas">
			<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/nuevodoc.png'?>
			title="Nuevo Documento"  width="140px"/>
			    </button>
			       <div style="color:#293080; font-weight:bold; font-size:18px;">NUEVO</div>
				   </div>
       </div> 
       </div>  
        <?php } ?> <!-- fin del if -->
	   <?php if($row->IdOpcion ==10){ ?>	
	   <div class="col-sm-3">	
       <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
       <div class="card-body">
           	<button type="button" class="btn btn-light" style="margin:10px" onClick="ccd_modificacion_ing()" title="Metas Corporativas">
			<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/modificacion.png'?>
			title="Modificación" width="140px"/>
			    </button>
			       <div style="color:#293080; font-weight:bold; font-size:18px;">MODIFICACIÓN</div>
				   </div>
       </div> 
       </div>  
	   <?php } ?> <!-- fin del if -->
				   <?php if($row->IdOpcion ==11){ ?>	
	   <div class="col-sm-3">	
       <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
       <div class="card-body">
				   <button type="button" class="btn btn-light" style="margin:10px" onClick="ccd_obsoleto()" title="Metas Corporativas">
			<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/obsoleto.png'?>
			title="Obsoleto" width="140px"/>
			    </button>
			       <div style="color:#293080; font-weight:bold; font-size:18px;">OBSOLETO</div>
				   </div>
       </div> 
       </div>  
	   <?php } ?> <!-- fin del if -->
				   <?php if($row->IdOpcion ==12){ ?>	
	   <div class="col-sm-3">	
       <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
       <div class="card-body">
           	<button type="button" class="btn btn-light" style="margin:10px" onClick="ccd()" title="Consulta de Documentos">
			<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/ccd.png'?>
			title="CCD"  width="140px"/>
			    </button>
			       <div style="color:#293080; font-weight:bold; font-size:18px;">CONSULTA DOCUMENTOS
			</div>
				   </div>
       </div> 
       </div>  
	   <?php } ?> <!-- fin del if -->

	   <?php if($row->IdOpcion ==17){ ?>	
	   <div class="col-sm-3">	
       <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
       <div class="card-body">
           	<button type="button" class="btn btn-light" style="margin:10px" onClick="ccd_exepcionesing()" title="Exepciones">
			<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/nuevodoc.png'?>
			title="Exepciones"  width="140px"/>
			    </button>
			       <div style="color:#293080; font-weight:bold; font-size:18px;">EXCEPCIONES</div>
				   </div>
       </div> 
       </div>  
	   <?php } ?> <!-- fin del if -->

	   <?php if($row->IdOpcion ==15){ ?>	
	   <div class="col-sm-3">	
       <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
       <div class="card-body">
       <button type="button" class="btn btn-light" style="margin:10px" onClick="panelIng()" title="Metas Corporativas">
			<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/dashboard.png'?>
			title="Dashboard" width="140px"/>
			    </button> 
		<div style="color:#293080; font-weight:bold; font-size:18px;">PANEL SOLICITUDES ABIERTAS</div>
        </div>
        </div> 
	    </div>
        <?php } ?> <!-- fin del if -->

		<?php if($row->IdOpcion ==16){ ?>	
	   <div class="col-sm-3">	
       <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
       <div class="card-body">
       <button type="button" class="btn btn-light" style="margin:10px" onClick="panelDocumentosIng()" title="Metas Corporativas">
			<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/dashboard.png'?>
			title="Dashboard" width="140px"/>
			    </button> 
		<div style="color:#293080; font-weight:bold; font-size:18px;">PANEL DOCUMENTOS VIGENTES</div>
        </div>
        </div> 
	    </div>
        <?php } ?> <!-- fin del if -->

		<?php if($row->IdOpcion ==21){ ?>	
	   <div class="col-sm-3">	
       <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
       <div class="card-body">
       <button type="button" class="btn btn-light" style="margin:10px" onClick="ccd_ConfigDibujo()" title="Metas Corporativas">
			<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/nuevodoc.png'?>
			title="Dashboard" width="140px"/>
			    </button> 
		<div style="color:#293080; font-weight:bold; font-size:18px;">CONFIGURACIÓN DIBUJO</div>
        </div>
        </div> 
	    </div>
        <?php } ?> <!-- fin del if -->

		


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
							<i type="button" id="consultaobing"  class="micon dw dw-edit1" title="Link OnBase"
							onclick="LinkOnbaseing('<?php echo $row2->URL;?>');"
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
	window.location='<?php echo constant('URL')?>onbase/documentosING/';
      }

      function nuevo_doc(){
	window.open('<?php echo constant('URL')?>onbase/ing_nuevo_documento/');
      }
      function ccd_modificacion_ing(){
		window.open('<?php echo constant('URL')?>onbase/ing_ccd_modificacion/');
	//window.location='<?php echo constant('URL')?>onbase/ing_ccd_modificacion/';
      }
      function ccd_obsoleto(){
		window.open('<?php echo constant('URL')?>onbase/ing_ccd_obsoleto/');
      }
	  function ccd_exepcionesing(){
	window.location='<?php echo constant('URL')?>onbase/ccd_exepciones/';
      }
	  function panelIng(){
		window.open('https://coflexbpm.coflex.com.mx/reportingviewer/Viewer.aspx?enc=ATl%2f1SOQ3S%2bKLUCOhL9cs%2feFaoGlDRKG0Vg1O4d%2fduh1UvfDATIYhR%2fS3LomPFh%2bVxZk7HjxDi9E9pFu4j43Nma05c9BdkBg2JGPTj42jdVM6uq1P35YUymKxhiHm5bKle8XExj7lIxIgy32HGcALvjszEZDHIxTCdVXVsAngStLQaihYjGD1dhqRk7691fN4LlIg%2fQRYuFFp%2bVURcbQLlKcI98RSaAqWHIA5Ag%2fpxLw');
      }
	  function panelDocumentosIng(){
	window.open('https://coflexbpm.coflex.com.mx/reportingviewer/Viewer.aspx?enc=ATeLok4IHXN%2f0H%2fo%2bDOb4fdMc%2bRByCrZ03T2reE4Bi5FJAetMSLOmPZ%2bZemLaIbIPPYuZq3nR7mQDrA0WAIKMZh%2bDkCZegDtrRcOST%2b4gZVhZN3G57fCG38kU5nZzkv%2bAP3eCj9JAv5VxyRQU8dW7AYVIuZGcCDq%2bktUS%2bu01eMFBSzSgbjviuwyEwkeBjE4MsE%2fuduxOMz11cjrbNdL85vT8xnsOhb2ch3q484QG%2fFl');
      }
	  function LinkOnbaseing(url){
	window.open(url);
      }
	  function ccd_ConfigDibujo(){
		window.open('<?php echo constant('URL')?>onbase/ing_ccd_configdibujo/');
      }
	  function ccd_cambiosING(){
		window.open('<?php echo constant('URL')?>onbase/ing_ccd_cambio_ing/');
      }
</script>