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
            if (isset($fila["neumococo1"])) {       $tabla .= "<td>X</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["neumococo2"])) {       $tabla .= "<td>X</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["neumococo3"])) {       $tabla .= "<td>X</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["SR"])) {               $tabla .= "<td>X</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["SRP"])) {              $tabla .= "<td>X</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["varicela"])) {         $tabla .= "<td>X</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["FA"])) {               $tabla .= "<td>X</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["OPV"])) {              $tabla .= "<td>X</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["Influenza"])) {        $tabla .= "<td>X</td>"; } else { $tabla .= "<td></td>"; }

            $tabla .= "</tr><tr>";

            // Fechas
            $tabla .= "";
            if (isset($fila["neumococo1"])) {       $tabla .= "<td>" . $fila["neumococo1"] . "</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["neumococo2"])) {       $tabla .= "<td>" . $fila["neumococo2"] . "</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["neumococo3"])) {       $tabla .= "<td>" . $fila["neumococo3"] . "</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["SR"])) {               $tabla .= "<td>" . $fila["SR"] . "</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["SRP"])) {              $tabla .= "<td>" . $fila["SRP"] . "</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["varicela"])) {         $tabla .= "<td>" . $fila["varicela"] . "</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["FA"])) {               $tabla .= "<td>" . $fila["FA"] . "</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["OPV"])) {              $tabla .= "<td>" . $fila["OPV"] . "</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["Influenza"])) {        $tabla .= "<td>" . $fila["Influenza"] . "</td>"; } else { $tabla .= "<td></td>"; }
           
            echo $tabla;
           
        }
    } else {
        echo $tabla_sin_datos;
    }
} else {
    echo $tabla_sin_datos;
}