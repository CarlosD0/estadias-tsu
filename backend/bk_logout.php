<?php
    // Retomar sesión activa.
session_start();
    // Se termina el proceso de la sesión activa.
session_destroy();
    // Redireccion hacia la página de inicio.
header('Location: ../index.php');
?>
