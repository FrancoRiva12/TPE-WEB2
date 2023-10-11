<?php
require 'config.php';

// Verifica si se proporciona un ID de producto en la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Consulta para obtener los detalles del ítem por ID
    $query = $pdo->prepare('SELECT * FROM Producto WHERE ID = ?');
    $query->execute([$id]);
    $producto = $query->fetch(PDO::FETCH_OBJ);

    if ($producto) {
        // Obtiene el nombre de la categoría
        $categoria = obtenerCategoria($producto->Categoria_ID);
    } else {
        // Maneja el caso si el ítem no existe
        header('Location: index.php');
        exit();
    }
} else {
    // Maneja el caso si no se proporciona un ID
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detalle del Ítem</title>
</head>
<body>

<h1>Detalle del Ítem</h1>

<h2><?php echo $producto->Nombre; ?></h2>
<p>Descripción: <?php echo $producto->Descripcion; ?></p>
<p>Precio: $<?php echo $producto->Precio; ?></p>
<p>Categoría: <?php echo $categoria; ?></p>

</body>
</html>