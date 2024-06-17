<?php
class Errores extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->activa = "";
        $this->view->render('errores/index');
        $_SESSION["mensaje"] = "";
    }

}
?>