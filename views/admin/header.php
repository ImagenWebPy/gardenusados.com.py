<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= ADMIN_TITLE . $this->title ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?= PUBLIC_FOLDER; ?>admin/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= PUBLIC_FOLDER; ?>admin/plugins/font-awesome/css/font-awesome.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= PUBLIC_FOLDER; ?>admin/dist/css/AdminLTE.min.css">
        <!-- LTE Skin BLUE-->
        <link rel="stylesheet" href="<?= PUBLIC_FOLDER; ?>admin/dist/css/skins/skin-blue.min.css">
        <!--Custom-->
        <link rel="stylesheet" href="<?= PUBLIC_FOLDER; ?>admin/dist/css/custom.css">
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
        ?>
        <!-- jQuery 2.2.3 -->
        <script src="<?= PUBLIC_FOLDER; ?>admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <?php
        if (isset($this->publicHeader_js)) {
            foreach ($this->publicHeader_js as $public_js) {
                echo '<script type="text/javascript" src="' . URL . 'public/' . $public_js . '"></script>';
            }
        }
        ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="index2.html" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>Admin</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Admin</b>istrador</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <?php
                        if (!empty($_SESSION['usuario']['imagen'])) {
                            $img = $_SESSION['usuario']['imagen'];
                        } else {
                            $img = 'default-user-image.png';
                        }
                        ?>
                        <ul class="nav navbar-nav">
                            <!-- Tasks: style can be found in dropdown.less -->
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?= PUBLIC_FOLDER; ?>images/usuarios/<?= $img; ?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?= $_SESSION['usuario']['nombre']; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?= PUBLIC_FOLDER; ?>images/usuarios/<?= $img; ?>" class="img-circle" alt="User Image">
                                        <p>
                                            <?= $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['permiso']; ?>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?= URL; ?>login/perfil/" class="btn btn-default btn-flat"><i class="fa fa-user" aria-hidden="true"></i> Perfil</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?= URL; ?>login/salir/" class="btn btn-danger btn-flat"><i class="fa fa-sign-out" aria-hidden="true"></i> Salir</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <ul class="sidebar-menu">
                        <li class="header">MENU PRINCIPAL</li>
                        <li class="active"><a href="<?= URL; ?>admin/"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                        <li><a href="<?= URL; ?>admin/marcas"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span>Marcas</span></a></li>
                        <li><a href="<?= URL; ?>admin/modelos"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span>Modelos</span></a></li>
                        <li><a href="<?= URL; ?>admin/sedes"><i class="fa fa-map-marker" aria-hidden="true"></i> <span>Sedes</span></a></li>
                        <li><a href="<?= URL; ?>admin/combustible"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span>Combustible</span></a></li>
                        <li><a href="<?= URL; ?>admin/condicion"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><span>Condición</span></a></li>
                        <li><a href="<?= URL; ?>admin/traccion"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span>Tracción</span></a></li>
                        <li><a href="<?= URL; ?>admin/tipo_vehiculos"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span>Tipo Vehículo</span></a></li>
                        <li><a href="<?= URL; ?>admin/vehiculos"><i class="fa fa-car" aria-hidden="true"></i> <span>Vehículos</span></a></li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>