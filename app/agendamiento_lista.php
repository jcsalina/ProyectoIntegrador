<?php
    session_start();

    include_once 'database/dbconnect.php';

    // Conectar con PDO
    $pdo = new PDO('mysql:host=localhost;dbname=proyectoministerio', 'root', '');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'principal_head.php';?>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <?php include 'principal_header.php';?>
        <!-- =============================================== -->
        <!-- Menu Principal -->
        <?php include 'principal_menu.php';?>
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
                    <h1>Citas Médicas</h1>
                    <small>Lista de Citas Médicas</small>
                    <ol class="breadcrumb hidden-xs">
                        <li><a href="index.html"><i class="pe-7s-home"></i> Inicio</a></li>
                        <li class="active">Citas Médicas</li>
                    </ol>
                </div>
            </section>
            <!-- EO / Content Header (Page header) -->

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-bd lobidrag">
                            <div class="panel-heading">
                                <div class="btn-group">
                                    <a class="btn btn-success" href="#"> <i class="fa fa-plus"></i> Nueva Cita Médica</a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="success">
                                            <tr>
                                                <th>Paciente</th>
                                                <th>Fecha Cita</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $agendamientos = "SELECT * FROM agendamiento";
                                                $stmt_agendamientos = $pdo->query( $agendamientos );

                                                foreach ($stmt_agendamientos as $row) {
                                                    $dropdown =     "<tr>".
                                                                        "<td>" . $row['paciente_id'] . "</td>".
                                                                        "<td>" . $row['fecha_cita'] . "</td>".
                                                                        "<td>" .
                                                                            "<button type='button' class='btn btn-info btn-xs' data-toggle='modal' data-target='#ordine'><i class='fa fa-pencil'></i>" .
                                                                            "</button>" .
                                                                            "<button type='button' class='btn btn-danger btn-xs' data-toggle='modal' data-target='#ordine'><i class='fa fa-trash-o'></i>" .
                                                                            "</button>" .
                                                                        "</td>" .
                                                                    "</tr>";
                                                    echo $dropdown;
                                                }
                                            ?>
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
        </div> 
        <!-- /.content-wrapper -->

    </div>
    <!-- ./wrapper -->
    
    <?php include 'principal_scripts.php';?>
</body>

</html>