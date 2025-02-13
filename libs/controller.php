<?php

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

    function extraerXml($xmlFile)
    {
        $xml = simplexml_load_file($xmlFile);
        $namespaces = $xml->getNamespaces(true);
        $xml->registerXPathNamespace('tfd', $namespaces['tfd']);
        $timbre = $xml->xpath('//tfd:TimbreFiscalDigital')[0];
        if ($timbre) {
            $uuid = (string) $timbre['UUID'];
            return $uuid;
        } else {
            return "No se encontró el nodo TimbreFiscalDigital.";
        }
    }

    function extraerPdf($pdfFile)
    {
        $text = shell_exec("gs -sDEVICE=txtwrite -o - " . escapeshellarg($pdfFile));
        $pattern = '/[a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12}/i';
        if (preg_match($pattern, $text, $matches)) {
            return $matches[0];
        } else {
            return "No se encontró ninguna coincidencia.";
        }
    }

    function extraerPdfReferencia($pdfFile)
    {
        $text = shell_exec("gs -sDEVICE=txtwrite -o - " . escapeshellarg($pdfFile));

        $referencia = '/[a-zA-Z]{2}24\d{6}/';
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

        $pedimento = '/\b40\d{5}\b/';
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
        $textoSinGuion12 = '/\b\d{12}\b/';
        $referencia = '/\b\d{3}-[A-Za-z0-9]{8}\b/';

        if (preg_match($referencia, $text, $matches)) {
            // Mostrar el primer resultado (la cadena UUID)
            return $matches[0];
        } elseif (preg_match($textoSinGuion, $text, $matches)) {
            return $matches[0];
        } elseif (preg_match($textoSinGuion12, $text, $matches)) {
            return $matches[0];
        } else {
            return '';
        }
    }


    function processFiles($pdfFiles, $xmlFiles)
    {
        $fileData = [];
        $xmlUuids = [];
        $archivosSinCoincidencia = 0;

        foreach ($xmlFiles['tmp_name'] as $index => $xmlFileTmpName) {
            $uuid = $this->extraerXml($xmlFileTmpName);
            if ($uuid) {
                $xmlUuids[strtoupper($uuid)] = $xmlFiles['tmp_name'][$index];
            }
        }

        foreach ($pdfFiles['tmp_name'] as $index => $pdfFileTmpName) {
            $pdfUuid = $this->extraerPdf($pdfFileTmpName);
            $pedimento = $this->extraerPdfPedimento($pdfFileTmpName);
            $guiaM = $this->extraerPdfGuiaM($pdfFileTmpName);
            $referencia = $this->extraerPdfReferencia($pdfFileTmpName);
            if ($pdfUuid) {

                if (isset($xmlUuids[strtoupper($pdfUuid)])) {
                    $originalName = str_replace(' ', '-', $pdfFiles['name'][$index]);

                    $fileData[] = [
                        'uuid' => $pdfUuid,
                        'original_pdf' => $originalName,
                        'new_pdf' => "{$pdfUuid}.pdf",
                        'referencia' => $referencia,
                        'guiaM' => $guiaM,
                        'pedimento' => $pedimento

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
            $_SESSION['fileData'] = $fileData;
        }
    }
}
