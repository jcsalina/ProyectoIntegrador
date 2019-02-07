<?php
    $vacunas_lista=$pdo->prepare("SELECT 
                                    vacuna.id AS vacuna_id, 
                                    vacuna.nombre AS vacuna_nombre, 
                                    vacuna.tipo AS vacuna_tipo, 
                                    stockvacuna.dosis AS vacuna_dosis,
                                    vacuna.estado AS vacuna_estado, 
                                    stockvacuna.cantidad AS vacuna_cantidad,
                                    stockvacuna.lote AS vacuna_lote, 
                                    stockvacuna.cantidad_total AS vacuna_cantidad_total, 
                                    stockvacuna.stock_actual AS vacuna_stock_actual, 
                                    stockvacuna.fecha_ingreso AS vacuna_fecha_ingreso,
                                    stockvacuna.fecha_expiracion AS vacuna_fecha_expiracion
                                  FROM stockvacuna
                                  LEFT JOIN vacuna
                                    ON stockvacuna.id_vacuna = vacuna.id ");
    $vacunas_lista->execute();
    

    if($vacunas_lista->rowCount()>=1) {
        while($fila=$vacunas_lista->fetch(PDO::FETCH_ASSOC)){

            $tabla_valor = "<tr>".
                                "<td>" . $fila['vacuna_nombre'] . "</td>".
                                "<td>" . $fila['vacuna_lote'] . "</td>".
                                "<td>" . $fila['vacuna_cantidad'] . "</td>".
                                "<td>" . $fila['vacuna_dosis'] . "</td>".
                                "<td>" . $fila['vacuna_cantidad_total'] . "</td>".
                                "<td>" . $fila['vacuna_stock_actual'] . "</td>".
                                "<td>" . $fila['vacuna_fecha_ingreso'] . "</td>".
                                "<td>" . $fila['vacuna_fecha_expiracion'] . "</td>".
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