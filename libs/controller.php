<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

class Controller
{

    public $view;

    function __construct()
    {
        $this->view = new View();
    }

    function loadModel($model)
    {
        $url = '(models/' . $model . 'model.php)';
        if (file_exists($url)) {
            require $url;
            $modelName = $model . 'Model';
            $this->model = new $modelName();
        }
    }

    //Funcion para elaborar el modal
    function modal($message, $id, $title)
    {
        ob_start();
?>
        <div class="modal" id="<?php echo htmlspecialchars($id); ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-bg-danger">
                        <h5 class="modal-title text-white text-uppercase"><?php echo htmlspecialchars($title); ?></h5>
                    </div>
                    <div class="modal-body">
                        <p><?php echo htmlspecialchars($message); ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php
        return ob_get_clean();
    }

    //Funcion para generar la tabla de las facturas
    function generarTabla($consulta, $data_found)
    {
        ob_start();
    ?>
        <div class="row d-flex pb-2">

            <div class="col-6 form-floating h-50 w-100">
                <select class="form-select form-select-sm w-50" id="selectSucursal" name="selectSucursal" required>
                    <option value="" selected></option>
                    <option value="MZO">MZO</option>
                    <option value="LTX">LTX</option>
                    <option value="MEX">MEX</option>
                    <option value="TOL">TOL</option>
                    <option value="APO">APO</option>
                    <option value="VER">VER</option>
                    <option value="MAZ">MAZ</option>
                    <option value="GT">GT</option>
                </select>
                <label for="selectSucursal" class="font-weight-bold">Selecciona una sucursal</label>
            </div>

        </div>


        <div id="mainSelectSucursal">

        </div>


        <table id="tablaRepPhi" name="tablaRepPhi" class="table table-responsive">
            <thead class="text-blue">
                <tr>
                    <th width=3%></th>
                    <th width=3%>PDF</th>
                    <th width=10%>UUID</th>
                    <th width=10%>Nombre</th>
                    <th width=10%>Nuevo Nombre</th>
                    <th>Referencia</th>
                    <th>Guia House</th>
                    <th>Guia Master</th>
                    <th>Pedimento</th>
                    <th>Contenedor</th>

                </tr>
            </thead>
            <tbody>
                <?php if ($data_found) {
                    foreach ($consulta as  $row) {
                        //Condicion para las que no se encuentran en el SAT , sis e cumple continua con el siguiente recorrido
                        if ($row['validacionXML'] == 'No Encontrado' && !$row['tiempoTimbrado']) {
                            continue;
                        }
                        //Condicion para que no genere las canceladas
                        if ($row['validacionXML'] != 'Cancelado') {
                ?>
                            <tr>
                                <th>
                                    <button class="btn btn-danger btn-sm eliminar-fila">
                                        -
                                    </button>
                                </th>
                                <th>
                                    <button class="btn btn-light btn-sm " onclick="mostrarPDF('<?php echo ($row['new_pdf']); ?>')">
                                        !
                                    </button>
                                </th>
                                <td><?php echo $row['uuid']; ?></td>
                                <td><?php echo $row['original_pdf']; ?></td>
                                <td><?php echo $row['new_pdf']; ?></td>
                                <td>
                                    <div class="position-relative">
                                        <input type="text" id="<?php echo $row['uuid']; ?>ref" class="form-control form-control-sm campo1"
                                            placeholder="Referencia" value="<?php echo $row['referencia']; ?>" oninput="validarReferencia('<?php echo $row['uuid']; ?>ref', 'RF')">
                                        <p class="invalid-feedback" style="position: absolute;">Referencia no existe en Darwin</p>
                                    </div>

                                </td>
                                <td>
                                    <div class="position-relative">
                                        <input type="text" class="form-control form-control-sm campo2"
                                            placeholder="GuiaHouse" id="<?php echo $row['uuid']; ?>gh" oninput="validarReferencia('<?php echo $row['uuid']; ?>gh', 'GH')">
                                        <p class="invalid-feedback" style="position: absolute;">GH no existe en Darwin</p>
                                    </div>

                                </td>
                                <td>
                                    <div class="position-relative">
                                        <input type="text" class="form-control form-control-sm campo3" placeholder="GuiaMaster"
                                            id="<?php echo $row['uuid']; ?>gm" value="<?php echo $row['guiaM'] ?>" oninput="validarReferencia('<?php echo $row['uuid']; ?>gm', 'GM')">
                                        <p class="invalid-feedback" style="position: absolute;">GM no existe en Darwin</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="position-relative">
                                        <input type="text" class="form-control form-control-sm campo4" placeholder="Pedimento"
                                            id="<?php echo $row['uuid']; ?>ped" value="<?php echo $row['pedimento'] ?>" oninput="validarReferencia('<?php echo $row['uuid']; ?>ped', 'PD')">
                                        <p class="invalid-feedback" style="position: absolute;">Pedimento no existe en Darwin</p>
                                    </div>

                                </td>
                                <td>
                                    <div class="position-relative">
                                        <input type="text" class="form-control form-control-sm campo5" placeholder="Contenedor"
                                            id="<?php echo $row['uuid']; ?>cont" oninput="validarReferencia('<?php echo $row['uuid']; ?>cont', 'CN')">
                                        <p class="invalid-feedback" style="position: absolute;">Contenedor no existe en Darwin</p>
                                    </div>

                                </td>

                            </tr>
                <?php
                        }
                    }
                }
                ?>
            </tbody>
        </table>
<?php
        return ob_get_clean();
    }

