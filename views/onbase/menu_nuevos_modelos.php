<?php include("public/inc/encabezado_sinbusqueda.php");?>
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
            <div class="page-header mb-5">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Nuevos modelos</a></li>
									<li class="breadcrumb-item active" aria-current="page">Menu</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right"></div>
					</div>
                    <section class="content" style="padding-top: 5px; padding-bottom: 5px;">
<div class="row">

<?php foreach($this->consulta_opcionesING as $row){ //INICIO DEL FOR ?>	
	<?php if($row->IdOpcion ==23){ ?>	
	   <div class="col-sm-3">	
       <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
       <div class="card-body">
       <button type="button" class="btn btn-light" style="margin:10px" onClick="nuevos_modelos()" title="Cambios de ing">
			<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/nuevodoc.png'?>
			title="Dashboard" width="140px"/>
			    </button> 
		<div style="color:#293080; font-weight:bold; font-size:18px;">SOLICITUD NUEVOS MODELOS</div>
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

	


<?php }//FIN DEL FOR?>
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
	  function nuevos_modelos(){
		window.open('<?php echo constant('URL')?>onbase/ing_nuevos_modelos/');
      }
</script>