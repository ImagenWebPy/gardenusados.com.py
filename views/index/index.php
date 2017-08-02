<?php
$helper = new Helper();
$listado = $helper->listadoModelosIndex();
$tipo = $helper->getTipoVehiculo(1);
$rangoPrecio = $helper->getMinMaxPrecio();
$marcas = $helper->getMarcas(1);
$sede = $helper->getSedes();
?>
<section class="b-slider"> 
    <div id="carousel" class="slide carousel carousel-fade">
        <div class="carousel-inner">
            <div class="item active">
                <img src="<?= MEDIA; ?>main-slider/1.jpg" alt="sliderImg" />
                <div class="container">
                    <div class="carousel-caption b-slider__info">
                        <h3>Find your dream</h3>
                        <h2>Lamborghini Aventador</h2>
                        <p>Model 2015 <span>$184,900</span></p>
                        <a class="btn m-btn" href="detail.html">see details<span class="fa fa-angle-right"></span></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="<?= MEDIA; ?>main-slider/2.jpg" alt="sliderImg" />
                <div class="container">
                    <div class="carousel-caption b-slider__info">
                        <h3>Find your dream</h3>
                        <h2>Lamborghini Aventador</h2>
                        <p>Model 2015 <span>$184,900</span></p>
                        <a class="btn m-btn" href="detail.html">see details<span class="fa fa-angle-right"></span></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="<?= MEDIA; ?>main-slider/3.jpg"  alt="sliderImg"/>
                <div class="container">
                    <div class="carousel-caption b-slider__info">
                        <h3>Find your dream</h3>
                        <h2>Lamborghini Aventador</h2>
                        <p>Model 2015 <span>$184,900</span></p>
                        <a class="btn m-btn" href="detail.html">see details<span class="fa fa-angle-right"></span></a>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control right" href="#carousel" data-slide="next">
            <span class="fa fa-angle-right m-control-right"></span>
        </a>
        <a class="carousel-control left" href="#carousel" data-slide="prev">
            <span class="fa fa-angle-left m-control-left"></span>
        </a>
    </div>
</section><!--b-slider-->

<section class="b-search">
    <div class="container">
        <form action="<?= URL; ?>busqueda/busqueda" method="POST" class="b-search__main" id="frmBuscarIndex">
            <div class="b-search__main-title wow zoomInUp" data-wow-delay="0.3s">
                <h2>Aún no has decidido cual vehículo comprar. Encuéntralo aquí.</h2>
            </div>
            <div class="b-search__main-type wow zoomInUp" data-wow-delay="0.3s">
                <div class="col-xs-12 col-md-2 s-noLeftPadding">
                    <h4>Seleccione el tipo de vehículo</h4>
                </div>
                <div class="col-xs-12 col-md-10">
                    <div class="row">
                        <?php foreach ($tipo as $item): ?>
                            <div class="col-md-1">
                                <label>
                                    <img src="<?= IMG; ?>siluetas/<?= $item['img']; ?>" alt="<?= utf8_encode($item['descripcion']); ?>" data-img="<?= IMG . 'siluetas/' . $item['img']; ?>" data-hover="<?= IMG . 'siluetas/' . $item['img_hover']; ?>" class="img-check img-responsive">
                                    <input type="checkbox" name="tipo[]" value="<?= $item['id']; ?>" class="hidden" autocomplete="off">
                                    <span class="textTipo"><?= utf8_encode($item['descripcion']); ?></span>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="b-search__main-form wow zoomInUp" data-wow-delay="0.3s">
                <div class="row">
                    <div class="col-xs-12 col-md-8">
                        <div class="m-firstSelects">
                            <div class="col-xs-6">
                                <select name="marca">
                                    <option value="" selected="">Marca</option>
                                    <?php foreach ($marcas as $item): ?>
                                        <option value="<?= utf8_encode($item['id']); ?>"><?= utf8_encode($item['descripcion']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-xs-6">
                                <select name="sede">
                                    <option value="" selected="">Sedes</option>
                                    <?php foreach ($sede as $item): ?>
                                        <option value="<?= utf8_encode($item['id']); ?>"><?= utf8_encode($item['descripcion']) . ' ' . utf8_encode($item['ciudad']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12 text-left s-noPadding">
                        <div class="b-search__main-form-range">
                            <label>Rango Precio</label>
                            <div class="slider"></div>
                            <input type="hidden" name="min" id="minUsados" value="<?= ceil($rangoPrecio['min']) ?>" class="j-min" />
                            <input type="hidden" name="max" id="maxUsados" value="<?= ceil($rangoPrecio['max']) ?>" class="j-max" />
                            <input type="hidden" name="realMinValue" id="realMinValue" value=""/>
                            <input type="hidden" name="realMaxValue" id="realMaxValue" value=""/>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-8">
                        <div class="b-search__main-form-submit">
                            <button type="submit" class="btn m-btn col-md-6" id="btnBuscarIndex">Buscar<span class="fa fa-angle-right"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section><!--b-search-->
<section class="b-featured">
    <div class="container">
        <h2 class="s-title wow zoomInUp" data-wow-delay="0.3s">Listado de Vehiculos</h2>
        <div class="b-items">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <?php foreach ($listado as $item): ?>
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
                        </div>
                        <div class="b-items__pagination">
                            <?= $helper->mostrarPaginador(CANT_REG, 1, 'vehiculo', 'vehiculo/listado'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--b-featured-->
<script type="text/javascript">
    $(document).ready(function (e) {
        $(".img-check").click(function () {
            //$(this).toggleClass("check");}
            var url = "<?= IMG; ?>siluetas/";
            var img = $(this).attr('data-img');
            var hover = $(this).attr('data-hover');
            var src = ($(this).attr('src') === img)
                    ? hover
                    : img;
            $(this).attr('src', src);
        });
        $(document).on("click", "#btnBuscarIndex", function (e) {
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
                $("#frmBuscarIndex").submit();
            }
            e.handled = true;
        });
    });
</script>