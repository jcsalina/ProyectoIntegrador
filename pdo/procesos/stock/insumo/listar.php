<?php
    $insumos_lista=$pdo->prepare("SELECT 
                                    insumo.id AS insumo_id, 
                                    insumo.nombre AS insumo_nombre, 
                                    insumo.calibre AS insumo_calibre, 
                                    insumo.estado AS insumo_estado, 
                                    stockinsumo.cantidad AS insumo_cantidad,
                                    stockinsumo.lote AS insumo_lote, 
                                    stockinsumo.fecha_ingreso AS insumo_fecha_ingreso,
                                    stockinsumo.fecha_expiracion AS insumo_fecha_expiracion
                                  FROM stockinsumo
                                  LEFT JOIN insumo
                                    ON stockinsumo.id_insumo = insumo.id ");
    $insumos_lista->execute();
    

    if($insumos_lista->rowCount()>=1) {
        while($fila=$insumos_lista->fetch(PDO::FETCH_ASSOC)){

            $tabla_valor = "<tr>".
                                "<td>" . $fila['insumo_nombre'] . "</td>".
                                "<td>" . $fila['insumo_cantidad'] . "</td>".
                                "<td>" . $fila['insumo_lote'] . "</td>".
                                "<td>" . $fila['insumo_fecha_ingreso'] . "</td>".
                                "<td>" . $fila['insumo_fecha_expiracion'] . "</td>".
                                "<td>" .
                                    "<a class='btn btn-info btn-xs' href='insumos_registrar.php?id=" . $fila['insumo_id'] . "'>" .
                                        "<i class='fa fa-pencil'></i>" .
                                    "</a>" .
                                    // "<a class='btn btn-danger btn-xs' href='lista.php?id=" . $fila['insumo_id'] . "'>" .
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