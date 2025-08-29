<?php 

require_once 'models/onbaseModel.php';
require 'vendor/autoload.php';

class Pages extends Controller 
{
    function __construct()
    {
        parent::__construct();
        revisa_session();
        $this->view->pagina = "";
        $this->model = new OnbaseModel();
    }
    function renderMain()
    {
        $this->view->render('main/index');
    }

    function formularioCandidatosView(){
        
        $this->view->pagina = "onbase/formularioCandidatos";
        $this->view->render('onbase/formularioCandidatos');
    }

    function registroCandidatosView(){
        
        $this->view->pagina = "onbase/registroDeCandidatos";
        $this->view->render('onbase/registroDeCandidatos');
    }

    function estadisticasCandidatosView(){
        
        $this->view->pagina = "onbase/estadisticasCandidatos";
        $this->view->render('onbase/estadisticasCandidatos');
    }

    function reportePaginasView(){
        
        $this->view->pagina = "onbase/reportePaginas";
        $this->view->render('onbase/reportePaginas');
    }

    function editarCandidatoView(){
        
        $this->view->pagina = "onbase/editarCandidato";
        $this->view->render('onbase/editarCandidato');
    }

    function reporteChecklistView(){
        
        $this->view->pagina = "onbase/reporteChecklistPendientes";
        $this->view->render('onbase/reporteChecklistPendientes');
    }


}

?>