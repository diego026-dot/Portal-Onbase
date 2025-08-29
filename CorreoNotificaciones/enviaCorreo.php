<?php
// Incluir el archivo con la clase DatabaseOnBase
include "../libs/onbase/database.php";

// Incluir el autoload de Composer para cargar automáticamente PHPMailer
require "../vendor/autoload.php";  // Asegúrate de que esta ruta sea correcta

// Usar los namespaces de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\LookupRef\Filter;

use function PHPSTORM_META\map;

// Crear una instancia de la clase DatabaseOnBase
$dbOnBase = new DatabaseOnBase();

// Conectarse a la base de datos
if ($dbOnBase->connect()) {
    echo "Conexión exitosa!";
} else {
    die("Error en la conexión a la base de datos");
}

include "../libs/funciones.php";

// SEGURIDAD TOKEN
// acceso($_GET["token"]);

// LISTADO
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $sql = "exec [PORTALONBASE].[dbo].[OB_WEB_ObNotification] '151', '119'";
    $dbOnBase->query($sql);
    $resultados = $dbOnBase->obtener_registros();
    //var_dump($resultados);

    $footer = "";
    $footer .= "
    
    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width:600px; margin-top:10px;\">
    <tr>
    
    <td class=\"td-headerBot\" align=\"center\" valign=\"middle\"  bgcolor=\"#08043b\">
    <hr/>
    <table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\">
    
        <tr>
            <td align=\"left\" valign=\"top\" width=\"300\">
                <div style=\"display:inline-block; max-width:100%; min-width:100px; vertical-align:middle; width:100%;\">
                    <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width:800px;\">
                    <tr>
                        <td align=\"left\" valign=\"middle\" style=\"font-size: 15px; font-weight: 800;\" class=\"mobile-center\">
                        <p style=\"font-size: 13px; line-height: 28px; font-weight: 400; text-decoration: none; color: #ffffff;\">
                        Si tiene alguna duda o problema para ingresar, favor de contactar a Helpdesk.
                        </p>
                        </td>
                          <td align=\"right\" width=\"80\">
                            <div style=\"display:inline-block; max-width:50%; min-width:100px; vertical-align:middle; width:100%;\" class=\"mobile-hide\">
                                <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"90%\" style=\"max-width:300px;\">
                                    <tr>
                                        <td align=\"right\" valign=\"middle\" style=\"font-family: ClanOT-NarrowBook, sans-serif; font-size: 18px; font-weight: 400; color: #ffffff;\">
                                            <a href=\"https://coflexbpm.coflex.com.mx/AppNet/Workflow/WFLogin.aspx\" title=\"logo\" target=\"_blank\">
                                                <img width=\"60\" style= \"opacity:0.6;\" src=\"https://imagesoftinc.com/wp-content/uploads/2022/02/onbase-300x300.png\" title=\"logo\" alt=\"logo\">
                                            </a>
                                         </td>
                                    </tr>
                                </table>
                             </div>
                        </td>
                    </tr>
                    </table>
                </div>
            </td>
        </tr>
    ";
    $i = 0;


   

    $tasks = [];
    foreach ($resultados as $row) {
        
        $num = $row->contentnum;
        $correoFacturista = $row->CorreoFacturista;
        if($correoFacturista === null) continue;
        $stateNum = $row->statename;
        $url= $row->url;

        // Si el número de tarea no existe en el array, se inicializa
        if (!isset($tasks[$num])) {
            $tasks[$num] = [];
        }

        // Añadir los correos al grupo de ese número de tarea si no se ha añadido aún
        if (!in_array($correoFacturista, $tasks[$num])) {
            $tasks[$num][] = [
                'correo' => $correoFacturista,
                'stateNum' => $stateNum,
                'url' => $url
            ];
        }
    }

    $grupoPorTarea = [];
    foreach ($tasks as $tarea => $correos) {
        $facturistas = array_column($correos, 'correo');
        $facturistas = array_map('trim', $facturistas);
        // Crear una clave única para los grupos de facturistas (unir correos en una string)
        sort($facturistas); // Para evitar duplicados por el orden
        $key = implode(',', $facturistas); // Crear una clave única con los correos

        // Agrupar las tareas que pertenecen al mismo conjunto de correos
        if (!isset($grupoPorTarea[$key])) {
            $grupoPorTarea[$key] = [];
        }
        $grupoPorTarea[$key][] = [
            'contentnum' => $tarea,
            'statenum' => $correos[0]['stateNum'],
            'url' => $correos[0]['url']
        ];
    }

    



    foreach ($grupoPorTarea as $grupoCorreos => $tarea) {

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 2;  // Puedes cambiar a 3 para obtener más detalles si es necesario
        $mail->Debugoutput = 'html';  // Mostrar los mensajes en formato HTML
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.office365.com";
        $mail->Username = "onbaseprocesos@ravisa.com";  // Cambia a tu correo de Outlook
        $mail->Password = "JeL8451.f";  // Cambia a tu contraseña de Outlook
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;  // Puerto SMTP


        $grupoCorreos = preg_replace('/\s*,\s*/', ',', trim($grupoCorreos));
        $correosArray = explode(',', $grupoCorreos);

        foreach ($correosArray as $correo) {
            if($correo == 'FACTURA@RAVISA.COM'){
                $correo1 = 'onbaseauxiliar@ravisa.com';
            }else if($correo == 'JTELLEZ@RAVISA.COM'){
                $correo1 = 'onbaseauxiliar@ravisa.com';
            }else{
                $correo1 = 'onbaseauxiliar@ravisa.com';
            }
            
            $mail->addAddress($correo1);
        }


        $tableRows = '';
        foreach ($tarea as $tareas) {
            $tableRows .= "
               <tr  style=\"background-color:#ffff ; \">
                    <td >
                            <img src=\"https://ci3.googleusercontent.com/proxy/LkbGr6KEEycu-Cd27TCe2P_XtmXFEFaqztubEddWxfdYJocAtp-QQ_opK4S29DrhJCVCrlMM-e-yqsft-e26Duf9yvBw8h_tXgcXTdiZe3BUv6redFjXGc7DrlR0Zh0sLhPciaY0rOOAqsBwTMXLjBXz872uXOUAUud6JgnW=s0-d-e1-ft#https://d3ki9tyy5l5ruj.cloudfront.net/obj/17ebaf90443cc42469dfeeaf11302fa63f0a3386/checkmark-icon-32x32.png\"
                            style=\"border:none;display:block;outline:none;text-decoration:none;margin-top:5px;text-align:center\" height=\"17\" width=\"17\" class=\"CToWUd\" data-bit=\"iit\">
                     </td>
                      <td style=\" \">
                            <p  style=\"font-size: 20px;\">{$tareas['contentnum']}</p>
                     </td>


                     <td  align=\"center\" style=\" font-size: 5px width: 20%; font-weight:500; color:rgba(0,0,0,.64)\">
                        <p style=\" display: block;\">
                           {$tareas['statenum']}
                        </p>                    
                     <td   >

                        
                 
                    <a class='btn-base' href={$tareas['url']} target=\"_blank\" style=\" text-decoration:none;\"> Tarea </a>
                            
                        
                     </td>
                </tr>";
        }

        if ($i < 10) {
            $i++;
        } else {
            exit();
        }


        $urlUser = "
                <tr >
                    <td>
                        <table class=\"tableTareas\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 100%; border-radius: 5px; overflow: hidden;\">
                        <tbody align=\"center\">
                            $tableRows
                        </tbody>
                        </table>
                    </td>
                </tr>";
        //}    //TERMINA EL FOREACH

        // Generar el cuerpo del correo
        //$mail->addStringAttachment(file_get_contents("https://static.wixstatic.com/media/fe7c4c_859ff973380e4c27a5dc6fb7864f65ab~mv2.png/v1/fill/w_217,h_48,al_c,lg_1,q_85,enc_auto/fe7c4c_859ff973380e4c27a5dc6fb7864f65ab~mv2.png"), "filename");
        
        $mail->AddEmbeddedImage('C:\xampp\htdocs\Ravisa\public\img\logotipo\logo.png', 'imageCID', 'logo.png');

        $body = '
        <!DOCTYPE html>
        <html>
            <head>
                <title>Resumen de Tareas</title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                <style type="text/css">
                    * {
                        font-family: -apple-system, system-ui, BlinkMacSystemFont, Segoe UI, Roboto, Oxygen, Ubuntu, Cantarell, Open Sans, Helvetica Neue, sans-serif;
                        font-style: normal;
                        font-weight: 400;
                    }
                    table.tableTareas {
                        border-collapse: collapse;
                        width: 80%;
                    }
                    table, td {
                        mso-table-lspace: 0pt;
                        mso-table-rspace: 0pt;
                    }
                    td {
                        padding: 10px 1px;
                    }
                    .btn-base {
                        background-color: #ff7113;
                        color: #fff;
                        border-radius: 4px;
                        padding: 5px 10px;
                        font-size: 0.95em;
                        font-weight: 500;
                        border: none;
                        transition: all 0.4s ease;
                    }
                </style>
            </head>
            <body style="margin: 0 !important; padding: 0 !important; background-color: #FFFFFF;" bgcolor="#FFFFFF">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td align="center" style="background-color: #08043B;" bgcolor="#08043B">
                            <table align="center" border="0" cellspacing="0" cellpadding="0" width="800">
                                <tr>
                                    <td align="center" valign="top" width="600">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                            <tr>
                                                <td class="td-headerTop" valign="middle" style="padding: 20px 35px;" bgcolor="#08043B">
                                                    <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
                                                        <tr>
                                                            <td align="center" width="300">
                                                                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 300px;">
                                                                    <tr>
                                                                        <td align="center" style="font-size: 36px; font-weight: 800;" class="mobile-center">
                                                                            <img src="cid:imageCID" />
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" style="line-height: 24px; padding: 20px 30px;">
                                                    <h1 style="font-size: 18px; font-weight: 600; color: #fff;">Hola, :</h1>
                                                    <p style="font-size: 15px; font-weight: 200; color: #fff; margin-bottom: 20px;">Aquí están tus tareas pendientes:</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <!-- Aquí va el contenido dinámico $urlUser -->
                                                    '.$urlUser.'
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <!-- Aquí va el pie de página dinámico $footer -->
                                '.$footer.'
                            </table>
                        </td>
                    </tr>
                </table>
            </body>
        </html>'
        ;

            
            
        echo $body;
        
        //exit();
       
        // Enviar correo usando PHPMailer


        $mail->From = "onbaseprocesos@ravisa.com";  // Tu correo de Outlook
        $mail->FromName = "OnBase Procesos";


        $mail->IsHTML(true);
        $mail->Subject = "OnBase | Resumen diario de tareas";
        $mail->Body = $body;
        $exito = $mail->Send();

        echo $exito ? "Correo enviado exitosamente a $correo" : "Error al enviar correo a $correo";

        $residuo = fmod($id, 50);
        if ($residuo == 0) {
            sleep(30);  // Para pausar si es necesario
        }
    }
    }

