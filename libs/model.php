<?php
// TIENE TODO EL MODELO DE BASE DE DATOS
class Model{
    public $db;

    function __construct(){
        $this->db = new Database();
    }
    
}
?>