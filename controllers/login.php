<?php

class Login extends Controller {

    function __construct() {
        parent::__construct();
        //echo Hash::create('sha256', 'garden2017', HASH_PASSWORD_KEY);
    }

    public function index() {
        #cargamos la vista
        $this->view->title = 'Inicie Sesión';
        $this->view->render('admin/login/header');
        $this->view->render('admin/login/index');
        $this->view->render('admin/login/footer');
        if (isset($_SESSION['message']))
            unset($_SESSION['message']);
    }

    public function iniciar() {
        $datos = array(
            'email' => $this->helper->cleanInput($_POST['login']['email']),
            'password' => $this->helper->cleanInput($_POST['login']['password']),
        );
        $this->model->iniciar($datos);
    }

    public function salir() {
        session_destroy();
        Auth::handleLogin();
    }

}
