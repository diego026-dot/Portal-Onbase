<?php include("public/inc/encabezado_sinbusqueda.php");?>
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
            <div class="page-header mb-5">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Procesos</a></li>
									<li class="breadcrumb-item active" aria-current="page">Modificación</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">	
							<button type="button" onclick="regresar();" class="btn btn-danger float-right">Regresar</button>
					</div>
					</div>
					<iframe src="<?php echo constant('URL')?>onbase/frame_ccd_modificacion" width="100%" height="2000px" frameborder="0" scrolling="no"></iframe>
					</div>
                <?php echo mensaje(); ?>
			</div>
		</div>
    </div>
<?php include("public/inc/jsfooter.php");?>
</html>

<script>
	function regresar(){
		window.location='<?php echo constant('URL')?>onbase/menu_ccd/';
		}
</script>