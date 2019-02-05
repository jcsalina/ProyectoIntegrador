<?php
session_start();

if(isset($_SESSION['usr_id'])!="") {
	header("Location: index.php");
}

include_once 'database/dbconnect.php';

//Comprobar de envío el formulario
if (isset($_POST['login'])) {

	$cedula_em  = mysqli_real_escape_string($con, $_POST['cedula_em']);
	$clave      = mysqli_real_escape_string($con, $_POST['clave']);
    
    $result     = mysqli_query($con, "SELECT * FROM empleado WHERE cedula_em = '" . $cedula_em. "' and clave = '" .$clave . "'");


	if ($row = mysqli_fetch_array($result)) {
		//$_SESSION['usr_estado'] = $row['estado'];

		if($row['estado']==1){
			$_SESSION['usr_id'] = $row['id'];
            $_SESSION['usr_name'] = $row['usuario'];
			
			header("Location: index.php");
		}else
		$errormsg = "Esta cuenta esta desactivada";
	} else {
		$errormsg = "Revise sus datos";
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
        </div>
        <!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
				<fieldset>
					<legend>Iniciar Sesión</legend>
					<!--div class="form-group clearfix">
						<img src="http://www.iconsfind.com/wp-content/uploads/2016/10/20161014_58006bff8b1de.png" alt="" width="200px" class="img-responsive img-circle" style="margin:0 auto">
					</div-->

					<div class="form-group">
						<label for="name">Número de Cédula</label>
						<input type="text" name="cedula_em" placeholder="Ingresar número de cédula" required class="form-control" />
					</div>

					<div class="form-group">
						<label for="name">Contraseña</label>
						<input type="password" name="clave" placeholder="Ingresar contraseña" required class="form-control" />
					</div>

					<div class="form-group">
						<input type="submit" name="login" value="Iniciar Sesion" class="btn btn-primary" />
						<input type="reset" value="Limpiar" class="btn btn-default" >
					</div>
				</fieldset>
			</form>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		No tienes cuenta? <a href="register.php">Regitrate aqui</a>
		</div>
	</div>
</div>

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