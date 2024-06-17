			<div class="footer-wrap pd-20 mb-20 card-box">
			<?php echo constant('FOOTER');?>
			</div>

			<script>

$("tableaa").tableExport({
	formats: ["xlsx"], //Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
	position: 'bottom',  // Posicion que se muestran los botones puedes ser: (top, bottom)
	bootstrap: false,//Usar lo estilos de css de bootstrap para los botones (true, false)
	fileName: "VentasMX",    //Nombre del archivo 
});
	function excel() {	$("#boton_excel").click();}
			</script>