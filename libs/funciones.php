<?php
function activo($id){
    if($id){
        return '<span class="badge badge-success">Activo</span>';
    }else{
        return '<span class="badge badge-danger">Inactivo</span>';
    }
}

function etiqueta_nuevo_promocion($nuevo,$promocion){
    if($nuevo){
        return ' <div style="position: absolute; right: 14px; top: 0px; text-align: right; z-index: 2;">
        <img src="'.constant('IMG').'extras/nuevo.png">
    </div>';
    }
    if($promocion){
        return ' <div style="position: absolute; right: 14px; top: 0px; text-align: right; z-index: 2;">
        <img src="'.constant('IMG').'extras/promocion.png">
    </div>';
    }
}

function etiqueta_piezas_pedido($cantidad){
    if($cantidad>0){
        return '<span style="position: absolute; left: 20px; top: 40px; text-align: left; z-index: 2;"
        class="badge badge-pill badge-proyecto">'.$cantidad.' en pedido</span>';
    } else {
        return "";
    }
}

function etiqueta_informacion($url){
    return '
        <a href="'.$url.'">
        <span style="position: absolute; left: 20px; top: 7px; text-align: left; z-index: 2;"
        class="badge badge-pill badge-light text-dark"><i 
        class="fa fa-info-circle" aria-hidden="true"></i> Más detalle</span></a>';
}

function modelo($modelo){
    return substr($modelo, 2, 50);
}

function aplicacosto($id){
    if($id){
        return 'Sí';
    }else{
        return 'No';
    }
}

function permiso($id){
    if($id){
        return '<a class="dropdown-item text-success" href="#"><i class="dw dw-check"></i></a>';
    }else{
        return '<a class="dropdown-item text-danger" href="#"><i class="dw dw-cancel"></i></a>';
    }
}

function checkbox($valor){
    if($valor){
        return "checked";
    }
}

function redirecciona($url){
    header('Location: '.constant('URL').$url);
    return true;
}

function revisa_session(){
    if(is_session_started()===FALSE) session_start();
    if(!isset($_SESSION["usuario"])){  header('Location: '.constant('URL').'logout');}
    return true;
}

function mensaje(){
    $mensaje = "";
    try{
        if(isset($_SESSION["mensaje"])){
            $mensaje = $_SESSION["mensaje"];    
        }
    } catch (Exception $e) {
        $mensaje = "";
    }
    return $mensaje;
}

function is_session_started()
{
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}

function fecha($fecha) {
  	$numeroDia = date('d', strtotime($fecha));
  	$dia = date('l', strtotime($fecha));
  	$mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $hora = date('H', strtotime($fecha));
    $minuto = date('i', strtotime($fecha));
  	$dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  	$dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  	$nombredia = str_replace($dias_EN, $dias_ES, $dia);
	$meses_ES = array("ENE", "FEB", "MAR", "ABR", "MAY", "JUN", "JUL", "AGO", "SEP", "OCT", "NOV", "DIC");
  	$meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  	$nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  	return $numeroDia."".$nombreMes."".$anio." ".$hora.":".$minuto;
}

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }
    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

function extension($archivo)
{
    $extension = explode(".", $archivo);
    return $extension[1];
}

function borrarArchivo($direccion){
    if (file_exists($direccion)) 
        { unlink($direccion); }    
}

function foto_existe( $url = NULL ) {
    if(empty( $url) ){
        return false;
    }
    stream_context_set_default(
        array(
            'http' => array(
                'method' => 'HEAD'
             )
        )
    );
    $headers = @get_headers( $url );
    sscanf( $headers[0], 'HTTP/%*d.%*d %d', $httpcode );
    $accepted_response = array( 200, 301, 302 );
    if( in_array( $httpcode, $accepted_response ) ) {
        return $url;
    } else {
        return constant('IMG').'extras/SIN_FOTO.jpg';
    }
}

