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
                    <h1>Consultas</h1>
                    <small>Citas Agendadas por dia</small>
                    <ol class="breadcrumb hidden-xs">
                        <li><a href="index.html"><i class="pe-7s-home"></i> Inicio</a></li>
                        <li class="active">Consultas</li>
                        <li class="active">Agendamiento por dia</li>
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
                                
                                <?php
                                    $fecha_cita = '';
                                    $fecha_cita_hasta = '';
                                    if(isset($_GET['fecha_cita'])){
                                        $fecha_cita = $_GET['fecha_cita'];
                                        $fecha_cita_hasta = $_GET['fecha_cita_hasta'];
                                    }
                                ?>
                                <!-- Search Form Group -->
                                <form action="lista.php" method="GET">
                                    <div class="btn-group col-sm-8 no-padding" style="margin-left:7px;">
                                        <div class="search-form-group col-md-12 no-padding">
                                            <div class="col-md-4 no-padding">Desde</div>
                                            <div class="col-md-4 no-padding">Hasta</div>
                                        </div>
                                        <div class="search-form-group col-md-12 no-padding">
                                            <input type="date" name="fecha_cita" id="fecha_cita" class="search-control col-md-4" placeholder="Ingrese Fecha" value="<?php echo $fecha_cita ?>">
                                            <input type="date" name="fecha_cita_hasta" id="fecha_cita_hasta" class="search-control col-md-4" placeholder="Ingrese Fecha" value="<?php echo $fecha_cita_hasta ?>">
                                            <input type="submit" class="btn btn-success col-md-4" value="Buscar">
                                        </div>
                                    </div>
                                </form>
                                <!-- EO / Search Form Group -->
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="success">
                                            <tr class="info">
                                                <th>Cédula</th>
                                                <th>Nombre</th>
                                                <th>Fecha de Cita</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php require '../../pdo/procesos/consulta1/listar.php';?>
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
