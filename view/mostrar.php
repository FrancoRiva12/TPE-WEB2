<?php


require '../config.php';

$db = new PDO('mysql:host=localhost;dbname=placas_de_video;charset=utf8', 'root', '');

// Consulta para obtener todas las placas de video
$query = $db->prepare('SELECT * FROM Producto');
$query->execute();
$productos = $query->fetchAll(PDO::FETCH_OBJ);

echo "<ul>";
foreach ($productos as $producto) {
    // Consulta para obtener las especificaciones de cada placa de video
    $query = $db->prepare('SELECT * FROM producto WHERE ID = ?');
    $query->execute([$producto->ID]);
    $especificaciones = $query->fetchAll(PDO::FETCH_OBJ);

    echo '<li>';
    echo 'Marca: ' . $producto->Marca . ', Modelo: ' . $producto->Modelo . ', Descripción: ' . $producto->Descripcion . ', Precio: ' . $producto->Precio;

    // Mostrar las especificaciones de la placa de video
    echo '<ul>';
    foreach ($especificaciones as $especificacion) {
        echo '<li>';
        echo 'Nombre: ' . $especificacion->Marca . ', Modelo: ' . $especificacion->Modelo . ', Precio: $' . $especificacion->Precio . ', Descripcion: ' . $especificacion->Descripcion;
        echo '</li>';
    }
    echo '</ul>';

    echo '</li>';
}

echo "</ul>";
?>