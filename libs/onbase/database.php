<?php
class DatabaseOnBase {
    private $conexion;
    private $ejecuta;
    
    private $host;
    private $db;
    private $user;
    private $password;

    public function __construct() {
        $this->host = "SRVDEV\SRVDEV";
        $this->db = "PORTALONBASE";
        $this->user = "obdesarrollo2";
        $this->password = "onbase123";
    }

    public function connect() {
        $datasource = 'sqlsrv:server=' . $this->host . ';Database=' . $this->db;
        $opciones = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        try {
            $this->conexion = new PDO($datasource, $this->user, $this->password, $opciones);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function query($sql) {
        try {
            $this->ejecuta = $this->conexion->prepare($sql);
            return true;
        } catch (PDOException $e) { 
            return false;
        }
    }
    
    public function bindParam($parameter, $variable) {
        if ($this->ejecuta) {
            return $this->ejecuta->bindParam($parameter, $variable);
        }
        return false;
    }
    
    public function ejecutar() {
        try {
            return $this->ejecuta->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function obtener_registros() {
        $this->ejecutar();
        return $this->ejecuta->fetchAll(PDO::FETCH_OBJ);
    }

    public function obtener_registro() {
        $this->ejecutar();
        return $this->ejecuta->fetch(PDO::FETCH_OBJ);
    }

    public function numero_registros() {
        return $this->ejecuta->rowCount();
    }
}
?>
