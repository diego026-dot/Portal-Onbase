<?php
class Recupera extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->activa = "";
    }

    function render(){
        $this->view->render('recupera/index');
    }

    function validacion(){
        $_SESSION["mensaje"] = "<div class='alert alert-success' role='alert'><b>Ok!</b> Información enviada.</div>";
        header('Location: '.constant('URL').'recupera');
    }
}
?>