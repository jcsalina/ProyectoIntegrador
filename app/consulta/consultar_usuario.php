<?php
session_start();

// if(isset($_SESSION['usr_id'])!="") {
// 	header("Location: index.php");
// }

include_once 'database/dbconnect.php';

// Conectar con PDO
$pdo = new PDO('mysql:host=localhost;dbname=proyectoministerio', 'root', '');

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
					<legend class="col-md-12">Consultar Usuarios</legend>

					<?php
						$empleados = "SELECT * FROM empleado";
						$stmt_empleados = $pdo->query( $empleados );


						$dropdown = "<table class='table table-striped table-bordered table-hover'>
						<tr>
							<th>Cédula</th>
							<th>Usuario</th>
							<th>Clave</th>
							<th>Cargo</th>
							<th>Estado</th>
						</tr>";

						
						foreach ($stmt_empleados as $row) {
							
							$dropdown .= "<tr>".
											"<td>" . $row['cedula_em'] . "</td>".
											"<td>" . $row['usuario'] . "</td>".
											"<td>" . $row['clave'] . "</td>".
											"<td>" . $row['cargo'] . "</td>".
											"<td>" . $row['estado'] . "</td>".
										"</tr>";
						}
						$dropdown .= "\r\n</table>";
						echo $dropdown;
					?>

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