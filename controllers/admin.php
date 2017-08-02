<?php

class Admin extends Controller {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();
        //var_dump($_SESSION['usuario']);
    }

    public function index() {
        $this->view->title = 'Dashboard';
        $this->view->render('admin/header');
        $this->view->render('admin/index/index');
        $this->view->render('admin/footer');
        if (!empty($_SESSION['message']))
            unset($_SESSION['message']);
    }

    public function marcas() {
        $this->view->public_css = array("admin/plugins/datatables/dataTables.bootstrap.css", "admin/plugins/html5fileupload/html5fileupload.css");
        $this->view->public_js = array("admin/plugins/datatables/jquery.dataTables.min.js", "admin/plugins/datatables/dataTables.bootstrap.min.js", "admin/plugins/html5fileupload/html5fileupload.min.js");
        $this->view->title = 'Marcas';
        $this->view->render('admin/header');
        $this->view->render('admin/marcas/index');
        $this->view->render('admin/footer');
        if (!empty($_SESSION['message']))
            unset($_SESSION['message']);
    }

    public function listadoDTMarcas() {
        header('Content-type: application/json; charset=utf-8');
        $data = $this->model->listadoDTMarcas();
        echo $data;
    }

    public function getEditarMarca() {
        header('Content-type: application/json; charset=utf-8');
        $data = array(
            'id' => $this->helper->cleanInput($_POST['id'])
        );
        $data = $this->model->getEditarMarca($data);
        echo $data;
    }

    public function saveEditarMarca() {
        $id = $this->helper->cleanInput($_POST['id']);
        $descripcion = $this->helper->cleanInput($_POST['descripcion']);
        $url = $this->helper->cleanInput($_POST['url']);
        $garden = (!empty($_POST['garden'])) ? $this->helper->cleanInput($_POST['garden']) : 0;
        $estado = (!empty($_POST['estado'])) ? $this->helper->cleanInput($_POST['estado']) : 0;
        #SUBIMOS LA IMAGEN
        $dir = 'public/images/logo/';
        $serverdir = $dir;
        #IMAGENES
        $imagenes = array();
        if (!empty($_FILES['file_archivo']['name'][0])) {
            $cantImagenes = count($_FILES['file_archivo']['name']) - 1;
            for ($i = 0; $i <= $cantImagenes; $i++) {
                $newname = $id . '_' . $_FILES['file_archivo']['name'][$i];
                $fname = $this->helper->cleanUrl($newname);
                $contents = file_get_contents($_FILES['file_archivo']['tmp_name'][$i]);
                $handle = fopen($serverdir . $fname, 'w');
                fwrite($handle, $contents);
                fclose($handle);
                #############
                #SE REDIMENSIONA LA IMAGEN
                #############
                # ruta de la imagen a redimensionar 
                $imagen = "public/images/logo/$fname";
                # ruta de la imagen final, si se pone el mismo nombre que la imagen, esta se sobreescribe 
                $imagen_final = $fname;
                $ancho = 276;
                $alto = 174;
                $this->helper->redimensionar($imagen, $imagen_final, $ancho, $alto);
                #############
                $imagenes [] = $fname;
            }
        }
        $dataFiles = array(
            'id' => $id,
            'descripcion' => $descripcion,
            'url' => $url,
            'imagen' => $imagenes,
            'garden' => $garden,
            'estado' => $estado
        );
        $this->model->saveEditarMarca($dataFiles);
        header('Location: ' . URL . 'admin/marcas');
    }

    public function modelos() {
        $this->view->public_css = array("admin/plugins/datatables/dataTables.bootstrap.css");
        $this->view->public_js = array("admin/plugins/datatables/jquery.dataTables.min.js", "admin/plugins/datatables/dataTables.bootstrap.min.js");
        $this->view->title = 'Modelos';
        $this->view->render('admin/header');
        $this->view->render('admin/modelos/index');
        $this->view->render('admin/footer');
        if (!empty($_SESSION['message']))
            unset($_SESSION['message']);
    }

    public function listadoDTModelos() {
        header('Content-type: application/json; charset=utf-8');
        $data = $this->model->listadoDTModelos();
        echo $data;
    }

    public function getEditarModelo() {
        header('Content-type: application/json; charset=utf-8');
        $data = array(
            'id' => $this->helper->cleanInput($_POST['id'])
        );
        $datos = $this->model->getEditarModelo($data);
        echo $datos;
    }

    public function saveEditarModelo() {
        $data = array(
            'id' => $this->helper->cleanInput($_POST['id']),
            'descripcion' => $this->helper->cleanInput($_POST['descripcion']),
            'id_marca' => $this->helper->cleanInput($_POST['marca']),
            'estado' => (!empty($_POST['estado'])) ? $this->helper->cleanInput($_POST['estado']) : 0
        );
        $this->model->saveEditarModelo($data);
        header('Location: ' . URL . 'admin/modelos');
    }

    public function combustible() {
        $this->view->public_css = array("admin/plugins/datatables/dataTables.bootstrap.css");
        $this->view->public_js = array("admin/plugins/datatables/jquery.dataTables.min.js", "admin/plugins/datatables/dataTables.bootstrap.min.js");
        $this->view->title = 'Modelos';
        $this->view->render('admin/header');
        $this->view->render('admin/combustible/index');
        $this->view->render('admin/footer');
        if (!empty($_SESSION['message']))
            unset($_SESSION['message']);
    }

    public function listadoDTCombustible() {
        header('Content-type: application/json; charset=utf-8');
        $data = $this->model->listadoDTCombustible();
        echo $data;
    }

    public function getEditarCombustible() {
        header('Content-type: application/json; charset=utf-8');
        $data = array(
            'id' => $this->helper->cleanInput($_POST['id'])
        );
        $datos = $this->model->getEditarCombustible($data);
        echo $datos;
    }

    public function saveEditarCombustible() {
        $data = array(
            'id' => $this->helper->cleanInput($_POST['id']),
            'descripcion' => $this->helper->cleanInput($_POST['descripcion']),
            'estado' => (!empty($_POST['estado'])) ? $this->helper->cleanInput($_POST['estado']) : 0
        );
        $this->model->saveEditarCombustible($data);
        header('Location: ' . URL . 'admin/combustible');
    }

    public function condicion() {
        $this->view->public_css = array("admin/plugins/datatables/dataTables.bootstrap.css");
        $this->view->public_js = array("admin/plugins/datatables/jquery.dataTables.min.js", "admin/plugins/datatables/dataTables.bootstrap.min.js");
        $this->view->title = 'Modelos';
        $this->view->render('admin/header');
        $this->view->render('admin/condicion/index');
        $this->view->render('admin/footer');
        if (!empty($_SESSION['message']))
            unset($_SESSION['message']);
    }

    public function listadoDTCondicion() {
        header('Content-type: application/json; charset=utf-8');
        $data = $this->model->listadoDTCondicion();
        echo $data;
    }

    public function getEditarCondicion() {
        header('Content-type: application/json; charset=utf-8');
        $data = array(
            'id' => $this->helper->cleanInput($_POST['id'])
        );
        $datos = $this->model->getEditarCondicion($data);
        echo $datos;
    }

    public function saveEditarCondicion() {
        $data = array(
            'id' => $this->helper->cleanInput($_POST['id']),
            'descripcion' => $this->helper->cleanInput($_POST['descripcion']),
            'estado' => (!empty($_POST['estado'])) ? $this->helper->cleanInput($_POST['estado']) : 0
        );
        $this->model->saveEditarCondicion($data);
        header('Location: ' . URL . 'admin/condicion');
    }

}
