<?php

require_once 'models/onbaseModel.php';
require 'vendor/autoload.php';

// Usar los namespaces de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Onbase extends Controller
{

    function __construct()
    {
        parent::__construct();
        revisa_session();
        $this->view->pagina = "";
        $this->model = new OnbaseModel();
    }
    function renderMain()
    {
        $this->view->render('main/index');
    }

    public function cambioReferencia($parametros = null)
    {
        if ($parametros == null) {
            $parametros = '0/0';
        }

        $referencia = $parametros[0];
        $folio = $parametros[1];



        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Coloca los valores en las celdas A1 y B1
        $sheet->setCellValue('A1', 'Referencia');
        $sheet->setCellValue('A2', $referencia);
        $sheet->setCellValue('B1', 'Folio SAP');
        $sheet->setCellValue('B2', $folio);

        // Define la ruta donde se guardará el archivo
        $folder = 'C:\\xampp\\htdocs\\Ravisa\\upload\\';
        $fileName = 'CambioRef.xlsx';
        $filePath = $folder . $fileName;

        // Asegúrate de que la carpeta existe; si no, créala
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        // Guarda el archivo Excel en la ruta especificada
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);



        $this->view->pagina = "login/cambioReferencia";
        $this->view->render('login/cambioReferencia');
    }

    public function obtenerPermisosUsuario()
    {
        // if ($parametros == null) {
        //     $parametros = '0/0';
        // }

        // $usuario = $parametros[1];
        // $id = $parametros[0];
        // //
        // $permisos = $this->model->obtenerPermisosUsuario($usuario,$id);
        $permisos = $this->model->obtenerPermisosUsuario();



        $_SESSION['PERMISOS'] = $permisos;
    }

    public function administracionUser($parametros = null)
    {
        if ($parametros == null) {
            $parametros = '0/0/0/0/0/0';
        }

        $id = $parametros[0];
        $usuario = $parametros[1];
        $correo = $parametros[2];
        $contrasena = $parametros[3];
        $activo = $parametros[4];
        $tipo = $parametros[5];

        if ($tipo == 1) {
            $this->model->agregarUsuarios($id, $usuario, $correo, $contrasena, $activo, $tipo);
        }
        if ($tipo == 2) {
            $this->model->editarUsuarios($id, $usuario, $correo, $contrasena, $activo, $tipo);
        }
        if ($tipo == 3) {
            $this->model->agregarPermisos($id, $usuario, $correo, $contrasena, $activo);
        }


        $consultaUsuarios = $this->model->selectUsuarios();
        $this->view->consultaUsuarios = $consultaUsuarios;
        $permisos = $this->model->obtenerPermisosUsuario();
        $this->view->permisos = $permisos;

        $this->view->pagina = "onbase/administracion";
        $this->view->render('onbase/administracion');
    }


    public function operaciones_menu()
    {

        $this->view->pagina = "onbase/menu_operaciones";
        $this->view->render('onbase/menu_operaciones');
    }
    public function inicioSinCredenciales()
    {

        $this->view->pagina = "login/inicioSinCredenciales";
        $this->view->render('login/inicioSinCredenciales');
    }

    public function cargaTabla_EstatusFactura($parametros = null)
    {

        if ($parametros == null) {
            $parametros = '0/0/0/0';
        }

        $pedimento = $parametros[0];
        $patente = $parametros[1];
        $aduana = $parametros[2];
        $opcion = $parametros[3];

        


        $consulta = $this->model->consultaEstatusFactura($pedimento,$patente,$aduana,$opcion);
   

        $data_found = !empty($consulta);
    ?>
        <input type="hidden" id="data_found" value="<?php echo $data_found ? '1' : '0'; ?>">
        <input type="text" class="form-control pull-right" style="width:20%; margin-bottom: 0.6em;" id="searchRepPhi" name="searchRepPhi" placeholder="Buscador...">

        <table id="tablaRepPhi" name="tablaRepPhi" class="table table-responsive">
            <thead class="text-blue">
                <tr>
                    <th width=20% style="text-align:center">UUID</th>
                    <th width=10% style="text-align:center">Fecha Creacion</th>
                    <th width=10% style="text-align:center">Referencia</th>
                    <th width=5% style="text-align:center">Estatus</th>
                    <th width=5% style="text-align:center">Pedimento</th>
                    <th width=5% style="text-align:center">Patente</th>
                    <th width=5% style="text-align:center">Aduana</th>
                    <th width=5% style="text-align:center">URL</th>
                    <th width=5% style="text-align:center">PDF</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($data_found) {
                    foreach ($consulta as $row) { //INICIO DEL FOR    
                ?>
                        <tr>
                            <td style="text-align:center"><?php echo $row->UUID; ?></td>
                            <td style="text-align:center"><?php echo $row->FechaCreacion; ?></td>
                            <td style="text-align:center"><?php echo $row->Referencia; ?></td>
                            <td style="text-align:center;"><p style="background-color: #ff7113"><?php echo $row->Estatus; ?></p></td>
                            <td style="text-align:center"><?php echo $row->Pedimento; ?></td>
                            <td style="text-align:center"><?php echo $row->Patente; ?></td>
                            <td style="text-align:center"><?php echo $row->Aduana; ?></td>
                            
                            <td style="text-align:center">
                                <a href="<?php if ($row->DocumentoURL !== "NA") {echo $row->DocumentoURL; } ?>" target="_blank">
                                <?php if ($row->DocumentoURL !== "NA") {echo "URL"; } ?></a>
                            </td>
                            
                            <td style="text-align:center">    
                                <label class="btn-file-p "onclick="subirPdf('<?php echo $row->UUID; ?>')">
                                    <i class="fas fa-file-pdf"></i> PDF
                                    <input type="file" class="file-btn"  id=<?php echo $row->UUID; ?> accept=".pdf" >
                                </label>
                            </td>
                 
                        </tr>
                <?php } //FIN DEL FOR
                } ?>
            </tbody>
        </table>
        <?php

    }

    public function procesarFacturaPdf()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifica si el archivo fue cargado correctamente
            if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
                // Obtén información del archivo
                $archivoTemporal = $_FILES['archivo']['tmp_name'];
                
                $nombrePdf = trim($_POST['nombre']) .'.pdf';
                $mail = new PHPMailer(true);
                $mail->IsSMTP();
                $mail->Host = "smtp.office365.com";
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->SMTPAuth = true;
                
                $mail->Username = "onbaseprocesos@ravisa.com";  // Cambia a tu correo de Outlook
                $mail->Password = 'JeL8451.f';
                
                
                // Cambia a tu contraseña de Outlook
                
                
                $mail->Port = 587;  // Puerto SMTP

                $mail->From = "onbaseprocesos@ravisa.com";  // Tu correo de Outlook
                $mail->addAddress("onbaseauxiliar@ravisa.com");
                $mail->IsHTML(true);
                $mail->Body = 'Hola, aqui tienes el archivo PDF adjunto';
                $mail->AltBody = 'Hola, aqui tienes el archivo PDF adjunto';

                
                $mail->addAttachment($archivoTemporal, $nombrePdf);
                $mail->SMTPDebug = 2;
                $mail->Debugoutput = 'html';
                
                $mail->Send();
        
                
            }
    }
}

    public function facturas_nacionales()
    {

        $this->view->pagina = "onbase/op_sol_facturasNac";
        $this->view->render('onbase/op_sol_facturasNac');
    }
    public function cargaDeFacturas()
    {

        $this->view->pagina = "onbase/op_cargaFacturas";
        $this->view->render('onbase/op_cargaFacturas');
    }

    public function frame_facturasNacionales()
    {

        $this->view->pagina = "onbase/frames/frame_op_factNacionales";
        $this->view->render('onbase/frames/frame_op_factNacionales');
    }


    public function facturacionReportes()
    {
        $this->view->consulta_opcionesASG = 0;

        $this->view->pagina = "onbase/menu_facturacion";
        $this->view->render('onbase/menu_facturacion');
    }

    public function cheklist()
    {

        $this->view->pagina = "onbase/cheklist";
        $this->view->render('onbase/cheklist');
    }

    public function cargaTablaCheklist($parametros = null)
    {
        if ($parametros == null) {
            $parametros = '0/0/0';
        }

        $pedimento = $parametros[0];
        $patente = $parametros[1];
        $aduana = $parametros[2];

        $consultaIndicadores = $this->model->consultaCheklist($pedimento, $patente, $aduana);

        $data_found = !empty($consultaIndicadores);
?>
        <input type="hidden" id="data_found" value="<?php echo $data_found ? '1' : '0'; ?>">
        <input type="text" class="form-control pull-right" style="width:20%; margin-bottom: 0.6em;" id="searchRepPhi" name="searchRepPhi" placeholder="Buscador...">

        <table id="tablaRepPhi" name="tablaRepPhi" class="table table-responsive">
            <thead class="text-blue">
                <tr>
                    <th width=10% style="text-align:left">Id</th>
                    <th width=15% style="text-align:left">FechaCreacion</th>
                    <th width=10% style="text-align:left">Pedimento</th>
                    <th width=10% style="text-align:left">Patente</th>
                    <th width=5% style="text-align:left">Aduana</th>
                    <th width=10% style="text-align:left">Referencia</th>
                    <th width=15% style="text-align:left">Estatus Flujo</th>
                    <th width=15% style="text-align:left">Checklist OnBase</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($data_found) {
                    foreach ($consultaIndicadores as $row) { //INICIO DEL FOR    
                ?>
                        <tr>
                            <td><?php echo $row->IdOB; ?></td>
                            <td><?php echo $row->FechaCreacion; ?></td>
                            <td><?php echo $row->Pedimento; ?></td>
                            <td><?php echo $row->Patente; ?></td>
                            <td><?php echo $row->Aduana; ?></td>
                            <td><?php echo $row->Referencia; ?></td>
                            <td><?php echo $row->EstatusActual; ?></td>
                            <td>
                                <a class="btn btn-link" href="<?php echo $row->DocumentoURL; ?>" target="_blank">Ir a Formulario</a>
                            </td>


                        </tr>
                <?php } //FIN DEL FOR
                } ?>
            </tbody>
        </table>
    <?php
    }

    public function cargaExcelCheklist($parametros = null)
    {


        if (isset($_POST['XmlDatos'])) {
            $xml = $_POST['XmlDatos'];
        }


        $consultaIndicadores = $this->model->consultaExcelCheklist($xml);



        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Convertir stdClass a array
        if (!empty($consultaIndicadores)) {
            $firstRow = (array) $consultaIndicadores[0];
            $columnIndex = 'A';
            foreach (array_keys($firstRow) as $column) {
                $sheet->setCellValue($columnIndex . '1', $column);
                $columnIndex++;
            }
        }

        // Set row data
        $rowIndex = 2;
        foreach ($consultaIndicadores as $row) {
            $columnIndex = 'A';
            foreach ((array) $row as $cell) {
                $sheet->setCellValue($columnIndex . $rowIndex, $cell);
                $columnIndex++;
            }
            $rowIndex++;
        }

        $writer = new Xlsx($spreadsheet);
        //$fileName = 'data_export_' . date('Y-m-d_H-i-s') . '.xlsx';

        if (ob_get_length()) ob_clean();

        // Set headers to trigger download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');


        // Save the file to output
        $writer->save('php://output');
        exit;
    }




    public function reporteClientes()
    {

        $selectClientes = $this->model->selectClientes();
        // print_r($selectClientes);
        $this->view->selectClientes = $selectClientes;
        $this->view->pagina = "onbase/reporteClientes";
        $this->view->render('onbase/reporteClientes');
    }

    public function op_buscarFactura()
    {
        $selectClientes = $this->model->selectClientes();
        $this->view->selectClientes = $selectClientes;

        $selectProveedor = $this->model->selectProveedor();
        $this->view->selectProveedor = $selectProveedor;

        $this->view->pagina = "onbase/op_buscarFactura";
        $this->view->render('onbase/op_buscarFactura');
    }

    public function reporteOnbase()
    {
        $this->view->pagina = "onbase/fact_reporteOnbase";
        $this->view->render('onbase/fact_reporteOnbase');
    }
    public function cargaTabla_ReporteOnbase($parametros = null)
    {

        if ($parametros == null) {
            $parametros = '0/0';
        }
        $fechaInicio = $parametros[0];
        $fechaFin = $parametros[1];


        $consultaIndicadores = $this->model->reporteOnbaseLimitado($fechaInicio, $fechaFin);
        $consulta = $this->model->reporteOnbase($fechaInicio, $fechaFin);


        $_SESSION['consultaIndicadoresOnbase'] = $consulta;

        $data_found = !empty($consultaIndicadores);
    ?>
        <input type="hidden" id="data_found" value="<?php echo $data_found ? '1' : '0'; ?>">
        <input type="text" class="form-control pull-right" style="width:20%; margin-bottom: 0.6em;" id="searchRepPhi" name="searchRepPhi" placeholder="Buscador...">

        <table id="tablaRepPhi" name="tablaRepPhi" class="table table-responsive">
            <thead class="text-blue">
                <tr>
                    <th width=30% style="text-align:left">Fecha Creacion</th>
                    <th width=10% style="text-align:left">Estatus</th>
                    <th width=15% style="text-align:left">ID Documento</th>
                    <th width=5% style="text-align:left">Pedimento</th>
                    <th width=5% style="text-align:left">Patente</th>
                    <th width=5% style="text-align:left">Aduana</th>
                    <th width=15% style="text-align:left">Referencia</th>
                    <th width=5% style="text-align:left">Remesa</th>
                    <th width=10% style="text-align:left">Cliente</th>
                    <th width=10% style="text-align:left">Numero Cliente</th>
                    <th width=5% style="text-align:left">Clave de Pedimento</th>
                    <th width=5% style="text-align:left">Segunda Facturacion</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($data_found) {
                    foreach ($consultaIndicadores as $row) { //INICIO DEL FOR    
                ?>
                        <tr>
                            <td><?php echo $row->FechaCreacion; ?></td>
                            <td><?php echo $row->Estatus; ?></td>
                            <td><?php echo $row->IDDocumento; ?></td>
                            <td><?php echo $row->Pedimento; ?></td>
                            <td><?php echo $row->Patente; ?></td>
                            <td><?php echo $row->Aduana; ?></td>
                            <td><?php echo $row->Referencia; ?></td>
                            <td><?php echo $row->Remesa; ?></td>
                            <td><?php echo $row->Cliente; ?></td>
                            <td><?php echo $row->NumeroCliente; ?></td>
                            <td><?php echo $row->ClavePedimento; ?></td>
                            <td><?php echo $row->SegundaFacturacion; ?></td>
                        </tr>
                <?php } //FIN DEL FOR
                } ?>
            </tbody>
        </table>
    <?php

    }

    public function cargaTabla_ReporteOnbaseCL($parametros = null)
    {

        if ($parametros == null) {
            $parametros = '0/0';
        }
        $fechaInicio = $parametros[0];
        $fechaFin = $parametros[1];


        $consulta = $this->model->reporteOnbaseCL($fechaInicio, $fechaFin);
        $consultaIndicadores = $this->model->reporteOnbaseCLimitado($fechaInicio, $fechaFin);
        $_SESSION['consultaIndicadoresOnbaseCL'] = $consulta;

        $data_found = !empty($consultaIndicadores);
    ?>
        <input type="hidden" id="data_found" value="<?php echo $data_found ? '1' : '0'; ?>">
        <input type="text" class="form-control pull-right" style="width:20%; margin-bottom: 0.6em;" id="searchRepPhi" name="searchRepPhi" placeholder="Buscador...">

        <table id="tablaRepPhi" name="tablaRepPhi" class="table table-responsive">
            <thead class="text-blue">
                <tr>
                    <th width=3% style="text-align:left">Aduana</th>
                    <th width=5% style="text-align:left">Pedimento</th>
                    <th width=3% style="text-align:left">Patente</th>
                    <th width=10% style="text-align:left">Referencia</th>
                    <th width=5% style="text-align:left">Estatus</th>
                    <th width=40% style="text-align:left">Fecha Creacion</th>
                    <th width=30% style="text-align:left">Fecha Rechazo</th>
                    <th width=30% style="text-align:left">Fecha Modificacion</th>
                    <th width=30% style="text-align:left">Fecha Aceptacion</th>
                    <th width=3% style="text-align:left">Tipo Operacion</th>
                    <th width=5% style="text-align:left">ItemNum Checklist</th>
                    <th width=5% style="text-align:left">ItemNum Factura</th>
                    <th width=10% style="text-align:left">UUIDFactura</th>
                    <th width=3% style="text-align:left">Segunda Facturacion</th>
                    <th width=3% style="text-align:left">MotivoSF</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($data_found) {
                    foreach ($consultaIndicadores as $row) { //INICIO DEL FOR    
                ?>
                        <tr>
                            <td><?php echo $row->Aduana; ?></td>
                            <td><?php echo $row->Pedimento; ?></td>
                            <td><?php echo $row->Patente; ?></td>
                            <td><?php echo $row->Referencia; ?></td>
                            <td><?php echo $row->Estatus; ?></td>
                            <td><?php echo $row->FechaCreacion; ?></td>
                            <td><?php echo $row->FechaRechazo; ?></td>
                            <td><?php echo $row->FechaModificacion; ?></td>
                            <td><?php echo $row->FechaAceptacion; ?></td>
                            <td><?php echo $row->TipoOperacion; ?></td>
                            <td><?php echo $row->ItemNumChecklist; ?></td>
                            <td><?php echo $row->ItemNumFactura; ?></td>
                            <td><?php echo $row->UUIDFactura; ?></td>
                            <td><?php echo $row->SegundaFacturacion; ?></td>
                            <td><?php echo $row->MotivoSF; ?></td>
                        </tr>
                <?php } //FIN DEL FOR
                } ?>
            </tbody>
        </table>
        <?php

    }


    public function cargaReporteExcelOnbase($parametros = null)
    {

        $consulta = $_SESSION['consultaIndicadoresOnbase'] ?? [];

        if (empty($consulta)) {
            exit('No hay datos disponibles para exportar.');
        }

        if (ob_get_length()) {
            ob_clean();
        }

        $output = fopen('php://output', 'w');

        // Headers to force download as CSV
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="ReporteOB.csv"');
        header('Cache-Control: max-age=0');

        // Add headers (column names) from the first row of data
        if (!empty($consulta)) {
            $firstRow = (array) $consulta[0];
            fputcsv($output, array_keys($firstRow));
        }

        // Add data rows
        foreach ($consulta as $row) {
            fputcsv($output, (array) $row); // Write each row to CSV
        }

        fclose($output);
        exit;
    }


    public function cargaReporteExcelOnbaseCL($parametros = null)
    {

        $consulta = $_SESSION['consultaIndicadoresOnbaseCL'] ?? [];

        if (empty($consulta)) {
            exit('No hay datos disponibles para exportar.');
        }

        if (ob_get_length()) {
            ob_clean();
        }

        $output = fopen('php://output', 'w');

        // Headers to force download as CSV
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="ReporteCL.csv"');
        header('Cache-Control: max-age=0');

        // Add headers (column names) from the first row of data
        if (!empty($consulta)) {
            $firstRow = (array) $consulta[0];
            fputcsv($output, array_keys($firstRow)); // Write headers to CSV
        }

        // Add data rows
        foreach ($consulta as $row) {
            fputcsv($output, (array) $row); // Write each row to CSV
        }

        fclose($output);
        exit;
    }



    public function procesarArchivos()
    {
        if (isset($_FILES['pdf']) && isset($_FILES['xml'])) {
            $this->processFiles($_FILES['pdf'], $_FILES['xml']); // Llama a la función que procesa los archivos
            $consulta = $_SESSION['fileData'];
            $dont_found = $_SESSION['noEncontrados'];

            $data_found = !empty($consulta);
        ?>
            <input type="hidden" id="data_found" value="<?php echo $data_found ? '1' : '0'; ?>">
            <input type="hidden" id="dont_found" value="<?php echo ($dont_found > 0) ? '1' : '0'; ?>">
            <div id="mainSelectSucursal">
                <label for="selectSucursal">Sucursal:</label>
                <select aria-label="Sucursal" style=" padding:0.2rem; font-weight:600 " id="selectSucursal" name="selectSucursal" required>
                    <option value="" hidden>Selecciona una opción</option>
                    <option value="MZO">MZO</option>
                    <option value="LTX">LTX</option>
                    <option value="MEX">MEX</option>
                    <option value="TOL">TOL</option>
                    <option value="APO">APO</option>
                    <option value="VER">VER</option>

                </select>
                <input type="text" class="form-control pull-right" style="width:20%; margin-bottom: 0.6em;" id="searchRepPhi" name="searchRepPhi" placeholder="Buscador...">
            </div>


            <table id="tablaRepPhi" name="tablaRepPhi" class="table table-responsive">
                <thead class="text-blue">
                    <tr>
                        <th width=3% style="text-align:left">UUID</th>
                        <th width=3% style="text-align:left">Nombre</th>
                        <th width=5% style="text-align:left">Nuevo Nombre</th>
                        <th width=3% style="text-align:left">Referencia</th>
                        <th width=3% style="text-align:left">Guia House</th>
                        <th width=3% style="text-align:left">Guia Master</th>
                        <th width=3% style="text-align:left">Pedimento</th>
                        <th width=3% style="text-align:left">Contenedor</th>

                    </tr>
                </thead>
                <tbody>
                    <?php if ($data_found) {
                        foreach ($consulta as  $row) { //INICIO DEL FOR    
                    ?>
                            <tr>
                                <td><?php echo $row['uuid']; ?></td>
                                <td><?php echo $row['original_pdf']; ?></td>
                                <td><?php echo $row['new_pdf']; ?></td>
                                <td><input type="text" class="campo1" placeholder="Referencia" value=<?php echo $row['referencia'] ?>></td>
                                <td><input type="text" class="campo2" placeholder="GuiaHouse"></td>
                                <td><input type="text" class="campo3" placeholder="GuiaMaster" value=<?php echo $row['guiaM'] ?>></td>
                                <td><input type="text" class="campo4" placeholder="Pedimento" value=<?php echo $row['pedimento'] ?>></td>
                                <td><input type="text" class="campo5" placeholder="Contenedor"></td>

                            </tr>
                    <?php } //FIN DEL FOR
                    } ?>
                </tbody>
            </table>
        <?php

        } else {
            return "Error: No se recibieron los archivos PDF y XML."; // Maneja el caso en que los archivos no estén disponibles
        }
    }

    public function moverArchivos($parametros = null)
    {
        if ($parametros == null) {
            $parametros = '0/0/0/0/0/0/0/0/0';
        }

        $select = $parametros[0];
        $uuid = $parametros[1];
        $nombre = $parametros[2];
        $nuevoNombre = $parametros[3];
        $referencia = ($parametros[4] !== 'NULL') ? $parametros[4] : null;
        $pedimento = ($parametros[5] !== 'NULL') ? $parametros[5] : null;
        $guiaH = ($parametros[6] !== 'NULL') ? $parametros[6] : null;
        $guiaM = ($parametros[7] !== 'NULL') ? $parametros[7] : null;
        $contenedor = ($parametros[8] !== 'NULL') ? $parametros[8] : null;

        error_log("UUID: $uuid, Nombre: $nombre, NuevoNombre: $nuevoNombre, Referencia: $referencia, Pedimento: $pedimento, GuiaH: $guiaH, GuiaM: $guiaM, Contenedor: $contenedor, Select: $select");

        $this->model->insertaFacturasPortal($uuid, $nombre, $nuevoNombre, $referencia, $pedimento, $guiaH, $guiaM, $contenedor, $select);

        //Nombre para el archivo XML
        $nuevoNombreXML = $uuid . '.xml';

        //rutas de pdf
        $rutaFinal = '\\\\SRVAPP\\Facturas Web\\' . $nuevoNombre;
        $rutaTemporal = './upload/' . $nuevoNombre;
        //rutas xml
        $rutaXML = './upload/' . $nuevoNombreXML;
        $rutaFinalXML = '\\\\SRVAPP\\Facturas Web\\' . $nuevoNombreXML;

        if (file_exists($rutaTemporal)) {

            $exists = copy($rutaTemporal, $rutaFinal);
            $existsXML = copy($rutaXML, $rutaFinalXML);

            if ($exists && $existsXML) {
                // Si la copia fue exitosa, eliminamos el archivo original
                unlink($rutaTemporal);
                unlink($rutaXML);
            } else {
                throw new Exception('Failed to copy file to ' . $rutaFinal);
            }
        }



        unset($_SESSION['fileData']);
    }



    public function cargaTabla_ReporteStatusFactura($parametros = null)
    {

        if ($parametros == null) {
            $parametros = '0/0/0';
        }

        $fechaInicio = $parametros[0];
        $fechaFin = $parametros[1];
        $clientes = $parametros[2];
        $tipo = $parametros[3];

        $consultaIndicadores = $this->model->consulta_ReporteStatusF($fechaInicio, $fechaFin, $clientes, $tipo);
        $_SESSION['consultaIndicadores'] = $consultaIndicadores;

        $data_found = !empty($consultaIndicadores);
        ?>


        <!--  BUSCADOR POR JQUERY    -->
        <input type="hidden" id="data_found" value="<?php echo $data_found ? '1' : '0'; ?>">
        <input type="text" class="form-control pull-right" style="width:20%; margin-bottom: 0.6em;" id="searchRepPhi" name="searchRepPhi" placeholder="Buscador...">

        <table id="tablaRepPhi" name="tablaRepPhi" class="table table-responsive">
            <thead class="text-blue">
                <tr>
                    <th width=30% style="text-align:left">Folio</th>
                    <th width=10% style="text-align:left">Referencia</th>
                    <th width=5% style="text-align:left">Pedimento</th>
                    <th width=5% style="text-align:left">Aduana</th>
                    <th width=5% style="text-align:left">Proveedor</th>
                    <th width=15% style="text-align:left">Fecha</th>
                    <th width=10% style="text-align:left">Cliente</th>
                    <th width=10% style="text-align:left">Total</th>
                    <th width=5% style="text-align:left">Estatus</th>
                    <th width=5% style="text-align:left">NumCliente</th>

                </tr>
            </thead>
            <tbody>
                <?php if ($data_found) {
                    foreach ($consultaIndicadores as $row) { //INICIO DEL FOR    
                ?>
                        <tr>
                            <td><?php echo $row->FolioFiscal; ?></td>
                            <td><?php echo $row->Referencia; ?></td>
                            <td><?php echo $row->Pedimento; ?></td>
                            <td><?php echo $row->Aduana; ?></td>
                            <td><?php echo $row->CodigoProveedor; ?></td>
                            <td><?php echo $row->FechaValidacionYExtraccion; ?></td>
                            <td><?php echo $row->ClienteOP; ?></td>
                            <td><?php echo $row->Total; ?></td>
                            <td><?php echo $row->Estatus; ?></td>
                            <td><?php echo $row->NumCliente; ?></td>
                        </tr>
                <?php } //FIN DEL FOR
                } ?>
            </tbody>
        </table>
    <?php
    }

    public function cargaTabla_ReportePhilips($parametros = null)
    {

        if ($parametros == null) {
            $parametros = '0/0/0';
        }
        $fechaInicio = $parametros[0];
        $fechaFin = $parametros[1];
        $clientes = !empty($parametros[2]) ? $parametros[2]  : '';


        $consultaIndicadores = $this->model->consulta_Facturacion($fechaInicio, $fechaFin, $clientes);
        $_SESSION['consultaIndicadores'] = $consultaIndicadores;

        $data_found = !empty($consultaIndicadores);
    ?>


        <!--  BUSCADOR POR JQUERY    -->
        <input type="hidden" id="data_found" value="<?php echo $data_found ? '1' : '0'; ?>">
        <input type="text" class="form-control pull-right" style="width:20%; margin-bottom: 0.6em;" id="searchRepPhi" name="searchRepPhi" placeholder="Buscador...">

        <table id="tablaRepPhi" name="tablaRepPhi" class="table table-responsive">
            <thead class="text-blue">
                <tr>
                    <th width=30% style="text-align:left">Folio</th>
                    <th width=10% style="text-align:left">Referencia</th>
                    <th width=15% style="text-align:left">Fecha</th>
                    <th width=5% style="text-align:left">Pedimento</th>
                    <th width=5% style="text-align:left">Patente</th>
                    <th width=5% style="text-align:left">Aduana</th>
                    <th width=15% style="text-align:left">Cliente</th>
                    <th width=5% style="text-align:left">#Cliente</th>
                    <th width=5% style="text-align:left">EmisorNombre</th>
                    <th width=10% style="text-align:left">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($data_found) {
                    foreach ($consultaIndicadores as $row) { //INICIO DEL FOR    
                ?>
                        <tr>
                            <td><?php echo $row->FolioFiscal; ?></td>
                            <td><?php echo $row->REFERENCIA; ?></td>
                            <td><?php echo $row->FechaIngresada; ?></td>
                            <td><?php echo $row->Pedimento; ?></td>
                            <td><?php echo $row->Patente; ?></td>
                            <td><?php echo $row->Aduana; ?></td>
                            <td><?php echo $row->ClienteOP; ?></td>
                            <td><?php echo $row->NumCliente; ?></td>
                            <td><?php echo $row->EmisorNombre; ?></td>
                            <td><?php echo $row->Total; ?></td>
                        </tr>
                <?php } //FIN DEL FOR
                } ?>
            </tbody>
        </table>
<?php
    }





    public function cargaReporteExcel($parametros = null)
    {

        $consultaIndicadores = $_SESSION['consultaIndicadores'] ?? [];
        if (empty($consultaIndicadores)) {
            // Manejar el caso en el que no hay datos en la sesión
            exit('No hay datos disponibles para exportar.');
        }
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Convertir stdClass a array
        if (!empty($consultaIndicadores)) {
            $firstRow = (array) $consultaIndicadores[0];
            $columnIndex = 'A';
            foreach (array_keys($firstRow) as $column) {
                $sheet->setCellValue($columnIndex . '1', $column);
                $columnIndex++;
            }
        }

        // Set row data
        $rowIndex = 2;
        foreach ($consultaIndicadores as $row) {
            $columnIndex = 'A';
            foreach ((array) $row as $cell) {
                $sheet->setCellValue($columnIndex . $rowIndex, $cell);
                $columnIndex++;
            }
            $rowIndex++;
        }

        $writer = new Xlsx($spreadsheet);
        //$fileName = 'data_export_' . date('Y-m-d_H-i-s') . '.xlsx';

        if (ob_get_length()) ob_clean();

        // Set headers to trigger download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');


        // Save the file to output
        $writer->save('php://output');
        exit;
    }
}
?>





<script>
    // BUSCADOR POR FILTRO TABLA DINAMICA 

    // Write on keyup event of keyword input element
    $(document).ready(function() {
        $("#searchRepPhi").keyup(function() {
            _this = this;
            // Show only matching TR, hide rest of them
            $.each($("#tablaRepPhi tbody tr"), function() {
                if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                    $(this).hide();
                else
                    $(this).show();
            });
        });



    });
</script>