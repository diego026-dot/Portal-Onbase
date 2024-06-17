
<?php $accion="modal_visor_documentosOBS";?>    
<form action="<?php echo constant('URL')?>onbase/modal_visor_documentosOBS"
method="POST" name="<?php echo $accion?>" id="<?php echo $accion?>">
    <div class="modal fade" id="documentosOBSing" name="documentosOBSing" tabindex="-1" data-backdrop="static" data-keyboard="false" 
    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Documentos Obsoletos</h5>   
                       <input type="hidden" class="form-control" id="sss" name="sss">
                    <button type="button" class="close" onclick="" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div id="ValoresdocumentosOBS"></div>	

               
                <div class="modal-footer">

					        															
                    <button type="button" name="btn_cerrarElimina" onclick="" id="btn_cerrarElimina"class="btn btn-secondary" 
                    data-dismiss="modal">Cerrar</button>
                   
                </div>
            </div>
        </div>
    </div> 
</div>
</form>


            
               

               

               
        