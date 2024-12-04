
<?php session_start(); ?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Nutrifoods</title>
</head>

<body>

      <!-- header -->
    <?php include "layout/header.php" ?>

    <main>
        
        <!-- Sobre nosotros -->
        <h1 class="text-center p-3">Sobre nosotros</h1>

        <section class="container sobre_nosotros">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <img src="assets/img/nutrifoods_sobreNosotros.jpg" alt="" width="600px">
                </div>
                <div class="col-md-6 col-sm-12">

                    <h2 class="text-center subtitle">¿Quienes somos?</h2>

                    <h2 class="text-center subtitle">¿Quines somos?</h2>

                    <p class=" p-4 fs-4">
                        NutriFoods es una empresa comprometida con el desarrollo y comercialización de
                        alimentos saludables y orgánicos. Nuestro enfoque es ofrecer productos naturales, sin aditivos
                        artificiales, que promuevan un estilo de vida saludable y consciente. Nos dedicamos a
                        proporcionar alimentos de alta calidad, dirigidos a quienes buscan mejorar su nutrición de
                        manera sostenible.
                    </p>
                </div>

            </div>

        </section>


         <!--  Misión, Visión y Valores -->

        <section>
            <div class="container p-5">

                

                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title fs-4 subtitle">Misión</h5>
                                <p class="card-text fs-5">
                                     En NutriFoods, nuestra misión es ofrecer alimentos saludables y
                                    orgánicos, brindando
                                    productos de alta calidad que promueven un estilo de vida equilibrado.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title fs-4 subtitle">Visión</h5>
                                <p class="card-text fs-5">
                                     Nuestra visión es ser líderes en la industria de alimentos en
                                    latinoamérica. Buscamos innovar
                                    constantemente y expandir nuestras ofertas.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title fs-4 subtitle">Valores</h5>
                                <p class="card-text fs-5">
                                     NutriFoods se basa en principios como la transparencia,
                                    sostenibilidad, responsabilidad
                                    social y cuidado del medio ambiente.
                                </p>
                            </div>
                        </div>
                    </div>

                    

                </div>
                <div class="text-end">
                    <img  src="assets/img/frutas_sobreNosotros.jpg" alt="" width="600px">
                    <p>Nutri<spanc class="color_orange">Foods👌</spanc></p>
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
