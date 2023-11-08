<?php
require __DIR__ . '/../config.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $marca_id = $_POST['marca_id'];

    // Realizar la eliminación en la base de datos
    $query = $pdo->prepare('DELETE FROM categoria_placa WHERE Marca_ID = ?');
    $success = $query->execute([$marca_id]);

    if ($success) {
        // Redirigir al usuario a la página principal con un mensaje de éxito
        header('Location: ../index.php?message=Categoría eliminada exitosamente');
        exit();
    } else {
        // Mostrar un mensaje de error si la eliminación falla
        $error_message = "Hubo un error al eliminar la categoría. Inténtalo de nuevo.";
    }
} else {
    // Consulta para obtener todas las categorías
    $query = $pdo->prepare('SELECT Marca_ID FROM categoria_placa');
    $query->execute();
    $categorias = $query->fetchAll(PDO::FETCH_ASSOC);
}
?>
<?php if (isset($_SESSION['username'])): ?>
    <form method="post" action="../view/logout.php">
        <button type="submit">Cerrar Sesión</button>
    </form>
    <a href="../index.php">Volver a la página principal</a>
    <a href="crear_categoria.php">Crear Categoría</a>
    <a href="modificar_categoria.php">Modificar Categoría</a>
<?php endif; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Categoría</title>
</head>
<body>
    <h1>Eliminar Categoría</h1>

    <form method="POST">
        <label for="marca_id">Seleccionar Categoría a Eliminar:</label>
        <select id="marca_id" name="marca_id">
            <option value="">Selecciona una Categoría</option>
            <?php foreach ($categorias as $categoria) : ?>
                <option value="<?php echo $categoria['Marca_ID']; ?>"><?php echo $categoria['Marca_ID']; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Eliminar Categoría</button>
    </form>

    <?php if (isset($error_message)) {
        echo '<p>' . $error_message . '</p>';
    }
    ?>
</body>
</html>