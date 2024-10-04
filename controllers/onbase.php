<?php

require_once 'models/onbaseModel.php';
require 'vendor/autoload.php';

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
        </table> <?php

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

        <table id="tablaCL" name="tablaRepPhi" class="table table-responsive">
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
        </table> <?php

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



public function procesarArchivos() {
    if (isset($_FILES['pdf']) && isset($_FILES['xml'])) {
        $this->processFiles($_FILES['pdf'], $_FILES['xml']); // Llama a la función que procesa los archivos
        $consulta = $_SESSION['fileData'] ;
        $dont_found = $_SESSION['noEncontrados'] ;
        
        $data_found = !empty($consulta);
        ?>
        <input type="hidden" id="data_found" value="<?php echo $data_found ? '1' : '0'; ?>">
        <input type="hidden" id="dont_found" value="<?php echo ($dont_found > 0) ? '1' : '0'; ?>">
        <input type="text" class="form-control pull-right" style="width:20%; margin-bottom: 0.6em;" id="searchRepPhi" name="searchRepPhi" placeholder="Buscador...">

        <table id="tablaCL" name="tablaRepPhi" class="table table-responsive">
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
                            <td><?php echo $row['uuid'] ; ?></td>
                            <td><?php echo $row['original_pdf'] ; ?></td>
                            <td><?php echo $row['new_pdf']; ?></td>
                            <td><?php  echo ($row['referencia'] == '') ? '<input type="text" class="campo1" placeholder="Referencia">' : $row['referencia']; ?></td>
                            <td><input type="text" class="campo2" placeholder="GuiaHouse"></td>
                            <td><input type="text" class="campo3" placeholder="GuiaMaster"></td>
                            <td><input type="text" class="campo4" placeholder="Pedimento"></td>
                            <td><input type="text" class="campo5" placeholder="Contenedor"></td>
     
                        </tr>
                <?php } //FIN DEL FOR
                    } ?>
            </tbody>
        </table> <?php

    } else {
        return "Error: No se recibieron los archivos PDF y XML."; // Maneja el caso en que los archivos no estén disponibles
    }
    
}

public function moverArchivos($parametros=null){
    if ($parametros == null) {
        $parametros = '0/0/0/0/0/0/0/0';
        }

        
        $uuid = $parametros[0];
        $nombre = $parametros[1];
        $nuevoNombre = $parametros[2];
        $referencia = empty($parametros[3]) ? null : $parametros[3];
        $pedimento = empty($parametros[6]) ? null : $parametros[4];
        $guiaH = empty($parametros[4]) ? null : $parametros[5];
        $guiaM = empty($parametros[5]) ? null : $parametros[6];
        $contenedor = empty($parametros[7]) ? null : $parametros[7];

    

        $consulta = $this->model->insertaFacturasPortal($uuid, $nombre, $nuevoNombre, $referencia, $pedimento, $guiaH, $guiaM, $contenedor);
        $this->view->consulta = $consulta;

       
                $rutaFinal=0;
                $rutaTemporal = 'C:/xampp/htdocs/Ravisa/upload' . $nuevoNombre;
        
                if (file_exists($rutaTemporal)) {
                    // Mover el archivo desde la ruta temporal a la carpeta destino
                    rename($rutaTemporal, $rutaFinal);
                    
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
        </table> <?php
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
                            <td><?php echo $row->Total; ?></td>
                        </tr>
                <?php } //FIN DEL FOR
                    } ?>
            </tbody>
        </table> <?php


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