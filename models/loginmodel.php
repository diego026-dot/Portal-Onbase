<?php
// Importamos las clases
include_once 'models/login.php';

class LoginModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function consultaLogin($correo,$contrasena){
        $item = new ClaseLogin();
        try{
            $query = $this->db->connect()->prepare("
                SELECT u.*,e.nombre nombreempresa
                FROM usuarios u 
                inner join empresas e on e.id=u.idempresa
                where u.correo='".$correo."' and u.contrasena='".$contrasena."' and u.activo=1;
            ");
            $query->execute();
            while($row = $query->fetch()){
                $item->id = $row['id'];
                $item->idempresa = $row['idempresa'];
                $item->nombreempresa = $row['nombreempresa'];
                $item->idcliente = $row['idcliente'];
                $item->correo = $row['correo'];
                $item->nombre = $row['nombre'];
                $item->contrasena = $row['contrasena'];
                $item->telefono = $row['telefono'];
                $item->direccion = $row['direccion'];
                $item->registro = $row['registro'];
                $item->modificacion = $row['modificacion'];
                $item->activo = $row['activo'];
            }
            return $item;
        }catch(PDOException $e){
            return null;
        }
    }

    public function insertaAcceso($idusuario){
        try{
            $query = $this->db->connect()->prepare(
                'INSERT INTO accesos (idusuario) VALUES (:idusuario) ');
            $query->execute(['idusuario' => $idusuario]);
            return true;
        }catch(PDOEXception $e){
            return false;
        }  
    }

    public function insertaAccesoFallido($correo,$contrasena){
        try{
            $query = $this->db->connect()->prepare(
                'INSERT INTO accesos_fallidos (correo,contrasena) VALUES (:correo,:contrasena) ');
            $query->execute(['correo' => $correo,'contrasena' => $contrasena]);
            return true;
        }catch(PDOEXception $e){
            return false;
        }  
    }
}
?>