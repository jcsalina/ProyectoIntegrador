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

    <form id="editform" class="col-sm-12" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="editform">
        <div class="col-sm-6 form-group">
            <label>Nombre<span class="text-danger req-mark">*</span></label>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese Nombre" value="">
            <span class="text-danger validation-error"><?php if (isset($nombre_error)) echo $nombre_error; ?></span>
        </div>
        <div class="col-sm-6 form-group">
            <label>Edad<span class="text-danger req-mark">*</span></label>
            <input type="number" name="edad" id="edad" class="form-control" placeholder="Ingrese edad" value="">
            <span class="text-danger validation-error"><?php if (isset($edad_error)) echo $edad_error; ?></span>
        </div>
        <div class="col-sm-6 form-group">
            <label>Fecha de Inicio<span class="text-danger req-mark">*</span></label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" placeholder="Ingrese Fecha de Inicio" value="">
            <span class="text-danger validation-error"><?php if (isset($fecha_inicio_error)) echo $fecha_inicio_error; ?></span>
        </div>
        <div class="col-sm-6 form-group">
            <label>Fecha de Fin</label>
            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" placeholder="Ingrese Fecha de Fin" value="">
            <span class="text-danger validation-error"><?php if (isset($fecha_fin_error)) echo $fecha_fin_error; ?></span>
        </div>
        
        <!-- Botonera -->
        <div class="col-sm-12 reset-button">
            <a onclick="resetForm('editform'); return false;" class="btn btn-warning">Limpiar</a>
            <input type="submit" name="registrar_form" id="registrar_form" value="Guardar" class="btn btn-success" />
        </div>
        <!-- EO / Botonera -->
    </form>

<!-- EDIT -->
<?php 
    } else { 
?>
    <?php require_once "../../pdo/php/connect.php";?>
    <?php include "../../pdo/procesos/campana/editar.php"; ?>
<?php
       
    } 
?>
                           