<?php

function test_input($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$nombre = test_input($_POST['nombre'] ?? null);
$email = filter_var($_POST['email'] ?? null, FILTER_VALIDATE_EMAIL);
$telefono = test_input($_POST['telefono'] ?? null);
$servicio = test_input($_POST['servicio'] ?? null);
$comentarios = test_input($_POST['comentarios'] ?? null);


$errores = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($nombre)) {
        $errores[] = "El nombre es obligatorio";
    }


    if (empty($email)) {
        $errores[] = "El Gmail es obligatorio";
    }


    if (empty($telefono)) {
        $errores[] = "El telefono es obligatorio";
    }


    if (empty($servicio)) {
        $errores[] = "El servicio es obligatorio";
    }

    if (empty($comentarios)) {
        $errores[] = "Los comentarios es obligatorio";
    }




}



?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <title>Nutrifoods</title>
</head>

<body>

    <!-- header -->
    <?php include "includes/header.php" ?>



    <main>

        <h1 class="text-center p-4 subtitle">Formulario</h1>

        <section class="container ">
            <div class="row my-5">
                <div class="col-6 my-3">
                    <!-- mapa -->
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13135.097049926098!2d-58.44211033851669!3d-34.60986929055628!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcca5e41da17ff%3A0xebce9fad2698f23f!2sAlmagro%2C%20Cdad.%20Aut%C3%B3noma%20de%20Buenos%20Aires!5e0!3m2!1ses!2sar!4v1728844046379!5m2!1ses!2sar"
                        width="550" height="600" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-6">
                    <!-- Formulario -->
                    <form action="#" method="post">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Tu Nombre"
                                >
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Tu Email"
                                >
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Numero de telefono:</label>
                            <input type="number" class="form-control" id="telefono" name="telefono"
                                placeholder="Tu numero" >
                        </div>
                        <div class="mb-3">
                            <label for="servicio" class="form-label">Servicio de Interés:</label>
                            <select class="form-control" id="servicio" name="servicio" >
                                <option value="">Seleccione un servicio</option>
                                <option value="consultoria">Consultoría Nutricional</option>
                                <option value="productos">Productos Orgánicos</option>
                                <option value="delivery">Servicio de Delivery</option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="comentarios" class="form-label">Comentarios:</label>
                            <textarea class="form-control" id="comentarios" rows="3" name="comentarios"
                                placeholder="Dejenos tu comentario" ></textarea>
                        </div>


                        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
                            <div class="mb-3">
                                <?php

                                if (empty($errores)) {
                                    echo "<div class='alert alert-success'>Gracias por contactarnos. Te responderemos pronto.</div>";
                                } else {
                                    foreach ($errores as $error) {
                                        echo "<div class='alert alert-danger'>$error</div>";
                                    }
                                }
                                ?>
                            </div>
                        <?php endif; ?>

                        <button type="submit" class="btn btn-success fs-5 mb-4">Enviar</button>

                    </form>

                </div>
            </div>
        </section>

    </main>

    <!-- footer -->
    <?php include "includes/footer.php" ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>