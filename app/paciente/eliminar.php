<?php
    header('Content-Type: application/json');
    //echo "control1";
    $aResult = array();
        
    if( !isset($_POST['id_registro']) ) { $aResult['error'] = 'No se encontro registro en la Base de Datos!'; }
    
    if( !isset($aResult['error']) ) {
        //echo "control2";
        
        $id_registro = (int)$_POST['id_registro'];
        //echo $id_registro;
        $query = mysqli_query($con, "SELECT * FROM empleado WHERE id=" . $id_registro . "");
        
        if($query) {
            //echo "control3";
            $sql = "DELETE FROM empleado WHERE id='".mysqli_escape_string($conn,$_POST["id_registro"])."'";

            $query_remove = mysqli_query($con, $sql);
            $query_remove;
            $aResult['result'] = 'Registro Eliminado!';
        } else {
            //echo "control4";
            $aResult['error'] = 'Error al Eliminar!';
        }
    }

    //echo json_encode($aResult);
?>
             