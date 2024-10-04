<?php
class DatabaseOnBase {
    private $conexion;
    private $ejecuta;
    
    private $host;
    private $db;
    private $user;
    private $password;

    public function __construct() {
        $this->host = "172.20.20.71\SRVSQLONBASE";
        $this->db = "PORTALONBASE";
        $this->user = "hsi";
        $this->password = "wstinol";
    }

    // M�todo para conectarse a la base de datos
    public function connect() {
        $datasource = 'sqlsrv:server=' . $this->host . ';Database=' . $this->db;
        $opciones = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        try {
            $this->conexion = new PDO($datasource, $this->user, $this->password, $opciones);
            return true;
        } catch (PDOException $e) {
            // En caso de error, puedes registrar o devolver m�s detalles
            return false;
        }
    }

    // M�todo para preparar la consulta (devuelve PDOStatement)
    public function prepare($sql) {
        try {
            $this->ejecuta = $this->conexion->prepare($sql);  // Prepara la consulta y la guarda en $ejecuta
            return $this->ejecuta;  // Devuelve el objeto PDOStatement para ejecutarlo en el script
        } catch (PDOException $e) { 
            return false;
        }
    }

    // M�todo para ejecutar la consulta ya preparada
    public function ejecutar() {
        try {
            return $this->ejecuta->execute();  // Ejecuta la consulta
        } catch (PDOException $e) {
            return false;
        }
    }

    // M�todo para vincular par�metros a la consulta preparada
    public function bindParam($parameter, $variable) {
        if ($this->ejecuta) {
            return $this->ejecuta->bindParam($parameter, $variable);
        }
        return false;
    }

    // M�todo para obtener todos los registros de la consulta
    public function obtener_registros() {
        $this->ejecutar();  // Ejecuta la consulta si no se ha hecho
        return $this->ejecuta->fetchAll(PDO::FETCH_OBJ);  // Devuelve todos los resultados como objetos
    }

    // M�todo para obtener un �nico registro
    public function obtener_registro() {
        $this->ejecutar();  // Ejecuta la consulta
        return $this->ejecuta->fetch(PDO::FETCH_OBJ);  // Devuelve un solo resultado como objeto
    }

    // M�todo para contar los registros
    public function numero_registros() {
        return $this->ejecuta->rowCount();  // Devuelve el n�mero de filas afectadas por la consulta
    }
}
?>
