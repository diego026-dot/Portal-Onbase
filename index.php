<?php 
// PHP Version 7.3.7
// AGREGAMOS LAS LIBRERIAS
// BASE DE DATOS DE FRAMEWORK
require_once 'libs/database.php'; 
// BASE DE DATOS DE ONBASE
require_once 'libs/onbase/database.php';
// BASE DE DATOS DE PEDIDOS

require_once 'libs/controller.php';
require_once 'libs/view.php';
require_once 'libs/model.php'; 
require_once 'libs/app.php';
// AGREGAMOS LAS FUNCIONES 
require_once 'libs/funciones.php'; 
// require_once 'recursos/phpmail/PHPMailerAutoload.php';
//require_once 'libs/funciones_correos.php';
//require_once 'libs/funciones_dompdf.php';
// CONFIGURACION DE BASE DE DATOS
require_once 'config/config.php';

$app = new App();
?>