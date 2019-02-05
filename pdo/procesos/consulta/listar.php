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

    $pacientes_lista=$pdo->prepare("SELECT paciente.id AS id, paciente.cedula_persona AS paciente_cedula, persona.nombre AS paciente_nombre, persona.apellido AS paciente_apellido, persona.direccion AS paciente_direccion, persona.telefono AS paciente_telefono, paciente.fecha_nacimiento AS paciente_fecha_nacimiento, paciente.sexo_id AS paciente_sexo_id, sexo.nombre AS paciente_sexo, paciente.nombre_madre AS paciente_madre_nombre, paciente.cedula_madre AS paciente_madre_cedula, paciente.nombre_padre AS paciente_padre_nombre, paciente.cedula_padre AS paciente_padre_cedula, paciente.nacionalidad_id AS paciente_nacionalidad_id, nacionalidad.nombre AS paciente_nacionalidad, paciente.etnia_id AS paciente_etnia_id, etnia.nombre AS paciente_etnia, paciente.captacion_id AS paciente_captacion_id, captacion.nombre AS paciente_captacion, paciente.pertenencia_distrito AS paciente_pertenece_distrito  
                                    FROM paciente 
                                    LEFT JOIN persona
                                        ON persona.cedula = paciente.cedula_persona 
                                    LEFT JOIN sexo
                                        ON sexo.id = paciente.sexo_id
                                    LEFT JOIN nacionalidad
                                        ON nacionalidad.id = paciente.nacionalidad_id
                                    LEFT JOIN etnia
                                        ON etnia.id = paciente.etnia_id
                                    LEFT JOIN captacion
                                        ON captacion.id = paciente.captacion_id
                                    WHERE paciente.cedula_persona =:cedula_persona
                                        ");
    $pacientes_lista->bindParam(":cedula_persona", $cedula);
    $pacientes_lista->execute();

} else {
    $pacientes_lista=$pdo->prepare("SELECT paciente.id AS id, paciente.cedula_persona AS paciente_cedula, persona.nombre AS paciente_nombre, persona.apellido AS paciente_apellido, persona.direccion AS paciente_direccion, persona.telefono AS paciente_telefono, paciente.fecha_nacimiento AS paciente_fecha_nacimiento, paciente.sexo_id AS paciente_sexo_id, sexo.nombre AS paciente_sexo, paciente.nombre_madre AS paciente_madre_nombre, paciente.cedula_madre AS paciente_madre_cedula, paciente.nombre_padre AS paciente_padre_nombre, paciente.cedula_padre AS paciente_padre_cedula, paciente.nacionalidad_id AS paciente_nacionalidad_id, nacionalidad.nombre AS paciente_nacionalidad, paciente.etnia_id AS paciente_etnia_id, etnia.nombre AS paciente_etnia, paciente.captacion_id AS paciente_captacion_id, captacion.nombre AS paciente_captacion, paciente.pertenencia_distrito AS paciente_pertenece_distrito 
                                    FROM paciente 
                                    LEFT JOIN persona
                                        ON persona.cedula = paciente.cedula_persona 
                                    LEFT JOIN sexo
                                        ON sexo.id = paciente.sexo_id
                                    LEFT JOIN nacionalidad
                                        ON nacionalidad.id = paciente.nacionalidad_id
                                    LEFT JOIN etnia
                                        ON etnia.id = paciente.etnia_id
                                    LEFT JOIN captacion
                                        ON captacion.id = paciente.captacion_id");
    $pacientes_lista->execute();

}

if($pacientes_lista->rowCount()>=1) {
    while($fila=$pacientes_lista->fetch(PDO::FETCH_ASSOC)){

        if($fila['paciente_pertenece_distrito']=='1') {
            $pertenece_distrito_display = "Pertenece";
        } else {
            $pertenece_distrito_display = "No Pertenece";
        }

        echo "<tr>".
                "<td>" . $fila['paciente_cedula'] . "</td>".
                "<td>" . $fila['paciente_nombre'] . " " . $fila['paciente_apellido'] . "</td>".
                "<td>" . $fila['paciente_direccion'] . " <br>" . $fila['paciente_telefono'] . "</td>".
                "<td>" . $fila['paciente_fecha_nacimiento'] . "</td>".
                "<td>" . $fila['paciente_sexo'] . "</td>".
                "<td>" . $fila['paciente_madre_nombre'] . " <br>" . $fila['paciente_madre_cedula'] . "</td>".
                "<td>" . $fila['paciente_padre_nombre'] . " <br>" . $fila['paciente_padre_cedula'] . "</td>".
                "<td>" . $fila['paciente_nacionalidad'] . " <br>" . $fila['paciente_etnia'] . "</td>".
                "<td>" . $pertenece_distrito_display . "</td>".
                "<td>" . $fila['paciente_captacion'] . "</td>".
                "<td>" .
                    "<a class='btn btn-info btn-xs' href='registrar.php?id=" . $fila['id'] . "'>" .
                        "<i class='fa fa-pencil'></i>" .
                    "</a>" .
                    "<a class='btn btn-danger btn-xs' href='lista.php?id=" . $fila['id'] . "'>" .
                        "<i class='fa fa-trash-o'></i>" .
                    "</a>" .
                "</td>" .
            "</tr>";
    }
} else {
    echo $tabla_sin_datos;
}
