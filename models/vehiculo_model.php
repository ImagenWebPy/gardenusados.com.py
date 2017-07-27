<?php

class Vehiculo_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    public function listado($pagina) {
        if (!empty($pagina)) {
            $page = $pagina;
        } else {
            $page = 2;
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
                                ORDER BY v.id desc
                                LIMIT $pageLimit, $setLimit");
        $data = array(
            'listado' => $sql,
            'paginador' => $this->helper->mostrarPaginador($setLimit, $page, 'vehiculo', 'vehiculo/listado')
        );
        return $data;
    }

    public function datosVehiculo($id) {
        $sqlDatos = $this->db->select("SELECT m.descripcion AS marca,
                                              mo.descripcion AS modelo,
                                              v.version,
                                              v.ano,
                                              v.transmision,
                                              v.precio,
                                              v.fecha,
                                              c.descripcion AS condicion,
                                              com.descripcion AS combustible,
                                              v.kilometraje,
                                              v.cantidad_pasajeros,
                                              tv.descripcion as tipo_vehiculo,
                                              tt.descripcion as traccion,
                                              v.motor,
                                              v.color,
                                              v.codigo,
                                              s.descripcion as sede,
                                              s.telefono,
                                              s.email,
                                              s.ciudad,
                                              v.adicionales,
                                              e.descripcion as estado
                                        FROM vehiculo v
                                        LEFT JOIN modelo mo ON mo.id = v.id_modelo
                                        LEFT JOIN marca m ON m.id = mo.id_marca
                                        LEFT JOIN condicion c ON c.id = v.id_condicion
                                        LEFT JOIN combustible com ON com.id = v.id_combustible
                                        LEFT JOIN tipo_vehiculo tv on tv.id = v.id_tipo_vehiculo
                                        LEFT JOIN tipo_traccion tt on tt.id = v.id_tipo_traccion
                                        LEFT JOIN sede s on s.id = v.id_sede
                                        LEFT JOIN estado e on e.id = v.id_estado
                                        WHERE v.id = $id");
        $sqlImagenes = $this->db->select("select imagen, principal from vehiculo_img where id_vehiculo = $id and estado = 1");
        $data['datos'] = array();
        $data['imagenes'] = array();
        foreach ($sqlDatos as $item) {
            array_push($data['datos'], array(
                'marca' => $item['marca'],
                'modelo' => $item['modelo'],
                'version' => $item['version'],
                'ano' => $item['ano'],
                'transmision' => $item['transmision'],
                'precio' => $item['precio'],
                'fecha' => $item['fecha'],
                'condicion' => $item['condicion'],
                'combustible' => $item['combustible'],
                'kilometraje' => $item['kilometraje'],
                'cantidad_pasajeros' => $item['cantidad_pasajeros'],
                'tipo_vehiculo' => $item['tipo_vehiculo'],
                'traccion' => $item['traccion'],
                'motor' => $item['motor'],
                'color' => $item['color'],
                'codigo' => $item['codigo'],
                'sede' => $item['sede'],
                'telefono' => $item['telefono'],
                'email' => $item['email'],
                'ciudad' => $item['ciudad'],
                'adicionales' => $item['adicionales'],
                'estado' => $item['estado']
            ));
        }
        foreach ($sqlImagenes as $item) {
            array_push($data['imagenes'], array(
                'imagen' => $item['imagen'],
                'principal' => $item['principal'],
            ));
        }
        return $data;
    }

}
