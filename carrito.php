<?php
session_start();

require_once("db/conexion.php");

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}
$carrito = $_SESSION['carrito'];

// Procesar acciones del carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['eliminar'])) {
        $id = $_POST['eliminar'];
        foreach ($_SESSION['carrito'] as $index => $producto) {
            if ($producto['id'] == $id) {
                unset($_SESSION['carrito'][$index]);
                break;
            }
        }
    } elseif (isset($_POST['actualizar'])) {
        $id = $_POST['id'];
        $cantidad = max(1, min((int) $_POST['cantidad'], 10)); // Limitar entre 1 y 10
        foreach ($_SESSION['carrito'] as &$producto) {
            if ($producto['id'] == $id) {
                $producto['cantidad'] = $cantidad;
                break;
            }
        }
    } elseif (isset($_POST['finalizar_compra'])) {
        // Verificar si el usuario está logueado
        if (!isset($_SESSION['id'])) {
            header("Location: login.php");
            exit;
        }

        $usuario_id = $_SESSION['id'];

        // Guardar cada producto del carrito en la tabla 'compras'
        foreach ($_SESSION['carrito'] as $producto) {
            $stmt = $conexion->prepare("INSERT INTO compras (id_usuario, id_producto, fecha) 
                                   VALUES (?, ?, NOW())");
            $stmt->execute([
                $usuario_id, 
                $producto['id']
            ]);
        }

        // Limpiar el carrito después de la compra
        unset($_SESSION['carrito']);

        // Redirigir a una página de gracias o confirmación
        header("Location: agradecer.php");
        exit;
    }

    // Redirigir después de las acciones del carrito (actualización o eliminación)
    header("Location: carrito.php");
    exit;
}

// Calcular el total completo
$total_completo = array_reduce($carrito, function ($total, $producto) {
    return $total + ($producto['precio'] * $producto['cantidad']);
}, 0);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Carrito de Compras</title>
</head>

<body>
    <!-- header -->
    <?php include "layout/header.php"; ?>

    <main class="container mt-5">
        <h1>Carrito de Compras</h1>
        <?php if ($carrito): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($carrito as $producto): ?>
                        <tr>
                            <td><img src="<?php echo $producto['img']; ?>" style="width: 50px;"></td>
                            <td><?php echo $producto['nombre']; ?></td>
                            <td>$<?php echo $producto['precio']; ?></td>
                            <td>
                                <form method="POST" class="d-flex">
                                    <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                                    <input type="number" name="cantidad" value="<?php echo $producto['cantidad']; ?>"
                                        class="form-control me-2" style="width: 80px;" min="1" max="10">
                                    <button type="submit" name="actualizar" class="btn btn-warning btn-sm">Actualizar</button>
                                </form>
                            </td>
                            <td>$<?php echo $producto['precio'] * $producto['cantidad']; ?></td>
                            <td>
                                <form method="POST">
                                    <button type="submit" name="eliminar" value="<?php echo $producto['id']; ?>"
                                        class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Mostrar total completo -->
            <div class="text-end m-4">
                <h4>Total: $<?php echo $total_completo; ?></h4>
                <!-- Botón para finalizar la compra -->
                <form method="POST" action="carrito.php">
                    <button type="submit" name="finalizar_compra" class="btn btn-success">Finalizar Compra</button>
                </form>
            </div>

        <?php else: ?>
            <p>El carrito está vacío.</p>
        <?php endif; ?>
    </main>

    <!-- footer -->
    <?php include "layout/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
