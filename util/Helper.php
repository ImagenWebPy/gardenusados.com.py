<?php

require 'libs/Database.php';

class Helper {

    function __construct() {
        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
    }

    /**
     * Funcion para limpiar un string
     * @param strig $String a quitar caracteres especiales y espacios
     * @return string formateado
     */
    public function cleanUrl($String) {
        $String = str_replace(array('á', 'à', 'â', 'ã', 'ª', 'ä'), "a", $String);
        $String = str_replace(array('Á', 'À', 'Â', 'Ã', 'Ä'), "A", $String);
        $String = str_replace(array('Í', 'Ì', 'Î', 'Ï'), "I", $String);
        $String = str_replace(array('í', 'ì', 'î', 'ï'), "i", $String);
        $String = str_replace(array('é', 'è', 'ê', 'ë'), "e", $String);
        $String = str_replace(array('É', 'È', 'Ê', 'Ë'), "E", $String);
        $String = str_replace(array('ó', 'ò', 'ô', 'õ', 'ö', 'º'), "o", $String);
        $String = str_replace(array('Ó', 'Ò', 'Ô', 'Õ', 'Ö'), "O", $String);
        $String = str_replace(array('ú', 'ù', 'û', 'ü'), "u", $String);
        $String = str_replace(array('Ú', 'Ù', 'Û', 'Ü'), "U", $String);
        $String = str_replace(array('?', '[', '^', '´', '`', '¨', '~', ']', '¿', '!', '¡'), "", $String);
        $String = str_replace("ç", "c", $String);
        $String = str_replace("Ç", "C", $String);
        $String = str_replace("ñ", "n", $String);
        $String = str_replace("Ñ", "N", $String);
        $String = str_replace("Ý", "Y", $String);
        $String = str_replace("ý", "y", $String);

        $String = str_replace("'", "", $String);
        //$String = str_replace(".", "_", $String);
        $String = str_replace(" ", "_", $String);
        $String = str_replace("/", "_", $String);

        $String = str_replace("&aacute;", "a", $String);
        $String = str_replace("&Aacute;", "A", $String);
        $String = str_replace("&eacute;", "e", $String);
        $String = str_replace("&Eacute;", "E", $String);
        $String = str_replace("&iacute;", "i", $String);
        $String = str_replace("&Iacute;", "I", $String);
        $String = str_replace("&oacute;", "o", $String);
        $String = str_replace("&Oacute;", "O", $String);
        $String = str_replace("&uacute;", "u", $String);
        $String = str_replace("&Uacute;", "U", $String);
        return $String;
    }

    /**
     * Funcion para limpiar un input antes de enviarlo por post
     * @param type $data
     * @return type
     */
    public function cleanInput($data) {
        $data = trim($data);
        $data = str_replace("'", "\'", $data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);

        return $data;
    }

    /**
     * Funcion para mostrar mensajes de alerta
     * @param string $type (success - info - warning - error)
     * @param string $message (mensaje a mostrar)
     * @return string
     */
    public function messageAlert($type, $message) {
        $alert = "";
        switch ($type) {
            case 'success':
                $alert .= '<div class="alert alert-success" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            ' . $message . '
                        </div>';
                break;
            case 'info':
                $alert .= '<div class="alert alert-info" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            ' . $message . '
                        </div>';
                break;
            case 'warning':
                $alert .= '<div class="alert alert-warning" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            ' . $message . '
                        </div>';
                break;
            case 'error':
                $alert .= '<div class="alert alert-danger" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            ' . $message . '
                        </div>';
                break;
        }
        return $alert;
    }

