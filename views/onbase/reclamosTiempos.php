<?php include("public/inc/encabezado_sinbusqueda.php"); ?>


<div class="main-container">
   <div class="pd-ltr-20 xs-pd-20-10">
      <div class="page-header mb-5">
         <div class="row">
            <div class="col-12">
               <nav aria-label="breadcrumb" role="navigation">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="#">Facturacion</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Reportes</li>
                  </ol>
               </nav>
            </div>
         </div>
         <div class="row mt-5 justify-content-center ">
            <div class="col-2">
               <label for="calendarioI"> Fecha inicio</label>
               <input type="date" id="calendarioI" name="calendarioI" step="1" min="2019-01-01" max="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>">
            </div>
            <div class="col-2">
               <label for="calendarioF"> Fecha fin</label>
               <input type="date" id="calendarioF" name="calendarioF" step="1" min="2019-01-01" max="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>">
            </div>
            <div class="col-2 d-flex align-items-center">
               <button type="button" class="btn btn-primary btn-sm mr-4" onclick="enviaDatos();">Buscar</button>
               <button type="button" onclick="excel();" class="btn btn-success float-right btn-sm">Excel</button>
            </div>
            <!-- <div class="col-1">
               <button type="button" onclick="excel();" class="btn btn-success float-right btn-sm">Excel</button>
            </div> -->
            <div class="col-3 ">
               <label for="clientes">Clientes</label>
               <select  name="clientes" id="clientes" required >
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
               </select>

            </div>

            <div class="col-1">
               <button type="button" onclick="regresar();" class="btn btn-danger float-right">Regresar</button>
            </div>

         </div>
         <?php //echo mensaje(); 
         ?>
         <!-- <div class="card-box mb-5">
            <div class="pb-20 table-responsive">
                <div id="ValoresTiempoReclamos"></div>
            </div> -->

         <div class="min-height-200px mt-3">
            <div class="page-header mb-5">
               <div class="table-responsive">
                  <table id="tabla20" class="table table-hover multiple-select-row">
                     <thead style="background-color: #08043b; color: white;">
                        <tr>
                           <th scope="col">FolioFiscal</th>
                           <th scope="col">Referencia</th>
                           <th scope="col">Pedimiento</th>
                           <th scope="col">Patente</th>
                           <th scope="col">Aduana</th>
                           <th scope="col">Cliente</th>
                           <th scope="col">Total</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <!-- <td>
                           <button type="button" class="btn-sm btn btn-link" onclick="modal_usuario('<?php echo rtrim(ltrim($row->Usuario)); ?>','<?php echo rtrim(ltrim($row->Usuario)); ?>');" data-toggle="modal" data-target="#AgregarPerm">
                              <?php echo $row->Usuario; ?>
                           </button>
                        </td>
                        <td><?php echo $row->Modulo; ?></td>
                        <td><?php echo $row->Opcion; ?></td> -->

                        </tr>
                        <?php foreach ($this->consultaIndicadores as $row) : ?>
                           <tr>
                              <td><?php echo $row->U_referencia; ?></td>
                              <td><?php echo $row->U_pedimento; ?></td>
                              <td><?php echo $row->U_patente; ?></td>
                              <td><?php echo $row->U_aduana; ?></td>
                              <td><?php echo $row->NumClienteOperativo; ?></td>
                              <td><?php echo $row->NumClienteAdministrativo; ?></td>
                              <td><?php echo $row->MetodoDePago; ?></td>
                           </tr>
                        <?php endforeach; ?>
                     </tbody>
                  </table>
               </div>

            </div>
            <div class="col">
               <div class="form-group">
                  <div class="input-group mb-3">
                     <div class="input-group-prepend">
                        <span class="input-group-text" style="width:100px"><b></b></span>
                     </div>
                  </div>
               </div>
               <br>
            </div>
            <?php echo mensaje(); ?>
         </div>
      </div>
      <br>


      <?php include("public/inc/jsfooter.php"); ?>

      </html>
      <script>
         function excel() {
            $("#tabla20").table2excel({
               formats: ["xlsx"], //Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
               position: 'bottom', // Posicion que se muestran los botones puedes ser: (top, bottom)
               bootstrap: false, //Usar lo estilos de css de bootstrap para los botones (true, false)
               name: "reclamos_tiempos",
               filename: 'reclamos_tiempos' //Nombre del archivo 
            });
         }

         
        

         function enviaDatos() {

            var fechaI = $("#calendarioI").val();
            var fechaF = $("#calendarioF").val();
            var cliente = $("#clientes").val();
            var resultI = fechaI.replaceAll("-", "@");
            var resultF = fechaF.replaceAll("-", "@");


            alert(resultI);

            var direccion = "http://127.0.0.1:80/ravisa/onbase/reportePhillips";

            var url = direccion + "/" + $.trim(resultI) + "/" + $.trim(resultF) + "/" + $.trim(cliente);
            alert(url);
            $.ajax({
               type: "POST",
               url: url,
               beforeSend: function() {},
               success: function(data) {
                  //alert(url);
                  location.reload();

               }
            });
         }


         function enviaDatosKardexDetalle(norma, proceso) {
            var fechaI = $("#calendarioI").val();
            var fechaF = $("#calendarioF").val();
            var resultI = fechaI.replaceAll("-", "@");
            var resultF = fechaF.replaceAll("-", "@");


            var direccion = "http://192.168.1.191:81/coflex/onbase/cargaTabla_ReclamosTiempos";

            var url = direccion + "/" + $.trim(resultI) + "/" + $.trim(resultF);


            $.ajax({
               type: "POST",
               url: url,
               beforeSend: function() {},
               success: function(data) {
                  $("#ValoresTiempoReclamos").html(data);
                  // $("#divImg3").css("display", "none");
               }
            });
         }
      </script>