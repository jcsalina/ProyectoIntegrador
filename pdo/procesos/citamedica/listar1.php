

<?php
$tabla_sin_datos =  "<tr>".
                        "<td colspan='11'>No hay datos</td>".
                    "</tr>";

if(isset($_GET['cedula'])){
    $cedula = $_GET['cedula'];

    // Reset List
    if($cedula == "") {
        header("Location: lista.php");
    }

    echo $cedula;
    $pacientes_lista=$pdo->prepare("SELECT agendamiento.fecha_cita , agendamiento.id, agendamiento.estado , paciente.cedula_persona
                                    FROM agendamiento 
                                    JOIN paciente 
                                    WHERE paciente.id =agendamiento.paciente_id 
                                        ");
    $pacientes_lista->bindParam(":paciente.cedula_persona", $cedula);
    $pacientes_lista->execute();

} 

if($pacientes_lista->rowCount()>=1) {
    while($fila=$pacientes_lista->fetch(PDO::FETCH_ASSOC)){


        $tabla_valor = "<tr>".
                "<td>" . $fila['paciente.cedula_persona,'] . "</td>".
                "<td>" . $fila['agendamiento.estado'] . "</td>".
                "<td>" . $fila['agendamiento.fecha_cita'] . "</td>".
                "<td>" . $fila['agendamiento.estado'] . "</td>".
                 
                "<td>" .
                    "<a class='btn btn-info btn-xs' href='registrar.php?id=" . $fila['agendamiento.id'] . "'>" .
                        "<i class='fa fa-pencil'></i>" .
                    "</a>" .
                    "<a class='btn btn-danger btn-xs' href='lista.php?id=" . $fila['agendamiento.id'] . "'>" .
                        "<i class='fa fa-trash-o'></i>" .
                    "</a>" .
                "</td>" .
            "</tr>";
            echo $tabla_valor;
    }
} else {
    echo $tabla_sin_datos;
}