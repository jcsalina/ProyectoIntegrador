

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

    $pacientes_lista=$pdo->prepare("SELECT paciente.id AS id, 
                                    paciente.cedula_persona AS paciente_cedula, 
                                    agendamiento.fecha_cita AS paciente_fecha_cita,
                                    agendamiento.estado AS paciente_estado,
                                    FROM paciente 
                                    LEFT JOIN persona
                                        ON persona.cedula = paciente.cedula_persona 
                                    LEFT JOIN agendamiento
                                        ON agendamiento.paciente_id = paciente.id
                                    WHERE paciente.cedula_persona =:cedula_persona
                                        ");
    $pacientes_lista->bindParam(":cedula_persona", $cedula);
    $pacientes_lista->execute();

} else {
   $pacientes_lista=$pdo->prepare("SELECT paciente.id AS id, 
				       	            paciente.cedula_persona AS paciente_cedula, 
					                agendamiento.fecha_cita AS paciente_fecha_cita,
					                agendamiento.estado AS paciente_estado,
                                    FROM paciente 
                                    LEFT JOIN persona
                                        ON persona.cedula = paciente.cedula_persona 
                                    LEFT JOIN agendamiento
                                        ON agendamiento.paciente_id = paciente.id
                                    ");
    $pacientes_lista->execute();

}

if($pacientes_lista->rowCount()>=1) {
    while($fila=$pacientes_lista->fetch(PDO::FETCH_ASSOC)){

        $tabla_valor = "<tr>".
                 "<td>" . $fila['paciente_fecha_cita'] . "</td>".
                 "<td>" . $fila['paciente_estado'] . "</td>".
                "<td>" .
                    "<a class='btn btn-info btn-xs' href='registrar.php?id=" . $fila['id'] . "'>" .
                        "<i class='fa fa-pencil'></i>" .
                    "</a>" .
                    "<a class='btn btn-danger btn-xs' href='lista.php?id=" . $fila['id'] . "'>" .
                        "<i class='fa fa-trash-o'></i>" .
                    "</a>" .
                "</td>" .
            "</tr>";
            echo $tabla_valor;
    }
} else {
    echo $tabla_sin_datos;
}