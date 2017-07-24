<?php
$helper = new Helper();
$listado = $this->listado;
?>
<section class="b-pageHeader">
    <div class="container">
        <h1 class="wow zoomInLeft" data-wow-delay="0.5s">Listado</h1>
    </div>
</section><!--b-pageHeader-->

<div class="b-breadCumbs s-shadow">
    <div class="container wow zoomInUp" data-wow-delay="0.5s">
        <a href="<?= URL; ?>" class="b-breadCumbs__page">Inicio</a><span class="fa fa-angle-right"></span><a href="#" class="b-breadCumbs__page m-active">Listado</a>
    </div>
</div><!--b-breadCumbs-->
<div class="b-items">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <?php foreach ($listado['listado'] as $item): ?>
                        <?php
                        $version = (!empty($item['version'])) ? ' ' . $item['version'] : '';
                        $nombre = utf8_encode($item['marca']) . ' ' . utf8_encode($item['modelo']) . $version;
                        ?>
                        <div class="col-md-3 paddingCorrectionList">
                            <div class="b-items__cell wow zoomInUp heightCorrectionList" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomInUp;">
                                <div class="b-items__cars-one-img">
                                    <img class="img-responsive" src="<?= PUBLIC_FOLDER; ?>/archivos/<?= $item['imagen']; ?>" alt="chevrolet">
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
                                            <h5 class="b-items__cell-info-price">$29,415</h5>
                                        </div>
                                        <div class="col-xs-6">
                                            <?php if (!empty($item['kilometraje'])): ?>
                                                <div class="b-items__cell-info-km">
                                                    <span class="fa fa-tachometer"></span>
                                                    <p><?= $item['kilometraje']; ?> KM</p>
                                                </div>
                                            <?php endif; ?>
                                            <a href="<?= URL; ?>/vehiculo/<?= $item['id']; ?>/<?= $helper->cleanUrl($nombre) ?>" class="btn m-btn">VER DETALLES<span class="fa fa-angle-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="b-items__pagination">
                    <?= $listado['paginador']; ?>
                </div>
            </div>
        </div>
    </div>
</div><!--b-items-->