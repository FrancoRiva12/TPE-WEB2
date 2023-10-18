<?php
require __DIR__ . '/../config.php';

session_start();

// Verificamos si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    // Usuario no autenticado, redirigimos a la página de inicio de sesión
    header('Location: login.php');
    exit();
}

// Obtener la lista de productos para mostrar en el formulario
$query = $pdo->prepare('SELECT * FROM producto');
$query->execute();
$productos = $query->fetchAll(PDO::FETCH_OBJ);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    // Si se envía un formulario POST con un ID de producto, mostrar el formulario de modificación
    $id = $_POST['id'];
    
    // Consulta para obtener los detalles del producto por ID
    $query = $pdo->prepare('SELECT * FROM producto WHERE ID = ?');
    $query->execute([$id]);
    $producto = $query->fetch(PDO::FETCH_OBJ);

    if ($producto) {
        // Mostrar el formulario de modificación
        $marca = $producto->Marca;
        $modelo = $producto->Modelo;
        $descripcion = $producto->Descripcion;
        $precio = $producto->Precio;
        $showForm = true;
    }
}

if (isset($_SESSION['username'])) {
    // Mostrar el botón para cerrar sesión
    echo '<form method="post" action="logout.php">';
    echo '<button type="submit">Cerrar Sesión</button>';
    echo '</form>';
    echo '<a href="../index.php">Volver a la pagina principal</a>';
    echo '<a href="crear.php">Crear item</a>';
    echo '<a href="eliminar.php">Eliminar item</a>';
}

// Manejar la actualización de datos si se ha enviado el formulario de modificación
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar'])) {
    // Obtener los valores actualizados del formulario
    $id = $_POST['id'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    // Realizar la actualización en la base de datos
    $query = $pdo->prepare('UPDATE producto SET Marca = ?, Modelo = ?, Descripcion = ?, Precio = ? WHERE ID = ?');
    $result = $query->execute([$marca, $modelo, $descripcion, $precio, $id]);

    if ($result) {
        echo 'Actualización exitosa.';
    } else {
        echo 'Error al actualizar el producto.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Modificar Producto</title>
</head>
<body>
    <h1>Modificar Producto</h1>

    <form method="POST">
        <label for="producto_id">Selecciona un Producto:</label>
        <select id="producto_id" name="id">
            <?php foreach ($productos as $producto) : ?>
                <option value="<?php echo $producto->ID; ?>">
                    <?php echo $producto->Marca . ' - ' . $producto->Modelo; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Seleccionar Producto</button>
    </form>

    <?php if (isset($showForm) && $showForm) : ?>
        <!-- Formulario para modificar el producto seleccionado -->
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" value="<?php echo $marca; ?>" required><br><br>

            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" value="<?php echo $modelo; ?>" required><br><br>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea><br><br>

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" value="<?php echo $precio; ?>" required><br><br>

            <button type="submit" name="guardar">Guardar</button>
        </form>
    <?php endif; ?>
</body>
</html>