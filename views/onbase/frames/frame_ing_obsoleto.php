
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/hmac-sha256.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/components/enc-base64-min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/hmac-sha256.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/hmac-sha256.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/enc-base64.js"></script>

<?php
$usuario = $_SESSION['strUsuario'];

try  
{ 	$con = new PDO( "sqlsrv:server=10.1.10.11 ; Database=obintegrations", "obintegrations", '0b1nt3gr4t10ns$');  
    $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );}  
catch(Exception $e){die( print_r( $e->getMessage()));}  

//CONSULTA SI YA ESTA REGISTRADO EL USUARIO EN LA TABLA
$store = "exec SP_OB_CCD_WEB_Usuarios_OnBase  '" . $usuario . "'";
$v = $con->prepare($store);  
$v->execute();  
$v = $v->fetchAll(PDO::FETCH_ASSOC);
foreach($v as $row)
  {
  $NOMBREEMPLEADO = $row["NOMBRE_COMPLETO"]; //echo $NOMBREEMPLEADO;
  $EMAIL = $row["CORREO"]; //echo $EMAIL;
  $DEPARTAMENTO = $row["AREA"]; //echo  $DEPARTAMENTO;
  $POSID = $row["POSID"]; //echo  $ID_EMPLEADO;
  }

			  
?>
<script>

var token = "Y/QeVNF7SPRmt/M1aul4CyLHiy4vDsW9HdvwEb5GSiM=";

var LINK = "https://coflexbpm.coflex.com.mx/AppNet//UnityForm.aspx?d1=AWKmoAMI4ZSRQDJHDpz5iIi4m0pfDvGQHHD811%2fZnK5CP%2bOZphDtivG4ZgJdsPGNDhIyTpKPbzVoefnXFPBEVGZW87B7zJI8TiFUsV9TOEjs3qXEHjaRjMZtFW90j8pHowroNYyOO1g%2bznjaeSSY8BWeVqITd9%2fKcz9CRKIlJ%2bRrnPaHdbndHppPr3E2ikZrdx1jlz28xts7M1wP8NyODPTY10ZkhOvp3LMOsv%2fiDQy9";

var encodedURL = "";


var url ="&ufpregbl01solicitantenombre7=<?php echo substr($NOMBREEMPLEADO, 0, 49); ?>&ufpregbl02solicitantecorreo8=<?php echo $EMAIL; ?>&ufpregbl03solicitantedepartamento9=<?php echo ltrim(rtrim($DEPARTAMENTO))?>&ufprechrs01vsolicitanteposiciónid70=<?php echo ltrim(rtrim($POSID))?>";

//split URL into fieldID and value pairs
var values = url.split('&');

for (var i = 0; i < values.length; i++)
{
var IDValue = values[i].split("=");
var ID = IDValue[0];
if (ID != "")
{
//URL encode the URL parameters
encodedURL += '&' + encodeURIComponent(ID) + '=' +
encodeURIComponent(IDValue[1]);
}
}


var utf8encodedURL = CryptoJS.enc.Utf8.parse(encodedURL);

var base64Token = CryptoJS.enc.Base64.parse(token);

var hash = CryptoJS.HmacSHA256(utf8encodedURL, base64Token);

var base64hash = CryptoJS.enc.Base64.stringify(hash);

var URIencodedhash = encodeURIComponent(base64hash);


LINK += encodedURL += '&ufprehash=' + URIencodedhash;
//alert(url);


//location.href='Frame_solicitud_cambio_revisionOnBase.php?link='+ LINK;
//document.forms["form1"].action = "http://www.investinmadrid.com/tce_nuevo/fichas/" + pais1 + "/intro_ficha_" + pais2 + ".htm";
location.href=LINK;
//location.href='Frame_solicitud_cambio_revisionOnBase.php?link='+ LINK;
//$('#onbase').src(encodedURL);

//document.getElementById('onbase').src=LINK;
//document.OnBaseFrameRevision.OnBaseFrame.src=encodedURL; 
//window.frames["OnBaseFrame"].document.forms["form1"].elements[0].value

</script>
