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
</script>
