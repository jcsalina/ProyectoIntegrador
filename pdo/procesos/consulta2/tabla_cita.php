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
                                            persona.nombre AS paciente_nombre, 
                                            persona.apellido AS paciente_apellido, 
                                            agendamiento.fecha_cita AS fecha_cita,
                                            agendamiento.estado AS estado
                                                            FROM paciente 
                                                            LEFT JOIN persona
                                                                ON persona.cedula = paciente.cedula_persona 
                                                            LEFT JOIN agendamiento
                                                                ON agendamiento.paciente_id = paciente.id
                                                            WHERE paciente.cedula_persona =:cedula_persona
                                                                ");
    $pacientes_lista->bindParam(":cedula_persona", $cedula);
    $pacientes_lista->execute();

    if($pacientes_lista->rowCount()>=1) {
        while($fila_p=$pacientes_lista->fetch(PDO::FETCH_ASSOC)){
                $tabla_valor = "<tr>".
                                "<td>" . $fila_p['fecha_cita'] . "</td>".
                                "<td>" . $fila_p['estado'] . "</td>".
                            "</tr>";
                echo $tabla_valor;
        }
    }else {
        echo $tabla_sin_datos;
    }



} else {
    echo $tabla_sin_datos;

}
