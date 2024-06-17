<?php $accion="form_id_documento";?>
<!--<form action="<?php echo RUTA_URL?>/onbase/<?php echo $accion?>"method="POST" name="<?php echo $accion?>" id="<?php echo $accion?>">-->
   <div class="modal fade" id="visor_documento" tabindex="-1" data-backdrop="static" data-keyboard="false" 
      role="dialog" aria-labelledby="exampleModalLabel33" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel33">Visor de Documento</h5>
               <input type="hidden" class="form-control" id="f_id" name="f_id">
               <button type="button" class="close" onclick="limpiar_modal();" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body" id="modalVisor1" style="position: relative;width: 100%">
            
               <!--<div style ="width: 100%;background: #000;height: 60px;position: absolute;"> 
            </div>-->
               <iframe id="visordoc" width="100%" height="600" src=""></iframe>
            </div>
            <div class="modal-footer" >
               <button type="button" name="btn_cerrar" onclick="limpiar_modal();"
                  id="btn_cerrar1"class="btn btn-secondary" 
                  data-dismiss="modal">Cerrar</button>
            </div>
         </div>
      </div>
   </div>
<!--</form>-->





