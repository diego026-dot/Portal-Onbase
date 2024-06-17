<?php include("public/inc/encabezado.php");?>
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
            <div class="page-header mb-20">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Pedidos</a></li>
									<li class="breadcrumb-item active" aria-current="page">Nuevo</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right"></div>
					</div>
				</div>
                <?php echo mensaje(); ?>
                    <div class="product-wrap">
                        <div class="product-list">
                            <ul class="row">
                            <?php 
                                foreach($this->modelos as $row){ //INICIO DEL FOR
								?>
                                <li class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="product-box">
                                        <div class="producct-img">
                                            <a onClick="evento(<?php echo $row->multiplo?>,<?php echo $row->id?>)";>
                                                <img src="<?php echo existe_img("public/img/productos/".$row->nombre_foto);?>" 
                                                alt="<?php echo modelo($row->modelo);?>">
                                            </a>
                                            <?php echo etiqueta_nuevo_promocion($row->nuevo,$row->promocion);?>
                                            <?php //echo etiqueta_piezas_pedido($row->pedido_temporal);?>
                                            <?php //echo etiqueta_informacion(constant('URL') . 'producto/detalleProducto/' . $item->id);?>
                                        </div>
                                        <div class="product-caption">
                                            <div><h5 class="text-proyecto"><?php echo modelo($row->modelo);?></h5></div>    
                                            <?php /*<div id="<?php echo $row->id;?>"></div>*/ ?>
                                            <div><?php echo $row->descripcion;?><div>
                                            <div><b>$<?php echo $row->precio?></b></div> <?php /*
                                            <div class="float-right mb-10">
                                                <a href="<?php echo constant('URL') . 'producto/detalleProducto/' . $item->id; ?>"
                                                class="btn btn-xs btn-outline-proyecto">
                                                    <i class="icon-copy fa fa-info-circle" aria-hidden="true"></i>
                                                </a>
                                            </div>*/?>
                                        </div>
                                    </div>
                                </li>
                            <?php } //FIN DEL FOR?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
			<?php include("public/inc/footer.php");?>
		</div>
    </div>
<?php include("public/inc/jsfooter.php");?>
</html>
