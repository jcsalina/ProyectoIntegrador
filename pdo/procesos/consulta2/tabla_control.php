<?php
$tabla_sin_datos =  "<tr>".
                        "<td colspan='19'>No hay datos</td>".
                    "</tr>";

if(isset($_GET['cedula'])){
    $cedula = $_GET['cedula'];

    // Reset List
    if($cedula == "") {
        header("Location: lista.php");
    }

    $control_lista=$pdo->prepare("  SELECT *
                                    FROM control
                                    LEFT JOIN paciente 
                                        ON control.paciente_id = paciente.id 
                                    WHERE paciente.cedula_persona=:cedula_persona OR paciente.cedula_madre=:cedula_persona OR paciente.cedula_padre=:cedula_persona");
    $control_lista->bindParam(":cedula_persona", $cedula);
    $control_lista->execute();
    
    if($control_lista->rowCount()>=1) {
        while($fila=$control_lista->fetch()){

            $tabla = "";
            if (isset($fila["BCG"])) {              $tabla .= "<td>X</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["HBO"])) {              $tabla .= "<td>X</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["rotavirus1"])) {       $tabla .= "<td>X</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["rotavirus2"])) {       $tabla .= "<td>X</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["pentavalente1"])) {    $tabla .= "<td>X</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["pentavalente2"])) {    $tabla .= "<td>X</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["pentavalente3"])) {    $tabla .= "<td>X</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["poliomielitis1"])) {   $tabla .= "<td>X</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["poliomielitis2"])) {   $tabla .= "<td>X</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["poliomielitis3"])) {   $tabla .= "<td>X</td>"; } else { $tabla .= "<td></td>"; }
            
            $tabla .= "</tr><tr>";

            // Fechas
            $tabla .= "";
            if (isset($fila["BCG"])) {              $tabla .= "<td>" . $fila["BCG"] . "</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["HBO"])) {              $tabla .= "<td>" . $fila["HBO"] . "</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["rotavirus1"])) {       $tabla .= "<td>" . $fila["rotavirus1"] . "</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["rotavirus2"])) {       $tabla .= "<td>" . $fila["rotavirus2"] . "</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["pentavalente1"])) {    $tabla .= "<td>" . $fila["pentavalente1"] . "</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["pentavalente2"])) {    $tabla .= "<td>" . $fila["pentavalente2"] . "</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["pentavalente3"])) {    $tabla .= "<td>" . $fila["pentavalente3"] . "</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["poliomielitis1"])) {   $tabla .= "<td>" . $fila["poliomielitis1"] . "</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["poliomielitis2"])) {   $tabla .= "<td>" . $fila["poliomielitis2"] . "</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["poliomielitis3"])) {   $tabla .= "<td>" . $fila["poliomielitis3"] . "</td>"; } else { $tabla .= "<td></td>"; }
                     
            echo $tabla;
           
        }
    } else {
        echo $tabla_sin_datos;
    }
} else {
    echo $tabla_sin_datos;
}