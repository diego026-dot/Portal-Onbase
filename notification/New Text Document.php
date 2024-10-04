¡Nuevo! Combinaciones de teclas … Las combinaciones de teclas de Drive se han actualizado para que puedas navegar escribiendo las primeras letras
<?php
include "inc/config.php";
$DBCON = connect($db);
include "inc/funciones.php";

require_once("phpmail/PHPMailerAutoload.php");

// SEGURIDAD TOKEN
// acceso($_GET["token"]);

// LISTADO
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  

    //$sentencia = "exec [SP_OB_SYS_TareasPendientes_Servicio] ";
    //$sql = $DBCON->prepare($sentencia);
   // $sql->execute();
    //$sql->setFetchMode(PDO::FETCH_ASSOC);
   // $consulta = $sql->fetchAll();

	$totalRegQuery = "exec [SP_OB_SYS_TareasPendientes_Servicio_TotalReg] ";
    $sqlTotalReg = $DBCON->prepare($totalRegQuery);
    $sqlTotalReg->execute();
    $sqlTotalReg->setFetchMode(PDO::FETCH_ASSOC);
    $totalRegResults = $sqlTotalReg->fetchAll(PDO::FETCH_ASSOC);

	$footer ="";
  $footer .="
  
  <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width:600px;\">
  <tr>
  <td class=\"td-headerBot\"align=\"center\" valign=\"middle\" style=\"font-size:0; padding: 5px 35px; \" bgcolor=\"#000C54\">
  <table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\">
	  <tr>
		  <td align=\"left\" valign=\"top\" width=\"300\">
			  <div style=\"display:inline-block; max-width:100%; min-width:100px; vertical-align:middle; width:100%;\">
				  <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width:800px;\">
					  <tr>
						  <td align=\"left\" valign=\"middle\" style=\"font-size: 15px; font-weight: 800;\" class=\"mobile-center\">
						 	
						  <p style=\"font-size: 15px; line-height: 28px; font-weight: 400; text-decoration: none; color: #ffffff;\">
						  Si tiene alguna duda o problema para ingresar, favor de contactar a Helpdesk.
		  <br />
		  
						</p>
						     
							  </td>
						
							  </tr>
					  </tr>
				  </table>
			  </div>
			 
		  </td>                                             
 
  ";

   // foreach ($consulta as $row) {
	

	//print_r($totalRegResults);
	foreach ($totalRegResults as $row) {
		$username = $row['username'];
		$name = $row['realname'];
		$correo = $row['emailaddress'];  
        $id = $row['id'];  
		

		$totalregU = "exec [SP_OB_SYS_TareasPendientes_Servicio_TareasxUsuario] '" . $username . "'";
		$sqlTotalU = $DBCON->prepare($totalregU);
		$sqlTotalU->execute();
		$sqlTotalU->setFetchMode(PDO::FETCH_ASSOC);
		$totalRegResultsUser = $sqlTotalU->fetchAll(PDO::FETCH_ASSOC);

		$totalReg = count($totalRegResultsUser);

		
		//var_dump($totalRegResultsUser);
		
// Comprueba si el segundo bucle tiene elementos
if (!empty($totalRegResultsUser)) {
	// Inicializa la variable $urlUser fuera del bucle
	$urlUser = "";

	foreach ($totalRegResultsUser as $innerRow) {
		$url = $innerRow['url'];
		$queue = $innerRow['statename'];
		$flujo = $innerRow['lifecyclename'];
		$cant = $innerRow['cant']; 
		$urlmobile = $innerRow['urlmobile'];
		
		// Concatena cada URL a $urlUser
		//$urlUser .= "<p style=\"margin: 0;\">LOREM S  </p>";

		$urlUser .= "
		<tr>
		
		<td>
			<table class=\"tableTareas\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 100%;\">
				<tbody align=\"center\">
					<tr class=\"trTareas\">
					<td style=\"padding: 0px;   width: 0%; font-weight:0; color:rgba(0,0,0,.64)\">
					<a href=\" $url  \" target=\"_blank\" rel=\"noopener noreferrer\"style=\"font-size: 0px; color: #5B5B5B; text-decoration: none; border-radius: 0px; background-color: #FFFFFF; padding: 0px 0px; border: 0px solid #FFFFFF; display: block;\">
						
					<img src=\"https://ci3.googleusercontent.com/proxy/LkbGr6KEEycu-Cd27TCe2P_XtmXFEFaqztubEddWxfdYJocAtp-QQ_opK4S29DrhJCVCrlMM-e-yqsft-e26Duf9yvBw8h_tXgcXTdiZe3BUv6redFjXGc7DrlR0Zh0sLhPciaY0rOOAqsBwTMXLjBXz872uXOUAUud6JgnW=s0-d-e1-ft#https://d3ki9tyy5l5ruj.cloudfront.net/obj/17ebaf90443cc42469dfeeaf11302fa63f0a3386/checkmark-icon-32x32.png\" 
					style=\"border:none;display:block;outline:none;text-decoration:none;margin-top:25px;text-align:center\" height=\"17\" width=\"17\" class=\"CToWUd\" data-bit=\"iit\">
					</a>
					</td>
						<td style=\"padding: 0px; font-size: 5px width: 20%; font-weight:500; color:rgba(0,0,0,.64)\">
						
						<h3 align=\"left\" style=\"font-size: 1px; display: block;\">
						<a href=\" $url  \" target=\"_blank\" rel=\"noopener noreferrer\"style=\"font-size: 13px; color: #5B5B5B; text-decoration: none; border-radius: 0px; background-color: #FFFFFF; padding: 0px 0px; border: 0px solid #FFFFFF; display: block;\">
						
						" . $flujo . "
						</a>
						</h3>
						<a  align=\"left\"  href=\" $url  \" target=\"_blank\" rel=\"noopener noreferrer\"style=\"font-size: 20px; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0); color: #000A32; text-decoration: none; border-radius: 0px; background-color: #FFFFFF; padding: 0px 30px; border: 0px solid #FFFFFF; display: block;\">
						<b>" . $queue . "</b></a>
														
						</td>

						<td style=\"padding: 0px;width: 3%; font-weight:0; color:rgba(0,0,0,.64)\">
					<a href=\" $url  \" target=\"_blank\" rel=\"noopener noreferrer\"style=\"font-size: 17px; color: #000A32; text-decoration: none; border-radius: 0px; background-color: #FFFFFF; padding: 1px 0px; border: 0px solid #FFFFFF; display: block;\">
			           <h3 align=\"left\" style=\"font-size: 20px; display: block; text-shadow: 0px 0px 0px rgba(0, 0, 0, 0.7);\">  $cant </h3>
					</a>
					</td>
					<td class=\"mobile-link\" style=\"padding: 0px;  width: 1%; font-weight:50; color:rgba(0,0,0,.64)\">
					<a href=\" $url  \" target=\"_blank\" rel=\"noopener noreferrer\"style=\"font-size: 17px; color: #000A32; text-decoration: none; border-radius: 0px; background-color: #FFFFFF; padding: 0px 0px; border: 0px solid #FFFFFF; display: block;\">
				 <img src=\"https://cdn-icons-png.flaticon.com/512/6559/6559088.png\" width=\"50\" height=\"88\" border=\"0\" alt=\"\" style=\"display: block;\" />
	
					</a>
					</td>
					<td class=\"mobile-app-link\" style=\"padding: 0px;  width: 1%; font-weight:50; color:rgba(0,0,0,.64)\">
					<a href=\" $urlmobile  \" target=\"_blank\" rel=\"noopener noreferrer\"style=\"font-size: 17px; color: #000A32; text-decoration: none; border-radius: 0px; background-color: #FFFFFF; padding: 0px 0px; border: 0px solid #FFFFFF; display: block;\">
				 <img src=\"https://cdn-icons-png.flaticon.com/512/6559/6559088.png\" width=\"50\" height=\"88\" border=\"0\" alt=\"\" style=\"display: block;\" />
	
					</a>
					</td>
					
					</tr>
				</tbody>
			</table>
		</td>
	</tr>";
	
		

	}

	// Imprime la variable $urlUser dentro de <td>
	//echo "<td>" . $urlUser . "</td>";
} else {
	




} //CIERRA ELSE
			  
			 
     $body = "<html>
	
<head>
    <title></title>
	
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\" />
    <style type=\"text/css\">
	*{
		font-family: -apple-system, system-ui,  BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;

	
		font-style: normal;
		font-weight: 400;
	}

        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
		table.tableTareas {
			border-collapse: collapse;
			width: 80%;
		}
		tr.trTareas {
			border-bottom: 2px solid #ccc;
		}
        table,
        td {
			
		
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
		.td-headerTop { 
			background-color: rgba(0, 12, 84, .85);
			
			border-top-right-radius: 15px; 
			border-top-left-radius: 15px;  
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
		.td-headerBot { 
			background-color: rgba(0, 12, 84, .85);
			border-bottom-right-radius: 15px;  
			border-bottom-left-radius: 15px;  
			
		
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        img {
            -ms-interpolation-mode: bicubic;
        }

        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }
		@media only screen and (max-width: 1024px) {
			.mobile-link {
                display: none !important;
            }
			
		}
		@media only screen and (min-width: 1025px) {
			
			.mobile-app-link {
				display: none !important;
            }
		}

        @media screen and (max-width: 768px) {
            .mobile-hide {
                display: none !important;
            }
			

            .mobile-center {
                text-align: center !important;
            }
        }

        /* ANDROID CENTER FIX */
        div[style*=\"margin: 16px 0;\"] {
            margin: 0 !important;
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
                                    <td class=\"td-headerTop\"align=\"center\" valign=\"middle\" style=\"font-size:0; padding: 20px 35px;\" bgcolor=\"#000C54\">
                                        <table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\">
                                            <tr>
                                                <td align=\"left\" valign=\"top\" width=\"300\">
                                                    <div style=\"display:inline-block; max-width:50%; min-width:100px; vertical-align:middle; width:100%;\">
                                                        <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width:300px;\">
                                                            <tr>
                                                                <td align=\"left\" valign=\"middle\" style=\"font-family: ClanOT-NarrowBook, sans-serif; font-size: 36px; font-weight: 800;\" class=\"mobile-center\">
																<img src=\"https://www.coflex.com.mx/theme/Coflex2021/img/Logo.png\" width=\"190\" height=\"88\" border=\"0\" alt=\"\" style=\"display: block;\" />
																      </td>
                                                            </tr>
                                                        </table>
                                                    </div>
													<div style=\"display:inline-block; max-width:100%; min-width:100px; vertical-align:middle; width:100%;\">
													<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width:300px;\">
														
													</table>
												</div>
                                                </td>
                                                <td align=\"right\" width=\"300\">
                                                    <div style=\"display:inline-block; max-width:50%; min-width:100px; vertical-align:middle; width:100%;\" class=\"mobile-hide\">
                                                        <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width:300px;\">
                                                            <tr>
                                                                <td align=\"right\" valign=\"middle\" style=\"font-family: ClanOT-NarrowBook, sans-serif; font-size: 18px; font-weight: 400; color: #ffffff; \">
                                                                    <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"right\">
                                                                        <tr>
                                                                            <td style=\"font-size: 18px; font-weight: 400; color: #ffffff;\">       
																			<a href=\"https://coflexbpm.coflex.com.mx/AppNet/Workflow/WFLogin.aspx\" title=\"logo\" target=\"_blank\">
                                      <img width=\"60\" src=https://imagesoftinc.com/wp-content/uploads/2022/02/onbase-300x300.png\" title=\"logo\" alt=\"logo\">   </a>
																			</td>
                                                                            
                                                                        </tr>
                                                                    </table>
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
								<p style=\"font-size: 23px; font-weight: 100; line-height: 30px; color: #333333; margin: 0;\">Aquí están tus tareas pendientes
							  </p>
							  <br>
					
								
                                   </td>
                            
                                            </tr>
                                <tr>
								<!--  <td align=\"center\" width=\"150\" height=\"120\" style=\"font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 5px;\">
			
								<h2 style=\"font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;\"> </h2> 
                                   </td>  -->
								  
                            
				                             $urlUser			   
                                                </td> 
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

     
 
  //  exit();
  

  $resultado=""; $mail = new PHPMailer();
  $mail->CharSet = 'UTF-8'; $mail->IsSMTP();
  $mail->SMTPAuth = true;
  $mail->Host = "smtp.gmail.com"; 
  $mail->Username = "procesos.bpm@coflex.com.mx"; // A RELLENAR. Email de la cuenta de correo. 
  $mail->Password = "CxF7XcQ2"; // A RELLENAR. Aqui pondremos la contraseña de la cuenta de correo
  $mail->Port = "587"; // Puerto de conexión al servidor de envio. 
  $mail->From = "procesos.bpm@coflex.com.mx"; // Desde donde enviamos (Para mostrar).
  $mail->FromName = "OnBase Procesos"; //A RELLENAR Nombre a mostrar del remitente.
  $mail->AddAddress($correo);// CORREO DESTINO
  $mail->AddCC('laguilarb@coflex.com.mx'); // COPIA CORREO DESTINO
  $mail->IsHTML(true); // El correo se envía como HTML 
  $mail->Subject = "OnBase | Resumen diario de tareas"; // Este es el titulo del email.
  $body = $body;  
  $mail->Body = $body; // Mensaje a enviar.  
  $exito = $mail->Send(); // Envía el correo.
	

  
	 echo  $exito;
     
    $residuo = fmod($id,50);
  
    if( $residuo==0){
      sleep(30);
    }

  // exit();
}


   //exit();

}
 
?>