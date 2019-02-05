<?php
session_start();

// if(isset($_SESSION['usr_id'])!="") {
// 	header("Location: index.php");
// }

include_once 'database/dbconnect.php';

//Establece el error de validación como flag
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
    $cedula_em  = mysqli_real_escape_string($con, $_POST['cedula_em']);
	$usuario = mysqli_real_escape_string($con, $_POST['usuario']);
	$clave = mysqli_real_escape_string($con, $_POST['clave']);
	
	// Nombre sólo puede contener caracteres alfabéticos y espacio (esto varia sgun requerimiento)
	if (!preg_match("/^[a-zA-Z ]+$/",$usuario)) {
		$error = true;
		$usuario_error = "El nombre debe contener solo caracteres del alfabeto y espacio.";
	}
    if(strlen($cedula_em) < 10) {
		$error        = true;
		$cedula_em_error = "La cedula debe tener un mínimo de 10 caracteres.";
	}
	if(strlen($clave) < 1) {
		$error = true;
		$clave_error = "La contraseña debe tener un mínimo de 6 caracteres.";
	}

	if (!$error) {
		if(mysqli_query($con, "INSERT INTO empleado(cedula_em,cargo,usuario,clave,estado) VALUES('" . $cedula_em . "', '2', '" . $usuario . "', '" . $clave . "', '1')")) {
			//$successmsg = "¡Registrado exitosamente! <a href='login.php'>Click here to Login</a>";
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
	}
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.ico">

    <title>Sistema de Control - Inyecciones</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="css/bootstrap/bootstrap-theme.min.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/bootstrap/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/theme.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="js/bootstrap/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/bootstrap/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Sistema de Control</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
        <?php include 'header_menu.php';?>

        <ul class="nav navbar-nav navbar-right">
            <?php if (isset($_SESSION['usr_id'])) { ?>
                <li><p class="navbar-text">Bienvenido: <i class="btn btn-primary btn-xs" ><b><?php echo $_SESSION['usr_name']; ?></b></i></p></li>
                <li><a href="logout.php">Salir</a></li>
            <?php } else { ?>
                <li><a href="login.php">Iniciar Sesión</a></li>
                <li><a href="register.php">Registro</a></li>
            <?php } ?>
        </ul>
    </div><!--/.nav-collapse -->


  </div>
</nav>

<!-- container -->
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
            <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
				<fieldset>
					<legend>Registro de Usuario</legend>

					<div class="form-group">
						<label for="usuario">Usuario</label>
						<input type="text" name="usuario" placeholder="Nombre de Usuario" required value="<?php if($error) echo $usuario; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($usuario_error)) echo $usuario_error; ?></span>
					</div>
					
					<div class="form-group">
						<label for="name">Cédula</label>
						<input type="number" name="cedula_em" placeholder="Número de Cédula" required value="<?php if($error) echo $cedula_em; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($cedula_em_error)) echo $cedula_em_error; ?></span>
					</div>

					<div class="form-group">
						<label for="clave">Contraseña</label>
						<input type="password" name="clave" placeholder="Contraseña" required class="form-control" />
						<span class="text-danger"><?php if (isset($clave_error)) echo $clave_error; ?></span>
					</div>

                    <!-- <div class="form-group">
                        <label for="cargo">Cargo</label>
                        <select name="cargo" required class="form-control" onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
                            <option value="1">Administrador</option>
                            <option value="2">Enfermera</option>
                        </select>
                    </div> -->

					<div class="form-group">
						<input type="submit" name="signup" value="Registrar" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
			
		</div>
	</div>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/bootstrap/vendor/jquery.min.js"><\/script>')</script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/bootstrap/docs.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="js/bootstrap/ie10-viewport-bug-workaround.js"></script>
</body>
</html>