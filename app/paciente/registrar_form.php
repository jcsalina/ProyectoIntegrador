<?php
if(!isset($_GET['id'])) {
        
    require "../../database/dbconnect.php"; //Borrar

    //Establece el error de validación como flag
    $error = false;

    //check if form is submitted
    if (isset($_POST['signup'])) {
        $cedula_persona         = $_POST['cedula_persona'];
        $nombre                 = $_POST['nombre'];
        $apellido               = $_POST['apellido'];
        $correo                 = $_POST['correo'];
        $direccion              = $_POST['direccion'];
        $telefono               = $_POST['telefono'];
        
        $fecha_nacimiento       = $_POST['fecha_nacimiento'];
        $sexo_id                = $_POST['sexo_id'];
        $cedula_padre           = $_POST['cedula_padre'];
        $nombre_padre           = $_POST['nombre_padre'];
        $cedula_madre           = $_POST['cedula_madre'];
        $nombre_madre           = $_POST['nombre_madre'];
        $etnia_id               = $_POST['etnia_id'];
        $nacionalidad_id        = $_POST['nacionalidad_id'];
        $captacion_id           = $_POST['captacion_id'];
        $pertenencia_distrito   = $_POST['pertenencia_distrito'];
        
        // REGISTRAR PERSONA
        $registrar_persona  = $pdo->prepare("INSERT INTO persona(cedula, nombre, apellido, correo, direccion, telefono) VALUES (:cedula_p, :nombre, :apellido, :correo, :direccion, :telefono)");
        $registrar_persona->bindParam(":cedula_p", $cedula_persona);
        $registrar_persona->bindParam(":nombre", $nombre);
        $registrar_persona->bindParam(":apellido", $apellido);
        $registrar_persona->bindParam(":correo", $correo);
        $registrar_persona->bindParam(":direccion", $direccion);
        $registrar_persona->bindParam(":telefono", $telefono);
        // $registrar_persona->execute();
        
        // REGISTRAR PACIENTE
        $registrar_paciente = $pdo->prepare("INSERT INTO paciente(cedula_persona, fecha_nacimiento, sexo_id, cedula_padre, nombre_padre, cedula_madre, nombre_madre, etnia_id, nacionalidad_id, captacion_id, pertenencia_distrito) VALUES (:cedula_p, :fecha_nacimiento, :sexo_id, :cedula_padre, :nombre_padre, :cedula_madre, :nombre_madre, :etnia_id, :nacionalidad_id, :captacion_id, :pertenencia_distrito)");
        $registrar_paciente->bindParam(":cedula_p", $cedula_persona);
        $registrar_paciente->bindParam(":fecha_nacimiento", $fecha_nacimiento);
        $registrar_paciente->bindParam(":sexo_id", $sexo_id);
        $registrar_paciente->bindParam(":cedula_padre", $cedula_padre);
        $registrar_paciente->bindParam(":nombre_padre", $nombre_padre);
        $registrar_paciente->bindParam(":cedula_madre", $cedula_madre);
        $registrar_paciente->bindParam(":nombre_madre", $nombre_madre);
        $registrar_paciente->bindParam(":etnia_id", $etnia_id);
        $registrar_paciente->bindParam(":nacionalidad_id", $nacionalidad_id);
        $registrar_paciente->bindParam(":captacion_id", $captacion_id);
        $registrar_paciente->bindParam(":pertenencia_distrito", $pertenencia_distrito);
        // $registrar_paciente->execute();
        
        // __________________________  VALIDACIONES  __________________________
        // ---------------  REQUERIDOS  ---------------
    

        if (empty($nombre)) {
            $nombre_error = "Campo Requerido";
            $error        = true;
        } else if (ctype_alpha(str_replace(' ', '', $nombre)) === false) {
            $nombre_error = 'El campo debe tener letras y espacios unicamente';
            $error        = true;
        }
        if (empty($apellido)) {
            $apellido_error = "Campo Requerido";
            $error        = true;
        } else if (ctype_alpha(str_replace(' ', '', $apellido)) === false) {
            $apellido_error = 'El campo debe tener letras y espacios unicamente';
            $error        = true;
        }
        if (empty($cedula_persona)) {
            $cedula_persona_error = "Campo Requerido";
            $error        = true;
        } else if(strlen($cedula_persona) > 10) {
            $error        = true;
            $cedula_persona_error = "La cedula debe tener un mínimo de 10 caracteres.";
        }
        if (empty($direccion)) {
            $direccion_error = "Campo Requerido";
            $error        = true;
        }
        if (empty($telefono)) {
            $telefono_error = "Campo Requerido";
            $error        = true;
        }
        if (empty($fecha_nacimiento)) {
            $fecha_nacimiento_error = "Campo Requerido";
            $error        = true;
        }
        if (empty($sexo_id)) {
            $sexo_id_error = "Campo Requerido";
            $error        = true;
        }
        if (empty($cedula_madre)) {
            $cedula_madre_error = "Campo Requerido";
            $error        = true;
        }
        if (empty($nombre_madre)) {
            $nombre_madre_error = "Campo Requerido";
            $error        = true;
        } else if (ctype_alpha(str_replace(' ', '', $nombre_madre)) === false) {
            $nombre_madre_error = 'El campo debe tener letras y espacios unicamente';
            $error        = true;
        }
        if (empty($etnia_id)) {
            $etnia_id_error = "Campo Requerido";
            $error        = true;
        }
        if (empty($nacionalidad_id)) {
            $nacionalidad_id_error = "Campo Requerido";
            $error        = true;
        }
        if (empty($captacion_id)) {
            $captacion_id_error = "Campo Requerido";
            $error        = true;
        }
        if (empty($pertenencia_distrito)) {
            $pertenencia_distrito_error = "Campo Requerido";
            $error        = true;
        }

        // ________________________  EO / VALIDACIONES  ________________________
        
        if (!$error) {
            if($registrar_persona->execute()) {
                if ($registrar_paciente->execute()) {
                    // REGISTRAR CONTROL
                    $paciente_id = $pdo->lastInsertId();
                    $registrar_control = $pdo->prepare("INSERT INTO control(paciente_id, BCG, HBO, rotavirus1, rotavirus2, pentavalente1, pentavalente2, pentavalente3, poliomielitis1, poliomielitis2, poliomielitis3, neumococo1, neumococo2, neumococo3, SR, SRP, varicela, FA, OPV, Influenza) VALUES (:paciente, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)");
                    $registrar_control->bindParam(":paciente", $paciente_id);
                    
                    if($registrar_control->execute()) {
                        $successmsg = "¡Registro exitoso!";
                    } else {
                        $errormsg = "Error al registrar Historial del Paciente";
                        print_r ($registrar_control->errorInfo()); // Developer Mode
                    }

                } else {
                    $errormsg = "Error al registrar Paciente.";
                    print_r ($registrar_paciente->errorInfo()); // Developer Mode
                }
                // $successmsg = '
                // <div class="alert alert-success alert-dismissable fade in">
                //     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                //     <strong>EXITO!</strong> ¡Registrado exitosamente!
                // </div>
                // ';
            } else {
                $errormsg = "Error al registrar Persona";
                print_r ($registrar_persona->errorInfo()); // Developer Mode
                // $errormsg = '
                // <div class="alert alert-danger alert-dismissable fade in">
                //     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                //     <strong>Error!</strong> Verifique sus datos.
                // </div>
                // ';
            }
        }

    }
    ?>

    <!-- Notificaciones -->
    <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
    <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
    <!-- EO / Notificaciones -->

    <form id="signupform" class="col-sm-12" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
        <div class="col-sm-6 form-group">
            <label>Nombre<span class="text-danger req-mark">*</span></label>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese Nombre" value="">
            <span class="text-danger validation-error"><?php if (isset($nombre_error)) echo $nombre_error; ?></span>
        </div>
        <div class="col-sm-6 form-group">
            <label>Apellido<span class="text-danger req-mark">*</span></label>
            <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Ingrese Apellido" value="">
            <span class="text-danger validation-error"><?php if (isset($apellido_error)) echo $apellido_error; ?></span>
        </div>
        <div class="col-sm-6 form-group">
            <label>Cédula<span class="text-danger req-mark">*</span></label>
            <input type="number" name="cedula_persona" id="cedula_persona" class="form-control" placeholder="Ingrese Número de Cédula" value="">
            <span class="text-danger validation-error"><?php if (isset($cedula_persona_error)) echo $cedula_persona_error; ?></span>
        </div>
        <div class="col-sm-6 form-group">
            <label>Correo</label>
            <input type="email" name="correo" id="correo" class="form-control" placeholder="Ingrese Correo Electrónico" value="">
            <span class="text-danger validation-error"><?php if (isset($correo_error)) echo $correo_error; ?></span>
        </div>
        <div class="col-sm-6 form-group">
            <label>Dirección<span class="text-danger req-mark">*</span></label>
            <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingrese Dirección" value="">
            <span class="text-danger validation-error"><?php if (isset($direccion_error)) echo $direccion_error; ?></span>
        </div>
        <div class="col-sm-6 form-group">
            <label>Teléfono<span class="text-danger req-mark">*</span></label>
            <input type="number" name="telefono" id="telefono" class="form-control" placeholder="Ingrese Teléfono" value="">
            <span class="text-danger validation-error"><?php if (isset($telefono_error)) echo $telefono_error; ?></span>
        </div>
        
        <!-- ___________________________________________ -->

        <div class="col-sm-6 form-group">
            <label>Fecha de Nacimiento<span class="text-danger req-mark">*</span></label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" placeholder="Ingrese Fecha de Nacimiento" value="">
            <span class="text-danger validation-error"><?php if (isset($fecha_nacimiento_error)) echo $fecha_nacimiento_error; ?></span>
        </div>
        <div class="col-sm-6 form-group">
            <label>Sexo<span class="text-danger req-mark">*</span></label>
            <?php
                $generos = "SELECT * FROM sexo";
                $stmt_generos = $pdo->query( $generos );


                $dropdown = "<select name='sexo_id' class='form-control'>";
                foreach ($stmt_generos as $row) {
                    $dropdown .= "\r\n<option value='{$row['id']}'>{$row['nombre']}</option>";
                }
                $dropdown .= "\r\n</select>";
                echo $dropdown;
            ?>
            <span class="text-danger validation-error"><?php if (isset($sexo_id_error)) echo $sexo_id_error; ?></span>
        </div>
        <div class="col-sm-6 form-group">
            <label>Cédula Padre</label>
            <input type="number" name="cedula_padre" id="cedula_padre" class="form-control" placeholder="Ingrese Cédula Padre" value="">
            <span class="text-danger validation-error"><?php if (isset($cedula_padre_error)) echo $cedula_padre_error; ?></span>
        </div>
        <div class="col-sm-6 form-group">
            <label>Nombre Padre</label>
            <input type="text" name="nombre_padre" id="nombre_padre" class="form-control" placeholder="Ingrese Nombre Padre" value="">
            <span class="text-danger validation-error"><?php if (isset($nombre_padre_error)) echo $nombre_padre_error; ?></span>
        </div>
        <div class="col-sm-6 form-group">
            <label>Cédula Madre<span class="text-danger req-mark">*</span></label>
            <input type="number" name="cedula_madre" id="cedula_madre" class="form-control" placeholder="Ingrese Cédula Madre" value="">
            <span class="text-danger validation-error"><?php if (isset($cedula_madre_error)) echo $cedula_madre_error; ?></span>
        </div>
        <div class="col-sm-6 form-group">
            <label>Nombre Madre<span class="text-danger req-mark">*</span></label>
            <input type="text" name="nombre_madre" id="nombre_madre" class="form-control" placeholder="Ingrese Nombre Madre" value="">
            <span class="text-danger validation-error"><?php if (isset($nombre_madre_error)) echo $nombre_madre_error; ?></span>
        </div>
        <div class="col-sm-6 form-group">
            <label>Etnia<span class="text-danger req-mark">*</span></label>
            <?php
                $etnias = "SELECT * FROM etnia";
                $stmt_etnias = $pdo->query( $etnias );


                $dropdown = "<select name='etnia_id' class='form-control'>";
                foreach ($stmt_etnias as $row) {
                    $dropdown .= "\r\n<option value='{$row['id']}'>{$row['nombre']}</option>";
                }
                $dropdown .= "\r\n</select>";
                echo $dropdown;
            ?>
            <span class="text-danger validation-error"><?php if (isset($etnia_id_error)) echo $etnia_id_error; ?></span>
        </div>
        <div class="col-sm-6 form-group">
            <label>Nacionalidad<span class="text-danger req-mark">*</span></label>
            <?php
                $nacionalidades = "SELECT * FROM nacionalidad";
                $stmt_nacionalidades = $pdo->query( $nacionalidades );


                $dropdown = "<select name='nacionalidad_id' class='form-control'>";
                foreach ($stmt_nacionalidades as $row) {
                    $dropdown .= "\r\n<option value='{$row['id']}'>{$row['nombre']}</option>";
                }
                $dropdown .= "\r\n</select>";
                echo $dropdown;
            ?>
            <span class="text-danger validation-error"><?php if (isset($nacionalidad_id_error)) echo $nacionalidad_id_error; ?></span>
        </div>
        <div class="col-sm-6 form-group">
            <label>Captación<span class="text-danger req-mark">*</span></label>
            <?php
                $captaciones = "SELECT * FROM captacion";
                $stmt_captaciones = $pdo->query( $captaciones );


                $dropdown = "<select name='captacion_id' class='form-control'>";
                foreach ($stmt_captaciones as $row) {
                    $dropdown .= "\r\n<option value='{$row['id']}'>{$row['nombre']}</option>";
                }
                $dropdown .= "\r\n</select>";
                echo $dropdown;
            ?>
            <span class="text-danger validation-error"><?php if (isset($captacion_id_error)) echo $captacion_id_error; ?></span>
        </div>
        <div class="col-sm-6 form-group">
            <label>Pertenencia a Distrito<span class="text-danger req-mark">*</span></label>
            <select name="pertenencia_distrito" id="pertenencia_distrito" class="form-control">
                <option value="1">Si</option>
                <option value="0">No</option>
            </select>
            
            <span class="text-danger validation-error"><?php if (isset($pertenencia_distrito_error)) echo $pertenencia_distrito_error; ?></span>
        </div>

        
        <!-- Botonera -->
        <div class="col-sm-12 reset-button">
            <a onclick="resetForm('signupform'); return false;" class="btn btn-warning">Limpiar</a>
            <input type="submit" name="signup" id="signup" value="Guardar" class="btn btn-success" />
        </div>
        <!-- EO / Botonera -->
    </form>

<!-- EDIT -->
<?php 
    } else { 
?>
    <?php require_once "../../pdo/php/connect.php";?>
    <?php include "../../pdo/procesos/pacientes/editar.php"; ?>
<?php
    } 
?>
