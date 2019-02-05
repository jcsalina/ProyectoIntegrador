<?php
    $id_insumo = $_GET['id'];

    // Actualizar informacion
    if (isset($_POST['registrar_form'])) {
        $nombre           = $_POST['nombre'];
        $cantidad         = (int)$_POST['cantidad'];
        $calibre          = (int)$_POST['calibre'];
        $lote             = (int)$_POST['lote'];
        $fecha_ingreso    = $_POST['fecha_ingreso'];
        $fecha_expiracion = $_POST['fecha_expiracion'];

        $insumo_actualizar = $pdo->prepare("UPDATE insumo 
                                            SET nombre=:nombre, calibre=:calibre, estado='1'
                                            WHERE id=:id_insumo");
        $insumo_actualizar->bindParam(":nombre", $nombre);
        $insumo_actualizar->bindParam(":calibre", $calibre);
        $insumo_actualizar->bindParam(":id_insumo", $id_insumo);
        // $insumo_actualizar->execute();

        $stockinsumo_actualizar = $pdo->prepare("UPDATE stockinsumo 
                                                 SET lote=:lote, cantidad=:cantidad, fecha_ingreso=:fecha_ingreso, fecha_expiracion=:fecha_expiracion
                                                 WHERE id_insumo=:id_insumo");
        $stockinsumo_actualizar->bindParam(":lote", $lote);
        $stockinsumo_actualizar->bindParam(":cantidad", $cantidad);
        $stockinsumo_actualizar->bindParam(":fecha_ingreso", $fecha_ingreso);
        $stockinsumo_actualizar->bindParam(":fecha_expiracion", $fecha_expiracion);
        $stockinsumo_actualizar->bindParam(":id_insumo", $id_insumo);
        // $stockinsumo_actualizar->execute();
        
        if($insumo_actualizar->execute()) {
            if($stockinsumo_actualizar->execute()) {
                $successmsg = "Datos actualizados exitosamente!";
                echo $successmsg;
            } else {
                $errormsg = "Error al actualizar datos!";
                print_r ($stockinsumo_actualizar->errorInfo()); // Developer Mode
            }
        } else {
            $errormsg = "Error al actualizar datos!";
            print_r ($insumo_actualizar->errorInfo()); // Developer Mode
        }
    }

    // Recuperar Informacion
    $insumo = $pdo->prepare("SELECT 
                                    insumo.id AS insumo_id, 
                                    insumo.nombre AS insumo_nombre, 
                                    insumo.calibre AS insumo_calibre, 
                                    insumo.estado AS insumo_estado, 
                                    stockinsumo.cantidad AS insumo_cantidad,
                                    stockinsumo.lote AS insumo_lote, 
                                    stockinsumo.fecha_ingreso AS insumo_fecha_ingreso,
                                    stockinsumo.fecha_expiracion AS insumo_fecha_expiracion
                                FROM insumo 
                                LEFT JOIN stockinsumo
                                    ON stockinsumo.id_insumo = insumo.id
                                WHERE insumo.id=:id_insumo");
    $insumo->bindParam(":id_insumo", $id_insumo);
    $insumo->execute();

    if($insumo->rowCount()>=1) {
        $fila_ins=$insumo->fetch();

        echo '<!-- Notificaciones -->
        <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
        <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        <!-- EO / Notificaciones -->
    
        <form class="col-sm-12" role="form" action="" method="post" name="signupform">
            <input type="hidden" name="id" value=' . $fila_ins["insumo_id"] . '>
            <div class="col-sm-6 form-group">
                <label>Nombre<span class="text-danger req-mark">*</span></label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese nombre" value=' . $fila_ins["insumo_nombre"] . '>
                <span class="text-danger validation-error"><?php if (isset($nombre_error)) echo $nombre_error; ?></span>
            </div>
            <div class="col-sm-6 form-group">
                <label>Calibre<span class="text-danger req-mark">*</span></label>
                <input type="number" name="calibre" id="calibre" class="form-control" placeholder="Ingrese calibre" value=' . $fila_ins["insumo_calibre"] . '>
                <span class="text-danger validation-error"><?php if (isset($calibre_error)) echo $calibre_error; ?></span>
            </div>
            <div class="col-sm-6 form-group">
                <label>Cantidad<span class="text-danger req-mark">*</span></label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Ingrese cantidad" value=' . $fila_ins["insumo_cantidad"] . '>
                <span class="text-danger validation-error"><?php if (isset($cantidad_error)) echo $cantidad_error; ?></span>
            </div>
            <div class="col-sm-6 form-group">
                <label>Lote<span class="text-danger req-mark">*</span></label>
                <input type="number" name="lote" id="lote" class="form-control" placeholder="Ingrese lote" value=' . $fila_ins["insumo_lote"] . '>
                <span class="text-danger validation-error"><?php if (isset($lote_error)) echo $lote_error; ?></span>
            </div>
            <div class="col-sm-6 form-group">
                <label>Fecha Ingreso<span class="text-danger req-mark">*</span></label>
                <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" placeholder="Ingrese Fecha Ingreso" value=' . $fila_ins["insumo_fecha_ingreso"] . '>
                <span class="text-danger validation-error"><?php if (isset($fecha_ingreso_error)) echo $fecha_ingreso_error; ?></span>
            </div>
            <div class="col-sm-6 form-group">
                <label>Fecha Expiración<span class="text-danger req-mark">*</span></label>
                <input type="date" name="fecha_expiracion" id="fecha_expiracion" class="form-control" placeholder="Ingrese Fecha Expiración" value=' . $fila_ins["insumo_fecha_expiracion"] . '>
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
        print_r ($insumo->errorInfo()); // Developer Mode
    }