<?php 

// Verificar si el usuario está autenticado y tiene permisos de administrador
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'administrador') {
    header("Location: login.php");
    exit;
}

