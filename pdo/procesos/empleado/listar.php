<?php
    $empleados_lista=$pdo->prepare("SELECT empleado.id AS id, empleado.cedula_persona AS empleado_cedula, persona.nombre AS empleado_nombre, persona.apellido AS empleado_apellido, empleado.usuario AS empleado_usuario, empleado.clave AS empleado_clave, empleado.estado AS empleado_estado, cargo.nombre AS empleado_cargo 
                                    FROM empleado 
                                    LEFT JOIN persona 
                                        ON persona.cedula = empleado.cedula_persona 
                                    LEFT JOIN cargo 
                                        ON cargo.id = empleado.cargo_id");
    $empleados_lista->execute();
    

    if($empleados_lista->rowCount()>=1) {
        while($fila=$empleados_lista->fetch(PDO::FETCH_ASSOC)){

            if($fila['empleado_estado']=='1') {
                $estado_display = "Activo";
            } else {
                $estado_display = "Inactivo";
            }

            echo "<tr>".
                    "<td>" . $fila['empleado_cedula'] . "</td>".
                    "<td>" . $fila['empleado_nombre'] . " " . $fila['empleado_apellido'] . "</td>".
                    "<td>" . $fila['empleado_usuario'] . "</td>".
                    "<td>" . $fila['empleado_clave'] . "</td>".
                    "<td>" . $estado_display . "</td>".
                    "<td>" . $fila['empleado_cargo'] . "</td>".
                    "<td>" .
                        "<a class='btn btn-info btn-xs' href='registrar.php?id=" . $fila['id'] . "'>" .
                            "<i class='fa fa-pencil'></i>" .
                        "</a>" .
                    "</td>" .
                    "<td>" .
                    "<a class='btn btn-danger btn-xs' href='lista.php?id=" . $fila['id'] . "'>" .
                        "<i class='fa fa-trash-o'></i>" .
                    "</a>" .
                "</td>" .
                "</tr>";
        }
    } else {
        echo    "<tr>".
                    "<td colspan='7'>No hay datos</td>".
                "</tr>";
    }