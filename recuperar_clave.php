<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Sistema de Control - Inyecciones</title>

    <!-- Favicon and touch icons -->
    <link rel="icon" href="img/favicon.ico">
    

    <!-- Bootstrap -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap rtl -->
    <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
    <!-- Pe-icon-7-stroke -->
    <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
    <!-- style css -->
    <link href="assets/dist/css/stylehealth.min.css" rel="stylesheet" type="text/css"/>
    <!-- Theme style rtl -->
    <!--<link href="assets/dist/css/stylehealth-rtl.css" rel="stylesheet" type="text/css"/>-->
</head>
<body>
    <!-- Content Wrapper -->
    <div class="login-wrapper">
        <div class="container-center">
            <div class="panel panel-bd">
                <div class="panel-heading">
                    <div class="view-header">
                        <div class="header-icon">
                            <i class="pe-7s-unlock"></i>
                        </div>
                        <div class="header-title">
                            <h3>Recuperar Contraseña</h3>
                            <small><strong>Ingrese sus credenciales para recuperar contraseña.</strong></small>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
                    <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
                        <div class="form-group">
                            <label class="control-label" for="username">Usuario/Cédula</label>
                            <input type="text" placeholder="9999999999" title="Ingrese su número de cédula" required="" value="" name="cedula_persona" id="cedula_persona" class="form-control">
                            <span class="help-block small">Ingrese Usuario/Cédula</span>
                        </div>
                        <div class="form-group add-on">
                            <label class="control-label" for="password">Nueva Contraseña</label>
                            <div class="input-group add-on" style="display: flex;">
                                <input type="password" title="Ingrese su contraseña" placeholder="******" required="" value="" name="clave" id="clave" class="form-control" style="border-right: none;">
                                <span toggle="#clave" class="btn btn-default" onclick="togglePassword(this)" style="border-left: none;"><i class="glyphicon glyphicon-eye-open"></i></button>
                            </div>
                            <span class="help-block small">Contraseña</span>
                        </div>
                        <div>
                            <input type="submit" name="signup" id="signup" value="Actualizar" class="btn btn-warning" />
                            <a href="login.php" class="btn btn-success">Regresar</a>
                        </div>
                    </form>

                    <?php 
                        if(isset($_POST['cedula_persona']) && isset($_POST['clave'])) {
                            require "pdo/php/connect.php";
                            require_once "pdo/procesos/recuperar_clave.php";
                        }
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->
    <!-- jQuery -->
    <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
    <!-- bootstrap js -->
    <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/app.js" type="text/javascript"></script>
</body>
</html>