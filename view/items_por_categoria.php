<?php


require '../config.php';

// Verifica si se proporciona un ID de categoría en la URL
if (isset($_GET['categoria'])) {
    $categoria_id = $_GET['categoria'];
    
    // Consulta para obtener los ítems de una categoría por ID
    $query = $pdo->prepare('SELECT * FROM Producto WHERE Marca = ?');
    $query->execute([$categoria_id]);
    $productos = $query->fetchAll(PDO::FETCH_OBJ);
    
    // Obtiene el nombre de la categoría
    $categoria = $categoria_id;
} else {
    //caso si no se proporciona un ID de categoría
    header('Location: ../index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ítems por Categoría</title>
</head>
<body>

<h1>Ítems de la Categoría: <?php echo $categoria; ?></h1>

<ul>
    <?php foreach ($productos as $producto) : ?>
        <li>
            <a href="detalle.php?id=<?php echo $producto->ID; ?>">
                <?php echo $producto->Modelo; ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

</body>
</html>