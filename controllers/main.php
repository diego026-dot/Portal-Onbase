<?php

require_once 'models/onbaseModel.php';
class Main extends Controller{
    

    function __construct(){
        parent::__construct();
        $this->revisa_session(); // Verifica la sesión
        $this->view->pagina = "";
        
    }

    function render(){
        $_SESSION["mensaje"] = "";  
        $this->view->render('main/index');
    }


    public function revisa_session() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            // Si no hay sesión activa, redirige al login
            header('Location: ' . constant('URL') . 'login');
            exit;
        }
    }




}
?>
