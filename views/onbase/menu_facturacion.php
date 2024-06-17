<?php include("public/inc/encabezado_sinbusqueda.php"); ?>
<style>
    .card-hover {
        transition: transform 0.3s ease, background-color 0.3s ease; 
    }
    .card-hover:hover {
        transform: scale(1.01); 
        background-color: #D2D2E3; 
    }
    .card-hover:active {
        background-color: #d0d0d0; 
    }
</style>

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



						<div class="col-sm-3 ">
							<div class="card text-dark  mb-3 shadow card-hover" style="max-width: 18rem; cursor:pointer;">
								<div class="card-body text-center p-5">
										<i class="fi fi-br-file-invoice-dollar" style="font-size:90px; color:#08043b "></i></i>
										<a href="javascript:void(0)" class="stretched-link" onClick="fact_phillips()"></a>

									<div style="color:#293080; font-weight:bold; font-size:18px; margin-top:10px;">REPORTE PHILLIPS</div>
								</div>
							</div>
						</div>



						<div class="col-sm-3">
							<div class="card text-dark mb-3 shadow card-hover" style="max-width: 18rem;">
								<div class="card-body text-center">
									<!--<button type="button" class="btn btn-light" style="margin:10px" onClick="ccd_modificacion()" title="Metas Corporativas">
										
									<img class="borderedondo" src=<?php //echo constant('URL') . 'public/img/menu_ccd/modificacion.png' ?> title="Modificación" onClick="ccd_modificacion()" width="140px" />
									</button> -->
									<i class="fi fi-ss-file-edit" style="font-size:120px; color:#08043b "></i>
									<div style="color:#293080; font-weight:bold; font-size:18px;">MODIFICACIÓN</div>
									<a href="javascript:void(0)" class="stretched-link" onClick="nuevo_doc()"></a>
								</div>
							</div>
						</div>



						<div class="col-sm-3">
							<div class="card text-dark  mb-3 shadow card-hover" style="max-width: 18rem;">
								<div class="card-body text-center">
									<!--<button type="button" class="btn btn-light" style="margin:10px" onClick="ccd_obsoleto()" title="Metas Corporativas">
										<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/obsoleto.png' ?> title="Obsoleto" onClick="ccd_obsoleto()" width="140px" />
									</button> -->
									<i class="fi fi-tr-document-circle-wrong" style="font-size:120px; color:#08043b "></i>
									<div style="color:#293080; font-weight:bold; font-size:18px;">OBSOLETO</div>
									<a href="javascript:void(0)" class="stretched-link" onClick="nuevo_doc()"></a>
								</div>
							</div>
						</div>



						<div class="col-sm-3">
							<div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
								<div class="card-body ">
									<button type="button" class="btn btn-light" style="margin:10px" onClick="ccd()" title="Consulta de Documentos">
										<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/ccd.png' ?> title="CCD" onClick="ccd()" width="140px" />
									</button>
									<div style="color:#293080; font-weight:bold; font-size:18px;">CONSULTA DOCUMENTOS</div>
								</div>
							</div>
						</div>



						<div class="col-sm-3">
							<div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
								<div class="card-body ">
									<button type="button" class="btn btn-light" style="margin:10px" onClick="ccd_aprobacion()" title="Metas Corporativas">
										<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/aprobacion.png' ?> title="Aprobación" onClick="ccd_aprobacion()" width="140px" />
									</button>
									<div style="color:#293080; font-weight:bold; font-size:18px;">APROBACIÓN</div>
								</div>
							</div>
						</div>



						<div class="col-sm-3">
							<div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
								<div class="card-body">
									<button type="button" class="btn btn-light" style="margin:10px" onClick="panel()" title="Metas Corporativas">
										<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/dashboard.png' ?> title="Dashboard" onClick="metascorporativas()" width="140px" />
									</button>
									<div style="color:#293080; font-weight:bold; font-size:18px;">PANEL SOLICITUDES ABIERTAS</div>
								</div>
							</div>
						</div>



						<div class="col-sm-3">
							<div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
								<div class="card-body">
									<button type="button" class="btn btn-light" style="margin:10px" onClick="ccd_exepciones()" title="Excepciones">
										<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/nuevodoc.png' ?> title="Exepciones" onClick="ccd_exepciones()" width="140px" />
									</button>
									<div style="color:#293080; font-weight:bold; font-size:18px;">EXCEPCIONES</div>
								</div>
							</div>
						</div>



						<div class="col-sm-3">
							<div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
								<div class="card-body">
									<button type="button" class="btn btn-light" style="margin:10px" onClick="panelDocumentos()" title="Metas Corporativas">
										<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/dashboard.png' ?> title="Consulta" onClick="metascorporativas()" width="140px" />
									</button>
									<div style="color:#293080; font-weight:bold; font-size:18px;">PANEL DOCUMENTOS VIGENTES</div>
								</div>
							</div>
						</div>


						<!--
		<div class="col-sm-3">	
			<div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
				<div class="card-body">
					<button type="button" class="btn btn-light" style="margin:10px" onClick="monitorSolicitudes()" title="Monitor Solicitudes">
			<img class="borderedondo" src=<?php //echo constant('URL') . 'public/img/menu_ccd/dashboard.png'
											?>
			title="MonitorSolicitudes" onClick="" width="140px"/>
			    </button> 
		<div style="color:#293080; font-weight:bold; font-size:18px;">MONITOR SOLICITUDES</div>
        </div>
        </div> 
	    </div>
        
//
		
	   <div class="col-sm-3">	
       <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
       <div class="card-body">
       <button type="button" class="btn btn-light" style="margin:10px" onClick="DifuProcedimientos()" title="Difusión">
			<img class="borderedondo" src=<?php //echo constant('URL') . 'public/img/menu_ccd/dashboard.png'
											?>
			title="Difusión" onClick="" width="140px"/>
			    </button> 
		<div style="color:#293080; font-weight:bold; font-size:18px;">DIFUSIÓN DE DOCUMENTOS</div>
        </div>
        </div> 
	    </div>
       
//
		
	   <div class="col-sm-3">	
       <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
       <div class="card-body">
       <button type="button" class="btn btn-light" style="margin:10px" onClick="copiasControladas()" title="Copias">
			<img class="borderedondo" src=<?php //echo constant('URL') . 'public/img/menu_ccd/dashboard.png'
											?>
			title="Copias" onClick="" width="140px"/>
			    </button> 
		<div style="color:#293080; font-weight:bold; font-size:18px;">COPIAS CONTROLADAS</div>
        </div>
        </div> 
	    </div>
      

		
			
	   <div class="col-sm-3">	
       <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
       <div class="card-body">
       <button type="button" class="btn btn-light" style="margin:10px" onClick="actualizacionPuesto()" title="Copias">
			<img class="borderedondo" src=<? php // echo constant('URL') . 'public/img/menu_ccd/nuevodoc.png'
											?>
			title="Copias" onClick="" width="140px"/>
			    </button> 
		<div style="color:#293080; font-weight:bold; font-size:18px;">ACTUALIZAR PUESTOS</div>
        </div>
        </div> 
	    </div>
        
//
//
 
</div>



    
</div>
 
</div>
		-->
						<?php include("public/inc/jsfooter.php"); ?>

						</html>

						<script>
							

							function fact_phillips() {
								window.location = '<?php echo constant('URL') ?>onbase/reportePhillips/';
							}
						</script>