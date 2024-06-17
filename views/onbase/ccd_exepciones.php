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
									<li class="breadcrumb-item active" aria-current="page">Solicitud Exepciones</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
						<button type="button" onclick="regresar();" class="btn btn-danger float-right">Regresar</button>
					
						</div>
					</div>
                   <!-- <iframe src="https://coflexbpm.coflex.com.mx/AppNet/UnityForm.aspx?d1=AdxfEnBeS8qjI6Ix0cvdzTR93hGMtVcKy%2fWf3827DSorbN%2b9CChAOSBl3tPPivhf3hWFnEfmr4ikCC8sMtNvua%2b3Yh5k6Lcg%2bXB%2fpJ493mxHJmbb2t4BwS9RaF34YJPz7TvPgR%2bx3T4bAI4ZeGdpa6mG4157X4cfJjtS7k%2fExMRqbBzjOolbZd8LVr54xl4BfSjPzYVQDYRgVLj1MuZokqWuuKb%2f4OZCo%2fckR7pHH0LZ" width="100%" height="1000px" frameborder="0" scrolling="no"></iframe> -->
						<iframe src="<?php echo constant('URL')?>onbase/frame_solicitud_exepciones" width="100%" height="2000px" frameborder="0" scrolling="no"></iframe>
				
				</div>
                <?php echo mensaje(); ?>
			</div>
		</div>
		<?php// https://coflexbpm.coflex.com.mx/AppNet/docpop/docpop.aspx?clienttype=html&cqid=122?>
    </div>
<?php include("public/inc/jsfooter.php");?>

<script>
	function regresar(){
		window.location='<?php echo constant('URL')?>onbase/menu_ccd/';
		}
</script>