    function validarTiempoTimbrado($xmlFile)
    {

        $xml = simplexml_load_file($xmlFile);
        $namespaces = $xml->getNamespaces(true);
        $xml->registerXPathNamespace('tfd', $namespaces['tfd']);
        $timbre = $xml->xpath('//tfd:TimbreFiscalDigital')[0];
        $diaTimbrado = (string) $timbre['FechaTimbrado'];
        // Crear un objeto DateTime con la fecha proporcionada
        $fecha = new DateTime($diaTimbrado);

        // Fecha actual
        $fechaActual = new DateTime();

        // Calcular la diferencia en horas
        $diferencia = $fechaActual->getTimestamp() - $fecha->getTimestamp();
        $horas = $diferencia / 3600;



        // Verificar si han pasado 72 horas (3 días)
        return $horas <= 72;
    }

    //Extrae el uuid
    function extraerXml($xmlFile)
    {
        $xml = simplexml_load_file($xmlFile);
        $namespaces = $xml->getNamespaces(true);
        if (!isset($namespaces['tfd'])) return false;
        $xml->registerXPathNamespace('tfd', $namespaces['tfd']);
        $timbre = $xml->xpath('//tfd:TimbreFiscalDigital');

        if (isset($timbre[0])) {
            $uuid = (string) $timbre[0]['UUID'];
            return strtoupper($uuid);
        }

        return false;
    }

    function extraerRFCXml($xmlFile)
    {
        $xml = simplexml_load_file($xmlFile);
        $namespaces = $xml->getNamespaces(true);
        if (!isset($namespaces['cfdi'])) return false;
        $xml->registerXPathNamespace('cfdi', $namespaces['cfdi']);
        $xmlEmisor = $xml->xpath('//cfdi:Receptor')[0];

        if (isset($xmlEmisor[0])) {
            $emisor = (string) $xmlEmisor['Rfc'];
            return strtoupper($emisor);
        }

        return false;
    }

    function validarXML($xmlFile)
    {
        $xml = simplexml_load_file($xmlFile);
        $namespaces = $xml->getNamespaces(true);
        $xml->registerXPathNamespace('tfd', $namespaces['tfd']);
        $xml->registerXPathNamespace('cfdi', $namespaces['cfdi']);
        $timbre = $xml->xpath('//tfd:TimbreFiscalDigital')[0];
        $xmlEmisor = $xml->xpath('//cfdi:Emisor')[0];
        $xmlReceptor = $xml->xpath('//cfdi:Receptor')[0];
        $xmlTotal = $xml->xpath('//cfdi:Comprobante')[0];

        if ($timbre) {
            $uuid = (string) $timbre['UUID'];
            $emisor = (string) $xmlEmisor['Rfc'];
            $receptor = (string) $xmlReceptor['Rfc'];
            $total = (string) $xmlTotal['Total'];

            $client = new Client();

            // Definir la URL de la API
            $url = "http://172.20.20.59/satvalidacion/api/validacion";

            // Realizar la solicitud POST
            $response = $client->post($url, [
                'json' => [
                    'rfcEmisor' => $emisor,
                    'rfcReceptor' => $receptor,
                    'total' => $total,
                    'uuid' => $uuid,
                ]
            ]);

            // Obtener el cuerpo de la respuesta
            $body = $response->getBody()->getContents();
            $estado = json_decode($body, true);
            return $estado['estado'];
        } else {
            return "No se encontró el nodo TimbreFiscalDigital.";
        }
    }

