<?php

    $empleados_lista=$pdo->prepare("SELECT empleado.id AS id, empleado.cedula_persona AS empleado_cedula, persona.nombre AS empleado_nombre, persona.apellido AS empleado_apellido, empleado.usuario AS empleado_usuario, empleado.clave AS empleado_clave, empleado.estado AS empleado_estado, cargo.nombre AS empleado_cargo FROM empleado LEFT JOIN persona ON persona.cedula = empleado.cedula_persona LEFT JOIN cargo ON cargo.id = empleado.cargo_id");
    $empleados_lista->execute();


    // if($empleados_lista->rowCount()>=1) {
    //     while($fila=$empleados_lista->fetch()){

            
            if(isset($_GET["exportar"])) {
                if(!empty($empleados_lista)) {
                    $filename = "empleados.xls";
                    header("Content-Type: application/vnd.ms-excel");
                    header("Content-Disposition: attachment; filename=".$filename);

                    $mostrar_columnas = false;

                    foreach($empleados_lista as $empleado) {
                        if(!$mostrar_columnas) {
                            echo implode("\t", array_keys($empleado)) . "\n";
                            $mostrar_columnas = true;
                        }
                        echo implode("\t", array_values($empleado)) . "\n";
                    }

                

                } else {
                    echo 'No hay datos a exportar';
                }
                exit;
            } else {
               
            }
    //     }
    // }