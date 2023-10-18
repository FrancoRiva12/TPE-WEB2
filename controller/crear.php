<?php
require './config.php';

session_start();

// Verificamos si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    // Usuario no autenticado, redirigimos a la página de inicio de sesión
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // proceso datos del formulario
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    // Realizar el insert en la base de datos
    $query = $pdo->prepare('INSERT INTO producto (Marca, Modelo, Descripcion, Precio) VALUES (?, ?, ?, ?)');
    $query->execute([$marca, $modelo, $descripcion, $precio]);

    // Redirigir al index
    header('Location: ../index.php');
    exit();
}
if (isset($_SESSION['username'])) {
    // Mostrar el botón para cerrar sesión
    echo '<form method="post" action="../view/logout.php">';
    echo '<button type="submit">Cerrar Sesión</button>';
    echo '</form>';
    echo '<a href="../index.php">Volver a la pagina principal</a>';
    echo '<a href="eliminar.php">Eliminar Ítem</a>';
    echo '<a href="modificar.php">Modificar Ítem</a>';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crear Producto</title>
</head>
<body>
    <h1>Crear Producto</h1>

    <form method="POST">
        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" required><br><br>

        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" required><br><br>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion"></textarea><br><br>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" required><br><br>

        <button type="submit">Guardar</button>
    </form>
</body>
</html>