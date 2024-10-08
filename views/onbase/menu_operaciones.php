<?php include("public/inc/encabezado_sinbusqueda.php"); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operaciones</title>
    <!-- Carga de jQuery desde una CDN confiable -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Carga de otras librerías después de jQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/hmac-sha256.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/components/enc-base64-min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/hmac-sha256.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/hmac-sha256.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/enc-base64.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wysihtml5/0.3.0/wysihtml5.min.js"></script>
    <!-- Incluye tus CSS específicos aquí -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/wysihtml5/0.3.0/wysihtml5.min.css">
</head>

<body>
    <div class="container-fluid" style="margin-top: 0; padding-top: 0;">
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <nav aria-label="breadcrumb" role="navigation" class="bg-transparent">
                    <ol class="breadcrumb mb-1 bg-transparent">
                        <li class="breadcrumb-item">
                            <img src="https://static.wixstatic.com/media/fe7c4c_794ee55525f8446ba0a6ba64d5afaeb6~mv2.png/v1/fill/w_120,h_48,al_c,lg_1,q_85,enc_auto/fe7c4c_794ee55525f8446ba0a6ba64d5afaeb6~mv2.png" alt="Icono" style="width: 40px; height: auto; margin-right: 10px;">
                            <a href="#">Operaciones</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Carga de Facturas</li>
                    </ol>
                </nav>
                <button type="button" onclick="regresar();" class="btn-base-regresar">Regresar</button>
            </div>
        </div>

        <div class="page-header mb-5">
            <section class="content" style="padding-top: 5px; padding-bottom: 5px;">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card text-dark mb-3 shadow card-hover" style="max-width: 18rem; cursor:pointer;">
                            <div class="card-body text-center p-5">
                                <img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/sol_nueva.png' ?> title="Solicitud Facturas Nacionales" width="140px" />
                                <a href="javascript:void(0)" class="stretched-link" onClick="facturas_nac()"></a>
                                <div style="color:#293080; font-weight:bold; font-size:18px; margin-top:10px;">SOLICITUD CARGA DE FACTURAS</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="card text-dark mb-3 shadow card-hover" style="max-width: 18rem; cursor:pointer;">
                            <div class="card-body text-center p-5">
                                <img class="borderedondo" src=<?php echo constant('URL') . 'public/img/menu_ccd/sol_fact.png' ?> title="Solicitud Facturas Nacionales" width="140px" />
                                <a href="javascript:void(0)" class="stretched-link" onClick="op_buscar()"></a>
                                <div style="color:#293080; font-weight:bold; font-size:18px; margin-top:10px;">BUSCAR FACTURA</div>
                            </div>
                        </div>
                    </div>



                </div>

            </section>
        </div>




    </div>

    <?php include("public/inc/jsfooter.php"); ?>

    <?php

    $USUARIO = $_SESSION['usuario'];

    foreach ($_SESSION['usuarioCorreo'] as $correo) {
        $EMAIL = $correo;
    }
    ?>

    <script>
        function op_buscar() {
            window.location = '<?php echo constant('URL') ?>onbase/op_buscarFactura/';
        }

        // function facturasmx() {
        // window.open('http://srvweb/AppNet/UnityForm.aspx?d1=AcEKbfLfYiZnR%2brHS%2bhGyl7oEtCSurJv4t%2fXfZu2Q9REKpjeB%2fJuYamzSeVzmuYgrdTUSYbOzCwrx5l8LUhrZ5AldjPnVzcnYXiDUd0%2bcMHpwWYz9W6rKRjqY5KthvFOZ%2fIYtnOG2OzImuyPayRgbYc%3d', '_blank');
        // }

        function facturas_nac() {
            var token = "lRMBnT/LxXzc8ev170zEwnjBELjUgUgihvgqiy/5Z5c=";
            var LINK = "http://srvweb/AppNet/UnityForm.aspx?d1=AXMAx%2fHUL6Qbq1c0rYv0VtidWiTj3HlwxZFWdU9QmdrA%2bAxvRui97UcQs2KYCIWDsHdzjKgYJLwOlk6yJsIE4i%2f%2bFQjizYwtOQjGxPiX9ofK4I5KT2h9jad4%2fQ26ojIpW4B2Ie4jHdUwvhpHwcb%2bbRcMh9pnT31cPwBfJmR0Me%2bA";
            var encodedURL = "";
            var url = "&ufpretextbox47Sol=<?php echo substr($USUARIO, 0, 49); ?>&ufpretextbox48CorreoSol=<?php echo $EMAIL; ?>";

            // Split URL into fieldID and value pairs
            var values = url.split('&');
            for (var i = 0; i < values.length; i++) {
                var IDValue = values[i].split("=");
                var ID = IDValue[0];
                if (ID != "") {
                    // URL encode the URL parameters
                    encodedURL += '&' + encodeURIComponent(ID) + '=' + encodeURIComponent(IDValue[1]);
                }
            }

            var utf8encodedURL = CryptoJS.enc.Utf8.parse(encodedURL);
            var base64Token = CryptoJS.enc.Base64.parse(token);
            var hash = CryptoJS.HmacSHA256(utf8encodedURL, base64Token);
            var base64hash = CryptoJS.enc.Base64.stringify(hash);
            var URIencodedhash = encodeURIComponent(base64hash);

            LINK += encodedURL += '&ufprehash=' + URIencodedhash;

            window.open(LINK, '_blank');
        }

        function regresar() {
            window.location = '<?php echo constant('URL') ?>main';
        }

        // Asignar las funciones a los eventos de clic en el momento de cargar el documento
        $(document).ready(function() {
            window.facturas_nac = facturas_nac;
            window.frame = frame;
            window.regresar = regresar;
        });
    </script>
</body>

</html>