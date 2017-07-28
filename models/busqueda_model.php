<?php

class Busqueda_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    public function listado($pagina) {
        $where = '';
        $alias = '';
        if (!empty($_SESSION['busqueda'])) {
            if (!empty($_SESSION['busqueda']['marca'])) {
                $where .= ' and m.id = ' . $_SESSION['busqueda']['marca'];
            }
            if ((!empty($_SESSION['busqueda']['min'])) && (!empty($_SESSION['busqueda']['max']))) {
                $where .= ' and v.precio BETWEEN ' . $_SESSION['busqueda']['min'] . ' and ' . $_SESSION['busqueda']['max'];
            }
            if (!empty($_SESSION['busqueda']['tipo_vehiculo'])) {
                $where .= ' and v.id_tipo_vehiculo = ' . $_SESSION['busqueda']['tipo_vehiculo'];
            }
            if (!empty($_SESSION['busqueda']['sede'])) {
                $where .= ' and v.id_sede = ' . $_SESSION['busqueda']['sede'];
            }
            if (!empty($_SESSION['busqueda']['combustible'])) {
                $where .= ' and v.id_combustible  = ' . $_SESSION['busqueda']['sede'];
            }
        }
        $setLimit = CANT_REG;
        $pageLimit = ($setLimit * $pagina) - $setLimit;
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
                                $where
                                ORDER BY v.id desc
                                LIMIT $pageLimit, $setLimit");
        $condicion = "from vehiculo v
                                LEFT JOIN modelo mo on mo.id = v.id_modelo
                                LEFT JOIN marca m on m.id = mo.id_marca
                                LEFT JOIN condicion c on c.id = v.id_condicion
                                LEFT JOIN combustible com on com.id = v.id_combustible
                                LEFT JOIN vehiculo_img vi on vi.id_vehiculo = v.id
                                where vi.principal = 1
                                $where";
        $data = array(
            'listado' => $sql,
            'paginador' => $this->helper->mostrarPaginador($setLimit, $pagina, 'vehiculo', 'busqueda/listado', $condicion)
        );
        return $data;
    }

}
