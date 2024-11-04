<?php
session_start();

// Inicializa las variables de usuario y contraseña
$usuarioGuardado = '';
$contrasenaGuardada = '';

// Verifica si la cookie 'usuario' y 'contrasena' están establecidas
if (isset($_COOKIE['usuario'])) {
    $usuarioGuardado = htmlspecialchars($_COOKIE['usuario']);
}

if (isset($_COOKIE['contrasena'])) {
    $contrasenaGuardada = htmlspecialchars($_COOKIE['contrasena']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Login</title>
</head>

<body>

    <div class="bienvenido">Bienvenido a la Tienda de productos</div>

    <form class="login" method="POST" action="/controladores/acceso.php">
        <legend> Inicio de sesión</legend>
        Usuario:<br>
        <input type="text" name="usuario" placeholder="Ingrese su usuario" value="<?php echo $usuarioGuardado; ?>" required><br>
        Contraseña:<br>
        <input type="password" name="contrasena" placeholder="Ingrese su contraseña" value="<?php echo $contrasenaGuardada; ?>" required><br>

        <div>
            <input type="checkbox" id="rememberMe" name="rememberMe" <?php if ($usuarioGuardado) echo 'checked'; ?>>
            <label for="rememberMe">Recuerdame</label>
        </div>

        <input type="submit" value="Ingresar">
    </form>

</body>

</html>
