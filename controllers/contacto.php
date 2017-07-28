<?php

class Contacto extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->view->title = 'Contacto';
        $this->view->external_js = array("https://maps.googleapis.com/maps/api/js?key=AIzaSyDjIzHo23zpYK8BBEcPI6pKXrXbYd64eE0&callback=initMap");
        $this->view->render('header');
        $this->view->render('contacto/index');
        $this->view->render('footer');
    }
}