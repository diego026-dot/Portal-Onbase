<?php include("public/inc/encabezado.php");?>
<br><br><br>
<div class="error-page d-flex align-items-center flex-wrap justify-content-center pd-20">
		<div class="pd-10">
			<div class="error-page-wrap text-center">
				<h1>Ops!</h1>
				<h3>Error: 400</h3>
				<p><?php echo mensaje(); ?></p>
				<div class="pt-20 mx-auto max-width-200">
					<a href="<?php echo constant('URL')?>main" class="btn btn-primary btn-block btn-lg">Regresar</a>
				</div>
			</div>
		</div>
	</div>
<?php include("public/inc/jsfooter.php");?>
</html>