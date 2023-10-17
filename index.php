<?php
// Incluimos el archivo de configuración de la base de datos (config.php)
require 'config.php';

session_start(); // Iniciar la sesión en la parte superior de tu archivo PHP

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['username'])) {
    // El usuario ha iniciado sesión, mostrar botón de cierre de sesión
    echo '<a href="view/logout.php">Cerrar Sesión</a>';
    echo '<a href="controller/crear.php">Crear Ítem</a>';
    echo '<a href="controller/eliminar.php">Eliminar Ítem</a>';
    echo '<a href="controller/modificar.php">Modificar Ítem</a>';
}

// Consulta para obtener todos los ítems
$query = $pdo->prepare('SELECT * FROM Producto');
$query->execute();
$productos = $query->fetchAll(PDO::FETCH_OBJ);

// Consulta para obtener todas las categorías
$queryCategorias = $pdo->prepare('SELECT * FROM categoria_placa');
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
                <a href="view/detalle.php?id=<?php echo $producto->ID; ?>">
                    <?php echo $producto->Modelo; ?>
                </a>
                (Marca: <?php echo $producto->Marca; ?>)
            </li>
        <?php endforeach; ?>
    </ul>

    <h1>Listado de Categorías</h1>

    <ul>
        <?php foreach ($categorias as $categoria) : ?>
            <li>
                <a href="view/items_por_categoria.php?categoria=<?php echo $categoria->Marca_ID; ?>">
                    <?php echo $categoria->Marca_ID; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

</body>

</html>