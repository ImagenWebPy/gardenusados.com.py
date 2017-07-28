<?php

class Saldos_Model extends Model {

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
                                and c.id = 2
                                ORDER BY v.id desc
                                LIMIT $pageLimit, $setLimit");
        $condicion = "from vehiculo v
                                LEFT JOIN modelo mo on mo.id = v.id_modelo
                                LEFT JOIN marca m on m.id = mo.id_marca
                                LEFT JOIN condicion c on c.id = v.id_condicion
                                LEFT JOIN combustible com on com.id = v.id_combustible
                                LEFT JOIN vehiculo_img vi on vi.id_vehiculo = v.id
                                where vi.principal = 1
                                and c.id = 2";
        $data = array(
            'listado' => $sql,
            'paginador' => $this->helper->mostrarPaginador($setLimit, $page, 'vehiculo', 'saldos/listado',$condicion)
        );
        return $data;
    }

}
