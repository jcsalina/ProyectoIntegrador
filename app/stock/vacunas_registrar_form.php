<?php
if(!isset($_GET['id'])) {
        
    require "../../database/dbconnect.php"; //Borrar

    //Establece el error de validación como flag
    $error = false;

    //check if form is submitted
    if (isset($_POST['registrar_form'])) {
        // $lote             = $_POST['lote'];
        // $cantidad         = $_POST['cantidad'];
        // $fecha_ingreso    = $_POST['fecha_ingreso'];
        // $fecha_expiracion = $_POST['fecha_expiracion'];
        // $id_vacuna        = $_POST['id_vacuna'];
        
        // $registrar_stockvacuna = $pdo->prepare("INSERT INTO stockvacuna(lote, cantidad, fecha_ingreso, fecha_expiracion, id_vacuna) VALUES (:lote, :cantidad, :fecha_ingreso, :fecha_expiracion, :id_vacuna)");
        // $registrar_stockvacuna->bindParam(":lote", $lote);
        // $registrar_stockvacuna->bindParam(":cantidad", $cantidad);
        // $registrar_stockvacuna->bindParam(":fecha_ingreso", $fecha_ingreso);
        // $registrar_stockvacuna->bindParam(":fecha_expiracion", $fecha_expiracion);
        // $registrar_stockvacuna->bindParam(":id_vacuna", $id_vacuna);
        // $registrar_stockvacuna->execute();

         // -------------------------------------
        $id_vacuna        = $_POST['id_vacuna'];
        $lote             = $_POST['lote'];
        $cantidad         = $_POST['cantidad'];
        $fecha_ingreso    = $_POST['fecha_ingreso'];
        $fecha_expiracion = $_POST['fecha_expiracion'];
 
        $stockvacuna_actualizar = $pdo->prepare("INSERT INTO stockvacuna (id_vacuna, cantidad, lote, fecha_ingreso, fecha_expiracion)
                                                 VALUES (:id_vacuna, :cantidad, :lote, :fecha_ingreso, :fecha_expiracion)");

        $stockvacuna_actualizar->bindParam(":lote", $lote);
        $stockvacuna_actualizar->bindParam(":cantidad", $cantidad);
        $stockvacuna_actualizar->bindParam(":fecha_ingreso", $fecha_ingreso);
        $stockvacuna_actualizar->bindParam(":fecha_expiracion", $fecha_expiracion);
        $stockvacuna_actualizar->bindParam(":id_vacuna", $id_vacuna);
         // -------------------------------------
    
        // __________________________  VALIDACIONES  __________________________
        // ---------------  REQUERIDOS  ---------------
        
        // if (empty($nombre)) {
        //     $nombre_error = "Campo Requerido";
        //     $error        = true;
        // }
        if (empty($cantidad)) {
            $cantidad_error = "Campo Requerido";
            $error        = true;
        }
        if (empty($fecha_ingreso)) {
            $fecha_ingreso_error = "Campo Requerido";
            $error        = true;
        }
        if (empty($fecha_expiracion)) {
            $fecha_expiracion_error = "Campo Requerido";
            $error        = true;
        }
        if (empty($id_vacuna)) {
            $id_vacuna_error = "Campo Requerido";
            $error        = true;
        }
        if (!$error) {
            if($stockvacuna_actualizar->execute()) {
                $successmsg = "Datos actualizados exitosamente!";
                //echo $successmsg;
            } else {
                $errormsg = "Error al actualizar datos!";
                print_r ($stockvacuna_actualizar->errorInfo()); // Developer Mode
            }
        }
    }
?>
    <!-- Notificaciones -->
    <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
    <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
    <!-- EO / Notificaciones -->

    <form id="editform" class="col-sm-12" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="editform">
        <div class="col-sm-12 form-group">
            <label>Nombre<span class="text-danger req-mark">*</span></label>
            <?php
                $vacuna = "SELECT * FROM vacuna";
                $stmt_vacuna = $pdo->query( $vacuna );


                $dropdown = "<select id='id_vacuna' name='id_vacuna' class='form-control'>";
                foreach ($stmt_vacuna as $row) {
                    $dropdown .= "\r\n<option value='{$row['id']}'>{$row['nombre']}</option>";
                }
                $dropdown .= "\r\n</select>";
                echo $dropdown;
            ?>
            <span class="text-danger validation-error"><?php if (isset($id_vacuna_error)) echo $id_vacuna_error; ?></span>
        </div>
        <div class="col-sm-6 form-group">
            <label>Cantidad<span class="text-danger req-mark">*</span></label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Ingrese cantidad" value="">
            <span class="text-danger validation-error"><?php if (isset($cantidad_error)) echo $cantidad_error; ?></span>
        </div>
        <div class="col-sm-6 form-group">
            <label>Lote<span class="text-danger req-mark">*</span></label>
            <input type="number" name="lote" id="lote" class="form-control" placeholder="Ingrese lote" value="">
            <span class="text-danger validation-error"><?php if (isset($lote_error)) echo $lote_error; ?></span>
        </div>
        <div class="col-sm-6 form-group">
            <label>Fecha Ingreso<span class="text-danger req-mark">*</span></label>
            <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" placeholder="Ingrese Fecha Ingreso" value="">
            <span class="text-danger validation-error"><?php if (isset($fecha_ingreso_error)) echo $fecha_ingreso_error; ?></span>
        </div>
        <div class="col-sm-6 form-group">
            <label>Fecha Expiración<span class="text-danger req-mark">*</span></label>
            <input type="date" name="fecha_expiracion" id="fecha_expiracion" class="form-control" placeholder="Ingrese Fecha Expiración" value="">
            <span class="text-danger validation-error"><?php if (isset($fecha_expiracion_error)) echo $fecha_expiracion_error; ?></span>
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
    <?php include "../../pdo/procesos/stock/vacuna/editar.php"; ?>
<?php
       
    } 
?>
                           