<?php
// Incluimos el archivo de configuración de la base de datos y pdo (config.php)
require './config.php';

session_start(); // Iniciar la sesión en la parte superior de tu archivo PHP

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['username'])) {
    // El usuario ha iniciado sesión, mostrar botón de cierre de sesión
    $logoutButton = '<form method="post" action="index.php"> <!-- Redirige a la misma página para destruir la sesión -->
                        <button type="submit" name="logout">Cerrar Sesión</button>
                    </form>';
    $crearItemLink = '<a href="controller/crear.php">Crear Ítem</a>';
    $eliminarItemLink = '<a href="controller/eliminar.php">Eliminar Ítem</a>';
    $modificarItemLink = '<a href="controller/modificar.php">Modificar Ítem</a>';
} else {
    $logoutButton = '';
    $crearItemLink = '';
    $eliminarItemLink = '';
    $modificarItemLink = '';
    include './view/login.php';
}

// Verificar si se hizo clic en el botón "Cerrar Sesión"
if (isset($_POST['logout'])) {
    session_destroy(); // Destruir la sesión
    header('Location: index.php'); // Redirigir a la misma página (index.php)
    exit();
}


// Consulta para obtener todas las placas
$query = $pdo->prepare('SELECT * FROM Producto');
$query->execute();
$productos = $query->fetchAll(PDO::FETCH_OBJ);

// Consulta para obtener todas las categorías (marcas)
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

    <?= $logoutButton ?>
    <?= $crearItemLink ?>
    <?= $eliminarItemLink ?>
    <?= $modificarItemLink ?>

</body>

</html>