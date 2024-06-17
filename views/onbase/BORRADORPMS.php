<?php include("public/inc/encabezado_sinbusqueda.php"); ?>
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
					<?php echo mensaje(); ?>
				</div>
			</div>


<!--  CAROUSEL   -->
			<div class="fluid-container w-100">
			<div id="carouselExampleSlidesOnly" class="carousel slide w-100 p-3" data-ride="carousel" data-interval="5000">

				<div class="carousel-inner ">
					<div class="carousel-item active">

						<a href=<?php echo constant('URL') . 'public/img/fondos/mantenimiento.jpg' ?>>
							<img src=<?php echo constant('URL') . 'public/img/fondos/mantenimiento.jpg' ?> class="img-fluid w-100 d-block" />
						</a>
					</div>
					<div class="carousel-item ">

						<a href="https://www.coflex.com.mx/es_MX/areas/view/13/sort:name/direction:asc">
							<img src=<?php echo constant('URL') . 'public/img/fondos/mantenimiento.jpg' ?> class="img-fluid w-100 d-block" />
						</a>
					</div>
					<div class="carousel-item ">

						<a href="https://www.coflex.com.mx/es_MX/products/index/area_id:14/zone_id:100">
							<img src=<?php echo constant('URL') . 'public/img/fondos/mantenimiento.jpg' ?> class="img-fluid w-100 d-block" />
						</a>
					</div>
					<div class="carousel-item ">

						<a href="https://www.coflex.com.mx/es_MX/areas/view/22">
							<img src=<?php echo constant('URL') . 'public/img/fondos/mantenimiento.jpg' ?> class="img-fluid w-100 d-block" />
						</a>
					</div>
					<div class="carousel-item ">

						<a href="https://www.coflex.com.mx/es_MX/products/index/area_id:9/zone_id:79">
							<img src=<?php echo constant('URL') . 'public/img/fondos/mantenimiento.jpg' ?> class="img-fluid w-100 d-block" />
						</a>
					</div>
					<div class="carousel-item ">

						<a href="https://www.coflex.com.mx/es_MX/products/index/area_id:15/zone_id:123">
							<img src=<?php echo constant('URL') . 'public/img/fondos/mantenimiento.jpg' ?> class="img-fluid w-100 d-block" />
						</a>
					</div>
					<div class="carousel-item ">

						<a href="https://www.coflex.com.mx/es_MX/areas/view/20">
							<img src=<?php echo constant('URL') . 'public/img/fondos/mantenimiento.jpg' ?> class="img-fluid w-100 d-block" />
						</a>
					</div>

					<a class="carousel-control-prev" href="#carouselExampleSlidesOnly" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleSlidesOnly" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
			</div>
	</div>
</div>
                 <!--  FIN CAROUSEL   -->




</div>






<?php include("public/inc/jsfooter.php"); ?>

</html>

<script>
	function regresar() {
		window.location = '<?php echo constant('URL') ?>onbase/menu_ccd/';
	}
</script>