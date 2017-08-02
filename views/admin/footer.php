<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
    </div>
    <strong>Desarrollado por <a href="mailto:raul.ramirez@garden.com.py">Marketing</a>.</strong>
</footer>
</div>
<!-- ./wrapper -->
<!-- Modal -->
<div class="modal fade genericModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- /Modal -->
<!-- Bootstrap 3.3.6 -->
<script src="<?= PUBLIC_FOLDER; ?>admin/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= PUBLIC_FOLDER; ?>admin/dist/js/app.min.js"></script>
<?php
#cargamos los js de las vistas
if (isset($this->external_js)) {
    foreach ($this->external_js as $external) {
        echo '<script async defer src="' . $external . '"></script>';
    }
}
if (isset($this->public_js)) {
    foreach ($this->public_js as $public_js) {
        echo '<script type="text/javascript" src="' . URL . 'public/' . $public_js . '"></script>';
    }
}
if (isset($this->js)) {
    foreach ($this->js as $js) {
        echo '<script type="text/javascript" src="' . URL . 'views/' . $js . '"></script>';
    }
}
?>
</body>
</html>
