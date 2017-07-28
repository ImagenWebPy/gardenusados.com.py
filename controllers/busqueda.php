<?php

class Busqueda extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function listado() {
        $data = '';
        if (!empty($_POST)) {
            $data = array(
                'marca' => $this->helper->cleanInput($_POST['marca']),
                'min' => $this->helper->cleanInput($_POST['realMinValue']),
                'max' => $this->helper->cleanInput($_POST['realMaxValue']),
                'tipo_vehiculo' => $this->helper->cleanInput($_POST['tipo_vehiculo']),
                'sede' => $this->helper->cleanInput($_POST['sede']),
                'combustible' => $this->helper->cleanInput($_POST['combustible'])
            );
            Session::set('busqueda', $data);
        }
        $url = $this->helper->getUrl();
        if (!empty($url[2])) {
            $pagina = $url[2];
        } else {
            $pagina = 1;
        }
        $this->view->listado = $this->model->listado($pagina);
        $this->view->title = 'Busqueda';
        $this->view->render('header');
        $this->view->render('busqueda/index');
        $this->view->render('footer');
    }

}
