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

    public function vehiculos() {
        $this->view->public_css = array("admin/plugins/datatables/dataTables.bootstrap.css", "admin/plugins/html5fileupload/html5fileupload.css");
        $this->view->public_js = array("admin/plugins/datatables/jquery.dataTables.min.js", "admin/plugins/datatables/dataTables.bootstrap.min.js", "admin/plugins/html5fileupload/html5fileupload.min.js");
        $this->view->title = 'Vehículos';
        $this->view->render('admin/header');
        $this->view->render('admin/vehiculos/index');
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

    public function sedes() {
        $this->view->public_css = array("admin/plugins/datatables/dataTables.bootstrap.css", "admin/plugins/html5fileupload/html5fileupload.css");
        $this->view->public_js = array("admin/plugins/datatables/jquery.dataTables.min.js", "admin/plugins/datatables/dataTables.bootstrap.min.js", "admin/plugins/html5fileupload/html5fileupload.min.js");
        $this->view->title = 'Sedes';
        $this->view->render('admin/header');
        $this->view->render('admin/sedes/index');
        $this->view->render('admin/footer');
        if (!empty($_SESSION['message']))
            unset($_SESSION['message']);
    }

    public function tipo_vehiculos() {
        $this->view->public_css = array("admin/plugins/datatables/dataTables.bootstrap.css", "admin/plugins/html5fileupload/html5fileupload.css");
        $this->view->public_js = array("admin/plugins/datatables/jquery.dataTables.min.js", "admin/plugins/datatables/dataTables.bootstrap.min.js", "admin/plugins/html5fileupload/html5fileupload.min.js");
        $this->view->title = 'Tipos de Vehículos';
        $this->view->render('admin/header');
        $this->view->render('admin/tipo_vehiculos/index');
        $this->view->render('admin/footer');
        if (!empty($_SESSION['message']))
            unset($_SESSION['message']);
    }

    public function listadoDTMarcas() {
        header('Content-type: application/json; charset=utf-8');
        $data = $this->model->listadoDTMarcas();
        echo $data;
    }

    public function listadoDTVehiculos() {
        header('Content-type: application/json; charset=utf-8');
        $data = $this->model->listadoDTVehiculos();
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

    public function modalAgregarMarca() {
        header('Content-type: application/json; charset=utf-8');
        $data = $this->model->modalAgregarMarca();
        echo $data;
    }

    public function modalAgregarVehiculo() {
        header('Content-type: application/json; charset=utf-8');
        $data = $this->model->modalAgregarVehiculo();
        echo $data;
    }

    public function modalAgregarSede() {
        header('Content-type: application/json; charset=utf-8');
        $data = $this->model->modalAgregarSede();
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

    public function addMarca() {
        $descripcion = $this->helper->cleanInput($_POST['descripcion']);
        $url = $this->helper->cleanInput($_POST['url']);
        $garden = (!empty($_POST['garden'])) ? $this->helper->cleanInput($_POST['garden']) : 0;
        $estado = (!empty($_POST['estado'])) ? $this->helper->cleanInput($_POST['estado']) : 0;
        #SUBIMOS LA IMAGEN
        $dir = 'public/images/logo/';
        $serverdir = $dir;
        #IMAGENES
        $imagenes = array();
        $dataFiles = array(
            'descripcion' => $descripcion,
            'url' => $url,
            'garden' => $garden,
            'estado' => $estado
        );
        $id = $this->model->addMarca($dataFiles);
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

    public function listadoDTSedes() {
        header('Content-type: application/json; charset=utf-8');
        $data = $this->model->listadoDTSedes();
        echo $data;
    }

    public function listadoDTTipoVehiculos() {
        header('Content-type: application/json; charset=utf-8');
        $data = $this->model->listadoDTTipoVehiculos();
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

    public function modalEditarVehiculo() {
        header('Content-type: application/json; charset=utf-8');
        $data = array(
            'id' => $this->helper->cleanInput($_POST['id'])
        );
        $datos = $this->model->modalEditarVehiculo($data);
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

    public function traccion() {
        $this->view->public_css = array("admin/plugins/datatables/dataTables.bootstrap.css");
        $this->view->public_js = array("admin/plugins/datatables/jquery.dataTables.min.js", "admin/plugins/datatables/dataTables.bootstrap.min.js");
        $this->view->title = 'Tracción';
        $this->view->render('admin/header');
        $this->view->render('admin/traccion/index');
        $this->view->render('admin/footer');
        if (!empty($_SESSION['message']))
            unset($_SESSION['message']);
    }

    public function listadoDTCondicion() {
        header('Content-type: application/json; charset=utf-8');
        $data = $this->model->listadoDTCondicion();
        echo $data;
    }

    public function listadoDTTraccion() {
        header('Content-type: application/json; charset=utf-8');
        $data = $this->model->listadoDTTraccion();
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

    public function getEditarTraccion() {
        header('Content-type: application/json; charset=utf-8');
        $data = array(
            'id' => $this->helper->cleanInput($_POST['id'])
        );
        $datos = $this->model->getEditarTraccion($data);
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

    public function saveEditarTraccion() {
        $data = array(
            'id' => $this->helper->cleanInput($_POST['id']),
            'descripcion' => $this->helper->cleanInput($_POST['descripcion']),
            'estado' => (!empty($_POST['estado'])) ? $this->helper->cleanInput($_POST['estado']) : 0
        );
        $this->model->saveEditarTraccion($data);
        header('Location: ' . URL . 'admin/traccion');
    }

    public function addSede() {
        $data = array(
            'descripcion' => $this->helper->cleanInput($_POST['descripcion']),
            'ciudad' => $this->helper->cleanInput($_POST['ciudad']),
            'telefono' => $this->helper->cleanInput($_POST['telefono']),
            'email' => $this->helper->cleanInput($_POST['email']),
            'latitud' => $this->helper->cleanInput($_POST['latitud']),
            'longitud' => $this->helper->cleanInput($_POST['longitud']),
            'principal' => (!empty($_POST['principal'])) ? $this->helper->cleanInput($_POST['principal']) : 0,
            'estado' => (!empty($_POST['estado'])) ? $this->helper->cleanInput($_POST['estado']) : 0,
        );
    }

    public function addVehiculo() {
        $data = array(
            'id_marca' => $this->helper->cleanInput($_POST['vehiculo']['marca']),
            'id_combustible' => $this->helper->cleanInput($_POST['vehiculo']['combustible']),
            'id_condicion' => $this->helper->cleanInput($_POST['vehiculo']['condicion']),
            'id_tipo_vehiculo' => $this->helper->cleanInput($_POST['vehiculo']['tipo']),
            'id_tipo_traccion' => $this->helper->cleanInput($_POST['vehiculo']['traccion']),
            'id_sede' => $this->helper->cleanInput($_POST['vehiculo']['sede']),
            'codigo' => $this->helper->cleanInput($_POST['vehiculo']['codigo']),
            'modelo' => $this->helper->cleanInput($_POST['vehiculo']['modelo']),
            'version' => $this->helper->cleanInput($_POST['vehiculo']['version']),
            'ano' => $this->helper->cleanInput($_POST['vehiculo']['sno']),
            'color' => $this->helper->cleanInput($_POST['vehiculo']['color']),
            'transmision' => $this->helper->cleanInput($_POST['vehiculo']['transmision']),
            'motor' => $this->helper->cleanInput($_POST['vehiculo']['motor']),
            'precio' => $this->helper->cleanInput($_POST['vehiculo']['precio']),
            'cuotas' => $this->helper->cleanInput($_POST['vehiculo']['cuotas']),
            'adicionales' => $this->helper->cleanInput($_POST['vehiculo']['adicionales']),
            'kilometraje' => $this->helper->cleanInput($_POST['vehiculo']['kilometraje']),
            'cantidad_pasajeros' => $this->helper->cleanInput($_POST['vehiculo']['pasajeros']),
            'fecha' => date('Y-m-d H:i:s'),
            'estado' => $this->helper->cleanInput($_POST['vehiculo']['estado'])
        );
        $datos = $this->model->addVehiculo($data);
        $id = $datos;
        #SUBIMOS LOS ARCHIVOS
        $error = false;
        $absolutedir = dirname(__FILE__);
        $dir = 'public/archivos/';
        $serverdir = $dir;
        #IMAGENES
        $cantImagenes = count($_FILES['file_archivo']['name']) - 1;
        $imagenes = array();
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
            $imagen = "public/archivos/$fname";
            # ruta de la imagen final, si se pone el mismo nombre que la imagen, esta se sobreescribe 
            $imagen_final = $fname;
            $ancho = 1280;
            $alto = 720;
            $this->helper->redimensionar($imagen, $imagen_final, $ancho, $alto);
            #############
            $imagenes [] = $fname;
        }
        $dataFiles = array(
            'id' => $id,
            'imagenes' => $imagenes,
        );
        $this->model->addVehiculoImg($dataFiles);
        header('Location: ' . URL . 'admin/vehiculos');
    }

    public function imgPrincipal() {
        header('Content-type: application/json; charset=utf-8');
        $data = array(
            'id' => $this->helper->cleanInput($_POST['id'])
        );
        $datos = $this->model->imgPrincipal($data);
        echo json_encode($datos);
    }

    public function mostrarImgBtn() {
        header('Content-type: application/json; charset=utf-8');
        $data = array(
            'id' => $this->helper->cleanInput($_POST['id'])
        );
        $datos = $this->model->mostrarImgBtn($data);
        echo json_encode($datos);
    }

    public function eliminarIMG() {
        header('Content-type: application/json; charset=utf-8');
        $data = array(
            'id' => $this->helper->cleanInput($_POST['id'])
        );
        $datos = $this->model->eliminarIMG($data);
        echo json_encode($datos);
    }

    public function modalEliminarVehiculo() {
        header('Content-type: application/json; charset=utf-8');
        $data = array(
            'id' => $this->helper->cleanInput($_POST['id'])
        );
        $datos = $this->model->modalEliminarVehiculo($data);
        echo $datos;
    }

    public function deleteVehiculo() {
        header('Content-type: application/json; charset=utf-8');
        $data = array(
            'id' => $this->helper->cleanInput($_POST['id'])
        );
        $data = $this->model->deleteVehiculo($data);
        echo json_encode($data);
    }

    public function uploadImageVehiculo() {
        if (!empty($_POST)) {
            $idPost = $_POST['data']['id'];

            $error = false;
            $absolutedir = dirname(__FILE__);
            $dir = 'public/archivos/';
            $serverdir = $dir;
            $tmp = explode(',', $_POST['file']);
            $file = base64_decode($tmp[1]);
            $ext = explode('.', $_POST['filename']);
            $extension = strtolower(end($ext));
            $name = $_POST['name'];
            $filename = $this->helper->cleanUrl($idPost . '_' . $name);
            $filename = $filename . '.' . $extension;
            //$filename				= $file.'.'.substr(sha1(time()),0,6).'.'.$extension;

            $handle = fopen($serverdir . $filename, 'w');
            fwrite($handle, $file);
            fclose($handle);
            #############
            #SE REDIMENSIONA LA IMAGEN
            #############
            # ruta de la imagen a redimensionar 
            $imagen = "public/archivos/$filename";
            # ruta de la imagen final, si se pone el mismo nombre que la imagen, esta se sobreescribe 
            $imagen_final = $filename;
            $ancho = 640;
            $alto = 480;
            $this->helper->redimensionar($imagen, $imagen_final, $ancho, $alto);
            #############
            header('Content-type: application/json; charset=utf-8');
            $data = array(
                'id' => $idPost,
                'archivo' => $filename
            );
            $response = $this->model->uploadImageVehiculo($data);
            echo json_encode($response);
            //echo json_encode(array('result'=>true));
        } else {
            $filename = basename($_SERVER['QUERY_STRING']);
            $file_url = '/public/archivos/' . $filename;
            header('Content-Type: 				application/octet-stream');
            header("Content-Transfer-Encoding: 	Binary");
            header("Content-disposition: 		attachment; filename=\"" . basename($file_url) . "\"");
            readfile($file_url);
            exit();
        }
    }

    public function editVehiculo() {
        header('Content-type: application/json; charset=utf-8');
        $data = array(
            'id' => $this->helper->cleanInput($_POST['vehiculo']['id']),
            'id_marca' => $this->helper->cleanInput($_POST['vehiculo']['marca']),
            'id_combustible' => $this->helper->cleanInput($_POST['vehiculo']['combustible']),
            'id_condicion' => $this->helper->cleanInput($_POST['vehiculo']['condicion']),
            'id_tipo_vehiculo' => $this->helper->cleanInput($_POST['vehiculo']['tipo']),
            'id_tipo_traccion' => $this->helper->cleanInput($_POST['vehiculo']['traccion']),
            'id_sede' => $this->helper->cleanInput($_POST['vehiculo']['sede']),
            'codigo' => $this->helper->cleanInput($_POST['vehiculo']['codigo']),
            'modelo' => $this->helper->cleanInput($_POST['vehiculo']['modelo']),
            'version' => $this->helper->cleanInput($_POST['vehiculo']['version']),
            'ano' => $this->helper->cleanInput($_POST['vehiculo']['ano']),
            'color' => $this->helper->cleanInput($_POST['vehiculo']['color']),
            'transmision' => $this->helper->cleanInput($_POST['vehiculo']['transmision']),
            'motor' => $this->helper->cleanInput($_POST['vehiculo']['motor']),
            'precio' => $this->helper->cleanInput($_POST['vehiculo']['precio']),
            'cuotas' => $this->helper->cleanInput($_POST['vehiculo']['cuotas']),
            'adicionales' => $this->helper->cleanInput($_POST['vehiculo']['adicionales']),
            'kilometraje' => $this->helper->cleanInput($_POST['vehiculo']['kilometraje']),
            'cantidad_pasajeros' => $this->helper->cleanInput($_POST['vehiculo']['pasajeros']),
            'estado' => (!empty($_POST['vehiculo']['estado'])) ? $_POST['vehiculo']['estado'] : 0
        );
        $data = $this->model->editVehiculo($data);
        echo json_encode($data);
    }

}
