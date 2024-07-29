<?php

require_once 'models/onbaseModel.php';


class Onbase extends Controller{
    


    function __construct(){
        parent::__construct();
        revisa_session();
        $this->view->pagina = "";
        $this->model = new OnbaseModel();
    }
    function renderMain(){
        $this->view->render('main/index');
    }
    
    private function obtenerPermisosUsuario($usuarioID) {
        $permisos = $this->model->obtenerPermisosUsuario($usuarioID);
        $_SESSION['PERMISOS'] = $permisos;
    }

    public function administracionUser($parametros = null)
    {
        $this -> model = new OnbaseModel();
        $param1 = 1;
        
        $consultaIndicadores = $this->model -> consulta_indicadoresMain($param1);	
        

       $this -> view -> consultaIndicadores = $consultaIndicadores;
     
        $this->view->pagina = "onbase/administracion";
        $this->view->render('onbase/administracion');

    
    }


    public function facturacionReportes(){

        
        $this -> view -> consulta_opcionesASG = 0;

        $this->view->pagina = "onbase/menu_facturacion";
        $this->view->render('onbase/menu_facturacion');

    }

    public function reportePhillips(){

        $selectClientes = $this->model -> selectClientes();
        // print_r($selectClientes);
        $this -> view -> selectClientes = $selectClientes;
        $this->view->pagina = "onbase/reporteClientes";
        $this->view->render('onbase/reporteClientes');
    }

    public function cargaTabla_ReportePhilips($parametros = null){

        if($parametros == null){ $parametros = '0/0/0';} 
          $fechaInicio = $parametros[0];
          $fechaFin = $parametros[1];
          $clientes = $parametros[2];

        $consultaIndicadores = $this->model -> consulta_Facturacion($fechaInicio, $fechaFin, $clientes);?>
    
        <!--  BUSCADOR POR JQUERY    -->
          <input type="text"  class="form-control pull-right" style="width:20%" id="searchRepPhi" name="searchRepPhi" placeholder="Buscador...">

            <table id="tablaRepPhi" name="tablaRepPhi" class="table table-responsive">
            <thead class="text-blue">
                        <tr>
                        <th  width=15% style="text-align:left">Folio</th>
							<th  width=20% style="text-align:left">Referencia</th>
							<th  width=20% style="text-align:left">Fecha</th>
							<th  width=5% style="text-align:left">Pedimento</th>
							<th  width=15% style="text-align:left">Patente</th>	
                            <th  width=15% style="text-align:left">Aduana</th>	
                            <th  width=15% style="text-align:left">Cliente</th>	
                            <th  width=15% style="text-align:left">#Cliente</th>	
                            <th  width=15% style="text-align:left">Total</th>	
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($consultaIndicadores as $row) { //INICIO DEL FOR    
                        ?>
                            <tr>
                            <td><?php echo $row->FolioFiscal;?></td>
                            <td><?php echo $row->REFERENCIA;?></td>
                            <td><?php echo $row->FechaIngresada;?></td>
                            <td><?php echo $row->Pedimento;?></td>
                            <td><?php echo $row->Patente;?></td>
                            <td><?php echo $row->Aduana;?></td>
                            <td><?php echo $row->ClienteOP;?></td>
                            <td><?php echo $row->NumCliente;?></td>
                            <td><?php echo $row->Total;?></td>
                            </tr>
                        <?php } //FIN DEL FOR
                        ?>
                    </tbody></table> <?php       
    }











}
?>


<script>
    
// BUSCADOR POR FILTRO TABLA DINAMICA 

 // Write on keyup event of keyword input element
 $(document).ready(function(){
 $("#searchRepPhi").keyup(function(){
 _this = this;
 // Show only matching TR, hide rest of them
 $.each($("#tablaRepPhi tbody tr"), function() {
 if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
 $(this).hide();
 else
 $(this).show();
 });
 });



});
</script>