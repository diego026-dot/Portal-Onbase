<?php

require_once 'models/onbaseModel.php';


class Onbase extends Controller{
    
    public $model;

    function __construct(){
        parent::__construct();
        revisa_session();
      
        
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

    public function reportePhillips($parametros = null){
        

        $fechaInicio = $parametros[0];
        $fechaFin = $parametros[1];
        $clientes = $parametros[2];

        $this -> model = new OnbaseModel();

        $consultaIndicadores = $this->model -> consulta_Facturacion($fechaInicio, $fechaFin, $clientes);	
        

        $this -> view -> consultaIndicadores = $consultaIndicadores;
      


        $this->view->pagina = "onbase/ReportesFacturacion";
        $this->view->render('onbase/reclamosTiempos');

    }




}
?>


<script>
    
// BUSCADOR POR FILTRO TABLA DINAMICA 

 // Write on keyup event of keyword input element
 $(document).ready(function(){
 $("#search12").keyup(function(){
 _this = this;
 // Show only matching TR, hide rest of them
 $.each($("#tabla11 tbody tr"), function() {
 if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
 $(this).hide();
 else
 $(this).show();
 });
 });

 $("#search13").keyup(function(){
 _this = this;
 // Show only matching TR, hide rest of them
 $.each($("#tabla13 tbody tr"), function() {
 if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
 $(this).hide();
 else
 $(this).show();
 });
 });

 $("#search14").keyup(function(){
 _this = this;
 // Show only matching TR, hide rest of them
 $.each($("#tabla14 tbody tr"), function() {
 if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
 $(this).hide();
 else
 $(this).show();
 });
 });

 $("#search15").keyup(function(){
 _this = this;
 // Show only matching TR, hide rest of them
 $.each($("#tabla15 tbody tr"), function() {
 if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
 $(this).hide();
 else
 $(this).show();
 });
 });

 $("#search16").keyup(function(){
 _this = this;
 // Show only matching TR, hide rest of them
 $.each($("#tabla16 tbody tr"), function() {
 if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
 $(this).hide();
 else
 $(this).show();
 });
 });

 $("#searchProv").keyup(function(){
 _this = this;
 // Show only matching TR, hide rest of them
 $.each($("#tablaProvT tbody tr"), function() {
 if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
 $(this).hide();
 else
 $(this).show();
 });
 });


});
</script>