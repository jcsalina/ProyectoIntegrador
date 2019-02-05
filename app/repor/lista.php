<?php
    include "../../pdo/procesos/seguridad.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../../app/general/principal_head.php';?>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <?php include '../../app/general/principal_header.php';?>
        <!-- =============================================== -->
        <!-- Menu Principal -->
        <?php include '../../app/general/principal_menu.php';?>
        <!-- =============================================== -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="header-icon">
                    <i class="pe-7s-box1"></i>
                </div>
                <div class="header-title">
                    <form action="#" method="get" class="sidebar-form search-box pull-right hidden-md hidden-lg hidden-sm">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <h1>Pacientes</h1>
                    <small>Lista de Pacientes</small>
                    <ol class="breadcrumb hidden-xs">
                        <li><a href="index.html"><i class="pe-7s-home"></i> Inicio</a></li>
                        <li class="active">Pacientes</li>
                    </ol>
                </div>
            </section>
            <!-- EO / Content Header (Page header) -->

            <!-- Main content -->
            <section class="content">
                <div class="row">
                     <?php
                        require_once "../../pdo/php/connect.php";
                    ?>
                    <div class="col-sm-12">
                        <div class="panel panel-bd lobidrag">
                            <div class="panel-heading">
                                <div class="btn-group new-instance-fix-btn">
                                    <a class="btn btn-success" href="registrar.php"> <i class="fa fa-plus"></i> Nuevo Paciente</a>
                                </div>
                                <?php
                                    $cedula = '';
                                    if(isset($_GET['cedula'])){
                                        $cedula = $_GET['cedula'];
                                    }
                                ?>
                                <!-- Search Form Group -->
                                <form action="lista.php" method="GET">
                                    <div class="btn-group col-sm-3 no-padding" style="margin-left:7px;">
                                        <div class="search-form-group col-md-10 no-padding">
                                            <input type="number" name="cedula" id="cedula" class="search-control col-md-8" placeholder="Ingrese Cédula" value="<?php echo $cedula ?>">
                                            <input type="submit" class="btn btn-success col-md-4" value="Buscar">
                                        </div>
                                    </div>
                                </form>
                                <!-- EO / Search Form Group -->
                            </div>
                            <?php 
                                if(isset($_GET['id'])){
                                    require_once "../../pdo/procesos/empleado/eliminar.php";
                                }
                            ?>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="success">
                                            <tr class="info">
                                                <th>Nombre y Apellido</th>
                                                <th>Cédula</th>
                                                <th>Fecha de Nacimiento</th>
                                                <th>Hombre</th>
                                                <th>Mujer</th>
                                                <th>Pertenece Distrito</th>
                                                <th>No Pertenece Distrito</th>
                                                <th>Ecuatoriano</th>
                                                <th>Colombiano</th>
                                                <th>Peruano</th>
                                                <th>Cubano</th>
                                                <th>Venezolano</th>
                                                <th>Otro</th>
                                                <th>Indigena</th>
                                                <th>Afro</th>
                                                <th>Negro/a</th>
                                                <th>Mulato/a</th>
                                                <th>Montubio/a</th>
                                                <th>Mestizo/a</th>
                                                <th>Blanco/a</th>
                                                <th>Otro</th>
                                                <th>BCG</th>
                                                <th>HBO</th>
                                                <th>Rotavirus 1</th>
                                                <th>Rotavirus 2</th>
                                                <th>Pentavalente 1</th>
                                                <th>Pentavalente 2</th>
                                                <th>Pentavalente 3</th>
                                                <th>Poliomielitis 1</th>
                                                <th>Poliomielitis 2</th>
                                                <th>Poliomielitis 3</th>
                                                <th>Neumococo 1</th>
                                                <th>Neumococo 2</th>
                                                <th>Neumococo 3</th>
                                                <th>SR</th>
                                                <th>SRP</th>
                                                <th>Varicela</th>
                                                <th>FA</th>
                                                <th>OPV</th>
                                                <th>Influenza</th>
                                                <th>Nacionalidad / Etnia</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php require '../../pdo/procesos/repor/listar.php';?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Paginacion -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->

            <!-- Modal Principal-->
            <div id="modal_editar" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    
                    <!-- Modal content-->
                    <div class="modal-content ">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h4 class="modal-title">Editar</h4>
                        </div>
                        <div class="modal-body">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-body">
                                    <!-- Form Registrar Empleado -->
                                    <?php include 'registrar_form.php';?>
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- EO / Modal Principal-->
        </div> 
        <!-- /.content-wrapper -->

        </div>
    <!-- ./wrapper -->
    
    <?php include '../../app/general/principal_scripts.php';?>
</body>
</html>