    /**
     * 
     * @return string url anterior del sitio
     */
    public function getUrlAnterior() {
        $url = (!empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : '';
        return $url;
    }

    /**
     * Funcion que retorna la url actual en forma de array
     * @return array url
     */
    public function getUrl() {
        $url = '';
        if (!empty($_GET['url'])) {
            $url = $_GET['url'];
            $url = explode('/', $url);
        }
        return $url;
    }

    /**
     * Funcion que lista las opciones del campo enum de una tabla
     * @param string $table
     * @param string $field
     * @return array con las opciones del campo enum
     */
    public function getEnumOptions($table, $field) {
        $finalResult = array();
        if (strlen(trim($table)) < 1)
            return false;
        $query = $this->db->select("show columns from $table");
        foreach ($query as $row) {
            if ($field != $row["Field"])
                continue;
//check if enum type 
            if (preg_match('/enum.(.*)./', $row['Type'], $match)) {
                $opts = explode(',', $match[1]);
                foreach ($opts as $item)
                    $finalResult[] = substr($item, 1, strlen($item) - 2);
            } else
                return false;
        }
        return $finalResult;
    }

    /**
     * Funcion para obtener las paginas donde nos encontramos
     * @return array
     */
    public function getPage() {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $pagina = (explode('/', $url));
        return $pagina;
    }

    /**
     * Devuelve la ip del visitante
     * @return string IP
     */
    public function getReal_ip() {
        if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            return $_SERVER["HTTP_CLIENT_IP"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED"])) {
            return $_SERVER["HTTP_X_FORWARDED"];
        } elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_FORWARDED"])) {
            return $_SERVER["HTTP_FORWARDED"];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    public function listadoModelosIndex() {
        $sql = $this->db->select("SELECT v.id,
                                        m.descripcion as marca,
                                        v.modelo,
                                        v.version,
                                        v.ano,
                                        v.transmision,
                                        v.precio,
                                        v.fecha,
                                        c.descripcion AS condicion,
                                        com.descripcion AS combustible,
                                        vi.imagen,
                                        v.kilometraje
                                FROM vehiculo v
                                LEFT JOIN marca m ON m.id = v.id_marca
                                LEFT JOIN condicion c ON c.id = v.id_condicion
                                LEFT JOIN combustible com ON com.id = v.id_combustible
                                LEFT JOIN vehiculo_img vi ON vi.id_vehiculo = v.id
                                WHERE vi.principal = 1
                                ORDER BY v.id DESC
                                LIMIT " . CANT_REG);
        return $sql;
    }

    /**
     * 
     * @param int $per_page
     * @param int $page
     * @param string $table (tabla a obtener el maximo de registros)
     * @param string $section (ruta del mvc a paginar)
     * @return string
     */
    public function mostrarPaginador($per_page, $page, $table, $section, $condicion = NULL) {
        if (!empty($condicion)) {
            $query = $this->db->select("SELECT COUNT(*) as totalCount $condicion");
        } else {
            $query = $this->db->select("SELECT COUNT(*) as totalCount FROM $table where estado = 1");
        }
        $total = $query[0]['totalCount'];
        $adjacents = "2";

        $page = ($page == 0 ? 1 : $page);
        $start = ($page - 1) * $per_page;

        $prev = $page - 1;
        $next = $page + 1;
        $setLastpage = ceil($total / $per_page);
        $lpm1 = $setLastpage - 1;

        $paging = "";
        if ($setLastpage > 1) {
            $paging .= "<ul class='m-pagination'>";
            $paging .= "<li class='active'>Página $page de $setLastpage</li>";
            if ($setLastpage < 7 + ($adjacents * 2)) {
                for ($counter = 1; $counter <= $setLastpage; $counter++) {
                    if ($counter == $page)
                        $paging .= "<li class='active'>$counter</li>";
                    else
                        $paging .= '<li><a class="m-btn" href="' . URL . $section . '/' . $counter . '" data-size="small" data-color="secondary" data-border>' . $counter . '</a></li>';
                }
            }
            elseif ($setLastpage > 5 + ($adjacents * 2)) {
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $paging .= '<li class="active">' . $counter . '</li>';
                        else
                            $paging .= '<li><a class="m-btn" href="' . URL . $section . '/' . $counter . '" data-size="small" data-color="secondary" data-border>' . $counter . '</a></li>';
                    }
                    $paging .= "<li class='dot'>...</li>";
                    $paging .= '<li><a class="m-btn" href="' . URL . $section . '/' . $lpm1 . '" data-size="small" data-color="secondary" data-border>' . $lpm1 . '</a></li>';
                    $paging .= '<li><a class="m-btn" href ="' . URL . $section . '/' . $setLastpage . '" data-size="small" data-color="secondary" data-border>' . $setLastpage . '</a></li>';
                }
                elseif ($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $paging .= '<li><a class="m-btn" href ="' . URL . $section . '/1' . '" data-size="small" data-color="secondary" data-border>1</a></li>';
                    $paging .= '<li><a class="m-btn" href ="' . URL . $section . '/2' . '" data-size="small" data-color="secondary" data-border>2</a></li>';
                    $paging .= "<li class = 'dot'>...</li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $paging .= "<li class='active'>$counter</li>"
                            ;
                        else
                            $paging .= '<li><a class="m-btn" href ="' . URL . $section . '/' . $counter . '" data-size="small" data-color="secondary" data-border>' . $counter . '</a></li>';
                    }
                    $paging .= "<li class='dot'>..</li>";
                    $paging .= '<li><a class="m-btn" href="' . URL . $section . '/' . $lpm1 . '" data-size="small" data-color="secondary" data-border>' . $lpm1 . '</a></li>';
                    $paging .= '<li><a class="m-btn" href="' . URL . $section . '/' . $setLastpage . '" data-size="small" data-color="secondary" data-border>' . $setLastpage . '</a></li>';
                }
                else {
                    $paging .= '<li><a class="m-btn" href ="' . URL . $section . '/1' . '" data-size="small" data-color="secondary" data-border>1</a></li>';
                    $paging .= '<li><a class="m-btn" href ="' . URL . $section . '/2' . '" data-size="small" data-color="secondary" data-border>2</a></li>';
                    $paging .= "<li class = 'dot'>..</li>";
                    for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++) {
                        if ($counter == $page)
                            $paging .= "<li class='active'>$counter</li>"
                            ;
                        else
                            $paging .= '<li><a class="m-btn" href="' . URL . $section . '/' . $counter . '" data-size="small" data-color="secondary" data-border>' . $counter . '</a></li>';
                    }
                }
            }

            if ($page < $counter - 1) {
                $paging .= '<li><a class="m-btn" href="' . URL . $section . '/' . $next . '" data-size="small" data-color="secondary" data-border >Siguiente</a></li>';
                $paging .= '<li><a class="m-btn" href="' . URL . $section . '/' . $setLastpage . '" data-size="small" data-color="secondary" data-border>Ultima</a></li>';
            } else {
                $paging .= "<li class='active'>Siguiente</li>";
                $paging .= "<li class='active'>Ultima</li>";
            }

            $paging .= "</ul>";
        }

