<?php
class ListaProducto {
    private $archivo;
    private $encabezado;
    
    public function __construct($idioma) {
        $this->setArchivo($idioma);
    }

    private function setArchivo($idioma) {
        if ($idioma === 'es') {
            $this->archivo = '../productos/categorias_es.txt';
            $this->encabezado = 'Categoría';
        } elseif ($idioma === 'en') {
            $this->archivo = '../productos/categorias_en.txt';
            $this->encabezado = 'Category'; 
        } else {
            throw new Exception("Idioma no soportado");
        }
    }

    public function obtenerCategorias() {
        if (file_exists($this->archivo)) {
            $jsonContent = file_get_contents($this->archivo);
            $productos = json_decode($jsonContent, true);

            if ($productos !== null) {
                return $this->generarTabla($productos);
            } else {
                return "<p>Error: no se pudo leer el contenido TXT.</p>";
            }
        } else {
            return "<p>Error: el archivo no se encontró.</p>";
        }
    }

    private function generarTabla($productos) {
        $tabla = '<table class="tabla-categoria" border="1">';
        $tabla .= '<tr><th>' . htmlspecialchars($this->encabezado) . '</th></tr>';
    
        foreach ($productos as $producto) {
            // Verifica si la categoría está definida en el producto
            if (isset($producto['category'])) {
                $categoria = htmlspecialchars($producto['category']);
            } elseif (isset($producto['categoria'])) {
                $categoria = htmlspecialchars($producto['categoria']);
            } else {
                continue;
            }
    
            // Genera la fila con el enlace que abarca toda la celda
            $tabla .= '<tr><td><a href="productos.php?categoria=' . urlencode($categoria) . '">' . $categoria . '</a></td></tr>';
        }
    
        $tabla .= '</table>';
        return $tabla;
    }

    public function obtenerProductosPorCategoria($categoria) {
        // Obtiene el idioma de la cookie, o por defecto 'es'
        $idioma = isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : 'es';
        $archivoProductos = ($idioma === 'en') ? '../productos/categorias_en.txt' : '../productos/categorias_es.txt';
        
        if (file_exists($archivoProductos)) {
            $jsonContent = file_get_contents($archivoProductos);
            $productos = json_decode($jsonContent, true);
    
            if ($productos !== null) {
                $tablaProductos = '<table class="tabla-productos">';
                $tablaProductos .= '<tr><th>Id</th><th>' . ($idioma === 'en' ? 'Name' : 'Nombre') .
                 '</th><th>' . ($idioma === 'en' ? 'Description' : 'Descripción') . 
                 '</th><th>' . ($idioma === 'en' ? 'Price' : 'Precio') . '</th></tr>';
    
                foreach ($productos as $producto) {
                    // Ajusta las claves para que funcionen con el idioma correcto
                    $keyCategoria = ($idioma === 'en') ? 'category' : 'categoria';
                    $keyNombre = ($idioma === 'en') ? 'name' : 'nombre';
                    $keyDescripcion = ($idioma === 'en') ? 'description' : 'descripcion';
                    $keyPrecio = ($idioma === 'en') ? 'price' : 'precio';
    
                    if (isset($producto[$keyCategoria]) && $producto[$keyCategoria] === $categoria) {
                        $tablaProductos .= '<tr>';
                        $tablaProductos .= '<td>' . htmlspecialchars($producto['id']) . '</td>';
                        $tablaProductos .= '<td>' . htmlspecialchars($producto[$keyNombre]) . '</td>';
                        $tablaProductos .= '<td>' . htmlspecialchars($producto[$keyDescripcion]) . '</td>';
                        $tablaProductos .= '<td>' . htmlspecialchars($producto[$keyPrecio]) . '</td>';
                        $tablaProductos .= '</tr>';
                    }
                }
    
                $tablaProductos .= '</table>';
                return $tablaProductos;
            } else {
                return "<p>Error: no se pudo leer el contenido de los productos.</p>";
            }
        } else {
            return "<p>Error: el archivo de productos no se encontró.</p>";
        }
    }
}
?>
