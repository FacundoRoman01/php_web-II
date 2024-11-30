<?php


require_once("layout/test_input.php");

$nombre = test_input($_POST['nombre'] ?? null);
$email = filter_var($_POST['email'] ?? null, FILTER_VALIDATE_EMAIL);
$password = test_input($_POST['password'] ?? null);
$rol = test_input($_POST['rol'] ?? null);



$errores = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($nombre)) {
        $errores[] = "El nombre es obligatorio";
    }


    if (empty($email)) {
        $errores[] = "El Gmail es obligatorio";
    }

    
    if (empty($password)) {
        $errores[] = "La constraseña es obligatorio";
    }


    if (empty($rol) || !in_array($rol, ['usuario', 'administrador'])) {
        $errores[] = "El rol es obligatorio y debe ser 'usuario' o 'administrador'";
    }




}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>

    <?php include "layout/header.php" ?>
    
    <h1 class="text-center">Login</h1>


    <section class="container d-flex justify-content-center align-items-center bg-primary ">


        <div class="row my-5 ">

            <div class="col ">
                <!-- Formulario -->
                <form action="#" method="POST">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre" value="<?= htmlspecialchars($nombre); ?>" >
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email"  placeholder="Ingrese su email" value="<?= htmlspecialchars($email); ?>" >
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su constraseña"  >
                    </div>
                    <div class="mb-3">
                        <label for="rol" class="form-label">Rol</label>
                        <select class="form-select" name="rol" id="rol">
                            <option value="" <?= empty($rol) ? 'selected' : '' ?>>Selecciona un rol</option>
                            <option value="usuario" <?= ($rol == 'usuario') ? 'selected' : '' ?>>Usuario</option>
                            <option value="administrador" <?= ($rol == 'administrador') ? 'selected' : '' ?>>Administrador</option>
                        </select>
                    </div>

                    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
                            <div class="mb-3">
                                <?php

                                if (empty($errores)) {
                                    echo "<div class='alert alert-success'>Gracias por registrarte..</div>";
                                } else {
                                    foreach ($errores as $error) {
                                        echo "<div class='alert alert-danger'>$error</div>";
                                    }
                                }
                                ?>
                            </div>
                        <?php endif; ?>

                        <div>
                            <a class="text-white" href="login.php">¿Ya estas registrado?</a>
                        </div>


                    <button type="submit" class="btn btn-success w-100">Registrarse</button>
                </form>

            </div>
        </div>
    </section>

    <?php include "layout/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>