<?php
session_start();

// Verifica si la sesión existe
if (isset($_SESSION['usuario'])) {
    
    $recordarme = isset($_SESSION['recordarme']) ? $_SESSION['recordarme'] : false;
    session_destroy();

    // Elimina las cookies solo si "Recordarme" no estaba seleccionado
    if (!$recordarme) {
        setcookie('usuario', '', time() - 3600, '/'); // Eliminar cookie de usuario
        setcookie('contrasena', '', time() - 3600, '/'); // Eliminar cookie de contraseña
        setcookie('idioma', '', time() - 3600, '/'); // Eliminar cookie de idioma, si es necesario
    }
}

header('Location: /pantallas/index.php');
exit();
?>
