<?php

class Login_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    public function iniciar($data) {
        if (!empty($data)) {
            $email = $data['email'];
            $pass = trim(Hash::create('sha256', $data['password'], HASH_PASSWORD_KEY));
            $sth = $this->db->prepare("select id, nombre, email from admin_usuario where email = :email and password = :password");
            $sth->execute(array(
                ':email' => $email,
                ':password' => $pass
            ));
            $data = $sth->fetch();
            $count = $sth->rowCount();
            if ($count > 0) {
                $permiso = $this->helper->getPermisosUsuario($data['id']);
                Session::set('usuario', array(
                    'id' => $data['id'],
                    'nombre' => utf8_encode($data['nombre']),
                    'email' => utf8_encode($data['email']),
                    'imagen' => utf8_encode($data['imagen']),
                    'id_permiso' => utf8_encode($permiso['id_permiso']),
                    'permiso' => utf8_encode($permiso['permiso'])
                ));
                Session::set('loggedIn', TRUE);
                header('location: ' . URL . 'admin');
            }
        } else {
            header('location: ' . URL . 'login/');
        }
    }

}
