<?php include("public/inc/encabezado_sinbusqueda.php"); ?>

<style>
	.clickable-card {
		cursor: pointer;
		transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out, background-color 0.3s ease-in-out;
	}

	.clickable-card:hover {
		background-color: #f0f0f0;
		box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
	}
</style>

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



	<div class=" row d-flex justify-content-center gap-4 " style="margin-top: 80px;">

		<?php foreach ($_SESSION["UsuarioOpciones"] as $mod) { //INICIO DEL FOR 
		?>
			<?php if ($mod == 1) { ?>
				<div class="col-2 mb-3 shadow clickable-card "
					onClick="fact_phillips()">
					<div class=" text-center p-4">
						<i class="bi bi-file-earmark-person-fill fs-1"></i>
						<p style="color:#293080; font-weight:bold; font-size:18px; margin-top:30px;">
							Reporte Clientes
						</p>
					</div>
				</div>
			<?php } ?>

		<?php } //FIN DEL FOREACH
		?>

		<?php foreach ($_SESSION["UsuarioOpciones"] as $mod) { //INICIO DEL FOR 
		?>
			<?php if ($mod == 1002) { ?>

				<div class="col-2 mb-3 shadow clickable-card "
					onClick="fact_onbase()">
					<div class=" text-center p-4">
						<i class="bi bi-globe fs-1"></i>
						<p style="color:#293080; font-weight:bold; font-size:18px; margin-top:30px;">
							Reporte OnBase
						</p>
					</div>
				</div>

			<?php } ?>

		<?php } //FIN DEL FOREACH
		?>

		<?php foreach ($_SESSION["UsuarioOpciones"] as $mod) { //INICIO DEL FOR 
		?>
			<?php if ($mod == 1002) { ?>

				<div class="col-2 mb-3 shadow clickable-card "
					onClick="fact_cheklist()">
					<div class=" text-center p-4">
					<i class="bi bi-journal-check fs-1"></i>
						<p style="color:#293080; font-weight:bold; font-size:18px; margin-top:30px;">
							Reporte Checklist
						</p>
					</div>
				</div>

			<?php } ?>

		<?php } //FIN DEL FOREACH
		?>





	</div>

</div>

<?php include("public/inc/jsfooter.php"); ?>

</html>

<script>
	function fact_phillips() {
		window.location = '<?php echo constant('URL') ?>onbase/reporteClientes/';
	}

	function fact_onbase() {
		window.location = '<?php echo constant('URL') ?>onbase/reporteOnbase/';
	}

	function fact_cheklist() {
		window.location = '<?php echo constant('URL') ?>pages/reporteChecklistView/';
	}


	function regresar() {
		window.location = '<?php echo constant('URL') ?>main';

	}
</script>