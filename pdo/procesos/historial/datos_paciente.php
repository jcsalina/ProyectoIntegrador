<?php
function get_edad($fecha_nacimiento) {
    $cumpleanos = new DateTime($fecha_nacimiento);
    $hoy = new DateTime();
    $annos = $hoy->diff($cumpleanos);
    return $annos->y;
};

$paciente_id;
$paciente_cedula;
$paciente_nombre = "";
$paciente_apellido;
$paciente_direccion;
$paciente_telefono;
$paciente_fecha_nacimiento;
$paciente_sexo;
$paciente_madre_nombre;
$paciente_madre_cedula;
$paciente_padre_nombre;
$paciente_padre_cedula;
$paciente_nacionalidad;
$paciente_etnia;
$paciente_captacion;
$paciente_pertenece_distrito;
$paciente_edad;

if(isset($_GET['cedula'])) {
    $cedula = $_GET['cedula'];

    $datos_paciente=$pdo->prepare("SELECT paciente.id AS id, paciente.cedula_persona AS paciente_cedula, persona.nombre AS paciente_nombre, persona.apellido AS paciente_apellido, persona.direccion AS paciente_direccion, persona.telefono AS paciente_telefono, paciente.fecha_nacimiento AS paciente_fecha_nacimiento, paciente.sexo_id AS paciente_sexo_id, sexo.nombre AS paciente_sexo, paciente.nombre_madre AS paciente_madre_nombre, paciente.cedula_madre AS paciente_madre_cedula, paciente.nombre_padre AS paciente_padre_nombre, paciente.cedula_padre AS paciente_padre_cedula, paciente.nacionalidad_id AS paciente_nacionalidad_id, nacionalidad.nombre AS paciente_nacionalidad, paciente.etnia_id AS paciente_etnia_id, etnia.nombre AS paciente_etnia, paciente.captacion_id AS paciente_captacion_id, captacion.nombre AS paciente_captacion, paciente.pertenencia_distrito AS paciente_pertenece_distrito  
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
                                    WHERE paciente.cedula_persona =:cedula_persona OR paciente.cedula_madre=:cedula_persona OR paciente.cedula_padre=:cedula_persona
                                        ");
    $datos_paciente->bindParam(":cedula_persona", $cedula);
    $datos_paciente->execute();

    if($datos_paciente->rowCount()>=1) {
        while($fila=$datos_paciente->fetch()){
            if($fila['paciente_pertenece_distrito']=='1') {
                $pertenece_distrito_display = "Pertenece";
            } else {
                $pertenece_distrito_display = "No Pertenece";
            }
            $paciente_id                 = $fila["id"];
            $paciente_cedula             = $fila["paciente_cedula"];
            $paciente_nombre             = $fila["paciente_nombre"];
            $paciente_apellido           = $fila["paciente_apellido"];
            $paciente_direccion          = $fila["paciente_direccion"];
            $paciente_telefono           = $fila["paciente_telefono"];
            $paciente_fecha_nacimiento   = $fila["paciente_fecha_nacimiento"];
            $paciente_sexo               = $fila["paciente_sexo"];
            $paciente_madre_nombre       = $fila["paciente_madre_nombre"];
            $paciente_madre_cedula       = $fila["paciente_madre_cedula"];
            $paciente_padre_nombre       = $fila["paciente_padre_nombre"];
            $paciente_padre_cedula       = $fila["paciente_padre_cedula"];
            $paciente_nacionalidad       = $fila["paciente_nacionalidad"];
            $paciente_etnia              = $fila["paciente_etnia"];
            $paciente_captacion          = $fila["paciente_captacion"];
            $paciente_pertenece_distrito = $pertenece_distrito_display;
            $paciente_edad               = get_edad($paciente_fecha_nacimiento);

            
        }
    }
}