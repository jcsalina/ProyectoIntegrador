<?php
    function cleanData(&$str)
    {
      // escape tab characters
      $str = preg_replace("/\t/", "\\t", $str);
  
      // escape new lines
      $str = preg_replace("/\r?\n/", "\\n", $str);
  
      // convert 't' and 'f' to boolean values
      if($str == 't') $str = 'TRUE';
      if($str == 'f') $str = 'FALSE';
  
      // force certain number/date formats to be imported as strings
      if(preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) {
        $str = "'$str";
      }
  
      // escape fields that include double quotes
      if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }

    if(isset($_GET['fecha_cita'])){
        $fecha_cita = $_GET['fecha_cita'];
    
        $citasmedicas_lista=$pdo->prepare("SELECT * 
                                        FROM agendamiento 
                                        WHERE agendamiento.fecha_cita LIKE :fecha_consulta");
        $citasmedicas_lista->bindParam(":fecha_consulta", $fecha_cita);

     } else {
        // header('Location: '.$_SERVER['REQUEST_URI']);
        $citasmedicas_lista=$pdo->prepare("SELECT * 
                                           FROM agendamiento");
    }
    $citasmedicas_lista->execute();

    if($citasmedicas_lista->rowCount()>=1) {
        while($fila=$citasmedicas_lista->fetch(PDO::FETCH_ASSOC)){
            
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
                                                   paciente.captacion_id AS paciente_captacion_id, 
                                                   captacion.nombre AS paciente_captacion, 
                                                   paciente.pertenencia_distrito AS paciente_pertenece_distrito  
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
                                    WHERE paciente.id =:paciente_id
                                        ");
            $pacientes_lista->bindParam(":paciente_id", $fila['paciente_id']);
            $pacientes_lista->execute();

            // // filename for download
            // $filename = "website_data_" . date('Ymd') . ".xls";

            // header("Content-Disposition: attachment; filename=\"$filename\"");
            // header("Content-Type: application/vnd.ms-excel");

            // $flag = false;       

            if($pacientes_lista->rowCount()>=1) {
                while($fila_p=$pacientes_lista->fetch(PDO::FETCH_ASSOC)){
                    $tabla_valor = "<tr>".
                                        "<td>" . $fila_p['paciente_cedula'] . "</td>".
                                        "<td>" . $fila_p['paciente_nombre'] . " " . $fila_p['paciente_apellido'] . "</td>".
                                        "<td>" . $fila['fecha_cita'] . "</td>".
                                        "<td>" . $fila['estado'] . "</td>".
                                    "</tr>";

                    echo $tabla_valor;

                    
                    
                }



                // while($fila=$citasmedicas_lista->fetch(PDO::FETCH_ASSOC)){
                //     if(!$flag) {
                //     // display field/column names as first row
                //     echo implode("\t", array_keys($fila   )) . "\r\n";
                //     $flag = true;
                //     }
                //     array_walk($fila  , __NAMESPACE__ . '\cleanData');
                //     echo implode("\t", array_values($fila )) . "\r\n";
                // }
                // exit;
            }


        }
    } else {
        echo    "<tr>".
                    "<td colspan='4'>No hay datos</td>".
                "</tr>";
    }

// /*******EDIT LINES 3-8*******/
// $DB_Server = "localhost"; //MySQL Server    
// $DB_Username = "root"; //MySQL Username     
// $DB_Password = "";             //MySQL Password     
// $DB_DBName = "proyectoministerio";         //MySQL Database Name  
// $DB_TBLName = "agendamiento"; //MySQL Table Name   
// $filename = "excelfilename";         //File Name
// /*******YOU DO NOT NEED TO EDIT ANYTHING BELOW THIS LINE*******/    
// //create MySQL connection   
// $sql = "Select * from $DB_TBLName";
// $Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno());
// //select database   
// $Db = @mysql_select_db($DB_DBName, $Connect) or die("Couldn't select database:<br>" . mysql_error(). "<br>" . mysql_errno());   
// //execute query 
// $result = @mysql_query($sql,$Connect) or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno());    
// $file_ending = "xls";
// //header info for browser
// header("Content-Type: application/xls");    
// header("Content-Disposition: attachment; filename=$filename.xls");  
// header("Pragma: no-cache"); 
// header("Expires: 0");
// /*******Start of Formatting for Excel*******/   
// //define separator (defines columns in excel & tabs in word)
// $sep = "\t"; //tabbed character
// //start of printing column names as names of MySQL fields
// for ($i = 0; $i < mysql_num_fields($result); $i++) {
// echo mysql_field_name($result,$i) . "\t";
// }
// print("\n");    
// //end of printing column names  
// //start while loop to get data
//     while($row = mysql_fetch_row($result))
//     {
//         $schema_insert = "";
//         for($j=0; $j<mysql_num_fields($result);$j++)
//         {
//             if(!isset($row[$j]))
//                 $schema_insert .= "NULL".$sep;
//             elseif ($row[$j] != "")
//                 $schema_insert .= "$row[$j]".$sep;
//             else
//                 $schema_insert .= "".$sep;
//         }
//         $schema_insert = str_replace($sep."$", "", $schema_insert);
//         $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
//         $schema_insert .= "\t";
//         print(trim($schema_insert));
//         print "\n";
//     }   