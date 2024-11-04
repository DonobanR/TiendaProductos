<?php
include '../controladores/verificacionSesion.php';
include '../modelos/ListaProducto.php';

$tablaProductos = "";
$categoriaSeleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : '';

$idiomaSeleccionado = isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : 'es';

if ($categoriaSeleccionada) {
    $producto = new ListaProducto($idiomaSeleccionado);
    $tablaProductos = $producto->obtenerProductosPorCategoria($categoriaSeleccionada);
}
?>

<!DOCTYPE html>
<html lang="<?php echo $idiomaSeleccionado; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Productos</title>
</head>
<body>

<header>
    <h1>PANEL PRINCIPAL</h1>
    <a href="/controladores/cerrarSesion.php" id="cerrarSesion">Cerrar Sesión</a>
    <a href="/pantallas/panelPrincipal.php" id="regresar">Regresar</a>
</header>
<div class="presentacion">
    <h2>Bienvenido usuario: <?php echo htmlspecialchars($_SESSION["usuario"]); ?> </h2>
    <h2><?php echo $idiomaSeleccionado === 'es' ? 'Productos en la Categoría:' : 
    'Products in the Category:'; ?> <?php echo htmlspecialchars($categoriaSeleccionada); ?></h2>
</div>

<div>
    <?php echo $tablaProductos; ?>
</div>

</body>
</html>

