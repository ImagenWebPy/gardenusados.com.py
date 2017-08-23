<?php
$helper = new Helper();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Vehículos
            <small>Listado</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= URL; ?>admin/"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Vehículos</li>
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
                        <h3 class="box-title">Listado de Vehículos</h3>
                        <div class="col-xs-6 pull-right">
                            <button type="button" class="btn btn-block btn-primary btnAgregarMarca">Agregar Vehículo</button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-striped" id="tblVehiculos">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha Carga</th>
                                    <th>Código</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Version</th>
                                    <th>Precio</th>
                                    <th>Sede</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha Carga</th>
                                    <th>Código</th>
                                    <th>Modelo</th>
                                    <th>Version</th>
                                    <th>Precio</th>
                                    <th>Sede</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
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
<script type="text/javascript">
    $(function () {
        $("#tblVehiculos").DataTable({
            "aaSorting": [[0, "desc"]],
            "paging": true,
            "orderCellsTop": true,
            //"scrollX": true,
            //"scrollCollapse": true,
            "fixedColumns": true,
            "iDisplayLength": 25,
            "ajax": {
                "url": "<?= URL ?>admin/listadoDTVehiculos/",
                "type": "post"
            },
            "columns": [
                {"data": "id"},
                {"data": "fecha"},
                {"data": "codigo"},
                {"data": "marca"},
                {"data": "modelo"},
                {"data": "version"},
                {"data": "precio"},
                {"data": "sede"},
                {"data": "estado"},
                {"data": "accion"}
            ],
            "language": {
                "url": "<?= URL ?>public/language/Spanish.json"
            }
        });
        $(document).on("click", ".btnAgregarMarca", function (e) {
            if (e.handled !== true) // This will prevent event triggering more then once
            {
                $.ajax({
                    url: "<?= URL; ?>admin/modalAgregarVehiculo",
                    type: "POST",
                    dataType: "json"
                }).done(function (data) {
                    $(".genericModal .modal-header").removeClass("modal-header").addClass("modal-header bg-primary");
                    $(".genericModal .modal-title").html(data['titulo']);
                    $(".genericModal .modal-body").html(data['contenido']);
                    $(".genericModal").modal("toggle");
                });
            }
            e.handled = true;
        });
        $(document).on("click", ".btnEditarVehiculo", function (e) {
            if (e.handled !== true) // This will prevent event triggering more then once
            {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "<?= URL; ?>admin/modalEditarVehiculo",
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
        $(document).on("click", ".btnEliminarVehiculo", function (e) {
            if (e.handled !== true) // This will prevent event triggering more then once
            {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "<?= URL; ?>admin/modalEliminarVehiculo",
                    type: "POST",
                    data: {id: id},
                    dataType: "json"
                }).done(function (data) {
                    $(".genericModal .modal-header").removeClass("modal-header").addClass("modal-header bg-primary");
                    $(".genericModal .modal-title").html(data['titulo']);
                    $(".genericModal .modal-body").html(data['contenido']);
                    $(".genericModal").modal("toggle");
                });
            }
            e.handled = true;
        });
        $(document).on("click", ".btnImgPrincipal", function (e) {
            if (e.handled !== true) // This will prevent event triggering more then once
            {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "<?= URL; ?>admin/imgPrincipal",
                    type: "post",
                    dataType: "json",
                    data: {
                        id: id
                    },
                    success: function (data) {
                        if (data.result != false) {
                            $('#imgPrincipal' + data.id).html(data.content);
                            $('#imgPrincipal' + data.id_old).html(data.content_old);
                        }
                    }
                }); //END AJAX
            }
            e.handled = true;
        });
        $(document).on("click", ".btnMostrarImg", function (e) {
            if (e.handled !== true) // This will prevent event triggering more then once
            {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "<?= URL; ?>admin/mostrarImgBtn",
                    type: "post",
                    dataType: "json",
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $('#mostrarImg' + data.id).html(data.content);
                    }
                }); //END AJAX
            }
            e.handled = true;
        });
        $(document).on("click", ".btnEliminarImg", function (e) {
            if (e.handled !== true) // This will prevent event triggering more then once
            {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "<?= URL; ?>admin/eliminarIMG",
                    type: "post",
                    dataType: "json",
                    data: {
                        id: id
                    },
                    success: function (data) {
                        if (data.result != false) {
                            $("#imagenGaleria" + data.id).remove();
                        }
                    }
                }); //END AJAX
            }
            e.handled = true;
        });
        $(document).on("submit", "#frmEliminarVehiculo", function (e) {
            var url = "<?= URL ?>admin/deleteVehiculo"; // the script where you handle the form input.
            var id = $("#btnDeleteVehiculo").attr("data-id");
            $.ajax({
                type: "POST",
                url: url,
                data: {id: id}, // serializes the form's elements.
                success: function (data)
                {
                    if (data['type'] == 'success') {
                        $("#vehiculo_" + data['id']).remove();
                        $(".genericModal").modal("toggle");
                    }
                }
            });
            e.preventDefault(); // avoid to execute the actual submit of the form.
        });
        $(document).on("submit", "#frmEditarVehiculo", function (e) {
            var url = "<?= URL ?>admin/editVehiculo"; // the script where you handle the form input.
            $.ajax({
                type: "POST",
                url: url,
                data: $("#frmEditarVehiculo").serialize(), // serializes the form's elements.
                success: function (data)
                {
                    if (data['type'] == 'success') {
                        $("#vehiculo_" + data['id']).html(data['row']);
                        $(".genericModal").modal("toggle");
                    }
                }
            });
            e.preventDefault(); // avoid to execute the actual submit of the form.
        });
    });
</script>