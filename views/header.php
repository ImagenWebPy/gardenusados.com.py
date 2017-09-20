<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title><?= SITE_TITLE . $this->title; ?></title>
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
        <link href="<?= CSS; ?>master.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?= URL; ?>public/assets/switcher/css/color2.css" title="color2" media="all" />
        <link href="<?= CSS; ?>custom.css" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php
        #cargamos los css de las vistas
        if (isset($this->css)) {
            foreach ($this->css as $css) {
                echo '<link rel="stylesheet" href="' . URL . 'views/' . $css . '" type="text/css">';
            }
        }
        if (isset($this->public_css)) {
            foreach ($this->public_css as $public_css) {
                echo '<link rel="stylesheet" href="' . URL . 'public/' . $public_css . '" type="text/css">';
            }
        }
        if (isset($this->publicHeader_js)) {
            foreach ($this->publicHeader_js as $public_js) {
                echo '<script type="text/javascript" src="' . URL . 'public/' . $public_js . '"></script>';
            }
        }
        ?>
        <script src="<?= JS; ?>jquery-1.11.3.min.js"></script>
        <!-- GOOGLE ANALYTICS CODE -->
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
            ga('create', 'UA-65863238-1', 'auto');
            ga('send', 'pageview');
        </script>
        <!-- END GOOGLE ANALYTICS CODE -->
    </head>
    <body class="m-index" data-scrolling-animations="true" data-equal-height=".b-auto__main-item">
        <!-- Loader -->
        <div id="page-preloader"><span class="spinner"></span></div>
        <!-- Loader end -->
        <nav class="b-nav">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 col-xs-4">
                        <div class="b-nav__logo wow slideInLeft" data-wow-delay="0.3s">
                            <a href="<?= URL; ?>"><img src="<?= IMG; ?>logo_usados.png" class="img-responsive logoSize"></a>
                        </div>
                    </div>
                    <div class="col-sm-9 col-xs-8">
                        <div class="b-nav__list wow slideInRight" data-wow-delay="0.3s">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="collapse navbar-collapse navbar-main-slide" id="nav">
                                <ul class="navbar-nav-menu">
                                    <li><a href="<?= URL; ?>">Inicio</a></li>
                                    <li><a href="<?= URL; ?>usados/listado">Usados</a></li>
                                    <li><a href="<?= URL; ?>saldos/listado">Saldos de Stock 0km</a></li>
                                    <li><a href="<?= URL; ?>contacto">Contacto</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav><!--b-nav-->