        return $paging;
    }

    public function ultimosVehiculos($limit = 3) {
        $sql = $this->db->select("select v.id,
                                        m.descripcion as marca,
                                        mo.descripcion as modelo,
                                        v.version, 
                                        v.ano, 
                                        v.transmision,
                                        v.precio,
                                        v.fecha,
                                        c.descripcion as condicion,
                                        com.descripcion as combustible,
                                        vi.imagen,
                                        v.kilometraje
                                from vehiculo v
                                LEFT JOIN modelo mo on mo.id = v.id_modelo
                                LEFT JOIN marca m on m.id = mo.id_marca
                                LEFT JOIN condicion c on c.id = v.id_condicion
                                LEFT JOIN combustible com on com.id = v.id_combustible
                                LEFT JOIN vehiculo_img vi on vi.id_vehiculo = v.id
                                where vi.principal = 1
                                ORDER BY v.id desc
                                LIMIT $limit");
        return $sql;
    }

    public function getSedes() {
        $sql = $this->db->select("select * from sede where estado = 1 ORDER BY id ASC");
        return $sql;
    }
    
    public function getEstado() {
        $sql = $this->db->select("select * from estado where estado = 1 ORDER BY descripcion ASC");
        return $sql;
    }

    public function getHorarioAtencion() {
        $sql = $this->db->select("select horario_atencion from sede where principal = 1");
        return $sql[0]['horario_atencion'];
    }

    public function getGardenMarcas() {
        $sql = $this->db->select("SELECT * FROM `marca` where garden = 1 and estado = 1;");
        return $sql;
    }

    public function getMarcas($filtro = NULL) {
        if (empty($filtro)) {
            $sql = $this->db->select("select id, descripcion from marca where estado = 1 ORDER BY descripcion ASC");
        } else {
            $sql = $this->db->select("select m.id, 
                                            m.descripcion 
                                    from marca m
                                    RIGHT JOIN modelo mo on mo.id_marca = m.id
                                    where m.estado = 1 
                                    GROUP BY m.descripcion, m.id
                                    ORDER BY m.descripcion ASC");
        }
        return $sql;
    }

    public function getMinMaxPrecio() {
        $sql = $this->db->select("select MAX(precio) as max, MIN(precio) as min from vehiculo");
        $data = array(
            'max' => $sql[0]['max'],
            'min' => $sql[0]['min']
        );
        return $data;
    }

    public function getTipoVehiculo($filtro = NULL) {
        if (empty($filtro)) {
            $sql = $this->db->select("select id, descripcion, img, img_hover from tipo_vehiculo where estado = 1 ORDER BY tv.descripcion ASC");
        } else {
            $sql = $this->db->select("select tv.id, tv.descripcion, tv.img, tv.img_hover 
                                    from tipo_vehiculo tv
                                    RIGHT JOIN vehiculo v on v.id_tipo_vehiculo = tv.id
                                    where tv.estado = 1
                                    GROUP BY tv.id, tv.descripcion
                                    ORDER BY tv.descripcion ASC");
        }
        return $sql;
    }

    public function getTipoCombusitble() {
        $sql = $this->db->select("select id, descripcion from combustible where estado = 1");
        return $sql;
    }
    
    public function getTipoTraccion() {
        $sql = $this->db->select("select * from tipo_traccion where estado = 1");
        return $sql;
    }

    public function loadBuscador() {
        $marcas = $this->getMarcas(1);
        $rangoPrecio = $this->getMinMaxPrecio();
        $tipoVehiculo = $this->getTipoVehiculo(1);
        $sede = $this->getSedes();
        $combustible = $this->getTipoCombusitble();
        $data = '<div class="col-lg-3 col-sm-4 col-xs-12">
                <aside class="b-items__aside">
                    <h2 class="s-title wow zoomInUp" style="font-size: 16px;" data-wow-delay="0.5s">REALIZA TU BÚSQUEDA</h2>
                    <div class="b-items__aside-main wow zoomInUp" data-wow-delay="0.5s">
                        <form method="POST" action="' . URL . 'busqueda/listado" id="frmBuscarVehiculo">
                            <div class="b-items__aside-main-body">
                                <div class="b-items__aside-main-body-item">
                                    <label>MARCA</label>
                                    <div>
                                        <select name="marca" class="m-select">
                                            <option value="" selected="">Cualquiera</option>';
        foreach ($marcas as $item) {
            $data .= '<option value="' . utf8_encode($item['id']) . '">' . utf8_encode($item['descripcion']) . '</option>';
        }
        $data .= '</select>
                                        <span class="fa fa-caret-down"></span>
                                    </div>
                                </div>
                                <div class="b-items__aside-main-body-item">
                                    <label>RANGO DE PRECIO</label>
                                    <div class="slider"></div>
                                    <input type="hidden" name="min" id="minUsados" value="' . ceil($rangoPrecio['min']) . '" class="j-min" />
                                    <input type="hidden" name="max" id="maxUsados" value="' . ceil($rangoPrecio['max']) . '" class="j-max" />
                                    <input type="hidden" name="realMinValue" id="realMinValue" value=""/>
                                    <input type="hidden" name="realMaxValue" id="realMaxValue" value=""/>
                                </div>
                                <div class="b-items__aside-main-body-item">
                                    <label>TIPO DE VEHICULO</label>
                                    <div>
                                        <select name="tipo_vehiculo" class="m-select">
                                            <option value="" selected="">Cualquiera</option>';
        foreach ($tipoVehiculo as $item) {
            $data .= '<option value="' . utf8_encode($item['id']) . '">' . utf8_encode($item['descripcion']) . '</option>';
        }
        $data .= '</select>
                                        <span class="fa fa-caret-down"></span>
                                    </div>
                                </div>
                                <div class="b-items__aside-main-body-item">
                                    <label>SEDE</label>
                                    <div>
                                        <select name="sede" class="m-select">
                                            <option value="" selected="">Cualquiera</option>';
        foreach ($sede as $item) {
            $data .= '<option value="' . utf8_encode($item['id']) . '">' . utf8_encode($item['descripcion']) . ' - ' . utf8_encode($item['ciudad']) . '</option>';
        }
        $data .= '</select>
                                        <span class="fa fa-caret-down"></span>
                                    </div>
                                </div>
                                <div class="b-items__aside-main-body-item">
                                    <label>COMBUSTIBLE</label>
                                    <div>
                                        <select name="combustible" class="m-select">
                                            <option value="" selected="">Todos</option>';
        foreach ($combustible as $item) {
            $data .= '<option value="' . utf8_encode($item['id']) . '">' . utf8_encode($item['descripcion']) . '</option>';
        }
        $data .= '  </select>
                                        <span class="fa fa-caret-down"></span>
                                    </div>
                                </div>
                            </div>
                            <footer class="b-items__aside-main-footer">
                                <button type="submit" class="btn m-btn" id="btn-BuscarVehiculos">BUSCAR VEHÍCULOS<span class="fa fa-angle-right"></span></button><br />
                            </footer>
                        </form>
                    </div>
                </aside>
            </div>';
        return $data;
    }

    public function getPermisosUsuario($id) {
        $sql = $this->db->select("SELECT aup.id_permiso, ap.descripcion as permiso
                                FROM admin_usuario_permiso aup 
                                LEFT JOIN admin_permiso ap on ap.id = aup.id_permiso
                                where id_usuario = $id;");
        return $sql[0];
    }

    public function getCantidadVehiculosTipo($tipo) {
        $sql = $this->db->select("select count(*) as cantidad from vehiculo where id_condicion = $tipo");
        return $sql[0]['cantidad'];
    }

    public function getCondicion() {
        $sql = $this->db->select("select * from condicion where estado = 1");
        return $sql;
    }

    function redimensionar($file, $nameFile, $ancho, $alto) {
        # se obtene la dimension y tipo de imagen 
        $datos = getimagesize($file);

        $ancho_orig = $datos[0]; # Anchura de la imagen original 
        $alto_orig = $datos[1];    # Altura de la imagen original 
        $tipo = $datos[2];

        if ($tipo == 1) { # GIF 
            if (function_exists("imagecreatefromgif"))
                $img = imagecreatefromgif($file);
            else
                return false;
        }
        else if ($tipo == 2) { # JPG 
            if (function_exists("imagecreatefromjpeg"))
                $img = imagecreatefromjpeg($file);
            else
                return false;
        }
        else if ($tipo == 3) { # PNG 
            if (function_exists("imagecreatefrompng"))
                $img = imagecreatefrompng($file);
            else
                return false;
        }

        # Se calculan las nuevas dimensiones de la imagen 
        if ($ancho_orig > $alto_orig) {
            $ancho_dest = $ancho;
            $alto_dest = ($ancho_dest / $ancho_orig) * $alto_orig;
        } else {
            $alto_dest = $alto;
            $ancho_dest = ($alto_dest / $alto_orig) * $ancho_orig;
        }

        // imagecreatetruecolor, solo estan en G.D. 2.0.1 con PHP 4.0.6+ 
        $img2 = @imagecreatetruecolor($ancho_dest, $alto_dest) or $img2 = imagecreate($ancho_dest, $alto_dest);

        // Redimensionar 
        // imagecopyresampled, solo estan en G.D. 2.0.1 con PHP 4.0.6+ 
        @imagecopyresampled($img2, $img, 0, 0, 0, 0, $ancho_dest, $alto_dest, $ancho_orig, $alto_orig) or imagecopyresized($img2, $img, 0, 0, 0, 0, $ancho_dest, $alto_dest, $ancho_orig, $alto_orig);

        // Crear fichero nuevo, según extensión. 
        if ($tipo == 1) // GIF 
            if (function_exists("imagegif"))
                imagegif($img2, "public/archivos/$nameFile", 60);
            else
                return false;

        if ($tipo == 2) // JPG 
            if (function_exists("imagejpeg"))
                imagejpeg($img2, "public/archivos/$nameFile", 60);
            else
                return false;

        if ($tipo == 3)  // PNG 
            if (function_exists("imagepng"))
                imagepng($img2, "public/archivos/$nameFile", 6);
            else
                return false;

        return true;
    }

    public function verificaEstado($tabla, $id, $campo = NULL) {
        $sql = $this->db->select("select estado from $tabla where id = $id");
        return $sql[0]['estado'];
    }

}
