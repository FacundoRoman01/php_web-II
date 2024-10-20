<?php 
 
 $error = "Pagina de error";

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <title>Error</title>
</head>
<body>

    <h1 class="text-center p-4">  <?php echo $error  ?>  </h1>
    <img class="text-center" src="assets/img/paginaError.jpg" alt="pagina de error">
</body>
</html>