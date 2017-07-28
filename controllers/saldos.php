<?php

class Saldos extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function listado() {
        $url = $this->helper->getUrl();
        if (!empty($url[2])) {
            $pagina = $url[2];
        } else {
            $pagina = 1;
        }
        $this->view->listado = $this->model->listado($pagina);
        $this->view->title = 'Salods de Stock 0Km';
        $this->view->render('header');
        $this->view->render('saldos/index');
        $this->view->render('footer');
    }

}
