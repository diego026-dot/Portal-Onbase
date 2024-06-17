<?php
// Importamos las clases
include_once 'models/recupera.php';

class RecuperaModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function consultaRecupera($correo){
        try{
            $item = new ClaseRecupera();
            $query = $this->db->connect()->prepare(" 
                SELECT u.*,p.nombre nombreperfil,e.nombre nombreempresa,IFNULL(c.nombre,'') nombrecliente
                FROM usuarios u 
                inner join perfiles p on p.id=u.idperfil
                inner join empresas e on e.id=u.idempresa
                left join clientes c on c.id=u.idcliente
                where u.correo='".$correo."' and u.activo=1;
            ");
            $query->execute();
            while($row = $query->fetch()){
                $item->id = $row['id'];
                $item->idempresa = $row['idempresa'];
                $item->nombreempresa = $row['nombreempresa'];
                $item->idcliente = $row['idcliente'];
                $item->nombrecliente = $row['nombrecliente'];
                $item->idperfil = $row['idperfil'];
                $item->nombreperfil = $row['nombreperfil'];
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

    public function insertaRecupera($idusuario){
        try{
            $query = $this->db->connect()->prepare(
                'INSERT INTO recupera (idusuario) VALUES (:idusuario) ');
            $query->execute(['idusuario' => $idusuario]);
            return true;
        }catch(PDOEXception $e){
            return false;
        }  
    }

    public function insertaRecuperaFallido($correo){
        try{
            $query = $this->db->connect()->prepare(
                'INSERT INTO recupera_fallidos (correo) VALUES (:correo) ');
            $query->execute(['correo' => $correo]);
            return true;
        }catch(PDOEXception $e){
            return false;
        }  
    }

}
?>