<?php

require_once 'models/onbaseModel.php';
require 'vendor/autoload.php';

// Usar los namespaces de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Row;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use function PHPSTORM_META\map;

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
            $parametros = '0/0/0/0/0/0/0';
        }

        $id = $parametros[0];
        $usuario = $parametros[1];
        $correo = $parametros[2];
        $contrasena = $parametros[3];
        $activo = $parametros[4];
        $sucursal = $parametros[5];
        $tipo = $parametros[6];

        if ($tipo == 1) {
            $this->model->agregarUsuarios($id, $usuario, $correo, $contrasena, 1, $sucursal, $tipo);
        }
        if ($tipo == 2) {
            $this->model->editarUsuarios($id, $usuario, $correo, $contrasena, $activo, $sucursal, $tipo);
        }
        if ($sucursal == 3) {
            $this->model->agregarPermisos($id, $usuario, $correo, $contrasena, $activo);
        }
        if ($id == 0) {
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

    public function menuAdministracion()
    {

        $this->view->pagina = "onbase/menuAdministracion";
        $this->view->render('onbase/menuAdministracion');
    }

    public function administracionCorreos()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $datos = [
                'id' => $_POST['id'] ?? null,
                'codigo' => $_POST['codigosn'] ?? null,
                'nombreSocio' => $_POST['nombresocionegocios'] ?? null,
                'usuario' => $_POST['nombre'] ?? null,
                'direccion' => $_POST['direccion'] ?? null,
                'puesto' => $_POST['puesto'] ?? null,
                'funcion' => $_POST['funcion'] ?? null,
                'correo' => $_POST['correo'] ?? null,
                'supervisor' => $_POST['supervisor'] ?? null,
                'supervisorCorreo' => $_POST['supervisorcorreo'] ?? null,
                'nl' => isset($_POST['nuevolaredo']) ? 1 : 0,
                'maz' => isset($_POST['mazatlan']) ? 1 : 0,
                'mx' => isset($_POST['mexico']) ? 1 : 0,
                'mzo' => isset($_POST['manzanillo']) ? 1 : 0,
                'mty' => isset($_POST['monterrey']) ? 1 : 0,
                'vr' => isset($_POST['veracruz']) ? 1 : 0,
                'tol' => isset($_POST['toluca']) ? 1 : 0,
                'slp' => isset($_POST['sanluispotosi']) ? 1 : 0,
                'coa' => isset($_POST['coatzacoalcos']) ? 1 : 0,
                'tipo' => $_POST['tipo'] ?? null
            ];

            error_log(print_r($datos), true);

            $this->model->agregarUsuarioDetalle($datos);
        }

        $consultaUsuarios = $this->model->selectUserAdminCorreo();

        $this->view->consultaUsuarios = $consultaUsuarios;
        $this->view->pagina = "onbase/administracionCorreos";
        $this->view->render('onbase/administracionCorreos');
    }

    public function validarUsuarioDetalle($parametros = null)
    {
        if ($parametros == null) {
            $parametros = '0/0/';
        }

        $id = $parametros[0];
        $correo = $parametros[1];


        $consultaUsuarios = $this->model->validarDatosUsuarioDetalle($id, $correo);

        header('Content-Type: application/json');
        echo json_encode($consultaUsuarios);
        exit;
    }

    public function administracionGerentes()
    {
        $usuariosSucursal = [];
        $resultados = [];
        $sucursalUsuario = [];
        $sucursales = [
            "MEX" => "Mexico",
            "LTX" => "NuevoLaredo",
            "MZO" => "Manzanillo",
            "TOL" => "Toluca",
            "COA" => "Coatzacoalcos",
            "MAZ" => "Mazatlan",
            "MTY" => "Monterrey",
            "SLP" => "San Luis Potosi",
            "APO" => "Apodaca",
            "VER" => "Veracruz"
        ];
        $consultaDatosUsuario = $this->model->validaSucursalGerente($_SESSION['usuario']);
        foreach ($consultaDatosUsuario[0] as $key => $value) {
            if ($value === "1" && $key != "Activo") {
                $usuariosSucursal[] = $key;
            }
        }

        // $sucursal = $consultaIndicadores[0]->Sucursal;
        foreach ($usuariosSucursal as $sucursal) {
            $sucursalUsuario[$sucursal] = $sucursales[$sucursal];
            $resultado = $this->model->usuariosSucursal($sucursal);
            if ($resultado) {
                $resultados[] = $resultado;
            }
        }


        $this->view->resultados = $resultados;
        $this->view->sucursalUsuario = $sucursalUsuario;
        $this->view->pagina = "onbase/administracionGerentes";
        $this->view->render('onbase/administracionGerentes');
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




        $consulta = $this->model->consultaEstatusFactura($pedimento, $patente, $aduana, $opcion);


        $data_found = !empty($consulta);
?>
        <input type="hidden" id="data_found" value="<?php echo $data_found ? '1' : '0'; ?>">
        <input type="text" class="form-control pull-right" style="width:20%; margin-bottom: 0.6em;" id="searchRepPhi" name="searchRepPhi" placeholder="Buscador...">

        <table id="tablaRepPhi" name="tablaRepPhi" class="table table-responsive">
            <thead class="text-blue">
                <tr>
                    <th width=20% style="text-align:center">UUID</th>
                    <th width=5% style="text-align:center">Fecha Creacion</th>
                    <th width=5% style="text-align:center">Referencia</th>
                    <th width=5% style="text-align:center">Estatus</th>
                    <th width=20% style="text-align:center">Cliente</th>
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
                            <td style="text-align:center;">
                                <p style="background-color: #ff7113"><?php echo $row->Estatus; ?></p>
                            </td>
                            <td style="text-align:center"><?php echo $row->ClienteOP; ?></td>
                            <td style="text-align:center"><?php echo $row->Pedimento; ?></td>
                            <td style="text-align:center"><?php echo $row->Patente; ?></td>
                            <td style="text-align:center"><?php echo $row->Aduana; ?></td>

                            <td style="text-align:center">
                                <a href="<?php if ($row->DocumentoURL !== "NA") {
                                                echo $row->DocumentoURL;
                                            } ?>" target="_blank">
                                    <?php if ($row->DocumentoURL !== "NA") {
                                        echo "URL";
                                    } ?></a>
                            </td>

                            <!-- <td style="text-align:center">    
                                <label class="btn-file-p "onclick="subirPdf('<?php echo $row->UUID; ?>')">
                                    <i class="fas fa-file-pdf"></i> PDF
                                    <input type="file" class="file-btn"  id=<?php echo $row->UUID; ?> accept=".pdf" >
                                </label>
                            </td> -->

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

                $nombrePdf = trim($_POST['nombre']) . '.pdf';
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


    //Las funciones tanto como de procesarArvhivos y mover vienen deL archivo libs/controller
    public function procesarArchivos()
    {
        if (isset($_FILES['pdf']) && isset($_FILES['xml'])) {
            $consulta = $this->processFiles($_FILES['pdf'], $_FILES['xml']); // Llama a la función que procesa los archivos

            $dont_found = $_SESSION['noEncontrados'];
            $data_found = !empty($consulta);
            //arreglo para almacenar los modales
            $modales = [];
            //Arreglo para almacenar todos los uuids
            $uuids = [];
            //Arreglo para almacenar los uuid cancelados etc...
            $uuidError = [];
            $rfc=[];
            //Recorrido para encontrar las facturas que no esten en el portal SAT
            foreach ($consulta as $row) {

                $uuids[] = $row['uuid'];
                
                if (!$row['tiempoTimbrado'] && $row['validacionXML'] == 'No Encontrado') {
                    $modales[] = $this->modal("La factura " . $row['original_pdf'] .
                        " ya paso de 72h y no se encuentra en el portal SAT", $row['uuid'], "Factura no timbrada");
                    $uuidError[] = $row['uuid'];
                    unlink('./upload/' . $row['new_pdf']);
                    unlink('./upload/' . $row['uuid'] . '.xml');
                }
            }

            //Recorrido para encontrar las facturas canceladas
            foreach ($consulta as $row) {
                if ($row['validacionXML'] == 'Cancelado') {
                    $modales[] = $this->modal("La factura " . $row['original_pdf'] . " esta cancelada", $row['uuid'], "Factura cancelada");
                    $uuidError[] = $row['uuid'];
                    unlink('./upload/' . $row['new_pdf']);
                    unlink('./upload/' . $row['uuid'] . '.xml');
                }
            }

            //funcion para generar la tabla de las facturas
            $tablaHTML = $this->generarTabla($consulta, $data_found);

            //Datos que retorna el controlador a la vista
            echo json_encode([
                'modal' => implode('', $modales),  // Combina todos los modales en un solo string
                'tabla' => $tablaHTML,
                'noEncontrados' => $dont_found,
                'data' => $data_found,
                'uuidError' => $uuidError,
                'uuids' => $uuids,
                'rfc' => $rfc
            ]);
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
        $correo = "";


        //Manda los datos hacia el modelo y retorna el mensaje del SP
        $message = $this->model->insertaFacturasPortal($uuid, $nombre, $nuevoNombre, $referencia, $pedimento, $guiaH, $guiaM, $contenedor, $select, $correo);

        //Retorna el mensaje hacia la vista
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'message' => $message['Mensaje'],
            'tipo' => $message['Tipo']
        ]);

        if ($message['Tipo'] == 2) {
            unlink('./upload/' . $nuevoNombre);
            unlink('./upload/' . $uuid . '.xml');
            exit;
        }


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

    public function validarReferencia($parametros = null)
    {
        if ($parametros == null) {
            $parametros = '0/0/';
        }

        $referencia = $parametros[0];
        $clave = $parametros[1];

        $query = $this->model->validaReferenciaModel($referencia, $clave);

        echo json_encode($query[0]);
    }

    public function buscarFacturaOnBase()
    {
        $uuid = $_POST['uuid'];
        error_log($uuid);

        $query = $this->model->buscarFacturaOB($uuid);

        if (!is_array($query) || count($query) === 0) {
            echo json_encode([
                'error' => true,
                'mensaje' => 'La Factura no se encuentra en OnBase'
            ]);
            return;
        }

        echo json_encode([
            'error' => false,
            'consulta' => $query[0]
        ]);
    }

    public function borrarFacturas()
    {

        if (isset($_POST['uuid'])) {
            foreach ($_POST['uuid'] as $uuid) {
                $pdfPath = "./upload/$uuid.pdf";
                $xmlPath = "./upload/$uuid.xml";

                if (file_exists($pdfPath)) {
                    unlink($pdfPath);
                }

                if (file_exists($xmlPath)) {
                    unlink($xmlPath);
                }
            }
        }
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

        if ($parametros == null) {
            $parametros = '0/0/0';
        }
        $fechaInicio = $parametros[0];
        $fechaFin = $parametros[1];
        $clientes = !empty($parametros[2]) ? $parametros[2]  : '';


        $consultaIndicadores = $this->model->consulta_Facturacion($fechaInicio, $fechaFin, $clientes);
        
        // echo json_encode($consultaIndicadores);
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

    public function registrarCandidato()
    {
        $nombre = $_POST['nombre'];
        $data = $_POST;

        try {
            $this->model->registrarCandidatoModel($data);
            echo json_encode([
                'nombre' => $nombre,
            ]);
        } catch (\Throwable $th) {
            echo json_encode([
                'nombre' => 'Error al registrar',

            ]);
        }
    }

    public function getCandidatos()
    {

        try {
            $data = $this->model->getCandidatosModel();
            echo json_encode($data);
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function actualizaCandidato()
    {
        $data = $_POST;
        try {
            $message = $this->model->actualizarCandidatoModel($data);
            echo json_encode($message);
        } catch (\Throwable $th) {
            echo json_encode([
                'error' => 'Error al actualizar',

            ]);
        }
    }

    public function actualizaEstatusCandidato()
    {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $campo = $_POST['campo'];
        $data = "";
        if ($campo === "Estatus") {
            $data = $_POST['estatus'];
        } else {
            $data =  $_POST['evaluacion'];
        }

        try {
            $this->model->actualizaEstatusCandidatoModel($data, $id, $campo);
            echo json_encode([
                'success' => $nombre,
            ]);
        } catch (\Throwable $th) {
            echo json_encode([
                'error' => 'Error al registrar',

            ]);
        }
    }

    public function validaTelefonoCandidato($parametros = null)
    {
        if ($parametros == null) {
            $parametros = '0/';
        }
        $telefono = $parametros[0];

        try {
            $data = $this->model->validaTelCandidatoModel($telefono);
            echo json_encode($data);
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function filtrarCandidato()
    {

        if ($_SESSION['usuario'] === 'Monserrat' || $_SESSION['usuario'] === 'admin') {
            $query = "SELECT * FROM [PORTALONBASE].[dbo].[OB_WEB_Candidatos] where 1=1";
        } else {
            $query = "SELECT * FROM [PORTALONBASE].[dbo].[OB_WEB_Candidatos] WHERE Reclutador = '" . $_SESSION['usuario'] . "'";
        }

        if (!empty($_POST['medioR'])) {
            $query .= " AND MedioReclutamiento LIKE '%{$_POST['medioR']}%'";
        }
        if (!empty($_POST['reclutador'])) {
            $query .= " AND Reclutador LIKE '%{$_POST['reclutador']}%'";
        }
        if (!empty($_POST['puesto'])) {
            $query .= " AND Puesto LIKE '%{$_POST['puesto']}%'";
        }
        if (!empty($_POST['sucursal'])) {
            $query .= " AND Sucursal LIKE '%{$_POST['sucursal']}%'";
        }
        if (!empty($_POST['fechaInicio']) && !empty($_POST['fechaFin'])) {
            $query .= " AND Fecha BETWEEN '{$_POST['fechaInicio']}' AND '{$_POST['fechaFin']}'";
        }
        if (!empty($_POST['candidatoPotencial'])) {
            $query .= " AND Estatus = '{$_POST['candidatoPotencial']}'";
        }

        $query .= "order by Fecha desc";
        $data = $this->model->filtrarCandidatoModel($query);
        echo json_encode($data);
    }

    public function deleteCandidato()
    {
        $data = $_POST['id'];
        $nombre = $_POST['nombre'];
        try {
            $this->model->deleteCandidatoModel($data);
            echo json_encode([
                "success" => $nombre
            ]);
        } catch (\Throwable $th) {
            echo json_encode([
                'error' => 'Error al eliminar'
            ]);
        }
    }

    public function getChecklistPendientes()
    {

        try {
            $data = $this->model->getChecklistPendientesModel();
            echo json_encode($data);
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function getChecklistPendientesFecha()
    {
        $fechaI = $_POST['fechaInicio'];
        $fechaF = $_POST['fechaFinal'];
        try {
            $data = $this->model->getChecklistPendientesFecha($fechaI, $fechaF);
            echo json_encode($data);
        } catch (\Throwable $th) {
            return [];
        }
    }


    public function getPuestoCandidatos(){
        try {
            $data = $this->model->getPuestosModel();
            echo json_encode($data);
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function agregarPuesto(){
        $puesto = $_POST['puesto'];
        try {
            $data = $this->model->agregarPuestoModel($puesto);
            if($data){
                echo json_encode([
                    "success" => "Puesto agregado correctamente"
                ]);
            }
            
        } catch (\Throwable $th) {
            echo json_encode([
                'error' => 'Error al eliminar'
            ])
            ;
        }
    }

    public function agregarComentarioFinal(){
        
        try {
            $data = $this->model->agregarComentarioModel($_POST);
            if($data){
                echo json_encode([
                    "success" => "Comentario agregado correctamente"
                ]);
            }else{
                echo json_encode([
                    "error" => "Comentario no agregado "
                ]);
            }

            
            
        } catch (\Throwable $th) {
            echo json_encode([
                'error' => 'Error al eliminar'
            ])
            ;
        }
    }
}


?>