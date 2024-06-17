<form action="<?php echo constant('URL')?>onbase/documentos" name="formulario_buscar" 
   id="formulario_buscar" method="POST" enctype="multipart/form-data">
<div class="header" style="height:90px;">
   <div class="header-left">
      <div class="menu-icon dw dw-menu"></div> 
      <div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
      <div class="header-search">
		
			<!-- RADIO BUTTONS   -->
			<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="inlineRadio1" id="inlineRadio1" onclick="radioChecked1()" value="1" checked>
						<label class="form-check-label" for="inlineRadio1">Comienza con:</label>
						&nbsp; &nbsp;
						<input class="form-check-input" type="radio" name="inlineRadio2" id="inlineRadio2" value="2" onclick="radioChecked2()">
						<label class="form-check-label" for="inlineRadio2" >Contiene:</label>
					</div>
						<!-- FIN RADIO BUTTONS   -->	
         <div class="form-group mb-0">
            <i class="dw dw-search2 search-icon"></i>
            <input onchange="ocultarcampo();" type="text" class="form-control search-input" name="busqueda" id="busqueda"
               placeholder="Buscar un documento">
            <div class="dropdown">
               <a class="dropdown-toggle no-arrow btn-proyecto text-white" data-toggle="modal" data-target="#exampleModal"
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
</div>

   <!-- Modal -->
   <div class="modal fade" id="exampleModal" tabindex="-1" 
      role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
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
                  <label name="sgclbclave" id="sgclbclave"  class="col-sm-12 col-md-2 col-form-label">Clave:</label>
                  <div class="col-sm-12 col-md-10">
                     <input onchange="ocultarcampo();" class="form-control form-control-sm form-control-line" autocomplete="off" name="sgcclave" id="sgcclave" type="text" placeholder="Escriba clave...">
                  </div>
               </div>
               <div class="form-group row">
                  <label name="sgclbnombre" id="sgclbnombre"  class="col-sm-12 col-md-2 col-form-label">Nombre:</label>
                  <div class="col-sm-12 col-md-10">
                     <input onchange="ocultarcampo();" class="form-control form-control-sm form-control-line" autocomplete="off" name="sgcnombre" id="sgcnombre" type="text" placeholder="Escriba nombre...">
                  </div>
               </div>
               <div class="form-group row">
                  <label name="sgclbclaverl" id="sgclbclaverl" class="col-sm-12 col-md-2 col-form-label">Clave Relacionada:</label>
                  <div class="col-sm-12 col-md-10">
                     <input onchange="ocultarcampo();" autocomplete="off" class="form-control form-control-sm form-control-line" 
                        name="sgcclaverl" id="sgcclaverl" type="text" placeholder="Escriba clave relacionada...">
                  </div>
               </div>
               <div class="form-group row">
                  <label name="sgclbtipodoc" id="sgclbtipodoc" class="col-sm-12 col-md-2 col-form-label">Tipo:</label>
                  <div class="col-sm-12 col-md-10">
                     <input onchange="ocultarcampo();" autocomplete="off" class="form-control form-control-sm form-control-line" 
                        name="tipodoc" id="tipodoc" type="text" placeholder="Escriba tipo de documento...">
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

function radioChecked2()
{
   radiobtn = document.getElementById("inlineRadio1");
   radiobtn.checked = false;
}
function radioChecked1()
{
   radiobtn = document.getElementById("inlineRadio2");
   radiobtn.checked = false;
}

   function ocultarcampo()   
   {
   	var nombre=$("#sgcnombre").val();
   	var clave=$("#sgcclave").val();
   	var claverl=$("#sgcclaverl").val();
   	var busqueda=$("#busqueda").val();
      var tipodoc=$("#tipodoc").val();
   
   		if (nombre != "") {
   			$("#sgcclave").hide();
   			$("#sgcclaverl").hide();
   			$("#sgclbclave").hide();
   			$("#sgclbclaverl").hide();
            $("#tipodoc").hide();
            $("#sgclbtipodoc").hide();
   		}
   		else {
   			$("#sgcclave").show();
   			$("#sgcclaverl").show();
   			$("#sgclbclave").show();
   			$("#sgclbclaverl").show();
            $("#tipodoc").show();
            $("#sgclbtipodoc").show();
   
   		if (clave != "") {
   			$("#sgcnombre").hide();
   			$("#sgcclaverl").hide();
   			$("#sgclbnombre").hide();
   			$("#sgclbclaverl").hide();
            $("#tipodoc").hide();
            $("#sgclbtipodoc").hide();
   		}
   		else {
   			$("#sgcnombre").show();
   			$("#sgcclaverl").show();
   			$("#sgclbnombre").show();
   			$("#sgclbclaverl").show();
            $("#show").hide();
            $("#show").hide();
   		
   
   		if (claverl != "") {
   			$("#sgcnombre").hide();
   			$("#sgcclave").hide();
   			$("#sgclbnombre").hide();
   			$("#sgclbclave").hide();
            $("#tipodoc").hide();
            $("#sgclbtipodoc").hide();
   		}
   		else {
   			$("#sgcnombre").show();
   			$("#sgcclave").show();
   			$("#sgclbnombre").show();
   			$("#sgclbclave").show();
            $("#tipodoc").show();
            $("#sgclbtipodoc").show();
   		
         if (tipodoc != "") {
            $("#sgcnombre").hide();
   			$("#sgcclave").hide();
   			$("#sgcclaverl").hide();
   			$("#sgclbclave").hide();
            $("#sgclbnombre").hide();
   			$("#sgclbclaverl").hide();
   		}
   		else {
            $("#sgcnombre").show();
   			$("#sgcclave").show();
   			$("#sgcclaverl").show();
   			$("#sgclbclave").show();
   			$("#sgclbclaverl").show();
            $("#sgclbnombre").show();

   		if (busqueda != "") {
   			$("#sgcnombre").hide();
   			$("#sgcclave").hide();
   			$("#sgcclaverl").hide();
   			$("#sgclbnombre").hide();
   			$("#sgclbclave").hide();
   			$("#sgclbclaverl").hide();
            $("#tipodoc").hide();
            $("#sgclbtipodoc").hide();
   		}
   		else {
   			$("#sgcnombre").show();
   			$("#sgcclave").show();
   			$("#sgcclaverl").show();
   			$("#sgclbnombre").show();
   			$("#sgclbclave").show();
   			$("#sgclbclaverl").show();
            $("#tipodoc").show();
            $("#sgclbtipodoc").show();
   		}
   		   }
   		     }
   		       }
               }
   
   }
   
</script>