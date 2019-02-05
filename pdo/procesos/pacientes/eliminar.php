<?php
    $id=$_GET['id'];
    $recuperar_cedula = $pdo->prepare("SELECT cedula_persona FROM empleado WHERE id=:id_e");
    $recuperar_cedula->bindParam(":id_e", $id);
    $recuperar_cedula->execute();
    $fila_cedula=$recuperar_cedula->fetch();

    $cedula = $fila_cedula["cedula_persona"];

    $eliminar_e = $pdo->prepare("DELETE FROM empleado WHERE cedula_persona=:cedula_p");
    $eliminar_e->bindParam(":cedula_p", $cedula);

    $eliminar_p = $pdo->prepare("DELETE FROM persona WHERE cedula=:cedula_p");
    $eliminar_p->bindParam(":cedula_p", $cedula);

    if($eliminar_e->execute()) {
        $eliminar_p->execute();
        echo "Registro eliminado";
        header("Location: lista.php");
    } else {
        echo "Ocurrio un error al eliminar";
    }