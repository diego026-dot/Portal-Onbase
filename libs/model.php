<?php
// TIENE TODO EL MODELO DE BASE DE DATOS
class Model extends Database{
    

    function __construct(){
        $this-> db = new Database();
    }
    
}
?>