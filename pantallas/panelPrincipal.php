<?php
include '../controladores/verificacionSesion.php';
include '../modelos/ListaProducto.php';

// Verifica si se ha enviado el idioma
if (isset($_POST['idioma'])) {
    // Establece una cookie que expirará en 1 hora
    setcookie('idioma', $_POST['idioma'], time() + 3600, '/');
    // Redirige a la misma página para que se aplique el nuevo idioma
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Obtiene el idioma de la cookie, o por defecto 'es'
$idiomaSeleccionado = isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : 'es';

// Crea una instancia de ListaProducto
$producto = new ListaProducto($idiomaSeleccionado);
$tablaCategorias = $producto->obtenerCategorias();
?>

<!DOCTYPE html>
<html lang="<?php echo $idiomaSeleccionado; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Panel principal</title>
</head>
<body>

<header>
    <h1>PANEL PRINCIPAL</h1>
    <a href="/controladores/cerrarSesion.php" id="cerrarSesion">Cerrar Sesión</a>
    <form id="tipoIdioma" method="POST" action="">
        <button type="submit" name="idioma" value="es">ES (Español)</button>
        <button type="submit" name="idioma" value="en">EN (English)</button>
    </form>
</header>
<div class="presentacion">
    <h2>Bienvenido usuario: <?php echo htmlspecialchars($_SESSION["usuario"]); ?> </h2>
    <h2><?php echo $idiomaSeleccionado === 'es' ? 'Lista de Productos' : 'Product List'; ?></h2>
</div>

<?php echo $tablaCategorias; ?>

</body>
</html>
