<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuario</title>
</head>
<body>

<h2>Registro de Usuario</h2>

<?php

require 'config.php';

$registroExitoso = false; // Variable para verificar si el registro se completó con éxito

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar el formulario de registro
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    
    // Validar los datos del formulario
    if (empty($username) || empty($password) || empty($confirmPassword)) {
        echo "Todos los campos son obligatorios.";
    } elseif ($password !== $confirmPassword) {
        echo "Las contraseñas no coinciden.";
    } else {
        // Verificar si el nombre de usuario ya existe en la base de datos
        $query = $pdo->prepare('SELECT * FROM usuarios WHERE Username = ?');
        $query->execute([$username]);
        $existingUser = $query->fetch(PDO::FETCH_OBJ);

        if ($existingUser) {
            echo "El nombre de usuario ya está en uso. Por favor, elige otro.";
        } else {
            // Si el nombre de usuario no existe, registramos al nuevo usuario
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $insertQuery = $pdo->prepare('INSERT INTO usuarios (Username, Password) VALUES (?, ?)');
            $insertQuery->execute([$username, $hashedPassword]);

            echo "¡Registro exitoso! Ahora puedes iniciar sesión.";
            $registroExitoso = true;
        }
    }
}
?>

<form method="POST" action="registro.php">
    <label for="username">Nombre de Usuario:</label>
    <input type="text" id="username" name="username" required><br><br>
    
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required><br><br>
    
    <label for="confirm_password">Confirmar Contraseña:</label>
    <input type="password" id="confirm_password" name="confirm_password" required><br><br>
    
    <button type="submit">Registrar</button>
</form>

<!-- Mostrar el botón de inicio de sesión solo si el registro se ha completado con éxito -->
<?php if ($registroExitoso): ?>
    <a href="view/login.php">Iniciar Sesión</a>
<?php endif; ?>

</body>
</html>