<?php
    // Actualizar informacion
    if (isset($_POST['cedula_persona'])) {
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

        //$actualizacion_p = $pdo->prepare("UPDATE persona SET nombre=:nombre_p, apellido=:apellido_p, correo=:correo_p, direccion=direccion_p, telefono=:telefono_p WHERE cedula=:cedula_p");
        $actualizacion_persona = $pdo->prepare("UPDATE persona SET nombre=:nombre_p, apellido=:apellido_p, correo=:correo_p, direccion=:direccion_p, telefono=:telefono_p WHERE cedula=:cedula_p");
        $actualizacion_persona->bindParam(":cedula_p", $cedula_persona);
        $actualizacion_persona->bindParam(":nombre_p", $nombre);
        $actualizacion_persona->bindParam(":apellido_p", $apellido);
        $actualizacion_persona->bindParam(":correo_p", $correo);
        $actualizacion_persona->bindParam(":direccion_p", $direccion);
        $actualizacion_persona->bindParam(":telefono_p", $telefono);
        // $actualizacion_persona->execute();

        $actualizacion_paciente = $pdo->prepare("UPDATE paciente SET fecha_nacimiento=:fecha_nacimiento_p, sexo_id=:sexo_id_p, cedula_padre=:cedula_padre_p, nombre_padre=:nombre_padre_p, cedula_madre=:cedula_madre_p, nombre_madre=:nombre_madre_p, etnia_id=:etnia_id_p, nacionalidad_id=:nacionalidad_id_p, captacion_id=:captacion_id_p, pertenencia_distrito=:pertenencia_distrito_p WHERE cedula_persona=:cedula_p");
        $actualizacion_paciente->bindParam(":cedula_p", $cedula_persona);
        $actualizacion_paciente->bindParam(":fecha_nacimiento_p", $fecha_nacimiento);
        $actualizacion_paciente->bindParam(":sexo_id_p", $sexo_id);
        $actualizacion_paciente->bindParam(":cedula_padre_p", $cedula_padre);
        $actualizacion_paciente->bindParam(":nombre_padre_p", $nombre_padre);
        $actualizacion_paciente->bindParam(":cedula_madre_p", $cedula_madre);
        $actualizacion_paciente->bindParam(":nombre_madre_p", $nombre_madre);
        $actualizacion_paciente->bindParam(":etnia_id_p", $etnia_id);
        $actualizacion_paciente->bindParam(":nacionalidad_id_p", $nacionalidad_id);
        $actualizacion_paciente->bindParam(":captacion_id_p", $captacion_id);
        $actualizacion_paciente->bindParam(":pertenencia_distrito_p", $pertenencia_distrito);
        // $actualizacion_paciente->execute();
        
        if($actualizacion_persona->execute()) {
            $actualizacion_paciente->execute();
            $successmsg = "Datos actualizados exitosamente!";
            echo $successmsg;
        } else {
            $errormsg = "Error al actualizar datos!";
        }
    }

    // Recuperar Informacion
    $id_paciente = $_GET['id'];
    $paciente = $pdo->prepare("SELECT 
                                paciente.id                   AS id, 
                                paciente.cedula_persona       AS paciente_cedula, 
                                persona.nombre                AS paciente_nombre, 
                                persona.apellido              AS paciente_apellido, 
                                persona.correo                AS paciente_correo, 
                                persona.direccion             AS paciente_direccion, 
                                persona.telefono              AS paciente_telefono, 
                                paciente.fecha_nacimiento     AS paciente_fecha_nacimiento, 
                                paciente.sexo_id              AS paciente_sexo_id, 
                                sexo.nombre                   AS paciente_sexo, 
                                paciente.cedula_padre         AS paciente_padre_cedula, 
                                paciente.nombre_padre         AS paciente_padre_nombre, 
                                paciente.cedula_madre         AS paciente_madre_cedula, 
                                paciente.nombre_madre         AS paciente_madre_nombre, 
                                paciente.etnia_id             AS paciente_etnia_id, 
                                etnia.nombre                  AS paciente_etnia,
                                paciente.nacionalidad_id      AS paciente_nacionalidad_id, 
                                nacionalidad.id               AS paciente_nacionalidad,
                                paciente.captacion_id         AS paciente_captacion_id, 
                                captacion.id                  AS paciente_captacion, 
                                paciente.pertenencia_distrito AS paciente_pertenencia_distrito 
                            FROM paciente 
                            LEFT JOIN persona 
                                ON persona.cedula = paciente.cedula_persona 
                            LEFT JOIN sexo 
                                ON sexo.id = paciente.sexo_id 
                            LEFT JOIN etnia 
                                ON etnia.id = paciente.etnia_id 
                            LEFT JOIN nacionalidad 
                                ON nacionalidad.id = paciente.nacionalidad_id 
                            LEFT JOIN captacion 
                                ON captacion.id = paciente.captacion_id 
                            WHERE paciente.id=:id_paciente");
    $paciente->bindParam(":id_paciente", $id_paciente);
    $paciente->execute();

    if($paciente->rowCount()>=1) {
        $fila_p=$paciente->fetch();

        // ________________ Generos
        $generos = "SELECT * FROM sexo";
        $stmt_generos = $pdo->query( $generos );

        $dropdown_genero = "<select name='sexo_id' class='form-control'>";
        foreach ($stmt_generos as $row) {
            if ($fila_p["paciente_sexo_id"] == $row['id']) {
                $dropdown_genero .= "\r\n<option value='{$row['id']}' selected='selected'>{$row['nombre']}</option>";
            } else {
                $dropdown_genero .= "\r\n<option value='{$row['id']}'>{$row['nombre']}</option>";
            }
        }
        $dropdown_genero .= "\r\n</select>";
        //$fila_p["paciente_sexo"]
        

        // ________________ Etnias
        $etnias = "SELECT * FROM etnia";
        $stmt_etnias = $pdo->query( $etnias );

        $dropdown_etnias = "<select name='etnia_id' class='form-control'>";
        foreach ($stmt_etnias as $row) {
            if ($fila_p["paciente_etnia_id"] == $row['id']) {
                $dropdown_etnias .= "\r\n<option value='{$row['id']}' selected='selected'>{$row['nombre']}</option>";
            } else {
                $dropdown_etnias .= "\r\n<option value='{$row['id']}'>{$row['nombre']}</option>";
            }
        }
        $dropdown_etnias .= "\r\n</select>";

        // ________________ Nacionalidades
        $nacionalidades = "SELECT * FROM nacionalidad";
        $stmt_nacionalidades = $pdo->query( $nacionalidades );

        $dropdown_nacionalidades = "<select name='nacionalidad_id' class='form-control'>";
        foreach ($stmt_nacionalidades as $row) {
            if ($fila_p["paciente_nacionalidad_id"] == $row['id']) {
                $dropdown_nacionalidades .= "\r\n<option value='{$row['id']}' selected='selected'>{$row['nombre']}</option>";
            } else {
                $dropdown_nacionalidades .= "\r\n<option value='{$row['id']}'>{$row['nombre']}</option>";
            }
        }
        $dropdown_nacionalidades .= "\r\n</select>";

        // ________________ Captacion
        $captaciones = "SELECT * FROM captacion";
        $stmt_captaciones = $pdo->query( $captaciones );

        $dropdown_captacion = "<select name='captacion_id' class='form-control'>";
        foreach ($stmt_captaciones as $row) {
            if ($fila_p["paciente_captacion_id"] == $row['id']) {
                $dropdown_captacion .= "\r\n<option value='{$row['id']}' selected='selected'>{$row['nombre']}</option>";
            } else {
                $dropdown_captacion .= "\r\n<option value='{$row['id']}'>{$row['nombre']}</option>";
            }
        }
        $dropdown_captacion .= "\r\n</select>";

        $dropdown_pertenece_distrito = '<select name="pertenencia_distrito" id="pertenencia_distrito" class="form-control">';
        if ($fila_p["paciente_pertenencia_distrito"]) {
            $dropdown_pertenece_distrito .= "\r\n<option value='{$row['id']}' selected='selected'>Si</option>";
            $dropdown_pertenece_distrito .= "\r\n<option value='{$row['id']}'>No</option>";
        } else {
            $dropdown_pertenece_distrito .= "\r\n<option value='{$row['id']}'>Si</option>";
            $dropdown_pertenece_distrito .= "\r\n<option value='{$row['id']}' selected='selected'>No</option>";
        }    
        $dropdown_pertenece_distrito .= "\r\n</select>";

        $formulario_paciente = '
            <!-- Notificaciones -->
            <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
            <!-- EO / Notificaciones -->

            <form class="col-sm-12" role="form" action="" method="post" name="signupform">
                <div class="col-sm-6 form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese Nombre" value="' . $fila_p["paciente_nombre"] . '">
                </div>
                <div class="col-sm-6 form-group">
                    <label>Apellido</label>
                    <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Ingrese Apellido" value="' . $fila_p["paciente_apellido"] . '">
                </div>
                <div class="col-sm-6 form-group">
                    <label>Cédula</label>
                    <input type="number" name="cedula_persona" id="cedula_persona" class="form-control" placeholder="Ingrese Número de Cédula" value="' . $fila_p["paciente_cedula"] . '">
                </div>
                <div class="col-sm-6 form-group">
                    <label>Correo</label>
                    <input type="email" name="correo" id="correo" class="form-control" placeholder="Ingrese Correo Electrónico" value="' . $fila_p["paciente_correo"] . '">
                </div>
                <div class="col-sm-6 form-group">
                    <label>Dirección</label>
                    <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingrese Dirección" value="' . $fila_p["paciente_direccion"] . '">
                </div>
                <div class="col-sm-6 form-group">
                    <label>Teléfono</label>
                    <input type="number" name="telefono" id="telefono" class="form-control" placeholder="Ingrese Teléfono" value="' . $fila_p["paciente_telefono"] . '">
                </div>
                
                <!-- ___________________________________________ -->

                <div class="col-sm-6 form-group">
                    <label>Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" placeholder="Ingrese Fecha de Nacimiento" value="' . $fila_p["paciente_fecha_nacimiento"] . '">
                </div>
                <div class="col-sm-6 form-group">
                    <label>Sexo</label>' . $dropdown_genero . '</div>
                <div class="col-sm-6 form-group">
                    <label>Cédula Padre</label>
                    <input type="number" name="cedula_padre" id="cedula_padre" class="form-control" placeholder="Ingrese Cédula Padre" value="' . $fila_p["paciente_padre_cedula"] . '">
                </div>
                <div class="col-sm-6 form-group">
                    <label>Nombre Padre</label> 
                    <input type="text" name="nombre_padre" id="nombre_padre" class="form-control" placeholder="Ingrese Nombre Padre" value="' . $fila_p["paciente_padre_nombre"] . '">
                </div>
                <div class="col-sm-6 form-group">
                    <label>Cédula Madre</label>
                    <input type="number" name="cedula_madre" id="cedula_madre" class="form-control" placeholder="Ingrese Cédula Madre" value="' . $fila_p["paciente_madre_cedula"] . '">
                </div>
                <div class="col-sm-6 form-group">
                    <label>Nombre Madre</label>
                    <input type="text" name="nombre_madre" id="nombre_madre" class="form-control" placeholder="Ingrese Nombre Madre" value="' . $fila_p["paciente_madre_nombre"] . '">
                </div>
                <div class="col-sm-6 form-group">
                    <label>Etnia</label>
                    ' . $dropdown_etnias . '
                </div>
                <div class="col-sm-6 form-group">
                    <label>Nacionalidad</label>
                    ' . $dropdown_nacionalidades . '
                </div>
                <div class="col-sm-6 form-group">
                    <label>Captación</label>
                    ' . $dropdown_captacion . '
                    </div>
                <div class="col-sm-6 form-group">
                    <label>Pertenencia a Distrito</label>
                    ' . $dropdown_pertenece_distrito . '                    
                </div>

                
                <!-- Botonera -->
                <div class="col-sm-12 reset-button">
                    <a href="#" class="btn btn-warning">Limpiar</a>
                    <input type="submit" name="signup" id="signup" value="Guardar" class="btn btn-success" />
                </div>
                <!-- EO / Botonera -->
            </form>';
            echo $formulario_paciente;
    } else {
        echo "Ocurrio un error";
    }