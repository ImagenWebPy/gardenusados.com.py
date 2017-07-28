<?php
$helper = new Helper();
$sedes = $helper->getSedes();
?>
<section class="b-pageHeader">
    <div class="container">
        <h1 class=" wow zoomInLeft" data-wow-delay="0.5s">Contacto</h1>
    </div>
</section><!--b-pageHeader-->
<div class="b-breadCumbs s-shadow wow zoomInUp" data-wow-delay="0.5s">
    <div class="container">
        <a href="<?= URL; ?>" class="b-breadCumbs__page">Inicio</a><span class="fa fa-angle-right"></span><a href="#" class="b-breadCumbs__page m-active">Contacto</a>
    </div>
</div><!--b-breadCumbs-->
<section class="b-contacts s-shadow">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php foreach ($sedes as $item): ?>
                    <div class="b-contacts__address">
                        <div class="b-contacts__address-info">
                            <h2 class="s-titleDet wow zoomInUp" data-wow-delay="0.5s"><?= utf8_encode($item['descripcion']) . ' ' . utf8_encode($item['ciudad']); ?></h2>
                            <address class="b-contacts__address-info-main wow zoomInUp" data-wow-delay="0.5s">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="b-contacts__address-info-main-item">
                                            <span class="fa fa-home"></span>
                                            DIRECCIÓN
                                            <p><?= utf8_encode($item['direccion']); ?></p>
                                        </div>
                                        <div class="b-contacts__address-info-main-item">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 col-xs-12">
                                                    <span class="fa fa-phone"></span>
                                                    TELÉFONO
                                                </div>
                                                <div class="col-lg-9 col-md-8 col-xs-12">
                                                    <em><?= utf8_encode($item['telefono']); ?></em>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="map-<?= $item['id']; ?>" class="map" data-latitud="<?= $item['latitud']; ?>" data-longitud="<?= $item['longitud']; ?>"></div>
                                    </div>
                                </div>
                            </address>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section><!--b-contacts-->
<script type="text/javascript">
    var maps = [];
    var markers = [];
    function initMap() {
        var $maps = $('.map');
        $.each($maps, function (i, value) {
            var uluru = {lat: parseFloat($(value).attr('data-latitud')), lng: parseFloat($(value).attr('data-longitud'))};
            var mapDivId = $(value).attr('id');

            maps[mapDivId] = new google.maps.Map(document.getElementById(mapDivId), {
                zoom: 17,
                center: uluru
            });

            markers[mapDivId] = new google.maps.Marker({
                position: uluru,
                map: maps[mapDivId]
            });
        })
    }
</script>