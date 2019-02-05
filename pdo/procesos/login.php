<?php
    $cedula_persona = $_POST['cedula_persona'];
    $clave          = $_POST['clave'];

    $usuario_e=$pdo->prepare("SELECT empleado.id AS id, empleado.cedula_persona AS empleado_cedula, persona.nombre AS empleado_nombre, persona.apellido AS empleado_apellido, empleado.usuario AS empleado_usuario, empleado.clave AS empleado_clave, empleado.estado AS empleado_estado, cargo.id AS empleado_cargo_id, cargo.nombre AS empleado_cargo 
                              FROM empleado 
                                LEFT JOIN persona 
                                    ON persona.cedula = empleado.cedula_persona 
                                LEFT JOIN cargo 
                                    ON cargo.id = empleado.cargo_id 
                              WHERE empleado.cedula_persona=:cedula_usuario AND empleado.clave=:clave OR empleado.usuario=:cedula_usuario");

    $usuario_e->bindParam(':cedula_usuario',$cedula_persona);
    $usuario_e->bindParam(':clave',$clave);
    $usuario_e->execute();

    
    

    if($usuario_e->rowCount()>=1) {
        $fila = $usuario_e->fetch();
        
        session_start();
        $_SESSION['id'] = $fila['id'];
        $_SESSION['cedula'] = $fila['empleado_cedula'];
        $_SESSION['usuario'] = $fila['empleado_usuario'];
        $_SESSION['nombre'] = $fila['empleado_nombre'];
        $_SESSION['cargo_id'] = $fila['empleado_cargo_id'];
        $_SESSION['cargo'] = $fila['empleado_cargo'];

        $_SESSION['token'] = md5(uniqid(mt_rand(),true));

        header("Location: index.php");
    } else {
        $errormsg = "Datos Incorrectos!";
    }


        $usuario_p=$pdo->prepare("SELECT * FROM persona WHERE cedula_persona=:cedula");
        $usuario_p->bindParam(':cedula',$cedula_p);
        $usuario_p->execute();

  