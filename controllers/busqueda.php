<?php

class Busqueda extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function listado() {
        var_dump($_POST);
        die();
        $data = '';
        if (!empty($_POST)) {
            $data = array(
                'marca' => $this->helper->cleanInput($_POST['marca']),
                'min' => $this->helper->cleanInput($_POST['min']),
                'max' => $this->helper->cleanInput($_POST['max']),
                'tipo_vehiculo' => $this->helper->cleanInput($_POST['tipo_vehiculo']),
                'sede' => $this->helper->cleanInput($_POST['sede']),
                'combustible' => $this->helper->cleanInput($_POST['combustible'])
            );
        }
        $url = $this->helper->getUrl();
        if (!empty($url[2])) {
            $pagina = $url[2];
        } else {
            $pagina = 1;
        }
        $this->view->listado = $this->model->listado($data, $pagina);
        var_dump($this->view->listado);
        $this->view->title = 'Saldos de Stock 0km';
    }

}
