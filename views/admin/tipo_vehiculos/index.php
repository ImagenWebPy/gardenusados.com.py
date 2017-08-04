<?php
$helper = new Helper();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tipo de Vehículos
            <small>Listado</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= URL; ?>admin/"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Tipo de Vehículos</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php
        if (isset($_SESSION['message'])) {
            echo $helper->messageAlert($_SESSION['message']['type'], $_SESSION['message']['mensaje']);
        }
        ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Listado de Tipos de Vehículos</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-striped" id="tblTipoVehiculos">
                            <thead>
                                <tr>
                                    <th>Tipo de Vehículo</th>
                                    <th>Imagen</th>
                                    <th>Imagen Hover</th>
                                    <th>Estado</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Tipo de Vehículo</th>
                                    <th>Imagen</th>
                                    <th>Imagen Hover</th>
                                    <th>Estado</th>
                                    <th>Editar</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
    $(function () {
        $("#tblTipoVehiculos").DataTable({
            //"aaSorting": [[1, "asc"]],
            "paging": true,
            "orderCellsTop": true,
            //"scrollX": true,
            //"scrollCollapse": true,
            "fixedColumns": true,
            //"iDisplayLength": 50,
            "ajax": {
                "url": "<?= URL ?>admin/listadoDTTipoVehiculos/",
                "type": "post"
            },
            "columns": [
                {"data": "tipo_vehiculo"},
                {"data": "imagen"},
                {"data": "imagen_hover"},
                {"data": "estado"},
                {"data": "editar"}
            ],
            "language": {
                "url": "<?= URL ?>public/language/Spanish.json"
            }
        });
        $(document).on("click", ".editDTTipoVehiculo", function (e) {
            if (e.handled !== true) // This will prevent event triggering more then once
            {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "<?= URL; ?>admin/getEditarMarca",
                    type: "POST",
                    data: {id: id},
                    dataType: "json"
                }).done(function (data) {
                    $(".genericModal .modal-header").removeClass("modal-header").addClass("modal-header bg-primary");
                    $(".genericModal .modal-title").html(data['marca']);
                    $(".genericModal .modal-body").html(data['contenido']);
                    $(".genericModal").modal("toggle");
                });
            }
            e.handled = true;
        });
    });
</script>