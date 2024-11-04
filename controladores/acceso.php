<?php
session_start();

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];
$recordarme = isset($_POST['rememberMe']);

if ($usuario === 'Donoban' && $contrasena === 'donoban123') {
    $_SESSION['usuario'] = $usuario;

    // Guarda el estado de "Recordarme" en la sesión
    $_SESSION['recordarme'] = $recordarme;

    // Maneja las cookies
    if ($recordarme) {
        // Crea cookies que expiran en 1 semana
        setcookie('usuario', $usuario, time() + (7 * 24 * 60 * 60), '/');
        setcookie('contrasena', $contrasena, time() + (7 * 24 * 60 * 60), '/');
    } else {
        // Si no se seleccionó 'Recordarme', elimina las cookies
        setcookie('usuario', '', time() - 3600, '/');
        setcookie('contrasena', '', time() - 3600, '/');
        setcookie('idioma', '', time() - 3600, '/');
    }

    header("Location: /pantallas/panelPrincipal.php");
    exit();
} else {
    // Redirige de vuelta al login con un mensaje de error
    header("Location: /pantallas/index.php?error=credenciales_invalidas");
    exit();
}
?>
