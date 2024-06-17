<?php
class PedidosModel extends Model{

    public function __construct(){
        $this->dbPedidos=new DatabasePedidos();
        parent::__construct();
    }
    
    public function consultaModelos(){
        try{
            $this->dbPedidos->connect();
            $sql = "exec qryPedidos_Proceso_Modelos '','','','',''";
            $this->dbPedidos->query($sql);
            $resultados=$this->dbPedidos->obtener_registros();
            //foreach($resultados as $row){ //INICIO DEL FOR
            //    revisa_imagen("public/img/productos/".$row->nombre_foto,$row->foto); // REVISION DE FOTO
            //}
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }
    
}
?>