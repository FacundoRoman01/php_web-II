<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gracias por tu compra</title>
    <!-- Agregar Bootstrap desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            background-color: #ffffff;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .icon {
            font-size: 100px;
            color: #28a745;
        }

        h1 {
            margin-top: 20px;
            font-size: 2.5rem;
            color: #343a40;
        }

        p {
            font-size: 1.2rem;
            color: #6c757d;
        }

        .btn-custom {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 1.1rem;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-custom:hover {
            background-color: #218838;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="icon">
            <i class="bi bi-check-circle"></i> <!-- Icono de Bootstrap -->
        </div>
        <h1>¡Gracias por tu compra!</h1>
        <p>Tu compra ha sido procesada exitosamente. Nos alegra que hayas elegido NutriFoods para tu compra.</p>
        <a href="index.php" class="btn-custom">Volver a la página principal</a>
    </div>

    <!-- Agregar los íconos de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>

</body>

</html>
