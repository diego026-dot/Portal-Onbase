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
									<li class="breadcrumb-item active" aria-current="page">Tipos</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right"></div>
                        <div class="card-body" style="background-color:#FFF"><!-- card -->
                        <!-- Nav pills -->
                        <?php foreach($this->consulta_validacion as $row){ //INICIO DEL FOR ?>
                <ul class="nav nav-pills">
                <?php if ($row->NULO!=1) { ?> 
                <li class="nav-item">
                    <a  class="nav-link active" data-toggle="pill" href="#navestrategicos"
                    >ESTRATÉGICOS</a> 
                   
                </li><?php } ?>
                <?php } //FIN DEL FOR?>

                <?php foreach($this->consulta_validacion2 as $row){ //INICIO DEL FOR ?>

                    <?php if ($row->NULO!=1) { ?> 
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#navoperativos">OPERATIVOS</a>
                </li>
                <?php } ?>
                <?php } //FIN DEL FOR?>

                <?php foreach($this->consulta_validacion3 as $row){ //INICIO DEL FOR ?>
                    <?php if ($row->NULO!=1) { ?> 
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#navapoyo">APOYO</a>
                </li>

                <?php } ?>
                <?php } //FIN DEL FOR?>
                </ul>

                
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane container active" id="navestrategicos">
                    
                        <!-- OPERATIVOS -->
                        <?php /*INICIO DE TABLA */?>

			    <table id="tabla1" class="table">
			        <thead>
						<tr>
			                <th width="10px">Procesos Activos</th>
							
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($this->consulta_proceso as $row){ //INICIO DEL FOR
                    ?>
                        <tr>
							<td><a
                        href="<?php echo constant('URL')?>/onbase/documentos/<?php echo $row->Proceso;?>" 
                        data-toggle="tooltip" data-target="">
                         <?php echo $row->Proceso;?></a></td>
					    </tr>
					<?php } //FIN DEL FOR?>
					</tbody>
				</table> 
                    
                </div>
                
                <div class="tab-pane container" id="navoperativos">
                    
                    <!-- OPERATIVOS -->
                    <?php /*INICIO DE TABLA */?>
            <table id="tabla1" class="table">
                <thead>
                    <tr>
                        <th width="10px">Procesos Activos</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach($this->consulta_proceso2 as $row){ //INICIO DEL FOR
                ?>
                    <tr>
                        <td><a
                        href="<?php echo constant('URL')?>/onbase/documentos/<?php echo $row->Proceso;?>" 
                        data-toggle="tooltip" data-target="">
                         <?php echo $row->Proceso;?></a></td>
                        
                    </tr>
                <?php } //FIN DEL FOR?>
                </tbody>
            </table> 
                
            </div>

            <div class="tab-pane container" id="navapoyo">
                    
                    <!-- OPERATIVOS -->
                    <?php /*INICIO DE TABLA */?>
            <table id="tabla1" class="table">
                <thead>
                    <tr>
                        <th width="10px">Procesos Activos</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach($this->consulta_proceso3 as $row){ //INICIO DEL FOR
                ?>
                    <tr>
                        <td><a
                        href="<?php echo constant('URL')?>/onbase/documentos/<?php echo $row->Proceso;?>" 
                        data-toggle="tooltip" data-target="">
                         <?php echo $row->Proceso;?></a></td>
                        
                    </tr>
                <?php } //FIN DEL FOR?>
                </tbody>
            </table> 
                
            </div>
                
					</div>
				</div>
                <?php echo mensaje(); ?>
			</div>
		</div>
    </div>
<?php include("public/inc/jsfooter.php");?>
</html>

<script>
function ccd_consulta(proceso){


    var PROC = proceso;
 //  $("#n_proceso").val(proceso);

	//window.location='<?php echo constant('URL')?>onbase/documentos/';


    //alert(window.location)
    //window.location='<?php echo constant('URL')?>onbase/documentos/'+$("#n_proceso").val();

    $.ajax({
        url:"http://192.168.1.191:81/coflex/onbase/documentos"+PROC,
      type:"POST",
      dataType: 'json',
      success:function(respuesta){
         window.location.href = "http://192.168.1.191:81/coflex/onbase/documentos";
       }
     });
    
      }

</script>