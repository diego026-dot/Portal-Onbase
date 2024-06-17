
<?php $accion="modal_permiso_usuario";?>    
<form action="<?php echo constant('URL')?>onbase/modal_permiso_usuario"
method="POST" name="<?php echo $accion?>" id="<?php echo $accion?>">
    <div class="modal fade" id="AgregarPerm" name="AgregarPerm" tabindex="-1" data-backdrop="static" data-keyboard="false" 
    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Permisos</h5>   
                       <input type="hidden" class="form-control" id="f_iddd" name="f_iddd">
                    <button type="button" class="close" onclick="" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="permisosUsuario">
	                  <div class="form-group">
                    <div class="input-group-prepend">
                            				<span class="input-group-text" style="width:100px"><b>Usuario:</b></span>
                          				</div>
									    <input type="text" class="form-control" id="selectUsuario" name="selectUsuario" readonly>
									</div>  
                     <div class="form-group">
                     <div class="input-group-prepend">
                            				<span class="input-group-text" style="width:100px"><b>Módulo:</b></span>
                          				</div>
                     <select class="form-control" id="selectModulo" name="selectModulo">
                                          <option value="">Seleccione sección..</option>
											<?php foreach($this->consulta_modulo as $row){  ?>  
											<option value="<?php echo $row->IdModulo;?>"><?php echo $row->Descripcion;?></option>
											<?php }?>
											</select>    </div>  

                      <div class="form-group" id="formSubModAgrega" name="formSubModAgrega">
                     <div class="input-group-prepend">
                            				<span class="input-group-text" style="width:100px"><b>Sub. Módulo:</b></span>
                          				</div>
										  <div id="selectValoresSubmodulo"></div>	
								   </div>  
                      
                      <div class="form-group" id="formOpcionAgrega" name="formOpcionAgrega">
                    <div class="input-group-prepend">
                            				<span class="input-group-text" style="width:100px"><b>Opción:</b></span>
                          				</div>
									<div id="selectOpcionvalores"></div>							
							</div>  
                <div class="modal-footer">

					        	<button type="button" class="btn btn-primary btn-md" onclick="enviaDatos();">Agregar</button>																		
                    <button type="button" name="btn_cerrar" onclick="limpiar_modal();" id="btn_cerrar"class="btn btn-secondary" 
                    data-dismiss="modal">Cerrar</button>
                   
                </div>
            </div>
        </div>
    </div> 
</div>
</form>


            
               

               

               
        