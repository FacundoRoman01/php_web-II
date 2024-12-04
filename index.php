<?php
session_start();


$titulo_principal = "Nutrición Consciente";


//base de datos

require_once("db/conexion.php");
require_once("db/productos.php");

$productos = getProductos($conexion);

// paginacion

$productosMostrados = 6;

$totalProd = count($productos);
$totalPaginas = ceil($totalProd / $productosMostrados);

$paginaActual = ($_GET['pagina']) ?? 1;



if ($paginaActual < 1) {
    $paginaActual = 1;
} elseif ($paginaActual > $totalPaginas) {
    $paginaActual = $totalPaginas;
}


$inicio = ($paginaActual - 1) * $productosMostrados;

$productosPagina = array_slice($productos, $inicio, $productosMostrados);

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<title>Nutrifoods</title>
</head>

<body>

    <!-- header -->
    <?php include "layout/header.php" ?>

    <main>

        <!-- banner -->

        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/img/banner_nutrifoods.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="assets/img/banner1_nutrifood.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>



        <h1 class="text-center p-3"> <?php echo $titulo_principal; ?> </h1>

        <!-- cards -->
        <section class="container p-2">

            <h4 class="subtitle">Eligidos para vos:</h4>

            <div class="row">


                <?php foreach ($productosPagina as $prod_saludable): ?>

                    <div class="col-md-4 col-sm-12">
                        <div class="card" style="width: 350px;">
                            <img src=" <?php echo $prod_saludable['img']; ?>  " class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"> <?php echo $prod_saludable['nombre_producto']; ?> </h5>
                                <p class="card-text"> <?php echo $prod_saludable['descripcion']; ?> </p>
                                <p class="card-text"> Precio: <?php echo $prod_saludable['precio']; ?> </p>
                                <p class="card-text"> <?php echo $prod_saludable['categoria']; ?> </p>
                                <a href="#" class="btn_style">Ver detalle</a>
                            </div>
                        </div>


                    </div>


                <?php endforeach; ?>


            </div>

            <!-- paginacion -->
            <div class="paginacion">
                <div class="pagination-navegadores">
                    <?php if ($paginaActual < 1): ?>
                        <div class="paginacion-nav">
                            <a href="?pagina=<?php echo $paginaActual - 1; ?>  "><i class="bi bi-arrow-right"></i></a>
                        </div>
                    <?php endif ?>


                    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                        <div class="paginacion-nav">
                            <a href="?pagina=<?php echo $i; ?>" class="<?php if ($i === $paginaActual)
                                   echo 'active'; ?>">
                                <?php echo $i; ?>
                            </a>
                        </div>
                    <?php endfor ?>


                    <?php if ($paginaActual < $totalPaginas): ?>
                        <div class="paginacion-nav">
                            <a href="?pagina=<?php echo $paginaActual + 1; ?>  "><i class="bi bi-arrow-right"></i></a>
                        </div>
                    <?php endif ?>


                </div>
            </div>




        </section>


    </main>




    <!-- footer -->
    <?php include "layout/footer.php" ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>
