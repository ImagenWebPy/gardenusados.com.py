<?php

class Admin_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    public function listadoDTMarcas() {
        $sql = $this->db->select("select * from marca 
                                  ORDER BY garden desc, descripcion DESC");
        $datos = array();
        foreach ($sql as $item) {
            if (!empty($item['imagen'])) {
                $img = '<img class="img-responsive" src="' . IMG . 'logo/' . utf8_encode($item['imagen']) . '" alt="' . utf8_encode($item['descripcion']) . '">';
            } else {
                $img = '<img class="img-responsive" src="' . IMG . 'logo/no-disponible.jpg" alt="' . utf8_encode($item['descripcion']) . '">';
            }
            $btnEditar = '<a class="btn btn-app editDTMarca pointer btn-xs" data-id="' . $item['id'] . '"><i class="fa fa-edit"></i> Editar </a>';
            $url = '<a href="' . utf8_encode($item['url']) . '" target="_blank">' . utf8_encode($item['url']) . '</a>';
            array_push($datos, array(
                'marca' => utf8_encode($item['descripcion']),
                'imagen' => $img,
                'enlace' => $url,
                'editar' => $btnEditar
            ));
        }
        $json = '{"data": ' . json_encode($datos) . '}';
        return $json;
    }

    public function getEditarMarca($data) {
        $id = $data['id'];
        $sql = $this->db->select("select * from marca where id = $id");
        $checkedGarden = ($sql[0]['garden'] == 1) ? 'checked' : '';
        $checkedEstado = ($sql[0]['estado'] == 1) ? 'checked' : '';
        if (!empty($sql[0]['imagen'])) {
            $img = '<img class="img-responsive" src="' . IMG . 'logo/' . utf8_encode($sql[0]['imagen']) . '" alt="' . utf8_encode($sql[0]['descripcion']) . '">';
        } else {
            $img = '<img style="width: 276px; height: 174px;" src="' . IMG . 'logo/no-disponible.jpg" alt="' . utf8_encode($sql[0]['descripcion']) . '">';
        }
        $form = '<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Modificar Datos</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="' . URL . 'admin/saveEditarMarca" method="POST" enctype="multipart/form-data">
              <input type="hidden" value="' . $sql[0]['id'] . '" name="id">
              <div class="box-body">
                <div class="form-group">
                  <label>Nombre Marca</label>
                  <input type="text" name="descripcion" class="form-control" value="' . utf8_encode($sql[0]['descripcion']) . '" placeholder="Ingrese el nombre de la Marca">
                </div>
                <div class="form-group">
                  <label>Enlace</label>
                  <input type="text" name="url" class="form-control" value="' . utf8_encode($sql[0]['url']) . '" placeholder="Ingrese el enlace">
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="' . $sql[0]['garden'] . '" name="garden" ' . $checkedGarden . '> Pertenece al Grupo Garden
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="1" name="estado" ' . $checkedEstado . '> Estado
                  </label>
                </div>
                <div class="col-md-12">
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-warning"></i> Importante!</h4>
                        Solo se permiten imagenes <strong>.jpg,.png</strong>. Las imagenes se redimensionaran automaticamente al tamaño 276 x 174px.
                    </div>
                </div>
                <div class="html5fileupload imgMarca" data-form="true" data-valid-extensions="JPG,JPEG,jpg,png,jpeg" style="width: 100%; display: inline-block;">
                    <input type="file" name="file_archivo[]" />
                </div>
                <script>
                    $(".html5fileupload.imgMarca").html5fileupload();
                </script>
              </div>
              <div class="form-group">
              <h4>Imagen Actual</h4>
              <p>' . $img . '</p>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-block">Guardar Cambios</button>
              </div>
            </form>
          </div>';
        $datos = array(
            'marca' => utf8_encode($sql[0]['descripcion']),
            'contenido' => $form
        );
        return json_encode($datos);
    }

    public function saveEditarMarca($data) {
        $id = $data['id'];
        $sqlEstado = $this->helper->verificaEstado('marca', $id);
        if ($data['estado'] != $sqlEstado) {
            $estado = (!empty($sqlEstado)) ? 0 : 1;
        } else {
            $estado = $data['estado'];
        }
        if (!empty($data['imagen'])) {
            $update = array(
                "descripcion" => utf8_decode($data['descripcion']),
                "imagen" => $data['imagen'][0],
                "url" => utf8_decode($data['url']),
                "garden" => $data['garden'],
                "estado" => $estado,
            );
        } else {
            $update = array(
                "descripcion" => utf8_decode($data['descripcion']),
                "url" => utf8_decode($data['url']),
                "garden" => $data['garden'],
                "estado" => $estado,
            );
        }
        $this->db->update('marca', $update, "id = $id");
        Session::set('message', array(
            'type' => 'success',
            'mensaje' => 'Se ha actualizado correctamente los datos de ' . $data['descripcion']));
    }

