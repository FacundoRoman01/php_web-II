<?php
// Aquí podrías manejar la validación del inicio de sesión
require_once("layout/test_input.php");

$email = filter_var($_POST['email'] ?? null, FILTER_VALIDATE_EMAIL);
$password = test_input($_POST['password'] ?? null);

$errores = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validación de correo electrónico
    if (empty($email)) {
        $errores[] = "El correo electrónico es obligatorio";
    }

    // Validación de contraseña
    if (empty($password)) {
        $errores[] = "La contraseña es obligatoria";
    }

    // Aquí podrías agregar la validación contra la base de datos para verificar el usuario
    // Ejemplo: verificar si el email y la contraseña coinciden con los datos almacenados en la base de datos
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Iniciar sesión</title>
</head>

<body>

     <!-- header -->
     <?php include "layout/header.php" ?>

    <h1 class="text-center">Iniciar sesión</h1>

    <section class="container d-flex justify-content-center align-items-center">
        <div class="row my-5">
            <div class="col">
                <!-- Formulario de inicio de sesión -->
                <form action="#" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su correo electrónico" value="<?= htmlspecialchars($email); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña">
                    </div>

                    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
                        <div class="mb-3">
                            <?php
                            if (empty($errores)) {
                                echo "<div class='alert alert-success'>¡Bienvenido de nuevo!</div>";
                            } else {
                                foreach ($errores as $error) {
                                    echo "<div class='alert alert-danger'>$error</div>";
                                }
                            }
                            ?>
                        </div>
                    <?php endif; ?>

                    <button type="submit" class="btn btn-success w-100">Iniciar sesión</button>
                </form>

                <div class="mt-3 text-center">
                    <p class="text-muted">¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p>
                </div>
            </div>
        </div>
    </section>

    <?php include "layout/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>
