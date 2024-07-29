<?php

class OnbaseModel extends Model{
  
    public function __construct(){
        $this->dbOnBase=new DatabaseOnBase();
        parent::__construct();
    }
    
    //LOGIN
    public function login($clave, $pass){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_SAC_PM_ClienteGP] '" . $clave . "'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }


    public function consulta_indicadoresMain($param1){
        try{
            $this->dbOnBase->connect();
           
            $sql = "exec [dbo].[OB_WEB_IndicadoresMain2] '" . $param1 . "'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
         
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }

    public function consulta_Facturacion($fechaI, $fechaF, $clientes){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [dbo].[OB_WEB_ReporteClientes] '" . $clientes . "','" . $fechaI . "','" . $fechaF . "'";
            $this->dbOnBase->query($sql); 
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;

        }catch(PDOEXception $e){
            return [];
        }  
    }



    public function selectClientes(){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [PORTALONBASE].[dbo].[OB_WEB_SelectClientes] ";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            // print_r($resultados);
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }


    public function obtenerPermisosUsuario($usuario){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [dbo].[OB_WEB_ValidaPermisos] '" . $usuario . "'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }



    public function consulta_validacion_web($email){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Valida_Correo_Usuario] '" . $email . "'";
           // echo  $sql;
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            echo "Error TRY para mostrar".$e->getMessage();
            return [];
        }  
    }

    public function documentos($clave, $valor, $radiob){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_DocumentosVigentes_xVista] '2','" . $clave . "','" . $valor . "','" . $radiob . "'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }
    public function documentosING($clave, $valor, $radiob){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_DocumentosVigentes_xVista] '1','" . $clave . "','" . $valor . "','" . $radiob . "'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }
    public function descargaDocs($usuario){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Usuario_Permiso_DescargaDocumentos] '" . $usuario . "'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }

    public function PermisoVisualizarModal($usuario){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Usuario_Permiso_Visualizar_Modal] '" . $usuario . "'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }

    public function ingClaveRel($clave, $v){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Consulta_ClaveRelacionada] '" . $clave . "', '" . $v . "'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }

    public function ingDocumentosOBSajax($clave){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_DocumentosRevisionObsoleta] '" . $clave . "'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }
    public function sgcPuestoRelacionados($clave){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Consulta_PuestosRelacionados] '" . $clave . "','2'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }
    public function consulta_procesos($valor1){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_PermisosUsuario_Procesos] '" . $valor1 . "'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }
    public function consulta_procesos2($valor2){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_PermisosUsuario_Procesos] '" . $valor2 . "'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }
    public function KardexEmpleado($norma, $proceso){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_ConsultaDifusionEmpleado] '" . $norma . "', '". $proceso ."'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }
    public function KardexAreas($norma, $proceso){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_ConsultaDifusionArea] '" . $norma . "', '". $proceso ."'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }

    public function KardexDetalle($norma, $proceso){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_ConsultaDifusionEmpleadoDetalle] '" . $norma . "', '". $proceso ."'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }

    public function normas(){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Consulta_Normas] ";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }
    public function procesosDifusion(){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Consulta_Procesos] ";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }
    public function consulta_procesos3($valor3){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_PermisosUsuario_Procesos] '" . $valor3 . "'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }

    public function consulta_validacion($valor1){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Procesos_Validacion_Opciones] '" . $valor1 . "'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }
    public function consulta_validacion2($valor2){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Procesos_Validacion_Opciones] '" . $valor2 . "'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }
    public function consulta_validacion3($valor3){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Procesos_Validacion_Opciones] '" . $valor3 . "'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }

    public function consulta_opcionesASG($usuario){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Valida_Permiso_Opciones] '" . $usuario . "','2'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }

    public function consulta_SolicitudesAbiertas($datoob, $tipo){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_ConsultaSolicitudes] '" . $datoob . "','" . $tipo . "'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }
    public function consulta_opcionesING($usuario){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Valida_Permiso_Opciones] '" . $usuario . "','1'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }
    public function acciones_correctivas(){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_ASG_AccionesCorrectivasTiempos] ";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }
    public function reclamos_tiempos($fechaI, $fechaF){
        try{
            $this->dbOnBase->connect();
           
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_SAC_ReclamosTiempos] '" . $fechaI . "','" . $fechaF . "'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }

    public function altaprov_tiempos($fechaI, $fechaF){
        try{
            $this->dbOnBase->connect();
           
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CMP_AltaProveedor_Tiempos] '" . $fechaI . "','" . $fechaF . "'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
        
    }

    public function pedimentos_tiempos($fechaI, $fechaF){
        try{
            $this->dbOnBase->connect();
           
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CXP_PedimentosTiempos] '" . $fechaI . "','" . $fechaF . "'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }

    public function consulta_catalogo($v, $m, $s){ 
        try{    
            if($s == null) { $s = '';}
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CDD_WEB_Catalogo_UsuarioModuloOpciones] '" . $v . "', '" . $m . "', '" . $s . "'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros(); 
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }

    public function agregar_permiso($usuario, $seccion, $sub ,$opcion ){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Agregar_PermisosUsuario] '" . $usuario . "','" . $seccion . "','" . $sub . "','" . $opcion . "'";
            //VAR_DUMP($sql);
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registro();
            
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }

    public function insertaUsuarioControl($usuario, $estatus, $mod ){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Inserta_Usuario_Inactivo] '" . $usuario . "','" . $estatus . "','" . $mod . "'";
            //VAR_DUMP($sql);
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registro();
            
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }
 
    public function consultaUsuarioCMP(){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_ConsultaUsuarioCMP] ";
            //VAR_DUMP($sql);
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }

    public function elimina_permiso($usuario, $seccion, $sub ,$opcion, $tipo){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Elimina_PermisosUsuario] '" . $usuario . "','" . $seccion . "','" . $sub . "','" . $opcion . "','" . $tipo . "'";
            //VAR_DUMP($sql);
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registro();
            
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }

    public function consulta_Permisos($usuario){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Consulta_PermisosUsuario] '" . $usuario . "'";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }

    public function consulta_usuarios_PU(){
        try{
            $this->dbOnBase->connect();
            $sql = "exec [OBINTEGRATIONS].[dbo].[SP_OB_CCD_WEB_Consulta_UsuariosPU] ";
            $this->dbOnBase->query($sql);
            $resultados=$this->dbOnBase->obtener_registros();
            return $resultados;
        }catch(PDOEXception $e){
            return [];
        }  
    }

    public function insertaXML($xmlString)
    {
        try {
        $this->dbOnBase->connect();
    
            $sql = "EXEC [OBINTEGRATIONS].[dbo].[SP_OB_CMP_WEB_INSERTA_ARTICULO_VENDOR] '" . $xmlString . "'";
//echo $sql;

            $this->dbOnBase->query($sql);
    
            $resultados = $this->dbOnBase->obtener_registros();
    
            return $resultados;
        } catch (PDOException $e) {
            //return ["error modelo"];
            echo $e;
        }
    }


    public function obtener_archivos(){
        try{
            // Ruta del directorio donde están los archivos
            $fileName = "";
            $fileExtension = "";
            // Ruta del directorio donde están los archivos
            $path  = '//192.168.1.191/coflex/public/pdf_docs/'; 
            // Arreglo con todos los nombres de los archivos
            $files = array_diff(scandir($path), array('.', '..')); 
            //print_r($files);
       return $files;
    }catch(PDOEXception $e){
       // echo $rutaArchivo;
        return [];
    }  


    
}    
}
?>