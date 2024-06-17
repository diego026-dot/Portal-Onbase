	
	<form action="<?php echo constant('URL')?>onbase/documentosING" name="formulario_buscarING" 
				id="formulario_buscar" method="POST" enctype="multipart/form-data">
	<div class="header"  style="height:90px;">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
		
			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
			<div class="header-search">
					<!-- RADIO BUTTONS   -->
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="inlineRadioING1" id="inlineRadioING1" onclick="radioCheckedING1()" value="1" checked>
						<label class="form-check-label" for="inlineRadioing1">Comienza con:</label>
						&nbsp; &nbsp;
						<input class="form-check-input" type="radio" name="inlineRadioING2" id="inlineRadioING2" value="2" onclick="radioCheckedING2()">
						<label class="form-check-label" for="inlineRadioing2" >Contiene:</label>
					</div>
						<!-- FIN RADIO BUTTONS   -->	

					<div class="form-group mb-0">
						<i class="dw dw-search2 search-icon"></i>
						<input onchange="ocultarcampoing();" type="text" class="form-control search-input" name="busqueda" id="busqueda"
                        placeholder="Buscar un documento">
						<div class="dropdown">
							<a class="dropdown-toggle no-arrow btn-proyecto text-white" data-toggle="modal" data-target="#exampleModalING"
                  style="text-decoration:none;"
                            href="#" role="button" data-toggle="dropdown">
								<i class="icon-copy ion-funnel"></i>
							</a>

						</div>
					</div>
				
				
			</div>
		</div>
		<?php include("public/inc/menu_derecho.php");?>
		</div>
		
	 <!-- Modal -->
	 <div class="modal fade" id="exampleModalING" tabindex="-1" 
      role="dialog" aria-labelledby="exampleModalLabelING" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Filtro de búsqueda</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cerrar_modal();">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
			<div class="form-group row">
									<label name="lbclave" id="lbclave"  class="col-sm-12 col-md-2 col-form-label">Clave:</label>
									<div class="col-sm-12 col-md-10">
										<input onchange="ocultarcampoing();" class="form-control form-control-sm form-control-line" 
										name="clave" id="clave" type="text">
									</div>
								</div>
								<div class="form-group row">
									<label name="lbnombre" id="lbnombre" class="col-sm-12 col-md-2 col-form-label">Nombre:</label>
									<div class="col-sm-12 col-md-10">
										<input onchange="ocultarcampoing();" class="form-control form-control-sm form-control-line"
										name="nombre" id="nombre" type="text" >
									</div>
								</div>
								<div class="form-group row">
									<label name="lbclaverl" id="lbclaverl" class="col-sm-12 col-md-2 col-form-label">Clave Relacionada:</label>
									<div class="col-sm-12 col-md-10">
										<input onchange="ocultarcampoing();" class="form-control form-control-sm form-control-line" 
										name="claverl" id="claverl" type="text">
									</div>
								</div>
								<div class="form-group row">
                  <label name="inglbtipodoc" id="inglbtipodoc" class="col-sm-12 col-md-2 col-form-label">Tipo:</label>
                  <div class="col-sm-12 col-md-10">
                     <input onchange="ocultarcampoing();" autocomplete="off" class="form-control form-control-sm form-control-line" 
                        name="tipodocing" id="tipodocing" type="text">
                  </div>
               </div>
								
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cerrar_modal();">Cerrar</button>
               <button type="submit" class="btn btn-primary" >Buscar</button>
            </div>
         </div>
      </div>
   </div>
</form>
	
	<script>
function radioCheckedING2()
{
   radiobtn = document.getElementById("inlineRadioING1");
   radiobtn.checked = false;
}
function radioCheckedING1()
{
   radiobtn = document.getElementById("inlineRadioING2");
   radiobtn.checked = false;
}
		function ocultarcampoing()
		{

			var nombre=$("#nombre").val();
			var clave=$("#clave").val();
			var claverl=$("#claverl").val();
			var busqueda=$("#busqueda").val();
			var tipodoc=$("#tipodocing").val();


				if (nombre != "") {
					$("#clave").hide();
					$("#claverl").hide();
					$("#lbclave").hide();
					$("#lbclaverl").hide();
					$("#tipodocing").hide();
					$("#inglbtipodoc").hide();
				}
				else {
					$("#clave").show();
					$("#claverl").show();
					$("#lbclave").show();
					$("#lbclaverl").show();
					$("#tipodocing").show();
					$("#inglbtipodoc").show();
				

				if (clave != "") {
					$("#nombre").hide();
					$("#claverl").hide();
					$("#lbnombre").hide();
					$("#lbclaverl").hide();
					$("#tipodocing").hide();
					$("#inglbtipodoc").hide();
				}
				else {
					$("#nombre").show();
					$("#claverl").show();
					$("#lbnombre").show();
					$("#lbclaverl").show();
					$("#tipodocing").show();
					$("#inglbtipodoc").show();
				

				if (claverl != "") {
					$("#nombre").hide();
					$("#clave").hide();
					$("#lbnombre").hide();
					$("#lbclave").hide();
					$("#tipodocing").hide();
					$("#inglbtipodoc").hide();
				}
				else {
					$("#nombre").show();
					$("#clave").show();
					$("#lbnombre").show();
					$("#lbclave").show();
					$("#tipodocing").show();
					$("#inglbtipodoc").show();

					if (tipodoc != "") {
					$("#nombre").hide();
					$("#clave").hide();
					$("#claverl").hide();
					$("#lbclave").hide();
					$("#lbclaverl").hide();
					$("#lbnombre").hide();
				}
				else {
					$("#nombre").show();
					$("#clave").show();
					$("#claverl").show();
					$("#lbclave").show();
					$("#lbclaverl").show();
					$("#lbnombre").show();
				
				if (busqueda != "") {
					$("#nombre").hide();
					$("#clave").hide();
					$("#claverl").hide();
					$("#lbnombre").hide();
					$("#lbclave").hide();
					$("#lbclaverl").hide();
					$("#tipodocing").hide();
					$("#inglbtipodoc").hide();
				}
				else {
					$("#nombre").show();
					$("#clave").show();
					$("#claverl").show();
					$("#lbnombre").show();
					$("#lbclave").show();
					$("#lbclaverl").show();
					$("#tipodocing").show();
					$("#inglbtipodoc").show();
				}
				   }
				     }
				       }
					}


		}

	</script>