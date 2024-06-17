<?php include("public/inc/encabezado_sinbusqueda.php");?>
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
            <div class="page-header mb-5">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Detalle</a></li>
									<li class="breadcrumb-item active" aria-current="page">Reclamos</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right"></div>
					</div>
                    <section class="content" style="padding-top: 5px; padding-bottom: 5px;">
<div class="row">
<div class="col-md-12">
<div class="box box-primary"> 
<div class="box-body no-padding">
<div class="box-body table-responsive">

<table class="container-fluid">
	<tr style="border:hidden">
			<td align="center" width="33%" height="250px" style="background-color: white; border:hidden;">
				<button type="button" class="btn btn-light" style="margin:10px" onClick="consultaReclamos()" title="Consulta reclamos">
			<img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/ccd.png'?>
			title="Consulta reclamos" onClick="nueva_ncr()" width="140px"/>
			    </button>
			       <div style="color:#293080; font-weight:bold; font-size:18px;">CONSULTA RECLAMOS</div>
			</td>
	</tr>
    
   
</table>

</div>
</div>
</div>
</div>
</div>
</section><!-- /.content -->
				</div>
                <?php echo mensaje(); ?>
			</div>
		</div>
    </div>
<?php include("public/inc/jsfooter.php");?>
</html>

<script>
function consultaReclamos(){
	window.location='<?php echo constant('URL')?>onbase/reclamosTiempos/';
      }

      function accionesCorrectivas(){
	window.location='<?php echo constant('URL')?>onbase/accionesCorrectivas/';
      }
</script>