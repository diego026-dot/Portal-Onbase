<?php
// Incluir el archivo con la clase DatabaseOnBase
include "../libs/onbase/database.php";

// Incluir el autoload de Composer para cargar automáticamente PHPMailer
require "../vendor/autoload.php";  // Asegúrate de que esta ruta sea correcta

// Usar los namespaces de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

    $totalRegQuery = "exec [PORTALONBASE].[dbo].[OB_WEB_ObNotification] ";
    $sqlTotalReg = $dbOnBase->prepare($totalRegQuery);
    $sqlTotalReg->execute();
    $sqlTotalReg->setFetchMode(PDO::FETCH_ASSOC);
    $totalRegResults = $sqlTotalReg->fetchAll(PDO::FETCH_ASSOC);

    $footer = "";
    $footer .= "
    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width:600px;\">
    <tr>
    <td class=\"td-headerBot\" align=\"center\" valign=\"middle\" style=\"font-size:0; padding: 5px 35px;\" bgcolor=\"#08043b\">
    <table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\">
        <tr>
            <td align=\"left\" valign=\"top\" width=\"300\">
                <div style=\"display:inline-block; max-width:100%; min-width:100px; vertical-align:middle; width:100%;\">
                    <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width:800px;\">
                    <tr>
                        <td align=\"left\" valign=\"middle\" style=\"font-size: 15px; font-weight: 800;\" class=\"mobile-center\">
                        <p style=\"font-size: 15px; line-height: 28px; font-weight: 400; text-decoration: none; color: #ffffff;\">
                        Si tiene alguna duda o problema para ingresar, favor de contactar a Helpdesk.
                        </p>
                        </td>
                    </tr>
                    </table>
                </div>
            </td>
        </tr>
    ";

    foreach ($totalRegResults as $row) {
        $username = $row['username'];
        $name = $row['realname'];
        $correo = "coordinador.desarrollo1@ravisa.com";
        $id = $row['id'];

        $totalregU = "exec [PORTALONBASE].[dbo].[OB_WEB_ObNotification]";
        $sqlTotalU = $dbOnBase->prepare($totalregU);
        $sqlTotalU->execute();
        $sqlTotalU->setFetchMode(PDO::FETCH_ASSOC);
        $totalRegResultsUser = $sqlTotalU->fetchAll(PDO::FETCH_ASSOC);

        $totalReg = count($totalRegResultsUser);

        if (!empty($totalRegResultsUser)) {
            $urlUser = "";
            // foreach ($totalRegResultsUser as $innerRow) {
            //     $url = $innerRow['username'];
            //     $queue = $innerRow['username'];
            //     $flujo = $innerRow['username'];
            //     $cant = $innerRow['username'];
            //     $urlmobile = $innerRow['username'];

                $urlUser .= "
                <tr>
                    <td>
                        <table class=\"tableTareas\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 100%;\">
                        <tbody align=\"center\">
                            <tr class=\"trTareas\">
                                <td style=\"padding: 0px; width: 0%; font-weight:0; color:rgba(0,0,0,.64)\">
                                    <a href=\"$username\" target=\"_blank\" rel=\"noopener noreferrer\" style=\"font-size: 0px; color: #5B5B5B; text-decoration: none; border-radius: 0px; background-color: #FFFFFF; padding: 0px 0px; border: 0px solid #FFFFFF; display: block;\">
                                        <img src=\"https://ci3.googleusercontent.com/proxy/LkbGr6KEEycu-Cd27TCe2P_XtmXFEFaqztubEddWxfdYJocAtp-QQ_opK4S29DrhJCVCrlMM-e-yqsft-e26Duf9yvBw8h_tXgcXTdiZe3BUv6redFjXGc7DrlR0Zh0sLhPciaY0rOOAqsBwTMXLjBXz872uXOUAUud6JgnW=s0-d-e1-ft#https://d3ki9tyy5l5ruj.cloudfront.net/obj/17ebaf90443cc42469dfeeaf11302fa63f0a3386/checkmark-icon-32x32.png\"
                                        style=\"border:none;display:block;outline:none;text-decoration:none;margin-top:25px;text-align:center\" height=\"17\" width=\"17\" class=\"CToWUd\" data-bit=\"iit\">
                                    </a>
                                </td>
                                <td style=\"padding: 0px; font-size: 5px width: 20%; font-weight:500; color:rgba(0,0,0,.64)\">
                                    <h3 align=\"left\" style=\"font-size: 1px; display: block;\">
                                        <a href=\"$username\" target=\"_blank\" rel=\"noopener noreferrer\" style=\"font-size: 13px; color: #5B5B5B; text-decoration: none; border-radius: 0px; background-color: #FFFFFF; padding: 0px 0px; border: 0px solid #FFFFFF; display: block;\">
                                        $username
                                        </a>
                                    </h3>
                                    <a align=\"left\" href=\"$username\" target=\"_blank\" rel=\"noopener noreferrer\" style=\"font-size: 20px; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0); color: #000A32; text-decoration: none; border-radius: 0px; background-color: #FFFFFF; padding: 0px 30px; border: 0px solid #FFFFFF; display: block;\">
                                        <b>$username</b>
                                    </a>
                                </td>
                                <td style=\"padding: 0px;width: 3%; font-weight:0; color:rgba(0,0,0,.64)\">
                                    <a href=\"$username\" target=\"_blank\" rel=\"noopener noreferrer\" style=\"font-size: 17px; color: #000A32; text-decoration: none; border-radius: 0px; background-color: #FFFFFF; padding: 1px 0px; border: 0px solid #FFFFFF; display: block;\">
                                        <h3 align=\"left\" style=\"font-size: 20px; display: block; text-shadow: 0px 0px 0px rgba(0, 0, 0, 0.7);\">$username</h3>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        </table>
                    </td>
                </tr>";
            //}    //TERMINA EL FOREACH

            // Generar el cuerpo del correo
            $body = "<html>
            <head>
                <title>Resumen de Tareas</title>
                <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
                <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\" />
                <style type=\"text/css\">
                    * {
                        font-family: -apple-system, system-ui, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                        font-style: normal;
                        font-weight: 400;
                    }
                    table.tableTareas {
                        border-collapse: collapse;
                        width: 80%;
                    }
                    tr.trTareas {
                        border-bottom: 2px solid #ccc;
                    }
                    table, td {
                        mso-table-lspace: 0pt;
                        mso-table-rspace: 0pt;
                    }
                </style>
            </head>
            <body style=\"margin: 0 !important; padding: 0 !important; background-color: #FFFFFF;\" bgcolor=\"#FFFFFF\">
                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
                    <tr>
                        <td align=\"center\" style=\"background-color: #FFFFFF;\" bgcolor=\"#FFFFFF\">
                            <table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\">
                                <tr>
                                    <td align=\"center\" valign=\"top\" width=\"600\">
                                        <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width:600px;\">
                                            <tr>
                                                <td class=\"td-headerTop\"  valign=\"middle\" style=\"font-size:0;  display:flex; align-items:center; padding: 20px 35px;\" bgcolor=\"#08043b\">
                                                    <table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\">
                                                        <tr>
                                                            <td align=\"left\" valign=\"center\" width=\"300\">
                                                                <div style=\"display:inline-block; max-width:50%; min-width:100px; width:100%;\">
                                                                    <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width:300px;\">
                                                                        <tr>
                                                                            <td align=\"left\" valign=\"middle\" style=\"font-family: ClanOT-NarrowBook, sans-serif; font-size: 36px;  font-weight: 800;\" class=\"mobile-center\">
                                                                                <img src=\"https://static.wixstatic.com/media/fe7c4c_859ff973380e4c27a5dc6fb7864f65ab~mv2.png/v1/fill/w_217,h_48,al_c,lg_1,q_85,enc_auto/fe7c4c_859ff973380e4c27a5dc6fb7864f65ab~mv2.png\" width=\"130\" height=\"40\" border=\"0\" alt=\"\" style=\"display: block;\" />
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                            <td align=\"right\" width=\"300\">
                                                                <div style=\"display:inline-block; max-width:50%; min-width:100px; vertical-align:middle; width:100%;\" class=\"mobile-hide\">
                                                                    <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width:300px;\">
                                                                        <tr>
                                                                            <td align=\"right\" valign=\"middle\" style=\"font-family: ClanOT-NarrowBook, sans-serif; font-size: 18px; font-weight: 400; color: #ffffff;\">
                                                                                <a href=\"https://coflexbpm.coflex.com.mx/AppNet/Workflow/WFLogin.aspx\" title=\"logo\" target=\"_blank\">
                                                                                    <img width=\"60\" src=\"https://imagesoftinc.com/wp-content/uploads/2022/02/onbase-300x300.png\" title=\"logo\" alt=\"logo\">
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align=\"left\" width=\"50\" height=\"20\" style=\"font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 5px;\">
                                                    <h1 style=\"font-size: 22px; font-weight: 450; margin: 0; color: #333333;\">Hola, ".trim($name).":</h1>
                                                    <p style=\"font-size: 23px; font-weight: 100; line-height: 30px; color: #333333; margin: 0;\">Aquí están tus tareas pendientes:</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                $urlUser
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                ". $footer ."
                            </table>
                        </td>
                    </tr>
                </table>
            </body>
            </html>";

            echo $body;

            exit();

            // Enviar correo usando PHPMailer
            $mail = new PHPMailer(true);
// // Habilitar depuración detallada para SMTP
// $mail->SMTPDebug = 2;  // Puedes cambiar a 3 para obtener más detalles si es necesario
// $mail->Debugoutput = 'html';  // Mostrar los mensajes en formato HTML
            $mail->CharSet = 'UTF-8';
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->Host = "smtp.office365.com";
            $mail->Username = "facturas.proveedores@ravisa.com";  // Cambia a tu correo de Outlook
            $mail->Password = "FN4c2021$";  // Cambia a tu contraseña de Outlook
            $mail->SMTPSecure = 'tls';  // Usar TLS
            $mail->Port = 587;  // Puerto SMTP
            $mail->From = "facturas.proveedores@ravisa.com";  // Tu correo de Outlook
            $mail->FromName = "OnBase Procesos";
            $mail->AddAddress($correo);
            $mail->AddCC('coordinador.desarrollo1.onba@ravisa.com');
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
}
?>
