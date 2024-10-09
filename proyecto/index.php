<?php

$nombre = "inicio";


$jsonData = file_get_contents("db/productos.json");

$productos = json_decode($jsonData, true);



?>





<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<title>Document</title>
</head>

<body>

    <?php include "includes/header.php" ?>


    <h1 class="text-center p-3">Pagina de <?php echo $nombre; ?> </h1>


    <section class="container p-2">
        <div class="row">


            <?php foreach ($productos as $prod_saludable): ?>

                <div class="col-4">
                <div class="card" style="width: 350px;">
                    <img src=" <?php echo $prod_saludable['img'];  ?>  " class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"> <?php echo $prod_saludable['nombre'];  ?>  </h5>
                        <p class="card-text">  <?php echo $prod_saludable['descripcion'];  ?>    </p>
                        <p class="card-text"> Precio: <?php echo $prod_saludable['precio'];  ?>    </p>
                        <p class="card-text">  <?php  echo $prod_saludable['categoria'];  ?>    </p>
                        <a href="#" class="btn btn-primary">Comprar</a>
                    </div>
                </div>


                </div>
                

            <?php endforeach; ?>


        </div>

    </section>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>