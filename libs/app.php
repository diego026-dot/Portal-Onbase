<?php
set_time_limit(0);
require_once 'controllers/errores.php';

class App{

    function __construct(){
        $url = isset($_GET['url']) ? $_GET['url']: null; // url definido en htaccess
        $url = rtrim($url , '/'); // quitamos / inecesarios
        $url = explode('/', $url); // pasamos a array los parametros
        
        if(empty($url[0])){
            //si no se especifico controlador lo mandamos a main
            $archivoController = 'controllers/main.php';
            require_once $archivoController;
            $controller = new Main();
            $controller->loadModel('main');
            $controller->render();
            return false;
        }

        //aqui definimos el controlador que recibimos en primera posicion
        $archivoController = 'controllers/' . $url[0] . '.php';
        if(file_exists($archivoController)){
            //si existe el controlador lo mandamos ejecutar
            require_once $archivoController;
            //inicializamos el controlador
            $controller = new $url[0];
            $controller->loadModel($url[0]);
            // numero de elementos del arreglo
            $n_parametros = sizeof($url); // si tiene mas de dos elementos hay parametros
            if($n_parametros>1){
                if($n_parametros>2){
                    $parametros = [];
                    for($i = 2; $i<$n_parametros; $i++){
                        array_push($parametros, $url[$i]);
                    }
                    $controller->{$url[1]}($parametros);
                }else{
                    $controller->{$url[1]}();
                }
            }else{
                $controller->render();
            }
        }else{
            //si no existe el controlador mostramos Errores
            $controller = new Errores();
        }
    }
}
?>