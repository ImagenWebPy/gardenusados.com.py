<?php

class Usados_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    public function listado($pagina) {
        if (!empty($pagina)) {
            $page = $pagina;
        } else {
            $page = 1;
        }
        $setLimit = CANT_REG;
        $pageLimit = ($setLimit * $page) - $setLimit;
        $sql = $this->db->select("select v.id,
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
                                and c.id = 1
                                ORDER BY v.id desc
                                LIMIT $pageLimit, $setLimit");
        $condicion = "FROM vehiculo v
                                LEFT JOIN marca m ON m.id = v.id_marca
                                LEFT JOIN condicion c ON c.id = v.id_condicion
                                LEFT JOIN combustible com ON com.id = v.id_combustible
                                LEFT JOIN vehiculo_img vi ON vi.id_vehiculo = v.id
                                WHERE vi.principal = 1
                                and c.id = 1";
        $data = array(
            'listado' => $sql,
            'paginador' => $this->helper->mostrarPaginador($setLimit, $page, 'vehiculo', 'usados/listado', $condicion)
        );
        return $data;
    }

}
