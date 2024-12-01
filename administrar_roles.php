<?php
session_start();
require_once("db/conexion.php");

if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'administrador') {
    header("Location: login.php");
    exit;
}

$errores = [];
$exito = "";

// Obtener lista de usuarios
$consulta = $conexion->prepare("SELECT id, nombre, email, rol FROM usuarios");
$consulta->execute();
$usuarios = $consulta->fetchAll(PDO::FETCH_ASSOC);

// Cambiar rol de usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cambiarRol'])) {
    $usuarioId = $_POST['usuarioId'];
    $nuevoRol = $_POST['nuevoRol'];

    // Validar que no sea el mismo administrador
    if ($usuarioId == $_SESSION['id']) {
        $errores[] = "No puedes cambiar tu propio rol.";
    } else {
        $update = $conexion->prepare("UPDATE usuarios SET rol = :rol WHERE id = :id");
        $update->bindParam(':rol', $nuevoRol);
        $update->bindParam(':id', $usuarioId);

        if ($update->execute()) {
            $exito = "El rol se actualizó correctamente.";
        } else {
            $errores[] = "Hubo un error al actualizar el rol.";
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
    <title>Administrar Roles</title>
</head>
<body>

    <!-- header -->
    <?php include "layout/header.php" ?>

    <div class="container mt-5 py-5">
        <h1 class="text-center">Administrar Roles de Usuario</h1>

        <div class="">
            <a href="crud.php">Gestion de productos</a>
        </div>

        <!-- Mensajes de éxito o error -->
        <?php if (!empty($errores)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errores as $error): ?>
                    <p><?= $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php elseif (!empty($exito)): ?>
            <div class="alert alert-success">
                <p><?= $exito; ?></p>
            </div>
        <?php endif; ?>

        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= $usuario['id']; ?></td>
                        <td><?= htmlspecialchars($usuario['nombre']); ?></td>
                        <td><?= htmlspecialchars($usuario['email']); ?></td>
                        <td><?= htmlspecialchars($usuario['rol']); ?></td>
                        <td>
                            <!-- Formulario para cambiar rol -->
                            <?php if ($usuario['id'] != $_SESSION['id']): ?>
                                <form action="administrar_roles.php" method="POST" class="d-inline">
                                    <input type="hidden" name="usuarioId" value="<?= $usuario['id']; ?>">
                                    <select name="nuevoRol" class="form-select form-select-sm d-inline w-auto">
                                        <option value="normal" <?= $usuario['rol'] === 'normal' ? 'selected' : ''; ?>>Normal</option>
                                        <option value="administrador" <?= $usuario['rol'] === 'administrador' ? 'selected' : ''; ?>>Administrador</option>
                                    </select>
                                    <button type="submit" name="cambiarRol" class="btn btn-primary btn-sm mt-2">Cambiar</button>
                                </form>
                            <?php else: ?>
                                <span class="text-muted">No puedes cambiar tu propio rol</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include "layout/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
