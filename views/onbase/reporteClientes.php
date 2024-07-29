<?php include("public/inc/encabezado_sinbusqueda.php"); ?>

<div class="main-container" style="margin-top: 0; padding-top: 0;">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="#">Facturacion</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Reportes</li>
                </ol>
            </nav>
            <button type="button" onclick="regresar();" class="btn btn-danger btn-sm">Regresar</button>
        </div>
    </div>
    <div class="row mt-5 justify-content-center">
        <div class="col-md-2">
            <label for="selectCliente" class="form-label mb-1">Cliente</label>
            <select class="form-select" aria-label="Clientes" id="selectCliente" name="selectCliente" required>
                <option value="" disabled selected>Selecciona un cliente</option>
                <?php foreach ($this->selectClientes as $row) { ?>
                    <option value="<?php echo $row->Cliente; ?>"><?php echo $row->Cliente; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-2">
            <label for="calendarioI" class="form-label mb-1">Fecha inicio</label>
            <input type="date" class="form-control" id="calendarioI" name="calendarioI" step="1" min="2019-01-01" max="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>">
        </div>
        <div class="col-md-2">
            <label for="calendarioF" class="form-label mb-1">Fecha fin</label>
            <input type="date" class="form-control" id="calendarioF" name="calendarioF" step="1" min="2019-01-01" max="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>">
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="button" class="btn btn-primary btn-sm mr-2" onclick="enviaDatos();">Buscar</button>
            <button type="button" onclick="excel();" class="btn btn-success btn-sm">Excel</button>
        </div>
    </div>
    <div class="min-height-200px mt-3">
        <div class="page-header mb-5">
            <div class="table-responsive">
                <table id="tabla20" class="table table-hover multiple-select-row">
                    <thead style="background-color: #08043b; color: white;">
                        <tr>
                            <th scope="col">FolioFiscal</th>
                            <th scope="col">Referencia</th>
                            <th scope="col">Pedimiento</th>
                            <th scope="col">Patente</th>
                            <th scope="col">Aduana</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($this->consultaIndicadores as $row) : ?>
                            <tr>
                                <td><?php echo $row->U_referencia; ?></td>
                                <td><?php echo $row->U_pedimento; ?></td>
                                <td><?php echo $row->U_patente; ?></td>
                                <td><?php echo $row->U_aduana; ?></td>
                                <td><?php echo $row->NumClienteOperativo; ?></td>
                                <td><?php echo $row->NumClienteAdministrativo; ?></td>
                                <td><?php echo $row->MetodoDePago; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width:100px"><b></b></span>
                    </div>
                </div>
            </div>
            <br>
            <?php echo mensaje(); ?>
        </div>
    </div>
</div>

<?php include("public/inc/jsfooter.php"); ?>

<script>
    function excel() {
        $("#tabla20").table2excel({
            formats: ["xlsx"],
            position: 'bottom',
            bootstrap: false,
            name: "reclamos_tiempos",
            filename: 'reclamos_tiempos'
        });
    }

    function enviaDatos() {
        var fechaI = $("#calendarioI").val();
        var fechaF = $("#calendarioF").val();
        var cliente = $("#selectCliente").val();
        var resultI = fechaI.replaceAll("-", "@");
        var resultF = fechaF.replaceAll("-", "@");

        var direccion = "http://172.20.20.56:8080/ravisa/onbase/reportePhillips";
        var url = direccion + "/" + $.trim(resultI) + "/" + $.trim(resultF) + "/" + $.trim(cliente);

        $.ajax({
            type: "POST",
            url: url,
            beforeSend: function() {},
            success: function(data) {
                location.reload();
            }
        });
    }

    function enviaDatosKardexDetalle(norma, proceso) {
        var fechaI = $("#calendarioI").val();
        var fechaF = $("#calendarioF").val();
        var resultI = fechaI.replaceAll("-", "@");
        var resultF = fechaF.replaceAll("-", "@");

        var direccion = "http://192.168.1.191:81/coflex/onbase/cargaTabla_ReclamosTiempos";
        var url = direccion + "/" + $.trim(resultI) + "/" + $.trim(resultF);

        $.ajax({
            type: "POST",
            url: url,
            beforeSend: function() {},
            success: function(data) {
                $("#ValoresTiempoReclamos").html(data);
            }
        });
    }
</script>
