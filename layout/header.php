<<<<<<< HEAD
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

=======
>>>>>>> c7f3239d6a081034311ce997a40ac45a8cde2691
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Document</title>
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
<<<<<<< HEAD

            <?php if (isset($_SESSION['nombre'])): ?>
                <!-- Si el usuario está logueado, mostrar su nombre y la opción de cerrar sesión -->
                <li><a href="perfiles_usuarios.php"> <?= htmlspecialchars($_SESSION['nombre']); ?></a></li>
                <li><a href="cerrar_sesion.php">Cerrar sesión</a></li>

                <?php if ($_SESSION['rol'] === 'administrador'): ?>
                    <!-- Si el usuario es administrador, mostrar la opción para administrar roles -->
                    <li><a href="administrar_roles.php">Administración</a></li>
                <?php endif; ?>

            <?php else: ?>
                <!-- Si el usuario no está logueado, mostrar enlace de login y registro -->
                <!-- <li><a href="login.php">Iniciar sesión</a></li> -->
                <li><a href="registro.php">Registrarse</a></li>
            <?php endif; ?>
=======
            
>>>>>>> c7f3239d6a081034311ce997a40ac45a8cde2691
        </ul>
    </nav>
</header>

<<<<<<< HEAD
</body>
</html>
=======
    
</body>
</html>
>>>>>>> c7f3239d6a081034311ce997a40ac45a8cde2691
