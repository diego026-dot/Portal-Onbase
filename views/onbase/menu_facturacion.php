<?php include("public/inc/encabezado_sinbusqueda.php"); ?>



<div class="container-fluid" style="margin-top: 0; padding-top: 0;">
	<div class="row">
		<div class="col-12 d-flex align-items-center justify-content-between">
			<nav aria-label="breadcrumb" role="navigation" class="bg-transparent">
				<ol class="breadcrumb mb-1 bg-transparent">
					<li class="breadcrumb-item">
						<img src="https://static.wixstatic.com/media/fe7c4c_794ee55525f8446ba0a6ba64d5afaeb6~mv2.png/v1/fill/w_120,h_48,al_c,lg_1,q_85,enc_auto/fe7c4c_794ee55525f8446ba0a6ba64d5afaeb6~mv2.png" alt="Icono" style="width: 40px; height: auto; margin-right: 10px;">
						<a href="#">Menu</a>
					</li>
					<li class="breadcrumb-item active" aria-current="page">Facturacion</li>
				</ol>
			</nav>
			<button type="button" onclick="regresar();" class="btn-base-regresar">Regresar</button>
		</div>
	</div>

	<div class="page-header mb-5">
		<section class="content" style="padding-top: 5px; padding-bottom: 5px;">

			<div class="row">


				<?php foreach ($_SESSION["UsuarioOpciones"] as $mod) { //INICIO DEL FOR 
				?>
					<?php if ($mod == 1) { ?>
						<div class="col-sm-3 ">
							<div class="card text-dark  mb-3 shadow card-hover" style="max-width: 18rem; cursor:pointer;">
								<div class="card-body text-center p-5">
									<img class="borderedondo" style="font-size:90px; color:#08043b " src=<?php echo constant('URL') . 'public/img/menu_ccd/orange_document.png' ?>

										<a href="javascript:void(0)" class="stretched-link" onClick="fact_phillips()"></a>

									<div style="color:#293080; font-weight:bold; font-size:18px; margin-top:10px;">REPORTE CLIENTES</div>
								</div>
							</div>
						</div>

					<?php } ?>





				<?php } //FIN DEL FOREACH
				?>

			</div>

	</div>

</div>

<?php include("public/inc/jsfooter.php"); ?>

</html>

<script>
	function fact_phillips() {
		window.location = '<?php echo constant('URL') ?>onbase/reporteClientes/';
	}


	function regresar() {
            window.location = '<?php echo constant('URL') ?>main';
    }

</script>