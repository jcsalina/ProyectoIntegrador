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
                                            persona.direccion AS paciente_direccion, 
                                            persona.telefono AS paciente_telefono, 
                                            paciente.fecha_nacimiento AS paciente_fecha_nacimiento, 
                                            paciente.sexo_id AS paciente_sexo_id, 
                                            sexo.nombre AS paciente_sexo, 
                                            paciente.nombre_madre AS paciente_madre_nombre, 
                                            paciente.cedula_madre AS paciente_madre_cedula, 
                                            paciente.nombre_padre AS paciente_padre_nombre, 
                                            paciente.cedula_padre AS paciente_padre_cedula, 
                                            paciente.nacionalidad_id AS paciente_nacionalidad_id, 
                                            nacionalidad.nombre AS paciente_nacionalidad, 
                                            paciente.etnia_id AS paciente_etnia_id, 
                                            etnia.nombre AS paciente_etnia, 
                                            paciente.pertenencia_distrito AS paciente_pertenece_distrito,
                                            control.BCG AS paciente_BCG,
                                            control.HBO AS paciente_HBO,
                                            control.rotavirus1 AS paciente_rotavirus1,
                                            control.rotavirus2 AS paciente_rotavirus2,
                                            control.pentavalente1 AS paciente_pentavalente1,
                                            control.pentavalente2 AS paciente_pentavalente2,
                                            control.pentavalente3 AS paciente_pentavalente3,
                                            control.poliomielitis1 AS paciente_poliomielitis1,
                                            control.poliomielitis2 AS paciente_poliomielitis2,
                                            control.poliomielitis3 AS paciente_poliomielitis3,
                                            control.neumococo1 AS paciente_neumococo1,
                                            control.neumococo2 AS paciente_neumococo2,
                                            control.neumococo3 AS paciente_neumococo3,
                                            control.SR AS paciente_SR,
                                            control.SRP AS paciente_SRP,
                                            control.varicela AS paciente_varicela,
                                            control.FA AS paciente_FA,
                                            control.OPV AS paciente_OPV,
                                            control.Influenza AS paciente_Influenza
                                                            FROM paciente 
                                                            LEFT JOIN persona
                                                                ON persona.cedula = paciente.cedula_persona 
                                                            LEFT JOIN sexo
                                                                ON sexo.id = paciente.sexo_id
                                                            LEFT JOIN nacionalidad
                                                                ON nacionalidad.id = paciente.nacionalidad_id
                                                            LEFT JOIN etnia
                                                                ON etnia.id = paciente.etnia_id
                                                            LEFT JOIN control
                                                                ON control.paciente_id = paciente.id
                                                            WHERE paciente.cedula_persona =:cedula_persona
                                                                ");
    $pacientes_lista->bindParam(":cedula_persona", $cedula);
    $pacientes_lista->execute();

} else {
    $pacientes_lista=$pdo->prepare("SELECT paciente.id AS id, 
                                            paciente.cedula_persona AS paciente_cedula, 
                                            persona.nombre AS paciente_nombre, 
                                            persona.apellido AS paciente_apellido, 
                                            persona.direccion AS paciente_direccion, 
                                            persona.telefono AS paciente_telefono, 
                                            paciente.fecha_nacimiento AS paciente_fecha_nacimiento, 
                                            paciente.sexo_id AS paciente_sexo_id, 
                                            sexo.nombre AS paciente_sexo, 
                                            paciente.nombre_madre AS paciente_madre_nombre, 
                                            paciente.cedula_madre AS paciente_madre_cedula, 
                                            paciente.nombre_padre AS paciente_padre_nombre, 
                                            paciente.cedula_padre AS paciente_padre_cedula, 
                                            paciente.nacionalidad_id AS paciente_nacionalidad_id, 
                                            nacionalidad.nombre AS paciente_nacionalidad, 
                                            paciente.etnia_id AS paciente_etnia_id, 
                                            etnia.nombre AS paciente_etnia, 
                                            paciente.pertenencia_distrito AS paciente_pertenece_distrito,
                                            control.BCG AS paciente_BCG,
                                            control.HBO AS paciente_HBO,
                                            control.rotavirus1 AS paciente_rotavirus1,
                                            control.rotavirus2 AS paciente_rotavirus2,
                                            control.pentavalente1 AS paciente_pentavalente1,
                                            control.pentavalente2 AS paciente_pentavalente2,
                                            control.pentavalente3 AS paciente_pentavalente3,
                                            control.poliomielitis1 AS paciente_poliomielitis1,
                                            control.poliomielitis2 AS paciente_poliomielitis2,
                                            control.poliomielitis3 AS paciente_poliomielitis3,
                                            control.neumococo1 AS paciente_neumococo1,
                                            control.neumococo2 AS paciente_neumococo2,
                                            control.neumococo3 AS paciente_neumococo3,
                                            control.SR AS paciente_SR,
                                            control.SRP AS paciente_SRP,
                                            control.varicela AS paciente_varicela,
                                            control.FA AS paciente_FA,
                                            control.OPV AS paciente_OPV,
                                            control.Influenza AS paciente_Influenza
                                                            FROM paciente 
                                                            LEFT JOIN persona
                                                                ON persona.cedula = paciente.cedula_persona 
                                                            LEFT JOIN sexo
                                                                ON sexo.id = paciente.sexo_id
                                                            LEFT JOIN nacionalidad
                                                                ON nacionalidad.id = paciente.nacionalidad_id
                                                            LEFT JOIN etnia
                                                                ON etnia.id = paciente.etnia_id
                                                            LEFT JOIN control
                                                                ON control.paciente_id = paciente.id
                                                                ");
    $pacientes_lista->execute();

}

if($pacientes_lista->rowCount()>=1) {
    while($fila=$pacientes_lista->fetch(PDO::FETCH_ASSOC)){

        if($fila['paciente_pertenece_distrito']=='1') { $pertenece_distrito_display = " X "; } else { $pertenece_distrito_display = " "; }
        if($fila['paciente_pertenece_distrito']=='2') { $pertenece_distrito2_display = " X "; } else { $pertenece_distrito2_display = " "; }
        if($fila['paciente_sexo_id']=='1') { $sexo_id_display = " X "; } else { $sexo_id_display = " "; }
        if($fila['paciente_sexo_id']=='2') { $sexo_id2_display = " X "; } else { $sexo_id2_display = " "; }
        if($fila['paciente_nacionalidad_id']=='1') { $nacionalidad_id_display = " X "; } else { $nacionalidad_id_display = " "; }
        if($fila['paciente_nacionalidad_id']=='2') { $nacionalidad2_id_display = " X "; } else { $nacionalidad2_id_display = " "; }
        if($fila['paciente_nacionalidad_id']=='3') { $nacionalidad3_id_display = " X "; } else { $nacionalidad3_id_display = " "; }
        if($fila['paciente_nacionalidad_id']=='4') { $nacionalidad4_id_display = " X "; } else { $nacionalidad4_id_display = " "; }
        if($fila['paciente_nacionalidad_id']=='5') { $nacionalidad5_id_display = " X "; } else { $nacionalidad5_id_display = " "; }
        if($fila['paciente_nacionalidad_id']=='6') { $nacionalidad6_id_display = " X "; } else { $nacionalidad6_id_display = " "; }
        if($fila['paciente_etnia_id']=='1') { $etnia_id_display = " X "; } else { $etnia_id_display = " "; }
        if($fila['paciente_etnia_id']=='2') { $etnia2_id_display = " X "; } else { $etnia2_id_display = " "; }
        if($fila['paciente_etnia_id']=='3') { $etnia3_id_display = " X "; } else { $etnia3_id_display = " "; }
        if($fila['paciente_etnia_id']=='4') { $etnia4_id_display = " X "; } else { $etnia4_id_display = " "; }
        if($fila['paciente_etnia_id']=='5') { $etnia5_id_display = " X "; } else { $etnia5_id_display = " "; }
        if($fila['paciente_etnia_id']=='6') { $etnia6_id_display = " X "; } else { $etnia6_id_display = " "; }
        if($fila['paciente_etnia_id']=='7') { $etnia7_id_display = " X "; } else { $etnia7_id_display = " "; }
        if($fila['paciente_etnia_id']=='8') { $etnia8_id_display = " X "; } else { $etnia8_id_display = " "; }
        if($fila['paciente_Influenza']) { $Influenza_display = " X "; } else { $Influenza_display = " "; }
        echo "<tr>".
                "<td>" . $fila['paciente_nombre'] . " " . $fila['paciente_apellido'] . "</td>".
                "<td>" . $fila['paciente_cedula'] . "</td>".
                "<td>" . $sexo_id_display . "</td>".
                "<td>" . $sexo_id2_display . "</td>".
                "<td>" . $pertenece_distrito_display . "</td>".
                "<td>" . $pertenece_distrito2_display . "</td>".
                "<td>" . $nacionalidad_id_display . "</td>".
                "<td>" . $nacionalidad2_id_display . "</td>".
                "<td>" . $nacionalidad3_id_display . "</td>".
                "<td>" . $nacionalidad4_id_display . "</td>".
                "<td>" . $nacionalidad5_id_display . "</td>".
                "<td>" . $nacionalidad6_id_display . "</td>".
                "<td>" . $etnia_id_display . "</td>".
                "<td>" . $etnia2_id_display . "</td>".
                "<td>" . $etnia3_id_display . "</td>".
                "<td>" . $etnia4_id_display . "</td>".
                "<td>" . $etnia5_id_display . "</td>".
                "<td>" . $etnia6_id_display . "</td>".
                "<td>" . $etnia7_id_display . "</td>".
                "<td>" . $etnia8_id_display . "</td>".
                "<td>" . $Influenza_display . "</td>".
            "</tr>";
    }
} else {
    echo $tabla_sin_datos;
}
