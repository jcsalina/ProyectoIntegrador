<?php
    // Actualizar informacion
    if (isset($_POST['cedula_persona'])) {
        $id             = $_POST['id'];
        $cedula_persona = $_POST['cedula_persona'];
        $nombre         = $_POST['nombre'];
        $apellido       = $_POST['apellido'];
        $correo         = $_POST['correo'];
        $direccion      = $_POST['direccion'];
        $telefono       = $_POST['telefono'];
        $usuario        = $_POST['usuario'];
        $clave          = $_POST['clave'];

        //$actualizacion_p = $pdo->prepare("UPDATE persona SET nombre=:nombre_p, apellido=:apellido_p, correo=:correo_p, direccion=direccion_p, telefono=:telefono_p WHERE cedula=:cedula_p");
        $actualizacion_p = $pdo->prepare("UPDATE persona SET nombre=:nombre_p, apellido=:apellido_p, correo=:correo_p, direccion=:direccion_p, telefono=:telefono_p WHERE cedula=:cedula_p");
        $actualizacion_p->bindParam(":nombre_p", $nombre);
        $actualizacion_p->bindParam(":apellido_p", $apellido);
        $actualizacion_p->bindParam(":correo_p", $correo);
        $actualizacion_p->bindParam(":direccion_p", $direccion);
        $actualizacion_p->bindParam(":telefono_p", $telefono);
        $actualizacion_p->bindParam(":cedula_p", $cedula_persona);
        // $actualizacion_p->execute();

        $actualizacion_u = $pdo->prepare("UPDATE empleado SET usuario=:usuario_e, clave=:clave_e WHERE cedula_persona=:cedula_p");
        $actualizacion_u->bindParam(":usuario_e", $usuario);
        $actualizacion_u->bindParam(":clave_e", $clave);
        $actualizacion_u->bindParam(":cedula_p", $cedula_persona);
        // $actualizacion_u->execute();
        
        if($actualizacion_p->execute()) {
            $actualizacion_u->execute();
            $successmsg = "Datos actualizados exitosamente!";
            echo $successmsg;
        } else {
            $errormsg = "Error al actualizar datos!";
        }
    }

    // Recuperar Informacion
    //empleado_cargo_id
    $id_empleado = $_GET['id'];
    $empleado = $pdo->prepare("SELECT empleado.id AS id, empleado.cedula_persona AS empleado_cedula, persona.nombre AS empleado_nombre, persona.apellido AS empleado_apellido, empleado.usuario AS empleado_usuario, empleado.clave AS empleado_clave, persona.correo AS empleado_correo, persona.direccion AS empleado_direccion, persona.telefono AS empleado_telefono, empleado.estado AS empleado_estado, cargo.id AS empleado_cargo_id, cargo.nombre AS empleado_cargo FROM empleado LEFT JOIN persona ON persona.cedula = empleado.cedula_persona LEFT JOIN cargo ON cargo.id = empleado.cargo_id WHERE empleado.id=:id");
    $empleado->bindParam("id", $id_empleado);
    $empleado->execute();

    if($empleado->rowCount()>=1) {
        $fila_e=$empleado->fetch();

        // Cargo - Combobox
        $cargos_q    = "SELECT * FROM cargo";
        $stmt_cargos = $pdo->query( $cargos_q );
        $cargo_selector = "<select name='cargo' class='form-control'>";
        foreach ($stmt_cargos as $row) {
            if ($fila_e["empleado_cargo_id"] == $row['id']) {
                $cargo_selector .= "\r\n<option value='{$row['id']}' selected='selected'>{$row['nombre']}</option>";
            } else {
                $cargo_selector .= "\r\n<option value='{$row['id']}'>{$row['nombre']}</option>";
            }
        }
        $cargo_selector .= "\r\n</select>";
        // EO / Cargo - Combobox

        echo '<!-- Notificaciones -->
        <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
        <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        <!-- EO / Notificaciones -->
    
        <form class="col-sm-12" role="form" action="" method="post" name="signupform">
        <input type="hidden" name="id" value=' . $fila_e["id"] . '>
        <div class="col-sm-6 form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese Nombre" value=' . $fila_e["empleado_nombre"] . '>
        </div>
        <div class="col-sm-6 form-group">
            <label>Apellido</label>
            <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Ingrese Apellido" value=' . $fila_e["empleado_apellido"] . '>
        </div>
        <div class="col-sm-6 form-group">
            <label>Cédula</label>
            <input type="number" name="cedula_persona" id="cedula_persona" class="form-control" placeholder="Ingrese Número de Cédula" value=' . $fila_e["empleado_cedula"] . '>
        </div>
        <div class="col-sm-6 form-group">
            <label>Correo</label>
            <input type="email" name="correo" id="correo" class="form-control" placeholder="Ingrese Correo Electrónico" value=' . $fila_e["empleado_correo"] . '>
        </div>
        <div class="col-sm-6 form-group">
            <label>Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingrese Dirección" value=' . $fila_e["empleado_direccion"] . '>
        </div>
        <div class="col-sm-6 form-group">
            <label>Teléfono</label>
            <input type="number" name="telefono" id="telefono" class="form-control" placeholder="Ingrese Teléfono" value=' . $fila_e["empleado_telefono"] . '>
        </div>
    
        <div class="col-sm-6 form-group">
            <label>Usuario</label>
            <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Ingrese Nombre Usuario" value=' . $fila_e["empleado_usuario"] . '>
        </div>
        <div class="col-sm-6 form-group">
            <label>Contraseña</label>
            <div class="input-group add-on" style="display: flex;">
                <input type="password" name="clave" id="clave" class="form-control" placeholder="Ingrese Contraseña" style="border-right: none;" value=' . $fila_e["empleado_clave"] . '>
                <span toggle="#clave" class="btn btn-default" onclick="togglePassword(this)" style="border-left: none;"><i class="glyphicon glyphicon-eye-open"></i></button>
                <span class="text-danger validation-error"><?php if (isset($clave_error)) echo $clave_error; ?></span>
            </div>
        </div>
        

        <div class="col-sm-6 form-group">
            <label>Cargo<span class="text-danger req-mark">*</span></label>
            ' . $cargo_selector . '
            <span class="text-danger validation-error"><?php if (isset($cargo_error)) echo $cargo_error; ?></span>
        </div>
        
        <!-- Botonera -->
        <div class="col-sm-12 reset-button">
            <input type="submit" name="editar" id="editar" value="Guardar" class="btn btn-success" />
        </div>
        <!-- EO / Botonera -->';
    } else {
        echo "Ocurrio un error";
    }