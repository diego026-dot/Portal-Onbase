
<?php $accion="modal_permiso_usuarioElimina";?>    
<form action="<?php echo constant('URL')?>onbase/modal_permiso_usuarioElimina"
method="POST" name="<?php echo $accion?>" id="<?php echo $accion?>">
    <div class="modal fade" id="EliminarPerm" name="EliminarPerm" tabindex="-1" data-backdrop="static" data-keyboard="false" 
    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Permisos</h5>   
                       <input type="hidden" class="form-control" id="f_Elimina" name="f_Elimina">
                    <button type="button" class="close" onclick="" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="permisosUsuarioElimina">
	                  <div class="form-group">
                    <div class="input-group-prepend">
                            				<span class="input-group-text" style="width:100px"><b>Usuario:</b></span>
                          				</div>
									    <input type="text" class="form-control" id="selectUsuarioElimina" name="selectUsuarioElimina" readonly required>
									</div>  
                                    <div class="form-group">
                     <div class="input-group-prepend">
                            				<span class="input-group-text" style="width:100px"><b>Selccione el tipo de permiso a eliminar:</b></span>
                          				</div>
                     <select class="form-control" id="selectTipo" name="selectTipo">
                                            <option value="0"selected>Seleccione sección..</option>
											<option value="MODULO">Módulo</option>
                                            <option value="SUBMODULO">Sub. Módulo</option>
                                            <option value="OPCION">Opción</option>
											</select>    </div>  
                     <div class="form-group" id="formMod" name="formMod">
                     <div class="input-group-prepend">
                            				<span class="input-group-text" style="width:100px"><b>Módulo:</b></span>
                          				</div>
                     <select class="form-control" id="selectModuloElimina" name="selectModuloElimina">
											<?php foreach($this->consulta_modulo as $row){  ?>
											<option value="<?php echo $row->IdModulo;?>"><?php echo $row->Descripcion;?></option>
											<?php }?>
											</select>    </div>  

                      <div class="form-group" id="divformSubmod" name="divformSubmod">
                     <div class="input-group-prepend">
                            				<span class="input-group-text" style="width:100px"><b>Sub. Módulo:</b></span>
                          				</div>
										  <div id="selectValoresSubmoduloElimina"></div>	
								   </div>  
                      
                      <div class="form-group" id="divformOpcion" name="divformOpcion">
                    <div class="input-group-prepend">
                            				<span class="input-group-text" style="width:100px"><b>Opción:</b></span>
                          				</div>
									<div id="selectOpcionvaloresElimina"></div>							
							</div>  
                <div class="modal-footer">

					        	<button type="button" class="btn btn-danger btn-md" onclick="enviaDatosEliminaPermisos();">Enviar </button>																		
                    <button type="button" name="btn_cerrarElimina" onclick="limpiar_modal();" id="btn_cerrarElimina"class="btn btn-secondary" 
                    data-dismiss="modal">Cerrar</button>
                   
                </div>
            </div>
        </div>
    </div> 
</div>
</form>


            
               

               

               
        