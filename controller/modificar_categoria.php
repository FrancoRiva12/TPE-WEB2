<?php
require __DIR__ . '/../config.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
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

$categoriaSeleccionada = null;
$error_message = '';
$categoria_id = ''; // Inicializa la variable para evitar advertencias

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['seleccionar'])) {
        $categoriaSeleccionada = $_POST['categoria'];
    } elseif (isset($_POST['guardar'])) {
        $categoriaSeleccionada = $_POST['categoria_id'];
        $nuevoNombre = $_POST['nuevo_nombre'];

        // Realizar la actualización en la base de datos
        $query = $pdo->prepare('UPDATE categoria_placa SET Marca_ID = ? WHERE Marca_ID = ?');
        $result = $query->execute([$nuevoNombre, $categoriaSeleccionada]);

        if ($result) {
            echo 'Categoría actualizada exitosamente.';
        } else {
            echo 'Error al actualizar la categoría.';
        }
    }
}

// Obtener la lista de categorías para mostrar en el formulario
$query = $pdo->prepare('SELECT Marca_ID FROM categoria_placa');
$query->execute();
$categorias = $query->fetchAll(PDO::FETCH_COLUMN);

if (!empty($categoriaSeleccionada)) {
    // Consulta para obtener los detalles de la categoría seleccionada
    $query = $pdo->prepare('SELECT * FROM categoria_placa WHERE Marca_ID = ?');
    $query->execute([$categoriaSeleccionada]);
    $categoria = $query->fetch(PDO::FETCH_ASSOC);
    if ($categoria) {
        $categoria_id = $categoria['Marca_ID'];
    } 
    
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modificar Categoría</title>
</head>
<body>
    <h1>Modificar Categoría</h1>

    <form method="POST">
        <label for="categoria">Selecciona una Categoría:</label>
        <select id="categoria" name="categoria">
            <?php foreach ($categorias as $categoria) : ?>
                <option value="<?php echo $categoria; ?>"><?php echo $categoria; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="seleccionar">Seleccionar Categoría</button>
    </form>

    <?php if (!empty($categoriaSeleccionada)) : ?>
        <!-- Formulario para modificar la categoría seleccionada -->
        <form method="POST">
            <input type="hidden" name="categoria_id" value="<?php echo $categoria_id; ?>">
            <label for="nuevo_nombre">Nuevo Nombre de Categoría:</label>
            <input type="text" id="nuevo_nombre" name="nuevo_nombre" value="<?php echo $categoria_id; ?>" required><br><br>
            <button type="submit" name="guardar">Guardar Cambios</button>
        </form>
    <?php endif; ?>

    <?php if (!empty($error_message)) {
        echo '<p>' . $error_message . '</p>';
    }
    ?>
</body>
</html>