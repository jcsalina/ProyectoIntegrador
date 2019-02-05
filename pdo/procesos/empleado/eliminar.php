<?php
    $id=$_GET['id'];
    $recuperar_cedula = $pdo->prepare("SELECT cedula_persona FROM empleado WHERE id=:id_e");
    $recuperar_cedula->bindParam(":id_e", $id);
    $recuperar_cedula->execute();
    $fila_cedula=$recuperar_cedula->fetch();

    $cedula = $fila_cedula["cedula_persona"];

    $eliminar_empleado = $pdo->prepare("DELETE FROM empleado WHERE cedula_persona=:cedula_p");
    $eliminar_empleado->bindParam(":cedula_p", $cedula);

    $eliminar_persona = $pdo->prepare("DELETE FROM persona WHERE cedula=:cedula_p");
    $eliminar_persona->bindParam(":cedula_p", $cedula);


    if($eliminar_persona->errorInfo()) {
        if($eliminar_empleado->execute()) {
            echo "Registro Eliminado exitosamente";
        } else {
            echo "Ocurrio un error al eliminar Empleado";
            print_r ($eliminar_persona->errorInfo()); // Developer Mode
        }
    } else {
        echo "Ocurrio un error al eliminar persona";
        print_r ($eliminar_empleado->errorInfo()); // Developer Mode
    }
    
