<?php
    $id_vacuna = $_GET['id'];

    // Actualizar informacion
    if (isset($_POST['registrar_form'])) {
        $nombre           = $_POST['nombre'];
        $cantidad         = (int)$_POST['cantidad'];
        $dosis         = (int)$_POST['dosis'];
        $lote             = (int)$_POST['lote'];
        $fecha_ingreso    = $_POST['fecha_ingreso'];
        $fecha_expiracion = $_POST['fecha_expiracion'];
        if($_POST)
        {	
            $cantidad_total   = $dosis * $cantidad ;
            $stock_actual = $cantidad_total; 
        }

        $vacuna_actualizar = $pdo->prepare("UPDATE vacuna 
                                            SET nombre=:nombre, tipo=:tipo, estado='1'
                                            WHERE id=:id_vacuna");
        $vacuna_actualizar->bindParam(":nombre", $nombre);
        $vacuna_actualizar->bindParam(":tipo", $tipo);
        $vacuna_actualizar->bindParam(":id_vacuna", $id_vacuna);
        // $vacuna_actualizar->execute();

        $stockvacuna_actualizar = $pdo->prepare("UPDATE stockvacuna 
                                                 SET lote=:lote, dosis=:dosis, cantidad=:cantidad, dosis=:dosis, cantidad_total=:cantidad_total, stock_actual=:stock_actual, fecha_ingreso=:fecha_ingreso, fecha_expiracion=:fecha_expiracion
                                                 WHERE id_vacuna=:id_vacuna");
        $stockvacuna_actualizar->bindParam(":lote", $lote);
        $stockvacuna_actualizar->bindParam(":dosis", $dosis);
        $stockvacuna_actualizar->bindParam(":cantidad", $cantidad);
        $stockvacuna_actualizar->bindParam(":cantidad_total", $cantidad_total);
        $stockvacuna_actualizar->bindParam(":stock_actual", $stock_actual);
        $stockvacuna_actualizar->bindParam(":fecha_ingreso", $fecha_ingreso);
        $stockvacuna_actualizar->bindParam(":fecha_expiracion", $fecha_expiracion);
        $stockvacuna_actualizar->bindParam(":id_vacuna", $id_vacuna);
        // $stockvacuna_actualizar->execute();
        
        if($vacuna_actualizar->execute()) {
            if($stockvacuna_actualizar->execute()) {
                $successmsg = "Datos actualizados exitosamente!";
                echo $successmsg;
            } else {
                $errormsg = "Error al actualizar datos!";
                print_r ($stockvacuna_actualizar->errorInfo()); // Developer Mode
            }
        } else {
            $errormsg = "Error al actualizar datos!";
            print_r ($vacuna_actualizar->errorInfo()); // Developer Mode
        }
    }

    // Recuperar Informacion
    $vacuna = $pdo->prepare("SELECT 
                                    vacuna.id AS vacuna_id, 
                                    vacuna.nombre AS vacuna_nombre, 
                                    vacuna.tipo AS vacuna_tipo, 
                                    vacuna.estado AS vacuna_estado, 
                                    stockvacuna.cantidad AS vacuna_cantidad,
                                    stockvacuna.lote AS vacuna_lote, 
                                    stockvacuna.dosis AS vacuna_dosis, 
                                    stockvacuna.fecha_ingreso AS vacuna_fecha_ingreso,
                                    stockvacuna.fecha_expiracion AS vacuna_fecha_expiracion
                                FROM stockvacuna
                                LEFT JOIN vacuna
                                    ON stockvacuna.id_vacuna = vacuna.id
                                WHERE vacuna.id=:id_vacuna");
    $vacuna->bindParam(":id_vacuna", $id_vacuna);
    $vacuna->execute();

    if($vacuna->rowCount()>=1) {
        $fila_ins=$vacuna->fetch();

        echo '<!-- Notificaciones -->
        <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
        <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        <!-- EO / Notificaciones -->
    
        <form class="col-sm-12" role="form" action="" method="post" name="signupform">
            <input type="hidden" name="id" value=' . $fila_ins["vacuna_id"] . '>
            <div class="col-sm-12 form-group">
                <label>Nombre<span class="text-danger req-mark">*</span></label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese nombre" value=' . $fila_ins["vacuna_nombre"] . '>
                <span class="text-danger validation-error"><?php if (isset($nombre_error)) echo $nombre_error; ?></span>
            </div>
            <div class="col-sm-6 form-group">
                <label>Dosis<span class="text-danger req-mark">*</span></label>
                <input type="number" name="dosis" id="dosis" class="form-control" placeholder="Ingrese dosis" value=' . $fila_ins["vacuna_dosis"] . '>
                <span class="text-danger validation-error"><?php if (isset($cantidad_error)) echo $cantidad_error; ?></span>
            </div>
            <div class="col-sm-6 form-group">
                <label>Cantidad<span class="text-danger req-mark">*</span></label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Ingrese cantidad" value=' . $fila_ins["vacuna_cantidad"] . '>
                <span class="text-danger validation-error"><?php if (isset($cantidad_error)) echo $cantidad_error; ?></span>
            </div>
            <div class="col-sm-6 form-group">
                <label>Lote<span class="text-danger req-mark">*</span></label>
                <input type="number" name="lote" id="lote" class="form-control" placeholder="Ingrese lote" value=' . $fila_ins["vacuna_lote"] . '>
                <span class="text-danger validation-error"><?php if (isset($lote_error)) echo $lote_error; ?></span>
            </div>
            <div class="col-sm-6 form-group">
                <label>Fecha Ingreso<span class="text-danger req-mark">*</span></label>
                <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" placeholder="Ingrese Fecha Ingreso" value=' . $fila_ins["vacuna_fecha_ingreso"] . '>
                <span class="text-danger validation-error"><?php if (isset($fecha_ingreso_error)) echo $fecha_ingreso_error; ?></span>
            </div>
            <div class="col-sm-6 form-group">
                <label>Fecha Expiración<span class="text-danger req-mark">*</span></label>
                <input type="date" name="fecha_expiracion" id="fecha_expiracion" class="form-control" placeholder="Ingrese Fecha Expiración" value=' . $fila_ins["vacuna_fecha_expiracion"] . '>
                <span class="text-danger validation-error"><?php if (isset($fecha_expiracion_error)) echo $fecha_expiracion_error; ?></span>
            </div>
            
            <!-- Botonera -->
            <div class="col-sm-12 reset-button">
            <a onclick="resetForm(\'editform\'); return false;" class="btn btn-warning">Limpiar</a>
                <input type="submit" name="registrar_form" id="registrar_form" value="Guardar" class="btn btn-success" />
            </div>
            <!-- EO / Botonera -->
        </form>';
    } else {
        echo "Ocurrio un error";
        print_r ($vacuna->errorInfo()); // Developer Mode
    }