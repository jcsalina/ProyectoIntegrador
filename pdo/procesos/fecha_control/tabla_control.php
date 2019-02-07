<?php
$tabla_sin_datos =  "<tr>".
                        "<td colspan='19'>No hay datos</td>".
                    "</tr>";
$cedula_persona = "";

$id_del_paciente = $paciente_id;

$control_BCG; 
$control_HBO; 
$control_rotavirus1; 
$control_rotavirus2; 
$control_pentavalente1; 
$control_pentavalente2; 
$control_pentavalente3; 
$control_poliomielitis1; 
$control_poliomielitis2; 
$control_poliomielitis3; 
$control_neumococo1; 
$control_neumococo2; 
$control_neumococo3; 
$control_SR; 
$control_SRP; 
$control_varicela; 
$control_FA; 
$control_OPV; 
$control_Influenza; 


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
    $valores_control = $control_lista->fetchAll();

    $BCG            = isset($_POST["BCG"]);
    $HBO            = isset($_POST["HBO"]);
    $rotavirus1     = isset($_POST["rotavirus1"]);
    $rotavirus2     = isset($_POST["rotavirus2"]);
    $pentavalente1  = isset($_POST["pentavalente1"]);
    $pentavalente2  = isset($_POST["pentavalente2"]);
    $pentavalente3  = isset($_POST["pentavalente3"]);
    $poliomielitis1 = isset($_POST["poliomielitis1"]);
    $poliomielitis2 = isset($_POST["poliomielitis2"]);
    $poliomielitis3 = isset($_POST["poliomielitis3"]);
    $neumococo1     = isset($_POST["neumococo1"]);
    $neumococo2     = isset($_POST["neumococo2"]);
    $neumococo3     = isset($_POST["neumococo3"]);
    $SR             = isset($_POST["SR"]);
    $SRP            = isset($_POST["SRP"]);
    $varicela       = isset($_POST["varicela"]);
    $FA             = isset($_POST["FA"]);
    $OPV            = isset($_POST["OPV"]);
    $Influenza      = isset($_POST["Influenza"]);
    echo $Influenza;

    foreach( $valores_control as $row ) {
        $control_BCG            = $row["BCG"];
        $control_HBO            = $row["HBO"];
        $control_rotavirus1     = $row["rotavirus1"];
        $control_rotavirus2     = $row["rotavirus2"];
        $control_pentavalente1  = $row["pentavalente1"];
        $control_pentavalente2  = $row["pentavalente2"];
        $control_pentavalente3  = $row["pentavalente3"];
        $control_poliomielitis1 = $row["poliomielitis1"];
        $control_poliomielitis2 = $row["poliomielitis2"];
        $control_poliomielitis3 = $row["poliomielitis3"];
        $control_neumococo1     = $row["neumococo1"];
        $control_neumococo2     = $row["neumococo2"];
        $control_neumococo3     = $row["neumococo3"];
        $control_SR             = $row["SR"];
        $control_SRP            = $row["SRP"];
        $control_varicela       = $row["varicela"];
        $control_FA             = $row["FA"];
        $control_OPV            = $row["OPV"];
        $control_Influenza      = $row["Influenza"]; 
    }

    // if($neumococo1 == strtotime('0000-00-00')){
    //      $neumococo1 = NULL;
    // }

    $actualizar_control = $pdo->prepare("UPDATE control
                                            SET BCG=:BCG, 
                                                HBO=:HBO, 
                                                rotavirus1=:rotavirus1, 
                                                rotavirus2=:rotavirus2, 
                                                pentavalente1=:pentavalente1, 
                                                pentavalente2=:pentavalente2, 
                                                pentavalente3=:pentavalente3, 
                                                poliomielitis1=:poliomielitis1, 
                                                poliomielitis2=:poliomielitis2, 
                                                poliomielitis3=:poliomielitis3, 
                                                neumococo1=:neumococo1, 
                                                neumococo2=:neumococo2, 
                                                neumococo3=:neumococo3, 
                                                SR=:SR, 
                                                SRP=:SRP, 
                                                varicela=:varicela, 
                                                FA=:FA, 
                                                OPV=:OPV, 
                                                Influenza=:Influenza 
                                            WHERE paciente_id=:paciente_id");
    $actualizar_control->bindParam(":paciente_id", $id_del_paciente);
    
    $BCG            = isset($_POST["BCG"]);
    $HBO            = isset($_POST["HBO"]);
    $rotavirus1     = isset($_POST["rotavirus1"]);
    $rotavirus2     = isset($_POST["rotavirus2"]);
    $pentavalente1  = isset($_POST["pentavalente1"]);
    $pentavalente2  = isset($_POST["pentavalente2"]);
    $pentavalente3  = isset($_POST["pentavalente3"]);
    $poliomielitis1 = isset($_POST["poliomielitis1"]);
    $poliomielitis2 = isset($_POST["poliomielitis2"]);
    $poliomielitis3 = isset($_POST["poliomielitis3"]);
    $neumococo1     = isset($_POST["neumococo1"]);
    $neumococo2     = isset($_POST["neumococo2"]);
    $neumococo3     = isset($_POST["neumococo3"]);
    $SR             = isset($_POST["SR"]);
    $SRP            = isset($_POST["SRP"]);
    $varicela       = isset($_POST["varicela"]);
    $FA             = isset($_POST["FA"]);
    $OPV            = isset($_POST["OPV"]);
    $Influenza      = isset($_POST["Influenza"]);


    // Control
    if(isset($_POST['BCG']) /*&& $_POST['BCG']=="1"*/) {
       $actualizar_control->bindParam(":BCG", NULL); // POST value
    } else {
        $actualizar_control->bindParam(":BCG", $_POST['BCG']); // Base value
    }

    if(isset($_POST['HBO']) && $_POST['HBO']=="1") {
        $actualizar_control->bindParam(":HBO", NULL); // POST value
    } else {
        $actualizar_control->bindParam(":HBO", $_POST['HBO']); // Base value
    }

    if(isset($_POST['rotavirus1']) && $_POST['rotavirus1']=="1") {
        $actualizar_control->bindParam(":rotavirus1", NULL); // POSTULL value
    } else {
        $actualizar_control->bindParam(":rotavirus1", $_POST['rotavirus1']); // Base value
    }

    if(isset($_POST['rotavirus2']) && $_POST['rotavirus2']=="1") {
        //$actualizar_control->bindParam(":rotavirus2", NULL); // POST value
    } else {
        $actualizar_control->bindParam(":rotavirus2", $_POST['rotavirus2']); // Base value
    }

    if(isset($_POST['pentavalente1']) && $_POST['pentavalente1']=="1") {
        //$actualizar_control->bindParam(":pentavalente1", NULL); // POST value
    } else {
        $actualizar_control->bindParam(":pentavalente1", $_POST['pentavalente1']); // Base value
    }

    if(isset($_POST['pentavalente2']) && $_POST['pentavalente2']=="1") {
        //$actualizar_control->bindParam(":pentavalente2", NULL); // POST value
    } else {
        $actualizar_control->bindParam(":pentavalente2", $_POST['pentavalente2']); // Base value
    }

    if(isset($_POST['pentavalente3']) && $_POST['pentavalente3']=="1") {
        //$actualizar_control->bindParam(":pentavalente3", NULL); // POST value
    } else {
        $actualizar_control->bindParam(":pentavalente3", $_POST['pentavalente3']); // Base value
    }

    if(isset($_POST['poliomielitis1']) && $_POST['poliomielitis1']=="1") {
        //$actualizar_control->bindParam(":poliomielitis1", NULL); // POST value
    } else {
        $actualizar_control->bindParam(":poliomielitis1", $_POST['poliomielitis1']); // Base value
    }

    if(isset($_POST['poliomielitis2']) && $_POST['poliomielitis2']=="1") {
        //$actualizar_control->bindParam(":poliomielitis2", NULL); // POST value
    } else {
        $actualizar_control->bindParam(":poliomielitis2", $_POST['poliomielitis2']); // Base value
    }

    if(isset($_POST['poliomielitis3']) && $_POST['poliomielitis3']=="1") {
        //$actualizar_control->bindParam(":poliomielitis3", NULL); // POST value
    } else {
        $actualizar_control->bindParam(":poliomielitis3", $_POST['poliomielitis3']); // Base value
    }

    if(isset($_POST['neumococo1']) && $_POST['neumococo1']=="1") {
        //$actualizar_control->bindParam(":neumococo1", NULL); // POST value
    } else {
        $actualizar_control->bindParam(":neumococo1", $_POST['neumococo1']); // Base value
    }

    if(isset($_POST['neumococo2']) && $_POST['neumococo2']=="1") {
        //$actualizar_control->bindParam(":neumococo2", NULL); // POST value
    } else {
        $actualizar_control->bindParam(":neumococo2", $_POST['neumococo2']); // Base value
    }

    if(isset($_POST['neumococo3']) && $_POST['neumococo3']=="1") {
        //$actualizar_control->bindParam(":neumococo3", NULL); // POST value
    } else {
        $actualizar_control->bindParam(":neumococo3", $_POST['neumococo3']); // Base value
    }

    if(isset($_POST['SR']) && $_POST['SR']=="1") {
        //$actualizar_control->bindParam(":SR", null); // POST value
    } else {
        $actualizar_control->bindParam(":SR", $_POST['SR']); // Base value
    }

    if(isset($_POST['SRP']) && $_POST['SRP']=="1") {
        //$actualizar_control->bindParam(":SRP", NULL); // POST value
    } else {
        $actualizar_control->bindParam(":SRP", $_POST['SRP']); // Base value
    }

    if(isset($_POST['varicela']) && $_POST['varicela']=="1") {
        //$actualizar_control->bindParam(":varicela", NULL); // POST value
    } else {
        $actualizar_control->bindParam(":varicela", $_POST['varicela']); // Base value
    }

    if(isset($_POST['FA']) && $_POST['FA']=="1") {
        //$actualizar_control->bindParam(":FA", NULL); // POST value
    } else {
        $actualizar_control->bindParam(":FA", $_POST['FA']); // Base value
    }

    if(isset($_POST['OPV']) && $_POST['OPV']=="1") {
        //$actualizar_control->bindParam(":OPV", NULL); // POST value
    } else {
        $actualizar_control->bindParam(":OPV", $_POST['OPV']); // Base value
    }

    if(isset($_POST['Influenza']) && $_POST['Influenza']=="1") {
        //$actualizar_control->bindParam(":Influenza", NULL); // POST value
		$errormsg_fechacontrol = "aqui me quedo";
    } else {
        $actualizar_control->bindParam(":Influenza", $_POST['Influenza']); // Base value
    }   

    if(isset($_POST['submit_fechacontrol'])){
        if($actualizar_control->execute()) {
            header('Location: '.$_SERVER['REQUEST_URI']);
            $successmsg_fechacontrol = "¡Datos actualizados correctamente!";
        } else {
            $errormsg_fechacontrol = "Error al registrar cita medica";
            print_r ($actualizar_control->errorInfo()); // Developer Mode
        }
    }
        
} else {
    echo $tabla_sin_datos;
}

