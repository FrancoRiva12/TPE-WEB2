<?php
// Verificar si el usuario ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar el nombre de usuario y contraseña del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta para verificar las credenciales del usuario
    $query = $pdo->prepare('SELECT * FROM Usuarios WHERE Username = ?');
    $query->execute([$username]);
    $user = $query->fetch(PDO::FETCH_OBJ);

    // Verificar la contraseña
    if ($user && password_verify($password, $user->Password)) {
        // Iniciar sesión
        session_start();
        $_SESSION['user_id'] = $user->ID;
        $_SESSION['username'] = $user->Username;

        // redirect a la pagina principal
        header('Location: mainPage.php');
        exit();
    } else {
        // Error si erramos contraseña o usuario
        $error_message = "Credenciales incorrectas.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
</head>
<body>

<h2>Iniciar Sesión</h2>

<?php
if (isset($error_message)) {
    echo "<p>$error_message</p>";
}
?>

<form method="POST" action="login.php">
    <label for="username">Usuario:</label>
    <input type="text" id="username" name="username" required><br><br>
    
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required><br><br>
    
    <button type="submit">Iniciar Sesión</button>
</form>

</body>
</html>