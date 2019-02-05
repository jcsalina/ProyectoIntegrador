<?php
    
    include_once '../database/dbconnect.php';

//Establece el error de validación como flag
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
    $cedula_persona = mysqli_real_escape_string($con, $_POST['cedula_persona']);
	$nombre         = mysqli_real_escape_string($con, $_POST['nombre']);
	$apellido       = mysqli_real_escape_string($con, $_POST['apellido']);
	$correo         = mysqli_real_escape_string($con, $_POST['correo']);
	$direccion      = mysqli_real_escape_string($con, $_POST['direccion']);
	$telefono       = mysqli_real_escape_string($con, $_POST['telefono']);
	$usuario        = mysqli_real_escape_string($con, $_POST['usuario']);
	$clave          = mysqli_real_escape_string($con, $_POST['clave']);
	
	// Nombre sólo puede contener caracteres alfabéticos y espacio (esto varia sgun requerimiento)
	// if (!preg_match("/^[a-zA-Z ]+$/",$usuario)) {
	// 	$error = true;
	// 	$usuario_error = "El nombre debe contener solo caracteres del alfabeto y espacio.";
	// }
    // if(strlen($cedula_persona) < 10) {
	// 	$error                  = true;
	// 	$cedula_persona_error   = "La cedula debe tener un mínimo de 10 caracteres.";
	// }
	// if(strlen($clave) < 1) {
	// 	$error = true;
	// 	$clave_error = "La contraseña debe tener un mínimo de 6 caracteres.";
	// }

    $query      = mysqli_query($con, "INSERT INTO persona(cedula, nombre, apellido, correo, direccion, telefono) VALUES('" . $cedula_persona . "', '" . $nombre . "', '" . $apellido . "', '" . $correo . "', '" . $direccion . "', '" . $telefono . "' )");
    $query2     = mysqli_query($con, "INSERT INTO empleado(cedula_persona, usuario, clave, estado, cargo_id) VALUES('" . $cedula_persona . "', '" . $usuario . "', '" . $clave . "', '1', '2' )");

	//if (!$error) {
		if($query) {
			//$successmsg = "¡Registrado exitosamente! <a href='login.php'>Click here to Login</a>";
            $query2;
            $successmsg = '
			  <div class="alert alert-success alert-dismissable fade in">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>EXITO!</strong> ¡Registrado exitosamente!
			  </div>
			  ';
		} else {
			//$errormsg = "Error de registro. Vuelve a intentarlo más tarde.";
			$errormsg = '
			<div class="alert alert-danger alert-dismissable fade in">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>Error de registro!</strong> Verifique sus datos.
			</div>
			';
		}
	//}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Sistema de Control - Inyecciones</title>

    <!-- Favicon and touch icons -->
    <link rel="icon" href="../img/favicon.ico">
    
    <!-- Bootstrap -->
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap rtl -->
    <!--<link href="../assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
    <!-- Pe-icon-7-stroke -->
    <link href="../assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
    <!-- style css -->
    <link href="../assets/dist/css/stylehealth.min.css" rel="stylesheet" type="text/css"/>
    <!-- Theme style rtl -->
    <!--<link href="../assets/dist/css/stylehealth-rtl.css" rel="stylesheet" type="text/css"/>-->
</head>
<body>
    <!-- Content Wrapper -->
    <div class="login-wrapper">
        <div class="container-center lg">
            <div class="panel panel-bd">
                <div class="panel-heading">
                    <div class="view-header">
                        <div class="header-icon">
                            <i class="pe-7s-unlock"></i>
                        </div>
                        <div class="header-title">
                            <h3>Registro</h3>
                            <small><strong>Ingrese sus datos para registrarse.</strong></small>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
                    <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>

                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>Nombre</label>
                                <input type="text" value="" id="nombre" class="form-control" name="nombre">
                                <span class="help-block small">Nombre</span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Apellido</label>
                                <input type="text" value="" id="apellido" class="form-control" name="apellido">
                                <span class="help-block small">Apellido</span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Cédula</label>
                                <input type="number" value="" id="cedula_persona" class="form-control" name="cedula_persona">
                                <span class="help-block small">Número de Cédula</span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Correo</label>
                                <input type="email" value="" id="correo" class="form-control" name="correo">
                                <span class="help-block small">Correo Electrónico</span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Dirección</label>
                                <input type="text" value="" id="direccion" class="form-control" name="direccion">
                                <span class="help-block small">Ingrese su dirección</span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Teléfono</label>
                                <input type="number" value="" id="telefono" class="form-control" name="telefono">
                                <span class="help-block small">Ingrese número telefónico</span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Usuario</label>
                                <input type="text" value="" id="usuario" class="form-control" name="usuario">
                                <span class="help-block small">Nombre de usuario</span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Contraseña</label>
                                <input type="password" value="" id="clave" class="form-control" name="clave">
                                <span class="help-block small">Contraseña</span>
                            </div>
                        </div>
                        <div>
                            <input type="submit" name="signup" id="signup" value="Registrar" class="btn btn-warning" />
                            <a class="btn btn-primary" href="../login.php">Iniciar Sesión</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->
    <!-- jQuery -->
    <script src="../assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
    <!-- bootstrap js -->
    <script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>