function my_curl_fun($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

function revisa_imagen($foto_local,$foto_url){
    $resultado = "";
    if (!file_exists($foto_local)) {
        $resultado = $resultado ." No existe foto en local.";
        $data = my_curl_fun($foto_url);
        if(!empty($data)){
            $imagen = file_get_contents($foto_url);
            file_put_contents($foto_local, $imagen);
            $resultado = $resultado ." Bajamos la foto a local";
        } else {
            copy("public/img/extras/SIN_FOTO.jpg", $foto_local);
            $resultado = $resultado ." No tiene foto en el portal, asignamos una default";
        }
    }
    return $resultado;
}

function existe_img($foto){
    $foto = $foto;
    if (!file_exists($foto)) {
        return constant('URL') . "public/img/extras/SIN_FOTO.jpg";
    } else {
        return constant('URL') . $foto;
    }
}

function medidacubicaje($valor){
    return $valor*100 ." cm";
}

function pesocubicaje($valor){
    return $valor*100 ." gr";
}

function subirLogotipo($dir_subida,$extension,$logo,$logotipo){
    $mensaje = "";
    if (move_uploaded_file($logotipo, $logo)) {
        $mensaje_imagen=", con logotipo registrado existosamente.";
    } else {
        $mensaje_imagen=", pero con error al subir logotipo.";
    }
    return $mensaje;
}

function altaRegistro($fecha){
    return '<a class="dropdown-item text-dark" href="#"><i class="dw dw dw-pencil"></i> Alta: '.fecha($fecha).'</a>';
}

function modificadoRegistro($fecha){
    return '<a class="dropdown-item text-dark" href="#"><i class="dw dw dw-edit-2"></i> Editado: '.fecha($fecha).'</a>';
}

function datosistema(){
    return '<a class="dropdown-item text-danger" href="#"><i class="dw dw dw-lock"></i> Uso de Sistema</a>';
}

function caracteres($x){
    echo ' maxlength="'.$x.'" ';
} 

function seleccionado(){
    echo ' autofocus ';
}

function picker($fecha){  //14 January 2021
    if($fecha==""){
        return '1900-01-01';
    }else{
        $f = explode(" ", $fecha);
        $meses_ES = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
  	    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
          $mes = str_replace($meses_EN, $meses_ES, $f[1]);
          return $f[2]."-".$mes."-".$f[0];
    }
}

function enviaCorreo($destino,$titulo,$mensaje){
    $cabeceras = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	mail($destino, $titulo, $mensaje, $cabeceras);
}

function enviaIncidencia($destino,$titulo,$mensaje,$id){
    $filename= "Incidencia_".$id.".pdf";
    $file = chunk_split(base64_encode(file_get_contents("http://localhost/helpme/public/pdfs/incidencias/".$id.".pdf")));
    $uid = md5(uniqid(time()));   
    $cabeceras = "MIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"$uid\"\r\n\r\n";
    mail($destino, $titulo, "--$uid\r\nContent-type:text/html; charset=iso-8859-1\r\n\r\n\r\n $mensaje \r\n\r\n--$uid\r\nContent-Type: application/octet-stream; name=\"$filename\"\r\nContent-Transfer-Encoding: base64\r\nContent-Disposition: attachment; filename=\"$filename\"\r\n\r\n$file\r\n\r\n--$uid--", $cabeceras);
}

function imgBase64($path){
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    return '<img src="'.$base64.'" width="100" height="100" style="vertical-align:middle"/>';
}

function modal_pdf_ccd($id)
{
	return '<div id="Modal_'.$id.'" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Orden de Compra '.$id.'</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button> 
                    </div>
                    <div class="modal-body">
                        <embed id="visordoc" src="public/pdf_docs/'.$id.'.pdf" 
                        type="application/pdf" width="100%" height="400px"></embed>
                    </div>
					<div class="modal-footer">
                            <button type="button" class="btn btn-danger"
							data-toggle="modal" data-target="#Modal_rechazar">Rechazar</button>
							<button type="button" class="btn btn-success"
							data-toggle="modal" data-target="#Modal_aceptar">Aceptar</button>
                   </div>
                </div>
            </div>
        </div>';	
}
function descargarDoc333($idDoc)
{
    echo("<script>alert($id);</script>");
 // Ruta del directorio donde están los archivos
//$path  = 'http://192.168.1.191/coflex/public/pdf_docs/';
$id=$idDoc;

$fileName = "";
	   $fileExtension = "";
	   // Ruta del directorio donde están los archivos
$path  = '//192.168.1.191/coflex/public/pdf_docs/'; 
// Arreglo con todos los nombres de los archivos
$files = array_diff(scandir($path), array('.', '..')); 
foreach($files as $file){ 
 // Divides en dos el nombre de tu archivo utilizando el . 
 $data          = explode(".", $file);
 // Nombre del archivo
 $fileName      = $data[0];
 // Extensión del archivo 
 $fileExtension = $data[1];
 
 echo("<script>alert($id);</script>");
 if($fileName == $id){
	 
	 // Realizamos un break para que el ciclo se interrumpa
	 break;
 }
}

$rutaArchivo = 'http://192.168.1.191:81/coflex/public/pdf_docs/'.$fileName.'.'.$fileExtension;
//echo constant('URL');
# Obtener nombre sin ruta completa, únicamente para sugerirlo al guardar
$nombreArchivo = basename($rutaArchivo);
# Algunos encabezados que son justamente los que fuerzan la descarga
echo $rutaArchivo;


//echo("<script>window.location('$rutaArchivo', '_blank');</script>");

echo("<script>downloadFile($rutaArchivo);</script>");
}
?>