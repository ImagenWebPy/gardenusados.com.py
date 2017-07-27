<?php
$helper = new Helper();
$nombreVehiculo = $this->nombreVehiculo;
$datosVehiculo = $this->datosVehiculo;
$datos = $datosVehiculo['datos'];
$imagenes = $datosVehiculo['imagenes'];
$marcas = $helper->getGardenMarcas();
?>
<section class="b-pageHeader">
    <div class="container">
        <h1 class="wow zoomInLeft" data-wow-delay="0.5s">Detalle - <?= $nombreVehiculo; ?></h1>
    </div>
</section><!--b-pageHeader-->

<div class="b-breadCumbs s-shadow wow zoomInUp" data-wow-delay="0.5s">
    <div class="container">
        <a href="<?= URL; ?>" class="b-breadCumbs__page">Inicio</a><span class="fa fa-angle-right"></span><a href="#" class="b-breadCumbs__page m-active"><?= $nombreVehiculo; ?></a>
    </div>
</div><!--b-breadCumbs-->
<section class="b-detail s-shadow">
    <div class="container">
        <header class="b-detail__head s-lineDownLeft wow zoomInUp" data-wow-delay="0.5s">
            <div class="row">
                <div class="col-sm-9 col-xs-12">
                    <div class="b-detail__head-title">
                        <h1><?= $nombreVehiculo . ' ' . $datos[0]['ano']; ?></h1>
                        <h3><?= $datos[0]['condicion']; ?></h3>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-12">
                    <div class="b-detail__head-price">
                        <div class="b-detail__head-price-num">$<?= number_format($datos[0]['precio'], 0, ',', '.'); ?></div>
                    </div>
                </div>
            </div>
        </header>
        <div class="b-detail__main">
            <div class="row">
                <div class="col-md-8 col-xs-12">
                    <div class="b-detail__main-info">
                        <div class="b-detail__main-info-images wow zoomInUp" data-wow-delay="0.5s">
                            <div class="row m-smallPadding">
                                <div class="col-xs-10">
                                    <ul class="b-detail__main-info-images-big bxslider enable-bx-slider" data-pager-custom="#bx-pager" data-mode="horizontal" data-pager-slide="true" data-mode-pager="vertical" data-pager-qty="5">
                                        <?php foreach ($imagenes as $item): ?>
                                            <li class="s-relative">                                        
                                                <img class="img-responsive center-block" src="<?= PUBLIC_FOLDER; ?>archivos/<?= $item['imagen'] ?>" alt="<?= $item['imagen'] ?>" />
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <div class="col-xs-2 pagerSlider pagerVertical">
                                    <div class="b-detail__main-info-images-small" id="bx-pager">
                                        <?php $i = 0; ?>
                                        <?php foreach ($imagenes as $item): ?>
                                            <a href="#" data-slide-index="<?= $i; ?>" class="b-detail__main-info-images-small-one">
                                                <img class="img-responsive" src="<?= PUBLIC_FOLDER; ?>archivos/<?= $item['imagen'] ?>" alt="<?= $item['imagen'] ?>" />
                                            </a>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="b-detail__main-info-characteristics wow zoomInUp" data-wow-delay="0.5s">
                            <!-- COMPARTIR EN REDES -->
                            <div id="share"></div>
                        </div>
                        <?php if (!empty($datos[0]['adicionales'])): ?>
                            <div class="b-detail__main-info-text wow zoomInUp" data-wow-delay="0.5s">
                                <div class="b-detail__main-aside-about-form-links">
                                    <a href="#" class="j-tab m-active s-lineDownCenter" data-to='#info1'>Datos Adicionales</a>
                                </div>
                                <div id="info1">
                                    <?= $datos[0]['adicionales']; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <aside class="b-detail__main-aside">
                        <div class="b-detail__main-aside-desc wow zoomInUp" data-wow-delay="0.5s">
                            <h2 class="s-titleDet">Características</h2>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h4 class="b-detail__main-aside-desc-title">Código</h4>
                                </div>
                                <div class="col-xs-6">
                                    <p class="b-detail__main-aside-desc-value"><?= utf8_encode($datos[0]['codigo']); ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h4 class="b-detail__main-aside-desc-title">Marca</h4>
                                </div>
                                <div class="col-xs-6">
                                    <p class="b-detail__main-aside-desc-value"><?= utf8_encode($datos[0]['marca']); ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h4 class="b-detail__main-aside-desc-title">Modelo</h4>
                                </div>
                                <div class="col-xs-6">
                                    <p class="b-detail__main-aside-desc-value"><?= utf8_encode($datos[0]['modelo']); ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h4 class="b-detail__main-aside-desc-title">Año</h4>
                                </div>
                                <div class="col-xs-6">
                                    <p class="b-detail__main-aside-desc-value"><?= utf8_encode($datos[0]['ano']); ?></p>
                                </div>
                            </div>
                            <?php if (!empty($datos[0]['kilometraje'])): ?>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <h4 class="b-detail__main-aside-desc-title">Kilometros</h4>
                                    </div>
                                    <div class="col-xs-6">
                                        <p class="b-detail__main-aside-desc-value"><?= number_format($datos[0]['kilometraje'], 0, ',', '.'); ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h4 class="b-detail__main-aside-desc-title">Tipo</h4>
                                </div>
                                <div class="col-xs-6">
                                    <p class="b-detail__main-aside-desc-value"><?= utf8_encode($datos[0]['tipo_vehiculo']); ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h4 class="b-detail__main-aside-desc-title">Motor</h4>
                                </div>
                                <div class="col-xs-6">
                                    <p class="b-detail__main-aside-desc-value"><?= utf8_encode($datos[0]['motor']); ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h4 class="b-detail__main-aside-desc-title">Tracción</h4>
                                </div>
                                <div class="col-xs-6">
                                    <p class="b-detail__main-aside-desc-value"><?= utf8_encode($datos[0]['traccion']); ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h4 class="b-detail__main-aside-desc-title">Transmisión</h4>
                                </div>
                                <div class="col-xs-6">
                                    <p class="b-detail__main-aside-desc-value"><?= utf8_encode($datos[0]['transmision']); ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h4 class="b-detail__main-aside-desc-title">Color</h4>
                                </div>
                                <div class="col-xs-6">
                                    <p class="b-detail__main-aside-desc-value"><?= utf8_encode($datos[0]['color']); ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h4 class="b-detail__main-aside-desc-title">Pasajeros</h4>
                                </div>
                                <div class="col-xs-6">
                                    <p class="b-detail__main-aside-desc-value"><?= utf8_encode($datos[0]['cantidad_pasajeros']); ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h4 class="b-detail__main-aside-desc-title">Tipo Combustible</h4>
                                </div>
                                <div class="col-xs-6">
                                    <p class="b-detail__main-aside-desc-value"><?= utf8_encode($datos[0]['combustible']); ?></p>
                                </div>
                            </div>
                            <p>&nbsp;</p>
                        </div>
                        <div class="b-detail__main-aside-about wow zoomInUp" data-wow-delay="0.5s">
                            <h2 class="s-titleDet">CONSULTÁ SOBRE ESTE VEHÍCULO</h2>
                            <div class="b-detail__main-aside-about-call">
                                <span class="fa fa-phone"></span>
                                <div><?= $datos[0]['telefono']; ?></div>
                            </div>
                            <div class="b-detail__main-aside-about-seller">
                                <p>Sede: <span><?= $datos[0]['sede'] . ' ' . $datos[0]['ciudad']; ?></span></p>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section><!--b-detail-->
<section class="b-brands s-shadow">
    <div class="container">
        <h5 class="s-titleBg wow zoomInUp" data-wow-delay="0.5s">DESCRUBRE MÁS</h5><br />
        <h2 class="s-title wow zoomInUp" data-wow-delay="0.5s">MARCAS QUE REPRESENTAMOS</h2>
        <div class="">
            <?php foreach ($marcas as $item): ?>
                <div class="b-brands__brand wow rotateIn" data-wow-delay="0.5s">
                    <a href="<?= $item['url']; ?>" target="_blank"><img src="<?= PUBLIC_FOLDER; ?>/images/logo/<?= $item['imagen']; ?>" alt="<?= $item['descripcion']; ?>" class="img-responsive" style="width: 80%;" /></a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section><!--b-brands-->
