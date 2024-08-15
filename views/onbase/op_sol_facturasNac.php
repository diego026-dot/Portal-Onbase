<?php include("public/inc/encabezado_sinbusqueda.php");?>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header mb-5">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Procesos</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Obsoleto</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <button type="button" onclick="regresar();" class="btn btn-danger float-right">Regresar</button>
                    </div>
                </div>
            </div>
            <?php echo mensaje(); ?>
        </div>
    </div>
</div>

<?php include("public/inc/jsfooter.php");?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/hmac-sha256.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/components/enc-base64-min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/hmac-sha256.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/hmac-sha256.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/enc-base64.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php
$usuario = $_SESSION['usuario'];

// try  
// { 	$con = new PDO( "sqlsrv:server=10.1.10.11 ; Database=obintegrations", "obintegrations", '0b1nt3gr4t10ns$');  
//     $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );}  
// catch(Exception $e){die( print_r( $e->getMessage()));}  

//CONSULTA SI YA ESTA REGISTRADO EL USUARIO EN LA TABLA
// $store = "exec SP_OB_CCD_WEB_Usuarios_OnBase  '" . $usuario . "'";
// $v = $con->prepare($store);  
// $v->execute();  
// $v = $v->fetchAll(PDO::FETCH_ASSOC);
// foreach($v as $row)
//   {
    $USUARIO = 'user'; //echo $NOMBREEMPLEADO;
  $EMAIL = 'email'; //echo $EMAIL;

  // }
?>

<script>
var token = "lRMBnT/LxXzc8ev170zEwnjBELjUgUgihvgqiy/5Z5c=";
var LINK = "http://srvweb/AppNet/UnityForm.aspx?d1=AXMAx%2fHUL6Qbq1c0rYv0VtidWiTj3HlwxZFWdU9QmdrA%2bAxvRui97UcQs2KYCIWDsHdzjKgYJLwOlk6yJsIE4i%2f%2bFQjizYwtOQjGxPiX9ofK4I5KT2h9jad4%2fQ26ojIpW4B2Ie4jHdUwvhpHwcb%2bbRcMh9pnT31cPwBfJmR0Me%2bA";
var encodedURL = "";

var url = "&ufpretextbox47Sol=<?php echo substr($USUARIO, 0, 49); ?>&ufpretextbox48CorreoSol=<?php echo $EMAIL; ?>";

//split URL into fieldID and value pairs
var values = url.split('&');

for (var i = 0; i < values.length; i++) {
    var IDValue = values[i].split("=");
    var ID = IDValue[0];
    if (ID != "") {
        //URL encode the URL parameters
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

function regresar() {
    window.location = '<?php echo constant('URL') ?>onbase/operaciones_menu/';
}
</script>
