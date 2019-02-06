<aside class="main-sidebar">
    <!-- sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="image pull-left">
                <img src="/ProyectoIntegrador/assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
            </div>
            <div class="info">
                <h4>Bienveindo</h4>
                <p><?php echo $_SESSION['nombre']; ?></p><br>
                <p><?php echo $_SESSION['cargo']; ?></p>
            </div>
        </div>

        <!-- sidebar menu -->
        <ul class="sidebar-menu">
            <li class="active">
                <a href="/ProyectoIntegrador/index.php"><i class="fa fa-hospital-o"></i><span>Principal</span>
                </a>
            </li>
            <?php if( $_SESSION['cargo_id'] == '1') {?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-md"></i><span>Usuarios</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/ProyectoIntegrador/app/empleado/registrar.php">Registrar Usuario</a></li>
                    <li><a href="/ProyectoIntegrador/app/empleado/lista.php">Lista Usuarios</a></li>
                </ul>
            </li>
            <?php } ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i><span>Pacientes</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/ProyectoIntegrador/app/paciente/registrar.php">Registrar Paciente</a></li>
                    <li><a href="/ProyectoIntegrador/app/paciente/lista.php">Lista Pacientes</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-history"></i><span>Control de Vacunación</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/ProyectoIntegrador/app/historial/lista.php">Ingreso de Control de Vacunación</a></li>
                    <li><a href="/ProyectoIntegrador/app/fecha_control/lista.php">Ingreso de Fechas de Control</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-archive"></i> <span>Stock Productos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/ProyectoIntegrador/app/stock/insumos_registrar.php">Ingresar Stock Insumos</a></li>
                    <li><a href="/ProyectoIntegrador/app/stock/insumos_lista.php">Lista Stock Insumos</a></li>
                    <li><a href="/ProyectoIntegrador/app/stock/vacunas_registrar.php">Ingresar Stock Vacunas</a></li>
                    <li><a href="/ProyectoIntegrador/app/stock/vacunas_lista.php">Lista Stock Vacunas</a></li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-calendar-check-o"></i><span>Cita Medica</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/ProyectoIntegrador/app/citamedica/registrar.php">Registrar Cita</a></li>
                    <li><a href="/ProyectoIntegrador/app/citamedica/lista.php">Lista Citas</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-briefcase"></i><span>Campaña</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/ProyectoIntegrador/app/campana/registrar.php">Registrar Campaña</a></li>
                    <li><a href="/ProyectoIntegrador/app/campana/lista.php">Lista Campañas</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-briefcase"></i><span>Consulta</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/ProyectoIntegrador/app/consulta1/lista.php">Agendamiento por dia</a></li>
                    <li><a href="/ProyectoIntegrador/app/consulta2/lista.php">Informacion Paciente</a></li>
                    <!-- <li><a href="/ProyectoIntegrador/app/consulta/lista.php">Consulta</a></li> -->
                </ul>
            </li>
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i><span>Reportes</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/ProyectoIntegrador/app/repor/lista.php">Reporte 1</a></li>
                    <li><a href="/ProyectoIntegrador/app/repor/lista1.php">Reporte 2</a></li>
                </ul>
            </li> 
        </ul>
        <!-- /.sidebar -->

    </div>
</aside>
