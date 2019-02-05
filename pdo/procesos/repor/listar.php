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
        if($fila['paciente_BCG']) { $BCG_display = " X "; } else { $BCG_display = " "; }
        if($fila['paciente_HBO']) { $HBO_display = " X "; } else { $HBO_display = " "; } 
        if($fila['paciente_rotavirus1']) { $rotavirus1_display = " X "; } else { $rotavirus1_display = " "; }
        if($fila['paciente_rotavirus1']) { $rotavirus2_display = " X "; } else { $rotavirus2_display = " "; }
        if($fila['paciente_pentavalente1']) { $pentavalente1_display = " X "; } else { $pentavalente1_display = " "; }
        if($fila['paciente_pentavalente2']) { $pentavalente2_display = " X "; } else { $pentavalente2_display = " "; }
        if($fila['paciente_pentavalente3']) { $pentavalente3_display = " X "; } else { $pentavalente3_display = " "; }
        if($fila['paciente_poliomielitis1']) { $poliomielitis1_display = " X "; } else { $poliomielitis1_display = " "; }
        if($fila['paciente_poliomielitis2']) { $poliomielitis2_display = " X "; } else { $poliomielitis2_display = " "; }
        if($fila['paciente_poliomielitis3']) { $poliomielitis3_display = " X "; } else { $poliomielitis3_display = " "; }
        if($fila['paciente_neumococo1']) { $neumococo1_display = " X "; } else { $neumococo1_display = " "; }
        if($fila['paciente_neumococo2']) { $neumococo2_display = " X "; } else { $neumococo2_display = " "; }
        if($fila['paciente_neumococo3']) { $neumococo3_display = " X "; } else { $neumococo3_display = " "; }
        if($fila['paciente_SR']) { $SR_display = " X "; } else { $SR_display = " "; }
        if($fila['paciente_SRP']) { $SRP_display = " X "; } else { $SRP_display = " "; }
        if($fila['paciente_varicela']) { $varicela_display = " X "; } else { $varicela_display = " "; }
        if($fila['paciente_FA']) { $FA_display = " X "; } else { $FA_display = " "; }
        if($fila['paciente_OPV']) { $OPV_display = " X "; } else { $OPV_display = " "; }
        if($fila['paciente_Influenza']) { $Influenza_display = " X "; } else { $Influenza_display = " "; }
        echo "<tr>".
                "<td>" . $fila['paciente_nombre'] . " " . $fila['paciente_apellido'] . "</td>".
                "<td>" . $fila['paciente_cedula'] . "</td>".
                "<td>" . $fila['paciente_fecha_nacimiento'] . "</td>".
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
                "<td>" . $BCG_display . "</td>".
                "<td>" . $HBO_display . "</td>".
                "<td>" . $rotavirus1_display . "</td>".
                "<td>" . $rotavirus2_display . "</td>".
                "<td>" . $pentavalente1_display . "</td>".
                "<td>" . $pentavalente2_display . "</td>".
                "<td>" . $pentavalente3_display . "</td>".
                "<td>" . $poliomielitis1_display . "</td>".
                "<td>" . $poliomielitis2_display . "</td>".
                "<td>" . $poliomielitis3_display . "</td>".
                "<td>" . $neumococo1_display . "</td>".
                "<td>" . $neumococo2_display . "</td>".
                "<td>" . $neumococo3_display . "</td>".
                "<td>" . $SR_display . "</td>".
                "<td>" . $SRP_display . "</td>".
                "<td>" . $varicela_display . "</td>".
                "<td>" . $FA_display . "</td>".
                "<td>" . $OPV_display . "</td>".
                "<td>" . $Influenza_display . "</td>".
                "<td>" . $fila['paciente_nacionalidad'] . " <br>" . $fila['paciente_etnia'] . "</td>".

            "</tr>";
    }
} else {
    echo $tabla_sin_datos;
}
