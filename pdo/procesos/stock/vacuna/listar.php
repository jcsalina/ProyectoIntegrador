<?php
    $vacunas_lista=$pdo->prepare("SELECT 
                                    vacuna.id AS vacuna_id, 
                                    vacuna.nombre AS vacuna_nombre, 
                                    vacuna.tipo AS vacuna_tipo, 
                                    vacuna.estado AS vacuna_estado, 
                                    stockvacuna.cantidad AS vacuna_cantidad,
                                    stockvacuna.lote AS vacuna_lote, 
                                    stockvacuna.fecha_ingreso AS vacuna_fecha_ingreso,
                                    stockvacuna.fecha_expiracion AS vacuna_fecha_expiracion
                                  FROM vacuna 
                                  LEFT JOIN stockvacuna
                                    ON stockvacuna.id_vacuna = vacuna.id ");
    $vacunas_lista->execute();
    

    if($vacunas_lista->rowCount()>=1) {
        while($fila=$vacunas_lista->fetch(PDO::FETCH_ASSOC)){

            if($fila['vacuna_estado']=='1') {
                $estado_display = "Activo";
            } else {
                $estado_display = "Inactivo";
            }

            $tabla_valor = "<tr>".
                                "<td>" . $fila['vacuna_nombre'] . "</td>".
                                "<td>" . $fila['vacuna_cantidad'] . "</td>".
                                "<td>" . $fila['vacuna_tipo'] . "</td>".
                                "<td>" . $fila['vacuna_lote'] . "</td>".
                                "<td>" . $estado_display . "</td>".
                                "<td>" .
                                    "<a class='btn btn-info btn-xs' href='vacunas_registrar.php?id=" . $fila['vacuna_id'] . "'>" .
                                        "<i class='fa fa-pencil'></i>" .
                                    "</a>" .
                                    // "<a class='btn btn-danger btn-xs' href='lista.php?id=" . $fila['vacuna_id'] . "'>" .
                                    //     "<i class='fa fa-trash-o'></i>" .
                                    // "</a>" .
                                "</td>" .
                            "</tr>";

            echo $tabla_valor;
        }
    } else {
        echo    "<tr>".
                    "<td colspan='4'>No hay datos</td>".
                "</tr>";
    }