    public function listadoDTModelos() {
        $sql = $this->db->select("select m.id, 
                                        m.descripcion,
                                        ma.descripcion as marca,
                                        m.estado
                                from modelo m
                                LEFT JOIN marca ma on ma.id = m.id_marca
                                ORDER BY ma.descripcion asc, m.descripcion asc");
        $datos = array();
        foreach ($sql as $item) {
            $id = $item['id'];
            if ($item['estado'] == 1) {
                $estado = '<a class="pointer btnCambiarEstado" data-id="' . $id . '" data-estado="1"><span class="label label-success">Activo</span></a>';
            } else {
                $estado = '<a class="pointer btnCambiarEstado" data-id="' . $id . '" data-estado="0"><span class="label label-danger">Inactivo</span></a>';
            }
            $btnEditar = '<a class="btn btn-app editDTModelo pointer btnSmall" data-id="' . $id . '"><i class="fa fa-edit"></i> Editar </a>';
            array_push($datos, array(
                'modelo' => utf8_encode($item['descripcion']),
                'marca' => utf8_encode($item['marca']),
                'estado' => $estado,
                'editar' => $btnEditar
            ));
        }
        $json = '{"data": ' . json_encode($datos) . '}';
        return $json;
    }

    public function getEditarModelo($data) {
        $id = $data['id'];
        $sql = $this->db->select("select m.id, 
                                        m.descripcion,
                                        m.id_marca,
                                        ma.descripcion as marca,
                                        m.estado
                                from modelo m
                                LEFT JOIN marca ma on ma.id = m.id_marca
                                where m.id = $id");
        $marcas = $this->helper->getMarcas();
        $checkedEstado = ($sql[0]['estado'] == 1) ? 'checked' : '';
        $form = '<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Modificar Datos</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="' . URL . 'admin/saveEditarModelo" method="POST" enctype="multipart/form-data">
              <input type="hidden" value="' . $sql[0]['id'] . '" name="id">
              <div class="box-body">
                <div class="form-group">
                  <label>Nombre Modelo</label>
                  <input type="text" name="descripcion" class="form-control" value="' . utf8_encode($sql[0]['descripcion']) . '" placeholder="Ingrese el nombre de la Marca">
                </div>
                <div class="form-group">
                    <label>Marca</label>
                    <select class="form-control" name="marca">';
        foreach ($marcas as $item) {
            $selected = ($item['id'] == $sql[0]['id_marca']) ? 'selected' : '';
            $form .= '  <option value="' . $item['id'] . '" ' . $selected . '>' . utf8_encode($item['descripcion']) . '</option>';
        }
        $form .= '  </select>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="1" name="estado" ' . $checkedEstado . '> Estado
                  </label>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-block">Guardar Cambios</button>
              </div>
            </form>
          </div>';
        $datos = array(
            'titulo' => utf8_encode($sql[0]['marca']) . ' - ' . utf8_encode($sql[0]['descripcion']),
            'contenido' => $form
        );
        return json_encode($datos);
    }

    public function saveEditarModelo($data) {
        $id = $data['id'];
        $sqlEstado = $this->helper->verificaEstado('modelo', $id);
        if ($data['estado'] != $sqlEstado) {
            $estado = (!empty($sqlEstado)) ? 0 : 1;
        } else {
            $estado = $data['estado'];
        }
        $update = array(
            "id_marca" => $data['id_marca'],
            "descripcion" => utf8_decode($data['descripcion']),
            "estado" => $estado
        );
        $this->db->update('modelo', $update, "id = $id");
        Session::set('message', array(
            'type' => 'success',
            'mensaje' => 'Se ha actualizado correctamente los datos del modelo ' . $data['descripcion']));
    }

    public function listadoDTCombustible() {
        $sql = $this->db->select("select * from combustible");
        $datos = array();
        foreach ($sql as $item) {
            $id = $item['id'];
            if ($item['estado'] == 1) {
                $estado = '<a class="pointer btnCambiarEstado" data-id="' . $id . '" data-estado="1"><span class="label label-success">Activo</span></a>';
            } else {
                $estado = '<a class="pointer btnCambiarEstado" data-id="' . $id . '" data-estado="0"><span class="label label-danger">Inactivo</span></a>';
            }
            $btnEditar = '<a class="btn btn-app editDTCombustible pointer btnSmall" data-id="' . $id . '"><i class="fa fa-edit"></i> Editar </a>';
            array_push($datos, array(
                'descripcion' => utf8_encode($item['descripcion']),
                'estado' => $estado,
                'editar' => $btnEditar
            ));
        }
        $json = '{"data": ' . json_encode($datos) . '}';
        return $json;
    }

    public function getEditarCombustible($data) {
        $id = $data['id'];
        $sql = $this->db->select("select * from combustible where id = $id");
        $checkedEstado = ($sql[0]['estado'] == 1) ? 'checked' : '';
        $form = '<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Modificar Datos</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="' . URL . 'admin/saveEditarCombustible" method="POST" enctype="multipart/form-data">
              <input type="hidden" value="' . $sql[0]['id'] . '" name="id">
              <div class="box-body">
                <div class="form-group">
                  <label>Combustible</label>
                  <input type="text" name="descripcion" class="form-control" value="' . utf8_encode($sql[0]['descripcion']) . '" placeholder="Ingrese el nombre de la Marca">
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="1" name="estado" ' . $checkedEstado . '> Estado
                  </label>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-block">Guardar Cambios</button>
              </div>
            </form>
          </div>';
        $datos = array(
            'titulo' => utf8_encode($sql[0]['descripcion']),
            'contenido' => $form
        );
        return json_encode($datos);
    }

    public function saveEditarCombustible($data) {
        $id = $data['id'];
        $sqlEstado = $this->helper->verificaEstado('combustible', $id);
        if ($data['estado'] != $sqlEstado) {
            $estado = (!empty($sqlEstado)) ? 0 : 1;
        } else {
            $estado = $data['estado'];
        }
        $update = array(
            "descripcion" => utf8_decode($data['descripcion']),
            "estado" => $estado
        );
        $this->db->update('combustible', $update, "id = $id");
        Session::set('message', array(
            'type' => 'success',
            'mensaje' => 'Se ha actualizado correctamente los datos del combustible ' . $data['descripcion']));
    }

    public function listadoDTCondicion() {
        $sql = $this->db->select("select * from condicion");
        $datos = array();
        foreach ($sql as $item) {
            $id = $item['id'];
            if ($item['estado'] == 1) {
                $estado = '<a class="pointer btnCambiarEstado" data-id="' . $id . '" data-estado="1"><span class="label label-success">Activo</span></a>';
            } else {
                $estado = '<a class="pointer btnCambiarEstado" data-id="' . $id . '" data-estado="0"><span class="label label-danger">Inactivo</span></a>';
            }
            $btnEditar = '<a class="btn btn-app editDTCondicion pointer btnSmall" data-id="' . $id . '"><i class="fa fa-edit"></i> Editar </a>';
            array_push($datos, array(
                'descripcion' => utf8_encode($item['descripcion']),
                'estado' => $estado,
                'editar' => $btnEditar
            ));
        }
        $json = '{"data": ' . json_encode($datos) . '}';
        return $json;
    }

    public function listadoDTTraccion() {
        $sql = $this->db->select("select * from tipo_traccion");
        $datos = array();
        foreach ($sql as $item) {
            $id = $item['id'];
            if ($item['estado'] == 1) {
                $estado = '<a class="pointer btnCambiarEstado" data-id="' . $id . '" data-estado="1"><span class="label label-success">Activo</span></a>';
            } else {
                $estado = '<a class="pointer btnCambiarEstado" data-id="' . $id . '" data-estado="0"><span class="label label-danger">Inactivo</span></a>';
            }
            $btnEditar = '<a class="btn btn-app editDTTraccion pointer btnSmall" data-id="' . $id . '"><i class="fa fa-edit"></i> Editar </a>';
            array_push($datos, array(
                'descripcion' => utf8_encode($item['descripcion']),
                'estado' => $estado,
                'editar' => $btnEditar
            ));
        }
        $json = '{"data": ' . json_encode($datos) . '}';
        return $json;
    }

    public function listadoDTTipoVehiculos() {
        $sql = $this->db->select("select * from tipo_vehiculo");
        $datos = array();
        foreach ($sql as $item) {
            $id = $item['id'];
            if (!empty($item['img'])) {
                $img = '<img src="' . IMG . 'siluetas/' . $item['img'] . '" alt="' . utf8_encode($item['descripcion']) . '">';
            } else {
                $img = '<img style="width: 50%;" src="' . IMG . 'logo/no-disponible.jpg" alt="' . utf8_encode($sql[0]['descripcion']) . '">';
            }
            if (!empty($item['img'])) {
                $img_hover = '<img src="' . IMG . 'siluetas/' . $item['img_hover'] . '" alt="' . utf8_encode($item['descripcion']) . '">';
            } else {
                $img_hover = '<img style="width: 50%;" src="' . IMG . 'logo/no-disponible.jpg" alt="' . utf8_encode($sql[0]['descripcion']) . '">';
            }
            if ($item['estado'] == 1) {
                $estado = '<a class="pointer btnCambiarEstado" data-id="' . $id . '" data-estado="1"><span class="label label-success">Activo</span></a>';
            } else {
                $estado = '<a class="pointer btnCambiarEstado" data-id="' . $id . '" data-estado="0"><span class="label label-danger">Inactivo</span></a>';
            }
            $btnEditar = '<a class="btn btn-app editDTTraccion pointer btnSmall" data-id="' . $id . '"><i class="fa fa-edit"></i> Editar </a>';
            array_push($datos, array(
                'tipo_vehiculo' => utf8_encode($item['descripcion']),
                'imagen' => $img,
                'imagen_hover' => $img_hover,
                'estado' => $estado,
                'editar' => $btnEditar
            ));
        }
        $json = '{"data": ' . json_encode($datos) . '}';
        return $json;
    }

    public function getEditarCondicion($data) {
        $id = $data['id'];
        $sql = $this->db->select("select * from condicion where id = $id");
        $checkedEstado = ($sql[0]['estado'] == 1) ? 'checked' : '';
        $form = '<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Modificar Datos</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="' . URL . 'admin/saveEditarCondicion" method="POST" enctype="multipart/form-data">
              <input type="hidden" value="' . $sql[0]['id'] . '" name="id">
              <div class="box-body">
                <div class="form-group">
                  <label>Condicion</label>
                  <input type="text" name="descripcion" class="form-control" value="' . utf8_encode($sql[0]['descripcion']) . '" placeholder="Ingrese la condicion">
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="1" name="estado" ' . $checkedEstado . '> Estado
                  </label>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-block">Guardar Cambios</button>
              </div>
            </form>
          </div>';
        $datos = array(
            'titulo' => utf8_encode($sql[0]['descripcion']),
            'contenido' => $form
        );
        return json_encode($datos);
    }

    public function getEditarTraccion($data) {
        $id = $data['id'];
        $sql = $this->db->select("select * from tipo_traccion where id = $id");
        $checkedEstado = ($sql[0]['estado'] == 1) ? 'checked' : '';
        $form = '<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Modificar Datos</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="' . URL . 'admin/saveEditarTraccion" method="POST" enctype="multipart/form-data">
              <input type="hidden" value="' . $sql[0]['id'] . '" name="id">
              <div class="box-body">
                <div class="form-group">
                  <label>Condicion</label>
                  <input type="text" name="descripcion" class="form-control" value="' . utf8_encode($sql[0]['descripcion']) . '" placeholder="Ingrese la condicion">
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="1" name="estado" ' . $checkedEstado . '> Estado
                  </label>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-block">Guardar Cambios</button>
              </div>
            </form>
          </div>';
        $datos = array(
            'titulo' => utf8_encode($sql[0]['descripcion']),
            'contenido' => $form
        );
        return json_encode($datos);
    }

    public function saveEditarCondicion($data) {
        $id = $data['id'];
        $sqlEstado = $this->helper->verificaEstado('condicion', $id);
        if ($data['estado'] != $sqlEstado) {
            $estado = (!empty($sqlEstado)) ? 0 : 1;
        } else {
            $estado = $data['estado'];
        }
        $update = array(
            "descripcion" => utf8_decode($data['descripcion']),
            "estado" => $estado
        );
        $this->db->update('condicion', $update, "id = $id");
        Session::set('message', array(
            'type' => 'success',
            'mensaje' => 'Se ha actualizado correctamente la condición ' . $data['descripcion']));
    }

    public function saveEditarTraccion($data) {
        $id = $data['id'];
        $sqlEstado = $this->helper->verificaEstado('condicion', $id);
        if ($data['estado'] != $sqlEstado) {
            $estado = (!empty($sqlEstado)) ? 0 : 1;
        } else {
            $estado = $data['estado'];
        }
        $update = array(
            "descripcion" => utf8_decode($data['descripcion']),
            "estado" => $estado
        );
        $this->db->update('tipo_traccion', $update, "id = $id");
        Session::set('message', array(
            'type' => 'success',
            'mensaje' => 'Se ha actualizado correctamente el tipo de tracción ' . $data['descripcion']));
    }

}
