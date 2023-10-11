<?php
session_start();

// Verificar si el usuario ya está autenticado, en cuyo caso redirigirlo a otra página.
if (isset($_SESSION['usuario'])) {
    header("Location: pagina_de_inicio.php");
    exit;
}

// Conectar a la base de datos
require 'config.php'; // Aseguremonos de que este archivo contenga la confign de la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    //verifico las credenciales del usuario
    $sql = "SELECT * FROM Usuarios WHERE Username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['Password'])) {
        // Iniciar sesión y redirigir al usuario a la página de inicio
        $_SESSION['usuario'] = $user;
        header("Location: pagina_de_inicio.php");
        exit;
    } else {
        $error = "Credenciales inválidas. Inténtalo de nuevo.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>

    <?php if (isset($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>

    <form method="post">
        <label for="username">Usuario:</label>
        <input type="text" name="username" id="username" required><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required><br>

        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>