<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/hmac-sha256.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/components/enc-base64-min.js"></script>

<? 
$email	= $_SESSION['correo']; //echo $email;

$sql = "EXEC qryUsuariosOnBase '" .$email. "'"; //echo $sql;
			$stmt = sqlsrv_query( $conn_intranetGeneral, $sql );
			  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) 
			  {
			  $NOMBREEMPLEADO = $row["NOMBRE_COMPLETO"]; //echo $NOMBREEMPLEADO;
			  $EMAIL = $row["CORREO"]; //echo $EMAIL;
			  $DEPARTAMENTO = $row["AREA"]; //echo  $DEPARTAMENTO;
			  } 
			  
?>
<script>  

var token = "Y/QeVNF7SPRmt/M1aul4CyLHiy4vDsW9HdvwEb5GSiM=";

var LINK = server.urldecode(Request.Unvalidated("https://coflexbpm.coflex.com.mx/AppNet/UnityForm.aspx?d1=AXACnF%2bNmO39lPv%2bL10YJTJ%2flgw%2fxGE3MOHSe9YnAIfr17AyCZ372z6ds5UBbjpkltmZ6HYkLs5vlhjY7DdoWA0XPWVQgkrhRwcyHA4NZz5yclSFKWpRjWuKlaBOhqYb0P4JsjmqurlmPQuOkAATtdg6s0INcHFCkcwn81Dh1noOL8NlP6AGqZFEJekXaWZyByWMj4dOOLePknigZjVN5VDzqYwpf1jpeLNXhiE8Oiyd"));

var encodedURL = "";

//&ufpresolicitante17=value1&ufpreemailsolicitante19=<? echo $_SESSION['correo'] ?>value2&ufpredepartamento18=value3
var url ="&ufpresac01solicitante6=<? echo substr($NOMBREEMPLEADO, 0, 49) ?>&ufpresac01correo7=<? echo $EMAIL ?>&ufpresac01departamento8=<? echo ltrim(rtrim($DEPARTAMENTO)) ?>";

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
//alert(LINK);


//location.href='Frame_solicitud_cambio_revisionOnBase.php?link='+ LINK;
//document.forms["form1"].action = "http://www.investinmadrid.com/tce_nuevo/fichas/" + pais1 + "/intro_ficha_" + pais2 + ".htm";
location.href=LINK;
//location.href='Frame_solicitud_cambio_revisionOnBase.php?link='+ LINK;
//$('#onbase').src(encodedURL);

//document.getElementById('onbase').src=LINK;
//document.OnBaseFrameRevision.OnBaseFrame.src=encodedURL; 
//window.frames["OnBaseFrame"].document.forms["form1"].elements[0].value

</script>
