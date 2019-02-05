<?php
session_start();

// if(isset($_SESSION['usr_id'])!="") {
// 	header("Location: index.php");
// }

include_once 'database/dbconnect.php';

// Conectar con PDO
$pdo = new PDO('mysql:host=localhost;dbname=proyectoministerio', 'root', '');

//Establece el error de validación como flag
$error = false;

//check if form is submitted
if (isset($_POST['registro_paciente'])) {

	$cedula_paciente	= mysqli_real_escape_string($con, $_POST['cedula_paciente']);
	$fecha_nacimiento	= mysqli_real_escape_string($con, $_POST['fecha_nacimiento']);
	$sexo				= mysqli_real_escape_string($con, $_POST['sexo']);
	$nacionalidad		= mysqli_real_escape_string($con, $_POST['nacionalidad']);
	$etnia				= mysqli_real_escape_string($con, $_POST['etnia']);
	$captacion			= mysqli_real_escape_string($con, $_POST['captacion']);
	$cedula_madre		= mysqli_real_escape_string($con, $_POST['cedula_madre']);
	$nombre_madre		= mysqli_real_escape_string($con, $_POST['nombre_madre']);
	
	// Nombre sólo puede contener caracteres alfabéticos y espacio (esto varia sgun requerimiento)
	// if (!preg_match("/^[a-zA-Z ]+$/",$usuario)) {
	// 	$error = true;
	// 	$usuario_error = "El nombre debe contener solo caracteres del alfabeto y espacio.";
	// }
    // if(strlen($cedula_paciente) < 10) {
	// 	$error        = true;
	// 	$cedula_paciente_error = "La cedula debe tener un mínimo de 10 caracteres.";
	// }
	// if(strlen($clave) < 1) {
	// 	$error = true;
	// 	$clave_error = "La contraseña debe tener un mínimo de 6 caracteres.";
	// }

	if (!$error) {
		if(mysqli_query($con, "INSERT INTO paciente(cedula_paciente,fecha_nacimiento,sexo,nacionalidad,etnia,captacion,cedula_madre,nombre_madre) VALUES('" . $cedula_paciente . "', '" . $fecha_nacimiento . "', '" . $sexo . "', '" . $nacionalidad . "', '" . $etnia . "', '" . $captacion . "', '" . $cedula_madre . "', '" . $nombre_madre . "')")) {
			//$successmsg = "¡Registrado exitosamente! <a href='login.php'>Click here to Login</a>";
			$successmsg = '
			  <div class="alert alert-success alert-dismissable fade in">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    Paciente registrado exitosamente!
			  </div>
			  ';
		} else {
			//$errormsg = "Error de registro. Vuelve a intentarlo más tarde.";
			$errormsg = '
			<div class="alert alert-danger alert-dismissable fade in">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    Error de registro!
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
		<div class="col-md-10 col-md-offset-1 well">
            <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="registro_pacienteform">
				<fieldset>
					<legend class="col-md-12">Registro de Paciente</legend>

					<div class="col-md-6">
						<div class="form-group">
							<label for="cedula_paciente">Cédula</label>
							<input type="number" name="cedula_paciente" placeholder="Número de Cédula" required value="<?php if($error) echo $cedula_paciente; ?>" class="form-control" />
							<span class="text-danger"><?php if (isset($cedula_paciente_error)) echo $cedula_paciente_error; ?></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="fecha_nacimiento">Fecha de Nacimiento</label>
							<input type="date" name="fecha_nacimiento" placeholder="Fecha de Nacimiento" required value="<?php if($error) echo $fecha_nacimiento; ?>" class="form-control" />
							<span class="text-danger"><?php if (isset($fecha_nacimiento_error)) echo $fecha_nacimiento_error; ?></span>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="sexo">Sexo</label>
							<!-- <input type="text" name="sexo" placeholder="Sexo" required value="<?php if($error) echo $sexo; ?>" class="form-control" /> -->

							<?php
								$generos = "SELECT * FROM sexo";
								$stmt_generos = $pdo->query( $generos );


								$dropdown = "<select name='sexo' class='form-control'>";
								foreach ($stmt_generos as $row) {
								  $dropdown .= "\r\n<option value='{$row['id']}'>{$row['nombre_sexo']}</option>";
								}
								$dropdown .= "\r\n</select>";
								echo $dropdown;
							?>

							<span class="text-danger"><?php if (isset($sexo_error)) echo $sexo_error; ?></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="nacionalidad">Nacionalidad</label>
							<!-- <input type="text" name="nacionalidad" placeholder="Nacionalidad" required value="<?php if($error) echo $nacionalidad; ?>" class="form-control" /> -->
							<?php
								$nacionalidades = "SELECT * FROM nacionalidad";
								$stmt_nacionalidades = $pdo->query( $nacionalidades );


								$dropdown = "<select name='nacionalidad' class='form-control'>";
								foreach ($stmt_nacionalidades as $row) {
								  $dropdown .= "\r\n<option value='{$row['id']}'>{$row['nombre_nacionalidad']}</option>";
								}
								$dropdown .= "\r\n</select>";
								echo $dropdown;
							?>

							<span class="text-danger"><?php if (isset($nacionalidad_error)) echo $nacionalidad_error; ?></span>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
							<label for="etnia">Etnia</label>
							<!-- <input type="text" name="etnia" placeholder="Etnia" required value="<?php if($error) echo $etnia; ?>" class="form-control" /> -->

							<?php
								$etnias = "SELECT * FROM etnia";
								$stmt_etnias = $pdo->query( $etnias );


								$dropdown = "<select name='etnia' class='form-control'>";
								foreach ($stmt_etnias as $row) {
								  $dropdown .= "\r\n<option value='{$row['id']}'>{$row['nombre_etnia']}</option>";
								}
								$dropdown .= "\r\n</select>";
								echo $dropdown;
							?>
							
							<span class="text-danger"><?php if (isset($etnia_error)) echo $etnia_error; ?></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="captacion">Captación</label>
							<!-- <input type="text" name="captacion" placeholder="Captación" required value="<?php if($error) echo $captacion; ?>" class="form-control" /> -->
							<?php
								$captaciones = "SELECT * FROM captacion";
								$stmt_captaciones = $pdo->query( $captaciones );


								$dropdown = "<select name='captacion' class='form-control'>";
								foreach ($stmt_captaciones as $row) {
								  $dropdown .= "\r\n<option value='{$row['id']}'>{$row['nombre_captacion']}</option>";
								}
								$dropdown .= "\r\n</select>";
								echo $dropdown;
							?>

							<span class="text-danger"><?php if (isset($captacion_error)) echo $captacion_error; ?></span>
						</div>
					</div>

					<hr>

					<div class="col-md-6">
						<div class="form-group">
							<label for="cedula_madre">Cédula Madre</label>
							<input type="number" name="cedula_madre" placeholder="Cédula Madre" required value="<?php if($error) echo $cedula_madre; ?>" class="form-control" />
							<span class="text-danger"><?php if (isset($cedula_madre_error)) echo $cedula_madre_error; ?></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="nombre_madre">Nombre Madre</label>
							<input type="text" name="nombre_madre" placeholder="Nombre Madre" required value="<?php if($error) echo $nombre_madre; ?>" class="form-control" />
							<span class="text-danger"><?php if (isset($nombre_madre_error)) echo $nombre_madre_error; ?></span>
						</div>
					</div>

					<div class="form-group">
						<input type="submit" name="registro_paciente" value="Registrar" class="btn btn-primary" />
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