<?php
$tabla_sin_datos =  "<tr>".
                        "<td colspan='19'>No hay datos</td>".
                    "</tr>";
$cedula_persona = "";


if(isset($_GET['cedula'])){
    $cedula = $_GET['cedula'];
    $cedula_persona = $cedula;
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


            /*if (isset($fila["BCG"])) {            $checkbox_BCG = "checked='checked' value='1' onclick='return true'";            } else { $checkbox_BCG = "value='0'"; }              
            if (isset($fila["HBO"])) {            $checkbox_HBO = "checked='checked' value='1' onclick='return false'";            } else { $checkbox_HBO = "value='0'"; }              
            if (isset($fila["rotavirus1"])) {     $checkbox_rotavirus1 = "checked='checked' value='1' onclick='return true'";     } else { $checkbox_rotavirus1 = "value='0'"; }       
            if (isset($fila["rotavirus2"])) {     $checkbox_rotavirus2 = "checked='checked' value='1' onclick='return false'";     } else { $checkbox_rotavirus2 = "value='0'"; }       
            if (isset($fila["pentavalente1"])) {  $checkbox_pentavalente1 = "checked='checked' value='1' onclick='return false'";  } else { $checkbox_pentavalente1 = "value='0'"; }    
            if (isset($fila["pentavalente2"])) {  $checkbox_pentavalente2 = "checked='checked' value='1' onclick='return false'";  } else { $checkbox_pentavalente2 = "value='0'"; }    
            if (isset($fila["pentavalente3"])) {  $checkbox_pentavalente3 = "checked='checked' value='1' onclick='return false'";  } else { $checkbox_pentavalente3 = "value='0'"; }    
            if (isset($fila["poliomielitis1"])) { $checkbox_poliomielitis1 = "checked='checked' value='1' onclick='return false'"; } else { $checkbox_poliomielitis1 = "value='0'"; }   
            if (isset($fila["poliomielitis2"])) { $checkbox_poliomielitis2 = "checked='checked' value='1' onclick='return false'"; } else { $checkbox_poliomielitis2 = "value='0'"; }*/   
			if ($fila["rotavirus2"]=="0000-00-00") { $checkbox_rotavirus2 = "value='0'";} else { $checkbox_rotavirus2 = "checked='checked' value='1' onclick='return false'";  }   
			if ($fila["pentavalente1"]=="0000-00-00") { $checkbox_pentavalente1 = "value='0'";} else { $checkbox_pentavalente1 = "checked='checked' value='1' onclick='return false'";  }   
			if ($fila["pentavalente2"]=="0000-00-00") { $checkbox_pentavalente2 = "value='0'";} else { $checkbox_pentavalente2 = "checked='checked' value='1' onclick='return false'";  }   
			if ($fila["pentavalente3"]=="0000-00-00") { $checkbox_pentavalente3 = "value='0'";} else { $checkbox_pentavalente3 = "checked='checked' value='1' onclick='return false'";  }   
			if ($fila["poliomielitis1"]=="0000-00-00") { $checkbox_poliomielitis1 = "value='0'";} else { $checkbox_poliomielitis1 = "checked='checked' value='1' onclick='return false'";  }              
			if ($fila["poliomielitis2"]=="0000-00-00") { $checkbox_poliomielitis2 = "value='0'";} else { $checkbox_poliomielitis2 = "checked='checked' value='1' onclick='return false'";  }   
            if (isset($fila["poliomielitis3"])) { $checkbox_poliomielitis3 = "checked='checked' value='1' onclick='return false'"; } else { $checkbox_poliomielitis3 = "value='0'"; }   
            

            $tabla = "<tr>";

            $tabla .= "<td><input type='checkbox' id='BCG' name='BCG' value='" . $fila["BCG"] . "' " . $checkbox_BCG . "></td>";
            $tabla .= "<td><input type='checkbox' id='HBO' name='HBO' value='" . $fila["HBO"] . "' " . $checkbox_HBO . "></td>";
            $tabla .= "<td><input type='checkbox' id='rotavirus1' name='rotavirus1' value='" . $fila["rotavirus1"] . "' " . $checkbox_rotavirus1 . "></td>";
            $tabla .= "<td><input type='checkbox' id='rotavirus2' name='rotavirus2' value='" . $fila["rotavirus2"] . "' " . $checkbox_rotavirus2 . "></td>";
            $tabla .= "<td><input type='checkbox' id='pentavalente1' name='pentavalente1' value='" . $fila["pentavalente1"] . "' " . $checkbox_pentavalente1 . "></td>";
            $tabla .= "<td><input type='checkbox' id='pentavalente2' name='pentavalente2' value='" . $fila["pentavalente2"] . "' " . $checkbox_pentavalente2 . "></td>";
            $tabla .= "<td><input type='checkbox' id='pentavalente3' name='pentavalente3' value='" . $fila["pentavalente3"] . "' " . $checkbox_pentavalente3 . "></td>";
            $tabla .= "<td><input type='checkbox' id='poliomielitis1' name='poliomielitis1' value='" . $fila["poliomielitis1"] . "' " . $checkbox_poliomielitis1 . "></td>";
            $tabla .= "<td><input type='checkbox' id='poliomielitis2' name='poliomielitis2' value='" . $fila["poliomielitis2"] . "' " . $checkbox_poliomielitis2 . "></td>";
            $tabla .= "<td><input type='checkbox' id='poliomielitis3' name='poliomielitis3' value='" . $fila["poliomielitis3"] . "' " . $checkbox_poliomielitis3 . "></td>";
    
            $tabla .= "</tr><tr>";

            // Fechas
            $tabla .= "";
            if ($fila["BCG"]=="0000-00-00") {$tabla .= "<td></td>"; } else {$tabla .= "<td>" . $fila["BCG"] . "</td>";  }
            if (isset($fila["HBO"])) {              $tabla .= "<td>" . $fila["HBO"] . "</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["rotavirus1"])) {       $tabla .= "<td>" . $fila["rotavirus1"] . "</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["rotavirus2"])) {       $tabla .= "<td>" . $fila["rotavirus2"] . "</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["pentavalente1"])) {    $tabla .= "<td>" . $fila["pentavalente1"] . "</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["pentavalente2"])) {    $tabla .= "<td>" . $fila["pentavalente2"] . "</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["pentavalente3"])) {    $tabla .= "<td>" . $fila["pentavalente3"] . "</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["poliomielitis1"])) {   $tabla .= "<td>" . $fila["poliomielitis1"] . "</td>"; } else { $tabla .= "<td></td>"; }
            if (isset($fila["poliomielitis2"])) {   $tabla .= "<td>" . $fila["poliomielitis2"] . "</td>"; } else { $tabla .= "<td></td>"; }
            //if (isset($fila["poliomielitis3"])) {   $tabla .= "<td>" . $fila["poliomielitis3"] . "</td>"; } else { $tabla .= "<td></td>"; }
            if ($fila["poliomielitis3"]=="0000-00-00") {$tabla .= "<td></td>"; } else {$tabla .= "<td>" . $fila["BCG"] . "</td>";  }     
            $tabla .= "</tr>";

            echo $tabla;
           
        }
    } else {
        echo $tabla_sin_datos;
    }
} else {
    echo $tabla_sin_datos;
}