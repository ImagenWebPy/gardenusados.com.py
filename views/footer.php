<?php
$helper = new Helper();
$ultimos_agregados = $helper->ultimosVehiculos();
$sedes = $helper->getSedes();
$horarioAtencion = $helper->getHorarioAtencion();
$url = $helper->getUrl();
?>
<div class="b-info">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-6">
                <aside class="b-info__aside wow zoomInLeft" data-wow-delay="0.3s">
                    <article class="b-info__aside-article">
                        <h3>HORARIO DE ATENCIÓN</h3>
                        <div class="b-info__aside-article-item">
                            <?= $horarioAtencion; ?>
                        </div>
                    </article>
                    <article class="b-info__aside-article">
                        <h3>Acerca de Nosotros</h3>
                        <p><a href="http://garden.com.py"><img src="<?= IMG; ?>logo.png" class="img-responsive logoSizeFooter" style="margin: 0 auto;"></a></p>
                    </article>
                    <a href="#" class="btn m-btn">LEER MÁS<span class="fa fa-angle-right"></span></a>
                </aside>
            </div>
            <div class="col-md-3 col-xs-6">
                <div class="b-info__latest">
                    <h3>ÚLTIMOS VEHICULOS AGREGADOS</h3>
                    <?php foreach ($ultimos_agregados as $item): ?>
                        <?php
                        $version = (!empty($item['version'])) ? ' ' . $item['version'] : '';
                        $nombre = utf8_encode($item['marca']) . ' ' . utf8_encode($item['modelo']) . $version;
                        ?>
                        <div class="b-info__latest-article wow zoomInUp" data-wow-delay="0.3s">
                            <div class="b-info__latest-article-photo"><img src="<?= PUBLIC_FOLDER; ?>/archivos/<?= $item['imagen']; ?>" class="img-responsive"></div>
                            <div class="b-info__latest-article-info">
                                <h6><a href="<?= URL; ?>/vehiculo/<?= $item['id']; ?>/<?= $helper->cleanUrl($nombre) ?>"><?= $nombre; ?></a></h6>
                                <?php if (!empty($item['kilometraje'])): ?>
                                    <div class="b-items__cell-info-km">
                                        <span class="fa fa-tachometer"></span>
                                        <p><?= $item['kilometraje']; ?> KM</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-md-3 col-xs-6 pull-right">
                <address class="b-info__contacts wow zoomInUp" data-wow-delay="0.3s">
                    <p>Contactanos</p>
                    <?php foreach ($sedes as $item): ?>
                        <div class="b-info__contacts-item">
                            <span class="fa fa-map-marker"></span>
                            <em><?= utf8_encode($item['descripcion']) . ' ' . utf8_encode($item['ciudad']); ?><br>
                                Tel. <?= $item['telefono']; ?></em>
                        </div>
                    <?php endforeach; ?>
                </address>
                <!--                <address class="b-info__map">
                                    <a href="#">Abrir en el Mapa</a>
                                </address>-->
            </div>
        </div>
    </div>
</div><!--b-info-->
<footer class="b-footer">
    <a id="to-top" href="#this-is-top"><i class="fa fa-chevron-up"></i></a>
    <div class="container">
        <div class="row">
            <div class="col-xs-4">
                <div class="b-footer__company wow fadeInLeft" data-wow-delay="0.3s">
                    <img src="<?= IMG; ?>logo_usados.png" class="img-responsive logoSizeFooter">
                    <p>&copy; Powered by <a href="mailto:raul.ramirez@garden.com.py">Garden Marketing</a>.</p>
                </div>
            </div>
            <div class="col-xs-8">
                <div class="b-footer__content wow fadeInRight" data-wow-delay="0.3s">
                    <nav class="b-footer__content-nav">
                        <ul>
                            <li><a href="<?= URL; ?>">Inicio</a></li>
                            <li><a href="<?= URL; ?>usados">Usados</a></li>
                            <li><a href="<?= URL; ?>saldos">Saldos de Stock 0km</a></li>
                            <li><a href="<?= URL; ?>contacto">Contacto</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</footer><!--b-footer-->
<!--Main-->   

<script src="<?= JS; ?>jquery-ui.min.js"></script>
<script src="<?= JS; ?>bootstrap.min.js"></script>
<script src="<?= JS; ?>modernizr.custom.js"></script>
<script src="assets/rendro-easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
<script src="<?= JS; ?>waypoints.min.js"></script>
<script src="<?= JS; ?>jquery.easypiechart.min.js"></script>
<script src="<?= JS; ?>classie.js"></script>
<!--Owl Carousel-->
<script src="<?= URL; ?>public/assets/owl-carousel/owl.carousel.min.js"></script>
<!--bxSlider-->
<script src="<?= URL; ?>public/assets/bxslider/jquery.bxslider.js"></script>
<!-- jQuery UI Slider -->
<script src="<?= URL; ?>public/assets/slider/jquery.ui-slider.js"></script>
<!--Theme-->
<script src="<?= JS; ?>jquery.smooth-scroll.js"></script>
<script src="<?= JS; ?>wow.min.js"></script>
<script src="<?= JS; ?>jquery.placeholder.min.js"></script>
<script src="<?= JS; ?>theme.js"></script>
<?php
#cargamos los js de las vistas
if (isset($this->external_js)) {
    foreach ($this->external_js as $external) {
        echo '<script async defer src="' . $external . '"></script>';
    }
}
if (isset($this->public_js)) {
    foreach ($this->public_js as $public_js) {
        echo '<script type="text/javascript" src="' . URL . 'public/' . $public_js . '"></script>';
    }
}
if (isset($this->js)) {
    foreach ($this->js as $js) {
        echo '<script type="text/javascript" src="' . URL . 'views/' . $js . '"></script>';
    }
}
?>
<?php
if (!empty($url)):
    if (($url[0] == 'vehiculo') && ($url[1] == 'detalle')):
        ?>
        <?php
        $enlace = URL . implode('/', $url);
        ?>
        <script>
            $("#share").jsSocials({
                shares: ["email", "twitter", "facebook", "googleplus", "pinterest"],
                url: "<?= $enlace ?>"
            });
        </script>
        <?php
    endif;
endif;
?>
</body>
</html>