<?php 

try {
    $conexion = new PDO('mysql:host=localhost;port=3306;dbname=nutri_foods;charset=utf8', 'root', '');

    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Ha surgido un error por favor intente más tarde';
    exit;
}
