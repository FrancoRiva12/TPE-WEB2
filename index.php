<?php
// Incluimos el archivo de configuración de la base de datos (config.php)
require 'config.php';

// Consulta para obtener todos los ítems
$query = $pdo->prepare('SELECT * FROM Producto');
$query->execute();
$productos = $query->fetchAll(PDO::FETCH_OBJ);

// Consulta para obtener todas las categorías
$queryCategorias = $pdo->prepare('SELECT * FROM Categoria');
$queryCategorias->execute();
$categorias = $queryCategorias->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página Principal</title>
</head>
<body>

<h1>Listado de Ítems</h1>

<ul>
    <?php foreach ($productos as $producto) : ?>
        <li>
            <a href="detalle.php?id=<?php echo $producto->ID; ?>">
                <?php echo $producto->Nombre; ?>
            </a>
            (Categoría: <?php echo obtenerCategoria($producto->Categoria_ID); ?>)
        </li>
    <?php endforeach; ?>
</ul>

<h1>Listado de Categorías</h1>

<ul>
    <?php foreach ($categorias as $categoria) : ?>
        <li>
            <a href="items_por_categoria.php?categoria=<?php echo $categoria->ID; ?>">
                <?php echo $categoria->Nombre; ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

</body>
</html>