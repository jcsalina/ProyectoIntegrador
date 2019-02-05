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
                    <h1>Control de Vacunación</h1>
                    <small>Control de Vacunación del Paciente</small>
                    <ol class="breadcrumb hidden-xs">
                        <li><a href="index.html"><i class="pe-7s-home"></i> Inicio</a></li>
                        <li class="active">Control de Vacunación</li>
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
                                <!-- <div class="btn-group">
                                    <a class="btn btn-success" href="registrar.php"> <i class="fa fa-plus"></i> Nuevo Paciente</a>
                                </div> -->
                            </div>
                            <?php
                                $cedula_persona = '';
                                if(isset($_GET['cedula'])){
                                    $cedula_persona = $_GET['cedula'];
                                }
                            ?>
                            <div class="panel-body">
                                <form action="lista.php" method="GET">
                                    <div class="row">
                                        <div class="col-sm-8 form-group">
                                            <div class="col-md-12 no-padding">
                                                <label>Cédula</label>
                                            </div>
                                            <div class="search-form-group col-md-10 no-padding">
                                                <input type="number" name="cedula" id="cedula" class="search-control col-md-5" placeholder="Ingrese Cédula" value="<?php echo $cedula_persona ?>">
                                                <input type="submit" class="btn btn-success col-md-2" value="Buscar">
                                            </div>

                                            <!-- <div class="search-form-group col-md-6">
                                                <input type="submit" class="btn btn-success col-md-4" value="Buscar">
                                            </div> -->
                                        </div>
                                    </div>
                                </form>
 
                                <?php require_once "../../pdo/php/connect.php";?>
                                <?php if(isset($_GET['cedula'])) {?>
                                    <?php include '../../pdo/procesos/historial/datos_paciente.php';?>
                                <?php }?>
                                
                                
                                <h2>Datos Del Paciente</h2>

                                <?php if(isset($_GET['cedula'])){ ?>

                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-6 no-padding">
                                            <span class="col-md-5 no-padding"><b>Nombres: </b></span>
                                            <span class="col-md-6 no-padding"><?php echo $paciente_nombre ?> <?php echo $paciente_apellido ?></span>
                                        </div>
                                        <div class="col-md-6 no-padding"></div>
                                    </div>
                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-6 no-padding">
                                            <span class="col-md-5 no-padding"><b>Dirección: </b></span>
                                            <span class="col-md-6 no-padding"><?php echo $paciente_direccion ?></span>
                                        </div>
                                        <div class="col-md-6 no-padding">
                                            <span class="col-md-5 no-padding"><b>Teléfono: </b></span>
                                            <span class="col-md-6 no-padding"><?php echo $paciente_telefono ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-6 no-padding">
                                            <span class="col-md-5 no-padding"><b>Fecha de Nacimiento: </b></span>
                                            <span class="col-md-6 no-padding"><?php echo $paciente_fecha_nacimiento ?> (<?php echo $paciente_edad ?> años)</span>
                                        </div>
                                        <div class="col-md-6 no-padding">
                                            <span class="col-md-5 no-padding"><b>Sexo: </b></span>
                                            <span class="col-md-6 no-padding"><?php echo $paciente_sexo ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-6 no-padding">
                                            <span class="col-md-5 no-padding"><b>Madre: </b></span>
                                            <span class="col-md-6 no-padding"><?php echo $paciente_madre_nombre ?></br><?php echo $paciente_madre_cedula ?></span>
                                        </div>
                                        <div class="col-md-6 no-padding">
                                            <span class="col-md-5 no-padding"><b>Padre: </b></span>
                                            <span class="col-md-6 no-padding"><?php echo $paciente_padre_nombre ?></br><?php echo $paciente_padre_cedula ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-6 no-padding">
                                            <span class="col-md-5 no-padding"><b>Nacionalidad/Etnia: </b></span>
                                            <span class="col-md-6 no-padding"><?php echo $paciente_nacionalidad ?></br><?php echo $paciente_etnia ?></span>
                                        </div>
                                        <div class="col-md-6 no-padding">
                                            <span class="col-md-5 no-padding"><b>Pertenece a Distrito: </b></span>
                                            <span class="col-md-6 no-padding"><?php echo $paciente_pertenece_distrito ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-6 no-padding">
                                            <span class="col-md-5 no-padding"><b>Captación: </b></span>
                                            <span class="col-md-6 no-padding"><?php echo $paciente_captacion ?></span>
                                        </div>
                                        <div class="col-md-6 no-padding">
                                        </div>
                                        <br>
                                        <br>
                                    </div>
                                <?php } else { ?>
                                    <span>Ingrese Numero de Cédula <br> <br></span>
                                <?php } ?>
                                <?php include '../../pdo/procesos/historial/registrar.php';?>
                                <form id="control_form" class="col-sm-12" role="form" action="" method="post" name="control_form">
                                    
                                    <h4>Tabla de Control</h4>
                                    <div class="table-responsive">
                                    
                                    <table class="table table-bordered table-hover">
                                            <thead class="success">
                                                <tr class="info">
                                                    <th>BCG</th>
                                                    <th>HBO</th>
                                                    <th>Rotavirus 1</th>
                                                    <th>Rotavirus 2</th>
                                                    <th>Penta 1</th>
                                                    <th>Penta 2</th>
                                                    <th>Penta 3</th>
                                                    <th>Poliomielitis 1</th>
                                                    <th>Poliomielitis 2</th>
                                                    <th>Poliomielitis 3</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php include '../../pdo/procesos/historial/tabla_control.php';?>
                                            </tbody>
                                        </table>
                                        <table class="table table-bordered table-hover">
                                            <thead class="success">
                                                <tr class="info">
                                                    <th>Neumococo 1</th>
                                                    <th>Neumococo 2</th>
                                                    <th>Neumococo 3</th>
                                                    <th>SR</th>
                                                    <th>SRP</th>
                                                    <th>Varicela</th>
                                                    <th>FA</th>
                                                    <th>OPV</th>
                                                    <th>Influenza</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php include '../../pdo/procesos/historial/tabla_control1.php';?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <br>
                               
                                
                                    <!-- Notificaciones -->
                                    <span class="text-success"><?php if (isset($successmsg_historial)) { echo $successmsg_historial; } ?></span>
                                    <span class="text-danger"><?php if (isset($errormsg_historial)) { echo $errormsg_historial; } ?></span>
                                    <!-- EO / Notificaciones -->
                                    <h4>Campaña</h4>
                                    
                                    <div class="col-sm-4 form-group">
                                        <label>Nombre<span class="text-danger req-mark">*</span></label>
                                        <?php
                                            if (isset($paciente_edad)) {
                                                $campana = "SELECT * FROM campana WHERE campana.edad >= $paciente_edad";
                                                $stmt_campana = $pdo->query( $campana );
    
                                                $dropdown = "<select name='campana' class='form-control'>";
                                                foreach ($stmt_campana as $row) {
                                                    $dropdown .= "\r\n<option value='{$row['id']}'>{$row['nombre']}</option>";
                                                }
                                                $dropdown .= "\r\n</select>";
                                                echo $dropdown;
                                            } else {
                                                $dropdown = "<select name='campana' class='form-control'>";
                                                $dropdown .= "\r\n<option value='0'>---</option>";
                                                $dropdown .= "\r\n</select>";
                                                echo $dropdown;
                                            }
                                        ?>
                                        <span class="text-danger validation-error"><?php if (isset($campana_error)) echo $campana_error; ?></span>
                                    </div>

                                    <div class="col-sm-4 form-group">
                                        <label>Fecha<span class="text-danger req-mark">*</span></label>
                                        <input type="date" name="fecha" id="fecha" class="form-control" style="border-right: none;" value="">
                                        <span class="text-danger validation-error"><?php if (isset($fecha_error)) echo $fecha_error; ?></span>
                                    </div>

                                    <div class="col-sm-4 form-group">
                                        <label>¿Recibió tratamiento completo?<span class="text-danger req-mark">*</span></label>
                                        <select name="boolean_tratamiento" id="boolean_tratamiento" class="form-control">
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>

                                    <!-- <br>
                                    <h4>¿Recibió tratamiento completo?</h4>
                                    <select name="boolean_tratamiento" id="boolean_tratamiento" class="form-control">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select> -->

                                    <br>
                                    <div class="col-sm-12 reset-button">
                                        <input type="submit" name="submit_historial" id="submit_historial" value="Guardar" class="btn btn-success" />
                                    </div>
                                </form>
                                
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

    <script>
        function showHint() {
            let cedula = document.getElementById('cedula').value;
            console.log(`Buscando: ${cedula}`);
            if (str.length == 0) { 
                document.getElementById("cedula").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("cedula").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "consulta_por_cedula.php?cedula=" + str, true);
                xmlhttp.send();
            }
        }

    </script>
</body>

</html>