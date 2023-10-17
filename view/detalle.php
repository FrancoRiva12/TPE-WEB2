<?php
require '../model/config.php';

// Verifica si se proporciona un ID de producto en la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Consulta para obtener los detalles del ítem por ID
    $query = $pdo->prepare('SELECT * FROM producto WHERE ID = ?');
    $query->execute([$id]);
    $producto = $query->fetch(PDO::FETCH_OBJ);

    if ($producto) {
        // Obtiene el nombre de la categoría
        $queryCategoria = $pdo->prepare('SELECT Marca FROM producto WHERE ID = ?');
        $queryCategoria->execute([$producto->ID]);
        $categoria = $queryCategoria->fetch(PDO::FETCH_OBJ);
    } else {
        // Maneja el caso si el ítem no existe
        header('Location: ../index.php');
        exit();
    }
} else {
    // Maneja el caso si no se proporciona un ID
    header('Location: ../index.php');
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

<h2><?php echo $producto->Modelo; ?></h2>
<p>Marca: <?php echo $producto->Marca; ?> </p>
<p>Descripción: <?php echo $producto->Descripcion; ?></p>
<p>Precio: $<?php echo $producto->Precio; ?></p>
<p>Categoría: <?php echo $categoria -> Marca; ?></p>

</body>
</html>