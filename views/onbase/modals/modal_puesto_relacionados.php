
<?php $accion="modal_puesto_relacionados";?>    
<form action="<?php echo constant('URL')?>onbase/modal_visor_claverelacionada"
method="POST" name="<?php echo $accion?>" id="<?php echo $accion?>">
    <div class="modal fade" id="puestoRLmodal" name="puestoRLmodal" tabindex="-1" data-backdrop="static" data-keyboard="false" 
    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Puestos relacionados</h5>   
                       <input type="hidden" class="form-control" id="ssss" name="ssss">
                    <button type="button" class="close" onclick="" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div id="Valorespuestosrl"></div>	

               
                <div class="modal-footer">

					        															
                    <button type="button" name="btn_cerrarElimina" onclick="" id="btn_cerrarElimina"class="btn btn-secondary" 
                    data-dismiss="modal">Cerrar</button>
                   
                </div>
            </div>
        </div>
    </div> 
</div>
</form>


            
               

               

               
        