<?php

class Vehiculo extends Controller {

    function __construct() {
        parent::__construct();
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
