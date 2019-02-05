<?php
if(!isset($_GET['id'])) {
        
    require "../../database/dbconnect.php"; //Borrar

    //Establece el error de validación como flag
    $error = false;

    //check if form is submitted
    if (isset($_POST['registrar_form'])) {
        $cedula_persona       = $_POST['cedula_persona'];
        $fecha_cita           = $_POST['fecha_cita'];
 
        $persona_sql = $pdo->prepare("SELECT id
                                      FROM persona
                                      WHERE persona.cedula=:cedula_persona");
        $persona_sql->bindParam(":cedula_persona", $cedula_persona);
        $persona_sql->execute();
        $result_persona = $persona_sql->fetchAll();

        // Get Paciente ID
        $persona_paciente_id;
        foreach( $result_persona as $row ) {
            $persona_paciente_id = $row["id"];
        }
        
        $registrar_agendamiento = $pdo->prepare("INSERT INTO agendamiento(paciente_id, fecha_cita, estado) 
                                                 VALUES (:paciente_id, :fecha_cita, 'Agendada')");
        $registrar_agendamiento->bindParam(":paciente_id", $persona_paciente_id);
        $registrar_agendamiento->bindParam(":fecha_cita", $fecha_cita);
        // $registrar_agendamiento->execute();

        // __________________________  VALIDACIONES  __________________________
        // ---------------  REQUERIDOS  ---------------
        
        if (empty($cedula_persona)) {
            $cedula_persona_error = "Campo Requerido";
            $error        = true;
        } else if(strlen($cedula_persona) > 10) {
            $error        = true;
            $cedula_persona_error = "La cedula debe tener un mínimo de 10 caracteres.";
        }
        if (empty($fecha_cita)) {
            $fecha_cita_error = "Campo Requerido";
            $error        = true;
        } 

        // PROCESOS BASE DE DATOS
        if (!$error) {
            if($registrar_agendamiento->execute()) {
                $successmsg = "¡Registro exitoso!";

            } else {
                $errormsg = "Error al registrar cita medica";
                print_r ($registrar_agendamiento->errorInfo()); // Developer Mode
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
            <label>Cédula<span class="text-danger req-mark">*</span></label>
            <input type="number" name="cedula_persona" id="cedula_persona" class="form-control" placeholder="Ingrese Cédula" value="">
            <span class="text-danger validation-error"><?php if (isset($cedula_persona_error)) echo $cedula_persona_error; ?></span>
        </div>
        <div class="col-sm-6 form-group">
            <label>Fecha<span class="text-danger req-mark">*</span></label>
            <input type="date" name="fecha_cita" id="fecha_cita" class="form-control" placeholder="Ingrese Fecha de Fin" value="">
            <span class="text-danger validation-error"><?php if (isset($fecha_cita_error)) echo $fecha_cita_error; ?></span>
        </div>
        
        <!-- Botonera -->
        <div class="col-sm-12 reset-button">
            <input type="submit" name="registrar_form" id="registrar_form" value="Guardar" class="btn btn-success" />
        </div>
        <!-- EO / Botonera -->
    </form>

<!-- EDIT -->
<?php 
    } else { 
?>
    <?php require_once "../../pdo/php/connect.php";?>
    <?php include "../../pdo/procesos/citamedica/editar.php"; ?>
<?php
       
    } 
?>
                           