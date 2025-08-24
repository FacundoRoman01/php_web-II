<?php 

function getProductos (PDO $conexion){

        $consultaDb = $conexion->prepare("SELECT * FROM productos_saludables");
        $consultaDb->execute();

        return $consultaDb->fetchAll(PDO::FETCH_ASSOC);


}