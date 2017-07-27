<?php

class Usados extends Controller {

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
        $this->view->title = 'Usados';
        $this->view->render('header');
        $this->view->render('usados/index');
        $this->view->render('footer');
    }

}
