<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inicializar el carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Calcular el total de productos en el carrito
$total_productos = array_reduce($_SESSION['carrito'], function ($total, $producto) {
    return $total + $producto['cantidad'];
}, 0);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>NutriFoods</title>
</head>
<body>

<header>
    <nav>
        <a href="index.php" class="logo">
            <p>Nutri<spanc class="color_orange">Foods</spanc></p>
        </a>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="sobre_nosotros.php">Nosotros</a></li>
            <li><a href="contacto.php">Contacto</a></li>

            <?php if (isset($_SESSION['nombre'])): ?>
                <li><a href="perfiles_usuarios.php"><?= htmlspecialchars($_SESSION['nombre']); ?></a></li>
                <li><a href="cerrar_sesion.php">Cerrar sesión</a></li>

                <?php if ($_SESSION['rol'] === 'administrador'): ?>
                    <li><a href="administrar_roles.php">Administración</a></li>
                <?php endif; ?>

            <?php else: ?>
                <li><a href="registro.php">Registrarse</a></li>
            <?php endif; ?>

            <!-- Ícono del carrito -->
            <li>
                <a href="carrito.php" class="position-relative">
                    <i class="bi bi-cart3" style="font-size: 1.5rem;"></i>
                    <?php if ($total_productos > 0): ?>
                        <span class="badge bg-danger position-absolute top-0 start-100 translate-middle rounded-circle">
                            <?= $total_productos; ?>
                        </span>
                    <?php endif; ?>
                </a>
            </li>
        </ul>
    </nav>
</header>

</body>
</html>
