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

    private function obtenerPermisosUsuario($usuarioID)
    {
        $permisos = $this->model->obtenerPermisosUsuario($usuarioID);
        $_SESSION['PERMISOS'] = $permisos;
    }

    public function administracionUser($parametros = null)
    {
        $this->model = new OnbaseModel();
        $param1 = 1;

        $consultaIndicadores = $this->model->consulta_indicadoresMain($param1);


        $this->view->consultaIndicadores = $consultaIndicadores;

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

    public function reportePhillips()
    {

        $selectClientes = $this->model->selectClientes();
        // print_r($selectClientes);
        $this->view->selectClientes = $selectClientes;
        $this->view->pagina = "onbase/reporteClientes";
        $this->view->render('onbase/reporteClientes');
    }

    public function cargaTabla_ReportePhilips($parametros = null)
    {

        if ($parametros == null) {
            $parametros = '0/0/0';
        }
        $fechaInicio = $parametros[0];
        $fechaFin = $parametros[1];
        $clientes = $parametros[2];

        $consultaIndicadores = $this->model->consulta_Facturacion($fechaInicio, $fechaFin, $clientes); 
        $_SESSION['consultaIndicadores'] = $consultaIndicadores;?>
        

        <!--  BUSCADOR POR JQUERY    -->
        <input type="text" class="form-control pull-right" style="width:20%" id="searchRepPhi" name="searchRepPhi" placeholder="Buscador...">

        <table id="tablaRepPhi" name="tablaRepPhi" class="table table-responsive">
            <thead class="text-blue">
                <tr>
                    <th width=15% style="text-align:left">Folio</th>
                    <th width=20% style="text-align:left">Referencia</th>
                    <th width=20% style="text-align:left">Fecha</th>
                    <th width=5% style="text-align:left">Pedimento</th>
                    <th width=15% style="text-align:left">Patente</th>
                    <th width=15% style="text-align:left">Aduana</th>
                    <th width=15% style="text-align:left">Cliente</th>
                    <th width=15% style="text-align:left">#Cliente</th>
                    <th width=15% style="text-align:left">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($consultaIndicadores as $row) { //INICIO DEL FOR    
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
                ?>
            </tbody>
        </table> <?php


    }

    public function cargaReporteExcel($parametros = null){

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