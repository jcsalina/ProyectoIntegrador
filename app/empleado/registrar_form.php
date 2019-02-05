<?php
if(!isset($_GET['id'])) {
        
    require "../../database/dbconnect.php"; //Borrar

    //Establece el error de validación como flag
    $error = false;

    //check if form is submitted
    if (isset($_POST['signup'])) {
        $cedula_persona = $_POST['cedula_persona'];
        $nombre         = $_POST['nombre'];
        $apellido       = $_POST['apellido'];
        $correo         = $_POST['correo'];
        $direccion      = $_POST['direccion'];
        $telefono       = $_POST['telefono'];
        $usuario        = $_POST['usuario'];
        $clave          = $_POST['clave'];
        $cargo          = $_POST['cargo'];
        
        $registrar_persona  = $pdo->prepare("INSERT INTO persona(cedula, nombre, apellido, correo, direccion, telefono) VALUES (:cedula_p, :nombre, :apellido, :correo, :direccion, :telefono)");
        $registrar_persona->bindParam(":cedula_p", $cedula_persona);
        $registrar_persona->bindParam(":nombre", $nombre);
        $registrar_persona->bindParam(":apellido", $apellido);
        $registrar_persona->bindParam(":correo", $correo);
        $registrar_persona->bindParam(":direccion", $direccion);
        $registrar_persona->bindParam(":telefono", $telefono);
        // $registrar_persona->execute();

        $registrar_empleado = $pdo->prepare("INSERT INTO empleado(cedula_persona, usuario, clave, estado, cargo_id) VALUES (:cedula_p, :usuario, :clave, '1', :cargo)");
        $registrar_empleado->bindParam(":cedula_p", $cedula_persona);
        $registrar_empleado->bindParam(":usuario", $usuario);
        $registrar_empleado->bindParam(":clave", $clave);
        $registrar_empleado->bindParam(":cargo", $cargo);
        // $registrar_empleado->bindParam(":estado", $estado);
        // $registrar_empleado->bindParam(":cargo_id", $cargo_id);
        // $registrar_empleado->execute();
        
    
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
            $cedula_persona_error = "La cedula debe tener un mínimo de 10 caracteres";
        }
        if (empty($direccion)) {
            $direccion_error = "Campo Requerido";
            $error        = true;
        }
        if (empty($telefono)) {
            $telefono_error = "Campo Requerido";
            $error        = true;
        }
        if (empty($usuario)) {
            $usuario_error = "Campo Requerido";
            $error        = true;
        }
        if (empty($clave)) {
            $clave_error = "Campo Requerido";
            $error        = true;
        }
        if (empty($cargo)) {
            $cargo_error = "Campo Requerido";
            $error        = true;
        }
      

        if (!$error) {
            if($registrar_persona->execute()) {
                if ($registrar_empleado->execute()) {
                    $successmsg = "¡Registro exitoso!";

                } else {
                    $errormsg = "Error al registrar usuario.";
                    print_r ($registrar_empleado->errorInfo()); // Developer Mode
                }
                $query2;
                // $successmsg = '
                // <div class="alert alert-success alert-dismissable fade in">
                //     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                //     <strong>EXITO!</strong> ¡Registrado exitosamente!
                // </div>
                // ';
            } else {
                $errormsg = "Error al registrar persona.";
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

    <form id="editform" class="col-sm-12" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="editform">
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
        
        <div class="col-sm-6 form-group">
            <label>Usuario<span class="text-danger req-mark">*</span></label>
            <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Ingrese Nombre Usuario" value="">
            <span class="text-danger validation-error"><?php if (isset($usuario_error)) echo $usuario_error; ?></span>
        </div>
        <div class="col-sm-6 form-group">
            <label>Contraseña<span class="text-danger req-mark">*</span></label>
            <div class="input-group add-on" style="display: flex;">
                <input type="password" name="clave" id="clave" class="form-control" placeholder="Ingrese Contraseña" style="border-right: none;" value="">
                <span toggle="#clave" class="btn btn-default" onclick="togglePassword(this)" style="border-left: none;"><i class="glyphicon glyphicon-eye-open"></i></button>
                <span class="text-danger validation-error"><?php if (isset($clave_error)) echo $clave_error; ?></span>
            </div>
        </div>
        <div class="col-sm-6 form-group">
            <label>Cargo<span class="text-danger req-mark">*</span></label>
            <?php
                $cargo = "SELECT * FROM cargo";
                $stmt_cargo = $pdo->query( $cargo );


                $dropdown = "<select name='cargo' class='form-control'>";
                foreach ($stmt_cargo as $row) {
                    $dropdown .= "\r\n<option value='{$row['id']}'>{$row['nombre']}</option>";
                }
                $dropdown .= "\r\n</select>";
                echo $dropdown;
            ?>
            <span class="text-danger validation-error"><?php if (isset($cargo_error)) echo $cargo_error; ?></span>
        </div>

        
        <!-- Botonera -->
        <div class="col-sm-12 reset-button">
        <a onclick="resetForm('editform'); return false;" class="btn btn-warning">Limpiar</a>
            <input type="submit" name="signup" id="signup" value="Guardar" class="btn btn-success" />
        </div>
        <!-- EO / Botonera -->
    </form>

<!-- EDIT -->
<?php 
    } else { 
?>
    <?php require_once "../../pdo/php/connect.php";?>
    <?php include "../../pdo/procesos/empleado/editar.php"; ?>
<?php
       
    } 
?>
                           