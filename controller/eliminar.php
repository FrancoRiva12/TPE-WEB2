<?php
require '../config.php';

session_start();

// Verificamos si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    // Usuario no autenticado, redirigimos a la página de inicio de sesión
    header('Location: ../view/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // El usuario ha enviado el formulario para eliminar un producto
    $id = $_POST['id'];

    // Realizar la eliminación en la base de datos
    $query = $pdo->prepare('DELETE FROM producto WHERE ID = ?');
    $success = $query->execute([$id]);

    if ($success) {
        // Redirigir al usuario a la página principal con un mensaje de éxito
        header('Location: ../index.php?message=Producto eliminado exitosamente');
        exit();
    } else {
        // Mostrar un mensaje de error si la eliminación falla
        $error_message = "Hubo un error al eliminar el producto. Inténtalo de nuevo.";
    }
} else {
    // Consulta para obtener todos los productos
    $query = $pdo->prepare('SELECT ID, Modelo FROM producto');
    $query->execute();
    $productos = $query->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($_SESSION['username'])) {
    // Mostrar el botón para cerrar sesión
    echo '<form method="post" action="logout.php">';
    echo '<button type="submit">Cerrar Sesión</button>';
    echo '</form>';
    echo '<a href="../index.php">Volver a la pagina principal</a>';
    echo '<a href="crear.php">Eliminar Ítem</a>';
    echo '<a href="modificar.php">Modificar Ítem</a>';
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
        <label for="producto">Seleccionar Producto a Eliminar:</label>
        <select id="producto" name="id">
            <option value="">Selecciona un Producto</option>
            <?php foreach ($productos as $producto) : ?>
                <option value="<?php echo $producto['ID']; ?>"><?php echo $producto['Modelo']; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Eliminar Producto</button>
    </form>

    <?php if (isset($error_message)) {
        echo '<p>' . $error_message . '</p>';
    }
    ?>
</body>
</html>