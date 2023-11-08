<?php
require __DIR__ . '/../config.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $marca_id = $_POST['marca_id'];

    // Realizar el insert en la base de datos
    $query = $pdo->prepare('INSERT INTO categoria_placa (Marca_ID) VALUES (?)');
    $query->execute([$marca_id]);

    header('Location: ../index.php');
    exit();
}

if (isset($_SESSION['username'])) {
    echo '<form method="post" action="../view/logout.php">';
    echo '<button type="submit">Cerrar Sesión</button>';
    echo '</form>';
    echo '<a href="../index.php">Volver a la página principal</a>';
    echo '<a href="eliminar_categoria.php">Eliminar Categoría</a>';
    echo '<a href="modificar_categoria.php">Modificar Categoría</a>';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crear Categoría</title>
</head>
<body>
    <h1>Crear Categoría</h1>

    <form method="POST">
        <label for="marca_id">Nombre de la Categoría:</label>
        <input type="text" id="marca_id" name="marca_id" required><br><br>

        <button type="submit">Guardar</button>
    </form>
</body>
</html>