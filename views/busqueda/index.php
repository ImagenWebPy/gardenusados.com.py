<?php
$helper = new Helper();
$listado = $this->listado;
?>
<section class="b-pageHeader">
    <div class="container">
        <h1 class="wow zoomInLeft" data-wow-delay="0.5s">Usados</h1>
    </div>
</section><!--b-pageHeader-->
<div class="b-breadCumbs s-shadow">
    <div class="container wow zoomInUp" data-wow-delay="0.5s">
        <a href="<?= URL; ?>" class="b-breadCumbs__page">Inicio</a><span class="fa fa-angle-right"></span><a href="#" class="b-breadCumbs__page m-active">Busqueda</a>
    </div>
</div><!--b-breadCumbs-->
<div class="b-items">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-sm-8 col-xs-12">
                <div class="row">
                    <?php if (!empty($listado['listado'])): ?>
                        <?php foreach ($listado['listado'] as $item): ?>
                            <?php
                            $version = (!empty($item['version'])) ? ' ' . $item['version'] : '';
                            $nombre = utf8_encode($item['marca']) . ' ' . utf8_encode($item['modelo']) . $version;
                            ?>
                            <div class="col-lg-4 col-md-6 col-xs-12 paddingCorrectionList">
                                <div class="b-items__cell wow zoomInUp heightCorrectionList" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomInUp;">
                                    <div class="b-items__cars-one-img">
                                        <img class="img-responsive" src="<?= PUBLIC_FOLDER; ?>/archivos/<?= $item['imagen']; ?>" alt="chevrolet" style="width: 93%;">
                                        <?php if ($item['condicion'] == '0km'): ?>
                                            <span class="b-items__cars-one-img-type m-premium">0KM</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="b-items__cell-info">
                                        <div class="s-lineDownLeft b-items__cell-info-title">
                                            <h2 class="h2List"><?= $nombre; ?></h2>
                                        </div>
                                        <div class="row m-smallPadding">
                                            <div class="col-xs-6">
                                                <ul class="text-left">
                                                    <li><?= $item['ano']; ?></li>
                                                    <li><?= utf8_encode($item['condicion']); ?></li>
                                                    <li><?= utf8_encode($item['transmision']); ?></li>
                                                    <li><?= utf8_encode($item['combustible']); ?></li>
                                                </ul>
                                                <h5 class="b-items__cell-info-price">$<?= number_format($item['precio'], 0, ',', '.'); ?></h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <?php if (!empty($item['kilometraje'])): ?>
                                                    <div class="b-items__cell-info-km">
                                                        <span class="fa fa-tachometer"></span>
                                                        <p><?= $item['kilometraje']; ?> KM</p>
                                                    </div>
                                                <?php endif; ?>
                                                <a href="<?= URL; ?>vehiculo/detalle/<?= $item['id']; ?>/<?= $helper->cleanUrl($nombre) ?>" class="btn m-btn">VER DETALLES<span class="fa fa-angle-right"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?= $helper->messageAlert('info', '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Lo sentimos, no se han encontrado resultados para su busqueda.'); ?>
                    <?php endif; ?>
                </div>
                <div class="b-items__pagination">
                    <?= $listado['paginador']; ?>
                </div>
            </div>
            <?= $helper->loadBuscador(); ?>
        </div>
    </div>
</div><!--b-items-->
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on("click", "#btn-BuscarVehiculos", function (e) {
            if (e.handled !== true) // This will prevent event triggering more then once
            {
                e.preventDefault();
                if ($("#minUsados").text().trim().length > 0) {
                    $("#realMinValue").val($("#minUsados").text());
                } else {
                    $("#realMinValue").val($("#minUsados").val());
                }
                if ($("#maxUsados").text().trim().length > 0) {
                    $("#realMaxValue").val($("#maxUsados").text());
                } else {
                    $("#realMaxValue").val($("#maxUsados").val());
                }
                $("#frmBuscarVehiculo").submit();
            }
            e.handled = true;
        });
    });
</script>