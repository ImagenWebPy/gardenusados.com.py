<div class="login-box">
    <div class="login-logo">
        <a href="#"><img src="<?= PUBLIC_FOLDER; ?>images/logo_usados.png"</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Inicie Sesión para Ingresar</p>
        <form action="<?= URL; ?>login/iniciar" method="post">
            <div class="form-group has-feedback">
                <input type="email" class="form-control" name="login[email]" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="login[password]" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->