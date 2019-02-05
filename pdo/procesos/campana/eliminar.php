<?php
    $id_campana=$_GET['id'];

    $eliminar_campana = $pdo->prepare("DELETE FROM campana WHERE id=:id_campana");
    $eliminar_campana->bindParam(":id_campana", $id_campana);

    if($eliminar_campana->execute()) {
        echo "Registro Eliminado exitosamente";
    } else {
        echo "Ocurrio un error al eliminar campana";
        print_r ($eliminar_campana->errorInfo()); // Developer Mode
    }
    
