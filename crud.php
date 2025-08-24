<?php
session_start();
require_once("db/conexion.php");
require_once("layout/verificacion_admin.php");

// Función para agregar un producto
if (isset($_POST['agregar'])) {
    $nombre_producto = $_POST['nombre_producto'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $img = "assets/img/" . $_FILES['img']['name'];

    // Subir imagen al servidor
    move_uploaded_file($_FILES['img']['tmp_name'], $img);

    // Insertar en la base de datos
    $stmt = $conexion->prepare("INSERT INTO productos_saludables (nombre_producto, precio, descripcion, categoria, img) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nombre_producto, $precio, $descripcion, $categoria, $img]);

    header("Location: crud.php");
    exit;
}

// Función para editar un producto
if (isset($_POST['editar'])) {
    $id = $_POST['id_productos_saludables'];
    $nombre_producto = $_POST['nombre_producto'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];

    // Si hay una nueva imagen, actualizarla
    if ($_FILES['img']['name']) {
        $img = "assets/img/" . $_FILES['img']['name'];
        move_uploaded_file($_FILES['img']['tmp_name'], $img);
        $stmt = $conexion->prepare("UPDATE productos_saludables SET nombre_producto = ?, precio = ?, descripcion = ?, categoria = ?, img = ? WHERE id_productos_saludables = ?");
        $stmt->execute([$nombre_producto, $precio, $descripcion, $categoria, $img, $id]);
    } else {
        $stmt = $conexion->prepare("UPDATE productos_saludables SET nombre_producto = ?, precio = ?, descripcion = ?, categoria = ? WHERE id_productos_saludables = ?");
        $stmt->execute([$nombre_producto, $precio, $descripcion, $categoria, $id]);
    }

    header("Location: crud.php");
    exit;
}

// Función para eliminar un producto
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $stmt = $conexion->prepare("DELETE FROM productos_saludables WHERE id_productos_saludables = ?");
    $stmt->execute([$id]);

    header("Location: crud.php");
    exit;
}

// Obtener todos los productos
$productos = $conexion->query("SELECT * FROM productos_saludables")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Gestión de Productos</title>
</head>
<body>
    <?php include "layout/header.php"; ?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Modificar productos saludables</h1>
        
        <!-- Botón para agregar un nuevo producto -->
        <a href="#agregarProductoModal" data-bs-toggle="modal" class="btn btn-success mb-4">Agregar Producto</a>

        <!-- Modal para agregar producto -->
        <div class="modal fade" id="agregarProductoModal" tabindex="-1" aria-labelledby="agregarProductoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="agregarProductoModalLabel">Nuevo Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <form action="crud.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nombre_producto" class="form-label">Nombre del Producto</label>
                                <input type="text" class="form-control" name="nombre_producto" required>
                            </div>
                            <div class="mb-3">
                                <label for="precio" class="form-label">Precio</label>
                                <input type="text" class="form-control" name="precio" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" name="descripcion" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="categoria" class="form-label">Categoría</label>
                                <input type="text" class="form-control" name="categoria" required>
                            </div>
                            <div class="mb-3">
                                <label for="img" class="form-label">Imagen</label>
                                <input type="file" class="form-control" name="img" required>
                            </div>
                            <button type="submit" name="agregar" class="btn btn-primary">Agregar Producto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de productos -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= $producto['id_productos_saludables']; ?></td>
                        <td><?= htmlspecialchars($producto['nombre_producto']); ?></td>
                        <td><?= $producto['precio']; ?></td>
                        <td><?= $producto['categoria']; ?></td>
                        <td>
                            <a href="#editarProductoModal<?= $producto['id_productos_saludables']; ?>" data-bs-toggle="modal" class="btn btn-warning btn-sm">Editar</a>
                            <a href="crud.php?eliminar=<?= $producto['id_productos_saludables']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</a>
                        </td>
                    </tr>

                    <!-- Modal para editar producto -->
                    <div class="modal fade" id="editarProductoModal<?= $producto['id_productos_saludables']; ?>" tabindex="-1" aria-labelledby="editarProductoModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editarProductoModalLabel">Editar Producto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="crud.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id_productos_saludables" value="<?= $producto['id_productos_saludables']; ?>">
                                        <div class="mb-3">
                                            <label for="nombre_producto" class="form-label">Nombre del Producto</label>
                                            <input type="text" class="form-control" name="nombre_producto" value="<?= htmlspecialchars($producto['nombre_producto']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="precio" class="form-label">Precio</label>
                                            <input type="text" class="form-control" name="precio" value="<?= $producto['precio']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="descripcion" class="form-label">Descripción</label>
                                            <textarea class="form-control" name="descripcion" rows="3" required><?= htmlspecialchars($producto['descripcion']); ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="categoria" class="form-label">Categoría</label>
                                            <input type="text" class="form-control" name="categoria" value="<?= $producto['categoria']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="img" class="form-label">Imagen (opcional)</label>
                                            <input type="file" class="form-control" name="img">
                                        </div>
                                        <button type="submit" name="editar" class="btn btn-primary">Actualizar Producto</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include "layout/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
