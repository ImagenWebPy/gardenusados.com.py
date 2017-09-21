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
            $id = $item['id'];
            if (!empty($item['imagen'])) {
                $img = '<img class="img-responsive" src="' . IMG . 'logo/' . utf8_encode($item['imagen']) . '" alt="' . utf8_encode($item['descripcion']) . '">';
            } else {
                $img = '<img class="img-responsive" src="' . IMG . 'logo/no-disponible.jpg" alt="' . utf8_encode($item['descripcion']) . '">';
            }
            $btnEditar = '<a class="btn btn-app editDTMarca pointer btn-xs" data-id="' . $id . '"><i class="fa fa-edit"></i> Editar </a>';
            $url = '<a href="' . utf8_encode($item['url']) . '" target="_blank">' . utf8_encode($item['url']) . '</a>';
            array_push($datos, array(
                "DT_RowId" => "marca_$id",
                'marca' => utf8_encode($item['descripcion']),
                'imagen' => $img,
                'enlace' => $url,
                'editar' => $btnEditar
            ));
        }
        $json = '{"data": ' . json_encode($datos) . '}';
        return $json;
    }

    public function listadoDTVehiculos() {
        $sql = $this->db->select("select v.id,
                                        ma.descripcion as marca,
                                        v.modelo,
                                        v.version,
                                        v.precio,
                                        v.fecha,
                                        v.estado,
                                        s.ciudad,
                                        s.descripcion as sede,
                                        v.estado,
                                        v.codigo
                                from vehiculo v
                                LEFT JOIN marca ma on ma.id = v.id_marca
                                LEFT JOIN sede s on s.id = v.id_sede
                                ORDER BY v.fecha DESC");
        $datos = array();
        foreach ($sql as $item) {
            $id = $item['id'];
            if ($sql[0]['estado'] == 1) {
                $estado = '<a class="pointer btnCambiarEstado" data-id="' . $id . '" data-estado="1"><span class="label label-success">Activo</span></a>';
            } else {
                $estado = '<a class="pointer btnCambiarEstado" data-id="' . $id . '" data-estado="0"><span class="label label-danger">Inactivo</span></a>';
            }
            $btn = '<a class="btn btn-app pointer btnEditarVehiculo btnSmall" data-id="' . $id . '"><i class="fa fa-edit"></i> Editar</a>';
            $btnDel = '<a class="btn btn-app pointer btnEliminarVehiculo btnSmall" data-id="' . $id . '"><i class="fa fa-ban" aria-hidden="true"></i> Eliminar</a>';
            if ($item['estado'] == 1) {
                $estado = '<a class="pointer btnCambiarEstado" data-id="' . $id . '" data-estado="1"><span class="label label-success">Activo</span></a>';
            } else {
                $estado = '<a class="pointer btnCambiarEstado" data-id="' . $id . '" data-estado="0"><span class="label label-danger">Inactivo</span></a>';
            }
            array_push($datos, array(
                "DT_RowId" => "vehiculo_$id",
                'id' => $id,
                'fecha' => date('d/m/Y', strtotime($item['fecha'])),
                'codigo' => utf8_encode($item['codigo']),
                'marca' => utf8_encode($item['marca']),
                'modelo' => utf8_encode($item['modelo']),
                'version' => utf8_encode($item['version']),
                'precio' => number_format($item['precio'], 0, ',', '.'),
                'sede' => utf8_encode($item['sede']) . ' ' . utf8_encode($item['ciudad']),
                'estado' => $estado,
                'accion' => $btn . ' | ' . $btnDel
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

    public function modalAgregarMarca() {
        $form = '<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Modificar Datos</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="' . URL . 'admin/addMarca" method="POST" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label>Nombre Marca</label>
                  <input type="text" name="descripcion" class="form-control" value="" placeholder="Ingrese el nombre de la Marca">
                </div>
                <div class="form-group">
                  <label>Enlace</label>
                  <input type="text" name="url" class="form-control" value="" placeholder="Ingrese el enlace">
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="" name="garden"> Pertenece al Grupo Garden
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="1" name="estado"> Estado
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
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-block">Agregar</button>
              </div>
            </form>
          </div>';
        $datos = array(
            'titulo' => 'Agregar Marca',
            'contenido' => $form
        );
        return json_encode($datos);
    }

    public function modalAgregarVehiculo() {
        $marcas = $this->helper->getMarcas();
        $combustible = $this->helper->getTipoCombusitble();
        $condicion = $this->helper->getCondicion();
        $tipoVehiculo = $this->helper->getTipoVehiculo();
        $tipoTraccion = $this->helper->getTipoTraccion();
        $sedes = $this->helper->getSedes();
        $estado = $this->helper->getEstado();
        $form = '<div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Modificar Vehículo</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="' . URL . 'admin/addVehiculo" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Marca</label>
                                        <select class="form-control" name="vehiculo[marca]" required>
                                            <option value="">Seleccione una Marca</option>';
        foreach ($marcas as $item) {
            $form .= '                      <option value="' . $item['id'] . '">' . utf8_encode($item['descripcion']) . '</option>';
        }
        $form .= '                      </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tipo de Vehículo</label>
                                        <select class="form-control" name="vehiculo[tipo]" required>
                                            <option value="">Seleccione un Tipo</option>';
        foreach ($tipoVehiculo as $item) {
            $form .= '                      <option value="' . $item['id'] . '">' . utf8_encode($item['descripcion']) . '</option>';
        }
        $form .= '                      </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Modelo</label>
                                        <input type="text" name="vehiculo[modelo]" class="form-control" value="" placeholder="Ingrese el modelo" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Versión</label>
                                        <input type="text" name="vehiculo[version]" class="form-control" value="" placeholder="Ingrese la versión">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tipo de Tracción</label>
                                        <select class="form-control" name="vehiculo[traccion]" required>
                                            <option value="">Seleccione una Tracción</option>';
        foreach ($tipoTraccion as $item) {
            $form .= '                      <option value="' . $item['id'] . '">' . utf8_encode($item['descripcion']) . '</option>';
        }
        $form .= '                      </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Condición</label>
                                        <select class="form-control" name="vehiculo[condicion]" required>
                                            <option value="">Seleccione una Condición</option>';
        foreach ($condicion as $item) {
            $form .= '                      <option value="' . $item['id'] . '">' . utf8_encode($item['descripcion']) . '</option>';
        }
        $form .= '                      </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Combustible</label>
                                        <select class="form-control" name="vehiculo[combustible]" required>
                                            <option value="">Seleccione un Combustible</option>';
        foreach ($combustible as $item) {
            $form .= '                      <option value="' . $item['id'] . '">' . utf8_encode($item['descripcion']) . '</option>';
        }
        $form .= '                      </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sede</label>
                                        <select class="form-control" name="vehiculo[sede]" required>
                                            <option value="">Seleccione una Sede</option>';
        foreach ($sedes as $item) {
            $form .= '                      <option value="' . $item['id'] . '">' . utf8_encode($item['descripcion']) . ' - ' . utf8_encode($item['ciudad']) . '</option>';
        }
        $form .= '                      </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mostrar</label>
                                        <select class="form-control" name="vehiculo[estado]" required>
                                            <option value="">Seleccione un Estado</option>
                                            <option value="1">Mostrar</option>
                                            <option value="0">Ocultar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Código</label>
                                        <input type="text" name="vehiculo[codigo]" class="form-control" value="" placeholder="Ingrese el Código">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Año</label>
                                        <input type="text" name="vehiculo[sno]" class="form-control" value="" placeholder="Ingrese el año">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Color</label>
                                        <input type="text" name="vehiculo[color]" class="form-control" value="" placeholder="Ingrese el color">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Transmisión</label>
                                        <input type="text" name="vehiculo[transmision]" class="form-control" value="" placeholder="Ingrese tipo de transmisión">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Motor</label>
                                        <input type="text" name="vehiculo[motor]" class="form-control" value="" placeholder="Ingrese el Motor">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Precio</label>
                                        <input type="number" name="vehiculo[precio]" class="form-control" value="" placeholder="Ingrese el precio">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kilometrajes</label>
                                        <input type="number" name="vehiculo[kilometraje]" class="form-control" value="" placeholder="Ingrese el kilometraje">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Cantidad Pasajeros</label>
                                        <input type="number" name="vehiculo[pasajeros]" class="form-control" value="" placeholder="Cantidad de Pasajeros">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Cuotas</label>
                                        <input type="text" name="vehiculo[cuotas]" class="form-control" value="" placeholder="Ingrese las cuotas">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Datos Adiconales</label>
                                        <textarea class="form-control" rows="3" name="vehiculo[adicionales]"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <h4>Imagenes</h4>
                                    <div class="alert alert-warning alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h4><i class="icon fa fa-warning"></i> Importante!</h4>
                                        Solo se permiten imagenes <strong>.jpg,.png</strong>. Las imagenes se redimensionaran automaticamente al tamaño 276 x 174px.
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="html5fileupload imgVehiculo" data-multiple="true" data-form="true" data-valid-extensions="JPG,JPEG,jpg,png,jpeg" style="width: 100%; display: inline-block;">
                                        <input type="file" name="file_archivo[]" />
                                    </div>
                                </div>
                                <script>
                                    $(".html5fileupload.imgVehiculo").html5fileupload();
                                </script>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                          <button type="submit" class="btn btn-primary btn-block">Agregar</button>
                        </div>
                    </form>
                </div>';
        $datos = array(
            'titulo' => 'Agregar Vehículo',
            'contenido' => $form
        );
        return json_encode($datos);
    }

    public function modalEditarVehiculo($data) {
        $id = $data['id'];
        $sql = $this->db->select("select * from vehiculo where id = $id");
        $marcas = $this->helper->getMarcas();
        $combustible = $this->helper->getTipoCombusitble();
        $condicion = $this->helper->getCondicion();
        $tipoVehiculo = $this->helper->getTipoVehiculo();
        $tipoTraccion = $this->helper->getTipoTraccion();
        $sedes = $this->helper->getSedes();
        $estado = $this->helper->getEstado();
        $checkedVendido = ($sql[0]['vendido'] == 1) ? 'checked' : '';
        if ($sql[0]['estado'] == 1) {
            $selectedMostrar = 'selected';
            $selectedOcultar = '';
        } else {
            $selectedMostrar = '';
            $selectedOcultar = 'selected';
        }
        $form = '<div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Modificar Vehículo</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="frmEditarVehiculo" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="vehiculo[id]" value="' . $id . '">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Marca</label>
                                        <select class="form-control" name="vehiculo[marca]" required>
                                            <option value="">Seleccione una Marca</option>';
        foreach ($marcas as $item) {
            $selected = ($item['id'] == $sql[0]['id_marca']) ? 'selected' : '';
            $form .= '                      <option value="' . $item['id'] . '" ' . $selected . '>' . utf8_encode($item['descripcion']) . '</option>';
        }
        $form .= '                      </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tipo de Vehículo</label>
                                        <select class="form-control" name="vehiculo[tipo]" required>
                                            <option value="">Seleccione un Tipo</option>';
        foreach ($tipoVehiculo as $item) {
            $selected = ($item['id'] == $sql[0]['id_tipo_vehiculo']) ? 'selected' : '';
            $form .= '                      <option value="' . $item['id'] . '" ' . $selected . '>' . utf8_encode($item['descripcion']) . '</option>';
        }
        $form .= '                      </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Modelo</label>
                                        <input type="text" name="vehiculo[modelo]" class="form-control" value="' . utf8_encode($sql[0]['modelo']) . '" placeholder="Ingrese el modelo" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Versión</label>
                                        <input type="text" name="vehiculo[version]" class="form-control" value="' . utf8_encode($sql[0]['version']) . '" placeholder="Ingrese la versión" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tipo de Tracción</label>
                                        <select class="form-control" name="vehiculo[traccion]" required>
                                            <option value="">Seleccione una Tracción</option>';
        foreach ($tipoTraccion as $item) {
            $selected = ($item['id'] == $sql[0]['id_tipo_traccion']) ? 'selected' : '';
            $form .= '                      <option value="' . $item['id'] . '" ' . $selected . '>' . utf8_encode($item['descripcion']) . '</option>';
        }
        $form .= '                      </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Condición</label>
                                        <select class="form-control" name="vehiculo[condicion]" required>
                                            <option value="">Seleccione una Condición</option>';
        foreach ($condicion as $item) {
            $selected = ($item['id'] == $sql[0]['id_condicion']) ? 'selected' : '';
            $form .= '                      <option value="' . $item['id'] . '" ' . $selected . '>' . utf8_encode($item['descripcion']) . '</option>';
        }
        $form .= '                      </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Combustible</label>
                                        <select class="form-control" name="vehiculo[combustible]" required>
                                            <option value="">Seleccione un Combustible</option>';
        foreach ($combustible as $item) {
            $selected = ($item['id'] == $sql[0]['id_combustible']) ? 'selected' : '';
            $form .= '                      <option value="' . $item['id'] . '" ' . $selected . '>' . utf8_encode($item['descripcion']) . '</option>';
        }
        $form .= '                      </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sede</label>
                                        <select class="form-control" name="vehiculo[sede]" required>
                                            <option value="">Seleccione una Sede</option>';
        foreach ($sedes as $item) {
            $selected = ($item['id'] == $sql[0]['id_sede']) ? 'selected' : '';
            $form .= '                      <option value="' . $item['id'] . '" ' . $selected . '>' . utf8_encode($item['descripcion']) . ' - ' . utf8_encode($item['ciudad']) . '</option>';
        }
        $form .= '                      </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mostrar</label>
                                        <select class="form-control" name="vehiculo[estado]" required>
                                            <option value="">Seleccione un Estado</option>
                                            <option value="1" ' . $selectedMostrar . '>Mostrar</option>
                                            <option value="0" ' . $selectedOcultar . '>Ocultar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Código</label>
                                        <input type="text" name="vehiculo[codigo]" class="form-control" value="' . utf8_encode($sql[0]['codigo']) . '" placeholder="Ingrese el Código">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Año</label>
                                        <input type="text" name="vehiculo[ano]" class="form-control" value="' . utf8_encode($sql[0]['ano']) . '" placeholder="Ingrese el año">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Color</label>
                                        <input type="text" name="vehiculo[color]" class="form-control" value="' . utf8_encode($sql[0]['color']) . '" placeholder="Ingrese el color">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Transmisión</label>
                                        <input type="text" name="vehiculo[transmision]" class="form-control" value="' . utf8_encode($sql[0]['transmision']) . '" placeholder="Ingrese tipo de transmisión">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Motor</label>
                                        <input type="text" name="vehiculo[motor]" class="form-control" value="' . utf8_encode($sql[0]['motor']) . '" placeholder="Ingrese el Motor">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Precio</label>
                                        <input type="number" name="vehiculo[precio]" class="form-control" value="' . round($sql[0]['precio']) . '" placeholder="Ingrese el precio">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kilometrajes</label>
                                        <input type="number" name="vehiculo[kilometraje]" class="form-control" value="' . round($sql[0]['kilometraje']) . '" placeholder="Ingrese el kilometraje">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Cantidad Pasajeros</label>
                                        <input type="number" name="vehiculo[pasajeros]" class="form-control" value="' . utf8_encode($sql[0]['cantidad_pasajeros']) . '" placeholder="Cantidad de Pasajeros">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Cuotas</label>
                                        <input type="text" name="vehiculo[cuotas]" class="form-control" value="' . utf8_encode($sql[0]['cuotas']) . '" placeholder="Ingrese las cuotas">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Datos Adiconales</label>
                                        <textarea class="form-control" rows="3" name="vehiculo[adicionales]">' . utf8_encode($sql[0]['adicionales']) . '</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="vehiculo[vendido]" value="1" ' . $checkedVendido . '> Vendido
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                          <button type="submit" class="btn btn-primary btn-block">Editar Contenido</button>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                                <h4>Agregar Nuevas Imagenes</h4>
                                <div class="alert alert-warning alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-warning"></i> Importante!</h4>
                                    Solo se permiten imagenes <strong>.jpg,.png</strong>. Las imagenes se redimensionaran automaticamente al tamaño 640 x 480px.
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="html5fileupload imgVehiculo" data-multiple="true" data-url="' . URL . 'admin/uploadImageVehiculo" data-valid-extensions="JPG,JPEG,jpg,png,jpeg" style="width: 100%; display: inline-block;">
                                <input type="file" name="file_archivo[]" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h4>Imagenes</h4>
                        </div>
                        <div class="col-md-12" id="listaImagenesVehiculos' . $id . '">';
        $form .= $this->helper->loadGalleryImage($id);
        $form .= '      </div>
                        <script>
                            $(".html5fileupload.imgVehiculo").html5fileupload({
                                data:{id:' . $id . '},
                                onAfterStartSuccess: function(response) {
                                    $("#listaImagenesVehiculos" + response.id).append(response.content);
                                }
                            });
                        </script>
                    </div>
                </div>';
        $datos = array(
            'titulo' => 'Editar Vehículo',
            'contenido' => $form
        );
        return json_encode($datos);
    }

    public function modalAgregarSede() {
        $form = '<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Modificar Datos</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="' . URL . 'admin/addSede" method="POST" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label>Nombre Sede</label>
                  <input type="text" name="descripcion" class="form-control" value="" placeholder="Ingrese el nombre de la Marca">
                </div>
                <div class="form-group">
                  <label>Ciudad</label>
                  <input type="text" name="ciudad" class="form-control" value="" placeholder="Ingrese el enlace">
                </div>
                <div class="form-group">
                  <label>Teléfono</label>
                  <input type="text" name="telefono" class="form-control" value="" placeholder="Ingrese el enlace">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" name="email" class="form-control" value="" placeholder="Ingrese el enlace">
                </div>
                <div class="form-group">
                  <label>Latitud</label>
                  <input type="text" name="latitud" class="form-control" value="" placeholder="Ingrese el enlace">
                </div>
                <div class="form-group">
                  <label>Longitud</label>
                  <input type="text" name="longitud" class="form-control" value="" placeholder="Ingrese el enlace">
                </div>
                <div class="form-group">
                  <label>Dirección</label>
                  <input type="text" name="direccion" class="form-control" value="" placeholder="Ingrese el enlace">
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="1" name="principal"> Principal
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="1" name="estado" checked> Estado
                  </label>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-block">Agregar</button>
              </div>
            </form>
          </div>';
        $datos = array(
            'titulo' => 'Agregar Marca',
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

    public function addMarca($data) {
        $this->db->insert('marca', array(
            'descripcion' => $data['descripcion'],
            'url' => $data['url'],
            'garden' => $data['garden'],
            'estado' => $data['estado']
        ));
        $id = $this->db->lastInsertId();
        return $id;
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

    public function listadoDTSedes() {
        $sql = $this->db->select("select s.id, 
                                        s.descripcion,
                                        s.ciudad,
                                        s.estado
                                from sede s
                                ORDER BY s.principal desc,s.descripcion asc");
        $datos = array();
        foreach ($sql as $item) {
            $id = $item['id'];
            if ($item['estado'] == 1) {
                $estado = '<a class="pointer btnCambiarEstado" data-id="' . $id . '" data-estado="1"><span class="label label-success">Activo</span></a>';
            } else {
                $estado = '<a class="pointer btnCambiarEstado" data-id="' . $id . '" data-estado="0"><span class="label label-danger">Inactivo</span></a>';
            }
            $btnEditar = '<a class="btn btn-app btnEditSede pointer btnSmall" data-id="' . $id . '"><i class="fa fa-edit"></i> Editar </a>';
            array_push($datos, array(
                'sede' => utf8_encode($item['descripcion']),
                'ciudad' => utf8_encode($item['ciudad']),
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

    public function addVehiculo($data) {
        #INSERTAMOS EL POST
        $this->db->insert('vehiculo', array(
            'id_marca' => $data['id_marca'],
            'id_combustible' => $data['id_combustible'],
            'id_condicion' => $data['id_condicion'],
            'id_tipo_vehiculo' => $data['id_tipo_vehiculo'],
            'id_tipo_traccion' => $data['id_tipo_traccion'],
            'id_sede' => $data['id_sede'],
            'codigo' => utf8_decode($data['codigo']),
            'modelo' => utf8_decode($data['modelo']),
            'version' => (!empty($data['version'])) ? utf8_decode($data['version']) : NULL,
            'ano' => (!empty($data['ano'])) ? utf8_decode($data['ano']) : NULL,
            'color' => (!empty($data['color'])) ? utf8_decode($data['color']) : NULL,
            'transmision' => utf8_decode($data['transmision']),
            'motor' => utf8_decode($data['motor']),
            'precio' => utf8_decode($data['precio']),
            'cuotas' => utf8_decode($data['cuotas']),
            'adicionales' => (!empty($data['adicionales'])) ? utf8_decode($data['adicionales']) : NULL,
            'kilometraje' => (!empty($data['kilometraje'])) ? $data['kilometraje'] : NULL,
            'cantidad_pasajeros' => (!empty($data['cantidad_pasajeros'])) ? $data['cantidad_pasajeros'] : NULL,
            'fecha' => $data['fecha'],
            'estado' => $data['estado']
        ));
        $id = $this->db->lastInsertId();
        return $id;
    }

    public function addVehiculoImg($data) {
        $id = $data['id'];
        #INSERTAMOS LAS IMAGENES
        $cantImagenes = count($data['imagenes']) - 1;
        for ($i = 0; $i <= $cantImagenes; $i ++) {
            $imgPrincipal = ($i == 0) ? 1 : 0;
            $this->db->insert('vehiculo_img', array(
                'id_vehiculo' => $id,
                'imagen' => $data['imagenes'][$i],
                'principal' => $imgPrincipal,
                'estado' => 1
            ));
        }
    }

    public function imgPrincipal($data) {
        $id = $data['id'];
        $imgActual = $this->helper->getImage($id);
        $idPost = $imgActual[0]['id_vehiculo'];
        $oldPrincipal = $this->db->select("select id from vehiculo_img where id_vehiculo = $idPost and principal = 1");
        $idOld = $oldPrincipal[0]['id'];
        if ($imgActual[0]['principal'] == 1) {
            $updatePrincipal = array(
                'principal' => 0
            );
        } else {
            $updatePrincipal = array(
                'principal' => 1
            );
        }
        $updatePrincipalOld = array(
            'principal' => 0
        );
        $btn = '<span class="label label-success">Principal</span>';
        $btnOld = '<span class="label label-warning">Principal</span>';
        if ($imgActual[0]['estado'] != 0) {
            $this->db->update('vehiculo_img', $updatePrincipal, "id = $id");
            $this->db->update('vehiculo_img', $updatePrincipalOld, "id = $idOld");
            $datos = array(
                'result' => true,
                'id' => $id,
                'content' => $btn,
                'id_old' => $idOld,
                'content_old' => $btnOld
            );
        } else {
            $datos = array(
                'result' => false
            );
        }
        return $datos;
    }

    public function mostrarImgBtn($data) {
        $id = $data['id'];
        $image = $this->helper->getImage($id);
        if ($image[0]['estado'] == 1) {
            $updateEstado = array(
                'estado' => 0
            );
            $labelBg = 'danger';
            $labelText = 'Oculto';
        } else {
            $updateEstado = array(
                'estado' => 1
            );
            $labelBg = 'success';
            $labelText = 'Mostrar';
        }
        $btn = '';
        if ($image[0]['principal'] != 1) {
            $this->db->update('vehiculo_img', $updateEstado, "id = $id");
            $btn = '<span class="label label-' . $labelBg . '">' . $labelText . '</span>';
        } else {
            $btn = '<span class="label label-success">Mostrar</span>';
        }
        $datos = array(
            'id' => $id,
            'content' => $btn
        );
        return $datos;
    }

    public function eliminarIMG($data) {
        $id = $data['id'];
        $imgActual = $this->helper->getImage($id);
        if ($imgActual[0]['principal'] != 1) {
            #Eliminamos la imagen del servidor
            unlink('public/archivos/' . $imgActual[0]['imagen']);
            #Elimamos de la BD
            $sth = $this->db->prepare("delete from vehiculo_img where id = :id");
            $sth->execute(array(
                ':id' => $id
            ));
            $datos = array(
                'result' => true,
                'id' => $id
            );
        } else {
            $datos = array(
                'result' => false
            );
        }
        return $datos;
    }

    public function modalEliminarVehiculo($data) {
        $id = $data['id'];
        $sql = $this->db->select("SELECT m.descripcion as marca, modelo, version FROM vehiculo v LEFT JOIN marca m on m.id = v.id_marca where v.id = $id");
        $form = '<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Datos del mensaje</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form role="form" id="frmEliminarVehiculo" method="POST">
                    <input type="hidden" name="vehiculo[id]" value="' . $id . '">
                    <div class="alert alert-danger alert-dismissible">
                        <h4><i class="icon fa fa-ban"></i> ¿Está seguro de que desea eliminar el siguiente vehículo "<strong>' . utf8_encode($sql[0]['marca']) . ' - ' . utf8_encode($sql[0]['modelo']) . ' ' . utf8_encode($sql[0]['version']) . '</strong>"?</h4>
                    </div>
                    <div class="box-footer">
                        <button type="submit" id="btnDeleteVehiculo" class="btn btn-danger" data-id="' . $id . '">Eliminar</button>
                    </div>
                </form>
            </div>
          </div>';
        $datos = array(
            'titulo' => 'Eliminar ' . utf8_encode($sql[0]['marca']) . ' - ' . utf8_encode($sql[0]['modelo']) . ' ' . utf8_encode($sql[0]['version']),
            'contenido' => $form
        );
        return json_encode($datos);
    }

    public function deleteVehiculo($data) {
        $id = $data['id'];
        $imagenes = $this->db->select("select * from vehiculo_img where id_vehiculo = $id");
        if (!empty($imagenes)) {
            $dir = "public/archivos/";
            foreach ($imagenes as $item) {
                unlink($dir . utf8_encode($item['imagen']));
            }
        }
        try {
            $sth = $this->db->prepare("delete from vehiculo where id = :id");
            $sth->execute(array(
                ':id' => $id
            ));
            $sthimg = $this->db->prepare("delete from vehiculo_img where id_vehiculo = :id");
            $sthimg->execute(array(
                ':id' => $id
            ));
            $datos = array(
                'type' => 'success',
                'id' => $id,
                'contenido' => ''
            );
        } catch (Exception $ex) {
            $datos = array(
                'type' => 'error',
                'id' => $id,
                'contenido' => 'Lo sentimos ha ocurrido un error, no se pudo eliminar el registro'
            );
        }
        return $datos;
    }

    public function uploadImageVehiculo($data) {
        $id = $data['id'];
        $this->db->insert('vehiculo_img', array(
            'id_vehiculo' => $id,
            'imagen' => $data['archivo'],
            'estado' => 1
        ));
        $id_img = $this->db->lastInsertId();
        $contenido = $this->helper->loadImage($id_img);
        $datos = array(
            "result" => true,
            'id' => $id,
            'content' => $contenido
        );
        return $datos;
    }

    public function editVehiculo($data) {
        $id = $data['id'];
        $estado = 1;
        if (empty($data['estado'])) {
            $estado = 0;
        }
        $update = array(
            'id_marca' => $data['id_marca'],
            'id_combustible' => $data['id_combustible'],
            'id_condicion' => $data['id_condicion'],
            'id_tipo_vehiculo' => $data['id_tipo_vehiculo'],
            'id_tipo_traccion' => $data['id_tipo_traccion'],
            'id_sede' => $data['id_sede'],
            'codigo' => utf8_decode($data['codigo']),
            'modelo' => utf8_decode($data['modelo']),
            'version' => utf8_decode($data['version']),
            'ano' => utf8_decode($data['ano']),
            'color' => utf8_decode($data['color']),
            'transmision' => utf8_decode($data['transmision']),
            'motor' => utf8_decode($data['motor']),
            'precio' => $data['precio'],
            'cuotas' => utf8_decode($data['cuotas']),
            'adicionales' => utf8_decode($data['adicionales']),
            'kilometraje' => utf8_decode($data['kilometraje']),
            'cantidad_pasajeros' => utf8_decode($data['cantidad_pasajeros']),
            'estado' => $data['estado'],
            'vendido' => $data['vendido']
        );
        $this->db->update('vehiculo', $update, "id = $id");

        #obtenemos la fila
        $sql = $this->db->select("select v.id,
                                        ma.descripcion as marca,
                                        v.modelo,
                                        v.codigo,
                                        v.version,
                                        v.precio,
                                        v.fecha,
                                        v.estado,
                                        s.ciudad,
                                        s.descripcion as sede,
                                        v.estado
                                from vehiculo v
                                LEFT JOIN marca ma on ma.id = v.id_marca
                                LEFT JOIN sede s on s.id = v.id_sede
                                where v.id = $id");
        if ($sql[0]['estado'] == 1) {
            $estado = '<a class="pointer btnCambiarEstado" data-id="' . $id . '" data-estado="1"><span class="label label-success">Activo</span></a>';
        } else {
            $estado = '<a class="pointer btnCambiarEstado" data-id="' . $id . '" data-estado="0"><span class="label label-danger">Oculto</span></a>';
        }
        $row = '<td class="sorting_1">' . $sql[0]['id'] . '</td>'
                . '<td >' . date('d/m/Y', strtotime($sql[0]['fecha'])) . '</td>'
                . '<td>' . utf8_encode($sql[0]['codigo']) . '</td>'
                . '<td>' . utf8_encode($sql[0]['marca']) . '</td>'
                . '<td>' . utf8_encode($sql[0]['modelo']) . '</td>'
                . '<td>' . utf8_encode($sql[0]['version']) . '</td>'
                . '<td>' . number_format($sql[0]['precio'], 0, ',', '.') . '</td>'
                . '<td>' . utf8_encode($sql[0]['sede']) . ' ' . utf8_encode($sql[0]['ciudad']) . '</td>'
                . '<td>' . $estado . '</td>'
                . '<td><a class="btn btn-app pointer btnEditarVehiculo btnSmall" data-id="' . $id . '"><i class="fa fa-edit"></i> Editar</a> '
                . '| <a class="btn btn-app pointer btnEliminarVehiculo btnSmall" data-id="' . $id . '"><i class="fa fa-ban" aria-hidden="true"></i> Eliminar</a></td>';
        $datos = array(
            'type' => 'success',
            'id' => $id,
            'row' => $row
        );
        return $datos;
    }

}
