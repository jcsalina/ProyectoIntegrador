<?php
    $cedula_persona = $_POST['cedula_persona'];
    $clave          = $_POST['clave'];

    $usuario_e=$pdo->prepare("UPDATE empleado 
                              SET clave=:clave
                              WHERE cedula_persona=:cedula_usuario OR usuario=:cedula_usuario");

    $usuario_e->bindParam(':cedula_usuario',$cedula_persona);
    $usuario_e->bindParam(':clave',$clave);
    $usuario_e->execute();

    
    if($usuario_e->execute()) {
        $successmsg = "Contraseña Actualizada!";
        echo $successmsg;
        //header("Location: login.php ? successmsg = $successmsg");
    } else {
        $errormsg = "Error al actualizar clave, revise usuario!";
        print_r ($usuario_e->errorInfo());
    }

  