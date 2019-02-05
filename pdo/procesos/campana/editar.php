<?php
    $campana_id = $_GET['id'];
    
    // Actualizar informacion
    if (isset($_POST['registrar_form'])) {

        $nombre       = $_POST['nombre'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin    = $_POST['fecha_fin'];
        $edad         = $_POST['edad'];
 
        
        $editar_campana = $pdo->prepare("UPDATE campana SET nombre=:nombre, fecha_inicio=:fecha_inicio, fecha_fin=:fecha_fin, edad=:edad WHERE id=:campana_id");
        $editar_campana->bindParam(":campana_id", $campana_id);
        $editar_campana->bindParam(":nombre", $nombre);
        $editar_campana->bindParam(":fecha_inicio", $fecha_inicio);
        $editar_campana->bindParam(":fecha_fin", $fecha_fin);
        $editar_campana->bindParam(":edad", $edad);

        
        
        if($editar_campana->execute()) {
            $successmsg = "Datos actualizados exitosamente!";
            echo $successmsg;
        } else {
            $errormsg = "Error al actualizar datos!";
        }
    }

    // Recuperar Informacion
    //campana_cargo_id
    $id_campana = $_GET['id'];
    $campana = $pdo->prepare("SELECT * FROM campana WHERE id=:id");
    $campana->bindParam("id", $id_campana);
    $campana->execute();
 
    if($campana->rowCount()>=1) {
        $fila_campana=$campana->fetch();


        echo '<!-- Notificaciones -->
        <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
        <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        <!-- EO / Notificaciones -->
        
        <form id="editform" class="col-sm-12" role="form" action="" method="post" name="editform">
            <input type="hidden" name="id" value=' . $fila_campana["id"] . '>
            <div class="col-sm-6 form-group">
                <label>Nombre<span class="text-danger req-mark">*</span></label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese Nombre" value="' . $fila_campana["nombre"] . '">
                <span class="text-danger validation-error"><?php if (isset($nombre_error)) echo $nombre_error; ?></span>
            </div>
            <div class="col-sm-6 form-group">
                <label>Edad<span class="text-danger req-mark">*</span></label>
                <input type="number" name="edad" id="edad" class="form-control" placeholder="Ingrese edad" value="' . $fila_campana["edad"] . '">
                <span class="text-danger validation-error"><?php if (isset($edad_error)) echo $edad_error; ?></span>
            </div>
            <div class="col-sm-6 form-group">
                <label>Fecha de Inicio<span class="text-danger req-mark">*</span></label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" placeholder="Ingrese Fecha de Inicio" value="' . $fila_campana["fecha_inicio"] . '">
                <span class="text-danger validation-error"><?php if (isset($fecha_inicio_error)) echo $fecha_inicio_error; ?></span>
            </div>
            <div class="col-sm-6 form-group">
                <label>Fecha de Fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" placeholder="Ingrese Fecha de Fin" value="' . $fila_campana["fecha_fin"] . '">
                <span class="text-danger validation-error"><?php if (isset($fecha_fin_error)) echo $fecha_fin_error; ?></span>
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
    }