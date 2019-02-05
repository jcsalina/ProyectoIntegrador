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
                    <h1>Empleados</h1>
                    <small>Lista de Empleados</small>
                    <ol class="breadcrumb hidden-xs">
                        <li><a href="index.html"><i class="pe-7s-home"></i> Inicio</a></li>
                        <li class="active">Empleados</li>
                        <li class="active">Consultar</li>
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
                                    <a class="btn btn-success" href="registrar.php"> <i class="fa fa-plus"></i> Nuevo empleado</a>
                                </div>
                                <div class="btn-group">
                                    <?php
                                        require_once "../../pdo/php/connect.php";
                                        require_once "../../pdo/procesos/empleado/exportar.php";
                                    ?>
                                    <a class="btn btn-success" type="submit" href="lista.php?exportar=1"> <i class="fa fa-plus"></i> Exportar Excel</a>
                                    
                                </div>
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
                                                <th>Cédula</th>
                                                <th>Nombre Apellido</th>
                                                <th>Usuario</th>
                                                <th>Clave</th>
                                                <th>Estado</th>
                                                <th>Cargo</th>
                                                <th>Editar</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                require_once "../../pdo/procesos/empleado/listar.php";
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
                                    <?php include "../../app/empleado/registrar_form.php?id='".$fila['id']."'"; ?>
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

    <!-- Custom Script -->
    <script type="text/javascript">
        function eliminar_registro(id) {
            if (confirm("¿Está seguro de eliminar el usuario?")) {
                alert("Usuario eliminado");
                
                $.ajax({
                    type: 'POST',
                    url: 'eliminar.php',
                    dataType: 'text',
                    data: {id_registro: id},


                }).done(function(text){
                        //alert(text);
                    
                    // success: function (obj, textstatus) {
                    //     console.log("Ajax 2");
                    //     if( !('error' in obj) ) {
                    //         resultado = obj.result;
                    //         console.log(resultado)
                    //         location.reload();
                    //     }
                    //     else {
                    //         console.log("Ajax 3");
                    //         console.log(obj.error);
                    //     }
                    // }
                    location.reload();
                });
                
            } else {
                console.log("Cancelado")
            }
        }
    </script>
    
    <?php include '../../app/general/principal_scripts.php';?>
</body>

</html>