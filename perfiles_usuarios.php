<?php
session_start();
require_once("db/conexion.php");
require_once("layout/test_input.php");

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$usuarioId = $_SESSION['id'];
$errores = [];
$exito = "";    

// Obtener datos actuales del usuario
$consulta = $conexion->prepare("SELECT * FROM usuarios WHERE id = :id");
$consulta->bindParam(':id', $usuarioId);
$consulta->execute();
$usuario = $consulta->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = test_input($_POST['nombre'] ?? $usuario['nombre']);
    $email = filter_var($_POST['email'] ?? $usuario['email'], FILTER_VALIDATE_EMAIL);
    $password = test_input($_POST['password'] ?? null);

    if (empty($nombre)) {
        $errores[] = "El nombre es obligatorio.";
    }
    if (empty($email)) {
        $errores[] = "El email es obligatorio.";
    }

    if (empty($errores)) {
        // Actualizar datos en la base de datos
        if ($password) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $consulta = $conexion->prepare("UPDATE usuarios SET nombre = :nombre, email = :email, password = :password WHERE id = :id");
            $consulta->bindParam(':password', $passwordHash);
            
        } else {
            $consulta = $conexion->prepare("UPDATE usuarios SET nombre = :nombre, email = :email WHERE id = :id");
        }

        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':email', $email);
        $consulta->bindParam(':id', $usuarioId);

        if ($consulta->execute()) {
            $exito = "Datos actualizados correctamente.";
            $_SESSION['nombre'] = $nombre;
        } else {
            $errores[] = "Hubo un error al actualizar los datos.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Modificar Datos</title>
</head>
<body>
    <?php include "layout/header.php"; ?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Datos de <?=$usuario['nombre']; ?></h1>
        

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow p-4">
                    <form action="perfiles_usuarios.php" method="POST">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($usuario['nombre']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($usuario['email']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Nueva Contraseña (opcional)</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Dejar vacío si no deseas cambiarla">
                        </div>

                        <?php if (!empty($errores)): ?>
                            <div class="alert alert-danger">
                                <?php foreach ($errores as $error): ?>
                                    <p class="mb-0"><?= $error; ?></p>
                                <?php endforeach; ?>
                            </div>
                        <?php elseif (!empty($exito)): ?>
                            <div class="alert alert-success">
                                <p class="mb-0"><?= $exito; ?></p>
                            </div>
                        <?php endif; ?>

                        <button type="submit" class="btn btn-success w-100">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include "layout/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
