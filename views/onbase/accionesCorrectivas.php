<?php include("public/inc/encabezado_sinbusqueda.php");?>

   
<div class="main-container">
   <div class="pd-ltr-20 xs-pd-20-10">
      <div class="page-header mb-5">
         <div class="row">
            <div class="col-md-6 col-sm-12">
               <nav aria-label="breadcrumb" role="navigation">
                  <h4 class="modal-title">Consulta Acciones Correctivas Tiempos</h4>

               </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
            <button type="button" onclick="regresar();" class="btn btn-danger float-right">Regresar</button>				
            </div>
         </div>
      </div>
     
      <?php echo mensaje(); ?>
      <div class="card-box mb-5">
         <div class="pb-20 table-responsive">
         <button type="button" onclick="excel();" class="btn btn-success float-right">Excel</button>
         <table id="table" class="table table-hover multiple-select-row">
  
         
			        <thead>
						<tr>
							<th width="10px">Folio</th>
							<th width="20px">Estatus</th>
							<th width="1px">Paso</th>
							<th width="8px">Ciclos</th>
							<th width="5px">Fecha Inicio</th>	
							<th width="3px">Fecha Fin</th>   
                     <th width="8px">Días</th>
                     <th width="5px"></th>
                        </tr>
                    </thead>  
                    <tbody>
                    <?php foreach($this->accionesCorrectivas as $row){ //INICIO DEL FOR?>  
                     <td><?php echo $row->FOLIO;?></td>
                     <td><?php echo $row->ESTATUS;?></td>
                     <td><?php echo $row->PASO;?></td>
                     <td><?php echo $row->CICLOS;?></td>
                     <td><?php echo $row->FECHAINICIO;?></td>
                     <td><?php echo $row->FECHAFIN;?></td>
                     <td><?php echo $row->DIAS;?></td>
					    </tr>   
                   <?php } //FIN DEL FOR?>     
					</tbody>
				</table> 
         </div>
      </div>
   </div>
</div>

<?php include("public/inc/jsfooter.php");?>
</html>
<script>
 




function excel(){
                $("#table").table2excel ({
                formats: ["xlsx"], //Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
                position: 'bottom',  // Posicion que se muestran los botones puedes ser: (top, bottom)
                bootstrap: false,//Usar lo estilos de css de bootstrap para los botones (true, false)
                name: "acciones_correctivas",
                filename : 'acciones_correctivas'//Nombre del archivo 
            });
                }
  
</script>