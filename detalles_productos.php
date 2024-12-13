<?php
session_start();
require_once("db/conexion.php");
require_once("db/productos.php");

// Inicializar el carrito si no existe
if (!isset($_SESSION['id'])) {
    echo "Debes iniciar sesión para agregar productos al carrito.";
    header("Location: login.php"); // Redirige al login si no está logueado
    exit;
}

$id_usuario = $_SESSION['id'];

// Función para obtener el detalle del producto por ID
function obtenerDetalleProducto($productos, $id_producto) {
    foreach ($productos as $producto) {
        if ($producto['id_productos_saludables'] == $id_producto) {
            return $producto;
        }
    }
    return null;
}

// Sanitizar entrada
$id_producto = filter_input(INPUT_GET, 'id_productos_saludables', FILTER_SANITIZE_NUMBER_INT);

if (!$id_producto) {
    echo "Producto no especificado.";
    header("Location: productos.php");
    exit;
}

// Obtener todos los productos y buscar el detalle del producto
$productos = getProductos($conexion);
$productoDetalle = obtenerDetalleProducto($productos, $id_producto);

if (!$productoDetalle) {
    echo "Producto no encontrado.";
    header("Location: index.php");
    exit;
}

// Agregar producto al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto_a_agregar = [
        'id' => $productoDetalle['id_productos_saludables'],
        'nombre' => $productoDetalle['nombre_producto'],
        'precio' => $productoDetalle['precio'],
        'cantidad' => 1,
        'img' => $productoDetalle['img']
    ];

    // Buscar si el producto ya está en el carrito
    $producto_existente = array_search(
        $producto_a_agregar['id'],
        array_column($_SESSION['carrito'], 'id')
    );

    if ($producto_existente !== false) {
        $_SESSION['carrito'][$producto_existente]['cantidad']++;
    } else {
        $_SESSION['carrito'][] = $producto_a_agregar;
    }

    header("Location: carrito.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Detalles del Producto</title>
</head>
<body>
    <!-- header -->
    <?php include "layout/header.php"; ?>

    <main>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <img src="<?php echo htmlspecialchars($productoDetalle['img'], ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid" alt="Producto" style="width: 450px;">
                </div>
                <div class="col-md-6">
                    <h2><?php echo htmlspecialchars($productoDetalle['nombre_producto'], ENT_QUOTES, 'UTF-8'); ?></h2>
                    <p><strong>Categoría:</strong> <?php echo htmlspecialchars($productoDetalle['categoria'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p><strong>Precio:</strong> $<?php echo htmlspecialchars($productoDetalle['precio'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p><strong>Descripción:</strong> <?php echo htmlspecialchars($productoDetalle['descripcion'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <form method="POST">
                        <button type="submit" class="btn btn-success">Agregar al carrito</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- footer -->
    <?php include "layout/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
