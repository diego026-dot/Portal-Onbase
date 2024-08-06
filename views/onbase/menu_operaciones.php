<?php include("public/inc/encabezado_sinbusqueda.php"); ?>
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


<!-- 
						<div class="col-sm-3 ">
							<div class="card text-dark  mb-3 shadow card-hover" style="max-width: 18rem; cursor:pointer;">
								<div class="card-body text-center p-5">
										<button type="button" class="btn btn-light" style="margin:10px" onClick="facturas_nac()" title="Solicitud Carga de Facturas">
									<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/orange_document.png'?>
									title="Solicitud Facturas Nacionales"  width="140px"/>
										</button>
									<div style="color:#293080; font-weight:bold; font-size:18px; margin-top:10px;">REPORTE PHILLIPS</div>
								</div>
							</div>
						</div> -->

						
						<div class="col-sm-3 ">
							<div class="card text-dark  mb-3 shadow card-hover" style="max-width: 18rem; cursor:pointer;">
								<div class="card-body text-center p-5">
									<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/orange_document.png'?>
									title="Solicitud Facturas Nacionales"  width="140px"/>
									<a href="javascript:void(0)" class="stretched-link" onClick="facturas_nac()"></a>

									<div style="color:#293080; font-weight:bold; font-size:18px; margin-top:10px;">REPORTE PHILLIPS</div>
								</div>
							</div>
						</div>


						<?php include("public/inc/jsfooter.php"); ?>

						</html>

						<script>
							
							function facturas_nac(){
								window.location='<?php echo constant('URL')?>onbase/facturas_nacionales/';
							     	}
							function fact_phillips() {
								window.location = '<?php echo constant('URL') ?>onbase/reporteClientes/';
							}
						</script>