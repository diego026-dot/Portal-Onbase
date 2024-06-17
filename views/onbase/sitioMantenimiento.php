<?php include("public/inc/encabezado_sinbusqueda.php");?>
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
            
					<div class="row">
						
						<body style="background-image: url('<?php echo constant('IMG');?>fondos/mantenimiento.jpg'); background-repeat: no-repeat; 
background-attachment: fixed;  background-size: 100% 100%;">
					</div>
			
			</div>
		</div>
    </div>
<?php include("public/inc/jsfooter.php");?>
</html>

<script>

 $(document).ready(function() {
	regresa();
});

function regresa(){

	setTimeout(5000);

delay();
	window.history.go(-1);
window.history.back();
}
</script>