<?php

/**
 * ARCHIVO DE CONFIGURACIONES
 * @author "Raul Ramirez" <raul.chuky@gmail.com>
 * @version 1 2017-07-17
 */
// Always provide a TRAILING SLASH (/) AFTER A PATH
$host = getHost();
switch ($host) {
    case 'localhost':
        define('URL', 'http://localhost/gardenusados.com.py/');
        define('DB_USER', 'root');
        define('DB_PASS', '');
        define('DB_NAME', 'usados');
        break;
    default :
        define('URL', 'http://192.168.90.195/gardenusados.com.py/');
        define('DB_USER', 'root');
        define('DB_PASS', '');
        define('DB_NAME', 'usados');
        break;
}
define('LIBS', 'libs/');

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');

// The sitewide hashkey, do not change this because its used for passwords!
// This is for other hash keys... Not sure yet
define('HASH_GENERAL_KEY', 'MixitUp200');

// This is for database passwords only
define('HASH_PASSWORD_KEY', '!@123456789ABCDEFGHIJKLMNOPRSTWYZ[¿]{?}<->');

//Constantes varias
define('SITE_TITLE', 'Garden Usados :: ');
define('TITLE_ADMIN', 'Institucional Admin :: ');
define('CSS', URL . 'public/css/');
define('JS', URL . 'public/js/');
define('IMG', URL . 'public/images/');
define('MEDIA', URL . 'public/media/');
define('CANT_REG_PAGINA', 15);

function getHost() {
    $host = $_SERVER['HTTP_HOST'];
    return $host;
}
