	<!-- js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.7/pdfobject.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
	<script src="https://cdn.sheetjs.com/xlsx-0.20.3/package/dist/xlsx.full.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
	<script src="<?php echo constant('URL');?>public/vendors/scripts/core.js"></script>
	<script src="<?php echo constant('URL');?>public/vendors/scripts/script.min.js"></script>
	<script src="<?php echo constant('URL');?>public/vendors/scripts/process.js"></script>
	<script src="<?php echo constant('URL');?>public/vendors/scripts/layout-settings.js"></script>
	<script src="<?php echo constant('URL');?>public/src/plugins/jquery-steps/jquery.steps.js"></script>
	<script src="<?php echo constant('URL');?>public/vendors/scripts/steps-setting.js"></script>
	<script src="<?php echo constant('URL');?>public/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo constant('URL');?>public/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?php echo constant('URL');?>public/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="<?php echo constant('URL');?>public/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<!-- buttons for Export datatable -->
	<script src="<?php echo constant('URL');?>public/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="<?php echo constant('URL');?>public/src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="<?php echo constant('URL');?>public/src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="<?php echo constant('URL');?>public/src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="<?php echo constant('URL');?>public/src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="<?php echo constant('URL');?>public/src/plugins/datatables/js/pdfmake.min.js"></script>
	<script src="<?php echo constant('URL');?>public/src/plugins/datatables/js/vfs_fonts.js"></script>
	<!-- Datatable Setting js -->
	<script src="<?php echo constant('URL');?>public/vendors/scripts/datatable-setting.js"></script>
	<!-- fancybox Popup Js -->
	<script src="<?php echo constant('URL');?>public/src/plugins/fancybox/dist/jquery.fancybox.js"></script>
	<!-- Slick Slider js -->
	<script src="<?php echo constant('URL');?>public/src/plugins/slick/slick.min.js"></script>
	<!-- bootstrap-touchspin js -->
	<script src="<?php echo constant('URL');?>public/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
	<script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
	<script src= "https://cdn.jsdelivr.net/npm/chart.js@4.5.0/dist/chart.umd.min.js" ></script>

</body>
<script>
	function bloqueoF5(){
		var tecla=window.event.keyCode;
		//if (tecla==116) { event.keyCode=0;event.returnValue=false;	} // bloqueo F5
	}

	$(document).ready(function() {
		$("#btn-buscar").click(function() {
			$("form#formulario_buscar").submit(function() {
				$('#btn-buscar').attr("disabled", true);
				return true;
			});
		});
	});
</script>
