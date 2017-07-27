<?php

class Vehiculo extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function detalle() {
        $url = $this->helper->getUrl();
        $id = $url[2];
        $this->view->datosVehiculo = $this->model->datosVehiculo($id);
        $version = (!empty($this->view->datosVehiculo['datos'][0]['version'])) ? ' ' . utf8_encode($this->view->datosVehiculo['datos'][0]['version']) : '';
        $vehiculo = utf8_encode($this->view->datosVehiculo['datos'][0]['marca']) . ' ' . utf8_encode($this->view->datosVehiculo['datos'][0]['modelo']) . $version;
        $this->view->title = $vehiculo;
        $this->view->nombreVehiculo = $vehiculo;
        $this->view->public_css = array("plugins/jssocial/jssocials.css", "plugins/jssocial/jssocials-theme-flat.css");
        $this->view->public_js = array("plugins/jssocial/jssocials.min.js");
        $this->view->render('header');
        $this->view->render('vehiculo/detalle');
        $this->view->render('footer');
    }

    public function listado() {
        $url = $this->helper->getUrl();
        if (!empty($url[2])) {
            $pagina = $url[2];
        } else {
            $pagina = 2;
        }
        $this->view->listado = $this->model->listado($pagina);
        $this->view->title = 'Listado';
        $this->view->render('header');
        $this->view->render('vehiculo/listado');
        $this->view->render('footer');
    }

}
