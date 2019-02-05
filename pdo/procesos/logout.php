<?php
    session_start();

    // Seguridad para evitar que un agente externo cierre la sesion del usuario
    if (isset($_GET['tk']) && isset($_SESSION['token']) && $_GET['tk']==$_SESSION['token']) {
        session_destroy();
        header("Location: ../../index.php");
    }
    
    