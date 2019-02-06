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
                                            <tr>
                                                <th colspan="20">Datos de las personas Vacunadas</th>
                                                <th colspan="14">Administrar Vacuna</th>
                                            </tr>
                                            <tr>
                                                <th rowspan="2"> Nombre y Apellido </th>
                                                <th rowspan="2"> Cédula </th>
                                                <th colspan="2">Sexo</th>
                                                <th colspan="2">Lugar de residencia habitual</th>
                                                <th colspan="6">Nacionalidad</th>
                                                <th colspan="8">Autoidentificacion etnica</th>
                                                <th colspan="2">6 a 11 meses</th>
                                                <th rowspan="2"> 1 año </th>
                                                <th rowspan="2"> 2 años </th>
                                                <th rowspan="2"> 3 años </th>
                                                <th rowspan="2"> 4 años </th>
                                                <th rowspan="2"> 65 años y más </th>
                                                <th rowspan="2"> Embarazadas </th>
                                                <th rowspan="2">Puerperas </th>
                                                <th rowspan="2">Personal de Salud</th>
                                                <th colspan="4">Enfermos de 5 a 64 años</th>
                                            </tr>
                                            <tr>
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
                                                <th>1.- Dosis</th>
                                                <th>2.- Dosis</th>
                                                <th>5 a 9 años</th>
                                                <th>10 a 19 años</th>
                                                <th>20 a 49 años</th>
                                                <th>50 a 64 años</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php require '../../pdo/procesos/repor/listar1.php';?>
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