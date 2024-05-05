<?php

// Esta función verifica si el usuario actual tiene privilegios de administrador.
function is_admin(): bool {
    // Verifica si la sesión está configurada.
    if (!isset($_SESSION)) {
        // Si no está configurada, inicia la sesión.
        session_start();
    }
    // Comprueba si la clave 'admin' está establecida en la sesión y si no está vacía.
    return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
}
?>
