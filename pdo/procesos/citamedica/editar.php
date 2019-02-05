<?php
    $citamedica_id = $_GET['id'];

     //check if form is submitted
     $error = false;
     if (isset($_POST['registrar_form'])) {
        $cedula_persona       = $_POST['cedula_persona'];
        $fecha_cita           = $_POST['fecha_cita'];
        $paciente_id          = $_POST['paciente_id'];
 
        
        
        $registrar_agendamiento = $pdo->prepare("UPDATE agendamiento 
                                                 SET paciente_id=:paciente_id, fecha_cita=:fecha_cita, estado='Agendada'
                                                 WHERE id=:id_citamedica");
        $registrar_agendamiento->bindParam(":paciente_id", $paciente_id);
        $registrar_agendamiento->bindParam(":fecha_cita", $fecha_cita);
        $registrar_agendamiento->bindParam(":id_citamedica", $citamedica_id);
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
                $successmsg = "¡Datos actualizados correctamente!";

            } else {
                $errormsg = "Error al registrar cita medica";
                print_r ($registrar_agendamiento->errorInfo()); // Developer Mode
            }
        }
    }




    // Actualizar informacion
        $citamedica_id = $_GET['id'];

        $citamedica_result=$pdo->prepare("SELECT *
                                        FROM agendamiento
                                        WHERE agendamiento.id=:citamedica_id");
        $citamedica_result->bindParam(":citamedica_id", $citamedica_id);
        $citamedica_result->execute();
        $result_citamedica = $citamedica_result->fetchAll();

        // Get Cedula Paciente
        $citamedica_paciente_id;
        $citamedica_fecha_cita;
        foreach( $result_citamedica as $row ) {
            $citamedica_paciente_id = $row["paciente_id"];
            $citamedica_fecha_cita = $row["fecha_cita"];
        }

        $persona_sql = $pdo->prepare("SELECT cedula
                                      FROM persona
                                      WHERE persona.id=:persona_id");
        $persona_sql->bindParam(":persona_id", $citamedica_paciente_id);
        $persona_sql->execute();
        $result_persona = $persona_sql->fetchAll();

        // Get Cedula Paciente
        $persona_paciente_cedula;
        foreach( $result_persona as $row ) {
            $persona_paciente_cedula = $row["cedula"];
        }

 



    if($citamedica_result->rowCount()>=1) {
        $fila_cm=$citamedica_result->fetch();

        echo '<!-- Notificaciones -->
        <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
        <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        <!-- EO / Notificaciones -->
    
        <form class="col-sm-12" role="form" action="" method="post" name="editform">
            <input type="hidden" name="paciente_id" value=' . $citamedica_paciente_id . '>
            <div class="col-sm-6 form-group">
                <label>Cédula<span class="text-danger req-mark">*</span></label>
                <input type="number" name="cedula_persona" id="cedula_persona" class="form-control" placeholder="Ingrese Cédula" value=' . $persona_paciente_cedula . '>
                <span class="text-danger validation-error"><?php if (isset($cedula_persona_error)) echo $cedula_persona_error; ?></span>
            </div>
            <div class="col-sm-6 form-group">
                <label>Fecha<span class="text-danger req-mark">*</span></label>
                <input type="date" name="fecha_cita" id="fecha_cita" class="form-control" placeholder="Ingrese Fecha de Fin" value=' . $citamedica_fecha_cita . '>
                <span class="text-danger validation-error"><?php if (isset($fecha_cita_error)) echo $fecha_cita_error; ?></span>
            </div>
            
            <!-- Botonera -->
            <div class="col-sm-12 reset-button">
                <input type="submit" name="registrar_form" id="registrar_form" value="Guardar" class="btn btn-success" />
            </div>
            <!-- EO / Botonera -->
        </form>';

    } else {
        echo "Ocurrio un error";
        print_r ($citamedica_result->errorInfo()); // Developer Mode
    }