    //Extrae el uuid 
    function extraerPdf($pdfFile)
    {
        $text = shell_exec("gs -sDEVICE=txtwrite -o - " . escapeshellarg($pdfFile));

        $pattern = '/[a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12}/i';
        if (preg_match($pattern, $text, $matches)) {
            return strtoupper($matches[0]);
        } else {
            return "No se encontró ninguna coincidencia.";
        }
    }

    function extraerPdfReferencia($pdfFile)
    {
        $text = shell_exec("gs -sDEVICE=txtwrite -o - " . escapeshellarg($pdfFile));

        $referencia = '/[a-zA-Z]{2}25\d{6}/';
        if (preg_match($referencia, $text, $matches)) {
            // Mostrar el primer resultado (la cadena UUID)
            return $matches[0];
        } else {
            return '';
        }
    }

    function extraerPdfPedimento($pdfFile)
    {
        $text = shell_exec("gs -sDEVICE=txtwrite -o - " . escapeshellarg($pdfFile));

        $pedimento = '/\b50\d{5}\b/';
        if (preg_match($pedimento, $text, $matches)) {
            // Mostrar el primer resultado (la cadena UUID)
            return $matches[0];
        } else {
            return '';
        }
    }

    function extraerPdfGuiaM($pdfFile)
    {
        $text = shell_exec("gs -sDEVICE=txtwrite -o - " . escapeshellarg($pdfFile));

        $textoSinGuion = '/\b\d{11}\b/';
        $referencia = '/\b\d{3}-[A-Za-z0-9]{8}\b/';

        if (preg_match($referencia, $text, $matches)) {
            // Si ya viene con guion, regresamos tal cual
            return $matches[0];
        } elseif (preg_match($textoSinGuion, $text, $matches)) {
            // Insertamos el guion después del tercer carácter
            return substr($matches[0], 0, 3) . '-' . substr($matches[0], 3);
        } else {
            return '';
        }
    }

    function processFiles($pdfFiles, $xmlFiles)
    {
        $fileData = [];
        $xmlUuids = [];
        $archivosSinCoincidencia = 0;

        ///Recorrido para almacenar los xml uuid
        foreach ($xmlFiles['tmp_name'] as $index => $xmlFileTmpName) {
            $uuid = $this->extraerXml($xmlFileTmpName);
            
            if ($uuid) {
                $xmlUuids[$uuid] = $xmlFiles['tmp_name'][$index];
            }
        }


        //Recorrido para extraer los datos del pdf
        foreach ($pdfFiles['tmp_name'] as $index => $pdfFileTmpName) {
            $pdfUuid = $this->extraerPdf($pdfFileTmpName);
            $pedimento = $this->extraerPdfPedimento($pdfFileTmpName);
            $guiaM = $this->extraerPdfGuiaM($pdfFileTmpName);
            $referencia = $this->extraerPdfReferencia($pdfFileTmpName);

           

            if ($pdfUuid) {

                if (isset($xmlUuids[$pdfUuid])) {
                    $validarXML = $this->validarXML($xmlUuids[$pdfUuid]);
                    $rfc = $this->extraerRFCXml($xmlUuids[$pdfUuid]);
                    $validarTimbrado = 1;
                    if ($validarXML == 'No Encontrado') {
                        $validarTimbrado = $this->validarTiempoTimbrado($xmlUuids[$pdfUuid]);
                    }
                    $originalName = str_replace(' ', '-', $pdfFiles['name'][$index]);

                    $fileData[] = [
                        'uuid' => $pdfUuid,
                        'original_pdf' => $originalName,
                        'new_pdf' => "{$pdfUuid}.pdf",
                        'referencia' => $referencia,
                        'guiaM' => $guiaM,
                        'pedimento' => $pedimento,
                        'validacionXML' => $validarXML,
                        'tiempoTimbrado' => $validarTimbrado,
                        'rfc' => $rfc
                    ];


                    //Mover el archivo PDF a la carpeta 'uploads'
                    $rutaDestino = './upload/' . "{$pdfUuid}.pdf";
                    if (!move_uploaded_file($pdfFileTmpName, $rutaDestino)) {
                        $results[] = "Error al mover el archivo PDF: {$pdfFiles['name'][$index]}";
                    }
                    $rutaXmlDestino = './upload/' . "{$pdfUuid}.xml";
                    if (!move_uploaded_file($xmlUuids[$pdfUuid], $rutaXmlDestino)) {
                        $results[] = "Error al mover el archivo XML: {$xmlFiles['name'][$index]}";
                    }
                } else {
                    $archivosSinCoincidencia++;
                }
            }

            $_SESSION['noEncontrados'] = $archivosSinCoincidencia;
        }

        return $fileData;
    }
}
