<?php
require 'config.php';


session_start();

// Verificamos si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    // Usuario no autenticado, redirigimos a la página de inicio de sesión
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    // Realizar la actualización en la base de datos
    $query = $pdo->prepare('UPDATE producto SET Marca = ?, Modelo = ?, Descripcion = ?, Precio = ? WHERE ID = ?');
    $query->execute([$marca, $modelo, $descripcion, $precio, $id]);

    // Redirect
    header('Location: ../index.php');
    exit();
} else {
    // Verificamos si se proporciona un ID de producto en la URL
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
        
        // Asignamos los valores a las variables para mostrar en el formulario
        $marca = $producto->Marca;
        $modelo = $producto->Modelo;
        $descripcion = $producto->Descripcion;
        $precio = $producto->Precio;
    } else {
        // Manejamos el caso si no se proporciona un ID
        echo 'ID de producto no proporcionado.';
        exit();
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
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        
        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" value="<?php echo $marca; ?>" required><br><br>

        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" value="<?php echo $modelo; ?>" required><br><br>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea><br><br>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" value="<?php echo $precio; ?>" required><br><br>

        <button type="submit">Guardar</button>
    </form>
</body>
</html>