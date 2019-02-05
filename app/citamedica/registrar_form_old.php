<?php
if(!isset($_GET['id'])) {
        
    require "../../database/dbconnect.php"; //Borrar

    //Establece el error de validación como flag
    $error = false;

    //check if form is submitted
    if (isset($_POST['registrar_form'])) {
        $nombre       = $_POST['nombre'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin    = $_POST['fecha_fin'];
        $edad         = $_POST['edad'];
 
        
        $registrar_campana = $pdo->prepare("INSERT INTO campana(nombre, fecha_inicio, fecha_fin, edad, estado) 
                                            VALUES (:nombre, :fecha_inicio, :fecha_fin, :edad, '1')");
        $registrar_campana->bindParam(":nombre", $nombre);
        $registrar_campana->bindParam(":fecha_inicio", $fecha_inicio);
        $registrar_campana->bindParam(":fecha_fin", $fecha_fin);
        $registrar_campana->bindParam(":edad", $edad);
        // $registrar_campana->execute();

        // __________________________  VALIDACIONES  __________________________
        // ---------------  REQUERIDOS  ---------------
        
        if (empty($nombre)) {
            $nombre_error = "Campo Requerido";
            $error        = true;
        } else if (ctype_alpha(str_replace(' ', '', $nombre)) === false) {
            $nombre_error = 'El campo debe tener letras y espacios unicamente';
            $error        = true;
        }
        if (empty($fecha_inicio)) {
            $fecha_inicio_error = "Campo Requerido";
            $error        = true;
        }
        if (empty($fecha_fin)) {
            $fecha_fin_error = "Campo Requerido";
            $error        = true;
        } 
        if (empty($edad)) {
            $edad_error = "Campo Requerido";
            $error        = true;
        }   

        if (!$error) {
            if($registrar_campana->execute()) {
                $successmsg = "¡Registro exitoso!";

            } else {
                $errormsg = "Error al registrar campaña";
                print_r ($registrar_campana->errorInfo()); // Developer Mode
            }
        }
    }
?>
    <!-- Notificaciones -->
    <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
    <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
    <!-- EO / Notificaciones -->

    <div class="row">
        <div class="col-sm-6 form-group">
            <form action="lista.php" method="GET">
                <div class="col-md-12 no-padding">
                    <label>Cédula</label>
                </div>
                <div class="search-form-group col-md-12 no-padding">
                    <input type="number" name="cedula" id="cedula" class="search-control col-md-9" placeholder="Ingrese Cédula" value="">
                    <input type="submit" class="btn btn-success col-md-3" value="Buscar">
                </div>
            </form>
        </div>
        <div class="col-sm-6 form-group">
            <form id="editform" class="" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="editform">
                <div class="col-md-12 no-padding">
                    <label>Fecha de Cita Medica</label>
                </div>
                <div class="search-form-group col-md-12 no-padding">
                    <input type="date" name="fecha_cita" id="fecha_cita" class="search-control col-md-9" placeholder="Ingrese Fecha" value="">
                    <input type="submit" class="btn btn-success col-md-3" value="Guardar">
                </div>
            </form>
        </div>
            
        
    </div>

    <?php require_once "../../pdo/php/connect.php";?>
    <?php include '../../pdo/procesos/historial/datos_paciente.php';?>


<!-- EDIT -->
<?php 
    } else { 
?>
    <?php require_once "../../pdo/php/connect.php";?>
    <?php include "../../pdo/procesos/campana/editar.php"; ?>
<?php
       
    } 
?>
                           