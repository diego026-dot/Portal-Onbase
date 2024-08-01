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
									<li class="breadcrumb-item active" aria-current="page">Obsoleto</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
						<button type="button" onclick="regresar();" class="btn btn-danger float-right">Regresar</button>
					
						</div>
					</div>
                   <!-- <iframe src="http://srvweb/AppNet/UnityForm.aspx?d1=AeCRirmMdQUscMZBkSr8shpWRs4%2fkJzYzTTGBf4jJ3%2fqfpNzu2yqMF%2fX1UyrfNgIk00pYwzisA0hx%2b5GdrevAcPmy3ABHQzNE7oDY6hqrCSRwc8R5x%2f%2bclFg1dcPW4jR52BKy5sGRvYIbZxnbnSmCYHG2sMGdnO5N%2b8aXa%2b0UDXa" width="100%" height="1000px" frameborder="0" scrolling="no"></iframe> -->
						<iframe src="<?php echo constant('URL')?>onbase/frame_facturasNacionales" width="100%" height="1000px" frameborder="0" scrolling="no"></iframe>
				
				</div>
                <?php echo mensaje(); ?>
			</div>
		</div>
		<?php// https://coflexbpm.coflex.com.mx/AppNet/docpop/docpop.aspx?clienttype=html&cqid=122?>
    </div>
<?php include("public/inc/jsfooter.php");?>


<script>
	function regresar(){
		window.location='<?php echo constant('URL')?>onbase/operaciones_menu/';
		}
</script>