<?php
    $campanas_lista=$pdo->prepare("SELECT * 
                                    FROM campana 
                                    ");
    $campanas_lista->execute();
    

    if($campanas_lista->rowCount()>=1) {
        while($fila=$campanas_lista->fetch(PDO::FETCH_ASSOC)){

            $tabla_valor = "<tr>".
                                "<td>" . $fila['nombre'] . "</td>".
                                "<td>" . $fila['edad'] . "</td>".
                                "<td>" . $fila['fecha_inicio'] . "</td>".
                                "<td>" . $fila['fecha_fin'] . "</td>".
                                "<td>" .
                                    "<a class='btn btn-info btn-xs' href='registrar.php?id=" . $fila['id'] . "'>" .
                                         "<i class='fa fa-pencil'></i>" .
                                     "</a>" .
                                    // "<a class='btn btn-danger btn-xs' href='lista.php?id=" . $fila['id'] . "'>" .
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