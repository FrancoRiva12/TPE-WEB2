<?php
require '../config.php';

session_start();

// Verificamos si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    // Usuario no autenticado, redirigimos a la página de inicio de sesión
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesamos la eliminación del dato
    $id = $_POST['id'];

    // Realizar la eliminación en la base de datos
    $query = $pdo->prepare('DELETE FROM producto WHERE ID = ?');
    $query->execute([$id]);

    // Redirigir a la página principal u otra página de tu elección
    header('Location: ../index.php');
    exit();
} else {
    // Verificamos el id que nos traemos
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        // Consulta para obtener los detalles del producto por ID
        $query = $pdo->prepare('SELECT * FROM producto WHERE ID = ?');
        $query->execute([$id]);
        $producto = $query->fetch(PDO::FETCH_OBJ);

        if (!$producto) {
            // Maneja el caso si el producto no existe
            echo 'El producto no existe.';
            exit();
        }
    } else {
        // Maneja el caso si no se proporciona un ID
        echo 'ID de producto no proporcionado.';
        exit();
    }
}
if (isset($_SESSION['username'])) {
    // Mostrar el botón para cerrar sesión
    echo '<form method="post" action="logout.php">';
    echo '<button type="submit">Cerrar Sesión</button>';
    echo '</form>';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Producto</title>
</head>
<body>
    <h1>Eliminar Producto</h1>
    
    <form method="POST">
        <p>¿Estás seguro de que deseas eliminar este producto?</p>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button type="submit">Eliminar</button>
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>