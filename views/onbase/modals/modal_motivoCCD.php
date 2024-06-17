
<?php $accion="modal_motivoCCD";?>
<form action="<?php echo RUTA_URL?>/onbase/<?php echo $accion?>"
method="POST" name="<?php echo $accion?>" id="<?php echo $accion?>">
    <div class="modal fade" id="modal_motivo" name="modal_motivo" tabindex="-1" data-backdrop="static" data-keyboard="false" 
    role="dialog" aria-labelledby="exampleModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel33">Comentario:</h5>   
                      
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="modal-content">
                <textarea class="form-control" rows="2" id="m_motivo" name="m_motivo" readonly></textarea>
</div>
                </div>           
                <div class="modal-footer" >
                    <button type="button" name="btn_cerrar1" id="btn_cerrar12"class="btn btn-secondary" 
                    data-dismiss="modal">Cerrar</button>
                   
                </div>
            </div>
        </div>
    </div>
</form>