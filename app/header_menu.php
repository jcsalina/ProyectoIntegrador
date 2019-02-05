
<?php if (isset($_SESSION['usr_id'])) { ?>
    <ul class="nav navbar-nav">
        <li class="active dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuarios <span class="caret"></span></a>
            <ul class="dropdown-menu">
            <li><a href="registrar_usuario.php">Registrar</a></li>
            <li><a href="consultar_usuario.php">Consultar</a></li>
            <li><a href="#">Editar</a></li>
            <li><a href="#">Eliminar</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pacientes <span class="caret"></span></a>
            <ul class="dropdown-menu">
            <li><a href="registrar_paciente.php">Registrar</a></li>
            <li><a href="consultar_paciente.php">Consultar</a></li>
            <li><a href="#">Editar</a></li>
            <li><a href="#">Eliminar</a></li>
            </ul>
        </li>
        <li><a href="#historial">Historial</a></li>
        <li><a href="#productos">Productos</a></li>
        <li><a href="#agendamiento">Agendamiento</a></li>
        <li><a href="#reportes">Reportes</a></li>
        <li><a href="#consultas">Consultas</a></li>
    </ul>
<?php } ?>